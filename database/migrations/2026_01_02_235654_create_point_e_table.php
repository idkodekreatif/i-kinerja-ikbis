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
        Schema::create('point_e', function (Blueprint $table) {
            $table->id();
            /* ================= RELASI ================= */
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('period_id')->nullable();

            /* ================= E1 (1–6) ================= */
            foreach (range(1, 6) as $i) {
                $key = "E1_{$i}";

                $table->enum($key, ['1', '2', '3', '4', '5'])->nullable();
                $table->float("scor{$key}", 8, 0)->default(0);
                $table->float("scorMax{$key}", 8, 0)->default(0);
                $table->float("scorSubItem{$key}", 8, 3)->default(0);
                $table->string("file{$key}")->nullable();
            }

            /* ================= E2 (1–4) ================= */
            foreach (range(1, 4) as $i) {
                $key = "E2_{$i}";

                $table->enum($key, ['1', '2', '3', '4', '5'])->nullable();
                $table->float("scor{$key}", 8, 0)->default(0);
                $table->float("scorMax{$key}", 8, 0)->default(0);
                $table->float("scorSubItem{$key}", 8, 3)->default(0);
                $table->string("file{$key}")->nullable();
            }

            /* ================= REKAP ================= */
            $table->float('SumSkor', 8, 3)->default(0);
            $table->float('NilaiUnsurPengabdian', 8, 2)->default(0);

            /* ================= FOREIGN KEY ================= */
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('period_id')
                ->references('id')
                ->on('periods')
                ->cascadeOnDelete();

            /* ================= UNIQUE ================= */
            $table->unique(['user_id', 'period_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_e');
    }
};
