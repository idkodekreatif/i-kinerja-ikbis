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
            // relasi utama
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('period_id')->constrained()->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | B1 – B18 (pilihan)
            |--------------------------------------------------------------------------
            */
            foreach (range(1, 18) as $i) {
                $table->tinyInteger("B{$i}")->nullable();
            }

            /*
            |--------------------------------------------------------------------------
            | Skor utama
            |--------------------------------------------------------------------------
            */
            foreach (range(1, 18) as $i) {
                $table->decimal("scorB{$i}", 8, 2)->default(0);
                $table->decimal("scorMaxB{$i}", 8, 2)->default(0);
                $table->decimal("scorSubItemB{$i}", 8, 3)->default(0);
            }

            /*
            |--------------------------------------------------------------------------
            | Skor tambahan (generik)
            |--------------------------------------------------------------------------
            */
            foreach (range(1, 18) as $i) {
                $table->integer("JumlahYangDihasilkanB{$i}")->nullable();
                $table->decimal("SkorTambahanB{$i}", 8, 2)->default(0);
                $table->decimal("TotalSkorTambahanB{$i}", 8, 3)->default(0);
                $table->decimal("BobotSkorTambahanB{$i}", 8, 3)->default(0);
            }

            /*
            |--------------------------------------------------------------------------
            | Total & Nilai Akhir
            |--------------------------------------------------------------------------
            */
            $table->decimal('TotalSkorPenelitianPointB', 8, 3)->default(0);
            $table->decimal('TotalKelebihanSkor', 8, 3)->default(0);

            $table->decimal('NilaiPenelitian', 8, 2)->default(0);
            $table->decimal('NilaiTambahPenelitian', 8, 2)->default(0);
            $table->decimal('NilaiTotalPenelitiandanKaryaIlmiah', 8, 2)->default(0);

            /*
            |--------------------------------------------------------------------------
            | File Bukti B1 – B18
            |--------------------------------------------------------------------------
            */
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
