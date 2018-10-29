@extends('tutor.layouts.master')

@section('styles')

  <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

@stop

@section('content')

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>All Meditations</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Meditations</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">           

            <div class="box box-primary">
              <div class="box-header">                
                <a href="{{ route('tutor.meditation.create') }}" class="btn btn-primary">Add New Meditation Session</a>
                <hr>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Student</th>
                      <th>First Session Time</th>
                      <th>Sessions</th>
                      <th>Room</th>
                      <th>Domain</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach($meditations as $meditation)
                            <tr>
                                <td>{{ $meditation->student->name }} ( {{ $meditation->student->email }} )</td>
                                <td>{{ \Carbon\Carbon::parse($meditation->sessions[0]->time)->format('l, d F, Y, H:i') }}</td>
                                <td>{{ $meditation->sessions->count() }}</td>
                                <td>{{ $meditation->room }}</td>                                                             
                                <td>{{ ucwords($meditation->domain->name) }}</td>                                                            
                                <td>  
                                    <a href="{{ route('tutor.meditation.show',[ 'id' => $meditation->id ]) }}" class="btn btn-icon btn-xs waves-effect waves-light btn-success"> <i class="fa fa-eye"></i> </a>

                                    {{-- <a href="{{ route('tutor.meditation.edit',[ 'id' => $meditation->id ]) }}" class="btn btn-icon btn-xs waves-effect waves-light btn-info"> <i class="fa fa-pencil"></i> </a> --}}
                                    {{-- {!! Form::open(['route' => [ 'tutor.meditation.destroy','id'=>$meditation->id ],'method' => 'delete','style'=> 'display: inline-block;']) !!}
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