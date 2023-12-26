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
        Schema::create('old_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict');
            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('restrict');
            $table->string('imei')->nullable();
            $table->bigInteger('new_price')->nullable();
            $table->string('time_buy')->nullable();
            $table->string('time_guarantee')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('restrict');
            $table->string('status_product')->nullable();
            $table->string('status_sale')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('old_products', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
        });
        Schema::table('old_products', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });
        Schema::table('old_products', function (Blueprint $table) {
            $table->dropForeign(['color_id']);
        });
        Schema::dropIfExists('old_products');
    }
};
