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
    $tanggal_obj = DateTime::createFromFormat("l j F Y - H:i", $date);
    $hari = $tanggal_obj->format("l");
    $tanggal = $tanggal_obj->format("j");
    $bulan = $tanggal_obj->format("F");
    $tahun = $tanggal_obj->format("Y");
    $waktu = $tanggal_obj->format("H:i");

    $bulan = str_replace(
        ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        $bulan
    );
    // Ubah hari ke dalam bahasa Indonesia
    $tanggal1 = $hari . ', ' . $tanggal . ' ' . $bulan . ' ' . $tahun;
    $tanggal2 = $tanggal . ' ' . $bulan . ' ' . $tahun;
    // Ubah bulan ke dalam bahasa Indonesia


    return ['hari-tanggal' => $tanggal1, 'waktu' => $waktu, 'tanggal' => $tanggal2, 'bulan' => $bulan];
}

