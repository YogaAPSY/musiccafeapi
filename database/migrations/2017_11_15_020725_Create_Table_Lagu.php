<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLagu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lagu', function(Blueprint $table){
            $table->increments('id');
            $table->string('judul', 50);
            $table->string('album', 50);
            $table->string('artist', 50);
            $table->string('genre', 30);
            $table->string('tahun', 10);
            $table->string('slug', 60);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
