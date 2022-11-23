<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_products', function (Blueprint $table) {
            $table->id();
            $table->integer('cate_id');
            $table->string('prod_title');
            $table->string('prod_slug');
            $table->string('prod_title_image');
            $table->string('prod_multiple_image');
            $table->text('prod_short_description');
            $table->text('prod_detail_description');
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
        Schema::dropIfExists('store_products');
    }
}
