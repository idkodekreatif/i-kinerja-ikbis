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
        Schema::create('point_a', function (Blueprint $table) {
            $table->id();
            // relasi utama
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('period_id')->constrained()->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | A1 – A13 (nilai pilihan)
            |--------------------------------------------------------------------------
            */
            foreach (range(1, 13) as $i) {
                $table->tinyInteger("A{$i}")->nullable();
            }

            /*
            |--------------------------------------------------------------------------
            | Skor utama
            |--------------------------------------------------------------------------
            */
            foreach (range(1, 13) as $i) {
                $table->decimal("scorA{$i}", 8, 2)->default(0);
                $table->decimal("scorMaxA{$i}", 8, 2)->default(0);
                $table->decimal("scorSubItemA{$i}", 8, 3)->default(0);
            }

            /*
            |--------------------------------------------------------------------------
            | Tambahan khusus A11
            |--------------------------------------------------------------------------
            */
            $table->integer('JumlahYangDihasilkanA11_5')->nullable();
            $table->decimal('JumlahSkorYangDiHasilkanA11_5', 8, 2)->default(0);
            $table->decimal('JumlahSkorYangDiHasilkanBobotSubItemA11_5', 8, 3)->default(0);

            $table->decimal('SkorTambahanA11_5', 8, 2)->default(0);
            $table->decimal('SkorTambahanJumlahA11_5', 8, 2)->default(0);
            $table->decimal('SkorTambahanJumlahBobotSubItemA11_5', 8, 3)->default(0);

            /*
            |--------------------------------------------------------------------------
            | Tambahan khusus A12
            |--------------------------------------------------------------------------
            */
            $table->integer('JumlahYangDihasilkanA12_3')->nullable();
            $table->integer('JumlahYangDihasilkanA12_4')->nullable();
            $table->integer('JumlahYangDihasilkanA12_5')->nullable();

            $table->decimal('SkorTambahanA12_3', 8, 2)->default(0);
            $table->decimal('SkorTambahanA12_4', 8, 2)->default(0);
            $table->decimal('SkorTambahanA12_5', 8, 2)->default(0);

            $table->decimal('SkorTambahanJumlahA12', 8, 2)->default(0);
            $table->decimal('JumlahSkorYangDiHasilkanA12', 8, 2)->default(0);
            $table->decimal('SkorTambahanJumlahSkorA12', 8, 2)->default(0);
            $table->decimal('SkorTambahanJumlahBobotSubItemA12', 8, 3)->default(0);

            /*
            |--------------------------------------------------------------------------
            | Total & Nilai Akhir
            |--------------------------------------------------------------------------
            */
            $table->decimal('TotalSkorPendidikanPointA', 8, 3)->default(0);
            $table->decimal('TotalKelebihanA11', 8, 3)->default(0);
            $table->decimal('TotalKelebihanA12', 8, 3)->default(0);
            $table->decimal('TotalKelebihanSkor', 8, 3)->default(0);

            $table->decimal('nilaiPendidikandanPengajaran', 8, 2)->default(0);
            $table->decimal('NilaiTambahPendidikanDanPengajaran', 8, 2)->default(0);
            $table->decimal('NilaiTotalPendidikanDanPengajaran', 8, 2)->default(0);

            /*
            |--------------------------------------------------------------------------
            | File Bukti A1 – A13
            |--------------------------------------------------------------------------
            */
            foreach (range(1, 13) as $i) {
                $table->string("fileA{$i}")->nullable();
            }

            $table->timestamps();

            // multi periode aman
            $table->unique(['user_id', 'period_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_a');
    }
};
