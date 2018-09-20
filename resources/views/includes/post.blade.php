<div class="col-md-7 mr-auto posts">
    <p class="post-author"><a href="" class="usernamePost">{{ $post->user->username }}</a><span class="hours"> &nbsp {{ Carbon\Carbon::parse($post->created_at)->diffForHumans()}} </span></p>
    <p class="text">{{ $post->text }}</p>
    <div class="row numberOf">
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

    <!-- Large modal -->
    @include('includes.postModal')

</div>
