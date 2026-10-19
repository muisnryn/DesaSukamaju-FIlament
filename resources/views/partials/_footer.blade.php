<style>
    .footer {
        background-color: #1a1a1a;
        color: #b0b0b0;
        font-size: 0.9rem;
    }
    .footer-title {
        color: #fff;
        font-weight: 700;
        margin-bottom: 1.2rem;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .footer-link {
        color: #b0b0b0;
        text-decoration: none;
        transition: all 0.3s;
        display: block;
        margin-bottom: 0.8rem;
    }
    .footer-link:hover {
        color: #198754; /* Hijau Utama */
        padding-left: 5px;
    }
    .footer-contact i {
        width: 25px;
        color: #198754; /* Hijau Utama */
    }
    .social-btn {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(255,255,255,0.1);
        color: #fff;
        border-radius: 50%;
        text-decoration: none;
        transition: 0.3s;
        margin-right: 10px;
    }
    .social-btn:hover {
        background-color: #198754; /* Hijau Utama */
        color: #fff;
    }
</style>

<footer class="footer pt-5">
    <div class="container pb-4">
        <div class="row gy-4">
            {{-- Kolom 1: Identitas --}}
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('images/logo-desa.png') }}" alt="Logo" height="40" class="me-3">
                    <div>
                        <h5 class="text-white fw-bold mb-0">Desa Sukamaju</h5>
                        <small>Kabupaten Cianjur</small>
                    </div>
                </div>
                <p class="mb-4">
                    Website Resmi Pemerintah Desa Sukamaju. Media komunikasi dan transparansi publik untuk mewujudkan desa yang mandiri dan sejahtera.
                </p>
                <div class="d-flex">
                    <a href="#" class="social-btn"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-btn"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-btn"><i class="bi bi-youtube"></i></a>
                    <a href="#" class="social-btn"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>

            {{-- Kolom 2: Jelajahi --}}
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-title">Jelajahi</h5>
                <a href="/" class="footer-link">Beranda</a>
                <a href="{{ route('profil') }}" class="footer-link">Profil Desa</a>
                <a href="{{ route('infografis.index') }}" class="footer-link">Infografis</a>
                <a href="{{ route('berita.index') }}" class="footer-link">Kabar Desa</a>
                <a href="{{ route('belanja.umkm') }}" class="footer-link">Produk UMKM</a>
            </div>

            {{-- Kolom 3: Layanan --}}
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-title">Layanan</h5>
                
                {{-- LINK CEK BANSOS DIPERBAIKI DI SINI --}}
                <a href="{{ route('infografis.bansos') }}" class="footer-link">Cek Bansos</a>
                
                <a href="#" class="footer-link">Informasi Publik</a>
                <a href="/admin" class="footer-link">Login Admin</a>
            </div>

            {{-- Kolom 4: Kontak --}}
            <div class="col-lg-4 col-md-6" id="hubungi-kami"> 
                <h5 class="footer-title">Hubungi Kami</h5>
                <ul class="list-unstyled footer-contact">
                    <li class="mb-3 d-flex text-start">
                        <i class="bi bi-geo-alt-fill mt-1"></i>
                        <span>Sukamaju, Kec. Cibeber, Kabupaten Cianjur, Jawa Barat 43262</span>
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="bi bi-envelope-fill mt-1"></i>
                        <span>sukamajucibeber@gmail.com</span>
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="bi bi-telephone-fill mt-1"></i>
                        <span>0831-1274-0004</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Copyright --}}
    <div class="bg-black py-3">
        <div class="container text-center">
            <small class="mb-0">
                &copy; {{ date('Y') }} <strong>Pemerintah Desa Sukamaju</strong>. Hak Cipta Dilindungi.
                {{-- TEXT DIBUAT OLEH DIPERBAIKI DI SINI --}}
                <span class="d-none d-sm-inline">| Dibuat Oleh Mahasiswa KKN UNSUR 2025 untuk Desa Sukamaju.</span>
            </small>
        </div>
    </div>
</footer>