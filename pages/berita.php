<?php
include 'koneksi.php';
?>
<main class="main">
    <div class="page-title dark-background">
    </div>
    <div class="container my-5" data-aos="fade-up" data-aos-delay="200">
        <section id="berita" class="berita section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Berita</h2>
                <p>Menyajikan informasi terbaru tentang peristiwa dan berita terkini dari Desa Larangan Slampar.</p>
            </div>
            <div class="container">
                <div class="row">
                    <?php
                    $sql = "SELECT * FROM berita";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                            <div class="member">
                                <img src="admin/uploads/<?= htmlspecialchars($row['gambar']) ?>" class="img-fluid" alt="">
                                <div class="member-content">
                                    <h5 class="mb-1"><?= htmlspecialchars($row['judul']) ?></h5>
                                    <p class="text-muted"><?= htmlspecialchars($row['tanggal']) ?></p>
                                    <p class="mb-1"><?= htmlspecialchars($row['keterangan']) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    </div>
</main>
<?php include('footer.html'); ?>
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<div id="preloader"></div>