@extends('student.layouts.master')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    <style>
        /* .fc-time{
            display : none;
        } */
        .fc-month-view .fc-time{
            display : none;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Next Session on {{ \Carbon\Carbon::parse($latest->time)->format('l, d F, Y, H:i') }} with {{ ucwords($latest->meditation->tutor->name) }} in room {{ $latest->meditation->room }} </h4>
                        </div>

                        <div class="panel-body">
                            {!! $calendar->calendar() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    {!! $calendar->script() !!}    
@endsection