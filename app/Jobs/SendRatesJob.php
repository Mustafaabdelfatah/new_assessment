<?php

namespace App\Jobs;

use App\Mail\PublishedRateMail;
use App\Mail\SendRateMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendRatesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public mixed $users;
    public mixed $lowest;
    public mixed $heighst;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users, $heighst, $lowest)
    {
        $this->users = $users;
        $this->heighst = $heighst;
        $this->lowest = $lowest;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {

        foreach ($this->users as $user) {
            try {
                Mail::to($user?->email)->send(new SendRateMail($user->name, $this->heighst, $this->lowest));
            } catch (\Exception $e) {
                Log::error($e);
            }
        }

    }
}
