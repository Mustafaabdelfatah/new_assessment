<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Assessment;
use App\Models\RateAction;
use Illuminate\Console\Command;
use App\Enums\ActionsStatusEnums;
use Illuminate\Support\Collection;
use Symfony\Component\Console\Command\Command as CommandAlias;

class CloneAssess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clone:assess';

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

        $assesss1 = Assessment::with('users', 'questions','actions')->where(['type' => 'monthly'])
            ->whereMonth('start_date', Carbon::today()->subMonths(1))
            ->get();

        $assesss3 = Assessment::with('users', 'questions','actions')->where(['type' => 'three_month'])
            ->whereMonth('start_date', Carbon::today()->subMonths(3))
            ->get();

        $assesss6 = Assessment::with('users', 'questions','actions')->where(['type' => 'six_month'])
            ->whereMonth('start_date', Carbon::today()->subMonths(6))
            ->get();

        $assesss1y = Assessment::with('users', 'questions','actions')->where(['type' => '1_year'])
            ->whereMonth('start_date', Carbon::today()->subMonths(12))
            ->get();

        $all = Collection::make();
        $all = $all->concat($assesss1)
            ->concat($assesss3)
            ->concat($assesss6)
            ->concat($assesss1y);

        foreach ($all as $assess) {
            // dump(count($assess->toArray()));

            $questions = $assess->questions()->pluck('question_id')->toArray();
            $users = $assess->users()->pluck('user_id')->toArray();
            // $actions = $assess->actions()->pluck('user_id')->toArray();
            // dd($actions);
            $newAssess = Assessment::create([
                'title' => $assess->title,
                'type' => $assess->type,
                'time' => $assess->time,
                'slug' =>  strtolower(str_replace(' ', '-', $assess->title)),
                'start_date' => Carbon::today()->startOfMonth(),
                'to_date' => Carbon::today()->endOfMonth(),
                'status' => $assess->status,
                'manager_id' => $assess->manager_id,
            ]);
            sendMsgFormat($assess,'email','','','assess','Now You Manager For New Assessment',route('admin.show-assessment',$assess->id));
            sendMsgFormat($assess,'noti','','','assess','Now You Manager For New1 Assessment',route('admin.show-assessment',$assess->id));


            $newAssess->questions()->attach($questions);
            $newAssess->users()->attach($users);

            // foreach ($assess?->users as $user) {
            //     // foreach ($assess->actions as $key => $action) {
            //         $assess_id = $assess?->id;
            //         $user_id = $user?->id;
            //         $pendingAction = RateAction::where('employee_id',$user_id)->where('assess_id',$assess_id)
            //         ->Where('status', ActionsStatusEnums::ACTIVE)->count();
            //         // $pendingAction = $rate->actions()->where('status', '!=', [ActionsStatusEnums::ACCEPT])->count();
            //          RateAction::create([
            //             'user_id' => $action,
            //             'assess_id' => $assess->id,
            //             'name' => 'sa',
            //             'rate_id' => null,
            //             'employee_id' => $user->id,
            //             'status' => $pendingAction == 0 ? ActionsStatusEnums::ACTIVE : ActionsStatusEnums::PENDING,
            //         ]);
            //     // }
            // }

            // for($i = 0 ; $i <= count($assess->toArray()) ; $i++){
            //     RateAction::create([
            //         'name'=>'sad',
            //         'status'=>'active',
            //         'user_id'=> $actions,
            //         'assess_id'=>$assess->id,
            //         'employee_id'=>7,
            //     ]);
            // }

            // $assess->actions()->insert([
            //     'name'=>'sad',
            //     'status'=>'active',
            //     'user_id'=>3,
            //     'assess_id'=>14,
            //     'employee_id'=>7,
            // ]);
        }

        return CommandAlias::SUCCESS;
    }
}
