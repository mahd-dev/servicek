-- MySQL dump 10.13  Distrib 5.6.24, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: servicek
-- ------------------------------------------------------
-- Server version	5.6.24-0ubuntu2

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
-- Table structure for table `agent`
--

DROP TABLE IF EXISTS `agent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agent` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(1023) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agent`
--

LOCK TABLES `agent` WRITE;
/*!40000 ALTER TABLE `agent` DISABLE KEYS */;
INSERT INTO `agent` VALUES (1,'Test Agent',NULL,NULL,'test',NULL,NULL,NULL);
/*!40000 ALTER TABLE `agent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agent_request`
--

DROP TABLE IF EXISTS `agent_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agent_request` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_for` bigint(20) DEFAULT NULL,
  `rel_type` varchar(35) DEFAULT NULL,
  `creation_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agent_request`
--

LOCK TABLES `agent_request` WRITE;
/*!40000 ALTER TABLE `agent_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `agent_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_children`
--

DROP TABLE IF EXISTS `category_children`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_children` (
  `id_category` bigint(20) NOT NULL DEFAULT '0',
  `id_children` bigint(20) NOT NULL DEFAULT '0',
  `children_type` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id_category`,`id_children`,`children_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_children`
--

LOCK TABLES `category_children` WRITE;
/*!40000 ALTER TABLE `category_children` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_children` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slogan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(4095) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `name` (`name`),
  FULLTEXT KEY `slogan` (`slogan`,`description`),
  FULLTEXT KEY `name_2` (`name`,`slogan`,`description`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (2,'mahd','Toghther we do the best','Software development company, we love cloud computing and web development','mahdCompany',NULL,NULL,'2015-05-06 16:30:00'),(3,'servicek','pub','aaaaaaaaaa aaaaaaaaaaaa\r\naaaaaaaaaa aaaaaaaaaaaa\r\naaaaaaaaaa aaaaaaaaaaaa\r\naaaaaaaaaa aaaaaaaaaaaa','servicek',NULL,NULL,'2015-05-08 16:58:25');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_seat`
--

DROP TABLE IF EXISTS `company_seat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_seat` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_company` bigint(20) DEFAULT NULL,
  `name` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `geolocation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(1023) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `name` (`name`,`address`,`tel`,`mobile`,`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_seat`
--

LOCK TABLES `company_seat` WRITE;
/*!40000 ALTER TABLE `company_seat` DISABLE KEYS */;
INSERT INTO `company_seat` VALUES (1,2,'Kalaa kebira','master','{\"longitude\":\"10.52671799999996\",\"latitude\":\"35.878347\"}','C48, Kalaa Kebira, Tunisie','73349119','93625649','contact@mahd.tn','2015-05-06 16:30:00'),(2,3,'SiÃ¨ge social','master','{\"longitude\":\"10.608394999999973\",\"latitude\":\"35.825603\"}','Sousse, Gouvernorat de Sousse, Tunisie','73349119','352154','contact@servicek.net','2015-05-08 16:58:25');
/*!40000 ALTER TABLE `company_seat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contract`
--

DROP TABLE IF EXISTS `contract`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contract` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_page` bigint(20) DEFAULT NULL,
  `page_type` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_agent` bigint(20) DEFAULT NULL,
  `payment_token` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_from` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_recipt` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `creation_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contract`
--

LOCK TABLES `contract` WRITE;
/*!40000 ALTER TABLE `contract` DISABLE KEYS */;
INSERT INTO `contract` VALUES (8,2,'company',NULL,'CC0DDA125D78D53EB99ADB37481E163F','e_dinar_smart_tunisian_post',NULL,'2',90,12,'2015-05-08 16:48:46'),(9,3,'job',NULL,'7B551AEF4CA3833B8EFA61F116B7998A','e_dinar_smart_tunisian_post',NULL,'3',60,36,'2015-05-08 16:50:32');
/*!40000 ALTER TABLE `contract` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job`
--

DROP TABLE IF EXISTS `job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_admin` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(4095) COLLATE utf8_unicode_ci DEFAULT NULL,
  `geolocation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(1023) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `name` (`name`),
  FULLTEXT KEY `description` (`description`,`address`,`tel`,`mobile`,`email`),
  FULLTEXT KEY `name_2` (`name`,`description`,`address`,`tel`,`mobile`,`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job`
--

LOCK TABLES `job` WRITE;
/*!40000 ALTER TABLE `job` DISABLE KEYS */;
INSERT INTO `job` VALUES (2,NULL,'mahd',NULL,'Sotware development company, we\'re working on cloud programing','{\"longitude\":\"10.52671799999996\",\"l','C48, Kalaa Kebira, Tunisie','73349119','93625649','contact@mahd.tn','2015-05-05 18:05:33'),(3,3,'mahd',NULL,'SociÃ©tÃ© de dÃ©veloppement informatique','{\"longitude\":\"10.52671799999996\",\"latitude\":\"35.878347\"}','P16, Tunisie','73349119','93625649','contact@mahd.tn','2015-05-06 13:12:54');
/*!40000 ALTER TABLE `job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offer`
--

DROP TABLE IF EXISTS `offer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_company` bigint(20) DEFAULT NULL,
  `text` varchar(4095) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer`
--

LOCK TABLES `offer` WRITE;
/*!40000 ALTER TABLE `offer` DISABLE KEYS */;
/*!40000 ALTER TABLE `offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_company` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(4095) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` float DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `name` (`name`,`description`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restricted_ip`
--

DROP TABLE IF EXISTS `restricted_ip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restricted_ip` (
  `ip_address` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `attempts` int(11) DEFAULT '1',
  `restriction_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ip_address`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restricted_ip`
--

LOCK TABLES `restricted_ip` WRITE;
/*!40000 ALTER TABLE `restricted_ip` DISABLE KEYS */;
/*!40000 ALTER TABLE `restricted_ip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_company` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(4095) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` float DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `name` (`name`,`description`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `displayname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'test','123','Test user','test@server.com','123456789','2015-04-24 19:46:41'),(3,'med','12345678','Mohamed Dardouri','dardouri.mohamed@hotmail.com','93625649','2015-05-01 16:28:29');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_admin`
--

DROP TABLE IF EXISTS `user_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_admin` (
  `id_user` bigint(20) NOT NULL DEFAULT '0',
  `id_company` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`,`id_company`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_admin`
--

LOCK TABLES `user_admin` WRITE;
/*!40000 ALTER TABLE `user_admin` DISABLE KEYS */;
INSERT INTO `user_admin` VALUES (3,2),(3,3);
/*!40000 ALTER TABLE `user_admin` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-08 18:04:17
