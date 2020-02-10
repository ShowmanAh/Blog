@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>Tags</h1>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <th>Tags Name</th>
                <th>Edit</th>
                <th>Delete</th>

                </thead>
                <tbody>
               @if($tags->count() > 0)
                   @foreach($tags as $tag)
                       <tr>
                           <td>{{ $tag->tag }}</td>
                           <td>
                               <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-xs btn-info"> Edit </a>
                           </td>
                           <td>
                               <form action="{{ route('tags.destroy', $tag->id) }}" method="post">
                                   {{ csrf_field() }}
                                   {{ method_field('delete') }}
                                   <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                               </form>


                           </td>
                       </tr>
                   @endforeach
                   @else
                   <tr>
                       <th colspan="5" class="text-lg-center text-danger"> No Tags Exist</th>
                   </tr>
                @endif


                </tbody>

            </table>
            {{ $tags->links() }}
        </div>
    </div>

    @endsection
