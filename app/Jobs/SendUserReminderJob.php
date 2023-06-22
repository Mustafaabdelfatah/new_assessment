<?php

namespace App\Jobs;

use App\Mail\SendUserReminder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendUserReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public mixed $user;
    public mixed $assess_title;
    public mixed $reminder;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $assess_title,$reminder)
    {
        $this->user = $user;
        $this->assess_title = $assess_title;
        $this->reminder = $reminder;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        try {

            Mail::to($this->user?->email)->send(new SendUserReminder($this->user, $this->assess_title,$this->reminder));
        } catch (\Exception $e) {
            Log::error($e);
        }
    }
}
