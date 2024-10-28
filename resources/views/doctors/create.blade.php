@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
        <div class="card-body">
            <h2 class="card-title text-center">Add Details</h2>
            <!-- Error Messages -->
            @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
            <form action="{{ route('doctors.store') }}" method="POST">
                @csrf
                <div class="mb-3">
            <label for="name" class="form-label">Name <i class="fas fa-user"></i></label>
            <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" readonly required>
            </div>
   
            <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="">Select Gender...</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    
            <div class="mb-3">
                <label for="specialization" class="form-label">Specialization</label>
                <select class="form-select" id="specialization" name="specialization" required>
                    <option value="">Select Specialization...</option>
                    @foreach($specializations as $specialization)
                        <option value="{{ $specialization->name }}">{{ $specialization->name }}</option>
                    @endforeach
                </select>
            </div>
                <div class="mb-3">
                    <label for="contact_info" class="form-label">Contact Info</label>
                    <input type="text" class="form-control" id="contact_info" name="contact_info" required>
                </div>
                <!-- <div class="mb-3">
                    <label for="availability" class="form-label">Availability</label>
                    <input type="text" class="form-control" id="availability" name="availability" required>
                </div> -->
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
