<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniBoard extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'photo_path',
        'display_order',
    ];
}
