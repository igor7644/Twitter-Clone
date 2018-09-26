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
            
            <div class="col-md-4 sidebar2">
                <h3>sidebar 2</h3>
            </div>
        </div>
    </div>

@endsection