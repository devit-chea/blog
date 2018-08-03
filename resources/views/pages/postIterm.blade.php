@extends('layouts.app')
@section('content')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
      Add Post
    </button>
      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open([ 'id' => 'form', 'method' => 'POST']) !!}
          <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title','', ['class' => 'form-control','placeholder' => 'Enter title'])}}
          </div>
          <div class="form-group">
            {{Form::label('body', 'Message')}}
            {{Form::textarea('body','',['id' => 'article-ckeditor' ,'class' => 'form-control','placeholder' => 'Enter messages'])}}
          </div>									
        </div>
        <div class="modal-footer">
            <button type="hidden" id="btnUpdate" class="btn actionBtn" data-dismiss="modal">
                Update
            </button>
          <div>
            {{Form::button('Add Post', ['id' => 'insert', 'class' => 'btn btn-primary insert'])}}
          </div>
          <button type="button" name="button_action" class="btn btn-secondary" id="button_action" data-dismiss="modal">Close</button>
        </div>
        {!! Form::close() !!}
        </div>
      </div>
      </div>
      <br><br>
			
      <div class="container">
        <div class="row">
          <div class="col-md-12">
              @if(count($posts) > 0)
              @foreach($posts as $post)
            <h2><a href="/posts/{{$post->id}}">{{$post->title}}</a></h2>
            <p>{{$post->body}}</p>
            <p>{{$post->created_at}}</p>
          <a class="btn btn-primary" href="{{ url('/pages/'.$post->id)}}">Edite</a>
            @endforeach
            @else
            <h2>Post not found</h2>
            @endif
          </div>
        </div>
      </div>

@endsection
@extends('layouts.footer')
@section('scripts')
	<script src="js/home.index.js"></script>
@endsection