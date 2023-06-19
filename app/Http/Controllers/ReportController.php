<?php

namespace App\Http\Controllers;

use App\Enums\UsersTypesEnums;
use App\Models\Assessment;
use App\Models\AssessmentUser;
use App\Models\Rate;
use App\Models\User;
use App\Services\UserService;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index($month = null)
    {


        $user = auth()->user();
        $user_data = User::with('position')->whereNot('type', UsersTypesEnums::ADMIN)->find($user->id);
        $userId = auth()->id();
        $user_service = new UserService($user);
        $firstQuarter = $user_service->getQuarterlyAverageRates($userId, Carbon::parse('January 1')->startOfQuarter(), Carbon::parse('March 31')->endOfQuarter());
        $secondQuarter = $user_service->getQuarterlyAverageRates($userId, Carbon::parse('April 1')->startOfQuarter(), Carbon::parse('June 30')->endOfQuarter());
        $thirdQuarter = $user_service->getQuarterlyAverageRates($userId, Carbon::parse('July 1')->startOfQuarter(), Carbon::parse('September 30')->endOfQuarter());
        $lastQuarter = $user_service->getQuarterlyAverageRates($userId, Carbon::parse('October 1')->startOfQuarter(), Carbon::parse('December 31')->endOfQuarter());


        $highestRatedEmployee = DB::table('rate_answers')
            ->join('users', 'rate_answers.user_id', '=', 'users.id')
            ->select('users.name', 'users.image', DB::raw('AVG(rate_answers.rate) as average_rate'))
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('average_rate')
            ->first();


        $users = User::where('type', 'employee')->get();

        $lowesttRatedEmployee = DB::table('rate_answers')
            ->join('users', 'rate_answers.user_id', '=', 'users.id')
            ->select('users.name', 'users.image', DB::raw('AVG(rate_answers.rate) as average_rate'))
            ->where('rate_answers.rate', '!=', 'null')
            ->groupBy('users.id', 'users.name')
            ->orderBy('average_rate', 'asc')
            ->first();


        $getAssessSlugs = Assessment::groupBy('slug')->pluck('slug');

        $assessIds = Assessment::where('slug', $getAssessSlugs[0])->pluck('id');
        $dates = Assessment::where('slug', $getAssessSlugs[0])->groupBy('start_date')->pluck('start_date');
        $getAssessDates = [];
        foreach ($dates as $date) {
            $getAssessDates[] = Carbon::parse($date)->format('Y-m-d');
        }
        $highestAvgRates = DB::table('rates')
            ->whereIn('assessment_id', $assessIds)->whereNotNull('rate')
            ->groupBy('user_id')
            ->select('user_id', 'users.name', DB::raw('AVG(rate) as avg_rate'))
            ->join('users', 'users.id', '=', 'rates.user_id')
            ->orderByDesc('avg_rate')
            ->limit(3)
            ->get();

        $month = $month ?? Carbon::today()->subMonth();
        if (auth()->user()->AssessmentManager()->count() >= 1) {

            $assessmentsIds = Assessment::where('manager_id', auth()->id())->whereMonth('start_date', Carbon::parse($month))->pluck('id')->toArray();
            $assessmentsDates = Assessment::orderBy('start_date', 'desc')->groupBy('start_date')
                ->pluck('start_date')
                ->toArray();

            $RatedUsers = AssessmentUser::with('assessment.manager', 'user', 'rateUser')
                ->whereHas('rateUser', function ($s) use ($assessmentsIds) {
                    $s->whereIn('assessment_id', $assessmentsIds)->orderBy('rate', 'asc');
                })
                ->whereIn('assessment_id', $assessmentsIds)
                ->get();
        }

        return view('layout.master', get_defined_vars());
    }


    public function get_dates(Request $request)
    {
        $slug = $request->slug;
        try {
            $assessIds = Assessment::where('slug', $slug)->pluck('id');
            $getAssessDates = Assessment::where('slug', $slug)->groupBy('start_date')->pluck('start_date');
            $dates = [];
            foreach ($getAssessDates as $date) {
                $dates[] = Carbon::parse($date)->format('Y-m-d');
            }
            $data = [
                'data' => $dates,
                'status' => true,
                'code' => 200
            ];
            return response($data, 200);
        } catch (\Exception $ex) {
            $data = [
                'data' => null,
                'status' => false,
                'code' => 404
            ];
            return response($data, 404);
        }

    }

    public function get_emp(Request $request)
    {
        $slug = $request->slug;
        $dates = $request->dates;
        try {
            $assessIds = Assessment::where('slug', $slug)->pluck('id');
            $highestAvgRates = DB::table('rates')
                ->where('status', 'published')
                ->whereIn('assessment_id', $assessIds)->whereNotNull('rate');
            if ($dates != 'all') {
                $highestAvgRates = $highestAvgRates->whereIn('date', $dates);
            }
            $highestAvgRates = $highestAvgRates->groupBy('user_id')
                ->select('user_id', 'users.name', DB::raw('AVG(rate) as avg_rate'))
                ->join('users', 'users.id', '=', 'rates.user_id')
                ->orderByDesc('avg_rate')
                ->limit(3)
                ->get();
            $lowestAvgRates = DB::table('rates')
                ->where('status', 'published')
                ->whereIn('assessment_id', $assessIds)->whereNotNull('rate');

            if ($dates != 'all') {
                $lowestAvgRates = $lowestAvgRates->whereIn('date', $dates);
            }
            $lowestAvgRates = $lowestAvgRates->groupBy('user_id')
                ->select('user_id', 'users.name', DB::raw('AVG(rate) as avg_rate'))
                ->join('users', 'users.id', '=', 'rates.user_id')
                ->orderBy('avg_rate')
                ->limit(3)
                ->get();

            $data = [
                'data' => [
                    'highest' => $highestAvgRates,
                    'lowest' => $lowestAvgRates
                ],
                'status' => true,
                'code' => 200
            ];
            return response($data, 200);
        } catch (\Exception $ex) {
            $data = [
                'data' => null,
                'status' => false,
                'code' => 404
            ];
            return response($data, 404);
        }

    }


