<section id="sejarah" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-uppercase" style="color: var(--secondary-color);">
                <i class="bi bi-clock-history me-2"></i>Sejarah Desa
            </h2>
            <div class="mx-auto" style="width: 80px; height: 4px; background: var(--primary-color); border-radius: 2px;"></div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    <div class="rich-content" style="line-height: 1.9; text-align: justify; color: #444;">
                        {!! $profil->sejarah !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="visi-misi" class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="p-4 text-white" style="background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));">
                        <h3 class="mb-0 fw-bold"><i class="bi bi-eye me-2"></i>Visi</h3>
                    </div>
                    <div class="card-body p-4 d-flex align-items-center">
                        <blockquote class="blockquote mb-0">
                            <p class="fst-italic fs-5 text-muted">"{!! strip_tags($profil->visi) !!}"</p>
                        </blockquote>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="p-4 bg-white border-bottom">
                        <h3 class="mb-0 fw-bold" style="color: var(--secondary-color);">
                            <i class="bi bi-list-check me-2 text-success"></i>Misi Desa
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="misi-content">
                            {!! $profil->misi !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>