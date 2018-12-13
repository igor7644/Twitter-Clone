<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->get();
        return view('pages.home', compact('posts'));
    }

    public function create()
    {
        Post::create([
            'text' => request('postText'),
            'user_id' => Auth::user()->id
        ]);
        return redirect()->back();
    }

    public function like()
    {
        Auth::user()->likes()->attach(request('postId'));
        $post = Post::find(request('postId'));
        return $post->likes->count(); 
    }

    public function unlike()
    {
        Auth::user()->likes()->detach(request('postId'));
        $post = Post::find(request('postId'));
        return $post->likes->count(); 
    }

    public function destroy($post)
    {
        Post::destroy($post);
        return redirect()->back();
    }


}
