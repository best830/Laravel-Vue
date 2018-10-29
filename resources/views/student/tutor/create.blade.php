@extends('student.layouts.master')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Students</h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active">Add student</li>
            </ol>
        </section>

        <!-- Main content -->
        <div class="row">
            <div class="col-md-6">
                <section class="content">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title">Add New Student</h3>
                        </div>
                        <form role="form" action="{{ route('tutor.student.store') }}" method="POST">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Student</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        @foreach($students as $student)
                                            <option value="{{ $student['id'] }}"> {{ $student['name'] }} ( {{ $student['email'] }} )</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                            

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a type="submit" class="btn btn-default" href="{{ route('tutor.student.index') }}">Cancel</a>

                            </div>
                        </form>
                    </div>    

                </section>
            </div>
        </div>
        
        <!-- /.content -->
    </div>

@endsection