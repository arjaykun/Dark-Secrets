@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-9">
		<div class="card p-3">
			<span>
				<a href="{{ route('posts.index') }}" class="mb btn btn-primary float-right">RETURN</a>
			</span>
			<h1 class="text-success font-weight-bold text-uppercase"> {{ $post->title}} </h1>
			
			<div class="d-flex">
				<small class="text-secondary pr-2" style="border-right: 1px solid #ccc">
					By: {{ $post->user->name}} ({{ $post->user->email }})
				</small>
				<small class="text-muted pl-2"> 
					@if($post->updated_at > $post->created_at)
						Updated on @datetime($post->updated_at)
					@else
						Written on @datetime($post->created_at)
					@endif 
				</small>
			</div>

			<br>
			@if($post->image)
		   <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="thumbnail" style="width:100%; height: 320px">
		  @else 
		   <img src="{{ asset('storage/uploads/noimage.jpeg') }}" alt="{{ $post->title }}" class="thumbnail" style="width:100%; height: 320px">    
		  @endif
			<p class="pb-4"> {!! $post->body !!} </p>

			<div class="d-flex justify-content-between align-items-baseline">			
				<div>
				@foreach( $post->tags as $tag )
					<h4 class="badge badge-secondary p-2">
						<a href="{{ route('tags.show', ['tag' => $tag])}}" class="text-light">{{ $tag->tagName }}</a>
					</h4>
				@endforeach
				</div>

				{{-- edit and delete links --}}
				@can('update', $post)
					@auth
					<div class="d-flex justify-content-end">
						<a href="{{ route('posts.edit', ['post' => $post]) }}" class="btn btn-info text-light mx-2">
						Edit
						</a>
						<form action="{{ route('posts.destroy', ['post' => $post ])}}" method="POST">
							@csrf
							@method('DELETE')	
							<button type="submit" class="btn btn-danger">Delete</button>
						</form>
					</div>
					@endauth
				@endcan

			</div>

			<hr>

			<h2>Comments: </h2>

			{{-- comment form --}}
			@auth
				<form action="{{ route('comments.store') }}" method="POST" class="mb-2">
					@csrf
					@include('comments.form')

					<input type="hidden" name="post_id" value="{{$post->id}}"> 
					<button type="submit" class="btn btn-primary px-5">Submit</button>
				</form>
			@endauth

			{{-- list of comments --}}
					@forelse( $post->comments as $comment) 
				
			<div class="media border p-3 mb-2">
			  <div class="media-body">
					<div class="d-flex justify-content-between" style="align-items: center;">
						<div>
					    <h5> 
									{{ $comment->user->name }} ({{ $comment->user->email }})
							</h5>
						</div>

						<div>
						{{-- authorize if user can edit this comment --}}
						@can('update', $comment)
						<small class="d-flex px-3 align-items-center">
							<a href="{{ route('comments.edit', ['comment' => $comment]) }}" class="mx-2 btn btn-link">EDIT</a>
							<form action="{{ route('comments.destroy', ['comment' => $comment ])}}" method="POST">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-link">DELETE</button>
							</form>
						</small>
						@endcan
						{{-- end authorization --}}
						</div>
					</div>

					<small class="text-secondary"><i>Commented on  @datetime($comment->created_at)</i></small>
			    
					<p class="blockquote px-3"> 
							{{ $comment->content }}
					</p>

					{{-- replies list here --}}
					@foreach($comment->replies as $reply)

					<div class="card" >
			      <div class="card-body">
							<div class="d-flex justify-content-between">
								<div>
									<h5> {{ $reply->user->name }} ({{ $reply->user->email }}) </h5>		
								</div>	
			
								@can('update', $reply)
								<div class="d-flex justify-content-end align-items-center">
									<a href="{{ route('replies.edit', ['reply' => $reply]) }}" class="mr-3">EDIT</a>
									<form action="{{ route('replies.destroy', ['reply' => $reply]) }}" method="POST">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-link">DELETE</button>
									</form>
								</div>
								@endcan

							</div>	
							<small class="text-secondary"><i>replies on @datetime($reply->created_at) </i></small>
			        <p class="card-text">{{ $reply->reply }}</p>
			      </div>
		   		</div> 

					@endforeach
					{{-- end replies list --}}

					@auth
					<div class="container px-3">
						<form action="{{ route('replies.store') }}" method="POST" class="mb-2">
							@csrf
							<textarea name="reply" cols="30" rows="3" class="form-control" placeholder="Enter your reply here..."></textarea>
							<input type="hidden" name="comment_id" value="{{ $comment->id }}">
							<button type="submit" class="btn btn-dark float-right mt-1 px-5">reply</button>
						</form>
					</div>
					@endauth
			  </div>
			</div>
			@empty
				<h3 class="text-center jumbotron text-secondary">No Comments</h3>
			@endforelse
		</div>
	</div>
	{{-- aside --}}
	<div class="col-md-3">
		@include('inc.aside')
	</div>
</div>	
@endsection