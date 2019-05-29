@if(session('post_success'))
	<div class="alert alert-success"> <strong>Success!</strong> {{ session('post_success') }} </div>
@endif