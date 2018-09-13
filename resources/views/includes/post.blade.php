<div class="col-md-7 mr-auto posts">
    <p class="post-author"><a href="" class="usernamePost">{{ $post->user->username }}</a><span class="hours"> &nbsp {{ Carbon\Carbon::parse($post->created_at)->diffForHumans()}} </span></p>
    <p class="text">{{ $post->text }}</p>
    <div class="row numberOf">
        <div class="numOfLikes">
            <i class="far fa-heart"> &nbsp;4</i> &nbsp; &nbsp;
        </div>
        <div class="numOfComments-{{ $post->id }}">
            <i class="far fa-comment-alt"> &nbsp;{{ $post->numberOfComments() }}</i>
        </div>
    </div>

    <!-- Large modal -->
    @include('includes.postModal')

</div>


