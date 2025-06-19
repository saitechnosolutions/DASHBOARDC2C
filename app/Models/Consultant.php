<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultant extends Model
{
    use HasFactory;

    protected $table = 'consultants';

    protected $fillable = [
        'name',
        'email',
        'mobile_number',
        'consultant_date',
        'color',
    ];

    protected $casts = [
        'consultant_date' => 'date',
    ];
}
