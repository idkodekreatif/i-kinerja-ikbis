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
        Schema::create('komponen_poin', function (Blueprint $table) {
            $table->id();
            $table->string('nama_komponen')->unique(); // Pendidikan, Penelitian, Pengabdian, Penunjang
            $table->decimal('non_jad', 5, 2)->nullable()->comment('Non-JAD');
            $table->decimal('aa', 5, 2)->nullable()->comment('Asisten Ahli');
            $table->decimal('lektor', 5, 2)->nullable();
            $table->decimal('lk', 5, 2)->nullable()->comment('Lektor Kepala');
            $table->decimal('gb', 5, 2)->nullable()->comment('Guru Besar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komponen_poin');
    }
};
