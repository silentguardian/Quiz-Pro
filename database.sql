SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `answers` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `user` mediumint(4) NOT NULL DEFAULT '0',
  `question` mediumint(4) NOT NULL DEFAULT '0',
  `option_s` varchar(4) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `questions` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `body` text NOT NULL,
  `option_a` text NOT NULL,
  `option_b` text NOT NULL,
  `option_c` text NOT NULL,
  `option_d` text NOT NULL,
  `answer` varchar(4) NOT NULL DEFAULT '',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `points` tinyint(4) NOT NULL DEFAULT '0',
  `random` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `user` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `username`, `password`, `admin`) VALUES
(1, 'ADMIN', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(2, 'TEAM1', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0),
(3, 'TEAM2', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0),
(4, 'TEAM3', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0),
(5, 'TEAM4', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0),
(6, 'TEAM5', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0),
(7, 'TEAM6', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0);

CREATE TABLE IF NOT EXISTS `variables` (
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
