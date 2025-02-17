<?php

namespace App\Services;

use Twilio\Rest\Client;

class SmsService
{
    protected $twilio;

    public function __construct()
    {
        $sid = env('TWILIO_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $this->twilio = new Client($sid, $authToken);
    }

    public function sendSms($to, $message)
    {
        $twilioNumber = env('TWILIO_PHONE_NUMBER');
        
        // Send message
        $message = $this->twilio->messages->create(
            $to, 
            [
                'from' => $twilioNumber,
                'body' => $message,
            ]
        );

        return $message->sid;
    }
}
