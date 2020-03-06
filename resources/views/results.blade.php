@extends('layouts.asside.front')
@section('content')

    <div class="container">
        <div class="row medium-padding120">
            <main class="main">

                <div class="row">
                    @foreach($posts as $post)
                        @if($posts->count() > 0)
                            <div class="case-item-wrap">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="case-item">
                                        <div class="case-item__thumb">
                                            <img src="{{ $post->image }}" alt="our case">
                                        </div>
                                        <h6 class="case-item__title"><a href="{{ route('post.single',['slug'=>$post->slug]) }}">{{ $post->title }}</a></h6>
                                    </div>
                                </div>


                            </div>
                            @else
                            <h1 class="text-center">
                                No Results Found
                            </h1>
                            @endif

                    @endforeach
                </div>



            </main>
        </div>
    </div>
@endsection
