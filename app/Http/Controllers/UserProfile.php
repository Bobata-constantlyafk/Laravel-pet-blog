<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Auth;
use Image;

class UserProfile extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function profile()
    {
      return view('profile', array('user'=>Auth::user()));
    }

    public function update_avatar(Request $request){
      if($request->hasFile('avatar'))
      {
        $avatar = $request->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(170,170)->save( public_path('/uploads/avatars/'  . $filename ));

        $avatar->insert(public_path('/uploads/avatars/watermark.png', 'bottom-left'));

        $user = Auth::user();
        $user->avatar=$filename;
        $user->save();
      }
      return view('profile', array('user'=>Auth::user()));
    }

    public function getDashboard()
    {
        $users = User::all();

        return view('dashboard', compact('users'));
    }

  }