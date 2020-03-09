<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    use ApiResponseTrait;
    public function index(){
        $tags = TagResource::collection(Tag::paginate($this->paginateNumber));
        return $this->apiResponse($tags);
    }
    public function show($id){
        $tag = Tag::find($id);
        if($tag){
            return $this->apiResponse(new TagResource($tag));
        }else{
            return $this->notFoundResponse();
        }
    }
    public function store(Request $request){
        $validateData = $request->validate([
            'tag' => 'required',
        ]);
        $tag = Tag::create($validateData);
        if($tag){
            return $this->createdResponse(new TagResource($tag));
        }else{
            return $this->unKnownError();
        }
    }
    public function update(Request $request,$id){
        $validateData = $request->validate([
            'tag' => 'required',
        ]);
        $tag = Tag::find($id);
        if(!$tag){
            return $this->notFoundResponse();
        }
        $tag->update($validateData);
        if ($tag){
            return $this->apiResponse(new TagResource($tag));
        }else{
            return $this->unKnownError();
        }

    }
    public function destroy($id){
        $tag = Tag::find($id);
        if($tag){
            $tag->delete();
            return $this->deleteResponse();
        }else{
            $this->notFoundResponse();

        }
    }

}
