-- MySQL dump 10.13  Distrib 5.7.23, for linux-glibc2.12 (x86_64)
--
-- Host: localhost    Database: S1130146_S1130146_boardgamesapp
-- ------------------------------------------------------
-- Server version	5.7.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES UTF8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- -----------------------------------------------------
-- Schema S1130146_boardgamesapp
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `S1130146_boardgamesapp` ;

-- -----------------------------------------------------
-- Schema S1130146_boardgamesapp
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `S1130146_boardgamesapp` ;
USE `S1130146_boardgamesapp` ;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(5024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES (2,'Secret hitler','Secret hitlerSecret hitlerSecret hitlerSecret hitlerSecret hitlerSecret hitlerSecret hitlerSecret hitlerSecret hitlerSecret hitlerSecret hitlerSecret hitlerSecret hitler');
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playedgames`
--

DROP TABLE IF EXISTS `playedgames`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `playedgames` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Games_id` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`Games_id`),
  KEY `fk_PlayedGames_Games1_idx` (`Games_id`),
  CONSTRAINT `fk_PlayedGames_Games1` FOREIGN KEY (`Games_id`) REFERENCES `games` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playedgames`
--

LOCK TABLES `playedgames` WRITE;
/*!40000 ALTER TABLE `playedgames` DISABLE KEYS */;
INSERT INTO `playedgames` VALUES (3,2,1337),(4,2,7777),(5,2,999999);
/*!40000 ALTER TABLE `playedgames` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playedgameuserscore`
--

DROP TABLE IF EXISTS `playedgameuserscore`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `playedgameuserscore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `didWin` int(11) DEFAULT NULL,
  `Games_id` int(11) unsigned DEFAULT NULL,
  `profiles_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playedgameuserscore`
--

LOCK TABLES `playedgameuserscore` WRITE;
/*!40000 ALTER TABLE `playedgameuserscore` DISABLE KEYS */;
INSERT INTO `playedgameuserscore` VALUES (1,0,2,5),(2,1,2,5),(3,0,2,5),(4,0,2,5),(5,0,2,5),(6,0,2,5),(7,0,2,5),(8,0,2,5),(9,0,2,5),(10,1,2,5),(11,0,2,6),(12,0,2,6),(13,0,2,5),(14,0,2,6),(15,0,2,5),(16,1,2,5),(17,1,2,6),(18,1,2,6),(19,1,2,5),(20,1,2,5);
/*!40000 ALTER TABLE `playedgameuserscore` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) DEFAULT NULL,
  `wins` int(11) DEFAULT NULL,
  `losses` int(11) DEFAULT NULL,
  `totalGames` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (5,'thomas zwarts',5,10,15),(6,'danny van veltum',2,3,5);
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `rememberMeToken` varchar(255) DEFAULT NULL,
  `forgotPasswordToken` varchar(255) DEFAULT NULL,
  `profiles_id` int(11) NOT NULL,
  `temporaryUserToken` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`profiles_id`),
  KEY `fk_users_profiles_idx` (`profiles_id`),
  CONSTRAINT `fk_users_profiles` FOREIGN KEY (`profiles_id`) REFERENCES `profiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'thomas','zwarts','thomaszwarts@gmail.com','TEMPORARY_USER_PASSWORD','8d5e824068753d67b47c25afabadbee6',NULL,5,'990aed86493525706b153b843894d57e'),(2,'danny','van veltum','danny@danny.nl','TEMPORARY_USER_PASSWORD','9b265e01b9ea3334f881665c27c9cef2',NULL,6,'d08e38f46cdabebe8cbf43a976661b1d');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-27 20:51:20
