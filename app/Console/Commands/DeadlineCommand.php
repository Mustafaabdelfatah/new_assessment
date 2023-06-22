<?php

namespace App\Console\Commands;

use App\Enums\UsersTypesEnums;
use App\Models\Assessment;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeadlineCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deadline:end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $deadline = Setting::where('slug', 'deadline')->first()?->desc;
        $deadline = Setting::where('slug', 'deadline')->first()?->desc;
        $assessments = Assessment::where('start_date', '<', Carbon::today()->subDays($deadline))->where('status', 'active')->get();
        //    foreach ($assessments as $assessment) {
        //
        //    }


    }
}