//    assessment statistics
//    public function ratedUsers($month = null)
//    {
//        $month = $month ?? Carbon::today()->subMonth();
//        $assessmentsIds = Assessment::whereMonth('start_date', Carbon::parse($month))->pluck('id')->toArray();
//
//
////        $ratedUsersIds = Rate::whereIn('assessment_id', $assessmentsIds)->pluck('id')->toArray();
////        rated users
//        $assessmentsDates = Assessment::orderBy('start_date', 'desc')->groupBy('start_date')
//            ->pluck('start_date')
//            ->toArray();
//
//        $RatedUsers = AssessmentUser::with('assessment.manager', 'user','rateUser')
//        ->whereHas('rateUser', function ($s) use ($assessmentsIds) {
//            $s->whereIn('assessment_id', $assessmentsIds);
//        })
//        ->whereIn('assessment_id', $assessmentsIds)
//        ->get();
//
//
//        $unRatedUsers = AssessmentUser::with('assessment.manager', 'user','rateUser')->whereDoesntHave('rateUser', function ($s) use ($assessmentsIds) {
//            $s->whereIn('assessment_id', $assessmentsIds);
//        })->whereIn('assessment_id', $assessmentsIds)->get();
//
//
//
//        return view('dashboard.pages.setting.assessment-users', get_defined_vars());
//
//    }


    public function get_emp_all(Request $request)
    {
        $dates = $request->dates;


        try {
            $highestAvgRates = DB::table('rates')
                ->where('status', 'published')
                ->whereNotNull('rate')
                ->whereIn('date', $dates);

            if ($dates != 'all') {
                $highestAvgRates = $highestAvgRates->whereIn('date', $dates);
            }

            $highestAvgRates = $highestAvgRates->groupBy('user_id', 'date') // Include 'date' column in groupBy
            ->select('user_id', 'users.name', DB::raw('AVG(rate) as avg_rate'))
                ->join('users', 'users.id', '=', 'rates.user_id')
                ->orderByDesc('avg_rate')
                ->limit(3)
                ->get();

            $lowestAvgRates = DB::table('rates')
                ->where('status', 'published')
                ->whereNotNull('rate')
                ->whereIn('date', $dates);

            if ($dates != 'all') {
                $lowestAvgRates = $lowestAvgRates->whereIn('date', $dates);
            }
            $lowestAvgRates = $lowestAvgRates->groupBy('user_id')
                ->select('user_id', 'users.name', DB::raw('AVG(rate) as avg_rate'))
                ->join('users', 'users.id', '=', 'rates.user_id')
                ->orderBy('avg_rate')
                ->limit(3)
                ->get();


            $data = [
                'data' => [
                    'highest' => $highestAvgRates,
                    'lowest' => $lowestAvgRates
                ],
                'status' => true,
                'code' => 200
            ];
            return response($data, 200);
        } catch (\Exception $ex) {
            $data = [
                'data' => null,
                'status' => false,
                'code' => 404
            ];
            return response($data, 404);
        }


    }

    public function ratedUsers($month = null)
    {
        if (auth()->user()->type == 'employee') abort(404);
        $month = $month ?? Carbon::today()->subMonth();
//        $assessmentsIds = Assessment::whereMonth('start_date', Carbon::parse($month))->pluck('id')->toArray();


//        if (auth()->user()->AssessmentManager()->count() > 1) {
//            $assessmentsIds = Assessment::where('manager_id', auth()->id())->whereMonth('start_date', Carbon::parse($month))->pluck('id')->toArray();
//        } else {
//        }
        $assessmentsIds = Assessment::whereMonth('start_date', Carbon::parse($month))->pluck('id')->toArray();

//        $ratedUsersIds = Rate::whereIn('assessment_id', $assessmentsIds)->pluck('id')->toArray();
//        rated users
        $assessmentsDates = Assessment::orderBy('start_date', 'desc')->groupBy('start_date')
            ->pluck('start_date')
            ->toArray();

        $RatedUsers = AssessmentUser::with('assessment.manager', 'user', 'rateUser')
            ->whereHas('rateUser', function ($s) use ($assessmentsIds) {
                $s->whereIn('assessment_id', $assessmentsIds);
            })
            ->whereIn('assessment_id', $assessmentsIds)
            ->get();


        $unRatedUsers = AssessmentUser::with('assessment.manager', 'user', 'rateUser')->whereDoesntHave('rateUser', function ($s) use ($assessmentsIds) {
            $s->whereIn('assessment_id', $assessmentsIds);
        })->whereIn('assessment_id', $assessmentsIds)->get();


        return view('dashboard.pages.setting.assessment-users', get_defined_vars());

    }

    // public function export_rate(){
    //     return Excel::download(new RatesAllExport, 'users-rates.xlsx');
    // }
}
