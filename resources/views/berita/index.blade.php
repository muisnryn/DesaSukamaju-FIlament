@extends('layouts.app')

@section('title', 'Berita Desa')

@section('content')

<style>
    /* Custom Hover Effect untuk Card */
    .news-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    /* Line Clamp untuk membatasi jumlah baris teks */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Gradient Header */
    .page-header {
        background: linear-gradient(135deg, #198754 0%, #20c997 100%); /* Nuansa Hijau Desa */
        padding: 3rem 0;
        margin-bottom: 3rem;
        color: white;
        border-radius: 0 0 50px 50px; /* Lengkungan modern di bawah */
    }
</style>

{{-- Header Section --}}
<div class="page-header text-center">
    <div class="container">
        <h1 class="fw-bold display-5 mb-2">Berita & Informasi Desa</h1>
        <p class="lead opacity-75">Update terbaru seputar kegiatan, pembangunan, dan pengumuman Desa Sukamaju.</p>
    </div>
</div>

<div class="container mb-5">
    {{-- Grid Berita --}}
    <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
        @forelse ($beritas as $item)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm news-card rounded-4 overflow-hidden">
                    {{-- Gambar Berita --}}
                    <div class="position-relative">
                        <a href="{{ route('berita.show', $item->slug) }}">
                            <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/no-image.jpg') }}" 
                                 class="card-img-top object-fit-cover" 
                                 alt="{{ $item->judul }}" 
                                 style="height: 220px;"
                                 onerror="this.onerror=null;this.src='https://placehold.co/600x400/e9ecef/6c757d?text=No+Image';">
                        </a>
                        {{-- Badge Tanggal (Overlay) --}}
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-white text-success shadow-sm px-3 py-2 rounded-pill">
                                <i class="bi bi-calendar-event me-1"></i> {{ $item->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>

                    {{-- Konten Berita --}}
                    <div class="card-body p-4 d-flex flex-column">
                        <a href="{{ route('berita.show', $item->slug) }}" class="text-decoration-none text-dark">
                            <h5 class="card-title fw-bold mb-3 line-clamp-2">{{ $item->judul }}</h5>
                        </a>
                        
                        <div class="card-text text-muted mb-4 line-clamp-3 flex-grow-1">
                            {!! Str::limit(strip_tags($item->isi), 120) !!}
                        </div>

                        <a href="{{ route('berita.show', $item->slug) }}" class="btn btn-outline-success rounded-pill w-100 fw-bold mt-auto">
                            Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            {{-- State Kosong --}}
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-newspaper text-muted" style="font-size: 4rem;"></i>
                    </div>
                    <h4 class="text-muted">Belum ada berita yang dipublikasikan.</h4>
                    <p class="text-secondary">Silakan kembali lagi nanti untuk melihat update terbaru.</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-5">
        {{ $beritas->links() }}
    </div>
</div>

@endsection