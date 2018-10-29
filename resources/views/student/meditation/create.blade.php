@extends('student.layouts.master')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Meditation Session</h1>
            <ol class="breadcrumb">
                <li><a href="/tutor"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active">Add Meditation Session</li>
            </ol>
        </section>

        <!-- Main content -->
        <div class="row">
            <div class="col-md-6">
                <section class="content">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title">Add Meditation Session</h3>
                        </div>
                        <form role="form" action="{{ route('tutor.meditation.store') }}" method="POST">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="user_id">Select Student</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        @foreach($studentusers as $studentuser)
                                            <option value="{{ $studentuser->student->id }}"> {{ $studentuser->student->name }} ( {{ $studentuser->student->email }} )</option>
                                        @endforeach
                                    </select>
                                </div>                               

                                <div class="form-group">
                                    <label for="time">Select Date and Time</label>

                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='text' class="form-control" name="time" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="no_of_sessions">No. of Sessions</label>
                                    <select name="no_of_sessions" id="no_of_sessions" class="form-control">
                                        <option value="1">1</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> 
                                </div>

                                <div class="form-group">
                                    <label for="room">Room</label>  
                                    <input type="text" name="room" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="domain_id">Select Domain</label>
                                    <select name="domain_id" id="domain_id" class="form-control">
                                        @foreach(Auth::user()->domains  as $domain)
                                            <option value="{{ $domain->id }}"> {{ ucwords($domain->name) }}</option>
                                        @endforeach
                                    </select>
                                </div> 


                            </div>                            

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a type="submit" class="btn btn-default" href="{{ route('tutor.meditation.index') }}">Cancel</a>

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
    <link rel="stylesheet" href="/css/bootstrap-datetimepicker.min.css">   

@endsection

@section('scripts')   

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="/js/bootstrap-datetimepicker.min.js"></script>
    <script>
    $( function() {
        $("#date").datepicker({ dateFormat: 'yy-mm-dd'});
        $('#datetimepicker1').datetimepicker();

    });
    </script>

@endsection