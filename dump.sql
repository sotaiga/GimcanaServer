-- MariaDB dump 10.18  Distrib 10.5.8-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: gimcana
-- ------------------------------------------------------
-- Server version	10.5.8-MariaDB-1:10.5.8+maria~bionic

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
-- Current Database: `gimcana`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `gimcana` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `gimcana`;

--
-- Table structure for table `equips`
--

DROP TABLE IF EXISTS `equips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equips` (
  `equip_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `equip_gimcana_id` int(11) NOT NULL,
  `equip_dispositiu` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `equip_nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `equip_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `equip_inici` datetime NOT NULL,
  `equip_fi` datetime DEFAULT NULL,
  `equip_num_respostes_correctes` int(11) DEFAULT NULL,
  `equip_punts_respostes_correctes` int(11) DEFAULT NULL,
  `equip_ordre_correcte` tinyint(1) DEFAULT NULL,
  `equip_num_respostes_en_ordre` int(11) DEFAULT NULL,
  `equip_punts_respostes_en_ordre` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`equip_id`),
  UNIQUE KEY `equips_equip_email_unique` (`equip_email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equips`
--

LOCK TABLES `equips` WRITE;
/*!40000 ALTER TABLE `equips` DISABLE KEYS */;
INSERT INTO `equips` VALUES (1,1,'22','sdfasdf','fsadfasd@fasfsa.com','2020-12-20 17:18:34','2020-12-20 05:51:23',10,1,0,1,5,'2020-12-20 17:18:34','2020-12-20 17:51:23'),(2,1,'22','sdfasdf','fsadfasd@fasfsa.comd','2020-12-20 17:18:42','2020-12-20 05:52:03',10,1,0,1,5,'2020-12-20 17:18:42','2020-12-20 17:52:03'),(3,1,'22h','sdfasdf','fsadfasd@fasfsa.comdh','2020-12-20 18:35:27','2020-12-20 06:40:42',170,17,0,1,5,'2020-12-20 18:35:27','2020-12-20 18:40:42');
/*!40000 ALTER TABLE `equips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gimcanes`
--

DROP TABLE IF EXISTS `gimcanes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gimcanes` (
  `gimcana_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gimcana_nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gimcana_data` date NOT NULL,
  `gimcana_patro` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`gimcana_id`),
  UNIQUE KEY `gimcanes_gimcana_nom_unique` (`gimcana_nom`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gimcanes`
--

LOCK TABLES `gimcanes` WRITE;
/*!40000 ALTER TABLE `gimcanes` DISABLE KEYS */;
INSERT INTO `gimcanes` VALUES (1,'Gimcana Medieval - Castelló dߴEmpúries','2020-12-24','2090522545367','2020-12-20 17:18:32','2020-12-20 17:18:32');
/*!40000 ALTER TABLE `gimcanes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (9,'2020_12_20_100619_create_gimcanes_table',1),(10,'2020_12_20_100635_create_plantilles_table',1),(11,'2020_12_20_100653_create_equips_table',1),(12,'2020_12_20_100725_create_respostes_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plantilles`
--

DROP TABLE IF EXISTS `plantilles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plantilles` (
  `plantilla_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plantilla_gimcana_id` int(11) NOT NULL,
  `plantilla_punt_codi` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plantilla_pregunta_codi` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plantilla_resposta_codi` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plantilla_ordre` int(11) NOT NULL,
  `plantilla_punts` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`plantilla_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plantilles`
--

LOCK TABLES `plantilles` WRITE;
/*!40000 ALTER TABLE `plantilles` DISABLE KEYS */;
INSERT INTO `plantilles` VALUES (1,1,'PUNT01','PREGUNTA01','RESPOSTA01_01',1,10,'2020-12-20 17:18:32','2020-12-20 17:18:32'),(2,1,'PUNT02','PREGUNTA02','RESPOSTA02_01',2,10,'2020-12-20 17:18:32','2020-12-20 17:18:32'),(3,1,'PUNT03','PREGUNTA03','RESPOSTA03_01',3,10,'2020-12-20 17:18:32','2020-12-20 17:18:32'),(4,1,'PUNT04','PREGUNTA04','RESPOSTA04_01',4,10,'2020-12-20 17:18:32','2020-12-20 17:18:32'),(5,1,'PUNT05','PREGUNTA05','RESPOSTA05_01',5,10,'2020-12-20 17:18:32','2020-12-20 17:18:32'),(6,1,'PUNT06','PREGUNTA06','RESPOSTA06_01',6,10,'2020-12-20 17:18:32','2020-12-20 17:18:32'),(7,1,'PUNT07','PREGUNTA07','RESPOSTA07_01',7,10,'2020-12-20 17:18:32','2020-12-20 17:18:32'),(8,1,'PUNT08','PREGUNTA08','RESPOSTA08_01',8,10,'2020-12-20 17:18:32','2020-12-20 17:18:32'),(9,1,'PUNT09','PREGUNTA09','RESPOSTA09_01',9,10,'2020-12-20 17:18:32','2020-12-20 17:18:32'),(10,1,'PUNT10','PREGUNTA10','RESPOSTA10_01',10,10,'2020-12-20 17:18:32','2020-12-20 17:18:32'),(11,1,'PUNT11','PREGUNTA11','RESPOSTA11_01',11,10,'2020-12-20 17:18:32','2020-12-20 17:18:32'),(12,1,'PUNT12','PREGUNTA12','RESPOSTA12_01',12,10,'2020-12-20 17:18:32','2020-12-20 17:18:32'),(13,1,'PUNT13','PREGUNTA13','RESPOSTA13_01',13,10,'2020-12-20 17:18:32','2020-12-20 17:18:32'),(14,1,'PUNT14','PREGUNTA14','RESPOSTA14_01',14,10,'2020-12-20 17:18:32','2020-12-20 17:18:32'),(15,1,'PUNT15','PREGUNTA15','RESPOSTA15_01',15,10,'2020-12-20 17:18:32','2020-12-20 17:18:32'),(16,1,'PUNT16','PREGUNTA16','RESPOSTA16_01',16,10,'2020-12-20 17:18:32','2020-12-20 17:18:32'),(17,1,'PUNT17','PREGUNTA17','RESPOSTA17_01',17,10,'2020-12-20 17:18:32','2020-12-20 17:18:32');
/*!40000 ALTER TABLE `plantilles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respostes`
--

DROP TABLE IF EXISTS `respostes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `respostes` (
  `resposta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `resposta_gimcana_id` int(11) NOT NULL,
  `resposta_dispositiu` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resposta_equip_id` int(11) NOT NULL,
  `resposta_punt_codi` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resposta_pregunta_codi` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resposta_resposta_codi` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resposta_ordre` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`resposta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20199 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respostes`
--

LOCK TABLES `respostes` WRITE;
/*!40000 ALTER TABLE `respostes` DISABLE KEYS */;
INSERT INTO `respostes` VALUES (20178,1,'sdfasd',1,'PUNT01','PREGUNTA01','RESPOSTA01_01',1,'2020-12-20 17:51:23','2020-12-20 17:51:23'),(20179,1,'sdfasd',2,'PUNT01','PREGUNTA01','RESPOSTA01_01',1,'2020-12-20 17:52:03','2020-12-20 17:52:03'),(20182,1,'sdfasd',3,'PUNT01','PREGUNTA01','RESPOSTA01_01',1,'2020-12-20 18:40:42','2020-12-20 18:40:42'),(20183,1,'sdfasd',3,'PUNT01','PREGUNTA01','RESPOSTA01_01',2,'2020-12-20 18:40:42','2020-12-20 18:40:42'),(20184,1,'sdfasd',3,'PUNT01','PREGUNTA01','RESPOSTA01_01',3,'2020-12-20 18:40:42','2020-12-20 18:40:42'),(20185,1,'sdfasd',3,'PUNT01','PREGUNTA01','RESPOSTA01_01',4,'2020-12-20 18:40:42','2020-12-20 18:40:42'),(20186,1,'sdfasd',3,'PUNT01','PREGUNTA01','RESPOSTA01_01',5,'2020-12-20 18:40:42','2020-12-20 18:40:42'),(20187,1,'sdfasd',3,'PUNT01','PREGUNTA01','RESPOSTA01_01',6,'2020-12-20 18:40:42','2020-12-20 18:40:42'),(20188,1,'sdfasd',3,'PUNT01','PREGUNTA01','RESPOSTA01_01',7,'2020-12-20 18:40:42','2020-12-20 18:40:42'),(20189,1,'sdfasd',3,'PUNT01','PREGUNTA01','RESPOSTA01_01',8,'2020-12-20 18:40:42','2020-12-20 18:40:42'),(20190,1,'sdfasd',3,'PUNT01','PREGUNTA01','RESPOSTA01_01',9,'2020-12-20 18:40:42','2020-12-20 18:40:42'),(20191,1,'sdfasd',3,'PUNT01','PREGUNTA01','RESPOSTA01_01',10,'2020-12-20 18:40:42','2020-12-20 18:40:42'),(20192,1,'sdfasd',3,'PUNT01','PREGUNTA01','RESPOSTA01_01',11,'2020-12-20 18:40:42','2020-12-20 18:40:42'),(20193,1,'sdfasd',3,'PUNT01','PREGUNTA01','RESPOSTA01_01',12,'2020-12-20 18:40:42','2020-12-20 18:40:42'),(20194,1,'sdfasd',3,'PUNT01','PREGUNTA01','RESPOSTA01_01',13,'2020-12-20 18:40:42','2020-12-20 18:40:42'),(20195,1,'sdfasd',3,'PUNT01','PREGUNTA01','RESPOSTA01_01',14,'2020-12-20 18:40:42','2020-12-20 18:40:42'),(20196,1,'sdfasd',3,'PUNT01','PREGUNTA01','RESPOSTA01_01',15,'2020-12-20 18:40:42','2020-12-20 18:40:42'),(20197,1,'sdfasd',3,'PUNT01','PREGUNTA01','RESPOSTA01_01',16,'2020-12-20 18:40:42','2020-12-20 18:40:42'),(20198,1,'sdfasd',3,'PUNT01','PREGUNTA01','RESPOSTA01_01',17,'2020-12-20 18:40:42','2020-12-20 18:40:42');
/*!40000 ALTER TABLE `respostes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-20 19:01:31
