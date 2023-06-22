<?php

namespace App\Jobs;

use App\Mail\PublishedRateMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Log;

class PublishedRateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


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
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        try {

            Mail::to($this->user?->email)->send(new PublishedRateMail($this->user, $this->rate));
        } catch (\Exception $e) {
            Log::error($e);
        }
    }
}
