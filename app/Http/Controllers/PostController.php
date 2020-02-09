<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::paginate(5);
        return view('admin.posts.index', compact('posts'));
    }


    public function create()
    {
        $categories = Category::all();
        if($categories->count() == 0)
        {
            session()->flash('info', 'You do not have any category to create Post');
            return redirect()->back();
        }
        return view('admin.posts.create', compact('categories'));
    }


    public function store(Request $request)
    {

        $this->validate($request,[
            'title' => 'required',
            'image' => 'required|image',
            'content' => 'required',
            'category_id' => 'required',


        ]);


        //dd($request->all());
        $image = $request->image;
        $image_new_name = time().$image->getClientOriginalName();
        $image->move('uploads/posts', $image_new_name);
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => 'uploads/posts/' . $image_new_name,
            'category_id' => $request->category_id,

        ]);
        session()->flash('success', 'Post Added Successfully');
        return redirect()->route('posts.index');

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
       $post = Post::find($id);
       $post->delete();
       session()->flash('success', 'post has trashed');
       return redirect()->route('posts.index');
    }
    public function trashed(){
        dd('hhh');
        $posts = Post::onlyTrashed()->get();
        dd($posts);
    }
}
