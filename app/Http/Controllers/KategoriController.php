<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Data Kategori',
            'menuKategori' => 'active',
            'breadcrumb' => [
                ['name' => 'Dashboard', 'url' => route('dashboard')],
                ['name' => 'Data Kategori', 'url' => null],
            ],
            'kategori' => Kategori::all(),
        ];

        return view('admin/kategori/index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori tidak boleh kosong',
            'nama_kategori.unique' => 'Kategori sudah ada',
        ]);

        $kategori = new Kategori;
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        return redirect()->route('kategori')->with('success', 'Data kategori berhasil ditambahkan');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori,nama_kategori,' . $id,
        ], [
            'nama_kategori.required' => 'Nama kategori tidak boleh kosong',
            'nama_kategori.unique' => 'Kategori sudah ada',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        return redirect()->route('kategori')->with('success', 'Data kategori berhasil diperbarui');
    }
    public function destroy($id)
    {
        // Pastikan kategori ditemukan
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->route('kategori')->with('success', 'Data kategori berhasil dihapus');
    }


}
