<?php
include("terbilang.php");

$judul = 'Tambah Surat';
if (isset($_REQUEST["submit"])) {
    if (empty($_POST["tgl_surat"])) {
        echo '<div class="alert alert-primary alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button> <strong>Gagal !</strong> Tolong Periksa Kembali data yang kamu isi.</div>';
        exit;
    } else {
        $tgl_surat = $_POST['tgl_surat'];
        $nomor_surat = $_POST['nomor_surat'];
        $kode = $_POST['kode'];
        $pembuat = $_POST['pembuat'];
        $pelanggan = $_POST['pelanggan'];
        $alamat_pelanggan = $_POST['alamat_pelanggan'];
        $subtotal = $_POST['subtotal'];
        $terbilang = $_POST['terbilang'];
        $keterangan = $_POST['keterangan'];
        $ppn = $_POST['ppn'];

        // Query untuk menyimpan data ke tabel tbl_surat
        $sql = "INSERT INTO tbl_surat (tgl_surat, nomer_surat, kode, pembuat, pelanggan, alamat_pelanggan, keterangan, ppn)
                VALUES ('$tgl_surat', '$nomor_surat', '$kode', '$pembuat', '$pelanggan', '$alamat_pelanggan', '$keterangan', '$ppn')";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            $id_surat_add = $conn->insert_id; // Mendapatkan ID yang baru saja di-generate oleh query INSERT
            if (isset($_SESSION["tableDet"])) {
                $tableDet = $_SESSION["tableDet"];
                foreach ($tableDet as $i => $v) {
                    if ($tableDet[$i]["i"] != "del") {
                        $kode_barang = $tableDet[$i]['kode_barang'];
                        $nama_barang = $tableDet[$i]['nama_barang'];
                        $qty = $tableDet[$i]['qty'];
                        $harga_sat = $tableDet[$i]['harga_sat'];

                        $queryBarang = mysqli_query($conn, "INSERT INTO tbl_barang (id_surat, kode_barang, nama_barang, qty, harga_sat)
                                    VALUES ('$id_surat_add', '$kode_barang', '$nama_barang', '$qty', '$harga_sat')");
                        if (!$queryBarang) {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                            echo '<div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                                    </button> <strong>GAGAL!</strong> Kesalahan Dalam Mengisi Form</div>';
                            break; // Hentikan loop jika terjadi kesalahan
                        }
                    }
                }
                unset($_SESSION['tableDet']);
            }
        }
        // Eksekusi query
        if ($sql == TRUE) {
            $_SESSION['success_message'] = "Berhasil";
            ?>
            <script>window.location.href = "index.php";</script>
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
    $sql = mysqli_query($conn, "SELECT kode, tgl_surat FROM tbl_surat ORDER BY id DESC LIMIT 1");
    $result = mysqli_fetch_assoc($sql);

    if (mysqli_num_rows($sql) > 0) {
        // Jika tahun sama, tambahkan 1 pada kode terakhir
        $kode = $result['kode'] + 1;
    } else {
        // Jika tahun berbeda, mulai dari 1
        $kode = 1;
    }

    //mulai bikin kode
    $bikin_kode = str_pad($kode, 4, "0", STR_PAD_LEFT);


    ?>
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
                            <input type="tel" id="kode_barang" class="form-control input-rounded" name="kode_barang"
                                placeholder="Kode Barang">
                        </div>
                        <div class="form-group col-md-11">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" id="nama_barang" class="form-control input-rounded" name="nama_barang"
                                placeholder="Nama Barang">
                        </div>
                        <div class="form-group col-md-11">
                            <label for="qty">QTY </label>
                            <input type="number" id="qty" class="form-control input-rounded" name="qty" placeholder="QTY">
                        </div>
                        <div class="form-group col-md-11">
                            <label for="harga_sat">Harga Satuan</label>
                            <input type="number" id="harga_sat" class="form-control input-rounded" name="harga_sat"
                                placeholder="Harga Satuan">
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
                <form action="#" method="POST" id="step-form-horizontal" class="step-form-horizontal">
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
                                            placeholder="Masukkan tanggal" id="mdate" data-dtp="dtp_5cLR3" required>
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
                                        <input type="number" class="form-control" name="ppn" id="ppn" placeholder="ppn">
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
                                        <textarea class="form-control h-150px" id="keterangan" name="keterangan" rows="6"
                                            id="comment"></textarea>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <h4>Konfirmasi</h4>
                        <section>
                            <div class="row h-100">
                                <div class="col-lg-12">
                                    <div class="col-12 h-100 d-flex flex-column justify-content-center align-items-center">
                                        <p>Apakah Data sudah benar?</p>
                                        <button type="submit" name="submit" class="btn btn-primary">Submit<span
                                                class="btn-icon-right"><i class="fa fa-check"></i></span></button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </form>
            </div>
        </div>
        <!-- #/ container -->

    </div>
<?php } ?>