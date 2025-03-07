<?php

namespace App\Http\Controllers;

use App\Models\registration;
use App\Models\Triage;
use Illuminate\Http\Request;

class TriageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $triage=registration::where('status', 'TriageQueue')->get();
        return view("staff.triage.index",compact("triage"));
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
        $data=$request->validate([
            "patient_id"=> "required",
            "temperature"=> "required",
            "pressure"=> "required",
            "height"=> "required",
            "weight"=> "required",
        ]);

        if($data){
            registration::where('id',$request->patient_id)->update(['status'=>'ClinicianQueue']);
            $dataExist=Triage::where('patient_id',$request->patient_id)->first();
            if($dataExist){
                $dataExist->patient_id=$request->patient_id;
                $dataExist->temperature=$request->temperature;
                $dataExist->pressure= $request->pressure;
                $dataExist->height= $request->height;
                $dataExist->weight= $request->weight;
                $dataExist->save();
                return back()->with("success","Information uploaded");
            }
            Triage::create($data);
            return back()->with("success","Information uploaded");
        }
        

    }

    /**
     * Display the specified resource.
     */
    public function show(Triage $triage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Triage $triage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Triage $triage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Triage $triage)
    {
        //
    }
}
