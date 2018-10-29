@extends('student.layouts.master')

@section('styles')

  <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

@stop

@section('content')

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>Theme</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Theme</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">           

            <div class="box box-primary">              
              <!-- /.box-header -->
              <div class="box-body">
                <p>Sent To : {{ $theme->receiver->name }}</p>
                <p>Rating : {{ $theme->rating ? $theme->rating : 'N/A'  }}</p>
                <p>
                    <a href="{{ route('student.theme.download') }}?attachment={{$theme->file}}" class="btn btn-primary">
                        Download theme
                    </a>
                    
                </p>
                <p>Comments:</p>
                @foreach($theme->comments as $comment)
                    
                    <div class="panel panel-default">
                        <div class="panel-body">
                          {{ $comment->text }}
                        </div>
                        <div class="panel-footer">{{ $comment->created_at->diffForHumans() }}</div>
                      </div>
                    
                @endforeach
              </div>
              <!-- /.box-body -->
            </div>            
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