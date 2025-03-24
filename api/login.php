<?php
header("Content-Type: application/json");
require_once "../koneksi.php"; // Pastikan file koneksi database sudah benar

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Cek apakah NIK dan Tanggal Lahir dikirim
    $nik = isset($_POST['nik']) ? trim($_POST['nik']) : '';
    $tanggal_lahir = isset($_POST['tanggal_lahir']) ? trim($_POST['tanggal_lahir']) : '';

    if (empty($nik) || empty($tanggal_lahir)) {
        $response = [
            "status" => "error",
            "message" => "NIK dan Tanggal Lahir wajib diisi!"
        ];
        echo json_encode($response);
        exit();
    }

    // Konversi tanggal ke format yang sesuai (YYYY-MM-DD)
    $tanggal_lahir = date('Y-m-d', strtotime($tanggal_lahir));

    // Debugging: Cek data yang diterima
    error_log("NIK: " . $nik);
    error_log("Tanggal Lahir: " . $tanggal_lahir);

    // Query untuk mencari user berdasarkan NIK dan Tanggal Lahir
    $query = "SELECT * FROM pengguna WHERE nik = ? AND tanggal_lahir = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $nik, $tanggal_lahir);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $response = [
            "status" => "success",
            "message" => "Login berhasil",
            "data" => [
                "id" => $user['id'],
                "nama" => $user['nama'],
                "nik" => $user['nik'],
                "tanggal_lahir" => $user['tanggal_lahir']
            ]
        ];
    } else {
        $response = [
            "status" => "error",
            "message" => "NIK atau Tanggal Lahir salah!"
        ];
    }
    echo json_encode($response);
} else {
    $response = [
        "status" => "error",
        "message" => "Metode tidak diperbolehkan!"
    ];
    echo json_encode($response);
}
