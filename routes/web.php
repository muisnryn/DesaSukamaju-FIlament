<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BelanjaController;
use App\Http\Controllers\InfografisController;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\ProfilController;
use App\Models\ProfilDesa;
use App\Models\Aparatur;
use App\Models\Berita;
use App\Models\Apbdes;    // Import Model
use App\Models\Demografi; // Import Model

Route::get('/', function () {
    // 1. Profil & Aparatur
    $profil = ProfilDesa::first() ?? new ProfilDesa();
    $aparaturs = Aparatur::orderBy('urutan', 'asc')->get();
    
    // 2. Berita Terbaru
    $beritas = Berita::latest()->get(); 

    // 3. Data APBDes (Ambil tahun sekarang, jika tidak ada ambil tahun terakhir)
    $apbdes = Apbdes::where('tahun', date('Y'))->first();
    if (!$apbdes) {
        $apbdes = Apbdes::latest('tahun')->first() ?? new Apbdes([
            'tahun' => date('Y'),
            'total_pendapatan' => 0,
            'total_belanja' => 0,
            'total_pembiayaan' => 0
        ]);
    }

    // 4. Data Demografi (Ambil tahun sekarang, jika tidak ada ambil tahun terakhir)
    $demografi = Demografi::where('tahun', date('Y'))->first();
    if (!$demografi) {
        $demografi = Demografi::latest('tahun')->first() ?? new Demografi([
            'total_penduduk' => 0,
            'total_laki_laki' => 0,
            'total_perempuan' => 0,
            'total_kepala_keluarga' => 0
        ]);
    }

    return view('welcome', compact('profil', 'aparaturs', 'beritas', 'apbdes', 'demografi'));
});

// --- Rute lainnya TETAP (Tidak perlu diubah) ---
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/belanja-umkm', [BelanjaController::class, 'umkm'])->name('belanja.umkm');
Route::get('/produk/{produk:slug}', [BelanjaController::class, 'showProduk'])->name('produk.show');

Route::prefix('infografis')->name('infografis.')->group(function () {
    Route::get('/', function () { return redirect()->route('infografis.penduduk'); })->name('index');
    Route::get('/penduduk', [InfografisController::class, 'penduduk'])->name('penduduk');
    Route::get('/apbdes', [InfografisController::class, 'apbdes'])->name('apbdes');
    Route::get('/stunting', [InfografisController::class, 'stunting'])->name('stunting');
    Route::get('/bansos', [InfografisController::class, 'bansos'])->name('bansos');
    Route::get('/idm', [InfografisController::class, 'idm'])->name('idm');
    Route::get('/sdgs', [InfografisController::class, 'sdgs'])->name('sdgs');
});

Route::get('/peta-desa', [PetaController::class, 'index'])->name('peta.desa');

Route::get('/fix-storage', function () {
    // 1. Hapus folder storage yang mungkin corrupt di public
    $shortcut = public_path('storage');
    if (File::exists($shortcut)) {
        File::delete($shortcut); // Jika itu file/link
        // Jika itu folder beneran, gunakan: File::deleteDirectory($shortcut);
    }

    // 2. Buat symlink manual menggunakan fungsi PHP
    $target = storage_path('app/public');
    $link = public_path('storage');
    
    if (symlink($target, $link)) {
        return "Symlink Berhasil Dibuat!";
    } else {
        return "Gagal membuat symlink. Cek izin folder.";
    }
});