@extends('tutor.layouts.master')

@section('styles')

  <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

@stop

@section('content')

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>Messages - {{ $studentuser->student->name }}</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Messages</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">           

            <div class="box box-primary">              
                <!-- /.box-header -->
                <div class="box-body">
                  <div style="max-height: 60vh;overflow: scroll;" class="message-div">
                    @foreach($messages as $message)
                      @if($message->sent_by == Auth::user()->id)
                        <p style="text-align:right; margin:25px 0px">
                          <span style="background-color:#19ad8b;color:white;padding: 10px;
                          border-radius: 10px;">
                            {{ $message->text }}
                          </span>                            
                        </p>
                      @else
                        <p style="margin:25px 0px">
                          <span style="background-color:#0083c1;color:white;padding: 10px;
                          border-radius: 10px;">
                            {{ $message->text }}
                          </span>
                            
                        </p>
                      @endif
                      
                    @endforeach
                  </div>
                  <hr>
                  <form action="{{ route('tutor.message.store') }}" method="POST">
                      <div style="display:flex;">
                          @csrf
                          <input type="hidden" value="{{ $studentuser->student_id }}" name="user_id">
                          <input type="text" style="flex-grow:1" name="text">
                          <button class="btn btn-primary" style="border-radius:0px">Send Message</button>
                      </div>
                      
                  </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
@endsection

@section('scripts')

    <script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': false,
        'ordering': true,
        'info': true,
        'autoWidth': false
      })
    })
  </script>

  <script>
     $('.message-div').scrollTop($('.message-div')[0].scrollHeight);
  </script>

@stop