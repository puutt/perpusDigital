-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2024 at 08:17 AM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `sinopsis` text NOT NULL,
  `tahun_terbit` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `jumlah_halaman` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `jml_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `foto`, `penulis`, `penerbit`, `sinopsis`, `tahun_terbit`, `kategori`, `jumlah_halaman`, `tgl_masuk`, `jml_buku`) VALUES
(11, 'The Night Circus', 'TheNightCircus.jpg', 'Erin Morgenstern', 'Doubleday', 'The Night Circus mengambil latar belakang abad ke-19 dan mengisahkan tentang dua pesulap muda, Celia Bowen dan Marco Alisdair, yang terjebak dalam kompetisi ajaib yang mempertaruhkan hidup mereka. Mereka dipaksa untuk bertarung dalam sebuah sirkus yang bergerak di seluruh dunia, dikenal sebagai "Le Cirque des RÃªves" (Sirkus Mimpi).\r\n\r\nKeduanya dilatih sejak kecil oleh guru mereka, namun mereka tidak tahu siapa pesaing sejati mereka atau kapan dan bagaimana permainan ini akan berakhir. Sirkus Mimpi sendiri adalah karya seni magis dengan tenda-tenda yang ajaib, seperti Tenda Ape, Tenda Horologi, dan Tenda Es. Pesona dan keajaiban sirkus ini mencuri perhatian pengunjung tanpa mereka sadari, karena hanya buka pada malam hari dan hilang saat matahari terbit.\r\n\r\nDalam perjalanan, Celia dan Marco juga bertemu dengan tokoh-tokoh menarik lainnya, seperti Bailey, seorang pengunjung yang kagum dengan keajaiban sirkus, dan Isobel, seorang mantan tarot reader. Dengan sorotan penuh misteri, cinta, dan persaingan yang mencekam, The Night Circus menawarkan pengalaman membaca yang tidak dapat dilupakan.', 2011, ' Fantasi ', 387, '2024-01-30', 0),
(12, 'Bumi Manusia', 'bumi-manusia.jpg', 'Pramoedya Ananta Toer', 'Hasta Mitra', 'Terdiri dari empat novel ("Bumi Manusia", "Anak Semua Bangsa", "Jejak Langkah", dan "Rumah Kaca"), tetralogi ini membentuk epik sejarah tentang perjuangan Indonesia melawan penjajah.', 1980, ' Fiksi ', 535, '2024-01-30', 8),
(13, 'Cantik Itu Luka', 'cantik-itu-luka.jpg', 'Eka Kurniawan', 'Gramedia Pustaka Utama', 'Novel ini mengisahkan tentang dua perempuan yang hidup pada masa perang di Indonesia, menggali lapisan sejarah dan mitos dengan gaya bercerita yang unik dan penuh imajinasi.', 2002, ' Fiksi ', 537, '2024-01-30', 9),
(14, 'Laut Bercerita', 'laut-bercerita.jpg', 'Leila S. Chudori', 'Gramedia', 'Sebuah novel yang mengisahkan peristiwa G30S dari sudut pandang keluarga Soeharto. Dengan latar belakang Jakarta dan Paris, novel ini membawa pembaca menelusuri masa-masa politik yang sulit dengan kepekaan dan kecerdasan.', 2017, ' Fiksi ', 379, '2024-01-30', 15),
(16, '172 Days', '172_Days.jpg', 'Nadzira Shafa', 'Motivaksi Inspira', 'Novel 172 Days adalah kisah nyata percintaan dari Nadzira Shafa bersama dengan suaminya, mendiang Ameer Azzikra yang adalah anak dari Almarhum Ustaz Arifin Ilham.\r\n\r\nNovel karya Nadzira Shafa ini rilis bertepatan dengan peringatan 100 hari wafatnya sang suami. Supaya kenangannya dengan Ameer Azzikra bisa tersimpan abadi, maka Nadzira Shafa menuliskannya dan terbit jadi suatu novel.', 2022, ' Religi ', 241, '2024-02-09', 12),
(17, 'Bahasa Indonesia SMA/MA/SMK/MAK Kelas XII - Kurikulum 2013 - Edisi revisi 2018', 'bindo.jpg', 'Maman Suryaman, Dr, M.Pd / Istiqomah, S.Pd., M.Pd. / Suherli, Prof, Dr, M.Pd.', 'Buku Sekolah Elektronik (BSE)', 'Buku ini merupakan buku siswa yang dipersiapkan Pemerintah dalam rangka implementasi Kurikulum 2013. Buku siswa ini disusun dan ditelaah oleh berbagai pihak di bawah koordinasi Kementerian Pendidikan dan Kebudayaan, dan dipergunakan dalam tahap awal penerapan Kurikulum 2013. Buku ini merupakan “dokumen hidup” yang senantiasa diperbaiki, diperbaharui, dan dimutakhirkan sesuai dengan dinamika kebutuhan dan perubahan zaman. Masukan dari berbagai kalangan yang dialamatkan kepada penulis dan laman http://buku.kemdikbud.go.id atau melalui email buku@kemdikbud.go.id diharapkan dapat meningkatkan kualitas buku ini.', 2018, ' Pelajaran ', 266, '2024-02-09', 29),
(18, 'Pendidikan Jasmani Olahraga dan Kesehatan Kelas XI', 'pjok.png', 'Sumaryoto, Soni Nopembri', 'Pusat Kurikulum dan Perbukuan, Balitbang, Kemendikbud', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n                          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n                          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n                          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n                          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n                          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 2017, ' Pelajaran ', 321, '2024-02-09', 31),
(19, 'Matematika', 'mtk.jpg', 'Bornok Sinaga, Prof, Dr, M.Pd / Pardomuan J.N.M Sinambela / Andri Kristianto Sitanggang, S.Pd.,M.Pd / Mangaratua Marianus Simanjorang, S.Pd., M.Pd', 'Buku Sekolah Elektronik (BSE)', 'buku matematika', 2015, ' Pelajaran ', 209, '2024-02-09', 11);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nama`) VALUES
(1, 'Asep Saefudin,S.Pd.'),
(2, 'Cecep Yusup Sopyadin,S.Pd.I'),
(3, 'Ai Titin Pitriani, A.,Md.'),
(4, 'Dadan Febiana, S.Sn.'),
(5, 'Deli Mardiano, S.Kom'),
(6, 'Dikdik Permana, S.Pd.'),
(7, 'Drs. Rahmat Priatna'),
(8, 'Eka Maulana Jumhur, S.Pd'),
(9, 'Eman, S.E., Ak'),
(10, 'Fitry Septiyanti, S.Pd'),
(11, 'Gesty Rizky Utami, S.Pd.'),
(12, 'Gumilar Agung Pratama,S.Kom'),
(13, 'Gunawan, S.Pd'),
(14, 'Ila Khoiriyah,S.E.'),
(15, 'Ita Rosita, M.Pd.'),
(16, 'Ivan Kurniawan'),
(17, 'Juju Jubaedah,S.Pd'),
(18, 'Kokoy Komala, S.Pd.'),
(19, 'Kurniawan Aditia, S.Kom'),
(20, 'Lela Nurlaela, S.E.'),
(21, 'Lies Malisa, S.Pd'),
(22, 'Mimin Minarti, S.Pd.'),
(23, 'Moch. Ris Karisma, S.Pd'),
(24, 'Rangga Utama, S.Pd'),
(25, 'Rika Riyanti, S.E'),
(26, 'Rina Sofia Sukmayani, S.Kom'),
(27, 'Sela Hermawanti, S.E.'),
(28, 'Septian Heryadi, S.E'),
(29, 'Suryani, S.Pd.'),
(30, 'Ujang Samsudin,S.Pd.'),
(31, 'Ujang Syarif Hidayatulloh,S.Pd.'),
(32, 'Wahyudin, S.Kom'),
(33, 'Wina Agustina, S.Kom'),
(34, 'Yanuar Putra Trenggana, S.Kom.'),
(35, 'Yopi Adi Sopyan, S.Kom'),
(36, 'Yusup Maulana, S.Pd');

