@extends('layouts.infografis')

@section('title', 'SDGs Desa')

@section('infografis_content')

{{-- Gaya Kustom --}}
<style>
    /* Kartu Skor Utama (Green Gradient Style) */
    .sdg-card-main {
        background: linear-gradient(135deg, #198754 0%, #20c997 100%);
        color: white;
        border: none;
        border-radius: 20px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(25, 135, 84, 0.3);
        transition: transform 0.3s ease;
    }
    .sdg-card-main:hover {
        transform: translateY(-5px);
    }
    /* Dekorasi Latar Belakang Kartu */
    .sdg-card-main::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 250px;
        height: 250px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        z-index: 0;
    }
    .sdg-card-main::after {
        content: '';
        position: absolute;
        bottom: -40px;
        left: -40px;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        z-index: 0;
    }
    .sdg-content { position: relative; z-index: 1; }
    .sdg-icon-large { font-size: 4.5rem; color: rgba(255, 255, 255, 0.85); }

    /* Container Grafik */
    .chart-container {
        position: relative;
        margin: auto;
        height: 65vh; /* Tinggi ideal di desktop */
        width: 100%;
        max-height: 750px;
    }
    
    /* Responsif untuk Mobile */
    @media (max-width: 768px) {
        .chart-container {
            height: 500px; /* Tinggi fix di mobile agar scrollable nyaman */
        }
        .sdg-icon-large { display: none; } /* Sembunyikan ikon besar di HP */
    }
</style>

{{-- Header & Filter Tahun --}}
<div class="row align-items-center mb-5 gy-3">
    <div class="col-md-8">
        <h2 class="section-title mb-0 text-center text-md-start">Capaian SDGs Desa {{ $currentYear }}</h2>
        <p class="text-muted text-center text-md-start mb-0">Tujuan Pembangunan Berkelanjutan (Sustainable Development Goals).</p>
    </div>
    <div class="col-md-4">
        <form action="{{ route('infografis.sdgs') }}" method="GET">
            <div class="input-group shadow-sm rounded-pill overflow-hidden border">
                <span class="input-group-text bg-white border-0 ps-3 fw-bold text-secondary small text-uppercase">Tahun</span>
                <select name="tahun" class="form-select border-0 bg-light fw-bold text-success text-center" style="cursor: pointer;" onchange="this.form.submit()">
                    @forelse($years as $year)
                        <option value="{{ $year }}" {{ $currentYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @empty
                        <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                    @endforelse
                </select>
            </div>
        </form>
    </div>
</div>

@if(isset($sdg) && $sdg)
    
    {{-- 1. Kartu Skor Utama --}}
    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="card sdg-card-main p-4 p-md-5">
                <div class="d-flex align-items-center justify-content-between sdg-content">
                    <div>
                        <h6 class="text-white-50 text-uppercase ls-1 mb-2 fw-bold">Skor Rata-Rata SDGs Desa</h6>
                        <div class="d-flex align-items-baseline">
                            <h1 class="display-3 fw-bolder mb-0">{{ number_format($sdg->skor_total, 2) }}</h1>
                            <span class="fs-4 ms-2 text-white-50">/ 100</span>
                        </div>
                        <p class="mb-0 mt-3 text-white-50 small bg-white bg-opacity-10 d-inline-block px-3 py-1 rounded-pill">
                            <i class="bi bi-info-circle me-1"></i> Indeks Desa Membangun Berkelanjutan
                        </p>
                    </div>
                    <div class="sdg-icon-large pe-md-4">
                        <i class="bi bi-globe-asia-australia"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Persiapan Data untuk Chart --}}
    @php
        $goals = [
            '1. Desa Tanpa Kemiskinan' => $sdg->desa_tanpa_kemiskinan,
            '2. Desa Tanpa Kelaparan' => $sdg->desa_tanpa_kelaparan,
            '3. Desa Sehat & Sejahtera' => $sdg->desa_sehat_sejahtera,
            '4. Pendidikan Desa Berkualitas' => $sdg->pendidikan_desa_berkualitas,
            '5. Keterlibatan Perempuan' => $sdg->keterlibatan_perempuan_desa,
            '6. Layak Air Bersih & Sanitasi' => $sdg->desa_layak_air_bersih,
            '7. Desa Berenergi Bersih' => $sdg->desa_berenergi_bersih,
            '8. Pertumbuhan Ekonomi Desa' => $sdg->pertumbuhan_ekonomi_merata,
            '9. Infrastruktur & Inovasi' => $sdg->infrastruktur_inovasi,
            '10. Desa Tanpa Kesenjangan' => $sdg->desa_tanpa_kesenjangan,
            '11. Kawasan Pemukiman Aman' => $sdg->kawasan_pemukiman_aman,
            '12. Konsumsi Sadar Lingkungan' => $sdg->konsumsi_produksi_sadar_lingkungan,
            '13. Tanggap Perubahan Iklim' => $sdg->desa_tanggap_perubahan_iklim,
            '14. Peduli Lingkungan Laut' => $sdg->desa_peduli_lingkungan_laut,
            '15. Peduli Lingkungan Darat' => $sdg->desa_peduli_lingkungan_darat,
            '16. Desa Damai & Berkeadilan' => $sdg->desa_damai_berkeadilan,
            '17. Kemitraan Pembangunan' => $sdg->kemitraan_pembangunan_desa,
            '18. Kelembagaan Desa Dinamis' => $sdg->kelembagaan_desa_dinamis,
        ];
        
        $labels = json_encode(array_keys($goals));
        $data = json_encode(array_values($goals));
    @endphp

    {{-- 2. Grafik Polar Area (Visualisasi Roda SDGs) --}}
    <div class="card border-0 shadow rounded-4 overflow-hidden mb-5">
        <div class="card-header bg-white border-bottom p-4">
            <div class="d-flex align-items-center">
                <div class="bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                    <i class="bi bi-pie-chart-fill fs-4"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-0">Peta Capaian SDGs</h5>
                    <small class="text-muted">Visualisasi skor per tujuan. Semakin penuh irisan warna, semakin baik capaiannya.</small>
                </div>
            </div>
        </div>
        
        <div class="card-body p-4">
            <div class="chart-container">
                <canvas id="sdgsPolarChart"></canvas>
            </div>
        </div>
    </div>

