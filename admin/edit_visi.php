<?php
include('../koneksi.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT isi FROM visi WHERE id = '$id'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $visi = $row['isi'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $visi_baru = $_POST['visi'];
    $query = "UPDATE visi SET isi = '$visi_baru' WHERE id = '$id'";
    if ($conn->query($query)) {
        echo "<script>alert('Visi berhasil diupdate!'); window.location.href='../index_admin.php?page=visi-misi';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate visi.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Visi</title>
    </head>
<body>
    <div class="container">
        <h1>Edit Visi</h1>
        <form method="POST">
            <div class="form-group">
                <label for="visi">Visi:</label>
                <textarea class="form-control" id="visi" name="visi" rows="5" required><?php echo $visi; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="../index_admin.php?page=visi-misi" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>