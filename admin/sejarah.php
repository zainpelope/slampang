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

            <a href="admin/sejarah/tambah_sejarah.php" class="btn btn-primary mb-3">Tambah Sejarah</a>

          
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        while ($row = $result->fetch_assoc()) : 
                            $gambar_path = "admin/uploads/" . htmlspecialchars($row['gambar']);
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <?php if (!empty($row['gambar']) && file_exists($gambar_path)) : ?>
                                        <img src="<?= $gambar_path ?>" alt="Sejarah" style="width: 100px; height: 100px; object-fit: cover;">
                                    <?php else : ?>
                                        <img src="assets/img/default-image.png" alt="Default" style="width: 100px; height: 100px; object-fit: cover;">
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($row['keterangan']); ?></td>
                                <td>
                                    <a href="admin/sejarah/detail_sejarah.php?id=<?= $row['id_sejarah']; ?>" class="btn btn-info btn-sm">Detail</a>
                                    <a href="admin/sejarah/edit_sejarah.php?id=<?= $row['id_sejarah']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="admin/sejarah/hapus_sejarah.php?id=<?= $row['id_sejarah']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>

<?php include('footer.html'); ?>


<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
</a>


<div id="preloader"></div>
