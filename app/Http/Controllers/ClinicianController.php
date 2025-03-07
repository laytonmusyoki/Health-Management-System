<?php

namespace App\Http\Controllers;

use App\Models\Clinician;
use App\Models\registration;
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Clinician $clinician)
    {
        //
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
