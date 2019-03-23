/*
SQLyog Ultimate v11.5 (64 bit)
MySQL - 5.6.38 : Database - game
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`game` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `game`;

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `migration` */

insert  into `migration`(`version`,`apply_time`) values ('m000000_000000_base',1553274668),('m130524_201442_init',1553274672);

/*Table structure for table `result` */

DROP TABLE IF EXISTS `result`;

CREATE TABLE `result` (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT 'User',
  `sentence_id` int(11) DEFAULT NULL COMMENT 'Answer',
  `type` enum('win','lose') DEFAULT NULL,
  `is_block` int(11) DEFAULT NULL,
  PRIMARY KEY (`result_id`),
  KEY `user_id` (`user_id`),
  KEY `sentence_id` (`sentence_id`),
  CONSTRAINT `result_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `result_ibfk_2` FOREIGN KEY (`sentence_id`) REFERENCES `task_word` (`word_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `result` */

insert  into `result`(`result_id`,`user_id`,`sentence_id`,`type`,`is_block`) values (7,2,1,'win',0),(8,2,2,'win',0);

/*Table structure for table `task_sentence` */

DROP TABLE IF EXISTS `task_sentence`;

CREATE TABLE `task_sentence` (
  `sentence_id` int(11) NOT NULL AUTO_INCREMENT,
  `text_id` int(11) DEFAULT NULL COMMENT 'Text',
  `senctence` varchar(255) DEFAULT NULL,
  `is_block` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`sentence_id`),
  KEY `text_id` (`text_id`),
  CONSTRAINT `task_sentence_ibfk_1` FOREIGN KEY (`text_id`) REFERENCES `task_text` (`text_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `task_sentence` */

insert  into `task_sentence`(`sentence_id`,`text_id`,`senctence`,`is_block`) values (1,1,'Шла Саша по шоссе.',0),(2,1,'Такая-сякая сбежала из дворца.',0),(3,1,'Ну-с, так вот что !',0),(4,1,'Кто-то счастье ждет, кто то в сказку верит.',0),(5,1,'У старинушки три сына: старший - умный был детина, средний сын и так и сяк, младший - вовсе был дурак.',0),(6,1,'Два на два будет пять ?',0);

/*Table structure for table `task_text` */

DROP TABLE IF EXISTS `task_text`;

CREATE TABLE `task_text` (
  `text_id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text,
  `is_block` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`text_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `task_text` */

insert  into `task_text`(`text_id`,`text`,`is_block`,`created_at`,`created_by`) values (1,'Шла Саша по шоссе. Такая-сякая сбежала из дворца. Ну-с, так вот что ! Кто-то счастье ждет, кто то в сказку верит. У старинушки три сына: старший - умный был детина, средний сын и так и сяк, младший - вовсе был дурак. Два на два будет пять ?',0,'2019-03-23 12:07:55',4);

/*Table structure for table `task_word` */

DROP TABLE IF EXISTS `task_word`;

CREATE TABLE `task_word` (
  `word_id` int(11) NOT NULL AUTO_INCREMENT,
  `sentence_id` int(11) DEFAULT NULL COMMENT 'Sentence',
  `word` varchar(100) DEFAULT NULL,
  `is_block` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`word_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

/*Data for the table `task_word` */

insert  into `task_word`(`word_id`,`sentence_id`,`word`,`is_block`) values (1,1,'Шла',0),(2,1,'Саша',0),(3,1,'по',0),(4,1,'шоссе.',0),(5,1,'',0),(6,2,'Такая-сякая',0),(7,2,'сбежала',0),(8,2,'из',0),(9,2,'дворца.',0),(10,2,'',0),(11,3,'Ну-с,',0),(12,3,'так',0),(13,3,'вот',0),(14,3,'что',0),(15,3,'!',0),(16,3,'',0),(17,4,'Кто-то',0),(18,4,'счастье',0),(19,4,'ждет,',0),(20,4,'кто',0),(21,4,'то',0),(22,4,'в',0),(23,4,'сказку',0),(24,4,'верит.',0),(25,4,'',0),(26,5,'У',0),(27,5,'старинушки',0),(28,5,'три',0),(29,5,'сына:',0),(30,5,'старший',0),(31,5,'-',0),(32,5,'умный',0),(33,5,'был',0),(34,5,'детина,',0),(35,5,'средний',0),(36,5,'сын',0),(37,5,'и',0),(38,5,'так',0),(39,5,'и',0),(40,5,'сяк,',0),(41,5,'младший',0),(42,5,'-',0),(43,5,'вовсе',0),(44,5,'был',0),(45,5,'дурак.',0),(46,5,'',0),(47,6,'Два',0),(48,6,'на',0),(49,6,'два',0),(50,6,'будет',0),(51,6,'пять',0),(52,6,'?',0);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `type` enum('A','G') COLLATE utf8_unicode_ci DEFAULT 'G',
  PRIMARY KEY (`id`,`updated_at`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`created_at`,`updated_at`,`type`) values (2,'gamer1','3z1oKoje_Dfvxj4v5sPd5Q_q3I6IxD9a','$2y$13$EVb5I1pdtgo3CKml1vIbAO1M.z3GV8.PKWg12B7exGNLdmrhaSyDu',NULL,'gamer1@mail.ru',10,1553323985,1553323985,'G'),(3,'gamer2','qOPg7wTkvnon9xlz_ydEFhrjajscStRF','$2y$13$KVPgmtQhtgMcuFoB/LsECuIIEDy/B6QEQiJ/u1s1/Q/2rbVb5Ku/.',NULL,'gamer2@mail.ru',10,1553324011,1553324011,'G'),(4,'admin','c-05Wxdizr8c6s9cE84i-q7ROXDJ8_Iz','$2y$13$ZgtKfFkzaMBNNO4ggzNYO.gAjgRfVa.HvRQotSH94ePfyvQdXqNfe',NULL,'admin@mail.ru',10,1553324047,1553324047,'A');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
