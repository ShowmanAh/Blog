<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponseTrait;
    public function register(Request $request){
        //dd('hkk');
        $validateDate = $request->validate([
            'name'=>'required|max:55',
            'email'=>'email|required|unique:users',
            'password'=>'required|confirmed'

        ]);
        $validateDate['password'] = bcrypt($request->password);
        $user = User::create($validateDate);
        $accessToken = $user->createToken('authToken')->accessToken;
        if($user){
            return $this->apiResponse(['user' => $user, 'access_token' => $accessToken]);
        }else{
            return $this->notFoundResponse();
        }
        //return response(['user' => $user, 'access_token' => $accessToken]);


    }
    public function login(Request $request){
        $loginData = $request->validate([
            'email' => 'required',
            'password' => 'required'


        ]);
        if(!auth()->attempt($loginData)){
            return response(['message'=>'No Data Cardentails']);

        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
            return response(['user'=>auth()->user(),'access_token'=>$accessToken]);

    }
}
