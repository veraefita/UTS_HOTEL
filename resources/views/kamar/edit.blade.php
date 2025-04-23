@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Data Kamar</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('kamar.update', $kamar->kamar_id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="tipe_kamar">Tipe Kamar</label>
                <input type="text" class="form-control @error('tipe_kamar') is-invalid @enderror"
                       id="tipe_kamar" name="tipe_kamar"
                       value="{{ old('tipe_kamar', $kamar->tipe_kamar) }}"
                       required minlength="3" maxlength="100">
                @error('tipe_kamar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="harga_per_malam">Harga per Malam (Rp)</label>
                <input type="number" class="form-control @error('harga_per_malam') is-invalid @enderror"
                       id="harga_per_malam" name="harga_per_malam"
                       value="{{ old('harga_per_malam', $kamar->harga_per_malam) }}"
                       required min="100000" max="100000000" step="1000">
                @error('harga_per_malam')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jumlah_kasur">Jumlah Kasur</label>
                <input type="number" class="form-control @error('jumlah_kasur') is-invalid @enderror"
                       id="jumlah_kasur" name="jumlah_kasur"
                       value="{{ old('jumlah_kasur', $kamar->jumlah_kasur) }}"
                       required min="1" max="5">
                @error('jumlah_kasur')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="kapasitas">Kapasitas (orang)</label>
                <input type="number" class="form-control @error('kapasitas') is-invalid @enderror"
                       id="kapasitas" name="kapasitas"
                       value="{{ old('kapasitas', $kamar->kapasitas) }}"
                       required min="1" max="10">
                @error('kapasitas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control @error('status') is-invalid @enderror"
                        id="status" name="status" required>
                    <option value="tersedia" {{ old('status', $kamar->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="tidak tersedia" {{ old('status', $kamar->status) == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @endError"
                          id="deskripsi" name="deskripsi">{{ old('deskripsi', $kamar->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('kamar.index') }}" class="btn btn-default">Kembali</a>
        </form>
    </div>
</div>
@endsection