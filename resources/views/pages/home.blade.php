@extends('layouts.layout')
@section('title', 'Home | Social Blog')
@section('body')

    @include('includes.header')    

    <div class="container-fluid" style="background-color:#E6ECF0">
        
        @include('includes.postForm')

        <div class="row dashboard">

            @foreach ($posts as $post)
                @include('includes.post')
            @endforeach
            
        </div>
    </div>

@endsection