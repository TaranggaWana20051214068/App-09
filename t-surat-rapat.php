<?php

$judul = 'Tambah Surat Rapat';
if (isset($_REQUEST["submit"])) {
    if (empty($_POST["tanggal"])) {
        echo '<div class="alert alert-primary alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button> <strong>Gagal !</strong> Tolong Periksa Kembali data yang kamu isi.</div>';
        exit;
    } else {
        $tgl_surat = $_POST['tanggal'];
        $nomor_surat = $_POST['nomor_surat'];
        $kode = $_POST['kode'];
        $perihal = $_POST['perihal'];
        $tmpt = $_POST['tmpt'];
        $acara = $_POST['acara'];
        $user = $_SESSION['uname'];
        $keperluan = 'Surat Rapat';
        $kod = mysqli_query($conn, "SELECT kode, tgl_surat FROM tbl_surat ORDER BY id DESC LIMIT 1");
        $result = mysqli_fetch_assoc($kod);

        if (mysqli_num_rows($kod) > 0) {
            $tanggal_terakhir = $result['tgl_surat'];
            $tahun_terakhir = date("Y", strtotime($tanggal_terakhir));
            $tahun_sekarang = date("Y");
            // Periksa apakah input terakhir pada tahun yang sama
            ($tahun_sekarang == $tahun_terakhir) ? $kodes = $result['kode'] + 1 : $kodes = 1;
        } else {
            $kodes = 1;
        }
        $x = str_pad($kodes, 4, "0", STR_PAD_LEFT);
        $tahun = date('Y-m');
        $bikin_kode = "SP/$tahun/$x";
        $sql = "INSERT INTO tbl_surat (kode,tgl_surat, nomer_surat, pemohon,keperluan)
        VALUES ('$kodes','$tgl_surat','$bikin_kode','$user','$keperluan')";
        if ($conn->query($sql) === TRUE) {
            $id_surat = $conn->insert_id;
            // Query untuk menyimpan data ke tabel tbl_surat
            $sql_rapat = "INSERT INTO tbl_s_rapat (tanggal, nomor_surat, kode, perihal, tmpt, acara, id_surat)
                VALUES ('$tgl_surat', '$nomor_surat', '$kode', '$perihal', '$tmpt', '$acara', '$id_surat')";

            $result = mysqli_query($conn, $sql_rapat);
            if (!$sql_rapat) {
                echo "Error: " . $sql . "<br>" . $conn->error;
                echo '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button> <strong>GAGAL!</strong> Kesalahan Dalam Mengisi Form</div>';
                // Hentikan loop jika terjadi kesalahan
            }
        }
        // Eksekusi query
        if ($sql == TRUE) {
            $_SESSION['success_message'] = "Berhasil";
            ?>
            <script>window.location.href = "?sur=rapat";</script>
            <?php
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            echo '<div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button> <strong>GAGAL!</strong>Kesalahan Dalam Mengisi Form</div>';
        }
    }
} else {

    // Mengambil data nomor surat terakhir
    $sql = mysqli_query($conn, "SELECT kode, tanggal FROM tbl_s_rapat ORDER BY id DESC LIMIT 1");
    $result = mysqli_fetch_assoc($sql);

    if (mysqli_num_rows($sql) > 0) {
        $tanggal_terakhir = $result['tanggal'];
        $tahun_terakhir = date("Y", strtotime($tanggal_terakhir));
        $tahun_sekarang = date("Y");
        // Periksa apakah input terakhir pada tahun yang sama
        ($tahun_sekarang == $tahun_terakhir) ? $kode = $result['kode'] + 1 : $kode = 1;
    } else {
        $kode = 1;
    }

    //mulai bikin kode

    $x = str_pad($kode, 4, "0", STR_PAD_LEFT);
    $tahun = date('Y-m');
    $bikin_kode = "SR/$tahun/$x";

    ?>
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">
                        <?= $judul ?>
                    </a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="#" method="post">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="tampilan">Nomor Surat <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="tampilan" name="tampilan"
                                            placeholder="Nomor-Surat" value="<?= $bikin_kode ?>" readonly>
                                        <input type="hidden" name="nomor_surat" value="<?= $bikin_kode ?>">
                                        <input type="hidden" name="kode" value="<?= $kode ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="perihal">Perihal <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="perihal" name="perihal"
                                            placeholder="Masukkan perihal" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="date-format">Tanggal <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" name="tanggal" class="form-control"
                                            placeholder="Masukkan tanggal Acara" id="date-format" data-dtp="dtp_h1kiw"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="tmpt">Tempat Acara <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="tmpt" name="tmpt"
                                            placeholder="Masukkan tempat" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="acara">Acara <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="acara" name="acara"
                                            placeholder="Masukkan Acara" required>
                                    </div>
                                </div>
                                <div class="col-lg-8 ml-auto">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #/ container -->

    </div>
<?php } ?>