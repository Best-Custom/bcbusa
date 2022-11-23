<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod_products_detail', function (Blueprint $table) {
            $table->id();
            $table->string('cate_id')->length(50);
            $table->string('prod_title');
            $table->string('prod_slug');
            $table->string('prod_title_image');
            $table->text('prod_multiple_image');
            $table->text('prod_short_description');
            $table->text('prod_detail_description');
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
        Schema::dropIfExists('products_detail');
    }
}
