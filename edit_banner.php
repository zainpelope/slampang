<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $sql = "SELECT * FROM banner WHERE id_banner=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $gambar_lama = $row['gambar'];
    } else {
        echo "Data banner tidak ditemukan.";
        exit();
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $judul = $_POST['judul'];
        $keterangan = $_POST['keterangan'];


        if (isset($_FILES["gambar"]) && $_FILES["gambar"]["error"] == 0) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


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


                    if (!empty($gambar_lama) && file_exists($gambar_lama)) {
                        unlink($gambar_lama);
                    }
                } else {
                    echo "Maaf, terjadi kesalahan saat mengupload file.";
                    $gambar = $gambar_lama;
                }
            }
        } else {
            $gambar = $gambar_lama;
        }



        $sql = "UPDATE banner SET gambar='$gambar', judul='$judul', keterangan='$keterangan' WHERE id_banner=$id";

        if ($conn->query($sql) === TRUE) {
            header("Location: index_admin.php?admin=home_admin");
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
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Banner</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 500px;
            margin: 20px auto;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        textarea {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            height: 120px;
        }

        input[type="file"] {
            margin-bottom: 10px;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .button-container a,
        input[type="submit"] {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            text-align: center;
            box-sizing: border-box;
        }

        .button-container a {
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            margin-top: 10px;
        }

        .button-container a:hover {
            background-color: #c12a36;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Edit Banner</h1>
        <?php if (isset($error)) : ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id; ?>" enctype="multipart/form-data">
            <label for="gambar">Gambar:</label>
            <input type="file" name="gambar" id="gambar"><br><br>

            <label for="judul">Judul:</label>
            <input type="text" name="judul" id="judul" value="<?php echo $row['judul']; ?>" required><br><br>

            <label for="keterangan">Keterangan:</label>
            <textarea name="keterangan" id="keterangan"><?php echo $row['keterangan']; ?></textarea><br><br>

            <div class="button-container">
                <input type="submit" value="Simpan">
                <a href="index_admin.php?admin=home_admin">Kembali</a>
            </div>
        </form>
    </div>
</body>

</html>