@extends('layouts.app')

@section('title', 'Profil Desa ')

@section('content')

<style>
    /* Header Style */
    .page-header {
        background: linear-gradient(135deg, #198754 0%, #20c997 100%);
        padding: 5rem 0 4rem;
        margin-bottom: 3rem;
        color: white;
        border-radius: 0 0 50px 50px;
        box-shadow: 0 10px 30px rgba(25, 135, 84, 0.15);
    }

    /* Sidebar Navigation Style */
    .nav-pills .nav-link {
        color: #555;
        background-color: white;
        border: 1px solid rgba(0,0,0,0.05);
        margin-bottom: 0.75rem;
        border-radius: 50px;
        padding: 0.85rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }
    
    .nav-pills .nav-link:hover {
        background-color: #f8f9fa;
        color: #198754;
        transform: translateX(5px);
        border-color: #d1e7dd;
    }
    
    /* State Active */
    .nav-pills .nav-link.active {
        background-color: #198754; /* Hijau Utama */
        color: white;
        border-color: #198754;
        box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3);
        transform: translateX(5px);
        font-weight: 700;
    }

    html { scroll-behavior: smooth; }
    
    /* PENTING: Offset agar judul tidak tertutup navbar saat di-scroll/klik */
    .section-scroll {
        scroll-margin-top: 120px; 
        padding-top: 20px;
        margin-bottom: 60px;
    }
</style>

{{-- Header --}}
<div class="page-header text-center">
    <div class="container">
        <h1 class="fw-bold display-5 mb-2">Profil Desa Sukamaju</h1>
        <p class="lead opacity-75">Mengenal lebih dekat sejarah, visi misi, dan struktur pemerintahan desa kami.</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row g-5">
        
        {{-- SIDEBAR NAVIGASI --}}
        <div class="col-lg-3 d-none d-lg-block">
            <div class="sticky-nav" style="position: sticky; top: 110px; z-index: 9;">
                <h6 class="text-uppercase text-muted fw-bold mb-3 ls-1 small ps-3">Daftar Isi</h6>
                <div class="nav flex-column nav-pills" id="profil-nav">
                    <a class="nav-link" href="#sejarah">
                        <i class="bi bi-clock-history me-2"></i> Sejarah Desa
                    </a>
                    <a class="nav-link" href="#visi-misi">
                        <i class="bi bi-bullseye me-2"></i> Visi & Misi
                    </a>
                    <a class="nav-link" href="#pemerintahan">
                        <i class="bi bi-people-fill me-2"></i> Pemerintahan
                    </a>
                    <a class="nav-link" href="#peta-wilayah">
                        <i class="bi bi-map-fill me-2"></i> Peta Wilayah
                    </a>
                </div>

                {{-- Widget Kontak --}}
                <div class="card border-0 bg-white rounded-4 mt-4 p-4 shadow-sm text-center">
                    <div class="mb-3 text-success"><i class="bi bi-headset display-5"></i></div>
                    <h6 class="fw-bold mb-2">Butuh Bantuan?</h6>
                    <a href="#hubungi-kami" class="btn btn-success btn-sm rounded-pill w-100 fw-bold mt-2">Hubungi Kami</a>
                </div>
            </div>
        </div>

        {{-- KONTEN UTAMA --}}
        <div class="col-lg-9">
            
            {{-- 1. BAGIAN SEJARAH --}}
            <section id="sejarah" class="section-scroll">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4">
                    <div class="d-flex align-items-center mb-4 border-bottom pb-3">
                        <div class="bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                            <i class="bi bi-clock-history fs-4"></i>
                        </div>
                        <h3 class="fw-bold mb-0 text-dark">Sejarah Desa</h3>
                    </div>
                    <div class="rich-content" style="line-height: 1.8; text-align: justify; color: #555;">
                        {!! $profil->sejarah ?? '<p class="text-muted">Belum ada data sejarah.</p>' !!}
                    </div>
                </div>
            </section>

            {{-- 2. BAGIAN VISI MISI --}}
            <section id="visi-misi" class="section-scroll">
                {{-- Kita memanggil partial profil tapi pastikan tampilannya cocok, atau kita buat manual disini agar rapi --}}
                <div class="row g-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                            <div class="card-header bg-success text-white p-4">
                                <h4 class="mb-0 fw-bold"><i class="bi bi-eye me-2"></i>Visi Desa</h4>
                            </div>
                            <div class="card-body p-4 bg-light">
                                <blockquote class="blockquote mb-0 fst-italic text-center text-dark fs-5">
                                    "{!! strip_tags($profil->visi ?? 'Belum ada visi.') !!}"
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-header bg-white p-4 border-bottom">
                                <h4 class="mb-0 fw-bold text-success"><i class="bi bi-list-check me-2"></i>Misi Desa</h4>
                            </div>
                            <div class="card-body p-4">
                                <div class="ms-2">
                                    {!! $profil->misi ?? '<p class="text-muted">Belum ada misi.</p>' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- 3. BAGIAN PEMERINTAHAN --}}
            <section id="pemerintahan" class="section-scroll">
                <div class="d-flex align-items-center mb-4 border-bottom pb-3">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 50px; height: 50px;">
                        <i class="bi bi-diagram-3-fill fs-4"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0 text-dark">Struktur Pemerintahan</h3>
                        <p class="text-muted mb-0">Aparatur Desa {{ $profil->nama_desa ?? 'Sukamaju' }}</p>
                    </div>
                </div>
                {{-- Include Aparatur Partial --}}
                @include('partials._aparatur', ['aparaturs' => $aparaturs])
            </section>

            {{-- 4. BAGIAN PETA --}}
            <section id="peta-wilayah" class="section-scroll">
                <div class="d-flex align-items-center mb-4 border-bottom pb-3">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 50px; height: 50px;">
                        <i class="bi bi-geo-alt-fill fs-4"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0 text-dark">Lokasi Desa</h3>
                        <p class="text-muted mb-0">Peta Wilayah Administratif</p>
                    </div>
                </div>
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-2 bg-white">
                        <div style="height: 450px; width: 100%; border-radius: 12px; overflow: hidden;">
                            @include('partials._peta') 
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

{{-- SCRIPT SCROLLSPY MANUAL YANG LEBIH AKURAT --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll(".section-scroll"); // Pilih section berdasarkan class
        const navLinks = document.querySelectorAll("#profil-nav .nav-link");

        function onScroll() {
            let current = "";
            const offset = 200; // Jarak toleransi dari atas layar (sesuaikan dengan tinggi header/navbar)

            sections.forEach((section) => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                
                // Logika: Jika kita scroll melebihi bagian atas section (dikurangi offset)
                if (window.scrollY >= (sectionTop - offset)) {
                    current = section.getAttribute("id");
                }
            });

            navLinks.forEach((link) => {
                link.classList.remove("active");
                // Cek jika href link cocok dengan ID section yang sedang dilihat
                if (link.getAttribute("href").includes(current)) {
                    link.classList.add("active");
                }
            });
        }

        // Jalankan saat di-scroll
        window.addEventListener("scroll", onScroll);
        // Jalankan sekali saat load untuk set posisi awal
        onScroll();
    });
</script>
@endpush

@endsection