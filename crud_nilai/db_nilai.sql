CREATE DATABASE IF NOT EXISTS `db_nilai`;
USE `db_nilai`;
CREATE TABLE IF NOT EXISTS `nilai_siswa` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nis` VARCHAR(20) NOT NULL,
  `nama` VARCHAR(100) NOT NULL,
  `kelas` VARCHAR(20) NOT NULL,
  `nilai_pemrograman` INT(11) NOT NULL,
  `nilai_web` INT(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `nilai_siswa` (`nis`,`nama`,`kelas`,`nilai_pemrograman`,`nilai_web`) VALUES
('123','Budi','XI RPL 1',80,90),
('124','Ani','XI RPL 1',70,65);