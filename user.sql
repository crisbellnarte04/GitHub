-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2025 at 07:01 AM
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
-- Database: `user`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `clinic_id` int(11) DEFAULT NULL,
  `date_of_visit` date DEFAULT NULL,
  `time_of_visit` time DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clinics`
--

CREATE TABLE `clinics` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_availability`
--

CREATE TABLE `doctor_availability` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `day_of_week` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `slot_duration_minutes` int(11) NOT NULL DEFAULT 30
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `recipient` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `recipient`, `type`, `date`, `is_read`) VALUES
(1, '\'buy a coffee\' has been assigned to you. Please review and start working on it', 6, 'New Task Assigned', '0000-00-00', 0),
(2, '\'hotdog\' has been assigned to you. Please review and start working on it', 8, 'New Task Assigned', '0000-00-00', 0),
(3, '\'kape\' has been assigned to you. Please review and start working on it', 7, 'New Task Assigned', '0000-00-00', 0),
(4, '\'Task\' has been assigned to you. Please review and start working on it', 7, 'New Task Assigned', '0000-00-00', 0),
(5, '\'ultrasound\' has been assigned to you. Please review and start working on it', 10, 'New Task Assigned', '0000-00-00', 0),
(6, '\'asa\' has been assigned to you. Please review and start working on it', 7, 'New Task Assigned', '0000-00-00', 0),
(7, '\'wasd\' has been assigned to you. Please review and start working on it', 9, 'New Task Assigned', '0000-00-00', 0),
(8, '\'buy a sardines\' has been assigned to you. Please review and start working on it', 7, 'New Task Assigned', '0000-00-00', 0),
(9, '\'dvdzA\' has been assigned to you. Please review and start working on it', 11, 'New Task Assigned', '0000-00-00', 0),
(10, '\'ASDAFDA\' has been assigned to you. Please review and start working on it', 18, 'New Task Assigned', '0000-00-00', 0),
(11, '\'12345\' has been assigned to you. Please review and start working on it', 18, 'New Task Assigned', '0000-00-00', 0),
(12, '\'qerqefe\' has been assigned to you. Please review and start working on it', 18, 'New Task Assigned', '0000-00-00', 0),
(13, '\'zdgsb\' has been assigned to you. Please review and start working on it', 19, 'New Task Assigned', '0000-00-00', 0),
(14, '\'adfsgv\' has been assigned to you. Please review and start working on it', 20, 'New Task Assigned', '0000-00-00', 0),
(15, '\'CT scan\' has been assigned to you. Please review and start working on it', 21, 'New Task Assigned', '0000-00-00', 1),
(16, '\'Ultrasound\' has been assigned to you. Please review and start working on it', 19, 'New Task Assigned', '0000-00-00', 0),
(17, '\'Laboratory\' has been assigned to you. Please review and start working on it', 22, 'New Task Assigned', '0000-00-00', 1),
(18, '\'qweqwe\' has been assigned to you. Please review and start working on it', 23, 'New Task Assigned', '0000-00-00', 1),
(19, '\'ultrasound\' has been assigned to you. Please review and start working on it', 23, 'New Task Assigned', '0000-00-00', 0),
(20, '\'laboratory\' has been assigned to you. Please review and start working on it', 23, 'New Task Assigned', '0000-00-00', 0),
(21, '\'xray\' has been assigned to you. Please review and start working on it', 23, 'New Task Assigned', '0000-00-00', 0),
(22, '\'l\' has been assigned to you. Please review and start working on it', 23, 'New Task Assigned', '0000-00-00', 0),
(23, '\'l\' has been assigned to you. Please review and start working on it', 23, 'New Task Assigned', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `due_date` date DEFAULT current_timestamp(),
  `status` enum('pending','in_progress','completed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `assigned_to`, `due_date`, `status`, `created_at`) VALUES
(21, 'xray', 'xray for ms  abi', 23, '2025-10-08', 'pending', '2025-10-06 03:20:53'),
(22, 'l', 'l', 23, '2025-10-02', 'pending', '2025-10-06 04:18:27'),
(23, 'l', 'i', 23, '0000-00-00', 'pending', '2025-10-06 04:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','employee') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `password`, `role`, `created_at`) VALUES
(4, 'Oliver', 'admin', '$2y$10$ZonY61lojU63LZXFSlK2YuV6ZaDOVRayUAjQitcDA6jCJjIkUz9vi', 'admin', '2025-09-24 02:36:54'),
(12, 'Mike', 'mike', '$2y$10$2m4voPFKE/2HeOmCPzFVt.OXc9V7ftBCKnSQ.bD2NSIBaFqYtxMbi', 'admin', '2025-09-29 06:00:26'),
(23, 'Steven T.', 'steven', '$2y$10$yeEepQPkWxh/Q6p3.xoSouvRh1Kk9Yv12QsY2T/jqI/jh7TYj/bCW', 'employee', '2025-09-30 05:34:26'),
(24, 'Jonathan', 'jonathan', '$2y$10$t/c9T7L4N669S8o99KF3fOXZOk2XSWwJc6MoIypyES8axsw.QbRiS', 'admin', '2025-10-02 08:44:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indexes for table `clinics`
--
ALTER TABLE `clinics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_availability`
--
ALTER TABLE `doctor_availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_to` (`assigned_to`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clinics`
--
ALTER TABLE `clinics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_availability`
--
ALTER TABLE `doctor_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`),
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`id`);

--
-- Constraints for table `doctor_availability`
--
ALTER TABLE `doctor_availability`
  ADD CONSTRAINT `doctor_availability_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`),
  ADD CONSTRAINT `doctor_availability_ibfk_2` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
