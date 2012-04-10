# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.1.44)
# Database: yii_press
# Generation Time: 2012-04-10 04:23:42 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table observation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `observation`;

CREATE TABLE `observation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `teacher_id` int(11) unsigned DEFAULT NULL,
  `rubric_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`teacher_id`,`rubric_id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `rubric_id` (`rubric_id`),
  CONSTRAINT `observation_ibfk_3` FOREIGN KEY (`rubric_id`) REFERENCES `rubric` (`id`),
  CONSTRAINT `observation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `observation_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table observation_meta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `observation_meta`;

CREATE TABLE `observation_meta` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `observation_id` int(11) unsigned DEFAULT NULL,
  `rubric_meta_id` int(11) unsigned DEFAULT NULL,
  `meta_value` text,
  PRIMARY KEY (`id`),
  KEY `observation_id` (`observation_id`,`rubric_meta_id`),
  KEY `rubric_meta_id` (`rubric_meta_id`),
  CONSTRAINT `observation_meta_ibfk_2` FOREIGN KEY (`rubric_meta_id`) REFERENCES `rubric_meta` (`id`),
  CONSTRAINT `observation_meta_ibfk_1` FOREIGN KEY (`observation_id`) REFERENCES `observation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table rubric
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rubric`;

CREATE TABLE `rubric` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `rubric_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `rubric` WRITE;
/*!40000 ALTER TABLE `rubric` DISABLE KEYS */;

INSERT INTO `rubric` (`id`, `user_id`, `title`)
VALUES
	(1,1,'Foo'),
	(2,2,'mendelson');

/*!40000 ALTER TABLE `rubric` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table rubric_meta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rubric_meta`;

CREATE TABLE `rubric_meta` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rubric_id` int(11) unsigned DEFAULT NULL,
  `item_label` text,
  `item_type` int(11) unsigned DEFAULT '0',
  `position` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `rubric_id` (`rubric_id`),
  CONSTRAINT `rubric_meta_ibfk_1` FOREIGN KEY (`rubric_id`) REFERENCES `rubric` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `rubric_meta` WRITE;
/*!40000 ALTER TABLE `rubric_meta` DISABLE KEYS */;

INSERT INTO `rubric_meta` (`id`, `rubric_id`, `item_label`, `item_type`, `position`)
VALUES
	(1,1,'asdf',1,0);

/*!40000 ALTER TABLE `rubric_meta` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table teacher
# ------------------------------------------------------------

DROP TABLE IF EXISTS `teacher`;

CREATE TABLE `teacher` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `teacher` WRITE;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;

INSERT INTO `teacher` (`id`, `user_id`, `first_name`, `last_name`)
VALUES
	(1,1,'Gordon','Haas'),
	(2,1,'asdf','asdf');

/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_meta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_meta`;

CREATE TABLE `user_meta` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `meta_key` varchar(11) DEFAULT NULL,
  `meta_value` text,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_meta_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(40) DEFAULT '',
  `email` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `activation_key` varchar(40) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `password`, `email`, `first_name`, `last_name`, `display_name`, `activation_key`, `status`)
VALUES
	(1,'demo','dead17762a55dce0c86e183dc398296447ff9916','john.ciacia@gmail.com','john','ciacia','John Ciacia','23xe93ksl',1),
	(2,'admin','dead17762a55dce0c86e183dc398296447ff9916','john@voceconnect.com','jim','bean','Jim Bean','293kak3',1);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
