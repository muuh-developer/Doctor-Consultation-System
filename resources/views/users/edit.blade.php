@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')

<div class="container mt-4">
    <div class="card w-50 mx-auto">
        <div class="card-body">
            <h1 class="card-title text-center mb-4">Edit User Profile</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="profile_image" class="form-label">Profile Image</label>
                    <input type="file" name="profile_image" class="form-control">
                </div>

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
                </div>

                <!-- Add more fields as needed -->

                <button type="submit" class="btn btn-secondary w-100">Update Profile</button>
            </form>
        </div>
    </div>
</div>

@include('layouts/templates/footer')
@include('layouts/templates/scripts')
