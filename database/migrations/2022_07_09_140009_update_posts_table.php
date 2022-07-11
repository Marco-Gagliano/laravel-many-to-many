<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {

            //1. Creo la colonna della Foreign key
            $table->unsignedBigInteger('category_id')->nullable()->after('id');

	        //2. Assegno la foreign key alla colonna creata
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {

            //1. Elimino la foreign key (N.B. nel "nome_id" si aspetta un array, altrimenti il terminale da errore)
            $table->dropForeign(['category_id']);

            //2. Elimino la colonna
            $table->dropColumn('category_id');
        });

    }
}
