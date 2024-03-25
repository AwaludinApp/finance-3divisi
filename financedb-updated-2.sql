-- MariaDB dump 10.19-11.2.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: financedb3
-- ------------------------------------------------------
-- Server version	11.2.2-MariaDB

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
-- Table structure for table `akun_children`
--

DROP TABLE IF EXISTS `akun_children`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `akun_children` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_akun` varchar(255) DEFAULT NULL,
  `nama_akun` varchar(255) DEFAULT NULL,
  `akun_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `akun_children`
--

LOCK TABLES `akun_children` WRITE;
/*!40000 ALTER TABLE `akun_children` DISABLE KEYS */;
/*!40000 ALTER TABLE `akun_children` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `akuns`
--

DROP TABLE IF EXISTS `akuns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `akuns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_akun` varchar(255) DEFAULT NULL,
  `nama_akun` varchar(255) DEFAULT NULL,
  `sub_sub_akun_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT 1,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `akuns`
--

LOCK TABLES `akuns` WRITE;
/*!40000 ALTER TABLE `akuns` DISABLE KEYS */;
INSERT INTO `akuns` VALUES
(1,'11000','Aset Lancar (lancar)',NULL,1,'2023-11-23 08:26:56','2023-12-02 23:32:04',1,1),
(2,'11100','Kas dan Setara Kas',NULL,1,'2023-11-23 08:27:18','2023-11-26 15:01:10',2,1),
(3,'11110','Kas',NULL,1,'2023-11-23 08:27:33','2023-11-23 08:27:33',3,2),
(4,'11120','Setara Kas',NULL,0,'2023-11-23 08:27:54','2023-11-23 08:27:54',3,2),
(5,'41000','Pendapatan tidak terikat',NULL,0,'2023-11-23 08:35:44','2023-11-23 08:35:44',1,4),
(6,'41100','Dana Luar',NULL,0,'2023-11-23 08:36:34','2023-11-23 08:36:34',2,5),
(7,'51000','Biaya-biaya',NULL,0,'2023-11-23 08:37:06','2023-11-23 08:37:06',1,5),
(8,'51100','Beban Listrik',NULL,0,'2023-11-23 08:37:25','2023-11-23 08:37:25',2,7),
(9,'12000','Test Akun',NULL,1,'2023-11-23 17:24:54','2023-11-23 17:29:32',1,1),
(10,'11111','Level last',NULL,1,'2023-11-23 23:24:59','2023-11-23 23:24:59',4,3),
(11,'12000','akun 2',NULL,1,'2023-11-26 13:24:53','2023-11-26 13:25:03',1,1),
(12,'1200','akun once deleted',NULL,1,'2023-11-26 13:33:09','2023-11-26 13:33:36',2,1),
(13,'12000','akun once deleted',NULL,1,'2023-11-26 13:33:50','2023-11-26 13:53:15',2,1),
(14,'11100','Kas dan Setara Kas (new)',NULL,1,'2023-11-26 15:03:08','2023-12-02 23:32:04',2,1),
(15,'akun1','akunlevel1',NULL,0,'2023-12-02 20:55:58','2023-12-02 20:55:58',1,6),
(16,'akunlevel2','akunlevel2',NULL,0,'2023-12-02 20:56:17','2023-12-02 20:56:17',2,15),
(17,'akunlevel3','akunlevel3',NULL,0,'2023-12-02 20:56:37','2023-12-02 20:56:37',3,16),
(18,'akunlevel4','akunlevel4',NULL,0,'2023-12-02 20:57:06','2023-12-02 20:57:06',4,17),
(19,'11110','Kas [baru]',NULL,1,'2023-12-02 23:25:37','2023-12-02 23:32:04',3,14),
(20,'11111','kas levl 4',NULL,1,'2023-12-02 23:26:25','2023-12-02 23:32:04',4,19),
(21,'19000','Akun2',NULL,0,'2024-02-25 07:01:49','2024-02-25 07:01:49',1,8);
/*!40000 ALTER TABLE `akuns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buku_besars`
--

DROP TABLE IF EXISTS `buku_besars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buku_besars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_transaksi` datetime NOT NULL,
  `akun_id` int(11) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `nilai` decimal(20,2) NOT NULL,
  `pemasukan` decimal(20,2) DEFAULT NULL,
  `pengeluaran` decimal(20,2) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `edited_by` text NOT NULL DEFAULT '[]',
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buku_besars`
--

LOCK TABLES `buku_besars` WRITE;
/*!40000 ALTER TABLE `buku_besars` DISABLE KEYS */;
INSERT INTO `buku_besars` VALUES
(16,'2023-11-29 00:00:00',4,'Pemasukan',600000.00,600000.00,NULL,0,NULL,1,'[]','Kas masuk','2023-11-29 01:54:32','2023-12-03 18:01:35'),
(17,'2023-12-01 00:00:00',7,'Pengeluaran',200000.00,NULL,200000.00,0,NULL,1,'[]','biaya listrik','2023-11-30 20:27:46','2023-11-30 20:28:02'),
(18,'2023-12-03 00:00:00',3,'Pemasukan',500000.00,500000.00,NULL,0,NULL,1,'[]',NULL,'2023-12-02 23:14:20','2023-12-02 23:14:20'),
(19,'2023-12-03 00:00:00',19,'Pemasukan',400000.00,400000.00,NULL,0,NULL,1,'[]',NULL,'2023-12-02 23:26:57','2023-12-02 23:26:57'),
(20,'2023-12-03 00:00:00',20,'Pemasukan',200000.00,200000.00,NULL,0,NULL,1,'[]',NULL,'2023-12-02 23:27:19','2023-12-02 23:27:19');
/*!40000 ALTER TABLE `buku_besars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buku_kecils`
--

DROP TABLE IF EXISTS `buku_kecils`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buku_kecils` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_transaksi` datetime NOT NULL,
  `akun_id` int(11) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `pemasukan` decimal(20,2) DEFAULT NULL,
  `pengeluaran` decimal(20,2) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `edited_by` text NOT NULL DEFAULT '[]',
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nilai` decimal(20,2) DEFAULT NULL,
  `id_transaksi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buku_kecils`
--

LOCK TABLES `buku_kecils` WRITE;
/*!40000 ALTER TABLE `buku_kecils` DISABLE KEYS */;
INSERT INTO `buku_kecils` VALUES
(5,'2023-12-05 00:00:00',5,'Pengeluaran',NULL,600000.00,0,NULL,1,'[]','pendapatan','2023-12-03 18:04:45','2023-12-03 18:16:08',600000.00,NULL),
(6,'2024-01-20 00:00:00',8,'DEBET',200000.00,NULL,0,NULL,3,'[]','Bayar listrik','2024-01-20 03:41:41','2024-01-20 03:41:41',200000.00,'123456'),
(7,'2024-01-20 00:00:00',4,'KREDIT',NULL,200000.00,0,NULL,3,'[]','Bayar listrik','2024-01-20 03:41:41','2024-01-20 03:41:41',200000.00,'123456');
/*!40000 ALTER TABLE `buku_kecils` ENABLE KEYS */;
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
-- Table structure for table `kategoris`
--

