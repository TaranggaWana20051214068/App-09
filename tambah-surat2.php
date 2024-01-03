<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="#" id="step-form-horizontal" class="step-form-horizontal">
                <div>
                    <h4>Daftar Barang</h4>
                    <section>
                        <div class="row">
                            <h4 class="card-title">
                                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal"
                                    data-target=".bd-example-modal-lg">Tambah Barang</button>
                            </h4>
                            <div class="bootstrap-modal">
                                <!-- Large modal -->
                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tambah Data Barang</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal"><span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="basic-form">
                                                <form action="#" method="post">
                                                    <div class="form-group col-md-11 barang">
                                                        <label for="kode_barang">Kode Barang</label>
                                                        <input type="number" id="kode_barang"
                                                            class="form-control input-rounded" name="kode_barang"
                                                            placeholder="Kode Barang">
                                                    </div>
                                                    <div class="form-group col-md-11">
                                                        <label for="nama_barang">Nama Barang</label>
                                                        <input type="text" id="nama_barang"
                                                            class="form-control input-rounded" name="nama_barang"
                                                            placeholder="Nama Barang">
                                                    </div>
                                                    <div class="form-group col-md-11">
                                                        <label for="qty">QTY </label>
                                                        <input type="number" id="qty" class="form-control input-rounded"
                                                            name="qty" placeholder="QTY">
                                                    </div>
                                                    <div class="form-group col-md-11">
                                                        <labe for="harga_sat">Harga Satuan</labe>
                                                        <input type="number" id="harga_sat"
                                                            class="form-control input-rounded" name="harga_sat"
                                                            placeholder="Harga Satuan">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button name="addBarang" onclick="hapusBarang(this)"
                                                            class="btn btn-primary">Kirim<span class="btn-icon-right"><i
                                                                    class="fa fa-check"></i></span></button>
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

                                            $tableDet = array();
                                        } else {
                                            $tableDet = $_SESSION['tableDet'];
                                        }


                                        // Hapus data sebelumnya (jika ada)
                                        unset($_SESSION['tableDet']);
                                        $i = count($tableDet);
                                        $tableDet[$i]['kode_barang'] = $kode_barang;
                                        $tableDet[$i]['nama_barang'] = $nama_barang;
                                        $tableDet[$i]['qty'] = $qty;
                                        $tableDet[$i]['harga_sat'] = $harga_sat;
                                        $tableDet[$i]['i'] = $i; // Menetapkan nilai 'i' dengan variabel $i
                                        $_SESSION["tableDet"] = $tableDet;
                                    }
                                    ?>

                                </div>
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
                                                                <?= '<a href="hapus-item-surat.php?id=' . $tableDet[$i]["i"] . '" type="button" class="btn mb-1 btn-danger">Remove <span class="btn-icon-right"><i class="fa fa-close"></i></span>
                                                        </a>' ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        // Tambahkan jumlah ke total jumlah
                                                        $jumlah = (int) $tableDet[$i]['qty'] * (int) $tableDet[$i]['harga_sat'];
                                                        $subtotal += $jumlah;
                                                        $angka = $subtotal;
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
                            </div>
                    </section>
                    <h4>Data Faktur</h4>
                    <section>
                        <div class="row">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="tampilan">Nomor-Surat <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="number" class="form-control input-rounded" id="tampilan"
                                        name="tampilan" placeholder="Nomor-Surat" value="<?= $bikin_kode ?>" readonly>
                                    <input type="hidden" name="nomor_surat" value="<?= $bikin_kode ?>">
                                    <input type="hidden" name="kode" value="<?= $kode ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="date-format">Tanggal <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" name="tgl_surat" class="form-control input-rounded"
                                        placeholder="tanggal" id="mdate" data-dtp="dtp_5cLR3">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="pembuat">Pembuat <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" id="pembuat" class="form-control input-rounded" name="pembuat"
                                        placeholder="Pembuat">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="pelanggan">Pelanggan <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" id="pelanggan" class="form-control input-rounded"
                                        name="pelanggan" placeholder="Pelanggan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="alamat_pelanggan">Alamat Pelanggan
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" id="alamat_pelanggan" class="form-control input-rounded"
                                        name="alamat_pelanggan" placeholder="Alamat Pelanggan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="keterangan">Keterangan <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <textarea class="form-control h-150px" id="keterangan" name="keterangan" rows="6"
                                        id="comment"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="ppn">Ppn <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="number" class="form-control input-rounded" name="ppn" id="ppn"
                                        placeholder="ppn">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="subtotal">Subtotal <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control input-rounded" name="subtotal" value="<?php if (is_numeric($subtotal) && $subtotal >= 0) {
                                        echo $subtotal;
                                    } ?>" placeholder="subtotal">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="terbilang">terbilang <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control input-rounded" name="terbilang"
                                        id="terbilang" value="<?php if (is_numeric($angka) && $angka >= 0) {
                                            echo terbilang($angka);
                                        } ?>" placeholder="terbilang">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-8 ml-auto">
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