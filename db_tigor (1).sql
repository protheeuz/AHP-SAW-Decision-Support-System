-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 29, 2024 at 01:53 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tigor`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama`) VALUES
(1, 'YANTO SURYANTO'),
(2, 'MUKHLIS MAHMUD'),
(3, 'SENTOT MARHADI'),
(7, 'BAGUS SETIAWAN'),
(8, 'FAHRI INDRAMAN'),
(9, 'ABDUL RAHMAN MANAAN'),
(10, 'MARADEN'),
(11, 'MIRNA AYU'),
(12, 'MUHAMMAD SYARIF'),
(13, 'PATRA SIHOMBING'),
(14, 'PUTRI DUMA TAMPUBOLON'),
(15, 'MUHAMMAD IKRAM'),
(16, 'NERU DERMAWAN'),
(17, 'CAHYARI '),
(18, 'MANSUR'),
(19, 'RINJANI '),
(20, 'LINDUNG SIRAIT'),
(21, 'ANDY MELANI'),
(22, 'MUHAMMAD PARTIMIN'),
(23, 'RIZAL HASIBUAN'),
(24, 'IWAN SETIAWAN'),
(25, 'LASIMIN'),
(26, 'ADBUL KHOLIL'),
(27, 'RIRIN PUJIASTUTI'),
(28, 'SHELLY PRATIWI'),
(29, 'GUSTI DARA PUSPITA'),
(30, 'RIDHA LILA AMELIA'),
(31, 'PUTRI PRILIYA ISYAFITRI'),
(32, 'SUHARTINI'),
(33, 'SYAIFULOH'),
(34, 'IDA ROSIDA'),
(35, 'HARTOYO PURNAMA '),
(36, 'MUHAMMAD ALIUDIN'),
(37, 'ACHMAD FADLY'),
(38, 'RANGGA PRASETIO'),
(39, 'TOUFIK AKBAR'),
(40, 'RAHMAD SOKKA'),
(41, 'FIFI PANGESTU'),
(42, 'ANGGA BASKARA '),
(43, 'WARTONO'),
(44, 'CITRA CANTIKA SIREGAR'),
(45, 'BAHRIA'),
(46, 'SRI ASRI '),
(47, 'AGNES DWI NAHAMPUN'),
(48, 'ANGGIANA'),
(49, 'NOVYTA PUTRI SARI'),
(50, 'ANJAR RENALDY'),
(51, 'RIZAL'),
(52, 'ARIS '),
(53, 'HANI'),
(54, 'NESSI NATALIE'),
(55, 'ALFRIO MATTEW SINAGA'),
(56, 'FACHRI RAFSANJANI AZIZI'),
(57, 'DINDA PURYANA'),
(58, 'GUSTI NANDA HESMYTA'),
(59, 'WINDA AZKAYRANSYAH');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id` int NOT NULL,
  `id_alternatif` int NOT NULL,
  `total_score` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id`, `id_alternatif`, `total_score`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 3, 0),
(4, 1, 0),
(5, 2, 0),
(6, 3, 0),
(7, 1, 0),
(8, 2, 0),
(9, 3, 0),
(10, 1, 0),
(11, 2, 0),
(12, 3, 0),
(13, 1, 0),
(14, 2, 0),
(15, 3, 0),
(16, 1, 0),
(17, 2, 0),
(18, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int NOT NULL,
  `kode_kriteria` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `bobot` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `keterangan`, `jenis`, `bobot`) VALUES
(10, 'K1', 'ABSENSI', 'Benefit', '20.00'),
(11, 'K2', 'KEJUJURAN', 'Benefit', '20.00'),
(12, 'K3', 'KERJASAMA TEAM', 'Benefit', '20.00'),
(13, 'K4', 'KOMUNIKASI', 'Benefit', '20.00'),
(14, 'K5', 'DISIPLIN', 'Benefit', '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_ahp`
--

CREATE TABLE `kriteria_ahp` (
  `id` int NOT NULL,
  `id_kriteria_1` int NOT NULL,
  `id_kriteria_2` int NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1720034743),
('m240703_192405_create_user_level_table', 1720034746),
('m240703_192426_create_user_table', 1720034746),
('m240703_192625_create_kriteria_table', 1720034899),
('m240703_192646_create_kriteria_ahp_table', 1720034900),
('m240703_192709_create_sub_kriteria_table', 1720034900),
('m240703_192728_create_alternatif_table', 1720034900),
('m240703_192752_create_penilaian_table', 1720034901),
('m240703_192945_add_admin_user', 1720037019),
('m240703_200432_add_bobot_to_kriteria_table', 1720037100);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int NOT NULL,
  `id_alternatif` int NOT NULL,
  `id_kriteria` int NOT NULL,
  `nilai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_alternatif`, `id_kriteria`, `nilai`) VALUES
