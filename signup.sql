-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `signup` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `signup`;

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `name` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admin` (`name`, `password`) VALUES
('admin',	'123456');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `mail` text NOT NULL,
  `dob` text NOT NULL,
  `pass` text NOT NULL,
  `img` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `fname`, `lname`, `mail`, `dob`, `pass`, `img`) VALUES
(36,	'austin',	'jay',	'austin@gmail.com',	'2018-11-09',	'fcea920f7412b5da7be0cf42b8c93759',	'96661538947037.jpg'),
(37,	'John',	'Bosco',	'johnbosco@yahoo.com',	'2018-10-31',	'fcea920f7412b5da7be0cf42b8c93759',	'36781538991481.jpg'),
(39,	'john',	'uloko',	'uloko@gmail.com',	'2018-10-16',	'fcea920f7412b5da7be0cf42b8c93759',	'36111539173827.jpg'),
(40,	'jay',	'john',	'jay@gmail.com',	'2018-10-09',	'fcea920f7412b5da7be0cf42b8c93759',	'2701539259850.jpg'),
(41,	'bosco',	'john',	'bosco24@yahoo.com',	'2019-01-30',	'e10adc3949ba59abbe56e057f20f883e',	'52441548104626.jpg');

-- 2019-02-06 12:49:57
