<?php
include('koneksi.php');
// Query untuk daftar pengajuan surat
$result = $conn->query("SELECT ps.*, p.nama FROM pengajuan_surat ps JOIN pengguna p ON ps.id_pengguna = p.id ORDER BY ps.tanggal_pengajuan DESC");

// Query untuk menghitung jumlah surat berdasarkan status
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
            <h3>History</h3>
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

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Pemohon</th>
                    <th>Jenis Surat</th>
                    <th>Status</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Tanggal Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
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
                                        $cetak_link = '../cetak/cetak_sktm.php?id=' . $row['id'];
                                        break;
                                    case 'Usaha':
                                        $cetak_link = '../cetak/cetak_usaha.php?id=' . $row['id'];
                                        break;
                                    case 'Belum Menikah':
                                        $cetak_link = '../cetak/cetak_belum_menikah.php?id=' . $row['id'];
                                        break;
                                    case 'Tanah':
                                        $cetak_link = '../cetak/cetak_tanah.php?id=' . $row['id'];
                                        break;
                                    default:
                                        $cetak_link = '#'; // Atau template default
                                }
                                ?>
                                <a href="<?= $cetak_link; ?>" class="btn btn-primary btn-sm" id="cetakBtn">Cetak</a>
                                <a href="siap_diambil.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm" id="sudahCetakBtn" style="display: none;">Sudah Cetak</a>
                            <?php } else { ?>
                                <button class="btn btn-secondary btn-sm" disabled><?= $row['status']; ?></button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('cetakBtn').addEventListener('click', function() {
            document.getElementById('cetakBtn').style.display = 'none';
            document.getElementById('sudahCetakBtn').style.display = 'inline-block';
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</main>


<?php include('footer.html'); ?>
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<div id="preloader"></div>

<?php
$conn->close();
?>