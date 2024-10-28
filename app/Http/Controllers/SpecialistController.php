<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialist;
use App\Models\Specialization; 
use App\Models\User;

 
class SpecialistController extends Controller
{
    public function index()
    { 
        $user = auth()->user();

        $specialists = Specialist::all();
        $specializations = Specialization::all();
        $usertype = auth()->user()->usertype;
        return view('specialists.index', compact('specialists','specializations','usertype','user'));
    }
    
    public function create()
    {
        $user = auth()->user();

        $specializations= Specialization::all();
        return view('specialists.create',compact('specializations','user'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:specialists,name',
        'contact_info' => ['required', 'regex:/^(07|06)\d{8}$/'],
        'availability.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday', // Validate each day
        'specialization_id' => 'required|exists:specializations,id',
        'user_id' => 'required|exists:users,id',  // Validate user_id
    ]);

    // Retrieve the specialization name using the provided specialization ID
    $specialization = Specialization::findOrFail($request->specialization_id);

    // Create a new specialist with the provided data
    Specialist::create([
        'name' => $request->name,
        'contact_info' => $request->contact_info,
        'availability' => json_encode($request->input('availability')), // Encode to JSON
        'specialization_id' => $request->specialization_id,
        'specialization_name' => $specialization->name,
        'user_id' => $request->input('user_id'),  // Set user_id
    ]);

    return redirect()->route('specialists.index')->with('success', 'Specialist records created successfully');
}

 
    public function show()
    {
        // Eager load the specialization relationship
        $user = auth()->user();
        
        $specialist->load('specialization');
        $specialistData = [
            'name' => $specialist->name,
            // 'contact_info' => $specialist->contact_info,
            'availability' => json_decode($specialist->availability, true),
            'specialization' => $specialist->specialization->name,
        ];
        return view('specialists.show', compact('specialist','specialistData','user'));
    }

    public function edit(Specialist $specialist)
    {
        $user = auth()->user();
        
        return view('specialists.edit', compact('specialist','user'));
    }

    public function update(Request $request, Specialist $specialist)
    { 
        $request->validate([
            'name' => 'required|unique:specialists,name,' . $specialist->id,
            'contact_info' => ['required', 'regex:/^(07|06)\d{8}$/'],
            'availability.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'specialization_id' => 'required|exists:specializations,id',
        ]);
        $specialist->update([
            'name' => $request->name,
            'contact_info' => $request->contact_info,
            'availability' => json_encode($request->input('availability', json_decode($specialist->availability, true))),
            'specialization_id' => $request->specialization_id,
        ]);
        return redirect()->route('specialists.index')->with('success', 'Specialist records updated successfully');
    }

    public function destroy(Specialist $specialist)
    {
        $specialist->delete();
        return redirect()->route('specialists.index')->with('success', 'Specialist records deleted successfully');
    }
    
}
