-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2023 at 11:59 AM
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
-- Database: `job-practice`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `AdminFN` varchar(255) DEFAULT NULL,
  `AdminUN` varchar(255) DEFAULT NULL,
  `AdminDP` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `AdminFN`, `AdminUN`, `AdminDP`) VALUES
(1, 'Mohammad Abu Obaida Mullick', 'maomislive', 'styles/job/admin-photo.png'),
(2, 'Nafi Sadman Khan', 'NafiSadman', 'https://media.licdn.com/dms/image/D4D03AQEO2cUf-YNRmw/profile-displayphoto-shrink_800_800/0/1675447107882?e=1693440000&v=beta&t=XLA8epoqcVnt_-LVYZsKPxLccr7UtvBEHuFxXrh7i9c'),
(3, 'Rafi Abrar Kabir', 'RafiPotato', 'https://i.pinimg.com/originals/62/ed/db/62eddb5823b8d2e4a0e2ad17be1ec9cd.gif'),
(4, 'John Momo', 'john123', 'https://www.mantruckandbus.com/fileadmin/media/bilder/02_19/219_05_busbusiness_interviewHeader_1485x1254.jpg'),
(5, 'David Depp', 'david789', 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxjb2xsZWN0aW9uLXBhZ2V8MXw3NjA4Mjc3NHx8ZW58MHx8fHx8&w=1000&q=80');

-- --------------------------------------------------------

--
-- Table structure for table `job_posts`
--

CREATE TABLE `job_posts` (
  `job_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `hashtags` varchar(100) DEFAULT NULL,
  `date` date NOT NULL,
  `no_of_people_applied` int(11) DEFAULT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `featured` int(1) DEFAULT NULL,
  `location` varchar(10) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_posts`
--

INSERT INTO `job_posts` (`job_id`, `company_name`, `job_title`, `hashtags`, `date`, `no_of_people_applied`, `company_logo`, `salary`, `featured`, `location`, `admin_id`) VALUES
(1, 'Microsoft', 'Software Engineer', '#programming #development', '2023-06-01', 10, 'https://www.microsoft.com/en-us/microsoft-365/blog/wp-content/uploads/sites/2/2022/06/cropped-microsoft_logo_element.png', 50000.00, 1, 'On-site', 3),
(2, 'Google Co.', 'Data Analyst', '#data #analytics', '2023-06-05', 5, 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/2008px-Google_%22G%22_Logo.svg.png', 60000.00, 0, 'Remote', 1),
(3, 'Apple', 'Marketing Specialist', '#marketing #advertising', '2023-06-10', 8, 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/31/Apple_logo_white.svg/640px-Apple_logo_white.svg.png', 45000.00, 0, 'On-site', 5),
(4, 'Adobe', 'Graphic Designer', '#design #creativity', '2023-06-15', 3, 'https://companieslogo.com/img/orig/ADBE-fb158b30.png?t=1633216711', 40000.00, 0, 'Remote', 1),
(5, 'Salesforce', 'Sales Manager', '#sales #leadership #manager', '2023-06-20', 12, 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f9/Salesforce.com_logo.svg/1200px-Salesforce.com_logo.svg.png', 70000.00, 1, 'On-site', 5),
(6, 'Microsoft', 'Project Manager', '#projectmanagement #organization', '2023-06-25', 7, 'https://www.microsoft.com/en-us/microsoft-365/blog/wp-content/uploads/sites/2/2022/06/cropped-microsoft_logo_element.png', 75000.00, 1, 'Remote', 2),
(7, 'Google Co.', 'Support Representative', '#customerservice #communication', '2023-07-01', 6, 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/2008px-Google_%22G%22_Logo.svg.png', 35000.00, 0, 'On-site', 4),
(8, 'Apple', 'Financial Analyst', '#finance #analysis', '2023-05-05', 4, 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/31/Apple_logo_white.svg/640px-Apple_logo_white.svg.png', 60000.00, 1, 'Remote', 3),
(9, 'Salesforce', 'Human Resources Coordinator', '#hr #recruitment', '2023-06-10', 9, 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f9/Salesforce.com_logo.svg/1200px-Salesforce.com_logo.svg.png', 45000.00, 0, 'On-site', 3),
(10, 'Microsoft', 'Content Writer', '#writing #contentcreation', '2023-06-15', 2, 'https://www.microsoft.com/en-us/microsoft-365/blog/wp-content/uploads/sites/2/2022/06/cropped-microsoft_logo_element.png', 30000.00, 0, 'Remote', 5),
(11, 'Google Co.', 'Software Engineer', '#coding #tech', '2023-06-01', 50, 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/2008px-Google_%22G%22_Logo.svg.png', 100000.00, 1, 'On-site', 2),
(12, 'Microsoft', 'Web Developer', '#programming #webdevelopment', '2023-06-02', 75, 'https://www.microsoft.com/en-us/microsoft-365/blog/wp-content/uploads/sites/2/2022/06/cropped-microsoft_logo_element.png', 90000.00, 0, 'On-site', 3),
(13, 'Amazon', 'Data Scientist', '#datascience #machinelearning', '2023-06-03', 100, 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4a/Amazon_icon.svg/2500px-Amazon_icon.svg.png', 120000.00, 1, 'On-site', 4),
(14, 'Meta', 'Full Stack Developer', '#coding #webdevelopment', '2023-06-04', 120, 'https://cdn.pixabay.com/photo/2021/11/01/15/20/meta-logo-6760788_1280.png', 110000.00, 0, 'Remote', 1),
(15, 'Apple', 'iOS Developer', '#mobiledevelopment #coding', '2023-06-05', 80, 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/31/Apple_logo_white.svg/640px-Apple_logo_white.svg.png', 95000.00, 0, 'Remote', 2),
(16, 'Netflix', 'Backend Engineer', '#programming #softwareengineering', '2023-06-06', 60, 'https://loodibee.com/wp-content/uploads/Netflix-N-Symbol-logo.png', 105000.00, 0, 'On-site', 5),
(17, 'IBM', 'Cloud Architect', '#cloudcomputing #infrastructure', '2023-06-07', 90, 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/IBM_logo.svg/800px-IBM_logo.svg.png', 115000.00, 1, 'Remote', 4),
(18, 'Salesforce', 'DevOps Engineer', '#coding #devops', '2023-06-08', 70, 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f9/Salesforce.com_logo.svg/1200px-Salesforce.com_logo.svg.png', 100000.00, 0, 'Remote', 5),
(19, 'Intel', 'Embedded Systems Engineer', '#electronics #coding', '2023-06-09', 85, 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7d/Intel_logo_%282006-2020%29.svg/1005px-Intel_logo_%282006-2020%29.svg.png', 95000.00, 0, 'Remote', 5),
(20, 'Salesforce', 'Frontend Developer', '#programming #webdevelopment', '2023-06-10', 65, 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f9/Salesforce.com_logo.svg/1200px-Salesforce.com_logo.svg.png', 90000.00, 0, 'On-site', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `job_posts`
--
ALTER TABLE `job_posts`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `fk_admin` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job_posts`
--
ALTER TABLE `job_posts`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `job_posts`
--
ALTER TABLE `job_posts`
  ADD CONSTRAINT `fk_admin` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
