-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Nov 2022 pada 02.30
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apoteker`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `efekSamping` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `kategori`, `deskripsi`, `efekSamping`) VALUES
(1, 'Paracetamol', 'Obat untuk panas', 'pusingg'),
(22, 'Antibiotik', 'Membunuh Bakteri Dan Kuman', 'Mual Mual'),
(23, 'asdsad', 'asda', 'sdasdasd'),
(24, 'asdasd', 'asdasd', 'asdasdasd'),
(25, 'asdas', 'dasdsa', 'dsadsad'),
(26, 'asdas', 'dsad', 'sadsadsa'),
(27, 'sada', 'sdasd', 'asdasdas'),
(28, 'asda', 'sdasd', 'asdasd'),
(29, 'asdsad', 'sadasdasd', 'sadasdasd'),
(30, 'sadsad', 'sadas', 'dasdasd'),
(31, 'asdasd', 'asdsa', 'dasdasd'),
(32, 'asdasd', 'asda', 'sdasdas'),
(33, 'asdas', 'dasd', 'asdasd'),
(40, 'asdas', 'dasd', ''),
(41, 'asda', 'sdsad', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `penyimpanan` varchar(50) NOT NULL,
  `Stock` int(11) NOT NULL,
  `Unit` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `t_kadaluarsa` date NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `h_beli` int(11) NOT NULL,
  `h_jual` int(11) NOT NULL,
  `pemasok` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `nama`, `penyimpanan`, `Stock`, `Unit`, `kategori`, `t_kadaluarsa`, `deskripsi`, `h_beli`, `h_jual`, `pemasok`) VALUES
(1, 'Penicilin', 'RAK A-2', 0, 'Kaplet', 'Antibiotik', '2010-12-15', 'asdasdasd\r\nsadsadsadasdasdsa\r\ndasdsadsadsadsadsad', 10000, 100000, 'Kimia Farma'),
(2, 'Jjjjj', 'RAK A-3', 123, 'Kapsul', 'Paracetamol', '2022-11-27', 'asdasd', 213213, 213213, 'Kimia Farma'),
(3, 'jasjdjasdj', 'RAK B-3', 100, 'Cair', 'Antibiotik', '2020-02-21', 'sadasdsa', 123, 21323, 'Kimia Farma'),
(4, 'asdasd', 'RAK 3-C', 12, 'Cair', 'Antibiotik', '2020-11-05', 'asdasd', 213, 213213, 'Kimia Farma'),
(5, 'sadsa', 'dasdasd', 213123, 'Kapsul', 'Paracetamol', '2022-11-14', 'asdasd', 213, 2123123, 'Kimia Farma');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasok`
--

CREATE TABLE `pemasok` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemasok`
--

INSERT INTO `pemasok` (`id`, `nama`) VALUES
(1, 'Kimia Farma'),
(2, 'Gryzia'),
(3, 'Sanca Farma');

-- --------------------------------------------------------

--
-- Struktur dari tabel `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `units`
--

INSERT INTO `units` (`id`, `unit`) VALUES
(1, 'Kapsul'),
(2, 'Cair'),
(3, 'Tablet'),
(4, 'Kaplet');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 1337),
(2, 'user', '5ce18dd788da69615cf285d404daa225', 1),
(16, 'manajement', '202cb962ac59075b964b07152d234b70', 2),
(17, 'asd', '7815696ecbf1c96e6894b779456d330e', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pemasok`
--
ALTER TABLE `pemasok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
