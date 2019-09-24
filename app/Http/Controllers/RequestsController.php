<?php

namespace App\Http\Controllers;

use App\Mail\RequestDeleted;
use App\Mail\RequestTakenMail;
use App\Mail\RequestVerify;
use App\Notifications\RequestTaken;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use App\Notifications\RequestMade;
use App\Request;
use App\Rules\KUMail;
use App\Rules\TimePick;
use App\User;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;use Illuminate\Support\Str;

class RequestsController extends Controller
{
    protected $now;

    /**
     * Shows pending requests *policy handled in routes*
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $requests = Request::where('taken_by', null)->where('verified', true)->orderBy('startTime', 'asc')->get();
        return view('request.index', compact('requests'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Request create form for students
     */
    public function create(){

        return view('request.create');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Stores created request form
     */
    public function store(){

        $data = request()->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:requests', new KUMail],
            'course' => ['required', 'string', 'max:255'],
            'reason' => ['required', 'string',],
            'startTime' => ['required', 'string', new TimePick],
            'notes' =>  ['required', 'string',],
        ]);


        $req = new Request();
        $req->email = $data['email'];
        $req->course = $data['course'];
        $req->reason = $data['reason'];
        $req->startTime = new Carbon($data['startTime']);
        if(Carbon::now()->isAfter($req->startTime)){
            $req->startTime->addDay();
        }
        $req->notes = $data['notes'];
        $req->token = Str::random(32);
        $req->save();

        /*send mail here as /verify/{id}/{token}**-*-*/
        try {
            Mail::to($req->email)
                ->send(new RequestVerify($req));
            $msg = 'Please check your inbox to verify your request';
            return view('alert', ['msg' => $msg, 'type' => 'info']);
        } catch (\Exception $exception) {
            $req->delete();
            $msg = 'Something wrong happened with your request, please fill in the form again';
            return view('alert', ['msg' => $msg, 'type' => 'danger']);
            //Delete request and redirect to fail
        }

    }

    public function verify(Request $request, $token){

        if($request->verified){
            $msg = 'The request is already verified, we will mail you as soon as a SL takes your request';
            return view('alert', ['msg' => $msg, 'type' => 'danger']);
        }else{
            if($request->token == $token) {
                if(Carbon::now()->isAfter($request->created_at->addMinutes(16))){
                    $msg = 'Your request has been expired, please create a new request';
                    $request->delete();
                    return view('alert', ['msg' => $msg, 'type' => 'danger']);
                }else{
                    $request->verified = 1;
                    $request->notify(new RequestMade());
                    $request->save();
                    $msg = 'Your request has been received successfully, we will mail you when an available SL takes it';
                    return view('alert', ['msg' => $msg, 'type' => 'success']);
                }

            }else{
                $msg = 'Wrong token for the selected request. You can do better...';
                return view('alert', ['msg' => $msg, 'type' => 'warning']);
            }
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Detailed view of a request *policy handled in routes*
     */
    public function show(Request $request){
        return view('request.show', compact('request'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * Edit requests form
     */
    public function edit(Request $request){
        $this->authorize('update', $request);

        return view('request.edit', compact('request'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Stores edit form
     */
    public function update(Request $request){

        $data = request()->validate([
            'email' => ['required', 'string', 'email', 'max:255', new KUMail],
            'course' => ['required', 'string', 'max:255'],
            'reason' => ['required', 'string',],
            'startTime' => ['required', 'string'],
            'notes' =>  [],
            'taken_by' => [],
        ]);

        $request->update($data);

        return redirect("/request/{$request->id}");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * Updates requests taken_by related to authorized user's name and taken_place
     */
    public function take(Request $request){

        if($request->taken_by == null){
            $request->taken_by = auth()->user()->name;
            $request->save();

            $request->notify(new RequestTaken());

            //Sending mail to student
            try {
                Mail::to($request->email)
                    ->cc('comp130-slcs-group@ku.edu.tr')
                    ->send(new RequestTakenMail($request));
                $msg = 'Appointment is set, you can check it in My Appointments Section. Student has been informed as well';
                return view('alert', ['msg' => $msg, 'type' => 'success']);
            } catch (\Exception $exception) {
                $msg = 'Appointment is set, but something wrong happened with mail notification, please inform the student by yourself!';
                return view('alert', ['msg' => $msg, 'type' => 'warning']);
            }
        }else{
            return view('alert', ['msg' => 'Request is already taken, please contact the coordinators if you think something is wrong', 'type' => 'warning']);
        }


    }

    public function done(Request $request){

        $this->authorize('softUpdate', $request);

        if(auth()->user()->name == $request->taken_by || auth()->user()->role == 'slc'){
            if($request->taken_place == false){
                $request->taken_place = true;
                $request->save();
                return redirect()->back();
            }else{
                $msg = "Appointment is already marked as done!";
                return view('alert', [
                    'msg' => $msg,
                    'type' => 'warning'
                ]);
            }
        }else{
            $msg = "You can't complete someone else's request!";
            return view('alert', [
                'msg' => $msg,
                'type' => 'danger'
            ]);
        }


    }

    public function undone(Request $request){

        $this->authorize('softUpdate', $request);

        if(auth()->user()->name == $request->taken_by || auth()->user()->role == 'slc'){
            if($request->taken_place == true){
                $request->taken_place = false;
                $request->save();
                return redirect()->back();
            }else{
                $msg = "Appointment is already marked as undone!";
                return view('alert', [
                    'msg' => $msg,
                    'type' => 'warning'
                ]);
            }
        }else{
            $msg = "You can't undone someone else's request!";
            return view('alert', [
                'msg' => $msg,
                'type' => 'danger'
            ]);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * To see own appointments *policy handled in routes*
     */
    public function appointments(){

        $requests = Request::where('taken_by', auth()->user()->name)->where('verified', true)->get();
        return view('request.appointments', compact('requests'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * To see ALL appointments
     */
    public function all(){

        $this->authorize('SLC', Request::class);

        $requests = Request::where('verified', true)->get();
        return view('request.all', compact('requests'));
    }

    //SADECE VERIFIED OLAN REQUESTLERI GOSTERMENIN YOLUNU BUL!

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * To see someone's appointments
     */
    public function appointmentsOf(User $user){

        $this->authorize('SLC', Request::class);

        $requests = Request::where('taken_by', $user->name)->where('verified', true)->get();
        return view('request.appointmentsOf', compact('requests'),  compact('user'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     *
     * To delete a particular request
     */
    public function delete(Request $request){

        $this->authorize('SLC', Request::class);

        try {
            $request->delete();
            Mail::to($request->email)
                ->cc('comp130-slcs-group@ku.edu.tr')
                ->send(new RequestDeleted($request));
            $msg = "The request was successfully deleted. Don't forget to contact with the student: " . $request->email;
            return view('alert', ['msg' => $msg, 'type' => 'info']);
        } catch (\Exception $exception) {
            $msg = "Request is deleted, but we couldn't inform the student. Please inform them by yourself";
            return view('alert', ['msg' => $msg, 'type' => 'danger']);
        }
    }

}
