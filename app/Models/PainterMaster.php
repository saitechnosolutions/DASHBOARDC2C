<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PainterMaster extends Model {
    use HasFactory;
    protected $table = 'painter_masters';
    protected $guarded = [];
}