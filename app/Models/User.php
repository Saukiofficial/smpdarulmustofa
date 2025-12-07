<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relasi Many-to-Many ke model Role.
     * Satu user bisa memiliki banyak peran.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Relasi One-to-One ke model Teacher.
     * Menandakan bahwa user ini adalah seorang guru.
     */
    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    /**
     * Relasi One-to-One ke model Student.
     * Menandakan bahwa user ini adalah seorang siswa.
     */
    public function student()
    {
        return $this->hasOne(Student::class);
    }

    /**
     * Relasi One-to-Many ke model Post.
     * Menandakan user sebagai penulis post.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
