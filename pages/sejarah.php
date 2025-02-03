<?php
include('koneksi.php'); 
$query = "SELECT * FROM sejarah ORDER BY id_sejarah DESC";
$result = $conn->query($query);
?>

<main class="main">
  
    <div class="page-title dark-background"></div>

    <div class="container my-5" data-aos="fade-up" data-aos-delay="200">
   
        <section id="sejarah" class="profil-section">
            <div class="section-title text-center">
                <h2>Sejarah</h2>
            </div>

            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="row mb-4">
                    <div class="col-md-6">
                    <img src="admin/uploads/<?= $row['gambar']; ?>" alt="Sejarah" class="img-fluid" width="500" height="500">

                    </div>
                    <div class="col-md-6">
                        <p><?= $row['keterangan']; ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </section>
    </div>
</main>

<?php include('footer.html'); ?>


<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
</a>


<div id="preloader"></div>
