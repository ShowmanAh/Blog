<?php
namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

/**
 * [
 * 'data' =>'',
 * 'status' => true : false
 * 'error' => ' '
 *
 * ]
 */
trait ApiResponseTrait{
    public $paginateNumber = 10;
    public function apiResponse($data=null, $error=null, $code=200){
        $array = [
            'data' => $data,
            'status' =>in_array($code, $this->successCode()) ? true : false,
            'error' => $error,

        ];
        return response($array,$code);

    }
    //create response
    public function createdResponse($data){
        return $this->apiResponse($data, null,201);
    }
    public function notFoundResponse(){
        return $this->apiResponse(null,'we not found ? ',404);
    }
    //validation
    public function apiValidation(Request $request, $array){
        $validate = validator::make($request->all(), $array);

        if($validate->fails()){
            return $this->apiResponse(null, $validate->errors(),422);
        }
    }

    public function unKnownError(){
        return $this->apiResponse(null, 'un known error', 520);
    }
    public function successCode(){
        return [
            200, 201, 202,
        ];

    }
    // delete response function
    public function deleteResponse(){
        return $this->apiResponse(true, null, 200);
    }



}
