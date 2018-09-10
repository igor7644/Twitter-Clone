<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function getIndex()
    {
        return view('pages.welcome');
    }

    public function getSignUp()
    {
        return view('pages.signup');
    }

    // public function getHome()
    // {
    //     return view('pages.home');
    // }
}
