<?php
include 'koneksi.php';
session_start();

$sql = "SELECT * FROM galery";
$result = $conn->query($sql);

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $sql = "SELECT gambar FROM galery WHERE id_galery = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($gambar);
    $stmt->fetch();
    $stmt->close();

    unlink("admin/uploads/" . $gambar);

    $sql = "DELETE FROM galery WHERE id_galery = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index_admin.php?page=galery");
    exit();
}
?>
<main class="main">
    <!-- Hero Title -->
    <div class="page-title dark-background text-center py-5 text-white">

    </div>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Daftar Gambar</h2>
            <a href="admin/galery/form_tambah_gambar.php" class="btn btn-primary">Tambah Gambar</a>
        </div>

        <div class="row g-4">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="ratio ratio-1x1">
                            <img src="admin/uploads/<?= $row['gambar'] ?>" class="card-img-top" alt="Gambar" style="object-fit: cover;">
                        </div>
                        <div class="card-body text-center">
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $row['id_galery'] ?>)">Hapus</button>
                        </div>

                        <script>
                            function confirmDelete(id) {

                                const userConfirmed = confirm("Apakah Anda yakin ingin menghapus gambar ini?");
                                if (userConfirmed) {

                                    window.location.href = `index_admin.php?page=galery&hapus=${id}`;
                                } else {

                                    return;
                                }
                            }
                        </script>

                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</main>
<br><br><br>

<?php include('footer.html'); ?>
<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>