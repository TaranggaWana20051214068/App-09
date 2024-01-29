<?php
include("terbilang.php");
if (!isset($_SESSION['login'])) {
    $_SESSION['timeOut'] = 'Silahkan Login Kembali';
    header('Location: login.php');
    die();
}
if (empty($_REQUEST['id'])) {
    ?>
    <script>
        sessionStorage.setItem('err', 'Error!');
        window.location.href = "?sur=rapat&gagal=id-kosong"</script>
    <?php
} else {
    $id = $_GET['id'];

}
$judul = 'Edit Surat';


$sql = mysqli_query($conn, "SELECT * FROM tbl_s_rapat WHERE id = '$id'");
$row = mysqli_fetch_array($sql);

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
                                <label class="col-lg-4 col-form-label" for="perihal">Perihal <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="perihal" name="perihal"
                                        placeholder="Masukkan perihal" value="<?= $row['perihal'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="date-format">Tanggal dan Waktu Dimulai <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" name="tanggal" class="form-control"
                                        placeholder="Masukkan tanggal Acara" id="date-format" data-dtp="dtp_h1kiw"
                                        value="<?= $row['tanggal'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="end">Waktu Selesai<span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6 input-group clockpicker" data-placement="top">
                                    <input id="end" class="form-control clock" name="end" placeholder="Selesai"
                                        value="<?= $row['waktu_s'] ?>">
                                    <span class="input-group-append"><span class="input-group-text"><i
                                                class="fa fa-clock-o"></i></span></span>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="tmpt">Tempat Acara <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="tmpt" name="tmpt"
                                        placeholder="Masukkan tempat" value="<?= $row['tmpt'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="comment">Acara <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <textarea class="form-control h-150px" placeholder="Masukkan Acara" rows="6"
                                        id="comment" name="acara" value="<?= $row['acara'] ?>"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-8 ml-auto">
                                <button type="button" onclick="submitx(<?= $id ?>);"
                                    class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function submitx(id) {

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data akan di ubah!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "kirim",
            preConfirm: () => {
                const perihal = document.getElementById('perihal').value;
                const tanggal = document.getElementById('date-format').value;
                const waktu = document.getElementById('end').value;
                const tmpt = document.getElementById('tmpt').value;
                const acara = document.getElementById('comment').value;
                const tbl = 'tbl_s_rapat';
                const kolom = 'perihal, tanggal, waktu_s, tmpt, acara';
                return {
                    id,
                    tbl,
                    kolom,
                    perihal,
                    tanggal,
                    waktu,
                    tmpt,
                    acara
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const data = [
                    result.value.id,
                    result.value.tbl,
                    result.value.kolom,
                    result.value.perihal,
                    result.value.tanggal,
                    result.value.waktu,
                    result.value.tmpt,
                    result.value.acara
                ];
                const jsonData = JSON.stringify(data);
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
                                        text: "Anda Berhasil Mengubah Data.",
                                        icon: "success"
                                    }).then(() => {
                                        window.location.href = "?sur=rapat";
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Maaf...",
                                        text: "Terjadi Kesalahan. Silakan Coba Lagi!"
                                    }).then(() => {
                                        window.location.href = "?sur=rapat&edit=<?= $id ?>";
                                    });
                                }
                            } catch (error) {
                                console.error("Error parsing JSON response:", error);
                            }
                        } else {
                            console.error("HTTP request failed with status:", this.status);
                        }
                    }
                };

                xhttp.open("POST", "proses_edit.php", true);
                xhttp.setRequestHeader("Content-Type", "application/json");
                xhttp.send(jsonData);
            }
            // Hancurkan objek XMLHttpRequest setelah digunakan
            xhttp = null;
        });
    }

</script>