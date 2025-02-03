<?php
include 'koneksi.php';

$sql = "SELECT * FROM kegiatan";
$result = $conn->query($sql);
?>

<main class="main">
    <div class="page-title dark-background"></div>
    <div class="container my-5" data-aos="fade-up" data-aos-delay="200">
        <section id="visimisi" class="vision-mission mt-5">
            <h1>Kegiatan</h1>

            <a href="tambah.php" class="btn btn-success mb-3">Tambah Kegiatan</a>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama Kegiatan</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Tanggal Mulai</th>
                        <th scope="col">Tanggal Selesai</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td><img src='admin/uploads/" . $row['gambar'] . "' width='100'></td>";
                            echo "<td>" . $row['nama_kegiatan'] . "</td>";
                            echo "<td>" . $row['keterangan'] . "</td>";

                            $tanggal_mulai = date("d-m-Y", strtotime($row['tanggal_mulai']));
                            echo "<td>" . $tanggal_mulai . "</td>";

                     
                            $tanggal_selesai = date("d-m-Y", strtotime($row['tanggal_selesai']));
                            echo "<td>" . $tanggal_selesai . "</td>";

                            echo "<td>" . $row['lokasi'] . "</td>";

                            echo "<td>
                                <a href='detail_kegiatan.php?id=" . $row['id_kegiatan'] . "' class='btn btn-info btn-sm'>Detail</a>
                                <a href='edit_kegiatan.php?id=" . $row['id_kegiatan'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='hapus.php?id=" . $row['id_kegiatan'] . "' class='btn btn-danger btn-sm' 
                                    onclick='return confirm(\"Apakah Anda yakin ingin menghapus kegiatan ini?\");'>Hapus</a>
                            </td>";
                            echo "</tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='8'>Tidak ada data kegiatan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>
</main>

<?php include('footer.html'); ?>
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<div id="preloader"></div>