<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Warga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            flex-grow: 1;
            padding: 15px;
            /* Mengurangi padding */
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            /* Mengurangi padding */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 15px;
            /* Mengurangi margin-top */
        }

        .form-label {
            font-weight: bold;
            margin-bottom: 5px;
            /* Mengurangi margin-bottom label */
        }

        .mb-3 {
            margin-bottom: 10px !important;
            /* Mengurangi margin-bottom input group */
        }

        .btn-container {
            margin-top: 15px;
            /* Mengurangi margin-top tombol */
            text-align: center;
        }

        .btn-full {
            width: 100%;
            margin-bottom: 8px;
            /* Mengurangi margin-bottom tombol */
            padding: 8px 12px;
            /* Mengecilkan padding tombol */
            font-size: 0.9rem;
            /* Mengecilkan ukuran font tombol */
        }

        .alert-danger {
            margin-top: 8px;
            /* Mengurangi margin-top alert */
            padding: 8px;
            /* Mengecilkan padding alert */
            font-size: 0.9rem;
            /* Mengecilkan ukuran font alert */
        }

        h2 {
            font-size: 1.5rem;
            /* Mengecilkan ukuran font judul */
            margin-bottom: 1.5rem;
            /* Mengurangi margin-bottom judul */
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center mb-4">Tambah Warga</h2>
        <div class="form-container">
            <form action="" method="post">
                <div class="mb-3">
                    <label class="form-label">Nama:</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">NIK:</label>
                    <input type="text" name="nik" class="form-control" required minlength="16" maxlength="16" onkeypress="return hanyaAngka(event)">
                    <small class="text-danger" id="nik-error"></small>
                    <?php
                    if (isset($_GET['nik_exist']) && $_GET['nik_exist'] == 'true') {
                        echo '<div class="alert alert-danger">NIK sudah terdaftar.</div>';
                    }
                    ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir:</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo $tanggal_sekarang; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat:</label>
                    <textarea name="alamat" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">No HP:</label>
                    <input type="text" name="no_hp" class="form-control" required onkeypress="return hanyaAngka(event)">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control">
                    <?php
                    if (isset($_GET['email_exist']) && $_GET['email_exist'] == 'true') {
                        echo '<div class="alert alert-danger">Email sudah terdaftar.</div>';
                    }
                    ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="btn-container">
                    <button type="submit" class="btn btn-success btn-full">Simpan</button>
                    <a href="index_admin.php?page=warga" class="btn btn-secondary btn-full">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        document.querySelector('form').addEventListener('submit', function(event) {
            const nikInput = document.querySelector('input[name="nik"]');
            const nikValue = nikInput.value;
            const nikError = document.getElementById('nik-error');

            if (nikValue.length !== 16 || !/^\d+$/.test(nikValue)) {
                nikError.textContent = 'NIK harus terdiri dari 16 digit angka.';
                event.preventDefault();
            } else {
                nikError.textContent = '';
            }
        });
    </script>
</body>

</html>