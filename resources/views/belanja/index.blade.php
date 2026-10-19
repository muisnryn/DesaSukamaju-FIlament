@extends('layouts.app')

@section('title', 'Belanja UMKM Desa')

@section('content')

<style>
    /* Card Produk Hover Effect */
    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(25, 135, 84, 0.15) !important; /* Shadow kehijauan saat hover */
        border-color: #d1e7dd;
    }

    /* Membatasi teks agar rapi */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Header Gradasi HIJAU untuk UMKM (Konsisten dengan Profil) */
    .page-header-umkm {
        background: linear-gradient(135deg, #198754 0%, #20c997 100%);
        padding: 4rem 0 3rem;
        margin-bottom: 3rem;
        color: white;
        border-radius: 0 0 50px 50px;
        box-shadow: 0 10px 20px rgba(25, 135, 84, 0.2);
    }
</style>

{{-- Header Section --}}
<div class="page-header-umkm text-center">
    <div class="container">
        <h1 class="fw-bold display-5 mb-2">Belanja Dari Desa</h1>
        <p class="lead opacity-75">Temukan produk lokal unggulan langsung dari UMKM Desa Sukamaju.</p>
        
        {{-- Breadcrumb simpel (Opsional) --}}
        <nav aria-label="breadcrumb" class="d-flex justify-content-center mt-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-white text-decoration-none fw-bold opacity-75 hover-opacity-100">Beranda</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Produk UMKM</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container mb-5">
    {{-- Grid Produk --}}
    <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
        @forelse ($produks as $produk)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm product-card rounded-4 overflow-hidden">
                    
                    {{-- Gambar Produk --}}
                    <div class="position-relative">
                        <a href="{{ route('produk.show', $produk) }}">
                            <img src="{{ $produk->gambar_produk ? asset('storage/' . $produk->gambar_produk) : asset('images/no-image.jpg') }}" 
                                 class="card-img-top object-fit-cover" 
                                 alt="{{ $produk->nama_produk }}" 
                                 style="height: 220px;"
                                 onerror="this.onerror=null;this.src='https://placehold.co/400x300/f0fdf4/198754?text=Produk+Desa';">
                        </a>
                        
                        {{-- Badge UMKM --}}
                        @if($produk->umkm)
                            <div class="position-absolute top-0 start-0 m-3">
                                {{-- Ubah text-primary jadi text-success --}}
                                <span class="badge bg-white text-success shadow-sm rounded-pill px-3 py-2 border border-success-subtle">
                                    <i class="bi bi-shop me-1"></i> {{ Str::limit($produk->umkm->nama_umkm, 15) }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="card-body p-3 d-flex flex-column">
                        {{-- Nama Produk --}}
                        <a href="{{ route('produk.show', $produk) }}" class="text-decoration-none text-dark">
                            <h5 class="card-title fw-bold mb-1 line-clamp-2" style="min-height: 3rem;">
                                {{ $produk->nama_produk }}
                            </h5>
                        </a>

                        {{-- Harga (Ubah jadi Hijau) --}}
                        <h5 class="text-success fw-bold mb-3">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h5>

                        {{-- Deskripsi Singkat --}}
                        <p class="card-text text-muted small line-clamp-2 mb-4 flex-grow-1">
                            {!! Str::limit(strip_tags($produk->deskripsi), 80) !!}
                        </p>

                        {{-- Tombol Aksi --}}
                        <div class="d-grid gap-2">
                            {{-- Tombol Detail (Outline Hijau) --}}
                            <a href="{{ route('produk.show', $produk) }}" class="btn btn-outline-success btn-sm rounded-pill fw-bold">
                                Detail Produk
                            </a>
                            
                            @if($produk->umkm && $produk->umkm->no_wa)
                                @php
                                    // Format Nomor WA (62...)
                                    $no_wa = $produk->umkm->no_wa;
                                    // Hapus karakter non-digit
                                    $no_wa = preg_replace('/[^0-9]/', '', $no_wa);
                                    
                                    if(substr($no_wa, 0, 1) == '0') {
                                        $no_wa = '62' . substr($no_wa, 1);
                                    }
                                    $pesan = "Halo, saya tertarik dengan produk {$produk->nama_produk} yang ada di website Desa.";
                                    $link_wa = "https://wa.me/{$no_wa}?text=" . urlencode($pesan);
                                @endphp
                                {{-- Tombol WA (Hijau Solid - Tetap) --}}
                                <a href="{{ $link_wa }}" target="_blank" class="btn btn-success btn-sm rounded-pill fw-bold">
                                    <i class="bi bi-whatsapp me-1"></i> Beli Sekarang
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-3">
                        <div class="bg-success-subtle text-success rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                            <i class="bi bi-shop" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                    <h4 class="text-dark fw-bold">Belum ada produk yang tersedia.</h4>
                    <p class="text-secondary">Silakan cek kembali nanti untuk melihat produk terbaru dari desa kami.</p>
                </div>
            </div>
        @endforelse
    </div>
    
    {{-- Pagination --}}
    @if(method_exists($produks, 'links'))
        <div class="d-flex justify-content-center mt-5">
            {{ $produks->links() }}
        </div>
    @endif
</div>

@endsection