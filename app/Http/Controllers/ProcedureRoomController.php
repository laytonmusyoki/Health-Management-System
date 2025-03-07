<?php

namespace App\Http\Controllers;

use App\Models\ProcedureRoom;
use Illuminate\Http\Request;

class ProcedureRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("staff.procedureRoom.index");
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
    public function show(ProcedureRoom $procedureRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProcedureRoom $procedureRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProcedureRoom $procedureRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProcedureRoom $procedureRoom)
    {
        //
    }
}
