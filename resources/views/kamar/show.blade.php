@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Detail Kamar</h3>
        <div class="card-tools">
            <a href="{{ route('kamar.index') }}" class="btn btn-sm btn-default mt-1">Kembali</a>
        </div>
    </div>
    <div class="card-body">
        @if($kamar)
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>ID Kamar</label>
                    <p>{{ $kamar->kamar_id }}</p>
                </div>
                <div class="form-group">
                    <label>Tipe Kamar</label>
                    <p>{{ $kamar->tipe_kamar }}</p>
                </div>
                <div class="form-group">
                    <label>Harga per Malam</label>
                    <p>Rp {{ number_format($kamar->harga_per_malam, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Jumlah Kasur</label>
                    <p>{{ $kamar->jumlah_kasur }}</p>
                </div>
                <div class="form-group">
                    <label>Kapasitas</label>
                    <p>{{ $kamar->kapasitas }} orang</p>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <p>
                        @if($kamar->status == 'tersedia')
                            <span class="badge badge-success">Tersedia</span>
                        @else
                            <span class="badge badge-danger">Tidak Tersedia</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <p>{{ $kamar->deskripsi ?? '-' }}</p>
        </div>
        @else
        <div class="alert alert-danger">
            Data kamar tidak ditemukan
        </div>
        @endif
    </div>
    @if($kamar)
    <div class="card-footer">
        <a href="{{ route('kamar.edit', $kamar->kamar_id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('kamar.destroy', $kamar->kamar_id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin menghapus data ini?')">Hapus</button>
        </form>
    </div>
    @endif
</div>
@endsection