@extends('tutor.layouts.master')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Materials</h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active">Send Material</li>
            </ol>
        </section>

        <!-- Main content -->
        <div class="row">
            <div class="col-md-6">
                <section class="content">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title">Send Material</h3>
                        </div>
                        <form role="form" action="{{ route('tutor.material.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="user_id">Select Student</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        @foreach($studentusers as $studentuser)
                                            <option value="{{ $studentuser->student->id }}" 
                                                @if($user_id && $user_id == $studentuser->student->id) selected @endif
                                            > {{ $studentuser->student->name }} ( {{ $studentuser->student->email }} )</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="files">Select Attachment</label>
                                    <input type="file" class="form-control" name="attachment">                                    
                                </div>
                            </div>                            

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a type="submit" class="btn btn-default" href="{{ route('tutor.material.index') }}">Cancel</a>

                            </div>
                        </form>
                    </div>    

                </section>
            </div>
        </div>
        
        <!-- /.content -->
    </div>

@endsection