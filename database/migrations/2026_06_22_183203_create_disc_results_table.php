<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('disc_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('intern_biodata_id')->nullable()->constrained('intern_biodatas')->onDelete('cascade');
            $table->json('answers')->nullable(); // Simpan jawaban raw
            $table->integer('score_d_most')->default(0);
            $table->integer('score_i_most')->default(0);
            $table->integer('score_s_most')->default(0);
            $table->integer('score_c_most')->default(0);
            $table->integer('score_star_most')->default(0);
            
            $table->integer('score_d_least')->default(0);
            $table->integer('score_i_least')->default(0);
            $table->integer('score_s_least')->default(0);
            $table->integer('score_c_least')->default(0);
            $table->integer('score_star_least')->default(0);
            
            $table->integer('score_d_change')->default(0);
            $table->integer('score_i_change')->default(0);
            $table->integer('score_s_change')->default(0);
            $table->integer('score_c_change')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Balikkan (rollback) migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('disc_results');
    }
};
