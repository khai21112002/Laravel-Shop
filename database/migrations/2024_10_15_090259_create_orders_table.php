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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('fullname',255)->collation('utf8mb4_general_ci')->nullable(false);
            $table->string('email',255)->collation('utf8mb4_general_ci')->nullable(false);
            $table->string('phone',255)->collation('utf8mb4_general_ci')->nullable(false);
            $table->string('received_address',255)->collation('utf8mb4_general_ci')->nullable(false);
            $table->unsignedInteger('payment_method')->default(0);
            $table->unsignedInteger('status')->nullable()->default(0);

            $table->decimal('total_amount',20,2)->nullable()->default(null);
            $table->string('order_code',20)->collation('utf8mb4_general_ci')->nullable(false)->index();

            $table->foreign('user_id','fk_orders_users')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('fk_orders_users');
            $table->dropIndex(['order_code']);
        });
        Schema::dropIfExists('orders');

    }
};
