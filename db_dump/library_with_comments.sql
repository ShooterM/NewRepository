-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Фев 14 2014 г., 13:19
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `library`
--
CREATE DATABASE `library` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `library`;

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `birth_date` date NOT NULL,
  `death_date` date DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT, -- просто id
  `author_id` int(11) NOT NULL,
  `title_id` int(11) NOT NULL, -- title не потрібно виносити в окрему таблицю
  `year` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `page_count` int(11) NOT NULL,
  `receipt_date` date NOT NULL,
  `genre_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `country_id` int(11) NOT NULL DEFAULT '0', -- просто id
  `country` varchar(20) NOT NULL,
  PRIMARY KEY (`country_id`),
  UNIQUE KEY `country` (`country`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `editors`
--

CREATE TABLE IF NOT EXISTS `editors` (
  `editor_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  PRIMARY KEY (`editor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(50) NOT NULL,
  PRIMARY KEY (`genre_id`),
  UNIQUE KEY `genre` (`genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `publishers`
--

CREATE TABLE IF NOT EXISTS `publishers` (
  `publisher_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `adress` varchar(80) NOT NULL, -- а ось адресу треба винести окремою таблицею і розбити на країна, місто, вулиця, дім, пошт. індекс
  `editor_id` int(11) NOT NULL,
  PRIMARY KEY (`publisher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `titles`
--

CREATE TABLE IF NOT EXISTS `titles` (
  `title_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`title_id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
