<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website Desa') - Desa Sukamaju</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-desa.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

