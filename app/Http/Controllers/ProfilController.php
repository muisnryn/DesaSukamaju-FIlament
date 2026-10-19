<?php

namespace App\Http\Controllers;

use App\Models\ProfilDesa; // Pastikan Model ProfilDesa sudah dibuat
use App\Models\Aparatur;  // Pastikan Model Aparatur sudah dibuat
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Menampilkan halaman profil desa.
     */
    public function index()
    {
        // Mengambil data pertama dari tabel profil_desas
        // Jika kosong, buat objek baru agar web tidak error (pola Null Object)
        $profil = ProfilDesa::first() ?? new ProfilDesa();

        // Mengambil semua data aparatur diurutkan berdasarkan kolom 'urutan'
        $aparaturs = Aparatur::orderBy('urutan', 'asc')->get();

        return view('profil', compact('profil', 'aparaturs'));
}
}