@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body> 
<div class="container full-height d-flex justify-content-center align-items-center mt-4">
    <div class="card w-50">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">User Profile</h3>
            <div class="text-center mb-4">
                @if ($user->profile_image)
                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Picture" class="rounded-circle" width="150" height="150">
                @else
                    <img src="{{ asset('assets/auth/assets/img/icon.webp') }}" alt="Default Profile Picture" class="rounded-circle" width="150" height="100">
                @endif
            </div>
            <div class= "text-center">
             <button class= "btn btn-secondary" onclick="window.location='{{ route('user.edit', $user->id) }}'">Update profile</button>
            </div> 
            <div class="row mb-2">
                <div class="col-md-4 text-right">
                    <p class="card-text"><strong>Name:</strong></p>
                </div>
                <div class="col-md-8">
                    <p class="card-text">{{ $user->name }}</p>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-right">
                    <p class="card-text"><strong>Email:</strong></p>
                </div>
                <div class="col-md-8">
                    <p class="card-text">{{ $user->email }}</p>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-right">
                    <p class="card-text"><strong>Role:</strong></p>
                </div>
                <div class="col-md-8">
                    <p class="card-text">{{ $user->role }}</p>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-right">
                    <p class="card-text"><strong>Created At:</strong></p>
                </div>
                <div class="col-md-8">
                    <p class="card-text">{{ $user->created_at->format('d M Y') }}</p>
                </div>
            </div>
            <!-- Add more fields as needed -->
        </div>
    </div>
</div>
</body>
</html>
@include('layouts/templates/footer')
@include('layouts/templates/scripts')
