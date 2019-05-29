@extends('layouts.app')

@section('content')
<div class="row">	
	<div class="offset-md-2 col-md-8">	
			<div class="card">
				<div class="card-body">	
						<h1>Create Post</h1>

						<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">

							@csrf
							@include('posts.forms')
							{{-- <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> --}}
					    <button type="submit" class="btn btn-primary float-right px-5">Submit</button>

						</form>
						
				</div>
		</div>
	</div>
</div>
@endsection