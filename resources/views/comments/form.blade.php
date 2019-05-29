

<div class="form-group">  
	<textarea name="content" id="content" cols="30" rows="10" class="form-control" placeholder="Enter Comment Content">{{ old('content') ?? $comment->content }}</textarea>
	<span class="text-danger">{{ $errors->first('content')}}</span>
</div>