@extends('layouts.layout')
@section('title', 'Home | Social Blog')
@section('body')

        <div class="row header">
            <div class="col-md-8 ml-auto">
                <p><a href="{{ asset('/home') }}">Social Blog</a></p>
            </div>
            <div class="col-md-2 ml-auto">
                <div class="dropdown show">
                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{ Auth::user()->username }} </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="#">Profile</a>
                      <a class="dropdown-item" href="{{ route('logOut') }}">Log out</a>
                    </div>
                  </div>
            </div>
        </div>

        <div class="container-fluid" style="background-color:#E9EBEE">
            <div class="row main-insert">
                <div class="col-md-7 mr-auto main-insert-blue">
                    <form action="{{ asset('/home/create') }}" method="POST">
                        @csrf
                        <div class="form-group blue-border-focus">
                            <textarea class="form-control textarea-insert" id="textarea-insert" name="postText" onkeyup="countChar(this)" onfocus="expand()" cols="40" rows="1" placeholder="What's happening?" maxlength="250"></textarea>
                        </div>
                        <div class="hiddenContent row" id="hiddenContent">
                            <p class="col-md-9"><span class="char-num">250</span><span class="char-text"> characters remaining</span></p>
                            <button type="submit" class="btn postBtn col-md-3" id="postBtn">Post</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 sidebar">
                    <h3>sidebar</h3>
                </div>
            </div>

            <div class="row dashboard">

                @foreach ($posts as $post)
                <div class="col-md-7 mr-auto posts">
                        <p class="post-author"><a href="" class="usernamePost">{{ $post->user->username }}</a><span class="hours"> {{ Carbon\Carbon::parse($post->created_at)->diffForHumans()}} </span></p>
                        <p class="text">{{ $post->text }}</p>

                        <!-- Large modal -->
                        <button type="button" class="btn btn-primary showPost" data-toggle="modal" data-target=".post-{{ $post->id }}" value="{{ $post->id }}">View Post</button>

                        <div class="post-{{ $post->id }} modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><p class="post-author"><a href="" class="usernamePost">{{ $post->user->username }}</a><span class="hours"> {{ Carbon\Carbon::parse($post->created_at)->diffForHumans()}} </span></p></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        
                                        <p class="text">{{ $post->text }}</p>
                                        <form action="" method="POST" class="row">
                                                <input type="hidden" value="{{ $post->id }}">
                                                <div class="form-group comment-border-focus col-md-9">
                                                <textarea class="form-control textarea-comment comment-{{ $post->id }}" id="textarea-comment" cols="40" rows="1" placeholder="Write comment.." maxlength="250" data-id="{{ $post->id }}"></textarea>
                                                </div>
                                                <div class="hiddenContent2 col-md-3 ml-auto" id="hiddenContent-{{ $post->id }}">
                                                    <button type="submit" class="btn commentBtn" id="{{ $post->id }}">Comment</button>
                                                </div>
                                            </form>
                                        <div id="comments-{{ $post->id }}">
                                                <p><a href="" class="usernameComment">{{ $post->user->username }}</a> <span class="comment"></span></p>
                                        </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
                
                
                <div class="col-md-4 sidebar2">
                    <h3>sidebar 2</h3>
                </div>
            </div>
        </div>

@endsection