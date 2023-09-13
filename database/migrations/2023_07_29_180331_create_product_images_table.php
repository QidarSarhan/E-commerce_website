<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('id');
            // /* $table->integer('product_color_size_id')->unsigned(); */
            $table->integer('product_id')->unsigned();
            // /* $table->foreign('product_color_size_id')->references('id')->on('product_color_size'); */
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('image');

            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
