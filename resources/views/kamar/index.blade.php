@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ route('kamar.create') }}">Tambah Kamar</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <table class="table table-bordered table-striped table-hover table-sm" id="table_kamar">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipe Kamar</th>
                    <th>Harga per Malam</th>
                    <th>Jumlah Kasur</th>
                    <th>Kapasitas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        var dataKamar = $('#table_kamar').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ route('kamar.list') }}",
                type: "POST",
                data: function(d) {
                    d._token = "{{ csrf_token() }}";
                }
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "tipe_kamar",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "harga_per_malam",
                    className: "text-right",
                    orderable: true,
                    searchable: true,
                    render: function(data) {
                        return 'Rp ' + parseInt(data).toLocaleString();
                    }
                },
                {
                    data: "jumlah_kasur",
                    className: "text-center",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "kapasitas",
                    className: "text-center",
                    orderable: true,
                    searchable: true,
                    render: function(data) {
                        return data + ' orang';
                    }
                },
                {
                    data: "status",
                    className: "text-center",
                    orderable: true,
                    searchable: true,
                    render: function(data) {
                        return data === 'tersedia'
                            ? '<span class="badge badge-success">Tersedia</span>'
                            : '<span class="badge badge-danger">Tidak Tersedia</span>';
                    }
                },
                {
                    data: "aksi",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
@endpush