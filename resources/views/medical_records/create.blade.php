@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body">
            <h2 class="text-center">Create Medical Record</h2>
            <form action="{{ route('medical_records.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="patient_id" class="form-label">Patient</label>
                    <select class="form-select" id="patient_id" name="patient_id" required>
                        <option value="" disabled selected>select patient...</option>
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
                <!-- <div class="mb-3">
                    <label for="doctor_name" class="form-label">Doctor</label>
                    <input type="text" class="form-control" id="doctor_name" name="doctor_id" value="{{ auth()->user()->name }}" readonly>
                    <input type="hidden" name="doctor_id" value="{{ auth()->user()->id }}">
                </div> -->

                <div class="mb-3">
                    <label for="record_datetime" class="form-label">Date and Time</label>
                    <input type="datetime" class="form-control" id="record_datetime" name="record_datetime" readonly required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="1" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="symptoms" class="form-label">Symptoms</label>
                    <textarea class="form-control" id="symptoms" name="symptoms" rows="1" required></textarea>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-secondary">Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@include('layouts/templates/footer')
@include('layouts/templates/scripts')
