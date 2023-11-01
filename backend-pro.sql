-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2023 at 10:10 PM
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
-- Database: `backend-pro`
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
  `Rate` int(11) DEFAULT NULL CHECK (`Rate` >= 1 and `Rate` <= 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`Id`, `User_Id`, `Event_Id`, `Comments_content`, `Rate`) VALUES
(1, 1, 1, 'Exciting initiative, happy to be a part!', 5),
(2, 2, 2, 'Rewarding experience helping out at the kitchen', 4),
(3, 2, 3, 'Enjoyed planting trees and making a difference', 4),
(4, 3, 1, 'Great turnout for the cleanup event', 3);

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
(1, 4),
(2, 3),
(3, 2),
(4, 1);

--
-- Triggers `event_user`
--
DELIMITER $$
CREATE TRIGGER `check_registration_time` BEFORE INSERT ON `event_user` FOR EACH ROW BEGIN
    DECLARE registration_count INT;

    SELECT COUNT(*) INTO registration_count
    FROM Event_User
    WHERE User_Id = NEW.User_Id
    AND Event_Id IN (
        SELECT Event_Id
        FROM Events
        WHERE E_date = (SELECT E_date FROM Events WHERE E_Id = NEW.Event_Id)
    );

    IF registration_count > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'User already registered for an event at the same time';
    END IF;
END
$$
DELIMITER ;

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `Role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `username`, `password`, `email`, `date_of_birth`, `img`, `name`, `Role`) VALUES
(1, 'admin123', 'adminpass123', 'admin@example.com', '1990-05-25', 'admin.jpg', 'Admin User', 1),
(2, 'user456', 'userpass456', 'user@example.com', '1995-09-10', 'user.jpg', 'Regular User', 2),
(3, 'john_doe', 'johnpass789', 'john@example.com', '1988-12-18', 'john.jpg', 'John Doe', 2),
(4, 'sarah_smith', 'sarahpass321', 'sarah@example.com', '1992-03-07', 'sarah.jpg', 'Sarah Smith', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Event_Id` (`Event_Id`),
  ADD KEY `User_Id` (`User_Id`);

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `E_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`Event_Id`) REFERENCES `events` (`E_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`User_Id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
