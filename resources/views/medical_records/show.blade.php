@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')
<div class="container">
    <h1>Medical Record Details</h1>
    <ul>
        <li><strong>Patient:</strong> {{ $medicalRecord->patient->name }}</li>
        <li><strong>Doctor:</strong> {{ $medicalRecord->doctor->name }}</li>
        <li><strong>Date and Time:</strong> {{ $medicalRecord->record_datetime }}</li>
        <li><strong>Description:</strong> {{ $medicalRecord->description }}</li>
        <li><strong>Prescription:</strong> {{ $medicalRecord->prescription }}</li>
    </ul>
    <a href="{{ route('medical_records.index') }}" class="btn btn-primary">Back</a>
</div>
@include('layouts/templates/footer')
@include('layouts/templates/scripts')