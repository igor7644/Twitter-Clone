<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;

class PostController extends Controller
{
    private $data = [];

    public function index()
    {
        $data['posts'] = Post::orderBy('created_at', 'DESC')->get();
        return view('pages.home', $data);
    }

    public function create()
    {
        Post::create([
            'text' => request('postText'),
            'user_id' => Auth::user()->id
        ]);

        return redirect()->back();
    }
}
