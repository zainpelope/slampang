<?php
// Sertakan koneksi ke database
include '../koneksi.php';
session_start();

// Cek login
if (!isset($_SESSION['id_admin'])) {
    header("Location: ../coba/login.php");
    exit();
}

// Handle upload gambar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["gambar"])) {
    $gambar = $_FILES["gambar"]["name"];
    $target_dir = "uploads/"; // Folder tempat gambar diupload
    $target_file = $target_dir . basename($gambar);

    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO galery (gambar) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $gambar);
        $stmt->execute();
        $stmt->close();
    }
}

// Ambil data gambar dari database
$sql = "SELECT * FROM galery";
$result = $conn->query($sql);

// Proses Hapus Gambar
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $sql = "SELECT gambar FROM galery WHERE id_galery = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($gambar);
    $stmt->fetch();
    $stmt->close();

    // Hapus file gambar dari server
    unlink("uploads/" . $gambar);

    // Hapus dari database
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

        <!-- Form Upload Gambar -->
        <form action="galery.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="gambar" class="form-label">Upload Gambar</label>
                <input type="file" class="form-control" name="gambar" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Gambar</button>
        </form>

        <h2 class="mt-4">Daftar Gambar</h2>
        <div class="row mt-3">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-3">
                    <div class="card">
                        <img src="uploads/<?= $row['gambar'] ?>" class="card-img-top" alt="Gambar">
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