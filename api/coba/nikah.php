<?php
include './koneksi.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['id_pengguna'])) {
    echo json_encode(["status" => "error", "message" => "Harap login terlebih dahulu!"]);
    exit();
}

$id_pengguna = $_SESSION['id_pengguna'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ... (ambil data dari $_POST dan $_FILES) ...

    $query_pengajuan = "INSERT INTO pengajuan_surat (id_pengguna, jenis_surat, status) VALUES ('$id_pengguna', 'Belum Menikah', 'Menunggu Verifikasi')";
    if (mysqli_query($conn, $query_pengajuan)) {
        $id_pengajuan = mysqli_insert_id($conn);

        $query_detail = "INSERT INTO detail_surat (id_pengajuan, nama_lengkap, tempat_lahir, tanggal_lahir, nik, alamat, agama, pekerjaan, keperluan, status_pernikahan, file_pendukung) VALUES ('$id_pengajuan', '$nama_lengkap', '$tempat_lahir', '$tanggal_lahir', '$nik', '$alamat', '$agama', '$pekerjaan', '$keperluan', '$status_pernikahan', '$target_file')";
        mysqli_query($conn, $query_detail);

        echo json_encode(["status" => "success", "message" => "Pengajuan surat Belum Menikah berhasil!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Terjadi kesalahan, coba lagi!"]);
    }
}
