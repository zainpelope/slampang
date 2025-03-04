<?php
include 'koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nik = $_POST['nik'];
    $tanggal_lahir = $_POST['tanggal_lahir'];

    // Validasi NIK: Harus angka dan 16 digit
    if (!preg_match("/^[0-9]{16}$/", $nik)) {
        echo "<script>alert('NIK harus terdiri dari 16 angka!');</script>";
    } else {
        // Format tanggal lahir ke YYYY-MM-DD
        $tanggal_lahir = date('Y-m-d', strtotime($tanggal_lahir));

        // Cek NIK dan Tanggal Lahir di database
        $query = "SELECT * FROM pengguna WHERE nik='$nik' AND tanggal_lahir='$tanggal_lahir'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['id_pengguna'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = 'warga';

            header("Location: index.php?page=home");
            exit();
        } else {
            echo "<script>alert('NIK atau Tanggal Lahir salah!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .login-container {
            width: 400px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .btn-primary {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2 class="text-center mb-4">Login</h2>
        <form method="POST" onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="nik" class="form-label">NIK:</label>
                <input type="text" name="nik" id="nik" class="form-control" required maxlength="16">
                <small class="text-danger" id="nikError"></small>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">Login</button>
                <a href="slampang.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>

    <script>
        function validateForm() {
            let nik = document.getElementById('nik').value;
            let nikError = document.getElementById('nikError');

            if (!/^\d{16}$/.test(nik)) {
                nikError.innerText = "NIK harus terdiri dari 16 angka!";
                return false;
            } else {
                nikError.innerText = "";
                return true;
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>