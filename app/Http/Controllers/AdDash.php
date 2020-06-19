<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Image;
use App\User;

class AdDash extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $users = User::all();
        return view('pages.addash')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = User::find($id);

      //Check for admin
      if(auth()->user()->name == "Admin"){
        return view('pages.addashe')->with('user', $user);
      }
      //Check for correct user
      
      return view('pages.addashe')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      request()->validate([
        'name' => 'required',
        'email' => 'required',

      ]);

      //Create post
      $user = User::find($id);
      $user->name = request()->input('name');
      $user->email = request()->input('email');

      if(request()->hasFile('image')){
        request()->validate([
          'image' => 'file|image|max:5000',
        ]);
        $image = request()->file('image');

        $filename = time() . '.' . $image->getClientOriginalExtension();

        Image::make($image)->resize(170,170)->save( public_path('/uploads/avatars/'  . $filename ));

        $user->avatar=$filename;
        $user->save();
      }

      $user->save();

      return redirect('/addash')->with('success','User Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::find($id);

      //Check for admin
      if(auth()->user()->name == "Admin"){
        $user -> delete();
        return redirect('/addash')->with('success','Post Removed');
      }

      $user -> delete();
      return redirect('/addash')->with('success','Post Removed');
    }
}
