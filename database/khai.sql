-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jan 2024 pada 19.33
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khai`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id` int(11) NOT NULL,
  `kode_barang` bigint(20) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_sat` bigint(20) NOT NULL,
  `id_surat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`id`, `kode_barang`, `nama_barang`, `qty`, `harga_sat`, `id_surat`) VALUES
(3, 152, 'Print', 12, 1250000, 5),
(4, 5221, 'Buku', 10, 50000, 5),
(5, 2, 'Kertas', 500, 500, 7),
(6, 1, 'pulpen', 1000, 2500, 7),
(7, 5, 'buku', 15, 75000, 7),
(20, 2, 'mobil', 500, 1500000, 12),
(21, 231, 'pencil', 123, 11111, 12),
(22, 213, 'kertas', 5000, 500, 12),
(23, 213, 'kertas', 5000, 500, 12),
(24, 213, 'kertas', 5000, 500, 12),
(25, 2, 'pulpen', 10, 2000, 12),
(26, 2, 'pulpen', 10, 2000, 12),
(27, 2, 'pulpen', 10, 2000, 12),
(28, 44, 'Print', 2, 15551, 12),
(29, 231, 'buku', 50, 50000, 12),
(30, 231, 'buku', 50, 50000, 12),
(31, 231, 'buku', 50, 50000, 12),
(32, 231, 'buku', 50, 50000, 12),
(33, 231, 'buku', 50, 50000, 12),
(34, 44, 'Print', 2, 15551, 12),
(35, 213, 'kertas', 5000, 500, 12),
(36, 213, 'kertas', 5000, 500, 12),
(37, 3, 'botol', 100, 1000, 12),
(38, 0, 'Jam', 10, 100000, 13),
(39, 0, 'pencil', 100, 1000, 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surat`
--

CREATE TABLE `tbl_surat` (
  `id` int(11) NOT NULL,
  `kode` int(11) NOT NULL,
  `tgl_surat` varchar(255) NOT NULL,
  `nomer_surat` int(11) NOT NULL,
  `pembuat` varchar(255) NOT NULL,
  `pelanggan` varchar(255) NOT NULL,
  `alamat_pelanggan` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `ppn` varchar(255) DEFAULT NULL,
  `total` bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_surat`
--

INSERT INTO `tbl_surat` (`id`, `kode`, `tgl_surat`, `nomer_surat`, `pembuat`, `pelanggan`, `alamat_pelanggan`, `keterangan`, `ppn`, `total`) VALUES
(5, 2, 'Monday 01 January 2024 - 23:00', 2, 'Jangkung', 'Tarangga', 'Jl.Pulo Wonokromo', 'xxx', NULL, NULL),
(7, 3, 'Monday 01 January 2024 - 23:06', 3, 'Jangkung', 'Khai', 'Jl.xx', '22222', '10', NULL),
(12, 4, '2024-01-04', 4, 'Jangkung', 'darly', 'Jl.xx', '', '10', NULL),
(13, 5, '2024-01-04', 5, 'Jangkung', 'Khai', 'Jl.Kayu', '', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_surat` (`id_surat`);

--
-- Indeks untuk tabel `tbl_surat`
--
ALTER TABLE `tbl_surat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat`
--
ALTER TABLE `tbl_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
