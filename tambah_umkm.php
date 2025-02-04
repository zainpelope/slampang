<?php
include 'koneksi.php';

// Proses tambah data jika form di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $keterangan = $_POST['keterangan'];

    $sql = "INSERT INTO umkm_desa (title, keterangan) VALUES ('$title', '$keterangan')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index_admin.php?admin=home_admin"); // Redirect ke halaman utama setelah data ditambahkan
        exit; // Penting untuk menghentikan eksekusi skrip setelah redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tambah Data UMKM</title>
</head>

<body>
    <h1>Tambah Data UMKM</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Judul: <input type="text" name="title" required><br>
        Keterangan: <textarea name="keterangan" required></textarea><br>
        <input type="submit" value="Simpan">
    </form>
</body>

</html>