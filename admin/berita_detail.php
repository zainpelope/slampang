<?php
include '../koneksi.php';
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id_berita'])) {
    $id_berita = $_GET['id_berita'];

    // Fetch the news details based on id_berita
    $sql = "SELECT * FROM berita WHERE id_berita = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_berita);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Berita tidak ditemukan.";
        exit();
    }
} else {
    echo "ID Berita tidak ditemukan.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1><?= htmlspecialchars($row['judul']) ?></h1>
        <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" class="img-fluid mb-3" style="max-width: 500px;">
        <p><strong>Keterangan:</strong></p>
        <p><?= nl2br(htmlspecialchars($row['keterangan'])) ?></p>
        <p><strong>Tanggal:</strong> <?= htmlspecialchars($row['tanggal']) ?></p>
        <a href="berita.php" class="btn btn-secondary">Kembali ke Berita</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>