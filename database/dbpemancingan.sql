-- MariaDB dump 10.19  Distrib 10.8.3-MariaDB, for osx10.17 (arm64)
--
-- Host: localhost    Database: dbpemancingan
-- ------------------------------------------------------
-- Server version	10.8.3-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `td_konfirmasi`
--

DROP TABLE IF EXISTS `td_konfirmasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `td_konfirmasi` (
  `id_konfirm` int(11) NOT NULL AUTO_INCREMENT,
  `kd_transaksi` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL,
  `bukti` varchar(50) NOT NULL,
  `timestamp` datetime NOT NULL,
  `usercreate` varchar(50) NOT NULL,
  `no_rek` varchar(30) NOT NULL,
  `sts` varchar(30) NOT NULL,
  PRIMARY KEY (`id_konfirm`),
  KEY `fk_tdkonfirmasi_tdpesanan` (`kd_transaksi`),
  KEY `fk_tdkonfirmasi_tmrekening` (`no_rek`),
  CONSTRAINT `fk_tdkonfirmasi_tdpesanan` FOREIGN KEY (`kd_transaksi`) REFERENCES `td_pesanan` (`kd_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tdkonfirmasi_tmrekening` FOREIGN KEY (`no_rek`) REFERENCES `tm_rekening` (`no_rek`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `td_konfirmasi`
--

LOCK TABLES `td_konfirmasi` WRITE;
/*!40000 ALTER TABLE `td_konfirmasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_konfirmasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `td_pesanan`
--

