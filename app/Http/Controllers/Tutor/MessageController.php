<?php

namespace App\Http\Controllers\Tutor;

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
        $tutor = Auth::user();
        $studentuser = StudentTutor::where('student_id',$id)->where('tutor_id',$tutor->id)->first();

        if(!$studentuser){
            return redirect()->route('tutor.index');
        }
        
        $messages = Message::where('sent_to',$tutor->id)
                            ->where('sent_by',$id)
                            ->orWhere('sent_by',$tutor->id)
                            ->where('sent_to',$id)
                            ->get();
        // dd($materials);
        return view('tutor.message.show',compact('messages','studentuser'));
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

        $tutor = Auth::user();
        $studentuser = StudentTutor::where('tutor_id',$tutor->id)->where('student_id',$request->user_id)->first();
        if(!$studentuser){
            return redirect()->route('tutor.index');
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

    public function admin_show()
    {       
        $messages = Message::where('sent_to',1)
                            ->where('sent_by',Auth::user()->id)
                            ->orWhere('sent_by',1)
                            ->where('sent_to',Auth::user()->id)
                            ->get();
        // dd($materials);
        return view('tutor.message.admin',compact('messages'));
    }

    public function admin_store(Request $request)
    {       
        $request->validate([
            'text'=> 'required|string'
        ]);        
 
        $message = new Message;
        $message->sent_by = Auth::user()->id;
        $message->sent_to = 1;
        $message->text = $request->text;
        $message->save();

        return redirect()->back();
    }
}
