<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmployeeIds implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $hasAllOption = in_array('all', $value);
        $hasSpecificEmployees = count($value) > 1 || ($value[0] !== 'all' && count($value) === 1);

        return !$hasAllOption || ($hasAllOption && !$hasSpecificEmployees);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return [
            'employee_ids[]'=> 'Please select "All" or specific employees, but not both.',
        ];
    }
}
