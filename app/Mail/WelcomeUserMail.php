<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class WelcomeUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $data = [];
    public $temp;


    public function __construct($data)
    {
        $this->data = $data;
        $this->temp = Setting::where('slug', 'create_user')->first()?->desc;
        $this->temp = Str::replace('{userName}', $this->data['name'], $this->temp);
        $this->temp = Str::replace('{email}', $this->data['email'], $this->temp);
        $this->temp = Str::replace('{password}', $this->data['password'], $this->temp);
    }


    public function build(): static
    {


        return $this->subject('Welcome to Assessment Dashboard')
            ->view('emails.welcome-user')
            ->with([
                'temp' => $this->temp,
                'link' => $this->data['link'],
            ]);
    }


}
