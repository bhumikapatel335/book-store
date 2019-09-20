<?php


namespace App\SendNotification;


use App\Mail\UserCreated;
use Illuminate\Support\Facades\Mail;

class MailNotification
{

    public function send($email)
    {
        Mail::to($email)->send(new UserCreated());
    }

}