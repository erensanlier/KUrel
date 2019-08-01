<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class TimePick implements Rule
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
        //if selected time is before
        $control = new Carbon($value);
        if(Carbon::now()->isAfter($control)){
            $control->addDay();
        }
        $control->addHours(-3);
        return !Carbon::now()->isAfter($control);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You can pick a time for next 24 hours, except within 3 hours from now!';
    }
}
