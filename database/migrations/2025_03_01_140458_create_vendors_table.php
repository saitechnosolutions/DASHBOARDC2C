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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_name', 255)->nullable();
            $table->string('vendor_email', 255)->nullable();
            $table->string('contact_name', 255)->nullable();
            $table->string('contact_phone', 255)->nullable();
            $table->string('business_type', 255)->nullable();
            $table->string('gst_number', 255)->nullable();
            $table->string('vendor_address', 255)->nullable();
            $table->string('vendor_country', 255)->nullable();
            $table->string('vendor_state', 255)->nullable();
            $table->string('vendor_district', 255)->nullable();
            $table->string('vendor_pincode', 255)->nullable();
            $table->string('vendor_bank_name', 255)->nullable();
            $table->string('vendor_account_name', 255)->nullable();
            $table->string('vendor_account_number', 255)->nullable();
            $table->string('vendor_ifsc_number', 255)->nullable();
            $table->string('vendor_status', 255)->nullable()->default('1');
            $table->string('is_deleted', 255)->nullable()->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};