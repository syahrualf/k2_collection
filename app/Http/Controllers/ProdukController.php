<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with('kategori')->get();

        $data = [
            'title' => 'Data Produk',
            'menuProduk' => 'active',
            'breadcrumb' => [
                ['name' => 'Dashboard', 'url' => route('dashboard')],
                ['name' => 'Data Produk', 'url' => null],
            ],
            'produk' => $produk,
        ];

        return view('admin/produk/index', $data);
    }

    public function create()
    {
        $kategori = Kategori::all();
        $data = [
            'title' => 'Tambah Data Produk',
            'menuProduk' => 'active',
            'breadcrumb' => [
                ['name' => 'Dashboard', 'url' => route('dashboard')],
                ['name' => 'Data Produk', 'url' => route('produk')],
                ['name' => 'Tambah Produk', 'url' => null],
            ],
            'kategori' => $kategori,
        ];
        return view('admin/produk/create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'harga' => 'required|numeric|min:0',
            'detail' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:8048',
        ], [
            'nama.required' => 'Nama produk tidak boleh kosong',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'kategori_id.exists' => 'Kategori tidak valid',
            'harga.required' => 'Harga wajib diisi',
            'harga.numeric' => 'Harga harus berupa angka',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar hanya jpg, jpeg, png',
            'foto.max' => 'Ukuran foto maksimal 8MB',
        ]);


        $produk = new Produk;
        $produk->nama = $request->nama;
        $produk->slug = Str::slug($request->nama, '-');
        $produk->kategori_id = $request->kategori_id;
        $produk->harga = $request->harga;
        $produk->detail = $request->detail;


        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = 'produk_' . uniqid() . '.' . $file->getClientOriginalExtension();
            // Kompres gambar otomatis 
            $image = Image::make($file)
                ->resize(1080, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode(null, 70);
            Storage::disk('public')->put('fotoProduk/' . $namaFile, $image);

            $produk->foto = $namaFile;
        }
        $produk->save();
        return redirect()->route('produk')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Produk',
            'menuProduk' => 'active',
            'breadcrumb' => [
                ['name' => 'Dashboard', 'url' => route('dashboard')],
                ['name' => 'Data Produk', 'url' => route('produk')],
                ['name' => 'Edit Data Produk', 'url' => null],
            ],
            'produk' => Produk::findOrFail($id),
            'kategori' => Kategori::all(),
        ];
        return view('admin/produk/edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'harga' => 'required|numeric|min:0',
            'detail' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
        ], [
            'nama.required' => 'Nama produk tidak boleh kosong',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'kategori_id.exists' => 'Kategori tidak ditemukan',
            'harga.required' => 'Harga tidak boleh kosong',
            'harga.numeric' => 'Harga harus berupa angka',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar hanya jpg, jpeg, png',
            'foto.max' => 'Ukuran foto maksimal 5MB',
        ]);

        $produk = Produk::findOrFail($id);

        $produk->nama = $request->nama;
        $produk->slug = Str::slug($request->nama, '-');
        $produk->kategori_id = $request->kategori_id;
        $produk->harga = $request->harga;
        $produk->detail = $request->detail;

        if ($request->hasFile('foto')) {
            // Hapus foto lama kalau ada
            if ($produk->foto && Storage::disk('public')->exists('fotoProduk/' . $produk->foto)) {
                Storage::disk('public')->delete('fotoProduk/' . $produk->foto);
            }
            $file = $request->file('foto');
            $namaFile = 'Produk_' . uniqid() . '.' . $file->getClientOriginalExtension();
            // Kompres dan resize gambar otomatis 
            $image = Image::make($file)
                ->resize(1080, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode($file->getClientOriginalExtension(), 70); // simpan sesuai ekstensi aslinya
            Storage::disk('public')->put('fotoProduk/' . $namaFile, (string) $image);
            $produk->foto = $namaFile;
        }

        $produk->save();

        return redirect()->route('produk')->with('success', 'Data produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        if ($produk->foto) {
            $path = 'fotoProduk/' . $produk->foto;
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
        $produk->delete();

        return redirect()->route('produk')->with('success', 'Data produk berhasil dihapus');
    }
    public function search(Request $request)
    {
        $cari = $request->cari;

        $produk = Produk::with('kategori')
            ->where('nama', 'like', "%$cari%")
            ->orWhereHas('kategori', function ($c) use ($cari) {
                $c->where('nama_kategori', 'like', "%$cari%");
            })
            ->paginate(12);

        if ($produk->count() == 0) {
            return view('user/produk', [
                'produk' => $produk,
                'cari' => $cari,
                'pesan' => "Produk \"$cari\" tidak ditemukan.",
                'title' => "Hasil Pencarian"
            ]);
        }

        return view('user/produk', [
            'produk' => $produk,
            'cari' => $cari,
            'title' => "Hasil Pencarian: $cari"
        ]);
    }





}
