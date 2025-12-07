<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $table = 'school_classes';

    protected $fillable = [
        'name',
        'homeroom_teacher_id',
    ];

    /**
     * Relasi Many-to-One ke model Teacher.
     * Menunjukkan wali kelas dari kelas ini.
     */
    public function homeroomTeacher()
    {
        return $this->belongsTo(Teacher::class, 'homeroom_teacher_id');
    }

    /**
     * Relasi One-to-Many ke model Student.
     * Satu kelas memiliki banyak siswa.
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Relasi One-to-Many ke model Schedule.
     * Satu kelas memiliki banyak jadwal pelajaran.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
