<!-- resources/views/users/profile.blade.php -->
@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body>
<div class="container mt-4">
    <div class="card w-50 mx-auto">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">User Profile</h3>
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="profile_image" class="form-label">Profile Image</label>
                    <input type="file" name="profile_image" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                </div>               
                <button type="submit" class="btn btn-primary w-100">Update Profile</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
@include('layouts/templates/footer')
@include('layouts/templates/scripts')
