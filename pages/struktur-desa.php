<?php
include 'koneksi.php';
session_start();

// Query untuk memprioritaskan Kepala Desa
$sql = "SELECT * FROM struktur
        ORDER BY 
          CASE WHEN jabatan = 'Kepala Desa' THEN 1 ELSE 2 END, 
          nama ASC";
$result = $conn->query($sql);
?>
<main class="main">
    <!-- Hero Title -->
    <div class="page-title dark-background"></div>

    <div class="container my-5" data-aos="fade-up" data-aos-delay="200">
        <!-- Profil Section -->
        <section id="struktur-desa" class="my-5">
            <div class="section-title text-center">
                <h2>Struktur Desa</h2>
            </div>
            <div class="row justify-content-center">
                <!-- Card 1 -->
                <?php if ($result->num_rows > 0) { ?>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <div class="col-md-3 mb-3">
                            <div class="card shadow">
                                <img src="admin/uploads/<?= $row['gambar'] ?>"
                                    class="card-img-top"
                                    alt="struktur-desa"
                                    style="width: 100%; height: 300px; object-fit: cover; padding: 6px;">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center"
                                    style="text-align: center;">
                                    <p class="card-text font-weight-bold"><?= htmlspecialchars($row['nama']) ?></p>
                                    <p class="card-text"><?= htmlspecialchars($row['jabatan']) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p class="text-center">Data struktur desa tidak ditemukan.</p>
                <?php } ?>
            </div>
        </section>
    </div>
</main>
<?php include('footer.html'); ?>
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>