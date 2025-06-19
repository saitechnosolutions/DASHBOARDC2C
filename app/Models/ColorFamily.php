<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorFamily extends Model {
    protected $table = 'color_family';
    protected $guarded = [];
    use HasFactory;
}