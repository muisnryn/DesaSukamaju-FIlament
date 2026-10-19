<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Import semua model yang dibutuhkan
use App\Models\Demografi;
use App\Models\DemografiDetail;
use App\Models\Apbdes;
use App\Models\ApbdesDetail;
use App\Models\Stunting;
use App\Models\Bansos;
use App\Models\PenerimaBansos;
use App\Models\Idm;
use App\Models\Sdg;

class InfografisController extends Controller
{
    /**
     * Menampilkan Data Demografi Penduduk
     */
    public function penduduk(Request $request)
    {
        // 1. Ambil daftar tahun yang tersedia untuk dropdown
        $years = Demografi::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        // 2. Tentukan tahun yang dipilih (Default: tahun terbaru)
        $currentYear = $request->input('tahun', $years->first() ?? date('Y'));

        // 3. Ambil data berdasarkan tahun
        $demografi = Demografi::where('tahun', $currentYear)->first();
        $demografiDetail = DemografiDetail::where('tahun', $currentYear)->get();

        return view('infografis.penduduk', compact('demografi', 'demografiDetail', 'years', 'currentYear'));
    }

    /**
     * Menampilkan Data APBDes (Sesuai Permintaan Revisi View)
     */
    public function apbdes(Request $request)
    {
        // 1. Ambil daftar tahun unik dari tabel apbdes
        $years = Apbdes::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        // 2. Cek input user, jika tidak ada pakai tahun pertama (terbaru), jika kosong pakai tahun ini
        $currentYear = $request->input('tahun', $years->first() ?? date('Y'));

        // 3. Query data utama
        $apbdes = Apbdes::where('tahun', $currentYear)->first();

        // 4. Query detail (cegah error jika $apbdes null)
        $apbdesDetail = $apbdes ? ApbdesDetail::where('apbdes_id', $apbdes->id)->get() : collect();

        // 5. Kirim data ke view (termasuk variabel untuk dropdown)
        return view('infografis.apbdes', compact('apbdes', 'apbdesDetail', 'years', 'currentYear'));
    }

    /**
     * Menampilkan Data Stunting
     */
    public function stunting(Request $request)
    {
        $years = Stunting::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
        $currentYear = $request->input('tahun', $years->first() ?? date('Y'));

        $stunting = Stunting::where('tahun', $currentYear)->first();

        return view('infografis.stunting', compact('stunting', 'years', 'currentYear'));
    }

    /**
     * Menampilkan Data Bansos & Pencarian NIK
     */
    public function bansos(Request $request)
    {
        // Bansos biasanya menampilkan data tahun aktif/terbaru saja
        $tahunTerbaru = Bansos::max('tahun') ?? date('Y');
        
        // Ambil rekap bansos per tahun terbaru
        $bansos = Bansos::where('tahun', $tahunTerbaru)->get();

        // Logika Pencarian Penerima
        $hasilCariBansos = null;
        if ($request->filled('nik')) {
            $hasilCariBansos = PenerimaBansos::where('nik', $request->nik)->first();
        }

        return view('infografis.bansos', compact('bansos', 'hasilCariBansos', 'tahunTerbaru'));
    }

    /**
     * Menampilkan Data IDM (Indeks Desa Membangun)
     */
    public function idm(Request $request)
    {
        $years = Idm::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
        $currentYear = $request->input('tahun', $years->first() ?? date('Y'));

        $idm = Idm::where('tahun', $currentYear)->first();

        return view('infografis.idm', compact('idm', 'years', 'currentYear'));
    }

    /**
     * Menampilkan Data SDGs Desa
     */
    public function sdgs(Request $request)
    {
        $years = Sdg::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
        $currentYear = $request->input('tahun', $years->first() ?? date('Y'));

        $sdg = Sdg::where('tahun', $currentYear)->first();

        return view('infografis.sdgs', compact('sdg', 'years', 'currentYear'));
    }
}