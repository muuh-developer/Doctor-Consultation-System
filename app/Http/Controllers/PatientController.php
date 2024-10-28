<?php

namespace App\Http\Controllers;
use App\Models\Patient;
use App\Models\MedicalRecord;
use Illuminate\Validation\Rule;
use App\Models\User;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
{
    $user = auth()->user();

    $usertype = auth()->user()->usertype;
    $authenticatedUser = auth()->user();

    if ($usertype == 3) {
        // User type 3 can see all patients
        $patients = Patient::all();
    }    
    elseif($usertype == 1){
        $patients = Patient::all();
    }
    else {
        // For other user types, show only their own details
        $patients = Patient::where('name', $authenticatedUser->name)
                        ->with('medicalRecords')
                        ->get();
    }

    return view('patients.index', compact('patients', 'usertype','authenticatedUser','user'));
}



    public function create()
    {
        $user = auth()->user();

        return view('patients.create',compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('patients')->where(function ($query) use ($request) {
                    return $query->where('name', $request->name);
                }),
            ],
            'date_of_birth' => 'required|date|before_or_equal:today',
            'gender' => 'required|in:Male,Female,Other',
            'contact_info' => ['required', 'regex:/^(07|06)\d{8}$/'],
            'address' => 'nullable|string|max:255',
        ]);
        Patient::create($request->all());
        return redirect()->route('patients.index')->with('success', 'Patient created successfully.');
    }

    public function show(Patient $patient)
    {
        $user = auth()->user();

        return view('patients.show', compact('patient','user'));
    }

    public function edit(Patient $patient)
    {
        $user = auth()->user();

        $usertype = auth()->user()->usertype;
        if ($usertype == 3) {
            return redirect()->route('patients.index')->with('error', 'Error!You are not authorized to edit patient details.');
        }
        return view('patients.edit', compact('patient','usertype','user'));
    }

    public function update(Request $request, Patient $patient)
    {
        $usertype = auth()->user()->usertype;
        if ($usertype == 3) {
            return redirect()->route('appointments.index')->with('error', 'Error!You are not authorized to edit appointments.');
        }
        $request->validate([
            
            'date_of_birth' => 'required|date|before_or_equal:today',
            'gender' => 'required|string|in:Male,Female,Other',
            'contact_info' => ['required', 'regex:/^(07|06)\d{8}$/'],
            'address' => 'nullable|string|max:255',
        ]);
        $patient->update($request->all());
        return redirect()->route('patients.index')->with('success', 'Patient records updated successfully.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient records deleted successfully.');
    }

    
    public function showMedicalRecords(Patient $patient)
    {
        $user = auth()->user();

    $medicalRecords = $patient->medicalRecords;
    return view('patients.medicalrecords', compact('patient','medicalRecords','user'));
    }

}
