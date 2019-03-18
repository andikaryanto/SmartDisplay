/*
SQLyog Professional v12.4.3 (64 bit)
MySQL - 10.1.33-MariaDB : Database - kospin
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
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `g_transactionnumbers` */

insert  into `g_transactionnumbers`(`Id`,`Format`,`Year`,`Month`,`LastNumber`,`M_Form_Id`) values 
(22,'MEM/{YYYY}{MM}/#####',2019,1,3,9),
(23,'SUB/{YYYY}{MM}/#####',2019,1,2,11),
(24,'SPA/{YYYY}{MM}/#####',2019,1,4,14);

/*Table structure for table `g_versionhistory` */

DROP TABLE IF EXISTS `g_versionhistory`;

CREATE TABLE `g_versionhistory` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Version` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

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
(11,'20181223055507'),
(12,'20181223061200'),
(13,'20181224081245'),
(14,'20181230083750'),
(15,'20181231042405'),
(16,'20181231114947'),
(17,'20190103101043'),
(18,'20190103104758'),
(19,'20190103104855'),
(20,'20190103114002'),
(21,'20190104090749'),
(22,'20190104101212'),
(23,'20190104101930'),
(24,'20190104103204'),
(25,'20190104131417'),
(26,'20190105094948'),
(27,'20190105120512'),
(28,'20190105123652'),
(29,'20190105224352'),
(30,'20190106115107'),
(31,'20190106120851'),
(32,'20190106213408'),
(33,'20190106214758'),
(34,'20190107094822'),
(35,'20190108092135'),
(36,'20190108130118'),
(37,'20190108131152'),
(38,'20190108160012'),
(39,'20190108162815'),
(40,'20190109114436'),
(41,'20190110093633'),
(42,'20190110110340'),
(43,'20190110112727'),
(44,'20190110113848'),
(45,'20190110215426'),
(46,'20190110225030'),
(47,'20190110231709'),
(48,'20190113222739'),
(49,'20190114143739'),
(50,'20190114144119'),
(51,'20190114145930'),
(52,'20190114161023'),
(53,'20190115125719'),
(54,'20190116095052'),
(55,'20190116143925'),
(56,'20190116145834'),
(57,'20190129133102'),
(58,'20190129133334');

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `m_accessroles` */

insert  into `m_accessroles`(`Id`,`M_Form_Id`,`M_Groupuser_Id`,`Read`,`Write`,`Delete`,`Print`) values 
(1,11,1,1,1,1,1),
(2,14,1,1,1,1,1),
(3,16,1,1,1,1,1),
(4,15,1,1,1,1,1),
(5,2,1,0,0,0,0),
(6,7,1,1,1,1,1),
(7,9,1,1,1,1,1),
(8,10,1,1,1,1,1),
(9,12,1,1,1,1,1),
(10,13,1,1,1,1,1),
(11,17,1,1,1,1,1),
(12,13,3,1,0,0,0),
(13,12,3,1,0,0,0),
(14,1,3,0,0,0,0),
(15,10,3,1,0,0,0),
(16,9,3,1,0,0,0),
(17,7,3,1,0,0,0),
(18,17,3,1,0,0,0),
(19,15,3,1,0,0,0),
(20,16,3,1,0,0,0),
(21,14,3,1,0,0,0),
(22,11,3,1,0,0,0);

/*Table structure for table `m_chartofaccounts` */

DROP TABLE IF EXISTS `m_chartofaccounts`;

CREATE TABLE `m_chartofaccounts` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Code` varchar(50) NOT NULL,
  `Name` varchar(300) NOT NULL,
  `Parent` varchar(50) DEFAULT NULL,
  `Level` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `m_chartofaccounts` */

insert  into `m_chartofaccounts`(`Id`,`Code`,`Name`,`Parent`,`Level`,`Type`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,'1000','Aktiva',NULL,1,1,NULL,NULL,NULL,NULL),
(2,'2000','Pasiva',NULL,1,2,NULL,NULL,NULL,NULL),
(3,'1010','Kas','1',2,1,'superadmin',NULL,'2019-01-10 16:48:30','2019-01-10 16:48:30'),
(4,'1011','Kas','3',3,1,'superadmin',NULL,'2019-01-10 16:48:42','2019-01-10 16:48:42'),
(5,'1020','Bank','1',2,1,'superadmin',NULL,'2019-01-10 16:48:54','2019-01-10 16:48:54'),
(6,'1021','Bank BCA','5',3,1,'superadmin',NULL,'2019-01-10 16:49:08','2019-01-10 16:49:08'),
(7,'1022','Bank Mandiri','5',3,1,'superadmin',NULL,'2019-01-10 16:49:39','2019-01-10 16:49:39'),
(8,'1030','Piutang','1',2,1,'superadmin',NULL,'2019-01-10 16:49:57','2019-01-10 16:49:57'),
(9,'1031','Piutang Dagang','8',3,1,'superadmin',NULL,'2019-01-10 16:50:13','2019-01-10 16:50:13'),
(10,'2010','Utang','2',2,2,'superadmin',NULL,'2019-01-10 16:50:36','2019-01-10 16:50:36'),
(11,'2011','Utang Dagang','10',3,2,'superadmin',NULL,'2019-01-10 16:50:49','2019-01-10 16:50:49');

