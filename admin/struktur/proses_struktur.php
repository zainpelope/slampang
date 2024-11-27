<?php
include '../../koneksi.php';
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["gambar"])) {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $gambar = $_FILES["gambar"]["name"];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($gambar);

    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO struktur (nama, jabatan, gambar) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nama, $jabatan, $gambar);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: struktur.php");
    exit();
}
