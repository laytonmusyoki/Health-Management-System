<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterFormController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//online patients
Route::get('/user/patient',[PatientController::class,'index'])->name('user.patient');


// staff configurations

Route::group(['middleware' => ['auth','role']], function () {
    Route::get('/staff/admin',[StaffController::class,'index'])->name('staff.admin');
});





Route::resource('admin/roles/delete', RolesController::class)->names('roles');
    Route::resource('admin/permissions', PermissionsController::class)->names('permissions');
    Route::delete('admin/roles/delete/{id}', [RolesController::class, 'destroy'])->name('roles.delete');
    Route::delete('admin/permissions/delete/{id}', [PermissionsController::class, 'destroy'])->name('permissions.delete');
    Route::resource('admin/users', UserController::class)->names('users');

//receptionist
Route::get('/registration',[RegisterFormController::class,'registration'])->name('registration');
Route::get('/find',[RegisterFormController::class,'find'])->name('find');
Route::get('/registrationForm',[RegisterFormController::class,'registrationForm'])->name('registrationForm');
Route::post('/registrationFormPost',[RegisterFormController::class,'registrationFormPost'])->name('registrationFormPost');
Route::get('/get/subcounties/{id}',[RegisterFormController::class,'data'])->name('data');
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
    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');
});

Route::get('/forgot',[AuthController::class,'forgot'])->name('forgot');
Route::post('/forgotpost',[AuthController::class,'forgotpost'])->name('forgotpost');
Route::get('/setnewpassword/{token}',[AuthController::class,'setnewpassword'])->name('setnewpassword');
Route::post('/reset/{token}',[AuthController::class,'reset'])->name('reset');
