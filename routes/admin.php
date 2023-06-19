<?php

use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use Carbon\Carbon;
use App\Models\Assessment;
use App\Http\Controllers\AdminAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\RateController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PositionController;
use App\Http\Controllers\Dashboard\QuestionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Dashboard\AssessmentController;


Route::get('clone', function () {
    $assesss1 = Assessment::with('users', 'questions', 'actions')->where(['type' => 'monthly'])
        ->whereMonth('start_date', Carbon::today()->subMonths(1))
        ->get();

});

Route::post('login', [AdminAuth::class, 'login'])->name('login');
Route::get('/logout', [AdminAuth::class, 'logout']);
Route::post('change-password', [AdminAuth::class, 'change_password'])->name('changePassword');

// forget pass
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [indexController::class, 'index']);

    Route::group(['middleware' => 'isAdmin'], function () {
        Route::resource('users', UserController::class)->except('edit', 'create', 'show');
        Route::get('/users/{id}', [UserController::class, 'getUser'])->name('users.edit');
        Route::resource('categories', CategoryController::class)->except('edit', 'create', 'show');
        Route::get('/categories/{id}', [CategoryController::class, 'getCategory'])->name('categories.edit');
        Route::resource('questions', QuestionController::class)->except('edit', 'create', 'show');
        Route::get('/questions/{id}', [QuestionController::class, 'getQuestion'])->name('questions.edit');
        Route::resource('positions', PositionController::class)->except('edit', 'create', 'show');
        Route::get('/positions/{id}', [PositionController::class, 'getPosition'])->name('positions.edit');

        Route::get('/setting', [SettingController::class, 'index'])->name('show.setting');
        Route::post('/setting', [SettingController::class, 'update'])->name('show.update');


        Route::get('/rated_users/{month?}', [ReportController::class, 'ratedUsers'])->name('show.rated_users');
    });

    // Assessment Routes
    Route::resource('assessments', AssessmentController::class)->except('edit', 'create', 'show');
    Route::get('/assessment/{id}', [AssessmentController::class, 'getAssessment'])->name('assessment.edit');
    Route::get('/get-assessManager-by-position/{positionId}', [AssessmentController::class, 'getManagerByPosition']);
    Route::get('/get-employee-tree', [AssessmentController::class, 'getEmployeeTree']);
    Route::get('/rate-assessment', [AssessmentController::class, 'rateAssessment'])->name("assessment.rate-assessment");
    Route::get('/assessment/show/{id?}/{title?}', [AssessmentController::class, 'showAssessment'])->name('show-assessment');
    Route::get('/assessment/render/{id}', [AssessmentController::class, 'assessmentRender'])->name('renderAssessmentByDate');
    Route::get('/assessment/render-question/{id}', [AssessmentController::class, 'assessmentRenderQuestion'])->name('renderAssessmentByQuestion');
    Route::get('/assessment/users/paginate', [AssessmentController::class, 'assessmentRender'])->name('PaginateAssessmentUsers');


    // assign questions to assessment
    Route::get('/assign-questions-by-category/{category}', [AssessmentController::class, 'getQuestionsByCategory']);
    Route::post('/assignQuestion/{assessmentId}', [AssessmentController::class, 'AssignQuestionToAssessment'])->name('assessment.assign');

    // Rate Routes
    Route::get('/rate-details', [RateController::class, 'rate_details'])->name('rate.rate-details');
    Route::get('/rate_assessment', [RateController::class, 'rate_assessment'])->name('rate.rate_assessment');
    Route::post('/assessment/show/update-rate', [RateController::class, 'updateRate']);
    Route::post('/assessment/rate/update-status/{id}', [RateController::class, 'updateRateStatus']);

    Route::get('/rates', [RateController::class, 'rates'])->name('rates');
    Route::get('/rate/history/{user_id}', [RateController::class, 'rates_history'])->name('rates_history');
    Route::get('/export-rates/{id}', [RateController::class, 'export_rate'])->name('export-rates');
    Route::get('/rate/details/{assessment}/{startdate}/{enddate}/{userid?}', [RateController::class, 'getRateDetails'])->name('rate.details');

    // Route::get('/export-rates', [ReportController::class, 'export_rate'])->name('export-rates');

    Route::put('/user/update-image', [UserController::class, 'update_user_image'])->name('update-image');
    Route::get('/users/show/{id}', [UserController::class, 'show_user'])->name('show_user');
    Route::post('/users/show', [UserController::class, 'show_users'])->name('show.users');


    Route::get('/', [ReportController::class, 'index'])->name('show.reports');

    Route::get('/get-dates', [ReportController::class, 'get_dates'])->name('get_dates');
    Route::get('/get-emp', [ReportController::class, 'get_emp'])->name('get_emp');
    Route::get('/get-emp-all', [ReportController::class, 'get_emp_all'])->name('get_emp_all');

    // Route::get('/actions', [indexController::class, 'actions'])->name('actions');


});
