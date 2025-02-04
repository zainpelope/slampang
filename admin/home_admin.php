<?php
include 'koneksi.php';
$sql_potensi = "SELECT * FROM potensi_desa";
$result_potensi = $conn->query($sql_potensi);
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

      <a href="admin/create.php" style="text-decoration: none;">
        <h2 style="cursor: pointer; color: black; transition: 0.3s;">
          Potensi Desa
        </h2>
      </a>

      <style>
        a h2:hover {
          color: black;
          text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }
      </style>
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
            <div class="row">
              <?php
              $sql = "SELECT * FROM umkm_desa";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<div class='col-lg-7'>"; // Tambahkan col-lg-7 di sini
                  echo "<i class='bi bi-store flex-shrink-0'></i>";
                  echo "<div class='info-umkm flex-grow-1'>";
                  echo "<h4><a href='tambah_umkm.php?id=" . $row["id_umkm"] . "' style='color: black;'>" . $row["title"] . "</a></h4>";
                  echo "<p>" . $row["keterangan"] . "</p>";
                  echo "</div>";
                  echo "<div class='action-buttons ml-auto'>";
                  echo "<a href='edit_umkm.php?id=" . $row["id_umkm"] . "' class='text-warning small' style='font-size: 12px;'>Edit</a> | ";
                  echo "<a href='#' onclick='konfirmasiHapus(" . $row["id_umkm"] . ")' class='text-danger small' style='font-size: 12px;'>Hapus</a>";
                  echo "</div>";
                  echo "</div>";
                }
              } else {
                echo "<div class='col-lg-12'><p>Tidak ada data UMKM.</p></div>";
              }
              ?>
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



</main>
<script>
  function konfirmasiHapus(id_umkm) {
    var konfirmasi = confirm("Apakah Anda yakin ingin menghapus data UMKM ini?");
    if (konfirmasi) {
      // Jika pengguna menekan OK, maka lanjutkan ke proses penghapusan
      window.location.href = "hapus_umkm.php?id=" + id_umkm;
    } else {
      // Jika pengguna menekan Batal, maka batalkan proses penghapusan
      return false;
    }
  }
</script>
<?php include('footer.html'); ?>
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<div id="preloader"></div>