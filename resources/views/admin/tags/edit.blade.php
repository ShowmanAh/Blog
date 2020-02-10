@extends('layouts.app')

@section('content')
    @if(count($errors) > 0)
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item text-danger">
                    {{ $error }}

                </li>
            @endforeach
        </ul>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Edit Tag
        </div>
        <div class="panel-body">
            <form action=" {{ route('tags.update',  $tag->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{method_field('put')}}
                <div class="form-group">
                    <label for="tag" >Tag</label>
                    <input type="text" name="tag" class="form-control" value="{{ $tag->tag }}">
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">
                           Edit Tag
                        </button>
                    </div>
                </div>
            </form>




        </div>
    </div>

@endsection
