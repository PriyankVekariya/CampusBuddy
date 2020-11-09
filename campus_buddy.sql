-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2020 at 06:14 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `campus_buddy`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` tinyint(4) NOT NULL,
  `dept_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name`) VALUES
(3, 'Civil'),
(1, 'IT'),
(2, 'Mechanical');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `user_id` int(11) NOT NULL,
  `message` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`user_id`, `message`, `timestamp`) VALUES
(2, 'Your question is submitted successfully having title as Controls.', '2020-11-09 16:57:07'),
(2, 'Your question is submitted successfully having title as qwer.', '2020-11-09 17:11:23');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject_id` smallint(6) NOT NULL,
  `title` varchar(50) NOT NULL,
  `question_description` text NOT NULL,
  `answered` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `user_id`, `subject_id`, `title`, `question_description`, `answered`, `timestamp`) VALUES
(1, 2, 0, 'Question title', 'Question description', 0, '2020-11-09 10:38:31');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` smallint(6) NOT NULL,
  `dept_id` tinyint(4) NOT NULL,
  `subject_name` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `dept_id`, `subject_name`) VALUES
(1, 1, 'Advanced Web Technologies'),
(2, 1, 'Software Testing'),
(3, 2, 'Product Design'),
(4, 2, 'Design machines'),
(5, 3, 'Design of Concrete Structure');

-- --------------------------------------------------------

--
-- Table structure for table `subject_mapper`
--

CREATE TABLE `subject_mapper` (
  `user_id` int(11) NOT NULL,
  `subject_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_mapper`
--

INSERT INTO `subject_mapper` (`user_id`, `subject_id`) VALUES
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `temp_questions`
--

CREATE TABLE `temp_questions` (
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject_id` smallint(6) NOT NULL,
  `title` varchar(50) NOT NULL,
  `question_description` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_questions`
--

INSERT INTO `temp_questions` (`question_id`, `user_id`, `subject_id`, `title`, `question_description`, `timestamp`) VALUES
(3, 2, 1, 'Controls', '123', '2020-11-09 16:57:06'),
(4, 2, 1, 'Controls', '123', '2020-11-09 17:09:35'),
(5, 2, 2, 'qwer', '3er', '2020-11-09 17:09:53'),
(6, 2, 2, 'qwer', '3er', '2020-11-09 17:11:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT 1,
  `password` varchar(15) NOT NULL,
  `dept_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `user_type`, `password`, `dept_id`) VALUES
(1, 'Campus', 'admin', 'admin@campusbuddy.com', 3, '123456', 1),
(2, 'Priyank', 'Vekariya', 'priyank@campusbuddy.com', 1, '123456', 1),
(3, 'Faculty', 'Faculty', 'faculty@campusbuddy.com', 2, '123456', 1),
(4, 'Hardik', 'Khunt', 'hardik@campus.com', 1, '123456', 2);

-- --------------------------------------------------------

--
-- Table structure for table `verify_user`
--

CREATE TABLE `verify_user` (
  `email` varchar(50) NOT NULL,
  `OTP` varchar(6) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`),
  ADD UNIQUE KEY `dept_name` (`dept_name`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`),
  ADD UNIQUE KEY `subject_name` (`subject_name`);

--
-- Indexes for table `temp_questions`
--
ALTER TABLE `temp_questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `verify_user`
--
ALTER TABLE `verify_user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `temp_questions`
--
ALTER TABLE `temp_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
