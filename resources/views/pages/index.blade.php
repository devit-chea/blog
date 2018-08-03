@extends('layouts.app')
@section('content')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

<div class="container">
<br>
	<div class="row">
		<div class="col-md-12">
			<h1 class="text-center">Add Post</h1>
		</div>
	</div>
	@include('inc.massage')
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
		Add Post
	</button>
	  <div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
					{{Form::text('title','', ['id' => 'title' ,'class' => 'form-control','placeholder' => 'Enter title'])}}
				</div>
				<div class="form-group">
					{{Form::label('body', 'Message')}}
					{{Form::textarea('body','',['id' => 'article-ckeditor' ,'class' => 'form-control','placeholder' => 'Enter messages'])}}
				</div>									
			</div>
			<div class="modal-footer">
				
				<div>
					{{Form::button('Add Post', ['id' => 'insert', 'class' => 'btn btn-primary insert'])}}
				</div>
				<button type="button" name="button_action" class="btn btn-secondary" id="" data-dismiss="modal">Close</button>
			</div>
			{!! Form::close() !!}
		  </div>
		</div>
	  </div>
	  <br><br>
	<table id="ltable" class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Title</th>
				<th>Content</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>	
		
@endsection
@section('scripts')
	<script src="js/home.index.js"></script>
@endsection

{{-- 	    <br><br><br><br>
      <div class="container">
    		<div class="form-group row add">
    			<div class="col-md-8">
    				<input type="text" class="form-control" id="name" name="name"
    					placeholder="Enter some name" required>
    				<p class="error text-center alert alert-danger hidden"></p>
    			</div>
    			<div class="col-md-4">
    				<button class="btn btn-primary" type="submit" id="add">
    					<span class="glyphicon glyphicon-plus"></span> ADD
    				</button>
    			</div>
    		</div>
  		   {{ csrf_field() }}
  		<div class="table-responsive text-center">
  			<table class="table table-borderless" id="table">
  				<thead>
  					<tr>
  						<th class="text-center">Id</th>
  						<th class="text-center">Title</th>
  						<th class="text-center">Content</th>
  						<th class="text-center">Actions</th>
  					</tr>
  				</thead>
  				
  				@foreach($data as $item)
  				<tr class="item{{$item->id}}">
  					<td>{{$no ++}}</td>
  					<td>{{$item->title}}</td>
  					<td>{{$item->body}}</td>
  					<td><button class="edit-modal btn btn-info" data-id="{{$item->id}}"
  							data-title="{{$item->title}}">
  							<span class="glyphicon glyphicon-edit"></span> Edit
  						</button>
  						<button class="delete-modal btn btn-danger"
  							data-id="{{$item->id}}" data-title="{{$item->title}}">
  							<span class="glyphicon glyphicon-trash"></span> Delete
  						</button></td>
  				</tr>
  				@endforeach
  			</table>
  		</div>
  	</div>
  	<div id="myModal" class="modal fade" role="dialog">
  		<div class="modal-dialog">
  			
  			<div class="modal-content">
  				<div class="modal-header">
  					<button type="button" class="close" data-dismiss="modal">&times;</button>
  					<h4 class="modal-title"></h4>
  				</div>
  				<div class="modal-body">
  					<form class="form-horizontal" role="form">
  						<div class="form-group">
  							<label class="control-label col-sm-2" for="id">ID:</label>
  							<div class="col-sm-10">
  								<input type="text" class="form-control" id="fid" disabled>
  							</div>
  						</div>
  						<div class="form-group">
  							<label class="control-label col-sm-2" for="name">Title:</label>
  							<div class="col-sm-10">
  								<input type="name" class="form-control" id="n">
  							</div>
						  </div>
						  <div class="form-group">
							<label class="control-label col-sm-2" for="name">Content:</label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="b">
							</div>
						</div>
  					</form>
  					<div class="deleteContent">
  						Are you Sure you want to delete <span class="dname"></span> ? <span class="hidden did"></span>
  					</div>
  					<div class="modal-footer">
  						<button type="button" class="btn actionBtn" data-dismiss="modal">
  							<span id="footer_action_button" class='glyphicon'> </span>
  						</button>
  						<button type="button" class="btn btn-warning" data-dismiss="modal">
  							<span class='glyphicon glyphicon-remove'></span> Close
  						</button>
  					</div>
  				</div>
  			</div>
		  </div> --}}