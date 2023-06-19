<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        //for update
        $id = $this->route('user') ? $this->route('user')->id : null;
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,8}$/ix',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],
            'phone' => 'nullable|min:3|max:15',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'type' => 'required|in:employee,admin',
            'position_id' => [
                'required',
                'exists:positions,id',
            ],
        ];
    }
}
