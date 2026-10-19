@extends('layouts.infografis')

@section('title', 'APBDes')

@section('infografis_content')

{{-- Gaya Kustom --}}
<style>
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
    .stat-card .icon-container svg { width: 28px; height: 28px; }
    
    .stat-card .info {
        min-width: 0;
        word-wrap: break-word;
    }
    .stat-card .info .label { font-size: 0.95rem; color: #6c757d; margin: 0; line-height: 1.4; }
    
    /* Font size default (Desktop) */
    .stat-card .info .value { font-size: 1.75rem; font-weight: 700; color: #212529; line-height: 1.2; }

    /* Warna Kartu */
    .stat-card.pendapatan .icon-container { background-color: #e4f8f0; }
    .stat-card.pendapatan .icon-container svg { color: #20c997; }
    .stat-card.belanja .icon-container { background-color: #fdeeee; }
    .stat-card.belanja .icon-container svg { color: #dc3545; }
    .stat-card.pembiayaan .icon-container { background-color: #e6f4f1; }
    .stat-card.pembiayaan .icon-container svg { color: #17a2b8; }

    /* Tabel Detail Styles */
    .detail-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        overflow: hidden;
    }
    .detail-header {
        padding: 1rem 1.5rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.9rem;
    }
    .bg-header-pendapatan { background-color: #e4f8f0; color: #0f5132; border-bottom: 2px solid #20c997; }
    .bg-header-belanja { background-color: #fdeeee; color: #842029; border-bottom: 2px solid #dc3545; }
    .bg-header-pembiayaan { background-color: #e6f4f1; color: #055160; border-bottom: 2px solid #17a2b8; }

    .table-detail th, .table-detail td {
        padding: 0.75rem 1.5rem;
        vertical-align: middle;
    }
    .table-detail tr:last-child td { border-bottom: 0; }

    /* RESPONSIVE MEDIA QUERIES */
    @media (max-width: 768px) {
        .stat-card { padding: 1rem; }
        .stat-card .icon-container { width: 48px; height: 48px; }
        .stat-card .icon-container svg { width: 24px; height: 24px; }
        .stat-card .info .value { font-size: 1.4rem; }
        .section-title { font-size: 1.5rem; text-align: center; }
    }
</style>

    {{-- Header dengan Filter Tahun --}}
    <div class="row align-items-center mb-5 gy-3">
        <div class="col-md-8">
            <h2 class="section-title mb-0 text-center text-md-start">
                APB Desa Tahun {{ $currentYear }}
            </h2>
        </div>
        
        <div class="col-md-4">
            <form action="{{ route('infografis.apbdes') }}" method="GET">
                <div class="input-group shadow-sm rounded-pill overflow-hidden border">
                    <span class="input-group-text bg-white border-0 ps-3 fw-bold text-secondary small text-uppercase">Tahun</span>
                    <select name="tahun" class="form-select border-0 bg-light fw-bold text-success text-center" style="cursor: pointer;" onchange="this.form.submit()">
                        @forelse($years as $year)
                            <option value="{{ $year }}" {{ $currentYear == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @empty
                            <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                        @endforelse
                    </select>
                </div>
            </form>
        </div>
    </div>

    @if(isset($apbdes) && $apbdes)
        {{-- 1. Kartu Ringkasan Statistik --}}
        <div class="row g-3 g-md-4 mb-5">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="stat-card pendapatan">
                    <div class="icon-container">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
                    </div>
                    <div class="info">
                        <div class="label">Total Pendapatan</div>
                        <div class="value">Rp {{ number_format($apbdes->total_pendapatan, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="stat-card belanja">
                    <div class="icon-container">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 6.43l.776 2.898m0 0-3.182-5.511m3.182 5.51-5.511-3.182" /></svg>
                    </div>
                    <div class="info">
                        <div class="label">Total Belanja</div>
                        <div class="value">Rp {{ number_format($apbdes->total_belanja, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="stat-card pembiayaan">
                    <div class="icon-container">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    </div>
                    <div class="info">
                        <div class="label">Total Pembiayaan</div>
                        <div class="value">Rp {{ number_format($apbdes->total_pembiayaan, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. Grafik Realisasi --}}
        <div class="card border-0 shadow-sm rounded-4 mb-5 p-3 p-md-4">
            <h4 class="text-center mb-4 fw-bold text-secondary fs-5 fs-md-4">Grafik Realisasi Anggaran {{ $currentYear }}</h4>
            <div style="position: relative; height: 300px; width: 100%;">
                <canvas id="apbdesChart"></canvas>
            </div>
        </div>

        {{-- 3. Rincian Detail Anggaran (TABEL) --}}
        @php
            // Memfilter data berdasarkan tipe dari Collection yang dikirim Controller
            $detPendapatan = $apbdesDetail->whereIn('tipe', ['pendapatan', 'Pendapatan']);
            $detBelanja = $apbdesDetail->whereIn('tipe', ['belanja', 'Belanja']);
            $detPembiayaan = $apbdesDetail->whereIn('tipe', ['pembiayaan', 'Pembiayaan']);
        @endphp

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card detail-card h-100">
                    <div class="detail-header bg-header-pendapatan">
                        <i class="bi bi-graph-up-arrow me-2"></i> Rincian Pendapatan
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-detail mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Uraian</th>
                                    <th class="text-end">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($detPendapatan as $item)
                                    <tr>
                                        <td>{{ $item->kategori }}</td>
                                        <td class="text-end fw-bold">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted fst-italic py-3">Belum ada rincian data.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card detail-card h-100">
                    <div class="detail-header bg-header-belanja">
                        <i class="bi bi-cart-check me-2"></i> Rincian Belanja
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-detail mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Uraian</th>
                                    <th class="text-end">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($detBelanja as $item)
                                    <tr>
                                        <td>{{ $item->kategori }}</td>
                                        <td class="text-end fw-bold">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted fst-italic py-3">Belum ada rincian data.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card detail-card">
                    <div class="detail-header bg-header-pembiayaan">
                        <i class="bi bi-arrow-left-right me-2"></i> Rincian Pembiayaan
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-detail mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Uraian</th>
                                    <th class="text-end">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($detPembiayaan as $item)
                                    <tr>
                                        <td>{{ $item->kategori }}</td>
                                        <td class="text-end fw-bold">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted fst-italic py-3">Belum ada rincian data.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    @else
        <div class="alert alert-warning text-center mt-4 d-flex flex-column flex-md-row align-items-center justify-content-center gap-3 py-4">
            <i class="bi bi-exclamation-triangle-fill fs-3 text-warning"></i>
            <div class="text-center text-md-start">
                <strong>Data Tidak Ditemukan!</strong><br>
                Belum ada data APBDes untuk tahun <strong>{{ $currentYear }}</strong>. Silakan pilih tahun lain.
            </div>
        </div>
    @endif

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @if(isset($apbdes) && $apbdes)
    const ctxApbdes = document.getElementById('apbdesChart').getContext('2d');
    
    // Gradient Warna
    let gradientPendapatan = ctxApbdes.createLinearGradient(0, 0, 0, 400);
    gradientPendapatan.addColorStop(0, 'rgba(32, 201, 151, 0.8)');
    gradientPendapatan.addColorStop(1, 'rgba(32, 201, 151, 0.2)');

    let gradientBelanja = ctxApbdes.createLinearGradient(0, 0, 0, 400);
    gradientBelanja.addColorStop(0, 'rgba(220, 53, 69, 0.8)');
    gradientBelanja.addColorStop(1, 'rgba(220, 53, 69, 0.2)');

    new Chart(ctxApbdes, {
        type: 'bar',
        data: {
            labels: ['Ringkasan Anggaran'],
            datasets: [{
                label: 'Pendapatan',
                data: [{{ $apbdes->total_pendapatan }}],
                backgroundColor: gradientPendapatan,
                borderColor: '#20c997',
                borderWidth: 2,
                borderRadius: 8,
                barPercentage: 0.6,
                categoryPercentage: 0.8
            }, {
                label: 'Belanja',
                data: [{{ $apbdes->total_belanja }}],
                backgroundColor: gradientBelanja,
                borderColor: '#dc3545',
                borderWidth: 2,
                borderRadius: 8,
                barPercentage: 0.6,
                categoryPercentage: 0.8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: { 
                        font: { size: window.innerWidth < 768 ? 12 : 14, family: "'Poppins', sans-serif" },
                        boxWidth: 15
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    padding: 10,
                    titleFont: { size: 13, family: "'Poppins', sans-serif" },
                    bodyFont: { size: 13, family: "'Poppins', sans-serif" },
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) { label += ': '; }
                            if (context.parsed.y !== null) {
                                label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { borderDash: [5, 5], color: '#f0f0f0' },
                    ticks: {
                        font: { size: window.innerWidth < 768 ? 10 : 12, family: "'Poppins', sans-serif" },
                        callback: function(value) {
                            if (value >= 1000000000) {
                                return 'Rp ' + (value / 1000000000).toFixed(1) + ' M';
                            } else if (value >= 1000000) {
                                return 'Rp ' + (value / 1000000).toFixed(0) + ' Jt';
                            }
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 12, family: "'Poppins', sans-serif" } }
                }
            }
        }
    });
    @endif
</script>
@endpush