/*Table structure for table `m_cities` */

DROP TABLE IF EXISTS `m_cities`;

CREATE TABLE `m_cities` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `M_Province_Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(300) DEFAULT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `m_cities_M_Province_Id_fk` (`M_Province_Id`),
  CONSTRAINT `m_cities_M_Province_Id_fk` FOREIGN KEY (`M_Province_Id`) REFERENCES `m_provinces` (`Id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `m_cities` */

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
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `m_companies` */

insert  into `m_companies`(`Id`,`CompanyName`,`Address`,`PostCode`,`Email`,`Phone`,`Fax`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,'PT KOSPIN ABC','Jalan Bima 164B, Jl. Panggungsari, Wonorejo, Sariharjo, \r\nNgaglik, Kabupaten Sleman, Daerah Istimewa Yogyakarta',' 55581','kospinabc@gmail.com','0271432234','0271432234','superadmin',NULL,'2019-01-10 15:10:56','2019-01-11 13:35:13');

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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

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
(13,2,1,'Male',1,'ui_male'),
(14,2,2,'Female',2,'ui_female'),
(15,3,1,'Islam',1,NULL),
(16,3,2,'Kristen',2,NULL),
(17,3,2,'Katholik',3,NULL),
(18,3,4,'Hindu',4,NULL),
(19,3,5,'Budha',5,NULL),
(20,3,6,'None',6,NULL),
(21,4,1,'Chief',1,'ui_chief'),
(22,4,99,'Others',99,'ui_others'),
(23,5,1,'A',1,NULL),
(24,5,2,'B',2,NULL),
(25,5,3,'AB',3,NULL),
(26,5,4,'O',4,NULL),
(27,6,1,'Student',1,'ui_student'),
(28,6,2,'Enterpreneur',2,'ui_enterpreneur'),
(29,4,2,'Secretary',2,'ui_secretary'),
(30,4,3,'Treasurer',3,'ui_treasurer'),
(31,6,99,'Others',99,'ui_others'),
(32,7,1,'Individual',1,'ui_individual'),
(33,7,2,'Instance',2,'ui_instance'),
(34,7,99,'Others',9,'ui_others'),
(35,8,1,'Flat',1,'ui_flat'),
(36,8,2,'Sliding',2,'ui_sliding'),
(37,9,1,'New',1,'ui_new'),
(38,9,2,'Approved',2,'ui_approved'),
(39,9,3,'Rejected',3,'ui_rejected'),
(40,9,4,'Canceled',4,'ui_canceled'),
(41,10,1,'Summary',1,'ui_summary'),
(42,10,2,'Detail',2,'ui_detail');

/*Table structure for table `m_enums` */

DROP TABLE IF EXISTS `m_enums`;

CREATE TABLE `m_enums` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `m_enums` */

insert  into `m_enums`(`Id`,`Name`) values 
(1,'Months'),
(2,'Gender'),
(3,'Religion'),
(4,'Worker'),
(5,'BloodType'),
(6,'Job'),
(7,'MemberType'),
(8,'RateType'),
(9,'SubmissionStatus'),
(10,'ReportType');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `m_forms` */

