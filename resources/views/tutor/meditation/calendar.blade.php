@extends('tutor.layouts.master')

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
                            <button type="button" class="btn" data-toggle="modal" data-target="#myModal" id="myModalButton" style="display: none">Open</button>

                            <h4>Next Session on {{ \Carbon\Carbon::parse($latest->time)->format('l, d F, Y, H:i') }} with {{ ucwords($latest->meditation->student->name) }} in room {{ $latest->meditation->room }} </h4>
                        </div>

                        <div class="panel-body">
                            {!! $calendar->calendar() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Meditation Session</h4>
            </div>
            <div class="modal-body">
              <p id="meditationtext">Meditation Session on Thursday, 18 October, 2018, 22:00 with Student2 in room 999.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    {!! $calendar->script() !!}
    
    <script>
        // $(document).ready(function() {
        //     
        // });

        // document.getElementsByTagName("a").addEventListener("click", function(event){ 
        //     console.log("Hello World!"); 
        //     event.preventDefault();

        // });
        setInterval(function(){ 
            var old_element = document.getElementsByClassName("fc-day-grid-event");
            
            for (var i = 0; i < old_element.length; i++) {
                var new_element = old_element[i].cloneNode(true);
                old_element[i].parentNode.replaceChild(new_element, old_element[i]);
            }

            $(".fc-day-grid-event").click(function(event){                
                myfunction(this);                
            });
        },1000);

        function myfunction(value){
            console.log(value.href);
            event.preventDefault();
            var jqxhr = $.get(value.href, function(data) {                
                $("#meditationtext").text("Meditation Session on " + data.time +" with "+ data.session.meditation.student.name+" in room "+ data.session.meditation.room +".");
                $("#myModalButton").click();
            })
            .done(function() {
                // alert( "second success" );
            })
            .fail(function() {
                // alert( "error" );
            })
            .always(function() {
                // alert( "finished" );
            });
        }
    </script>
@endsection