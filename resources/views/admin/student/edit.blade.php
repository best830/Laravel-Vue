@extends('admin.layouts.master')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Students</h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active">Edit Student</li>
            </ol>
        </section>

        <!-- Main content -->
        <div class="row">
            <div class="col-md-6">
                <section class="content">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title">Edit Student</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        {!! Form::open(['route' => ['admin.student.update',$student->id], 'method' => 'put']) !!}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter student Name" name="name" value="{{ $student->name }}">
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter Student Email" name="email" required value="{{ $student->email }}">
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Enter Student Password" name="password">
                                    <input type="checkbox" onclick="showPassword()">Show Password
                                    <script>
                                        function showPassword() {
                                            var x = document.getElementById("password");
                                            if (x.type === "password") {
                                                x.type = "text";
                                            } else {
                                                x.type = "password";
                                            }
                                        }
                                        function generatePassword(event){
                                            console.log('clicked');
                                            document.getElementById('password').value = Math.random().toString(36).slice(-8);
                                        }
                                    </script>
                                    <a 
                                        class="btn btn-default" 
                                        style="width:100%" 
                                        onclick="generatePassword(event)">Generate Random Password
                                    </a>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a type="submit" class="btn btn-default" href="{{ route('admin.student.index') }}">Cancel</a>

                            </div>
                            {!! Form::close() !!}
                    </div>    

                </section>
            </div>
        </div>
        
        <!-- /.content -->
    </div>

@endsection