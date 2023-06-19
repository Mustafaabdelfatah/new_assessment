<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
     /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('dashboard.pages.questions.index', [
            'questions' => Question::with('categories')
            ->orderBy('id','desc')
            ->get(),
            'categories' => Category::pluck('name', 'id')
        ]);
    }

     /**
     * @param id $id
     * @return Application|Factory|View
     */
    public function getQuestion($id)
    {
        $question = Question::with('categories')->findOrFail($id);
        $categories = Category::all();

        return view('dashboard.pages.questions.edit',compact('question' , 'categories'));
    }


    /**
     * @param QuestionRequest $request
     * @return Application|Factory|View
     */
    public function store(QuestionRequest $request)
    {

        $percentage = $request->percentage;

        foreach($request->categories as $category_id) {
            $category = Category::findOrFail($category_id);
            $sum_questions = $category->questions->sum('percentage');
            $check_sum = $percentage + $sum_questions;
            if ($check_sum > 100) {
                return response()->json(['errors'=>'The question cannot be created because the sum of the percentages exceeds 100%.',"type"=>'single'],422);

            }


        }




        $question = Question::create($request->validated());
        $question->categories()->attach($request->categories);

            return view('dashboard.pages.questions.render', [
                'question' => $question,
                'create' => true
            ]);

        }

    /**
     * @param QuestionRequest $request
     * @param Question $question
     * @return Application|Factory|View
     */
    public function update(QuestionRequest $request, Question $question)
    {

        $old_percentage = $request->old_percentage;  //the old percentage of question

        foreach($request->categories as $category_id) {
            $category = Category::findOrFail($category_id);
            $old_questions = $category->questions->where('id', '!=', $question->id); // get all questions except the current one
            $old_sum_percentage = $old_questions->sum('percentage'); //the sum value percentage of old questions
            $check_sum = $old_sum_percentage + $request->percentage; //add the new value to the net value and check
            if ($check_sum > 100) {
                return response()->json(['errors'=>'The question cannot be updated because the sum of the percentages exceeds 100%.',"type"=>'single'],422);
            }
        }
                $question->update($request->validated());
        $question->categories()->sync($request->categories);
        return view('dashboard.pages.questions.render', [
            'question' => $question,
            'create' => false
        ]);

}

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $question = Question::select('id')
            ->where('id', $id)
            ->withCount(['assessments','readAnswers'])
            ->first();


        $question_array = $question->toArray();
        unset($question_array['id']);


        if (max(array_values($question_array))) {
            return response()->json([
                'message' => trans('Unable To Delete This Question Because It BelongsTo Another Modules'),
            ], 403);
        }

        $question->delete();

        return response()->json([
            'success' => true,
            'message' => 'Question deleted successfully'
        ]);
    }
}
