<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include('include/head.php');
include('include/functions.php');
if (!isset($_SESSION['login'])) {
    $_SESSION['timeOut'] = 'Silahkan Login Kembali';
    header('Location: login.php');
    die();
}

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


            $judul = "Halaman Utama";
            $actArray = [
                'rapat' => 'dasboard-surat-rapat.php'

            ];
            if (isset($_REQUEST['sur'])) {
                $act = $_REQUEST['sur'];
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
                            <li class="breadcrumb-item"><a href="?">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">
                                    <?= $judul ?>
                                </a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="email-left-box">
                                        <div role="toolbar" class="toolbar">
                                            <button aria-expanded="false" data-toggle="dropdown"
                                                class="btn btn-block btn-primary dropdown-toggle" type="button">Surat
                                                <span class="caret m-l-5"></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="?sur=rapat" class="dropdown-item">Surat</a>
                                            </div>
                                        </div>
                                        <div class="mail-list mt-4"><a href="email-inbox.html"
                                                class="list-group-item border-0 text-primary p-r-0"><i
                                                    class="fa fa-inbox font-18 align-middle mr-2"></i> <b>Inbox</b> <span
                                                    class="badge badge-primary badge-sm float-right m-t-5">198</span> </a>
                                            <!-- <a href="#" class="list-group-item border-0 p-r-0"><i
                                                    class="fa fa-paper-plane font-18 align-middle mr-2"></i>Sent</a> <a
                                                href="#" class="list-group-item border-0 p-r-0"><i
                                                    class="fa fa-star-o font-18 align-middle mr-2"></i>Important <span
                                                    class="badge badge-danger badge-sm float-right m-t-5">47</span> </a>
                                            <a href="#" class="list-group-item border-0 p-r-0"><i
                                                    class="mdi mdi-file-document-box font-18 align-middle mr-2"></i>Draft</a><a
                                                href="#" class="list-group-item border-0 p-r-0"><i
                                                    class="fa fa-trash font-18 align-middle mr-2"></i>Trash</a> -->
                                        </div>
                                        <h5 class="mt-5 m-b-10">Categories</h5>
                                        <div class="list-group mail-list"><a href="#" class="list-group-item border-0">
                                                <!-- <span class="fa fa-briefcase f-s-14 mr-2"></span>Work</a>   -->
                                                <a href="#" class="list-group-item border-0"><i
                                                        class="mdi mdi-file-document-box font-18 align-middle mr-2"></i>Surat</a>
                                                <!-- <a href="#"class="list-group-item border-0"><span class="fa fa-ticket f-s-14 mr-2"></span>Support</a>  
                                    <a href="#" class="list-group-item border-0"><span class="fa fa-tags f-s-14 mr-2"></span>Social</a> -->
                                        </div>
                                    </div>
                                    <div class="email-right-box">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>No.Surat</th>
                                                        <th>Pemohon</th>
                                                        <th>Tanggal</th>
                                                        <th>Alamat</th>
                                                        <th>status</th>
                                                        <th>Keperluan</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $qry = "SELECT a.*, b.alamat 
                                                        FROM tbl_surat a
                                                        LEFT JOIN tbl_users b 
                                                        ON a.pemohon = b.full_name ORDER BY a.id DESC";
                                                    $res = mysqli_query($conn, $qry);
                                                    if (mysqli_num_rows($res) > 0) {
                                                        $no = 1;
                                                        while ($row = mysqli_fetch_assoc($res)) {
                                                            $date = tanggalWaktu($row['tgl_surat']);
                                                            ?>
                                                            <tr>
                                                                <th>
                                                                    <?= $no ?>
                                                                </th>
                                                                <td>
                                                                    <?= $row['nomer_surat'] ?>
                                                                </td>
                                                                <td>
                                                                    <?= $row['pemohon'] ?>
                                                                </td>
                                                                <td>
                                                                    <?= $date['tanggal'] ?>
                                                                </td>
                                                                <td>
                                                                    <?= $row['alamat'] ?>
                                                                </td>
                                                                <td>
                                                                    <?= ($row['status']) ? '<i class="fa fa-circle-o text-success  mr-2"></i>' . $row['status'] : '<i class="fa fa-circle-o text-warning left  mr-2"> pending</i>'; ?>
                                                                </td>
                                                                <td>
                                                                    <?= $row['keperluan'] ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    if (is_null($row['acc'])) {
                                                                        ?>
                                                                        <button type="button"
                                                                            onclick="sweetAcc(<?php echo $row['id']; ?>)"
                                                                            class="btn mb-1 btn-sm btn-warning text-white">ACC</button>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <a href="?sur=cetak"
                                                                            class="btn btn-sm btn-info btn-block">Cetak</a>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $no++;
                                                        }
                                                    } else {
                                                        ?>
                                                        <div
                                                            class="alert alert-primary h-100 d-flex flex-column justify-content-center align-items-center">
                                                            Tidak ada Permohonan Surat
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        function sweetAcc(id) {
                            Swal.fire({
                                title: "Apakah Anda yakin?",
                                text: "Menyetujui ini!",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Yes, approve it!"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Kirim permintaan AJAX ke server untuk melakukan update
                                    const xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function () {
                                        if (this.readyState == 4 && this.status == 200) {
                                            const response = JSON.parse(this.responseText);
                                            if (response.success) {
                                                Swal.fire({
                                                    title: "Approved!",
                                                    text: "Anda sudah menyetujui ini.",
                                                    icon: "success"
                                                }).then(() => {
                                                    // Ganti window.lication menjadi window.location
                                                    window.location.href = '?';
                                                });
                                            } else {
                                                Swal.fire({
                                                    icon: "error",
                                                    title: "Maaf...",
                                                    text: "Terjadi Kesalahan Silakan Coba Lagi!"
                                                });
                                            }
                                        }
                                    };

                                    xhttp.open("GET", "approve_surat.php?id=" + id, true);
                                    xhttp.send();

                                }
                            });
                        }

                    </script>
                <?php } ?>
            </div>
            <!--**********************************
            Content body end
        ***********************************-->
        </div>
        <!--**********************************
        Main wrapper end
    ***********************************-->
        <?php include('include/footer.php'); ?>
</body>

</html>