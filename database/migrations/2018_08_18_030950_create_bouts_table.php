<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bouts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();
            $table->integer('sponsor_id')->unsigned()->nullable();
            $table->string('name');
            $table->integer('red_contender_id')->unsigned()->nullable();
            $table->integer('blue_contender_id')->unsigned()->nullable();
            $table->integer('victor_id')->unsigned()->nullable();
            $table->string('video_url')->nullable();
            $table->timestamps();

            // Foreign key constraint definition
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('red_contender_id')->references('id')->on('contenders')->onDelete('cascade');
            $table->foreign('blue_contender_id')->references('id')->on('contenders')->onDelete('cascade');
            $table->foreign('victor_id')->references('id')->on('contenders')->onDelete('cascade');
            $table->foreign('sponsor_id')->references('id')->on('sponsors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bouts');
    }
}
