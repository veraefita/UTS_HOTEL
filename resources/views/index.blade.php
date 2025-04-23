@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ route('kamar.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Kamar
            </a>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm" id="table_kamar">
                <thead class="bg-primary">
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Tipe Kamar</th>
                        <th class="text-center">Harga per Malam</th>
                        <th class="text-center">Jumlah Kasur</th>
                        <th class="text-center">Kapasitas</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data akan diisi oleh DataTables -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('css')
    <style>
        .table th {
            vertical-align: middle;
        }
    </style>
@endpush

@push('js')
<script>
    $(document).ready(function() {
        var dataKamar = $('#table_kamar').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ route('kamar.list') }}",
                type: "POST",
                data: function (d) {
                    d._token = "{{ csrf_token() }}";
                }
            },
            columns: [
                {
                    data: "kamar_id",
                    className: "text-center",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { 
                    data: "tipe_kamar",
                    className: "text-left" 
                },
                {
                    data: "harga_per_malam",
                    className: "text-right",
                    render: function(data) {
                        return 'Rp ' + data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    }
                },
                {
                    data: "jumlah_kasur",
                    className: "text-center"
                },
                {
                    data: "kapasitas",
                    className: "text-center",
                    render: function(data) {
                        return data + ' orang';
                    }
                },
                {
                    data: "status",
                    className: "text-center",
                    render: function(data) {
                        var badge = data === 'tersedia' ? 'badge-success' : 'badge-danger';
                        return '<span class="badge ' + badge + ' p-2 text-uppercase">' + data + '</span>';
                    }
                },
                {
                    data: "aksi",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <a href="kamar/${row.kamar_id}" class="btn btn-sm btn-info">
                                <span>Detail</span>
                            </a>
                            <a href="kamar/${row.kamar_id}/edit" class="btn btn-sm btn-warning">
                                <span>Edit</span>
                            </a>
                            <form action="kamar/${row.kamar_id}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin?')">
                                    <span>Hapus</span>
                                </button>
                            </form>
                        `;
                    }
                }
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            }
        });
    });
</script>
@endpush