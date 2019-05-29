@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-9">
        <div>
            <div class="card">
                <div class="card-header bg-dark text-light">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
        <div class="d-flex justify-content-between">
            <h3>Your Posts</h3>
            <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
        </div>
                <hr>   
                    @if( count($posts) > 0 )
                        @foreach( $posts as $post )
                        <a href="{{ route('posts.show', ['post' => $post]) }}" class="text-dark">
                         <div class="media border p-3 mb-1">
                            @if($post->image)
                             <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="thumbnail" style="width:200px; height: 150px">
                            @else 
                             <img src="{{ asset('storage/uploads/noimage.jpeg') }}" alt="{{ $post->title }}" class="thumbnail" style="width:200px; height: 150px">    
                            @endif

                            <div class="media-body ml-3">
                              <h5> {{ ucwords($post->title) }} <br>
                                <small>
                                    <i> Posted on {{ $post->created_at }}</i>
                                </small></h5>
                              <p> {!! substr($post->body, 0, 200) !!} <br> ... </p>      
                            </div>
                          </div>
                        </a>
                        @endforeach
                    @else
                        <div class="text-center">You have currently no post.</div>
                    @endif

                    <div class="d-flex justify-content-end">{{ $posts->links() }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        @include('inc.aside')
    </div>
</div>
@endsection
