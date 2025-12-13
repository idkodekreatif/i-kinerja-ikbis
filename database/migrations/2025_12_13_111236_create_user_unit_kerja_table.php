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
        Schema::create('user_unit_kerja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreignId('unit_kerja_id')
                ->references('id')->on('unit_kerja')
                ->onDelete('cascade');

            $table->date('tmt_mulai');
            $table->date('tmt_selesai')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            $table->timestamps();

            //  boleh unit kerja sama, asal periode beda
            $table->unique(['user_id', 'unit_kerja_id', 'tmt_mulai']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_unit_kerja');
    }
};
