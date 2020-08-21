<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('admin.users.profile', compact('user'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'facebook' => 'required|url',
            'youtube' => 'required|url'
        ]);

        $user = Auth::user();

        if($request->hasFile('avatar'))
        {
            $avatar = $request->avatar;

            $avatar_new_name = time() . $avatar->getClientOriginalName();

            $avatar->move('uploads/posts', $avatar_new_name);

            $user->profile->avatar = 'uploads/posts/' . $avatar_new_name ;

            $user->profile->save();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile->facebook = $request->facebook;
        $user->profile->youtube = $request->youtube;
        $user->profile->about = $request->about;

        $user->save();
        $user->profile->save();

        if($request->has('password'))
        {
            $user->password = bcrypt($request->password);

            $user->save();
        }

        session()->flash('success', 'Account profile updated.');

        return redirect()->route('user.profile');
    }

    public function destroy($id)
    {
        //
    }
}
