<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts(){
        Return $this->belongsToMany('App\Post');
    }
}
