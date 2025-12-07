<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\User;
use App\Models\Role;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $user = User::firstOrCreate(
            ['email' => strtolower(str_replace(' ', '', $row['nama_siswa'])).'@sekolah.com'],
            [
                'name' => $row['nama_siswa'],
                'password' => Hash::make('password123'),
            ]
        );


        $studentRole = Role::where('name', 'siswa')->first();
        if ($studentRole) {
            $user->roles()->syncWithoutDetaching([$studentRole->id]);
        }


        $schoolClass = SchoolClass::firstOrCreate(['name' => $row['kelas']]);


        $genderText = strtolower(str_replace(['-', ' '], '', $row['jenis_kelamin']));
        $gender = ($genderText == 'lakilaki') ? 'male' : 'female';


        return Student::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nisn'          => $user->id . rand(1000, 9999),
                'jurusan'       => $row['jurusan'],
                'gender'        => $gender,
            ]
        );
    }
}
