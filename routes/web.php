<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

//online patients



//receptionist



//doctor



//lab



//pharmacist



//store



//web

// auth routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loginpost',[AuthController::class,'loginpost'])->name('loginpost');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/otp',[AuthController::class,'otp'])->name('otp');
Route::get('/forgot',[AuthController::class,'forgot'])->name('forgot');
Route::get('/setnewpassword',[AuthController::class,'setnewpassword'])->name('setnewpassword');
