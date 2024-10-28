@include('layouts.templates.header')
@include('layouts.templates.sidebar')
@include('layouts.templates.navbar')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <!-- <li class="breadcrumb-item active">Dashboard</li> -->
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body bg-primary text-white text-center">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <i class="fas fa-user-md fa-2x"></i>
                        <h5 class="mb-0">Doctors</h5>
                    </div>
                    <div class="display-4"></div>               
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body bg-warning text-white text-center">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <i class="fas fa-user-injured fa-2x"></i>
                        <h5 class="mb-0">Patients</h5>
                    </div>
                    <div class="display-4"></div>
                    
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body bg-success text-white text-center">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <i class="fas fa-calendar-check fa-2x"></i>
                        <h5 class="mb-0">Appointments</h5>
                    </div>
                    <div class="display-4"></div>
                    
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body bg-danger text-white text-center">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                        <h5 class="mb-0">Specialization</h5>
                    </div>
                    <div class="display-4"></div>
                    
                </div>
            </div>
        </div>
    </div>
</div>


    @include('layouts.templates.footer')

@include('layouts.templates.scripts')
