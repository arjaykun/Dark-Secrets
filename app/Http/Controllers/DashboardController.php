<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = auth()->user()->id;
        $posts = Post::where('user_id', $id)->orderBy('id', 'DESC')->paginate(4);
        $tags = \App\Tag::orderBy('postCount','DESC')->limit(30)->get();

        $topPosts = Post::all()->sortByDesc('views')->take(10);
    
        return view('dashboard', compact('posts','tags','topPosts'));
    }
}
