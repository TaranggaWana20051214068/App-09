<?php
if (!isset($_SESSION['login'])) {
    $_SESSION['timeOut'] = 'Silahkan Login Kembali';
    header('Location: login.php');
    die();
}
$actArray = [
    'add' => 't-surat-edaran.php',
    'edit' => 'edit-surat.php',
    'surat' => 'cetak-surat-edaran.php'

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

        $sql = mysqli_query($conn, "DELETE a, b FROM tbl_surat a LEFT JOIN tbl_s_edar b ON a.id = b.id_surat WHERE a.id = '$id'");

        if ($sql === false) {
            echo '<div class="alert alert-warning">Gagal Menghapus Data!</div>';
            // Log pesan kesalahan untuk referensi internal jika diperlukan
            error_log("Gagal menghapus data: " . mysqli_error($conn));
        } else {
            echo '<div class="alert alert-info">Data berhasil dihapus!</div>';
            $_SESSION['hapus'] = "Data berhasil diahapus";
            ?>
            <script>window.location.href = "?sur=edaran";</script>
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
                            <h4 class="card-title">Data Surat
                            </h4>
                            <button type="button" onclick="window.location.href='?sur=edaran&page=add'"
                                class="btn btn-rounded mb-1 btn-outline-info">Tambah
                                Data <span class="btn-icon-right"><i class="fa fa-plus color-info"></i></span>
                            </button>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th>Perihal</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query_surat = mysqli_query($conn, 'SELECT * FROM tbl_s_edar ORDER BY id DESC');
                                        if (mysqli_num_rows($query_surat) > 0) {
                                            $no = 1;
                                            $hasil = 0;
                                            while ($row_surat = mysqli_fetch_array($query_surat)) {
                                                $id_surat = $row_surat["id"];
                                                // Tampilkan data surat dan jumlah barang
                                                if ($row_surat['tanggal']) {
                                                    $date = tanggalWaktu($row_surat['tanggal']);
                                                    $q_waktu = DateTime::createFromFormat("H:i:s", $row_surat['waktu_s']);
                                                    $waktu = $q_waktu->format('H:i');
                                                }
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= $no ?>
                                                    </td>
                                                    <td>
                                                        <?= $row_surat['perihal'] ?>
                                                    </td>
                                                    <td>
                                                        <?= ($row_surat['tanggal']) ? $date['tanggal'] : '-'; ?>
                                                    </td>
                                                    <td>
                                                        <?= $row_surat['waktu_s'] ?>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group mb-2 btn-group-sm">
                                                            <button type="button"
                                                                onclick="window.open('./cetak-surat-edaran.php?id=<?= $id_surat ?>', '_blank')"
                                                                class="btn btn-xs btn-info">Cetak</button>
                                                            <button type="button"
                                                                onclick="window.location.href='?sur=edaran&page=edit&id=<?= $id_surat ?>'"
                                                                class="btn btn-xs btn-primary">Edit</button>
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
                                                <a href="?sur=edaran&page=add" class="alert-link">Click Disini</a>
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
        <script>
            const succPesan = sessionStorage.getItem('succ');
            if (succPesan) {
                Swal.fire({
                    icon: "success",
                    title: succPesan,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
            sessionStorage.removeItem('succ');
        </script>
        <?php
    } else {
        ?>
        <script>
            Swal.fire({
                title: 'Form Data Diri',
                html: `<input type="number" id="telp" class="swal2-input" placeholder="Nomor Telepon">
                                                                                                                                                       <input type="text" id="alamat" class="swal2-input" placeholder="Alamat">`,
                allowEscapeKey: false,
                allowOutsideClick: false,
                confirmButtonText: 'Kirim',
                focusConfirm: false,
                didOpen: () => {
                    const popup = Swal.getPopup();
                    telpInput = popup.querySelector('#telp');
                    alamatInput = popup.querySelector('#alamat');
                    telpInput.onkeyup = (event) => event.key === 'Enter' && Swal.clickConfirm();
                    alamatInput.onkeyup = (event) => event.key === 'Enter' && Swal.clickConfirm();
                },
                preConfirm: () => {
                    const telp = telpInput.value;
                    const alamat = alamatInput.value;
                    const id = <?= $_SESSION['user_id'] ?>;

                    if (!telp || !alamat) {
                        Swal.showValidationMessage(`Harap masukkan nomor telepon dan alamat`);
                        return false; // Menambahkan return false agar SweetAlert tidak ditutup jika validasi gagal
                    }

                    return { telp, alamat, id };
                },
            }).then((result) => {
                if (result.value) {
                    const { telp, alamat, id } = result.value;
                    const xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function () {
                        if (this.readyState == 4) {
                            if (this.status == 200) {
                                console.log(this.responseText); // Tampilkan respons dari server dalam konsol
                                try {
                                    const response = JSON.parse(this.responseText);
                                    if (response.success) {
                                        Swal.fire({
                                            title: "Berhasil!",
                                            text: "Anda berhasil menambahkan Data.",
                                            icon: "success"
                                        }).then(() => {
                                            window.location.href = '?sur=rapat';
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Maaf...",
                                            text: "Terjadi Kesalahan Silakan Coba Lagi!"
                                        }).then(() => {
                                            window.location.href = '?sur=rapat';
                                        });;
                                    }
                                } catch (error) {
                                    console.error("Error parsing JSON:", error);
                                }
                            } else {
                                console.error("HTTP request failed with status:", this.status);
                            }
                        }
                    };
                    xhttp.open("GET", "proses_data.php?ket=alamat&id=" + id + "&telp=" + telp + "&alamat=" + alamat, true);
                    xhttp.send();

                }
            });

        </script>
        <?php
    }
} ?>