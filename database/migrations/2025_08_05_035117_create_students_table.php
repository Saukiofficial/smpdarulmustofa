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
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // bigIncrements
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nisn')->unique();
            $table->foreignId('school_class_id')->constrained()->onDelete('cascade');
            $table->enum('gender', ['male', 'female']);
            $table->text('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
