@extends('layouts.app')

@section('content')
    @include('admin.includes.errors')
    <div class="panel panel-default">
        <div class="panel-heading text-center">
           Edit Post : {{ $post->title }}
        </div>
        <div class="panel-body">
            <form action=" {{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('put') }}
                <div class="form-group">
                    <label for="title" >Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $post->title  }}">
                </div>
                <div class="form-group">
                    <label for="image" >Image</label>
                    <input type="file" name="image" class="form-control" value="{{ $post->image  }}">
                    <img src="{{$post->image}}" width="50px" height="50px" alt="{{$post->image}}">
                </div>
                <div class="form-group">
                    <label for="category_id" >Select Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    @if($post->category->id == $category->id)
                                    selected
                                    @endif
                            >{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tag_id"> Select Tag</label>
                    @foreach($tags as $tag)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                       @foreach($post->tags as $tag_post)
                                           @if($tag->id == $tag_post->id)
                                               checked
                                            @endif
                                        @endforeach



                                >{{ $tag->tag }}
                            </label>

                        </div>
                    @endforeach

                </div>

                <div class="form-group">
                    <label for="description">Content</label>
                    <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ $post->description  }}</textarea>
                </div>


                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">
                           Edit Post
                        </button>
                    </div>
                </div>
            </form>




        </div>
    </div>

@endsection
