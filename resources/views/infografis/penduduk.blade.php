@extends('layouts.infografis')

@section('title', 'Demografi Penduduk')

@section('infografis_content')

{{-- Gaya Kustom --}}
<style>
    /* 1. Stat Card Styles (Sama seperti sebelumnya) */
    .stat-card {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.25rem;
        background-color: #fff;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.07);
        border-color: #d1e7dd;
    }
    .stat-card .icon-container {
        flex-shrink: 0;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .stat-card .icon-container svg, 
    .stat-card .icon-container i { width: 28px; height: 28px; font-size: 1.5rem; }
    
    .stat-card .info { min-width: 0; word-wrap: break-word; }
    .stat-card .info .label { font-size: 0.95rem; color: #6c757d; margin: 0; line-height: 1.4; text-transform: uppercase; letter-spacing: 0.5px; }
    .stat-card .info .value { font-size: 1.75rem; font-weight: 700; color: #212529; line-height: 1.2; }

    /* Warna Kartu Utama */
    .stat-card.total-penduduk .icon-container { background-color: #d1e7dd; color: #198754; }
    .stat-card.kepala-keluarga .icon-container { background-color: #fff3cd; color: #ffc107; }
    .stat-card.perempuan .icon-container { background-color: #f8d7da; color: #dc3545; }
    .stat-card.laki-laki .icon-container { background-color: #cff4fc; color: #0dcaf0; }

    /* 2. Detail Table Styles */
    .detail-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        overflow: hidden;
        height: 100%; /* Agar tinggi kartu sama rata */
    }
    .detail-header {
        padding: 1rem 1.5rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    /* Variasi Warna Header Tabel */
    .bg-header-umur { background-color: #cfe2ff; color: #084298; border-bottom: 2px solid #0d6efd; }
    .bg-header-pendidikan { background-color: #d1e7dd; color: #0f5132; border-bottom: 2px solid #198754; }
    .bg-header-pekerjaan { background-color: #fff3cd; color: #664d03; border-bottom: 2px solid #ffc107; }
    .bg-header-agama { background-color: #e0cffc; color: #3d0a91; border-bottom: 2px solid #6610f2; }
    .bg-header-perkawinan { background-color: #f8d7da; color: #842029; border-bottom: 2px solid #dc3545; }
    .bg-header-dusun { background-color: #e2e3e5; color: #41464b; border-bottom: 2px solid #6c757d; }
    .bg-header-default { background-color: #f8f9fa; color: #212529; border-bottom: 2px solid #dee2e6; }

    .table-detail th, .table-detail td {
        padding: 0.75rem 1.5rem;
        vertical-align: middle;
    }
    .table-detail tr:last-child td { border-bottom: 0; }
    .table-detail tbody tr:hover { background-color: #f8f9fa; }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .stat-card { padding: 1rem; }
        .stat-card .icon-container { width: 48px; height: 48px; }
        .stat-card .info .value { font-size: 1.4rem; }
        .section-title { font-size: 1.5rem; text-align: center; }
    }
</style>

    {{-- Header dengan Filter Tahun --}}
    <div class="row align-items-center mb-5 gy-3">
        <div class="col-md-8">
            <h2 class="section-title mb-0 text-center text-md-start">
                Data Demografi Tahun {{ $currentYear }}
            </h2>
        </div>
        
        <div class="col-md-4">
            <form action="{{ route('infografis.penduduk') }}" method="GET">
                <div class="input-group shadow-sm rounded-pill overflow-hidden border">
                    <span class="input-group-text bg-white border-0 ps-3 fw-bold text-secondary small text-uppercase">Tahun</span>
                    <select name="tahun" class="form-select border-0 bg-light fw-bold text-success text-center" style="cursor: pointer;" onchange="this.form.submit()">
                        @if(isset($years) && $years->count() > 0)
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ $currentYear == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        @else
                            <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                        @endif
                    </select>
                </div>
            </form>
        </div>
    </div>

    @if(isset($demografi) && $demografi)
        
        {{-- 1. Kartu Ringkasan Statistik Utama --}}
        <div class="row g-3 g-md-4 mb-5">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="stat-card total-penduduk">
                    <div class="icon-container"><i class="bi bi-people-fill"></i></div>
                    <div class="info">
                        <div class="label">Total Penduduk</div>
                        <div class="value">{{ number_format($demografi->total_penduduk) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="stat-card kepala-keluarga">
                    <div class="icon-container"><i class="bi bi-house-door-fill"></i></div>
                     <div class="info">
                        <div class="label">Kepala Keluarga</div>
                        <div class="value">{{ number_format($demografi->total_kepala_keluarga) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="stat-card laki-laki">
                    <div class="icon-container"><i class="bi bi-gender-male"></i></div>
                    <div class="info">
                        <div class="label">Laki-laki</div>
                        <div class="value">{{ number_format($demografi->total_laki_laki) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="stat-card perempuan">
                    <div class="icon-container"><i class="bi bi-gender-female"></i></div>
                    <div class="info">
                        <div class="label">Perempuan</div>
                        <div class="value">{{ number_format($demografi->total_perempuan) }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. Grafik Distribusi Gender --}}
        <div class="card border-0 shadow-sm rounded-4 mb-5 p-3 p-md-4">
            <h4 class="text-center mb-4 fw-bold text-secondary fs-5 fs-md-4">
                <i class="bi bi-pie-chart-fill text-success me-2"></i>Distribusi Gender {{ $currentYear }}
            </h4>
            <div style="position: relative; height: 350px; width: 100%; max-width: 600px; margin: 0 auto;">
                <canvas id="genderChart"></canvas>
            </div>
        </div>

        {{-- 3. Tabel Detail Data Demografi (Dikelompokkan Berdasarkan Tipe) --}}
        @if(isset($demografiDetail) && $demografiDetail->count() > 0)
            
            {{-- Menyiapkan Grouping Data --}}
            @php
                // Mapping untuk Label, Icon, dan Kelas Warna Header berdasarkan 'tipe' di database
                $typeConfig = [
                    'umur' => [
                        'label' => 'Kelompok Umur', 
                        'icon' => 'bi-bar-chart-steps', 
                        'class' => 'bg-header-umur'
                    ],
                    'pendidikan' => [
                        'label' => 'Tingkat Pendidikan', 
                        'icon' => 'bi-mortarboard-fill', 
                        'class' => 'bg-header-pendidikan'
                    ],
                    'pekerjaan' => [
                        'label' => 'Mata Pencaharian', 
                        'icon' => 'bi-briefcase-fill', 
                        'class' => 'bg-header-pekerjaan'
                    ],
                    'agama' => [
                        'label' => 'Agama / Kepercayaan', 
                        'icon' => 'bi-book-half', 
                        'class' => 'bg-header-agama'
                    ],
                    'perkawinan' => [
                        'label' => 'Status Perkawinan', 
                        'icon' => 'bi-heart-fill', 
                        'class' => 'bg-header-perkawinan'
                    ],
                    'dusun' => [
                        'label' => 'Sebaran Wilayah (Dusun)', 
                        'icon' => 'bi-geo-alt-fill', 
                        'class' => 'bg-header-dusun'
                    ]
                ];

                // Mengelompokkan data dari database berdasarkan kolom 'tipe'
                $groupedDetails = $demografiDetail->groupBy('tipe');
            @endphp

            <div class="row g-4 mb-5">
                {{-- Loop melalui konfigurasi agar urutannya rapi --}}
                @foreach($typeConfig as $key => $config)
                    @if(isset($groupedDetails[$key]))
                        <div class="col-lg-6">
                            <div class="card detail-card">
                                <div class="detail-header {{ $config['class'] }}">
                                    <i class="{{ $config['icon'] }} fs-5"></i> {{ $config['label'] }}
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-detail mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Kategori</th>
                                                <th class="text-end" style="width: 120px;">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($groupedDetails[$key] as $item)
                                                <tr>
                                                    <td>{{ $item->kategori }}</td>
                                                    <td class="text-end fw-bold">{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                {{-- Menangani tipe lain yang mungkin tidak ada di config (Fallback) --}}
                @foreach($groupedDetails as $key => $items)
                    @if(!array_key_exists($key, $typeConfig))
                        <div class="col-lg-6">
                            <div class="card detail-card">
                                <div class="detail-header bg-header-default">
                                    <i class="bi bi-list-check fs-5"></i> {{ ucwords(str_replace('_', ' ', $key)) }}
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-detail mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Kategori</th>
                                                <th class="text-end" style="width: 120px;">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($items as $item)
                                                <tr>
                                                    <td>{{ $item->kategori }}</td>
                                                    <td class="text-end fw-bold">{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

    @else
        {{-- Alert Data Kosong --}}
        <div class="alert alert-warning text-center mt-4 d-flex flex-column flex-md-row align-items-center justify-content-center gap-3 py-4 rounded-4 shadow-sm">
            <i class="bi bi-exclamation-triangle-fill fs-3 text-warning"></i>
            <div class="text-center text-md-start">
                <strong>Data Tidak Ditemukan!</strong><br>
                Belum ada data demografi untuk tahun <strong>{{ $currentYear }}</strong>. Silakan pilih tahun lain.
            </div>
        </div>
    @endif

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @if(isset($demografi) && $demografi)
    const ctx = document.getElementById('genderChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                label: 'Jumlah Penduduk',
                data: [{{ $demografi->total_laki_laki }}, {{ $demografi->total_perempuan }}],
                backgroundColor: ['#0dcaf0', '#dc3545'],
                hoverOffset: 15,
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        font: { family: "'Poppins', sans-serif", size: 14 }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    padding: 12,
                    cornerRadius: 8,
                    bodyFont: { size: 13, family: "'Poppins', sans-serif" },
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) { label += ': '; }
                            if (context.parsed !== null) {
                                label += context.parsed.toLocaleString('id-ID') + ' Jiwa';
                            }
                            return label;
                        }
                    }
                }
            },
            cutout: '60%',
            animation: { animateScale: true, animateRotate: true }
        }
    });
    @endif
</script>
@endpush