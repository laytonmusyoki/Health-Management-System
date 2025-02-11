<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Activitylog\Facades\Activity;


class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        $roles = Role::all();


        return view('staff.users.roles', compact('roles', 'permissions'));
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
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array'
        ]);

        $role = Role::create(['name' => $request->name]);

       
        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name');
        $role->syncPermissions($permissions);


        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('staff.users.role_details', compact('role', 'permissions') );
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
        $role = Role::findById($id);
        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name');
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Permissions updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
        $item = Role::find($id);
        $item->delete();

        return redirect()->back()->with('success', 'Role deleted successfully.');
    }
}
