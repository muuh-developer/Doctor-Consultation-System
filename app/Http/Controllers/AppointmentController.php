<?php

namespace App\Http\Controllers;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Specialization;
use App\Models\Specialist;
use App\Models\MedicalRecord;
use Carbon\Carbon;
use App\Notifications\AppointmentReminder;
use App\Notifications\AppointmentCreated;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentEmail;
use Illuminate\Http\Request;
use App\Models\Notification;

class AppointmentController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = auth()->user();
        
        // Check if the user is a specialist
        if ($user->usertype === 2) {
            // Get the specialist record for the authenticated user
            $specialist = Specialist::where('user_id', $user->id)->first();

            // Check if the specialist exists and has a specialization
            if ($specialist && $specialist->specialization_id) {
                // Get appointments related to the specialist's specialization
                $appointments = Appointment::with(['patient', 'doctor'])
                    ->where('specialization_id', $specialist->specialization_id)
                    ->get();
            } else {
                // If no specialization found, return an empty collection
                $appointments = collect();
            }
            } else {
                // If the user is not a specialist, return all appointments
                $appointments = Appointment::with(['patient', 'doctor'])->get();
            }

            // Get the usertype of the authenticated user
            $usertype = $user->usertype;
        return view('appointments.index', compact('appointments','usertype','user'));
    }
    public function showMedicalRecords($appointment_id)
{ 
    $user = auth()->user();

    $appointment = Appointment::findOrFail($appointment_id);
    $medicalRecords = MedicalRecord::where('patient_id', $appointment->patient_id)->get();

        // Log the medical records to debug
        \Log::info($medicalRecords);
    return view('appointments.medical_records', compact('appointment', 'medicalRecords','user'));
}

    public function create()
    {
        $user = auth()->user();

        $patients = Patient::all();
        $doctors = Doctor::all();
        $usertype = auth()->user()->usertype;
        $specializations = Specialization::all();
        return view('appointments.create', compact('patients','user', 'doctors','usertype','specializations'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Validate the request data
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_datetime' => ['required', 'date', function ($attribute, $value, $fail) {
                if (Carbon::parse($value)->isPast()) {
                    $fail('The appointment date cannot be in the past.');
                }
            }],
            'appointment_time' => 'required',
            'specialization_id' => 'required|exists:specializations,id',
        ]);
        // Check if the patient has a medical record
        $patientMedicalRecord = MedicalRecord::where('patient_id', $request->input('patient_id'))->first();

        if (!$patientMedicalRecord) {
            return redirect()->back()->with('error', 'Error "No medical records for this patient"!!.');
        }

        // Check if the appointment datetime already exists
        $existingAppointment = Appointment::where('doctor_id', $request->doctor_id)
        ->where('appointment_datetime', $request->appointment_datetime)
        ->first();

        if ($existingAppointment) {
            return redirect()->back()->with('error', 'The specialist is already booked for this day.');
        }
          // Check specialist availability
        $specialist = Specialist::where('specialization_id', $request->specialization_id)->first();

        if ($specialist) {
            $availability = json_decode($specialist->availability, true);
            $appointmentDay = Carbon::parse($request->appointment_datetime)->format('l');

            if (!is_array($availability) || !in_array($appointmentDay, $availability)) {
                return redirect()->back()->with('error', "The specialist is not available on $appointmentDay.");
            }
        } else {
            return redirect()->back()->with('error', 'Error: Specialist not found.');
        }

        // Set default status
        $status = $request->input('status', 'submitted..');

        // Create the appointment 
        $appointment = new Appointment([
            'patient_id' => $request->input('patient_id'),
            'doctor_id' => $request->input('doctor_id'),
            'appointment_datetime' => $request->input('appointment_datetime'),
            'status' => $status,
            'appointment_time' => $request->input('appointment_time'),
            'specialization_id' => $request->input('specialization_id'),
        ]);

        // Save the appointment
        $appointment->save();
 
           // Create notification
           $specialist = Specialist::where('specialization_id', $request->specialization_id)->first();
            if ($specialist) {
            Notification::create([
                'doctor_id' => $request->doctor_id,
                'specialist_id' => $specialist->id,
                'appointment_id' => $appointment->id,
                'message' => 'New appointment created.',
            ]);
        }
        // Redirect with success message
        return redirect()->route('appointments.index')->with('success', 'Appointment created and notifications sent');
    }

    public function edit(Appointment $appointment)
    {
        $user = auth()->user();

        $usertype =auth()->user()->usertype;
        $patients = Patient::all();
        $medicalRecord = MedicalRecord::all();
        $doctors = Doctor::all();

         // Check if user is not of type 3 (assuming 3 is the admin type)
        if ($usertype == 3) {
            return redirect()->route('appointments.index')->with('error', 'Error!You are not authorized to edit appointments.');
        }
        return view('appointments.edit', compact('appointment','user','usertype','patients','medicalRecord','doctors'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $user = auth()->user();

         // Check if user is not of type 3 (assuming 3 is the admin type)
        if (auth()->user()->usertype == 3) {
            return redirect()->route('appointments.index')->with('error', 'Error!You are not authorized to update appointments.');
        }
        $appointment->update([
            'patient_id' => $request->input('patient_id'),
            'doctor_id' => $request->input('doctor_id'),
            'appointment_datetime' => $request->input('appointment_datetime'),
            'status' => $request->input('status'),
            'appointment_time' => $request->input('appointment_time'),
        ]);
        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully');
    }

    public function show(Appointment $appointment)
{
    $user = auth()->user();

    return view('appointments.show', compact('appointment'));
}


    public function destroy(Appointment $appointment)
    {
        $user = auth()->user();

         // Check if user is not of type 3 (assuming 3 is the admin type)
        if (auth()->user()->usertype == 3) {
            return redirect()->route('appointments.index')->with('error', 'Error!You are not authorized to Delete appointments.');
        }
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully');
    }

    //change status 
    public function updateStatus(Request $request, $id)
    {
        // Find the appointment
        $appointment = Appointment::findOrFail($id);
    
        // Check if the user has permission to update status
        if (auth()->user()->usertype === 2) {
            if ($appointment->status_changed_by) {
                return redirect()->route('appointments.index')->with('error', 'Error!!Appointment status changed only once.');
            }
            $request->validate([
                'status' => 'required|in:scheduled,cancelled,completed',
            ]); 
            $appointment->status = $request->input('status');
            $appointment->status_changed_by = auth()->user()->id; // Track who changed the status
            $appointment->status_changed_at = now(); // Track when the status was changed
            $appointment->save();
            return redirect()->route('appointments.index')->with('success', 'Appointment status updated successfully.');
        } else {
            return redirect()->back()->with('error', 'You do not have permission to update the appointment status.');
        }
    }
    
public function getSpecialists(Request $request)
{
    $specializationId = $request->query('specialization_id');
    $specialists = Specialist::where('specialization_id', $specializationId)->get();
    return response()->json($specialists);
}
public function search(Request $request)
    {
        $user = auth()->user();

        dd($request->all());
        $specializations = Specialization::all();
        $appointments = [];

        if ($request->has('specialization_id')) {
            $appointments = Appointment::where('specialization_id', $request->specialization_id)
                ->where('status', 'available')
                ->with('doctor', 'specialization')
                ->get();
                dd($appointments);
        }

        return view('appointments.search', compact('specializations','user', 'appointments'))->with('appointments', $appointments);

    }

    //email functionality
    public function sendAppointmentEmail(){
        $toEmail = 'raphaelkirodi@gmail.com';
        $message = 'This is appointment email';
        $subject = 'Appointment email using Gmail';

        $response = Mail::to($toEmail)->send(new AppointmentEmail($message, $subject));

        dd($response);
    }
}
