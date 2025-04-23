@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Detail Reservasi</h3>
        <div class="card-tools">
            <a href="{{ route('reservasi.index') }}" class="btn btn-sm btn-default mt-1">Kembali</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>ID Reservasi</label>
                    <p>{{ $reservasi->reservasi_id }}</p>
                </div>
                <div class="form-group">
                    <label>Nama Tamu</label>
                    <p>{{ $reservasi->nama_tamu }}</p>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <p>{{ $reservasi->email }}</p>
                </div>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <p>{{ $reservasi->nomor_telepon }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tipe Kamar</label>
                    <p>{{ $reservasi->kamar->tipe_kamar ?? 'Data tidak tersedia' }}</p>
                </div>
                <div class="form-group">
                    <label>Tanggal Check In</label>
                    <p>{{ $reservasi->tanggal_check_in ? \Carbon\Carbon::parse($reservasi->tanggal_check_in)->format('d/m/Y') : '-' }}</p>
                    <p>{{ $reservasi->tanggal_check_out ? \Carbon\Carbon::parse($reservasi->tanggal_check_out)->format('d/m/Y') : '-' }}</p>
                </div>
                <div class="form-group">
                    <label>Jumlah Malam</label>
                    <p>{{ $reservasi->jumlah_malam }}</p>
                </div>
                <div class="form-group">
                    <label>Jumlah Orang</label>
                    <p>{{ $reservasi->jumlah_orang }}</p>
                </div>
                <div class="form-group">
                    <label>Total Harga</label>
                    <p>Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</p>
                </div>
                <div class="form-group">
                    <label>Status Pembayaran</label>
                    <p>
                        @if($reservasi->status_pembayaran == 'lunas')
                            <span class="badge badge-success">Lunas</span>
                        @else
                            <span class="badge badge-danger">Belum Lunas</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('reservasi.edit', $reservasi->reservasi_id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('reservasi.destroy', $reservasi->reservasi_id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin menghapus data ini?')">Hapus</button>
        </form>
    </div>
</div>
@endsection