-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2025 at 11:24 AM
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
-- Database: `studentonlineformdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `status` enum('present','absent') NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `student_id`, `student_name`, `date`, `status`, `created_at`) VALUES
(9, 1, 'NUR AINATUL MARDHIYAH BINTI MOHAMAD', '2025-02-09', 'absent', '2025-02-10 06:37:30.796062'),
(15, 5, 'NUR AINATUL MARDHIYAH BINTI MOHAMAD', '2025-02-10', 'present', '2025-02-10 06:37:07.118296');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `instructor` varchar(50) DEFAULT 'NUR FATHIHAH MAISARAH BINTI PIEI',
  `credits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `instructor`, `credits`) VALUES
(3, 'Chemistry', 'NUR FATHIHAH MAISARAH BINTI PIEI', 3),
(4, 'Biology', 'NUR FATHIHAH MAISARAH BINTI PIEI', 3),
(5, 'IMS566', 'NUR FATHIHAH MAISARAH BINTI PIEI', 3),
(6, 'IMS560', 'NUR FATHIHAH MAISARAH BINTI PIEI', 3),
(7, 'IMS564', 'NUR FATHIHAH MAISARAH BINTI PIEI', 3),
(8, 'LCC501', 'NUR FATHIHAH MAISARAH BINTI PIEI', 3),
(9, 'CTU555', 'NUR FATHIHAH MAISARAH BINTI PIEI', 3),
(10, 'IMS566', 'NUR FATHIHAH MAISARAH BINTI PIEI', 4);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `enrollment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enrollment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_submission`
--

CREATE TABLE `form_submission` (
  `form_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `assignment_name` varchar(50) NOT NULL,
  `form_type` varchar(50) NOT NULL,
  `submission_date` date NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `course_id` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `name`, `email`, `phone_number`, `course_id`, `password`, `status`, `created_at`) VALUES
(1, 'SAFIKA BINTI ABDUL KARIM', '202467565@uitm.edu.my', '011-6133136', 'CDIM262', '12345678', 'Active', '2025-02-09 17:54:29'),
(2, 'NUR AINATUL MARDHIYAH BINTI MOHAMAD', '2024388929@uitm.edu.my', '011-14850539', 'CDIM262', '', 'Active', '2025-02-09 14:35:23'),
(3, 'MUHD KHAIRUL AR-RASHID BIN PIEI', '2024456787@uitm.edu.my', '', '', '', 'Active', '2025-02-09 14:51:23'),
(6, 'MOHD AFIQ BIN MOHD MANAF', '2024387878@uitm.edu.my', '', '', '', 'Active', '2025-02-10 06:36:21');

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `submission_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `assignment_name` varchar(50) NOT NULL,
  `submission_date` date NOT NULL,
  `file_url` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`submission_id`, `student_id`, `student_name`, `assignment_name`, `submission_date`, `file_url`, `status`) VALUES
(4, 1, '', '0', '0000-00-00', '0', ''),
(5, 1, '', 'IMS56 PAIR ASSIGNEMENT', '0000-00-00', '0', ''),
(6, 1, '', 'LCC501 PAIR ASSIGNMENT', '2025-02-09', '0', ''),
(7, 1, '', 'IMS56 PAIR ASSIGNEMENT', '2025-02-09', '0', ''),
(8, 1, '', 'IMS560 PAIR ASSIGNEMENT', '2025-02-09', '0', ''),
(9, 1, '', 'IMS560 PAIR ASSIGNEMENT', '2025-02-09', '0', ''),
(10, 1, '', 'IMS560 PAIR ASSIGNEMENT', '2025-02-09', '0', ''),
(11, 1, '', 'IMS560 PAIR ASSIGNEMENT', '2025-02-09', '0', ''),
(12, 1, '', 'IMS560 PAIR ASSIGNEMENT', '2025-02-09', '0', ''),
(13, 1, '', 'IMS560 PAIR ASSIGNEMENT', '2025-02-09', '0', ''),
(14, 1, '', 'LCC501 PAIR ASSIGNMENT', '2025-02-09', '0', ''),
(15, 1, '', 'IMS560 PAIR ASSIGNEMENT', '2025-02-09', '0', ''),
(16, 1, '', 'LCC501 PAIR ASSIGNMENT', '2025-02-09', '0', ''),
(17, 1, '', 'LCC501 PAIR ASSIGNMENT', '2025-02-09', '0', ''),
(18, 1, '', 'LCC501 PAIR ASSIGNMENT', '2025-02-09', '0', ''),
(19, 1, '', 'LCC501 PAIR ASSIGNMENT', '2025-02-09', '0', ''),
(20, 1, '', 'LCC501 PAIR ASSIGNMENT', '2025-02-09', '0', ''),
(21, 1, '', 'LCC501 PAIR ASSIGNMENT', '2025-02-09', '0', ''),
(22, 1, '', 'IMS560 PAIR ASSIGNEMENT', '2025-02-09', '0', ''),
(23, 1, '', 'IMS560 PAIR ASSIGNEMENT', '2025-02-09', '0', ''),
(24, 1, '', 'IMS560 PAIR ASSIGNEMENT', '2025-02-09', '0', ''),
(25, 1, '', 'IMS560 PAIR ASSIGNEMENT', '2025-02-09', '0', ''),
(26, 1, '', 'IMS560 PAIR ASSIGNEMENT', '2025-02-09', '0', ''),
(27, 1, '', 'CTU552', '2025-02-09', 'uploads/67a91f956baa5-MOOC CTU552 - NOTA BAB 6 EPISTEMOLOGI (2).pdf', ''),
(28, 1, '', 'CTU552', '2025-02-09', 'uploads/67a92d29945c2-MOOC CTU552 - NOTA BAB 6 EPISTEMOLOGI (2).pdf', ''),
(29, 1, '', 'IMS560 PAIR ASSIGNEMENT', '2025-02-10', 'uploads/67a99d2a664b7-Pair Assignment IMS560 (1).pdf', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` enum('admin','student','staff','') NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `institution` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `role`, `last_login`, `institution`) VALUES
(3, 'NUR AINATUL MARDHIYAH BINTI MOHAMAD', '12345678', '2024388929@uitm.edu.my', 'student', '2025-02-09 22:39:23', 'Universiti Teknologi MARA (UiTM)'),
(4, 'NUR FATHIHAH MAISARAH BINTI PIEI', '09876543', '2024947793@uitm.edu.my', 'staff', '2025-02-09 23:34:13', 'Universiti Teknologi MARA (UiTM)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `form_submission`
--
ALTER TABLE `form_submission`
  ADD PRIMARY KEY (`form_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`submission_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `form_submission`
--
ALTER TABLE `form_submission`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `submission`
--
ALTER TABLE `submission`
  ADD CONSTRAINT `submission_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
