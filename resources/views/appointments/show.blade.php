<!-- resources/views/appointments/show.blade.php -->

@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')

<div class="container">
    <h1>Appointment Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Appointment Information</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Patient:</strong> {{ $appointment->patient->name }}</li>
                <li class="list-group-item"><strong>Doctor:</strong> {{ $appointment->doctor->name }}</li>
                <li class="list-group-item"><strong>Appointment Date:</strong> {{ $appointment->appointment_datetime }}</li>
                <li class="list-group-item"><strong>Appointment Time:</strong> {{ $appointment->appointment_time }}</li>
                <li class="list-group-item"><strong>Status:</strong> {{ $appointment->status }}</li>
            </ul>
        </div>
    </div>
    <a href="{{ route('appointments.index') }}" class="btn btn-primary mt-3">Back</a>
</div>

@include('layouts/templates/footer')
@include('layouts/templates/scripts')
