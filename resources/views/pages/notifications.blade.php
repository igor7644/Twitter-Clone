@extends('layouts.layout')
@section('title', 'Notifications | Social Blog')
@section('body')

    @include('includes.header')

    <div class="container-fluid" style="background-color:#E6ECF0">
        <div class="row">
            <div class="col-md-6 offset-md-3 notifications">
                <h3><b>Notifications</b></h3><br>
                @if(Auth::user()->unreadnotifications->count())
                    <form action="{{ asset('/markasread') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary markAsRead">Mark All As Read</button>
                    </form>
                @endif
                @foreach (Auth::user()->unReadNotifications as $notification)
                    <div class="card notificationCard">
                        <i class="far fa-bell" style="margin-top:20px;"></i>
                        <div class="card-body">
                            <p>{{ $notification->data['name'] }} {{ $notification->data['lastName'] }} (<a href="{{ asset('/user/'.$notification->data['username']) }}">{{ $notification->data['username'] }}</a>) started following you!</p>
                        </div>
                        <div class="card-footer">
                        <small class="text-muted">
                            <p>{{ $notification->created_at->diffForHumans() }}</p>
                        </small>
                        </div>
                    </div>
                @endforeach
                @foreach (Auth::user()->readNotifications as $notification)
                    <div class="card notificationCard readNotification">
                        <i class="far fa-bell-slash" style="margin-top:20px;"></i>
                        <div class="card-body">
                            <p>{{ $notification->data['name'] }} {{ $notification->data['lastName'] }} (<a href="{{ asset('/user/'.$notification->data['username']) }}">{{ $notification->data['username'] }}</a>) started following you!</p>
                        </div>
                        <div class="card-footer">
                        <small class="text-muted">
                            <p>{{ $notification->created_at->diffForHumans() }}</p>
                        </small>
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
        
    </div>

@endsection