<?php
include '../koneksi.php';

// Memastikan ID berita ada dalam query string dan ID tersebut valid
if (isset($_GET['id']) && is_numeric($_GET['id']) && !empty($_GET['id'])) {
    // Mengambil ID dari query string
    $id = $_GET['id'];

    // Query untuk mengambil data berita berdasarkan ID
    $sql = "SELECT * FROM berita WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // Mengikat parameter ID
    $stmt->execute();
    $result = $stmt->get_result();

    // Mengecek apakah berita ditemukan
    if ($result->num_rows > 0) {
        // Menampilkan data berita
        $row = $result->fetch_assoc();
    } else {
        // Jika berita tidak ditemukan
        echo "Berita tidak ditemukan.";
        exit;
    }
} else {
    // Jika ID tidak ada atau tidak valid
    echo "ID berita tidak valid.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h2 class="mb-3"><?= htmlspecialchars($row['judul']) ?></h2>
        <p class="text-muted"><?= htmlspecialchars($row['tanggal']) ?></p>
        <img src="admin/uploads/<?= htmlspecialchars($row['gambar']) ?>" class="img-fluid mb-3" alt="Gambar Berita">
        <div class="content">
            <p><?= nl2br(htmlspecialchars($row['keterangan'])) ?></p>
        </div>
        <a href="berita.php" class="btn btn-primary">Kembali ke Berita</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>