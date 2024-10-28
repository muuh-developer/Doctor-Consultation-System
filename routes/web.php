<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\MedicalResultController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('login');

});
  
Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware([\App\Http\Middleware\NoCacheMiddleware::class])->group(function () {
    // Routes that need to disable caching

    // Patients
    Route::resource('patients', PatientController::class);
    Route::get('/patients/{patient}/medical-records', [PatientController::class, 'showMedicalRecords'])->name('patients.medicalRecords');

    // Doctors
    Route::resource('doctors', DoctorController::class);

    // Specialists
    Route::resource('specialists', SpecialistController::class);
    
    // Medical Records
    Route::resource('medical_records', MedicalRecordController::class);

    // Appointments
    Route::resource('appointments', AppointmentController::class);
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::put('/appointments/{id}/update-status', [AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');
    Route::get('appointments/{appointment}/medical-records', [AppointmentController::class, 'showMedicalRecords'])->name('appointments.showMedicalRecords');
    Route::get('appointments/{id}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
    Route::get('appointments/{id}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::get('appointments/search', [AppointmentController::class, 'search'])->name('appointments.search');
    // Route::get('send-mail', [AppointmentController::class, 'sendAppointmentEmail']);

    // Custom dashboard route
    Route::get('/custom-dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('custom.dashboard');
    
    //profile route
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show')->middleware('auth');
    Route::put('user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::get('user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');


    // Specializations
    Route::resource('specializations', SpecializationController::class);

    // Register Doctor
    Route::get('/register-doctor', [AdminController::class, 'showRegisterDoctorForm'])->name('admin.register.doctor');
    Route::post('/register-doctor-submit', [AdminController::class, 'registerDoctor'])->name('admin.register.doctor.submit');

    // Register Specialist
    Route::get('/register-specialist', [AdminController::class, 'showRegisterSpecialistForm'])->name('admin.register.specialist');
    Route::post('/register-specialist-submit', [AdminController::class, 'registerSpecialist'])->name('admin.register.specialist.submit');
    
    
}); 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //medical result
    Route::get('medical_records/{id}/add-result', [MedicalRecordController::class, 'addResult'])->name('medical_records.addResult');
    Route::post('medical_records/{id}/store_medical_result', [MedicalRecordController::class, 'storeMedicalResult'])->name('medical_records.storeMedicalResult');
    Route::get('medical_records/{id}/show-result', [MedicalRecordController::class, 'showResult'])->name('medical_records.showResult');
    Route::get('/medical-results', [MedicalResultController::class, 'showPatientResults'])->name('medical_results.showPatientResults');
    Route::delete('/medical-results/{id}', [MedicalResultController::class, 'destroy'])->name('medical-results.destroy');

    Route::get('medical_records/{id}/view_result', [MedicalRecordController::class, 'showResult'])->name('medical_records.view_result');
    Route::post('/medical_records/{medical_record_id}/store-result', [MedicalRecordController::class, 'storeMedicalResult'])
    ->name('medical_records.storeResult');

    Route::get('/medical-results', [MedicalResultController::class, 'index'])->name('medicalResults.index');
    Route::get('/medical-results/show-patient-results', [MedicalResultController::class, 'showPatientResults'])
    ->name('medical_results.showPatientResults');
    Route::get('/medical-results/download-pdf/{medicalRecordId}', [MedicalResultController::class, 'downloadPdf'])
    ->name('medical_results.downloadPdf');
    Route::delete('/medical-results/{id}',[MedicalResultController::class,'destroy'])->name('medical-results.destroy');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});

Route::middleware('disable_back_btn')->group(function () {
    // Define routes here that require the disable_back_btn middleware
});

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

require __DIR__.'/auth.php';

// Admin routes
Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
    Route::post('/login-submit', [AdminController::class, 'login_submit'])->name('admin_login_submit');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
    Route::get('/forget-password', [AdminController::class, 'forget_password'])->name('admin_forget_password');
    Route::post('/forget-password-submit', [AdminController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
    Route::get('/reset-password/{token}/{email}', [AdminController::class, 'reset_password'])->name('admin_reset_password');
    Route::post('/register', [AdminController::class, 'register'])->name('admin.register.submit');
});
