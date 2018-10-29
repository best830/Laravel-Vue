@extends('tutor.layouts.master')

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
                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div style="padding: 0px 10px;color: red;">{{ $error }}</div>
                            @endforeach
                        @endif
                        <form role="form" action="{{ route('tutor.meditation.store') }}" method="POST">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="user_id">Select Student</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        @foreach($payments as $payment)
                                            <option value="{{ $payment->user->id }}"> {{ $payment->user->name }} ( {{ $payment->user->email }} )</option>
                                        @endforeach
                                    </select>
                                </div> 
                                
                                <div class="form-group">
                                    <label for="domain_id">Select Domain</label>
                                    <select name="domain_id" id="domain_id" class="form-control">
                                        @if(count($payments) > 0)
                                            @foreach($payments[0]->domains  as $domain)
                                                @foreach(Auth::user()->domains  as $innerdomain)
                                                    @if($domain->id == $innerdomain->id)
                                                        <option value="{{ $domain->id }}"> {{ $domain->name }}</option>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <input type="hidden" value="@if(count($payments) > 0) {{ $payments[0]->id }} @endif" name="payment_id" id="payment_id">                                

                                <div class="form-group">
                                    <label for="no_of_sessions">No. of Sessions</label>
                                    <select name="no_of_sessions" id="no_of_sessions" class="form-control">                 
                                        @if(count($payments) > 0)                                        
                                            @foreach($payments[0]->domains as $domain)
                                                @if($loop->iteration == 1)
                                                    @foreach (range(1, $domain->pivot->remaining_no_of_meditations) as $number)
                                                        <option value="{{ $number }}">{{ $number }}</option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
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
                                    <label for="room">Room</label>  
                                    <input type="text" name="room" class="form-control">
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

    <script>
        var payments = {!! json_encode($payments) !!};
        var domains = {!! json_encode(Auth::user()->domains) !!};

        $(document).ready(function () {
            $("#user_id").change(function () {
                var val = $(this).val();
                var selectedPayment = payments.filter(function (el) {
                    return el.user_id == val;
                });
                var mappedvalues = selectedPayment[0].domains.map((item) =>{
                    var fullname='';
                    domains.forEach(element => {                        
                        if(element.id == item.id){
                            console.log(element);
                            fullname = '<option value="'+ item.id+'">'+item.name +'</option>';
                        }
                    });                    
                    return fullname;
                    
                });
                mappedvalues = mappedvalues.join();                
                
                $("#domain_id").html(mappedvalues);

                var selectedDomain = selectedPayment[0].domains.filter(function (el) {
                    return el.id == $("#domain_id").val();
                });

                var remaining_no_of_meditations = selectedDomain[0].pivot.remaining_no_of_meditations;
                console.log(remaining_no_of_meditations);
                var text='';
                for (i = 1; i <= remaining_no_of_meditations; i++) { 
                    text += '<option value="'+ i+'">'+i +'</option>';
                }
                console.log(text);
                $("#no_of_sessions").html(text);
                
                $("#payment_id").val(selectedPayment[0].id);

            });

            $("#domain_id").change(function () {
                var val = $(this).val();
                var selectedPayment = payments.filter(function (el) {
                    return el.user_id == $("#user_id").val();
                });
                
                var selectedDomain = selectedPayment[0].domains.filter(function (el) {
                    return el.id == val;
                });

                var remaining_no_of_meditations = selectedDomain[0].pivot.remaining_no_of_meditations;
                console.log(remaining_no_of_meditations);
                var text='';
                for (i = 1; i <= remaining_no_of_meditations; i++) { 
                    text += '<option value="'+ i+'">'+i +'</option>';
                }
                console.log(text);
                $("#no_of_sessions").html(text);
                
                // $("#no_of_sessions").html(mappedvalues);
                
            });
        });
    </script>

@endsection