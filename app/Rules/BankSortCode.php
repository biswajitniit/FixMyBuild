<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BankSortCode implements Rule
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
        if (!is_array($value) || count($value) != 3) {
            return false;
        }
        $concatenatedString = implode('', $value);
        return preg_match('/^\d{6}$/', $concatenatedString) === 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid sort code. Sort Code must be 6 digits longer.';
    }
}
