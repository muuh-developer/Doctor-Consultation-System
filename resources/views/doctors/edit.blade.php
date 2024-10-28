@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')

<h1>Edit Doctor</h1>

<form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $doctor->name }}" required>
    </div>
    <div class="mb-3">
        <label for="specialization" class="form-label">Specialization</label>
        <input type="text" class="form-control" id="specialization" name="specialization" value="{{ $doctor->specialization }}" required>
    </div>
    <div class="mb-3">
        <label for="contact_info" class="form-label">Contact Info</label>
        <input type="text" class="form-control" id="contact_info" name="contact_info" value="{{ $doctor->contact_info }}" required>
    </div>
    <div class="mb-3">
        <label for="availability" class="form-label">Availability</label>
        <input type="text" class="form-control" id="availability" name="availability" value="{{ $doctor->availability }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

@include('layouts/templates/footer')
@include('layouts/templates/scripts')
