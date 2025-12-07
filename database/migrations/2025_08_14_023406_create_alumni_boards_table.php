    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        public function up(): void
        {
            Schema::create('alumni_boards', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('position');
                $table->string('photo_path');
                $table->integer('display_order')->default(0);
                $table->timestamps();
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('alumni_boards');
        }
    };
