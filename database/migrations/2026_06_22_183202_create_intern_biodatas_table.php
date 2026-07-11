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
        Schema::create('intern_biodatas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('no_identitas');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('fakultas');
            $table->string('semester');
            $table->string('universitas');
            $table->text('alamat');
            $table->string('no_telepon');
            $table->string('nama_orang_tua');
            $table->string('pekerjaan_orang_tua')->nullable();
            $table->text('alamat_orang_tua');
            $table->string('no_telepon_orang_tua');
            $table->string('pembimbing');
            $table->string('no_telepon_pembimbing');
            $table->string('durasi_magang');
            $table->date('mulai');
            $table->date('sampai');
            $table->timestamps();
        });
    }

    /**
     * Balikkan (rollback) migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('intern_biodatas');
    }
};
