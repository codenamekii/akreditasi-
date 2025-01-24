<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send_mail($subject,$title,$body,$email)
    {
        $details = [
            'title' => $title,
            'body' => $body,
            'email' => $email,
            'subject' => $subject
        ];

        Mail::to($email)->send(new \App\Mail\sendMail($details));

        return true;
    }
}
