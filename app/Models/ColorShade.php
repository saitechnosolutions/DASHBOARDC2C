<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorShade extends Model {

    protected $table = 'color_shades';
    protected $guarded = [];
    use HasFactory;

    public function colorFamily() {
        return $this->belongsTo( ColorFamily::class, 'color_fam_id' );
    }
}