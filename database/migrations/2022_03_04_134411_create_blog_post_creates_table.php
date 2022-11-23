<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostCreatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_post_creates', function (Blueprint $table) {
            $table->id();
            $table->text('blog_title');
            $table->text('blog_slug');
            $table->text('blog_tag');
            $table->text('blog_des');
            $table->string('blog_title_img');
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
        Schema::dropIfExists('blog_post_creates');
    }
}
