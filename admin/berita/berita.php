<?php
include '../../koneksi.php';
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

    unlink("../uploads/" . $gambar);

    $sql = "DELETE FROM berita WHERE id_berita = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: berita.php");
    exit();
}

$sql = "SELECT * FROM berita";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Daftar Berita</h1>
        <a href="tambah_berita.php" class="btn btn-primary mb-3">Tambah Berita</a>
        <div class="list-group mt-3">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="list-group-item">
                    <a href="berita_detail.php?id_berita=<?= $row['id_berita'] ?>" class="text-decoration-none">
                        <h5 class="mb-1"><?= htmlspecialchars($row['judul']) ?></h5>
                        <img src="../uploads/<?= htmlspecialchars($row['gambar']) ?>" class="img-fluid mb-2" style="max-width: 200px;">
                        <p class="mb-1"><?= htmlspecialchars($row['keterangan']) ?></p>
                        <p class="text-muted"><?= htmlspecialchars($row['tanggal']) ?></p>
                    </a>
                    <div class="mt-2">
                        <a href="edit_berita.php?id_berita=<?= $row['id_berita'] ?>" class="btn btn-warning">Edit</a>
                        <a href="berita.php?hapus=<?= $row['id_berita'] ?>" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>