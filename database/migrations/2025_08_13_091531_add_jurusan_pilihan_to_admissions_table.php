    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        public function up(): void
        {
            Schema::table('admissions', function (Blueprint $table) {

                $table->string('jurusan_pilihan')->after('previous_school')->nullable();
            });
        }

        public function down(): void
        {
            Schema::table('admissions', function (Blueprint $table) {
                $table->dropColumn('jurusan_pilihan');
            });
        }
    };
