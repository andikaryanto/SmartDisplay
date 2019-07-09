/*
SQLyog Professional v12.4.3 (64 bit)
MySQL - 10.1.33-MariaDB : Database - smartdisplay
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Data for the table `g_colors` */

insert  into `g_colors`(`Id`,`Name`,`Value`,`CssClass`,`CssPath`,`CssCustomPath`) values 
(1,'primary','#9c27b0','text-primary','assets/material-dashboard/assets/css/material-dashboard.min.css','assets/material-dashboard/assets/css/custom.css'),
(2,'green','#4caf50','text-success','assets/material-dashboard/assets/css/material-dashboard.greeen.min.css','assets/material-dashboard/assets/css/custom.green.css'),
(3,'orange','#ff9800','text-warning','assets/material-dashboard/assets/css/material-dashboard.orange.min.css','assets/material-dashboard/assets/css/Custom.orange.css');

/*Data for the table `g_languages` */

insert  into `g_languages`(`Id`,`Name`) values 
(1,'indonesia'),
(2,'english');

/*Data for the table `g_transactionnumbers` */

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
(13,'20190108131152'),
(14,'20190110093633'),
(15,'20190110113848'),
(16,'20190110215426'),
(17,'20190114143739'),
(18,'20190114145930'),
(19,'20190116143925'),
(20,'20190116145834'),
(21,'20190129133102'),
(22,'20190129133334'),
(23,'20190222150138'),
(24,'20190318090044'),
(25,'20190318091354'),
(26,'20190318132623'),
(27,'20190318141019'),
(28,'20190319082048'),
(29,'20190319090609'),
(30,'20190319125307'),
(31,'20190319141434'),
(32,'20190320084920'),
(33,'20190320094400'),
(34,'20190322105500'),
(35,'20190322110851'),
(36,'20190322133934'),
(37,'20190324110233'),
(38,'20190324111317'),
(39,'20190325102622'),
(41,'20190325102843'),
(42,'20190325110212'),
(43,'20190328134255'),
(45,'20190329093713'),
(46,'20190414103734'),
(47,'20190414105825'),
(48,'20190424140813'),
(49,'20190523093650'),
(50,'20190523093818');

/*Data for the table `m_accessroles` */

/*Data for the table `m_companies` */

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
(13,2,1,'Image',1,'ui_image'),
(14,2,2,'Video',2,'ui_video'),
(15,3,1,'Many Players',1,'ui_manyplayers'),
(16,3,2,'Group Player',2,'ui_groupplayer');

/*Data for the table `m_enums` */

insert  into `m_enums`(`Id`,`Name`) values 
(1,'Months'),
(2,'MultimediaType'),
(3,'MultimediaAssignType');

/*Data for the table `m_events` */

insert  into `m_events`(`Id`,`Name`,`Description`,`ActiveDate`,`InactiveDate`,`TimeStart`,`TimeEnd`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,'Not Knowing','Not Knowing','2019-03-26 06:00:00','2019-07-31 05:00:00','00:00','22:00','superadmin','superadmin','2019-03-25 10:03:31','2019-07-09 14:01:10'),
(2,'TES','','2019-07-09 05:00:00','2019-07-31 05:00:00','10:00','17:00','superadmin',NULL,'2019-07-09 10:47:11','2019-07-09 10:47:11');

/*Data for the table `m_forms` */

