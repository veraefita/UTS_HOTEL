@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Data Kamar</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('kamar.store') }}">
            @csrf

            <div class="form-group">
                <label for="tipe_kamar">Tipe Kamar</label>
                <input type="text" class="form-control @error('tipe_kamar') is-invalid @enderror"
                       id="tipe_kamar" name="tipe_kamar"
                       value="{{ old('tipe_kamar') }}"
                       required minlength="3" maxlength="100">
                @error('tipe_kamar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Minimal 3 karakter, maksimal 100 karakter</small>
            </div>

            <div class="form-group">
                <label for="harga_per_malam">Harga per Malam (Rp)</label>
                <input type="number" class="form-control @error('harga_per_malam') is-invalid @enderror"
                       id="harga_per_malam" name="harga_per_malam"
                       value="{{ old('harga_per_malam') }}"
                       required min="100000" max="100000000" step="1000">
                @error('harga_per_malam')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Masukkan harga antara Rp1.000 - Rp1.000.000.000 (kelipatan 100)</small>
            </div>

            <div class="form-group">
                <label for="jumlah_kasur">Jumlah Kasur</label>
                <input type="number" class="form-control @error('jumlah_kasur') is-invalid @enderror"
                       id="jumlah_kasur" name="jumlah_kasur"
                       value="{{ old('jumlah_kasur') }}"
                       required min="1" max="5">
                @error('jumlah_kasur')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Minimal 1-3 kasur</small>
            </div>

            <div class="form-group">
                <label for="kapasitas">Kapasitas (orang)</label>
                <input type="number" class="form-control @error('kapasitas') is-invalid @enderror"
                       id="kapasitas" name="kapasitas"
                       value="{{ old('kapasitas') }}"
                       required min="1" max="10">
                @error('kapasitas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Minimal 1-6 orang</small>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control @error('status') is-invalid @enderror"
                        id="status" name="status" required>
                    <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="tidak tersedia" {{ old('status') == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Harus Dipilih</small>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @endError"
                          id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Opsional</small>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('kamar.index') }}" class="btn btn-default">Kembali</a>
        </form>
    </div>
</div>
@endsection