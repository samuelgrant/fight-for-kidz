<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();
            $table->integer('sponsor_id')->unsigned()->nullable();
            $table->integer('applicant_id')->unsigned();
            $table->string('team'); // should be 'red' or 'blue'
            $table->string('nickname')->nullable();
            $table->float('weight')->nullable();
            $table->float('height')->nullable();
            $table->float('reach')->nullable();
            $table->timestamps();

            // Foreign key constraints definition
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('sponsor_id')->references('id')->on('sponsors')->onDelete('set null');
            $table->foreign('applicant_id')->references('id')->on('applicants')->onDelete('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contenders');
    }
}