insert  into `m_forms`(`Id`,`FormName`,`AliasName`,`LocalName`,`ClassName`,`Resource`,`IndexRoute`) values 
(1,'m_groupusers','master group user','master grup pengguna','Master','ui_groupuser','mgroupuser'),
(2,'m_users','master user','master pengguna','Master','ui_user','muser'),
(3,'m_companies','Perusahaan','Company','Setup','ui_company','mcompany'),
(4,'m_forms','Setup','Pengaturan','Setup','ui_mainsetup','mainsetup'),
(5,'r_reports','Report','Laporan','Report','ui_report','report'),
(6,'m_groupplayers','Group Player','Player Grup','Master','ui_groupplayer','mgroupplayer'),
(7,'m_players','Player','Player','Master','ui_player','mplayer'),
(8,'m_events','Even','Even','Master','ui_even','mevent'),
(9,'m_multimedias','Multimedia','Multimedia','Multimedia','ui_multimedia','mmultimedia'),
(10,'m_tickers','Master','Master','Master','ui_ticker','mticker'),
(12,'m_tickersettings','Ticker','Ticker','Setup','ui_ticker','mtickersetting');

/*Data for the table `m_formsettings` */

/*Data for the table `m_groupplayers` */

insert  into `m_groupplayers`(`Id`,`GroupName`,`Description`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,'Lantai 1','Lantai 1','superadmin',NULL,'2019-03-25 09:56:24','2019-03-25 09:56:24'),
(2,'Lantai 2','Lantai 2','superadmin',NULL,'2019-03-25 09:56:48','2019-03-25 09:56:48');

/*Data for the table `m_groupusers` */

insert  into `m_groupusers`(`Id`,`GroupName`,`Description`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,'Admin','Admin','superadmin',NULL,'2019-07-09 10:20:31','2019-07-09 10:20:31');

/*Data for the table `m_multimediadetails` */

insert  into `m_multimediadetails`(`Id`,`M_Multimedia_Id`,`M_Player_Id`,`M_Groupplayer_Id`,`IsDeleted`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,1,1,NULL,0,NULL,NULL,'2019-03-25 10:04:48','2019-03-26 11:54:51'),
(2,1,2,NULL,0,NULL,NULL,'2019-03-25 10:04:48','2019-03-25 10:04:48'),
(3,1,3,NULL,0,NULL,NULL,'2019-03-25 10:04:48','2019-03-25 10:04:48'),
(4,2,NULL,2,0,NULL,NULL,'2019-03-25 10:20:03','2019-03-25 10:20:03'),
(5,2,NULL,1,0,NULL,NULL,'2019-03-25 10:20:04','2019-03-25 10:20:04'),
(6,3,1,NULL,1,NULL,NULL,'2019-03-27 11:21:10','2019-03-27 11:22:55'),
(7,3,1,NULL,1,NULL,NULL,'2019-03-27 13:54:35','2019-03-27 13:54:59'),
(9,3,1,NULL,1,NULL,NULL,'2019-03-27 14:04:01','2019-03-27 14:10:46'),
(10,4,NULL,1,1,NULL,NULL,'2019-03-27 14:15:56','2019-03-27 14:20:35'),
(11,4,NULL,1,0,NULL,NULL,'2019-03-27 15:26:50','2019-03-27 15:26:50'),
(12,5,1,NULL,0,NULL,NULL,'2019-03-29 13:40:16','2019-03-29 13:40:16'),
(13,3,1,NULL,0,NULL,NULL,'2019-05-23 09:13:09','2019-05-23 09:13:09'),
(14,6,2,NULL,0,NULL,NULL,'2019-05-23 11:09:59','2019-05-23 11:09:59');

/*Data for the table `m_multimedias` */

