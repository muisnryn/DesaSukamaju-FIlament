@php
    // Helper format Rupiah
    function formatRupiah($angka) {
        return 'Rp' . number_format($angka, 0, ',', '.');
    }

    // Ambil data dari variabel yang dikirim controller
    $pendapatan = $apbdes->total_pendapatan ?? 0;
    $belanja = $apbdes->total_belanja ?? 0;
    
    // Hitung Persentase Realisasi (Dummy calculation untuk visualisasi bar)
    // Karena biasanya APBDes itu Pagu vs Realisasi, disini kita bandingkan Belanja thd Pendapatan
    $rasio = ($pendapatan > 0) ? ($belanja / $pendapatan) * 100 : 0;
@endphp

<div class="d-flex flex-column gap-4">
    <div>
        <div class="d-flex justify-content-between align-items-end mb-2">
            <div>
                <div class="d-flex align-items-center mb-1">
                    <i class="bi bi-arrow-down-left-circle-fill text-success me-2 fs-5"></i>
                    <span class="text-secondary fw-bold small text-uppercase ls-1">Pendapatan Desa</span>
                </div>
                <h3 class="fw-bold text-dark mb-0">{{ formatRupiah($pendapatan) }}</h3>
            </div>
            <div class="text-end">
                <span class="badge bg-success-subtle text-success rounded-pill px-3">{{ $apbdes->tahun ?? date('Y') }}</span>
            </div>
        </div>
        <div class="progress" style="height: 10px; background-color: #f1f3f5; border-radius: 5px;">
            <div class="progress-bar bg-success" role="progressbar" style="width: 100%; border-radius: 5px;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>

    <div>
        <div class="d-flex justify-content-between align-items-end mb-2">
            <div>
                <div class="d-flex align-items-center mb-1">
                    <i class="bi bi-arrow-up-right-circle-fill text-warning me-2 fs-5"></i>
                    <span class="text-secondary fw-bold small text-uppercase ls-1">Belanja Desa</span>
                </div>
                <h3 class="fw-bold text-dark mb-0">{{ formatRupiah($belanja) }}</h3>
            </div>
            <div class="text-end">
                <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-3">
                    Rasio: {{ round($rasio) }}%
                </span>
            </div>
        </div>
        <div class="progress" style="height: 10px; background-color: #f1f3f5; border-radius: 5px;">
            <div class="progress-bar bg-warning" role="progressbar" 
                 style="width: {{ $rasio > 100 ? 100 : $rasio }}%; border-radius: 5px;" 
                 aria-valuenow="{{ $rasio }}" aria-valuemin="0" aria-valuemax="100">
            </div>
        </div>
    </div>

    <div class="alert alert-light border border-secondary-subtle d-flex align-items-start gap-3 mb-0 rounded-4">
        <i class="bi bi-info-circle-fill text-secondary fs-5 mt-1"></i>
        <div class="lh-sm text-secondary" style="font-size: 0.85rem;">
            <strong>Status Anggaran:</strong> 
            @if($pendapatan > $belanja)
                Surplus sebesar <strong>{{ formatRupiah($pendapatan - $belanja) }}</strong>.
            @elseif($belanja > $pendapatan)
                Defisit sebesar <strong>{{ formatRupiah($belanja - $pendapatan) }}</strong> ditutup oleh SiLPA tahun sebelumnya.
            @else
                Anggaran Berimbang (Defisit Rp0).
            @endif
        </div>
    </div>
</div>