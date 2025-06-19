<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    use HasFactory;
    protected $table = 'product_orders';
    protected $guarded = [];

    public function customer() {
        return $this->belongsTo( User::class, 'user_id', 'user_id' );
    }
}