<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();

            // Data Diri Siswa
            $table->string('full_name');
            $table->string('nisn')->unique()->nullable();
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('religion')->nullable(); // Agama

            // Data Akademik Asal
            $table->string('previous_school'); // Asal Sekolah (SMP)
            $table->text('school_address')->nullable(); // Alamat Sekolah Asal
            $table->year('graduation_year')->nullable(); // Tahun Lulus

            // Data Alamat
            $table->text('address'); // Alamat
            $table->string('village')->nullable(); // Desa/Kelurahan
            $table->string('district')->nullable(); // Kecamatan
            $table->string('city')->nullable(); // Kota/Kabupaten

            // Data Orang Tua
            $table->string('father_name');
            $table->string('father_job')->nullable(); // Pekerjaan Ayah
            $table->string('father_phone')->nullable(); // No. HP Ayah
            $table->string('mother_name');
            $table->string('mother_job')->nullable(); // Pekerjaan Ibu
            $table->string('mother_phone')->nullable(); // No. HP Ibu

            // Status Pendaftaran
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
