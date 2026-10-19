<section id="jelajahi" class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <h2 class="fw-bold mb-3" style="font-size: 2.5rem;">JELAJAHI DESA</h2>
                <p class="text-muted">
                    Melalui website ini Anda dapat menjelajahi segala hal yang terkait dengan desa. Aspek pemerintahan, penduduk, demografi, potensi desa, dan juga berita tentang desa.
                </p>
            </div>
            <div class="col-lg-7">
                <div class="row g-4">
                    <div class="col-md-6">
                        {{-- Mengarah ke halaman Profil --}}
                        <a href="{{ route('profil') }}" class="text-decoration-none text-dark">
                            <div class="card text-center p-4 h-100 card-jelajahi shadow-sm border-0">
                                <div class="card-body">
                                    <i class="bi bi-bank fs-1 mb-3 text-success"></i>
                                    <h5 class="fw-bold">Profil Desa</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-6">
                        {{-- Mengarah ke halaman Infografis (Default: Penduduk) --}}
                        <a href="{{ route('infografis.penduduk') }}" class="text-decoration-none text-dark">
                            <div class="card text-center p-4 h-100 card-jelajahi shadow-sm border-0">
                                <div class="card-body">
                                    <i class="bi bi-bar-chart-line-fill fs-1 mb-3 text-success"></i>
                                    <h5 class="fw-bold">Infografis</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-6">
                        {{-- Mengarah ke halaman Belanja UMKM --}}
                        <a href="{{ route('belanja.umkm') }}" class="text-decoration-none text-dark">
                            <div class="card text-center p-4 h-100 card-jelajahi shadow-sm border-0">
                                <div class="card-body">
                                    <i class="bi bi-shop fs-1 mb-3 text-success"></i>
                                    <h5 class="fw-bold">Produk UMKM</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-6">
                        {{-- Link mengarah ke ID spesifik 'hubungi-kami' --}}
                        <a href="#hubungi-kami" class="text-decoration-none text-dark">
                            <div class="card text-center p-4 h-100 card-jelajahi shadow-sm border-0">
                                <div class="card-body">
                                    <i class="bi bi-telephone-fill fs-1 mb-3 text-success"></i>
                                    <h5 class="fw-bold">Kontak</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>