<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupables', function (Blueprint $table) {
            $table->integer('group_id')->unsigned();
            $table->integer('groupable_id')->unsigned();
            $table->string('groupable_type');

            $table->primary(['group_id', 'groupable_id', 'groupable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groupables');
    }
}
