<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Rate;
use App\Models\User;
use App\Models\Assessment;
use App\Models\AssessmentUser;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class unRatesExport implements FromView
{


    protected $month;

    public function __construct($month)
    {
        $this->month = $month;
    }

    public function view(): View
    {
        $month = $this->month ?? Carbon::today()->subMonth();
        $assessmentsIds = Assessment::whereMonth('start_date', Carbon::parse($this->month))->pluck('id')->toArray();


        $assessmentsDates = Assessment::orderBy('start_date', 'desc')->groupBy('start_date')
            ->pluck('start_date')
            ->toArray();

        $RatedUsers = AssessmentUser::with('assessment.manager', 'user','rateUser')
        ->whereHas('rateUser', function ($s) use ($assessmentsIds) {
            $s->whereIn('assessment_id', $assessmentsIds);
        })
        ->whereIn('assessment_id', $assessmentsIds)
        ->get();

        $unRatedUsers = AssessmentUser::with('assessment.manager', 'user','rateUser')->whereDoesntHave('rateUser', function ($s) use ($assessmentsIds) {
            $s->whereIn('assessment_id', $assessmentsIds);
        })->whereIn('assessment_id', $assessmentsIds)->get();
        return view('dashboard.exports.unrated-user', compact('unRatedUsers'));

    }
}
