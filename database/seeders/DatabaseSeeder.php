<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolClass;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        SchoolClass::firstOrCreate(['name' => 'Kelas 10']);
        SchoolClass::firstOrCreate(['name' => 'Kelas 11']);
        SchoolClass::firstOrCreate(['name' => 'Kelas 12']);

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
