<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $adminRole = Role::where('name', 'admin')->first();
        $teacherRole = Role::where('name', 'guru')->first();
        $studentRole = Role::where('name', 'siswa')->first();


        $adminUser = User::firstOrCreate(
            ['email' => 'admin@sekolah.com'],
            [
                'name' => 'Admin Sekolah',
                'password' => Hash::make('admin123'),
            ]
        );

        $adminUser->roles()->sync($adminRole->id);


        $teacherUser = User::firstOrCreate(
            ['email' => 'guru@sekolah.com'],
            [
                'name' => 'Guru Pengajar',
                'password' => Hash::make('admin123'),
            ]
        );
        $teacherUser->roles()->sync($teacherRole->id);

        $studentUser = User::firstOrCreate(
            ['email' => 'siswa@sekolah.com'],
            [
                'name' => 'Siswa Belajar',
                'password' => Hash::make('admin123'),
            ]
        );
        $studentUser->roles()->sync($studentRole->id);
    }
}