-- --------------------------------------------------------

--
-- Table structure for table `kategoribuku`
--

CREATE TABLE `kategoribuku` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategoribuku`
--

INSERT INTO `kategoribuku` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Misteri'),
(2, 'Romantis'),
(3, 'Komedi'),
(4, 'Horor'),
(5, 'Fiksi'),
(6, 'Fiksi Ilmiah'),
(7, 'Fantasi'),
(8, 'Roman'),
(9, 'Komik'),
(11, 'Religi'),
(12, 'Pelajaran');

-- --------------------------------------------------------

--
-- Table structure for table `kategoribuku_relasi`
--

CREATE TABLE `kategoribuku_relasi` (
  `id_kategoribuku` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `koleksi_pribadi`
--

CREATE TABLE `koleksi_pribadi` (
  `id_koleksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `koleksi_pribadi`
--

INSERT INTO `koleksi_pribadi` (`id_koleksi`, `id_user`, `id_buku`) VALUES
(7, 28, 13),
(3, 33, 13);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `buku` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_peminjaman` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `jml_pinjam` int(11) NOT NULL,
  `jam` varchar(11) NOT NULL,
  `guru` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_user`, `id_buku`, `buku`, `nama`, `tgl_peminjaman`, `tgl_kembali`, `jml_pinjam`, `jam`, `guru`) VALUES
