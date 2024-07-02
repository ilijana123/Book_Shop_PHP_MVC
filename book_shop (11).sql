-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2024 at 01:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `email`) VALUES
(4, 'mgs_user1', '$2y$10$uyzYw3cJ4fyjsOhm7fIdLeRSTbqhNZz9rsfjh9KE3kCQAgJ9AfMz6', 'simonovskailijana1@gmail.com'),
(5, 'admin', '$2y$10$I662rv3uo9.O6G3ahZ0ITeiH1..YqsCcCUimTnal.cLqOqoV1Cuza', 'simonovskailijana11@gmail.com'),
(6, 'mgs_user', '$2y$10$63d9L2NLnlWjtoe8E2lSxO4lStj/3hUCX4YbdfGcTjmcR278Yu05y', 'lozankamilenkovska@gmail.com'),
(7, 'ane', '$2y$10$fkMKgKuV8KY986YRZiJEc.JlMShdAfDv1nK2C1YSwXPG7mceLBp7e', 'aneilie@gmail.com'),
(8, 'nikola', '$2y$10$IATvZtg/mQHtGCNB3T04IeQwvgIihuI9UGZZUPRfiumzPEWQEiyxG', 'nikola.petkovski01@gmail.com'),
(12, 'nov', '$2y$10$OP6AGPYYw5F0/MqO/ZDUseNw0PXM5s8IblvMG7gFSfUhMmS/MAt.2', 'nov@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `adminID` int(11) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`adminID`, `emailAddress`, `password`, `username`) VALUES
(4, 'simonovskailijana11@gmail.com', '$2y$10$I662rv3uo9.O6G3ahZ0ITeiH1..YqsCcCUimTnal.cLqOqoV1Cuza', 'admin'),
(12, 'lozankamilenkovska55@gmail.com', '$2y$10$u1I6R/XfHYNars6mjtcPG.ZoJ3OROmUCvvkhl8AUBqa.2AVpt3sYa', 'ana '),
(13, 'ana@gmail.com', '$2y$10$Lia4UHbLLG2qyiRnSfZw4edTaUbQVsTiIg94vif49qPNSXl.NTJs2', 'anastasija'),
(14, 'ilijana.simonovska777@yahoo.com', '$2y$10$q5Gxom0riONDIpBlTdM2wuFACf6yng7pMIXy5RXNdOblrhooEZeLC', 'admin123'),
(15, 'pom@gmail.com', '$2y$10$FTJ.A9/vgWBRiRMIs/58P.RTwoMvcWAKCyxTg6AsVRrWfBs55uuWa', 'admin1'),
(16, 'ilijana@gmail.com', '$2y$10$mp4b6WFiBI1AkeBWRT1uVe.JdqZdkvT/itBV48B2iDXWPtHDCX2zy', 'admin4');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `authorID` int(11) NOT NULL,
  `authorName` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `birthDate` date NOT NULL,
  `gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`authorID`, `authorName`, `nationality`, `birthDate`, `gender`) VALUES
(1, 'J.K. Rowling', 'British', '1965-07-31', 'Female'),
(2, 'John Green', 'American', '1970-01-01', 'Male'),
(3, 'Paulo Coelho', 'Brazilian', '1960-09-04', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartID` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartID`, `accountID`, `product_id`, `quantity`) VALUES
(6, 8, 4, 1),
(7, 5, 4, 1),
(9, 6, 22, 1),
(13, 12, 30, 5);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `productID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `comment`, `productID`, `username`) VALUES
(11, 'ok', 4, 'mgs_user'),
(13, 'kk', 29, 'mgs_user1');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genreID` int(11) NOT NULL,
  `genreName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genreID`, `genreName`) VALUES
(1, 'Horror'),
(2, 'Drama'),
(3, 'Fantasy'),
(4, 'Romantic');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `productCode` varchar(255) NOT NULL,
  `productTitle` varchar(255) NOT NULL,
  `listPrice` int(11) NOT NULL,
  `yearPublished` int(11) NOT NULL,
  `numPages` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `genreID` int(11) NOT NULL,
  `authorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productCode`, `productTitle`, `listPrice`, `yearPublished`, `numPages`, `description`, `genreID`, `authorID`) VALUES
(4, '../images/Hobbit.jpg', 'Hobbit', 13, 2001, 110, 'The Hobbit is set in Middle-earth and follows home-loving Bilbo Baggins, the hobbit of the title, who joins the wizard Gandalf and the thirteen dwarves of Thorin\'s Company, on a quest to reclaim the dwarves\' home and treasure from the dragon Smaug.', 2, 1),
(22, '../images/knig.jpg', 'The Alchemist', 55, 1960, 55, 'whatever', 3, 3),
(23, '../images/44.jpg', 'Can a cookie change the world?', 22, 2005, 345, 'A young girl sets out to help her remote Alaskan town and ends up impacting the world in ways she could never have imagined.', 4, 2),
(29, '../images/OIP.jpg', 'Forrest Gump', 55, 1880, 88, 'Run Forrest Run!!', 1, 1),
(30, '../images/a.jpg', ' The Honey Witch', 66, 1955, 100, 'The Honey Witch of Innisfree can never find true love. That is her curse to bear. But when a young woman who doesn’t believe in magic arrives on her island, sparks fly in this deliciously sweet debut novel of magic, hope, and love overcoming all.', 1, 1),
(34, '44.jpg', 'Anastasija', 55, 1966, 55, 'novo', 2, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`authorID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `accountID` (`accountID`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genreID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `authorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`productID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
