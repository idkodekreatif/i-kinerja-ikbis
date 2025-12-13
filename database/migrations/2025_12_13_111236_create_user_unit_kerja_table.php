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

            $table->string('status', 20)->default('aktif')->comment('aktif, nonaktif, system');

            $table->timestamps();
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
