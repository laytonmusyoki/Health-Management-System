<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

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