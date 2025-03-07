<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\registration;
use Illuminate\Http\Request;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labPatient = registration::where('status','LabQueue')->get();
        return view("staff.lab.index",compact('labPatient'));
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
        $data = $request->validate([
            'test'=> 'required',
            'patient_id'=>'required',
            'results'=> 'required',
        ]);

        if($data){
            $patient = registration::where('id',$request->patient_id)->first();
            $patient->status = 'ClinicianQueue';
            $patient->save();

            $record = Lab::where('patient_id',$request->patient_id)->first();
            if($record){
                $record->results = $request->results;
                $record->save();
                return redirect(route('lab.index'))->with('success','Patient referred back to the clinician');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $patient = Lab::where('patient_id', $id)->first();
        return view('staff.lab.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lab $lab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lab $lab)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lab $lab)
    {
        //
    }
}
