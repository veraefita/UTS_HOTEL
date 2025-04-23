<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiKamar extends Model
{
    use HasFactory;

    protected $table = 'reservasi_kamar';
    protected $primaryKey = 'reservasi_id';

    protected $fillable = [
        'kamar_id',
        'nama_tamu',
        'email',
        'nomor_telepon',
        'tanggal_check_in',
        'tanggal_check_out',
        'jumlah_malam',
        'jumlah_orang',
        'total_harga',
        'status_pembayaran'
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kamar_id', 'kamar_id');
    }
}
