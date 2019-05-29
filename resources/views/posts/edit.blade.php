@extends('layouts.app')

@section('content')
	<div class="row">	
		<div class="offset-md-2 col-md-8">	
				<div class="card">
					<div class="card-body">	
							<h1>Update Post</h1>

							<form action="{{ route('posts.update', ['post' => $post]) }}" method="POST" enctype="multipart/form-data">

								@csrf
								@method('PATCH')
								@include('posts.forms')
						    <button type="submit" class="btn btn-primary float-right px-5">Save Changes</button>

							</form>
							
					</div>
			</div>
		</div>
	</div>
@endsection