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
                    <h2 class="animate__animated animate__fadeInDown">Selamat Datang<br>di Desa Larangan Slampar</h2>
                    <p class="animate__animated animate__fadeInUp">Desa Larangan Slampar merupakan salah satu desa yang berada di Ujung Utara Kecamatan Tlanakan Kabupaten Pamekasan, dengan luas desa ± 517,00 Ha serta jumlah penduduknya berkisar 6.515 jiwa, mayoritas mata pencaharian masyarakatnya sebagai petani.</p>
                    <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="carousel-container">
                    <h2 class="animate__animated animate__fadeInDown">Desa Larangan Slampar</h2>
                    <p class="animate__animated animate__fadeInUp">Desa Larangan Slampar memiliki 9 Dusun yakni Dusun
                        Gergunung Dejeh, Dusun Gergunung Laok, Dusun Karpote, Dusun
                        Torbalangan, Dusun Nyabangan, Dusun Lonsambi, Dusun Tengah, Dusun
                        Larangan, dan Dusun Morlaok. Angka curah hujan yang biasa terjadi di
                        Desa Larangan Slampar rata-rata cukup rendah, yakni sebesar 1112,4 mm pertahun sebagaimana yang terjadi di daerah lain di Indinesia. Di Desa
                        Larangan Slampar beriklim tropis dengan kelembapan udaranya ±65%
                        serta curah hujan terendah terjadi pada bulan juni sampai dengan bulan
                        oktober.</p>
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

        </div><!-- End Section Title -->



    </section>

    <!-- Gallery Section -->



</main>

<?php include('footer.html'); ?>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>