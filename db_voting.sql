-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 11, 2026 at 10:43 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id_admin` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `Alamat` varchar(50) DEFAULT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id_admin`, `username`, `email`, `password`, `nama_admin`, `Alamat`, `foto`) VALUES
(2, 'irul', 'kaiixxyy.xpro@gmail.com', '123', 'muhammad khairul azzam', 'jalan raden kosasih', 'Screenshot 2025-11-27 121224.png'),
(6, 'rafael', 'rafaelxpro@gmail.com', '123', 'rafael najwan mahardika', 'jalan merpati', '1775718129_Screenshot 2026-04-09 140015.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblcalonketos`
--

CREATE TABLE `tblcalonketos` (
  `id_calon` int NOT NULL,
  `nama_calon` varchar(100) NOT NULL,
  `visi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `misi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblcalonketos`
--

INSERT INTO `tblcalonketos` (`id_calon`, `nama_calon`, `visi`, `misi`, `foto`) VALUES
(2, 'WYANET IN NAKEISHA', 'Mewujudkan OSIS yang aktif, kreatif, dan berprestasi.', 'Mengadakan kegiatan yang menarik dan bermanfaat bagi siswa Meningkatkan partisipasi siswa dalam organisasi Mendukung pengembangan bakat dan minat siswa', '1775635378_wyanet.jpg'),
(3, 'ZENTRISTAN VITADI', 'Menciptakan lingkungan sekolah yang disiplin, nyaman, dan berkarakter.', 'Menumbuhkan sikap disiplin dan tanggung jawab siswa Menjalin kerja sama yang baik antar siswa dan guru Mengadakan program yang membangun karakter positif', 'tristan.jpg'),
(4, 'M.ALFATH FACHRIZY EL HAKIM', 'Menjadikan OSIS sebagai wadah aspirasi siswa yang inovatif dan inspiratif.', 'Menampung dan menyampaikan aspirasi siswa Membuat program kerja yang kreatif dan inovatif Meningkatkan komunikasi antar warga sekolah', 'alfath.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblsiswa`
--

CREATE TABLE `tblsiswa` (
  `id_siswa` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblsiswa`
--

INSERT INTO `tblsiswa` (`id_siswa`, `nama`, `email`, `kelas`, `jurusan`, `alamat`, `username`, `password`, `foto`) VALUES
(1, 'WILDAN ZAGHLUL IZAZ', 'wildun1221@gmail.com', 'X-1', 'RPL', 'jalan rawa bebek', 'wildan', '1', 'Screenshot 2026-04-09 134736.png'),
(2, 'AMMAR ZAHID', 'amarzahid@gmail.com', 'X-1', 'RPL', 'jalan kosasih', '2', '1', 'Screenshot 2026-04-01 190256.png'),
(3, 'ARKANA GHANI NARESHWARA', 'rkanaa@gmail.com', 'X-1', 'RPL', 'komp.citra park', '3', '1', 'Screenshot 2026-04-09 134940.png'),
(4, 'MUHAMMAD RAFIE TAUFIK', 'rafietaufik12@gmail.com', 'X-1', 'RPL', 'jalan nurkim', '4', '1', 'Screenshot 2026-04-01 190314.png'),
(5, 'ZHOFIR RAFIF MACHIKO', 'ciko@gmail.com', 'X-1', 'RPL', 'jalan gotong royong', '5', '1', 'unnamed.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblvoting`
--

CREATE TABLE `tblvoting` (
  `id_voting` int NOT NULL,
  `id_calon` int NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_siswa` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblvoting`
--

INSERT INTO `tblvoting` (`id_voting`, `id_calon`, `tanggal`, `id_siswa`) VALUES
(1, 2, '2026-04-09 01:05:00', '1'),
(2, 3, '2026-04-09 01:05:20', '2'),
(3, 2, '2026-04-09 01:05:32', '3'),
(4, 4, '2026-04-09 01:05:44', '4');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `nama` int NOT NULL,
  `umur` varchar(255) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `apa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tblcalonketos`
--
ALTER TABLE `tblcalonketos`
  ADD PRIMARY KEY (`id_calon`);

--
-- Indexes for table `tblsiswa`
--
ALTER TABLE `tblsiswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `tblvoting`
--
ALTER TABLE `tblvoting`
  ADD PRIMARY KEY (`id_voting`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblcalonketos`
--
ALTER TABLE `tblcalonketos`
  MODIFY `id_calon` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblsiswa`
--
ALTER TABLE `tblsiswa`
  MODIFY `id_siswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblvoting`
--
ALTER TABLE `tblvoting`
  MODIFY `id_voting` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
