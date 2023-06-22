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

class SendUserReminder extends Mailable
{
    use Queueable, SerializesModels;

    public mixed $user;
    public mixed $temp;
    public mixed $assess_title;
    public mixed $reminder;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $assess_title,$reminder)
    {
        $this->user = $user;
        $this->assess_title = $assess_title;
        $this->reminder = $reminder;
        $this->temp = Setting::where('slug', 'reminder_email')->first()?->desc;
        $this->temp = Str::replace('{userName}', $user?->name, $this->temp);
        $this->temp = Str::replace('{assessTitle}', $assess_title, $this->temp);
        $this->temp = Str::replace('{days}', $reminder, $this->temp);
    }

    public function build(): static
    {

        return $this->subject('Reminder Email')
            ->view('emails.reminder-email')
            ->with([
                'user' => $this->user,
                'temp' => $this->temp,
                'title' => $this->assess_title,
            ]);
    }
}
