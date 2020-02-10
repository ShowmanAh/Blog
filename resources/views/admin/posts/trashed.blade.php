@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>Posts</h1>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <th>Image</th>
                <th>Title</th>
                <th>Content</th>
                <th>Edit</th>
                <th>Restore</th>
                <th>Delete</th>

                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td><img src="{{$post->image}}" width="50px" height="50px" alt="{{$post->title}}"></td>
                        <td>{{ $post->title  }}</td>
                        <td>{{ $post->description  }}</td>
                        <td>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-xs btn-success"> Edit Post </a>
                        </td>
                        <td>
                            <a href="{{ route('posts.restore', $post->id) }}" class="btn btn-xs btn-primary"> Restore Post </a>
                        </td>
                        <td>
                            <form action="{{ route('posts.remove', $post->id) }}" method="post">
                                {{ csrf_field() }}

                                <button type="submit" class="btn btn-xs btn-danger">Delete Post</button>
                            </form>


                        </td>
                    </tr>
                @endforeach

                </tbody>

            </table>
            {{ $posts->links() }}
        </div>
    </div>

@endsection
