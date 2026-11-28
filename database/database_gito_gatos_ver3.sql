-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 28, 2026 at 03:32 AM
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
  `job_ref` char(5) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(15) NOT NULL,
  `street_address` varchar(40) NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `state` enum('VIC','NSW','QLD','NT','WA','SA','TAS','ACT') NOT NULL,
  `postcode` char(4) NOT NULL,
  `email` varchar(254) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `other_skills` text DEFAULT NULL,
  `status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eoi_skills`
--

DROP TABLE IF EXISTS `eoi_skills`;
CREATE TABLE `eoi_skills` (
  `EOInumber` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL
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
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_ref`, `title`, `salary`, `reporting_to`, `job_level`, `description`) VALUES
('FED01', 'Front-End Developer', 3500.00, 'Technical Lead', 'Senior', 'We are looking for a Front-End Developer to build interactive, responsive websites for our diverse client projects.'),
('UID02', 'UI Designer', 3200.00, 'Creative Director', 'Senior', 'Join our creative team to design visually appealing, interactive, and intuitive interfaces for our web and digital products.');

-- --------------------------------------------------------

--
-- Table structure for table `job_requirements`
--

DROP TABLE IF EXISTS `job_requirements`;
CREATE TABLE `job_requirements` (
  `id` int(11) NOT NULL,
  `job_ref` char(5) NOT NULL,
  `type` enum('essential','preferable') NOT NULL,
  `requirement` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_requirements`
--

INSERT INTO `job_requirements` (`id`, `job_ref`, `type`, `requirement`) VALUES
(1, 'FED01', 'essential', '5+ years of experience.'),
(2, 'FED01', 'essential', 'Proficient in HTML, CSS, and pure JavaScript.'),
(3, 'FED01', 'essential', 'Has practical experience with Responsive Web Design (works well on all devices).'),
(4, 'FED01', 'essential', 'Strong problem-solving and teamwork skills.'),
(5, 'FED01', 'preferable', 'Has basic knowledge of search engine optimization (SEO).'),
(6, 'FED01', 'preferable', 'Has experience using Git and GitHub for source code management.'),
(7, 'UID02', 'essential', '5+ years of experience.'),
(8, 'UID02', 'essential', 'Proven experience in UI design with a strong portfolio demonstrating web design, aesthetics, and visual skills.'),
(9, 'UID02', 'essential', 'Proficient in design software such as Figma, Adobe XD or Sketch.'),
(10, 'UID02', 'essential', 'Deep understanding of visual design principles (including typography, color theory, layout, and grid systems).'),
(11, 'UID02', 'preferable', 'Has basic knowledge of implementing HTML5 and CSS3 from designs.'),
(12, 'UID02', 'preferable', 'Has experience working in an agency environment, which is a significant advantage.');

-- --------------------------------------------------------

--
-- Table structure for table `job_responsibilities`
--

DROP TABLE IF EXISTS `job_responsibilities`;
CREATE TABLE `job_responsibilities` (
  `id` int(11) NOT NULL,
  `job_ref` char(5) NOT NULL,
  `responsibility` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_responsibilities`
--

INSERT INTO `job_responsibilities` (`id`, `job_ref`, `responsibility`) VALUES
(1, 'FED01', 'Develop user interface features using HTML5, CSS3 and JavaScript.'),
(2, 'FED01', 'Collaborate closely with the design team to translate graphic designs into actual web interfaces.'),
(3, 'FED01', 'Optimize websites to ensure fast loading times and the best possible user experience.'),
(4, 'UID02', 'Collaborate with UX designers and product teams to translate wireframes and user flows into high-fidelity visual designs.'),
(5, 'UID02', 'Create high-quality mockups, interactive prototypes, and maintain design systems/style guides for web projects.'),
(6, 'UID02', 'Design and refine visual interface components such as menus, tabs, icons, and widgets, ensuring visual consistency across all screens.');

-- --------------------------------------------------------

--
-- Table structure for table `job_skills`
--

DROP TABLE IF EXISTS `job_skills`;
CREATE TABLE `job_skills` (
  `skill_id` int(11) NOT NULL,
  `job_ref` char(5) NOT NULL,
  `skill_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_skills`
--

INSERT INTO `job_skills` (`skill_id`, `job_ref`, `skill_name`) VALUES
(7, 'FED01', 'Accessibility (WCAG) & SEO'),
(12, 'FED01', 'Agile Workflow & Jira'),
(13, 'FED01', 'Client Communication & Requirements Gathering'),
(9, 'FED01', 'CMS Platforms (WordPress)'),
(4, 'FED01', 'Cross-browser Compatibility'),
(2, 'FED01', 'CSS3 & Sass (SCSS)'),
(6, 'FED01', 'Front-end Frameworks (React, Vue)'),
(10, 'FED01', 'Git & GitHub Version Control'),
(5, 'FED01', 'JavaScript (ES6+) & TypeScript'),
(3, 'FED01', 'Responsive Web Design'),
(1, 'FED01', 'Semantic HTML5'),
(11, 'FED01', 'Testing & Debugging'),
(8, 'FED01', 'Web Performance Optimization'),
(19, 'UID02', 'Accessibility (WCAG) & Inclusive Design'),
(15, 'UID02', 'Adobe Creative Suite (Photoshop, Illustrator)'),
(21, 'UID02', 'Brand Identity & Visual Branding'),
(17, 'UID02', 'Design Systems, Component Libraries & Style Guides'),
(24, 'UID02', 'Design-to-Developer Handoff'),
(14, 'UID02', 'Figma (auto layout, components, variants)'),
(22, 'UID02', 'Motion Design & Micro-interactions'),
(25, 'UID02', 'Presenting Concepts to Clients'),
(20, 'UID02', 'Responsive Web Design'),
(18, 'UID02', 'Typography, Color Theory & Layout'),
(23, 'UID02', 'User Research & Usability Testing'),
(16, 'UID02', 'Wireframing & Interactive Prototyping');

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
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`),
  ADD KEY `fk_eoi_job_ref` (`job_ref`);

--
-- Indexes for table `eoi_skills`
--
ALTER TABLE `eoi_skills`
  ADD PRIMARY KEY (`EOInumber`,`skill_id`),
  ADD KEY `fk_eoi_skills_skill` (`skill_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_ref`);

--
-- Indexes for table `job_requirements`
--
ALTER TABLE `job_requirements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_ref` (`job_ref`);

--
-- Indexes for table `job_responsibilities`
--
ALTER TABLE `job_responsibilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_ref` (`job_ref`);

--
-- Indexes for table `job_skills`
--
ALTER TABLE `job_skills`
  ADD PRIMARY KEY (`skill_id`),
  ADD UNIQUE KEY `uq_job_skill` (`job_ref`,`skill_name`);

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
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_requirements`
--
ALTER TABLE `job_requirements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `job_responsibilities`
--
ALTER TABLE `job_responsibilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `job_skills`
--
ALTER TABLE `job_skills`
  MODIFY `skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eoi`
--
ALTER TABLE `eoi`
  ADD CONSTRAINT `fk_eoi_job_ref` FOREIGN KEY (`job_ref`) REFERENCES `jobs` (`job_ref`) ON UPDATE CASCADE;

--
-- Constraints for table `eoi_skills`
--
ALTER TABLE `eoi_skills`
  ADD CONSTRAINT `fk_eoi_skills_eoi` FOREIGN KEY (`EOInumber`) REFERENCES `eoi` (`EOInumber`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_eoi_skills_skill` FOREIGN KEY (`skill_id`) REFERENCES `job_skills` (`skill_id`) ON DELETE CASCADE;

--
-- Constraints for table `job_requirements`
--
ALTER TABLE `job_requirements`
  ADD CONSTRAINT `job_requirements_ibfk_1` FOREIGN KEY (`job_ref`) REFERENCES `jobs` (`job_ref`) ON DELETE CASCADE;

--
-- Constraints for table `job_responsibilities`
--
ALTER TABLE `job_responsibilities`
  ADD CONSTRAINT `job_responsibilities_ibfk_1` FOREIGN KEY (`job_ref`) REFERENCES `jobs` (`job_ref`) ON DELETE CASCADE;

--
-- Constraints for table `job_skills`
--
ALTER TABLE `job_skills`
  ADD CONSTRAINT `fk_job_skills_job_ref` FOREIGN KEY (`job_ref`) REFERENCES `jobs` (`job_ref`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
