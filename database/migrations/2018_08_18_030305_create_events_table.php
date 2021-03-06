<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->datetime('datetime');
            $table->string('charity')->nullable();
            $table->string('charity_url')->nullable();
            $table->string("event_sponsor")->nullable();
            $table->string('venue_name');
            $table->string('venue_address');
            $table->string('venue_gps')->nullable();
            $table->string('desc_1', 2000)->nullable();
            $table->string('desc_2', 2000)->nullable();
            $table->string('ticket_seller_url')->nullable();  
            $table->boolean('is_public')->default(false);
            $table->boolean('open')->default(false);
            $table->boolean('show_bouts')->default(false);
            $table->boolean('show_auctions')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        
        Schema::dropIfExists('events');        
    }
}
