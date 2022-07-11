<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // inseriamo le informazioni che vogliamo ottenere tramite una variabile $data
        $data = ['Front End', 'Back End', 'Game Designer', 'Playtester', 'Artist Animator', 'Art Director', 'Texture Artist', 'Gameplay Programmer', 'Level Designer', 'Narrative Designer', 'Scriptwriter'];

        foreach ($data as $tag) {
            $new_tag = new Tag();
            $new_tag->name = $tag;
            $new_tag->slug = Str::slug($tag, '-');
            $new_tag->save();
        }
    }
}
