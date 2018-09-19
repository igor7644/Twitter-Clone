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

        return Comment::with('user', 'post', 'replies', 'replies.user')->where(['post_id' => request('id'), 'parent_id' => null])->get();
    }

    public function createReply()
    {
        Comment::create([
            'comment' => request('reply'),
            'user_id' => auth()->user()->id,
            'post_id' => request('postId'),
            'parent_id' => request('commentId')
        ]);

        return Comment::with('user', 'post', 'replies', 'replies.user')->where(['post_id' => request('postId'), 'parent_id' => null])->get();
    }

    public function show()
    {
        return Comment::with('user', 'post', 'replies', 'replies.user')->where(['post_id' => request('id'), 'parent_id' => null])->get();
    }

}
