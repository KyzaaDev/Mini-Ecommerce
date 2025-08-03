-- MySQL dump 10.13  Distrib 8.0.42, for Linux (x86_64)
--
-- Host: localhost    Database: mecom
-- ------------------------------------------------------
-- Server version	8.0.42-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_product` varchar(100) DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `harga` varchar(100) DEFAULT NULL,
  `pic` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (2,'Mouse Gaming X7',20,'150000','mouse_x7.jpg'),(3,'Keyboard Mechanical RGB',15,'450000','keyboard_rgb.jpg'),(4,'Headset BassBoost',10,'325000','headset_bass.jpg'),(5,'Monitor 24 Inch IPS',5,'1800000','monitor_24ips.jpg'),(6,'Flashdisk 64GB',50,'85000','flashdisk64.jpg'),(7,'SSD 512GB NVMe',8,'950000','ssd_512.jpg'),(8,'Router WiFi 6',7,'670000','router_wifi6.jpg'),(9,'Webcam Full HD',12,'225000','webcam_hd.jpg'),(10,'Microphone Condenser',9,'390000','mic_cond.jpg'),(11,'Kipas RGB Casing',30,'75000','kipas_rgb.jpg'),(12,'VGA GTX 1660',2,'3400000','vga_gtx1660.jpg'),(13,'RAM DDR4 16GB',14,'720000','ram16gb.jpg'),(14,'Power Supply 550W',6,'480000','psu_550w.jpg'),(15,'Mousepad XXL',25,'95000','mousepad_xxl.jpg'),(16,'Laptop Stand Aluminium',11,'145000','laptop_stand.jpg');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'kyzaasec@gmail.com','admin','$2y$10$VDotXXwk9uuZmTN2UZpsSugg9X.ClTzAnfHwH1EqpKSfNwg8mlsxa'),(4,'max@dududu.com','ElGerobak','$2y$10$ItbYxwuw2mnvgoioqNCLhueVpxiGagSyK.FdW7sg0.sKQ4UIWvpJ6'),(6,'Ollie@bearman.com','Olman','$2y$10$epat0Byi7xPkceSuiQNO/uF.vvujuPiHovCcxlSDZ3JvOLnhWvMCa'),(7,'dzakyraufnurfhadillah@gmail.com','zakyneedmoney','$2y$10$ZBXWZ.t0mXVm1TRIK1CoFODfoMV0WsYgkIR8kkN1vfFZ8wjrzCzmC');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ratings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `rating` int NOT NULL CHECK (`rating` >= 1 AND `rating` <= 5),
  `review` text,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_product` (`user_id`, `product_id`),
  FOREIGN KEY (`product_id`) REFERENCES `product`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-24 19:37:58
