<?php
include '../../koneksi.php';
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

    unlink("../uploads/" . $gambar);

    $sql = "DELETE FROM galery WHERE id_galery = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: galery.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Galeri</h1>
        <a href="form_tambah_gambar.php" class="btn btn-primary mb-4">Tambah Gambar</a>

        <h2>Daftar Gambar</h2>
        <div class="row mt-3">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-3">
                    <div class="card">
                        <img src="../uploads/<?= $row['gambar'] ?>" class="card-img-top" alt="Gambar">
                        <div class="card-body">
                            <a href="galery.php?hapus=<?= $row['id_galery'] ?>" class="btn btn-danger">Hapus</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>