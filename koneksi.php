<?php
// Konfigurasi database
$host = "localhost"; // Host database
$username = "root";  // Username MySQL
$password = "root";      // Password MySQL
$database = "desa";  // Nama database

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
