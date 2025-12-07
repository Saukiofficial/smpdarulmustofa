<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnus extends Model
{
    use HasFactory;

    /**
     *
     *
     *
     * @var string
     */
    protected $table = 'alumni';

    protected $fillable = [
        'name',
        'graduation_year',
        'occupation',
        'photo_path',
    ];

    /**
     * Relasi One-to-Many ke model Testimonial.
     */
    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
}
