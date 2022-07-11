<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Tag;

class PostsTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 40; $i++) {

            // qui estraggo randomicamente un post
            $post = Post::inRandomOrder()->first();

            // qui estraggo randomicamente l'ID di un tag
            $tag_id = Tag::inRandomOrder()->first()->id;

            // Inserisco il dato nella tabella ponte con il metodo "Attach";
            // Con "->attach()" viene inserita nella tabella ponte. Ad attach posso passare un singolo dato o un array di id
            $post->tags()->attach($tag_id);
        }
    }
}
