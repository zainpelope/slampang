<?php
include('koneksi.php');


$batas = 10;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;


$cari = isset($_GET['cari']) ? $_GET['cari'] : '';
$where = "";
if ($cari != '') {
    $where = "WHERE p.nama LIKE '%$cari%' OR ps.jenis_surat LIKE '%$cari%'";
}

$data = mysqli_query($conn, "SELECT ps.*, p.nama FROM pengajuan_surat ps JOIN pengguna p ON ps.id_pengguna = p.id $where");
$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

$query = "SELECT ps.*, p.nama FROM pengajuan_surat ps JOIN pengguna p ON ps.id_pengguna = p.id $where ORDER BY ps.tanggal_pengajuan DESC LIMIT $halaman_awal, $batas";
$result = $conn->query($query);

$total_masuk = $conn->query("SELECT COUNT(*) as total FROM pengajuan_surat")->fetch_assoc()['total'];
$total_ditolak = $conn->query("SELECT COUNT(*) as total FROM pengajuan_surat WHERE status = 'Ditolak'")->fetch_assoc()['total'];
$total_diproses = $conn->query("SELECT COUNT(*) as total FROM pengajuan_surat WHERE status = 'Diproses'")->fetch_assoc()['total'];
$total_diambil = $conn->query("SELECT COUNT(*) as total FROM pengajuan_surat WHERE status = 'Siap Diambil'")->fetch_assoc()['total'];
?>

<main class="main">
    <div class="page-title dark-background"></div>
    <div class="container mt-4">
        <h2>Daftar Pengajuan Surat</h2>

        <div class="mt-4">

            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Masuk</h5>
                            <p class="card-text"><?= $total_masuk; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Ditolak</h5>
                            <p class="card-text"><?= $total_ditolak; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Diproses</h5>
                            <p class="card-text"><?= $total_diproses; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Diambil</h5>
                            <p class="card-text"><?= $total_diambil; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <form method="GET" action="">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Nama/Jenis Surat" name="cari" value="<?= $cari; ?>">
                <input type="hidden" name="page" value="layanan_publik">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemohon</th>
                    <th>Jenis Surat</th>
                    <th>Status</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Tanggal Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = $halaman_awal + 1;
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['jenis_surat']; ?></td>
                        <td>
                            <span class="badge bg-<?= ($row['status'] == 'Siap Diambil') ? 'success' : (($row['status'] == 'Ditolak') ? 'danger' : 'warning'); ?>">
                                <?= $row['status']; ?>
                            </span>
                        </td>
                        <td><?= $row['tanggal_pengajuan']; ?></td>
                        <td><?= $row['tanggal_selesai'] ? $row['tanggal_selesai'] : '-'; ?></td>
                        <td>
                            <a href="detail_pengajuan.php?id=<?= $row['id']; ?>" class="btn btn-info btn-sm">Detail</a>
                            <?php if ($row['status'] == 'Menunggu Verifikasi') { ?>
                                <a href="verifikasi.php?id=<?= $row['id']; ?>" class="btn btn-success btn-sm">Verifikasi</a>
                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#tolakModal<?= $row['id']; ?>">Tolak</a>

                                <div class="modal fade" id="tolakModal<?= $row['id']; ?>" tabindex="-1" aria-labelledby="tolakModalLabel<?= $row['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tolakModalLabel<?= $row['id']; ?>">Alasan Penolakan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="tolak.php?id=<?= $row['id']; ?>" method="POST">
                                                    <div class="mb-3">
                                                        <label for="alasan_penolakan" class="form-label">Alasan Penolakan:</label>
                                                        <textarea class="form-control" id="alasan_penolakan" name="alasan_penolakan" rows="3"></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } elseif ($row['status'] == 'Diproses') { ?>
                                <?php
                                $cetak_link = '';
                                switch ($row['jenis_surat']) {
                                    case 'Domisili':
                                        $cetak_link = 'cetak/cetak_domisili.php?id=' . $row['id'];
                                        break;
                                    case 'Tidak Mampu':
                                        $cetak_link = 'cetak/cetak_sktm.php?id=' . $row['id'];
                                        break;
                                    case 'Usaha':
                                        $cetak_link = 'cetak/cetak_usaha.php?id=' . $row['id'];
                                        break;
                                    case 'Belum Menikah':
                                        $cetak_link = 'cetak/cetak_belum_menikah.php?id=' . $row['id'];
                                        break;
                                    case 'Tanah':
                                        $cetak_link = 'cetak/cetak_tanah.php?id=' . $row['id'];
                                        break;
                                    default:
                                        $cetak_link = '#';
                                }
                                ?>
                                <a href="#" class="btn btn-primary btn-sm" onclick="cetakSurat('<?= $cetak_link; ?>', <?= $row['id']; ?>)">Cetak</a>
                                <a href="siap_diambil.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm" id="sudahCetakBtn" style="display: none;">Sudah Cetak</a>
                            <?php } elseif ($row['status'] != 'Ditolak' && $row['status'] != 'Siap Diambil') { ?>
                                <button class="btn btn-secondary btn-sm" disabled><?= $row['status']; ?></button>
                            <?php } ?>
                            <a href="hapus_pengajuan.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus pengajuan ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if ($halaman > 1) { ?>
                    <li class="page-item"><a class="page-link" href="?page=layanan_publik&cari=<?= $cari; ?>&halaman=<?= $previous; ?>">Previous</a></li>
                <?php } ?>
                <?php
                for ($x = 1; $x <= $total_halaman; $x++) {
                ?>
                    <li class="page-item <?= ($halaman == $x) ? 'active' : ''; ?>"><a class="page-link" href="?page=layanan_publik&cari=<?= $cari; ?>&halaman=<?= $x; ?>"><?= $x; ?></a></li>
                <?php
                }
                ?>
                <?php if ($halaman < $total_halaman) { ?>
                    <li class="page-item"><a class="page-link" href="?page=layanan_publik&cari=<?= $cari; ?>&halaman=<?= $next; ?>">Next</a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>

    <script>
        function cetakSurat(url, id) {
            window.open(url, '_blank');
            fetch('siap_diambil.php?id=' + id, {
                    method: 'GET'
                }).then(response => response.text())
                .then(data => {
                    location.reload();
                }).catch(error => console.error('Error:', error));
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</main>

<?php include('footer.html'); ?>
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<div id="preloader"></div>

<?php
$conn->close();
?>