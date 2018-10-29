<?php

namespace App\Http\Controllers\Tutor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Comment;
use App\Theme;
use Auth;
use App\StudentTutor;
use Storage;

class CommentController extends Controller
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


    public function store(Request $request)
    {

        $request->validate([
            'text' => 'required',
            'theme_id' => 'required'
        ]);

        $theme = Theme::where('id',$request->theme_id)->where('sent_to',Auth::user()->id)->first();

        if(!$theme){
            return redirect()->route('tutor.theme.index');
        }
     
        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->theme_id = $theme->id;
        $comment->text = $request->text;
        $comment->save();

        return redirect()->route('tutor.theme.show',['id'=>$theme->id]);
    }

    public function edit($id)
    {
        // $student = User::findorfail($id);
        // return view('student.theme.edit',compact('student'));
    }

    public function update(Request $request,$id)
    {
        $student = User::findorfail($id);
        if($student->email == $request->email){
            $request->validate([
                'name' => 'required|string'
            ]);
        }
        else{
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
            ]);
        }       

        $student->name = $request->name;
        $student->email = $request->email;
        if($request->password){
            $student->password = bcrypt($request->password);
        }
        $student->save();

        return redirect()->route('student.student.index');
    }

    public function destroy($id)
    {
        // $student = User::findorfail($id);        
        // $student->delete();

        // return redirect()->route('student.student.index');
    }

    public function download(Request $request)
    {
        $theme = Theme::where('file',$request->attachment)->firstorfail();

        return Storage::download($request->attachment);
    }
}
