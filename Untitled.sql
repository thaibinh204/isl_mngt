-- MySQL dump 10.13  Distrib 8.0.20, for macos10.15 (x86_64)
--
-- Host: localhost    Database: isl_mngt
-- ------------------------------------------------------
-- Server version	8.0.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `course_students`
--

DROP TABLE IF EXISTS `course_students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `students_id` int NOT NULL,
  `tuition_fees_id` int NOT NULL,
  `charged` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_course_students_students1_idx` (`students_id`),
  KEY `fk_course_students_tuition_fees1_idx` (`tuition_fees_id`),
  CONSTRAINT `fk_course_students_students1` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`),
  CONSTRAINT `fk_course_students_tuition_fees1` FOREIGN KEY (`tuition_fees_id`) REFERENCES `tuition_fees` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_students`
--

LOCK TABLES `course_students` WRITE;
/*!40000 ALTER TABLE `course_students` DISABLE KEYS */;
INSERT INTO `course_students` VALUES (1,1,1,4000),(2,2,1,4000);
/*!40000 ALTER TABLE `course_students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT 'コース名',
  `start_date` date NOT NULL COMMENT '開始日',
  `end_date` date DEFAULT NULL COMMENT '終了日',
  `estimate` double NOT NULL COMMENT '見積時間',
  `description` text COMMENT '備考',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '登録日付',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '変更日付',
  `hour_salary` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='コース';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'java','2020-05-18','2020-08-18',3,NULL,NULL,NULL,NULL),(2,'C#','2020-05-18','2020-08-18',3,NULL,NULL,'2020-05-31 20:46:19',NULL);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experiences`
--

DROP TABLE IF EXISTS `experiences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `experiences` (
  `id` int NOT NULL AUTO_INCREMENT,
  `skill_id` int NOT NULL COMMENT 'スキルID',
  `teacher_id` int NOT NULL COMMENT '講師ID',
  `year` int DEFAULT NULL COMMENT '年間',
  `month` int DEFAULT NULL COMMENT '月間',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '登録日付',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '変更日付',
  PRIMARY KEY (`id`),
  KEY `fk_table1_skills1_idx` (`skill_id`),
  KEY `fk_table1_teachers1_idx` (`teacher_id`),
  CONSTRAINT `fk_table1_skills1` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`),
  CONSTRAINT `fk_table1_teachers1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='スキル経験';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experiences`
--

LOCK TABLES `experiences` WRITE;
/*!40000 ALTER TABLE `experiences` DISABLE KEYS */;
/*!40000 ALTER TABLE `experiences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fee_status`
--

DROP TABLE IF EXISTS `fee_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fee_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tuition_fee_id` int NOT NULL,
  `student_quantity` int DEFAULT '0',
  `total_fee` int DEFAULT '0',
  `charged_fee` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tuition_fee_fk_idx` (`tuition_fee_id`),
  CONSTRAINT `tuition_fee_fk` FOREIGN KEY (`tuition_fee_id`) REFERENCES `tuition_fees` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fee_status`
--

LOCK TABLES `fee_status` WRITE;
/*!40000 ALTER TABLE `fee_status` DISABLE KEYS */;
INSERT INTO `fee_status` VALUES (20,1,2,180000,8000,NULL,NULL);
/*!40000 ALTER TABLE `fee_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule_status`
--

DROP TABLE IF EXISTS `schedule_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedule_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `schedule_id` int NOT NULL,
  `status` int NOT NULL COMMENT '1: continue\n2: change time\n3: change teacher\n4: cancel',
  `remark` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_schedules_schedules1_idx` (`schedule_id`),
  CONSTRAINT `fk_schedules_schedules1` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule_status`
--

LOCK TABLES `schedule_status` WRITE;
/*!40000 ALTER TABLE `schedule_status` DISABLE KEYS */;
INSERT INTO `schedule_status` VALUES (12,4,3,'change teacher','2020-06-25 19:41:33','2020-06-25 19:41:33'),(13,4,3,'change teacher','2020-06-25 19:41:52','2020-06-25 19:41:52'),(14,3,2,'Change time','2020-06-25 19:42:13','2020-06-25 19:42:13'),(15,3,2,'change date','2020-06-28 16:36:48','2020-06-28 16:36:48'),(16,1,3,'change teacher','2020-06-28 16:37:35','2020-06-28 16:37:35'),(17,1,2,'it\'s OK','2020-06-28 16:38:40','2020-06-28 16:38:40');
/*!40000 ALTER TABLE `schedule_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `start_time` timestamp NOT NULL COMMENT '開始日付',
  `end_time` timestamp NOT NULL COMMENT '終了日付',
  `duration` double DEFAULT NULL COMMENT '時間',
  `remark` text COMMENT '備考',
  `course_id` int NOT NULL COMMENT 'コースID',
  `teacher_id` int NOT NULL COMMENT '講師ID',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '登録日付',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '変更日付',
  PRIMARY KEY (`id`),
  KEY `fk_schedules_courses1_idx` (`course_id`),
  KEY `fk_schedules_teachers1_idx` (`teacher_id`),
  CONSTRAINT `fk_schedules_courses1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `fk_schedules_teachers1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='研修スケジュール';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedules`
--

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
INSERT INTO `schedules` VALUES (1,'2020-06-02 00:30:00','2020-06-02 05:30:00',3,NULL,1,1,NULL,'2020-06-28 16:38:40'),(2,'2020-06-02 11:00:00','2020-06-02 13:00:00',2,NULL,2,2,NULL,'2020-06-25 17:07:04'),(3,'2020-06-04 00:00:00','2020-06-04 04:30:00',3,NULL,1,1,NULL,'2020-06-28 16:36:48'),(4,'2020-06-18 00:00:00','2020-06-18 03:30:00',2,NULL,1,2,NULL,'2020-06-25 19:41:52'),(5,'2020-07-02 00:30:00','2020-07-02 05:30:00',5,NULL,1,1,NULL,'2020-06-28 16:38:40'),(6,'2020-07-02 11:00:00','2020-07-02 13:00:00',6,NULL,2,2,NULL,'2020-06-25 17:07:04'),(7,'2020-07-04 00:00:00','2020-07-04 04:30:00',5,NULL,1,1,NULL,'2020-06-28 16:36:48'),(8,'2020-07-18 00:00:00','2020-07-18 03:30:00',6,NULL,1,2,NULL,'2020-06-25 19:41:52');
/*!40000 ALTER TABLE `schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `skills` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skills`
--

LOCK TABLES `skills` WRITE;
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
INSERT INTO `skills` VALUES (2,'C#','2020-06-09 23:52:50','2020-06-09 23:52:50'),(3,'VB','2020-06-09 23:52:56','2020-06-09 23:52:56'),(4,'Java','2020-06-09 23:53:03','2020-06-09 23:53:03');
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL COMMENT '姓',
  `last_name` varchar(45) DEFAULT NULL COMMENT '名',
  `email` varchar(255) DEFAULT NULL COMMENT 'メール',
  `password` varchar(255) DEFAULT NULL COMMENT 'パスワード',
  `birthday` date DEFAULT NULL COMMENT '生年月日',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '登録日付',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '変更日付',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='生徒';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'Hai','Nguyen','ndhai.hai@gmail.com',NULL,'1993-12-04','2020-06-04 19:27:07','2020-06-04 19:27:07'),(2,'Hai2','Nguyen2','ndhai.hai@gmail.com',NULL,'1993-12-04','2020-06-04 19:27:07','2020-06-04 19:27:07'),(3,'Hai3','Nguyen3','ndhai.hai@gmail.com',NULL,'1993-12-04','2020-06-04 19:27:07','2020-06-04 19:27:07');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `study_types`
--

DROP TABLE IF EXISTS `study_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `study_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(45) NOT NULL COMMENT 'Online/Offline',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '登録日付',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '変更日付',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `study_types`
--

LOCK TABLES `study_types` WRITE;
/*!40000 ALTER TABLE `study_types` DISABLE KEYS */;
INSERT INTO `study_types` VALUES (1,'Online','2020-06-04 19:26:44','2020-06-04 19:49:04'),(2,'Offline','2020-06-04 19:49:12','2020-06-04 19:49:12');
/*!40000 ALTER TABLE `study_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teachers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL COMMENT '姓',
  `last_name` varchar(45) DEFAULT NULL COMMENT '名',
  `birthday` date DEFAULT NULL COMMENT '生年月日',
  `hour_salary` int DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL COMMENT 'メール',
  `password` varchar(255) DEFAULT NULL COMMENT 'パスワード',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '登録日付',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '変更日付',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='講師';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teachers`
--

LOCK TABLES `teachers` WRITE;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
INSERT INTO `teachers` VALUES (1,'Hai1','Nguuyen1','2020-04-03',2000,'aa@gmail.com','123',NULL,NULL),(2,'Hai2','Nguyen2','2020-04-03',4000,'gmail.com','123',NULL,NULL),(3,'Hai3','Nguyen3','2020-04-03',5500,'gmail.com','123',NULL,NULL);
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tuition_fees`
--

DROP TABLE IF EXISTS `tuition_fees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tuition_fees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `course_id` int NOT NULL COMMENT 'コースID',
  `study_type_id` int NOT NULL COMMENT '研修方法ID',
  `fee` int DEFAULT NULL COMMENT '学費',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '登録日付',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '変更日付',
  PRIMARY KEY (`id`),
  KEY `fk_fees_courses_idx` (`course_id`),
  KEY `fk_fees_study_types1_idx` (`study_type_id`),
  CONSTRAINT `fk_fees_courses` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `fk_fees_study_types1` FOREIGN KEY (`study_type_id`) REFERENCES `study_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='学費';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tuition_fees`
--

LOCK TABLES `tuition_fees` WRITE;
/*!40000 ALTER TABLE `tuition_fees` DISABLE KEYS */;
INSERT INTO `tuition_fees` VALUES (1,1,1,90000,'2020-06-04 19:27:25','2020-06-04 19:27:25'),(2,1,2,80000,'2020-06-04 19:49:31','2020-06-04 19:49:31');
/*!40000 ALTER TABLE `tuition_fees` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-20 21:38:02
