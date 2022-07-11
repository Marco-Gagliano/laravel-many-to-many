<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();

            //qui creiamo la FK (Foreign Key) per i posts
            $table->unsignedBigInteger('post_id');

            // qui creiamo la FK (Foreign Key) della colonna appena creata
            $table->foreign('post_id')
                  ->references('id')
                  ->on('posts')
                  ->onDelete('cascade');
                  // CASCADE = all’eliminazione di un post o un tag a cascata viene eliminato il record della tabella

            //qui creiamo la FK (Foreign Key) per i tags
            $table->unsignedBigInteger('tag_id');

            // qui creiamo la FK (Foreign Key) della colonna appena creata
            $table->foreign('tag_id')
                  ->references('id')
                  ->on('tags')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