insert  into `m_multimedias`(`Id`,`M_Event_Id`,`Name`,`Type`,`AssignType`,`Url`,`ShowTime`,`ActiveDate`,`InactiveDate`,`IsDeleted`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,1,'Pic 1',1,1,'/uploads/smartdisplay/images/20190709_130406_20190329_134010_02_01_slide_nature.jpg','00:00:10',NULL,NULL,0,'superadmin','superadmin','2019-03-25 10:04:26','2019-07-09 13:04:07'),
(2,1,'Pic 2',1,2,'/uploads/smartdisplay/images/20190709_130529_indomie-goreng-spesial-foto-resep-utama.jpg','00:00:05',NULL,NULL,0,'superadmin','superadmin','2019-03-25 10:19:46','2019-07-09 13:05:29'),
(3,1,'Pic 3',1,1,'/uploads/smartdisplay/images/20190709_130546_istock-602301816.jpg','00:00:15',NULL,NULL,0,'superadmin','superadmin','2019-03-27 11:14:04','2019-07-09 13:05:46'),
(4,1,'Pic 4',1,2,'/uploads/smartdisplay/images/20190709_130605_Ramen.jpg','00:00:05',NULL,NULL,0,'superadmin','superadmin','2019-03-27 14:15:15','2019-07-09 13:06:05'),
(5,1,'Pic 5',1,1,'/uploads/smartdisplay/images/20190709_130622_ega.jpeg','00:00:01',NULL,NULL,0,'superadmin','superadmin','2019-03-29 13:40:10','2019-07-09 13:06:22'),
(6,1,'Vid 1',2,1,'/uploads/smartdisplay/videos/20190709_131613_Slipknot - Unsainted [OFFICIAL VIDEO].mp4','',NULL,NULL,0,'superadmin','superadmin','2019-05-23 11:08:18','2019-07-09 13:32:13');

/*Data for the table `m_playermultimedias` */

insert  into `m_playermultimedias`(`Id`,`M_Multimediadetail_Id`,`M_Player_Id`,`IsUpdated`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,1,1,1,NULL,NULL,'2019-03-25 10:04:48','2019-07-09 14:01:11'),
(2,2,2,0,NULL,NULL,'2019-03-25 10:04:48','2019-07-09 14:01:41'),
(3,3,3,1,NULL,NULL,'2019-03-25 10:04:48','2019-07-09 14:01:11'),
(4,4,4,1,NULL,NULL,'2019-03-25 10:20:04','2019-07-09 14:01:11'),
(5,4,5,1,NULL,NULL,'2019-03-25 10:20:04','2019-07-09 14:01:11'),
(6,5,1,1,NULL,NULL,'2019-03-25 10:20:04','2019-07-09 14:01:11'),
(7,5,2,0,NULL,NULL,'2019-03-25 10:20:04','2019-07-09 14:01:46'),
(8,5,3,1,NULL,NULL,'2019-03-25 10:20:04','2019-07-09 14:01:11'),
(11,6,1,1,NULL,NULL,'2019-03-27 11:21:10','2019-07-09 14:01:11'),
(13,9,1,1,NULL,NULL,'2019-03-27 14:04:01','2019-07-09 14:01:11'),
(14,10,1,1,NULL,NULL,'2019-03-27 14:15:56','2019-07-09 14:01:11'),
(15,10,2,0,NULL,NULL,'2019-03-27 14:15:56','2019-07-09 14:01:52'),
(16,10,3,1,NULL,NULL,'2019-03-27 14:15:56','2019-07-09 14:01:11'),
(17,11,1,1,NULL,NULL,'2019-03-27 15:26:50','2019-07-09 14:01:11'),
(18,11,2,0,NULL,NULL,'2019-03-27 15:26:50','2019-07-09 14:01:56'),
(19,11,3,1,NULL,NULL,'2019-03-27 15:26:50','2019-07-09 14:01:12'),
(20,12,1,1,NULL,NULL,'2019-03-29 13:40:16','2019-07-09 14:01:12'),
(21,14,2,0,NULL,NULL,'2019-05-23 11:09:59','2019-07-09 14:02:27');

/*Data for the table `m_players` */

