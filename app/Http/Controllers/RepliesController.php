<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;

class RepliesController extends Controller
{

		public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request) 
    {
    	$validatedData = $request->validate(
    		[
    			'reply' => 'required',
    			'comment_id' => 'required',
    		]
    	);

    	$validatedData['user_id'] = auth()->user()->id;

    	Reply::create($validatedData);

    	return back();
    }

    public function edit(Reply $reply) {
    	return view('comments.reply_edit', compact('reply'));
    }

    public function update(Request $request, Reply $reply) 
    {
    	$this->authorize('update', $reply);

    	$validatedData = $request->validate( ['reply' => 'required'] );
    	$reply->update($validatedData);

    	return redirect('posts/' .  $reply->comment->post->id);
    }

    public function destroy(Reply $reply) 
    {
  	 	$this->authorize('update', $reply);
  	 	$reply->delete();

  	 	return back();
    }

}
