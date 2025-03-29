<?php
header("Content-Type: application/json");
include '../koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['id_pengguna'])) {
        echo json_encode(["status" => "error", "message" => "Harap login terlebih dahulu!"]);
        exit();
    }

    $id_pengguna = $_SESSION['id_pengguna'];
    $nama_lengkap = $_POST['nama_lengkap'] ?? '';
    $tempat_lahir = $_POST['tempat_lahir'] ?? '';
    $tanggal_lahir = $_POST['tanggal_lahir'] ?? '';
    $nik = $_POST['nik'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $agama = $_POST['agama'] ?? '';
    $pekerjaan = $_POST['pekerjaan'] ?? '';
    $keperluan = $_POST['keperluan'] ?? '';

    if (isset($_FILES["file_pendukung"])) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["file_pendukung"]["name"]);
        move_uploaded_file($_FILES["file_pendukung"]["tmp_name"], $target_file);
    } else {
        $target_file = "";
    }

    $query_pengajuan = "INSERT INTO pengajuan_surat (id_pengguna, jenis_surat, status) VALUES ('$id_pengguna', 'Domisili', 'Menunggu Verifikasi')";
    if (mysqli_query($conn, $query_pengajuan)) {
        $id_pengajuan = mysqli_insert_id($conn);

        $query_detail = "INSERT INTO detail_surat (id_pengajuan, nama_lengkap, tempat_lahir, tanggal_lahir, nik, alamat, agama, pekerjaan, keperluan, file_pendukung) VALUES ('$id_pengajuan', '$nama_lengkap', '$tempat_lahir', '$tanggal_lahir', '$nik', '$alamat', '$agama', '$pekerjaan', '$keperluan', '$target_file')";
        if (mysqli_query($conn, $query_detail)) {
            echo json_encode(["status" => "success", "message" => "Pengajuan surat domisili berhasil!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Terjadi kesalahan saat menyimpan detail surat."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Terjadi kesalahan saat menyimpan pengajuan surat."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode request tidak valid."]);
}
