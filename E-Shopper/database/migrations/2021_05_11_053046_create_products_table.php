<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->integer('category_id');
            $table->integer('manufacture_id');
            $table->text('product_name');
            $table->longText('product_short_description');
            $table->longText('product_long_description');
            $table->float('product_price');
            $table->string('product_image');
            $table->string('product_video');
            $table->string('product_size');
            $table->string('product_color');
            $table->tinyInteger('publication_status');
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
        Schema::dropIfExists('products');
    }
}
