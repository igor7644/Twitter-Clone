@extends('layouts.layout')
@section('title', 'Profile | Social Blog')
@section('body')

    @include('includes.header')

    <div class="container-fluid" style="background-color:#E6ECF0">
        <div class="row profile">
            <div class="col-md-12 profile-info">
                <p><b>{{ $user->name }} {{ $user->last_name }}</b></p>
                <p>{{ $user->username }}</p>
                <p>Joined {{ $user->created_at->format('F Y') }}</p>
                @if (auth()->user()->id == $user->id)
                    <button type="button" class="btn btn-primary editProfile" >Edit Profile</button>
                @endif
            </div>
            <div class="col-md-6 offset-md-3 list"><br>
                <table class="table">
                    <thead>
                        <tr align="center">
                            <td>Posts</td>
                            <td>Likes</td>
                            <td>Followers</td>
                            <td>Following</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr align="center">
                            <td><b>{{ $user->posts->count() }}</b></td>
                            <td><b>{{ $user->likes->count() }}</b></td>
                            <td><b>5</b></td>
                            <td><b>5</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection