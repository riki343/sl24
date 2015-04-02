-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.21 - Source distribution
-- ОС Сервера:                   Linux
-- HeidiSQL Версия:              9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных sl24
CREATE DATABASE IF NOT EXISTS `sl24` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sl24`;


-- Дамп структуры для таблица sl24.employment_types
CREATE TABLE IF NOT EXISTS `employment_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы sl24.employment_types: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `employment_types` DISABLE KEYS */;
INSERT INTO `employment_types` (`id`, `label`, `color`) VALUES
	(1, 'Студент', 'gray'),
	(2, 'Працівник', 'gray'),
	(3, 'Високооплачуваний працівник', 'gray'),
	(4, 'Держслужбовець', 'gray'),
	(5, 'Дрібний підприємець', 'gray'),
	(6, 'Бізнесмен', 'gray');
/*!40000 ALTER TABLE `employment_types` ENABLE KEYS */;


-- Дамп структуры для таблица sl24.meetings
CREATE TABLE IF NOT EXISTS `meetings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) NOT NULL,
  `consultant_id` int(11) NOT NULL,
  `assistant_id` int(11) DEFAULT NULL,
  `employment_type` int(11) NOT NULL,
  `credentials` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `price` double NOT NULL,
  `years` int(11) NOT NULL,
  `progress` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `pay_date` date NOT NULL,
  `working_month_id` int(11) NOT NULL,
  `client_birthday` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_44FE52E26BF700BD` (`status_id`),
  KEY `IDX_44FE52E244F779A2` (`consultant_id`),
  KEY `IDX_44FE52E2E05387EF` (`assistant_id`),
  KEY `IDX_44FE52E2AA55F630` (`employment_type`),
  CONSTRAINT `FK_44FE52E244F779A2` FOREIGN KEY (`consultant_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_44FE52E26BF700BD` FOREIGN KEY (`status_id`) REFERENCES `meeting_statuses` (`id`),
  CONSTRAINT `FK_44FE52E2AA55F630` FOREIGN KEY (`employment_type`) REFERENCES `employment_types` (`id`),
  CONSTRAINT `FK_44FE52E2E05387EF` FOREIGN KEY (`assistant_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы sl24.meetings: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `meetings` DISABLE KEYS */;
INSERT INTO `meetings` (`id`, `status_id`, `consultant_id`, `assistant_id`, `employment_type`, `credentials`, `date`, `price`, `years`, `progress`, `age`, `pay_date`, `working_month_id`, `client_birthday`) VALUES
	(5, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(7, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(8, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(9, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(10, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(11, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(12, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(13, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(14, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(15, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(16, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(17, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(18, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(19, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(20, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(21, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(22, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(23, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(24, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(25, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(26, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(27, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(28, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(29, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(30, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(31, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(32, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(33, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(34, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(35, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(36, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(37, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(38, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(39, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(40, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(41, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(42, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(43, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(44, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(45, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(46, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(47, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(48, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(49, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(50, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(51, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(52, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(53, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(54, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(55, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(56, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(57, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(58, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(59, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(60, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(61, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(62, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(63, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(64, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(65, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(66, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(67, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(68, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(69, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(70, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(71, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(72, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(73, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(74, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(75, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(76, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(77, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(78, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(79, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(80, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(81, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01'),
	(82, 2, 1, NULL, 1, 'Лозан В.В.', '2015-04-01 15:22:02', 5000, 30, 100, 20, '2015-04-01', 0, '1995-01-01');
/*!40000 ALTER TABLE `meetings` ENABLE KEYS */;


-- Дамп структуры для таблица sl24.meeting_statuses
CREATE TABLE IF NOT EXISTS `meeting_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы sl24.meeting_statuses: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `meeting_statuses` DISABLE KEYS */;
INSERT INTO `meeting_statuses` (`id`, `label`, `color`) VALUES
	(1, 'Назначена', ''),
	(2, 'Так', ''),
	(3, 'Можливо', ''),
	(4, 'Ні', '');
/*!40000 ALTER TABLE `meeting_statuses` ENABLE KEYS */;


-- Дамп структуры для таблица sl24.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы sl24.roles: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`) VALUES
	(1, 'ROLE_ADMIN'),
	(2, 'ROLE_USER');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Дамп структуры для таблица sl24.seminars
CREATE TABLE IF NOT EXISTS `seminars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `credentials` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы sl24.seminars: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `seminars` DISABLE KEYS */;
/*!40000 ALTER TABLE `seminars` ENABLE KEYS */;


-- Дамп структуры для таблица sl24.tasks
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `assigned_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_505865976BF700BD` (`status_id`),
  KEY `IDX_505865977E3C61F9` (`owner_id`),
  KEY `IDX_50586597E1501A05` (`assigned_id`),
  CONSTRAINT `FK_505865976BF700BD` FOREIGN KEY (`status_id`) REFERENCES `task_statuses` (`id`),
  CONSTRAINT `FK_505865977E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_50586597E1501A05` FOREIGN KEY (`assigned_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы sl24.tasks: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;


-- Дамп структуры для таблица sl24.task_statuses
CREATE TABLE IF NOT EXISTS `task_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы sl24.task_statuses: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `task_statuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `task_statuses` ENABLE KEYS */;


-- Дамп структуры для таблица sl24.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `registered` datetime NOT NULL,
  `lastactive` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `sl_number` int(11) NOT NULL,
  `deal_date` date NOT NULL,
  `first_seminar` date NOT NULL,
  `score` int(11) NOT NULL,
  `team_score` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `parker` tinyint(1) NOT NULL,
  `diary` tinyint(1) NOT NULL,
  `cufflinks` tinyint(1) NOT NULL,
  `watches` tinyint(1) NOT NULL,
  `director_number` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`),
  KEY `IDX_1483A5E9727ACA70` (`parent_id`),
  CONSTRAINT `FK_1483A5E9727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы sl24.users: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `surname`, `registered`, `lastactive`, `active`, `avatar`, `parent_id`, `sl_number`, `deal_date`, `first_seminar`, `score`, `team_score`, `level`, `parker`, `diary`, `cufflinks`, `watches`, `director_number`) VALUES
	(1, 'sl24', '2e6401531190d2c9ea5a91d4a16ed8ee026419d3703ee00f70defeae0416d2645b8bddb4d9a87fc8d6c5c812a0157bf59cab49b56b62aaed35a065637f509a6c', 'admin@sl24.com.ua', 'Admin', 'Admin', '2015-03-30 15:02:38', '2015-03-30 15:02:54', 0, NULL, NULL, 0, '0000-00-00', '0000-00-00', 0, '', 0, 0, 0, 0, 0, 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Дамп структуры для таблица sl24.user_role
CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_2DE8C6A3A76ED395` (`user_id`),
  KEY `IDX_2DE8C6A3D60322AC` (`role_id`),
  CONSTRAINT `FK_2DE8C6A3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_2DE8C6A3D60322AC` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы sl24.user_role: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
	(1, 1),
	(1, 2);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;


-- Дамп структуры для таблица sl24.working_months
CREATE TABLE IF NOT EXISTS `working_months` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы sl24.working_months: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `working_months` DISABLE KEYS */;
/*!40000 ALTER TABLE `working_months` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
