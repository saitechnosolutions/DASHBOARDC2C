<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PainterCategory extends Model {
    use HasFactory;
    protected $table = 'painter_category';
    protected $guarded = [];
}