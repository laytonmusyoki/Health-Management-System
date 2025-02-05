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

            return redirect(route('otp'))->with('success', 'Two-step verification code sent to email');
        }

        return $next($request);
        }

        
    }
}
