<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();                

            // Application form fields:
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->string('preferred_nickname')->nullable();
            $table->boolean('is_male');

            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('suburb')->nullable();
            $table->string('city');
            $table->string('postcode');
            $table->string('phone', 30);
            $table->string('mobile', 30);
            $table->string('email')->unique();

            $table->date('dob');
            $table->integer('current_weight')->unsigned();
            $table->integer('expected_weight')->unsigned()->nullable();
            $table->integer('height')->unsigned();
            $table->boolean('right_handed');
            $table->integer('fitness_rating');
            $table->mediumText('sporting_exp');
            $table->mediumText('boxing_exp')->nullable(); // null if the applicant ticks 'no' on the form 
            $table->mediumText('hobbies')->nullable();

            $table->string('occupation');
            $table->string('employer');
            $table->boolean('can_secure_sponsor');
            $table->mediumText('conviction_details')->nullable(); // null if the applicant ticks 'no convictions' and 'not facing charges' on the form
            $table->boolean('consent_to_test');            

            $table->timestamps();

            // Foreign key constraints definition
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
}
