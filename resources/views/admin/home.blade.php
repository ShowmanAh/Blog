@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            @if(Auth::check())


            <div class="col-lg-3">

                <div class="panel panel-info" style="border: #4c110f;padding: 20px;background-color: #00adef;box-shadow: #0b0b0b">

                    <a class="panel-heading text-center" href="{{ route('posts.index') }}">Published Posts</a>
                    <div class="panel-body">
                        <h1 class="text-center"> {{ $publishedPosts->count() }}</h1>
                    </div>

                </div>
            </div>

            <div class="col-lg-3" >

                <div class="panel panel-danger"style="border: #4c110f;padding: 20px;background-color: rebeccapurple;box-shadow: #0b0b0b">

                    <a class="panel-heading text-center" href="{{ route('posts.trashed') }}">Trashed Posts</a>
                    <div class="panel-body">
                        <h1 class="text-center"> {{ $trashedPosts->count() }}</h1>
                    </div>
                       
                </div>
            </div>

            <div class="col-lg-3">
                @if(Auth::user()->admin)
                <div class="panel panel-success" style="border: #4c110f;padding: 20px;background-color: green;box-shadow: #0b0b0b">

                    <a class="panel-heading text-center" href="{{ route('users') }}">
                        USERS
                    </a>
                    <div class="panel-body">
                        <h1 class="text-center"> {{$users->count()}}
                        </h1>
                    </div>
                        @endif
                </div>
            </div>

            <div class="col-lg-3">
                @if(Auth::user()->admin)
                <div class="panel panel-info" style="border: #4c110f;padding: 20px;background-color: darkslategrey;box-shadow: #0b0b0b" >

                    <a class="panel-heading text-center" href="{{ route('categories.index') }}">Categories</a>
                    <div class="panel-body">
                        <h1 class="text-center"> {{ $categories->count() }}</h1>
                    </div>
                        @endif
                </div>
            </div>
       @endif
        </div>
    </div>

@endsection
