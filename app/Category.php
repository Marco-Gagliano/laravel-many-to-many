<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    // Per ottenere $category->post, laravel esegue la "join", restituendo la relazione come proprietà
    // Perchè avvenga tutto ciò, bisogna creare un metodo publico con il nome della relazione

    public function posts(){
        return $this->hasMany('App\Post');
    }
}
