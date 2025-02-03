<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function register(){
        return view('auth.register');
    }
    

    public function otp(){
        return view('auth.otp');
    }
    
    public function loginpost(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $email= $request->email;
        $emailExist = User::where('email',$email)->first();

        
    }

    public function login(){
        return view('auth.login');
    }

    public function forgot(){
        return view('auth.forgot');
    }

    public function setnewpassword(){
        return view('auth.setnewpassword');
    }
   
}
