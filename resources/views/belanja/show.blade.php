@extends('layouts.app')

@section('title', $produk->nama_produk . ' - Belanja UMKM')

@section('content')

<style>
    /* CSS Tambahan untuk Tampilan yang Lebih Segar */
    
    /* 1. Efek Hover pada Gambar Produk */
    .product-image-container {
        transition: all 0.3s ease;
        overflow: hidden;
        border-radius: 1rem !important; /* Rounded-4 */
    }
    .product-image-container:hover {
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important; /* Bayangan lebih lembut saat hover */
    }
    .product-image-container img {
        transition: transform 0.5s ease;
    }
    .product-image-container:hover img {
        transform: scale(1.03); /* Sedikit zoom effect */
    }

    /* 2. Styling Deskripsi */
    .product-description {
        font-size: 1.05rem;
        line-height: 1.8;
        color: #4a4a4a;
    }
    .product-description img {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 12px;
        margin: 1rem 0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    /* 3. Breadcrumb Cleaner Link */
    .breadcrumb-item a {
        transition: color 0.2s;
    }
    .breadcrumb-item a:hover {
        color: #146c43 !important; /* Hijau yang lebih gelap saat hover */
        text-decoration: underline !important;
    }

    /* 4. Sticky hanya di layar besar */
    @media (min-width: 992px) {
        .sticky-lg-top-custom {
            position: sticky;
            top: 100px; /* Sesuaikan dengan tinggi navbar */
            z-index: 1;
        }
    }
</style>

<div class="container py-5">
    
    {{-- Breadcrumb (Desain Lebih Bersih Tanpa Background) --}}
    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb bg-transparent p-0">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-success fw-bold"><i class="bi bi-house-door-fill me-1"></i>Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('belanja.umkm') }}" class="text-decoration-none text-success fw-bold">Belanja</a></li>
            <li class="breadcrumb-item active text-muted fw-medium" aria-current="page">{{ Str::limit($produk->nama_produk, 30) }}</li>
        </ol>
    </nav>

    <div class="row g-5 align-items-start">
        {{-- Kolom Kiri: Gambar Produk --}}
        <div class="col-lg-5 sticky-lg-top-custom">
            {{-- Menggunakan class custom .product-image-container untuk efek hover --}}
            <div class="card border-0 shadow-lg rounded-4 product-image-container bg-white">
                <img src="{{ $produk->gambar_produk ? asset('storage/' . $produk->gambar_produk) : asset('images/no-image.jpg') }}" 
                     class="w-100 object-fit-cover" 
                     alt="{{ $produk->nama_produk }}" 
                     style="height: 450px; /* Sedikit lebih tinggi */"
                     onerror="this.onerror=null;this.src='https://placehold.co/600x600/f0fdf4/198754?text=Gambar+Produk';">
            </div>
        </div>

        {{-- Kolom Kanan: Informasi Produk --}}
        <div class="col-lg-7">
            <div class="ps-lg-4">
                {{-- Kategori/Tag Kecil (Opsional, jika ada datanya) --}}
                <div class="mb-2">
                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 fw-bold small">
                        <i class="bi bi-tag-fill me-1"></i> Produk Desa
                    </span>
                </div>

                {{-- Judul Produk --}}
                <h1 class="fw-bolder text-dark display-6 mb-3" style="letter-spacing: -0.5px;">
                    {{ $produk->nama_produk }}
                </h1>
                
                {{-- Harga (Lebih Menonjol) --}}
                <h2 class="text-success fw-bolder mb-4 display-5">
                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                </h2>

                {{-- Informasi Penjual (Desain Lebih Modern Tanpa Border) --}}
                @if($produk->umkm)
                <div class="card bg-white border-0 shadow rounded-4 mb-5 p-4">
                    <div class="d-flex align-items-center">
                        {{-- Ikon Toko --}}
                        <div class="bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center shadow-sm flex-shrink-0" style="width: 60px; height: 60px;">
                            <i class="bi bi-shop fs-3"></i>
                        </div>
                        {{-- Teks Penjual --}}
                        <div class="ms-3">
                            <span class="text-muted small text-uppercase fw-bold ls-1 d-block mb-1">Dijual Langsung Oleh:</span>
                            <h5 class="mb-0 fw-bold text-dark d-flex align-items-center">
                                {{ $produk->umkm->nama_umkm }} 
                                {{-- Ikon Verifikasi --}}
                                <span data-bs-toggle="tooltip" data-bs-title="UMKM Terverifikasi Desa Sukamaju">
                                    <i class="bi bi-patch-check-fill text-success ms-2 fs-5"></i>
                                </span>
                            </h5>
                            @if($produk->umkm->alamat)
                                <small class="text-muted d-block mt-1"><i class="bi bi-geo-alt me-1"></i> {{ Str::limit($produk->umkm->alamat, 50) }}</small>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                {{-- Deskripsi --}}
                <div class="mb-5">
                    <h5 class="fw-bold text-dark border-bottom pb-3 mb-3 d-flex align-items-center">
                        <i class="bi bi-file-text me-2 text-success"></i>Detail Deskripsi
                    </h5>
                    <div class="product-description text-break">
                        {!! $produk->deskripsi !!}
                    </div>
                </div>
            </div>
        </div>
    </div> 
    {{-- End Row --}}

    {{-- Floating Action Bar (Tombol Aksi di Bawah) --}}
    {{-- Menggunakan container terpisah agar posisinya rapi di bawah deskripsi --}}
    <div class="row justify-content-end mt-4">
        <div class="col-lg-7">
            <div class="ps-lg-4 py-4 border-top d-grid gap-3 d-md-flex align-items-center">
                 {{-- LOGIKA WHATSAPP --}}
                 @if($produk->umkm && $produk->umkm->nomor_whatsapp)
                    @php
                        $no_wa = $produk->umkm->nomor_whatsapp;
                        // Hanya ambil angka
                        $no_wa = preg_replace('/[^0-9]/', '', $no_wa);
                        
                        // Cek awalan
                        if(substr($no_wa, 0, 1) == '0') {
                            $no_wa = '62' . substr($no_wa, 1);
                        } elseif(substr($no_wa, 0, 2) == '62') {
                             // Sudah benar, biarkan
                        } else {
                             // Asumsi user input tanpa 0 di depan, tambahkan 62
                             $no_wa = '62' . $no_wa;
                        }
                        
                        $pesan = "Halo {$produk->umkm->nama_umkm}, saya tertarik dengan produk *{$produk->nama_produk}* yang saya lihat di Website Desa. Apakah stoknya masih tersedia?";
                        $link_wa = "https://wa.me/{$no_wa}?text=" . urlencode($pesan);
                    @endphp

                    {{-- TOMBOL UNGGULAN (Hijau, Besar, Bayangan) --}}
                    <a href="{{ $link_wa }}" target="_blank" class="btn btn-success btn-lg rounded-pill fw-bold px-5 shadow py-3 flex-grow-1 flex-md-grow-0 d-flex align-items-center justify-content-center me-md-3 hover-lift">
                        <i class="bi bi-whatsapp fs-4 me-2"></i> Pesan Sekarang
                    </a>
                @else
                    {{-- TOMBOL MATI --}}
                    <button class="btn btn-secondary btn-lg rounded-pill px-5 py-3 fw-bold disabled flex-grow-1 flex-md-grow-0 me-md-3" disabled>
                        <i class="bi bi-telephone-x me-2"></i> Kontak Tidak Tersedia
                    </button>
                @endif

                {{-- Tombol Kembali --}}
                <a href="{{ route('belanja.umkm') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4 py-3 fw-bold">
                    Kembali
                </a>
            </div>
        </div>
    </div>

</div>

{{-- Inisialisasi Tooltip Bootstrap (Perlu ditaruh di layouts/app.blade.php idealnya, tapi ditaruh sini untuk memastikan jalan) --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endpush

@endsection