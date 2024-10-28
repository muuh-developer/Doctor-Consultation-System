@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <h2 class="text-center">Edit Medical Record</h2>
            <form action="{{ route('medical_records.update', $medicalRecord->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- patient field -->
                <div class="mb-3">
                    <label for="doctor_name" class="form-label">Patient</label>
                    <input type="text" class="form-control" id="doctor_name" name="patient_id" value="{{ $medicalRecord->patient->name }}" readonly>
                    <input type="hidden" name="patient_id" value="{{ $medicalRecord->patient_id }}">
                </div>
                <!-- doctor field -->
                <div class="mb-3">
                    <label for="doctor_name" class="form-label">Patient</label>
                    <input type="text" class="form-control" id="doctor_name" name="doctor_id" value="{{ $medicalRecord->doctor->name }}" readonly>
                    <input type="hidden" name="doctor_id" value="{{ $medicalRecord->doctor_id }}">
                </div>
                <!-- date field -->
                <div class="mb-3">
                    <label for="record_datetime" class="form-label">Date and Time</label>
                    <input type="datetime-local" class="form-control" id="record_datetime" name="record_datetime" value="{{ $medicalRecord->record_datetime->format('Y-m-d\TH:i') }}" required readonly>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="1" required>{{ $medicalRecord->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="prescription" class="form-label">Symptoms</label>
                    <textarea class="form-control" id="Symptoms" name="symptoms" rows="1" required>{{ $medicalRecord->prescription }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="prescription" class="form-label">Prescription</label>
                    <textarea class="form-control" id="prescription" name="prescription" rows="1" required>{{ $medicalRecord->prescription }}</textarea>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('layouts/templates/footer')
@include('layouts/templates/scripts')
