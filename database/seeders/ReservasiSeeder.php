<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservasiSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan KamarSeeder sudah dijalankan terlebih dahulu
        $this->call(KamarSeeder::class);

        DB::table('reservasi_kamar')->insert([
            [
                'reservasi_id' => 1,
                'kamar_id' => 1, // Standard
                'nama_tamu' => 'annisa ',
                'email' => 'nisa@example.com',
                'nomor_telepon' => '081234567891',
                'tanggal_check_in' => Carbon::now()->addDays(2),
                'tanggal_check_out' => Carbon::now()->addDays(5),
                'jumlah_malam' => 3,
                'jumlah_orang' => 2,
                'total_harga' => 1500000, // 3 x 500000
                'status_pembayaran' => 'lunas',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'reservasi_id' => 2,
                'kamar_id' => 2, // Deluxe
                'nama_tamu' => 'aprilia putri',
                'email' => 'april@example.com',
                'nomor_telepon' => '082345678912',
                'tanggal_check_in' => Carbon::now()->addDays(7),
                'tanggal_check_out' => Carbon::now()->addDays(10),
                'jumlah_malam' => 3,
                'jumlah_orang' => 3,
                'total_harga' => 2400000, // 3 x 800000
                'status_pembayaran' => 'belum lunas',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'reservasi_id' => 3,
                'kamar_id' => 3, // Suite
                'nama_tamu' => 'Vera Efita',
                'email' => 'Vera@example.com',
                'nomor_telepon' => '083456789123',
                'tanggal_check_in' => Carbon::now()->addDays(15),
                'tanggal_check_out' => Carbon::now()->addDays(20),
                'jumlah_malam' => 5,
                'jumlah_orang' => 4,
                'total_harga' => 6000000, // 5 x 1200000
                'status_pembayaran' => 'lunas',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'reservasi_id' => 4,
                'kamar_id' => 1, // Standard
                'nama_tamu' => 'Meisy',
                'email' => 'mei@example.com',
                'nomor_telepon' => '084567891234',
                'tanggal_check_in' => Carbon::now()->addDays(25),
                'tanggal_check_out' => Carbon::now()->addDays(27),
                'jumlah_malam' => 2,
                'jumlah_orang' => 1,
                'total_harga' => 1000000, // 2 x 500000
                'status_pembayaran' => 'belum lunas',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'reservasi_id' => 5,
                'kamar_id' => 2, // Deluxe
                'nama_tamu' => 'mas tain',
                'email' => 'tain@example.com',
                'nomor_telepon' => '085678912345',
                'tanggal_check_in' => Carbon::now()->addDays(30),
                'tanggal_check_out' => Carbon::now()->addDays(35),
                'jumlah_malam' => 5,
                'jumlah_orang' => 4,
                'total_harga' => 4000000, // 5 x 800000
                'status_pembayaran' => 'lunas',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}