(43, 28, 11, 'The Night Circus', 'putri', '2024-01-11', '2024-01-18', 1, '15:38', '-'),
(44, 33, 13, 'Cantik Itu Luka', 'putra', '2024-01-31', '2024-02-07', 1, '15:55', '-'),
(45, 36, 11, 'The Night Circus', 'Lintang', '2024-02-20', '2024-02-27', 1, '10:49', '-');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `denda` varchar(50) NOT NULL,
  `terlambat` varchar(50) NOT NULL,
  `tgl_peminjaman` date NOT NULL,
  `nama` varchar(255) NOT NULL,
  `buku` varchar(255) NOT NULL,
  `jam` varchar(11) NOT NULL,
  `guru` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `tgl_pengembalian`, `id_user`, `id_buku`, `denda`, `terlambat`, `tgl_peminjaman`, `nama`, `buku`, `jam`, `guru`) VALUES
(41, '2024-02-18', 28, 11, '0', '', '2024-02-18', 'putri', 'The Night Circus', '12:52', '-');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id_profile` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `deskripsi` text NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id_profile`, `judul`, `nama_sekolah`, `alamat`, `deskripsi`, `telp`, `email`, `foto`) VALUES
(1, 'perpusDigital', 'SMK Inovasi Mandiri', 'Jl. Rd. Umar Wirahadi Kusumah KM.25 Darmaraja – Sumedang', 'Perpustakaan Digital ini dibuat untuk memudahkan para murid meminjam buku secara online atau daring tanpa perlu ribet. Website ini hanya bisa digunakan untuk meminjam dan mengembalikan buku saja.', '(0262) 2820905', 'smkiman42@gmail.com', 'book.png');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan_buku`
--

CREATE TABLE `ulasan_buku` (
  `id_ulasan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `ulasan` text NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl` varchar(255) NOT NULL,
  `rating` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ulasan_buku`
--

