<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'assessment_id' => 'required|numeric|exists:assessments,id',
            'questions.*' => 'required',
            'questions.*.question_id' => 'required|numeric|exists:questions,id',
            'questions.*.note' => 'sometimes|string|max:255|nullable',
            'questions.*.rate' => 'nullable|numeric|min:0|max:100',
        ];
    }
}
