<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['reply', 'comment_id', 'user_id'];

    public function comment() {
    	return $this->belongsTo(Comment::class);
    }

    public function user() {
    	return $this->belongsTo(User::class);
    }
}
