<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CustomPasswordRegex implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $attribute;
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
        $this->attribute = $attribute;

        return preg_match('^(?=.*[a-z])(?=.*\d)[a-zA-Z0-9].{7,}$', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '8 character minimum, alphabets and numeric.';
    }
}
