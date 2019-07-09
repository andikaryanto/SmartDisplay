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

/*Table structure for table `g_languages` */

DROP TABLE IF EXISTS `g_languages`;

CREATE TABLE `g_languages` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `g_versionhistory` */

DROP TABLE IF EXISTS `g_versionhistory`;

CREATE TABLE `g_versionhistory` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Version` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Table structure for table `m_enums` */

DROP TABLE IF EXISTS `m_enums`;

CREATE TABLE `m_enums` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `m_events` */

DROP TABLE IF EXISTS `m_events`;

CREATE TABLE `m_events` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(300) DEFAULT NULL,
  `ActiveDate` datetime NOT NULL,
  `InactiveDate` datetime NOT NULL,
  `TimeStart` varchar(20) NOT NULL,
  `TimeEnd` varchar(20) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `m_groupplayers` */

DROP TABLE IF EXISTS `m_groupplayers`;

CREATE TABLE `m_groupplayers` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(100) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `m_multimediadetails` */

DROP TABLE IF EXISTS `m_multimediadetails`;

CREATE TABLE `m_multimediadetails` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `M_Multimedia_Id` int(11) NOT NULL,
  `M_Player_Id` int(11) DEFAULT NULL,
  `M_Groupplayer_Id` int(11) DEFAULT NULL,
  `IsDeleted` smallint(11) DEFAULT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `m_multimediadetails_M_Multimedia_Id_fk` (`M_Multimedia_Id`),
  KEY `m_multimediadetails_M_Player_Id_fk` (`M_Player_Id`),
  KEY `m_multimediadetails_M_Groupplayer_Id_fk` (`M_Groupplayer_Id`),
  CONSTRAINT `m_multimediadetails_M_Groupplayer_Id_fk` FOREIGN KEY (`M_Groupplayer_Id`) REFERENCES `m_groupplayers` (`Id`) ON UPDATE CASCADE,
  CONSTRAINT `m_multimediadetails_M_Multimedia_Id_fk` FOREIGN KEY (`M_Multimedia_Id`) REFERENCES `m_multimedias` (`Id`) ON UPDATE CASCADE,
  CONSTRAINT `m_multimediadetails_M_Player_Id_fk` FOREIGN KEY (`M_Player_Id`) REFERENCES `m_players` (`Id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Table structure for table `m_multimedias` */

DROP TABLE IF EXISTS `m_multimedias`;

