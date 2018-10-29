@extends('admin.layouts.master')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Payments</h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active">Edit Payment</li>
            </ol>
        </section>

        <!-- Main content -->
        <div class="row">
            <div class="col-md-12">
                <section class="content">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title">Edit Payment</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        {!! Form::open(['route' => ['admin.payment.update',$payment->id], 'method' => 'put']) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Select Student</label>
                                            <select name="user_id" id="student" class="form-control">
                                                @foreach($students as $student)
                                                    <option value="{{ $student->id }}" @if($payment->user->id == $student->id) selected @endif>
                                                        {{ $student->name }} ( {{ $student->email }} ) 
                                                    </option>
                                                @endforeach
                                            </select>

                                            <label for="amount">Amount</label>
                                        <input type="number" class="form-control" id="amount" placeholder="Enter Amount" name="amount" value="{{ $payment->amount }}">

                                            <label for="start_date">Start Date</label>
                                            <input type="date" class="form-control" id="start_date" placeholder="Enter Start Date" name="start_date" value="{{ \Carbon\Carbon::parse($payment->start_date)->format('Y-m-d') }}">

                                            <label for="end_Date">End Date</label>
                                            <input type="date" class="form-control" id="end_date" placeholder="Enter End Date" name="end_date" value="{{ \Carbon\Carbon::parse($payment->end_date)->format('Y-m-d')  }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="domains">
                                        <div class="box-body">
                                            @foreach($payment->domains as $selecteddomain)
                                                <div class="form-group" style="border: 1px solid #e0e0e0;padding:10px;">
                                                    <label for="domain_id">Select Domain</label>
                                                    <select name="domain_id[]" id="domain_id" class="form-control">
                                                        <option value="">Select Domain</option>
                                                        @foreach($domains as $domain)
                                                            <option value="{{ $domain->id }}" @if($domain->id == $selecteddomain->id) selected @endif>{{ ucwords($domain->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="no_of_meditations">No. of Meditations</label>
                                                <input type="number" class="form-control" id="no_of_meditations" placeholder="Enter No of Meditations" name="no_of_meditations[]" value="{{ $selecteddomain->pivot->total_no_of_meditations }}">
                                                </div>
                                            @endforeach                                            
                                        </div>
                                    </div>                                    
                                    <div style="text-align:right;padding-right:10px">
                                        <button class="btn btn-default" id="adddomainbutton">Add More Domains</button>
                                    </div>                                  

                                </div>                           
                            
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a type="submit" class="btn btn-default" href="{{ route('admin.payment.index') }}">Cancel</a>

                            </div>
                        </form>
                    </div>    

                </section>
            </div>
        </div>
        
        <!-- /.content -->
    </div>

@endsection

@section('styles')    

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">   

@endsection

@section('scripts')

    <script>
        $( document ).ready(function() {
            $("#adddomainbutton").click(function (e) {
                e.preventDefault();
                console.log('test');
                $("#domains").append('<div class="box-body"><div class="form-group" style="border: 1px solid #e0e0e0;padding:10px;"><label for="domain_id">Select Domain</label><select name="domain_id[]" id="domain_id" class="form-control"><option value="">Select Domain</option> @foreach($domains as $domain) <option value="{{ $domain->id }}">{{ $domain->name }}</option> @endforeach </select><label for="no_of_meditations">No. of Meditations</label><input type="number" class="form-control" id="no_of_meditations" placeholder="Enter No of Meditations" name="no_of_meditations[]"></div></div>');
            });
        });                                    
    </script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $( function() {
        $( "#start_date" ).datepicker({ dateFormat: 'yy-mm-dd'});
        $( "#end_date" ).datepicker({ dateFormat: 'yy-mm-dd'});
    } );
    </script>

@endsection