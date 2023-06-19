<?php

namespace App\Http\Controllers\Dashboard;
use Carbon\Carbon;
use App\Models\User;
use App\Services\UserService;
use App\Enums\UsersTypesEnums;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $user_data = User::with('position')->whereNot('type', UsersTypesEnums::ADMIN)->find($user->id);
        $userId = auth()->id();
        $user_service = new UserService($user);
        $firstQuarter =  $user_service->getQuarterlyAverageRates($userId, Carbon::parse('January 1')->startOfQuarter(), Carbon::parse('March 31')->endOfQuarter());
        $secondQuarter =  $user_service->getQuarterlyAverageRates($userId, Carbon::parse('April 1')->startOfQuarter(), Carbon::parse('June 30')->endOfQuarter());
        $thirdQuarter =  $user_service->getQuarterlyAverageRates($userId, Carbon::parse('July 1')->startOfQuarter(), Carbon::parse('September 30')->endOfQuarter());
        $lastQuarter =  $user_service->getQuarterlyAverageRates($userId, Carbon::parse('October 1')->startOfQuarter(), Carbon::parse('December 31')->endOfQuarter());
        return view('layout.master', get_defined_vars());
    }

}