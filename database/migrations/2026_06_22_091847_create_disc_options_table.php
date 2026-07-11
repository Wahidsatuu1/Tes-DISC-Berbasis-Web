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
        Schema::create('disc_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('disc_question_id')->constrained('disc_questions')->onDelete('cascade');
            $table->string('option_text');
            $table->string('most_type', 2); // D, I, S, C, atau *
            $table->string('least_type', 2); // D, I, S, C, atau *
            $table->timestamps();
        });
    }

    /**
     * Balikkan (rollback) migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('disc_options');
    }
};
