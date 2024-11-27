<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM struktur
        ORDER BY 
          CASE WHEN jabatan = 'Kepala Desa' THEN 1 ELSE 2 END, 
          nama ASC";
$result = $conn->query($sql);

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $sql = "SELECT gambar FROM struktur WHERE id_struktur = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($gambar);
    $stmt->fetch();
    $stmt->close();

    unlink("admin/uploads/" . $gambar);

    $sql = "DELETE FROM struktur WHERE id_struktur = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index_admin.php?page=struktur");
    exit();
}
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
        <h1>Daftar Struktur Organisasi</h1>
        <a href="admin/struktur/tambah_struktur.php" class="btn btn-primary mb-3">Tambah Struktur</a>
        <div class="row mt-3">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-3">
                    <div class="card">
                        <img src="admin/uploads/<?= $row['gambar'] ?>" class="card-img-top" alt="Struktur">
                        <div class="card-body">
                            <p class="card-text"><?= htmlspecialchars($row['nama']) ?> - <?= htmlspecialchars($row['jabatan']) ?></p>
                            <a href="index_admin.php?page=struktur&hapus=<?= $row['id_struktur'] ?>" class="btn btn-danger">Hapus</a>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>
<?php include('footer.html'); ?>
<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>