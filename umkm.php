<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <title>Daftar UMKM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* CSS tambahan untuk menyesuaikan tampilan (opsional) */
        .features-item {
            border-bottom: 1px solid #eee;
            /* Garis pemisah antar item */
            padding-bottom: 20px;
            /* Spasi bawah antar item */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Daftar UMKM</h1>
        <a href="tambah_umkm.php" class="btn btn-primary">Tambah Data</a><br><br>

        <div class="row">
            <?php
            $sql = "SELECT * FROM umkm_desa";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-lg-7 d-flex flex-column justify-content-center'>"; // Menggunakan kolom Bootstrap
                    echo "<div class='features-item d-flex' data-aos='fade-up' data-aos-delay='200'>"; // Menggunakan class features-item
                    echo "<i class='bi bi-store flex-shrink-0'></i>"; // Ikon UMKM (Anda bisa menggantinya)
                    echo "<div>";
                    echo "<h4>" . $row["title"] . "</h4>";
                    echo "<p>" . $row["keterangan"] . "</p>";
                    echo "</div>";
                    echo "</div>";

                    // Tombol Edit dan Hapus diletakkan di bawah deskripsi
                    echo "<div class='mt-2'>"; // Spasi atas untuk tombol
                    echo "<a href='edit_umkm.php?id=" . $row["id_umkm"] . "' class='btn btn-warning btn-sm'>Edit</a> | "; // Tombol Edit dengan warna kuning
                    echo "<a href='hapus_umkm.php?id=" . $row["id_umkm"] . "' class='btn btn-danger btn-sm'>Hapus</a>"; // Tombol Hapus dengan warna merah
                    echo "</div>";

                    echo "</div>"; // Penutup div col-lg-7
                }
            } else {
                echo "<div class='col-lg-12'><p>Tidak ada data UMKM.</p></div>"; // Pesan jika tidak ada data
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>