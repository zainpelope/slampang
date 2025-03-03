<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../koneksi.php');

if (isset($_GET['id'])) {
    $id_pengajuan = $_GET['id'];

    $stmt = $conn->prepare("SELECT ds.*, ps.jenis_surat FROM detail_surat ds 
                            JOIN pengajuan_surat ps ON ds.id_pengajuan = ps.id 
                            WHERE ds.id_pengajuan = ?");
    $stmt->bind_param("i", $id_pengajuan);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data) {
?>
        <!DOCTYPE html>
        <html lang="id">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Surat Keterangan Tidak Mampu</title>
            <style>
                @page {
                    size: A4;
                    margin: 2cm;
                }

                body {
                    font-family: 'Times New Roman', Times, serif;
                    margin: 0;
                    padding: 2cm;
                    padding-top: 1cm;
                }

                .header {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    text-align: center;
                    position: relative;
                }

                .logo {
                    width: 100px;
                    height: 100px;
                    position: absolute;
                    left: -10px;
                    top: 50%;
                    transform: translateY(-50%);
                }

                .header-text {
                    flex-grow: 1;
                    text-align: center;
                    margin-left: 50px;
                }


                h3,
                h4,
                p {
                    margin: 2px 0;
                }

                hr {
                    border: 1px solid black;
                }

                .isi {
                    margin-top: 20px;
                    font-size: 16px;
                    text-align: justify;
                }

                .ttd {
                    margin-top: 50px;
                }

                .ttd-content {
                    text-align: left;
                    float: right;
                }

                .ttd-content p {
                    margin: 5px;
                }
            </style>
        </head>

        <body>
            <div class="header">
                <img src="../pmk.png" alt="Logo Desa" class="logo">
                <div class="header-text">
                    <h3>PEMERINTAH KABUPATEN PAMEKASAN</h3>
                    <h4>KECAMATAN TLANAKAN</h4>
                    <h4>KEPALA DESA LARANGAN SLAMPAR</h4>
                    <p>Alamat : Jl. Raya Larangan Slampar, Pamekasan - Telp: 081703709509</p>
                </div>
            </div>
            <hr>
            <h3 style="text-align: center; text-decoration: underline;">SURAT KETERANGAN TIDAK MAMPU</h3>
            <p style="text-align: center;">Nomor: 475/93/432.504.16/<?= date('Y'); ?></p>

            <div class="isi">
                <p>Yang bertanda tangan di bawah ini Kepala Desa Larangan Slampar Kecamatan Tlanakan Kabupaten Pamekasan, menerangkan dengan sebenar-benarnya bahwa:</p>

                <table>
                    <tr>
                        <td>Nama</td>
                        <td>: <?= $data['nama_lengkap']; ?></td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>: <?= $data['nik']; ?></td>
                    </tr>
                    <tr>
                        <td>Tempat, Tanggal Lahir</td>
                        <td>: <?= $data['tempat_lahir']; ?>, <?= date('d-m-Y', strtotime($data['tanggal_lahir'])); ?></td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td>: <?= $data['agama']; ?></td>
                    </tr>
                    <tr>
                        <td>Pekerjaan</td>
                        <td>: <?= $data['pekerjaan']; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: <?= $data['alamat']; ?></td>
                    </tr>
                    <tr>
                        <td>Keperluan</td>
                        <td>: <?= $data['keperluan']; ?></td>
                    </tr>
                </table>

                <p>Orang tersebut betul-betuk Penduduk Desa Larangan Slampar dan keadaan ekonominya lemah (TIDAK MAMPU).</p>

                <p>Surat keterangan ini digunakan untuk persyaratan pengajuan beasiswa.</p>
                <p>Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
            </div>

            <div class="ttd-content">
                <br><br><br>
                <p>Pamekasan, <?= date('d-m-Y'); ?></p>
                <p>Kepala Desa Larangan Slampar</p>
                <div style="text-align: center;">
                    <br><br><br> <br><br><br>
                    <p><b>HOYYIBAH</b></p>
                </div>
            </div>

            <script>
                window.print();
            </script>
        </body>

        </html>
<?php
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "ID pengajuan tidak valid.";
}
?>