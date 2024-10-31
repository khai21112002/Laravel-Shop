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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->string('product_name', 50)->collation('utf8mb4_general_ci')->nullable(false);
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id','fk_stat_orders')->references('id')->on('orders')->onDelete('cascade');
            $table->decimal('total_order', 20, 2)->nullable();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('statistics', function (Blueprint $table){
            
            $table->dropForeign('fk_stat_orders');
        });
        Schema::dropIfExists('statistics');
    }
};
