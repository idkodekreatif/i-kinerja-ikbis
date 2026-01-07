<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('point_e', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('period_id')->constrained()->cascadeOnDelete();

            // 1. Radio Button Values untuk Point E - NULLABLE
            // E.1.1 sampai E.1.6 dan E.2.1 sampai E.2.4
            $eItems = [
                'E1_1',
                'E1_2',
                'E1_3',
                'E1_4',
                'E1_5',
                'E1_6',
                'E2_1',
                'E2_2',
                'E2_3',
                'E2_4'
            ];

            foreach ($eItems as $item) {
                $table->tinyInteger($item)->nullable();
            }

            // 2. Skor Utama per Item - NULLABLE dengan default 0
            foreach ($eItems as $item) {
                $table->decimal("scor{$item}", 10, 2)->nullable()->default(0);
                $table->decimal("scorMax{$item}", 10, 2)->nullable()->default(0);
                $table->decimal("scorSubItem{$item}", 10, 3)->nullable()->default(0);
            }

            // 3. Kolom Total & Nilai Akhir - NULLABLE
            $table->decimal('SumSkor', 12, 3)->nullable()->default(0);
            $table->decimal('NilaiUnsurPengabdian', 10, 2)->nullable()->default(0);

            // 4. File Bukti (fileE1_1 - fileE2_4) - NULLABLE
            foreach ($eItems as $item) {
                $table->string("file{$item}")->nullable();
            }

            $table->timestamps();
            $table->unique(['user_id', 'period_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('point_e');
    }
};
