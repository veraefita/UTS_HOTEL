@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Data Reservasi</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('/reservasi/'.$reservasi->reservasi_id) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="kamar_id">Kamar</label>
                <select class="form-control @error('kamar_id') is-invalid @enderror" 
                        id="kamar_id" name="kamar_id" required>
                    @foreach($kamars as $kamar)
                        <option value="{{ $kamar->kamar_id }}" 
                            {{ old('kamar_id', $reservasi->kamar_id) == $kamar->kamar_id ? 'selected' : '' }}>
                            {{ $kamar->tipe_kamar }} (Rp {{ number_format($kamar->harga_per_malam, 0, ',', '.') }}/malam)
                        </option>
                    @endforeach
                </select>
                @error('kamar_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Harus Dipilih</small>
            </div>
            
            <div class="form-group">
                <label for="nama_tamu">Nama Tamu</label>
                <input type="text" class="form-control @error('nama_tamu') is-invalid @enderror" 
                       id="nama_tamu" name="nama_tamu" 
                       value="{{ old('nama_tamu', $reservasi->nama_tamu) }}" 
                       required minlength="3" maxlength="100">
                @error('nama_tamu')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Minimal 3 karakter, maksimal 100 karakter</small>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" 
                       value="{{ old('email', $reservasi->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Minimal 3 karakter, maksimal 100 karakter</small>
            </div>
            
            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon</label>
                <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" 
                       id="nomor_telepon" name="nomor_telepon" 
                       value="{{ old('nomor_telepon', $reservasi->nomor_telepon) }}" 
                       required minlength="10" maxlength="15">
                @error('nomor_telepon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">maksimal 1-12 karakter</small>
            </div>
            
            <div class="form-group">
                <label for="tanggal_check_in">Tanggal Check In</label>
                <input type="date" class="form-control @error('tanggal_check_in') is-invalid @enderror" 
                    id="tanggal_check_in" name="tanggal_check_in" 
                    value="{{ old('tanggal_check_in', $reservasi->tanggal_check_in ? \Carbon\Carbon::parse($reservasi->tanggal_check_in)->format('Y-m-d') : '') }}" 
                    required>
                @error('tanggal_check_in')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Tanggal Check In harus diisi</small>
            </div>

            <div class="form-group">
                <label for="tanggal_check_out">Tanggal Check Out</label>
                <input type="date" class="form-control @error('tanggal_check_out') is-invalid @enderror" 
                    id="tanggal_check_out" name="tanggal_check_out" 
                    value="{{ old('tanggal_check_out', $reservasi->tanggal_check_out ? \Carbon\Carbon::parse($reservasi->tanggal_check_out)->format('Y-m-d') : '') }}" 
                    required>
                @error('tanggal_check_out')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Tanggal Check Out harus diisi</small>
            </div>

            <div class="form-group">
                <label for="jumlah_orang">Jumlah Orang</label>
                <input type="number" class="form-control @error('jumlah_orang') is-invalid @enderror" 
                       id="jumlah_orang" name="jumlah_orang" 
                       value="{{ old('jumlah_orang', $reservasi->jumlah_orang) }}" 
                       required min="1" max="10">
                @error('jumlah_orang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Minimal 1-6 orang</small>
            </div>
            
            <div class="form-group">
                <label for="status_pembayaran">Status Pembayaran</label>
                <select class="form-control @error('status_pembayaran') is-invalid @enderror" 
                        id="status_pembayaran" name="status_pembayaran" required>
                    <option value="lunas" {{ old('status_pembayaran', $reservasi->status_pembayaran) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                    <option value="belum lunas" {{ old('status_pembayaran', $reservasi->status_pembayaran) == 'belum lunas' ? 'selected' : '' }}>Belum Lunas</option>
                </select>
                @error('status_pembayaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Harus Dipilih</small>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ url('reservasi') }}" class="btn btn-default">Kembali</a>
        </form>
    </div>
</div>
@endsection
