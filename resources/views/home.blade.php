<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <li><a href="#hero" class="active">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Fitur</a></li>
                    <li><a href="#features">Detail</a></li>
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

<!---------------------------------------------------------------- Section 1 Welcomme ------------------------------------------------------------------------>
    <section id="hero" class="hero section">
        <div class="hero-bg">
            <img src="assets/img/hero-bg-light.webp" alt="">
        </div>
        <div class="container text-center">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h1 data-aos="fade-up">Welcome to <span>GamaPulse</span></h1>
                <p data-aos="fade-up" data-aos-delay="100">ayoo pantau mental anda dengan gamapulse<br></p>
                <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('login') }}" class="btn-get-started transition-transform duration-300 ease-in-out transform hover:scale-110">Login</a>
                </div>
                <img src="assets/img/hero-services-img.webp" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300">
            </div>
        </div>
    </section><!-- /Hero Section -->
<!---------------------------------------------------------------- Section 1 Welcomme ------------------------------------------------------------------------>

<!---------------------------------------------------------------- Section 2 About ------------------------------------------------------------------------>
    <section id="about" class="about section">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                    <p class="who-we-are">website Apakah ini? </p>
                    <h3>Memantau Emosi Harian Anda</h3>
                    <p class="fst-italic">
                    Kami menyediakan solusi pemantauan kesehatan mental yang mudah dan efektif bagi mahasiswa,
                    serta memberikan laporan dari data secara bulanan dan mingguan.
                    </p>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> <span>Memberikan pelacakan suasana hati harian yang mudah diakses.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Menyediakan laporan mingguan dan bulanan yang dapat membantu mengidentifikasi tren suasana hati.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Menawarkan pengaturan target harian dan pelaporan pencapaian untuk menjaga motivasi tetap tinggi.</span></li>
                    </ul>
                    <a href="#" class="read-more"><span>Ayo coba sekarang</span><i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <img src="assets/img/home/home1.png" class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-6">
                            <div class="row gy-4">
                                <div class="col-lg-12">
                                    <img src="assets/img/home/home2.jpg" class="img-fluid" alt="">
                                </div>
                                <div class="col-lg-12">
                                    <img src="assets/img/home/home3.jpg" class="img-fluid" alt="">
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
            <h2>Fitur</h2>
            <p>Temukan berbagai fitur yang akan membantu Anda mengelola mood dan progress tugas akhir dengan lebih efektif</p>
        </div>

        <div class="container">

            <div class="row g-5">

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item item-cyan position-relative">
                        <i class="bi bi-emoji-smile icon"></i>
                        <div>
                            <h3>Mood trackker</h3>
                            <p>Catat dan pantau suasana hati Anda setiap hari. Fitur ini membantu Anda mengidentifikasi pola mood, memahami pemicu perubahan emosi, dan mengelola kesehatan mental dengan lebih baik selama perjalanan tugas akhir Anda.</p>
                            <a href="#mood-trakker" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item item-orange position-relative">
                        <i class="bi bi-stopwatch icon"></i>
                        <div>
                            <h3>Trakker pengerjaan tugas akhir</h3>
                            <p>Pantau dan kelola progress pengerjaan tugas akhir Anda dengan sistematis. Fitur ini memungkinkan Anda membuat timeline, menentukan target, dan memantau pencapaian setiap tahap pengerjaan tugas akhir.</p>
                            <a href="#trakker-perngerjaan-tugas-akhir" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item item-teal position-relative">
                        <i class="bi bi-calendar4-week icon"></i>
                        <div>
                            <h3>View mood calender</h3>
                            <p>Visualisasikan perubahan mood Anda dalam bentuk kalender interaktif. Lihat pola mood harian, mingguan, dan bulanan untuk memahami tren kesehatan mental Anda selama proses pengerjaan tugas akhir.</p>
                            <a href="#view-mood-calender" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-item item-red position-relative">
                        <i class="bi bi-journal-text icon"></i>
                        <div>
                            <h3>Notes</h3>
                            <p>Catat semua ide, pemikiran, dan refleksi Anda dalam satu tempat. Fitur ini memudahkan Anda untuk mendokumentasikan progress, menulis catatan penting, dan menyimpan referensi terkait tugas akhir.</p>
                            <a href="#notes" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-item item-indigo position-relative">
                        <i class="bi bi-bar-chart icon"></i>
                        <div>
                            <h3>Laporan mood</h3>
                            <p>Dapatkan analisis komprehensif tentang pola mood Anda. Fitur ini menyajikan laporan detail tentang tren emosi, faktor pemicu, dan rekomendasi untuk meningkatkan kesehatan mental Anda.</p>
                            <a href="#laporan-mood" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="service-item item-pink position-relative">
                        <i class="bi bi-bar-chart icon"></i>
                        <div>
                            <h3>Laporan pengerjaan tugas akhir</h3>
                            <p>Monitor kemajuan tugas akhir Anda melalui laporan terstruktur. Fitur ini memberikan gambaran jelas tentang progress, deadline, dan capaian dalam proses pengerjaan tugas akhir Anda.</p>
                            <a href="#laporan-pengerjaan-tugas-akhir" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!---------------------------------------------------------------- Section 3 Fitur ------------------------------------------------------------------------>

