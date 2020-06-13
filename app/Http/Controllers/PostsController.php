<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Image;
use Barryvdh\DomPDF\Facade as PDF;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        //$posts = Post::orderBy('title','desc')->get();

        $posts = Post::orderBy('created_at','desc')->paginate(3);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        request()->validate([
          'title' => 'required',
          'body' => 'required',
  
        ]);

        //Create post
        $post = new Post;
        $post->title = request()->input('title');
        $post->body = request()->input('body');
        $post->user_id = auth()->user()->id;

        if(request()->hasFile('image')){
          request()->validate([
            'image' => 'file|image|max:5000',
          ]);

          
          $image = request()->file('image');
          $imagep = Image::make($image);
          $imagep->pixelate(35);
          
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $filenamep=  "p" . $filename;

          Image::make($image)->resize(170,170)->save( public_path('/uploads/pics/'  . $filename ));
          Image::make($imagep)->resize(170,170)->save( public_path('/uploads/pics/'  . $filenamep));
          
          $post->image=$filename;
          $post->imagep=$filenamep;
          $post->save();
        }

        $post->save();

        return redirect('/posts')->with('success','Post Created');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        //Check for admin
        if(auth()->user()->name == "Admin"){
          return view('posts.edit')->with('post', $post);
        }
        //Check for correct user
        if(auth()->user()->id !==$post->user_id){
          return redirect('/posts')->with('error','Unauthorized page');
        }
        
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
      request()->validate([
        'title' => 'required',
        'body' => 'required',

      ]);

      //Create post
      $post = Post::find($id);
      $post->title = request()->input('title');
      $post->body = request()->input('body');

      if(request()->hasFile('image')){
        request()->validate([
          'image' => 'file|image|max:5000',
        ]);
        $image = request()->file('image');
        $imagep = Image::make($image);
        $imagep->pixelate(35);

        $filename = time() . '.' . $image->getClientOriginalExtension();
        $filenamep=  "p" . $filename;

        Image::make($image)->resize(170,170)->save( public_path('/uploads/pics/'  . $filename ));
        Image::make($imagep)->resize(170,170)->save( public_path('/uploads/pics/'  . $filenamep));

        $post->imagep=$filenamep;
        $post->image=$filename;
        $post->save();
      }

      $post->save();

      return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        //Check for admin
        if(auth()->user()->name == "Admin"){
          $post -> delete();
          return redirect('/posts')->with('success','Post Removed');
        }

        //Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','Unauthorized page');
        }
        
        $post -> delete();
        return redirect('/posts')->with('success','Post Removed');

    }

}
