<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Specialist;
use App\Models\Notification;
use App\Models\User;
use App\Models\Specialization;
use App\Models\MedicalRecord;



class DashboardController extends Controller
{
    public function index()
    {
        $usertype = auth()->user()->usertype;
        $user = auth()->user();
        
        $doctorCount = Doctor::count();
        $patientCount = Patient::count();
        $appointmentCount = Appointment::count();
        $specialistCount = Specialist::count();
        $appointments = Patient::all(); // Example: Fetch all patients
        $specialists = Specialist::all(); // Example: Fetch all patients
        $notifications = Notification::all();
        $specializations = Specialization::all();
        $medicalRecords = MedicalRecord::all();


        return view('user.dashboard', compact('specialistCount','doctorCount',
         'patientCount', 'appointmentCount',
         'usertype','appointments','specialists',
         'notifications','user','specializations','medicalRecords'));
    }
}
