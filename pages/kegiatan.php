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
                            
                            $keterangan = $row['keterangan'];
                            $keterangan_pendek = substr($keterangan, 0, 150); // Batasi 150 karakter
                            echo "<td>" . nl2br($keterangan_pendek);
                            if (strlen($keterangan) > 150) {
                                echo "... <a href='kegiatan_detail.php?id=" . $row['id_kegiatan'] . "' style='color: blue; font-style: italic;'>Lihat Selengkapnya</a>";

                            }
                            echo "</td>";
                            
                            $tanggal_mulai = date("d-m-Y", strtotime($row['tanggal_mulai']));
                            echo "<td>" . $tanggal_mulai . "</td>";
                            
                            $tanggal_selesai = date("d-m-Y", strtotime($row['tanggal_selesai']));
                            echo "<td>" . $tanggal_selesai . "</td>";
                            
                            echo "<td>" . $row['lokasi'] . "</td>";
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
