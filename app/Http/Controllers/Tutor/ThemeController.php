<?php

namespace App\Http\Controllers\Tutor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Theme;
use Auth;
use App\StudentTutor;
use Storage;

class ThemeController extends Controller
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
        $themes = Theme::where('sent_to',Auth::user()->id)->get();
        // dd($themes);
        return view('tutor.theme.index',compact('themes'));
    }

    public function show(Request $request,$id)
    {
        $theme = Theme::where('id',$id)->where('sent_to',Auth::user()->id)->firstorfail();
        // dd($themes);
        return view('tutor.theme.show',compact('theme'));
    }

    public function create(Request $request)
    {
        $user_id = '';
        $studentusers = StudentTutor::where('student_id',Auth::user()->id)->get();
        if($request->user_id){
            foreach($studentusers as $studentuser){
                if($studentuser->tutor_id == $request->user_id){
                    $user_id = $request->user_id;
                    break;
                }
            }
        }
        return view('student.theme.create',compact('studentusers','user_id'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'attachment'=> 'required|file'
        ]);

        $student = Auth::user();
        $studentuser = StudentTutor::where('tutor_id',$request->user_id)->where('student_id',$student->id)->first();
        if(!$studentuser){
            return redirect()->route('student.tutor.index');
        }

        $path = $request->file('attachment')->store('attachment');        
        $theme = new Theme;
        $theme->sent_by = Auth::user()->id;
        $theme->sent_to = $request->user_id;
        $theme->file = $path;
        $theme->save();


        return redirect()->route('student.theme.index');
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

    public function rate(Request $request)
    {

        $request->validate([
            'theme_id' => 'required|exists:users,id',
            'rating'=> 'required|integer'
        ]);

        $theme = Theme::where('id',$request->theme_id)->where('sent_to',Auth::user()->id)->first();

        if(!$theme){
            return redirect()->route('tutor.theme.index');
        }

        $theme->rating = $request->rating;
        $theme->save();


        return redirect()->back();
    }
}
