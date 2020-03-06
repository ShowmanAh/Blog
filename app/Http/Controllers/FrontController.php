<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Setting;
use App\Tag;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public  function index(){
        $settings = Setting::first();
        $categories = Category::take(4)->get();
        //latest post in db
        $posts = Post::orderBy('created_at','desc')->first();

        $secondPost = Post::orderBy('created_at','desc')->skip(1)->take(1)->get()->first();
       // dd($secondPost);
        $thirdPost = Post::orderBy('created_at','desc')->skip(2)->take(1)->get()->first();

        return view('index',compact('settings','categories','posts','secondPost','thirdPost'));

       // return view('index')->with('title',$settings->site_name);
    }
    public function singlePost($slug){
        $posts = Post::where('slug',$slug)->first();
        $settings = Setting::first();
        $categories = Category::take(4)->get();
        $next_id = Post::where('id', '>', $posts->id)->min('id');

        $prev_id = Post::where('id', '<', $posts->id)->max('id');
        $next = Post::find($next_id);
        $prev = Post::find($prev_id);
        $tags = Tag::all();
        return view('singlePost',compact('posts','settings','categories','next','prev','tags'));

    }
    public function category($id){
        $category = Category::find($id);
        $categories = Category::take(5)->get();
        $settings = Setting::first();
        return view('category',compact('category','categories','settings'));
    }
    public function tag($id){
        $tag = Tag::find($id);
        $categories = Category::take(5)->get();
        $settings = Setting::first();
        return view('tag',compact('tag','categories','settings'));


    }
}
