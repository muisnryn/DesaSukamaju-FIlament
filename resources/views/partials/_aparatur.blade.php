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
                @php
                    $daftarJobdesk = filled($orang->jobdesk)
                        ? array_values(array_filter(
                            array_map(
                                fn ($baris) => trim(preg_replace('/^[-•*]\s*/', '', trim($baris))),
                                preg_split('/\r\n|\r|\n/', $orang->jobdesk)
                            ),
                            fn ($baris) => $baris !== ''
                        ))
                        : [];
                @endphp

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card card-struktur border-0 shadow-sm text-center bg-white">
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

                            <div class="mt-3">
                                @if(count($daftarJobdesk) > 0)
                                    <button
                                        type="button"
                                        class="btn btn-outline-success btn-sm rounded-pill px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#jobdeskModal{{ $orang->id }}"
                                    >
                                        <i class="bi bi-list-task me-1"></i>
                                        Lihat {{ count($daftarJobdesk) }} tugas pokok
                                    </button>
                                @else
                                    <span class="small text-muted">Jobdesk belum tersedia</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if(count($daftarJobdesk) > 0)
                        <div
                            class="modal fade"
                            id="jobdeskModal{{ $orang->id }}"
                            tabindex="-1"
                            aria-labelledby="jobdeskModalLabel{{ $orang->id }}"
                            aria-hidden="true"
                        >
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content border-0 rounded-4 shadow">
                                    <div class="modal-header border-0 pb-0">
                                        <div>
                                            <span class="small text-success text-uppercase fw-semibold">Tugas Pokok</span>
                                            <h5 class="modal-title fw-bold text-dark mt-1" id="jobdeskModalLabel{{ $orang->id }}">
                                                {{ $orang->nama }}
                                            </h5>
                                            <p class="text-muted small mb-0">{{ $orang->jabatan }}</p>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body pt-3">
                                        <ul class="list-unstyled mb-0 jobdesk-list">
                                            @foreach($daftarJobdesk as $tugas)
                                                <li class="d-flex align-items-start gap-2">
                                                    <i class="bi bi-check2-circle text-success flex-shrink-0"></i>
                                                    <span>{{ $tugas }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer border-0 pt-0">
                                        <button type="button" class="btn btn-success rounded-pill px-4" data-bs-dismiss="modal">
                                            Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
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
        padding-bottom: 24px;
    }

    .card-struktur h5 {
        overflow-wrap: anywhere;
    }

    .jobdesk-list li {
        font-size: 0.95rem;
        color: #555;
        line-height: 1.6;
        margin-bottom: 0.8rem;
        overflow-wrap: anywhere;
    }
    .jobdesk-list li:last-child {
        margin-bottom: 0;
    }
    .jobdesk-list li i {
        margin-top: 4px;
    }
</style>
