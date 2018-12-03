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

            // Section 1 - Contact Information
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('suburb')->nullable();
            $table->string('city');
            $table->string('postcode' ,10);
            $table->string('phone', 30);
            $table->string('mobile', 30)->nullable();
            $table->string('email');

            //Section 2 - Personal Details
            $table->date('dob');
            $table->integer('height')->unsigned();
            $table->integer('current_weight')->unsigned();
            $table->integer('expected_weight')->unsigned()->nullable();
            $table->string('occupation');
            $table->string('employer');
            $table->boolean('is_male');
            $table->boolean('right_handed');
            $table->string('preferred_fight_name')->nullable();
            $table->boolean('can_secure_sponsor');

            //Section 3 - Emergency Contact
            $table->string('emergency_first_name', 30);
            $table->string('emergency_last_name', 30);
            $table->string('emergency_relationship', 30);
            $table->string('emergency_phone', 30);
            $table->string('emergency_mobile', 30)->nullable();
            $table->string('emergency_email');

            //Section 4 - Sporting Experience
            $table->integer('fitness_rating');
            $table->mediumText('boxing_exp')->nullable(); // null if the applicant ticks 'no' on the form 
            $table->mediumText('sporting_exp');
            
            //Section 5 - Medical Questions
            $table->boolean('heart_disease');
            $table->boolean('breathlessness');
            $table->boolean('epilepsy');
            $table->boolean('heart_attack');
            $table->boolean('stroke');
            $table->boolean('heart_surgery');
            $table->boolean('respiratory_problems');
            $table->boolean('cancer');
            $table->boolean('irregular_heartbeat');
            $table->boolean('smoking');
            $table->boolean('joint_pain_problems');
            $table->boolean('chest_pain_discomfort');
            $table->boolean('hypertension');
            $table->boolean('surgery');
            $table->boolean('dizziness_fainting');
            $table->boolean('high_cholesterol');

            $table->mediumText('other')->nullable(); // null if the applicant ticks 'no' on the form
            $table->mediumText('hand_injuries')->nullable(); // null if the applicant ticks 'no' on the form
            $table->mediumText('previous_current_injuries')->nullable(); // null if the applicant ticks 'no' on the form
            $table->mediumText('current_medication')->nullable(); // null if the applicant ticks 'no' on the form

            $table->boolean('heart_condition');
            $table->boolean('chest_pain_activity');
            $table->boolean('chest_pain_recent');
            $table->boolean('lost_consciousness');
            $table->boolean('bone_joint_problems');
            $table->boolean('recommended_medication');
            $table->boolean('concussed_knocked_out');
            $table->mediumText('other_reasons')->nullable(); // null if the applicant ticks 'no' on the form            

            //Section 6 - Additional Information
            $table->mediumText('hobbies')->nullable();
            $table->mediumText('conviction_details')->nullable(); // null if the applicant ticks 'no convictions' and 'not facing charges' on the form
            $table->boolean('consent_to_test');       
            
            // Custom questions answers. Ideally these would be in a separate table to keep the table normalized. 
            $table->string('custom_one', 500)->nullable();
            $table->string('custom_two', 500)->nullable();
            $table->string('custom_three', 500)->nullable();
            $table->string('custom_four', 500)->nullable();
            $table->string('custom_five', 500)->nullable();

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
