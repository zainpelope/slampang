<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .container {
            text-align: center;
        }

        .btn {
            margin: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mb-4">Selamat Datang di Halaman Utama</h1>
        <p class="lead">Pilih peran Anda untuk melanjutkan:</p>
        <div class="d-flex justify-content-center">

            <a href="login.php" class="btn btn-success">Warga</a>
            <a href="admin/login.php" class="btn btn-danger">Admin</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>