<div class="map-wrapper card border-0 shadow-lg rounded-4 overflow-hidden h-100">
    
    {{-- BAGIAN 1: LABEL / HEADER --}}
    <div class="p-3 bg-white border-bottom d-flex align-items-center gap-3">
        {{-- Ikon Bulat --}}
        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px;">
            <i class="bi bi-geo-alt-fill"></i>
        </div>
        {{-- Teks --}}
        <div class="lh-1">
            <h6 class="fw-bold mb-1 text-dark">Lokasi Desa</h6>
            <span class="text-muted small" style="font-size: 0.75rem;">Peta Wilayah Administratif</span>
        </div>
    </div>

    {{-- BAGIAN 2: KONTEN PETA --}}
    <div class="flex-grow-1 position-relative map-container-body">
        
        {{-- CEK: Apakah Admin sudah input peta? --}}
        @if(isset($profil) && !empty($profil->iframe_peta))
            
            {{-- KONDISI ADA DATA: Tampilkan Peta --}}
            <div class="ratio ratio-16x9 map-frame h-100">
                {!! $profil->iframe_peta !!}
            </div>

        @else
            
            {{-- KONDISI KOSONG: Tampilkan Placeholder (Empty State) --}}
            <div class="d-flex flex-column align-items-center justify-content-center h-100 w-100 bg-light text-center p-4" style="min-height: 350px;">
                {{-- Ikon Besar Pudar --}}
                <div class="mb-3 text-secondary opacity-25">
                    <i class="bi bi-map-fill" style="font-size: 5rem;"></i>
                </div>
                
                {{-- Pesan Informasi --}}
                <h6 class="fw-bold text-secondary mb-2">Peta Belum Tersedia</h6>
                <p class="text-muted small mb-0" style="max-width: 80%;">
                    Lokasi peta wilayah belum disematkan oleh Administrator. <br>
                    Silakan hubungi Kantor Desa untuk informasi lokasi lebih lanjut.
                </p>
            </div>

        @endif

    </div>

</div>

<style>
    /* 1. Styling Peta (Jika ada) */
    .map-frame iframe {
        width: 100% !important;
        height: 100% !important;
        border: 0;
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        filter: saturate(1.1) contrast(1.05); 
    }

    /* 2. Styling Container */
    .map-wrapper {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: #fff;
        display: flex;
        flex-direction: column;
        min-height: 300px;
    }
    
    .map-container-body {
        background-color: #f8f9fa;
    }

    .map-wrapper:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
    }
</style>