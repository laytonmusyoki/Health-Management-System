<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ClinicianController;
use App\Http\Controllers\DrugsController;
use App\Http\Controllers\HivController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\ProcedureRoomController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterFormController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\TriageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OnlineRegistrationController;
use App\Http\Controllers\WebController;

//online patients
Route::get('/user/patient',[PatientController::class,'index'])->name('user.patient');


// staff configurations

Route::group(['middleware' => ['auth','role']], function () {
    // super admin
    Route::get('/staff/admin',[StaffController::class,'index'])->name('staff.admin');

    Route::middleware(['permission'])->group(function () {
        Route::resource('admin/roles/delete', RolesController::class)->names('roles');
        Route::resource('admin/permissions', PermissionsController::class)->names('permissions');
        Route::delete('admin/roles/delete/{id}', [RolesController::class, 'destroy'])->name('roles.delete');
        Route::delete('admin/permissions/delete/{id}', [PermissionsController::class, 'destroy'])->name('permissions.delete');
        Route::resource('admin/users', UserController::class)->names('users');
        //receptionist
        Route::get('/find',[RegisterFormController::class,'find'])->name('find');
        Route::get('/registerQueue/{id}',[RegisterFormController::class,'registerQueue'])->name('registerQueue');
        Route::get('/registrationForm',[RegisterFormController::class,'registrationForm'])->name('registrationForm');
        Route::post('/registrationFormPost',[RegisterFormController::class,'registrationFormPost'])->name('registrationFormPost');
        Route::get('/get/subcounties/{id}',[RegisterFormController::class,'data'])->name('data');
        // triage
        Route::resource('triage', TriageController::class)->names('triage');
        // Clinician
        Route::resource('/clinician',ClinicianController::class)->names('clinician');
        Route::post('/clinician/labTest',[ClinicianController::class,'labTest'])->name('clincian.labTest');
        Route::resource('/admin/clinician/appointments',AppointmentController::class)->names('clinician.appointments');
        
        // Drugs
        Route::resource('/drugs',DrugsController::class)->names('drugs');
        // Lab
        Route::resource('/lab',LabController::class)->names('lab');
        // billing
        Route::resource('/billing',BillingController::class)->names('billing');
        // Hiv
        Route::resource('/Hiv',HivController::class)->names('Hiv');
        // Ward
        Route::resource('/ward',WardController::class)->names('ward');
        // procedure
        Route::resource('/procedure',ProcedureRoomController::class)->names('procedure');
        // tracking
        Route::resource('/tracking',TrackingController::class)->names('tracking');
        });
        // pharmacy
        Route::resource('/pharmacy',PharmacyController::class)->names('pharmacy');
        Route::get('/pharmacy', [PharmacyController::class, 'index'])->name('pharmacy.index');
        Route::get('/pharmacy/show/{id}', [PharmacyController::class, 'show'])->name('pharmacy.show');
        Route::post('/pharmacy/dispense', [PharmacyController::class, 'dispense'])->name('pharmacy.dispense');

});



Route::get('/drugs', [DrugsController::class, 'index'])->name('drugs.index'); // List drugs
Route::post('/drugs/restock', [DrugsController::class, 'restock'])->name('drugs.restock'); // Restock drugs
Route::get('/drugs/stock-levels', [DrugsController::class, 'stockLevels'])->name('drugs.stockLevels'); // Manage stock levels
Route::get('/drugs/expiration', [DrugsController::class, 'expirationTracking'])->name('drugs.expirationTracking'); // Track expiration
Route::get('/drugs/{id}/viewStock', [DrugsController::class, 'viewStock'])->name('drugs.viewStock');
Route::get('/drugs/{id}/trackExpiry', [DrugsController::class, 'trackExpiry'])->name('drugs.trackExpiry');






//doctor



//lab



//pharmacist



//store



//web

// auth routes

Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::post('/user/twoStep',[ProfileController::class,'twoStep'])->name('2step.upate');
Route::post('/profile/update',[ProfileController::class,'updateProfile'])->name('profile.update');
Route::post('/profile/updatepassword',[ProfileController::class,'updatepassword'])->name('profile.updatepassword');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/registerpost',[AuthController::class,'registerpost'])->name('registerpost');
Route::get('/otp',[AuthController::class,'otp'])->name('otp');
Route::post('/otppost',[AuthController::class,'otppost'])->name('otppost');
Route::get('/resend',[AuthController::class,'resend'])->name('resend');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
// Route::middleware(['otpenabled'])->group(function(){
Route::post('/loginpost',[AuthController::class,'loginpost'])->name('loginpost');
// });
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard',[PatientController::class,'index'])->name('dashboard');
});

Route::get('/forgot',[AuthController::class,'forgot'])->name('forgot');
Route::post('/forgotpost',[AuthController::class,'forgotpost'])->name('forgotpost');
Route::get('/setnewpassword/{token}',[AuthController::class,'setnewpassword'])->name('setnewpassword');
Route::post('/reset/{token}',[AuthController::class,'reset'])->name('reset');






// Online patients Routes
Route::get('/',[WebController::class,'landingPage'])->name('OnlineDashboard');
Route::group(['middleware'=>'authCheck'],function(){
    Route::get('/appointments',[WebController::class,'appointments'])->name('appointments');
});

Route::post('/appointments/post',[WebController::class,'appointmentsPost'])->name('appointmentsPost');
