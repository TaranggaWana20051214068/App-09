<?php
function rupiah($angka)
{
    $hasil = 'Rp ' . number_format($angka, 0, ",", ".");
    return $hasil;
}
function ubahHari($hariInggris)
{
    $hari = '';
    switch ($hariInggris) {
        case 'Monday':
            $hari = 'Senin';
            break;
        case 'Tuesday':
            $hari = 'Selasa';
            break;
        case 'Wednesday':
            $hari = 'Rabu';
            break;
        case 'Thursday':
            $hari = 'Kamis';
            break;
        case 'Friday':
            $hari = 'Jumat';
            break;
        case 'Saturday':
            $hari = 'Sabtu';
            break;
        case 'Sunday':
            $hari = 'Minggu';
            break;
    }
    return $hari;
}

function tanggalWaktu($date)
{
    // Explode tanggal dan waktu langsung pada $date
    list($tanggal2, $waktu) = explode(' - ', $date);

    // Explode tanggal ke dalam array
    $indoDate = explode(" ", substr($tanggal2, 0, 25));

    // Pastikan indeks 0, 1, 2, dan 3 ada sebelum diakses
    $hari = isset($indoDate[0]) ? ubahHari($indoDate[0]) : '';
    $tanggal = isset($indoDate[1]) ? $indoDate[1] : '';
    $bulan = isset($indoDate[2]) ? $indoDate[2] : '';
    $tahun = isset($indoDate[3]) ? $indoDate[3] : '';
    $bulan = str_replace(
        ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        $bulan
    );
    // Ubah hari ke dalam bahasa Indonesia
    $tanggal1 = $hari . ', ' . $tanggal . ' ' . $bulan . ' ' . $tahun;

    // Ubah bulan ke dalam bahasa Indonesia


    return ['tanggal' => $tanggal1, 'waktu' => $waktu];
}

