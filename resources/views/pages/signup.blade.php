@extends('layouts.layout')
@section('title', 'Sign Up | Social Blog')
@section('body')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 signupHeader">
                <p>Already have an account? Login <a href="{{ asset('/welcome') }}">here</a></p>
            </div>
            <div class="col-md-4 offset-md-4 signup">
                <h3>Create your account</h3>
                <form action="{{ route('storeUser') }}" method="POST" class="signupForm">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastName">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Username</label>
                            <input type="text" class="form-control" id="usernameForm" name="username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn signupBtn2">Sign up</button>
                </form><br>

                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach
                @endif

            </div>
        </div>
    </div>

@endsection