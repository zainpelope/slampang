<?php
include '../koneksi.php';

$conn->query("UPDATE kontak SET status = 'dibaca' WHERE status = 'baru'");

$sql = "SELECT * FROM kontak ORDER BY id_kontak DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kotak Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .table th,
        .table td {
            vertical-align: middle;
        }

        .delete-btn {
            color: #fff;
            background-color: #dc3545;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .back-btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container my-5">
        <h1 class="text-center mb-4">Kotak Masuk</h1>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Subjek</th>
                        <th>Pesan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['subjeck']); ?></td>
                            <td><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>
                            <td><?php echo date("d-m-Y H:i:s", strtotime($row['created_at'])); ?></td>
                            <td>
                                <form action="../admin/delete_kontak.php" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
                                    <input type="hidden" name="id_kontak" value="<?php echo $row['id_kontak']; ?>">
                                    <button type="submit" class="delete-btn">Hapus</button>
                                </form>

                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info text-center">Belum ada pesan masuk.</div>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="../index_admin.php?page=masuk" class="back-btn">Kembali ke Halaman Masuk</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-wEmeIV1mKuiNp12sAOF3m27B2QF2xnQL3cbsX7PsGh1S5n0XTsg1BWp3BO5uwsIl" crossorigin="anonymous"></script>
</body>

</html>

<?php
$conn->close();
?>