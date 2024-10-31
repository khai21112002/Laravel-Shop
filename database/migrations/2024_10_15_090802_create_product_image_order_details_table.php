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
        Schema::create('product_image_order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_image_id');
            $table->unsignedBigInteger('order_detail_id');
            $table->foreign('product_image_id','fk_img_order_product_image')->references('id')->on('product_images');
            $table->foreign('order_detail_id','fk_img_order_order_detail')->references('id')->on('order_details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_image_order_details', function (Blueprint $table){
            $table->dropForeign('fk_img_order_product_image');
            $table->dropForeign('fk_img_order_order_detail');
        });
        Schema::dropIfExists('product_image_order_details');
    }
};
