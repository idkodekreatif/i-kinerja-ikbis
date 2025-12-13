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
        Schema::create('jabatan_fungsional', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('golongan_min')->nullable();
            $table->string('golongan_max')->nullable();
            $table->integer('angka_kredit_min')->default(0);
            $table->integer('angka_kredit_next')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan_fungsional');
    }
};
