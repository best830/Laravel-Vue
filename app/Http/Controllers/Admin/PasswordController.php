<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Domain;
use Auth;

class PasswordController extends Controller
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
    

    public function edit()
    {
        return view('admin.password.edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('admin.index');
    }
}
