<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
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
        $positionId = $this->route('position') ? $this->route('position')->id : null;

        return [
            'title' =>[
                'required',
                'min:3',
                'max:255',
                Rule::unique('positions')->ignore($positionId)
            ],
            'parent_id' => 'nullable',


         ];
    }
}
