@extends('tutor.layouts.master')

@section('styles')

  <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

@stop

@section('content')

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>All Themes</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Themes</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">           

            <div class="box box-primary">
              {{-- <div class="box-header">                
                <a href="{{ route('student.theme.create') }}" class="btn btn-primary">Send New theme</a>
                <hr>
              </div> --}}
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Sent By</th>
                      <th>Theme</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach($themes as $theme)
                            <tr>
                                <td>{{ $theme->sender->name }}</td>
                                <td>
                                    <a href="{{ route('tutor.theme.download') }}?attachment={{$theme->file}}" class="btn btn-primary">
                                        Download theme
                                    </a>
                                </td>                               
                                <td>                                    
                                    <a href="{{ route('tutor.theme.show',[ 'id' => $theme->id ]) }}" class="btn btn-icon btn-xs waves-effect waves-light btn-info"> <i class="fa fa-eye"></i> </a>
                                    {{-- {!! Form::open(['route' => [ 'student.theme.destroy','id'=>$theme->id ],'method' => 'delete','style'=> 'display: inline-block;']) !!}
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