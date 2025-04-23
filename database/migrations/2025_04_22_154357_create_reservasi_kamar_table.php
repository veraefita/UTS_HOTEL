<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservasi_kamar', function (Blueprint $table) {
            $table->id('reservasi_id');
            $table->foreignId('kamar_id')->constrained('kamar', 'kamar_id');
            $table->string('nama_tamu', 100);
            $table->string('email', 100);
            $table->string('nomor_telepon', 20);
            $table->datetime('tanggal_check_in');
            $table->datetime('tanggal_check_out');
            $table->integer('jumlah_malam');
            $table->integer('jumlah_orang');
            $table->decimal('total_harga', 10, 2);
            $table->enum('status_pembayaran', ['lunas', 'belum lunas'])->default('belum lunas');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservasi_kamar');
    }
};