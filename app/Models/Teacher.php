<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nip',
        'mapel',
        'gender',
        'phone_number',
        'address',
    ];

    /**
     * Relasi One-to-One (inverse) ke model User.
     * Setiap profil guru terhubung ke satu akun user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi One-to-One ke model SchoolClass.
     * Menandakan guru ini sebagai wali kelas.
     */
    public function homeroomClass()
    {
        return $this->hasOne(SchoolClass::class, 'homeroom_teacher_id');
    }

    /**
     * Relasi One-to-Many ke model Schedule.
     * Satu guru bisa mengajar di banyak jadwal.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
