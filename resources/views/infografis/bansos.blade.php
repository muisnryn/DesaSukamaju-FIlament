@extends('layouts.infografis')

@section('title', 'Bantuan Sosial')

@section('infografis_content')

<style>
    /* Styling tambahan agar ikon lebih rapi */
    .icon-box-bansos {
        width: 60px; 
        height: 60px;
        transition: transform 0.3s ease;
    }
    .card-bansos:hover .icon-box-bansos {
        transform: scale(1.1);
    }
    .card-bansos {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-bansos:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
        border-color: #d1e7dd !important;
    }
</style>

{{-- HEADER & FILTER TAHUN (Layout Baru) --}}
<div class="row align-items-center mb-5 gy-3">
    <div class="col-md-8">
        <div class="d-flex align-items-center">
            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 50px; height: 50px;">
                <i class="bi bi-gift-fill fs-4"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-0 text-dark">Rekapitulasi Bantuan Sosial</h3>
                <p class="text-muted mb-0">Data Penyaluran Tahun {{ $currentYear ?? date('Y') }}</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <form action="{{ route('infografis.bansos') }}" method="GET">
            <div class="input-group shadow-sm rounded-pill overflow-hidden border">
                <span class="input-group-text bg-white border-0 ps-3 fw-bold text-secondary small text-uppercase">Tahun</span>
                <select name="tahun" class="form-select border-0 bg-light fw-bold text-success text-center" style="cursor: pointer;" onchange="this.form.submit()">
                    {{-- Cek apakah variabel $years ada (dikirim dari controller) --}}
                    @if(isset($years) && count($years) > 0)
                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ (isset($currentYear) && $currentYear == $year) ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    @else
                        <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                    @endif
                </select>
            </div>
            
            {{-- Jaga input pencarian NIK tetap ada saat ganti tahun --}}
            @if(request('nik'))
                <input type="hidden" name="nik" value="{{ request('nik') }}">
            @endif
        </form>
    </div>
</div>

{{-- 1. Kartu Statistik Jenis Bansos --}}
@if($bansos->count() > 0)
    <div class="row g-4 mb-5">
        @foreach($bansos as $b)
        <div class="col-md-6 col-lg-4">
            <div class="card card-bansos h-100 border-1 border-light shadow-sm rounded-4 p-3 d-flex flex-row align-items-center gap-3">
                {{-- Ikon Hijau --}}
                <div class="icon-box-bansos bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center flex-shrink-0">
                    <i class="bi bi-box2-heart-fill fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted text-uppercase mb-1 small fw-bold">{{ $b->jenis_bansos }}</h6>
                    <h3 class="mb-0 fw-bold text-dark">{{ number_format($b->jumlah_penerima, 0, ',', '.') }} <span class="fs-6 text-muted fw-normal">KPM</span></h3>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="alert alert-warning mb-5 d-flex align-items-center rounded-4 shadow-sm">
        <i class="bi bi-info-circle-fill me-2 fs-4"></i>
        <div>
            Belum ada data rekapitulasi bantuan sosial untuk tahun <strong>{{ $currentYear ?? date('Y') }}</strong>.
        </div>
    </div>
@endif

{{-- 2. Form Cek Penerima --}}
<div class="card border-0 shadow rounded-4 overflow-hidden mb-5">
    {{-- Header Card Hijau --}}
    <div class="card-header bg-success text-white p-4">
        <h4 class="mb-0 fw-bold"><i class="bi bi-search me-2"></i> Cek Penerima Bantuan</h4>
        <p class="mb-0 text-white-50">Masukkan NIK untuk memeriksa status penerima secara mandiri.</p>
    </div>
    
    <div class="card-body p-4 p-lg-5 bg-white">
        <form action="{{ route('infografis.bansos') }}" method="GET" class="row g-3 justify-content-center">
            {{-- Kirim input tahun agar tidak reset ke default saat mencari --}}
            @if(isset($currentYear))
                <input type="hidden" name="tahun" value="{{ $currentYear }}">
            @endif

            <div class="col-md-8">
                <input type="text" name="nik" class="form-control form-control-lg rounded-pill px-4 border-success-subtle" placeholder="Masukkan Nomor Induk Kependudukan (NIK)" value="{{ request('nik') }}" required onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            </div>
            <div class="col-md-3">
                {{-- Tombol Hijau --}}
                <button type="submit" class="btn btn-success btn-lg w-100 rounded-pill fw-bold shadow-sm">
                    <i class="bi bi-search me-1"></i> Cek Data
                </button>
            </div>
        </form>

        {{-- Hasil Pencarian --}}
        @if(request()->filled('nik'))
            <div class="mt-5">
                @if($hasilCariBansos)
                    <div class="alert alert-success d-flex align-items-start gap-3 rounded-4 p-4 shadow-sm border-0 bg-success-subtle text-success-emphasis">
                        <i class="bi bi-check-circle-fill fs-1 mt-1 text-success"></i>
                        <div>
                            <h4 class="fw-bold mb-2">Data Ditemukan!</h4>
                            <p class="mb-0 fs-5">
                                Atas nama <strong>{{ $hasilCariBansos->nama }}</strong><br>
                                <span class="badge bg-success mt-2">Terdaftar sebagai Penerima Manfaat</span>
                            </p>
                            <hr class="border-success opacity-25">
                            <small class="fw-bold"><i class="bi bi-geo-alt-fill"></i> {{ $hasilCariBansos->alamat }}</small>
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger d-flex align-items-center gap-3 rounded-4 p-4 shadow-sm border-0">
                        <i class="bi bi-x-circle-fill fs-1 text-danger"></i>
                        <div>
                            <h5 class="fw-bold mb-1 text-danger">Data Tidak Ditemukan</h5>
                            <p class="mb-0 text-muted">NIK <strong>{{ request('nik') }}</strong> tidak terdaftar dalam basis data penerima bantuan saat ini.</p>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>

@endsection