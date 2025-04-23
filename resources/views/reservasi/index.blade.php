@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ route('reservasi.create') }}" class="btn btn-primary btn-sm">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <table class="table table-bordered table-striped table-hover table-sm" id="table_reservasi">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipe Kamar</th>
                    <th>Nama Tamu</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Total Harga</th>
                    <th>Status Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
<script>
$(document).ready(function() {
    var dataReservasi = $('#table_reservasi').DataTable({
        serverSide: true,
        ajax: {
            "url": "{{ route('reservasi.list') }}",
            "dataType": "json",
            "type": "GET",
            "data": function (d) {
                // Anda bisa menambahkan parameter tambahan di sini jika diperlukan
            }
        },
        columns: [
            {data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false},
            {data: "kamar_tipe", className: "", orderable: true, searchable: true},
            {data: "nama_tamu", className: "", orderable: true, searchable: true},
            {data: "tanggal_check_in", className: "", 
                render: function(data) {
                    return new Date(data).toLocaleDateString();
                }
            },
            {data: "tanggal_check_out", className: "", 
                render: function(data) {
                    return new Date(data).toLocaleDateString();
                }
            },
            {data: "total_harga", className: "",
                render: function(data) {
                    return 'Rp ' + data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                }
            },
            {data: "status_pembayaran", className: "", 
                render: function(data) {
                    return data === 'lunas' ? 
                        '<span class="badge badge-success">Lunas</span>' : 
                        '<span class="badge badge-danger">Belum Lunas</span>';
                }
            },
            {data: "aksi", className: "", orderable: false, searchable: false}
        ],
        order: [[1, 'asc']],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
        }
    });
});
</script>
@endpush