@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-sm-9">
				
				@if( count($posts) > 0)
					<div class="card mb-2">
						<div class="card-body d-flex justify-content-between">
							{{-- pagination --}}
							<div class="d-flex justify-content-end">
								{{ $posts->links() }}
							</div>
							{{-- end pagination --}}
	
							{{-- filters --}}
							<div>
								<h3>Filtered by tag: <strong>{{ strtoupper($tag->tagName) }}</strong></h3>
							</div>
							{{-- end filters --}}
						</div>
					</div>

					{{-- post lists  --}}
					@foreach( $posts as $post )

						<div class="card mb-2">
							<div class="card-body">
								<a href="{{ route('posts.show', ['post' => $post ] )}}">
									<h1 class="card-title"> {{ $post->title }} </h1>
								</a>

								<small class="text-secondary">By: {{ $post->user->name}} ({{ $post->user->email }})</small>
								<p class="card-text py-3">
									{{ substr($post->body, 0 , 500) }}
									<br> <a href="{{ route('posts.show', ['post' => $post ] )}}"><h2 class="text-center">...</h2></a>
								</p>
								<small class="text-muted"> Written on @datetime($post->created_at) </small>
							</div>
						</div>

					@endforeach
					{{-- end post list --}}

				@else
					<div class="card mb-2">
						<div class="card-body">
							 <h1 class="text-center py-5 text-uppercase"> There is no post found as of the moment.</h1>
						</div>
					</div>
				@endif

		</div>

		<div class="col-sm-3">
			@include('inc.aside')
		</div>
	</div>
@endsection