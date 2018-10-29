@extends('student.layouts.master')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Password</h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active">Change Password</li>
            </ol>
        </section>

        <!-- Main content -->
        <div class="row">
            <div class="col-md-6">
                <section class="content">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title">Change Password</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        {!! Form::open(['route' => 'student.password.update', 'method' => 'put']) !!}
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Enter New Password" name="password">
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
                                <button type="submit" class="btn btn-primary">Update Password</button>
                                <a type="submit" class="btn btn-default" href="{{ route('student.index') }}">Cancel</a>
                            </div>
                        {!! Form::close() !!}
                    </div>    

                </section>
            </div>
        </div>
        
        <!-- /.content -->
    </div>

@endsection