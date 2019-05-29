<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function show(Tag $tag) {

    	$tags = Tag::orderBy('postCount','DESC')->limit(30)->get();
    	$posts = $tag->posts->paginate(5);

      $topPosts = Post::all()->sortByDesc('views')->take(10);

    	return view('tags.show', compact('posts','tags','tag', 'topPosts'));
    
    }
}