insert  into `m_forms`(`Id`,`FormName`,`AliasName`,`LocalName`,`ClassName`,`Resource`,`IndexRoute`) values 
(1,'m_groupusers','master group user','master grup pengguna','Master','ui_groupuser','mgroupuser'),
(2,'m_users','master user','master pengguna','Master','ui_user','muser'),
(3,'m_provinces','master province','master provinsi','Master','ui_province','mprovince'),
(4,'m_cities','master city','master kota','Master','ui_city','mcity'),
(5,'m_subcities','master sub city','master kecamatan','Master','ui_subcity','msubcity'),
(6,'m_villages','master village','master kelurahan','Master','ui_village','mvillage'),
(7,'m_people','master people','master orang','Master','ui_people','mpeople'),
(8,'m_workers','master worker','master pekerja','Master','ui_worker','mworker'),
(9,'m_members','master member','master anggota','Master','ui_member','mmember'),
(10,'m_instances','master instance','master perusahaan','Master','ui_instance','minstance'),
(11,'t_submissions','submission','pengajuan','Transaction','ui_submission','tsubmission'),
(12,'m_loans','loan','pinjaman','General','ui_loan','mloan'),
(13,'m_chartofaccounts','chart of account','kode akun','General','ui_chartofaccount','mchartofaccount'),
(14,'t_submissionpayments','angsuran','submission payment','Transaction','ui_submissionpayment','tsubmissionpayment'),
(15,'m_companies','Perusahaan','Company','Setup','ui_company','mcompany'),
(16,'m_forms','Setup','Pengaturan','Setup','ui_mainsetup','mainsetup'),
(17,'r_reports','Report','Laporan','Report','ui_report','report');

/*Table structure for table `m_formsettings` */

DROP TABLE IF EXISTS `m_formsettings`;

CREATE TABLE `m_formsettings` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `M_Form_Id` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `m_formsettings` */

