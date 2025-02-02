<?php
include('../../koneksi.php'); 


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_sejarah = $_GET['id'];


    $query = "SELECT * FROM sejarah WHERE id_sejarah = ?";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        die("Error dalam query: " . $conn->error);
    }

    $stmt->bind_param("i", $id_sejarah);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
    } else {
        die("<h3 style='color:red;'>Data tidak ditemukan! Pastikan ID benar.</h3>");
    }
} else {
    die("<h3 style='color:red;'>ID tidak valid atau tidak ditemukan di URL.</h3>");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Sejarah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2>Detail Sejarah</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Gambar</h5>
                <img src="../../admin/uploads/<?= htmlspecialchars($row['gambar']) ?>" alt="Sejarah" class="img-fluid mb-3" style="max-width: 300px; height: auto;">

                <h5 class="card-title">Keterangan</h5>
                <p class="card-text"><?= nl2br(htmlspecialchars($row['keterangan'])); ?></p>

                <a href="../../index_admin.php?page=sejarah" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</body>
</html>
