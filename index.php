<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include('include/head.php');


?>


<body>


    <!--*******************
        Preloader start
    ********************-->
    <?php include('include/loader.php'); ?>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <?php include('include/navheader.php'); ?>

        <!--**********************************
            Nav header end
        ***********************************-->
        <?php include('include/header.php'); ?>
        <!--**********************************
            Header start
        ***********************************-->

        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php include('include/sidebar.php'); ?>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <?php
            if (isset($_SESSION['success_message'])) {
                echo '<div id="success-message" class="alert alert-success">
                <h4 class="alert-heading">' . $_SESSION['success_message'] . '!!</h4>
                <p>Data Berhasil Ditambahkan</p>
              </div>';
                echo '<script>
                setTimeout(function() {
                    var successMessage = document.getElementById("success-message");
                    successMessage.style.display = "none";
                }, 5000); // 3000 milidetik atau 3 detik
              </script>';
                unset($_SESSION['success_message']); // Hapus pesan agar tidak ditampilkan lagi
            }

            if (isset($_SESSION['judul'])) {
                unset($_SESSION['judul']);
                $_SESSION['judul'] = 'Halaman Utama';
            } else {
                $_SESSION['judul'] = 'Halaman Utama';
            }
            $judul = $_SESSION['judul'];

            $actArray = [
                'add' => 'tambah-surat.php',
                'edit' => 'edit-surat.php',
                'del' => 'hapus-surat.php',
                'surat' => 'surat.php'

            ];
            if (isset($_REQUEST['page'])) {
                $act = $_REQUEST['page'];
                if (array_key_exists($act, $actArray)) {
                    $halaman = $actArray[$act];
                    if (file_exists($halaman)) {
                        include $halaman;
                    } else {
                        ?>
                        <script>window.location.href = "include/page-error-404.php";</script>
                        <?php
                    }
                } else {
                    ?>
                    <script>window.location.href = "include/page-error-404.php";</script>
                    <?php
                }
            } else {
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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Table <button type="button"
                                            onclick="window.location.href='?page=add'" class="btn mb-1 btn-primary">Tambah
                                            Data <span class="btn-icon-right"><i class="fa fa-plus color-info"></i></span>
                                        </button></h4>

                                    <div class="table-responsive">
                                        <table
                                            class="table table-striped table-bordered zero-configuration verticle-middle">
                                            <?php

                                            ?>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nomor Surat</th>
                                                    <th>Pelanggan</th>
                                                    <th>Alamat Pelanggan</th>
                                                    <th>Tanggal</th>
                                                    <th>Subtotal</th>
                                                    <th>ppn</th>
                                                    <th>Jumlah Barang</th>
                                                    <th>Cetak</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query_surat = mysqli_query($conn, 'SELECT * FROM tbl_surat ORDER BY id DESC');

                                                if (mysqli_num_rows($query_surat) > 0) {
                                                    $no = 1;

                                                    while ($row_surat = mysqli_fetch_array($query_surat)) {
                                                        $id_surat = $row_surat["id"];

                                                        // Query untuk menghitung jumlah barang
                                                        $stmt = $conn->prepare("SELECT COUNT(*) AS jumlah_barang FROM tbl_barang WHERE id_surat = ?");
                                                        $stmt->bind_param("i", $id_surat);
                                                        $stmt->execute();
                                                        $result_barang = $stmt->get_result();

                                                        // Menggunakan mysqli_fetch_assoc untuk mengambil hasil query sebagai array asosiatif
                                                        $r_barang = mysqli_fetch_assoc($result_barang);


                                                        // Tampilkan data surat dan jumlah barang
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?= $no ?>
                                                            </td>
                                                            <td>
                                                                <?= $row_surat['nomer_surat'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $row_surat['pelanggan'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $row_surat['alamat_pelanggan'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $row_surat['tgl_surat'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $row_surat['sub_total'] ?>
                                                            </td>
                                                            <td>
                                                                <?= ($row_surat['ppn']) ? $row_surat['ppn'] : '0%'; ?>
                                                            </td>
                                                            <td>
                                                                <?= ($r_barang['jumlah_barang']) ? $r_barang['jumlah_barang'] : 'Kosong'; ?>
                                                            </td>
                                                            <td>
                                                                <button
                                                                    onclick="window.location.href='/surat.php?id=<?= $id_surat ?>'"
                                                                    class="btn btn-primary">Cetak Invoice</button>
                                                            </td>
                                                            <td>
                                                                <span>
                                                                    <a href="?page=edit&id=<?= $id_surat ?>" data-toggle="tooltip"
                                                                        data-placement="top" title="" data-original-title="Edit">
                                                                        <i class="fa fa-pencil color-muted m-r-5"></i>
                                                                    </a>
                                                                    <a href="?page=del&id=<?= $id_surat ?>" data-toggle="tooltip"
                                                                        data-placement="top" title="" data-original-title="Close">
                                                                        <i class="fa fa-close color-danger"></i>
                                                                    </a>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $no++;
                                                    }
                                                } else { ?>
                                                    <div class="alert alert-primary">Tidak ada data ditemukan silahkan Tambah
                                                        Data
                                                        <a href="?page=add" class="alert-link">Click Disini</a>
                                                    </div>
                                                <?php } ?>
                                            </tbody>
                                            <!-- <tfoot>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Position</th>
                                                        <th>Office</th>
                                                        <th>Age</th>
                                                        <th>Start date</th>
                                                        <th>Salary</th>
                                                    </tr>
                                                </tfoot> -->

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--**********************************
            Content body end
        ***********************************-->
            <?php } ?>
        </div>
        <!--**********************************
        Main wrapper end
    ***********************************-->

        <!--**********************************
        Scripts
    ***********************************-->
        <script>
            var urlParams = new URLSearchParams(window.location.search);
            var id = urlParams.get('id');
        </script>
        <script src="plugins/common/common.min.js"></script>
        <script src="js/custom.min.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/gleek.js"></script>
        <script src="js/styleSwitcher.js"></script>
        <script src="./plugins/moment/moment.js"></script>
        <script src="./plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
        <!-- Clock Plugin JavaScript -->
        <script src="./plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
        <!-- Color Picker Plugin JavaScript -->
        <script src="./plugins/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
        <script src="./plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
        <script src="./plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
        <!-- Date Picker Plugin JavaScript -->
        <script src="./plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <!-- Date range Plugin JavaScript -->
        <script src="./plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <script src="./plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

        <script src="./js/plugins-init/form-pickers-init.js"></script>

        <!-- Data table  javascript-->
        <script src="./plugins/tables/js/jquery.dataTables.min.js"></script>
        <script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
        <script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
</body>

</html>