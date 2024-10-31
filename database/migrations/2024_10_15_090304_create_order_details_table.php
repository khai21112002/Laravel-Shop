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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->string('product_name', 50)->collation('utf8mb4_general_ci')->nullable(false);
            $table->string('product_img')->collation('utf8mb4_general_ci')->default(null);
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id','fk_details_order')->references('id')->on('orders')->onDelete('cascade');

            $table->unsignedBigInteger('quantity')->nullable(false);
            $table->decimal('price', 20, 2)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropForeign('fk_details_order');
        });
        Schema::dropIfExists('order_details');
    }
};
