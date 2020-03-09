<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    public function index(){
        $categories = CategoryResource::collection(Category::paginate($this->paginateNumber));
        return $this->apiResponse($categories);
    }
    public function show($id){
        $category = Category::find($id);
        if($category){
            return $this->apiResponse(new CategoryResource($category));
        }else{
            return $this->notFoundResponse();
        }
    }
    public function store(Request $request){
        $validateData = $request->validate([
            'name' => 'required',
        ]);
        $catecory = Category::create($validateData);
        if($catecory){
            return $this->createdResponse(new CategoryResource($catecory));
        }else{
            return $this->unKnownError();
        }
    }
    public function update(Request $request,$id){
        $validateData = $request->validate([
            'name' => 'required',
        ]);
        $category = Category::find($id);
        if(!$category){
            return $this->notFoundResponse();
        }
        $category->update($validateData);
        if ($category){
            return $this->apiResponse(new CategoryResource($category));
        }else{
            return $this->unKnownError();
        }

    }
    public function destroy($id){
       $category = Category::find($id);
       if($category){
           $category->delete();
           return $this->deleteResponse();
       }else{
           $this->notFoundResponse();

       }
    }

}
