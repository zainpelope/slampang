<?php
include '../../koneksi.php';
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id_berita'])) {
    echo "Berita tidak ditemukan!";
    exit();
}

$id_berita = $_GET['id_berita'];

$sql = "SELECT * FROM berita WHERE id_berita = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_berita);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Berita tidak ditemukan!";
    exit();
}

$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $keterangan = $_POST['keterangan'];
    $tanggal = $_POST['tanggal'];
    $gambarLama = $row['gambar'];
    if ($_FILES['gambar']['name']) {
        $image = $_FILES['gambar'];
        $imageName = time() . "_" . basename($image['name']);
        $targetDirectory = '../uploads/';
        $targetFile = $targetDirectory . $imageName;

        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
            unlink("../uploads/" . $gambarLama);
            $gambarLama = $imageName;
        } else {
            echo "Gagal mengunggah gambar!";
            exit();
        }
    }
    $sql = "UPDATE berita SET judul = ?, keterangan = ?, tanggal = ?, gambar = ? WHERE id_berita = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $judul, $keterangan, $tanggal, $gambarLama, $id_berita);

    if ($stmt->execute()) {
        header("Location: ../../index_admin.php?page=berita");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Edit Berita</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Berita</label>
                <input type="text" class="form-control" name="judul" value="<?= htmlspecialchars($row['judul']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" name="keterangan" rows="5" required><?= htmlspecialchars($row['keterangan']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" name="tanggal" value="<?= htmlspecialchars($row['tanggal']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" class="form-control" name="gambar" accept="image/*">
                <img src="../uploads/<?= htmlspecialchars($row['gambar']) ?>" class="img-fluid mt-2" style="max-width: 200px;">
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="../../index_admin.php?page=berita" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>