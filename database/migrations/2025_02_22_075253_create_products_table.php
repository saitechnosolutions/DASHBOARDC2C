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
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->string('product_name', 255)->nullable();
            $table->string('product_quantity', 255)->nullable();
            $table->string('product_mrp_price', 255)->nullable();
            $table->string('product_regular_price', 255)->nullable();
            $table->string('product_desc', 255)->nullable();
            $table->string('product_image', 255)->nullable();
            $table->string('product_spec', 255)->nullable();
            $table->string('product_brand_name', 255)->nullable();
            $table->string('product_brand_material', 255)->nullable();
            $table->string('product_brand_type', 255)->nullable();
            $table->string('product_approval_days', 255)->nullable();
            $table->string('product_unit_value', 255)->nullable();
            $table->string('product_product_value', 255)->nullable();
            $table->string('product_cate_name', 255)->nullable();
            $table->string('product_subcate_name', 255)->nullable();
            $table->string('product_size_value', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};