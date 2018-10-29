<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class StudentController extends Controller
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
        $students = User::role('student')->get();
        return view('admin.student.index',compact('students'));
    }

    public function create()
    {
        return view('admin.student.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        $student = new User;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = bcrypt($request->password);
        $student->save();
        $student->assignRole('student');

        return redirect()->route('admin.student.index');
    }

    public function edit($id)
    {
        $student = User::findorfail($id);
        return view('admin.student.edit',compact('student'));
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

        return redirect()->route('admin.student.index');
    }

    public function destroy($id)
    {
        $student = User::findorfail($id);        
        $student->delete();

        return redirect()->route('admin.student.index');
    }
}
