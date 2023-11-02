-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2023 at 09:34 PM
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
-- Database: `project-back`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `E_Id` int(11) NOT NULL,
  `E_name` varchar(100) NOT NULL,
  `E_date` date NOT NULL,
  `Category` varchar(100) DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `Num_of_sites` int(11) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Img` varchar(100) DEFAULT NULL,
  `Last_registration` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`E_Id`, `E_name`, `E_date`, `Category`, `Location`, `Num_of_sites`, `Description`, `Img`, `Last_registration`) VALUES
(1, 'Community Cleanup', '2023-12-05', 'Volunteer', 'Park XYZ', 50, 'Join us to clean up the local park', 'cleanup_event.jpg', '2023-11-01'),
(2, 'Soup Kitchen Assistance', '2023-12-06', 'Volunteer', 'Community Center', 30, 'Help serve meals at the local soup kitchen', 'soup_kitchen_event.jpg', '2023-11-01'),
(3, 'Tree Planting Drive', '2023-12-07', 'Volunteer', 'City Nursery', 100, 'Plant trees for a greener environment', 'tree_planting_event.jpg', '2023-11-01'),
(4, 'Animal Shelter Support', '2023-12-08', 'Volunteer', 'Animal Shelter', 20, 'Assist in caring for shelter animals', 'animal_shelter_event.jpg', '2023-11-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`E_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `E_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
