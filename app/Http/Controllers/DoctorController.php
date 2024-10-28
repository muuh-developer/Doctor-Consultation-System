<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Specialization;
use App\Models\MedicalResult;
use App\Models\User;


class DoctorController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $usertype = auth()->user()->usertype;
        $authenticatedUser = auth()->user();

        if ($usertype == 3) {
            // User type 3 can see all doctors
            $doctors = Doctor::all();
        } else {
            // For other user types, show only their own details
            $doctors = Doctor::where('name', $authenticatedUser->name)->get();
        }

        return view('doctors.index', compact('doctors', 'usertype','authenticatedUser','user'));
    }
    public function create()
    {
        $user = auth()->user();
        $specializations = Specialization::all();
        return view('doctors.create', compact('specializations','user'));
    }

    public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'gender' => 'required|string|max:255',
        'specialization' => 'required|string|max:255',
        'contact_info' => ['required', 'regex:/^(07|06)\d{8}$/'],
        // 'availability' => 'required|string|max:255',
    ]);
 
    // Check if a doctor with the same name already exists
    $existingDoctor = Doctor::where('name', $request->name)->first();

    if ($existingDoctor) {
        // Redirect back with an error message
        return redirect()->back()->withErrors(['error' => 'The records for this Doctor already exists.']);
    }

    // Create a new doctor
    Doctor::create($request->all());

    return redirect()->route('doctors.index')->with('success', 'Doctor records created successfully.');
}

    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctors.show', compact('doctor'));
    }

    public function edit($id)
{
    $usertype = auth()->user()->usertype;
    $specializations = Specialization::all(); // Fetch all specializations

    if ($usertype == 3) {
        return redirect()->route('doctors.index')->with('error', 'Error! You are not authorized to edit Doctor details.');
    }

    $doctor = Doctor::findOrFail($id);
    return view('doctors.edit', compact('doctor', 'specializations'));
}


    public function update(Request $request, $id)
    {
        
        $usertype = auth()->user()->usertype;
        if ($usertype == 3) {
            return redirect()->route('doctors.index')->with('error', 'Error!You are not authorized to edit Doctor details.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'contact_info' => ['required', 'regex:/^(07|06)\d{8}$/'],
            // 'availability' => 'required|string|max:255',
        ]);
        $doctor = Doctor::findOrFail($id);
        $doctor->update($request->all());
        return redirect()->route('doctors.index')->with('success', 'Doctor records updated successfully.');
    }

    public function destroy($id)
    {
        $usertype = auth()->user()->usertype;
        if ($usertype == 3) {
            return redirect()->route('doctors.index')->with('error', 'Error!You are not authorized to delete Doctor details.');
        }
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor records deleted successfully.');
    }
}
