-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2023 at 07:16 AM
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
-- Database: `youtube_db`
--
CREATE DATABASE IF NOT EXISTS `youtube_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `youtube_db`;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getChannelVideos` (IN `id` INT)   SELECT id, title, description, thumbnail, uid FROM youtube_channel_videos WHERE channel_id = id LIMIT 100$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `saveChannel` (IN `channel_id` VARCHAR(50), IN `name` VARCHAR(50), IN `description` TEXT, IN `thumbnail` VARCHAR(2083))   INSERT  INTO youtube_channels
	(
        uid,
        name,
        description,
        thumbnail
    )
VALUES
	(
        channel_id,
        name,
        description,
        thumbnail
	)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `saveVideo` (IN `video_id` VARCHAR(50), IN `title` VARCHAR(50), IN `description` TEXT, IN `thumbnail` VARCHAR(2083), IN `channel_id` INT)   INSERT INTO youtube_channel_videos
	(
        uid, 
        title,
        description,
        thumbnail,
        channel_id
    ) 
VALUES 
	(
        video_id,
        title,
        description,
        thumbnail,
        channel_id
   	)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `youtube_channels`
--

CREATE TABLE `youtube_channels` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `thumbnail` varchar(2083) NOT NULL,
  `uid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `youtube_channel_videos`
--

CREATE TABLE `youtube_channel_videos` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `thumbnail` varchar(2083) NOT NULL,
  `channel_id` int(11) NOT NULL,
  `uid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `youtube_channels`
--
ALTER TABLE `youtube_channels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `youtube_channel_videos`
--
ALTER TABLE `youtube_channel_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `channel_fk` (`channel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `youtube_channels`
--
ALTER TABLE `youtube_channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `youtube_channel_videos`
--
ALTER TABLE `youtube_channel_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `youtube_channel_videos`
--
ALTER TABLE `youtube_channel_videos`
  ADD CONSTRAINT `channel_fk` FOREIGN KEY (`channel_id`) REFERENCES `youtube_channels` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
