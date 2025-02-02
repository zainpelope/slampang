<?php
include '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $keterangan = $_POST['keterangan'];

 
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name']; 
        $gambar_tmp = $_FILES['gambar']['tmp_name']; 

       
        $upload_dir = '../../admin/uploads/'; 
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0775, true);
        }

      
        $gambar_path = $upload_dir . basename($gambar);

     
        if (move_uploaded_file($gambar_tmp, $gambar_path)) {
      
            $query = "INSERT INTO sejarah (gambar, keterangan) VALUES ('$gambar', '$keterangan')";
            if ($conn->query($query)) {
                echo "Data berhasil ditambahkan!";
                header("Location: ../../index_admin.php?page=sejarah"); 
                exit;
            } else {
                echo "Terjadi kesalahan: " . $conn->error;
            }
        } else {
            echo "Gagal mengunggah gambar. Pastikan folder 'admin/uploads/' memiliki izin tulis.";
        }
    } else {
        echo "Harap pilih gambar untuk diunggah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sejarah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2>Tambah Sejarah</h2>
        <form action="tambah_sejarah.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>
