<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
      $title = 'Welcome to our pet blog!';
      return view('pages.index')->with('title',$title);
    }

    public function about(){
      $title = 'About us';
      return view('pages.about')->with('title',$title);
    }

    public function addash(){
      $title = 'Adashcho';
      return view('pages.addash')->with('title',$title);
    }

    public function services(){
      $data = array(
        'title' => 'Services',
        'services' => ['Dogs','Cats','Fish','Birds']
      );
      return view('pages.services')->with($data);
    }
}
