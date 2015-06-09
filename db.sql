-- MySQL dump 10.14  Distrib 5.5.41-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: next_servicek
-- ------------------------------------------------------
-- Server version	5.5.41-MariaDB-1ubuntu0.14.04.1

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agent_request`
--

LOCK TABLES `agent_request` WRITE;
/*!40000 ALTER TABLE `agent_request` DISABLE KEYS */;
INSERT INTO `agent_request` VALUES (5,11,'company','2015-05-23 23:01:39');
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
  `company_publish_price` float DEFAULT NULL,
  `job_publish_price` float DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=149 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (103,'Bijoux',50,50,NULL),(104,'Faux Bijoux',50,50,NULL),(105,'Montres',50,50,NULL),(106,'Garderie',50,50,NULL),(107,'Ecole primaire',50,50,NULL),(108,'Collége privé',50,50,NULL),(109,'Lycée privé',50,50,NULL),(110,'Instituts privé',50,50,NULL),(111,'Centre de formation',50,50,NULL),(112,'Vêtements',50,50,NULL),(113,'Chaussures',50,50,NULL),(114,'Robe de location',50,50,NULL),(115,'Sac à main',50,50,NULL),(116,'Meubles',50,50,NULL),(117,'Bureautique',50,50,NULL),(118,'Objets décoratifs',50,50,NULL),(119,'Dressing',50,50,NULL),(120,'Architecture',50,50,NULL),(121,'Avocat',50,50,NULL),(122,'Notaire',50,50,NULL),(123,'Enseignement & Formation',50,50,NULL),(124,'Accessoire',50,50,NULL),(125,'Automobiles & Transport',50,50,NULL),(126,'Equipements & Matériaux',50,50,NULL),(127,'Santé',50,50,NULL),(128,'Vêtement',50,50,NULL),(129,'Banques & Services',50,50,NULL),(130,'Financiers',50,50,NULL),(131,'High Tech & Multimédia',50,50,NULL),(132,'Services',50,50,NULL),(133,'Commerce',50,50,NULL),(134,'Immobilier & BTP',50,50,NULL),(135,'Télécommunication',50,50,NULL),(136,'Industrie',50,50,NULL),(137,'Tourisme',50,50,NULL),(138,'Energie & Matières ',50,50,NULL),(139,'Informatique',50,50,NULL),(140,'Internet',50,50,NULL),(141,'Agro-Alimentaire',50,50,NULL),(142,'Environnement',50,50,NULL),(143,'Médias & Communication',50,50,NULL),(144,'Sanitaire',50,50,NULL),(145,'Confection',50,50,NULL),(146,'Location des voitures',50,50,NULL),(147,'Maintenance',50,50,NULL),(148,'Comptabilité générale',50,50,NULL);
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
INSERT INTO `category_children` VALUES (3,11,'company'),(4,9,'company'),(4,10,'company'),(6,12,'company'),(106,5,'job');
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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (9,'mahd','Toghther we do the best','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaa aaaaaaaaaa','mahdCompany','1ED28EFA2B7A1C4FFD5A26C5AAF5E3FD.png','2A8BFAE17825E68BC8C049641BE96A32.png','2015-05-16 14:45:58'),(10,'sdcfds','dsvedvdsvbg','dfbgrtfbhrtsgfhjtyhjfgnhjhg hj kgjfxdb gthgfhghjrtyhn','aaaaaaaa',NULL,NULL,'2015-05-23 22:33:18'),(11,'rez','sss','ssssssssssssssssssssssssssssssssssssssssssssssssss','aaaaaa',NULL,NULL,'2015-05-23 22:39:05'),(12,'STS','','offre des services en ligne azlrkmazlramkrapv,lf,dbbep\r\nrebflder;b \r\nÃ¹erge 75 dd','stservices',NULL,'413A954E48367AC0C5A92DAEEAAE64DE.','2015-06-01 14:14:37');
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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_seat`
--

