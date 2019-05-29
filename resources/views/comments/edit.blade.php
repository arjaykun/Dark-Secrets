@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="offset-md-3 col-md-6">
			<div class="card">
				<div class="card-body">
					<a href="{{ route('posts.show', ['post' => $comment->post]) }}" class="btn btn-dark float-right">Return back</a>
					<div style="clear:both"></div>
					<br>
					<h3 class="text-center">Update Comment for 
						<span class="text-secondary font-weight-bold">{{ $comment->post->title }}</span>
					</h3 class="text-center">
					<form action="{{ route('comments.update', ['comment' => $comment]) }}" method="POST">
						@csrf
						@method('PATCH')
						@include('comments.form')
						
						<button type="submit" class="btn btn-primary btn-block">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection