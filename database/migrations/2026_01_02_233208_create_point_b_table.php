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
        Schema::create('point_b', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('period_id')->constrained()->cascadeOnDelete();

            // 1. Radio Button Values (B1 - B18)
            foreach (range(1, 18) as $i) {
                $table->tinyInteger("B{$i}")->nullable();
            }

            // 2. Skor Utama per Item
            foreach (range(1, 18) as $i) {
                $table->decimal("scorB{$i}", 10, 2)->default(0);
                $table->decimal("scorMaxB{$i}", 10, 2)->default(0);
                $table->decimal("scorSubItemB{$i}", 10, 3)->default(0);
            }

            // 3. Kolom "Jumlah Yang Dihasilkan" Spesifik (Mengikuti Blade Anda)
            // Kolom ini sering menyebabkan error jika hanya dibuat B1, B2 secara generik
            $spesifik = [
                'B1'  => [2, 3, 4, 5],
                'B2'  => [4, 5],
                'B3'  => [4, 5],
                'B5'  => [5],
                'B6'  => [5],
                'B7'  => [5],
                'B9'  => [3, 5],
                'B10' => [3, 5],
                'B11' => [5],
                'B12' => [5],
                'B13' => [3, 4, 5],
                'B14' => [2, 3, 4, 5],
                'B15' => [3, 4, 5],
                'B17' => [2, 3, 4, 5],
            ];

            foreach ($spesifik as $key => $subItems) {
                foreach ($subItems as $sub) {
                    // Contoh: JumlahYangDihasilkanB1_2
                    $table->integer("JumlahYangDihasilkan{$key}_{$sub}")->default(0);
                    // Contoh: SkorTambahanB1_2
                    $table->decimal("SkorTambahan{$key}_{$sub}", 10, 2)->default(0);
                }
            }

            // 4. Kolom Helper Perhitungan Skor Tambahan (per nomor)
            $kelebihanNomor = [1, 2, 3, 5, 6, 7, 9, 10, 11, 12, 13, 14, 15, 17];
            foreach ($kelebihanNomor as $i) {
                $table->decimal("JumlahSkorYangDiHasilkanB{$i}", 10, 3)->default(0);
                $table->decimal("SkorTambahanJumlahB{$i}", 10, 3)->default(0);
                $table->decimal("SkorTambahanJumlahSkorB{$i}", 10, 3)->default(0);
                $table->decimal("SkorTambahanJumlahBobotSubItemB{$i}", 10, 3)->default(0);
                $table->decimal("TotalKelebihaB{$i}", 10, 3)->default(0); // Digunakan di ringkasan bawah
            }

            // 5. Kolom Total & Nilai Akhir
            $table->decimal('TotalSkorPenelitianPointB', 12, 3)->default(0);
            $table->decimal('TotalKelebihanSkor', 12, 3)->default(0);
            $table->decimal('NilaiPenelitian', 10, 2)->default(0);
            $table->decimal('NilaiTambahPenelitian', 10, 2)->default(0);
            $table->decimal('NilaiTotalPenelitiandanKaryaIlmiah', 10, 2)->default(0);

            // 6. File Bukti (fileB1 - fileB18)
            foreach (range(1, 18) as $i) {
                $table->string("fileB{$i}")->nullable();
            }

            $table->timestamps();
            $table->unique(['user_id', 'period_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_b');
    }
};
