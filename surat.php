<?php
if (isset($_REQUEST['id'])) {
    include("include/config.php");
    include("include/functions.php");
    include("terbilang.php");
    $id = $_REQUEST['id'];

    $sql = "SELECT * FROM tbl_surat   WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Pastikan $row['sub_total'] adalah numerik
    $sub_total = floatval($row['sub_total']);

    // Pastikan $row['ppn'] adalah numerik
    $ppn = is_numeric($row['ppn']) ? (($row['ppn'] / 100) * $sub_total) : 0;

    // Jumlahkan secara numerik
    $total = $ppn + $sub_total;

} else {
    $id = NULL;
    $row = NULL;
    $result = FALSE;
    $sql = NULL;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/style2.css">
    <link href="./plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <style>
        /* SURAT */
        body {
            color: #000;
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }


        /* @media print {
            body {
                width: 100%;
                margin: 0; 
            }
        } */
    </style>
</head>

<body onload=" window.print()">
    <!-- onload=" window.print()" -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice">
                            <div class="div-2">FAKTUR</div>
                            <div class="div-3">
                                <div class="div-4">
                                    <img loading="lazy" srcset="/images/logo-pb.png" class="img" />
                                    <div class="div-5">
                                        <div class="div-6">PUTRA BAROKAH</div>
                                        <div class="div-7">Jl. Karang Klumprik Utara A/2</div>
                                        <div class="div-8">Wiyung, Surabaya 60223</div>
                                        <div class="div-9">Telp. 08121661972</div>
                                    </div>
                                </div>
                                <div class="dt-right">
                                    <div class="card-body">
                                        <div class="invoice-head">
                                            <p class="card-text">Nomor</p>
                                            <p class="card-text">Tanggal</p>
                                            <p class="card-text">Pelanggan</p>
                                            <p class="card-text">Alamat</p>
                                        </div>
                                        <div class="invoice-head-2">
                                            <p class="card-text">:</p>
                                            <p class="card-text">:</p>
                                            <p class="card-text">:</p>
                                            <p class="card-text">:</p>
                                        </div>
                                        <div class="invoice-head-3">
                                            <p class="card-text">
                                                <?= (isset($_REQUEST['id'])) ? $row['nomer_surat'] : '      &nbsp;' ?>
                                            </p>
                                            <p class="card-text">
                                                <?= (isset($_REQUEST['id'])) ? $row['tgl_surat'] : '      &nbsp;' ?>
                                            </p>
                                            <p class="card-text">
                                                <?= (isset($_REQUEST['id'])) ? $row['pelanggan'] : '      &nbsp;' ?>
                                            </p>
                                            <p class="card-text">
                                                <?= (isset($_REQUEST['id'])) ? $row['alamat_pelanggan'] : '      &nbsp;' ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-table">
                                <div class="table-responsive">
                                    <table class="table table-borderless centered">
                                        <thead>
                                            <tr>
                                                <th width="2%">No</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>QTY</th>
                                                <th>Harga Sat</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_REQUEST['id'])) {
                                                $queryBarang = mysqli_query($conn, "SELECT * FROM tbl_barang WHERE id_surat = $id");
                                                $no = 1;
                                                if (mysqli_num_rows($queryBarang) > 0) {
                                                    while ($row_barang = mysqli_fetch_assoc($queryBarang)) {
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?= $no ?>
                                                            </td>
                                                            <td>
                                                                <?= ($row_barang['kode_barang']) ? $row_barang['kode_barang'] : "-" ?>
                                                            </td>
                                                            <td>
                                                                <?= ($row_barang['nama_barang']) ? $row_barang['nama_barang'] : "-" ?>
                                                            </td>
                                                            <td>
                                                                <?= ($row_barang['qty']) ? $row_barang['qty'] : "-" ?>
                                                            </td>
                                                            <td class="color-primary">
                                                                <?= ($row_barang['harga_sat']) ? rupiah($row_barang['harga_sat']) : "0" ?>
                                                            </td>
                                                            <td class="color-primary">
                                                                <?= ($row_barang['jumlah']) ? rupiah($row_barang['jumlah']) : "0" ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $no++;
                                                    }
                                                }
                                            } else {
                                                for ($i = 1; $i <= 10; $i++) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?= $i ?>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <?php
                                                }
                                            } ?>
                                        </tbody>
                                    </table>
                                    <div class="container-tot">
                                        <div class="dt-left">
                                            <div class="card-body">
                                                <div class="invoice-head">
                                                    <p class="card-text">Terbilang</p>
                                                    <p class="card-text">Keterangan</p>
                                                </div>
                                                <div class="invoice-head-2">
                                                    <p class="card-text">:</p>
                                                    <p class="card-text">:</p>
                                                </div>
                                                <div class="invoice-head-3">
                                                    <p class="card-text terbilang">
                                                        <?= (isset($_REQUEST['id'])) ? terbilang($total) : '      &nbsp;' ?>
                                                    </p>
                                                    <p class="card-text">
                                                        <?= (isset($_REQUEST['id'])) ? $row['keterangan'] : '      &nbsp;' ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dt-right">
                                            <div class="card-body">
                                                <div class="invoice-head">
                                                    <p class="card-text">SubTotal</p>
                                                    <p class="card-text">PPN</p>
                                                    <p class="card-text">Total</p>
                                                </div>
                                                <div class="invoice-head-2">
                                                    <p class="card-text">:</p>
                                                    <p class="card-text">:</p>
                                                    <p class="card-text">:</p>
                                                </div>
                                                <div class="invoice-head-3">
                                                    <p class="card-text">
                                                        <?= (isset($_REQUEST['id'])) ? rupiah($sub_total) : '' ?>
                                                    </p>
                                                    <p class="card-text">
                                                        <?= (isset($_REQUEST['id'])) ? $row['ppn'] . "% =" . rupiah($ppn) : "-" ?>
                                                    </p>
                                                    <hr>
                                                    <p class="card-text terbilang">
                                                        <?= ($row['ppn']) ? rupiah($total) : rupiah($sub_total) ?>
                                                    </p>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <hr style="border:2px solid #000;">
                                    <div class="card-body ket">
                                        <ul class="list-icons">
                                            <li>
                                                <p><i class="fa fa-chevron-right"></i> Barang titipan untuk dijual</p>
                                            </li>
                                            <li>
                                                <p><i class="fa fa-chevron-right"></i> Pembayaran ditransfer ke (selain
                                                    ke rek tsb, pembayaran dianggap <span>TIDAK SAH</span>)</p>
                                            </li>
                                            <li>
                                                <p><i class="fa fa-chevron-right"></i> Bukti
                                                    Pembayaran yang sah & faktur adalah asli (putih)
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="div-86">
                                <div class="div-87">
                                    <div class="div-88">HORMAT KAMI</div>
                                    <div class="div-89">(<span>
                                            <?= $row['pembuat'] ?>
                                        </span>)
                                    </div>
                                </div>
                                <div class="div-90">
                                    <div class="div-91">PENERIMA</div>
                                    <div class="div-92">(<span>
                                            <?= $row['pelanggan'] ?>
                                        </span>)
                                    </div>
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
        <script src="plugins/common/common.min.js"></script>
        <script src="js/custom.min.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/gleek.js"></script>
        <script src="js/styleSwitcher.js"></script>
        <script src="./plugins/moment/moment.js"></script>
</body>

</html>