LOCK TABLES `company_seat` WRITE;
/*!40000 ALTER TABLE `company_seat` DISABLE KEYS */;
INSERT INTO `company_seat` VALUES (8,9,'SiÃ¨ge social','master','{\"longitude\":\"10.52671799999996\",\"latitude\":\"35.878347\"}','C48, Kalaa Kebira, Tunisie','73349119','93625649','contact@mahd.tn','2015-05-16 14:45:58'),(9,10,'SiÃ¨ge social','master','{\"longitude\":\"10.52671799999996\",\"latitude\":\"35.878347\"}','C48, Kalaa Kebira, Tunisie','73349119','','contact@mahd.tn','2015-05-23 22:33:18'),(10,11,'SiÃ¨ge social','master','{\"longitude\":\"9.670627281250063\",\"latitude\":\"36.042582610203716\"}','C46, Tunisie','44444444','44444444444','sam_rezg@yahoo.fr','2015-05-23 22:39:05'),(11,12,'SiÃ¨ge social','master','{\"longitude\":\"10.53333299999997\",\"latitude\":\"35.866667\"}','Unnamed Road, KalÃ¢a Kebira, Tunisie','548654^pmm',',figeignvhe7','ararazrarza@hotmail.tn','2015-06-01 14:14:37');
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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contract`
--

LOCK TABLES `contract` WRITE;
/*!40000 ALTER TABLE `contract` DISABLE KEYS */;
INSERT INTO `contract` VALUES (15,9,'company',NULL,NULL,NULL,NULL,'0',0,1,'2015-05-16 14:45:58'),(16,10,'company',NULL,NULL,NULL,NULL,'0',0,1,'2015-05-23 22:33:18'),(17,11,'company',NULL,NULL,NULL,NULL,'0',0,1,'2015-05-23 22:39:05'),(18,11,'company',6,'DBAA0B4FBEE4DFCF06897C5F2C85DBB9','e_dinar_smart_tunisian_post',NULL,'1',60,6,'2015-06-23 22:39:05'),(19,12,'company',NULL,NULL,NULL,NULL,'0',0,1,'2015-06-01 14:14:37'),(20,5,'job',NULL,NULL,NULL,NULL,'0',0,1,'2015-06-08 17:52:27');
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job`
--

LOCK TABLES `job` WRITE;
/*!40000 ALTER TABLE `job` DISABLE KEYS */;
INSERT INTO `job` VALUES (5,16,'zrgf',NULL,'rzefsokapq\r\nezflsckpxlwri vrds\r\nezfdsfpt$Ãªrgv\r\nsdxdmza$zrzÃªfpezlv\r\nvvdvlzpefze$fÃªzv','{\"longitude\":\"8.176486656250063\",\"latitude\":\"33.71763630114032\"}','Tozeur, Tunisie','584646876','7+9563659','kalaka@ooo.fr','2015-06-08 17:52:27');
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
  `rent_price` float DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `name` (`name`,`description`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (22,9,'cssc','sfedfx',10,5,NULL,'2015-05-23 22:52:06'),(24,12,NULL,NULL,NULL,NULL,NULL,'2015-06-01 14:24:40'),(23,12,NULL,NULL,NULL,NULL,NULL,'2015-06-01 14:23:35');
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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` VALUES (13,12,NULL,NULL,NULL,NULL,'2015-06-01 14:26:43');
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
  `type` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `displayname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (8,NULL,'librairiehachem','Acpc9owORAvzY','ahlem hachem','servicetunisien@gmail.com','97135911','2015-05-10 23:13:45'),(3,'master','med','Acu65vpNnWmck','Mohamed Dardouri','dardouri.mohamed@hotmail.com','93625649','2015-05-01 16:28:29'),(4,NULL,'aminehm','Ach3btbuEnZnI','aminehm','servicetunisien@gmail.com','97831197','2015-05-08 23:03:42'),(5,NULL,'yathreb ','Ac8qf0fSu9ETU','yathreb baccouche','yathrebbaccouche@gmail.com','50482859','2015-05-08 23:35:04'),(6,'agent','testagent','AcOXrZIDI6uXk','Agent de test','test@serviek.net','123456789','2015-05-10 03:17:41'),(7,NULL,'hachem','AcXd/IzvcZKAc','ahmed','servicetunisien@gmail.com','97831197','2015-05-10 18:34:46'),(9,NULL,'test1','Ac2MmEGlzmFWA','test','hichemchouaibi2@gmail.com','96474355','2015-05-13 13:29:18'),(10,NULL,'test12','Ac2MmEGlzmFWA','test testjejje','hichemchouaaibi2@gmail.com','96474355','2015-05-13 13:49:31'),(11,NULL,'sami','j3824/4Yp3T6M','rezg','sam_rezg@yahoo.fr','44444444','2015-05-23 22:35:27'),(12,NULL,'a','bVUX21pWJIgd6','e','servicetunisien@gmail.com','123456789','2015-06-01 13:54:47'),(13,NULL,'servicek','6wIMZGG/RM2Mk','STS','azrfdg@oigjglg.jg','aezrzazaea','2015-06-01 14:09:12'),(14,NULL,'aa','AUnmrdJEZcdrw','aaaaa','servicetunisien@gmail.com','31656465','2015-06-07 18:23:08'),(15,NULL,'GS Sanitaire','2KzX8I83hR./.','GS Sanitaire','GSSanitaire@servicek.net','GS Sanitaire','2015-06-08 08:31:00'),(16,NULL,'qsf','Pk7wlDvxHxF2E','qds','azeazdasd@otrgfv.kjh','54687987987987','2015-06-08 17:51:23');
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
INSERT INTO `user_admin` VALUES (3,9),(3,10),(11,11),(13,12);
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

-- Dump completed on 2015-06-09 19:37:00
