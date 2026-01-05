<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('point_d', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('period_id')->constrained()->cascadeOnDelete();

            // 1. Radio Button Values (D1 - D11) - NULLABLE
            foreach (range(1, 11) as $i) {
                $table->tinyInteger("D{$i}")->nullable();
            }

            // 2. Skor Utama per Item - NULLABLE dengan default 0
            foreach (range(1, 11) as $i) {
                $table->decimal("scorD{$i}", 10, 2)->nullable()->default(0);
                $table->decimal("scorMaxD{$i}", 10, 2)->nullable()->default(0);
                $table->decimal("scorSubItemD{$i}", 10, 3)->nullable()->default(0);
            }

            // 3. Kolom "Jumlah Yang Dihasilkan" Spesifik untuk Point D - NULLABLE
            $spesifik = [
                'D2' => [2, 3, 4, 5], // Kepanitiaan
                'D3' => [2, 3, 4, 5], // Peranan dalam kepanitiaan
                'D4' => [3, 4, 5],    // Mitra bestari jurnal
                'D5' => [3, 4, 5],    // Redaktur/editor terbitan
                'D6' => [2, 3, 4, 5], // Organisasi asosiasi profesi
                'D7' => [5],          // Delegasi internasional (>4)
                'D8' => [3, 4, 5],    // Pertemuan ilmiah
                'D9' => [2, 3, 4, 5], // Tanda jasa/penghargaan
                'D10' => [3, 4, 5],   // Buku pelajaran
                'D11' => [3, 4, 5],   // Prestasi olahraga/kesenian
                // D1 tidak punya jumlah tambahan
            ];

            foreach ($spesifik as $key => $subItems) {
                foreach ($subItems as $sub) {
                    // Contoh: JumlahYangDihasilkanD2_2 - INTEGER NULLABLE
                    $table->integer("JumlahYangDihasilkan{$key}_{$sub}")->nullable()->default(0);
                    // Contoh: SkorTambahanD2_2 - DECIMAL NULLABLE
                    $table->decimal("SkorTambahan{$key}_{$sub}", 10, 2)->nullable()->default(0);
                }
            }

            // 4. Kolom Helper Perhitungan Skor Tambahan (per nomor) - NULLABLE
            $kelebihanNomor = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
            foreach ($kelebihanNomor as $i) {
                $table->decimal("JumlahSkorYangDiHasilkanD{$i}", 10, 3)->nullable()->default(0);
                $table->decimal("SkorTambahanJumlahD{$i}", 10, 3)->nullable()->default(0);
                $table->decimal("SkorTambahanJumlahSkorD{$i}", 10, 3)->nullable()->default(0);
                $table->decimal("SkorTambahanJumlahBobotSubItemD{$i}", 10, 3)->nullable()->default(0);
                $table->decimal("TotalKelebihaD{$i}", 10, 3)->nullable()->default(0);
            }

            // 5. Kolom Total & Nilai Akhir - NULLABLE
            $table->decimal('TotalSkorUnsurPenunjang', 12, 3)->nullable()->default(0);
            $table->decimal('TotalKelebihanSkor', 12, 3)->nullable()->default(0);
            $table->decimal('NilaiUnsurPenunjang', 10, 2)->nullable()->default(0);
            $table->decimal('NilaiTambahUnsurPenunjang', 10, 2)->nullable()->default(0);
            $table->decimal('ResultSumNilaiTotalUnsurPenunjang', 10, 2)->nullable()->default(0);

            // 6. File Bukti (fileD1 - fileD11) - NULLABLE
            foreach (range(1, 11) as $i) {
                $table->string("fileD{$i}")->nullable();
            }

            $table->timestamps();
            $table->unique(['user_id', 'period_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('point_d');
    }
};
