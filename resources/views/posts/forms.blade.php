<div class="form-group">
  <label for="title">Title:</label>
  <input type="title" class="form-control" id="title" placeholder="Enter Title" name="title" value="{{ old('title') ?? $post->title }}">
  <span class="text-danger">{{ $errors->first('title')}}</span>
</div>

<div class="form-group"> 
  <label for="post-ckeditor">Body:</label>
	<textarea name="body" id="article-ckeditor" cols="30" rows="10" class="form-control" placeholder="Enter Post Body">{{ old('body') ?? $post->body }}</textarea>
	<span class="text-danger">{{ $errors->first('body')}}</span>
</div>

<div class="form-group">
  <label for="tags">Tags (if many use comma to separate each tags ex: confession, secret, dark):</label>
  <input type="tags" class="form-control" placeholder="Enter tags" name="tags" value="{{ old('tags') ?? $tags  }}">
  <span class="text-danger">{{ $errors->first('tags')}}</span>
</div>


<div class="form-group">
	<label for="image">Post Image: </label> <br>
	<input type="file" name="image" id="image">
</div>

