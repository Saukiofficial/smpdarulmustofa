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
        Schema::create('admission_documents', function (Blueprint $table) {
            $table->id(); // bigIncrements
            $table->foreignId('admission_id')->constrained()->onDelete('cascade');
            $table->string('document_name');
            $table->string('file_path', 2048);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admission_documents');
    }
};
