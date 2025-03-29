<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pengguna = $_POST['id_pengguna'] ?? '';
    $nama_lengkap = $_POST['nama_lengkap'] ?? '';
    $tempat_lahir = $_POST['tempat_lahir'] ?? '';
    $tanggal_lahir = $_POST['tanggal_lahir'] ?? '';
    $nik = $_POST['nik'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $agama = $_POST['agama'] ?? '';
    $pekerjaan = $_POST['pekerjaan'] ?? '';
    $keperluan = $_POST['keperluan'] ?? '';


    error_log("Data diterima: " . json_encode($_POST));

    if (isset($_FILES["file_pendukung"])) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["file_pendukung"]["name"]);
        if (move_uploaded_file($_FILES["file_pendukung"]["tmp_name"], $target_file)) {

            error_log("File berhasil diunggah: " . $target_file);
        } else {
            $target_file = "";
            error_log("Gagal mengunggah file.");
        }
    } else {
        $target_file = "";
        error_log("Tidak ada file yang diunggah.");
    }

    $query_pengajuan = "INSERT INTO pengajuan_surat (id_pengguna, jenis_surat, status) VALUES ('$id_pengguna', 'Domisili', 'Menunggu Verifikasi')";
    if (mysqli_query($conn, $query_pengajuan)) {
        $id_pengajuan = mysqli_insert_id($conn);

        $query_detail = "INSERT INTO detail_surat (id_pengajuan, nama_lengkap, tempat_lahir, tanggal_lahir, nik, alamat, agama, pekerjaan, keperluan, file_pendukung) VALUES ('$id_pengajuan', '$nama_lengkap', '$tempat_lahir', '$tanggal_lahir', '$nik', '$alamat', '$agama', '$pekerjaan', '$keperluan', '$target_file')";
        if (mysqli_query($conn, $query_detail)) {
            echo json_encode(["status" => "success", "message" => "Pengajuan surat domisili berhasil!"]);
        } else {
            $error_message = "Terjadi kesalahan saat menyimpan detail surat: " . mysqli_error($conn);
            error_log("Error detail_surat: " . $error_message);
            echo json_encode(["status" => "error", "message" => $error_message]);
        }
    } else {
        $error_message = "Terjadi kesalahan saat menyimpan pengajuan surat: " . mysqli_error($conn);
        error_log("Error pengajuan_surat: " . $error_message);
        echo json_encode(["status" => "error", "message" => $error_message]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode request tidak valid."]);
}
