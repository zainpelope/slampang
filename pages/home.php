<?php
include 'koneksi.php';

$sql = "SELECT * FROM galery";
$result = $conn->query($sql);

?>
<main class="main">

  <!-- Hero Section -->
  <section id="hero" class="hero section dark-background">
    <div id="hero-carousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">
      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">Welcome to <span>Desa Larangan Slampar</span></h2>
          <p class="animate__animated animate__fadeInUp">Desa Larangan Slampar merupakan salah satu desa yang berada di Ujung Utara Kecamatan Tlanakan Kabupaten Pamekasan, dengan luas desa ± 517,00 Ha serta jumlah penduduknya berkisar 6.515 jiwa, mayoritas mata pencaharian masyarakatnya sebagai petani.</p>
          <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
        </div>
      </div>
      <!-- Slide 2 -->
      <div class="carousel-item">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">Desa Larangan Slampar</h2>
          <p class="animate__animated animate__fadeInUp">Desa Larangan Slampar merupakan salah satu desa yang berada di Ujung Utara Kecamatan Tlanakan Kabupaten Pamekasan, dengan luas desa ± 517,00 Ha serta jumlah penduduknya berkisar 6.515 jiwa, mayoritas mata pencaharian masyarakatnya sebagai petani.</p>
          <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
        </div>
      </div>
      <!-- Slide 3 -->
      <div class="carousel-item">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">Sequi ea ut et est quaerat</h2>
          <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
          <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
        </div>
      </div>
      <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>
      <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>
    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
      <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3"></use>
      </g>
      <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0"></use>
      </g>
      <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9"></use>
      </g>
    </svg>

  </section>

  <!-- Potensi Section -->
  <section id="features-2" class="features section features-2">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Potensi Desa</h2>
      <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="row gy-4 justify-content-between">
        <div class="features-image col-lg-4 d-flex align-items-center" data-aos="fade-up">
          <img src="assets/img/potensi.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-lg-7 d-flex flex-column justify-content-center">

          <div class="features-item d-flex" data-aos="fade-up" data-aos-delay="200">
            <i class="bi bi-globe-americas flex-shrink-0"></i>
            <div>
              <h4>Potensi Alam</h4>
              <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
            </div>
          </div>

          <div class="features-item d-flex mt-5" data-aos="fade-up" data-aos-delay="300">
            <i class="bi bi-tree-fill flex-shrink-0"></i>
            <div>
              <h4>Sumber Daya Desa</h4>
              <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
            </div>
          </div>

          <div class="features-item d-flex mt-5" data-aos="fade-up" data-aos-delay="400">
            <i class="bi bi-broadcast flex-shrink-0"></i>
            <div>
              <h4>Usaha Mikro, Kecil, Menengan (UMKM)</h4>
              <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
            </div>
          </div>

        </div>
      </div>

    </div>

  </section>

  <!-- Gallery Section -->
  <section id="gallery" class="gallery section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Gallery</h2>
      <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

      <div class="row g-0">
        <?php while ($row = $result->fetch_assoc()) { ?>
          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="admin/uploads/<?= $row['gambar'] ?>" class="glightbox" data-gallery="images-gallery">
                <img src="admin/uploads/<?= $row['gambar'] ?>" class="img-fluid">
              </a>
            </div>
          </div>
        <?php } ?>

      </div>

    </div>

  </section>


</main>

<footer id="footer" class="footer light-background">
  <div class="container">
    <h3 class="sitename">Desa Larangan Slampar</h3>
    <p>Et aut eum quis fuga eos sunt ipsa nihil. Labore corporis magni eligendi fuga maxime saepe commodi placeat.</p>
    <div class="social-links d-flex justify-content-center">
      <a href=""><i class="bi bi-twitter-x"></i></a>
      <a href=""><i class="bi bi-facebook"></i></a>
      <a href=""><i class="bi bi-instagram"></i></a>
      <a href=""><i class="bi bi-skype"></i></a>
      <a href=""><i class="bi bi-linkedin"></i></a>
    </div>
    <div class="container">
      <div class="copyright">
        <span>Copyright</span> <strong class="px-1 sitename">Riyan.a_w</strong> <span>All Rights Reserved</span>
      </div>
      <div class="credits">
        Designed by Riyan.a_w</a>
      </div>
    </div>
  </div>
</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>