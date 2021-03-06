<button type="button" class="btn btn-primary showPost" data-toggle="modal" data-target=".post-{{ $post->id }}" value="{{ $post->id }}">Show this thread</button><br><br>

<div class="post-{{ $post->id }} modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="thread" class="thread">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><p class="post-author"><a href="{{ asset('/user/'.$post->user->username) }}" class="usernamePost">{{ $post->user->username }}</a></p></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <p class="text">{{ $post->text }}</p>
                <div class="row modal-numberOf numberOf"><p class="date"><span class="hours"> {{ $post->created_at->format('H:i - j M Y') }} </span> 
                    &nbsp; &nbsp; &nbsp; &nbsp; 
                    <div class="numOfLikes-{{ $post->id }}">
                        @if(auth()->user()->likes->contains($post->id))
                            <i class="fas fa-heart unlike" data-id="{{ $post->id }}"> &nbsp;{{ $post->numberOfLikes() }}</i> &nbsp; &nbsp;
                        @else 
                            <i class="far fa-heart like" data-id="{{ $post->id }}"> &nbsp;{{ $post->numberOfLikes() }}</i> &nbsp; &nbsp;
                        @endif
                    </div>
                    <div class="numOfComments-{{ $post->id }}">
                        <i class="far fa-comment-alt"> &nbsp;{{ $post->numberOfComments() }}</i>
                    </div>
                </div>
                
                <form action="" method="POST" class="row">
                    <input type="hidden" class="postid" value="{{ $post->id }}">
                    <div class="form-group comment-border-focus col-md-9">
                    <textarea class="form-control textarea-comment comment-{{ $post->id }}" id="textarea-comment" cols="40" rows="1" placeholder="Write comment.." maxlength="250" data-id="{{ $post->id }}"></textarea>
                    </div>
                    <div class="hiddenContent2 col-md-3 ml-auto" id="hiddenContent-{{ $post->id }}">
                        <button type="submit" class="btn commentBtn" id="{{ $post->id }}">Comment</button>
                    </div>
                </form>
                <div id="comments-{{ $post->id }}" class="comments">

                </div>
                <div id="reply-{{ $post->id }}">
                    
                </div>
            </div>
        </div>
    </div>
</div>