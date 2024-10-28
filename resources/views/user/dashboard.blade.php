@include('layouts/templates/header')
@include('layouts/templates/sidebar')
@include('layouts/templates/navbar')

<div class="container-fluid px-4">
    <ol class="breadcrumb mt-4">
        <h1><li class="breadcrumb-item active">Dashboard</li></h1>
    </ol>
    @if($usertype == 3)
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('patients.index') }}" class="text-decoration-none">

            <div class="card border-0 shadow-sm">
                <div class="card-body bg-primary text-white text-center">
                    <div class="card-title d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-user fa-7x"></i>
                    </div>
                    <h5 class="mb-0">Patient Info</h5>
                </div>
            </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('specialists.index') }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm">
                <div class="card-body bg-warning text-white text-center">
                    <div class="card-title d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-user-injured fa-7x"></i>
                    </div>
                    <h5 class="mb-0">Specialist Info</h5>
                </div>
            </div>
        </a>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('appointments.index') }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm">
                <div class="card-body bg-success text-white text-center">
                    <div class="card-title d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-calendar-check fa-7x"></i>
                    </div>
                    <h5 class="mb-0">Appointment</h5>
                </div>
            </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('medical_records.index') }}" class="text-decoration-none">

            <div class="card border-0 shadow-sm">
                <div class="card-body bg-danger text-white text-center">
                    <div class="card-title d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-notes-medical fa-7x"></i>
                    </div>
                    <h5 class="mb-0">Med Records</h5>
                </div>
            </div>
        </div>
</a>
    </div>
    @elseif($usertype == 2)
     <!-- for specialist -->
     <div class="row">
     <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('appointments.index') }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm">
                <div class="card-body bg-success text-white text-center">
                    <div class="card-title d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-calendar-check fa-7x"></i>
                    </div>
                    <h5 class="mb-0">Appointment</h5>
                    <p class="mt-3">
                    <h1>{{ $appointments->count() }}</h1>
                </p>
                </div>
            </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('specialists.index') }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm">
                <div class="card-body bg-warning text-white text-center">
                    <div class="card-title d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-user-injured fa-7x"></i>
                    </div>
                    <h5 class="mb-0">Specialist Info</h5>
                    <p class="mt-3">
                    <h1>{{ $specialists->count() }}</h1>
                </p>
                </div>
            </div>
        </a>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('notifications.index') }}" class="text-decoration-none">

            <div class="card border-0 shadow-sm">
                <div class="card-body bg-danger text-white text-center">
                    <div class="card-title d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-notes-comment fa-7x"></i>
                    </div>
                    <h5 class="mb-0">Notification</h5>
                    <p class="mt-3">
                    <h1>{{ $notifications->count() }}</h1>
                </p>
                </div>
            </div>
        </div>
</a>
    </div>
    @elseif($usertype == 1)
     <!-- for specialist -->
     <div class="row">
     <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('appointments.index') }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm">
                <div class="card-body bg-success text-white text-center">
                    <div class="card-title d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-calendar-check fa-7x"></i>
                    </div>
                    <h5 class="mb-0">Appointment</h5>
                    <p class="mt-3">
                    <h1>{{ $appointments->count() }}</h1>
                </p>
                </div>
            </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('specializations.index') }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm">
                <div class="card-body bg-secondary text-white text-center">
                    <div class="card-title d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-briefcase-medical fa-7x"></i>
                    </div>
                    <h5 class="mb-0">Specialization</h5>
                    <p class="mt-3">
                    <h1>{{ $specializations->count() }}</h1>
                </p>
                </div>
            </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('doctors.index') }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm">
                <div class="card-body bg-warning text-white text-center">
                    <div class="card-title d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-user-injured fa-7x"></i>
                    </div>
                    <h5 class="mb-0">Doctor Info</h5>
                    <p class="mt-3">
                    <h1>{{ $specialists->count() }}</h1>
                </p>
                </div>
            </div>
        </a>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('medical_records.index') }}" class="text-decoration-none">

            <div class="card border-0 shadow-sm">
                <div class="card-body bg-danger text-white text-center">
                    <div class="card-title d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-file-medical fa-7x"></i>
                    </div>
                    <h5 class="mb-0">Medical Records</h5>
                    <p class="mt-3">
                    <h1>{{ $medicalRecords->count() }}</h1>
                </p>
                </div>
            </div>
        </div>
</a>
    </div>
    @else
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('patients.index') }}" class="text-decoration-none">

            <div class="card border-0 shadow-sm">
                <div class="card-body bg-primary text-white text-center">
                    <div class="card-title d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-user fa-7x"></i>
                    </div>
                    <h5 class="mb-0">Patient Info</h5>
                </div>
            </div>
            </a>
        </div>
         @endif
</div>


@include('layouts/templates/footer')
@include('layouts/templates/scripts')
