<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subjeck = $_POST['subjeck'];
    $message = $_POST['message'];

    $sql = "INSERT INTO kontak (name, email, subjeck, message) VALUES ('$name', '$email', '$subjeck', '$message')";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
    $conn->close();
}
?>


<main class="main">

    <div class="page-title dark-background">

    </div>

    <div class="container my-5" data-aos="fade-up" data-aos-delay="200">

        <section id="contact" class="contact section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Kontak</h2>
                <p>Jika Anda memiliki saran, kritik, atau masukan terkait Desa Larangan Slampar, silakan sampaikan melalui kontak resmi desa. Masukan Anda sangat berarti untuk mendukung pengembangan dan kemajuan desa secara bersama-sama.</p>
            </div>

            <div class="container" data-aos="fade" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-4">
                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h3>Alamat</h3>
                                <p>Desa Larangan Slampar, Kecamatan Tlanakan, Kabupaten Pamekasan.</p>
                            </div>
                        </div>

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-telephone flex-shrink-0"></i>
                            <div>
                                <h3>Nomor Telpon</h3>
                                <p>+62 878-4006-0990</p>
                            </div>
                        </div>

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h3>Email</h3>
                                <p>larangan_slampar@gmail.com</p>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-8">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="subjeck" class="form-label">Subjek</label>
                                <input type="text" class="form-control" id="subjeck" name="subjeck" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Pesan</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                        </form>
                    </div>

                </div>

            </div>

        </section>
    </div>
</main>
<footer id="footer" class="footer light-background">
    <div class="container">
        <h3 class="sitename">Desa Larangan Slampar</h3>
        <p>Et aut eum quis fuga eos sunt ipsa nihil. Labore corporis magni eligendi fuga maxime saepe commodi placeat.</p>
        <div class="social-links d-flex justify-content-center">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-skype"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
        </div>
        <div class="container">
            <div class="copyright">
                <span>Copyright</span> <strong class="px-1 sitename">Riyan.a_w</strong> <span>All Rights Reserved</span>
            </div>
            <div class="credits">
                Designed by Riyan.a_w</a>
            </div>
        </div>
    </div>
</footer>

<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader"></div>