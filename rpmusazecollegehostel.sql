-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 04:41 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rpmusazecollegehostel`
--

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE `beds` (
  `room_number` int(11) NOT NULL,
  `bed_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beds`
--

INSERT INTO `beds` (`room_number`, `bed_number`) VALUES
(2, 5),
(12, 1),
(12, 2),
(44, 3),
(666, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `registration_number` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `department` varchar(50) DEFAULT NULL,
  `year_of_study` int(11) DEFAULT NULL,
  `academic_year` varchar(20) DEFAULT NULL,
  `room_number` int(11) NOT NULL,
  `bed_number` int(11) NOT NULL,
  `date_of_accommodation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`registration_number`, `first_name`, `last_name`, `gender`, `department`, `year_of_study`, `academic_year`, `room_number`, `bed_number`, `date_of_accommodation`) VALUES
('23RP01865', 'DIEUDONNE', 'NIYIONSABA', 'Male', 'E-commerce', 0, '2024-2025', 44, 3, '2024-11-02 16:11:37'),
('24RP11363', 'NKUNDIMANA', 'Regis', 'Male', 'IT', 4, '2024-2025', 666, 1, '2024-10-29 23:00:57'),
('24RP14601', 'NIYOMUHOZA', 'Chantal', 'Female', 'Hosptality management', 3, '2024-2025', 12, 1, '2024-10-29 23:02:10'),
('24RP22334', 'SIMBI', 'Nicole', 'Female', 'CIVIL', 4, '2024-2025', 12, 2, '2024-10-29 23:05:50'),
('24RP233454', 'IRADUKUNDA ', 'Patrick', 'Male', 'Electronics', 1, '2024-2025', 2, 5, '2024-10-30 08:28:34');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_number` int(11) NOT NULL,
  `room_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_number`, `room_category`) VALUES
(0, 'Ladies_Hostel'),
(2, 'Gents_Hostel'),
(4, 'Ladies_Hostel'),
(8, 'Ladies_Hostel'),
(9, 'Ladies_Hostel'),
(12, 'Ladies_Hostel'),
(23, 'Ladies_Hostel'),
(44, 'Gents_Hostel'),
(99, 'Gents_Hostel'),
(100, 'Gents_Hostel'),
(123, 'Ladies_Hostel'),
(666, 'Gents_Hostel'),
(767, 'Gents_Hostel');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `email` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`email`, `first_name`, `last_name`, `telephone`, `position`, `password`) VALUES
('wealthaffair@gmail.com', 'marie', 'marie', '0783456845', 'student wealth affair', 'wealth');

-- --------------------------------------------------------

--
-- Table structure for table `studentlogs`
--

CREATE TABLE `studentlogs` (
  `id` int(11) NOT NULL,
  `registration_number` varchar(50) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `year_of_study` varchar(50) DEFAULT NULL,
  `academic_year` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentlogs`
--

INSERT INTO `studentlogs` (`id`, `registration_number`, `first_name`, `last_name`, `gender`, `telephone`, `email`, `department`, `year_of_study`, `academic_year`, `password`) VALUES
(1, '24RP11363', 'NKUNDIMANA', 'Regis', 'Male', '0789733274', 'regisnkundimana77@gmail.com', 'IT', '4', '2024-2025', '$2y$10$BdkLwG/kcjKMYPq5w.fnEeEQjZuwwq09eDtBzryBuU29lFWeoIsb.'),
(2, '24RP233454', 'IRADUKUNDA ', 'Patrick', 'Male', '788845453', 'piradukunda@gmail.com', 'Electronics', '1', '2024-2025', '$2y$10$IhYifhlAfWu22HkyKthgNeaEjn5swVL6SKgnJfYLctrCPyk7jrLgC');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `registration_number` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `department` varchar(50) DEFAULT NULL,
  `year_of_study` int(11) DEFAULT NULL,
  `academic_year` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`registration_number`, `first_name`, `last_name`, `gender`, `telephone`, `email`, `department`, `year_of_study`, `academic_year`) VALUES
('23RP01865', 'DIEUDONNE', 'NIYIONSABA', 'Male', '78873783', 'niyi@gmailo.com', 'E-commerce', 0, '2024-2025'),
('24RP11363', 'NKUNDIMANA', 'Regis', 'Male', '0789733274', 'regisnkundimana77@gmail.com', 'IT', 4, '2024-2025'),
('24RP14601', 'NIYOMUHOZA', 'Chantal', 'Female', '788850123', 'muhozachanto', 'Hosptality management', 3, '2024-2025'),
('24RP14622', 'NIYONSENGA ', 'Dieudonne', 'Male', '0788675433', 'dhsdas@gmail.com', 'Crop Production', 3, '2024-2025'),
('24RP14647', 'NIYIGABA', 'Claude', 'Male', '0788545123', 'nclaude12@yahoo.fr', 'E-commerce', 2, '2024-2025'),
('24RP22334', 'SIMBI', 'Nicole', 'Female', '0788408401', 'hopeforliferwanda@yahoo.com', 'CIVIL', 4, '2024-2025'),
('24RP233454', 'IRADUKUNDA ', 'Patrick', 'Male', '788845453', 'piradukunda@gmail.com', 'Electronics', 1, '2024-2025'),
('24RP23453', 'TURIKUMANA', 'ANTOINE', 'Male', '789733278', 'atur@gmail.com', 'Civil', 3, '2024-205');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beds`
--
ALTER TABLE `beds`
  ADD PRIMARY KEY (`room_number`,`bed_number`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`registration_number`,`bed_number`),
  ADD KEY `room_number` (`room_number`,`bed_number`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_number`),
  ADD UNIQUE KEY `room_number` (`room_number`,`room_category`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `studentlogs`
--
ALTER TABLE `studentlogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registration_number` (`registration_number`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`registration_number`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `studentlogs`
--
ALTER TABLE `studentlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beds`
--
ALTER TABLE `beds`
  ADD CONSTRAINT `beds_ibfk_1` FOREIGN KEY (`room_number`) REFERENCES `rooms` (`room_number`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`registration_number`) REFERENCES `students` (`registration_number`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`room_number`,`bed_number`) REFERENCES `beds` (`room_number`, `bed_number`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
