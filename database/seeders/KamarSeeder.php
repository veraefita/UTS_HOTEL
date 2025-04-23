<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class KamarSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kamar')->insert([
            [
                'tipe_kamar' => 'Standard',
                'deskripsi' => 'Kamar standar dengan 1 tempat tidur',
                'harga_per_malam' => 500000,
                'status' => 'tersedia',
                'jumlah_kasur' => 1,
                'kapasitas' => 2,
                'foto_kamar' => 'kamar-standard.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tipe_kamar' => 'Deluxe',
                'deskripsi' => 'Kamar deluxe dengan 2 tempat tidur',
                'harga_per_malam' => 800000,
                'status' => 'tersedia',
                'jumlah_kasur' => 2,
                'kapasitas' => 4,
                'foto_kamar' => 'kamar-deluxe.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tipe_kamar' => 'Suite',
                'deskripsi' => 'Kamar suite mewah dengan fasilitas lengkap',
                'harga_per_malam' => 1200000,
                'status' => 'tersedia',
                'jumlah_kasur' => 2,
                'kapasitas' => 4,
                'foto_kamar' => 'kamar-suite.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}