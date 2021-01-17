-- MySQL dump 10.13  Distrib 5.7.24, for Win32 (AMD64)
--
-- Host: localhost    Database: exercise
-- ------------------------------------------------------
-- Server version	5.7.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `goals` int(11) NOT NULL,
  `resetHash` varchar(256) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `resetHash` (`resetHash`),
  UNIQUE KEY `resetHash_2` (`resetHash`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (2,'hhh@gmail.com','$2y$10$YDF0hR1CXxHqEU2Rzle1zeurq71qHPPlEWTmyX3u7jTOr9VExXA3q','hhh',3,'$2y$10$eqPCuBka3W.4uLBEbIZKfeVBpq6xPzHvTPNd1Ko/5lDgUBHpOBREy');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exevents`
--

DROP TABLE IF EXISTS `exevents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exevents` (
  `id` int(11) NOT NULL,
  `sportid` int(11) NOT NULL,
  `edate` date NOT NULL,
  `startTime` time DEFAULT NULL,
  `stopTime` time DEFAULT NULL,
  `checkbox` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exevents`
--

LOCK TABLES `exevents` WRITE;
/*!40000 ALTER TABLE `exevents` DISABLE KEYS */;
INSERT INTO `exevents` VALUES (2,1,'2020-12-08','12:01:00','16:01:00',NULL);
/*!40000 ALTER TABLE `exevents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sports`
--

DROP TABLE IF EXISTS `sports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sports` (
  `sportsID` int(11) NOT NULL AUTO_INCREMENT,
  `sportsName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sportsID`),
  UNIQUE KEY `sportsName` (`sportsName`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sports`
--

LOCK TABLES `sports` WRITE;
/*!40000 ALTER TABLE `sports` DISABLE KEYS */;
INSERT INTO `sports` VALUES (2,'basketball'),(1,'soccer');
/*!40000 ALTER TABLE `sports` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-17 23:44:32
