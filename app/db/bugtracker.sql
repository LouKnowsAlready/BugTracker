-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2018 at 03:03 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bugtracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `bugs`
--

CREATE TABLE `bugs` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `bug_name` varchar(300) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `priority_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bugs`
--

INSERT INTO `bugs` (`id`, `project_id`, `bug_name`, `assigned_to`, `priority_id`, `status_id`, `details`) VALUES
(2, 3, 'Project A - Issue 1 - Edited', 2, 6, 3, '   Project A issue 1 details   '),
(3, 3, 'Project A - Issue 2', 1, 8, 2, 'Project A Issue 2 Details'),
(5, 3, 'Test issue in Project A', 2, 7, 3, 'Test issue in Project A'),
(6, 3, 'Project A - Issue 5 - Edited', 2, 7, 3, ' Test Issue 5 in Project A '),
(7, 3, 'Project A - Issue 6', 2, 9, 3, 'Project A issue 6'),
(8, 3, 'Project A - Issue 7', 2, 9, 2, 'Project A - Issue 7 details'),
(9, 3, 'Project A - Issue 8', 2, 9, 2, 'Issue 8 in Project A'),
(10, 3, 'Project A - Issue 9', 2, 7, 2, 'Test'),
(12, 3, 'Issue 11', 2, 8, 2, 'Test Issue 11'),
(13, 4, 'Project B - Issue 1', 4, 11, 6, 'First test Issue in Project B'),
(14, 4, 'Project B - Issue 2', 4, 10, 6, 'Test Issue 2 in Project B'),
(15, 4, 'Project B - Issue 3', 5, 12, 5, 'Test Issue 3 in Project B'),
(16, 3, 'Project A - Issue 11', 1, 8, 3, 'Test Issue'),
(17, 3, 'Project A - Issue 12', 2, 7, 3, 'Test Issue in Project A'),
(18, 4, 'Project B - Issue 4', 5, 10, 7, 'Test Issue 4'),
(19, 5, 'Project C - Issue 1', 5, 15, 9, 'Test Issue in Project C');

-- --------------------------------------------------------

--
-- Table structure for table `bug_status`
--

CREATE TABLE `bug_status` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `status_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bug_status`
--

INSERT INTO `bug_status` (`id`, `project_id`, `status_name`) VALUES
(2, 3, 'Not Started'),
(3, 3, 'In Progress'),
(4, 3, 'Done'),
(5, 4, 'Not Started'),
(6, 4, 'In Progress'),
(7, 4, 'For Review'),
(8, 4, 'Fixed'),
(9, 5, 'Not Started'),
(10, 5, 'In Progress'),
(11, 5, 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `bug_tags`
--

CREATE TABLE `bug_tags` (
  `id` int(11) NOT NULL,
  `bug_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `priorities`
--

CREATE TABLE `priorities` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `priority_name` varchar(200) NOT NULL,
  `priority_weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `priorities`
--

INSERT INTO `priorities` (`id`, `project_id`, `priority_name`, `priority_weight`) VALUES
(6, 3, 'P1', 1),
(7, 3, 'P2', 2),
(8, 3, 'P3', 3),
(9, 3, 'P4', 4),
(10, 4, 'Important', 1),
(11, 4, 'Mediocre', 2),
(12, 4, 'Normal', -1),
(13, 5, 'P1', 1),
(14, 5, 'P2', 2),
(15, 5, 'P3', 3);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `project_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`) VALUES
(3, 'Project A'),
(4, 'Project B'),
(5, 'Project C');

-- --------------------------------------------------------

--
-- Table structure for table `project_users`
--

CREATE TABLE `project_users` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_users`
--

INSERT INTO `project_users` (`id`, `project_id`, `user_id`, `role_id`) VALUES
(5, 3, 3, 4),
(6, 3, 2, 3),
(7, 3, 1, 2),
(8, 4, 4, 1),
(9, 4, 5, 3),
(10, 5, 5, 2),
(11, 5, 1, 3),
(12, 5, 2, 3),
(13, 5, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Browser'),
(3, 'Developer'),
(4, 'Project Manager');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `tag_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `project_id`, `tag_name`) VALUES
(3, 3, 'PC-Bug'),
(4, 4, 'Audio-Bug'),
(5, 4, 'World-Bug'),
(6, 5, 'Test Tag 1'),
(7, 5, 'Test Tag 2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`) VALUES
(1, 'Paul Christian', 'Hubahib'),
(2, 'Lourence John', 'Cabaluna'),
(3, 'Steve', 'Verrault'),
(4, 'William', 'Basmayor'),
(5, 'Neil', 'Dunken');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bugs`
--
ALTER TABLE `bugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bug_status`
--
ALTER TABLE `bug_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bug_tags`
--
ALTER TABLE `bug_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `priorities`
--
ALTER TABLE `priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_users`
--
ALTER TABLE `project_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bugs`
--
ALTER TABLE `bugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `bug_status`
--
ALTER TABLE `bug_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bug_tags`
--
ALTER TABLE `bug_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `priorities`
--
ALTER TABLE `priorities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project_users`
--
ALTER TABLE `project_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
