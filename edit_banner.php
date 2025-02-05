<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data banner sebelum di-edit
    $sql = "SELECT * FROM banner WHERE id_banner=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $gambar_lama = $row['gambar']; // Simpan nama gambar lama
    } else {
        echo "Data banner tidak ditemukan.";
        exit();
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $judul = $_POST['judul'];
        $keterangan = $_POST['keterangan'];

        // Proses upload gambar (jika ada gambar baru)
        if (isset($_FILES["gambar"]) && $_FILES["gambar"]["error"] == 0) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Validasi file (mirip dengan tambah_banner.php)
            $check = getimagesize($_FILES["gambar"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File bukan gambar.";
                $uploadOk = 0;
            }

            if ($_FILES["gambar"]["size"] > 500000) {
                echo "Ukuran file terlalu besar.";
                $uploadOk = 0;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Hanya file JPG, PNG, JPEG, dan GIF yang diizinkan.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "Maaf, file tidak berhasil diupload.";
            } else {
                if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                    $gambar = $target_file;

                    // Hapus gambar lama jika ada dan gambar baru berhasil diupload
                    if (!empty($gambar_lama) && file_exists($gambar_lama)) {
                        unlink($gambar_lama);
                    }
                } else {
                    echo "Maaf, terjadi kesalahan saat mengupload file.";
                    $gambar = $gambar_lama; // Gunakan gambar lama jika upload gagal
                }
            }
        } else {
            $gambar = $gambar_lama; // Gunakan gambar lama jika tidak ada gambar baru yang diupload
        }



        $sql = "UPDATE banner SET gambar='$gambar', judul='$judul', keterangan='$keterangan' WHERE id_banner=$id";

        if ($conn->query($sql) === TRUE) {
            header("Location: index_admin.php?admin=home_admin"); // Ganti dengan nama file daftar banner Anda
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    echo "ID banner tidak valid.";
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Banner</title>
</head>

<body>
    <h1>Edit Banner</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id; ?>" enctype="multipart/form-data">
        Gambar: <input type="file" name="gambar"><br><br> Judul: <input type="text" name="judul" value="<?php echo $row['judul']; ?>" required><br><br>
        Keterangan: <textarea name="keterangan"><?php echo $row['keterangan']; ?></textarea><br><br>
        <input type="submit" value="Simpan">
    </form>
</body>

</html>