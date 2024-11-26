<?php
// Sertakan koneksi database
include '../koneksi.php';

// Data admin baru
$email = 'admin2@gmail.com';
$password = 'dfdfdfdfdf'; // Password asli

// Simpan password langsung tanpa hashing
$sql = "INSERT INTO admin (email, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);

if ($stmt->execute()) {
    echo "Admin berhasil didaftarkan dengan password asli!";
} else {
    echo "Gagal mendaftarkan admin: " . $conn->error;
}

$stmt->close();
$conn->close();
