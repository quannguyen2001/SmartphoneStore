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
        Schema::create('order_old_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('old_product_id')->nullable();
            $table->foreign('old_product_id')->references('id')->on('old_products')->onDelete('restrict');
            $table->bigInteger('price')->nullable();
            $table->string('user_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('time_order')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_old_products', function (Blueprint $table) {
            $table->dropForeign(['old_product_id']);
        });
        Schema::dropIfExists('order_old_products');
    }
};
