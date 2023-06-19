<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $data = [];


    public function __construct($data)
    {
        $this->data = $data;
    }



    public function build(): static
    {



        return $this->subject('Welcome to Assessment Dashboard')
        ->view('emails.welcome-user')
        ->with([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'link' => $this->data['link'],
            'password' => $this->data['password'],
        ]);
     }


}
