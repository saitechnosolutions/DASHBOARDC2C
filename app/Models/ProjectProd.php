<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProd extends Model {
    use HasFactory;
    protected $table = 'project_prods';
    protected $guarded = [];
}