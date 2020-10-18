/*
SQLyog Ultimate v9.50 
MySQL - 5.5.5-10.1.29-MariaDB : Database - forecasting_ses_tm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`forecasting_ses_tm` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `forecasting_ses_tm`;

/*Table structure for table `tb_jenis` */

DROP TABLE IF EXISTS `tb_jenis`;

CREATE TABLE `tb_jenis` (
  `kode_jenis` varchar(16) NOT NULL,
  `nama_jenis` varchar(255) DEFAULT NULL,
  `hasil` double DEFAULT NULL,
  PRIMARY KEY (`kode_jenis`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tb_jenis` */

insert  into `tb_jenis`(`kode_jenis`,`nama_jenis`,`hasil`) values ('J01','Padi',1699142.8571429),('J02','Jagung',52.525);

/*Table structure for table `tb_periode` */

DROP TABLE IF EXISTS `tb_periode`;

CREATE TABLE `tb_periode` (
  `kode_periode` varchar(16) NOT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`kode_periode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tb_periode` */

insert  into `tb_periode`(`kode_periode`,`tanggal`) values ('P01','2020-01-01'),('P02','2020-02-01'),('P03','2020-03-01'),('P04','2020-04-01'),('P05','2020-05-01'),('P06','2020-06-01'),('P07','2020-07-01'),('P08','2020-08-01'),('P09','2020-09-01'),('P10','2020-10-01'),('P11','2020-11-01'),('P12','2020-12-01'),('P13','2020-12-02');

/*Table structure for table `tb_relasi` */

DROP TABLE IF EXISTS `tb_relasi`;

CREATE TABLE `tb_relasi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kode_periode` varchar(16) DEFAULT NULL,
  `kode_jenis` varchar(16) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

/*Data for the table `tb_relasi` */

insert  into `tb_relasi`(`ID`,`kode_periode`,`kode_jenis`,`nilai`) values (1,'P01','J01',71),(2,'P01','J02',10),(4,'P02','J01',70),(5,'P02','J02',13),(7,'P03','J01',69),(8,'P03','J02',15),(10,'P04','J01',68),(11,'P04','J02',17),(13,'P05','J01',64),(14,'P05','J02',19),(19,'P06','J01',65),(20,'P06','J02',20),(22,'P07','J01',72),(23,'P07','J02',25),(25,'P08','J01',78),(26,'P08','J02',26),(53,'P09','J01',75),(54,'P09','J02',1),(56,'P10','J01',75),(57,'P10','J02',12),(59,'P11','J01',75),(60,'P11','J02',4),(68,'P13','J02',5),(62,'P12','J01',70),(63,'P12','J02',2),(67,'P13','J01',5);

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `user` varchar(16) DEFAULT NULL,
  `pass` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_user` */

insert  into `tb_user`(`user`,`pass`) values ('admin','admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
