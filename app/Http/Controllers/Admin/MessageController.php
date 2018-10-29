<?php

namespace App\Http\Controllers\Admin;

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
    

    public function show($id)
    {
        $admin = Auth::user();       
        $tutor = User::find($id);
        $messages = Message::where('sent_to',$admin->id)
                            ->where('sent_by',$id)
                            ->orWhere('sent_by',$admin->id)
                            ->where('sent_to',$id)
                            ->get();
        // dd($materials);
        return view('admin.message.show',compact('messages','tutor'));
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

        $admin = Auth::user();       
 
        $message = new Message;
        $message->sent_by = $admin->id;
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
