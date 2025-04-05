-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2025 at 12:15 PM
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
-- Database: `verloff`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_logins`
--

CREATE TABLE `active_logins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `role` enum('faculty','hod','student') NOT NULL,
  `logged_in_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_actions`
--

CREATE TABLE `admin_actions` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `action_type` enum('user_management','system_update','report_generation') NOT NULL,
  `details` text DEFAULT NULL,
  `action_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_history`
--

CREATE TABLE `leave_history` (
  `id` int(11) NOT NULL,
  `leave_id` int(11) NOT NULL,
  `action_by` enum('faculty','hod','admin') NOT NULL,
  `action_taken` enum('approved','rejected','forwarded') NOT NULL,
  `remarks` text DEFAULT NULL,
  `action_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_request`
--

CREATE TABLE `leave_request` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `class` varchar(50) NOT NULL,
  `leave_reason` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('Pending','Approved','Rejected','Forwarded') DEFAULT 'Pending',
  `faculty_remarks` text DEFAULT NULL,
  `hod_remarks` text DEFAULT NULL,
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_request`
--

INSERT INTO `leave_request` (`id`, `student_id`, `student_name`, `class`, `leave_reason`, `start_date`, `end_date`, `status`, `faculty_remarks`, `hod_remarks`, `applied_at`) VALUES
(1, 1, 'nandana', 'S6 CSE', 'wertyui', '2025-04-02', '2025-04-04', 'Approved', '', '', '2025-04-04 09:40:25'),
(2, 1, 'nandana', 'S6 CSE', 'ertyuio', '2025-04-03', '2025-04-04', '', '', '', '2025-04-04 10:05:23'),
(3, 1, 'nandana', 'S6 CSE', 'sick leave', '2025-04-03', '2025-04-04', 'Approved', '', 'approved', '2025-04-04 10:34:21'),
(4, 32, 'nehaaa', 's6cse', 'vayyaaa maduthhh....', '2025-04-07', '2025-04-08', 'Approved', '', '', '2025-04-04 10:45:36'),
(5, 13, 'nandanaa', 'Not Set', 'not well', '2025-04-02', '2025-04-04', 'Approved', 'ok', NULL, '2025-04-04 13:05:25'),
(6, 14, 'nandana', 'Not Set', 'asdfghj', '2025-03-31', '2025-04-04', 'Approved', 'as', NULL, '2025-04-04 14:40:05'),
(7, 14, 'nandana', 'Not Set', 'dfghj', '2025-04-23', '2025-04-25', 'Approved', 'ok', 'srsly', '2025-04-04 14:42:03'),
(8, 14, 'nandana', 'Not Set', 'awd', '2025-04-10', '2025-04-29', 'Rejected', '', NULL, '2025-04-04 14:42:18'),
(9, 12, 'abik', 'Not Set', 'abcd', '2025-04-01', '2025-04-10', '', 'ok', 'not fair', '2025-04-04 15:02:32'),
(10, 14, 'nandana', 'Not Set', 'not well', '2025-04-01', '2025-04-05', 'Approved', 'ok', 'ok', '2025-04-05 06:15:35'),
(11, 15, 'unni', 'Not Set', 'vayya', '2025-04-01', '2025-04-05', '', 'ok', 'no', '2025-04-05 06:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `leave_type` enum('sick','casual','emergency','other') NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `faculty_remarks` text DEFAULT NULL,
  `hod_remarks` text DEFAULT NULL,
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `name`, `department`, `email`) VALUES
(12, 23, 'abik', 'Not Set', 'abik@gmail.com'),
(13, 24, 'nandanaa', 'Not Set', 'nandanaa@gmail.com'),
(14, 28, 'nandana', 'Not Set', 'nandana@gmail.com'),
(15, 29, 'unni', 'Not Set', 'unni@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('student','faculty','hod','admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `role`, `created_at`) VALUES
(12, 'nandhanakn', 'nandhanakn@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'student', '2025-04-04 08:45:17'),
(15, 'nehaaa', 'nehakk2804@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'student', '2025-04-04 10:16:13'),
(22, 'anfal', 'anfal@gmail.com', 'abac2d4101d246852fcdd487ef190ca6', 'student', '2025-04-04 12:16:16'),
(23, 'abik', 'abik@gmail.com', 'd58345f6b144dbfecb76321f2633136f', 'student', '2025-04-04 13:01:38'),
(24, 'nandanaa', 'nandanaa@gmail.com', '10b4945abe2e627db646b3c5226a4e50', 'student', '2025-04-04 13:03:04'),
(25, 'anju', 'anju@gmail.com', '9abfae448bc00ea3214033a3086e6539', 'hod', '2025-04-04 13:09:40'),
(26, 'reshmi', 'reshmi@gmail.com', '9e1e06ec8e02f0a0074f2fcc6b26303b', 'faculty', '2025-04-04 13:09:57'),
(27, 'arabhi', 'arabhi@gmail.cpm', '11b649e96ac70d395311ee92b9328197', 'faculty', '2025-04-04 13:10:18'),
(28, 'nandana', 'nandana@gmail.com', '10b4945abe2e627db646b3c5226a4e50', 'student', '2025-04-04 14:39:21'),
(29, 'unni', 'unni@gmail.com', 'b6dbe4cd5e9a667a65783b81b84a2948', 'student', '2025-04-05 06:31:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_logins`
--
ALTER TABLE `active_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_actions`
--
ALTER TABLE `admin_actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `leave_history`
--
ALTER TABLE `leave_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_id` (`leave_id`);

--
-- Indexes for table `leave_request`
--
ALTER TABLE `leave_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_logins`
--
ALTER TABLE `active_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `admin_actions`
--
ALTER TABLE `admin_actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_history`
--
ALTER TABLE `leave_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_request`
--
ALTER TABLE `leave_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_actions`
--
ALTER TABLE `admin_actions`
  ADD CONSTRAINT `admin_actions_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leave_history`
--
ALTER TABLE `leave_history`
  ADD CONSTRAINT `leave_history_ibfk_1` FOREIGN KEY (`leave_id`) REFERENCES `leave_requests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `leave_requests_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
