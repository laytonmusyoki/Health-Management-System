<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//online patients
Route::get('/user/patient',[PatientController::class,'index'])->name('user.patient');


// staff configurations
Route::get('/staff/admin',[StaffController::class,'index'])->name('staff.admin');


//receptionist



//doctor



//lab



//pharmacist



//store



//web

// auth routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/otp',[AuthController::class,'otp'])->name('otp');
Route::get('/forgot',[AuthController::class,'forgot'])->name('forgot');
Route::get('/setnewpassword',[AuthController::class,'setnewpassword'])->name('setnewpassword');
