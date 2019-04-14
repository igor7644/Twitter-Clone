<div class="row header">
    <div class="col-md-8 ml-auto nav">
        <p class="navp"><a href="{{ asset('/home') }}" class="navlink"><i class="fas fa-home"></i> Home</a></p>
        <p class="navp">
            <a href="{{ asset('/notifications') }}" class="navlink">
                <i class="fas fa-bell"></i> Notifications&nbsp;
                @if(Auth::user()->unreadnotifications->count())
                    <span class="badge badge-dark">
                        {{ Auth::user()->unreadnotifications->count() }}
                    </span>
                @endif
            </a>
        </p>
    </div>
    <div class="col-md-2 ml-auto">
        <div class="ddBtn usernameAjax">
            <button class="btn btn-primary dropdown-toggle profile-dd" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{ Auth::user()->username }} </button>

            <div class="dropdown-menu profile-dd-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="{{ asset('/user/'.auth()->user()->username) }}"><i class="fas fa-user"></i> &nbsp; Profile</a>
                <a class="dropdown-item" href="{{ route('logOut') }}"><i class="fas fa-sign-out-alt"></i> &nbsp; Log out</a>
            </div>
        </div>
    </div>
</div>