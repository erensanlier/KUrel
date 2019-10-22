<?php

namespace App\Rules;

use App\Request;
use Illuminate\Contracts\Validation\Rule;

class NewRequestRule implements Rule
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
        $temp = Request::where('email', $value)->where('verified', true)->where('taken_by', null)->get();
        if(count($temp) == 1){
           return true;
        }


        $requests = Request::where('email', $value)->where('taken_place', false)->get();
        return sizeof($requests) == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You have a previous request which is not completed. If you think there is an error, contact us!';
    }
}
