<?php
include 'koneksi.php';

// Ambil id_umkm dari URL
if (isset($_GET['id'])) {
    $id_umkm = $_GET['id'];

    // Ambil data UMKM berdasarkan id_umkm
    $sql = "SELECT * FROM umkm_desa WHERE id_umkm = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_umkm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $keterangan = $row['keterangan'];
    } else {
        echo "Data UMKM tidak ditemukan.";
        exit;
    }

    $stmt->close();
} else {
    echo "id_umkm tidak valid.";
    exit;
}

// Proses update data jika form di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $keterangan = $_POST['keterangan'];

    // Validasi data (sama seperti pada tambah_umkm.php)
    if (empty($title)) {
        echo "Judul tidak boleh kosong.";
    } elseif (empty($keterangan)) {
        echo "Keterangan tidak boleh kosong.";
    } else {
        // Gunakan prepared statement untuk mencegah SQL injection
        $sql = "UPDATE umkm_desa SET title = ?, keterangan = ? WHERE id_umkm = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $title, $keterangan, $id_umkm);

        if ($stmt->execute()) {
            header("Location: umkm.php");
            exit;
        } else {
            error_log("Error saat mengupdate data UMKM: " . $stmt->error);
            echo "Terjadi kesalahan saat mengupdate data. Silakan coba lagi nanti.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Data UMKM</title>
</head>

<body>
    <h1>Edit Data UMKM</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id_umkm; ?>">
        Judul: <input type="text" name="title" value="<?php echo $title; ?>" required><br>
        Keterangan: <textarea name="keterangan" required><?php echo $keterangan; ?></textarea><br>
        <input type="submit" value="Simpan">
    </form>
</body>

</html>