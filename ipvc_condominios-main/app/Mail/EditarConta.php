<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EditarConta extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $new_password;

    public function __construct($details, $new_password)
    {
        $this->details = $details;
        $this->new_password = $new_password;
    }


    public function build()
    {
        return $this->view('emails.editar_conta');
    }
}