-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Хост: mysql91.1gb.ru
-- Время создания: Окт 25 2015 г., 08:16
-- Версия сервера: 5.5.35-rel33.0-log
-- Версия PHP: 5.3.28

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `gb_x_prodaccc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `1_Emails`
--

CREATE TABLE IF NOT EXISTS `1_Emails` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `from` int(8) NOT NULL,
  `to` int(8) NOT NULL,
  `body` text NOT NULL,
  `type` int(1) NOT NULL,
  `dt` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE IF NOT EXISTS `2_Emails` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `from` int(8) NOT NULL,
  `to` int(8) NOT NULL,
  `body` text NOT NULL,
  `type` int(1) NOT NULL,
  `dt` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `3_Emails` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `from` int(8) NOT NULL,
  `to` int(8) NOT NULL,
  `body` text NOT NULL,
  `type` int(1) NOT NULL,
  `dt` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `4_Emails` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `from` int(8) NOT NULL,
  `to` int(8) NOT NULL,
  `body` text NOT NULL,
  `type` int(1) NOT NULL,
  `dt` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `Emails` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `from` int(8) NOT NULL,
  `to` int(8) NOT NULL,
  `body` text NOT NULL,
  `type` int(1) NOT NULL,
  `dt` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1 ;

