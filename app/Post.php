<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Post extends Model
{
    //Table name
    protected $table = 'posts';
    //Primary key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    protected $fillable = ['image'];

    public function user(){
      return $this->belongsTo('App\User');
    }
}
