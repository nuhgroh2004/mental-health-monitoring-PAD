<?php

namespace App\Jobs;

use App\Mail\OTPMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $otp;
    private $email;

    public function __construct($otp, $email)
    {
        $this->otp = $otp;
        $this->email = $email;
    }

    public function handle()
    {
        Mail::to($this->email)
            ->send(new OTPMail($this->otp));
    }
}
