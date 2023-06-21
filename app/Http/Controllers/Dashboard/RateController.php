<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Rate;
use App\Models\User;
use App\Models\Question;
use App\Models\Assessment;
use App\Models\RateAnswer;
use App\Exports\RatesExport;
use Illuminate\Http\Request;
use App\Enums\UsersTypesEnums;
use App\Exports\unRatesExport;
use App\Models\AssessmentUser;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class RateController extends Controller
{

    public function rates()
    {
        if (auth()->user()->AssessmentManager()->count() == 0 && auth()->user()->type == UsersTypesEnums::EMPLOYEE) {
            abort(404);
        }

        $rates = auth()->user()->AssessmentManager()->count() > 0 ?
            $this->getRatesWithManager()->get() :
            User::select('name', 'id')
                ->with(['rates', 'assessment'])
                ->selectRaw('(SELECT COUNT(*) FROM rates WHERE rates.user_id = users.id) AS assessment_count')
                ->selectRaw('(SELECT GROUP_CONCAT(assessments.title SEPARATOR ", ") FROM assessments JOIN rates ON rates.assessment_id = assessments.id WHERE rates.user_id = users.id) AS assessment_names')
                ->whereExists(function ($query) {
                    $query->select(\DB::raw(1))
                        ->from('rates')
                        ->whereRaw('rates.user_id = users.id');
                })
                ->get();
        return view('dashboard.pages.rates.all_rates', get_defined_vars());
    }

    private function getRatesWithManager(): \Illuminate\Database\Eloquent\Builder
    {
        $rate = User::select('name', 'id')
            ->with(['rates', 'assessment'])
            ->selectRaw('(SELECT COUNT(*) FROM rates WHERE rates.user_id = users.id) AS assessment_count')
            ->selectRaw('(SELECT GROUP_CONCAT(assessments.title SEPARATOR ", ") FROM assessments JOIN rates ON rates.assessment_id = assessments.id WHERE rates.user_id = users.id) AS assessment_names')
            ->whereExists(function ($query) {
                $query->select(\DB::raw(1))
                    ->from('rates')
                    ->where('manager_id', auth()->user()->id)
                    ->whereRaw('rates.user_id = users.id');
            });
        return $rate;
    }

    public function rates_history($id)
    {
        $rates = Rate::where('user_id', $id)->get();
        return view('dashboard.pages.rates.rates-history', get_defined_vars());
    }

    public function export_rate($month)
    {
        return Excel::download(new RatesExport($month), 'rated-employee.xlsx');
    }
    public function export_unrate($month)
    {
        return Excel::download(new unRatesExport($month), 'unrated-employee.xlsx');
    }

    public function getRateDetails($assessment, $startDate, $endDate, $userId)
    {


        $managerId = auth()->user()->id; // Assuming the authenticated user is the manager
        $userIdToCheck = $userId; // The user ID you want to check

        $isUnderManager = AssessmentUser::whereHas('assessment', function ($query) use ($managerId) {
            $query->where('manager_id', $managerId);
        })
        ->where('user_id', $userIdToCheck)
        ->exists();
        $isCurrentUserAdmin = Auth::user()->type->value === 'admin'; // Assuming 'admin' is the value for admin users


        if (!$isUnderManager && $userIdToCheck != $managerId && !$isCurrentUserAdmin) {
            // If the user is not under the manager's group of users and the user ID is not the manager's ID
            // Abort with a "Not Found" response
            abort(404);
        }
        $firstMonthDate = Carbon::parse($startDate)->startOfQuarter();
        $secondMonthDate = Carbon::parse($startDate)->startOfQuarter()->addMonths(1);
        $thirdMonthDate = Carbon::parse($startDate)->startOfQuarter()->addMonths(2);

        $first_month = Rate::whereHas('assessment', function ($query) use ($assessment) {
            $query->where('slug', $assessment);
        })
            ->whereMonth('date', $firstMonthDate)
            ->where('user_id', $userId)
            ->with('assessment', 'answers')
            ->first();
        $second_month = Rate::whereHas('assessment', function ($query) use ($assessment) {
            $query->where('slug', $assessment);
        })
            ->whereMonth('date', $secondMonthDate)
            ->where('user_id', $userId)
            ->with('assessment', 'answers')
            ->first();
        $third_month = Rate::whereHas('assessment', function ($query) use ($assessment) {
            $query->where('slug', $assessment);
        })
            ->whereMonth('date', $thirdMonthDate)
            ->where('user_id', $userId)
            ->with('assessment', 'answers')
            ->first();
            return view('dashboard.pages.rates.rates-details', get_defined_vars());

     }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View
     */

    public function rate_details(Request $request)
    {
        $rate = Rate::with('answers', 'user')->find($request->rate_id);
        return view('dashboard.pages.rates.rate-details', [
            'rate' => $rate,
        ]);
    }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View
     */

    public function rate_assessment(Request $request)
    {
        $assessment = Assessment::with('questions', 'users', 'answers.user', 'manager', 'rates')->findOrFail($request->assessment_id);
        $employeeIdsWithRate = $assessment->answers->pluck('user_id')->unique()->toArray();
        return view('dashboard.pages.rates.rate_assessment', get_defined_vars());
    }

    // used In Main Function UpdateRate
    function createOrUpdateRate(Request $request, Assessment $assessment)
    {
        // If a rate ID is provided, delete its existing answers
        if ($request->rate_id) {
            $rate = Rate::find($request->rate_id);
            $rate->answers()->delete();
        } // Otherwise, create a new rate with default values
        else {
            $rate = Rate::updateOrCreate([
                'assessment_id' => $assessment->id,
                'user_id' => $request->user_id,
                'manager_id' => $assessment->manager_id,
                'date' => $assessment->start_date,
                'status' => 'pending',
            ]);
        }


        return $rate;
    }

    // used In Main Function UpdateRate
    function createRateAnswers(Request $request, $assessment_id, $rate)
    {

        // Loop through the questions and create rate answers for each one
        foreach ($request->input('questions') as $question_id => $values) {

            if ($values['rate'] == 0) {
                $value_degree = Null;
            } else {
                $value_degree = $values['rate'];
            }
            $Question = Question::find($question_id);
            $the_percentage = $Question->percentage;
            $degree = $value_degree / 100;
            $actual_degree = $degree * $the_percentage;
            $note = $request->input('questions_' . $question_id . '_note');
            RateAnswer::updateOrCreate([
                'assessment_id' => $assessment_id,
                'question_id' => $question_id,
                'user_id' => $request->user_id,
                'rate_id' => $rate->id,
            ], [
                'rate' => $value_degree,
                'actual_degree' => $actual_degree,
                'note' => $note
            ]);
        }
    }

    // used In Main Function UpdateRate
    function calculateAverageRate($rate, $user_id, $assessment_id)
    {
        $total_rate = RateAnswer::whereNotNull('rate')
            ->where('user_id', $user_id)
            ->where('assessment_id', $assessment_id)
            ->sum('actual_degree');

        $count = RateAnswer::whereNotNull('rate')
            ->where('user_id', $user_id)
            ->where('assessment_id', $assessment_id)
            ->count();

        $average_rate = $count > 0 ? $total_rate / $count : 0;

        // Update the rate's average rate and save the changes
        $rate->rate = $total_rate;

        $rate->save();

    }

    public function updateRate(Request $request)
    {
//        dd($request->toArray());
        DB::beginTransaction();

        // Validate the request data
        $request->validate([
            'questions.*.rate' => 'nullable|numeric|between:0,100',
        ]);

        try {

            $assessment = Assessment::find($request->assessment_id);

            $rate = $this->createOrUpdateRate($request, $assessment);
            $this->createRateAnswers($request, $request->assessment_id, $rate);
            $this->calculateAverageRate($rate, $request->user_id, $request->assessment_id);
            DB::commit();

            return response()->json([
                'success' => true,
                'newRate' => $rate,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing the request: ' . $e->getMessage(),
            ]);
        }
    }

    public function updateRateStatus($id)
    {
        DB::beginTransaction();
        try {
            $rate = Rate::find($id);

            if ($rate) {
                $rate->update(['status' => 'published']);
            } else {
                throw new \Exception('Rate not found');
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Rate Published Successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing the request.',
            ]);
        }
    }

}