<!---------------------------------------------------------------- Section 4 Detail mood trakker ------------------------------------------------------------------------>
    <section id="features" class="features section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Mood tracker</h2>
        </div>
        <div id="mood-trakker" class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5 d-flex align-items-center">
                    <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">
                        <li class="nav-item">
                            <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                                <i class="bi bi-binoculars"></i>
                                <div>
                                    <h4 class="d-none d-lg-block">Modi sit est dela pireda nest</h4>
                                    <p>
                                    Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                    velit esse cillum dolore eu fugiat nulla pariatur
                                    </p>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                                <i class="bi bi-box-seam"></i>
                                <div>
                                    <h4 class="d-none d-lg-block">Unde praesenti mara setra le</h4>
                                    <p>
                                    Recusandae atque nihil. Delectus vitae non similique magnam molestiae sapiente similique
                                    tenetur aut voluptates sed voluptas ipsum voluptas
                                    </p>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                                <i class="bi bi-brightness-high"></i>
                                <div>
                                    <h4 class="d-none d-lg-block">Pariatur explica nitro dela</h4>
                                    <p>
                                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                                    Debitis nulla est maxime voluptas dolor aut
                                    </p>
                                </div>
                            </a>
                        </li>
                    </ul><!-- End Tab Nav -->
                </div>
                <div class="col-lg-6">
                    <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
                        <div class="tab-pane fade active show" id="features-tab-1">
                            <img src="assets/img/tabs-1.jpg" alt="" class="img-fluid">
                        </div><!-- End Tab Content Item -->
                        <div class="tab-pane fade" id="features-tab-2">
                            <img src="assets/img/tabs-2.jpg" alt="" class="img-fluid">
                        </div><!-- End Tab Content Item -->
                        <div class="tab-pane fade" id="features-tab-3">
                            <img src="assets/img/tabs-3.jpg" alt="" class="img-fluid">
                        </div><!-- End Tab Content Item -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<!---------------------------------------------------------------- Section 4 Detail mood trakker ------------------------------------------------------------------------>


    <section  class="features-details section">

      <div class="container">
        <!---------------------------------------------------------------- Section 5 Detail pengerjaan tugas akhir ------------------------------------------------------------------------>
        <div class="row gy-4 justify-content-between features-item">
            <div id="trakker-perngerjaan-tugas-akhir" class="container section-title" data-aos="fade-up">
                <h2>Tracker pengerjaan tugas akhir</h2>
            </div>

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <img src="assets/img/features-1.jpg" class="img-fluid" alt="">
            </div>
            <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
                <div class="content">
                    <h3>Buat target pengerjaan tugas akhir</h3>
                    <p class="text-justify">
                        Kami menyediakan sebuah fitur yang memungkinkan Anda untuk memantau progress pengerjaan tugas akhir dengan lebih efektif.
                        Fitur ini memungkinkan Anda untuk membuat target seberapa lama anda mengerjakan tugas akhir,
                        System mencatat waktu yang anda gunakan untuk mengerjakan tugas akhir, dan memberikan laporan pencapaian setiap tahap pengerjaan tugas akhir.
                    </p>
                </div>
            </div>
        </div>
        <!---------------------------------------------------------------- Section 5 Detail pengerjaan tugas akhir ------------------------------------------------------------------------>

        <!---------------------------------------------------------------- Section 6 Detail view mood calender ------------------------------------------------------------------------>

        <div class="row gy-4 justify-content-between features-item">
             <div id="view-mood-calender" class="container section-title" data-aos="fade-up">
            <h2>View mood calender</h2>
          </div>

          <div class="col-lg-5 d-flex align-items-center order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">

            <div class="content">
              <h3>Neque ipsum omnis sapiente quod quia dicta</h3>
              <p>
                Quidem qui dolore incidunt aut. In assumenda harum id iusto lorena plasico mares
              </p>
              <ul>
                <li><i class="bi bi-easel flex-shrink-0"></i> Et corporis ea eveniet ducimus.</li>
                <li><i class="bi bi-patch-check flex-shrink-0"></i> Exercitationem dolorem sapiente.</li>
                <li><i class="bi bi-brightness-high flex-shrink-0"></i> Veniam quia modi magnam.</li>
              </ul>
              <p></p>
              <a href="#" class="btn more-btn">Learn More</a>
            </div>

          </div>

          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="200">
            <img src="assets/img/features-2.jpg" class="img-fluid" alt="">
          </div>

        </div>
         <!---------------------------------------------------------------- Section 6 Detail view mood calender ------------------------------------------------------------------------>

      </div>

    </section>


    <section class="features-details section">

        <div class="container">
            <!---------------------------------------------------------------- Section 7 Detail notes ------------------------------------------------------------------------>

            <div class="row gy-4 justify-content-between features-item">
                <div id="notes" class="container section-title" data-aos="fade-up">
                    <h2>Notes</h2>
                  </div>

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
              <img src="assets/img/features-1.jpg" class="img-fluid" alt="">
            </div>

            <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
              <div class="content">
                <h3>Corporis temporibus maiores provident</h3>
                <p>
                  Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.
                </p>
                <a href="#" class="btn more-btn">Learn More</a>
              </div>
            </div>

          </div>
            <!---------------------------------------------------------------- Section 7 Detail notes ------------------------------------------------------------------------>

            <!---------------------------------------------------------------- Section 7 Detail laporan mood ------------------------------------------------------------------------>

          <div class="row gy-4 justify-content-between features-item">
            <div id="laporan-mood" class="container section-title" data-aos="fade-up">
                <h2>Laporan mood</h2>
              </div>

            <div class="col-lg-5 d-flex align-items-center order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">

              <div class="content">
                <h3>Neque ipsum omnis sapiente quod quia dicta</h3>
                <p>
                  Quidem qui dolore incidunt aut. In assumenda harum id iusto lorena plasico mares
                </p>
                <ul>
                  <li><i class="bi bi-easel flex-shrink-0"></i> Et corporis ea eveniet ducimus.</li>
                  <li><i class="bi bi-patch-check flex-shrink-0"></i> Exercitationem dolorem sapiente.</li>
                  <li><i class="bi bi-brightness-high flex-shrink-0"></i> Veniam quia modi magnam.</li>
                </ul>
                <p></p>
                <a href="#" class="btn more-btn">Learn More</a>
              </div>

            </div>

            <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="200">
              <img src="assets/img/features-2.jpg" class="img-fluid" alt="">
            </div>

          </div>
          <!---------------------------------------------------------------- Section 7 Detail laporan mood ------------------------------------------------------------------------>

        </div>

      </section><!-- /Features Details Section -->

      <section id="trakker-perngerjaan-tugas-akhir" class="features-details section">

        <div class="container">
            <!---------------------------------------------------------------- Section 7 Detail laporan pengerjaan tugas akhir ------------------------------------------------------------------------>
          <div class="row gy-4 justify-content-between features-item">
            <div id="laporan-pengerjaan-tugas-akhir" class="container section-title" data-aos="fade-up">
                <h2>Laporan pengerjaan tugas akhir</h2>
              </div>

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
              <img src="assets/img/features-1.jpg" class="img-fluid" alt="">
            </div>

            <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
              <div class="content">
                <h3>Corporis temporibus maiores provident</h3>
                <p>
                  Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.
                </p>
                <a href="#" class="btn more-btn">Learn More</a>
              </div>
            </div>
        </div>
            <!---------------------------------------------------------------- Section 7 Detail laporan pengerjaan tugas akhir ------------------------------------------------------------------------>

      </section><!-- /Features Details Section -->
  </main>

  <footer id="footer" class="footer position-relative light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">GamaPulse</span>
          </a>
          <div class="footer-contact pt-3">
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Fitur</a></li>
            <li><a href="#">Detail</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">QuickStart</strong><span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Dist<a href="https://themewagon.com">ThemeWagon
      </div>
    </div>

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
