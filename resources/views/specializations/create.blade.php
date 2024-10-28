<!DOCTYPE html>
<html>
<head>
    <title>Create Specialization</title>
    <!-- Add your Bootstrap CSS link here -->
</head>
<body>
    @include('layouts/templates/header')
    @include('layouts/templates/sidebar')
    @include('layouts/templates/navbar')

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card w-50">
            <div class="card-body">
                <h5 class="card-title text-center">Create Specialization</h5>
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
                <form action="{{ route('specializations.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-secondary w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>

    @include('layouts/templates/footer')
    @include('layouts/templates/scripts')
</body>
</html>
