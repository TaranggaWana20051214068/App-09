<?php

$judul = 'Tambah Surat Edaran';


// Mengambil data nomor surat terakhir
$sql = mysqli_query($conn, "SELECT kode, tanggal FROM tbl_s_edar ORDER BY id DESC LIMIT 1");
$result = mysqli_fetch_assoc($sql);

if (mysqli_num_rows($sql) > 0) {
    $tanggal_terakhir = $result['tanggal'];
    $tanggal_obj = DateTime::createFromFormat("l j F Y - H:i", $tanggal_terakhir);
    $tahun_terakhir = $tanggal_obj->format('Y');
    $tahun_sekarang = date("Y");
    // Periksa apakah input terakhir pada tahun yang sama
    ($tahun_sekarang == $tahun_terakhir) ? $kode = $result['kode'] + 1 : $kode = 1;
} else {
    $sql = mysqli_query($conn, "SELECT nomor_surat FROM tbl_s_edar");
    ($result = mysqli_num_rows($sql)) != 0 ? $kode = $result + 1 : $kode = 1;
}

//mulai bikin kode

$x = str_pad($kode, 2, "0", STR_PAD_LEFT);
$tahun = date('Y');
$bikin_kode = "$x/RT009/$tahun";

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
                                <label class="col-lg-4 col-form-label" for="tampilan">Nomor Surat <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="tampilan" name="tampilan"
                                        placeholder="Nomor-Surat" value="<?= $bikin_kode ?>" readonly>
                                    <input type="hidden" id="nomor_surat" value="<?= $bikin_kode ?>">
                                    <input type="hidden" id="kode" value="<?= $kode ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="perihal">Perihal <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="perihal" name="perihal"
                                        placeholder="Masukkan perihal" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="date-format">Tanggal dan Waktu Dimulai <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" name="tanggal" class="form-control"
                                        placeholder="Masukkan tanggal Acara" id="date-format" data-dtp="dtp_h1kiw"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="end">Waktu Selesai<span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6 input-group clockpicker" data-placement="top">
                                    <input id="end" class="form-control clock" name="end" placeholder="Selesai"> <span
                                        class="input-group-append"><span class="input-group-text"><i
                                                class="fa fa-clock-o"></i></span></span>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="tmpt">Tempat Acara <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="tmpt" name="tmpt"
                                        placeholder="Masukkan tempat" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="comment">Acara <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <textarea class="form-control h-150px" placeholder="Masukkan Acara" rows="6"
                                        id="comment" name="acara"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-8 ml-auto">
                                <button type="button" onclick="submitx();" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->

</div>
<script>
    function submitx() {
        const surat = document.querySelector('#nomor_surat').value;
        const kode = document.querySelector('#kode').value;
        const perihal = document.querySelector('#perihal').value;
        const tanggal = document.querySelector('#date-format').value;
        const tgl = document.querySelector('#date-format').value;
        const waktu = document.querySelector('#end').value;
        const tmpt = document.querySelector('#tmpt').value;
        const acara = document.querySelector('#comment').value;
        const tbl = 'tbl_s_edar';
        const kolom = 'nomor_surat, kode, perihal, tanggal, waktu_s, tmpt, acara, id_surat';
        const user = '<?= $_SESSION['uname'] ?>';
        const keperluan = 'edaran';
        const kolomSurat = 'tgl_surat, pemohon, keperluan';
        if (tbl) {
            const data = [
                tbl,
                kolomSurat,
                tgl,
                user,
                keperluan,
                kolom,
                surat,
                kode,
                perihal,
                tanggal,
                waktu,
                tmpt,
                acara
            ]; // Mengasumsikan result.value memiliki tipe array
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
                                    window.location.href = '?sur=edaran';
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Maaf...",
                                    text: "Terjadi Kesalahan. Silakan Coba Lagi!"
                                }).then(() => {
                                    window.location.href = '?sur=edaran&page=add';
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

            xhttp.open("POST", "proses_tambah.php", true);
            xhttp.setRequestHeader("Content-Type", "application/json");
            xhttp.send(jsonData);
        }
        // Hancurkan objek XMLHttpRequest setelah digunakan
        xhttp = null;
    }
</script>