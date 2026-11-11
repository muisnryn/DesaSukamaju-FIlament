<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class BelanjaController extends Controller
{
    /**
     * Menampilkan halaman Belanja UMKM.
     */
    public function umkm()
    {
        $produks = Produk::with('umkm')->latest()->paginate(12);
        return view('belanja.index', compact('produks'));
    }

    /**
     * TAMBAHKAN METHOD BARU DI BAWAH INI
     * Menampilkan halaman detail untuk satu produk.
     */
    public function showProduk(Produk $produk) // Gunakan Route Model Binding
    {
        // Variabel $produk akan otomatis ditemukan berdasarkan slug di URL
        return view('belanja.show', [
            'produk' => $produk
        ]);
    }
}
