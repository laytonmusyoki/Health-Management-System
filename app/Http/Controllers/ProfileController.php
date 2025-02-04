<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(){
        return view('patients.profile');
    }

    public function twoStep(Request $request){
        $status=$request->enable2FA;
        $user=auth()->user();
        if($status == 'on'){
            $status=1;
            $user->otp_enabled=$status;
        }
        else{
            $status=0;
            $user->otp_enabled=$status;
        }
        $user->save();
        return back()->with('success','Two-Step-Verification updated successfully');
    }

    public function updateProfile(Request $request){
       $request->validate([
        'name'=>'required|unique:users'
       ]);
       $id= auth()->user()->id;
       $user = User::where('id',$id)->first();
       $user->name = $request->name;
       $user->save();
       return redirect(route('profile'))->with('success','Name updated');
    }

    public function updatepassword(Request $request){
        $request->validate([
            'oldpassword'=>'required',
            'password'=>'required|min:8|max:20|confirmed'
        ]);
        $user = auth()->user();
        $password = $user->password;
        if(Hash::check($request->oldpassword ,$password)){
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect(route('profile'))->with('success','Password changed');
        }
        else{
            return redirect(route('profile'))->with('error','Incorrect old password');
        }
    }
}
