<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\StudentTutor;

class TutorController extends Controller
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
        $tutors = [];
        $student= Auth::user();
        $studenttutors = StudentTutor::where('student_id',$student->id)->get();
        foreach($studenttutors as $studenttutor){
            $tutors[] = $studenttutor->tutor;
        }
        return view('student.tutor.index',compact('tutors'));
    }

    public function create()
    {
        $tutor = Auth::user();
        $domains = $tutor->domains->pluck('id')->toArray();     
        $filterstudents = [];
        $students = User::role('student')->get();
        foreach($students as $student){
            foreach($student->payments as $payment){
                foreach($payment->domains as $domain){
                    if (in_array($domain->id, $domains)){
                        $filterstudents[] = $student;
                    }
                }
            }
        }

        $students = $filterstudents;
        $students = array_unique($students);
        // dd($students);
        return view('tutor.student.create',compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $tutor = Auth::user();
        $studentuser = StudentTutor::where('tutor_id',$tutor->id)->where('student_id',$request->user_id)->first();
        if(!$studentuser){
            $studentuser = new StudentTutor;
            $studentuser->student_id = $request->user_id;
            $studentuser->tutor_id = $tutor->id;
            $studentuser->save();
        }      


        return redirect()->route('tutor.student.index');
    }

    public function edit($id)
    {
        $student = User::firstorfail($id);
        return view('tutor.student.edit',compact('student'));
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

        return redirect()->route('tutor.student.index');
    }

    public function destroy($id)
    {
        $student = User::findorfail($id);        
        $student->delete();

        return redirect()->route('tutor.student.index');
    }
}