INSERT INTO `ulasan_buku` (`id_ulasan`, `id_user`, `id_buku`, `ulasan`, `nama`, `tgl`, `rating`) VALUES
(7, 28, 11, 'Covernya cantik bgt', 'putri', 'Thursday, 01-02-2024 07:57:40 am', 5),
(10, 28, 12, 'halamannya ada yg sobek', 'putri', 'Friday, 02-02-2024 07:44:31 pm', 1),
(11, 28, 11, 'oke lah', 'putri', 'Thursday, 08-02-2024 09:00:43 pm', 2),
(13, 33, 13, 'keren veritanya', 'putra', 'Thursday, 08-02-2024 10:03:30 pm', 5),
(14, 28, 11, 'i love u', 'putri', 'Thursday, 08-02-2024 10:25:59 pm', 5),
(16, 28, 11, 'o', 'putri', 'Thursday, 08-02-2024 22:34', 1),
(17, 33, 11, 'wah', 'putra', 'Friday, 09-02-2024 12:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `kelas` varchar(12) NOT NULL,
  `jurusan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `username`, `password`, `email`, `role`, `alamat`, `foto`, `kelas`, `jurusan`) VALUES
(19, 'Admin', 'admin', 'admin', '-', 'Admin', '-', 'default.png', '-', '-'),
(20, 'Susi Rahmawati', 'susi', '123', 'susi@gmail.com', 'Peminjam', 'Ancol', 'default.png', 'XII 4', 'RPL'),
(21, 'Nurul Hidayati', 'nurul', '123', 'nurul@gmail.com', 'Admin', 'Sumedang', 'Gojo.webp', 'XII 4', 'RPL'),
(28, 'putri', 'putri', '123', 'pputmhh@gmail.com', 'Peminjam', 'Sumedang', 'default.png', 'XII 1', 'RPL'),
(30, 'aca', 'aca', '123', 'aca@gmail.com', 'Petugas', 'Sumedang', 'default.png', 'XII 2', 'RPL'),
(32, 'Patrick Star', 'patpat', '123', 'patrik@gmail.com', 'Peminjam', 'Bikini Bottom', 'default.png', 'XII 3', 'RPL'),
(33, 'putra', 'putra', '1234', 'putra@gmail.com', 'Peminjam', 'Sumedang', 'spiderman.jpg', 'XII 1', 'RPL'),
(34, 'Spongebob', 'spons', '1234', 'sponsbob@gmail.com', 'Peminjam', 'Bikini Bottom', 'default.png', 'Bikin', 'RPL'),
(35, 'Dede Nur Ardiansyah', 'dedenur', '1234', 'dede@gmail.com', 'Peminjam', 'Sumedang', 'default.png', 'X TBS', ''),
(36, 'Lintang', 'lintang', '1234', 'lt@gmail.com', 'Peminjam', 'Sumedang', 'default.png', 'XII RPL 3', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `kategoribuku`
--
ALTER TABLE `kategoribuku`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  ADD PRIMARY KEY (`id_kategoribuku`),
  ADD KEY `id_buku` (`id_buku`,`id_kategori`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `koleksi_pribadi`
--
ALTER TABLE `koleksi_pribadi`
  ADD PRIMARY KEY (`id_koleksi`),
  ADD KEY `id_user` (`id_user`,`id_buku`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_user` (`id_user`,`id_buku`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `id_user` (`id_user`,`id_buku`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id_profile`);

--
-- Indexes for table `ulasan_buku`
--
ALTER TABLE `ulasan_buku`
  ADD PRIMARY KEY (`id_ulasan`),
  ADD KEY `id_user` (`id_user`,`id_buku`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `kategoribuku`
--
ALTER TABLE `kategoribuku`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  MODIFY `id_kategoribuku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `koleksi_pribadi`
--
ALTER TABLE `koleksi_pribadi`
  MODIFY `id_koleksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id_profile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ulasan_buku`
--
ALTER TABLE `ulasan_buku`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  ADD CONSTRAINT `kategoribuku_relasi_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kategoribuku_relasi_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategoribuku` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `koleksi_pribadi`
--
ALTER TABLE `koleksi_pribadi`
  ADD CONSTRAINT `koleksi_pribadi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `koleksi_pribadi_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengembalian_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ulasan_buku`
--
ALTER TABLE `ulasan_buku`
  ADD CONSTRAINT `ulasan_buku_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ulasan_buku_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
