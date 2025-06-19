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
        Schema::create('vendor_offers', function (Blueprint $table) {
            $table->id();
            $table->string('product_id', 255)->nullable();
            $table->string('product_price', 255)->nullable();
            $table->string('offer_price', 255)->nullable();
            $table->string('offer_end_date', 255)->nullable();
            $table->string('offer_status', 255)->nullable()->default('1');
            $table->string('is_deleted', 255)->nullable()->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_offers');
    }
};