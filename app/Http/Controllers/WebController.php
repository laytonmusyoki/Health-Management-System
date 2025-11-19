<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentMail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;


class WebController extends Controller
{
    //
    public function appointments(){
        // fetch from user where role clinician
        $doctors = User::role('Clinician')->get();
        // Only include clinicians that have 2 or fewer pending appointments
        $doctors = User::role('Clinician')
        ->whereHas('appointments', function($q){
            $q->where('status', 'pending');
        }, '<', 10)
        ->get();

       
        return view('patients.bookappointment',compact('doctors'));
       
    }
    public function appointmentsPost( Request $request){
        $data = $request->validate([
            'user_id'=> 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'doctorName' => 'required',
            'patientName' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'reason' => 'nullable',
        ]);
    
        
        if($data){
            $mailData=[
                'doctor'=> $data['doctorName'],
                'time'=> $data['time'],
                'date'=> $data['date']
            ];
            try{
                Mail::to($data['email'])->send(new AppointmentMail($mailData));
                return redirect()->route('dashboard')->with('success','Appointment booked successfully');
            }
            catch(\Exception $e){
                return redirect()->back()->with('error', $e->getMessage());
            }
            finally{
                Appointment::create($data);
                return redirect()->route('dashboard')->with('success','Appointment booked successfully');
            }
            
        
        }
        else{
            return redirect()->back()->with('error','Appointment not booked');
        }
        
    }
    
    public function landingPage(){
        return view('patients.onlinedashboard');
    }
   
}
