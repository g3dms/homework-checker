-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2026 at 03:40 PM
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
-- Database: `ictsba`
--

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `id` int(11) NOT NULL,
  `due` datetime(6) NOT NULL,
  `class` varchar(4) NOT NULL,
  `subject` varchar(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `instructions` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homework`
--

INSERT INTO `homework` (`id`, `due`, `class`, `subject`, `name`, `instructions`) VALUES
(1, '0000-00-00 00:00:00.000000', 'S6B', 'ths', 'THS HW', ''),
(2, '2024-12-19 00:17:00.000000', 'S6B', 'eng', 'English Writing', 'Write a feature article on composition paper'),
(3, '0000-00-00 00:00:00.000000', 'S6B', 'eng', 'English writing', ''),
(4, '2024-12-01 09:25:00.000000', 'S6B', 'phys', 'Physics Problem Set', ''),
(5, '2024-12-01 09:47:00.000000', 'S6A', 'hist', 'Essay 1', ''),
(6, '2024-12-04 09:50:00.000000', 'S1G1', 'eng', 'Writing Assignment', 'Write a short story about your favorite animal.'),
(7, '0000-00-00 00:00:00.000000', 'S1G1', 'is', 'Poster', 'Create a poster about the water cycle.'),
(8, '0000-00-00 00:00:00.000000', 'S1G2', 'ls', 'Presentation next week', 'Research and present on a local environmental issue.'),
(9, '2024-12-05 12:12:00.000000', 'S6B', 'chem', 'Problem set', ''),
(10, '0000-00-00 00:00:00.000000', 'S3A', 'chem', 'Problem set', ''),
(11, '2024-12-01 12:18:00.000000', 'S6B', 'eng', 'English writing draft', 'Feature article'),
(12, '2024-12-21 16:23:00.000000', 'S4A', 'bio', 'Problem set', ''),
(13, '2024-12-18 16:24:00.000000', 'S5A', 'phys', 'Mechanics HW', ''),
(14, '0000-00-00 00:00:00.000000', 'S6B', 'eng', 'Listening practice', ''),
(15, '2024-12-28 20:38:00.000000', 'S6B', 'eng', 'english listening', 'task 10 b2'),
(16, '0000-00-00 00:00:00.000000', 'S5B', 'econ', 'Worksheet', 'pls do it by monday'),
(17, '2025-01-16 10:30:00.000000', 'S5A', 'chist', 'worksheet', ''),
(18, '2025-01-16 10:30:00.000000', 'S5A', 'chist', 'worksheet 2', ''),
(19, '2025-01-16 10:30:00.000000', 'S5A', 'chist', 'worksheet 3', ''),
(20, '0000-00-00 00:00:00.000000', 'S6B', 'eng', 'Reading HW', ''),
(21, '2025-01-23 18:16:00.000000', 'S6B', 'phys', 'EM Problem set', 'Do Q3-15'),
(22, '2025-02-01 18:18:00.000000', 'S6B', 'bio', 'TB P6-11', ''),
(23, '0000-00-00 00:00:00.000000', 'S6B', 'm2', 'HWB Ex5 Q1-3', ''),
(24, '2025-01-31 18:22:00.000000', 'S6B', 'eng', 'English speaking', 'Prepare notes for tomorrow'),
(25, '2025-02-08 18:23:00.000000', 'S6B', 'bio', 'Ex 6 Q4, 5', ''),
(26, '0000-00-00 00:00:00.000000', 'S6B', 'eng', 'English writing', ''),
(27, '0000-00-00 00:00:00.000000', 'S6B', 'm2', 'practice', '');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(8) NOT NULL,
  `password` varchar(30) NOT NULL,
  `usertype` varchar(10) NOT NULL,
  `monitorbool` tinyint(1) NOT NULL,
  `monitorclass` varchar(10) NOT NULL,
  `class` varchar(4) NOT NULL,
  `E1` varchar(10) NOT NULL,
  `E2` varchar(10) NOT NULL,
  `E3` varchar(10) NOT NULL,
  `E4` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `usertype`, `monitorbool`, `monitorclass`, `class`, `E1`, `E2`, `E3`, `E4`) VALUES
(1, 's1301011', 'student', 'student', 1, 'eng', 'S6B', 'ict', 'phys', 'bio', 'm2'),
(2, 'gdm', 'teacher', 'teacher', 0, '', '', '', '', '', ''),
(3, 's1911047', 'student', 'student', 0, '', 'S6B', 'bm', 'ths', 'econ', ''),
(4, 's1301021', 'student', 'student', 0, '', 'S6B', 'chem', 'phys', 'bio', 'm2'),
(5, 's1402068', 'student', 'student', 0, '', 'S6B', 'ict', 'phys', 'bio', 'm2'),
(6, 'aj', 'teacher', 'teacher', 0, '', '', '', '', '', ''),
(7, 's1911057', 'student', 'student', 1, 'elit', 'S6B', '', 'ths', 'elit', ''),
(8, 's1301023', 'student', 'student', 1, 'ths', '', 'ict', 'ths', 'elit', ''),
(9, 's1402001', 'student', 'student', 1, 'bio', 'S6B', 'ict', '', 'bio', ''),
(10, 's1301031', 'student', 'student', 0, '', 'S6B', 'ict', 'ths', 'elit', ''),
(11, 'banana', 'student', 'student', 0, '', 'S3B', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `id` int(11) NOT NULL,
  `student_id` varchar(8) NOT NULL,
  `homework_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`id`, `student_id`, `homework_id`) VALUES
(1, 's1301011', 2),
(2, 's1301011', 4),
(3, 's1301011', 11),
(4, 's1301011', 3),
(5, 's1301031', 2),
(6, 's1301031', 11),
(7, 's1301021', 2),
(8, 's1301021', 3),
(9, 's1301021', 4),
(10, 's1301021', 14),
(11, 's1301011', 14),
(12, 's1301011', 15),
(13, 's1301021', 9),
(14, 's1301021', 11),
(15, 's1301021', 15),
(16, 's1911057', 1),
(17, 's1911057', 11),
(18, 's1911057', 14),
(19, 's1301011', 20),
(20, 's1301021', 20),
(21, 's1301021', 21),
(22, 's1301021', 22),
(23, 's1301021', 23),
(24, 's1301021', 24),
(25, 's1301011', 21),
(26, 's1301011', 23);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `login` ADD FULLTEXT KEY `password` (`password`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
