<!-- resources/views/patients/show.blade.php -->
@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')
<h1>Patient Details</h1>
    <ul>
        <li><strong>Name:</strong> {{ $patient->name }}</li>
        <li><strong>Date of Birth:</strong> {{ $patient->date_of_birth }}</li>
        <li><strong>Gender:</strong> {{ $patient->gender }}</li>
        <li><strong>Contact Info:</strong> {{ $patient->contact_info }}</li>
        <li><strong>Address:</strong> {{ $patient->address }}</li>
        <li><strong>Medical History:</strong> {{ $patient->medical_history }}</li>
    </ul>
    <a href="{{ route('patients.index') }}" class="btn btn-primary">Back</a>

    @include('layouts/templates/footer')
@include('layouts/templates/scripts')