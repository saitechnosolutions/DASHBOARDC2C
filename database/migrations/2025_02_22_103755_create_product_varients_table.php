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
        Schema::create('product_varients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('varient', 255)->nullable();
            $table->string('varient_img', 255)->nullable();
            $table->string('varient_name', 255)->nullable();
            $table->string('value', 255)->nullable();
            $table->string('offer_price', 255)->nullable();
            $table->string('mrp_price', 255)->nullable();
            $table->string('product_qty', 255)->nullable();
            $table->string('low_stock', 255)->nullable();
            $table->string('hot_deals', 255)->nullable()->default('0');
            $table->string('Popular_products', 255)->nullable()->default('0');
            $table->string('product_gst', 255)->nullable();
            $table->string('size_value', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_varients');
    }
};