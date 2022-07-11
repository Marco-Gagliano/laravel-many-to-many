<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 30; $i++){
            $new_post = new Post();
            $new_post->title = $faker->sentence(4);
            $new_post->slug = Post::generateSlug($new_post->title);
            $new_post->description = $faker->text();
            $new_post->save();
        }
    }
}
