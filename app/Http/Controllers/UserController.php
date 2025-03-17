<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use App\Models\Contact;
use App\Models\Partner;
use App\Models\CompanySBP;
use App\Models\ActivityLog;
use App\Models\Attachments;
use App\Models\BankDetails;
use App\Models\Shareholder;
use Illuminate\Http\Request;
use App\Models\CompanyDetail;
use App\Models\CompanyExpirience;
use App\Models\EligibilityStatus;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        $roles = Role::all();

        return view('staff.users.list', compact('users', 'roles'));

    }

    public function activity_logs()
    {
        $users = User::all();
        $activity_logs = [];

        $roles = Role::all();

        return view('staff.users.activity_logs', compact('activity_logs', 'roles'));

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
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff',
        ]);

        $user->assignRole($request->role);


        return redirect()->route('users.index')->with('success', 'User created successfully.');


    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();



        return view('staff.users.details', compact('user', 'roles','selected_departments','departments'));
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


        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|string|exists:roles,name',
        ]);

        $user = User::findOrFail($id);
        $user->save();

        $user->update([
            'name' => $request->username,
            'email' => $request->email,
            'role'=> 'staff',
        ]);

        $user->syncRoles([$request->role]);



        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->back();
    }
}
