<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Domain;
use App\Payment;
use Carbon\Carbon;

class PaymentController extends Controller
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
    public function index(Request $request)
    {
        if($request->student_id && $request->expired){
            $payments = Payment::where('user_id',$request->student_id)
                                ->where('end_date', '<', Carbon::now()->toDateTimeString())->get();
        }
        elseif($request->student_id){
            $payments = Payment::where('user_id',$request->student_id)->get();
        }
        elseif($request->expired){
            $payments = Payment::where('end_date', '<', Carbon::now()->toDateTimeString())->get();
        }
        else{
            $payments = Payment::all();
        }
        return view('admin.payment.index',compact('payments'));
    }

    public function create()
    {
        $domains = Domain::all();
        $students = User::role('student')->get();
        return view('admin.payment.create',compact('domains','students'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'start_date' => 'required',
            'end_date' => 'required',
            'amount' => 'required|integer',
            'domain_id.*' => 'required|exists:domains,id',
            'no_of_meditations.*' => 'required|integer',
        ]);

        
        $payment = new Payment;
        $payment->start_date = $request->start_date;
        $payment->end_date = $request->end_date;
        $payment->amount = $request->amount;
        $payment->user_id = $request->user_id;
        $payment->save();

        // $domains = Domain::where('id', $request->domain_id)->get();
        // $payment->domains()->attach($domains);
        foreach($request->domain_id as $key => $id){
            $domain = Domain::find($id);
            $payment->domains()->save($domain, 
                                    [
                                    'total_no_of_meditations' => $request->no_of_meditations[$key],
                                    'remaining_no_of_meditations' => $request->no_of_meditations[$key],
                                    ]
                                );
        }
        
        // $payment->assignRole('payment');
        // $payment->domains()->sync($request->domain_id);

        return redirect()->route('admin.payment.index');
    }

    public function edit($id)
    {
        $domains = Domain::all();
        $students = User::role('student')->get();
        $payment = Payment::find($id);
        return view('admin.payment.edit',compact('domains','students','payment'));
    }

    public function update(Request $request,$id)
    {
        $payment = Payment::findorfail($id);
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'start_date' => 'required',
            'end_date' => 'required',
            'amount' => 'required|integer',
            'domain_id.*' => 'required|exists:domains,id',
            'no_of_meditations.*' => 'required|integer',
        ]);
        
        $payment->start_date = $request->start_date;
        $payment->end_date = $request->end_date;
        $payment->amount = $request->amount;
        $payment->user_id = $request->user_id;
        $payment->save();

        // $domains = Domain::where('id', $request->domain_id)->get();
        // $payment->domains()->attach($domains);
        $myarray = [];
        foreach($request->domain_id as $key => $id){
            $myarray[$id] = [
                'total_no_of_meditations' => $request->no_of_meditations[$key],
                'remaining_no_of_meditations' => $request->no_of_meditations[$key]
            ];
        }
        $payment->domains()->sync($myarray);        

        return redirect()->route('admin.payment.index');
    }

    public function destroy($id)
    {
        $tutor = User::findorfail($id);        
        $tutor->delete();

        return redirect()->route('admin.tutor.index');
    }
}