insert  into `m_players`(`Id`,`Name`,`M_Groupplayer_Id`,`IpAddress`,`IsActive`,`ExpirationDate`,`DeviceId`,`IsRegistered`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,'Player_001',1,'::1',1,NULL,'34234234234',1,'superadmin',NULL,'2019-03-25 09:59:12','2019-05-23 13:51:12'),
(2,'Player_002',1,'192.168.1.61',1,NULL,'ccc2f6bd6e567e70',1,'superadmin',NULL,'2019-03-25 09:59:19','2019-07-09 14:01:34'),
(3,'Player_003',1,NULL,1,NULL,NULL,0,'superadmin',NULL,'2019-03-25 09:59:26','2019-03-25 09:59:26'),
(4,'Player_004',2,NULL,1,NULL,NULL,0,'superadmin',NULL,'2019-03-25 09:59:32','2019-03-25 09:59:32'),
(5,'Player_005',2,NULL,1,NULL,NULL,0,'superadmin',NULL,'2019-03-25 09:59:41','2019-03-25 09:59:41');

/*Data for the table `m_playerslots` */

insert  into `m_playerslots`(`Id`,`Count`) values 
(1,5);

/*Data for the table `m_playertickers` */

insert  into `m_playertickers`(`Id`,`M_Tickerdetail_Id`,`M_Player_Id`,`IsUpdated`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,1,1,1,NULL,NULL,'2019-03-25 10:37:17','2019-07-09 14:01:12'),
(2,2,2,0,NULL,NULL,'2019-03-25 10:37:17','2019-07-09 14:01:41'),
(3,3,3,1,NULL,NULL,'2019-03-25 10:37:17','2019-07-09 14:01:12'),
(4,4,4,1,NULL,NULL,'2019-03-25 10:38:36','2019-07-09 14:01:12'),
(5,4,5,1,NULL,NULL,'2019-03-25 10:38:36','2019-07-09 14:01:12'),
(6,5,1,1,NULL,NULL,'2019-03-25 10:38:36','2019-07-09 14:01:12'),
(7,5,2,0,NULL,NULL,'2019-03-25 10:38:36','2019-07-09 14:01:46'),
(8,5,3,1,NULL,NULL,'2019-03-25 10:38:36','2019-07-09 14:01:12'),
(9,6,2,0,NULL,NULL,'2019-05-23 11:42:54','2019-07-09 14:01:51');

/*Data for the table `m_tickerdetails` */

insert  into `m_tickerdetails`(`Id`,`M_Ticker_Id`,`M_Player_Id`,`M_Groupplayer_Id`,`IsDeleted`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,1,1,NULL,0,NULL,NULL,'2019-03-25 10:37:17','2019-03-25 10:37:17'),
(2,1,2,NULL,0,NULL,NULL,'2019-03-25 10:37:17','2019-03-25 10:37:17'),
(3,1,3,NULL,0,NULL,NULL,'2019-03-25 10:37:17','2019-03-25 10:37:17'),
(4,2,NULL,2,0,NULL,NULL,'2019-03-25 10:38:36','2019-03-25 10:38:36'),
(5,2,NULL,1,0,NULL,NULL,'2019-03-25 10:38:36','2019-03-25 10:38:36'),
(6,3,2,NULL,0,NULL,NULL,'2019-05-23 11:42:54','2019-05-23 11:42:54');

/*Data for the table `m_tickers` */

insert  into `m_tickers`(`Id`,`M_Event_Id`,`Name`,`Description`,`AssignType`,`ActiveDate`,`InactiveDate`,`IsDeleted`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,1,'Ticker 1','We open at 7.00 - 17.00 , At friday at 13.00 - 17.00',1,NULL,NULL,0,'superadmin','superadmin','2019-03-25 10:37:11','2019-05-23 11:34:19'),
(2,1,'Tikcer 2','it\'s still working, we are testing the update ticker if it works like charm',2,NULL,NULL,0,'superadmin','superadmin','2019-03-25 10:38:30','2019-05-23 11:33:22'),
(3,1,'Ticker 3','Test for last time. if it works, then it will be ok',1,NULL,NULL,0,'superadmin','superadmin','2019-05-23 11:42:45','2019-05-23 11:43:50');

/*Data for the table `m_tickersettings` */

