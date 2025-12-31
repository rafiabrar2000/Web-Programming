-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2023 at 06:09 AM
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
-- Database: `dbmsproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `signin`
--

CREATE TABLE `signin` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Passcode` varchar(50) DEFAULT NULL,
  `Phone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signin`
--

INSERT INTO `signin` (`UserID`, `Username`, `Email`, `Passcode`, `Phone`) VALUES
(1, 'Rafi', 'a@gmail.com', '123', '01305589089'),
(2, 'Abrar', 'b@gmail.com', '124', '01705589089'),
(3, 'Kabir', 'c@gmail.com', '125', '01306689089'),
(4, 'Nafi', 'd@gmail.com', '126', '01305589129'),
(5, 'Sadman', 'e@gmail.com', '127', '01305589099'),
(6, 'Khan', 'f@gmail.com', '128', '01305589578'),
(7, 'Abu', 'g@gmail.com', '129', '01707789089'),
(8, 'Obaida', 'h@gmail.com', '131', '01305589573'),
(9, 'Mullick', 'i@gmail.com', '132', '01305589456'),
(10, 'Muhammad', 'j@gmail.com', '133', '01305589034'),
(11, 'Mukit', 'M@gmail.com', '431', '01328922522'),
(12, 'Mukit', 'M@gmail.com', '431', '01328922522'),
(13, 'Shafiul', 'Sh@gmail.com', '568', '01305589089');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `signin`
--
ALTER TABLE `signin`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `signin`
--
ALTER TABLE `signin`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
