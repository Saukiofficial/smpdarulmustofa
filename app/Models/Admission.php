<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'registration_number',
        'full_name',
        'nisn',
        'gender',
        'birth_place',
        'birth_date',
        'religion',
        'previous_school',
        'school_address',
        'graduation_year',
        'address',
        'village',
        'district',
        'city',
        'father_name',
        'father_job',
        'father_phone',
        'mother_name',
        'mother_job',
        'mother_phone',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date',
    ];


    public function documents()
    {
        return $this->hasMany(AdmissionDocument::class);
    }
}
