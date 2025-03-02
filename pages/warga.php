<?php
session_start();
include 'koneksi.php';


// Pastikan pengguna sudah login
if (!isset($_SESSION['id_pengguna'])) {
    header("Location: login.php");
    exit();
}

$id_pengguna = $_SESSION['id_pengguna'];

// Ambil data pengguna dari database
$query_user = "SELECT * FROM pengguna WHERE id = '$id_pengguna'";
$result_user = $conn->query($query_user);
$user = $result_user->fetch_assoc();

// Ambil data pengajuan surat pengguna
$query_surat = "SELECT * FROM pengajuan_surat WHERE id_pengguna = '$id_pengguna' ORDER BY tanggal_pengajuan DESC";
$result_surat = $conn->query($query_surat);
?>

<main class="main">
    <div class="page-title dark-background"></div>
    <div class="container mt-4">

        <a href="form_pengajuan.php" class="btn btn-primary">Ajukan Surat Baru</a>

        <hr>

        <h3>Status Pengajuan Surat</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Jenis Surat</th>
                    <th>Status</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Tanggal Selesai</th>
                    <th>Alasan Penolakan</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_surat->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['jenis_surat']; ?></td>
                        <td>
                            <span class="badge bg-<?= ($row['status'] == 'Siap Diambil') ? 'success' : (($row['status'] == 'Ditolak') ? 'danger' : 'warning'); ?>">
                                <?= $row['status']; ?>
                            </span>
                        </td>
                        <td><?= $row['tanggal_pengajuan']; ?></td>
                        <td><?= $row['tanggal_selesai'] ? $row['tanggal_selesai'] : '-'; ?></td>
                        <td><?= ($row['status'] == 'Ditolak' && $row['alasan_penolakan']) ? $row['alasan_penolakan'] : '-'; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


</main>

<?php include('footer.html'); ?>
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<div id="preloader"></div>