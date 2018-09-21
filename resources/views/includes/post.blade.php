<div class="col-md-7 mr-auto posts">
    <div class="row insidePost">
            <p class="post-author"><a href="" class="usernamePost">{{ $post->user->username }}</a><span class="hours"> &nbsp {{ Carbon\Carbon::parse($post->created_at)->diffForHumans()}} </span></p>
            @if(auth()->user()->id == $post->user->id)
            <div class="dropdown ml-auto delete-dd">
                    <a class="dropdown-toggle fas fa-angle-down delete-dropdown"  data-toggle="dropdown"></a>
                    <span class="caret"></span>
                    <div class="dropdown-menu delete-dd-menu" aria-labelledby="dropdownMenuLink">
                        <form action="{{ asset('/posts/'.$post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="submit dropdown-item deletePost" href=""><i class="far fa-trash-alt"></i> &nbsp; Delete Post</button>
                        </form>
                    </div>
                  </div>
                {{-- <a class="ml-auto" href="">Delete</a> --}}
            @endif
    </div>
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