@else
    {{-- Alert Data Kosong --}}
    <div class="alert alert-warning text-center mt-4 d-flex flex-column flex-md-row align-items-center justify-content-center gap-3 py-4 rounded-4 shadow-sm border-0">
        <div class="bg-warning-subtle text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
            <i class="bi bi-exclamation-lg fs-3"></i>
        </div>
        <div class="text-center text-md-start">
            <strong>Data Tidak Ditemukan!</strong><br>
            Belum ada data SDGs Desa yang diinput untuk tahun <strong>{{ $currentYear }}</strong>.
        </div>
    </div>
@endif

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @if(isset($sdg) && $sdg)
    const ctxSdgs = document.getElementById('sdgsPolarChart').getContext('2d');
    
    // Warna Resmi SDGs (Standard UN Colors)
    const sdgColors = [
        '#E5243B', // 1
        '#DDA63A', // 2
        '#4C9F38', // 3
        '#C5192D', // 4
        '#FF3A21', // 5
        '#26BDE2', // 6
        '#FCC30B', // 7
        '#A21942', // 8
        '#FD6925', // 9
        '#DD1367', // 10
        '#FD9D24', // 11
        '#BF8B2E', // 12
        '#3F7E44', // 13
        '#0A97D9', // 14
        '#56C02B', // 15
        '#00689D', // 16
        '#19486A', // 17
        '#10689D'  // 18
    ];

    // Deteksi Lebar Layar untuk Responsivitas Posisi Legenda
    const legendPosition = window.innerWidth < 768 ? 'bottom' : 'right';

    new Chart(ctxSdgs, {
        type: 'polarArea',
        data: {
            labels: {!! $labels !!},
            datasets: [{
                label: 'Skor',
                data: {!! $data !!},
                backgroundColor: sdgColors,
                borderWidth: 2,
                borderColor: '#ffffff',
                hoverOffset: 15 // Efek irisan keluar saat di-hover (Pop-out)
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                r: {
                    angleLines: { display: true, color: '#f0f0f0' },
                    suggestedMin: 0,
                    suggestedMax: 100,
                    ticks: {
                        backdropColor: 'rgba(255, 255, 255, 0.9)',
                        color: '#666',
                        font: { size: 10, family: "'Poppins', sans-serif" },
                        z: 1
                    },
                    grid: { color: '#e9ecef' }
                }
            },
            plugins: {
                legend: {
                    position: legendPosition, // Posisi legenda dinamis
                    labels: {
                        font: { size: 11, family: "'Poppins', sans-serif" },
                        boxWidth: 15,
                        padding: 15,
                        usePointStyle: true // Menggunakan titik bulat/kotak kecil
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(33, 37, 41, 0.95)',
                    padding: 15,
                    cornerRadius: 10,
                    titleFont: { size: 13, family: "'Poppins', sans-serif", weight: 'bold' },
                    bodyFont: { size: 13, family: "'Poppins', sans-serif" },
                    displayColors: true,
                    callbacks: {
                        label: function(context) {
                            return ' Skor: ' + context.parsed.r.toFixed(2);
                        }
                    }
                }
            },
            layout: {
                padding: 20
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });
    @endif
</script>
@endpush