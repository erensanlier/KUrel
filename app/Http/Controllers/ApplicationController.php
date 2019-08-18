<?php

namespace App\Http\Controllers;

use App\Mail\Interview;
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
            'email' => ['required', 'string', 'email', new KUMail],
            'name' => ['required', 'string', 'max:255'],
        ]);

        /*send mail here as /verify/{id}/{token}**-*-*/
        try {
            Mail::to($data['email'])
                ->send(new Rejection($data['name']));
            $msg = 'Rejection mail sended';

            $file = 'mailed.txt';
            $content = file_get_contents($file);
            $content .= $data['email'] . " Rejection Mail\n";
            file_put_contents($file, $content);

            return view('alert', ['msg' => $msg, 'type' => 'success']);
        } catch (\Exception $exception) {
            $msg = 'Something wrong happened with your request, please fill in the form again';
            return view('alert', ['msg' => $msg, 'type' => 'danger']);
        }
    }

    public function interview(){

        return view('application.interviewsender');
    }

    public function interviewSend()
    {

        $data = request()->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:requests', new KUMail],
            'name' => ['required', 'string', 'max:255'],

        ]);

        /*send mail here as /verify/{id}/{token}**-*-*/
        try {
            Mail::to($data['email'])
                ->send(new Interview($data['name']));
            $msg = 'Interview mail sended';

            $file = 'mailed.txt';
            $content = file_get_contents($file);
            $content .= $data['email'] . " Interiew Mail\n";
            file_put_contents($file, $content);

            return view('alert', ['msg' => $msg, 'type' => 'success']);
        } catch (\Exception $exception) {
            $msg = 'Something wrong happened with your request, please fill in the form again';
            return view('alert', ['msg' => $msg, 'type' => 'danger']);
        }
    }

}
