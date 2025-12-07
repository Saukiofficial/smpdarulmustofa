<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumnus_id',
        'content',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    /**
     * Relasi Many-to-One ke model Alumnus.
     */
    public function alumnus()
    {
        return $this->belongsTo(Alumnus::class);
    }
}
