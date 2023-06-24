<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendRateMail extends Mailable
{
    public mixed $name;
    public mixed $lowest;
    public mixed $heighst;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $heighst, $lowest)
    {
        $this->name = $name;
        $this->heighst = $heighst;
        $this->lowest = $lowest;
    }


    public function build(): static
    {

        return $this->subject('Rates Mail')
            ->view('emails.reminder-email')
            ->with([
                'user' => $this->user,
            ]);
    }
}
