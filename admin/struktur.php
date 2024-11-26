<?php
include '../koneksi.php';
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

// Tambah struktur
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["gambar"])) {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $gambar = $_FILES["gambar"]["name"];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($gambar);

    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO struktur (nama, jabatan, gambar) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nama, $jabatan, $gambar);
        $stmt->execute();
        $stmt->close();
    }
}

// Ambil data struktur
$sql = "SELECT * FROM struktur";
$result = $conn->query($sql);

// Hapus Struktur
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $sql = "SELECT gambar FROM struktur WHERE id_struktur = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($gambar);
    $stmt->fetch();
    $stmt->close();

    unlink("uploads/" . $gambar);

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
    <title>Struktur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Struktur Organisasi</h1>

        <!-- Form Tambah Struktur -->
        <form action="struktur.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <input type="text" class="form-control" name="jabatan" required>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Upload Gambar</label>
                <input type="file" class="form-control" name="gambar" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Struktur</button>
        </form>

        <h2 class="mt-4">Daftar Struktur</h2>
        <div class="row mt-3">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-3">
                    <div class="card">
                        <img src="uploads/<?= $row['gambar'] ?>" class="card-img-top" alt="Struktur">
                        <div class="card-body">
                            <p class="card-text"><?= htmlspecialchars($row['nama']) ?> - <?= htmlspecialchars($row['jabatan']) ?></p>
                            <a href="struktur.php?hapus=<?= $row['id_struktur'] ?>" class="btn btn-danger">Hapus</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>