insert  into `m_tickersettings`(`Id`,`Name`,`BackGroundColor`,`FontColor`,`Height`,`Speed`,`ImgUrl`,`IsActive`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,'Tikcer 2','#00cc66','#ffffff','15',10,'/uploads/smartdisplay/tickers/20190709_134644_20190416_092747_images.png',1,'superadmin','superadmin','2019-03-29 11:33:12','2019-07-09 13:46:44');

/*Data for the table `m_userprofiles` */

insert  into `m_userprofiles`(`Id`,`M_User_Id`,`CompleteName`,`Address`,`Phone`,`Email`,`PhotoPath`,`PhotoName`,`AboutMe`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,1,NULL,NULL,NULL,NULL,'./assets/user_profile/','user_default.png',NULL,NULL,NULL,NULL,NULL);

/*Data for the table `m_users` */

insert  into `m_users`(`Id`,`M_Groupuser_Id`,`Username`,`Password`,`IsLoggedIn`,`IsActive`,`Language`,`CreatedBy`,`ModifiedBy`,`Created`,`Modified`) values 
(1,NULL,'superadmin','1e2acca1abae9a7e0dd64a901adea2e5',0,1,'indonesia',NULL,NULL,NULL,NULL);

/*Data for the table `m_usersettings` */

insert  into `m_usersettings`(`Id`,`M_User_Id`,`G_Language_Id`,`G_Color_Id`,`RowPerpage`) values 
(1,1,1,1,5);

/*Data for the table `migrations` */

insert  into `migrations`(`version`) values 
(20190523093818);

/*Data for the table `r_reportaccessroles` */

/*Data for the table `r_reports` */

/*Data for the table `t_playermultimedias` */

insert  into `t_playermultimedias`(`Id`,`PlayerId`,`PlayerName`,`MultimediaId`,`Url`,`MultimediaName`,`IsDeleted`,`ActiveDate`,`InactiveDate`,`TimeStart`,`TimeEnd`,`DownloadedUrl`) values 
(1,1,'Player_001','1','/uploads/images/20190325_100426_screencapture-localhost-8889-Sahara-cart-2019-03-22-13_59_04.png','Pic 1',0,'2019-03-26 06:00:00','2019-04-19 05:00:00','00:00','22:00','C:\\download\\20190325_100426_screencapture-localhost-8889-Sahara-cart-2019-03-22-13_59_04.png'),
(2,1,'Player_001','2','/uploads/images/20190325_101945_screencapture-localhost-8889-Sahara-shop-2019-03-22-13_54_06.png','Pic 2',0,'2019-03-26 06:00:00','2019-04-19 05:00:00','00:00','22:00','C:\\download\\20190325_101945_screencapture-localhost-8889-Sahara-shop-2019-03-22-13_54_06.png'),
(28,1,'Player_001','4','/uploads/images/20190327_141515_WhatsApp Image 2019-02-18 at 07.25.29.jpeg','Pic 4',0,'2019-03-26 06:00:00','2019-04-19 05:00:00','00:00','22:00','C:\\download\\20190327_141515_WhatsApp Image 2019-02-18 at 07.25.29.jpeg'),
(29,1,'Player_001','5','/uploads/images/20190329_134010_02_01_slide_nature.jpg','Pic 5',0,'2019-03-26 06:00:00','2019-04-19 05:00:00','00:00','22:00','C:\\download\\20190329_134010_02_01_slide_nature.jpg');

/*Data for the table `t_playertickers` */

insert  into `t_playertickers`(`Id`,`PlayerId`,`PlayerName`,`TickerId`,`TickerContent`,`TickerName`,`IsDeleted`,`ActiveDate`,`InactiveDate`,`TimeStart`,`TimeEnd`) values 
(1,1,'Player_001','1','Test 1 ya babang','Ticker 1',0,'2019-03-26 06:00:00','2019-04-19 05:00:00','00:00','22:00'),
(2,1,'Player_001','2','Test 2 ya babang','Tikcer 2',0,'2019-03-26 06:00:00','2019-04-19 05:00:00','00:00','22:00');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
