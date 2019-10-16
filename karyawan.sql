-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Okt 2019 pada 10.11
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `karyawan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bagian`
--

CREATE TABLE `bagian` (
  `bagian` varchar(30) DEFAULT NULL,
  `bagian_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bagian`
--

INSERT INTO `bagian` (`bagian`, `bagian_id`) VALUES
('Rotary', 1),
('Hot Press', 2),
('Repaire Core', 3),
('Glue', 4),
('Inspections', 5),
('Face Back', 6),
('Dry Core', 7),
('Finishing', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot`
--

CREATE TABLE `bobot` (
  `id` bigint(50) NOT NULL,
  `bobot` int(50) NOT NULL,
  `biaya` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bobot`
--

INSERT INTO `bobot` (`id`, `bobot`, `biaya`) VALUES
(1, 3, 1),
(2, 2, 1),
(3, 5, 1),
(4, 3, 1),
(5, 4, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto`
--

CREATE TABLE `foto` (
  `id` bigint(50) NOT NULL,
  `id_karyawan` varchar(50) NOT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `foto`
--

INSERT INTO `foto` (`id`, `id_karyawan`, `file`) VALUES
(1, '', '20150717-0019.jpeg'),
(2, '', '20150717-0020.jpeg'),
(3, '', '20150717-0021.jpeg'),
(4, '', '20150717-0022.jpeg'),
(5, '<br />\r\n<b>Notice</b>:  Undefined variable: id in ', '<br />\r\n<b>Notice</b>:  Undefined variable: id in <b>C:\\xampp\\htdocs\\wisata\\tambah-tempat.php</b> on line <b>182</b><br />\r\n_360923.png'),
(9, '', '20150717-0018.jpeg'),
(10, '', 'A11.2015.09075.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` bigint(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `nama`, `link`, `status`) VALUES
(1, 'Rekomendasi Karyawan', 'index.php', '0'),
(2, 'Daftar Karyawan', 'daftar-karyawan.php', '0'),
(3, 'Tambah Karyawan', 'tambah-karyawan.php', '0'),
(9, 'Logout', 'action.php?action=logout', '0'),
(31, 'Rekomendasi Karyawan', 'index.php', '1'),
(39, 'Logout', 'action.php?action=logout', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tempat`
--

CREATE TABLE `tempat` (
  `id` bigint(50) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `bagian_id` int(50) NOT NULL,
  `disiplin` int(50) DEFAULT NULL,
  `kinerja` int(50) DEFAULT NULL,
  `prilaku` int(50) DEFAULT NULL,
  `kerjasama` int(50) DEFAULT NULL,
  `ketrampilan` int(50) DEFAULT NULL,
  `deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tempat`
--

INSERT INTO `tempat` (`id`, `nama`, `bagian_id`, `disiplin`, `kinerja`, `prilaku`, `kerjasama`, `ketrampilan`, `deskripsi`) VALUES
(35, 'ita rahardyan', 6, 3, 4, 4, 4, 4, 'NIK 05.3657'),
(36, 'Ita Budi Retno', 6, 3, 4, 5, 3, 3, 'NIK 05.3658'),
(37, 'Nurul Khasanah', 6, 3, 3, 4, 2, 3, 'NIK 05.3659'),
(38, 'Deasy Wahyuningsih', 6, 2, 3, 2, 3, 3, 'NIK 05.3660'),
(39, 'uswatun k', 6, 3, 2, 3, 3, 3, 'NIK 05.3661'),
(40, 'Sholekah', 8, 3, 4, 3, 2, 4, 'NIK 05.3662'),
(42, 'Khalmiyatuzzakariyah', 8, 3, 3, 3, 3, 3, 'NIK 05.3663'),
(43, 'Umi Salamah', 8, 2, 4, 2, 3, 4, 'NIK 05.3699'),
(44, 'Priska', 2, 4, 4, 3, 2, 4, 'NIK 05.3667'),
(45, 'Desti Irma Irvianty', 4, 3, 4, 2, 4, 3, 'NIK 05.3668'),
(46, 'Desti Irma Irvianty', 4, 3, 4, 2, 4, 3, 'NIK 05.3668'),
(47, 'Elma Mustagfiroh', 4, 3, 4, 3, 3, 3, 'NIK 05.3669'),
(48, 'ddf', 2, 3, 4, 4, 4, 4, '4'),
(49, 'ddddssss', 2, 3, 4, 5, 4, 4, '4we'),
(50, 'darwin', 2, 4, 3, 4, 4, 4, 'NIk 0532156'),
(51, 'janet', 2, 5, 3, 4, 3, 3, 'NIk 25465'),
(52, 'Aditya', 3, 3, 3, 3, 3, 3, 'bagus'),
(53, 'juhan', 2, 10, 10, 10, 10, 10, 'ya'),
(54, 'inu', 4, 1, 1, 1, 1, 1, 'n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_lengkap` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `status` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `nama_lengkap`, `email`, `password`, `status`) VALUES
(3, 'Maulana', 'AMaulanaS', 'AMaualanaS@gmail.com', '3af4b225867f3036733b13733d08257f', 0),
(4, 'admin', 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 0),
(5, 'user', 'user', 'user@user.com', 'ee11cbb19052e40b07aac0ca060c23ee', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`bagian_id`);

--
-- Indeks untuk tabel `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tempat`
--
ALTER TABLE `tempat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`,`username`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bobot`
--
ALTER TABLE `bobot`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tempat`
--
ALTER TABLE `tempat`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
