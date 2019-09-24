<?php


namespace App\SendNotification;


use App\Entities\User;
use App\Mail\UserCreated;
use Illuminate\Support\Facades\Mail;

class MailNotification
{

    public function send($email,$user)
    {
        Mail::to($email)->send(new UserCreated($user));
    }

}