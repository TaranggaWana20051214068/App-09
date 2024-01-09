<?php
$judul = 'Belajar coding';
$variable_name = "hello world";


if (isset($_POST["submit"])) {
    $coding = $_POST['coding'];

}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Belajar Coding</h4>
                    <p>Buatkan fungction dengan nama rupiah yang menghasilkan rupiah sebagai hasilnya contoh = 'Rp.
                        10.000'.
                        <br>
                        Jika Ibu ani ingin membeli baso seharga 50.000 dengan jumlah 10 bakso
                    </p>
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <iframe frameBorder="0" height="450px"
                            src="https://onecompiler.com/embed/php?hideLanguageSelection=true&hideNew=true&hideTitle=true&hideStdin=true&disableCopyPaste=true&codeChangeEvent=true"
                            width="100%"></iframe>
                        <input type="text" name="coding" id="coding">
                        <input type="text" name="name_file" id="name_file">
                        <input type="text" id="keterangan">
                        <textarea class="form-control h-150px" id="file" name="file" rows="6"></textarea>
                        <button type="submit" class="btn btn-primary" name="submit">Selesai</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
<script>
    window.onmessage = function (e) {
        if (e.data && e.data.language) {
            console.log(e.data);

            // Pengecekan apakah ada output sebelum melanjutkan
            if (e.data.result && e.data.result.output !== undefined) {
                // Masukkan hasil ke dalam elemen dengan ID "coding"
                var variabel_name = 'Rp.500.000'; // Sesuaikan dengan nilai yang diharapkan
                var messageElement = document.getElementById('keterangan');
                var isSuccess = e.data.result.success && (e.data.result.output === variabel_name);
                var namefileElement = document.getElementById('name_file');
                var fileInputElement = document.getElementById('file');

                var outputElement = document.getElementById('coding');
                if (outputElement) {
                    outputElement.value = e.data.result.output || 'Tidak ada keluaran.';
                }

                // Lakukan pengecekan dengan variabel $variabel_name

                // Tampilkan pesan ke layar
                if (messageElement) {
                    messageElement.value = isSuccess ? 'Berhasil' : 'Gagal';

                    // Set nilai elemen input file
                    if (namefileElement && fileInputElement) {
                        namefileElement.value = e.data.files[0].name;
                        fileInputElement.value = e.data.files[0].content;
                    }
                }
            }
        }
    };
</script>