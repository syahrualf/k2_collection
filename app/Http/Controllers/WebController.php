<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home()
    {

        $data = array(
            "title" => "Home",
            "menuHome" => "active",
            "produk" => Produk::latest()->take(6)->get(),
        );
        return view('user/home', $data);
    }

    public function produk()
    {

        $data = array(
            "title" => "Produk",
            "menuProduk" => "active",
            "produk" => Produk::all(),
            "kategori" => Kategori::all()
        );
        return view('user/produk', $data);
    }
    public function detailProduk($slug)
    {
        $produk = Produk::where('slug', $slug)->firstOrFail();
        $data = array(
            "title" => "DetailProduk",
            "menuProduk" => "active",
            "produk" => $produk,
            "kategori" => Kategori::all()
        );
        return view('user/detailProduk', $data);
    }
    public function tentang()
    {

        $data = array(
            "title" => "Tentang Kami",
            "menuTentang" => "active",
        );
        return view('user/tentang', $data);
    }


}
