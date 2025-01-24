<?php
// app/Mail/AkunCreated.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AkunCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $akun;

    public function __construct(App\Models\User $akun)
    {
        $this->akun = $akun;
    }

    public function build()
    {
        return $this->subject('Akun Anda Telah Dibuat')
                    ->view('emails.akun-created');
    }
}