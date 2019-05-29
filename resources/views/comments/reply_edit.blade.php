@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="offset-md-3 col-md-6">
			<div class="card">
				<div class="card-body">
					<a href="{{ route('posts.show', ['post' => $reply->comment->post]) }}" class="btn btn-dark float-right">Return back</a>
					<div style="clear:both"></div>
					<br>
					<h3 class="text-center">Update Reply for 
						<span class="text-secondary font-weight-bold">{{ $reply->comment->post->title }}</span>
					</h3 class="text-center">
						<form action="{{ route('replies.update', ['reply' => $reply]) }}" method="POST" class="mb-2">
							@csrf
							@method('PATCH')
							<textarea name="reply" cols="30" rows="3" class="form-control">{{ $reply->reply }}</textarea>
							<input type="hidden" name="reply_id" value="{{ $reply->id }}">
							<button type="submit" class="btn btn-primary btn-block mt-2">Submit Changes</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
@endsection