DROP TABLE IF EXISTS `kategoris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategoris` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategoris`
--

LOCK TABLES `kategoris` WRITE;
/*!40000 ALTER TABLE `kategoris` DISABLE KEYS */;
INSERT INTO `kategoris` VALUES
(1,'Aset',0,'2023-11-23 08:21:50','2024-02-25 08:30:56'),
(2,'Liabilitas',0,'2023-11-23 08:21:50','2023-11-23 08:21:50'),
(3,'Aset Neto',0,'2023-11-23 08:21:50','2023-11-23 08:21:50'),
(4,'Pendapatan',0,'2023-11-23 08:21:50','2023-11-23 08:21:50'),
(5,'Biaya-biaya',0,'2023-11-23 08:21:50','2023-11-23 08:21:50'),
(6,'ini akan dihapus',1,'2023-12-02 20:55:18','2024-02-25 06:58:03'),
(7,'berhasil disimpan',1,'2024-02-25 06:59:41','2024-02-25 06:59:47'),
(8,'ini akan dihapus2',1,'2024-02-25 07:01:30','2024-02-25 07:02:14');
/*!40000 ALTER TABLE `kategoris` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(14,'2014_10_12_000000_create_users_table',1),
(15,'2014_10_12_100000_create_password_reset_tokens_table',1),
(16,'2019_08_19_000000_create_failed_jobs_table',1),
(17,'2019_12_14_000001_create_personal_access_tokens_table',1),
(18,'2023_11_12_174850_create_kategoris_table',1),
(19,'2023_11_15_173804_create_sub_akuns_table',1),
(20,'2023_11_15_173831_create_sub_sub_akuns_table',1),
(21,'2023_11_15_173939_create_akuns_table',1),
(22,'2023_11_16_012649_create_akun_child_table',1),
(23,'2023_11_16_205703_alter_user_table',1),
(24,'2023_11_18_054918_create_buku_besar_table',1),
(25,'2023_11_18_062026_create_buku_kecil_table',1),
(26,'2023_11_19_052659_alter_akun_table',1),
(27,'2014_10_12_100000_create_password_resets_table',2),
(28,'2024_01_20_103447_alter_buku_kecils_table_2',3),
(29,'2024_02_25_124917_create_seconds_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
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
  KEY `password_resets_email_index` (`email`)
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
-- Table structure for table `seconds`
--

DROP TABLE IF EXISTS `seconds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seconds` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_transaksi` datetime NOT NULL,
  `akun_id` int(11) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `nilai` decimal(20,2) NOT NULL,
  `pemasukan` decimal(20,2) DEFAULT NULL,
  `pengeluaran` decimal(20,2) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `edited_by` text NOT NULL DEFAULT '[]',
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seconds`
--

LOCK TABLES `seconds` WRITE;
/*!40000 ALTER TABLE `seconds` DISABLE KEYS */;
INSERT INTO `seconds` VALUES
(1,'2024-02-25 00:00:00',5,'Pemasukan',2000000.00,2000000.00,NULL,0,NULL,1,'[]',NULL,'2024-02-25 06:39:02','2024-02-25 06:39:02'),
(2,'2024-02-25 00:00:00',21,'Pemasukan',1000000.00,1000000.00,NULL,0,NULL,1,'[]',NULL,'2024-02-25 07:02:07','2024-02-25 07:02:07');
/*!40000 ALTER TABLE `seconds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_akuns`
--

DROP TABLE IF EXISTS `sub_akuns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_akuns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_akun` varchar(255) DEFAULT NULL,
  `nama_akun` varchar(255) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_akuns`
