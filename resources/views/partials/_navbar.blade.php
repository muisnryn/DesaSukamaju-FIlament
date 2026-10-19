<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        {{-- Brand / Logo --}}
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('images/logo-desa.png') }}" alt="Logo" height="40" class="me-2">
            <div class="d-flex flex-column">
                {{-- Ubah warna teks jadi Hijau --}}
                <strong class="text-success lh-1">Desa Sukamaju</strong>
                <small class="text-muted" style="font-size: 0.75rem;">Cibeber, Kabupaten Cianjur</small>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('profil') ? 'active' : '' }}" href="{{ route('profil') }}">Profil Desa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('infografis.*') ? 'active' : '' }}" href="{{ route('infografis.index') }}">Infografis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('berita.*') ? 'active' : '' }}" href="{{ route('berita.index') }}">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('belanja.*') ? 'active' : '' }}" href="{{ route('belanja.umkm') }}">Belanja</a>
                </li>
            </ul>

            <div class="ms-lg-3 mt-3 mt-lg-0">
                {{-- UBAH DI SINI: Dari btn-outline-primary (Biru) ke btn-success (Hijau) --}}
                <a href="/admin" class="btn btn-success px-4 rounded-pill shadow-sm fw-bold text-white">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Login Admin
                </a>
            </div>
        </div>
    </div>
</nav>