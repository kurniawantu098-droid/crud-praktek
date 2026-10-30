-- Database db_toko
CREATE DATABASE IF NOT EXISTS `db_toko`;
USE `db_toko`;
CREATE TABLE IF NOT EXISTS `barang` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` VARCHAR(20) NOT NULL,
  `nama_barang` VARCHAR(100) NOT NULL,
  `harga` INT(11) NOT NULL,
  `stok` INT(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `barang` (`kode_barang`,`nama_barang`,`harga`,`stok`) VALUES
('BRG001','Mouse Logitech',150000,10),
('BRG002','Keyboard Mechanical',350000,5);