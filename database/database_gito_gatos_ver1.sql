-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 19, 2026 at 08:24 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_gito_gatos`
--
CREATE DATABASE IF NOT EXISTS `database_gito_gatos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `database_gito_gatos`;

-- --------------------------------------------------------

--
-- Table structure for table `contributions`
--

DROP TABLE IF EXISTS `contributions`;
CREATE TABLE `contributions` (
  `id` int(11) NOT NULL,
  `student_id` varchar(10) NOT NULL,
  `project_part` int(11) NOT NULL,
  `project_contributions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contributions`
--

INSERT INTO `contributions` (`id`, `student_id`, `project_part`, `project_contributions`) VALUES
(1, '106913104', 1, 'Developed home and about page, made the first prototype for nav bar and footer.'),
(2, '106913256', 1, 'Coordinated team agendas, designed the theme of our website, developed jobs page, made the second prototype of nav bar.'),
(3, '106913544', 1, 'Set up central Git repository protocols and handle merging, designed the theme of our website, developed apply page, made the final version of nav bar and footer by mixing the first and second prototype versions.');

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

DROP TABLE IF EXISTS `eoi`;
CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `job_ref` varchar(5) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(15) NOT NULL,
  `street_address` varchar(40) NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `state` enum('VIC','NSW','QLD','NT','WA','SA','TAS','ACT') NOT NULL,
  `postcode` char(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `other_skills` text DEFAULT NULL,
  `status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `job_ref` char(5) NOT NULL,
  `title` varchar(50) NOT NULL,
  `salary` decimal(8,2) NOT NULL,
  `reporting_to` varchar(100) NOT NULL,
  `job_level` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `responsibilities` text NOT NULL,
  `essential_requirements` text NOT NULL,
  `preferable_requirements` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_ref`, `title`, `salary`, `reporting_to`, `job_level`, `description`, `responsibilities`, `essential_requirements`, `preferable_requirements`) VALUES
('FED01', 'Front-End Developer', 3500.00, 'Technical Lead', 'Senior', 'We are looking for a Front-End Developer to build interactive, responsive websites for our diverse client projects.', 'Develop user interface features using HTML5, CSS3 and JavaScript.|Collaborate closely with the design team to translate graphic designs into actual web interfaces.|Optimize websites to ensure fast loading times and the best possible user experience.', '5+ years of experience.|Proficient in HTML, CSS, and pure JavaScript.|Has practical experience with Responsive Web Design (works well on all devices).|Strong problem-solving and teamwork skills.', 'Has basic knowledge of search engine optimization (SEO).|Has experience using Git and GitHub for source code management.'),
('UID02', 'UI Designer', 3200.00, 'Creative Director', 'Senior', 'Join our creative team to design visually appealing, interactive, and intuitive interfaces for our web and digital products.', 'Collaborate with UX designers and product teams to translate wireframes and user flows into high-fidelity visual designs.|Create high-quality mockups, interactive prototypes, and maintain design systems/style guides for web projects.|Design and refine visual interface components such as menus, tabs, icons, and widgets, ensuring visual consistency across all screens.', '5+ years of experience.|Proven experience in UI design with a strong portfolio demonstrating web design, aesthetics, and visual skills.|Proficient in design software such as Figma, Adobe XD or Sketch.|Deep understanding of visual design principles (including typography, color theory, layout, and grid systems).', 'Has basic knowledge of implementing HTML5 and CSS3 from designs.|Has experience working in an agency environment, which is a significant advantage.');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `student_id` varchar(10) NOT NULL,
  `member_name` varchar(100) NOT NULL,
  `role` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`student_id`, `member_name`, `role`) VALUES
('106913104', 'Nguyễn Hoàng Đăng Dương', 'Developer'),
('106913256', 'Bùi Thuỵ Yến Ngân', 'Project Manager (Scrum Master), Developer, UI/UX co-designer'),
('106913544', 'Lê Bá Cao Minh', 'Tech Lead (Git Master), Developer, UI/UX co-designer');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contributions`
--
ALTER TABLE `contributions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_ref`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contributions`
--
ALTER TABLE `contributions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contributions`
--
ALTER TABLE `contributions`
  ADD CONSTRAINT `1` FOREIGN KEY (`student_id`) REFERENCES `members` (`student_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
