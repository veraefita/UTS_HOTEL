<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';
    protected $primaryKey = 'kamar_id';
    protected $keyType = 'string'; // Jika ID bukan integer
    public $incrementing = false; // Jika ID bukan auto-increment

    protected $fillable = [
        'kamar_id', // Tambahkan jika ID diisi manual
        'tipe_kamar',
        'deskripsi',
        'harga_per_malam',
        'status',
        'jumlah_kasur',
        'kapasitas',
        
    ];

    protected $casts = [
        'harga_per_malam' => 'integer',
        'jumlah_kasur' => 'integer',
        'kapasitas' => 'integer'
    ];

    public function reservasi()
    {
        return $this->hasMany(ReservasiKamar::class, 'kamar_id');
    }
}