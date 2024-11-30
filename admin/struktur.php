<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM struktur
        ORDER BY 
          CASE WHEN jabatan = 'Kepala Desa' THEN 1 ELSE 2 END, 
          nama ASC";
$result = $conn->query($sql);

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $sql = "SELECT gambar FROM struktur WHERE id_struktur = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($gambar);
    $stmt->fetch();
    $stmt->close();

    unlink("admin/uploads/" . $gambar);

    $sql = "DELETE FROM struktur WHERE id_struktur = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index_admin.php?page=struktur");
    exit();
}
?>
<main class="main">
    <!-- Hero Title -->
    <div class="page-title dark-background text-center py-5 text-white">

    </div>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Daftar Struktur</h2>
            <a href="admin/struktur/tambah_struktur.php" class="btn btn-primary">Tambah Struktur</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <img src="admin/uploads/<?= htmlspecialchars($row['gambar']) ?>" alt="Struktur" style="width: 80px; height: 80px; object-fit: cover;">
                            </td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['jabatan']) ?></td>
                            <td>
                                <a href="admin/struktur/edit_struktur.php?id=<?= $row['id_struktur'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="confirmDeleteStruktur(<?= $row['id_struktur'] ?>)">Hapus</button>
                            </td>


                            <script>
                                function confirmDeleteStruktur(id) {

                                    const userConfirmed = confirm("Apakah Anda yakin ingin menghapus struktur ini?");
                                    if (userConfirmed) {

                                        window.location.href = `index_admin.php?page=struktur&hapus=${id}`;
                                    } else {

                                        return;
                                    }
                                }
                            </script>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<br><br><br>
<?php include('footer.html'); ?>
<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>