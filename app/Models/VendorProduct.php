<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorProduct extends Model {
    use HasFactory;
    protected $table = 'vendor_products';
    protected $guarded = [];

    public function product() {
        return $this->belongsTo( Product::class );
    }

}