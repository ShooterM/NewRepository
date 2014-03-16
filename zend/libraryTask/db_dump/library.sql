-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 16 2014 г., 11:11
-- Версия сервера: 5.5.23
-- Версия PHP: 5.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `library`
--

-- --------------------------------------------------------

--
-- Структура таблицы `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `city` varchar(20) NOT NULL,
  `street` varchar(20) NOT NULL,
  `home` varchar(20) NOT NULL,
  `post_index` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Дамп данных таблицы `addresses`
--

INSERT INTO `addresses` (`id`, `country_id`, `city`, `street`, `home`, `post_index`) VALUES
(1, 10, 'Boston', 'Street of Glory', '16', 102530),
(2, 1, 'Chernivtsi', 'Ruska street', '286', 58040),
(31, 8, 'Kyiv', 'Small', '250', 598712);

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `birth_date` date NOT NULL,
  `death_date` date DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `name`, `surname`, `birth_date`, `death_date`, `country_id`) VALUES
(1, 'Misha', 'Boichuk', '2000-04-17', NULL, 3),
(2, 'Arthur', 'Savchuk', '2010-05-24', NULL, 12),
(6, 'Jagudryl', 'Vsevolodovich', '2014-03-02', NULL, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `year` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `page_count` int(11) NOT NULL,
  `receipt_date` date NOT NULL,
  `genre_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `author_id`, `title`, `year`, `publisher_id`, `page_count`, `receipt_date`, `genre_id`) VALUES
(1, 1, 'The Kolobok', 1992, 1, 380, '2014-02-17', 3),
(2, 2, 'Chicken Ryaba', 1996, 1, 500, '2014-02-11', 1),
(3, 3, 'The straw bull', 1992, 3, 643, '2014-02-02', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `country` (`country`),
  UNIQUE KEY `country_2` (`country`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`id`, `country`) VALUES
(8, 'China'),
(5, 'Czech Republic'),
(4, 'France'),
(7, 'Germany'),
(3, 'Great Britain'),
(9, 'Japan'),
(6, 'Libya'),
(11, 'Moldova'),
(13, 'Olosh'),
(2, 'Russia'),
(1, 'Ukraine'),
(10, 'USA');

-- --------------------------------------------------------

--
-- Структура таблицы `editors`
--

CREATE TABLE IF NOT EXISTS `editors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `editors`
--

INSERT INTO `editors` (`id`, `name`, `surname`) VALUES
(1, 'Lena', 'Golovach'),
(2, 'Ivpatiy', 'Kholovrat'),
(4, 'Jagudryl', 'Vsevolodovich');

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `genre` (`genre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `genre`) VALUES
(4, 'Fable'),
(5, 'Horror'),
(1, 'Novel'),
(2, 'Poem'),
(3, 'Story');

-- --------------------------------------------------------

--
-- Структура таблицы `guestbook`
--

CREATE TABLE IF NOT EXISTS `guestbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(32) NOT NULL DEFAULT 'noemail@example.com',
  `comment` text,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `guestbook`
--

INSERT INTO `guestbook` (`id`, `email`, `comment`, `created`) VALUES
(1, 'shooter@mail.ru', 'It'' my first comment :)', '2014-03-12 19:01:19'),
(2, 'misha@gmail.com', 'The second commit', '2014-03-12 20:02:23'),
(3, 'ololo@mail.ru', 'It is my third comment!', '2014-03-12 21:28:15');

-- --------------------------------------------------------

--
-- Структура таблицы `publishers`
--

CREATE TABLE IF NOT EXISTS `publishers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pub_name` varchar(50) NOT NULL,
  `address` int(11) NOT NULL,
  `editor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `publishers`
--

INSERT INTO `publishers` (`id`, `pub_name`, `address`, `editor_id`) VALUES
(1, 'Sunrise', 1, 1),
(2, 'School', 2, 2),
(3, 'Unknown publisher', 1, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
