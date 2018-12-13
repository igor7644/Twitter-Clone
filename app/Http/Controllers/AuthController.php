<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginValidation;
use App\Http\Requests\SignupValidation;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\VerifyUser;
use App\Mail\VerifyMail;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.welcome');
    }

    public function getSignUp()
    {
        return view('pages.signup');
    }

    public function signUp(SignupValidation $request)
    {
        DB::transaction(function () {
            $user = User::create([
                'name' => request('name'),
                'last_name' => request('lastName'),
                'email' => request('email'),
                'username' => request('username'),
                'password' => bcrypt(request('password')),
                'role_id' => 2
            ]);
    
            VerifyUser::create([
                'token' => str_random(40),
                'user_id' => $user->id
            ]);
        });

        Mail::to($user->email)->send(new VerifyMail($user));
        return redirect('/welcome')->with('message', 'We sent you an activation code. Check your email and click on the link to verify.');
    }

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();

        if(isset($verifyUser))
        {
            $user = $verifyUser->user;

            if(!$user->verified)
            {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                return redirect('/welcome')->with('message', 'Your account is now verified. You can now login.');
            }
            else 
            {
                return redirect('/welcome')->with('message', 'Your account is already verified. You can now login.');
            }
        }
        else 
        {
            return redirect('/welcome')->with('message', 'Sorry your email cannot be identified.');
        }
    }

    public function signIn(LoginValidation $request)
    {
        $username = request('username');
        $password = request('password');

        if(Auth::attempt(['email' => $username, 'password' => $password, 'verified' => 1]) || Auth::attempt(['username' => $username, 'password' => $password, 'verified' => 1]))
        {
            if(Auth::user()->role_id == 1)
            {
                echo "admin";
            }
            else 
            {
                return redirect('/home');
            }
        }
        else 
        {
            return redirect()->back()->with('errorMessage', 'The username and password you entered did not match our records. Please double-check and try again.');
        }
    }

    public function logOut()
    {
        Auth::logout();
        return redirect('/welcome');
    }
}