DROP TABLE IF EXISTS `td_pesanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `td_pesanan` (
  `kd_transaksi` varchar(25) NOT NULL,
  `id_kolam` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL,
  `usercreate` varchar(50) NOT NULL,
  `id_jam` int(11) NOT NULL,
  PRIMARY KEY (`kd_transaksi`),
  KEY `fk_tdpesanan_tmuser` (`nik`),
  KEY `fk_tdpesanan_tmjam` (`id_jam`),
  KEY `fk_tdpesanan_tmkolam` (`id_kolam`),
  CONSTRAINT `fk_tdpesanan_tmjam` FOREIGN KEY (`id_jam`) REFERENCES `tm_jam` (`id_jam`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tdpesanan_tmkolam` FOREIGN KEY (`id_kolam`) REFERENCES `tm_kolam` (`id_kolam`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tdpesanan_tmuser` FOREIGN KEY (`nik`) REFERENCES `tm_user` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `td_pesanan`
--

LOCK TABLES `td_pesanan` WRITE;
/*!40000 ALTER TABLE `td_pesanan` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_pesanan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `td_transaksi_selesai`
--

DROP TABLE IF EXISTS `td_transaksi_selesai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `td_transaksi_selesai` (
  `id_ts` int(11) NOT NULL AUTO_INCREMENT,
  `kd_transaksi` varchar(25) NOT NULL,
  PRIMARY KEY (`id_ts`),
  KEY `fk_tdtransaksi_selesai_tdpesanan` (`kd_transaksi`),
  CONSTRAINT `fk_tdtransaksi_selesai_tdpesanan` FOREIGN KEY (`kd_transaksi`) REFERENCES `td_pesanan` (`kd_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `td_transaksi_selesai`
--

LOCK TABLES `td_transaksi_selesai` WRITE;
/*!40000 ALTER TABLE `td_transaksi_selesai` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_transaksi_selesai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_jam`
--

DROP TABLE IF EXISTS `tm_jam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_jam` (
  `id_jam` int(10) NOT NULL AUTO_INCREMENT,
  `jam` time DEFAULT NULL,
  PRIMARY KEY (`id_jam`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_jam`
--

LOCK TABLES `tm_jam` WRITE;
/*!40000 ALTER TABLE `tm_jam` DISABLE KEYS */;
INSERT INTO `tm_jam` VALUES
(1,'08:00:00'),
(2,'13:00:00'),
(3,'20:00:00');
/*!40000 ALTER TABLE `tm_jam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_kolam`
--

DROP TABLE IF EXISTS `tm_kolam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_kolam` (
  `id_kolam` int(11) NOT NULL AUTO_INCREMENT,
  `kd_kolam` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `detail` text NOT NULL,
  `pic` varchar(200) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  PRIMARY KEY (`id_kolam`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_kolam`
--

LOCK TABLES `tm_kolam` WRITE;
/*!40000 ALTER TABLE `tm_kolam` DISABLE KEYS */;
INSERT INTO `tm_kolam` VALUES
(1,'KL','Kolam Ikan Lele','Kolam dengan budidaya ikan Lele','3284Kolam Ikan Lele.jpeg','30000',40),
(2,'KN','Kolam Ikan Nila','Kolam dengan budidaya ikan Nila','1113Kolam Ikan Nila.jpeg','40000',30);
/*!40000 ALTER TABLE `tm_kolam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_rekening`
--

DROP TABLE IF EXISTS `tm_rekening`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_rekening` (
  `no_rek` varchar(30) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `atas_nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`no_rek`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_rekening`
--

LOCK TABLES `tm_rekening` WRITE;
/*!40000 ALTER TABLE `tm_rekening` DISABLE KEYS */;
INSERT INTO `tm_rekening` VALUES
('1011002030','Mandiri','Admin');
/*!40000 ALTER TABLE `tm_rekening` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_statis`
--

DROP TABLE IF EXISTS `tm_statis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_statis` (
  `id_statis` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `halaman` varchar(50) NOT NULL,
  `detail` text NOT NULL,
  PRIMARY KEY (`id_statis`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_statis`
--

LOCK TABLES `tm_statis` WRITE;
/*!40000 ALTER TABLE `tm_statis` DISABLE KEYS */;
INSERT INTO `tm_statis` VALUES
(1,'About Us','About','Sejarah Permahusada diawali dari pemancingan, dan sampai saat ini menjadi lokasi yang paling diminati para pecinta memancing. Dikemas dengan berbagai fasilitas lainnya, Permahusada membuat Anda para pecinta memancing dapat meluangkan waktu bersama keluarga dan rekan sejawat. Begitupun sebaliknya, untuk Anda dan keluarga yang belum pernah merasakan serunya sensasi memancing, di Permahusada tempatnya.'),
(2,'Cara Pemesanan','pemesanan','Untuk pemesanan tiket, anda harus memenuhi syarat-syarat yang kami berikan pada bagian selanjutnya, apa saja syarat yang harus anda penuhi atau bagaimana cara untuk mendapatkan tiket secara online  :<br>\r\n\r\n1. Anda harus melakukan register sebagai members.<br>\r\n2. silahkan isi semua data-data register anda dengan baik dan benar.<br>\r\n3. jika semua sudah di isi, maka silahkan klik submit button.<br>\r\n4. jika sukses melakukan pendaftaran, anda sudah bisa melakukan login.<br>\r\n5. masukkan pada halaman login username dan password anda waktu mendaftar.<br>\r\n6. jika benar, anda akan di bawa ke halaman members.<br>\r\n7. untuk memesan tiket pergi kelahaman <b>Pesan Tiket</b><br>\r\n8. dan isi semua data pemesanan anda.<br>\r\n9. Pada pemilihan waktu pilih salah satu waktu ketika anda akan memancing.<br>\r\n10. Setelah data terisi klik tombol Pesan.<br>\r\n11. jika data2 yang anda isikan benar, maka anda akan sukses memesan tiket.<br>\r\n12. silahkan bayar pesanan anda ke rekening yang tertera.<br>\r\n13. jika sudah transfer, silahkan upload bukti pembayaran.<br>\r\n14. setelah bukti pembayaran terUpload, tunggu status anda samapai di konfirmasi oleh admin.<br>\r\n15. cetak tiket jika sudah lunas atau di konfirmasi.<br/>\r\n\r\n');
/*!40000 ALTER TABLE `tm_statis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tm_user`
--

DROP TABLE IF EXISTS `tm_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tm_user` (
  `nik` varchar(16) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL,
  `timestamp` datetime NOT NULL,
  `usercreate` varchar(50) NOT NULL,
  PRIMARY KEY (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tm_user`
--

LOCK TABLES `tm_user` WRITE;
/*!40000 ALTER TABLE `tm_user` DISABLE KEYS */;
INSERT INTO `tm_user` VALUES
('superadmin','Admin','$2y$10$WHBoycpHJHU/Ke1R7VjHL.AGjAjvJ035XdQNQYOy.B2A4Jw9Pwy8e','Super Admin','superadmin@gmail.com','None','0812000000000','admin','2022-12-03 11:09:49','admin_superadmin');
/*!40000 ALTER TABLE `tm_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-03 11:40:49
