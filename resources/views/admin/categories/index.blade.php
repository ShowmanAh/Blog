@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>Categories</h1>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <th>Category Name</th>
                <th>Edit</th>
                <th>Delete</th>

                </thead>
                <tbody>
               @if($categories->count() > 0)
                   @foreach($categories as $category)
                       <tr>
                           <td>{{ $category->name }}</td>
                           <td>
                               <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-xs btn-info"> Edit </a>
                           </td>
                           <td>
                               <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                                   {{ csrf_field() }}
                                   {{ method_field('delete') }}
                                   <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                               </form>


                           </td>
                       </tr>
                   @endforeach
                   @else
                   <tr>
                       <th colspan="5" class="text-lg-center text-danger"> No Categories Exist</th>
                   </tr>
                @endif


                </tbody>

            </table>
            {{ $categories->links() }}
        </div>
    </div>

    @endsection
