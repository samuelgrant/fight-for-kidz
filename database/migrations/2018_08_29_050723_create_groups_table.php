<?php

use App\Groups;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->unique();
            $table->string('type', 30)->nullable()->default('Custom Group');
            $table->boolean('custom_icon')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        $groupAdmins = new Groups();
        $groupAdmins->name = "Administrators";
        $groupAdmins->type = "System Group";
        $groupAdmins->save();
        Log::debug('Administrators group created');

        $groupSubs = new Groups();
        $groupSubs->name = "Subscribers";
        $groupSubs->type = "System Group";
        $groupSubs->save();
        Log::debug('Subscribers group created');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
