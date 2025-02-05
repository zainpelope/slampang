<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "uploads/"; // Direktori tempat Anda akan menyimpan gambar
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi file
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    // Cek ukuran file
    if ($_FILES["gambar"]["size"] > 500000) {
        echo "Ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    // Hanya izinkan tipe file tertentu
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Hanya file JPG, PNG, JPEG, dan GIF yang diizinkan.";
        $uploadOk = 0;
    }

    // Cek jika ada error saat upload
    if ($uploadOk == 0) {
        echo "Maaf, file tidak berhasil diupload.";
    } else {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $gambar = $target_file; // Simpan nama file gambar ke database
            $judul = $_POST['judul'];
            $keterangan = $_POST['keterangan'];

            $sql = "INSERT INTO banner (gambar, judul, keterangan) VALUES ('$gambar', '$judul', '$keterangan')";

            if ($conn->query($sql) === TRUE) {
                header("Location: index_admin.php?admin=home_admin");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengupload file.";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tambah Banner</title>
</head>

<body>
    <h1>Tambah Banner</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        Gambar: <input type="file" name="gambar" required><br><br> Judul: <input type="text" name="judul" required><br><br>
        Keterangan: <textarea name="keterangan"></textarea><br><br>
        <input type="submit" value="Simpan">
    </form>
</body>

</html>