<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupSponsorTable extends Migration
{
    /**
     * Run the migrations.
     *
     *  This table serves as a pivot table between the many to many relationship between groups and sponsors
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('group_sponsor', function (Blueprint $table) {
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('sponsor_id');

            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('sponsor_id')->references('id')->on('sponsors')->onDelete('cascade');
            $talbe->primary('group_id', 'sponsor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_sponsor');
    }
}
