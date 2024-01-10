<?php
$actArray = [
    'add' => 't-surat-rapat.php',
    'edit' => 'edit-surat.php',
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
    // Ambil nilai parameter 'gagal' dari URL
    $gagal = isset($_GET['gagal']) ? $_GET['gagal'] : '';

    // Periksa nilai parameter dan berikan respon sesuai
    if ($gagal == 'id-kosong') {
        echo '<div id="hapus" class="alert alert-warning">Data Kosong</div>';
        echo '<script>
setTimeout(function() {
var successMessage = document.getElementById("hapus");
successMessage.style.display = "none";
}, 5000); // 3000 milidetik atau 3 detik
</script>';
    }
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

        $sql = mysqli_query($conn, "DELETE a, b FROM tbl_surat a LEFT JOIN tbl_s_rapat b ON a.id = b.id_surat WHERE a.id = '$id'");

        if ($sql === false) {
            echo '<div class="alert alert-warning">Gagal Menghapus Data!</div>';
            // Log pesan kesalahan untuk referensi internal jika diperlukan
            error_log("Gagal menghapus data: " . mysqli_error($conn));
        } else {
            echo '<div class="alert alert-info">Data berhasil dihapus!</div>';
            $_SESSION['hapus'] = "Data berhasil diahapus";
            ?>
            <script>window.location.href = "?sur=rapat";</script>
            <?php
            exit(); // Opsional: Menghentikan eksekusi script setelah menampilkan pesan sukses
        }
    }


    $id = $_SESSION['oauth_id'];
    $sql_u = "SELECT telp, alamat  FROM tbl_users WHERE oauth_id = '$id'";
    $res_s = mysqli_query($conn, $sql_u);
    $rows = $res_s->fetch_assoc();
    // Cek apakah data kosong
    if (!empty($rows['telp']) || !empty($rows['alamat'])) {
        // Tampilkan modal karena data kosong
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Data Faktur
                            </h4>
                            <button type="button" onclick="window.location.href='?sur=rapat&page=add'"
                                class="btn btn-rounded mb-1 btn-outline-info">Tambah
                                Data <span class="btn-icon-right"><i class="fa fa-plus color-info"></i></span>
                            </button>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th>No.Surat</th>
                                            <th>Perihal</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Tempat</th>
                                            <th>Acara</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query_surat = mysqli_query($conn, 'SELECT * FROM tbl_s_rapat ORDER BY id DESC');
                                        if (mysqli_num_rows($query_surat) > 0) {
                                            $no = 1;
                                            $hasil = 0;
                                            while ($row_surat = mysqli_fetch_array($query_surat)) {
                                                $id_surat = $row_surat["id"];
                                                // Tampilkan data surat dan jumlah barang
                                                $date = tanggalWaktu($row_surat['tanggal']);
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= $no ?>
                                                    </td>
                                                    <td>
                                                        <?= $row_surat['nomor_surat'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row_surat['perihal'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $date['tanggal'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $date['waktu'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row_surat['tmpt'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row_surat['acara'] ?>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group mb-2 btn-group-sm">
                                                            <button type="button"
                                                                onclick="window.open('./surat.php?id=<?= $id_surat ?>', '_blank')"
                                                                class="btn btn-xs btn-info">Cetak</button>
                                                            <button type="button"
                                                                onclick="window.location.href='?sur=rapat&page=edit&id=<?= $id_surat ?>'"
                                                                class="btn btn-xs btn-primary" data-toggle="modal"
                                                                data-target="#basicModal<?= $id_surat ?>">Edit</button>
                                                            <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                                                data-target="#basicModal<?= $id_surat ?>">Hapus</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <div class="bootstrap-modal">
                                                    <!-- Button trigger modal -->
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="basicModal<?= $id_surat ?>" style="display: none;"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
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
                                                                        <input type="hidden" name="id" value="<?= $id_surat ?>">
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
                                                <a href="?sur=rapat&page=add" class="alert-link">Click Disini</a>
                                            </div>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            style="display: block;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Data Diri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST">
                            <div class="form-group">
                                <label for="telp" class="col-form-label">Nomer Telpon:</label>
                                <input type="number" class="form-control" name="telp" id="telp">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Alamat:</label>
                                <textarea class="form-control" name="alamat" id="message-text"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="data" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_REQUEST['data'])) {
            $telp = $_POST['telp'];
            $alamat = $_POST['alamat'];

            $sql_i = "UPDATE tbl_users SET telp = '$alamat', alamat = '$alamat' WHERE oauth_id = '$id'";
            $res = mysqli_query($conn, $sql_i);
            // Data tidak kosong, lanjutkan dengan logika yang ada
            if ($res === true) {
                echo '<div class="alert alert-info">Data berhasil dihapus!</div>';
                die();
            } else {
                echo '<div class="alert alert-warning">Gagal Menambah Data!</div>';
                // Log pesan kesalahan untuk referensi internal jika diperlukan
                error_log("Gagal menghapus data: " . mysqli_error($conn));

            }
        }
    }
} ?>