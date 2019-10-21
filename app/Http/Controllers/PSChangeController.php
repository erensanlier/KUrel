<?php

namespace App\Http\Controllers;

use App\Mail\PSChangeVerify;
use App\PSChange;
use App\Request;
use App\Rules\KUMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class PSChangeController extends Controller
{
    public function create(){

        return view('pschange.create');
    }

    public function store(){

        $data = request()->validate([
            'email' => ['required', 'string', 'email', 'max:255', new KUMail],
            'yourPS' => ['required', 'string', 'max:255'],
            'desiredPS' => ['required', 'string', 'max:255'],
        ]);

        // Create new request with given data
        $temp = PSChange::where('email', $data['email'])->where('verified', true)->get();

        if(count($temp)<2){
            $req = new PSChange();
            $req->email = $data['email'];
            $req->yourPS = $data['yourPS'];
            $req->desiredPS = $data['desiredPS'];
            $req->token = Str::random(32); // New token for validation
            $req->save();
        }else{
            $msg = 'You have no remaining PS Changes left!';
            return view('alert', ['msg' => $msg, 'type' => 'danger']);
        }




        /*send mail here as /verify/{id}/{token}**-*-*/
        try {
            Mail::to($req->email)
                ->send(new PSChangeVerify($req));
            $msg = 'Please check your inbox to verify your request';
            return view('alert', ['msg' => $msg, 'type' => 'info']);
        } catch (\Exception $exception) {
            $req->delete();
            $msg = 'Something wrong happened with your request, please fill in the form again';
            return view('alert', ['msg' => $msg, 'type' => 'danger']);
            //Delete request and redirect to fail
        }


    }

    public function verify(PSChange $request, $token){
        if($request->verified){
            $msg = 'The request is already verified.';
            return view('alert', ['msg' => $msg, 'type' => 'danger']);
        }else{
            if($request->token == $token) {
                if(Carbon::now()->isAfter($request->created_at->addMinutes(16))){
                    $msg = 'Your request has been expired, please create a new request';
                    $request->delete();
                    return view('alert', ['msg' => $msg, 'type' => 'danger']);
                }else{
                    $request->verified = 1;
                    $request->save();
                    $msg = 'Your request has been received successfully!';
                    return view('alert', ['msg' => $msg, 'type' => 'success']);
                }

            }else{
                $msg = 'Wrong token for the selected request. You can do better...';
                return view('alert', ['msg' => $msg, 'type' => 'warning']);
            }
        }
    }
}
