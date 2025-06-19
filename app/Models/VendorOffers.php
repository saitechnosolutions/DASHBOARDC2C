<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class   VendorOffers extends Model {
    use HasFactory;
    protected $table = 'vendor_offers';
    protected $guarded = [];

    public function product() {
        return $this->belongsTo( Product::class, 'product_id' );
    }
}