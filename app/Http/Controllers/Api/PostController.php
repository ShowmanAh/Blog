<?php

namespace App\Http\Controllers\Api;
use Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
   use ApiResponseTrait;
   public function index(){
       return PostResource::collection(Post::with('category','tags','user')->paginate($this->paginateNumber));
   }
   public function store(Request $request){
       $this->validate($request,[
           'title' => 'required',
           'image' => 'required|image',
           'description' => 'required',
           'category_id' => 'required',
           'tag_id' => 'required'


       ]);
       $image = $request->image;
       $image_new_name = time().$image->getClientOriginalName();
       $image->move('uploads/posts', $image_new_name);
       //dd($request->all());

       $post = Post::create([
           'title' =>$request->title,
           'description' =>$request->description,
           'image' => 'uploads/posts/' . $image_new_name,
           'category_id' =>$request->category_id,
           'tag_id'=>$request->tag_id,
           'user_id' =>  $request->user_id,
           'slug' => str_slug($request->title),

       ]);
       //dd($post);
       if($post){
           return $this->apiResponse(new PostResource($post));
       }else{
           return $this->notFoundResponse();
       }

   }
   public function show($id){
       $post = Post::find($id);
      if($post){
          return $this->apiResponse(new PostResource($post));
      }else{
          return $this->notFoundResponse();
      }

   }
   public function update(Request $request, $id){
       $this->validate($request,[
           'title' => 'required',
           'image' => 'required|image',
           'description' => 'required',
       ]);
       if($request->hasFile('image')){
           $image = $request->image;
           $image_new_name = time().$image->getClientOriginalName();
           $image->move('uploads/posts', $image_new_name);
       }
       $post = Post::find($id);

       $post->update([
           'title' =>$request->title,
           'description' =>$request->description,
           'image' => 'uploads/posts/' . $image_new_name,

       ]);
       if($post){
           return $this->apiResponse(new PostResource($post));
       }else{
           $this->notFoundResponse();

       }


   }
   public function destroy($id){
       $post = Post::find($id);
       if($post){
           $post->delete();
           return $this->apiResponse($post);
       }else{
           return $this->notFoundResponse();
       }
   }

}
