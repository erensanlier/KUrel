<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function status(){

        $walkin = 'walk-in.txt';
        $status = file_get_contents($walkin);
        if ($status){
            $status = "0";
            file_put_contents($walkin, $status);
        }
        else{
            $status = "1";
            file_put_contents($walkin, $status);
        }

        return redirect('/');
    }

    public function play(){

        return view('play');
    }
}
