<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendEmail;
use App\Jobs\SendMailJob;


class SendEmailController extends Controller
{
    public function index()
    {

    }
        public function store(Request $request)
    {
        $otp= $request->all();
        dispatch(new SendMailJob($otp));
    
    }


}
