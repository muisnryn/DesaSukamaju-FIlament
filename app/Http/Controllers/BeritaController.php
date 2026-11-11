<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
        // Method untuk menampilkan daftar berita
    public function index()
    {
        $beritas = Berita::where('status', 'published') // Ambil yang statusnya published
                         ->latest() // Urutkan dari yang terbaru
                         ->paginate(10); // Buat paginasi

        return view('berita.index', compact('beritas'));
    }

    // Method untuk menampilkan detail berita
    public function show($slug)
    {
        $berita = Berita::where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();
        return view('berita.show', compact('berita'));
    }
}
