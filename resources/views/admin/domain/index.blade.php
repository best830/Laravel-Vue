@extends('admin.layouts.master')

@section('styles')

  <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

@stop

@section('content')

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>All Domains</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Domains</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">           

            <div class="box box-primary">
              <div class="box-header">                
                <a href="{{ route('admin.domain.create') }}" class="btn btn-primary">Add New Domain</a>
                <hr>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach($domains as $domain)
                            <tr>
                                <td>{{ ucwords($domain->name) }}</td>
                                <td>
                                    <!-- <a href="{{ route('admin.domain.edit',[ 'id' => $domain->id ]) }}">
                                        <span class="label label-info">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                    <a href="">
                                        <span class="label label-danger">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </span>
                                    </a> -->
                                    <a href="{{ route('admin.domain.edit',[ 'id' => $domain->id ]) }}" class="btn btn-icon btn-xs waves-effect waves-light btn-info"> <i class="fa fa-pencil"></i> </a>
                                    {!! Form::open(['route' => [ 'admin.domain.destroy','id'=>$domain->id ],'method' => 'delete','style'=> 'display: inline-block;']) !!}
                                        <button class="btn btn-icon btn-xs waves-effect waves-light btn-danger"> <i class="fa fa-trash-o"></i> </button> 
                                    {!! Form::close() !!}

                                    
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