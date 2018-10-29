@extends('admin.layouts.master')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Tutors</h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active">Edit Tutor</li>
            </ol>
        </section>

        <!-- Main content -->
        <div class="row">
            <div class="col-md-6">
                <section class="content">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title">Edit Tutor</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        {!! Form::open(['route' => ['admin.tutor.update',$tutor->id], 'method' => 'put']) !!}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter tutor Name" name="name" value="{{ $tutor->name }}">
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter tutor Email" name="email" required value="{{ $tutor->email }}">
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Enter tutor Password" name="password">
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
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="domain">Domain</label>
                                    <br>
                                    @foreach($domains as $domain)
                                        @if(in_array($domain->id, $tutor->domains->pluck('id')->all()))
                                                <input type="checkbox" name="domain_id[]" value="{{ $domain->id }}" checked > {{ $domain->name }} <br>
                                        @else
                                                <input type="checkbox" name="domain_id[]" value="{{ $domain->id }}" > {{ $domain->name }} <br>
                                        @endif                                          
                                    @endforeach
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a type="submit" class="btn btn-default" href="{{ route('admin.tutor.index') }}">Cancel</a>

                            </div>
                            {!! Form::close() !!}
                    </div>    

                </section>
            </div>
        </div>
        
        <!-- /.content -->
    </div>

@endsection