@extends('admin.layouts.master')

@section('styles')

  <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

@stop

@section('content')

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>All Payments</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Payments</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">           

            <div class="box box-primary">
              <div class="box-header">                
                <a href="{{ route('admin.payment.create') }}" class="btn btn-primary">Add New payment</a>
                <hr>
                <a href="{{ Request::getPathInfo() . (Request::getQueryString() ? ('?' . Request::getQueryString().'&expired=1') : ''.'?expired=1') }}" class="btn btn-default">Expired Payments</a>

              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Student Name</th>
                      <th>Amount</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Expired</th>
                      <th>Domains (No. of meditations)</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach($payments as $payment)
                            <tr @if($payment->end_date < \Carbon\Carbon::now()->toDateTimeString()) style="background-color:#ff00002e" @endif>
                                <td>{{ ucwords($payment->user->name) }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ $payment->start_date }}</td>
                                <td>{{ $payment->end_date }}</td>
                                <td>@if($payment->end_date < \Carbon\Carbon::now()->toDateTimeString()) Yes @else No @endif</td>
                                <td>
                                  @foreach($payment->domains as $domain)
                                    {{ ucwords($domain->name) }} ( {{ $domain->pivot->remaining_no_of_meditations }} /  {{ $domain->pivot->total_no_of_meditations }}) <br>
                                  @endforeach
                                </td>
                                <td>
                                    <!-- <a href="{{ route('admin.payment.edit',[ 'id' => $payment->id ]) }}">
                                        <span class="label label-info">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                    <a href="">
                                        <span class="label label-danger">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </span>
                                    </a> -->
                                    <a href="{{ route('admin.payment.edit',[ 'id' => $payment->id ]) }}" class="btn btn-icon btn-xs waves-effect waves-light btn-info"> <i class="fa fa-pencil"></i> </a>
                                    {!! Form::open(['route' => [ 'admin.payment.destroy','id'=>$payment->id ],'method' => 'delete','style'=> 'display: inline-block;']) !!}
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