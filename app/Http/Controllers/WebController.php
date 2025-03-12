<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;


class WebController extends Controller
{
    //
    public function appointments(){
        // fetch from user where role clinician
        $doctors = User::role('Clinician')->get();
       
        return view('patients.bookappointment',compact('doctors'));
       
    }
    public function appointmentsPost( Request $request){
        $data = $request->validate([
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
            Appointment::create($data);
            return redirect()->back()->with('success','Appointment booked successfully');
        
        }
        else{
            return redirect()->back()->with('error','Appointment not booked');
        }
        // dd($appointment);
        // $appointment->save();

        // send email to the doctor
        // $doctor = User::where('name',$data['doctorName'])->first();
        // $email = $doctor->email;
        // $details = [
        //     'title' => 'Appointment',
        //     'body' => 'You have an appointment with '.$data['patientName'].' on '.$data['date'].' at '.$data['time']
        // ];  
        // \Mail::to($email)->send(new \App\Mail\AppointmentMail($details));

        // //send email to the patient

        // $details = [
        //     'title' => 'Appointment',
        //     'body' => 'You have an appointment with '.$data['doctorName'].' on '.$data['date'].' at '.$data['time'],'Wait for the approvement of the appointment'
        // ];
        // \Mail::to($data['email'])->send(new \App\Mail\AppointmentMail($details));   

        // return redirect()->route('dashboard');
    }
    
    public function landingPage(){
        return view('patients.onlinedashboard');
    }
   
}
