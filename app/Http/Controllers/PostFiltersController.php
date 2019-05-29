<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Illuminate\Support\Str;

class PostFiltersController extends Controller
{
    public function mostViews() {

        $posts =  Post::orderBy('views', 'DESC')->paginate(10);

        $posts->withPath('posts?' . Str::random(100));

        $tags = Tag::orderBy('postCount','DESC')->limit(30)->get();

        $topPosts = $posts->sortByDesc('views')->take(10);
        
        return view('posts.index', compact('posts','tags', 'topPosts'));
 
    }
     public function mostComments() {
     		$posts = Post::paginate(10);
     		
        $posts->withPath('posts?' . Str::random(100));

        $tags = Tag::orderBy('postCount','DESC')->limit(30)->get();

        $topPosts = $posts->sortByDesc('views')->take(10);
        
        return view('posts.index', compact('posts','tags', 'topPosts'));
 
    }
}
