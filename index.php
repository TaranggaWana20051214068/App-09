<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include('include/head.php');
include('include/functions.php');


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
            if (isset($_SESSION['hapus'])) {
                echo '<div id="hapus" class="alert alert-info">' . $_SESSION['hapus'] . '</div>';
                echo '<script>
                setTimeout(function() {
                    var successMessage = document.getElementById("hapus");
                    successMessage.style.display = "none";
                }, 5000); // 3000 milidetik atau 3 detik
                </script>';
                unset($_SESSION['hapus']);
            }
            if (isset($_REQUEST['delet'])) {
                $id = $_POST['id'];

                $sql = mysqli_query($conn, "DELETE a, b FROM tbl_surat a LEFT JOIN tbl_barang b ON a.id = b.id_surat WHERE a.id = '$id'");

                if ($sql === false) {
                    echo '<div class="alert alert-warning">Gagal Menghapus Data!</div>';
                    // Log pesan kesalahan untuk referensi internal jika diperlukan
                    error_log("Gagal menghapus data: " . mysqli_error($conn));
                } else {
                    echo '<div class="alert alert-info">Data berhasil dihapus!</div>';
                    $_SESSION['hapus'] = "Data berhasil diahapus";
                    ?>
                    <script>window.location.href = "index.php";</script>
                    <?php
                    exit(); // Opsional: Menghentikan eksekusi script setelah menampilkan pesan sukses
                }
            }

            $judul = "Halaman Utama";
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
                                        </button>
                                    </h4>

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
                                                                    onclick="window.open('/surat.php?id=<?= $id_surat ?>', '_blank')"
                                                                    class="btn mb-1 btn-primary btn-sm">Cetak
                                                                    Invoice</button>
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
                                                                    <button type="button" class="btn btn-sm btn-primary btn-danger"
                                                                        data-toggle="modal"
                                                                        data-target="#basicModal<?= $id_surat ?>">Hapus</button>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <div class="bootstrap-modal">
                                                            <!-- Button trigger modal -->
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="basicModal<?= $id_surat ?>"
                                                                style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Hapus Data</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal"><span>×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">Yakin ingin menghapus?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <form method="POST" action="#">
                                                                                <input type="hidden" name="id"
                                                                                    value="<?= $id_surat ?>">
                                                                                <button type="button" class="btn btn-secondary"
                                                                                    data-dismiss="modal">Close</button>
                                                                                <button type="submit" name="delet"
                                                                                    class="btn btn-primary btn-danger">Hapus</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
        <?php include('include/footer.php'); ?>
</body>

</html>