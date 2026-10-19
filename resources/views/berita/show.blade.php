@extends('layouts.app')

@section('title', $berita->judul)

@section('content')

<style>
    /* Styling khusus untuk konten artikel (WYSIWYG) */
    .article-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #333;
    }
    
    /* Memastikan elemen di dalam artikel responsif */
    .article-content img {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 8px;
        margin: 1.5rem 0;
    }
    .article-content iframe {
        max-width: 100%;
        width: 100%;
    }
    .article-content blockquote {
        border-left: 4px solid #198754;
        padding-left: 1rem;
        font-style: italic;
        color: #6c757d;
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 0 8px 8px 0;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            
            {{-- Breadcrumb Navigasi --}}
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb bg-light p-3 rounded-3 shadow-sm">
                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-success fw-bold">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('berita.index') }}" class="text-decoration-none text-success fw-bold">Berita</a></li>
                    <li class="breadcrumb-item active text-muted" aria-current="page">{{ Str::limit($berita->judul, 30) }}</li>
                </ol>
            </nav>

            {{-- Kartu Artikel Utama --}}
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                
                {{-- Gambar Utama --}}
                <div class="position-relative">
                    <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : asset('images/no-image.jpg') }}" 
                         class="w-100 object-fit-cover" 
                         alt="{{ $berita->judul }}" 
                         style="max-height: 500px;"
                         onerror="this.onerror=null;this.src='https://placehold.co/800x500/e9ecef/6c757d?text=No+Image';">
                    
                    {{-- Overlay Gradient untuk Judul (Opsional, atau judul di bawah gambar) --}}
                </div>

                <div class="card-body p-4 p-md-5">
                    {{-- Meta Data --}}
                    <div class="d-flex align-items-center text-muted mb-3 small">
                        <div class="d-flex align-items-center me-3">
                            <i class="bi bi-calendar-event me-2 text-success"></i>
                            {{ $berita->created_at->format('d F Y') }}
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock me-2 text-success"></i>
                            {{ $berita->created_at->format('H:i') }} WIB
                        </div>
                        {{-- Jika ada penulis --}}
                        {{-- <div class="d-flex align-items-center ms-3">
                            <i class="bi bi-person me-2 text-success"></i> Admin Desa
                        </div> --}}
                    </div>

                    {{-- Judul Berita --}}
                    <h1 class="fw-bold mb-4 text-dark lh-sm">{{ $berita->judul }}</h1>

                    <hr class="my-4 opacity-10">

                    {{-- Isi Berita --}}
                    <div class="article-content text-justify">
                        {!! $berita->isi !!}
                    </div>

                    <hr class="my-5">

                    {{-- Tombol Navigasi Bawah --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-2"></i> Kembali ke Berita
                        </a>
                        
                        {{-- Tombol Share (Opsional - Dummy Link) --}}
                        <div class="d-flex gap-2">
                            <span class="text-muted small align-self-center me-1">Bagikan:</span>
                            <a href="#" class="btn btn-sm btn-primary rounded-circle"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="btn btn-sm btn-success rounded-circle"><i class="bi bi-whatsapp"></i></a>
                            <a href="#" class="btn btn-sm btn-info text-white rounded-circle"><i class="bi bi-twitter-x"></i></a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection