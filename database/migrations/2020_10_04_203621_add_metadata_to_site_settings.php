<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetadataToSiteSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            // Setup default values
            $author = "Samuel Grant - https://github.com/samuelgrant, Mitchell Quarrie & Samuel Jackson";
            $description = "Fight for Kidz is a non for profit charity based in Invercargill that rasies funds for Southland Kids.";
            $keywords = "Fight for Kidz, Fight for Kidz Southland, Fight for Kidz Invercargill, f4k, Fight4Kidz, Charity Boxing, Southland, Invercargill";
            $theme_color = "#DC3545";

            $table->string('seo_author', 255)->default($author)->comment('Displayed in HEAD of all pages');
            $table->string('seo_description', 512)->default($description)->comment('Default page description, may be overridden on some pages');
            $table->string('seo_keywords', 255)->default($keywords)->comment('Displayed in HEAD of all pages');
            $table->string('seo_theme_color', 7)->default($theme_color)->comment('Android toolbar & Discord Embed Color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['seo_author', 'seo_description', 'seo_keywords', 'seo_theme_color']);
        });
    }
}
