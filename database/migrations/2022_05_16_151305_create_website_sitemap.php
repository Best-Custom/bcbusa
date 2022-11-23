<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteSitemap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sitemap_details', function (Blueprint $table) {
            $table->id();
            $table->string('loc');
            $table->string('lastmod');
            $table->string('changefreq');
            $table->integer('priority')->length(11);
            $table->integer('status')->length(11)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_sitemap');
    }
}
