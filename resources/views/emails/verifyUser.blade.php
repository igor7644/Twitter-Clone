@extends('layouts.layout')
@section('title', 'Verify Account | Social Blog')
@section('body')

    <h3>Welcome to the Social Blog site {{$user['name']}}!</h3>
    <br/> Your registered email-id is {{$user['email']}} , Please click on the below link to verify your account &crarr; <br/><br>
    <a class="btn signupBtn" href="{{url('user/verify', $user->verifyUser->token)}}" role="button">Verify account</a>

@endsection