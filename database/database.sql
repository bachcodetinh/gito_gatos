-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               13.0.2-MariaDB - MariaDB Server
-- Server OS:                    Win64
-- HeidiSQL Version:             12.20.0.7320
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for about
CREATE DATABASE IF NOT EXISTS `about` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci */;
USE `about`;

-- Dumping structure for table about.contributions
CREATE TABLE IF NOT EXISTS `contributions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(10) NOT NULL,
  `project_part` int(11) NOT NULL,
  `project_contributions` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `1` FOREIGN KEY (`student_id`) REFERENCES `members` (`student_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Dumping data for table about.contributions: ~3 rows (approximately)
INSERT INTO `contributions` (`id`, `student_id`, `project_part`, `project_contributions`) VALUES
	(1, '106913104', 1, 'Developed home and about page, made the first prototype for nav bar and footer.'),
	(2, '106913256', 1, 'Coordinated team agendas, designed the theme of our website, developed jobs page, made the second prototype of nav bar.'),
	(3, '106913544', 1, 'Set up central Git repository protocols and handle merging, designed the theme of our website, developed apply page, made the final version of nav bar and footer by mixing the first and second prototype versions.');

-- Dumping structure for table about.members
CREATE TABLE IF NOT EXISTS `members` (
  `student_id` varchar(10) NOT NULL,
  `member_name` varchar(100) NOT NULL,
  `role` varchar(150) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Dumping data for table about.members: ~3 rows (approximately)
INSERT INTO `members` (`student_id`, `member_name`, `role`) VALUES
	('106913104', 'Nguyễn Hoàng Đăng Dương', 'Developer'),
	('106913256', 'Bùi Thuỵ Yến Ngân', 'Project Manager (Scrum Master), Developer, UI/UX co-designer'),
	('106913544', 'Lê Bá Cao Minh', 'Tech Lead (Git Master), Developer, UI/UX co-designer');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
