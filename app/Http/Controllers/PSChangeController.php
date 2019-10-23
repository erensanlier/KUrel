<?php

namespace App\Http\Controllers;

use App\Mail\PSChangeNotifyMail;
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
            if($req->yourPS == $req->desiredPS){
                $msg = "Your PS and Desired PS cannot be the same";
                return view('alert', ['msg' => $msg, 'type' => 'danger']);
            }else{
                $req->token = Str::random(32); // New token for validation
                $req->save();
            }
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

                    //mail corresponding SL's
                    $fromPS = $request->yourPS;
                    $toPS = $request->desiredPS;
                    $fromSL = "";
                    $toSL = "";
                    switch ($fromPS) {
                        case "COMP 111 - PS A":
                            $fromSL = "onacitarhan17@ku.edu.tr";
                            break;
                        case "COMP 130 - PS A":
                            $fromSL = "gkoldas15@ku.edu.tr";
                            break;
                        case "COMP 130 - PS B":
                            $fromSL = "hgun16@ku.edu.tr";
                            break;
                        case "COMP 130 - PS C":
                            $fromSL = "kgirenes18@ku.edu.tr";
                            break;
                        case "COMP 130 - PS D":
                            $fromSL = "missa18@ku.edu.tr";
                            break;
                        case "COMP 130 - PS E":
                            $fromSL = "bcoban17@ku.edu.tr";
                            break;
                        case "COMP 130 - PS F":
                            $fromSL = "ddemirturk18@ku.edu.tr";
                            break;
                        case "COMP 130 - PS G":
                            $fromSL = "oyasuran18@ku.edu.tr";
                            break;
                        case "COMP 130 - PS H":
                            $fromSL = "azeybek17@ku.edu.tr";
                            break;
                        case "COMP 130 - PS I":
                            $fromSL = "abayan17@ku.edu.tr";
                            break;
                        case "COMP 130 - PS J":
                            $fromSL = "ierkol18@ku.edu.tr";
                            break;
                        case "COMP 130 - PS K":
                            $fromSL = "eozsuer16@ku.edu.tr";
                            break;
                        case "COMP 130 - PS L":
                            $fromSL = "atap18@ku.edu.tr";
                            break;
                        case "COMP 130 - PS M":
                            $fromSL = "mkeskin17@ku.edu.tr";
                            break;
                        case "COMP 131 - PS A":
                            $fromSL = "edincer16@ku.edu.tr";
                            break;
                        case "COMP 131 - PS B":
                            $fromSL = "uozalp18@ku.edu.tr";
                            break;
                        case "COMP 131 - PS C":
                            $fromSL = "wbaroudi18@ku.edu.tr";
                            break;
                        case "COMP 131 - PS D":
                            $fromSL = "zoner17@ku.edu.tr";
                            break;
                        case "COMP 131 - PS E":
                            $fromSL = "lcelik17@ku.edu.tr";
                            break;
                        case "COMP 131 - PS F":
                            $fromSL = "perbil18@ku.edu.tr";
                            break;
                        case "COMP 131 - PS G":
                            $fromSL = "otas17@ku.edu.tr";
                            break;
                        case "COMP 131 - PS H":
                            $fromSL = "bsahin17@ku.edu.tr";
                            break;
                    }
                    switch ($toPS) {
                        case "COMP 111 - PS A":
                            $toSL = "onacitarhan17@ku.edu.tr";
                            break;
                        case "COMP 130 - PS A":
                            $toSL = "gkoldas15@ku.edu.tr";
                            break;
                        case "COMP 130 - PS B":
                            $toSL = "hgun16@ku.edu.tr";
                            break;
                        case "COMP 130 - PS C":
                            $toSL = "kgirenes18@ku.edu.tr";
                            break;
                        case "COMP 130 - PS D":
                            $toSL = "missa18@ku.edu.tr";
                            break;
                        case "COMP 130 - PS E":
                            $toSL = "bcoban17@ku.edu.tr";
                            break;
                        case "COMP 130 - PS F":
                            $toSL = "ddemirturk18@ku.edu.tr";
                            break;
                        case "COMP 130 - PS G":
                            $toSL = "oyasuran18@ku.edu.tr";
                            break;
                        case "COMP 130 - PS H":
                            $toSL = "azeybek17@ku.edu.tr";
                            break;
                        case "COMP 130 - PS I":
                            $toSL = "abayan17@ku.edu.tr";
                            break;
                        case "COMP 130 - PS J":
                            $toSL = "ierkol18@ku.edu.tr";
                            break;
                        case "COMP 130 - PS K":
                            $toSL = "eozsuer16@ku.edu.tr";
                            break;
                        case "COMP 130 - PS L":
                            $toSL = "atap18@ku.edu.tr";
                            break;
                        case "COMP 130 - PS M":
                            $toSL = "mkeskin17@ku.edu.tr";
                            break;
                        case "COMP 131 - PS A":
                            $toSL = "edincer16@ku.edu.tr";
                            break;
                        case "COMP 131 - PS B":
                            $toSL = "uozalp18@ku.edu.tr";
                            break;
                        case "COMP 131 - PS C":
                            $toSL = "wbaroudi18@ku.edu.tr";
                            break;
                        case "COMP 131 - PS D":
                            $toSL = "zoner17@ku.edu.tr";
                            break;
                        case "COMP 131 - PS E":
                            $toSL = "lcelik17@ku.edu.tr";
                            break;
                        case "COMP 131 - PS F":
                            $toSL = "perbil18@ku.edu.tr";
                            break;
                        case "COMP 131 - PS G":
                            $toSL = "otas17@ku.edu.tr";
                            break;
                        case "COMP 131 - PS H":
                            $toSL = "bsahin17@ku.edu.tr";
                            break;
                    }

                    Mail::to($fromSL)
                        ->send(new PSChangeNotifyMail($request));
                    Mail::to($toSL)
                        ->send(new PSChangeNotifyMail($request));

                    return view('alert', ['msg' => $msg, 'type' => 'success']);
                }

            }else{
                $msg = 'Wrong token for the selected request. You can do better...';
                return view('alert', ['msg' => $msg, 'type' => 'warning']);
            }
        }
    }
}
