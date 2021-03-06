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
        $followedUsers = auth()->user()->isFollowing->pluck('id');
        $followedUsers[] = auth()->user()->id;
        $posts = Post::whereIn('user_id', $followedUsers)->orderBy('created_at', 'DESC')->paginate(4);
        $users = User::orderBy('created_at', 'DESC')->whereNotIn('id', $followedUsers)->limit(5)->get();
        return view('pages.home', compact('posts', 'users'));
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
