<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneWithDialCode implements Rule
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
        $phone_office = str_replace('-', '', str_replace(' ', '', substr($value,1,-1)));
        return (is_numeric($phone_office) && $value[0] == '+');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid phone number with dial code.';
    }
}
