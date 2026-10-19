<div class="row g-3">
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-between p-3 rounded-4 bg-primary-subtle text-primary border border-primary-subtle">
            <div>
                <span class="small fw-bold text-uppercase ls-1">Total Penduduk</span>
                <h2 class="mb-0 fw-bold display-6">
                    {{ number_format($demografi->total_penduduk ?? 0, 0, ',', '.') }} 
                    <span class="fs-6 fw-normal text-secondary">Jiwa</span>
                </h2>
            </div>
            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px;">
                <i class="bi bi-people-fill fs-2 text-primary"></i>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="p-3 rounded-4 bg-white border shadow-sm h-100 position-relative overflow-hidden">
            <div class="d-flex align-items-center mb-2">
                <i class="bi bi-gender-male text-info fs-5 me-2 bg-info-subtle p-1 rounded"></i>
                <small class="text-muted fw-medium">Laki-laki</small>
            </div>
            <h4 class="fw-bold mb-0 text-dark">
                {{ number_format($demografi->total_laki_laki ?? 0, 0, ',', '.') }}
            </h4>
        </div>
    </div>

    <div class="col-6">
        <div class="p-3 rounded-4 bg-white border shadow-sm h-100 position-relative overflow-hidden">
            <div class="d-flex align-items-center mb-2">
                <i class="bi bi-gender-female text-danger fs-5 me-2 bg-danger-subtle p-1 rounded"></i>
                <small class="text-muted fw-medium">Perempuan</small>
            </div>
            <h4 class="fw-bold mb-0 text-dark">
                {{ number_format($demografi->total_perempuan ?? 0, 0, ',', '.') }}
            </h4>
        </div>
    </div>

    <div class="col-12">
        <div class="text-center p-3 rounded-3 bg-light border d-flex justify-content-between align-items-center px-4">
            <span class="text-muted small text-uppercase fw-bold">Kepala Keluarga</span>
            <h5 class="fw-bold mb-0 text-dark">
                {{ number_format($demografi->total_kepala_keluarga ?? 0, 0, ',', '.') }}
            </h5>
        </div>
    </div>
</div>