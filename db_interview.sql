-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Agu 2023 pada 20.44
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_interview`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tab_karyawan`
--

CREATE TABLE `tab_karyawan` (
  `id` int(11) NOT NULL,
  `nama_karyawan` varchar(255) DEFAULT NULL,
  `kota` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tab_karyawan`
--

INSERT INTO `tab_karyawan` (`id`, `nama_karyawan`, `kota`, `foto`) VALUES
(4, 'Bagas', 1, '1691692786_b6d534ca51da8f3cb5e5.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tab_kota`
--

CREATE TABLE `tab_kota` (
  `id` int(11) NOT NULL,
  `nama_kota` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tab_kota`
--

INSERT INTO `tab_kota` (`id`, `nama_kota`) VALUES
(1, 'Jakarta'),
(2, 'Bandung'),
(3, 'Bali');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tab_karyawan`
--
ALTER TABLE `tab_karyawan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kota` (`kota`);

--
-- Indeks untuk tabel `tab_kota`
--
ALTER TABLE `tab_kota`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tab_karyawan`
--
ALTER TABLE `tab_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tab_kota`
--
ALTER TABLE `tab_kota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tab_karyawan`
--
ALTER TABLE `tab_karyawan`
  ADD CONSTRAINT `tab_karyawan_ibfk_1` FOREIGN KEY (`kota`) REFERENCES `tab_kota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
