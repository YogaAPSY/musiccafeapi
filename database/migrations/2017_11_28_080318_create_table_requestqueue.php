<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRequestqueue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('request_queue', function(Blueprint $table){
            $table->increments('id');
            $table->enum('played', [0,1])->default(0);

            $table->integer('music_id')->unsigned();
            $table->foreign('music_id')->refrences('id')->on('lagu');
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
