@extends('layouts.app')


@section('content')


	<div class="jumbotron text-center mt-3">
		<h1 class="display-3">Welcome to Dark Secrets </h1>
		<p class="blockquote mb-4 lead px-5">
			"Share your darkest secrets, stories or confessions. Don't worry your secrets is 100% safe with us." 
			<h3 class="text-secondary" style="letter-spacing: 3px">"What you see! <span class="text-danger">What you read!</span> Leave it here!"</h3>
		</p>
		
		@guest
			<h1 class="text-center">Get Started</h1>
			<a href="{{ route('login') }}" class="btn btn-primary text-light py-2 px-5">login</a>
			<a href="{{ route('register') }}" class="btn btn-dark text-light p-2 px-5">register</a>
		@endguest

	</div>

@endsection