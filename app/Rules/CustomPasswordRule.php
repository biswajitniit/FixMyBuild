<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CustomPasswordRule implements Rule
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
        $hasUpperCase = preg_match('/[A-Z]/', $value);
        $hasLowerCase = preg_match('/[a-z]/', $value);
        $hasDigit = preg_match('/\d/', $value);
        $hasSpecialChar = preg_match('/\W/', $value);

        return $hasUpperCase && $hasLowerCase && $hasDigit && $hasSpecialChar && strlen($value) >= 8 && strlen($value) <= 32;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must meet the following password requirements: Password should be min 8 characters and max 32 characters; Password should contain at least one upper case letter; Password should contain at least one lower case letter; Password should contain at least one special character; Password should contain at least one digit';
    }
}
