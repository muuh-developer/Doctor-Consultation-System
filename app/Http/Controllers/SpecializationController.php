<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use App\Models\User;

use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the specializations.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $specializations = Specialization::all();
        return view('specializations.index', compact('specializations','user'));
    }

    /**
     * Show the form for creating a new specialization.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        return view('specializations.create',compact('user'));
    }

    /**
     * Store a newly created specialization in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:specializations|max:255',
        ]);
        if (Specialization::where('name', $request->name)->exists()) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['name' => 'The specialization name already exists.']);
        }

        Specialization::create([ 
            'name' => $request->name,
        ]);

        return redirect()->route('specializations.index')
            ->with('success', 'Specialization created successfully.');
    }

    /**
     * Display the specified specialization.
     *
     * @param  \App\Models\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function show(Specialization $specialization)
    {
        $user = auth()->user();
        return view('specializations.show', compact('specialization','user'));
    }

    /**
     * Show the form for editing the specified specialization.
     *
     * @param  \App\Models\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialization $specialization)
    {
        $user = auth()->user();
        return view('specializations.edit', compact('specialization','user'));
    }

    /**
     * Update the specified specialization in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specialization $specialization)
    {
        $request->validate([
            'name' => 'required|unique:specializations|max:255',
        ]);

        $specialization->update([
            'name' => $request->name,
        ]);

        return redirect()->route('specializations.index')
            ->with('success', 'Specialization updated successfully.');
    }

    /**
     * Remove the specified specialization from storage.
     *
     * @param  \App\Models\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialization $specialization)
    {
        $specialization->delete();

        return redirect()->route('specializations.index')
            ->with('success', 'Specialization deleted successfully.');
    }
}
