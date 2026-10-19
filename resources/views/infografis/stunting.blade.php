@extends('layouts.infografis')

@section('title', 'Data Stunting')

@section('infografis_content')

{{-- Header Filter Tahun --}}
<div class="row align-items-center mb-5 gy-3">
    <div class="col-md-8">
        <h2 class="section-title mb-0 text-center text-md-start">
            Data Stunting Tahun {{ $currentYear }}
        </h2>
    </div>
    <div class="col-md-4">
        <form action="{{ route('infografis.stunting') }}" method="GET">
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

@if(isset($stunting) && $stunting)
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-white h-100">
                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center bg-danger-subtle text-danger rounded-circle" style="width: 80px; height: 80px;">
                        <i class="bi bi-activity" style="font-size: 2.5rem;"></i>
                    </div>
                </div>
                <h5 class="text-muted text-uppercase ls-1 mb-2">Jumlah Kasus Stunting</h5>
                <h1 class="display-3 fw-bold text-danger mb-0">{{ number_format($stunting->jumlah_kasus, 0, ',', '.') }}</h1>
                <span class="text-muted">Anak Terindikasi</span>
            </div>
        </div>
    </div>
    
    <div class="alert alert-info mt-4 d-flex align-items-start gap-3 rounded-4 border-0 bg-info-subtle text-info-emphasis">
        <i class="bi bi-info-circle-fill fs-5 mt-1"></i>
        <div>
            <strong>Informasi Data:</strong> Saat ini sistem hanya menampilkan total kasus. Untuk menampilkan grafik persentase (Prevalensi), mohon lengkapi database dengan data "Total Sasaran Balita".
        </div>
    </div>
@else
    <div class="alert alert-warning text-center py-5 rounded-4">
        <i class="bi bi-exclamation-triangle fs-1 d-block mb-3"></i>
        Data Stunting untuk tahun <strong>{{ $currentYear }}</strong> belum tersedia.
    </div>
@endif

@endsection