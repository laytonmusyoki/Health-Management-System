<?php

namespace App\Http\Controllers;

use App\Models\Clinician;
use App\Models\Lab;
use App\Models\registration;
use App\Models\Triage;
use Illuminate\Http\Request;

class ClinicianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients=registration::where('status', 'ClinicianQueue')->get();
        return view("staff.clinician.index",compact("patients"));
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
            "patient_id"=> "required",
            "signs"=> "required",
            "disease"=> "required",
            'medicine'=>'required'
        ]);

        if($data){
            $patient = registration::where('id',$request->patient_id)->first();
            $patient->status = 'PharmacyQueue';
            $patient->save();
            $patientExist = Clinician::where('patient_id',$request->patient_id)->first();
            if($patientExist){
                $patientExist->signs = $request->signs;
                $patientExist->disease = $request->disease;
                $patientExist->medicine = $request->medicine;
                $patientExist->save();
                return redirect(route('clinician.index'))->with('success','Patient treated successfully');
            }
            $record = new Clinician();
            $record->patient_id = $request->patient_id;
            $record->signs = $request->signs;
            $record->disease = $request->disease;
            $record->medicine = $request->medicine;
            $record->save();
            return redirect(route('clinician.index'))->with('success','Patient treated successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $patient = Triage::where( 'patient_id',$id )->first();
        $labResult = $patient->patient_id;
        $result = Lab::where('patient_id',$labResult)->first();
        return view("staff.clinician.show",compact("patient","result"));

    }

    public function labTest(Request $request){
        $data = $request->validate([
            'patient_id'=>'required',
            'test'=>'required'
        ]);

        if($data){
            $patient=registration::where('id',$request->patient_id)->first();
            $patient->status = "LabQueue";
            $patient->save();

            $patientExist = Lab::where("patient_id", $request->patient_id)->first();

            if($patientExist){
                $patientExist->test = $request->test;
                $patientExist->save();
                return redirect(route("clinician.index"))->with("success","Patient sent to laboratory");
            }
            $record = new Lab();
            $record->test = $request->test;
            $record->patient_id = $request->patient_id;
            $record->save();
            return redirect(route("clinician.index"));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clinician $clinician)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clinician $clinician)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clinician $clinician)
    {
        //
    }
}
