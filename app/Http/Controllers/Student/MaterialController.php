<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Material;
use Auth;
use App\StudentTutor;
use Storage;

class MaterialController extends Controller
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
        $materials = Material::where('sent_to',Auth::user()->id)->get();
        // dd($materials);
        return view('student.material.index',compact('materials'));
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
        return view('student.material.create',compact('studentusers','user_id'));
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
        $material = new Material;
        $material->sent_by = Auth::user()->id;
        $material->sent_to = $request->user_id;
        $material->file = $path;
        $material->save();


        return redirect()->route('student.material.index');
    }

    public function edit($id)
    {
        $student = User::findorfail($id);
        return view('student.student.edit',compact('student'));
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
        $student = User::findorfail($id);        
        $student->delete();

        return redirect()->route('student.student.index');
    }

    public function download(Request $request)
    {
        $material = Material::where('file',$request->attachment)->firstorfail();

        return Storage::download($request->attachment);
    }
}
