<?php
include '../../koneksi.php';
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

    unlink("../uploads/" . $gambar);

    $sql = "DELETE FROM struktur WHERE id_struktur = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: struktur.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Struktur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Daftar Struktur Organisasi</h1>
        <a href="tambah_struktur.php" class="btn btn-primary mb-3">Tambah Struktur</a>
        <div class="row mt-3">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-3">
                    <div class="card">
                        <img src="../uploads/<?= $row['gambar'] ?>" class="card-img-top" alt="Struktur">
                        <div class="card-body">
                            <p class="card-text"><?= htmlspecialchars($row['nama']) ?> - <?= htmlspecialchars($row['jabatan']) ?></p>
                            <a href="struktur.php?hapus=<?= $row['id_struktur'] ?>" class="btn btn-danger">Hapus</a>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>