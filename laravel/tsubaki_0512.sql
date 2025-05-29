-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: tsubaki
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'チョコレート'),(2,'ガム'),(3,'スナック'),(4,'アイス'),(5,'クッキー'),(6,'せんべい'),(7,'珍味');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2025_05_12_140622_create_products_table',2),(7,'2025_05_12_140951_add_category_id_to_products',3),(8,'2025_05_12_141138_change_category_id_index',4),(9,'2025_05_12_142333_create_categories_table',5),(11,'2025_05_12_142726_change_category_id_foreign_key',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_index` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'サンプル商品100',360,NULL,'2025-05-12 05:39:14','2025-05-12 05:39:14',7),(2,'サンプル商品1',230,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',5),(3,'サンプル商品2',330,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',7),(4,'サンプル商品3',140,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',7),(5,'サンプル商品4',180,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',3),(6,'サンプル商品5',130,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',5),(7,'サンプル商品6',460,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',7),(8,'サンプル商品7',240,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',2),(9,'サンプル商品8',470,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',1),(10,'サンプル商品9',330,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',4),(11,'サンプル商品10',480,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',7),(12,'サンプル商品11',160,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',6),(13,'サンプル商品12',400,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',2),(14,'サンプル商品13',400,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',5),(15,'サンプル商品14',430,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',4),(16,'サンプル商品15',270,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',1),(17,'サンプル商品16',280,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',5),(18,'サンプル商品17',480,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',2),(19,'サンプル商品18',200,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',5),(20,'サンプル商品19',200,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',2),(21,'サンプル商品20',180,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',5),(22,'サンプル商品21',430,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',6),(23,'サンプル商品22',400,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',5),(24,'サンプル商品23',270,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',4),(25,'サンプル商品24',320,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',1),(26,'サンプル商品25',280,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',4),(27,'サンプル商品26',270,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',5),(28,'サンプル商品27',500,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',6),(29,'サンプル商品28',370,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',1),(30,'サンプル商品29',390,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',3),(31,'サンプル商品30',320,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',2),(32,'サンプル商品31',250,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',5),(33,'サンプル商品32',240,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',6),(34,'サンプル商品33',280,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',4),(35,'サンプル商品34',230,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',1),(36,'サンプル商品35',120,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',1),(37,'サンプル商品36',220,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',7),(38,'サンプル商品37',360,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',1),(39,'サンプル商品38',260,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',5),(40,'サンプル商品39',360,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',4),(41,'サンプル商品40',110,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',1),(42,'サンプル商品41',340,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',1),(43,'サンプル商品42',360,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',6),(44,'サンプル商品43',450,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',7),(45,'サンプル商品44',140,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',4),(46,'サンプル商品45',160,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',3),(47,'サンプル商品46',330,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',5),(48,'サンプル商品47',460,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',3),(49,'サンプル商品48',120,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',1),(50,'サンプル商品49',250,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',6),(51,'サンプル商品50',350,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',2),(52,'サンプル商品51',190,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',2),(53,'サンプル商品52',310,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',7),(54,'サンプル商品53',360,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',7),(55,'サンプル商品54',270,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',1),(56,'サンプル商品55',290,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',4),(57,'サンプル商品56',360,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',1),(58,'サンプル商品57',430,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',1),(59,'サンプル商品58',280,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',7),(60,'サンプル商品59',390,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',1),(61,'サンプル商品60',180,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',4),(62,'サンプル商品61',170,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',3),(63,'サンプル商品62',500,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',4),(64,'サンプル商品63',230,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',1),(65,'サンプル商品64',480,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',3),(66,'サンプル商品65',140,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',2),(67,'サンプル商品66',180,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',4),(68,'サンプル商品67',260,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',5),(69,'サンプル商品68',420,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',2),(70,'サンプル商品69',330,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',5),(71,'サンプル商品70',170,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',5),(72,'サンプル商品71',270,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',4),(73,'サンプル商品72',400,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',4),(74,'サンプル商品73',280,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',7),(75,'サンプル商品74',110,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',5),(76,'サンプル商品75',130,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',7),(77,'サンプル商品76',220,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',7),(78,'サンプル商品77',280,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',5),(79,'サンプル商品78',470,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',7),(80,'サンプル商品79',390,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',5),(81,'サンプル商品80',490,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',2),(82,'サンプル商品81',500,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',5),(83,'サンプル商品82',430,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',7),(84,'サンプル商品83',330,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',3),(85,'サンプル商品84',320,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',4),(86,'サンプル商品85',330,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',1),(87,'サンプル商品86',450,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',6),(88,'サンプル商品87',220,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',3),(89,'サンプル商品88',190,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',6),(90,'サンプル商品89',160,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',1),(91,'サンプル商品90',320,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',3),(92,'サンプル商品91',410,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',4),(93,'サンプル商品92',130,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',1),(94,'サンプル商品93',250,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',2),(95,'サンプル商品94',310,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',4),(96,'サンプル商品95',370,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',5),(97,'サンプル商品96',280,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',4),(98,'サンプル商品97',400,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',5),(99,'サンプル商品98',100,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',6),(100,'サンプル商品99',120,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',1),(101,'サンプル商品100',300,NULL,'2025-05-12 05:40:24','2025-05-12 05:40:24',1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2025-05-12 16:05:08
