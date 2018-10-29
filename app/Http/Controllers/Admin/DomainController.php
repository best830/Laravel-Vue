<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain;

class DomainController extends Controller
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
        $domains = Domain::all();
        return view('admin.domain.index',compact('domains'));
    }

    public function create()
    {
        return view('admin.domain.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $domain = new Domain;
        $domain->name = $request->name;
        $domain->save();

        return redirect()->route('admin.domain.index');
    }

    public function edit($id)
    {
        $domain = Domain::findorfail($id);
        return view('admin.domain.edit',compact('domain'));
    }

    public function update(Request $request,$id)
    {
        $domain = Domain::findorfail($id);
        
        $request->validate([
            'name' => 'required|string'
        ]);

        $domain->name = $request->name;
        $domain->save();

        return redirect()->route('admin.domain.index');
    }

    public function destroy($id)
    {
        $domain = Domain::findorfail($id);        
        $domain->delete();

        return redirect()->route('admin.domain.index');
    }
}
