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
                'rapat' => 'dasboard-surat-rapat.php',
                'pro' => 'profile.php',
                'edaran' => 'dashboard-surat-edara.php',

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
                <div id="popup" class="popup col-md-6 col-lg-3">
                    <div class="popup-content card text-center">
                        <div class="card-body">
                            <!-- Konten pop-up -->
                            <h4 class="card-title">RT-09</h4>
                            <p class="card-text">Install RT-09 App?</p>
                            <a id="kon-popup" class="btn btn-sm btn-info btn-rounded">Install</a>
                            <a id="close-popup" class="btn btn-sm btn-danger btn-rounded">TIDAK</a>
                        </div>
                    </div>
                </div>
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
                                                <a href="?sur=rapat" class="dropdown-item">Surat Rapat</a>
                                                <a href="?sur=edaran" class="dropdown-item">Surat Edaran</a>
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
                                                                    Surat
                                                                    <?= $row['keperluan'] ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $user_id = $_SESSION['user_id'];
                                                                    if (is_null($row['acc'])) {
                                                                        ?>
                                                                        <button type="button"
                                                                            onclick="sweetAcc(<?= $row['id'] . ',' . $user_id ?>)"
                                                                            class="btn mb-1 btn-sm btn-warning text-white">ACC</button>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <button type="button"
                                                                            onclick="ctk('<?= $row['keperluan'] ?>', '<?= $row['id'] ?>');"
                                                                            class="btn btn-sm btn-info btn-block">Cetak</button>
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
                        // Check if the 'prompt' method is available
                        if ('prompt' in window) {
                            // The 'prompt' method is available, which means it's a PWA
                            // Check if the PWA is already installed
                            window.addEventListener('beforeinstallprompt', (e) => {
                                e.preventDefault(); // Prevent the default browser prompt
                                const installPrompt = e;
                                const popup = document.getElementById('popup');
                                const closeBtn = document.getElementById('close-popup');
                                const konBtn = document.getElementById('kon-popup');

                                // Fungsi untuk menampilkan pop-up
                                function showPopup() {
                                    popup.style.visibility = 'visible';
                                }

                                // Fungsi untuk menyembunyikan pop-up
                                function hidePopup() {
                                    popup.style.visibility = 'hidden';
                                }

                                function hidePopupKon() {
                                    popup.style.visibility = 'hidden';
                                    installPrompt.prompt();
                                }

                                // Tambahkan event listener untuk tombol konfirm
                                konBtn.addEventListener('click', hidePopupKon);

                                // Tambahkan event listener untuk tombol tutup
                                closeBtn.addEventListener('click', hidePopup);

                                // Tambahkan timer untuk menutup pop-up secara otomatis setelah 5 detik
                                setTimeout(() => {
                                    hidePopup();
                                }, 5000);

                                // You can now display your own custom installation popup
                                showPopup();

                                // Handle the installation process if the user chooses to install
                                installPrompt.userChoice
                                    .then((choiceResult) => {
                                        if (choiceResult.outcome === 'accepted') {
                                            // The user has accepted the installation
                                            // You can perform further actions if needed
                                        }
                                    });
                            });
                        } else {
                            // 'prompt' method is not available, indicating it's not a PWA
                            // You can take other actions or show a different UI
                        }
                    </script>
                    <script>

                        function ctk(keperluan, id) {
                            window.location.href = 'cetak-surat-' + keperluan + '.php?id=' + id;
                        }
                        function sweetAcc(id, user_id) {
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
                                                }).then(() => {
                                                    // Ganti window.lication menjadi window.location
                                                    window.location.href = '?';
                                                });;
                                            }
                                        }
                                    };

                                    xhttp.open("GET", "proses_data.php?ket=approve&id=" + id + "&user_id=" + user_id, true);
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