--

LOCK TABLES `sub_akuns` WRITE;
/*!40000 ALTER TABLE `sub_akuns` DISABLE KEYS */;
/*!40000 ALTER TABLE `sub_akuns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_sub_akuns`
--

DROP TABLE IF EXISTS `sub_sub_akuns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_sub_akuns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_akun` varchar(255) DEFAULT NULL,
  `nama_akun` varchar(255) DEFAULT NULL,
  `sub_akun_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_sub_akuns`
--

LOCK TABLES `sub_sub_akuns` WRITE;
/*!40000 ALTER TABLE `sub_sub_akuns` DISABLE KEYS */;
/*!40000 ALTER TABLE `sub_sub_akuns` ENABLE KEYS */;
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
  `role` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Admin','admin@finance.app',NULL,'$2y$10$7zfzSXCuMbCtvbLHP8Wr7uw4rBiIH9fLqsIjW0RjIpDdgyoPfZxRG',NULL,NULL,'2024-01-23 00:34:18',1,0),
(2,'Bendahara','bendahara@finance.app',NULL,'$2y$10$P.v/2y9bvgaQpoSBB32lIOkFhx1MRP6krbvLaYynW6u9n3wz012Ju',NULL,'2023-11-23 23:36:34','2023-12-04 17:51:44',2,0),
(3,'Bendahara 2','bendahara2@finance.app',NULL,'$2y$10$wMz55yydv.omsRlxrqFoVu5M8ZZqDximt6gJmeAyv1u6Jj0GdEIpm',NULL,'2023-11-24 17:59:31','2023-12-04 17:51:58',3,0),
(4,'direksi 121231313','direksi@finance.app',NULL,'$2y$10$pb2Yi42JXoDaNR774ouis.fc3RYJ1um3Z0u5UdLi9z4W2Gf8yT3Tu',NULL,'2023-11-24 18:10:50','2023-12-04 17:49:42',4,0),
(5,'Fulan','bendahara3@finance.app',NULL,'$2y$10$hCfSQg6E.Tr5K2z7gYKhbOkdnqmMaN/xixRKzTcVcY8arXE/.o7YC',NULL,'2023-11-26 00:19:16','2023-11-26 00:19:16',3,0),
(10,'adminsecond','adminsecond@finance.app',NULL,'$2y$10$dAQTTPLN073dPH3iwlfZseJ35Y3E35jktyygmsUv1.7FI3nnj8RnW',NULL,'2024-02-25 06:03:11','2024-02-25 06:03:11',5,0);
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

-- Dump completed on 2024-02-25 22:35:45
