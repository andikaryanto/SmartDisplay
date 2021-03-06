/*
SQLyog Professional v12.4.3 (64 bit)
MySQL - 10.1.33-MariaDB : Database - accounting_2019
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `g_colors` */

DROP TABLE IF EXISTS `g_colors`;

CREATE TABLE `g_colors` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(300) NOT NULL,
  `Value` varchar(300) NOT NULL,
  `CssClass` varchar(300) NOT NULL,
  `CssPath` varchar(300) NOT NULL,
  `CssCustomPath` varchar(300) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `g_colors` */

insert  into `g_colors`(`Id`,`Name`,`Value`,`CssClass`,`CssPath`,`CssCustomPath`) values 
(1,'primary','#9c27b0','text-primary','assets/material-dashboard/assets/css/material-dashboard.min.css','assets/material-dashboard/assets/css/custom.css'),
(2,'green','#4caf50','text-success','assets/material-dashboard/assets/css/material-dashboard.greeen.min.css','assets/material-dashboard/assets/css/custom.green.css'),
(3,'orange','#ff9800','text-warning','assets/material-dashboard/assets/css/material-dashboard.orange.min.css','assets/material-dashboard/assets/css/Custom.orange.css');

/*Table structure for table `g_languages` */

DROP TABLE IF EXISTS `g_languages`;

CREATE TABLE `g_languages` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `g_languages` */

insert  into `g_languages`(`Id`,`Name`) values 
(1,'indonesia'),
(2,'english');

/*Table structure for table `g_transactionnumbers` */

DROP TABLE IF EXISTS `g_transactionnumbers`;

CREATE TABLE `g_transactionnumbers` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Format` varchar(50) NOT NULL,
  `Year` int(11) NOT NULL,
  `Month` int(11) NOT NULL,
  `LastNumber` int(11) NOT NULL,
  `M_Form_Id` int(11) NOT NULL,
  `TypeTrans` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `g_transactionnumbers` */

insert  into `g_transactionnumbers`(`Id`,`Format`,`Year`,`Month`,`LastNumber`,`M_Form_Id`,`TypeTrans`) values 
(1,'BKM/{YYYY}{MM}/#######',2019,2,1,7,1),
(2,'BKK/{YYYY}{MM}/#######',2019,2,1,7,2),
(3,'JUR/{YYYY}{MM}/#######',2019,2,4,7,3);

/*Table structure for table `g_versionhistory` */

DROP TABLE IF EXISTS `g_versionhistory`;

CREATE TABLE `g_versionhistory` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Version` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

/*Data for the table `g_versionhistory` */

insert  into `g_versionhistory`(`Id`,`Version`) values 
(1,'20181126072409'),
(2,'20181126072713'),
(3,'20181126081808'),
(4,'20181126083126'),
(5,'20181126083234'),
(6,'20181126100538'),
(7,'20181129105921'),
(8,'20181201061354'),
(9,'20181217062632'),
(10,'20181219070746'),
(11,'20181231114947'),
(12,'20190104103204'),
(13,'20190108130118'),
(14,'20190108131152'),
(15,'20190110093633'),
(16,'20190110113848'),
(17,'20190110215426'),
(18,'20190114143739'),
(19,'20190114145930'),
(20,'20190115125719'),
(21,'20190116143925'),
(22,'20190116145834'),
(23,'20190129133102'),
(24,'20190129133334'),
(25,'20190218123551'),
(26,'20190219105637'),
(27,'20190219115745'),
(28,'20190219133337'),
(29,'20190219155334'),
(30,'20190220084111'),
(31,'20190221090138'),
(32,'20190221100612'),
(33,'20190221102556'),
(34,'20190221131255'),
(35,'20190221134401'),
(36,'20190221143217'),
(37,'20190222150138'),
(38,'20190222150814'),
(39,'20190222152416'),
(40,'20190225084046');

/*Table structure for table `m_accessroles` */

DROP TABLE IF EXISTS `m_accessroles`;

CREATE TABLE `m_accessroles` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `M_Form_Id` int(11) NOT NULL,
  `M_Groupuser_Id` int(11) NOT NULL,
  `Read` tinyint(1) NOT NULL,
  `Write` tinyint(1) NOT NULL,
  `Delete` tinyint(1) NOT NULL,
  `Print` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `m_accessroles_M_Groupuser_Id_fk` (`M_Groupuser_Id`),
  KEY `m_accessroles_M_Form_Id_fk` (`M_Form_Id`),
  CONSTRAINT `m_accessroles_M_Form_Id_fk` FOREIGN KEY (`M_Form_Id`) REFERENCES `m_forms` (`Id`) ON UPDATE CASCADE,
  CONSTRAINT `m_accessroles_M_Groupuser_Id_fk` FOREIGN KEY (`M_Groupuser_Id`) REFERENCES `m_groupusers` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `m_accessroles` */

/*Table structure for table `m_beginningbalances` */

DROP TABLE IF EXISTS `m_beginningbalances`;

CREATE TABLE `m_beginningbalances` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `M_Chartofaccount_Id` int(11) NOT NULL,
  `Type` varchar(5) NOT NULL,
  `Attribute` varchar(5) NOT NULL,
  `Amount` decimal(20,2) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `m_beginningbalances_M_Chartofaccount_Id_fk` (`M_Chartofaccount_Id`),
  CONSTRAINT `m_beginningbalances_M_Chartofaccount_Id_fk` FOREIGN KEY (`M_Chartofaccount_Id`) REFERENCES `m_chartofaccounts` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;

/*Data for the table `m_beginningbalances` */

