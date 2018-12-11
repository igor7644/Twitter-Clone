<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EditProfileValidation;
use App\Post;
use App\User;

class UserController extends Controller
{
    private $data = [];
    
    public function show($id)
    {
        $data['user'] = User::find($id);
        return view('pages.profile', $data);
    }

    public function showUpdate()
    {
        return User::where(['id' => request('id')])->get();
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
}
