<?php
if (isset($_REQUEST['id'])) {
    include("include/config.php");
    include("include/functions.php");
    include("terbilang.php");
    $tbl_name = 'rapat';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Rapat</title>
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="stylesheet" href="asset/css/style2.css">
    <link href=".asset/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="asset/images/logo-dki-512.png">
    <style>
        /* SURAT */

        @font-face {
            font-family: 'Times New Roman';
            src: url('asset/font/times-new-roman.ttf') format('truetype');
            /* Ganti path/to/times-new-roman.ttf dengan path yang benar menuju file font di server Anda */
        }

        body {
            color: #000;
            height: 100dvh;
            font-family: 'Times New Roman', serif;
        }

        .ttd {
            display: flex;
            flex-direction: column;
            align-items: end;
            text-align: center;
            justify-content: center;
        }

        p {
            font-size: 20px;
        }
    </style>
</head>

<body onload=" window.print()">
    <!-- onload=" window.print()" -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="max-w-2xl mx-auto my-12 p-8 bg-white">
                                <h2 class="text-lg font-bold font-weight-bold text-center col-s-7">
                                    RUKUN TETANGGA 009 RW 01 KELURAHAN KELAPA GADING
                                    BARAT KECAMATAN KELAPA GADING KOTA ADMINISTRASI
                                    JAKARTA UTARA
                                </h2>
                                <br>
                                <h4 class="mb-2 font-lg font-weight-bold text-center">Sekretariat: Jalan Teguh Raya RT
                                    009
                                    RW
                                    01
                                    Komplek TNI
                                    - AL
                                    Kodamar
                                    14240</h4>
                                <p class="divider" style="margin-bottom:7px;"></p>
                                <p class="divider"></p>
                                <div class="border-t border-black mt-4 pt-4">
                                    <?php
                                    $id = $_GET['id'];
                                    $sql = "SELECT a.*, b.rt, c.ttd 
                                    FROM tbl_s_rapat a 
                                    LEFT JOIN tbl_surat b ON a.id_surat = b.id 
                                    LEFT JOIN tbl_users c ON b.rt = c.full_name WHERE a.id = '$id'";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        $row = mysqli_fetch_assoc($result);
                                        $date = tanggalWaktu($row['tanggal']);
                                        ?>
                                        <p class="mb-2 text-lg-right">Jakarta
                                            <?= $date['tanggal'] ?>
                                        </p>
                                        <p class="mb-2">Nomor    :
                                            <?= $row['nomor_surat'] ?>
                                        </p>
                                        <p class="mb-2">Perihal    :
                                            <?= $row['perihal'] ?>
                                        </p>
                                        <p class="mb-2">Lampiran   : -</p>
                                    </div>
                                    <div class="mt-4">
                                        <p class="mb-2">Kepada Yth,</p>
                                        <p class="mb-2">Bapak/Ibu RT 009 RW 01</p>
                                        <p class="mb-2">di Tempat,</p>
                                        <div class="container">
                                            <p class="mb-4 text-justify">
                                                Assalamualaikum wr. wb Syukur Alhamdulillah segala nikmat Allah kita diberi
                                                kesehatan, semoga semua senantiasa
                                                dalam lindungan Allah SWT, ( Tuhan Semesta Alam ) guna menjalin kebersamaan
                                                di
                                                lingkungan RT 009/01 maka kami
                                                melakukan kegiatan rutin, Rapat Bulanan bersama Warga Jika Bapak tidak dapat
                                                hadir
                                                maka bisa diwakilkan
                                                Ibu/Istri yang akan dilaksanakan pada:
                                            </p>
                                        </div>
                                        <div class="container justify-content-center">
                                            <div class="dt-left">
                                                <div class="card-body">
                                                    <div class="invoice-head">
                                                        <p class="card-text">Hari/Tanggal</p>
                                                        <p class="card-text">Waktu</p>
                                                        <p class="card-text">Tempat</p>
                                                    </div>
                                                    <div class="invoice-head-2">
                                                        <p class="card-text">:</p>
                                                        <p class="card-text">:</p>
                                                        <p class="card-text">:</p>
                                                    </div>
                                                    <div class="invoice-head-3">
                                                        <p class="card-text">
                                                            <?= $date['tanggal'] ?>
                                                        </p>
                                                        <p class="card-text">
                                                            <?= $date['waktu'] ?>
                                                        </p>
                                                        <p>
                                                            <?= $row['tmpt'] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <p class="mb-4">Demikian yang dapat kami sampaikan, Kami mohon untuk kehadiran
                                                Bapak
                                                semuanya.</p>
                                            <p class="mb-4">Sekian Wassalamualaikum</p>
                                        </div>
                                        <div class="container ttd">
                                            <div class="card-body">
                                                <p class="mb-2">Hormat Kami,</p>
                                                <p class="mb-2">KETUA RT 009</p>
                                                <?php
                                                if ($row['ttd']) {
                                                    ?>
                                                    <img src="asset/images/<?= $tbl_name . '/' . $row['ttd'] ?>" alt="">
                                                    <?php
                                                } else {
                                                    ?>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <?php
                                                }
                                                ?>
                                                <p class="mb-2 font-weight-bold">(
                                                    <?= $row['rt'] ?> )
                                                </p>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        $_SESSION['err-log'] = 'Terjadi Kesalahan Silahkan Coba Kembali';
                                        header('Location: ?sur=rapat');
                                        exit;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
        Scripts
    ***********************************-->
        <script src="asset/plugins/common/common.min.js"></script>
        <script src="asset/js/custom.min.js"></script>
        <script src="asset/js/settings.js"></script>
        <script src="asset/js/gleek.js"></script>
        <script src="asset/js/styleSwitcher.js"></script>
        <script src="asset/plugins/moment/moment.js"></script>
</body>

</html>