CREATE TABLE `m_multimedias` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `M_Event_Id` int(11) NOT NULL,
  `Name` varchar(300) NOT NULL,
  `Type` smallint(11) NOT NULL,
  `AssignType` smallint(11) NOT NULL,
  `Url` varchar(500) NOT NULL,
  `ShowTime` varchar(10) DEFAULT NULL,
  `ActiveDate` datetime DEFAULT NULL,
  `InactiveDate` datetime DEFAULT NULL,
  `IsDeleted` smallint(11) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `m_multimedias_M_Event_Id_fk` (`M_Event_Id`),
  CONSTRAINT `m_multimedias_M_Event_Id_fk` FOREIGN KEY (`M_Event_Id`) REFERENCES `m_events` (`Id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `m_playermultimedias` */

DROP TABLE IF EXISTS `m_playermultimedias`;

CREATE TABLE `m_playermultimedias` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `M_Multimediadetail_Id` int(11) NOT NULL,
  `M_Player_Id` int(11) DEFAULT NULL,
  `IsUpdated` smallint(11) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `m_playermultimedias_M_Multimediadetail_Id_fk` (`M_Multimediadetail_Id`),
  KEY `m_playermultimedias_M_Player_Id_fk` (`M_Player_Id`),
  CONSTRAINT `m_playermultimedias_M_Multimediadetail_Id_fk` FOREIGN KEY (`M_Multimediadetail_Id`) REFERENCES `m_multimediadetails` (`Id`) ON UPDATE CASCADE,
  CONSTRAINT `m_playermultimedias_M_Player_Id_fk` FOREIGN KEY (`M_Player_Id`) REFERENCES `m_players` (`Id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Table structure for table `m_players` */

DROP TABLE IF EXISTS `m_players`;

CREATE TABLE `m_players` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `M_Groupplayer_Id` int(11) NOT NULL,
  `IpAddress` varchar(25) DEFAULT NULL,
  `IsActive` smallint(11) NOT NULL,
  `ExpirationDate` datetime DEFAULT NULL,
  `DeviceId` varchar(50) DEFAULT NULL,
  `IsRegistered` smallint(11) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `m_players_M_Groupplayer_Id_fk` (`M_Groupplayer_Id`),
  CONSTRAINT `m_players_M_Groupplayer_Id_fk` FOREIGN KEY (`M_Groupplayer_Id`) REFERENCES `m_groupplayers` (`Id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `m_playerslots` */

DROP TABLE IF EXISTS `m_playerslots`;

CREATE TABLE `m_playerslots` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Count` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `m_playertickers` */

DROP TABLE IF EXISTS `m_playertickers`;

CREATE TABLE `m_playertickers` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `M_Tickerdetail_Id` int(11) NOT NULL,
  `M_Player_Id` int(11) DEFAULT NULL,
  `IsUpdated` smallint(11) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `m_playertickers_M_Tickerdetail_Id_fk` (`M_Tickerdetail_Id`),
  KEY `m_playertickers_M_Player_Id_fk` (`M_Player_Id`),
  CONSTRAINT `m_playertickers_M_Player_Id_fk` FOREIGN KEY (`M_Player_Id`) REFERENCES `m_players` (`Id`) ON UPDATE CASCADE,
  CONSTRAINT `m_playertickers_M_Tickerdetail_Id_fk` FOREIGN KEY (`M_Tickerdetail_Id`) REFERENCES `m_tickerdetails` (`Id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Table structure for table `m_tickerdetails` */

DROP TABLE IF EXISTS `m_tickerdetails`;

CREATE TABLE `m_tickerdetails` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `M_Ticker_Id` int(11) NOT NULL,
  `M_Player_Id` int(11) DEFAULT NULL,
  `M_Groupplayer_Id` int(11) DEFAULT NULL,
  `IsDeleted` smallint(11) DEFAULT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `m_tickerdetails_M_Ticker_Id_fk` (`M_Ticker_Id`),
  KEY `m_tickerdetails_M_Player_Id_fk` (`M_Player_Id`),
  KEY `m_tickerdetails_M_Groupplayer_Id_fk` (`M_Groupplayer_Id`),
  CONSTRAINT `m_tickerdetails_M_Groupplayer_Id_fk` FOREIGN KEY (`M_Groupplayer_Id`) REFERENCES `m_groupplayers` (`Id`) ON UPDATE CASCADE,
  CONSTRAINT `m_tickerdetails_M_Player_Id_fk` FOREIGN KEY (`M_Player_Id`) REFERENCES `m_players` (`Id`) ON UPDATE CASCADE,
  CONSTRAINT `m_tickerdetails_M_Ticker_Id_fk` FOREIGN KEY (`M_Ticker_Id`) REFERENCES `m_tickers` (`Id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `m_tickers` */

DROP TABLE IF EXISTS `m_tickers`;

CREATE TABLE `m_tickers` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `M_Event_Id` int(11) NOT NULL,
  `Name` varchar(300) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `AssignType` smallint(11) NOT NULL,
  `ActiveDate` datetime DEFAULT NULL,
  `InactiveDate` datetime DEFAULT NULL,
  `IsDeleted` smallint(11) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `m_tickers_M_Event_Id_fk` (`M_Event_Id`),
  CONSTRAINT `m_tickers_M_Event_Id_fk` FOREIGN KEY (`M_Event_Id`) REFERENCES `m_events` (`Id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `m_tickersettings` */

DROP TABLE IF EXISTS `m_tickersettings`;

CREATE TABLE `m_tickersettings` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `BackGroundColor` varchar(10) NOT NULL,
  `FontColor` varchar(10) NOT NULL,
  `Height` varchar(10) NOT NULL,
  `Speed` int(11) NOT NULL,
  `ImgUrl` varchar(500) NOT NULL,
  `IsActive` smallint(11) NOT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Modified` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

/*Table structure for table `r_reports` */

DROP TABLE IF EXISTS `r_reports`;

CREATE TABLE `r_reports` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(300) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Url` varchar(1000) NOT NULL,
  `Resource` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `t_playermultimedias` */

DROP TABLE IF EXISTS `t_playermultimedias`;

CREATE TABLE `t_playermultimedias` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `PlayerId` int(11) NOT NULL,
  `PlayerName` varchar(100) NOT NULL,
  `MultimediaId` varchar(100) NOT NULL,
  `Url` varchar(500) NOT NULL,
  `MultimediaName` varchar(500) NOT NULL,
  `IsDeleted` smallint(11) NOT NULL,
  `ActiveDate` datetime NOT NULL,
  `InactiveDate` datetime NOT NULL,
  `TimeStart` varchar(20) NOT NULL,
  `TimeEnd` varchar(20) NOT NULL,
  `DownloadedUrl` varchar(500) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Table structure for table `t_playertickers` */

DROP TABLE IF EXISTS `t_playertickers`;

CREATE TABLE `t_playertickers` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `PlayerId` int(11) NOT NULL,
  `PlayerName` varchar(100) NOT NULL,
  `TickerId` varchar(100) NOT NULL,
  `TickerContent` varchar(500) NOT NULL,
  `TickerName` varchar(500) NOT NULL,
  `IsDeleted` smallint(11) NOT NULL,
  `ActiveDate` datetime NOT NULL,
  `InactiveDate` datetime NOT NULL,
  `TimeStart` varchar(20) NOT NULL,
  `TimeEnd` varchar(20) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/* Procedure structure for procedure `sp_getplayermultimedia` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_getplayermultimedia` */;

DELIMITER $$

/*!50003 CREATE  PROCEDURE `sp_getplayermultimedia`(
            IN PlayerName VARCHAR(100)
        )
SELECT 	a.Id PlayerId,
		            f.Id PlayerMultimediaId,
                    a.Name PlayerName, 
		            d.Id MultimediaId,
                    d.Url, 
                    d.Name MultimediaName,
                    c.`IsDeleted`,
                    e.`ActiveDate`,
                    e.`InactiveDate`,
                    e.`TimeStart`,
                    e.`TimeEnd`,
                    d.`ShowTime`,
                    d.`Type` MultimediaType
            FROM m_players a
            INNER JOIN m_playermultimedias f ON f.M_Player_Id = a.Id
            INNER JOIN m_multimediadetails c ON c.Id = f.M_Multimediadetail_Id
            INNER JOIN m_multimedias d ON d.Id = c.`M_Multimedia_Id`
            INNER JOIN m_events e ON e.Id = d.`M_Event_Id`
            WHERE a.Name = PlayerName
                AND f.IsUpdated = 1 */$$
DELIMITER ;

/* Procedure structure for procedure `sp_getplayerticker` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_getplayerticker` */;

DELIMITER $$

/*!50003 CREATE  PROCEDURE `sp_getplayerticker`(
                IN PlayerName VARCHAR(100)
            )
SELECT 	a.Id PlayerId,
	d.`Id` TickerId,
                    a.Name PlayerName, 
                    f.Id PlayerTickerId,
                    d.Description TickerContent, 
                    d.Name TickerName,
                    d.`IsDeleted`,
                    e.`ActiveDate`,
                    e.`InactiveDate`,
                    e.`TimeStart`,
                    e.`TimeEnd`
            FROM m_players a
            INNER JOIN m_playertickers f ON f.M_Player_Id = a.Id
            INNER JOIN m_tickerdetails c ON c.Id = f.M_Tickerdetail_Id
            INNER JOIN m_tickers d ON d.Id = c.`M_Ticker_Id`
            INNER JOIN m_events e ON e.Id = d.`M_Event_Id`
            WHERE a.Name = PlayerName
                AND f.IsUpdated = 1 */$$
DELIMITER ;

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

/*!50001 CREATE  VIEW `view_m_accessroles` AS select `a`.`Id` AS `GroupId`,`b`.`Id` AS `FormId`,`b`.`FormName` AS `FormName`,`b`.`AliasName` AS `AliasName`,`b`.`LocalName` AS `LocalName`,ifnull(`c`.`Read`,0) AS `Readd`,ifnull(`c`.`Write`,0) AS `Writee`,ifnull(`c`.`Delete`,0) AS `Deletee`,ifnull(`c`.`Print`,0) AS `Printt`,`b`.`ClassName` AS `ClassName`,0 AS `Header` from ((`m_groupusers` `a` join `m_forms` `b`) left join `m_accessroles` `c` on(((`c`.`M_Form_Id` = `b`.`Id`) and (`c`.`M_Groupuser_Id` = `a`.`Id`)))) union all select distinct NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,`m_forms`.`ClassName` AS `ClassName`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,`m_forms`.`ClassName` AS `ClassName`,1 AS `Header` from `m_forms` order by 10,11 */;

/*View structure for view view_r_reportaccessroles */

/*!50001 DROP TABLE IF EXISTS `view_r_reportaccessroles` */;
/*!50001 DROP VIEW IF EXISTS `view_r_reportaccessroles` */;

/*!50001 CREATE  VIEW `view_r_reportaccessroles` AS select `a`.`Id` AS `GroupId`,`b`.`Id` AS `ReportId`,`b`.`Name` AS `ReportName`,`b`.`Resource` AS `Resource`,ifnull(`c`.`Read`,0) AS `Readd`,ifnull(`c`.`Write`,0) AS `Writee`,ifnull(`c`.`Delete`,0) AS `Deletee`,ifnull(`c`.`Print`,0) AS `Printt` from ((`m_groupusers` `a` join `r_reports` `b`) left join `r_reportaccessroles` `c` on(((`c`.`R_Report_Id` = `b`.`Id`) and (`c`.`M_Groupuser_Id` = `a`.`Id`)))) order by `b`.`Name` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
