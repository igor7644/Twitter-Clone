<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
