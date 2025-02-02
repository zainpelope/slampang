<?php
include 'koneksi.php';


$sql = "SELECT COUNT(*) AS jumlah_baru FROM kontak WHERE status = 'baru'";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
$jumlah_baru = $data['jumlah_baru'];
?>
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <a href="index_admin.php" class="logo d-flex align-items-center">
            <img src="logo.png" alt="">
            <h1 class="sitename">Larangan Slampar</h1>
        </a>
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="index_admin.php?admin=home_admin" class="active">Home</a></li>
                <li><a href="index_admin.php?page=sejarah">Sejarah</a></li>
                <li><a href="index_admin.php?page=galery">Galery</a></li>
                <li><a href="index_admin.php?page=struktur">Struktur</a></li>
                <li><a href="index_admin.php?page=berita">Berita</a></li>
                <li>
                    <a href="admin/kotak_masuk.php">
                        Kotak Masuk
                        <?php if ($jumlah_baru > 0): ?>
                            <span class="badge bg-danger"><?php echo $jumlah_baru; ?></span>
                        <?php endif; ?>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profile
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="index.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>