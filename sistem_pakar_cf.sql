-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Sep 2024 pada 17.07
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_pakar_cf`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `kode_gejala` varchar(5) NOT NULL,
  `nama_gejala` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gejala`
--

INSERT INTO `gejala` (`kode_gejala`, `nama_gejala`) VALUES
('G001', 'Lampu indikator LOS merah'),
('G002', 'Tidak ada koneksi internet'),
('G003', 'Tidak ada cahaya pada ujung kabel fiber optik'),
('G004', 'Lampu indikator Power menyala tapi internet tidak berfungsi'),
('G005', 'Tidak bisa mengakses router melalui IP lokal'),
('G006', 'Kecepatan internet sangat lambat'),
('G007', 'Lampu indikator PON mati'),
('G008', 'Sering terjadi disconnect'),
('G009', 'Modem sering restart'),
('G010', 'Ping tinggi dan tidak stabil'),
('G011', 'Modem terasa panas saat disentuh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala_kerusakan`
--

CREATE TABLE `gejala_kerusakan` (
  `id_gejala_kerusakan` int(11) NOT NULL,
  `kode_kerusakan` varchar(5) DEFAULT NULL,
  `kode_gejala` varchar(5) DEFAULT NULL,
  `nilai_mb` float DEFAULT NULL,
  `nilai_md` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gejala_kerusakan`
--

INSERT INTO `gejala_kerusakan` (`id_gejala_kerusakan`, `kode_kerusakan`, `kode_gejala`, `nilai_mb`, `nilai_md`) VALUES
(1, 'K001', 'G001', 0.7, 0.3),
(2, 'K001', 'G002', 0.6, 0.2),
(3, 'K001', 'G003', 0.9, 0.1),
(5, 'K002', 'G006', 0.8, 0.1),
(6, 'K002', 'G007', 0.9, 0.2),
(7, 'K002', 'G008', 0.7, 0.2),
(11, 'K003', 'G009', 0.8, 0.4),
(12, 'K003', 'G002', 0.6, 0.4),
(13, 'K003', 'G004', 0.7, 0.1),
(14, 'K003', 'G005', 0.6, 0.2),
(16, 'K004', 'G010', 0.9, 0.2),
(17, 'K004', 'G006', 0.8, 0.3),
(21, 'K005', 'G011', 0.8, 0.1),
(22, 'K005', 'G009', 0.8, 0.4),
(23, 'K005', 'G008', 0.6, 0.3),
(42, 'K002', 'G002', 0.6, 0.4),
(43, 'K004', 'G002', 0.6, 0.4),
(44, 'K005', 'G002', 0.6, 0.4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kerusakan`
--

CREATE TABLE `kerusakan` (
  `kode_kerusakan` varchar(5) NOT NULL,
  `nama_kerusakan` varchar(100) DEFAULT NULL,
  `keterangan` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kerusakan`
--

INSERT INTO `kerusakan` (`kode_kerusakan`, `nama_kerusakan`, `keterangan`) VALUES
('K001', 'Kabel Fiber Optik Putus', 'Identifikasi Lokasi Kerusakan : Gunakan OTDR untuk menemukan titik putus.\r\n2. Persiapkan Alat : Siapkan fusion splicer, cleaver, dan sleeve proteksi.\r\n3. Penyambungan Kabel :\r\nâ€¢	Potong ujung kabel yang rusak dengan cleaver.\r\nâ€¢	Sambungkan serat dengan fusion splicer.\r\nâ€¢	Lindungi sambungan dengan sleeve heat-shrink.\r\n4. Uji Koneksi : Gunakan OTDR atau power meter untuk memastikan kualitas sambungan.\r\n5. Pencegahan : Lindungi kabel dengan conduit atau pasang di lokasi aman.'),
('K002', 'Gangguan pada OLT', '1.	Periksa Status Indikator OLT : Cek lampu indikator pada OLT untuk mengetahui status operasionalnya. Jika ada indikator merah atau berkedip, kemungkinan ada masalah.\r\n2.	Reboot OLT : Lakukan restart atau reboot OLT secara aman untuk memperbaiki gangguan kecil atau malfungsi sistem.\r\n3.	Periksa Koneksi Fiber Optik: Pastikan konektor fiber optik terpasang dengan benar dan tidak ada kabel yang longgar atau rusak.\r\n4.	Cek Konfigurasi OLT : Verifikasi konfigurasi OLT melalui interface manajemen untuk memastikan tidak ada kesalahan konfigurasi, seperti pada VLAN atau parameter lainnya.\r\n5.	Uji Sinyal OLT : Gunakan alat penguji sinyal optik (OTDR) untuk memastikan kualitas sinyal dari OLT ke perangkat downstream.'),
('K003', 'Router bermasalah', '1.	Reboot Router: Matikan dan nyalakan ulang router untuk memperbaiki gangguan sementara.\r\n2.	Cek Koneksi Kabel: Pastikan semua kabel (power, ethernet) terhubung dengan benar.\r\n3.	Periksa Pengaturan WiFi: Cek apakah SSID dan kata sandi WiFi sesuai. Ubah channel WiFi jika sinyal lemah.\r\n4.	Reset Router: Jika masalah berlanjut, reset router ke pengaturan pabrik dan konfigurasi ulang.\r\n5.	Update Firmware: Perbarui firmware router ke versi terbaru dari situs resmi.\r\n6.	Pindahkan Router: Tempatkan router di area terbuka untuk sinyal yang lebih baik.'),
('K004', 'Interferensi sinyal', '1.	Ganti Channel WiFi: Ubah channel WiFi pada router ke channel yang kurang padat (misalnya channel 1, 6, atau 11).\r\n2.	Pindahkan Router: Tempatkan router di lokasi terbuka, jauh dari perangkat elektronik lain seperti microwave atau telepon nirkabel.\r\n3.	Gunakan Frekuensi 5GHz: Jika router mendukung, beralih ke frekuensi 5GHz yang lebih sedikit gangguan daripada 2.4GHz.\r\n4.	Perbarui Firmware Router: Pastikan router memiliki firmware terbaru untuk performa sinyal yang optimal.\r\n5.	Gunakan Repeater / Extender : Tambahkan repeater atau WiFi extender untuk memperkuat sinyal di area yang terhalang.'),
('K005', 'Modem Overheating', '1.	Matikan dan Diamkan: Matikan modem dan biarkan dingin selama beberapa menit.\r\n2.	Pindahkan ke Area Terbuka: Pastikan modem ditempatkan di lokasi dengan sirkulasi udara yang baik, jauh dari sumber panas atau sinar matahari langsung.\r\n3.	Bersihkan Ventilasi: Periksa dan bersihkan lubang ventilasi pada modem dari debu atau kotoran.\r\n4.	Gunakan Kipas Eksternal: Jika memungkinkan, gunakan kipas kecil atau cooling pad untuk meningkatkan pendinginan.\r\n5.	Kurangi Beban Kerja : Hindari penggunaan berat yang terus-menerus, seperti streaming atau gaming non-stop.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_cf`
--

CREATE TABLE `nilai_cf` (
  `id_nilai_cf` int(11) NOT NULL,
  `kode_kerusakan` varchar(5) DEFAULT NULL,
  `kode_gejala` varchar(5) DEFAULT NULL,
  `nilai_mb` float DEFAULT NULL,
  `nilai_md` float DEFAULT NULL,
  `cf` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilai_cf`
--

INSERT INTO `nilai_cf` (`id_nilai_cf`, `kode_kerusakan`, `kode_gejala`, `nilai_mb`, `nilai_md`, `cf`) VALUES
(1, 'K001', 'G001', 0.9, 0.3, 0.6),
(2, 'K001', 'G002', 0.8, 0.4, 0.4),
(3, 'K001', 'G003', 0.7, 0.1, 0.6),
(4, 'K002', 'G006', 0.8, 0.2, 0.6),
(5, 'K002', 'G007', 0.9, 0.4, 0.5),
(6, 'K002', 'G008', 0.6, 0.2, 0.4),
(7, 'K003', 'G009', 0.7, 0.5, 0.2),
(8, 'K003', 'G002', 0.7, 0.4, 0.3),
(9, 'K003', 'G004', 0.8, 0.4, 0.4),
(10, 'K003', 'G005', 0.6, 0.1, 0.5),
(11, 'K004', 'G010', 0.7, 0.2, 0.5),
(12, 'K004', 'G006', 0.7, 0.3, 0.4),
(13, 'K005', 'G011', 0.8, 0.2, 0.6),
(14, 'K005', 'G009', 0.7, 0.5, 0.2),
(15, 'K005', 'G008', 0.6, 0.2, 0.4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `nama_user` varchar(20) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_user`, `level`) VALUES
(1, 'admin', 'admin', 'Admin', 'Admin'),
(2, 'teknisi', 'teknisi', 'Teknisi', 'Teknisi');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`kode_gejala`);

--
-- Indeks untuk tabel `gejala_kerusakan`
--
ALTER TABLE `gejala_kerusakan`
  ADD PRIMARY KEY (`id_gejala_kerusakan`);

--
-- Indeks untuk tabel `kerusakan`
--
ALTER TABLE `kerusakan`
  ADD PRIMARY KEY (`kode_kerusakan`);

--
-- Indeks untuk tabel `nilai_cf`
--
ALTER TABLE `nilai_cf`
  ADD PRIMARY KEY (`id_nilai_cf`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gejala_kerusakan`
--
ALTER TABLE `gejala_kerusakan`
  MODIFY `id_gejala_kerusakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `nilai_cf`
--
ALTER TABLE `nilai_cf`
  MODIFY `id_nilai_cf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
