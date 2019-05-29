
{{-- filters  --}}
<div class="card my-2">
		<div class="card-body">
			<h4>Filter Secrets By:</h4>
			<div>		
				<a href="{{ route('filters.mostViews') }}" class="btn btn-dark mb-2" >Most Views</a>
				<a href="{{ route('filters.recent') }}" class="btn btn-dark mb-2" >Recent</a>
				<a href="{{ route('filters.mostComments') }}" class="btn btn-dark mb-2" >Most Comments</a>
			</div>
		</div>
</div>
{{-- end filters --}}


{{-- search  --}}
<div class="card my-2">
		<div class="card-body">
			<label>Search Secrets</label>
			<input type="text" class="form-control" placeholder="Search by title, author">
			<button type="submit" class="btn btn-primary btn-block">search</button>
		</div>
</div>
{{-- end search --}}

{{-- tags --}}
<div class="card mb-2">
		<div class="card-body">
			<h3 class="card-title">TAGS</h3>
			<div>
					@foreach( $tags as $tag )
						<h4 class="badge badge-secondary p-2">
							<a href="{{ route('tags.show', ['tag' => $tag])}}" class="text-light">{{ $tag->tagName }}</a>
						</h4>
					@endforeach
					</div>
		</div>
</div>
{{-- end tags --}}

{{-- top secrets --}}
<div class="card mb-2">
		<div class="card-body">
			<h3 class="card-title">TOP SECRETS</h3>
			<p>
				@foreach($topPosts as $top )
					<span>
						<a  class="text-dark" href="{{ route('posts.show', ['post' => $top->id]) }}">
							{{ $loop->iteration}}. {{ $top->title }}
						</a>
					</span><br>
				@endforeach
			</p>
		</div>
</div>
{{-- end top secrets --}}