<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\MedicalResult;
use PDF;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class MedicalResultController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $user = auth()->user();
        $usertype =auth()->user()->usertype;
    
        $medicalResults = MedicalResult::all();
        return view('medical_results.index', compact('medicalResults','user','usertype'));
    }

    // Show the form for creating a new resource
    public function create(Request $request)
    {
        $user = auth()->user();
        $medicalrecord_id = $request->query('medicalrecord_id');
        $medicalRecord = MedicalRecord::findOrFail($medicalrecord_id);
        return view('medical_results.create', compact('medicalRecord','medicalrecord_id','user'));
    }

     // Store a newly created resource in storage
     public function store(Request $request)
     {
         $request->validate([
             'doctor_id' => 'required|exists:doctors,id',
             'medicalrecord_id' => 'required|exists:medical_records,id',
             'result' => 'required|string',
             'prescription' => 'required|string',
             'advice' => 'required|string',
         ]);
 
         MedicalResult::create($request->all());
 
         return redirect()->route('medical_results.index')
             ->with('success', 'Medical Result created successfully.');
    }

    // Display the specified resource
    public function show(MedicalResult $medicalResult)
    {
        $user = auth()->user();
        return view('medical_results.show', compact('medicalResult','user'));
    }

     // Show the form for editing the specified resource
     public function edit(MedicalResult $medicalResult)
     {
        $user = auth()->user();
        return view('medical_results.edit', compact('medicalResult','user'));
     }

    // Update the specified resource in storage
    public function update(Request $request, MedicalResult $medicalResult)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'medicalrecord_id' => 'required|exists:medical_records,id',
            'result' => 'required|string',
            'prescription' => 'required|string',
            'advice' => 'required|string',
        ]);

        $medicalResult->update($request->all());

        return redirect()->route('medical_results.index')
            ->with('success', 'Medical Result updated successfully.');
    }

        public function destroy($id)
        {
            $medicalResults = MedicalResult::findOrFail($id);
            $medicalResults->delete();

            // Redirect back or to a different route after deletion
            return redirect()->route('medical_results.showPatientResults')->with('success', 'Medical result deleted successfully.');
        }

    //patients view results
    public function showPatientResults()
    {
        $user = auth()->user();
        $patientId = Auth::user()->id; 

        // Get medical records for the authenticated patient
        // $medicalRecords = MedicalRecord::where('patient_id', $patientId)->with('medicalResults.doctor')->get();
        $medicalRecords = MedicalRecord::where('patient_id', $patientId) ->with('medicalResults.doctor') ->get();

        return view('medical_results.show_patient_results', compact('medicalRecords','user'));
    }

    public function downloadPdf($medicalRecordId)
    {
        // ini_set('max_execution_time', 120);
        $medicalRecord = MedicalRecord::with('medicalResults.doctor', 'patient')
            ->findOrFail($medicalRecordId);

        $pdf = PDF::loadView('medical_results.pdf', compact('medicalRecord'));

        return $pdf->download('medical_result_' . $medicalRecordId . '.pdf');
    }

}
