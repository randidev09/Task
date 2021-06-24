<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterEmail;

class MailController extends Controller
{
    public static function sendRegisterEmail($name, $email, $verification_code,$user_id){
        $data = [
            'name' => $name,
            'email' => $email,
            'verification_code' => $verification_code,
            'user_id' => $user_id
        ];
        Mail::to($email)->send(new RegisterEmail($data));
    }
}
