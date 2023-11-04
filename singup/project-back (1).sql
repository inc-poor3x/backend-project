-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2023 at 08:13 PM
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
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `Id` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `Event_Id` int(11) DEFAULT NULL,
  `Comments_content` text DEFAULT NULL,
  `Rate` int(11) DEFAULT NULL CHECK (`Rate` >= 1 and `Rate` <= 5),
  `statis` int(1) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`Id`, `User_Id`, `Event_Id`, `Comments_content`, `Rate`, `statis`) VALUES
(3, 2, 3, 'Enjoyed planting trees and making a difference', 4, 3),
(5, 5, 1, 'Great event!', 5, 3),
(6, 2, 3, 'Could be better.', 3, 3),
(7, 6, 4, 'Amazing experience!', 4, 3),
(8, 6, 5, 'I didnt like it.', 2, 3),
(9, 5, 4, 'Not my cup of tea.', 1, 3);

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
  `Img` varchar(255) DEFAULT NULL,
  `Last_registration` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`E_Id`, `E_name`, `E_date`, `Category`, `Location`, `Num_of_sites`, `Description`, `Img`, `Last_registration`) VALUES
(1, 'Community Cleanup', '2015-12-08', 'Volunteer', 'Park XYZ', 42, 'Join us to clean up the local park', 'https://images-ext-1.discordapp.net/external/by6BVwdDQF7nqiRd83xgZloYH7oxbh2Si3qBBWOIGSw/https/students.1fbusa.com/hubfs/25%2520Ways%2520to%2520Volunteer%2520in%2520Your%2520Community.jpg?width=1276&height=670', '2023-11-01'),
(3, 'Tree Planting Drive', '2019-12-10', 'Volunteer', 'City Nursery', 100, 'Plant trees for a greener environment', 'https://images-ext-2.discordapp.net/external/HQm-QgdmPcVXx-jdtawj07uE45C-ByzFsWJuEbXRjo0/https/www.101highlandlakes.com/uploads/media/default/0001/24/a4ff4bedeaec4abb29bb9a9134c9399a42201ce6.jpeg?width=750&height=370', '2023-11-01'),
(4, 'Animal Shelter Support', '2017-12-07', 'Volunteer', 'Animal Shelter', 20, 'Assist in caring for shelter animals', 'https://images-ext-1.discordapp.net/external/6aI1T2c2B2A-i5Oy6IZIj98utWsCfWKSTtdS954EADo/%3Fq%3Dtbn%3AANd9GcT6bPlmx9sEzttZCQ_C9LGLxv0XU_RF7qRZHw%26usqp%3DCAU/https/encrypted-tbn0.gstatic.com/images?width=388&height=202', '2023-11-01'),
(5, 'aahmad 1', '2023-11-10', 'Music', 'City Park', 100, 'An amazing music festival in the park.', 'https://images-ext-1.discordapp.net/external/YXkCLD-GwXCvpwO0givVaEN377L8XzOSROlAeY_cfe8/https/s3.amazonaws.com/cioc.communityconnection/volunteerconnection/volunteer_group.jpeg?width=691&height=410', '2023-11-03');

-- --------------------------------------------------------

--
-- Table structure for table `event_user`
--

CREATE TABLE `event_user` (
  `User_Id` int(11) NOT NULL,
  `Event_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_user`
--

INSERT INTO `event_user` (`User_Id`, `Event_Id`) VALUES
(2, 1),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `Id` int(11) NOT NULL,
  `Role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`Id`, `Role`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `statis`
--

CREATE TABLE `statis` (
  `id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statis`
--

INSERT INTO `statis` (`id`, `status`) VALUES
(1, 'Accepted'),
(2, 'Rejected'),
(3, 'Waiting for Acceptance');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `img` varchar(1000) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `Role` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `username`, `password`, `email`, `date_of_birth`, `img`, `name`, `Role`) VALUES
(2, 'user456', 'userpass456', 'user@example.com', '1995-09-10', 'https://images-ext-1.discordapp.net/external/wg5as83L_jGW5qRZqD-vFY9QBSWfnG7A9cUnzEvR37Q/%3Fq%3Dtbn%3AANd9GcT32TRqMNY1jQHaL3L4ENSzCFDd8ZOt-SdrqeMy6m_sbdAA7nXJRNXWWSUCbyzdsL0BNvc%26usqp%3DCAU/https/encrypted-tbn0.gstatic.com/images?width=281&height=281', 'Regular User', 2),
(5, 'Ahmad', '@125319', '@gmail.com', '2023-11-17', 'sdfghjkl', 'ahnmm', 1),
(6, 'khaled', 'asdfghjkl', 'asdfghj', '2023-11-17', 'Zxcvbnm', 'Zxcvbnm', 2),
(7, 'testuser', 'testpassword', 'testuser@example.com', '1990-01-01', NULL, '', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Event_Id` (`Event_Id`),
  ADD KEY `User_Id` (`User_Id`),
  ADD KEY `statis` (`statis`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`E_Id`);

--
-- Indexes for table `event_user`
--
ALTER TABLE `event_user`
  ADD PRIMARY KEY (`User_Id`,`Event_Id`),
  ADD KEY `Event_Id` (`Event_Id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Role` (`Role`);

--
-- Indexes for table `statis`
--
ALTER TABLE `statis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `Role` (`Role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `E_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`Event_Id`) REFERENCES `events` (`E_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`User_Id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `statis` FOREIGN KEY (`statis`) REFERENCES `statis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_user`
--
ALTER TABLE `event_user`
  ADD CONSTRAINT `event_user_ibfk_1` FOREIGN KEY (`Event_Id`) REFERENCES `events` (`E_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_user_ibfk_2` FOREIGN KEY (`User_Id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Role`) REFERENCES `role` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
