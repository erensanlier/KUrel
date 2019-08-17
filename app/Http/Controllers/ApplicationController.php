<?php

namespace App\Http\Controllers;

use App\Mail\Rejection;
use App\Mail\RequestVerify;
use App\Rules\KUMail;
use App\Rules\TimePick;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    public function rejection(){

        return view('application.rejectionsender');
    }

    public function rejectionSend()
    {

        $data = request()->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:requests', new KUMail],
            'name' => ['required', 'string', 'max:255'],
        ]);

        /*send mail here as /verify/{id}/{token}**-*-*/
        try {
            Mail::to($data['email'])
                ->send(new Rejection($data['name']));
            $msg = 'Rejection mail sended';
            return view('alert', ['msg' => $msg, 'type' => 'success']);
        } catch (\Exception $exception) {
            $msg = 'Something wrong happened with your request, please fill in the form again';
            return view('alert', ['msg' => $msg, 'type' => 'danger']);
        }
    }

}
