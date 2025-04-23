<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KamarController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kamar',
            'list' => ['Home', 'Kamar']
        ];

        $page = (object) [
            'title' => 'Daftar kamar yang tersedia'
        ];

        $activeMenu = 'kamar';

        return view('kamar.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $kamars = Kamar::select('kamar_id', 'tipe_kamar', 'harga_per_malam', 'status', 'jumlah_kasur', 'kapasitas');

        return DataTables::of($kamars)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kamar) {
                $btn = '<a href="'.route('kamar.show', $kamar->kamar_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.route('kamar.edit', $kamar->kamar_id).'" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'.route('kamar.destroy', $kamar->kamar_id).'">'
                    . csrf_field()
                    . method_field('DELETE')
                    . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button>'
                    . '</form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Kamar',
            'list' => ['Home', 'Kamar', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah kamar baru'
        ];

        $activeMenu = 'kamar';

        return view('kamar.create', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipe_kamar' => 'required|string|min:3|max:100',
            'harga_per_malam' => 'required|numeric|min:100000|max:100000000',
            'status' => 'required|in:tersedia,tidak tersedia',
            'jumlah_kasur' => 'required|integer|min:1|max:5',
            'kapasitas' => 'required|integer|min:1|max:10',
            'deskripsi' => 'nullable|string'
        ]);

        Kamar::create($validated);

        return redirect()->route('kamar.index')->with('success', 'Data kamar berhasil disimpan');
    }

    public function show($id)
    {
        $kamar = Kamar::findOrFail($id);

        $breadcrumb = (object) [
            'title' => 'Detail Kamar',
            'list' => ['Home', 'Kamar', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail kamar'
        ];

        $activeMenu = 'kamar';

        return view('kamar.show', compact('breadcrumb', 'page', 'activeMenu', 'kamar'));
    }

    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);

        $breadcrumb = (object) [
            'title' => 'Edit Kamar',
            'list' => ['Home', 'Kamar', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit kamar'
        ];

        $activeMenu = 'kamar';

        return view('kamar.edit', compact('breadcrumb', 'page', 'activeMenu', 'kamar'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tipe_kamar' => 'required|string|min:3|max:100',
            'harga_per_malam' => 'required|numeric|min:100000|max:100000000',
            'status' => 'required|in:tersedia,tidak tersedia',
            'jumlah_kasur' => 'required|integer|min:1|max:5',
            'kapasitas' => 'required|integer|min:1|max:10',
            'deskripsi' => 'nullable|string'
        ]);

        $kamar = Kamar::findOrFail($id);
        $kamar->update($validated);

        return redirect()->route('kamar.index')->with('success', 'Data kamar berhasil diubah');
    }

    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);

        try {
            $kamar->delete();
            return redirect()->route('kamar.index')->with('success', 'Data kamar berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('kamar.index')->with('error', 'Data kamar gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}