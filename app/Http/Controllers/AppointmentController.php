<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentStatusMail;
use App\Models\Appointment;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Mail;
use PhpParser\Node\Stmt\Finally_;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    if (auth()->check() && auth()->user()->hasRole('Super Admin')) {
        $appointments = Appointment::all();
    } else {
        $appointments = Appointment::where('doctor_id', auth()->id())->get();
    }
        return view("staff.appointments.index",compact("appointments"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $patient = Appointment::where('id',$id)->first();
        return view('staff.appointments.show',compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $appointment = Appointment::where('id',$id)->first();
        $request->validate([
            'status'=> 'required',
        ]);
        $status = $appointment->status;
        if($appointment){

            $data = [
                'status' => $request->status,
                'date'   => $appointment->date,
                'time' => $appointment->time,
            ];

            try{
                Mail::to($appointment->email)->send(new AppointmentStatusMail($data));
                return redirect(route('clinician.appointments.index'))->with('success','Status for '.$appointment->patientName.' updated successfully' );
            }
            catch(Exception $e){
                return redirect(route('clinician.appointments.index'))->with('error','Unavailable internet');
            }
            finally{
                $appointment->status = $request->status;
                $appointment->save();
            }
        }
        else{
            return redirect(route('clinician.appointments.index'))->with('error','No such index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
