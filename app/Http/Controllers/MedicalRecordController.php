<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Appointment;
use App\Models\MedicalResult;
use Illuminate\Support\Facades\Log;
use App\Models\User;




class MedicalRecordController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $patients = Patient::all();
        $doctors = Doctor::all();
        $medicalRecords = MedicalRecord::with(['patient', 'doctor'])->get();
        return view('medical_records.index', compact('medicalRecords','patients','doctors','user'));
    }

    public function create()
    {
        $user = auth()->user();

        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('medical_records.create', compact('patients', 'doctors','user'));
    }

    public function store(Request $request)
    {
         // Validate the incoming request data
    $validatedData = $request->validate([
        'patient_id' => 'required|exists:patients,id',
        'doctor_id' => 'required|exists:doctors,id',
        'record_datetime' => 'required|date',
        'description' => 'required|string',
        'symptoms' => 'required|string',
    ]);
         // Log the request data to debug
         \Log::info($request->all());

         // Create a new medical record
    MedicalRecord::create([
        'patient_id' => $validatedData['patient_id'],
        'doctor_id' => $validatedData['doctor_id'],
        'record_datetime' => $validatedData['record_datetime'],
        'description' => $validatedData['description'],
        'symptoms' => $validatedData['symptoms'],
    ]);
        return redirect()->route('medical_records.index')->with('success', 'Medical Record created successfully.');
    }

    public function show(MedicalRecord $medicalRecord)
    {
        $user = auth()->user();

        return view('medical_records.show', compact('medicalRecord','user'));
    }

    public function edit(MedicalRecord $medicalRecord)
    {
        $user = auth()->user();

        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('medical_records.edit', compact('medicalRecord', 'patients', 'doctors','user'));
    }

    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'record_datetime' => 'required|date',
            'description' => 'required|string',
            'symptoms' => 'required|string',
        ]);

        $medicalRecord->update($request->all());
        return redirect()->route('medical_records.index')->with('success', 'Medical Record updated successfully.');
    }

    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();
        return redirect()->route('medical_records.index')->with('success', 'Medical Record deleted successfully.');
    }

    //get medicalrecords
    public function getMedicalRecords(Patient $patient)
    {
    $medicalRecords = $patient->medicalRecords()->with('doctor')->get();
    return response()->json($medicalRecords);
    }

    //add results 
    public function addResult($id)
    {
        $user = auth()->user();

        $medicalRecord = MedicalRecord::findOrFail($id);
        $doctors = Doctor::all();
        return view('medical_records.add_result', compact('medicalRecord','doctors','user'));
    }

    public function storeMedicalResult(Request $request, $medical_record_id)
    {
    $request->validate([
        'doctor_id' => 'required|exists:doctors,id',
        'result' => 'required|string',
        'prescription' => 'nullable|string|max:255',
        'advice' => 'nullable|string|max:255',
    ]);

    // Find the medical record
    $medicalRecord = MedicalRecord::findOrFail($medical_record_id);

    // Check if a medical result already exists for this medical record
    if ($medicalRecord->medicalResult) {
        return redirect()->route('medical_records.view_result', $medicalRecord->id)
            ->with('error', 'A medical result already exists for this medical record.');
    }

    // Create the medical result
    $medicalResult = new MedicalResult();
    $medicalResult->medical_record_id = $medicalRecord->id;
    $medicalResult->doctor_id = $request->doctor_id; // Set the doctor_id from the request
    $medicalResult->result = $request->result;
    $medicalResult->prescription = $request->prescription;
    $medicalResult->advice = $request->advice;
    $medicalResult->save();

    return redirect()->route('medical_records.view_result', $medicalRecord->id)
        ->with('success', 'Medical result added successfully.');
    }

//displaying the results
    public function showResult($id)
    {
        $user = auth()->user();

        $medicalRecord = MedicalRecord::findOrFail($id);
        
        $medicalRecord->load('medicalResults');
        return view('medical_records.view_result', compact('medicalRecord','user'));
    }
}
