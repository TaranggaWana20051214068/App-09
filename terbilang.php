<?php
// Fungsi untuk mengubah angka menjadi terbilang dalam bahasa Indonesia
function terbilang($angka)
{
  // Array untuk menyimpan kata bilangan
  $arr = [
    "",
    "Satu",
    "Dua",
    "Tiga",
    "Empat",
    "Lima",
    "Enam",
    "Tujuh",
    "Delapan",
    "Sembilan",
    "Sepuluh",
    "Sebelas",
    "Dua Belas",
    "Tiga Belas",
    "Empat Belas",
    "Lima Belas",
    "Enam Belas",
    "Tujuh Belas",
    "Delapan Belas",
    "Sembilan Belas"
  ];
  // Fungsi untuk mengonversi angka menjadi terbilang
  if ($angka < 12)
    return " " . $arr[$angka];
  elseif ($angka < 20)
    return terbilang($angka - 10) . " belas";
  elseif ($angka < 100)
    return terbilang($angka / 10) . " puluh" . terbilang($angka % 10);
  elseif ($angka < 200)
    return "seratus" . terbilang($angka - 100);
  elseif ($angka < 1000)
    return terbilang($angka / 100) . " ratus" . terbilang($angka % 100);
  elseif ($angka < 2000)
    return "seribu" . terbilang($angka - 1000);
  elseif ($angka < 1000000)
    return terbilang($angka / 1000) . " ribu" . terbilang($angka % 1000);
  elseif ($angka < 1000000000)
    return terbilang($angka / 1000000) . " juta" . terbilang($angka % 1000000);

  // Mengonversi angka menjadi terbilang
  return terbilang($angka);
}


// Contoh penggunaan
// $angka = 10000;
// echo terbilang($angka) . " Rupiah";
?>