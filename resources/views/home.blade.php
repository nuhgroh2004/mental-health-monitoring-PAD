<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>GamaPulse</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Favicons -->
    <link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="index-page">
<!----------------------------------------------------------------- Narbar ------------------------------------------------------------------------>
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">
        <!-- Logo and Site Name -->
            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <img src="{{ asset('asset/logo.png') }}" alt="">
                <h1 class="sitename">GamaPulse</h1>
            </a>

            <!-- Navigation Menu -->
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Beranda</a></li>
                    <li><a href="#about">Tentang</a></li>
                    <li><a href="#services">Fitur</a></li>
                    <li><a href="#detail">Detail</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        <!-- Register Button with Dropdown -->
            <a class="btn-getstarted dropdown-toggle transition-transform duration-300 ease-in-out transform hover:scale-110"
                type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Register
            </a>
            <ul class="dropdown-menu rounded-lg p-2" aria-labelledby="dropdownMenuButton">
                <li>
                    <a class="dropdown-item text-[#388da8] hover:bg-gray-200 hover:text-[#388da8] rounded"
                        href="{{ route('mahasiswa.register') }}"
                        style="transition: background-color 0.3s, color 0.3s;">
                        Mahasiswa
                    </a>
                </li>
                <li>
                    <a class="dropdown-item text-[#388da8] hover:bg-gray-200 hover:text-[#388da8] rounded"
                        href="{{ route('dosen.register') }}"
                        style="transition: background-color 0.3s, color 0.3s;">
                        Dosen
                    </a>
                </li>
            </ul>
        </div>
    </header>
<!----------------------------------------------------------------  Narbar ------------------------------------------------------------------------>

    <main class="main">

<!---------------------------------------------------------------- Section 1 Welcome ------------------------------------------------------------------------>
    <section id="hero" class="hero section">
        <div class="hero-bg">
            <img src="assets/img/hero-bg-light.webp" alt="">
        </div>
        <div class="container text-center">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h1 data-aos="fade-up">Welcome to <span>GamaPulse</span></h1>
                <p data-aos="fade-up" data-aos-delay="100">Peduli Kesehatan Mental, Menjadi Lebih Baik Setiap Hari dengan Gamapulse!<br></p>
                <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('login') }}" class="btn-get-started transition-transform duration-300 ease-in-out transform hover:scale-110">Login</a>
                </div>
                <img src="assets/img/hero-services-img.webp" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300">
            </div>
        </div>
    </section><!-- /Hero Section -->
<!---------------------------------------------------------------- Section 1 Welcome ------------------------------------------------------------------------>

<!---------------------------------------------------------------- Section 2 About ------------------------------------------------------------------------>
<section id="about" class="about section">
  <div class="container">
      <div class="row gy-4">
          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
              <p class="who-we-are">Apa itu GamaPulse?</p>
              <h3>Memahami Mood Setiap Hari dengan GamaPulse</h3>
              <p class="fst-italic">
                  GamaPulse adalah platform yang dirancang untuk membantu mahasiswa memantau dan mengelola kesehatan mental mereka dengan cara yang mudah dan menyenangkan. Dengan laporan mendalam setiap minggu dan bulan, kami membantu Anda mengenali pola suasana hati untuk menciptakan keseimbangan dalam kehidupan akademis Anda.
              </p>
              <ul>
                  <li><i class="bi bi-check-circle"></i> <span>Pelacakan mood harian yang mudah diakses di setiap saat, kapan pun Anda butuh.</span></li>
                  <li><i class="bi bi-check-circle"></i> <span>Laporan mingguan dan bulanan untuk membantu Anda mengenali perubahan suasana hati.</span></li>
                  <li><i class="bi bi-check-circle"></i> <span>Pengaturan target harian yang memotivasi Anda untuk terus maju dan tetap produktif.</span></li>
              </ul>
              <a href="#" class="read-more"><span>Mulai Sekarang dan Rasakan Perbedaannya!</span><i class="bi bi-arrow-right"></i></a>
          </div>
          <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">
                  <div class="col-lg-6">
                      <img src="assets/img/home/home1.png" class="img-fluid" alt="Track Mood">
                  </div>
                  <div class="col-lg-6">
                      <div class="row gy-4">
                          <div class="col-lg-12">
                              <img src="assets/img/home/home2.jpg" class="img-fluid" alt="Mental Health Support">
                          </div>
                          <div class="col-lg-12">
                              <img src="assets/img/home/home3.jpg" class="img-fluid" alt="Academic Journey">
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

