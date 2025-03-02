<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_pengajuan = $_GET['id'];

    // Update status menjadi 'Siap Diambil'
    $query = "UPDATE pengajuan_surat SET status = 'Siap Diambil' WHERE id = $id_pengajuan";

    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Surat siap diambil!'); window.location.href='index_admin.php?page=layanan_publik';</script>";
    } else {
        echo "Gagal memperbarui status: " . $conn->error;
    }
} else {
    echo "ID tidak ditemukan!";
}
