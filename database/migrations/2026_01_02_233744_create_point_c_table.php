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
        Schema::create('point_c', function (Blueprint $table) {
            $table->id();
            // Relasi utama (SAMA DENGAN A & B)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('period_id')->constrained()->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | C1 – C9 (pilihan)
            |--------------------------------------------------------------------------
            */
            foreach (range(1, 9) as $i) {
                $table->tinyInteger("C{$i}")->nullable();
            }

            /*
            |--------------------------------------------------------------------------
            | Skor utama
            |--------------------------------------------------------------------------
            */
            foreach (range(1, 9) as $i) {
                $table->decimal("scorC{$i}", 8, 2)->default(0);
                $table->decimal("scorMaxC{$i}", 8, 2)->default(0);
                $table->decimal("scorSubItemC{$i}", 8, 3)->default(0);
            }

            /*
            |--------------------------------------------------------------------------
            | Skor tambahan (fleksibel & konsisten)
            |--------------------------------------------------------------------------
            */
            foreach (range(1, 9) as $i) {
                $table->integer("JumlahYangDihasilkanC{$i}")->nullable();
                $table->decimal("SkorTambahanC{$i}", 8, 2)->default(0);
                $table->decimal("TotalSkorTambahanC{$i}", 8, 3)->default(0);
                $table->decimal("BobotSkorTambahanC{$i}", 8, 3)->default(0);
            }

            /*
            |--------------------------------------------------------------------------
            | Total & Nilai Akhir
            |--------------------------------------------------------------------------
            */
            $table->decimal('TotalSkorPengabdian', 8, 3)->default(0);
            $table->decimal('TotalKelebihanSkor', 8, 3)->default(0);

            $table->decimal('NilaiPengabdian', 8, 2)->default(0);
            $table->decimal('NilaiTambahPengabdian', 8, 2)->default(0);
            $table->decimal('NilaiTotalPengabdianKepadaMasyarakat', 8, 2)->default(0);

            /*
            |--------------------------------------------------------------------------
            | File Bukti C1 – C9
            |--------------------------------------------------------------------------
            */
            foreach (range(1, 9) as $i) {
                $table->string("fileC{$i}")->nullable();
            }

            $table->timestamps();

            // Kunci 1 data / user / periode
            $table->unique(['user_id', 'period_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_c');
    }
};
