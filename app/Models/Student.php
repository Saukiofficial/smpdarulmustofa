<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nisn',
        'school_class_id',
        'jurusan',
        'gender',
        'address',
    ];

    /**
     * Relasi One-to-One (inverse) ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi Many-to-One ke model SchoolClass.
     */
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }
}
