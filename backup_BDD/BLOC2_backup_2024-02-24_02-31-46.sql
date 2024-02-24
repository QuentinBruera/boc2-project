-- MariaDB dump 10.19  Distrib 10.11.4-MariaDB, for debian-linux-gnu (aarch64)
--
-- Host: localhost    Database: BLOC2
-- ------------------------------------------------------
-- Server version	10.11.4-MariaDB-1~deb12u1

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
-- Table structure for table `Temperature`
--

DROP TABLE IF EXISTS `Temperature`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Temperature` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Ville_ID` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `Température_Capteur` int(11) DEFAULT NULL,
  `Picto` text DEFAULT NULL,
  `Humidité_Capteur` int(11) DEFAULT NULL,
  `Température_API` int(11) DEFAULT NULL,
  `Humidité_API` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_ville` (`Ville_ID`),
  CONSTRAINT `fk_ville` FOREIGN KEY (`Ville_ID`) REFERENCES `Ville` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Temperature`
--

LOCK TABLES `Temperature` WRITE;
/*!40000 ALTER TABLE `Temperature` DISABLE KEYS */;
INSERT INTO `Temperature` VALUES
(1,1,'2024-01-26',20,'https://meteofrance.com/modules/custom/mf_tools_common_theme_public/svg/weather/p2j.svg',68,NULL,NULL),
(2,3,'2024-01-27',16,'https://meteofrance.com/modules/custom/mf_tools_common_theme_public/svg/weather/p2j.svg',80,NULL,NULL),
(3,1,'2024-01-28',5,'https://meteofrance.com/modules/custom/mf_tools_common_theme_public/svg/weather/p2j.svg',50,NULL,NULL),
(4,1,'2024-01-29',40,'https://meteofrance.com/modules/custom/mf_tools_common_theme_public/svg/weather/p2j.svg',25,NULL,NULL),
(5,1,'2024-01-30',33,'https://meteofrance.com/modules/custom/mf_tools_common_theme_public/svg/weather/p2j.svg',45,NULL,NULL),
(6,1,'2024-01-31',28,'test',85,25,86),
(21,1,'2024-02-01',24,'https://meteofrance.com/modules/custom/mf_tools_common_theme_public/svg/weather/p2j.svg',45,14,71),
(22,1,'2024-02-02',24,'https://meteofrance.com/modules/custom/mf_tools_common_theme_public/svg/weather/p2j.svg',44,15,67),
(23,1,'2024-02-20',22,'https://meteofrance.com/modules/custom/mf_tools_common_theme_public/svg/weather/p2j.svg',46,16,51),
(24,1,'2024-02-21',23,'https://meteofrance.com/modules/custom/mf_tools_common_theme_public/svg/weather/p2j.svg',46,17,42),
(25,1,'2024-02-22',25,'https://meteofrance.com/modules/custom/mf_tools_common_theme_public/svg/weather/p2j.svg',43,20,37),
(26,1,'2024-02-23',23,'http://openweathermap.org/img/w/11n.png',48,5,87),
(27,1,'2024-02-24',24,'http://openweathermap.org/img/w/10n.png',48,4,93);
/*!40000 ALTER TABLE `Temperature` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Ville`
--

DROP TABLE IF EXISTS `Ville`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ville` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NomVille` varchar(50) DEFAULT NULL,
  `Pays` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ville`
--

LOCK TABLES `Ville` WRITE;
/*!40000 ALTER TABLE `Ville` DISABLE KEYS */;
INSERT INTO `Ville` VALUES
(1,'Pau','France'),
(2,'Toulouse','France'),
(3,'Paris','France'),
(4,'Limoges','France');
/*!40000 ALTER TABLE `Ville` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-24  2:31:46
