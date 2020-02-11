@extends('layouts.app')

@section('content')
    @include('admin.includes.errors')
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Create A New Post
        </div>
        <div class="panel-body">
            <form action=" {{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title" >Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="image" >Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category_id" >Select Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tag_id"> Select Tag</label>
                    @foreach($tags as $tag)
                       <div class="checkbox">
                           <label>
                               <input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->tag }}
                           </label>

                       </div>
                        @endforeach

                </div>

                <div class="form-group">
                    <label for="description">Content</label>
                    <textarea name="description" id="description" cols="5" rows="5" class="form-control"></textarea>
                </div>


                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">
                            Add Post
                        </button>
                    </div>
                </div>
            </form>




        </div>
    </div>

    @endsection

@section('style')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
@endsection
@section('script')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
</script>
@endsection