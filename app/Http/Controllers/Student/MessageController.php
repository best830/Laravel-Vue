<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Message;
use Auth;
use App\StudentTutor;
use Storage;

class MessageController extends Controller
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
        
    }

    public function show($id)
    {
        $student = Auth::user();
        $studentuser = StudentTutor::where('tutor_id',$id)->where('student_id',$student->id)->first();

        if(!$studentuser){
            return redirect()->route('student.index');
        }
        
        $messages = Message::where('sent_to',$student->id)
                            ->where('sent_by',$id)
                            ->orWhere('sent_by',$student->id)
                            ->where('sent_to',$id)
                            ->get();
        // dd($materials);
        return view('student.message.show',compact('messages','studentuser'));
    }

    public function create(Request $request)
    {
        
    }

    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'text'=> 'required|string'
        ]);

        $student = Auth::user();
        $studentuser = StudentTutor::where('tutor_id',$request->user_id)->where('student_id',$student->id)->first();
        if(!$studentuser){
            return redirect()->route('student.tutor.index');
        }
 
        $message = new Message;
        $message->sent_by = Auth::user()->id;
        $message->sent_to = $request->user_id;
        $message->text = $request->text;
        $message->save();

        return redirect()->back();
    }

    public function edit($id)
    {
       
    }

    public function update(Request $request,$id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
