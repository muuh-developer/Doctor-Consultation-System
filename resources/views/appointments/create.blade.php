<!-- resources/views/appointments/create.blade.php -->

@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')

<div class="container mt-4 d-flex justify-content-center">
    <div class="card" style="width: 50%;">
        <div class="card-body">
            <h3 class="card-title text-center">Create Appointment</h3>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- appointment error -->
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="patient_id" class="form-label">Patient</label>
                    <select class="form-select" id="patient_id" name="patient_id" required>
                        <option value=""selected disabled>select patient...</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="doctor_id" class="form-label">Doctor</label>
                    <select class="form-select" id="doctor_id" name="doctor_id" required>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                    </select>
                </div>
         

                <div class="mb-3">
                    <label for="appointment_datetime" class="form-label">Appointment Date</label>
                    <input type="date" class="form-control" id="appointment_datetime" name="appointment_datetime" required>
                </div>

                <div class="mb-3">
                    <label for="appointment_time" class="form-label">Appointment Time</label>
                    <input type="time" class="form-control" id="appointment_time" name="appointment_time" required>
                </div>
                        <!-- specialization -->
        <div class="form-group">
        <label for="specialization_id">Specialization</label>
        <select class="form-control" id="specialization_id" name="specialization_id">
        <option value="" disabled selected>select specialization...</option>

            @foreach($specializations as $specialization)
                <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
            @endforeach
        </select>
    </div> 
                @if($usertype != 1)
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="" disabled selected>Choose status...</option>
                        <option value="scheduled">Scheduled</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                @endif
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-secondary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts/templates/footer')
@include('layouts/templates/scripts')
