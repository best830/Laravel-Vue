@extends('student.layouts.master')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Meditation Session</h1>
            <ol class="breadcrumb">
                <li><a href="/tutor"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active">Edit Meditation Session</li>
            </ol>
        </section>

        <!-- Main content -->
        <div class="row">
            <div class="col-md-6">
                <section class="content">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title">Edit Meditation Session</h3>
                        </div>
                        {!! Form::open(['route' => ['tutor.meditation.update',$meditation->id], 'method' => 'put']) !!}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="user_id">Select Student</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        @foreach($studentusers as $studentuser)
                                            <option value="{{ $studentuser->student->id }}"
                                                @if($studentuser->id == $meditation->student_id) selected @endif
                                                > {{ $studentuser->student->name }} ( {{ $studentuser->student->email }} )</option>
                                        @endforeach
                                    </select>
                                </div>                               

                                <div class="form-group">
                                    <label for="time">Select Date and Time</label>

                                    <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' class="form-control" name="time" value="{{ $meditation->time}}"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="no_of_sessions">No. of Sessions</label>
                                    <select name="no_of_sessions" id="no_of_sessions" class="form-control">
                                        <option value="1" @if($meditation->sessions->count() == 1) selected @endif >1</option>
                                        <option value="5" @if($meditation->sessions->count() == 5) selected @endif >5</option>
                                        <option value="10" @if($meditation->sessions->count() == 10) selected @endif >10</option>
                                        <option value="20" @if($meditation->sessions->count() == 20) selected @endif >20</option>
                                        <option value="50" @if($meditation->sessions->count() == 50) selected @endif >50</option>
                                        <option value="100" @if($meditation->sessions->count() == 100) selected @endif >100</option>
                                    </select> 
                                </div>

                                <div class="form-group">
                                    <label for="room">Room</label>  
                                    <input type="text" name="room" class="form-control" value="{{ $meditation->room}}">
                                </div>

                                <div class="form-group">
                                    <label for="domain_id">Select Domain</label>
                                    <select name="domain_id" id="domain_id" class="form-control">
                                        @foreach(Auth::user()->domains  as $domain)
                                            <option value="{{ $domain->id }}"
                                                @if($domain->id == $meditation->domain_id) selected @endif
                                            > {{ ucwords($domain->name) }}</option>
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