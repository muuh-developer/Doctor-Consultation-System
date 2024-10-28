@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')

<div class="container d-flex justify-content-center mt-4">
<div class="col-md-8">

    <div class="card card-body">
        <div class="card-header text-center">
            <h3>Edit Appointment</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-2">
                    <label for="patient_name" class="form-label">Patient</label>
                    <input type="text" class="form-control" id="patient_name" name="patient_name" value="{{ $appointment->patient->name }}" readonly>
                    <input type="hidden" name="patient_id" value="{{ $appointment->patient_id }}">
                </div>

                <div class="mb-2">
                    <label for="doctor_name" class="form-label">Doctor</label>
                    <input type="text" class="form-control" id="doctor_name" name="doctor_name" value="{{ $appointment->doctor->name }}" readonly>
                    <input type="hidden" name="doctor_id" value="{{ $appointment->doctor_id }}">
                </div>

                <div class="mb-2">
                    <label for="appointment_datetime" class="form-label">Appointment Date</label>
                    <input type="date" class="form-control" id="appointment_datetime" name="appointment_datetime" value="{{ $appointment->appointment_datetime }}" required>
                </div>

                <div class="mb-2">
                    <label for="appointment_datetime" class="form-label">Appointment Time</label>
                    <input type="time" class="form-control" id="appointment_datetime" name="appointment_time" value="{{ $appointment->appointment_datetime }}" required>
                </div>

                    <input hidden type="text" class="form-control" id="status" name="status" value="{{ $appointment->status }}" readonly required>
                <button type="submit" class="btn btn-primary d-block w-100">Update</button>
            </form>
        </div>
    </div>
</div>
</div>
@include('layouts/templates/footer')
@include('layouts/templates/scripts')
