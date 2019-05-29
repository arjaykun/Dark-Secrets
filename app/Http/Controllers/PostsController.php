<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts =  Post::orderBy('id', 'DESC')->paginate(10);

        $posts->withPath('posts?' . Str::random(100));

        $tags = Tag::orderBy('postCount','DESC')->limit(30)->get();

        $topPosts = $posts->sortByDesc('views')->take(10);

        return view('posts.index', compact('posts','tags', 'topPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $tags = '';
        return view('posts.create', compact('post', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $postData = request()->validate(
            [
                'title' => 'required|min:5',
                'body' => 'required',
                'image' => 'sometimes|file|image|max:2000',
                'tags' => 'required',
            ]
        );

        //remove the tag in the postData before inserting in post table
        array_pop($postData);


        $post = auth()->user()->posts()->create($postData);

        //Handle image upload
        $this->storeImage($post);

        //store tags
        $this->storeTags($post);

        return redirect('posts')
            ->with('post_success', 'Post is created successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $comment = new Comment(); 
        $tags = Tag::orderBy('postCount','DESC')->limit(30)->get();

        $topPosts = Post::all()->sortByDesc('views')->take(10);

        if (auth()->user()->id != $post->user->id) {
            $post->increment('views');
        }

        return view('posts.show', compact('post', 'comment', 'tags', 'topPosts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        // $tags = implode(', ', Arr::pluck($post->tags, 'tagName'));
        $tags = $post->tags->implode('tagName', ', ');

        return view('posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $this->authorize('update', $post);

        $data = $request->validate(
            [
                'title' => 'required|min:5',
                'body' => 'required',
                'image' => 'sometimes|file|image|max:2000',
                'tags' => 'required',
            ]
        );

        array_pop($data);

        $post->update($data);

        $this->storeImage($post);

        $this->updateTags($post);

        return redirect('posts/' . $post->id)
            ->with('post_success', 'Post is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect('posts')
            ->with('post_success', 'Post is deleted successfully');
    }

    public function storeImage($post) {
        if (request()->has('image')) {
            $post->update( 
                [
                    'image' => request()->image->store('uploads', 'public')
                ]
            );
        }
    }

    public function storeTags($post) {
        $tags = explode(',', request()->input('tags') );
        
        foreach ($tags as $tag) {
            $tag = $this->validateTag($tag);
            $post->tags()->attach($tag->id);
        }

    }

    public function updateTags($post) {
        $post->tags()->detach($post->tags);
        $tags = explode(',', request()->input('tags') );
        foreach ($tags as $tag) {
           $tag = $this->validateTag($tag);
           $post->tags()->attach($tag->id);
        }
    }

    public function validateTag($tag) {
        if (Tag::where('tagName', trim($tag))->exists()) {
            $tag = Tag::where('tagName', trim($tag))->get()->first();
            $tag->increment('postCount');
        } 
        else {
            $tag = Tag::create(['tagName' => trim($tag), 'postCount' => 1]);   
        }
        return $tag;
    }
}
