<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'description' => 'required',
            'category_id' => 'required',


        ]);


       // dd($request->all());
        $image = $request->image;
        $image_new_name = time().$image->getClientOriginalName();
        $image->move('uploads/posts', $image_new_name);
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => 'uploads/posts/' . $image_new_name,
            'category_id' => $request->category_id,
            'slug' => str_slug($request->title),

        ]);
       // dd($post);
        session()->flash('success', 'Post Added Successfully');
        return redirect()->route('posts.index');

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $categories = Category::all();
       $post = Post::find($id);
       return view('admin.posts.edit', compact('categories','post'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'image' => 'required|image',
            'description' => 'required',
            'category_id' => 'required',


        ]);
        $post = Post::find($id);
        dd($post);

        if ($request->hasFile('image')){
            $image = $request->image;
            $image_new_name = time().$image->getClientOriginalName();
            $image->move('uploads/posts', $image_new_name);
        }
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => 'uploads/posts/' . $image_new_name,
            'category_id' => $request->category_id,
            'slug' => str_slug($request->title),

        ]);

        session()->flash('success', 'Post Updated Successfully');
        return redirect()->route('posts.index');
    }


    public function destroy($id)
    {
       $post = Post::find($id);
       $post->delete();
       session()->flash('success', 'post has trashed');
       return redirect()->route('posts.index');
    }
    public function trashed(){

        $posts = Post::onlyTrashed()->paginate(10);
        //dd($posts);
        return view('admin.posts.trashed')->with('posts',$posts);
    }
    public function restore($id){
        $post = Post::withTrashed()->where('id',$id)->first();
        // dd($post);
        $post->restore();
        session()->flash('success', 'Post Restored successfully');
        return redirect()->route('posts.index');
    }
    public function remove($id){
        $post = Post::withTrashed()->where('id',$id)->first();
       // dd($post);
        $post->forceDelete();
        session()->flash('success', 'Post deleted successfully');
        return redirect()->back();
    }
}
