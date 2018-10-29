<?php

namespace App\Http\Controllers\Student;

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

class MeditationController extends Controller
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
    public function index()
    {
        $meditations = Meditation::where('student_id',Auth::user()->id)->get();
        // dd($Meditations);
        return view('student.meditation.index',compact('meditations'));
    }

    public function show($id)
    {
        $meditation = Meditation::findorfail($id);
        // dd($Meditations);
        return view('student.meditation.show',compact('meditation'));
    }

    public function create()
    {
        $studentusers = StudentTutor::where('tutor_id',Auth::user()->id)->get();
        
        // dd($students);
        return view('student.meditation.create',compact('studentusers'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'time' => 'required',
            'room' => 'required',
            'no_of_sessions' => 'required|integer',
            'domain_id' => 'required|exists:domains,id',
        ]);

        $meditation = new Meditation;
        $meditation->tutor_id = Auth::user()->id;
        $meditation->student_id = $request->user_id;
        $meditation->room = $request->room;
        $meditation->domain_id = $request->domain_id;        
        $meditation->save();

        foreach (range(1, $request->no_of_sessions) as $i) {
            $session = new Session;
            $session->time = Carbon::parse($request->time)->addWeeks($i-1);
            $session->meditation_id = $meditation->id;
            $session->save();
        }


        return redirect()->route('student.meditation.index');
    }

    public function edit($id)
    {
        $meditation = Meditation::findorfail($id);
        $studentusers = StudentTutor::where('tutor_id',Auth::user()->id)->get();

        return view('student.meditation.edit',compact('meditation','studentusers'));
    }

    public function update(Request $request,$id)
    {
        $meditation = Meditation::findorfail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'time' => 'required',
            'room' => 'required',
            'no_of_sessions' => 'required|integer',
            'domain_id' => 'required|exists:domains,id',
        ]);

        $meditation->tutor_id = Auth::user()->id;
        $meditation->student_id = $request->user_id;
        $meditation->room = $request->room;
        $meditation->domain_id = $request->domain_id;        
        $meditation->save();

        foreach($meditation->sessions as $session){
            $session->delete();
        }
        foreach (range(1, $request->no_of_sessions) as $i) {


            $session = new Session;
            $session->time = Carbon::parse($request->time)->addWeeks($i-1);
            $session->meditation_id = $meditation->id;
            $session->save();
        }

        return redirect()->route('student.meditation.index');
    }

    public function destroy($id)
    {
        $student = User::findorfail($id);        
        $student->delete();

        return redirect()->route('student.meditation.index');
    }

    public function calendar(Request $request)
    {
        $meditations = Meditation::where('student_id',Auth::user()->id)->get();
        $upcoming = [];
        foreach($meditations as $meditation){
            if(Carbon::parse($meditation->time) > Carbon::now()){
                $upcoming[] = $meditation;
            }
        }
        

        $events = [];
        if($meditations->count()) {
            foreach ($meditations as $key => $meditation) {
                foreach($meditation->sessions as $session){
                    $events[] = Calendar::event(
                        ucwords($meditation->tutor->name),
                        false,
                        new \DateTime($session->time),
                        (new \DateTime($session->time))->add(new \DateInterval('PT1H')),
                        null,
                        // Add color and link on event
                        [
                            'color' => '#3ae2ea',
                            'url' => '#',
                        ]
                    );

                    if(Carbon::parse($session->time) > Carbon::now()){
                        $upcoming[] = $session;
                    }
                }
                
            }
        }
        $latest = $upcoming[0];
        foreach($upcoming as $session){
            if(Carbon::parse($session->time) < Carbon::parse($latest->time)){
                $latest = $session;
            }
        }
        // dd($latest);
        $calendar = Calendar::addEvents($events);
        return view('student.meditation.calendar', compact('calendar','latest'));
    }

    public function confirm(Request $request,$id)
    {
        $meditation = Meditation::findorfail($id);        
        if($meditation->tutor_id != Auth::user()->id){
            return redirect()->route('tutor.meditation.index');
        }
        if(Carbon::parse($meditation->time) >= Carbon::now()){
            return redirect()->route('tutor.meditation.index');
        }
        $meditation->confirmed = 1;
        $meditation->save();

        return redirect()->route('student.meditation.index');

    }

    public function notconfirm(Request $request,$id)
    {
        $meditation = Meditation::findorfail($id);        
        if($meditation->tutor_id != Auth::user()->id){
            return redirect()->route('tutor.meditation.index');
        }
        if(Carbon::parse($meditation->time) >= Carbon::now()){
            return redirect()->route('tutor.meditation.index');
        }
        $meditation->confirmed = 2;
        $meditation->save();

        return redirect()->route('student.meditation.index');

    }
}
