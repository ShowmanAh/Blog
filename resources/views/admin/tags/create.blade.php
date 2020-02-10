@extends('layouts.app')

@section('content')
   @include('admin.includes.errors')
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Create Tags
        </div>
        <div class="panel-body">
            <form action=" {{ route('tags.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="tag" >Tag</label>
                    <input type="text" name="tag" class="form-control">
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">
                            Add Tags
                        </button>
                    </div>
                </div>
            </form>




        </div>
    </div>

    @endsection
