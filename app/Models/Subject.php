<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
    ];

    /**
     * Relasi One-to-Many ke model Schedule.
     * Satu mata pelajaran bisa ada di banyak jadwal.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
