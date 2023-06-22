<?php

namespace App\Console\Commands;

use App\Jobs\SendUserReminderJob;
use App\Models\Assessment;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    public function handle(): void
    {
        $reminder = Setting::where('slug', 'reminder_before')->first()?->desc;
        $day = Carbon::today()->addMonth()->startOfMonth()->subDays($reminder);
        $dateToCompare = Carbon::parse($day);
        $today = Carbon::today();

        $isSameDay = $today->isSameDay($dateToCompare);
        if ($isSameDay) {
            $assessments = Assessment::whereMonth('start_date', Carbon::today())->get();
            foreach ($assessments as $assess) {
                dispatch(new SendUserReminderJob($assess->manager, $assess->title,$reminder));
            }
        }
    }
}
