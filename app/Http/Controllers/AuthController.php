<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Mail\TokenMail;
use App\Models\Forgot;
use App\Models\User;
use App\Services\SmsService;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use Mail;
use Str;

class AuthController extends Controller
{
    protected $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    //
    public function register(){
        return view('auth.register');
    }
    public function registerpost(Request $request){
        $request->validate([
            'name'=>'required|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>'confirmed|min:8|max:20|required'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect(route('login'))->with('success','Account created successfully');
    }
    public function otp(){
        $user_id = auth()->user()->id;
        $user = User::where('id',$user_id)->first();
        $users = User::where('id',$user_id)->count();
        $currentTime = Carbon::now();
        $expiryTime = Carbon::parse($user->expiryTime);
        $remainingTime = $currentTime->diffInSeconds($expiryTime,false);
        return view('auth.otp',compact('remainingTime'));
    }

    public function otppost(Request $request){
        $request->validate([
            'otp'=>'required',
        ]);

        $otp = $request->otp;

        $otpExist = User::where('otp',$otp)->first();
        if($otpExist){
            if(Carbon::now()->subMinutes(5)<$otpExist->createdAt){
                $otpExist->isVerified = 1;
                $otpExist->save();
                if(auth()->user()->role=='staff'){
                    return redirect(route('staff.admin'));
                }
                return redirect(route('dashboard'));
            }
            else{
                return back()->with('error','Otp has expired');
            }
        }
        else{
            return back()->with('error','Incorrect otp');
        }
    }

    public function resend(){
        $user_id = auth()->user()->id;
        $user = User::where('id',$user_id)->first();
        $otp = random_int(000000,999999);
        $expiry = Carbon::now()->addMinutes(5);
        $created = Carbon::now();
        $user->otp = $otp;
        $user->createdAt = $created;
        $user->expiryTime = $expiry;
        $user->save();
        Mail::to($user->email)->send(new OtpMail($otp));
        return redirect(route('otp'))->with('success','A new code sent to email');
    }

    public function login(){
        return view('auth.login');
    }

    public function loginpost(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $email= $request->email;
        $emailExist = User::where('email',$email)->first();

        if($emailExist){
            if(Hash::check($request->password , $emailExist->password)){
                auth()->login($emailExist);
                if($emailExist->otp_enabled==1){
                    $otp = random_int(100000, 999999);
                    $created = Carbon::now();
                    $expiryTime = Carbon::now()->addMinutes(5);
        
                    $emailExist->otp = $otp;
                    $emailExist->createdAt = $created;
                    $emailExist->expiryTime = $expiryTime;
                    $emailExist->save();
                    // $to = "+254759352129"; 
                    // $message = 'Your OTP is '.$otp;
                    // $sid = $this->smsService->sendSms($to, $message);
                    Mail::to($emailExist->email)->send(new OtpMail($otp));
                    return redirect(route('otp'))->with('success','Two factor authentication code has been sent to account');
                }
                if($emailExist->role=='patient'){
                    return redirect(route('dashboard'));
                }
                return redirect(route('staff.admin'));
            }
            else{
                return back()->with('error','Incorrect password');
            }
        }
        else{
            return back()->with('error','Incorrect email');
        }
    }

    public function dashboard(){
        return view('patients.index');
    }

    public function logout(){
        auth()->logout();
        return redirect(route('login'));
    }

    public function forgot(){
        return view('auth.forgot');
    }

    public function forgotpost(Request $request){
        $request->validate([
            'email'=>'required'
        ]);
        $email = $request->email;
        $token = Str::random(50);
        $created = Carbon::now();
        $emailExist = User::where('email',$email)->first();
        if($emailExist){
            $user_id = $emailExist->id;
            $user = Forgot::where('user_id',$user_id)->first();
            if($user){
                $user->token = $token;
                $user->createdAt= $created;
                $user->save();
            }
            else{
                $newUser = new Forgot();
                $newUser->user_id = $user_id;
                $newUser->token = $token;
                $newUser->createdAt = $created;
                $newUser->save();
            }
            Mail::to($email)->send(new TokenMail($token));
            return back()->with('success','A reset link has been sent to your email');
        }
        else{
            return back()->with('error','Incorrect email');
        }
    }

    public function setnewpassword($token){
        return view('auth.setnewpassword',compact('token'));
    }

    public function reset(Request $request,$token){
        $request->validate([
            'password'=>'required|min:8|max:20|confirmed'
        ]);
    $tokenExist = Forgot::where('token',$token)->first();
    if($tokenExist){
        if(Carbon::now()->subMinutes(2)<$tokenExist->createdAt){
            $id = $tokenExist->user_id;
            $userExist = User::where('id',$id)->first();
            $userExist->password = Hash::make($request->password);
            $userExist->save();
            return redirect(route('login'))->with('success','Passowrd changed successfully');
        }
        else{
            return redirect(route('forgot'))->with('error','Token has expired');
        }
    }
    else{
        return redirect(route('forgot'))->with('error','Incorrect token');
    }
    }
   
}