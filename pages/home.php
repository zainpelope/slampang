<?php
include 'koneksi.php';

$sql_potensi = "SELECT * FROM potensi_desa";
$result_potensi = $conn->query($sql_potensi);

$sql_galery = "SELECT * FROM galery";
$result_galery = $conn->query($sql_galery);
?>

<main class="main">

  <section id="hero" class="hero section dark-background">
    <div id="hero-carousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">
      <div class="carousel-item active">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">Selamat Datang<br>di Desa Larangan Slampar</h2>
          <p class="animate__animated animate__fadeInUp">Desa Larangan Slampar merupakan salah satu desa yang berada di Ujung Utara Kecamatan Tlanakan Kabupaten Pamekasan, dengan luas desa ± 517,00 Ha serta jumlah penduduknya berkisar 6.515 jiwa, mayoritas mata pencaharian masyarakatnya sebagai petani.</p>
          <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
        </div>
      </div>
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
  <section id="features-2" class="features section features-2">
    <div class="container section-title" data-aos="fade-up">


      <h2>
        Potensi Desa
      </h2>



      <?php
      $row = $result_potensi->fetch_assoc();
      if ($row) {
      ?>
        <p><?php echo $row['keterangan']; ?></p>
    </div>
    <div class="container">
      <div class="row gy-4 justify-content-between">
        <div class="features-image col-lg-4 d-flex align-items-center" data-aos="fade-up">
          <img src="uploads/<?php echo $row['gambar']; ?>" class="img-fluid" alt="Potensi Desa">
        </div>
        <div class="col-lg-7 d-flex flex-column justify-content-center">

          <div class="features-item d-flex" data-aos="fade-up" data-aos-delay="200">
            <i class="bi bi-globe-americas flex-shrink-0"></i>
            <div>
              <h4>Potensi Alam</h4>
              <p>
                Potensi alam Desa Larangan Slampar juga mencakup ketersediaan sumber daya air yang mendukung irigasi pertanian, lahan hijau yang cocok untuk pengembangan hortikultura, serta keanekaragaman hayati yang dapat dimanfaatkan untuk program konservasi dan pemberdayaan ekonomi berbasis lingkungan.</p>
            </div>
          </div>

          <div class="features-item d-flex mt-5" data-aos="fade-up" data-aos-delay="300">
            <i class="bi bi-tree-fill flex-shrink-0"></i>
            <div>
              <h4>Sumber Daya Desa</h4>
              <p>Sumber daya desa di Larangan Slampar juga sangat mendukung pembangunan, baik dari segi tenaga kerja lokal yang sebagian besar memiliki keterampilan di sektor agraris, kerajinan, maupun perdagangan, maupun lembaga-lembaga desa seperti Badan Usaha Milik Desa (BUMDes) yang dapat membantu mengelola potensi desa secara optimal.</p>
            </div>
          </div>
          <div class="features-item d-flex mt-5" data-aos="fade-up" data-aos-delay="400">
            <i class="bi bi-broadcast flex-shrink-0"></i>
            <div>
              <h4>Usaha Mikro, Kecil, Menengan (UMKM)</h4>
              <p>Desa Larangan Slampar, yang terletak di Kecamatan Tlanakan, Kabupaten Pamekasan, Jawa Timur, memiliki potensi besar dalam pengembangan Usaha Mikro, Kecil, dan Menengah (UMKM), potensi alam, serta sumber daya desa yang melimpah.</p>
            </div>
          </div>
        </div>
      <?php
      }
      ?>

      <?php
      if ($row = $result_potensi->fetch_assoc()) {
        echo "<p>" . $row['keterangan'] . "</p>";
      }
      ?>
      </div>


    </div>
    </div>

    </div>
  </section>

  <section id="gallery" class="gallery section">
    <div class="container section-title" data-aos="fade-up">
      <h2>Gallery</h2>
      <p>Desa Larangan Slampar memiliki galeri visual yang menampilkan keindahan alam, kegiatan masyarakat, serta produk lokal unggulan melalui kumpulan gambar yang dapat menggambarkan identitas dan potensi desa secara visual.</p>
    </div>
    <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
      <div class="row g-0">
        <?php while ($row = $result_galery->fetch_assoc()) { ?>
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
<?php include('footer.html'); ?>
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<div id="preloader"></div>