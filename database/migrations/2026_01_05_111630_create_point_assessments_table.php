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
        Schema::create('point_assessments', function (Blueprint $table) {
            $table->id();
            $table->string('a_poin', 20);
            $table->string('b_poin', 20);
            $table->string('c_poin', 20);
            $table->string('d_poin', 20);
            $table->string('predikat', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_assessments');
    }
};
