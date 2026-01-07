<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('point_c', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('period_id')->constrained()->cascadeOnDelete();

            // 1. Radio Button Values (C1 - C9) - NULLABLE
            foreach (range(1, 9) as $i) {
                $table->tinyInteger("C{$i}")->nullable();
            }

            // 2. Skor Utama per Item - NULLABLE dengan default 0
            foreach (range(1, 9) as $i) {
                $table->decimal("scorC{$i}", 10, 2)->nullable()->default(0);
                $table->decimal("scorMaxC{$i}", 10, 2)->nullable()->default(0);
                $table->decimal("scorSubItemC{$i}", 10, 3)->nullable()->default(0);
            }

            // 3. Kolom "Jumlah Yang Dihasilkan" Spesifik - NULLABLE
            $spesifik = [
                'C1' => [2, 3, 4, 5],
                'C2' => [2, 3, 4, 5],
                'C3' => [4, 5], // Khusus C3 hanya ada kolom 4 dan 5
                'C4' => [2, 3, 4, 5],
                'C5' => [2, 3, 4, 5],
                'C6' => [2, 3, 4, 5],
                'C7' => [2, 3, 4, 5],
                'C8' => [2, 3, 4, 5],
                'C9' => [2, 3, 4, 5],
            ];

            foreach ($spesifik as $key => $subItems) {
                foreach ($subItems as $sub) {
                    // Contoh: JumlahYangDihasilkanC1_2 - INTEGER NULLABLE
                    $table->integer("JumlahYangDihasilkan{$key}_{$sub}")->nullable()->default(0);
                    // Contoh: SkorTambahanC1_2 - DECIMAL NULLABLE
                    $table->decimal("SkorTambahan{$key}_{$sub}", 10, 2)->nullable()->default(0);
                }
            }

            // 4. Kolom Helper Perhitungan Skor Tambahan (per nomor) - NULLABLE
            $kelebihanNomor = [1, 2, 3, 4, 5, 6, 7, 8, 9];
            foreach ($kelebihanNomor as $i) {
                $table->decimal("JumlahSkorYangDiHasilkanC{$i}", 10, 3)->nullable()->default(0);
                $table->decimal("SkorTambahanJumlahC{$i}", 10, 3)->nullable()->default(0);
                $table->decimal("SkorTambahanJumlahSkorC{$i}", 10, 3)->nullable()->default(0);
                $table->decimal("SkorTambahanJumlahBobotSubItemC{$i}", 10, 3)->nullable()->default(0);
                $table->decimal("TotalKelebihaC{$i}", 10, 3)->nullable()->default(0);
            }

            // 5. Kolom Total & Nilai Akhir - NULLABLE
            $table->decimal('TotalSkorPengabdianKepadaMasyarakat', 12, 3)->nullable()->default(0);
            $table->decimal('TotalKelebihanSkor', 12, 3)->nullable()->default(0);
            $table->decimal('NilaiPengabdianKepadaMasyarakat', 10, 2)->nullable()->default(0);
            $table->decimal('NilaiTambahPengabdianKepadaMasyarakat', 10, 2)->nullable()->default(0);
            $table->decimal('NilaiTotalPengabdianKepadaMasyarakat', 10, 2)->nullable()->default(0);

            // 6. File Bukti (fileC1 - fileC9) - NULLABLE
            foreach (range(1, 9) as $i) {
                $table->string("fileC{$i}")->nullable();
            }

            $table->timestamps();
            $table->unique(['user_id', 'period_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('point_c');
    }
};
