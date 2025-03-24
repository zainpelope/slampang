<?php
header("Content-Type: application/json");
include '../../koneksi.php';

// Ambil id_pengguna dari request POST
$id_pengguna = isset($_POST['id_pengguna']) ? $_POST['id_pengguna'] : null;

if (!$id_pengguna) {
    echo json_encode(["status" => "error", "message" => "id_pengguna diperlukan"]);
    exit();
}

// Pagination
$batas = isset($_GET['batas']) ? (int)$_GET['batas'] : 5;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

// Filter pencarian
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';
$where = ($cari != '') ? "AND jenis_surat LIKE '%$cari%'" : "";

// Ambil total data
$data = mysqli_query($conn, "SELECT * FROM pengajuan_surat WHERE id_pengguna = '$id_pengguna' $where");
$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

// Ambil data dengan pagination
$query_surat = "SELECT * FROM pengajuan_surat WHERE id_pengguna = '$id_pengguna' $where ORDER BY tanggal_pengajuan DESC LIMIT $halaman_awal, $batas";
$result_surat = $conn->query($query_surat);

$pengajuan_surat = [];
while ($row = $result_surat->fetch_assoc()) {
    $pengajuan_surat[] = [
        "id" => $row['id'],
        "jenis_surat" => $row['jenis_surat'],
        "status" => $row['status'],
        "tanggal_pengajuan" => $row['tanggal_pengajuan'],
        "tanggal_selesai" => $row['tanggal_selesai'] ? $row['tanggal_selesai'] : '-',
        "alasan_penolakan" => ($row['status'] == 'Ditolak' && $row['alasan_penolakan']) ? $row['alasan_penolakan'] : '-'
    ];
}

// Respon JSON
$response = [
    "status" => "success",
    "halaman" => $halaman,
    "total_halaman" => $total_halaman,
    "jumlah_data" => $jumlah_data,
    "pengajuan_surat" => $pengajuan_surat
];

echo json_encode($response);
$conn->close();
