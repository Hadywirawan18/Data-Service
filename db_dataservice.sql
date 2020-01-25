-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jan 2020 pada 12.28
-- Versi server: 10.1.30-MariaDB
-- Versi PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dataservice`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`nama_pelanggan`, `no_hp`, `alamat`) VALUES
('Pelanggan Kedua', '0823403718812', 'Lost'),
('Pelanggan Ketiga', '082340371883', 'Sandik'),
('Pelanggan Pertama', '08234567890', 'Sandik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_proses_service`
--

CREATE TABLE `tbl_proses_service` (
  `id` varchar(255) NOT NULL,
  `tgl_terima` date DEFAULT NULL,
  `jenis_barang` varchar(25) DEFAULT NULL,
  `merk` varchar(255) DEFAULT NULL,
  `model_seri` varchar(255) DEFAULT NULL,
  `sn` varchar(255) DEFAULT NULL,
  `kelengkapan` varchar(255) DEFAULT NULL,
  `kerusakan` varchar(255) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `kondisi` varchar(255) DEFAULT NULL,
  `tindakan` varchar(255) DEFAULT NULL,
  `biaya` int(255) DEFAULT NULL,
  `tgl_dikerjakan` date DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `tgl_ambil` date DEFAULT NULL,
  `garansi` varchar(30) DEFAULT NULL,
  `pengambil` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_proses_service`
--

INSERT INTO `tbl_proses_service` (`id`, `tgl_terima`, `jenis_barang`, `merk`, `model_seri`, `sn`, `kelengkapan`, `kerusakan`, `no_hp`, `status`, `kondisi`, `tindakan`, `biaya`, `tgl_dikerjakan`, `catatan`, `tgl_ambil`, `garansi`, `pengambil`) VALUES
('5e1dcc755384b', '2020-01-14', 'Laptop', 'Acer', 'E5-476G', 'NXGGSN00123456785767800', 'UNIT', 'NO DISPLAY', '0823403718812', 'selesai', 'Sudah Jadi', 'Replaced LCD', 600000, '2020-01-14', '', NULL, NULL, NULL),
('5e1dcc8a31231', '2020-01-14', 'Laptop', 'Acer', 'E5-476G', 'NXGGSN00123456785767900', 'UNIT', 'NO DISPLAY', '08234567890', 'diambil', 'Sudah Jadi', 'SERVICE MAINBOARD', 1350000, '2020-01-16', 'SPEAKER DEAD', '2020-01-18', '1 Minggu', 'Lia'),
('5e1dec3f8970b', '2020-01-14', 'Laptop', 'Acer', 'E5-476G', 'NXGGSN00123456785767700', 'UNIT', 'NO POWER', '082340371883', 'selesai', 'Sudah Jadi', 'SERVICE MB', 500000, '2020-01-18', 'KEYBOARD ERROR', '2020-01-18', '1 Bulan', 'Hadi'),
('5e21bc3b7fc40', '2020-01-17', 'Laptop', 'Acer', 'E5-476G', 'NXGGSN00123456785767900', 'UNIT', 'RECOVERY ORIGINAL WINDOWS', '08234567890', 'proses', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('5e21c0cc8d3b9', '2020-01-17', 'Laptop', 'Acer', 'E5-477G', 'NXGGSN00123456785767500', 'UNIT', 'NO POWER', '08234567890', 'diambil', 'Tidak Bisa', 'Check', 25000, '2020-01-17', 'No Part', '2020-01-17', 'Tidak Ada', 'Hadi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`username`, `nama`, `password`) VALUES
('diiy18', 'Hadi', '181218'),
('t', 'test', 't'),
('thl28', 'Thalia', '28mei'),
('yan24', 'Yan', '2424');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_proses_service`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_proses_service` (
`id` varchar(255)
,`nama_pelanggan` varchar(255)
,`tgl_terima` date
,`jenis_barang` varchar(25)
,`merk` varchar(255)
,`model_seri` varchar(255)
,`sn` varchar(255)
,`kelengkapan` varchar(255)
,`kerusakan` varchar(255)
,`status` varchar(255)
,`no_hp` varchar(15)
,`alamat` varchar(255)
,`kondisi` varchar(255)
,`tindakan` varchar(255)
,`biaya` int(255)
,`tgl_dikerjakan` date
,`catatan` varchar(255)
,`tgl_ambil` date
,`garansi` varchar(30)
,`pengambil` varchar(30)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `view_proses_service`
--
DROP TABLE IF EXISTS `view_proses_service`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_proses_service`  AS  select `tbl_proses_service`.`id` AS `id`,`tbl_pelanggan`.`nama_pelanggan` AS `nama_pelanggan`,`tbl_proses_service`.`tgl_terima` AS `tgl_terima`,`tbl_proses_service`.`jenis_barang` AS `jenis_barang`,`tbl_proses_service`.`merk` AS `merk`,`tbl_proses_service`.`model_seri` AS `model_seri`,`tbl_proses_service`.`sn` AS `sn`,`tbl_proses_service`.`kelengkapan` AS `kelengkapan`,`tbl_proses_service`.`kerusakan` AS `kerusakan`,`tbl_proses_service`.`status` AS `status`,`tbl_pelanggan`.`no_hp` AS `no_hp`,`tbl_pelanggan`.`alamat` AS `alamat`,`tbl_proses_service`.`kondisi` AS `kondisi`,`tbl_proses_service`.`tindakan` AS `tindakan`,`tbl_proses_service`.`biaya` AS `biaya`,`tbl_proses_service`.`tgl_dikerjakan` AS `tgl_dikerjakan`,`tbl_proses_service`.`catatan` AS `catatan`,`tbl_proses_service`.`tgl_ambil` AS `tgl_ambil`,`tbl_proses_service`.`garansi` AS `garansi`,`tbl_proses_service`.`pengambil` AS `pengambil` from (`tbl_pelanggan` join `tbl_proses_service` on((`tbl_proses_service`.`no_hp` = `tbl_pelanggan`.`no_hp`))) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`no_hp`);

--
-- Indeks untuk tabel `tbl_proses_service`
--
ALTER TABLE `tbl_proses_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_hp` (`no_hp`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`username`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_proses_service`
--
ALTER TABLE `tbl_proses_service`
  ADD CONSTRAINT `tbl_proses_service_ibfk_1` FOREIGN KEY (`no_hp`) REFERENCES `tbl_pelanggan` (`no_hp`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
