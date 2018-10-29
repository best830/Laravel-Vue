@extends('tutor.layouts.master')

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
                <p>Sent By : {{ $theme->sender->name }}</p>
                <p>Rating : {{ $theme->rating ? $theme->rating : 'N/A'  }}</p>
                <p>
                  <a href="{{ route('tutor.theme.download') }}?attachment={{$theme->file}}" class="btn btn-primary">
                      Download theme
                  </a>                   
                </p>
                {{-- <p>Completed: {{ $theme->completed ? 'Yes' : 'No' }}</p> --}}
                @if($theme->comments->count())
                  <p>Comments:</p>
                  @foreach($theme->comments as $comment)
                      
                      <div class="panel panel-default">
                          <div class="panel-body">
                            {{ $comment->text }}
                          </div>
                          <div class="panel-footer">{{ $comment->created_at->diffForHumans() }}</div>
                        </div>
                      
                  @endforeach
                @endif
              </div>
              <!-- /.box-body -->
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title">Rate Theme</h3>
                        </div>
                        <form role="form" action="{{ route('tutor.theme.rate') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{$theme->id}}" name="theme_id">
                            <div class="box-body">
                                <div class="form-group">
                                  <select name="rating" id="" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                  </select>
                                </div>                                        
                            </div>                            

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Rate Now</button>
                                <a type="submit" class="btn btn-default" href="{{ route('tutor.theme.index') }}">Cancel</a>

                            </div>
                        </form>
                    </div>
            </div>
              <div class="col-md-6">
                      <div class="box box-primary">
                          <div class="box-header with-border">
                          <h3 class="box-title">Post Comment</h3>
                          </div>
                          <form role="form" action="{{ route('tutor.comment.store') }}" method="POST">
                              @csrf
                              <input type="hidden" value="{{$theme->id}}" name="theme_id">
                              <div class="box-body">
                                  <div class="form-group">
                                      <textarea cols="30" rows="10" class="form-control" name="text"></textarea>
                                  </div>                                        
                              </div>                            
  
                              <div class="box-footer">
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                  <a type="submit" class="btn btn-default" href="{{ route('tutor.theme.index') }}">Cancel</a>
  
                              </div>
                          </form>
                      </div>
              </div>
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