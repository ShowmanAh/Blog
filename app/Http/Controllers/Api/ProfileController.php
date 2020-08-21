<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\ProfileRresource;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use Auth;

class ProfileController extends Controller
{
    private $token;
    use ApiResponseTrait;
  public function findUser($id){
      $user = User::find($id);
      if (($user = Auth::user()) !== null) {
          $user_profile = $user->profile->first();
//dd($user_profile);
        return $this->apiResponse(new ProfileRresource($user_profile));
         // return ProfileRresource::collection($user->profile->first());
      }
      return response('Unauthenticated user');






  }
  public function update(Request $request,$id){
      $this->validate($request,[
          'name'=>'required',
          'email'=>'required|email',
          'facebook'=>'required|url',
          'youtube'=>'required|url',
          'about' =>'required'

      ]);
      $user = User::find($id);

      if($user = Auth::user() !==null ){

          if($request->hasFile('avatar'))
          {
              $avatar = $request->avatar;

              $avatar_new_name = time() . $avatar->getClientOriginalName();

              $avatar->move('uploads/posts', $avatar_new_name);

             // $user->profile->avatar = 'uploads/posts/' . $avatar_new_name ;
                // dd($user->profile->avatar);
              //$user->profile->save();
          }

          $user->name = $request->name;
          dd($user->name);
          $user->email = $request->email;
          $user->profile->facebook = $request->facebook;
          $user->profile->youtube = $request->youtube;
          $user->profile->about = $request->about;
          $user->profile->avatar = 'uploads/posts/' . $avatar_new_name ;

          $user->save();
          $user->profile->save();

          if($request->has('password'))
          {
              $user->password = bcrypt($request->password);

              $user->save();
          }

          return $this->apiResponse(new ProfileRresource($user->profile));
      }else{
          return response('unauthenticated user');
      }




  }
}
