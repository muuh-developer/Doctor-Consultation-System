@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')

<h1>Doctor Details</h1>

<ul>
    <li><strong>Name:</strong> {{ $doctor->name }}</li>
    <li><strong>Specialization:</strong> {{ $doctor->specialization }}</li>
    <li><strong>Contact Info:</strong> {{ $doctor->contact_info }}</li>
    <li><strong>Availability:</strong> {{ $doctor->availability }}</li>
</ul>

<a href="{{ route('doctors.index') }}" class="btn btn-primary">Back</a>

@include('layouts/templates/footer')
@include('layouts/templates/scripts')
