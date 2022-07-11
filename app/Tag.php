<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // creo la relazione many to many con i posts per ottenere $tag->posts
    public function posts(){
        Return $this->belongsToMany('App\Post');
    }
}
