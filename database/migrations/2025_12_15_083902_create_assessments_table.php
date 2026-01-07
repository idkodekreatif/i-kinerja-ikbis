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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->string('lecturer_name');
            $table->string('academic_year');
            $table->string('semester');

            // Skor A.1
            $table->integer('A1_score')->nullable();
            $table->integer('A1_max_score')->default(5);
            $table->decimal('A1_weighted_score', 5, 2)->nullable();
            $table->string('fileA1')->nullable();

            // Total
            $table->decimal('total_score', 8, 2)->default(0);
            $table->decimal('final_score', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
