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
        return view('addashe')->with('user', $user);
      }
      //Check for correct user
      if(auth()->user()->id !==$post->user_id){
        return redirect('/addashe')->with('error','Unauthorized page');
      }
      
      return view('addashe')->with('user', $user);
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
        //
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

      //Check for correct user
      if(auth()->user()->id !==$post->user_id){
          return redirect('/addash')->with('error','Unauthorized page');
      }
      
      $user -> delete();
      return redirect('/addash')->with('success','Post Removed');
    }
}
