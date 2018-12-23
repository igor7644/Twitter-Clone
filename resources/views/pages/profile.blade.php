@extends('layouts.layout')
@section('title', 'Profile | Social Blog')
@section('body')

    @include('includes.header')

    <div class="container-fluid" style="background-color:#E6ECF0">
        <div class="row profile">
            <div class="col-md-12 profile-info">
                <div class="pofileAjax">
                    <p><b>{{ $user->name }} {{ $user->last_name }}</b></p>
                    <p>{{ $user->username }}</p>
                </div>
                <p>Joined {{ $user->created_at->format('F Y') }}</p>

                @if (auth()->user()->id == $user->id)
                    <button type="button" class="btn btn-primary editProfile" data-toggle="modal" data-target="#exampleModal" value="{{ $user->id }}">Edit Profile</button>
                @else
                    @if (auth()->user()->isFollowing->contains(request()->user))
                        <form action="{{ asset('/user/'.$user->id.'/unfollow') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary unfollowProfile">Unfollow</button>
                        </form>
                    @else
                        <form action="{{ asset('/user/'.$user->id.'/follow') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary followProfile">Follow</button>
                        </form>
                    @endif
                    
                @endif
                
                

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body profileEdit">
                            <div class="alertMessage">

                            </div>
                            <form>
                                <div class="form-group">
                                  <label>Name</label>
                                  <input type="text" class="form-control" id="" placeholder="">
                                </div>
                                <div class="form-group">
                                  <label>Last Name</label>
                                  <input type="text" class="form-control" id="" placeholder="">
                                </div>
                                <div class="form-group">
                                  <label>Username</label>
                                  <input type="text" class="form-control" id="" placeholder="">
                                  <input type="hidden" data-id="{{ $user->id }}">
                                </div>
                                <button type="submit" class="btn btn-primary updateProfile">Save changes</button>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
                
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
                            <td><b>{{ $user->isFollowedBy->count() }}</b></td>
                            <td><b>{{ $user->isFollowing->count() }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row profilePosts" style="background-color: white">
            <div class="col-md-10 offset-md-3">
                @foreach ($user->posts as $post)
                    @include('includes.post')
                @endforeach
            </div>
        </div>
    </div>

@endsection