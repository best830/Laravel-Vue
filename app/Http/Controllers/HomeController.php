<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
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
        if(Auth::user()->hasRole('admin')){
            return redirect()->route('admin.index');
        } elseif(Auth::user()->hasRole('tutor')){
            return redirect()->route('tutor.index');
        } elseif(Auth::user()->hasRole('student')){
            return redirect()->route('student.index');
        }
        return view('home');
    }

    public function profile()
    {
        return view('profile');
    }
}
