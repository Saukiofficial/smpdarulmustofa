<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'admin'], [
            'description' => 'Administrator'
        ]);

        Role::firstOrCreate(['name' => 'guru'], [
            'description' => 'Pengajar'
        ]);

        Role::firstOrCreate(['name' => 'siswa'], [
            'description' => 'Pelajar'
        ]);
    }
}
