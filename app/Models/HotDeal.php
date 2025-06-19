<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotDeal extends Model {
    use HasFactory;
    protected $table = 'hot_deals';
    protected $guarded = [];
}