<?php
include '../koneksi.php';
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $keterangan = $_POST['keterangan'];
    $tanggal = $_POST['tanggal'];

    $image = $_FILES['gambar'];
    $imageName = time() . "_" . basename($image['name']);
    $targetDirectory = 'uploads/';
    $targetFile = $targetDirectory . $imageName;

    if (getimagesize($image['tmp_name']) === false) {
        echo "File is not an image.";
        exit();
    }

    if (move_uploaded_file($image['tmp_name'], $targetFile)) {
        $sql = "INSERT INTO berita (gambar, judul, keterangan, tanggal) 
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ssss", $imageName, $judul, $keterangan, $tanggal);

        if ($stmt->execute()) {
            echo "Berita berhasil ditambahkan!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Failed to upload image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Tambah Berita</h1>
        <form action="berita.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" class="form-control" name="gambar" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Berita</label>
                <input type="text" class="form-control" name="judul" required>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" name="keterangan" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" name="tanggal" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Berita</button>
        </form>

        <h2 class="mt-4">Daftar Berita</h2>
        <div class="list-group mt-3">
            <?php
            $sql = "SELECT * FROM berita";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
            ?>
                <a href="berita_detail.php?id_berita=<?= $row['id_berita'] ?>" class="list-group-item list-group-item-action">
                    <h5 class="mb-1"><?= htmlspecialchars($row['judul']) ?></h5>
                    <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" class="img-fluid mb-2" style="max-width: 200px;">
                    <p class="mb-1"><?= htmlspecialchars($row['keterangan']) ?></p>
                    <p class="text-muted"><?= htmlspecialchars($row['tanggal']) ?></p>
                    <a href="berita.php?hapus=<?= $row['id_berita'] ?>" class="btn btn-danger">Hapus</a>
                </a>

            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>