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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->collation('utf8mb4_general_ci')->nullable(false)->unique();

            $table->string('slug')->unique();
            $table->unsignedBigInteger('category_id');

            $table->foreign('category_id','fk_products_category')->references('id')->on('categories')->onDelete('cascade');
            $table->longText('description')->collation('utf8mb4_general_ci');
            $table->decimal('price', 20, 2)->nullable(false);
            $table->unsignedBigInteger('stock')->default(0);
            $table->tinyInteger('is_hot')->default(0);
            $table->tinyInteger('is_new')->default(0);
            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop foreign key constraint for categories
            $table->dropForeign('fk_products_category');
        });

        Schema::dropIfExists('products');
    }
};
