-- --------------------------------------------------------
-- Database : db_sekolah
-- Aplikasi : CRUD Data Siswa RPL
-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `db_sekolah`;
USE `db_sekolah`;

-- --------------------------------------------------------
-- Struktur tabel `siswa`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `siswa` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nis` VARCHAR(20) NOT NULL,
  `nama` VARCHAR(100) NOT NULL,
  `jurusan` VARCHAR(50) NOT NULL,
  `alamat` TEXT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
