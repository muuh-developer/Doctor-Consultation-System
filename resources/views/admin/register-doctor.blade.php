@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Register Doctor & Specialists</h3>

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

                    <form method="POST" action="{{ route('admin.register.submit') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user"></i> Name
                                </label>
                                <div class="input-group">
                                    <input type="text" name="name" class="form-control form-control-lg" required placeholder="Enter valid name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i> Email
                                </label>
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control form-control-lg" required placeholder="eg example@gmail.com">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock"></i> Password
                                </label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control form-control-lg" required placeholder="Type password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">
                                    <i class="fas fa-lock"></i> Confirm Password
                                </label>
                                <div class="input-group">
                                    <input type="password" name="password_confirmation" class="form-control form-control-lg" required placeholder="Re-write password">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="usertype" class="form-label">
                                    <i class="fas fa-users"></i> User Type
                                </label>
                                <div class="input-group">
                                    <select name="usertype" class="form-control form-control-lg" required>
                                        <option value="" disabled selected>Please select user type...</option>
                                        <option value="1">Doctor</option>
                                        <option value="2">Specialist</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts/templates/footer')
@include('layouts/templates/scripts')
