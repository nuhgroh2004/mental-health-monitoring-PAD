<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Favicons -->
    <link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/mhs-home.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/mhs-report.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/mhs-viewMoodCalender.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/mhs-notifikasi.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa/mhs-profil.css') }}">
    @vite('resources/css/app.css')
</head>

<body class="index-page">
<!---------------------------------------------Narbar ------------------------------------------------------------------------>
    <header id="header" class="header d-flex align-items-center fixed-top bg-white shadow-sm">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index.html" class="logo d-flex align-items-center me-auto">
            <img src="{{ asset('asset/logo.png') }}" alt="">
            <h1 class="sitename">GamaPulse</h1>
        </a>
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('mahasiswa.home') }}" class="{{ request()->routeIs('mahasiswa.home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('mahasiswa.calendar', ['month' => now()->month, 'year' => now()->year]) }}"
                        class="{{ request()->routeIs('mahasiswa.calendar') ? 'active' : '' }}">
                        Kalender Mood
                     </a></li>
                    <li><a href="{{ route('mahasiswa.report', ['month' => now()->month, 'year' => now()->year]) }}"
                        class="{{ request()->routeIs('mahasiswa.report') ? 'active' : '' }}">
                        Laporan</a></li>
                    <li><a href="{{ route('mahasiswa.notifikasi') }}" class="{{ request()->routeIs('mahasiswa.notifikasi') ? 'active' : '' }}">Notifikasi</a></li>
                    <li><a href="{{ route('mahasiswa.profil') }}" class="{{ request()->routeIs('mahasiswa.profil') ? 'active' : '' }}">Profil</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>
<!---------------------------------------------------------------- Narbar ------------------------------------------------------------------------>

    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/mahasiswa/mhs-report.js') }}"></script>
    <script src="{{ asset('assets/js/mahasiswa/mhs-viewMoodCalender.js') }}"></script>
    <script src="{{ asset('assets/js/mahasiswa/mhs-notifikasi.js') }}"></script>
    <script src="{{ asset('assets/js/mahasiswa/mhs-profil.js') }}"></script>
</body>
@yield('content')
