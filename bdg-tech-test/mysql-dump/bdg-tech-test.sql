-- -------------------------------------------------------------
-- TablePlus 4.0.0(370)
--
-- https://tableplus.com/
--
-- Database: bdg-tech-test
-- Generation Time: 2021-07-21 18:14:19.7860
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `line1` varchar(255) NOT NULL,
  `line2` varchar(255) DEFAULT NULL,
  `line3` varchar(255) DEFAULT NULL,
  `town` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `user_addresses`;
CREATE TABLE `user_addresses` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `address_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `addresses` (`id`, `line1`, `line2`, `town`, `postcode`, `updated_at`, `created_at`) VALUES
(1, '100', 'Pipard', 'Milton Keynes', 'MK14 5DF', NULL, '2021-07-10 15:51:45'),
(2, '120', 'Pipard', 'Milton Keynes', 'MK14 5DF', NULL, '2021-07-11 15:51:45'),
(3, '140', 'Pipard', 'Milton Keynes', 'MK14 5DF', NULL, '2021-07-12 15:51:45'),
(4, '200', 'Pipard', 'Milton Keynes', 'MK14 5DF', NULL, '2021-07-13 15:51:45'),
(5, '220', 'Pipard', 'Milton Keynes', 'MK14 5DF', NULL, '2021-07-14 15:51:45'),
(6, '240', 'Pipard', 'Milton Keynes', 'MK14 5DF', NULL, '2021-07-15 15:51:45'),
(7, '300', 'Middleton', 'Milton Keynes', 'MK12 5AB', NULL, '2021-07-16 15:51:45'),
(8, '320', 'Middleton', 'Milton Keynes', 'MK12 5AB', NULL, '2021-07-17 15:51:45'),
(9, '340', 'Middleton', 'Milton Keynes', 'MK12 5AB', NULL, '2021-07-18 15:51:45'),
(10, '360', 'Middleton', 'Milton Keynes', 'MK12 5AB', NULL, '2021-07-19 15:51:45');

INSERT INTO `user_addresses` (`id`, `user_id`, `address_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(4, 1, 3),
(5, 1, 4),
(6, 2, 1),
(7, 2, 3),
(8, 1, 10),
(9, 1, 9),
(10, 1, 8);

INSERT INTO `users` (`id`, `username`, `title`, `firstname`, `surname`, `updated_at`, `created_at`) VALUES
(1, 'Steve', 'Mr', 'Steve', 'Jones', NULL, '2021-07-21 08:29:01'),
(2, 'Amy313', 'Miss', 'Amy', 'Vaughan', NULL, '2021-07-21 15:48:51'),
(3, 'Ben838', 'Mr', 'Ben', 'Affleck', NULL, '2021-07-21 15:49:01');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;