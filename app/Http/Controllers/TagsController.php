<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{

    public function index()
    {
       $tags = Tag::paginate(10);
       return view('admin.tags.index', compact('tags'));
    }


    public function create()
    {
      return view('admin.tags.create');
    }


    public function store(Request $request)
    {
       $request->validate([
           'tag' => 'required',
       ]);
       //dd($request->tag);
       Tag::create([
           'tag' => $request->tag,
       ]);
       session()->flash('success', 'Tag Added Successfully');
       return redirect()->route('tags.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
       $tag = Tag::find($id);
       return view('admin.tags.edit', compact('tag'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'tag' => 'required',
        ]);
       $tag = Tag::find($id);
       $tag->update([
           'tag' => $request->tag,
       ]);
       session()->flash('success', 'Tag Updated Successfully');
       return redirect()->route('tags.index');
    }


    public function destroy($id)
    {
       $tag = Tag::find($id);
       $tag->delete();
        session()->flash('success', 'Tag Deleted Successfully');
        return redirect()->route('tags.index');

    }
}