insert  into `m_beginningbalances`(`Id`,`M_Chartofaccount_Id`,`Type`,`Attribute`,`Amount`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(11,11,'D','+',50000000000.00,'superadmin',NULL,'2019-02-25 11:22:33','2019-02-25 13:08:30'),
(12,12,'D','+',1000000000.00,'superadmin',NULL,'2019-02-25 11:22:46','2019-02-25 12:03:53'),
(14,14,'D','+',0.00,'superadmin',NULL,'2019-02-25 13:29:33','2019-02-25 13:29:33'),
(16,16,'D','+',0.00,'superadmin',NULL,'2019-02-25 13:30:13','2019-02-25 13:30:13'),
(18,18,'D','+',0.00,'superadmin',NULL,'2019-02-25 13:36:20','2019-02-25 13:36:20'),
(21,21,'D','+',0.00,'superadmin',NULL,'2019-02-25 13:38:35','2019-02-25 13:38:35'),
(22,22,'D','+',0.00,'superadmin',NULL,'2019-02-25 13:38:43','2019-02-25 13:38:43'),
(23,23,'D','+',0.00,'superadmin',NULL,'2019-02-25 13:38:54','2019-02-25 13:38:54'),
(24,24,'D','+',0.00,'superadmin',NULL,'2019-02-25 13:39:08','2019-02-25 13:39:08'),
(30,30,'D','-',0.00,'superadmin',NULL,'2019-02-25 13:43:20','2019-02-25 13:43:20'),
(31,31,'D','-',0.00,'superadmin',NULL,'2019-02-25 13:43:47','2019-02-25 13:43:47'),
(32,32,'D','-',0.00,'superadmin',NULL,'2019-02-25 13:43:57','2019-02-25 13:43:57'),
(33,33,'D','-',0.00,'superadmin',NULL,'2019-02-25 13:44:06','2019-02-25 13:44:06'),
(38,38,'C','+',0.00,'superadmin',NULL,'2019-02-25 13:48:26','2019-02-25 13:48:26'),
(40,40,'C','+',0.00,'superadmin',NULL,'2019-02-25 13:48:54','2019-02-25 13:48:54'),
(43,43,'C','+',0.00,'superadmin',NULL,'2019-02-25 13:50:58','2019-02-25 13:50:58'),
(45,45,'C','+',0.00,'superadmin',NULL,'2019-02-25 13:51:35','2019-02-25 13:51:35'),
(77,77,'C','+',0.00,'superadmin',NULL,'2019-02-25 15:45:10','2019-02-25 15:45:10'),
(78,78,'D','+',0.00,'superadmin',NULL,'2019-02-25 15:45:18','2019-02-25 15:45:18'),
(79,79,'D','+',0.00,'superadmin',NULL,'2019-02-25 15:45:27','2019-02-25 15:45:27'),
(81,81,'D','+',0.00,'superadmin',NULL,'2019-02-25 15:45:45','2019-02-25 15:45:45'),
(82,82,'D','+',0.00,'superadmin',NULL,'2019-02-25 15:45:54','2019-02-25 15:45:54'),
(83,83,'D','+',0.00,'superadmin',NULL,'2019-02-25 15:46:56','2019-02-25 15:46:56'),
(89,89,'D','+',0.00,'superadmin',NULL,'2019-02-25 15:50:59','2019-02-25 15:50:59'),
(90,90,'D','+',0.00,'superadmin',NULL,'2019-02-25 15:51:08','2019-02-25 15:51:08'),
(91,91,'D','+',0.00,'superadmin',NULL,'2019-02-25 15:51:21','2019-02-25 15:51:21'),
(92,92,'D','+',0.00,'superadmin',NULL,'2019-02-25 15:51:31','2019-02-25 15:51:31'),
(93,93,'D','+',0.00,'superadmin',NULL,'2019-02-25 15:51:43','2019-02-25 15:51:43'),
(94,94,'D','+',0.00,'superadmin',NULL,'2019-02-25 15:51:56','2019-02-25 15:51:56'),
(97,97,'C','+',0.00,'superadmin',NULL,'2019-02-25 15:52:28','2019-02-25 15:52:28'),
(98,98,'C','+',0.00,'superadmin',NULL,'2019-02-25 15:52:44','2019-02-25 15:52:44'),
(101,101,'D','+',0.00,'superadmin',NULL,'2019-02-25 15:53:12','2019-02-25 15:53:12'),
(102,102,'D','+',0.00,'superadmin',NULL,'2019-02-25 15:53:21','2019-02-25 15:53:21'),
(103,103,'D','+',0.00,'superadmin',NULL,'2019-02-25 15:53:30','2019-02-25 15:53:30');

/*Table structure for table `m_chartofaccounts` */

DROP TABLE IF EXISTS `m_chartofaccounts`;

CREATE TABLE `m_chartofaccounts` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Code` varchar(50) NOT NULL,
  `Name` varchar(300) NOT NULL,
  `Parent` varchar(50) DEFAULT NULL,
  `Type` int(11) NOT NULL,
  `Level` int(11) NOT NULL,
  `CodeInt` varchar(50) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;

/*Data for the table `m_chartofaccounts` */

insert  into `m_chartofaccounts`(`Id`,`Code`,`Name`,`Parent`,`Type`,`Level`,`CodeInt`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(8,'1000','Aktiva',NULL,1,1,'1000000000','superadmin',NULL,'2019-02-25 11:21:59','2019-02-25 11:21:59'),
(9,'1000.01','Aktiva Lancar','8',1,2,'1000010000','superadmin',NULL,'2019-02-25 11:22:10','2019-02-25 11:22:10'),
(10,'1000.01.01','Kas dan Setara Kas','9',1,3,'1000010100','superadmin',NULL,'2019-02-25 11:22:21','2019-02-25 11:22:21'),
(11,'1000.01.01.01','Kas','10',1,4,'1000010101','superadmin',NULL,'2019-02-25 11:22:33','2019-02-25 11:22:33'),
(12,'1000.01.01.02','Bank','10',1,4,'1000010102','superadmin',NULL,'2019-02-25 11:22:46','2019-02-25 11:22:46'),
(13,'1000.01.02','Piutang','9',1,3,'1000010200','superadmin',NULL,'2019-02-25 12:53:37','2019-02-25 12:53:37'),
(14,'1000.01.02.01','Piutang','13',1,4,'1000010201','superadmin',NULL,'2019-02-25 13:29:33','2019-02-25 13:29:33'),
(15,'1000.01.03','Persediaan','9',1,3,'1000010300','superadmin',NULL,'2019-02-25 13:29:59','2019-02-25 13:29:59'),
(16,'1000.01.03.01','Persediaan','15',1,4,'1000010301','superadmin',NULL,'2019-02-25 13:30:13','2019-02-25 13:30:13'),
(17,'1000.01.04','Sewa Dibayar Dimuka','9',1,3,'1000010400','superadmin',NULL,'2019-02-25 13:36:07','2019-02-25 13:36:07'),
(18,'1000.01.04.01','Sewa Dibayar Dimuka','17',1,4,'1000010401','superadmin',NULL,'2019-02-25 13:36:20','2019-02-25 13:36:20'),
(19,'1000.02','Aktiva Tetap','8',1,2,'1000020000','superadmin',NULL,'2019-02-25 13:36:59','2019-02-25 13:36:59'),
(20,'1000.02.01','Aktiva Tetap','19',1,3,'1000020100','superadmin',NULL,'2019-02-25 13:37:37','2019-02-25 13:37:37'),
(21,'1000.02.01.01','Tanah','20',1,4,'1000020101','superadmin',NULL,'2019-02-25 13:38:35','2019-02-25 13:38:35'),
(22,'1000.02.01.02','Bangunan','20',1,4,'1000020102','superadmin',NULL,'2019-02-25 13:38:43','2019-02-25 13:38:43'),
(23,'1000.02.01.03','Kendaraan','20',1,4,'1000020103','superadmin',NULL,'2019-02-25 13:38:54','2019-02-25 13:38:54'),
(24,'1000.02.01.04','Peralatan','20',1,4,'1000020104','superadmin',NULL,'2019-02-25 13:39:08','2019-02-25 13:39:08'),
(25,'1000.02.02','Akumulasi Penyusutan','19',1,3,'1000020200','superadmin',NULL,'2019-02-25 13:39:32','2019-02-25 13:39:32'),
(30,'1000.02.02.01','Tanah','25',1,4,'1000020201','superadmin',NULL,'2019-02-25 13:43:20','2019-02-25 13:43:20'),
(31,'1000.02.02.02','Bangunan','25',1,4,'1000020202','superadmin',NULL,'2019-02-25 13:43:47','2019-02-25 13:43:47'),
(32,'1000.02.02.03','Kendaraan','25',1,4,'1000020203','superadmin',NULL,'2019-02-25 13:43:57','2019-02-25 13:43:57'),
(33,'1000.02.02.04','Peralatan','25',1,4,'1000020204','superadmin',NULL,'2019-02-25 13:44:06','2019-02-25 13:44:06'),
(35,'2000','Pasiva',NULL,2,1,'2000000000','superadmin',NULL,'2019-02-25 13:46:48','2019-02-25 13:46:48'),
(36,'2000.01','Hutang','35',2,2,'2000010000','superadmin',NULL,'2019-02-25 13:47:44','2019-02-25 13:47:44'),
(37,'2000.01.01','Hutang Jangka Pendek','36',2,3,'2000010100','superadmin',NULL,'2019-02-25 13:48:16','2019-02-25 13:48:16'),
(38,'2000.01.01.01','Hutang Usaha','37',2,4,'2000010101','superadmin',NULL,'2019-02-25 13:48:26','2019-02-25 13:48:26'),
(39,'2000.01.02','Hutang Jangka Panjang','36',2,3,'2000010200','superadmin',NULL,'2019-02-25 13:48:44','2019-02-25 13:48:44'),
(40,'2000.01.02.01','Hutang Bank','39',2,4,'2000010201','superadmin',NULL,'2019-02-25 13:48:54','2019-02-25 13:48:54'),
(41,'2000.02','Modal','35',2,2,'2000020000','superadmin',NULL,'2019-02-25 13:49:07','2019-02-25 13:49:07'),
(42,'2000.02.01','Modal Usaha','41',2,3,'2000020100','superadmin',NULL,'2019-02-25 13:49:27','2019-02-25 13:49:27'),
(43,'2000.02.01.01','Modal Usaha','42',2,4,'2000020101','superadmin',NULL,'2019-02-25 13:50:57','2019-02-25 13:50:57'),
(44,'2000.02.02','Prive','41',2,3,'2000020200','superadmin',NULL,'2019-02-25 13:51:20','2019-02-25 13:51:20'),
(45,'2000.02.02.01','Prive','44',2,4,'2000020201','superadmin',NULL,'2019-02-25 13:51:35','2019-02-25 13:51:35'),
(74,'3000','Pendapatan',NULL,3,1,'3000000000','superadmin',NULL,'2019-02-25 15:44:18','2019-02-25 15:44:18'),
(75,'3000.01','Pendapatan','74',3,2,'3000010000','superadmin',NULL,'2019-02-25 15:44:39','2019-02-25 15:44:39'),
(76,'3000.01.01','Pendapatan','75',3,3,'3000010100','superadmin',NULL,'2019-02-25 15:44:46','2019-02-25 15:44:46'),
(77,'3000.01.01.01','Pendapatan Usaha/Penjualan Barang','76',3,4,'3000010101','superadmin',NULL,'2019-02-25 15:45:10','2019-02-25 15:45:10'),
(78,'3000.01.01.02','Potongan Penjualan','76',3,4,'3000010102','superadmin',NULL,'2019-02-25 15:45:18','2019-02-25 15:45:18'),
(79,'3000.01.01.03','Retur Penjualan','76',3,4,'3000010103','superadmin',NULL,'2019-02-25 15:45:27','2019-02-25 15:45:27'),
(80,'3000.01.02','Harga Pokok Penjualan','75',3,3,'3000010200','superadmin',NULL,'2019-02-25 15:45:36','2019-02-25 15:45:36'),
(81,'3000.01.02.01','Harga Pokok Penjualan','80',3,4,'3000010201','superadmin',NULL,'2019-02-25 15:45:45','2019-02-25 15:45:45'),
(82,'3000.01.02.02','Potongan Pembelian','80',3,4,'3000010202','superadmin',NULL,'2019-02-25 15:45:54','2019-02-25 15:45:54'),
(83,'3000.01.02.03','Retur Pembelian','80',3,4,'3000010203','superadmin',NULL,'2019-02-25 15:46:56','2019-02-25 15:46:56'),
(84,'4000','Biaya',NULL,4,1,'4000000000','superadmin',NULL,'2019-02-25 15:48:40','2019-02-25 15:48:40'),
(88,'4000.01','Biaya Administrasi dan Umum','84',4,2,'4000010000','superadmin',NULL,'2019-02-25 15:50:35','2019-02-25 15:50:35'),
(89,'4000.01.01','Biaya XXXX','88',4,3,'4000010100','superadmin',NULL,'2019-02-25 15:50:59','2019-02-25 15:50:59'),
(90,'4000.01.02','Biaya CCC','88',4,3,'4000010200','superadmin',NULL,'2019-02-25 15:51:08','2019-02-25 15:51:08'),
(91,'4000.01.03','Biaya DDD','88',4,3,'4000010300','superadmin',NULL,'2019-02-25 15:51:21','2019-02-25 15:51:21'),
(92,'4000.01.04','Biaya GGG','88',4,3,'4000010400','superadmin',NULL,'2019-02-25 15:51:31','2019-02-25 15:51:31'),
(93,'4000.01.05','Biaya FFF','88',4,3,'4000010500','superadmin',NULL,'2019-02-25 15:51:43','2019-02-25 15:51:43'),
(94,'4000.01.06','Biaya Penyusutan','88',4,3,'4000010600','superadmin',NULL,'2019-02-25 15:51:56','2019-02-25 15:51:56'),
(95,'5000','Pendapatan Non Operasional',NULL,5,1,'5000000000','superadmin',NULL,'2019-02-25 15:52:09','2019-02-25 15:52:09'),
(96,'5000.01','Pendapatan Non Operasional','95',5,2,'5000010000','superadmin',NULL,'2019-02-25 15:52:18','2019-02-25 15:52:18'),
(97,'5000.01.01','Pendapatan Bunga Bank','96',5,3,'5000010100','superadmin',NULL,'2019-02-25 15:52:28','2019-02-25 15:52:28'),
(98,'5000.01.02','Pendapatan Lain-Lain','96',5,3,'5000010200','superadmin',NULL,'2019-02-25 15:52:44','2019-02-25 15:52:44'),
(99,'6000','Biaya Non Operasional',NULL,6,1,'6000000000','superadmin',NULL,'2019-02-25 15:52:54','2019-02-25 15:52:54'),
(100,'6000.01','Biaya Non Operasional','99',6,2,'6000010000','superadmin',NULL,'2019-02-25 15:53:03','2019-02-25 15:53:03'),
(101,'6000.01.01','Biaya Administrasi Bank','100',6,3,'6000010100','superadmin',NULL,'2019-02-25 15:53:12','2019-02-25 15:53:12'),
(102,'6000.01.02','Biaya Pajak Bank','100',6,3,'6000010200','superadmin',NULL,'2019-02-25 15:53:21','2019-02-25 15:53:21'),
(103,'6000.01.03','Biaya Lain-Lain','100',6,3,'6000010300','superadmin',NULL,'2019-02-25 15:53:30','2019-02-25 15:53:30');

/*Table structure for table `m_companies` */

DROP TABLE IF EXISTS `m_companies`;

CREATE TABLE `m_companies` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `CompanyName` varchar(50) NOT NULL,
  `Address` varchar(300) NOT NULL,
  `PostCode` varchar(10) NOT NULL,
  `Email` varchar(300) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `Fax` varchar(50) DEFAULT NULL,
  `M_Chartofaccount_Id` int(11) DEFAULT NULL,
  `Period` int(11) DEFAULT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `m_companies` */

insert  into `m_companies`(`Id`,`CompanyName`,`Address`,`PostCode`,`Email`,`Phone`,`Fax`,`M_Chartofaccount_Id`,`Period`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,'PT UMKM','asdasdasd','567788','ainayaeirnayo@gmail.com','0274432234','0271432234',44,2019,'superadmin',NULL,'2019-02-25 16:36:53','2019-02-25 16:36:53');

/*Table structure for table `m_enumdetails` */

DROP TABLE IF EXISTS `m_enumdetails`;

CREATE TABLE `m_enumdetails` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `M_Enum_Id` int(11) NOT NULL,
  `Value` int(11) NOT NULL,
  `EnumName` varchar(50) NOT NULL,
  `Ordering` tinyint(11) NOT NULL,
  `Resource` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `m_enumdetails_M_Enum_Id_fk` (`M_Enum_Id`),
  CONSTRAINT `m_enumdetails_M_Enum_Id_fk` FOREIGN KEY (`M_Enum_Id`) REFERENCES `m_enums` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

/*Data for the table `m_enumdetails` */

insert  into `m_enumdetails`(`Id`,`M_Enum_Id`,`Value`,`EnumName`,`Ordering`,`Resource`) values 
(1,1,1,'January',1,'ui_january'),
(2,1,2,'February',2,'ui_february'),
(3,1,3,'March',3,'ui_march'),
(4,1,4,'April',4,'ui_april'),
(5,1,5,'May',5,'ui_may'),
(6,1,6,'June',6,'ui_june'),
(7,1,7,'July',7,'ui_july'),
(8,1,8,'August',8,'ui_august'),
(9,1,9,'September',9,'ui_september'),
(10,1,10,'October',10,'ui_october'),
(11,1,11,'November',11,'ui_november'),
(12,1,12,'December',12,'ui_december'),
(15,3,1,'Income',1,'ui_income'),
(16,3,2,'Expense',2,'ui_expense'),
(17,3,3,'Debt',3,'ui_debt'),
(18,3,4,'Pay Debt',4,'ui_paydebt'),
(19,3,5,'Receivable',5,'ui_receivable'),
(20,3,6,'Paid Receivable',6,'ui_paidreceivable'),
(21,3,7,'Capital Increase',7,'ui_capitalincrease'),
(22,3,8,'Capital Withdrawal',8,'ui_capitalwithdrawal'),
(23,3,9,'Asset Sale',9,'ui_assetsale'),
(24,3,10,'Asset Purchase',10,'ui_assetpurchase'),
(25,3,11,'Asset Adjustment',11,'ui_adjustment'),
(26,4,1,'Daily',1,'ui_daily'),
(27,4,2,'Monthly',2,'ui_monthly'),
(28,4,3,'Quarterly',3,'ui_quarterly'),
(29,4,4,'Semester',4,'ui_semester'),
(30,4,5,'Yearly',5,'ui_yearly'),
(31,5,1,'Quarter 1',1,'ui_quarter1'),
(32,5,2,'Quarter 2',2,'ui_quarter2'),
(33,5,3,'Quarter 3',3,'ui_quarter3'),
(34,5,4,'Quarter 4',4,'ui_quarter4'),
(35,6,1,'Semester 1',1,'ui_semester1'),
(36,6,2,'Semester 2',2,'ui_semester2');

/*Table structure for table `m_enums` */

DROP TABLE IF EXISTS `m_enums`;

CREATE TABLE `m_enums` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `m_enums` */

insert  into `m_enums`(`Id`,`Name`) values 
(1,'Months'),
(2,'ReportType'),
(3,'JournalType'),
(4,'ReportRangeType'),
(5,'Quarter'),
(6,'Semester');

/*Table structure for table `m_forms` */

DROP TABLE IF EXISTS `m_forms`;

CREATE TABLE `m_forms` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FormName` varchar(100) NOT NULL,
  `AliasName` varchar(100) NOT NULL,
  `LocalName` varchar(100) NOT NULL,
  `ClassName` varchar(100) NOT NULL,
  `Resource` varchar(50) DEFAULT NULL,
  `IndexRoute` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `m_forms` */

insert  into `m_forms`(`Id`,`FormName`,`AliasName`,`LocalName`,`ClassName`,`Resource`,`IndexRoute`) values 
(1,'m_groupusers','master group user','master grup pengguna','Master','ui_groupuser','mgroupuser'),
(2,'m_users','master user','master pengguna','Master','ui_user','muser'),
(3,'m_chartofaccounts','chart of account','kode akun','General','ui_chartofaccount','mchartofaccount'),
(4,'m_companies','Perusahaan','Company','Setup','ui_company','mcompany'),
(5,'m_forms','Setup','Pengaturan','Setup','ui_mainsetup','mainsetup'),
(6,'r_reports','Report','Laporan','Report','ui_report','report'),
(7,'t_journals','Journal','Jurnal','Transaction','ui_journal','tjournal'),
(8,'m_beginningbalances','Beginning Balance','Saldo Awal','Master','ui_beginningbalance','mbeginningbalance');

/*Table structure for table `m_formsettings` */

DROP TABLE IF EXISTS `m_formsettings`;

CREATE TABLE `m_formsettings` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `M_Form_Id` int(11) NOT NULL,
  `TypeTrans` int(11) DEFAULT NULL,
  `Value` int(11) NOT NULL,
  `Name` varchar(1000) NOT NULL,
  `IntValue` int(11) DEFAULT NULL,
  `StringValue` varchar(100) DEFAULT NULL,
  `DecimalValue` decimal(18,2) DEFAULT NULL,
  `DateTimeValue` datetime DEFAULT NULL,
  `BooleanValue` smallint(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `m_formsettings_M_Form_Id_fk` (`M_Form_Id`),
  CONSTRAINT `m_formsettings_M_Form_Id_fk` FOREIGN KEY (`M_Form_Id`) REFERENCES `m_forms` (`Id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*Data for the table `m_formsettings` */

insert  into `m_formsettings`(`Id`,`M_Form_Id`,`TypeTrans`,`Value`,`Name`,`IntValue`,`StringValue`,`DecimalValue`,`DateTimeValue`,`BooleanValue`) values 
(1,7,NULL,1,'NUMBERING_FORMAT',NULL,NULL,NULL,NULL,NULL),
(2,7,NULL,2,'INCOME_DEBET_ACCOUNT',77,'3000.01.01.01~Pendapatan Usaha/Penjualan Barang',NULL,NULL,NULL),
(3,7,NULL,3,'INCOME_CREDIT_ACCOUNT',12,'1000.01.01.02~Bank',NULL,NULL,NULL),
(4,7,NULL,4,'EXPENSE_DEBET_ACCOUNT',11,'1000.01.01.01~Kas',NULL,NULL,NULL),
(5,7,NULL,5,'EXPENSE_CREDIT_ACCOUNT',89,'4000.01.01~Biaya XXXX',NULL,NULL,NULL),
(6,7,NULL,6,'DEBT_DEBET_ACCOUNT',40,'2000.01.02.01~Hutang Bank',NULL,NULL,NULL),
(7,7,NULL,7,'DEBT_CREDIT_ACCOUNT',12,'1000.01.01.02~Bank',NULL,NULL,NULL),
(8,7,NULL,8,'PAY_DEBT_DEBET_ACCOUNT',12,'1000.01.01.02~Bank',NULL,NULL,NULL),
(9,7,NULL,9,'PAY_DEBT_CREDIT_ACCOUNT',40,'2000.01.02.01~Hutang Bank',NULL,NULL,NULL),
(10,7,NULL,10,'RECEIVABLE_DEBET_ACCOUNT',78,'3000.01.01.02~Potongan Penjualan',NULL,NULL,NULL),
(11,7,NULL,11,'RECEIVABLE_CREDIT_ACCOUNT',14,'1000.01.02.01~Piutang',NULL,NULL,NULL),
(12,7,NULL,12,'PAID_RECEIVABLE_DEBET_ACCOUNT',14,'1000.01.02.01~Piutang',NULL,NULL,NULL),
(13,7,NULL,13,'PAID_RECEIVABLE_CREDIT_ACCOUNT',12,'1000.01.01.02~Bank',NULL,NULL,NULL),
(14,7,NULL,14,'CAPITAL_INCREASE_DEBET_ACCOUNT',43,'2000.02.01.01~Modal Usaha',NULL,NULL,NULL),
(15,7,NULL,15,'CAPITAL_INCREASE_CREDIT_ACCOUNT',12,'1000.01.01.02~Bank',NULL,NULL,NULL),
(16,7,NULL,16,'CAPITAL_WITHDRAWAL_DEBET_ACCOUNT',12,'1000.01.01.02~Bank',NULL,NULL,NULL),
(17,7,NULL,17,'CAPITAL_WITHDRAWAL_CREDIT_ACCOUNT',43,'2000.02.01.01~Modal Usaha',NULL,NULL,NULL),
(18,7,NULL,18,'ASSET_SALE_DEBET_ACCOUNT',21,'1000.02.01.01~Tanah',NULL,NULL,NULL),
(19,7,NULL,19,'ASSET_SALE_CREDIT_ACCOUNT',12,'1000.01.01.02~Bank',NULL,NULL,NULL),
(20,7,NULL,20,'ASSET_PURCHASE_DEBET_ACCOUNT',12,'1000.01.01.02~Bank',NULL,NULL,NULL),
(21,7,NULL,21,'ASSET_PURCHASE_CREDIT_ACCOUNT',23,'1000.02.01.03~Kendaraan',NULL,NULL,NULL),
(22,7,NULL,22,'ASSET_ADJUSTMENT_DEBET_ACCOUNT',12,'1000.01.01.02~Bank',NULL,NULL,NULL),
(23,7,NULL,23,'ASSET_ADJUSTMENT_CREDIT_ACCOUNT',14,'1000.01.02.01~Piutang',NULL,NULL,NULL),
(24,7,1,24,'NUMBERING_FORMAT',NULL,'BKM/{YYYY}{MM}/7',NULL,NULL,NULL),
(25,7,2,25,'NUMBERING_FORMAT',NULL,'BKK/{YYYY}{MM}/7',NULL,NULL,NULL),
(26,7,3,26,'NUMBERING_FORMAT',NULL,'JUR/{YYYY}{MM}/7',NULL,NULL,NULL);

/*Table structure for table `m_groupusers` */

DROP TABLE IF EXISTS `m_groupusers`;

CREATE TABLE `m_groupusers` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(100) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `m_groupusers` */

/*Table structure for table `m_userprofiles` */

DROP TABLE IF EXISTS `m_userprofiles`;

CREATE TABLE `m_userprofiles` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `M_User_Id` int(11) NOT NULL,
  `CompleteName` varchar(300) DEFAULT NULL,
  `Address` varchar(300) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Email` varchar(20) DEFAULT NULL,
  `PhotoPath` varchar(300) DEFAULT NULL,
  `PhotoName` varchar(300) DEFAULT NULL,
  `AboutMe` varchar(1000) DEFAULT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `m_userprofiles_M_User_Id_fk` (`M_User_Id`),
  CONSTRAINT `m_userprofiles_M_User_Id_fk` FOREIGN KEY (`M_User_Id`) REFERENCES `m_users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `m_userprofiles` */

insert  into `m_userprofiles`(`Id`,`M_User_Id`,`CompleteName`,`Address`,`Phone`,`Email`,`PhotoPath`,`PhotoName`,`AboutMe`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,1,NULL,NULL,NULL,NULL,'./assets/user_profile/','user_default.png',NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `m_users` */

DROP TABLE IF EXISTS `m_users`;

CREATE TABLE `m_users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `M_Groupuser_Id` int(11) DEFAULT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `IsLoggedIn` smallint(11) NOT NULL DEFAULT '0',
  `IsActive` smallint(11) NOT NULL DEFAULT '1',
  `Language` varchar(50) NOT NULL DEFAULT 'indonesia',
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `m_users_M_Groupuser_Id_fk` (`M_Groupuser_Id`),
  CONSTRAINT `m_users_M_Groupuser_Id_fk` FOREIGN KEY (`M_Groupuser_Id`) REFERENCES `m_groupusers` (`Id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `m_users` */

insert  into `m_users`(`Id`,`M_Groupuser_Id`,`Username`,`Password`,`IsLoggedIn`,`IsActive`,`Language`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,NULL,'superadmin','18e31bae1483a116b33cc49e32591064',0,1,'indonesia',NULL,NULL,NULL,NULL);

/*Table structure for table `m_usersettings` */

DROP TABLE IF EXISTS `m_usersettings`;

CREATE TABLE `m_usersettings` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `M_User_Id` int(11) NOT NULL,
  `G_Language_Id` int(11) NOT NULL DEFAULT '1',
  `G_Color_Id` int(11) NOT NULL DEFAULT '1',
  `RowPerpage` int(11) NOT NULL DEFAULT '5',
  PRIMARY KEY (`Id`),
  KEY `m_usersettings_M_User_Id_fk` (`M_User_Id`),
  CONSTRAINT `m_usersettings_M_User_Id_fk` FOREIGN KEY (`M_User_Id`) REFERENCES `m_users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `m_usersettings` */

insert  into `m_usersettings`(`Id`,`M_User_Id`,`G_Language_Id`,`G_Color_Id`,`RowPerpage`) values 
(1,1,1,1,5);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `migrations` */

insert  into `migrations`(`version`) values 
(20190225084046);

/*Table structure for table `r_reportaccessroles` */

DROP TABLE IF EXISTS `r_reportaccessroles`;

CREATE TABLE `r_reportaccessroles` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `R_Report_Id` int(11) NOT NULL,
  `M_Groupuser_Id` int(11) NOT NULL,
  `Read` tinyint(1) NOT NULL,
  `Write` tinyint(1) NOT NULL,
  `Delete` tinyint(1) NOT NULL,
  `Print` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `r_reportaccessroles_M_Groupuser_Id_fk` (`M_Groupuser_Id`),
  KEY `r_reportaccessroles_R_Report_Id_fk` (`R_Report_Id`),
  CONSTRAINT `r_reportaccessroles_M_Groupuser_Id_fk` FOREIGN KEY (`M_Groupuser_Id`) REFERENCES `m_groupusers` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `r_reportaccessroles_R_Report_Id_fk` FOREIGN KEY (`R_Report_Id`) REFERENCES `r_reports` (`Id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `r_reportaccessroles` */

/*Table structure for table `r_reports` */

DROP TABLE IF EXISTS `r_reports`;

CREATE TABLE `r_reports` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(300) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Url` varchar(1000) NOT NULL,
  `Resource` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `r_reports` */

insert  into `r_reports`(`Id`,`Name`,`Description`,`Url`,`Resource`) values 
(1,'Journal','Journal','reports/journal_view','report_journal');

/*Table structure for table `t_journaldetails` */

DROP TABLE IF EXISTS `t_journaldetails`;

CREATE TABLE `t_journaldetails` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `T_Journal_Id` int(11) NOT NULL,
  `M_Chartofaccount_Id` int(11) NOT NULL,
  `Type` varchar(5) NOT NULL,
  `Debet` decimal(20,2) NOT NULL,
  `Credit` decimal(20,2) NOT NULL,
  `Order` int(11) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `t_journaldetails_T_Journal_Id_fk` (`T_Journal_Id`),
  KEY `t_journaldetails_M_Chartofaccount_Id_fk` (`M_Chartofaccount_Id`),
  CONSTRAINT `t_journaldetails_M_Chartofaccount_Id_fk` FOREIGN KEY (`M_Chartofaccount_Id`) REFERENCES `m_chartofaccounts` (`Id`) ON UPDATE CASCADE,
  CONSTRAINT `t_journaldetails_T_Journal_Id_fk` FOREIGN KEY (`T_Journal_Id`) REFERENCES `t_journals` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `t_journaldetails` */

insert  into `t_journaldetails`(`Id`,`T_Journal_Id`,`M_Chartofaccount_Id`,`Type`,`Debet`,`Credit`,`Order`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,1,43,'D',100000000000.00,0.00,1,NULL,NULL,'2019-02-25 16:22:02','2019-02-25 16:22:02'),
(2,1,12,'C',0.00,100000000000.00,2,NULL,NULL,'2019-02-25 16:22:02','2019-02-25 16:22:02'),
(3,2,77,'D',50000000000.00,0.00,1,NULL,NULL,'2019-02-25 16:22:30','2019-02-25 16:22:30'),
(4,2,12,'C',0.00,50000000000.00,2,NULL,NULL,'2019-02-25 16:22:30','2019-02-25 16:22:30'),
(5,3,40,'D',5000000000.00,0.00,1,NULL,NULL,'2019-02-25 16:22:41','2019-02-25 16:22:41'),
(6,3,12,'C',0.00,5000000000.00,2,NULL,NULL,'2019-02-25 16:22:41','2019-02-25 16:22:41'),
(9,5,12,'D',1000000000.00,0.00,1,NULL,NULL,'2019-02-25 16:28:36','2019-02-25 16:28:36'),
(10,5,40,'C',0.00,1000000000.00,2,NULL,NULL,'2019-02-25 16:28:36','2019-02-25 16:28:36'),
(11,6,11,'D',50000000.00,0.00,1,NULL,NULL,'2019-02-25 16:36:01','2019-02-25 16:36:01'),
(12,6,89,'C',0.00,50000000.00,2,NULL,NULL,'2019-02-25 16:36:01','2019-02-25 16:36:01');

/*Table structure for table `t_journals` */

DROP TABLE IF EXISTS `t_journals`;

CREATE TABLE `t_journals` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `JournalNo` varchar(50) NOT NULL,
  `TranDate` datetime NOT NULL,
  `CoaDebet_Id` int(11) NOT NULL,
  `CoaCredit_Id` int(11) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Refno` varchar(50) DEFAULT NULL,
  `Type` int(11) DEFAULT NULL,
  `Amount` decimal(20,2) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `t_journals_CoaDebet_Id_fk` (`CoaDebet_Id`),
  KEY `t_journals_CoaCredit_Id_fk` (`CoaCredit_Id`),
  CONSTRAINT `t_journals_CoaCredit_Id_fk` FOREIGN KEY (`CoaCredit_Id`) REFERENCES `m_chartofaccounts` (`Id`) ON UPDATE CASCADE,
  CONSTRAINT `t_journals_CoaDebet_Id_fk` FOREIGN KEY (`CoaDebet_Id`) REFERENCES `m_chartofaccounts` (`Id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `t_journals` */

insert  into `t_journals`(`Id`,`JournalNo`,`TranDate`,`CoaDebet_Id`,`CoaCredit_Id`,`Description`,`Refno`,`Type`,`Amount`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,'JUR/201902/0000001','2019-02-25 06:00:00',43,12,'tambah modal','',7,1000000000.00,'superadmin',NULL,'2019-02-25 16:22:02','2019-02-25 16:22:02'),
(2,'BKM/201902/0000001','2019-02-25 06:00:00',77,12,'pemasukan','',1,500000000.00,'superadmin',NULL,'2019-02-25 16:22:30','2019-02-25 16:22:30'),
(3,'JUR/201902/0000002','2019-02-25 06:00:00',40,12,'Hutang','',3,50000000.00,'superadmin',NULL,'2019-02-25 16:22:41','2019-02-25 16:22:41'),
(5,'JUR/201902/0000004','2019-02-25 06:00:00',12,40,'Bayar ya','JUR/201902/0000002',4,10000000.00,'superadmin',NULL,'2019-02-25 16:28:35','2019-02-25 16:28:35'),
(6,'BKK/201902/0000001','2019-02-25 06:00:00',11,89,'Test Pengeluaran','',2,500000.00,'superadmin',NULL,'2019-02-25 16:36:01','2019-02-25 16:36:01');

/*Table structure for table `view_m_accessroles` */

DROP TABLE IF EXISTS `view_m_accessroles`;

/*!50001 DROP VIEW IF EXISTS `view_m_accessroles` */;
/*!50001 DROP TABLE IF EXISTS `view_m_accessroles` */;

/*!50001 CREATE TABLE  `view_m_accessroles`(
 `GroupId` int(11) ,
 `FormId` int(11) ,
 `FormName` varchar(100) ,
 `AliasName` varchar(100) ,
 `LocalName` varchar(100) ,
 `Readd` bigint(4) ,
 `Writee` bigint(4) ,
 `Deletee` bigint(4) ,
 `Printt` bigint(4) ,
 `ClassName` varchar(100) ,
 `Header` bigint(20) 
)*/;

/*Table structure for table `view_r_reportaccessroles` */

DROP TABLE IF EXISTS `view_r_reportaccessroles`;

/*!50001 DROP VIEW IF EXISTS `view_r_reportaccessroles` */;
/*!50001 DROP TABLE IF EXISTS `view_r_reportaccessroles` */;

/*!50001 CREATE TABLE  `view_r_reportaccessroles`(
 `GroupId` int(11) ,
 `ReportId` int(11) ,
 `ReportName` varchar(300) ,
 `Resource` varchar(1000) ,
 `Readd` int(4) ,
 `Writee` int(4) ,
 `Deletee` int(4) ,
 `Printt` int(4) 
)*/;

/*View structure for view view_m_accessroles */

/*!50001 DROP TABLE IF EXISTS `view_m_accessroles` */;
/*!50001 DROP VIEW IF EXISTS `view_m_accessroles` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_m_accessroles` AS select `a`.`Id` AS `GroupId`,`b`.`Id` AS `FormId`,`b`.`FormName` AS `FormName`,`b`.`AliasName` AS `AliasName`,`b`.`LocalName` AS `LocalName`,ifnull(`c`.`Read`,0) AS `Readd`,ifnull(`c`.`Write`,0) AS `Writee`,ifnull(`c`.`Delete`,0) AS `Deletee`,ifnull(`c`.`Print`,0) AS `Printt`,`b`.`ClassName` AS `ClassName`,0 AS `Header` from ((`m_groupusers` `a` join `m_forms` `b`) left join `m_accessroles` `c` on(((`c`.`M_Form_Id` = `b`.`Id`) and (`c`.`M_Groupuser_Id` = `a`.`Id`)))) union all select distinct NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,`m_forms`.`ClassName` AS `ClassName`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,`m_forms`.`ClassName` AS `ClassName`,1 AS `Header` from `m_forms` order by 10,11 */;

/*View structure for view view_r_reportaccessroles */

/*!50001 DROP TABLE IF EXISTS `view_r_reportaccessroles` */;
/*!50001 DROP VIEW IF EXISTS `view_r_reportaccessroles` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_r_reportaccessroles` AS select `a`.`Id` AS `GroupId`,`b`.`Id` AS `ReportId`,`b`.`Name` AS `ReportName`,`b`.`Resource` AS `Resource`,ifnull(`c`.`Read`,0) AS `Readd`,ifnull(`c`.`Write`,0) AS `Writee`,ifnull(`c`.`Delete`,0) AS `Deletee`,ifnull(`c`.`Print`,0) AS `Printt` from ((`m_groupusers` `a` join `r_reports` `b`) left join `r_reportaccessroles` `c` on(((`c`.`R_Report_Id` = `b`.`Id`) and (`c`.`M_Groupuser_Id` = `a`.`Id`)))) order by `b`.`Name` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
