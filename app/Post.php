<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{

    // Per ottenere $post->category, laravel esegue la "join", restituendo la relazione come proprietà
    // Perchè avvenga tutto ciò, bisogna creare un metodo publico con il nome della relazione

    public function category(){
        return $this->belongsTo('App\Category');
    }


    // creo la relazione many to many con i tags per ottenere $post->tags
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }


    protected $fillable = [
        'title',
        'slug',
        'description',
        'category_id'
    ];


    public static function generateSlug($title){

        $slug = Str::slug($title, '-');
        $slug_base = $slug;

        // cerco l'esistenza dello "slug"
        $actual_post = Post::where('slug', $slug)->first();
        $counter = 1;

        // se lo trovo, ne genero uno univoco con un contatore
        while($actual_post){
            $slug = $slug_base . '-' . $counter;
            $counter++;
            $actual_post = Post::where('slug', $slug)->first();
        }

        return $slug;
    }
}
