-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Waktu pembuatan: 21 Jun 2025 pada 18.17
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik-gigi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `nama_admin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`admin_id`, `nama_admin`) VALUES
(1, 'Admin Utama');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `dokter_id` int(11) NOT NULL,
  `nama_dokter` varchar(100) NOT NULL,
  `spesialis` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`dokter_id`, `nama_dokter`, `spesialis`) VALUES
(2, 'drg. Olivia', 'Ortodonti'),
(3, 'drg. Iman', 'Periodonsia'),
(4, 'drg. Revia', 'Konservasi Gigi'),
(5, 'drg. Nabil', 'Prostodonti'),
(6, 'drg. Novi', 'Bedah Mulut'),
(7, 'drg. Amelia', 'Dokter Gigi Umum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_dokter`
--

CREATE TABLE `jadwal_dokter` (
  `jadwal_id` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal_dokter`
--

INSERT INTO `jadwal_dokter` (`jadwal_id`, `dokter_id`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(55, 2, 'Senin', '10:00:00', '14:00:00'),
(56, 3, 'Senin', '10:00:00', '14:00:00'),
(57, 3, 'Senin', '17:00:00', '21:00:00'),
(58, 4, 'Senin', '17:00:00', '21:00:00'),
(59, 2, 'Selasa', '10:00:00', '14:00:00'),
(60, 4, 'Selasa', '10:00:00', '14:00:00'),
(61, 2, 'Selasa', '17:00:00', '21:00:00'),
(62, 4, 'Selasa', '17:00:00', '21:00:00'),
(63, 3, 'Rabu', '10:00:00', '14:00:00'),
(64, 5, 'Rabu', '10:00:00', '14:00:00'),
(65, 5, 'Rabu', '17:00:00', '21:00:00'),
(66, 2, 'Rabu', '17:00:00', '21:00:00'),
(67, 2, 'Kamis', '10:00:00', '14:00:00'),
(68, 5, 'Kamis', '10:00:00', '14:00:00'),
(69, 3, 'Kamis', '17:00:00', '21:00:00'),
(70, 2, 'Kamis', '17:00:00', '21:00:00'),
(71, 3, 'Jumat', '10:00:00', '14:00:00'),
(72, 6, 'Jumat', '10:00:00', '14:00:00'),
(73, 7, 'Jumat', '17:00:00', '21:00:00'),
(74, 6, 'Jumat', '17:00:00', '21:00:00'),
(75, 2, 'Sabtu', '10:00:00', '14:00:00'),
(76, 6, 'Sabtu', '10:00:00', '14:00:00'),
(77, 7, 'Sabtu', '17:00:00', '21:00:00'),
(78, 6, 'Sabtu', '17:00:00', '21:00:00'),
(79, 6, 'Minggu', '10:00:00', '14:00:00'),
(80, 7, 'Minggu', '17:00:00', '21:00:00'),
(81, 6, 'Minggu', '17:00:00', '21:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
--

CREATE TABLE `layanan` (
  `layanan_id` int(11) NOT NULL,
  `nama_layanan` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `layanan`
--

INSERT INTO `layanan` (`layanan_id`, `nama_layanan`, `harga`) VALUES
(1, 'Pemeriksaan Umum', 100000.00),
(2, 'Tambal Gigi', 150000.00),
(3, 'Cabut Gigi', 120000.00),
(4, 'Scaling', 100000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `pasien_id` int(11) NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `no_telp` varchar(100) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`pasien_id`, `nama_pasien`, `no_telp`, `tanggal_lahir`, `alamat`) VALUES
(8, 'Pasien Satu', '081234567891', '1990-01-01', 'Jl. Mawar No.1'),
(9, 'Pasien Dua', '081234567892', '1992-02-02', 'Jl. Melati No.2'),
(10, 'Pasien Tiga', '081234567893', '1993-03-03', 'Jl. Kenanga No.3'),
(11, 'Pasien Empat', '081234567894', '1994-04-04', 'Jl. Kamboja No.4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `pembayaran_id` int(11) NOT NULL,
  `pemeriksaan_id` int(11) NOT NULL,
  `total_bayar` decimal(10,2) NOT NULL,
  `harus_dibayar` decimal(10,2) NOT NULL,
  `status_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`pembayaran_id`, `pemeriksaan_id`, `total_bayar`, `harus_dibayar`, `status_id`) VALUES
