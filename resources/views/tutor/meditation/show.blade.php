@extends('tutor.layouts.master')

@section('styles')

  <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

@stop

@section('content')

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>All sessions</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">sessions</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">           

            <div class="box box-primary">              
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Student</th>
                      <th>Time</th>
                      <th>Room</th>
                      <th>Domain</th>
                      <th>Student Present?</th>
                      {{-- <th></th> --}}
                    </tr>
                  </thead>
                  <tbody>
                        @foreach($meditation->sessions as $session)
                            <tr>
                                <td>{{ $session->meditation->student->name }} ( {{ $session->meditation->student->email }} )</td>                                
                                <td>
                                    {{ \Carbon\Carbon::parse($session->time)->format('l, d F, Y, H:i') }}
                                </td>
                                
                                <td>{{ $session->meditation->room }}</td>                                                             
                                <td>{{ ucwords($session->meditation->domain->name) }}</td> 
                                <td>
                                        @if($session->confirmed)
                                            {{ $session->confirmed == 1 ? 'Yes' : 'No' }}
                                        @elseif(\Carbon\Carbon::parse($session->time) < \Carbon\Carbon::now())
                                            <a href="{{ route('tutor.session.confirm',['id'=> $session->id]) }}" class="btn btn-default btn-primary" style="color:white">Yes, I Confirm</a>
                                            <a href="{{ route('tutor.session.notconfirm',['id'=> $session->id]) }}" class="btn btn-default btn-danger" style="color:white">No, I Confirm</a>
                                        @endif
                                    </td>                                                           
                                <td>  
                                    {{-- <a href="{{ route('tutor.session.show',[ 'id' => $session->id ]) }}" class="btn btn-icon btn-xs waves-effect waves-light btn-success"> <i class="fa fa-eye"></i> </a>

                                    <a href="{{ route('tutor.session.edit',[ 'id' => $session->id ]) }}" class="btn btn-icon btn-xs waves-effect waves-light btn-info"> <i class="fa fa-pencil"></i> </a> --}}
                                    {{-- {!! Form::open(['route' => [ 'tutor.session.destroy','id'=>$session->id ],'method' => 'delete','style'=> 'display: inline-block;']) !!}
                                        <button class="btn btn-icon btn-xs waves-effect waves-light btn-danger"> <i class="fa fa-trash-o"></i> </button> 
                                    {!! Form::close() !!} --}}

                                    
                                </td>
                            </tr>
                        @endforeach                       
                    
                  </tbody>                  
                </table>
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

@stop