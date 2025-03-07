<?php

namespace App\Http\Controllers;

use App\Models\Ward;
use Illuminate\Http\Request;

class WardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("staff.ward.index");
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
    public function show(Ward $ward)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ward $ward)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ward $ward)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ward $ward)
    {
        //
    }
}
