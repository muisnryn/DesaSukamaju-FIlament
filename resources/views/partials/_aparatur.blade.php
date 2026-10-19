<section id="aparatur" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-uppercase" style="color: var(--secondary-color);">
                <i class="bi bi-people me-2"></i>Pemerintahan Desa
            </h2>
            <p class="text-muted">Mengenal para pelayan masyarakat Desa Sukamaju</p>
            <div class="mx-auto" style="width: 80px; height: 4px; background: var(--primary-color); border-radius: 2px;"></div>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($aparaturs as $orang)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card card-struktur border-0 shadow-sm text-center h-100 bg-white">
                        <div class="position-relative">
                            <img src="{{ $orang->foto ? asset('storage/' . $orang->foto) : 'https://ui-avatars.com/api/?name='.urlencode($orang->nama).'&background=008000&color=fff' }}" 
                                 class="card-img-top shadow-sm border border-white" 
                                 alt="{{ $orang->nama }}">
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold mb-1 text-dark">{{ $orang->nama }}</h5>
                            <p class="text-success fw-medium small text-uppercase mb-0" style="letter-spacing: 1px;">
                                {{ $orang->jabatan }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4">
                    <p class="text-muted">Data aparatur belum tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<style>
    /* CSS Khusus untuk mempercantik List Misi dari RichEditor */
    .misi-content ol, .misi-content ul {
        padding-left: 1rem;
    }
    .misi-content li {
        margin-bottom: 0.8rem;
        color: #555;
        line-height: 1.6;
    }
    
    /* Perbaikan posisi foto agar presisi */
    .card-struktur {
        margin-top: 50px;
        border-radius: 20px !important;
        transition: all 0.3s ease;
    }
    .card-struktur:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .card-struktur .card-img-top {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        object-fit: cover;
        margin-top: -55px;
        background: #fff;
    }
    .card-struktur .card-body {
        padding-top: 65px;
        padding-bottom: 30px;
    }
</style>