(1, 1, 150000.00, 150000.00, 2),
(2, 2, 120000.00, 120000.00, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `pemeriksaan_id` int(11) NOT NULL,
  `reservasi_id` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `tanggal_pemeriksaan` date NOT NULL,
  `catatan_dokter` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemeriksaan`
--

INSERT INTO `pemeriksaan` (`pemeriksaan_id`, `reservasi_id`, `dokter_id`, `tanggal_pemeriksaan`, `catatan_dokter`) VALUES
(1, 2, 3, '2025-06-02', 'Tambal gigi selesai tanpa komplikasi.'),
(2, 3, 4, '2025-06-03', 'Cabut gigi dengan sedikit pendarahan.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi`
--

CREATE TABLE `reservasi` (
  `reservasi_id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `layanan_id` int(11) NOT NULL,
  `tanggal_reservasi` date NOT NULL,
  `jam_reservasi` time NOT NULL,
  `status_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `reservasi`
--

INSERT INTO `reservasi` (`reservasi_id`, `pasien_id`, `layanan_id`, `tanggal_reservasi`, `jam_reservasi`, `status_id`) VALUES
(1, 8, 1, '2025-06-01', '16:00:00', 1),
(2, 9, 2, '2025-06-02', '10:00:00', 2),
(3, 10, 3, '2025-06-03', '11:00:00', 2),
(4, 11, 4, '2025-06-30', '14:00:00', 1),
(5, 8, 3, '2025-06-30', '10:00:00', 1),
(6, 8, 3, '2025-06-03', '10:00:00', 1),
(7, 9, 3, '2025-06-30', '19:00:00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat`
--

CREATE TABLE `riwayat` (
  `riwayat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `aktivitas` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `riwayat`
--

INSERT INTO `riwayat` (`riwayat_id`, `user_id`, `aktivitas`, `waktu`) VALUES
(1, 8, 'Reservasi layanan Pemeriksaan Umum', '2025-06-20 16:15:42'),
(2, 9, 'Reservasi layanan Tambal Gigi', '2025-06-20 16:15:42'),
(3, 10, 'Reservasi layanan Cabut Gigi', '2025-06-20 16:15:42'),
(4, 11, 'Reservasi layanan Scaling', '2025-06-20 16:15:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_pembayaran`
--

CREATE TABLE `status_pembayaran` (
  `status_id` int(11) NOT NULL,
  `nama_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `status_pembayaran`
--

INSERT INTO `status_pembayaran` (`status_id`, `nama_status`) VALUES
(1, 'Belum Lunas'),
(2, 'Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_reservasi`
--

CREATE TABLE `status_reservasi` (
  `status_id` int(11) NOT NULL,
  `nama_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `status_reservasi`
--

INSERT INTO `status_reservasi` (`status_id`, `nama_status`) VALUES
(1, 'Menunggu'),
(2, 'Selesai'),
(3, 'Dibatalkan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','dokter','pasien') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `password_hash`, `role`) VALUES
(1, 'admin', '123', 'admin'),
(2, 'dokter1', '123', 'dokter'),
(3, 'dokter2', '123', 'dokter'),
(4, 'dokter3', '123', 'dokter'),
(5, 'dokter4', '123', 'dokter'),
(6, 'dokter5', '123', 'dokter'),
(7, 'dokter6', '123', 'dokter'),
(8, 'pasien1', '123', 'pasien'),
(9, 'pasien2', '123', 'pasien'),
(10, 'pasien3', '123', 'pasien'),
(11, 'pasien4', '123', 'pasien');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_riwayat`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_riwayat` (
`pasien_id` int(11)
,`tanggal` date
,`layanan` varchar(100)
,`dokter` varchar(100)
,`total` decimal(10,2)
,`total_bayar` decimal(10,2)
,`catatan_dokter` mediumtext
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_riwayat`
--
DROP TABLE IF EXISTS `v_riwayat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_riwayat`  AS SELECT `r`.`pasien_id` AS `pasien_id`, `r`.`tanggal_reservasi` AS `tanggal`, `l`.`nama_layanan` AS `layanan`, `d`.`nama_dokter` AS `dokter`, `l`.`harga` AS `total`, coalesce(`pm`.`total_bayar`,0) AS `total_bayar`, coalesce(`p`.`catatan_dokter`,'-') AS `catatan_dokter` FROM ((((`reservasi` `r` join `layanan` `l` on(`r`.`layanan_id` = `l`.`layanan_id`)) left join `pemeriksaan` `p` on(`r`.`reservasi_id` = `p`.`reservasi_id`)) left join `dokter` `d` on(`p`.`dokter_id` = `d`.`dokter_id`)) left join `pembayaran` `pm` on(`p`.`pemeriksaan_id` = `pm`.`pemeriksaan_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`dokter_id`);

--
-- Indeks untuk tabel `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD PRIMARY KEY (`jadwal_id`),
  ADD KEY `dokter_id` (`dokter_id`);

--
-- Indeks untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`layanan_id`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`pasien_id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`pembayaran_id`),
  ADD KEY `pemeriksaan_id` (`pemeriksaan_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indeks untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD PRIMARY KEY (`pemeriksaan_id`),
  ADD KEY `reservasi_id` (`reservasi_id`),
  ADD KEY `dokter_id` (`dokter_id`);

--
-- Indeks untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`reservasi_id`),
  ADD KEY `pasien_id` (`pasien_id`),
  ADD KEY `layanan_id` (`layanan_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indeks untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`riwayat_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `status_pembayaran`
--
ALTER TABLE `status_pembayaran`
  ADD PRIMARY KEY (`status_id`);

--
-- Indeks untuk tabel `status_reservasi`
--
ALTER TABLE `status_reservasi`
  ADD PRIMARY KEY (`status_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  MODIFY `jadwal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `layanan`
--
ALTER TABLE `layanan`
  MODIFY `layanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `pembayaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  MODIFY `pemeriksaan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `reservasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `riwayat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `status_pembayaran`
--
ALTER TABLE `status_pembayaran`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `status_reservasi`
--
ALTER TABLE `status_reservasi`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`dokter_id`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD CONSTRAINT `jadwal_dokter_ibfk_1` FOREIGN KEY (`dokter_id`) REFERENCES `dokter` (`dokter_id`);

--
-- Ketidakleluasaan untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD CONSTRAINT `pasien_ibfk_1` FOREIGN KEY (`pasien_id`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`pemeriksaan_id`) REFERENCES `pemeriksaan` (`pemeriksaan_id`),
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status_pembayaran` (`status_id`);

--
-- Ketidakleluasaan untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD CONSTRAINT `pemeriksaan_ibfk_1` FOREIGN KEY (`reservasi_id`) REFERENCES `reservasi` (`reservasi_id`),
  ADD CONSTRAINT `pemeriksaan_ibfk_2` FOREIGN KEY (`dokter_id`) REFERENCES `dokter` (`dokter_id`);

--
-- Ketidakleluasaan untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  ADD CONSTRAINT `reservasi_ibfk_1` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`pasien_id`),
  ADD CONSTRAINT `reservasi_ibfk_2` FOREIGN KEY (`layanan_id`) REFERENCES `layanan` (`layanan_id`),
  ADD CONSTRAINT `reservasi_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status_reservasi` (`status_id`);

--
-- Ketidakleluasaan untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  ADD CONSTRAINT `riwayat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
