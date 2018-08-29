<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupApplicantTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * This table serves as a pivot table between the many to many relationship between groups and applicants
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_applicant', function (Blueprint $table) {
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('applicant_id');

            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('applicant_id')->references('id')->on('applicants')->onDelete('cascade');
            $talbe->primary('group_id', 'applicant_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_applicant');
    }
}
