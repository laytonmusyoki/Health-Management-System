<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    //
    public function index(){
        $user=auth()->user()->id;
        $appointments=Appointment::where('user_id',$user)->get();
        return view('patients.index',compact('appointments'));
    }
}
