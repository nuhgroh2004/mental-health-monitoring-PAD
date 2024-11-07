<?php

namespace App\Jobs;

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

    public $otp;
    public function __construct(Int $otp)
    {
        $this->otp = $otp;
    }
    public function handle(): void
    {
        $email = new SendEmail($this->otp);
        Mail::to($this->otp['email'])->send($email);
    }
}
