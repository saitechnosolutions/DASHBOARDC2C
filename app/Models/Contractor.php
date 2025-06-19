<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractor extends Model {
    use HasFactory;
    protected $table = 'contractors_master';
    protected $guarded = [];
}