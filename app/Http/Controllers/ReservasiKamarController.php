<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\ReservasiKamar;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReservasiKamarController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Reservasi',
            'list'  => ['Home', 'Reservasi']
        ];
    
        $page = (object) [
            'title' => 'Daftar reservasi kamar'
        ];
    
        $activeMenu = 'reservasi';
        $kamars = Kamar::all();
    
        return view('reservasi.index', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'activeMenu' => $activeMenu,
            'kamars' => $kamars
        ]);
    }
    
    public function list(Request $request)
    {
        $reservasis = ReservasiKamar::with(['kamar' => function($query) {
                $query->select('kamar_id', 'tipe_kamar');
            }])
            ->select('reservasi_id', 'kamar_id', 'nama_tamu', 'tanggal_check_in', 
                    'tanggal_check_out', 'jumlah_malam', 'total_harga', 'status_pembayaran');
    
        return DataTables::of($reservasis)
            ->addIndexColumn()
            ->addColumn('kamar_tipe', function ($reservasi) {
                return $reservasi->kamar ? $reservasi->kamar->tipe_kamar : 'Tidak diketahui';
            })
            ->addColumn('aksi', function ($reservasi) {
                $btn = '<a href="' . route('reservasi.show', $reservasi->reservasi_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . route('reservasi.edit', $reservasi->reservasi_id) . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . route('reservasi.destroy', $reservasi->reservasi_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Reservasi',
            'list'  => ['Home', 'Reservasi', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah reservasi baru'
        ];

        $activeMenu = 'reservasi';
        $kamars = Kamar::where('status', 'tersedia')->get();

        return view('reservasi.create', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'activeMenu' => $activeMenu,
            'kamars' => $kamars
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kamar_id' => 'required|integer',
            'nama_tamu' => 'required|string|max:100',
            'email' => 'required|email',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_check_in' => 'required|date',
            'tanggal_check_out' => 'required|date|after:tanggal_check_in',
            'jumlah_orang' => 'required|integer|min:1',
            'status_pembayaran' => 'required|in:lunas,belum lunas'
        ]);

        $kamar = Kamar::find($request->kamar_id);
        if (!$kamar) {
            return back()->with('error', 'Kamar tidak ditemukan');
        }

        // Konversi string tanggal ke objek Carbon
        $checkIn = \Carbon\Carbon::parse($request->tanggal_check_in);
        $checkOut = \Carbon\Carbon::parse($request->tanggal_check_out);
        
        $jumlah_malam = $checkIn->diffInDays($checkOut);
        $total_harga = $jumlah_malam * $kamar->harga_per_malam;

        $data = $request->all();
        $data['jumlah_malam'] = $jumlah_malam;
        $data['total_harga'] = $total_harga;
        $data['tanggal_check_in'] = $checkIn;
        $data['tanggal_check_out'] = $checkOut;

        ReservasiKamar::create($data);

        return redirect('/reservasi')->with('success', 'Reservasi berhasil dibuat');
    }

    public function show(string $id)
    {
        try {
            $reservasi = ReservasiKamar::with('kamar')->findOrFail($id);
        
            $breadcrumb = (object) [
                'title' => 'Detail Reservasi',
                'list'  => ['Home', 'Reservasi', 'Detail']
            ];
        
            $page = (object) [
                'title' => 'Detail reservasi'
            ];
        
            $activeMenu = 'reservasi';
        
            return view('reservasi.show', [
                'breadcrumb' => $breadcrumb,
                'page' => $page,
                'activeMenu' => $activeMenu,
                'reservasi' => $reservasi
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/reservasi')->with('error', 'Data reservasi tidak ditemukan');
        }
    }

    public function edit(string $id)
    {
        $reservasi = ReservasiKamar::find($id);
        $kamars = Kamar::where('status', 'tersedia')->orWhere('kamar_id', $reservasi->kamar_id)->get();

        $breadcrumb = (object) [
            'title' => 'Edit Reservasi',
            'list'  => ['Home', 'Reservasi', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit reservasi'
        ];

        $activeMenu = 'reservasi';

        return view('reservasi.edit', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'activeMenu' => $activeMenu,
            'reservasi' => $reservasi,
            'kamars' => $kamars
        ]);
    }

        public function update(Request $request, string $id)
    {
        $request->validate([
            'kamar_id' => 'required|integer',
            'nama_tamu' => 'required|string|max:100',
            'email' => 'required|email',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_check_in' => 'required|date',
            'tanggal_check_out' => 'required|date|after:tanggal_check_in',
            'jumlah_orang' => 'required|integer|min:1',
            'status_pembayaran' => 'required|in:lunas,belum lunas'
        ]);

        $reservasi = ReservasiKamar::find($id);
        if (!$reservasi) {
            return back()->with('error', 'Reservasi tidak ditemukan');
        }

        $kamar = Kamar::find($request->kamar_id);
        if (!$kamar) {
            return back()->with('error', 'Kamar tidak ditemukan');
        }

        // Konversi string tanggal ke objek Carbon
        $checkIn = \Carbon\Carbon::parse($request->tanggal_check_in);
        $checkOut = \Carbon\Carbon::parse($request->tanggal_check_out);
        
        $jumlah_malam = $checkIn->diffInDays($checkOut);
        $total_harga = $jumlah_malam * $kamar->harga_per_malam;

        $data = $request->except(['_token', '_method']);
        $data['jumlah_malam'] = $jumlah_malam;
        $data['total_harga'] = $total_harga;
        $data['tanggal_check_in'] = $checkIn;
        $data['tanggal_check_out'] = $checkOut;

        ReservasiKamar::where('reservasi_id', $id)->update($data);

        return redirect('/reservasi')->with('success', 'Reservasi berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $check = ReservasiKamar::find($id);

        if (!$check) {
            return redirect('/reservasi')->with('error', 'Data reservasi tidak ditemukan');
        }

        try {
            ReservasiKamar::destroy($id);

            return redirect('/reservasi')->with('success', 'Data reservasi berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/reservasi')->with('error', 'Data reservasi gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
