<?php
include '../../koneksi.php';


if (isset($_GET['id'])) {
    $id_sejarah = $_GET['id'];

    $query = "SELECT * FROM sejarah WHERE id_sejarah = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_sejarah);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href='../../index_admin.php?page=sejarah';</script>";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $keterangan = $_POST['keterangan'];
    $gambar_lama = $_POST['gambar_lama']; 


    if ($_FILES['gambar']['name']) {
        $gambar_baru = $_FILES['gambar']['name'];
        $gambar_tmp = $_FILES['gambar']['tmp_name'];
        $upload_dir = "../../admin/uploads/";

      
        if (!empty($gambar_lama) && file_exists($upload_dir . $gambar_lama)) {
            unlink($upload_dir . $gambar_lama);
        }

        
        move_uploaded_file($gambar_tmp, $upload_dir . $gambar_baru);
    } else {
        $gambar_baru = $gambar_lama;
    }


    $update_query = "UPDATE sejarah SET gambar = ?, keterangan = ? WHERE id_sejarah = ?";
    $stmt_update = $conn->prepare($update_query);
    $stmt_update->bind_param("ssi", $gambar_baru, $keterangan, $id_sejarah);

    if ($stmt_update->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='../../index_admin.php?page=sejarah';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data!'); window.history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sejarah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2>Edit Sejarah</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label><br>
                <img src="../../admin/uploads/<?= htmlspecialchars($row['gambar']) ?>" alt="Sejarah" style="width: 150px; height: 150px; object-fit: cover;"><br>
                <input type="file" class="form-control mt-2" id="gambar" name="gambar">
                <input type="hidden" name="gambar_lama" value="<?= $row['gambar'] ?>">
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="5" required><?= htmlspecialchars($row['keterangan']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="../../index_admin.php?page=sejarah" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
