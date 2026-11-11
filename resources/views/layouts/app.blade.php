<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $seoTitle = trim($__env->yieldContent('title', 'Website Resmi Desa Sukamaju'));
        $seoDescription = trim($__env->yieldContent('meta_description', 'Website resmi Pemerintah Desa Sukamaju, Kecamatan Cibeber, Kabupaten Cianjur, Jawa Barat.'));
        $seoCanonical = trim($__env->yieldContent('canonical_url', url()->current()));
        $seoImage = trim($__env->yieldContent('meta_image', asset('images/logo-desa.png')));
        $seoRobots = trim($__env->yieldContent('meta_robots', 'index,follow'));
        $seoType = trim($__env->yieldContent('og_type', 'website'));
        $siteUrl = rtrim(config('app.url'), '/');
        $organizationSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'GovernmentOrganization',
            'name' => 'Pemerintah Desa Sukamaju',
            'url' => $siteUrl,
            'logo' => $siteUrl . '/images/logo-desa.png',
            'email' => 'desasukamajucibeber@gmail.com',
            'telephone' => '+6281460919142',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Cibeber',
                'addressRegion' => 'Jawa Barat',
                'addressCountry' => 'ID',
            ],
        ];
    @endphp
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="robots" content="{{ $seoRobots }}">
    <link rel="canonical" href="{{ $seoCanonical }}">
    <meta name="theme-color" content="#198754">

    <meta property="og:locale" content="id_ID">
    <meta property="og:type" content="{{ $seoType }}">
    <meta property="og:site_name" content="Pemerintah Desa Sukamaju">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url" content="{{ $seoCanonical }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:image:alt" content="Website resmi Pemerintah Desa Sukamaju">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-desa.png') }}">

    <script type="application/ld+json">@json($organizationSchema)</script>
    @stack('structured-data')

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('css/motion.css') }}">
    @stack('styles')

    <!-- Google Fonts (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            /* Add padding top to body to prevent content from being hidden by the fixed navbar */
            padding-top: 70px;
        }

        :root {
            --primary-color: #008000; /* Warna hijau utama */
            --secondary-color: #0f5132; /* Warna hijau tua */
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        .navbar-brand img {
            max-height: 40px;
        }

        .nav-link {
            font-weight: 500;
            color: #333;
        }

        .nav-link.active, .nav-link:hover {
            color: var(--primary-color);
        }

        .footer {
            background-color: #212529;
            color: #f8f9fa;
        }
        .footer a {
            color: #adb5bd;
            text-decoration: none;
        }
        .footer a:hover {
            color: #fff;
        }

        @media (max-width: 575.98px) {
            .row.g-5 {
                --bs-gutter-x: 1.5rem;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    @include('partials._navbar')

    <!-- === MAIN CONTENT === -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('partials._footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @stack('scripts')
    <script src="{{ asset('js/motion.js') }}" defer></script>
</body>
</html>
