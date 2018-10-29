<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Domain;

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
        $tutors = User::role('tutor')->get();
        return view('admin.tutor.index',compact('tutors'));
    }

    public function create()
    {
        $domains = Domain::all();
        return view('admin.tutor.create',compact('domains'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'domain_id.*' => 'required|exists:domains,id'
        ]);

        $tutor = new User;
        $tutor->name = $request->name;
        $tutor->email = $request->email;
        // $tutor->domain_id = $request->domain_id;
        $tutor->password = bcrypt($request->password);
        $tutor->save();
        $tutor->assignRole('tutor');
        $tutor->domains()->sync($request->domain_id);

        return redirect()->route('admin.tutor.index');
    }

    public function edit($id)
    {
        $domains = Domain::all();
        $tutor = User::findorfail($id);
        return view('admin.tutor.edit',compact('tutor','domains'));
    }

    public function update(Request $request,$id)
    {
        $tutor = User::findorfail($id);
        if($tutor->email == $request->email){
            $request->validate([
                'name' => 'required|string',
                'domain_id.*' => 'required|exists:domains,id'
            ]);
        }
        else{
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'domain_id.*' => 'required|exists:domains,id'
            ]);
        }       

        $tutor->name = $request->name;
        $tutor->email = $request->email;
        // $tutor->domain_id = $request->domain_id;
        if($request->password){
            $tutor->password = bcrypt($request->password);
        }
        $tutor->save();
        $tutor->domains()->sync($request->domain_id);

        return redirect()->route('admin.tutor.index');
    }

    public function destroy($id)
    {
        $tutor = User::findorfail($id);        
        $tutor->delete();

        return redirect()->route('admin.tutor.index');
    }
}
