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
        Schema::create('point_d', function (Blueprint $table) {
            $table->id();
            // RELASI UTAMA (SAMA DENGAN A, B, C)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('period_id')->constrained()->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | D1 – D11 (ENUM → TINYINT, FUNGSI SAMA)
            |--------------------------------------------------------------------------
            */
            foreach (range(1, 11) as $i) {
                $table->tinyInteger("D{$i}")->nullable();
                $table->decimal("scorD{$i}", 8, 2)->default(0);
                $table->decimal("scorMaxD{$i}", 8, 2)->default(0);
                $table->decimal("scorSubItemD{$i}", 8, 3)->default(0);
            }

            /*
            |--------------------------------------------------------------------------
            | SKOR TAMBAHAN (TETAP DETAIL, TIDAK DIHILANGKAN)
            |--------------------------------------------------------------------------
            */
            foreach (range(2, 11) as $i) {
                $table->integer("JumlahYangDihasilkanD{$i}_2_in")->nullable();
                $table->decimal("SkorTambahanD{$i}_2", 8, 2)->default(0);

                $table->integer("JumlahYangDihasilkanD{$i}_3_in")->nullable();
                $table->decimal("SkorTambahanD{$i}_3", 8, 2)->default(0);

                $table->integer("JumlahYangDihasilkanD{$i}_4_in")->nullable();
                $table->decimal("SkorTambahanD{$i}_4", 8, 2)->default(0);

                $table->integer("JumlahYangDihasilkanD{$i}_5_in")->nullable();
                $table->decimal("SkorTambahanD{$i}_5", 8, 2)->default(0);

                $table->decimal("SkorTambahanJumlahD{$i}", 8, 3)->default(0);
                $table->decimal("JumlahSkorYangDiHasilkanD{$i}", 8, 3)->default(0);
                $table->decimal("SkorTambahanJumlahSkorD{$i}", 8, 3)->default(0);
                $table->decimal("SkorTambahanJumlahBobotSubItemD{$i}", 8, 3)->default(0);
            }

            /*
            |--------------------------------------------------------------------------
            | TOTAL & NILAI AKHIR (TETAP)
            |--------------------------------------------------------------------------
            */
            $table->decimal('TotalSkorUnsurPenunjang', 8, 3)->default(0);

            foreach (range(2, 11) as $i) {
                $table->decimal("TotalKelebihaD{$i}", 8, 3)->default(0);
            }

            $table->decimal('TotalKelebihanSkor', 8, 3)->default(0);
            $table->decimal('NilaiUnsurPenunjang', 8, 2)->default(0);
            $table->decimal('NilaiTambahUnsurPenunjang', 8, 2)->default(0);
            $table->decimal('ResultSumNilaiTotalUnsurPenunjang', 8, 2)->default(0);

            /*
            |--------------------------------------------------------------------------
            | FILE BUKTI D1 – D11
            |--------------------------------------------------------------------------
            */
            foreach (range(1, 11) as $i) {
                $table->string("fileD{$i}")->nullable();
            }

            $table->timestamps();

            // 1 DATA / USER / PERIODE
            $table->unique(['user_id', 'period_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_d');
    }
};
