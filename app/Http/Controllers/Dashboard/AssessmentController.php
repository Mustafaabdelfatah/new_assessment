<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\UsersTypesEnums;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssessmentRequest;
use App\Models\Assessment;
use App\Models\Category;
use App\Models\Position;
use App\Models\Question;
use App\Models\Rate;
use App\Models\RateAnswer;
use App\Models\Setting;
use App\Models\User;
use App\Repositories\PositionTreeRepositry;
use App\Services\AssessmentService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;
use PhpParser\Node\Stmt\Foreach_;

class AssessmentController extends Controller
{
    // Property For UserService
    protected $assessmentService;

    /**
     * @return Application|Factory|Construct
     */
    public function __construct(AssessmentService $assessmentService)
    {
        $this->assessmentService = $assessmentService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $deadline = Setting::where('slug', 'deadline')->first()?->desc;

        $PendingAssessment = $this->assessmentService->getPendingAssessments();
        $assessments = $this->assessmentService->index();
        return view('dashboard.pages.assessment.index', [
            'assessments' => $assessments,
            'PendingAssessment' => $PendingAssessment,
            'users' => User::select('id', 'name')->where('type', '!=', UsersTypesEnums::ADMIN)->get(),
            'positions' => Position::select('id', 'title')->get(),
            'categories' => Category::select('id', 'name')->get(),
            'deadline' => $deadline
        ]);
    }


    public function showAssessment($id, $title)
    {

        $deadline = Setting::where('slug', 'deadline')->first()?->desc;


        if (auth()->user()->AssessmentManager()->count() == 0 && auth()->user()->type == UsersTypesEnums::EMPLOYEE) {
            abort(404);
        }

        $assessment = Assessment::find($id);
        $assessmentDate = Carbon::parse($assessment->start_date)->addDays($deadline);
        $assessmentDate2 = Carbon::parse(Carbon::today());

        if ($assessmentDate2->gt($assessmentDate) && $assessment->status == 'active') {
            return view('dashboard.pages.close');
        }

        $dateByMonth = $this->assessmentService->getDateByMonth($title);
        $assessment = $this->assessmentService->getAssessmentById($id);
        $users = $this->assessmentService->getAssessmentUsersPaginated($assessment);
        return view('dashboard.pages.assessment.show_assessment', get_defined_vars());
    }

    /**
     * @param id $id
     * @return Application|Factory|View
     */
    public function assessmentRenderQuestion($id)
    {
        $assessment_question = Assessment::with('questions')->findOrFail($id);
        return view('dashboard.pages.assessment.assessment_question', get_defined_vars());
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function assessmentRender(Request $request)
    {
        $dateByMonth = $this->assessmentService->getDateByMonth($request->title);
        $assessment = $this->assessmentService->getAssessmentById($request->id);
        $users = $this->assessmentService->getAssessmentUsersPaginated($assessment);
        return view('dashboard.pages.assessment.render-assessment', get_defined_vars());

    }

    /**
     * @param id $id
     * @return Application|Factory|View
     */
    public function getAssessment($id)
    {
        $assessment = Assessment::findOrFail($id);
        $users = User::select('id', 'name')->where('type', '!=', UsersTypesEnums::ADMIN)->get();
        $positions = Position::get();
        $start_date = Carbon::parse($assessment->start_date);
        $month = $start_date->month;
        $year = $start_date->year;
        return view('dashboard.pages.assessment.edit', get_defined_vars());
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function rateAssessment(Request $request)
    {
        $assessment = Assessment::with('questions')
            ->where('id', $request->assessment_id)
            ->first();

        $answers = RateAnswer::where('user_id', $request->user_id)
            ->where('assessment_id', $request->assessment_id)
            ->where('rate_id', $request->rate_id)
            ->get()
            ->mapWithKeys(fn($i) => [$i->question_id => ['rate' => $i->rate, 'note' => $i->note]]);

        $user_id = $request->user_id;
        $rate_id = $request->rate_id;

        return view('dashboard.pages.rates.rate_assessment', get_defined_vars());
    }

    /**
     * @param position_id $position_id
     * @return JsonResponse
     */
    public function getManagerByPosition($positionId)
    {
        $users = User::where('position_id', $positionId)->pluck('name', 'id');
        return response()->json($users);
    }


    /**
     * @param UserRequest $request
     * @return Application|Factory|View
     */
    public function store(AssessmentRequest $request)
    {
        $validatedData = $request->validated();
        $assessment = $this->assessmentService->store($validatedData);

        return view('dashboard.pages.assessment.render', [
            'assessment' => $assessment,
            'create' => true,
        ]);
    }

    /**
     * @param AssessmentRequest $request
     * @param Assessment $assessment
     * @return Application|Factory|View
     */
    public function update(AssessmentRequest $request, Assessment $assessment)
    {
        $validatedData = $request->validated();
        $assessment = $this->assessmentService->update($validatedData, $assessment);

        return view('dashboard.pages.assessment.render', [
            'assessment' => $assessment,
            'create' => false,
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $assessment = Assessment::select('id')
            ->where('id', $id)
            ->withCount(['questions', 'rates'])
            ->first();

        $assessment_array = $assessment->toArray();
        unset($assessment_array['id']);
        if (max(array_values($assessment_array))) {
            return response()->json([
                'message' => trans('Unable To Delete This Assessment Because It BelongsTo Another Modules'),
            ], 403);
        }
        $assessment->delete();
        return response()->json([
            'success' => true,
            'message' => 'Assessment deleted successfully'
        ]);
    }

    /**
     * Assign Questions To Assessment
     * @param categoryId $categoryId
     * @return JsonResponse
     */
    public function getQuestionsByCategory($categoryId)
    {
        $questions = Question::whereHas('categories', function ($query) use ($categoryId) {
            $query->where('categories.id', $categoryId);
        })->pluck('title', 'id');
        return response()->json($questions);
    }

    /**
     * Assign Questions To Assessment
     * @param assessmentId $assessmentId
     */
    public function AssignQuestionToAssessment(Request $request, $assessmentId)
    {
        $request->validate([
            'question_id' => ['required', 'array'],
            'question_id.*' => ['exists:questions,id'],
        ]);
        $assessment = Assessment::findOrFail($assessmentId);
        $assessment->status = 'active';
        $assessment->save();
        $assessment->questions()->sync($request->question_id);
        // return a success response
        return response()->json([
            'assessment' => $assessment,
            'success' => true
        ]);
    }
}
