@extends('layouts.layout')
@section('title', 'Welcome | Social Blog')
@section('body')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 welcome">
                <h1 class="welcomeText"><i class="fas fa-search"></i> &nbsp Follow your interests.</h1>
                <h1 class="welcomeText"><i class="fas fa-users"></i>&nbsp Hear what people are talking about.</h1>
                <h1 class="welcomeText"><i class="far fa-comment"></i> &nbsp Join the conversation.</h1>
            </div>
            <div class="col-md-6">
                <form action="{{ route('signIn') }}" method="POST" class="form-inline signin">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control mr-sm-2 ph" placeholder="E-mail or Username" name="username">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control mr-sm-2 ph" placeholder="Password" name="password">
                    </div>
                    <button type="submit" class="btn loginBtn">Log in</button>
                </form>
                <div class="col-md-8 offset-md-2 loginError">

                        @if (count($errors) > 0)
                            @foreach ($errors->all() as $error)
                                <p class="alert alert-danger">{{ $error }}</p>
                            @endforeach
                        @endif
                        @empty(!session('message'))
                            {{ session('message') }}
                        @endempty
                        @empty(!session('errorMessage'))
                            {{ session('errorMessage') }}
                        @endempty
                        
                    </div>
                <div class="signup">
                    <h2>See what’s happening in <br> the world right now!</h2><br>
                    <p class="joinUs">Join Social Blog today.</p><br>
                    <a class="btn signupBtn defaultButton" href="{{ route('signUp') }}" role="button">Sign up</a>
                </div>
            </div>
        </div>
    </div>

@endsection

    