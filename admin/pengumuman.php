<?php
include('koneksi.php');

$sql = "SELECT * FROM pengumuman ORDER BY tanggal DESC";
$result = $conn->query($sql);
?>

<main class="main">
    <div class="page-title dark-background">
    </div>
    <div class="container my-5" data-aos="fade-up" data-aos-delay="200">
        <h2>Pengumuman</h2>
        <a href="tambah_pengumuman.php" class="btn btn-success mb-3">Tambah Pengumuman</a>

        <?php
        if ($result->num_rows > 0) {
            echo "<table class='table table-bordered'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>No</th>";
            echo "<th>Judul</th>";
            echo "<th>Keterangan</th>";
            echo "<th>Tanggal</th>";
            // echo "<th>Status</th>";
            echo "<th>Aksi</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $row["judul"] . "</td>";
                echo "<td>" . $row["keterangan"] . "</td>";
                $tanggal = date('d-m-Y', strtotime($row["tanggal"])); 
                echo "<td>" . $tanggal . "</td>";
                // echo "<td>";
                // if ($row["status"] == "aktif") {
                //     echo "<span style='color: green; font-style: italic;'>Aktif</span>";
                // } else {
                //     echo "<span style='color: red; font-style: italic;'>Tidak Aktif</span>";
                // }
                // echo "</td>";

                echo "<td>";
                echo "<a href='detail_pengumuman.php?id=" . $row["id_pengumuman"] . "' class='btn btn-primary btn-sm'>Detail</a> ";
                echo "<a href='edit_pengumuman.php?id=" . $row["id_pengumuman"] . "' class='btn btn-warning btn-sm'>Edit</a> ";
                echo "<a href='hapus_pengumuman.php?id=" . $row["id_pengumuman"] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')\">Hapus</a>";
                echo "</td>";
                echo "</tr>";
                $no++;
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>Tidak ada pengumuman saat ini.</p>";
        }
        ?>
    </div>
</main>

<?php include('footer.html'); ?>
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<div id="preloader"></div>

<?php
$conn->close();
?>