-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2017 at 07:47 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_tbl`
--

CREATE TABLE `attendance_tbl` (
  `a_id` int(11) NOT NULL,
  `subject` varchar(64) NOT NULL,
  `student` varchar(64) NOT NULL,
  `a_date` date DEFAULT NULL,
  `status` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance_tbl`
--

INSERT INTO `attendance_tbl` (`a_id`, `subject`, `student`, `a_date`, `status`) VALUES
(5, 'Internet Development', 'Atish Chaudhary', '2017-04-22', 'PRESENT'),
(6, 'Internet Development', 'Khusi Nandan', '2017-04-22', 'PRESENT'),
(7, 'Internet Development', 'Dipisha sen', '2017-04-22', 'PRESENT'),
(20, 'Internet Development', 'Atish Chaudhary', '2017-04-28', 'ABSENT'),
(21, 'Internet Development', 'Khusi Nandan', '2017-04-28', 'ABSENT'),
(22, 'Internet Development', 'Dipisha sen', '2017-04-28', 'ABSENT'),
(74, 'Internet Development', 'Atish Chaudhary', '2017-05-15', 'ONLEAVE'),
(75, 'Internet Development', 'Khusi Nandan', '2017-05-15', 'ONLEAVE'),
(76, 'Internet Development', 'Dipisha sen', '2017-05-15', 'ONLEAVE'),
(84, 'Computer system', 'Durga Chaudhary', '2017-05-16', 'ABSENT'),
(87, 'Internet Development', 'Atish Chaudhary', '2017-05-16', 'ONLEAVE'),
(88, 'Internet Development', 'Khusi Nandan', '2017-05-16', 'ONLEAVE'),
(89, 'Internet Development', 'Dipisha sen', '2017-05-16', 'ONLEAVE'),
(91, 'Digital Security', 'Karishma Chaudhary', '2017-05-16', 'PRESENT'),
(92, 'Digital Security', 'Satish Chaudhary', '2017-05-16', 'PRESENT');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `d_id` int(11) NOT NULL,
  `d_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`d_id`, `d_name`) VALUES
(1, 'BSC Computing'),
(2, 'Networking'),
(3, 'BBA'),
(4, 'MIT'),
(5, 'CA'),
(6, 'BSC (Hons) Computing');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `sem_id` int(11) NOT NULL,
  `sem_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`sem_id`, `sem_name`) VALUES
(1, 'SEMESTER1'),
(2, 'SEMESTER2'),
(3, 'SEMESTER3'),
(4, 'SEMESTER4'),
(5, 'SEMESTER5'),
(6, 'SEMESTER6'),
(7, 'SEMESTER7'),
(8, 'SEMESTER8');

-- --------------------------------------------------------

--
-- Table structure for table `staff_tbl`
--

CREATE TABLE `staff_tbl` (
  `staff_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `staff_fname` varchar(255) NOT NULL,
  `staff_lname` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `address` text NOT NULL,
  `degree` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL,
  `approve` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_tbl`
--

INSERT INTO `staff_tbl` (`staff_id`, `d_id`, `username`, `staff_fname`, `staff_lname`, `password`, `dateOfBirth`, `address`, `degree`, `phone`, `email`, `usertype`, `approve`) VALUES
(1, 6, 'Staff001', 'Satish', 'Chaudhary', '8b1a9953c4611296a827abf8c47804d7', '1996-04-19', 'Kumari Club, Balkhu', 'BIT', 2147483647, 'satish4link@gmail.com', 'Faculty', 1),
(7, 4, 'Schand', 'Saroj', 'Chand', '5d41402abc4b2a76b9719d911017c592', '2001-03-12', 'Kathmandu', 'MBA', 2147483647, 'schand@gmail.com', 'Faculty', 1),
(8, 4, 'Jarun', 'Arun', 'Joshi', '5455c33e251ab225e5c61c67e1902769', '1972-11-05', 'Kathmandu, Nepal', 'MIT', 2147483647, 'arunjoshi@gmail.com', 'Faculty', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `registration_code` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `address` text NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`student_id`, `subject_id`, `registration_code`, `fname`, `lname`, `gender`, `dob`, `address`, `phone`, `email`, `semester`) VALUES
(2, 3, 'Student001', 'Atish', 'Chaudhary', 'Male', '2000-03-07', 'Balkhu, Kumari Club', 2147483647, 'gamer4link@gmail.com', 'SEMESTER 4'),
(3, 8, 'Student002', 'Durga', 'Chaudhary', 'female', '1997-03-07', 'Kumari Club, Balkhu', 2147483647, 'somya.cut@gmail.com', 'SEMESTER 2'),
(4, 3, 'Student003', 'Khusi', 'Nandan', 'Male', '1984-03-12', 'balkhu', 2147483647, 'khusi@gmail.com', 'SEMESTER 6'),
(5, 9, 'Student004', 'Karishma', 'Chaudhary', 'Female', '1986-03-12', 'Balkhu, Kathmandu', 2147483647, 'karishma@gmail.com', 'SEMESTER 4'),
(6, 3, 'dipisha001', 'Dipisha', 'sen', 'Female', '2000-10-22', 'kathmandu', 74123685, 'dipisha@gmail.com', 'SEMESTER 8'),
(7, 9, 'Satish001', 'Satish', 'Chaudhary', 'Male', '1996-04-19', 'Umajan, Bara', 2147483647, 'satish4link@gmail.com', 'SEMESTER 8');

-- --------------------------------------------------------

--
-- Table structure for table `subject_tbl`
--

CREATE TABLE `subject_tbl` (
  `subject_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_tbl`
--

INSERT INTO `subject_tbl` (`subject_id`, `d_id`, `sem_id`, `subject_name`) VALUES
(3, 6, 8, 'Internet Development'),
(8, 6, 3, 'Computer system'),
(9, 4, 8, 'Digital Security');

-- --------------------------------------------------------

--
-- Table structure for table `users_tbl`
--

CREATE TABLE `users_tbl` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL,
  `approve` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_tbl`
--

INSERT INTO `users_tbl` (`id`, `username`, `password`, `email`, `usertype`, `approve`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'satish4link@gmail.com', 'Admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`sem_id`);

--
-- Indexes for table `staff_tbl`
--
ALTER TABLE `staff_tbl`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `subject_tbl`
--
ALTER TABLE `subject_tbl`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `users_tbl`
--
ALTER TABLE `users_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `sem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `staff_tbl`
--
ALTER TABLE `staff_tbl`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `subject_tbl`
--
ALTER TABLE `subject_tbl`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users_tbl`
--
ALTER TABLE `users_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
