<!-- resources/views/patients/edit.blade.php -->
@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')

<div class="container d-flex justify-content-center">
    <div class="col-md-6">
        <div class="card mt-5">
            <div class="card-header text-center">
                <h3>Edit Patient Information</h3>
            </div>
            <div class="card-body">
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
                <form action="{{ route('patients.update', $patient->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $patient->name }}" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $patient->date_of_birth }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="Male" {{ $patient->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $patient->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ $patient->gender == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="contact_info" class="form-label">Contact</label>
                        <input type="tel" class="form-control" id="contact_info" name="contact_info" value="{{ $patient->contact_info }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="{{ $patient->address }}">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-3">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('layouts/templates/footer')
@include('layouts/templates/scripts')
