<?php

use App\Post;
use App\Category;
use Illuminate\Database\Seeder;

class UpdatePostsSeeder extends Seeder
{

    // questo seeder impostato in questo modo assegniamo una categoria casuale a ogni new entry della tabella post

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1.  bisogna prendere tutte le informazioni per poi stamparle
        $posts = Post::all();

        //2. ad ogni ciclo foreach estraggo random un id dalla tabella categories :
        foreach ($posts as $post) {
            $category_id= Category::inRandomOrder()->first()->id;
		    $post->category_id =$category_id;
		    $post->update();
        }
    }
}
