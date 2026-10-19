@extends('layouts.infografis')

@section('title', 'Indeks Desa Membangun (IDM)')

@section('infografis_content')

{{-- Gaya Kustom --}}
<style>
    /* Card Status Utama */
    .status-card {
        background: linear-gradient(135deg, #198754 0%, #20c997 100%);
        color: white;
        border: none;
        border-radius: 16px;
        position: relative;
        overflow: hidden;
    }
    .status-card::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    /* Card Detail Indeks */
    .index-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    .index-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }
    .index-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
    }
    .index-card.iks::before { background-color: #0d6efd; } /* Biru */
    .index-card.ike::before { background-color: #198754; } /* Hijau */
    .index-card.ikl::before { background-color: #ffc107; } /* Kuning */

    .index-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 1rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .bg-icon-iks { background-color: #e7f1ff; color: #0d6efd; }
    .bg-icon-ike { background-color: #d1e7dd; color: #198754; }
    .bg-icon-ikl { background-color: #fff3cd; color: #ffc107; }

    .index-value {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #333;
    }
    .index-label {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>

{{-- Filter Tahun --}}
<div class="row align-items-center mb-5 gy-3">
    <div class="col-md-8">
        <h2 class="section-title mb-0 text-center text-md-start">Status IDM Tahun {{ $currentYear }}</h2>
    </div>
    <div class="col-md-4">
        <form action="{{ route('infografis.idm') }}" method="GET">
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

@if(isset($idm) && $idm)
    {{-- Status Utama --}}
    <div class="card status-card shadow-lg mb-5 p-4 p-md-5 text-center">
        <h6 class="text-white-50 text-uppercase ls-2 mb-2 fw-bold">Status Desa Membangun</h6>
        <h1 class="display-3 fw-bold mb-3">{{ $idm->status_idm }}</h1>
        <div>
            <span class="badge bg-white text-success fs-5 px-4 py-2 rounded-pill shadow-sm">
                Skor Total: {{ $idm->skor_idm }}
            </span>
        </div>
    </div>

    {{-- Detail Indeks --}}
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="index-card iks">
                <div class="index-icon bg-icon-iks">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="index-value">{{ $idm->skor_iks }}</div>
                <div class="index-label">Indeks Ketahanan Sosial</div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="index-card ike">
                <div class="index-icon bg-icon-ike">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
                <div class="index-value">{{ $idm->skor_ike }}</div>
                <div class="index-label">Indeks Ketahanan Ekonomi</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="index-card ikl">
                <div class="index-icon bg-icon-ikl">
                    <i class="bi bi-tree-fill"></i>
                </div>
                <div class="index-value">{{ $idm->skor_ikl }}</div>
                <div class="index-label">Indeks Ketahanan Lingkungan</div>
            </div>
        </div>
    </div>

    {{-- Grafik Radar --}}
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="text-center mb-4 fw-bold text-secondary">Grafik Komposit IDM</h5>
                <div style="height: 450px; position: relative;">
                    <canvas id="idmChart"></canvas>
                </div>
            </div>
        </div>
    </div>

@else
    <div class="alert alert-warning text-center mt-4 d-flex flex-column flex-md-row align-items-center justify-content-center gap-3 py-4">
        <i class="bi bi-exclamation-triangle-fill fs-3 text-warning"></i>
        <div class="text-center text-md-start">
            <strong>Data Tidak Ditemukan!</strong><br>
            Belum ada data IDM yang diinput untuk tahun <strong>{{ $currentYear }}</strong>.
        </div>
    </div>
@endif

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @if(isset($idm) && $idm)
    const ctxIdm = document.getElementById('idmChart').getContext('2d');
    new Chart(ctxIdm, {
        type: 'radar',
        data: {
            labels: ['Ketahanan Sosial (IKS)', 'Ketahanan Ekonomi (IKE)', 'Ketahanan Lingkungan (IKL)'],
            datasets: [{
                label: 'Skor Indeks',
                data: [{{ $idm->skor_iks }}, {{ $idm->skor_ike }}, {{ $idm->skor_ikl }}],
                fill: true,
                backgroundColor: 'rgba(25, 135, 84, 0.2)', // Hijau Transparan
                borderColor: 'rgb(25, 135, 84)', // Hijau Solid
                pointBackgroundColor: 'rgb(25, 135, 84)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgb(25, 135, 84)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                r: {
                    angleLines: { display: true, color: '#eee' },
                    grid: { color: '#eee' },
                    suggestedMin: 0,
                    suggestedMax: 1, // Karena skor maksimal biasanya 1.0
                    ticks: {
                        stepSize: 0.2,
                        backdropColor: 'transparent'
                    },
                    pointLabels: {
                        font: { size: 14, family: "'Poppins', sans-serif" }
                    }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    padding: 10,
                    titleFont: { size: 13, family: "'Poppins', sans-serif" },
                    bodyFont: { size: 13, family: "'Poppins', sans-serif" }
                }
            }
        }
    });
    @endif
</script>
@endpush