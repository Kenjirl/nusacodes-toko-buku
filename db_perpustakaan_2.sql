/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 8.0.30 : Database - db_perpustakaan_2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_perpustakaan_2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `db_perpustakaan_2`;

/*Table structure for table `tb_buku` */

DROP TABLE IF EXISTS `tb_buku`;

CREATE TABLE `tb_buku` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `sinopsis` text NOT NULL,
  `tanggal_terbit` date NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tb_buku` */

INSERT INTO `tb_buku` (`id`, `judul`, `penulis`, `sinopsis`, `tanggal_terbit`, `harga`) VALUES
(1, 'Belajar Pemrograman Java', 'Andi Saputra', 'Buku ini membahas dasar-dasar pemrograman Java mulai dari sintaks hingga pembuatan aplikasi sederhana.', '2024-10-10', 75000.00),
(2, 'Misteri di Balik Layar', 'Rina Wijaya', 'Novel misteri yang mengisahkan seorang detektif dalam mengungkap rahasia di balik kematian seorang artis terkenal.', '2025-01-05', 85000.00),
(3, 'Panduan Laravel untuk Pemula', 'Budi Santoso', 'Buku ini membahas framework Laravel secara mendetail, mulai dari instalasi hingga pembuatan aplikasi web.', '2024-12-20', 95000.00),
(4, 'Petualangan Sang Petarung', 'Doni Prasetyo', 'Kisah epik tentang seorang pendekar yang berkelana untuk mencari pedang legendaris yang bisa mengalahkan iblis.', '2023-11-11', 65000.00),
(5, 'Ekonomi Digital: Peluang dan Tantangan', 'Siti Nurdiana', 'Analisis mendalam mengenai dampak perkembangan ekonomi digital terhadap bisnis dan masyarakat.', '2024-08-15', 120000.00),
(6, 'Psikologi dalam Kehidupan Sehari-hari', 'Dr. Ahmad Fauzi', 'Buku yang menjelaskan bagaimana psikologi mempengaruhi keputusan dan perilaku manusia dalam kehidupan sehari-hari.', '2024-07-01', 105000.00),
(7, 'Mengenal Data Science', 'Dewi Kusuma', 'Panduan komprehensif tentang data science, machine learning, dan penerapannya di dunia industri.', '2024-09-30', 98000.00),
(8, 'Perjalanan Menuju Keabadian', 'Rahmat Hidayat', 'Novel fiksi ilmiah yang menceritakan perjalanan seorang ilmuwan dalam menemukan rahasia kehidupan abadi.', '2025-06-22', 73000.00),
(9, 'Rahasia Keuangan Pribadi', 'Linda Hartono', 'Tips dan strategi untuk mengelola keuangan pribadi agar lebih stabil dan berkembang.', '2024-05-12', 88000.00),
(10, 'Dunia Tanpa Batas', 'Agus Priyanto', 'Kisah petualangan seorang penjelajah yang menemukan dunia baru yang penuh dengan keajaiban.', '2023-12-05', 67000.00);

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id`,`username`,`password`) values 
(1,'kencong','123456');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
