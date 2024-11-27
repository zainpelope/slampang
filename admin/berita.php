<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $sql = "SELECT gambar FROM berita WHERE id_berita = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($gambar);
    $stmt->fetch();
    $stmt->close();

    unlink("admin/uploads/" . $gambar);

    $sql = "DELETE FROM berita WHERE id_berita = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index_admin.php?page=berita");
    exit();
}

$sql = "SELECT * FROM berita";
$result = $conn->query($sql);
?>
<main class="main">
    <!-- Hero Title -->
    <div class="page-title dark-background">
        <!-- <div class="container position-relative">
            <h1>Profil Desa</h1>
            <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        </div> -->
    </div>

    <div class="container mt-5">
        <h1>Daftar Berita</h1>
        <a href="admin/berita/tambah_berita.php" class="btn btn-primary mb-3">Tambah Berita</a>
        <div class="list-group mt-3">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="list-group-item">
                    <a href="admin/berita/berita_detail.php?id_berita=<?= $row['id_berita'] ?>" class="text-decoration-none">
                        <h5 class="mb-1"><?= htmlspecialchars($row['judul']) ?></h5>
                        <img src="admin/uploads/<?= htmlspecialchars($row['gambar']) ?>" class="img-fluid mb-2" style="max-width: 200px;">
                        <p class="mb-1"><?= htmlspecialchars($row['keterangan']) ?></p>
                        <p class="text-muted"><?= htmlspecialchars($row['tanggal']) ?></p>
                    </a>
                    <div class="mt-2">
                        <a href="admin/berita/edit_berita.php?id_berita=<?= $row['id_berita'] ?>" class="btn btn-warning">Edit</a>
                        <a href="index_admin.php?page=berita&hapus=<?= $row['id_berita'] ?>" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</main>
<?php include('footer.html'); ?>
<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>