<!---------------------------------------------------------------- Section 2 About ------------------------------------------------------------------------>

<!---------------------------------------------------------------- Section 3 Fitur ------------------------------------------------------------------------>


<section id="services" class="services section light-background">
  <div class="container section-title" data-aos="fade-up">
      <h2>Fitur Unggulan </h2>
      <p>GamaPulse menawarkan fitur inovatif yang akan membantu memahami diri lebih baik dan mendukung perjalanan akademis Anda dengan lebih efektif.</p>
  </div>

  <div class="container">
      <div class="row g-5">
          <!-- Mood Tracker -->
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
              <div class="service-item item-cyan position-relative">
                  <i class="bi bi-emoji-smile icon"></i>
                  <div>
                      <h3>Mood Tracker</h3>
                      <p>Catat suasana hati Anda setiap hari dan pelajari bagaimana perasaan Anda memengaruhi produktivitas. Dengan pemantauan rutin, Anda bisa lebih mudah mengenali pola mood Anda dan menjaga kesehatan mental Anda tetap stabil.</p>
                      <a href="#mood-tracker" class="read-more stretched-link">Pelajari Lebih Lanjut <i class="bi bi-arrow-right"></i></a>
                  </div>
              </div>
          </div>

          <!-- Daily Task Log -->
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
              <div class="service-item item-orange position-relative">
                  <i class="bi bi-stopwatch icon"></i>
                  <div>
                      <h3>Task Log</h3>
                      <p>Kelola progres tugas Anda dengan sistematis. Atur timeline pengerjaan, tentukan target, dan evaluasi pencapaian Anda setiap hari. Fitur ini membantu Anda tetap fokus pada tujuan dan menyelesaikan tugas tepat waktu.</p>
                      <a href="#daily-task-log" class="read-more stretched-link">Pelajari Lebih Lanjut <i class="bi bi-arrow-right"></i></a>
                  </div>
              </div>
          </div>

          <!-- Mood Calendar -->
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
              <div class="service-item item-teal position-relative">
                  <i class="bi bi-calendar4-week icon"></i>
                  <div>
                      <h3>Kalender Mood</h3>
                      <p>Visualisasikan perubahan mood Anda dalam format kalender yang interaktif. Amati tren suasana hati Anda dari hari ke hari, minggu ke minggu, untuk lebih memahami pengaruhnya terhadap kesehatan mental Anda secara keseluruhan.</p>
                      <a href="#mood-calendar" class="read-more stretched-link">Pelajari Lebih Lanjut <i class="bi bi-arrow-right"></i></a>
                  </div>
              </div>
          </div>

          <!-- Daily Journal -->
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
              <div class="service-item item-red position-relative">
                  <i class="bi bi-journal-text icon"></i>
                  <div>
                      <h3>Catatan Harian</h3>
                      <p>Simak refleksi dan ide-ide Anda setiap hari. Jurnal ini memudahkan Anda untuk merekam kemajuan tugas, menulis catatan penting, dan menyimpan informasi yang relevan dengan mudah.</p>
                      <a href="#daily-journal" class="read-more stretched-link">Pelajari Lebih Lanjut <i class="bi bi-arrow-right"></i></a>
                  </div>
              </div>
          </div>

          <!-- GamaPulse Reports -->
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
              <div class="service-item item-indigo position-relative">
                  <i class="bi bi-bar-chart icon"></i>
                  <div>
                      <h3>Laporan GamaPulse</h3>
                      <p>Terima analisis mendalam tentang tren mood Anda. Laporan ini membantu Anda memahami pemicu perasaan, serta memberikan rekomendasi untuk meningkatkan kesejahteraan mental Anda sepanjang perjalanan akademis.</p>
                      <a href="#gamapulse-reports" class="read-more stretched-link">Pelajari Lebih Lanjut <i class="bi bi-arrow-right"></i></a>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

