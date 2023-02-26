-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: sync_music
-- ------------------------------------------------------
-- Server version	8.0.27

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
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `Labelle` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Date` date NOT NULL,
  `User` int NOT NULL,
  KEY `logs_FK` (`User`),
  CONSTRAINT `logs_FK` FOREIGN KEY (`User`) REFERENCES `users` (`IdUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES ('Conexion de l\'utilisateur','2023-02-21',1),('Tentative de conexion de l\'utilisateur','2023-02-22',1),('Conexion de l\'utilisateur','2023-02-22',1),('Conexion de l\'utilisateur','2023-02-24',2),('Conexion de l\'utilisateur','2023-02-24',2),('Conexion de l\'utilisateur','2023-02-24',2),('Conexion de l\'utilisateur','2023-02-24',2),('Tentative de conexion de l\'utilisateur','2023-02-24',2),('Conexion de l\'utilisateur','2023-02-24',2),('Conexion de l\'utilisateur','2023-02-24',2),('Conexion de l\'utilisateur','2023-02-24',2),('Conexion de l\'utilisateur','2023-02-24',1),('Conexion de l\'utilisateur','2023-02-24',1),('Conexion de l\'utilisateur','2023-02-24',2),('Conexion de l\'utilisateur','2023-02-25',1),('Conexion de l\'utilisateur','2023-02-25',2);
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `music`
--

DROP TABLE IF EXISTS `music`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `music` (
  `idMusic` int NOT NULL AUTO_INCREMENT,
  `Labelle` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`idMusic`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `music`
--

LOCK TABLES `music` WRITE;
/*!40000 ALTER TABLE `music` DISABLE KEYS */;
INSERT INTO `music` VALUES (1,'1000K - Keny Bennett, JAKE B, ACHPRODD - Unknown.mp3','2023-02-22'),(2,'B E 2N E 2T - Keny Bennett, VINTAGEMAN - Unknown.mp3','2023-02-22');
/*!40000 ALTER TABLE `music` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `play`
--

DROP TABLE IF EXISTS `play`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `play` (
  `idMusic` int NOT NULL,
  `idPlaylist` int NOT NULL,
  `IdUser` int NOT NULL,
  PRIMARY KEY (`IdUser`),
  KEY `play_FK` (`idMusic`),
  KEY `play_FK_1` (`idPlaylist`),
  CONSTRAINT `play_FK` FOREIGN KEY (`idMusic`) REFERENCES `music` (`idMusic`),
  CONSTRAINT `play_FK_1` FOREIGN KEY (`idPlaylist`) REFERENCES `playlist` (`idPlaylist`),
  CONSTRAINT `play_FK_2` FOREIGN KEY (`IdUser`) REFERENCES `users` (`IdUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `play`
--

LOCK TABLES `play` WRITE;
/*!40000 ALTER TABLE `play` DISABLE KEYS */;
/*!40000 ALTER TABLE `play` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playlist`
--

DROP TABLE IF EXISTS `playlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `playlist` (
  `idPlaylist` int NOT NULL AUTO_INCREMENT,
  `Labelle` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `User` int NOT NULL,
  PRIMARY KEY (`idPlaylist`),
  KEY `playlist_FK` (`User`),
  CONSTRAINT `playlist_FK` FOREIGN KEY (`User`) REFERENCES `users` (`IdUser`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playlist`
--

LOCK TABLES `playlist` WRITE;
/*!40000 ALTER TABLE `playlist` DISABLE KEYS */;
INSERT INTO `playlist` VALUES (1,'Maxens',1),(2,'test',1),(6,'florine_playliste',2);
/*!40000 ALTER TABLE `playlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playlist_x_music`
--

DROP TABLE IF EXISTS `playlist_x_music`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `playlist_x_music` (
  `idPlaylist` int NOT NULL,
  `idMusic` int NOT NULL,
  PRIMARY KEY (`idPlaylist`,`idMusic`),
  KEY `playlist_x_music_FK` (`idMusic`),
  CONSTRAINT `playlist_x_music_FK` FOREIGN KEY (`idMusic`) REFERENCES `music` (`idMusic`),
  CONSTRAINT `playlist_x_music_FK_1` FOREIGN KEY (`idPlaylist`) REFERENCES `playlist` (`idPlaylist`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playlist_x_music`
--

LOCK TABLES `playlist_x_music` WRITE;
/*!40000 ALTER TABLE `playlist_x_music` DISABLE KEYS */;
INSERT INTO `playlist_x_music` VALUES (1,1),(1,2),(2,2);
/*!40000 ALTER TABLE `playlist_x_music` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `idRole` int NOT NULL,
  `Label` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idRole`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Admin'),(2,'Moderateur'),(3,'visiteur');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `IdUser` int NOT NULL AUTO_INCREMENT,
  `Login` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `MDP` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `derniere` date DEFAULT NULL,
  `role` int DEFAULT NULL,
  PRIMARY KEY (`IdUser`),
  KEY `users_FK` (`role`),
  CONSTRAINT `users_FK` FOREIGN KEY (`role`) REFERENCES `role` (`idRole`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'maxens','$argon2id$v=19$m=65536,t=4,p=1$am16MUJiV2I4eGpJUUlleg$NXHwGf0N+tCAmboy6wMtc6uf8C6f+A89JpDtDBazmWw','2023-02-21',1),(2,'florine','$argon2id$v=19$m=65536,t=4,p=1$am16MUJiV2I4eGpJUUlleg$NXHwGf0N+tCAmboy6wMtc6uf8C6f+A89JpDtDBazmWw','2023-02-24',2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'sync_music'
--

--
-- Dumping routines for database 'sync_music'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-02-26 13:57:30
