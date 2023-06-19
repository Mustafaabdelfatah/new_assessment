<?php

namespace App\Http\Requests;

use App\Rules\EmployeeIds;
use Illuminate\Foundation\Http\FormRequest;

class AssessmentRequest extends FormRequest
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
            'title' => 'required|string|min:2|max:250|regex:/^[\pL\s\-]+$/u',
            'type' =>'required|in:monthly,three_month,six_month,1_year',
            'manager_id' =>'required|numeric|exists:users,id',
            'employee_ids' => ['required', new EmployeeIds()],
            'start_date' => 'required',
            'to_date' => 'nullable',
            'time' => 'nullable',
        ];
    }


}
