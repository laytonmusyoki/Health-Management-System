<?php

namespace App\Http\Middleware;

use App\Mail\OtpMail;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Mail;
use Symfony\Component\HttpFoundation\Response;

class TwoStepVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors('Please login to continue.');
        }
        else{
            $user = auth()->user();

        $otpEnabled = $user->otp_enabled;

        if ($otpEnabled == 1) {
            $otp = random_int(100000, 999999);
            $created = Carbon::now();
            $expiryTime = Carbon::now()->addMinutes(5);

            $user->otp = $otp;
            $user->createdAt = $created;
            $user->expiryTime = $expiryTime;
            $user->save();
            Mail::to($user->email)->send(new OtpMail($otp));

            return redirect(route('otp'))->with('success', 'Two-step verification code sent to email');
        }

        return $next($request);
        }

        
    }
}
