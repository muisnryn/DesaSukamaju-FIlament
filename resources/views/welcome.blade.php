@extends('layouts.app')

@section('title', 'Selamat Datang di Website Resmi Desa Sukamaju')

@section('content')

{{-- Style Khusus Halaman Welcome --}}
<style>
    /* Hero Carousel - Fullscreen Impact */
    .hero-carousel {
        margin-top: -80px; /* Menarik ke atas menutupi padding-top body */
    }
    .hero-carousel .carousel-item {
        height: 100vh; /* Full Height */
        min-height: 600px;
        background-size: cover;
        background-position: center;
        position: relative;
    }
    .hero-carousel .carousel-item::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.5) 100%);
    }
    .hero-carousel .carousel-caption {
        bottom: 35%;
        z-index: 2;
    }
    .hero-carousel h1 {
        font-size: 3.5rem;
        font-weight: 800;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.6);
        letter-spacing: -1px;
    }
    .hero-carousel p {
        font-size: 1.25rem;
        text-shadow: 1px 1px 4px rgba(0,0,0,0.6);
        max-width: 700px;
        margin: 0 auto;
    }

    /* Section Styling */
    .section-title {
        text-align: center;
        margin-bottom: 3.5rem;
        font-weight: 800;
        position: relative;
        color: #0f5132;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .section-title::after {
        content: '';
        display: block;
        width: 70px;
        height: 4px;
        background: #198754;
        margin: 15px auto 0;
        border-radius: 2px;
    }

    /* Card Hover Effect */
    .card-hover-effect {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    .card-hover-effect:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(25, 135, 84, 0.15) !important;
        border-color: #d1e7dd !important;
    }

    /* Dashboard Widget */
    .dashboard-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        overflow: hidden;
        height: 100%;
        transition: transform 0.3s ease;
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
        border-color: #198754;
    }
    .dashboard-header {
        padding: 20px 25px;
        background: linear-gradient(to right, #f8f9fa, #fff);
        border-bottom: 1px solid rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
    }
    .icon-box {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 1.25rem;
    }

    /* Responsif adjustments */
    @media (max-width: 768px) {
        .hero-carousel .carousel-item { 
            height: 85vh; /* Sedikit lebih tinggi agar proporsional */
            min-height: 500px; 
        }
        
        .hero-carousel .carousel-caption {
            /* PERBAIKAN UTAMA: Taruh teks di paling bawah */
            bottom: 140px !important; /* Jarak dari bawah layar */
            left: 5% !important;
            right: 5% !important;
            padding-bottom: 20px;
            text-align: center;
        }

        .hero-carousel h1 { 
            font-size: 1.8rem; 
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .hero-carousel p { 
            font-size: 0.95rem; 
            margin-bottom: 15px;
            /* Membatasi teks agar tidak terlalu panjang ke bawah */
            display: -webkit-box;
            -webkit-line-clamp: 2; 
            -webkit-box-orient: vertical;
            overflow: hidden;
            opacity: 0.9;
        }

        .hero-carousel .btn {
            font-size: 0.85rem;
            padding: 8px 20px !important;
        }

        /* Geser indikator (titik-titik carousel) agar tidak menutupi tombol */
        .hero-carousel .carousel-indicators {
            bottom: 10px;
        }
    }
</style>

{{-- HERO SECTION (Carousel) --}}
<header id="hero-carousel" class="carousel slide hero-carousel" data-bs-ride="carousel">
    <div class="carousel-indicators mb-4">
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" style="background-image: url('{{ asset('images/kantor-desa.jpg') }}');">
            <div class="carousel-caption">
                <span class="badge bg-success mb-2 px-3 py-2 rounded-pill fw-bold text-uppercase" style="font-size: 0.7rem;">Website Resmi</span>
                <h1 class="text-white">Selamat Datang</h1>
                <p class="text-white opacity-90">Pemerintah Desa Sukamaju, Kabupaten Cianjur. Media informasi dan pelayanan publik digital.</p>
                <div class="mt-3">
                    <a href="#sambutan" class="btn btn-success rounded-pill shadow fw-bold">Jelajahi Desa <i class="bi bi-arrow-down ms-1"></i></a>
                </div>
            </div>
        </div>

        <div class="carousel-item" style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
            <div class="carousel-caption">
                <span class="badge bg-warning text-dark mb-2 px-3 py-2 rounded-pill fw-bold text-uppercase" style="font-size: 0.7rem;">Pesona Alam</span>
                <h1 class="text-white">Potensi Agrowisata</h1>
                <p class="text-white opacity-90">Menjelajahi keindahan alam, persawahan hijau, dan potensi pertanian unggulan desa.</p>
            </div>
        </div>

        <div class="carousel-item" style="background-image: url('{{ asset('images/phbn.jpg') }}');">
            <div class="carousel-caption">
                <span class="badge bg-primary mb-2 px-3 py-2 rounded-pill fw-bold text-uppercase" style="font-size: 0.7rem;">Komunitas</span>
                <h1 class="text-white">Guyub Rukun</h1>
                <p class="text-white opacity-90">Membangun desa dengan semangat gotong royong dan kebersamaan warga masyarakat.</p>
            </div>
        </div>
    </div>
</header>

{{-- KONTEN UTAMA --}}
<main>
    {{-- Section Sambutan --}}
    <section id="sambutan" class="py-5 bg-white scroll-margin-top">
        <div class="container py-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-4 text-center">
                    <div class="position-relative d-inline-block">
                        {{-- Efek lingakaran ganda --}}
                        <div class="position-absolute top-50 start-50 translate-middle rounded-circle border border-success border-opacity-10" style="width: 320px; height: 320px; z-index: 0;"></div>
                        <img src="{{ asset('images/struktural/kades.jpg') }}" class="img-fluid rounded-circle shadow position-relative z-1" style="width: 280px; height: 280px; object-fit: cover; border: 8px solid #fff;" alt="Kepala Desa">
                        <div class="badge bg-success text-white px-4 py-2 rounded-pill position-absolute bottom-0 start-50 translate-middle-x shadow z-2" style="bottom: 10px !important;">
                            <span class="fw-bold">Kepala Desa</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <h6 class="text-success text-uppercase fw-bold ls-1 mb-2">Sambutan</h6>
                    <h2 class="fw-bold text-dark mb-1">Hendri, S.IP</h2>
                    <p class="text-muted mb-4">Kepala Desa Sukamaju Periode 2020 - 2026</p>
                    
                    <div class="position-relative ps-4 border-start border-4 border-success">
                        <i class="bi bi-quote text-success opacity-25 display-1 position-absolute top-0 start-0 translate-middle-x ms-2" style="z-index: -1;"></i>
                        <p class="text-secondary fst-italic fs-5" style="line-height: 1.8;">
                            "Assalamualaikum Wr. Wb. Puji syukur kehadirat Allah SWT. Website ini hadir sebagai wujud transparansi dan peningkatan pelayanan publik. Kami berkomitmen untuk mewujudkan Desa Sukamaju yang Mandiri, Sejahtera, dan Berakhlak Mulia melalui pemanfaatan teknologi informasi."
                        </p>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('profil') }}" class="btn btn-outline-success rounded-pill px-4 fw-bold hover-lift">
                            Baca Profil Lengkap <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Widget Jelajahi (Partial) --}}
    @include('partials._jelajahi')

    {{-- Widget Peta (Partial) --}}
    @include('partials._peta')

    {{-- Section Aparatur --}}
    <section class="py-5 bg-light position-relative">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Pemerintahan Desa</h2>
                <p class="text-muted w-75 mx-auto">Struktur pemerintahan desa yang solid dan siap melayani kebutuhan administrasi serta pembangunan masyarakat.</p>
            </div>

            <div class="row g-4 gy-5 justify-content-center">
                @foreach($aparaturs->take(4) as $orang)
                <div class="col-lg-3 col-md-6 pt-4"> 
                    <div class="card h-100 border-0 shadow-sm text-center card-hover-effect bg-white" style="border-radius: 20px; overflow: visible;">
                        <div class="position-relative">
                            <img src="{{ $orang->foto ? asset('storage/' . $orang->foto) : 'https://ui-avatars.com/api/?name='.urlencode($orang->nama) }}" 
                                 class="rounded-circle shadow-sm bg-white" 
                                 style="width: 120px; height: 120px; object-fit: cover; border: 5px solid #fff; margin-top: -60px;"
                                 alt="{{ $orang->nama }}">
                        </div>
                        <div class="card-body pt-4 pb-4">
                            <h5 class="fw-bold text-dark mb-1">{{ $orang->nama }}</h5>
                            <div class="d-inline-block px-3 py-1 rounded-pill bg-success-subtle text-success fw-bold small text-uppercase mt-2">
                                {{ $orang->jabatan }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('profil') }}#pemerintahan" class="btn btn-success px-5 rounded-pill shadow-sm fw-bold hover-lift">
                    Lihat Struktur Organisasi
                </a>
            </div>
        </div>
    </section>

    {{-- Section Infografis & Statistik --}}
    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title mb-5">Transparansi Data</h2>
            <div class="row g-5">
                {{-- Kolom Kiri: Demografi --}}
                <div class="col-lg-6">
                    <div class="dashboard-card">
                        <div class="dashboard-header">
                            <div class="icon-box bg-success-subtle text-success">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0 text-dark">Demografi Penduduk</h4>
                                <small class="text-muted">Statistik Kependudukan Terkini</small>
                            </div>
                        </div>
                        <div class="p-4">
                            @include('partials._administrasi')
                            <div class="mt-4 text-center border-top pt-3">
                                <a href="{{ route('infografis.penduduk') }}" class="text-decoration-none fw-bold text-success">
                                    Lihat Detail Statistik <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: APBDes --}}
                <div class="col-lg-6">
                    <div class="dashboard-card">
                        <div class="dashboard-header">
                            <div class="icon-box bg-success-subtle text-success">
                                <i class="bi bi-wallet2"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0 text-dark">APB Desa {{ date('Y') }}</h4>
                                <small class="text-muted">Transparansi Anggaran Desa</small>
                            </div>
                        </div>
                        <div class="p-4">
                            @include('partials._apb')
                            <div class="mt-4 text-center border-top pt-3">
                                <a href="{{ route('infografis.apbdes') }}" class="text-decoration-none fw-bold text-success">
                                    Lihat Rincian Realisasi <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section Berita --}}
    <section id="berita" class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2 class="section-title mb-0 text-start m-0 border-0 p-0 text-dark">Kabar Desa Terbaru</h2>
                <a href="{{ route('berita.index') }}" class="btn btn-outline-success rounded-pill px-4 fw-bold btn-sm">
                    Lihat Semua Berita
                </a>
            </div>
            
            <div class="row g-4">
                @forelse($beritas->take(3) as $item)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden card-hover-effect">
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" style="height: 220px; object-fit: cover;" alt="{{ $item->judul }}">
                            <div class="bg-success text-white position-absolute top-0 start-0 px-3 py-1 m-3 rounded-pill small fw-bold shadow">
                                Berita
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column p-4">
                            <small class="text-muted mb-2 d-flex align-items-center">
                                <i class="bi bi-calendar3 me-2 text-success"></i> {{ $item->created_at->translatedFormat('d F Y') }}
                            </small>
                            <h5 class="card-title fw-bold mb-3 text-dark lh-sm">
                                <a href="{{ route('berita.show', $item->slug) }}" class="text-decoration-none text-dark stretched-link hover-text-success">
                                    {{ Str::limit($item->judul, 55) }}
                                </a>
                            </h5>
                            <p class="card-text text-secondary small mb-4 flex-grow-1">
                                {{ Str::limit(strip_tags($item->konten), 90) }}
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="text-muted fst-italic bg-white p-4 rounded-4 shadow-sm d-inline-block">
                        <i class="bi bi-newspaper me-2"></i> Belum ada berita terbaru saat ini.
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    
    {{-- Section Potensi --}}
    <section id="potensi" class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title">Potensi Unggulan</h2>
            <div class="row g-4 text-center">
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 p-4 border-0 shadow-sm bg-light card-hover-effect rounded-4">
                        <div class="mb-3 text-success"><i class="bi bi-tree-fill display-4"></i></div>
                        <h5 class="fw-bold text-dark">Pertanian</h5>
                        <p class="small text-muted mb-0">Lumbung padi berkualitas dengan sistem irigasi teknis yang mumpuni.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 p-4 border-0 shadow-sm bg-light card-hover-effect rounded-4">
                        <div class="mb-3 text-success"><i class="bi bi-shop display-4"></i></div>
                        <h5 class="fw-bold text-dark">UMKM Kreatif</h5>
                        <p class="small text-muted mb-0">Sentra kerajinan bambu dan olahan makanan ringan khas desa.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 p-4 border-0 shadow-sm bg-light card-hover-effect rounded-4">
                        <div class="mb-3 text-success"><i class="bi bi-water display-4"></i></div>
                        <h5 class="fw-bold text-dark">Wisata Alam</h5>
                        <p class="small text-muted mb-0">Pesona curug dan pemandangan persawahan terasering yang indah.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 p-4 border-0 shadow-sm bg-light card-hover-effect rounded-4">
                        <div class="mb-3 text-success"><i class="bi bi-people-fill display-4"></i></div>
                        <h5 class="fw-bold text-dark">SDM Unggul</h5>
                        <p class="small text-muted mb-0">Masyarakat yang guyub, inovatif, dan menjunjung tinggi gotong royong.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

@endsection