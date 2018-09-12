<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\User;

class CommentController extends Controller
{
    public function create()
    {
        Comment::create([
            'comment' => request('comment'),
            'user_id' => auth()->user()->id,
            'post_id' => request('id')
        ]);
        
        return Comment::with('user')->where('post_id', request('id'))->get();
        return Comment::with('post')->where('post_id', request('id'))->count();
    }

    public function show()
    {
        return Comment::with('user')->where('post_id', request('id'))->get();
    }

}
