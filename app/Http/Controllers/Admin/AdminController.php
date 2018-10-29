<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Domain;
use App\Payment;

class AdminController extends Controller
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
        $students = User::role('student')->count();
        $tutors = User::role('tutor')->count();
        $payments = Payment::count();
        $domains = Domain::count();
        return view('admin.index',compact('students','tutors','domains','payments'));
    }
}
