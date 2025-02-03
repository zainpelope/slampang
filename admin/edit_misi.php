<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT isi FROM misi WHERE id = '$id'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $misi = $row['isi'];
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak valid.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $misi_baru = $_POST['misi'];
    $query = "UPDATE misi SET isi = '$misi_baru' WHERE id = '$id'";
    if ($conn->query($query)) {
        echo "<script>alert('Misi berhasil diupdate!'); window.location.href='../index_admin.php?page=visi-misi';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Misi</title>
</head>
<body>
    <h1>Edit Misi</h1>
    <form method="POST">
        <textarea name="misi"><?php echo $misi; ?></textarea><br>
        <button type="submit">Simpan</button>
        <a href="../index_admin.php?page=visi-misi">Kembali</a>
    </form>
</body>
</html>