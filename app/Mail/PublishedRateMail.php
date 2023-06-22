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

class PublishedRateMail extends Mailable
{
    use Queueable, SerializesModels;

    public mixed $user;
    public mixed $rate;
    public string $temp;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $rate)
    {

        $this->user = $user;
        $this->rate = $rate;

        $this->temp = Setting::where('slug', 'rate_published')->first()?->desc;
        $this->temp = Str::replace('{userName}', $user?->name, $this->temp);
        $this->temp = Str::replace('{assessTitle}', $rate?->assessment?->title, $this->temp);
    }

    public function build(): static
    {

        return $this->subject('Rate Published')
            ->view('emails.reminder-email')
            ->with([
                'user' => $this->user,
                'temp' => $this->temp,
            ]);
    }
}
