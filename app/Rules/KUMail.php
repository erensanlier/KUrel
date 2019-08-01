<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class KUMail implements Rule
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
        $domain_name = substr(strrchr($value, "@"), 1);
        return $domain_name == "ku.edu.tr";
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please enter KU associated email address';
    }
}
