<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PainterProjects extends Model {
    use HasFactory;
    protected $table = 'painter_project_images';
    protected $guarded = [];
}