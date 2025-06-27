<!DOCTYPE html>
<html lang="ms">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sistem Pengurusan Temu Janji dan Giliran Klinik ENT</title>
  <meta name="description" content="Sistem Pengurusan Temu Janji dan Giliran untuk Klinik ENT">
  <meta name="keywords" content="Klinik ENT, Temu Janji, Sistem Giliran">

  <link href="Logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="assets/css/main.css" rel="stylesheet">

  <style>
    /* Custom styles for login dropdown */
    .cta-btn-group {
      display: flex;
      gap: 10px;
    }
    .dropdown-toggle::after {
        display: none;
    }
  </style>

</head>

<body class="index-page">

  <header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:hubungi@klinikent.com">hubungi@klinikent.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+60 12-345 6789</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div><div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="/" class="logo d-flex align-items-center me-auto">
          <h1 class="sitename"><img src="Logo.png" alt="Logo Klinik ENT"></h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="#hero" class="active">Laman Utama<br></a></li>
            <li><a href="#about">Tentang Kami</a></li>
            <li><a href="#services">Perkhidmatan</a></li>
            <li><a href="#doctors">Doktor</a></li>
            <li><a href="#contact">Hubungi Kami</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        
        <div class="cta-btn-group d-none d-sm-flex align-items-center">
            <a class="cta-btn" href="{{ route('login') }}">Tempah Temujanji</a>
        </div>


      </div>

    </div>

  </header>

  <main class="main">

    <section id="hero" class="hero section light-background">

      <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

      <div class="container position-relative">

        <div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
          <h2>SELAMAT DATANG KE KLINIK ENT</h2>
          <p>Perkhidmatan kesihatan telinga, hidung dan tekak yang terbaik untuk anda.</p>
        </div><div class="content row gy-4">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="why-box" data-aos="zoom-out" data-aos-delay="200">
              <h3>Kenapa Pilih Kami?</h3>
              <p>
                Kami komited untuk menyediakan penjagaan pesakit yang luar biasa dengan pasukan doktor pakar dan staf yang berdedikasi. Klinik kami dilengkapi dengan teknologi terkini untuk memastikan diagnosis dan rawatan yang tepat.
              </p>
              <div class="text-center">
                <a href="#about" class="more-btn"><span>Ketahui Lebih Lanjut</span> <i class="bi bi-chevron-right"></i></a>
              </div>
            </div>
          </div><div class="col-lg-8 d-flex align-items-stretch">
            <div class="d-flex flex-column justify-content-center">
              <div class="row gy-4">

                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box" data-aos="zoom-out" data-aos-delay="300">
                    <i class="bi bi-clipboard-data"></i>
                    <h4>Pakar Berpengalaman</h4>
                    <p>Pasukan doktor kami terdiri daripada pakar-pakar yang diiktiraf dalam bidang ENT.</p>
                  </div>
                </div><div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box" data-aos="zoom-out" data-aos-delay="400">
                    <i class="bi bi-gem"></i>
                    <h4>Teknologi Terkini</h4>
                    <p>Menggunakan peralatan perubatan moden untuk rawatan yang efektif.</p>
                  </div>
                </div><div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box" data-aos="zoom-out" data-aos-delay="500">
                    <i class="bi bi-inboxes"></i>
                    <h4>Penjagaan Komprehensif</h4>
                    <p>Menyediakan pelbagai perkhidmatan dari pemeriksaan hingga pembedahan.</p>
                  </div>
                </div></div>
            </div>
          </div>
        </div></div>

    </section><section id="about" class="about section">

      <div class="container">

        <div class="row gy-4 gx-5">

          <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="200">
            <img src="assets/img/about.jpg" class="img-fluid" alt="">
            <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
          </div>

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <h3>Tentang Kami</h3>
            <p>
              Klinik kami ditubuhkan dengan misi untuk menawarkan perkhidmatan kesihatan ENT yang berkualiti tinggi dan mudah diakses oleh semua lapisan masyarakat. Kami percaya setiap pesakit layak menerima layanan terbaik.
            </p>
            <ul>
              <li>
                <i class="fa-solid fa-vial-circle-check"></i>
                <div>
                  <h5>Diagnosis Tepat & Cepat</h5>
                  <p>Sistem kami membantu mempercepatkan proses diagnosis untuk rawatan segera.</p>
                </div>
              </li>
              <li>
                <i class="fa-solid fa-pump-medical"></i>
                <div>
                  <h5>Fasiliti Rawatan Moden</h5>
                  <p>Bilik rawatan dan peralatan kami sentiasa dinaik taraf mengikut peredaran teknologi.</p>
                </div>
              </li>
              <li>
                <i class="fa-solid fa-heart-circle-xmark"></i>
                <div>
                  <h5>Mengutamakan Keselesaan Pesakit</h5>
                  <p>Kami berusaha untuk memastikan pengalaman yang selesa dan mesra untuk setiap pesakit.</p>
                </div>
              </li>
            </ul>
          </div>

        </div>

      </div>

    </section><section id="stats" class="stats section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fa-solid fa-user-doctor"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
              <p>Doktor</p>
            </div>
          </div><div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fa-regular fa-hospital"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="5" data-purecounter-duration="1" class="purecounter"></span>
              <p>Jabatan</p>
            </div>
          </div><div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fas fa-flask"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="2000" data-purecounter-duration="1" class="purecounter"></span>
              <p>Pesakit Berpuas Hati</p>
            </div>
          </div><div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fas fa-award"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
              <p>Anugerah</p>
            </div>
          </div></div>

      </div>

    </section><section id="services" class="services section">

      <div class="container section-title" data-aos="fade-up">
        <h2>Perkhidmatan</h2>
        <p>Kami menawarkan pelbagai perkhidmatan khusus untuk masalah telinga, hidung dan tekak.</p>
      </div><div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item  position-relative">
              <div class="icon">
                <i class="fas fa-heartbeat"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Pemeriksaan Telinga</h3>
              </a>
              <p>Pemeriksaan pendengaran, jangkitan telinga, dan masalah tahi telinga tersumbat.</p>
            </div>
          </div><div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-pills"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Rawatan Hidung & Resdung</h3>
              </a>
              <p>Rawatan untuk masalah resdung (sinusitis), alahan, dan hidung tersumbat.</p>
            </div>
          </div><div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-hospital-user"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Masalah Tekak & Tonsil</h3>
              </a>
              <p>Pemeriksaan dan rawatan untuk sakit tekak, masalah tonsil, dan gangguan suara.</p>
            </div>
          </div></div>

      </div>

    </section><section id="appointment" class="appointment section">

      <div class="container section-title" data-aos="fade-up">
        <h2>Tempah Temujanji</h2>
        <p>Sila daftar atau log masuk sebagai pesakit untuk menempah slot temujanji anda secara dalam talian.</p>
      </div><div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="text-center">
             <a href="#" class="btn btn-primary btn-lg">Daftar / Log Masuk Pesakit</a>
        </div>
      </div>

    </section><section id="doctors" class="doctors section">

      <div class="container section-title" data-aos="fade-up">
        <h2>Doktor Kami</h2>
        <p>Barisan doktor pakar kami yang sedia membantu anda.</p>
      </div><div class="container">

        <div class="row gy-4">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="assets/img/doctors/doctors-1.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Dr. Walter White</h4>
                <span>Ketua Pegawai Perubatan</span>
                <p>Pakar dalam pembedahan endoskopik sinus dan rawatan alahan.</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div><div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="assets/img/doctors/doctors-2.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Dr. Sarah Jhonson</h4>
                <span>Pakar Audiologi</span>
                <p>Berpengalaman dalam diagnosis dan pengurusan masalah pendengaran.</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div></div>

      </div>

    </section><section id="contact" class="contact section">

      <div class="container section-title" data-aos="fade-up">
        <h2>Hubungi Kami</h2>
        <p>Hubungi kami untuk sebarang pertanyaan lanjut. Kami sedia membantu.</p>
      </div><div class="mb-5" data-aos="fade-up" data-aos-delay="200">
        <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div><div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-12">
            <div class="row gy-4">
                <div class="col-md-4">
                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-geo-alt flex-shrink-0"></i>
                        <div>
                        <h3>Lokasi</h3>
                        <p>A108 Adam Street, New York, NY 535022</p>
                        </div>
                    </div></div>

                <div class="col-md-4">
                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-telephone flex-shrink-0"></i>
                        <div>
                        <h3>Hubungi Kami</h3>
                        <p>+1 5589 55488 55</p>
                        </div>
                    </div></div>
                
                <div class="col-md-4">
                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                        <i class="bi bi-envelope flex-shrink-0"></i>
                        <div>
                        <h3>Emel Kami</h3>
                        <p>info@example.com</p>
                        </div>
                    </div></div>
            </div>
          </div>

        </div>

      </div>

    </section></main>

  <footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="/" class="logo d-flex align-items-center">
            <span class="sitename">Klinik ENT</span>
          </a>
          <div class="footer-contact pt-3">
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p class="mt-3"><strong>Telefon:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Emel:</strong> <span>info@example.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Pautan Berguna</h4>
          <ul>
            <li><a href="#">Laman Utama</a></li>
            <li><a href="#">Tentang Kami</a></li>
            <li><a href="#">Perkhidmatan</a></li>
            <li><a href="#">Terma Perkhidmatan</a></li>
            <li><a href="#">Dasar Privasi</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Perkhidmatan Kami</h4>
          <ul>
            <li><a href="#">Rawatan Resdung</a></li>
            <li><a href="#">Masalah Pendengaran</a></li>
            <li><a href="#">Pemeriksaan Tekak</a></li>
            <li><a href="#">Pembedahan Kecil</a></li>
            <li><a href="#">Audiologi</a></li>
          </ul>
        </div>
        
      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Hak Cipta Terpelihara</span> <strong class="px-1 sitename">Klinik ENT</strong></p>
    </div>

  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <script src="assets/js/main.js"></script>

</body>

</html>