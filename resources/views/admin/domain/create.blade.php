@extends('admin.layouts.master')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Domains</h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active">Add Domain</li>
            </ol>
        </section>

        <!-- Main content -->
        <div class="row">
            <div class="col-md-6">
                <section class="content">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title">Create New Domain</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('admin.domain.store') }}" method="POST">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Domain Name" name="name">
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a type="submit" class="btn btn-default" href="{{ route('admin.domain.index') }}">Cancel</a>
                            </div>
                        </form>
                    </div>    

                </section>
            </div>
        </div>
        
        <!-- /.content -->
    </div>

@endsection