<?php
include("terbilang.php");

$judul = 'Tambah Surat';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Quixlab - Bootstrap Admin Dashboard Template by Themefisher.com</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="./plugins/jquery-steps/css/jquery.steps.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .table-responsive {
            max-height: 13rem !important;
        }

        .wizard>.actions a,
        .wizard>.actions a:hover,
        .wizard>.actions a:active {
            padding: 0.55em 2em !important;
        }
    </style>
</head>

<body>
    <div id="main-wrapper">
        <div class="content-body">
            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Data Barang</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <div class="basic-form">
                            <form action="#" method="post" autocomplete="off">
                                <div class="form-group col-md-11 barang">
                                    <label for="kode_barang">Kode Barang</label>
                                    <input type="tel" id="kode_barang" class="form-control input-rounded"
                                        name="kode_barang" placeholder="Kode Barang">
                                </div>
                                <div class="form-group col-md-11">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" id="nama_barang" class="form-control input-rounded"
                                        name="nama_barang" placeholder="Nama Barang">
                                </div>
                                <div class="form-group col-md-11">
                                    <label for="qty">QTY </label>
                                    <input type="number" id="qty" class="form-control input-rounded" name="qty"
                                        placeholder="QTY">
                                </div>
                                <div class="form-group col-md-11">
                                    <label for="harga_sat">Harga Satuan</label>
                                    <input type="number" id="harga_sat" class="form-control input-rounded"
                                        name="harga_sat" placeholder="Harga Satuan">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="addBarang" class="btn btn-primary">Kirim<span
                                            class="btn-icon-right"><i class="fa fa-check"></i></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($_REQUEST["addBarang"])) {
                    // Proses data yang dikirimkan
                    $kode_barang = $_POST['kode_barang'];
                    $nama_barang = $_POST['nama_barang'];
                    $qty = $_POST['qty'];
                    $harga_sat = $_POST['harga_sat'];

                    if (!isset($_SESSION['tableDet'])) {
                        unset($_SESSION['tableDet']);
                        $tableDet = array();
                    } else {
                        $tableDet = $_SESSION['tableDet'];
                    }
                    $i = count($tableDet);
                    $tableDet[$i]['kode_barang'] = $kode_barang;
                    $tableDet[$i]['nama_barang'] = $nama_barang;
                    $tableDet[$i]['qty'] = $qty;
                    $tableDet[$i]['harga_sat'] = $harga_sat;
                    $tableDet[$i]['i'] = $i; // Menetapkan nilai 'i' dengan variabel $i
                    $_SESSION["tableDet"] = $tableDet;
                    ?>
                    <script>window.location.href = "?page=add"</script>
                    <?php
                    die();
                }
                ?>

            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="#" id="step-form-horizontal" class="step-form-horizontal">
                            <div>
                                <h4>Daftar Barang</h4>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <!-- Large modal -->

                                            <div class="table-responsive">
                                                <table class="table header-border">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">No</th>
                                                            <th scope="col">Kode Barang</th>
                                                            <th scope="col">Nama Barang</th>
                                                            <th scope="col">QTY</th>
                                                            <th scope="col">Harga Satuan</th>
                                                            <th scope="col">Jumlah</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $subtotal = 0;
                                                        $angka = 0;
                                                        if (isset($_SESSION["tableDet"])) {
                                                            $tableDet = $_SESSION["tableDet"];
                                                            foreach ($tableDet as $i => $v) {
                                                                if ($tableDet[$i]["i"] != "del") {
                                                                    $no = $i + 1; // Menggunakan $no untuk nomor
                                                        
                                                                    ?>
                                                                    <tr>
                                                                        <td>
                                                                            <?= $no ?>
                                                                        </td>
                                                                        <td>
                                                                            <?= (is_array($tableDet[$i]['kode_barang']) ? 'Tidak Ada' : $tableDet[$i]['kode_barang']) ?>
                                                                        </td>
                                                                        <td>
                                                                            <?= (is_array($tableDet[$i]['nama_barang']) ? 'Tidak Ada' : $tableDet[$i]['nama_barang']) ?>
                                                                        </td>
                                                                        <td>
                                                                            <?= (is_array($tableDet[$i]['qty']) ? 'Tidak Ada' : $tableDet[$i]['qty']) ?>
                                                                        </td>
                                                                        <td>
                                                                            <?= (is_array($tableDet[$i]['harga_sat']) ? 'Tidak Ada' : $tableDet[$i]['harga_sat']) ?>
                                                                        </td>
                                                                        <td>
                                                                            <?= (int) $tableDet[$i]['qty'] * (int) $tableDet[$i]['harga_sat'] ?>
                                                                        </td>
                                                                        <td>
                                                                            <?= '<a href="hapus-item-surat.php?id=' . $tableDet[$i]["i"] . '" type="button" class="btn mb-1 btn-xs btn-danger">Remove<span class="btn-icon-right"><i class="fa fa-close"></i></span>
                                                        </a>' ?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    // Tambahkan jumlah ke total jumlah
                                                        
                                                                }
                                                            }
                                                        } else {
                                                            ?>
                                                            <tr>
                                                                <td oncl colspan="6" style="text-align: center"
                                                                    class="col-lg-12 align-center">
                                                                    <p class="text-warning">Data Barang Masih Kosong
                                                                        <code>Isi Data barang</code>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal"
                                                    data-target=".bd-example-modal-lg">Tambah Barang</button>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <h4>Data Faktur</h4>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="number" class="form-control" id="tampilan" name="tampilan"
                                                    placeholder="Nomor-Surat" value="<?= $bikin_kode ?>">
                                                <input type="hidden" name="nomor_surat" value="<?= $bikin_kode ?>">
                                                <input type="hidden" name="kode" value="<?= $kode ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="tgl_surat" class="form-control"
                                                    placeholder="Masukkan tanggal" id="mdate" data-dtp="dtp_5cLR3"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" id="pembuat" class="form-control" name="pembuat"
                                                    placeholder="Masukan Nama" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="ppn" id="ppn"
                                                    placeholder="ppn">
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <h4>Data Pelanggan</h4>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" id="pelanggan" class="form-control" name="pelanggan"
                                                    placeholder="Masukkan nama Pelanggan" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" id="alamat_pelanggan" class="form-control"
                                                    name="alamat_pelanggan" placeholder="Alamat Pelanggan" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <textarea class="form-control h-150px" id="keterangan" name="keterangan"
                                                    rows="6" id="comment"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <h4>Konfirmasi</h4>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div
                                                class="col-12 h-100 d-flex flex-column justify-content-center align-items-center">
                                                <p>Apakah Data sudah benar?</p>
                                                <button type="submit" name="submit" class="btn btn-primary">Submit<span
                                                        class="btn-icon-right"><i
                                                            class="fa fa-check"></i></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>


    <script src="./plugins/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="./plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="./js/plugins-init/jquery-steps-init.js"></script>

</body>

</html>