insert  into `m_formsettings`(`Id`,`M_Form_Id`,`Value`,`Name`,`IntValue`,`StringValue`,`DecimalValue`,`DateTimeValue`,`BooleanValue`) values 
(1,9,1,'NUMBERING_FORMAT',NULL,'MEM/{YYYY}{MM}/5',NULL,NULL,NULL),
(2,11,1,'NUMBERING_FORMAT',NULL,'SUB/{YYYY}{MM}/5',NULL,NULL,NULL),
(3,14,1,'NUMBERING_FORMAT',NULL,'SPA/{YYYY}{MM}/5',NULL,NULL,NULL),
(4,14,2,'SUBMISSION_PAYMENT_ACCOUNT_CODE',7,'1022 Bank Mandiri',NULL,NULL,NULL),
(5,14,3,'SUBMISSION_PAYMENT_ONE_MONTH_ONLY',NULL,NULL,NULL,NULL,1),
(6,14,4,'SUBMISSION_PAYMENT_STANDALONE_FINE_PAYMENT',NULL,NULL,NULL,NULL,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `m_groupusers` */

insert  into `m_groupusers`(`Id`,`GroupName`,`Description`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,'Admin','Admin','superadmin','superadmin','2019-01-11 09:04:36','2019-01-11 09:04:51'),
(2,'FO','FO','superadmin',NULL,'2019-01-17 14:37:37','2019-01-17 14:37:37'),
(3,'Guest','Guest','superadmin',NULL,'2019-01-29 14:07:22','2019-01-29 14:07:22');

/*Table structure for table `m_instances` */

DROP TABLE IF EXISTS `m_instances`;

CREATE TABLE `m_instances` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Owner` varchar(100) NOT NULL,
  `InstanceName` varchar(100) NOT NULL,
  `NoInstance` varchar(100) NOT NULL,
  `InstanceType` varchar(300) DEFAULT NULL,
  `M_Village_Id` int(11) DEFAULT NULL,
  `Address` varchar(300) DEFAULT NULL,
  `Rt` int(11) DEFAULT NULL,
  `Rw` int(11) DEFAULT NULL,
  `PostCode` varchar(10) DEFAULT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `m_instances` */

insert  into `m_instances`(`Id`,`Owner`,`InstanceName`,`NoInstance`,`InstanceType`,`M_Village_Id`,`Address`,`Rt`,`Rw`,`PostCode`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,'Andik Aryanto','PT AJANAND','23466356','Dagang',NULL,'sfasdfasdf',10,4,'57466','superadmin',NULL,'2019-01-15 12:26:46','2019-01-15 12:26:46');

/*Table structure for table `m_loans` */

DROP TABLE IF EXISTS `m_loans`;

CREATE TABLE `m_loans` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `m_loans` */

insert  into `m_loans`(`Id`,`Name`,`Description`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,'Modal usaha','formid','superadmin',NULL,'2019-01-10 16:41:37','2019-01-10 16:41:37');

/*Table structure for table `m_members` */

DROP TABLE IF EXISTS `m_members`;

CREATE TABLE `m_members` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `NoMember` varchar(50) DEFAULT NULL,
  `M_People_Id` int(11) DEFAULT NULL,
  `M_Instance_Id` int(11) DEFAULT NULL,
  `Phone` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `IsActive` int(11) NOT NULL,
  `MemberType` int(11) DEFAULT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `m_members_M_People_Id_fk` (`M_People_Id`),
  CONSTRAINT `m_members_M_People_Id_fk` FOREIGN KEY (`M_People_Id`) REFERENCES `m_peoples` (`Id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `m_members` */

insert  into `m_members`(`Id`,`NoMember`,`M_People_Id`,`M_Instance_Id`,`Phone`,`Email`,`IsActive`,`MemberType`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(3,'MEM/201901/00001',1,NULL,'2342423424','ainayaeirnayo@gmail.com',1,1,'superadmin',NULL,'2019-01-10 15:01:20','2019-01-10 15:01:20'),
(4,'MEM/201901/00002',NULL,1,'2342423424','inklolly6@gmail.com',1,2,'superadmin',NULL,'2019-01-15 12:26:59','2019-01-15 12:26:59'),
(5,'MEM/201901/00003',2,NULL,'2342423424','ainayaeirnayo@gmail.com',1,1,'superadmin',NULL,'2019-01-15 17:07:00','2019-01-15 17:07:00');

/*Table structure for table `m_peoples` */

DROP TABLE IF EXISTS `m_peoples`;

CREATE TABLE `m_peoples` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `CompleteName` varchar(100) NOT NULL,
  `Nik` varchar(100) NOT NULL,
  `PlaceOfBirth` varchar(10) NOT NULL,
  `DateOfBirth` datetime NOT NULL,
  `Gender` int(11) DEFAULT NULL,
  `M_Village_Id` int(11) DEFAULT NULL,
  `Address` varchar(300) DEFAULT NULL,
  `Rt` int(11) DEFAULT NULL,
  `Rw` int(11) DEFAULT NULL,
  `PostCode` varchar(10) DEFAULT NULL,
  `BloodType` int(11) DEFAULT NULL,
  `Religion` int(11) DEFAULT NULL,
  `MariageStatus` int(11) DEFAULT NULL,
  `Job` int(11) DEFAULT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `m_peoples_M_Village_Id_fk` (`M_Village_Id`),
  CONSTRAINT `m_peoples_M_Village_Id_fk` FOREIGN KEY (`M_Village_Id`) REFERENCES `m_villages` (`Id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `m_peoples` */

insert  into `m_peoples`(`Id`,`CompleteName`,`Nik`,`PlaceOfBirth`,`DateOfBirth`,`Gender`,`M_Village_Id`,`Address`,`Rt`,`Rw`,`PostCode`,`BloodType`,`Religion`,`MariageStatus`,`Job`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,'Ainaya Eir Nakeshia','23452345','Grobogan','2010-01-20 06:00:00',2,NULL,' Jl. Kaliurang No.1, Gondangan, Sardonoharjo, Ngaglik, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55581',10,4,'57466',NULL,1,NULL,1,'superadmin','superadmin','2019-01-10 14:58:03','2019-01-11 14:25:03'),
(2,'Michael Bubble','123123123123','yogyakartA','2019-01-15 06:00:00',1,NULL,'SDAFASDF',2,2,' 55581',NULL,2,NULL,2,'superadmin',NULL,'2019-01-15 17:06:47','2019-01-15 17:06:47');

/*Table structure for table `m_provinces` */

DROP TABLE IF EXISTS `m_provinces`;

CREATE TABLE `m_provinces` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(300) DEFAULT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `m_provinces` */

/*Table structure for table `m_subcities` */

DROP TABLE IF EXISTS `m_subcities`;

CREATE TABLE `m_subcities` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `M_City_Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(300) DEFAULT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `m_subcities_M_City_Id_fk` (`M_City_Id`),
  CONSTRAINT `m_subcities_M_City_Id_fk` FOREIGN KEY (`M_City_Id`) REFERENCES `m_cities` (`Id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `m_subcities` */

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `m_userprofiles` */

insert  into `m_userprofiles`(`Id`,`M_User_Id`,`CompleteName`,`Address`,`Phone`,`Email`,`PhotoPath`,`PhotoName`,`AboutMe`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,1,'I am Superadmin','Gatak Rt10/ Rw4, Gatak , Ngawen, Klaten','089674392721','andik.aryantoo@gmail','./assets/user_profile/','20190117024041_30127013_1840671715978321_7878438148059955200_o.jpg','Fuck You,, You Know What?? Fuck You anyway,, im getting sick of this shit out from your mouth.\r\nGo disappear from this world. Fuck your existence',NULL,NULL,NULL,'2019-01-17 08:40:41'),
(3,5,'Andik Aryanto','Gatak Rt10/ Rw4, Gatak , Ngawen, Klaten','089674392721','andik.aryantoo@gmail','./assets/user_profile/','20190116111607_30127013_1840671715978321_7878438148059955200_o.jpg','Fuck You,, You Know What?? Fuck You anyway,, im getting sick of this shit out from your mouth.\r\nGo disappear from this world. Fuck your existence',NULL,NULL,'2019-01-16 16:59:16','2019-01-16 17:16:07'),
(4,6,NULL,NULL,NULL,NULL,'./assets/user_profile/','user_default.png',NULL,NULL,NULL,'2019-01-29 14:19:49','2019-01-29 14:19:49');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `m_users` */

insert  into `m_users`(`Id`,`M_Groupuser_Id`,`Username`,`Password`,`IsLoggedIn`,`IsActive`,`Language`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,NULL,'superadmin','0d403ffb03c72dff96ee1d0de8c75ee8',0,1,'indonesia',NULL,NULL,NULL,NULL),
(5,3,'Andik','aec33a051cd33cc96badbead52553deb',0,1,'indonesia','superadmin','superadmin','2019-01-16 16:59:16','2019-01-29 14:16:16'),
(6,3,'Guest','4f3f99cd473c0a3721bc67c5afc4884e',0,1,'indonesia','superadmin',NULL,'2019-01-29 14:19:49','2019-01-29 14:19:49');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `m_usersettings` */

insert  into `m_usersettings`(`Id`,`M_User_Id`,`G_Language_Id`,`G_Color_Id`,`RowPerpage`) values 
(1,1,1,2,5),
(5,5,2,2,5),
(6,6,1,1,5);

/*Table structure for table `m_villages` */

DROP TABLE IF EXISTS `m_villages`;

CREATE TABLE `m_villages` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `M_Subcity_Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(300) DEFAULT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `m_villages_M_Subcity_Id_fk` (`M_Subcity_Id`),
  CONSTRAINT `m_villages_M_Subcity_Id_fk` FOREIGN KEY (`M_Subcity_Id`) REFERENCES `m_subcities` (`Id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `m_villages` */

/*Table structure for table `m_workers` */

DROP TABLE IF EXISTS `m_workers`;

CREATE TABLE `m_workers` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `NoWorker` varchar(50) DEFAULT NULL,
  `M_People_Id` int(11) NOT NULL,
  `Phone` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `IsActive` int(11) NOT NULL,
  `WorkerType` int(11) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `m_workers` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `migrations` */

insert  into `migrations`(`version`) values 
(20190129133334);

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
  KEY `m_reportaccessroles_M_Groupuser_Id_fk` (`M_Groupuser_Id`),
  KEY `m_reportaccessroles_R_Report_Id_fk` (`R_Report_Id`),
  CONSTRAINT `m_reportaccessroles_M_Groupuser_Id_fk` FOREIGN KEY (`M_Groupuser_Id`) REFERENCES `m_groupusers` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `m_reportaccessroles_R_Report_Id_fk` FOREIGN KEY (`R_Report_Id`) REFERENCES `r_reports` (`Id`) ON UPDATE CASCADE
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
(1,'Submission Payment','Submission Payment','reports/submission_payment_view','report_submission_payment');

/*Table structure for table `t_submissiondetails` */

DROP TABLE IF EXISTS `t_submissiondetails`;

CREATE TABLE `t_submissiondetails` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `T_Submission_Id` int(11) NOT NULL,
  `Month` int(11) DEFAULT NULL,
  `DueDate` datetime NOT NULL,
  `Installment` decimal(18,2) NOT NULL,
  `InstallmentPayment` decimal(18,2) NOT NULL,
  `RatePayment` decimal(18,2) NOT NULL,
  `AmountPayment` decimal(18,2) NOT NULL,
  `Balance` decimal(18,2) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `t_submissiondetails_T_Submission_Id_fk` (`T_Submission_Id`),
  CONSTRAINT `t_submissiondetails_T_Submission_Id_fk` FOREIGN KEY (`T_Submission_Id`) REFERENCES `t_submissions` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `t_submissiondetails` */

insert  into `t_submissiondetails`(`Id`,`T_Submission_Id`,`Month`,`DueDate`,`Installment`,`InstallmentPayment`,`RatePayment`,`AmountPayment`,`Balance`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,1,1,'2019-02-10 22:46:59',500000000.00,41666666.67,3333333.33,45000000.00,458333333.33,'superadmin',NULL,'2019-01-10 16:47:00','2019-01-10 16:47:00'),
(2,1,2,'2019-03-11 04:46:59',458333333.33,41666666.67,3333333.33,45000000.00,416666666.67,'superadmin',NULL,'2019-01-10 16:47:00','2019-01-10 16:47:00'),
(3,1,3,'2019-04-11 09:46:59',416666666.67,41666666.67,3333333.33,45000000.00,375000000.00,'superadmin',NULL,'2019-01-10 16:47:00','2019-01-10 16:47:00'),
(4,1,4,'2019-05-11 14:46:59',375000000.00,41666666.67,3333333.33,45000000.00,333333333.33,'superadmin',NULL,'2019-01-10 16:47:00','2019-01-10 16:47:00'),
(5,1,5,'2019-06-11 19:46:59',333333333.33,41666666.67,3333333.33,45000000.00,291666666.67,'superadmin',NULL,'2019-01-10 16:47:00','2019-01-10 16:47:00'),
(6,1,6,'2019-07-12 00:46:59',291666666.67,41666666.67,3333333.33,45000000.00,250000000.00,'superadmin',NULL,'2019-01-10 16:47:00','2019-01-10 16:47:00'),
(7,1,7,'2019-08-12 05:46:59',250000000.00,41666666.67,3333333.33,45000000.00,208333333.33,'superadmin',NULL,'2019-01-10 16:47:00','2019-01-10 16:47:00'),
(8,1,8,'2019-09-12 10:46:59',208333333.33,41666666.67,3333333.33,45000000.00,166666666.67,'superadmin',NULL,'2019-01-10 16:47:00','2019-01-10 16:47:00'),
(9,1,9,'2019-10-12 15:46:59',166666666.67,41666666.67,3333333.33,45000000.00,125000000.00,'superadmin',NULL,'2019-01-10 16:47:00','2019-01-10 16:47:00'),
(10,1,10,'2019-11-12 21:46:59',125000000.00,41666666.67,3333333.33,45000000.00,83333333.33,'superadmin',NULL,'2019-01-10 16:47:00','2019-01-10 16:47:00'),
(11,1,11,'2019-12-13 03:46:59',83333333.33,41666666.67,3333333.33,45000000.00,41666666.67,'superadmin',NULL,'2019-01-10 16:47:00','2019-01-10 16:47:00'),
(12,1,12,'2020-01-13 09:46:59',41666666.67,41666666.67,3333333.33,45000000.00,0.00,'superadmin',NULL,'2019-01-10 16:47:00','2019-01-10 16:47:00'),
(13,2,1,'2019-02-15 18:27:44',50000000.00,4166666.67,333333.33,4500000.00,45833333.33,'superadmin',NULL,'2019-01-15 12:27:44','2019-01-15 12:27:44'),
(14,2,2,'2019-03-16 00:27:44',45833333.33,4166666.67,305555.56,4472222.22,41666666.67,'superadmin',NULL,'2019-01-15 12:27:44','2019-01-15 12:27:44'),
(15,2,3,'2019-04-16 05:27:44',41666666.67,4166666.67,277777.78,4444444.44,37500000.00,'superadmin',NULL,'2019-01-15 12:27:44','2019-01-15 12:27:44'),
(16,2,4,'2019-05-16 10:27:44',37500000.00,4166666.67,250000.00,4416666.67,33333333.33,'superadmin',NULL,'2019-01-15 12:27:44','2019-01-15 12:27:44'),
(17,2,5,'2019-06-16 15:27:44',33333333.33,4166666.67,222222.22,4388888.89,29166666.67,'superadmin',NULL,'2019-01-15 12:27:45','2019-01-15 12:27:45'),
(18,2,6,'2019-07-16 20:27:44',29166666.67,4166666.67,194444.44,4361111.11,25000000.00,'superadmin',NULL,'2019-01-15 12:27:45','2019-01-15 12:27:45'),
(19,2,7,'2019-08-17 01:27:44',25000000.00,4166666.67,166666.67,4333333.33,20833333.33,'superadmin',NULL,'2019-01-15 12:27:45','2019-01-15 12:27:45'),
(20,2,8,'2019-09-17 06:27:44',20833333.33,4166666.67,138888.89,4305555.56,16666666.67,'superadmin',NULL,'2019-01-15 12:27:45','2019-01-15 12:27:45'),
(21,2,9,'2019-10-17 11:27:44',16666666.67,4166666.67,111111.11,4277777.78,12500000.00,'superadmin',NULL,'2019-01-15 12:27:45','2019-01-15 12:27:45'),
(22,2,10,'2019-11-17 17:27:44',12500000.00,4166666.67,83333.33,4250000.00,8333333.33,'superadmin',NULL,'2019-01-15 12:27:45','2019-01-15 12:27:45'),
(23,2,11,'2019-12-17 23:27:44',8333333.33,4166666.67,55555.56,4222222.22,4166666.67,'superadmin',NULL,'2019-01-15 12:27:45','2019-01-15 12:27:45'),
(24,2,12,'2020-01-18 05:27:44',4166666.67,4166666.67,27777.78,4194444.44,0.00,'superadmin',NULL,'2019-01-15 12:27:45','2019-01-15 12:27:45');

/*Table structure for table `t_submissionfiles` */

DROP TABLE IF EXISTS `t_submissionfiles`;

CREATE TABLE `t_submissionfiles` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `T_Submission_Id` int(11) NOT NULL,
  `FileName` varchar(100) NOT NULL,
  `FileType` varchar(100) NOT NULL,
  `Path` varchar(1000) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `t_submissionfiles_T_Submission_Id_fk` (`T_Submission_Id`),
  CONSTRAINT `t_submissionfiles_T_Submission_Id_fk` FOREIGN KEY (`T_Submission_Id`) REFERENCES `t_submissions` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `t_submissionfiles` */

insert  into `t_submissionfiles`(`Id`,`T_Submission_Id`,`FileName`,`FileType`,`Path`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(3,2,'20190117025936_Capture.PNG','image/png','./uploads/submission_files/','superadmin',NULL,'2019-01-17 08:59:36','2019-01-17 08:59:36'),
(4,2,'20190117025936_v-i-lenin-sosialisme-dan-kaum-tani.pdf','application/pdf','./uploads/submission_files/','superadmin',NULL,'2019-01-17 08:59:36','2019-01-17 08:59:36'),
(5,2,'20190117025936_14-01-2019-laporan-register-siswa-spp-xak1(genap).pdf','application/pdf','./uploads/submission_files/','superadmin',NULL,'2019-01-17 08:59:36','2019-01-17 08:59:36'),
(6,2,'20190117025936_nayo.png','image/png','./uploads/submission_files/','superadmin',NULL,'2019-01-17 08:59:36','2019-01-17 08:59:36'),
(7,1,'20190117030108_nayo2.png','image/png','./uploads/submission_files/','superadmin',NULL,'2019-01-17 09:01:08','2019-01-17 09:01:08'),
(8,1,'20190117030108_nayo.png','image/png','./uploads/submission_files/','superadmin',NULL,'2019-01-17 09:01:09','2019-01-17 09:01:08'),
(9,1,'20190117030108_Capture.PNG','image/png','./uploads/submission_files/','superadmin',NULL,'2019-01-17 09:01:09','2019-01-17 09:01:09'),
(10,1,'20190117030108_14-01-2019-laporan-register-siswa-spp-xak1(genap).pdf','application/pdf','./uploads/submission_files/','superadmin',NULL,'2019-01-17 09:01:09','2019-01-17 09:01:09');

/*Table structure for table `t_submissionpaymentdetails` */

DROP TABLE IF EXISTS `t_submissionpaymentdetails`;

CREATE TABLE `t_submissionpaymentdetails` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `T_Submissionpayment_Id` int(11) NOT NULL,
  `T_Submissiondetail_Id` int(11) NOT NULL,
  `Month` int(11) NOT NULL,
  `Payment` decimal(18,2) NOT NULL,
  `RatePayment` decimal(18,2) NOT NULL,
  `FinePayment` decimal(18,2) NOT NULL,
  `Amount` decimal(18,2) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `t_submissionpaymentdetails_T_Submissionpayment_Id_fk` (`T_Submissionpayment_Id`),
  KEY `t_submissionpaymentdetails_T_Submissiondetail_Id_fk` (`T_Submissiondetail_Id`),
  CONSTRAINT `t_submissionpaymentdetails_T_Submissiondetail_Id_fk` FOREIGN KEY (`T_Submissiondetail_Id`) REFERENCES `t_submissiondetails` (`Id`) ON UPDATE CASCADE,
  CONSTRAINT `t_submissionpaymentdetails_T_Submissionpayment_Id_fk` FOREIGN KEY (`T_Submissionpayment_Id`) REFERENCES `t_submissionpayments` (`Id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `t_submissionpaymentdetails` */

insert  into `t_submissionpaymentdetails`(`Id`,`T_Submissionpayment_Id`,`T_Submissiondetail_Id`,`Month`,`Payment`,`RatePayment`,`FinePayment`,`Amount`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,1,1,1,41666666.67,3333333.33,0.00,45000000.00,'superadmin',NULL,'2019-01-10 16:51:30','2019-01-10 16:51:30'),
(2,2,2,2,41666666.67,3333333.33,0.00,45000000.00,'superadmin',NULL,'2019-01-14 13:58:36','2019-01-14 13:58:36'),
(3,3,13,1,4166666.67,333333.33,0.00,4500000.00,NULL,NULL,'2019-01-15 12:28:17','2019-01-15 12:28:17'),
(4,4,3,3,41666666.67,3333333.33,2700000.00,47700000.00,NULL,NULL,'2019-01-16 09:14:08','2019-01-16 09:14:08');

/*Table structure for table `t_submissionpayments` */

DROP TABLE IF EXISTS `t_submissionpayments`;

CREATE TABLE `t_submissionpayments` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `NoPayment` varchar(50) NOT NULL,
  `T_Submission_Id` int(11) NOT NULL,
  `PaymentDate` datetime NOT NULL,
  `M_Chartofaccount_Id` int(11) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `t_submissionpayments_T_Submission_Id_fk` (`T_Submission_Id`),
  CONSTRAINT `t_submissionpayments_T_Submission_Id_fk` FOREIGN KEY (`T_Submission_Id`) REFERENCES `t_submissions` (`Id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `t_submissionpayments` */

insert  into `t_submissionpayments`(`Id`,`NoPayment`,`T_Submission_Id`,`PaymentDate`,`M_Chartofaccount_Id`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,'SPA/201901/00001',1,'2019-01-10 06:00:00',7,'superadmin',NULL,'2019-01-10 16:51:17','2019-01-10 16:51:17'),
(2,'SPA/201901/00002',1,'2019-01-14 06:00:00',7,'superadmin',NULL,'2019-01-14 13:50:46','2019-01-14 13:50:46'),
(3,'SPA/201901/00003',2,'2019-01-15 06:00:00',7,'superadmin',NULL,'2019-01-15 12:28:10','2019-01-15 12:28:10'),
(4,'SPA/201901/00004',1,'2019-04-16 05:00:00',7,'superadmin','superadmin','2019-01-16 08:35:59','2019-01-16 08:39:39');

/*Table structure for table `t_submissions` */

DROP TABLE IF EXISTS `t_submissions`;

CREATE TABLE `t_submissions` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `NoSubmission` varchar(20) NOT NULL,
  `M_Member_Id` int(11) NOT NULL,
  `M_Loan_Id` int(11) DEFAULT NULL,
  `ApplyDate` datetime NOT NULL,
  `VerifyDate` datetime DEFAULT NULL,
  `DeleteDate` datetime DEFAULT NULL,
  `Rate` decimal(18,2) NOT NULL DEFAULT '0.00',
  `RateType` int(11) NOT NULL,
  `Plafon` decimal(18,2) NOT NULL DEFAULT '0.00',
  `Span` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `t_submissions_M_Member_Id_fk` (`M_Member_Id`),
  KEY `t_submissions_M_Loan_Id_fk` (`M_Loan_Id`),
  CONSTRAINT `t_submissions_M_Loan_Id_fk` FOREIGN KEY (`M_Loan_Id`) REFERENCES `m_loans` (`Id`) ON UPDATE CASCADE,
  CONSTRAINT `t_submissions_M_Member_Id_fk` FOREIGN KEY (`M_Member_Id`) REFERENCES `m_members` (`Id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `t_submissions` */

insert  into `t_submissions`(`Id`,`NoSubmission`,`M_Member_Id`,`M_Loan_Id`,`ApplyDate`,`VerifyDate`,`DeleteDate`,`Rate`,`RateType`,`Plafon`,`Span`,`Status`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,'SUB/201901/00001',3,1,'2019-01-10 16:46:59','2019-01-10 16:46:59',NULL,8.00,1,500000000.00,12,2,'superadmin','superadmin','2019-01-10 16:41:59','2019-01-10 16:46:59'),
(2,'SUB/201901/00002',4,1,'2019-01-15 12:27:44','2019-01-15 12:27:44',NULL,8.00,2,50000000.00,12,2,'superadmin','superadmin','2019-01-15 12:27:26','2019-01-15 12:27:44');

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
