<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Setting;
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
}
