<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EditProfileValidation;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;

class UserController extends Controller
{   
    public function show($user)
    {
        $user = User::with('posts')->where('id', $user)->first();
        return view('pages.profile', compact('user'));
    }

    public function showUpdate()
    {
        return User::find(request('id'));
    }

    public function edit(EditProfileValidation $request)
    {
        $user = User::find(request('id'));
        $user->name = request('name');
        $user->last_name = request('lastName');
        $user->username = request('username');
        $user->save();

        return User::find(request('id'));
    }

    public function follow($user)
    {
        Auth::user()->isFollowing()->attach($user);
        return redirect()->back();
    }

    public function unfollow($user)
    {
        Auth::user()->isFollowing()->detach($user);
        return redirect()->back();
    }
}