(201, 4, 10, 15),
(202, 4, 11, 18),
(203, 4, 12, 17),
(204, 4, 13, 16),
(205, 4, 14, 19),
(206, 5, 10, 20),
(207, 5, 11, 12),
(208, 5, 12, 14),
(209, 5, 13, 19),
(210, 5, 14, 17),
(211, 6, 10, 18),
(212, 6, 11, 16),
(213, 6, 12, 19),
(214, 6, 13, 15),
(215, 6, 14, 18),
(216, 7, 10, 13),
(217, 7, 11, 15),
(218, 7, 12, 20),
(219, 7, 13, 16),
(220, 7, 14, 17),
(221, 10, 10, 15),
(222, 10, 11, 19),
(223, 10, 12, 18),
(224, 10, 13, 17),
(225, 10, 14, 20),
(226, 11, 10, 18),
(227, 11, 11, 17),
(228, 11, 12, 19),
(229, 11, 13, 16),
(230, 11, 14, 18),
(231, 12, 10, 13),
(232, 12, 11, 14),
(233, 12, 12, 20),
(234, 12, 13, 17),
(235, 12, 14, 19),
(236, 13, 10, 14),
(237, 13, 11, 15),
(238, 13, 12, 18),
(239, 13, 13, 19),
(240, 13, 14, 16),
(241, 14, 10, 20),
(242, 14, 11, 18),
(243, 14, 12, 17),
(244, 14, 13, 16),
(245, 14, 14, 15),
(246, 15, 10, 19),
(247, 15, 11, 18),
(248, 15, 12, 17),
(249, 15, 13, 16),
(250, 15, 14, 20),
(251, 16, 10, 18),
(252, 16, 11, 16),
(253, 16, 12, 19),
(254, 16, 13, 17),
(255, 16, 14, 18),
(256, 17, 10, 15),
(257, 17, 11, 19),
(258, 17, 12, 18),
(259, 17, 13, 20),
(260, 17, 14, 17),
(261, 18, 10, 16),
(262, 18, 11, 18),
(263, 18, 12, 19),
(264, 18, 13, 20),
(265, 18, 14, 17),
(266, 19, 10, 18),
(267, 19, 11, 17),
(268, 19, 12, 19),
(269, 19, 13, 16),
(270, 19, 14, 18),
(271, 20, 10, 13),
(272, 20, 11, 19),
(273, 20, 12, 18),
(274, 20, 13, 17),
(275, 20, 14, 20),
(276, 21, 10, 14),
(277, 21, 11, 18),
(278, 21, 12, 19),
(279, 21, 13, 16),
(280, 21, 14, 18),
(281, 22, 10, 15),
(282, 22, 11, 17),
(283, 22, 12, 19),
(284, 22, 13, 18),
(285, 22, 14, 16),
(286, 23, 10, 14),
(287, 23, 11, 20),
(288, 23, 12, 18),
(289, 23, 13, 17),
(290, 23, 14, 16),
(291, 24, 10, 18),
(292, 24, 11, 19),
(293, 24, 12, 16),
(294, 24, 13, 20),
(295, 24, 14, 17),
(296, 25, 10, 18),
(297, 25, 11, 16),
(298, 25, 12, 17),
(299, 25, 13, 19),
(300, 25, 14, 15),
(301, 26, 10, 20),
(302, 26, 11, 19),
(303, 26, 12, 18),
(304, 26, 13, 17),
(305, 26, 14, 16),
(306, 27, 10, 15),
(307, 27, 11, 18),
(308, 27, 12, 16),
(309, 27, 13, 19),
(310, 27, 14, 17),
(311, 28, 10, 14),
(312, 28, 11, 16),
(313, 28, 12, 20),
(314, 28, 13, 18),
(315, 28, 14, 17),
(316, 29, 10, 16),
(317, 29, 11, 18),
(318, 29, 12, 19),
(319, 29, 13, 17),
(320, 29, 14, 15),
(321, 30, 10, 17),
(322, 30, 11, 20),
(323, 30, 12, 18),
(324, 30, 13, 16),
(325, 30, 14, 19),
(326, 31, 10, 18),
(327, 31, 11, 17),
(328, 31, 12, 19),
(329, 31, 13, 20),
(330, 31, 14, 16),
(331, 32, 10, 20),
(332, 32, 11, 19),
(333, 32, 12, 16),
(334, 32, 13, 18),
(335, 32, 14, 15),
(336, 33, 10, 16),
(337, 33, 11, 20),
(338, 33, 12, 18),
(339, 33, 13, 17),
(340, 33, 14, 19),
(341, 34, 10, 18),
(342, 34, 11, 17),
(343, 34, 12, 19),
(344, 34, 13, 16),
(345, 34, 14, 20),
(346, 35, 10, 15),
(347, 35, 11, 19),
(348, 35, 12, 17),
(349, 35, 13, 18),
(350, 35, 14, 16),
(351, 36, 10, 20),
(352, 36, 11, 18),
(353, 36, 12, 19),
(354, 36, 13, 16),
(355, 36, 14, 17),
(356, 37, 10, 17),
(357, 37, 11, 16),
(358, 37, 12, 20),
(359, 37, 13, 18),
(360, 37, 14, 19),
(361, 38, 10, 16),
(362, 38, 11, 18),
(363, 38, 12, 20),
(364, 38, 13, 19),
(365, 38, 14, 17),
(366, 39, 10, 19),
(367, 39, 11, 18),
(368, 39, 12, 17),
(369, 39, 13, 20),
(370, 39, 14, 16),
(371, 40, 10, 16),
(372, 40, 11, 19),
(373, 40, 12, 20),
(374, 40, 13, 18),
(375, 40, 14, 17),
(376, 41, 10, 17),
(377, 41, 11, 18),
(378, 41, 12, 19),
(379, 41, 13, 20),
(380, 41, 14, 16),
(381, 42, 10, 19),
(382, 42, 11, 17),
(383, 42, 12, 16),
(384, 42, 13, 18),
(385, 42, 14, 20),
(386, 43, 10, 20),
(387, 43, 11, 17),
(388, 43, 12, 18),
(389, 43, 13, 19),
(390, 43, 14, 16),
(391, 44, 10, 18),
(392, 44, 11, 19),
(393, 44, 12, 20),
(394, 44, 13, 17),
(395, 44, 14, 16),
(396, 45, 10, 19),
(397, 45, 11, 18),
(398, 45, 12, 17),
(399, 45, 13, 16),
(400, 45, 14, 20),
(401, 46, 10, 17),
(402, 46, 11, 18),
(403, 46, 12, 19),
(404, 46, 13, 16),
(405, 46, 14, 20),
(406, 47, 10, 16),
(407, 47, 11, 17),
(408, 47, 12, 19),
(409, 47, 13, 18),
(410, 47, 14, 20),
(411, 48, 10, 19),
(412, 48, 11, 18),
(413, 48, 12, 20),
(414, 48, 13, 17),
(415, 48, 14, 16),
(416, 49, 10, 19),
(417, 49, 11, 16),
(418, 49, 12, 18),
(419, 49, 13, 20),
(420, 49, 14, 17),
(421, 50, 10, 18),
(422, 50, 11, 19),
(423, 50, 12, 20),
(424, 50, 13, 17),
(425, 50, 14, 16),
(426, 51, 10, 17),
(427, 51, 11, 18),
(428, 51, 12, 19),
(429, 51, 13, 20),
(430, 51, 14, 16),
(431, 52, 10, 16),
(432, 52, 11, 19),
(433, 52, 12, 20),
(434, 52, 13, 17),
(435, 52, 14, 18),
(436, 53, 10, 19),
(437, 53, 11, 17),
(438, 53, 12, 20),
(439, 53, 13, 16),
(440, 53, 14, 18),
(441, 54, 10, 17),
(442, 54, 11, 18),
(443, 54, 12, 19),
(444, 54, 13, 20),
(445, 54, 14, 16),
(446, 55, 10, 16),
(447, 55, 11, 17),
(448, 55, 12, 18),
(449, 55, 13, 20),
(450, 55, 14, 19),
(451, 56, 10, 19),
(452, 56, 11, 20),
(453, 56, 12, 18),
(454, 56, 13, 17),
(455, 56, 14, 16),
(456, 57, 10, 16),
(457, 57, 11, 19),
(458, 57, 12, 18),
(459, 57, 13, 17),
(460, 57, 14, 20),
(461, 58, 10, 17),
(462, 58, 11, 16),
(463, 58, 12, 19),
(464, 58, 13, 20),
(465, 58, 14, 18),
(466, 59, 10, 16),
(467, 59, 11, 20),
(468, 59, 12, 17),
(469, 59, 13, 18),
(470, 59, 14, 19),
(471, 1, 10, 13),
(472, 1, 11, 15),
(473, 1, 12, 15),
(474, 1, 13, 15),
(475, 1, 14, 20),
(476, 2, 10, 14),
(477, 2, 11, 6),
(478, 2, 12, 16),
(479, 2, 13, 19),
(480, 2, 14, 20),
(481, 3, 10, 20),
(482, 3, 11, 12),
(483, 3, 12, 15),
(484, 3, 13, 16),
(485, 3, 14, 17),
(486, 8, 10, 15),
(487, 8, 11, 17),
(488, 8, 12, 18),
(489, 8, 13, 19),
(490, 8, 14, 20),
(491, 9, 10, 20),
(492, 9, 11, 20),
(493, 9, 12, 19),
(494, 9, 13, 17),
(495, 9, 14, 16);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int NOT NULL,
  `id_kriteria` int NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `nilai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `id_kriteria`, `deskripsi`, `nilai`) VALUES
(10, 10, 'TEPAT WAKTU', 10),
(13, 10, 'SERING TERLAMBAT', 5),
(14, 11, 'SANGAT JUJUR', 10),
(15, 11, 'KADANG BERBOHONG', 5),
(16, 12, 'SANGAT BAIK', 10),
(17, 12, 'KURANG BAIK', 5),
(18, 13, 'KOMUNIKASI EFEKTIF', 10),
(19, 13, 'KOMUNIKASI TIDAK EFEKTIF', 5),
(20, 14, 'SANGAT DISIPLIN', 10),
(21, 14, 'KURANG DISIPLIN', 5),
(22, 10, 'COBA', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `id_user_level` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_user_level`, `email`, `username`, `password`, `nama`) VALUES
(3, 1, 'tigor@kemdikbud.go.id', 'admin', '$2y$13$EJt5cezxyA1lFVubf/TTJ.WRVoGnYu3XkyyDL3H4EiCKZmpuYGgei', 'Tigor'),
(6, 1, 'xi@chinaltd.cn', 'xi', '$2y$13$zCeUHPZFH4fAclbk/XKZrO6v3dJ1Ya3QeJxHi7jlDH0dRKGH3eZM2', 'Xi Jin Ping'),
(7, 1, 'tigorpercum@gmail.com', 'TigorYAI', '$2y$13$SRQaUKXTS0HGFifgmafAtu3tGh9nWbPQ5Eg5tuelNWh.5gZbDEQrG', 'Tigor'),
(8, 2, 'kabag@kemdikbud.go.id', 'kabag', '$2y$13$yQ8lxA142c621JbLCfJ9cOK9IifJ3UISm56zziIu3mhizqw0OWyCK', 'Kepala Bagian'),
(9, 3, 'karyawan@kemdikbug.go.id', 'karyawan', '$2y$13$UCe64IDPhqB9DPqgRTOvgekduZuHaOYFPt/rr1XFsq9O9b/0eRz5C', 'karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id` int NOT NULL,
  `user_level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id`, `user_level`) VALUES
(1, 'Admin'),
(2, 'Kepala Bagian'),
(3, 'Karyawan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alternatif` (`id_alternatif`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `kriteria_ahp`
--
ALTER TABLE `kriteria_ahp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-kriteria_ahp-id_kriteria_1` (`id_kriteria_1`),
  ADD KEY `idx-kriteria_ahp-id_kriteria_2` (`id_kriteria_2`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_alternatif` (`id_alternatif`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `idx-sub_kriteria-id_kriteria` (`id_kriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `idx-user-id_user_level` (`id_user_level`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kriteria_ahp`
--
ALTER TABLE `kriteria_ahp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=496;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`);

--
-- Constraints for table `kriteria_ahp`
--
ALTER TABLE `kriteria_ahp`
  ADD CONSTRAINT `fk-kriteria_ahp-id_kriteria_1` FOREIGN KEY (`id_kriteria_1`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-kriteria_ahp-id_kriteria_2` FOREIGN KEY (`id_kriteria_2`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE;

--
-- Constraints for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `fk-sub_kriteria-id_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk-user-id_user_level` FOREIGN KEY (`id_user_level`) REFERENCES `user_level` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
