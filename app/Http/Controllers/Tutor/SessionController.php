<?php

namespace App\Http\Controllers\Tutor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Meditation;
use App\Session;
use Auth;
use App\StudentTutor;
use Storage;
use Carbon\Carbon;
use Calendar;

class SessionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */  

    

    public function confirm(Request $request,$id)
    {
        $session = Session::findorfail($id);        
        if($session->meditation->tutor_id != Auth::user()->id){
            return redirect()->route('tutor.meditation.index');
        }
        if(Carbon::parse($session->time) >= Carbon::now()){
            return redirect()->route('tutor.meditation.index');
        }
        $session->confirmed = 1;
        $session->save();

        $data = $session->meditation->payment->domains->where('id', $session->meditation->domain_id)->first();
        $data->pivot->remaining_no_of_meditations = $data->pivot->remaining_no_of_meditations - 1;
        $data->pivot->save();
        // dd($data->pivot->remaining_no_of_meditations);
        return redirect()->back();

    }

    public function notconfirm(Request $request,$id)
    {
        $session = Session::findorfail($id);        
        if($session->meditation->tutor_id != Auth::user()->id){
            return redirect()->route('tutor.meditation.index');
        }
        if(Carbon::parse($session->time) >= Carbon::now()){
            return redirect()->route('tutor.meditation.index');
        }
        $session->confirmed = 2;
        $session->save();

        return redirect()->back();

    }

    public function show($id)
    {
        $session = Session::with('meditation.student')->findorfail($id);
        // dd($sessions);
        return response()->json(['session'=>$session,'time' => \Carbon\Carbon::parse($session->time)->format('l, d F, Y, H:i')]);
    }
}
