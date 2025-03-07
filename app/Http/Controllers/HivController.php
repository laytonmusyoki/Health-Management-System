<?php

namespace App\Http\Controllers;

use App\Models\Hiv;
use Illuminate\Http\Request;

class HivController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("staff.Hiv.index");
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
    public function show(Hiv $hiv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hiv $hiv)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hiv $hiv)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hiv $hiv)
    {
        //
    }
}
