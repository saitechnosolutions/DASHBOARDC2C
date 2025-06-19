<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Painter extends Model {
    use HasFactory;
    protected $table = 'painters';
    protected $guarded = [];
}