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
            $table->string('name')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('restrict');
            $table->bigInteger('price')->nullable();
            $table->bigInteger('old_price')->nullable();
            $table->string('year')->nullable();
            $table->string('screen')->nullable();
            $table->string('port')->nullable();
            $table->string('software')->nullable();
            $table->string('camera_sau')->nullable();
            $table->string('camera_truoc')->nullable();
            $table->string('chip')->nullable();
            $table->string('ram')->nullable();
            $table->string('rom')->nullable();
            $table->string('sim')->nullable();
            $table->string('pin')->nullable();
            $table->string('link')->nullable();
            $table->string('accessories')->nullable();
            $table->string('promotion')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
        });
        Schema::dropIfExists('products');
    }
};
