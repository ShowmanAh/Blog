<?php

namespace App\Http\Controllers;
use Session;
use App\User;
use App\Profile;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
       $users = User::all();

        return view('admin.users.index', compact('users'));
    }

      public function create()
    {
        return view('admin.users.create');
    }

       public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email'
        ]);
        //dd($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password')
        ]);

        $profile = Profile::create([
            'user_id' => $user->id,
            'avatar' => 'uploads/avatars/1.png'
        ]);

        session()->flash('success', 'User added successfully.');

        return redirect()->route('users');
    }

       public function show($id)
    {
        //
    }

      public function edit($id)
    {
        //
    }

      public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        $user = User::find($id);

        $user->profile->delete();

        $user->delete();

        Session::flash('success', 'User deleted.');

        return redirect()->back();
    }
    public function admin($id) {

        $user = User::find($id);

        $user->admin = 1;
        $user->save();

        Session::flash('success', 'Successfully changed user permissions.');

        return redirect()->back();
    }

    public function not_admin($id) {

        $user = User::find($id);

        $user->admin = 0;
        $user->save();

        Session::flash('success', 'Successfully changed user permissions.');

        return redirect()->back();

    }
}
