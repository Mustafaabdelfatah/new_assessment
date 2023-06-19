<?php

namespace App\Services;

use App\Models\Assessment;
use App\Models\Position;
use App\Models\User;
use App\Repositories\PositionTreeRepositry;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Location;

class AssessmentService
{

    private $model;

    public function __construct(Assessment $model)
    {
        $this->model = $model;
    }

    public function getPendingAssessments()
    {
        return Assessment::where(function ($query) {
            $query->whereDoesntHave('rates')
                ->orWhereHas('rates', function ($query) {
                    $query->where('status', 'pending');
                });
        })
            ->where('manager_id', auth()->user()->id)
            ->where('status', '!=', 'pending')
            ->orderBy('id', 'desc')
            ->pluck('start_date')
            ->map(function ($date) {
                return \Illuminate\Support\Carbon::parse($date)->format('d-m-Y');
            })
            ->toArray();
    }

    public function index()
    {
        return auth()->user()->AssessmentManager()->count() > 0 ?
            Assessment::with(['rates', 'questions', 'users'])
                ->where('manager_id', auth()->user()->id)
                ->where('status', '!=', 'pending')
                ->orderBy('id', 'desc')
                ->withCount(['questions', 'users'])
                ->get()
                ->groupBy('title')
                ->map(function ($group) {
                    $assessment = $group->first();
                    $total_users_count = $assessment->users()->count();
                    $rated_users_count = $assessment->rates()
                        ->whereNotNull('rate')
                        ->where('status', 'published')
                        ->distinct('user_id')
                        ->count('user_id');
                    $assessment->percentage_rated = $total_users_count ? ($rated_users_count / $total_users_count) * 100 : 0;
                    return $assessment;
                })
            :
            Assessment::with('manager')->orderBy('id', 'desc')->get();
    }

    public function getEmployee($data)
    {

        if ($data['choose_employee'] == 'direct_employee') {
            $position = Position::find($data['position_id'])->child_positions()->pluck('id')->toArray();
            $employee = User::whereIn('position_id', $position)->pluck('name', 'id');

        } else {
            $position = Position::orderBy('parent_id', 'asc')->get();
            $treeRepoIds = PositionTreeRepositry::make($position, $data['position_id']);
            $employee = User::whereIn('position_id', $treeRepoIds['ids'])->pluck('name', 'id');
        }

        return $employee;
    }

    public function getDate($data)
    {

        switch ($data['type']) {
            case 'monthly':
                $startOfDate = Carbon::createFromFormat('m-Y', $data['start_date'])->startOfMonth();
                $endOfDate = $startOfDate->copy()->endOfMonth();
                $data['time'] = 1;
                break;
            case 'three_month':
                $startOfDate = Carbon::createFromFormat('m-Y', $data['start_date'])->startOfMonth();
                $endOfDate = $startOfDate->copy()->addMonths(2)->endOfMonth();
                $data['time'] = 3;
                break;
            case 'six_month':
                $startOfDate = Carbon::createFromFormat('m-Y', $data['start_date'])->startOfMonth();
                $endOfDate = $startOfDate->copy()->addMonths(5)->endOfMonth();
                $data['time'] = 6;
                break;
            case '1_year':
                $startOfDate = Carbon::createFromFormat('m-Y', $data['start_date'])->startOfMonth();
                $endOfDate = $startOfDate->copy()->addYear(1)->endOfMonth();
                $data['time'] = 12;
                break;
        }
        return ['startDate' => $startOfDate, 'endDate' => $endOfDate, 'time' => $data['time']];
    }

    public function getLastDate($subscriptionDates)
    {

        $startOfDate = $subscriptionDates['startDate'];
        $endOfDate = $subscriptionDates['endDate'];
        $time = $subscriptionDates['time'];
        $date['start_date'] = $startOfDate->format('Y-m-d');
        $date['to_date'] = $endOfDate->format('Y-m-d');
        $date['time'] = $time;

        return $date;
    }

    public function getDateByMonth($title)
    {
        return Assessment::select('id', 'start_date', 'title')
            ->where('title', $title)
            ->get();
    }

    public function getAssessmentById($id)
    {
        return Assessment::with('questions', 'users', 'answers.user', 'manager', 'rates')
            ->withCount(['questions', 'users'])
            ->findOrFail($id);
    }

    public function getAssessmentUsersPaginated($assessment, $perPage = 10)
    {
        return $assessment->users()->paginate($perPage);
    }


    public function store(array $data)
    {
        $subscriptionDates = $this->getDate($data);
        $date = $this->getLastDate($subscriptionDates);
        $data['status'] = 'pending';
        $data = array_merge($data, $date);
        $data['slug'] = strtolower(str_replace(' ', '-', $data['title']));
        $assessment = Assessment::create(Arr::except($data, ['employee_ids']));
        if ($data['employee_ids'][0] == 'all') {
            $employeeCollection = $this->getEmployee($data);
            $data['employee_ids'] = $employeeCollection->keys()->toArray();
        }
        $assessment->users()->attach($data['employee_ids']);

        return $assessment;
    }

    public function update(array $data, $assessment)
    {
        $subscriptionDates = $this->getDate($data);
        $date = $this->getLastDate($subscriptionDates);
        $data = array_merge($data, $date);
        $assessment->fill($data);
        $assessment->save();

        if ($data['employee_ids'][0] == 'all') {
            $employeeCollection = $this->getEmployee($data);
            $data['employee_ids'] = $employeeCollection->keys()->toArray();
        }
        $assessment->users()->sync($data['employee_ids']);
        return $assessment;
    }


}