<!---------------------------------------------------------------- Section 3 Fitur ------------------------------------------------------------------------>

<!---------------------------------------------------------------- Section 4 Detail mood trakker ------------------------------------------------------------------------>
<section class="features-details section">
  <div class="container">
    <!-- Section 1: Mood Tracker -->
    <div id="mood-trakker" class="row gy-4 justify-content-between features-item">
      <div class="container section-title" data-aos="fade-up">
        <h2>Mood Tracker</h2>
      </div>
      <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="100">
        <div class="content">
          <h3>Lacak dan Kelola Mood Anda dengan Mudah</h3>
          <p>Pantau suasana hati setiap hari untuk memahami emosi Anda lebih baik</p>
          <ul>
            <li><i class="bi bi-calendar3"></i> Lihat Mood Anda di Kalender Bulanan</li>
            <li><i class="bi bi-bar-chart-line"></i> Dapatkan Laporan Lengkap untuk Menganalisis Tren Mood Anda</li>
            <li><i class="bi bi-activity"></i> Pantau Kemajuan Mental Anda</li>
          </ul>
          <a href="#" class="btn more-btn">Learn More</a>
        </div>
      </div>
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
        <img src="assets/img/mood-tracker.png" class="img-fluid" alt="">
      </div>
    </div>

    <!-- Section 2: Task Log -->
    <div id="trakker-pengerjaan-tugas-akhir" class="row gy-4 justify-content-between features-item">
      <div class="container section-title" data-aos="fade-up">
        <h2>Task Log</h2>
      </div>
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
        <img src="assets/img/taks-log.png" class="img-fluid" alt="">
      </div>
      <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
        <div class="content">
          <h3>Capai Target, Tingkatkan Efisiensi</h3>
          <p>Tetapkan target waktu untuk setiap tugas, pantau durasi pengerjaannya, dan evaluasi produktivitas Anda.</p>
          <ul>
            <li><i class="bi bi-calendar-check"></i> Tetapkan Target Waktu Pengerjaan Tugas</li>
            <li><i class="bi bi-stopwatch"></i> Hentikan Waktu Saat Tugas Selesai</li>
            <li><i class="bi bi-graph-up"></i> Dapatkan Laporan Rata-rata Waktu Produktivitas</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Section 3: Kalender Mood -->
    <div id="view-mood-calender" class="row gy-4 justify-content-between features-item">
      <div class="container section-title" data-aos="fade-up">
        <h2>Kalender Mood</h2>
      </div>
      <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="100">
        <div class="content">
          <h3>Pantau & Kelola Mood Anda di Kalender Bulanan</h3>
          <p>Telusuri dan kelola mood harian Anda dengan mudah melalui tampilan kalender yang interaktif.</p>
          <ul>
            <li><i class="bi bi-calendar3"></i> Pilih Bulan untuk Melihat Rekam Mood Anda</li>
            <li><i class="bi bi-pencil-square"></i> Ubah Mood dan Catatan Jika Masih dalam Hari yang Sama</li>
            <li><i class="bi bi-bar-chart-line"></i> Pantau Konsistensi dan Tren Mood Anda Setiap Bulan</li>
          </ul>
          <a href="#" class="btn more-btn">Learn More</a>
        </div>
      </div>
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
        <img src="assets/img/calender.png" class="img-fluid" alt="">
      </div>
    </div>

    <!-- Section 4: Catatan Harian -->
    <div id="notes" class="row gy-4 justify-content-between features-item">
      <div class="container section-title" data-aos="fade-up">
        <h2>Catatan Harian</h2>
      </div>
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
        <img src="assets/img/notes.png" class="img-fluid" alt="">
      </div>
      <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
        <div class="content">
          <h3>Ekspresikan Emosi Anda dengan Catatan</h3>
          <p>Tuliskan Perasaan Anda dengan Aman dan Terkontrol</p>
          <ul>
            <li><i class="bi bi-pencil"></i> Tulis Perasaan Anda dengan Bebas dan Tanpa Batas</li>
            <li><i class="bi bi-shield-lock"></i> Semua Catatan Anda Dilindungi dan Tidak Akan Dibagikan</li>
            <li><i class="bi bi-calendar2-day"></i> Catat Emosi Anda Setiap Hari dengan Jaminan Kerahasiaan</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Section 5: Laporan Mood Tracker -->
    <div id="laporan-mood" class="row gy-4 justify-content-between features-item">
      <div class="container section-title" data-aos="fade-up">
        <h2>Laporan Mood Tracker</h2>
      </div>
      <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="100">
        <div class="content">
          <h3>Analisis Tren Mood Anda dengan Mudah</h3>
          <p>Analisis tren mood dengan visual yang memudahkan.</p>
          <ul>
            <li><i class="bi bi-bar-chart"></i> Lihat Infografik Mood yang Jelas dan Informatif</li>
            <li><i class="bi bi-calendar3"></i> Pilih Laporan Mingguan atau Bulanan untuk Melihat Pola Mood Anda</li>
            <li><i class="bi bi-search"></i> Pantau Perkembangan Mood Anda dengan Visual yang Memudahkan Analisis</li>
          </ul>
          <a href="#" class="btn more-btn">Learn More</a>
        </div>
      </div>
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
        <img src="assets/img/laporan-mood.png" class="img-fluid" alt="">
      </div>
    </div>

    <!-- Section 6: Laporan Task Log -->
    <div id="laporan-pengerjaan-tugas-akhir" class="row gy-4 justify-content-between features-item">
      <div class="container section-title" data-aos="fade-up">
        <h2>Laporan Task Log</h2>
      </div>
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
        <img src="assets/img/task-log.png" class="img-fluid" alt="">
      </div>
      <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
        <div class="content">
          <h3>Tingkatkan Produktivitas Anda</h3>
          <p>Lihat waktu yang dihabiskan untuk tugas Anda melalui infografik</p>
          <ul>
            <li><i class="bi bi-bar-chart-line"></i> Laporan Infografik untuk Mengukur Produktivitas Pengerjaan Tugas</li>
            <li><i class="bi bi-calendar3"></i> Pilih Laporan dalam Format Mingguan atau Bulanan</li>
            <li><i class="bi bi-clock"></i> Analisis Waktu yang Dihabiskan untuk Menyelesaikan Tugas</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>


  </main>

  <footer id="footer" class="footer position-relative light-background">
    <div class="container footer-top">
      <div class="row gy-4">
        <!-- Informasi Utama -->
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">GamaPulse</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Jl. Kaliurang KM 10</p>
            <p>Yogyakarta, Indonesia 55284</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+62 857 1234 5678</span></p>
            <p><strong>Email:</strong> <span>support@gamapulse.com</span></p>
          </div>
          {{-- <div class="social-links d-flex mt-4">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div> --}}
        </div>

        <!-- Navigasi Cepat -->
        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Navigasi Cepat</h4>
          <ul>
            <li><a href="#">Beranda</a></li>
            <li><a href="#">Tentang Kami</a></li>
            <li><a href="#">Fitur</a></li>
            <li><a href="#">Panduan</a></li>
          </ul>
        </div>

        <!-- Layanan Kami -->
        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Layanan Kami</h4>
          <ul>
            <li><a href="#">Mood Tracker</a></li>
            <li><a href="#">Catatan Harian</a></li>
            <li><a href="#">Task Log</a></li>
            <li><a href="#">Mood Calendar</a></li>
            <li><a href="#">Laporan</a></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Hak Cipta -->
    {{-- <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">GamaPulse</strong><span> All Rights Reserved</span></p>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> | Adapted by <a href="https://themewagon.com">ThemeWagon</a>
      </div>
    </div> --}}
  </footer>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Preloader -->
  <div id="preloader"></div>
  <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
