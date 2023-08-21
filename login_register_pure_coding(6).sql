-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2023 at 03:21 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_register_pure_coding`
--

-- --------------------------------------------------------

--
-- Table structure for table `addedtocart`
--

CREATE TABLE `addedtocart` (
  `id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addedtocart`
--

INSERT INTO `addedtocart` (`id`, `user_id`, `title`, `description`) VALUES
(19, 0, 'Momin', '../uploads/IMG-64b2bc37a2bc38.24345577.jpeg'),
(40, 1, 'momin', '../uploads/IMG-64b2e52b691201.39969327.jpg'),
(67, 18, 'peter', '../uploads/IMG-64b3e0fd10b380.20601195.jpg'),
(70, 2, 'Khan', '../uploads/IMG-64b3e0e86e0642.18915254.jpg'),
(76, 2, 'Bhai', '../uploads/IMG-64e20c944bf220.80502545.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `admin_email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin1234'),
(2, 'satish', 'satish@gmail.com', '123'),
(3, 'shahil', 's@gmail.com', '123'),
(4, 'hello', '1@gmail.com', '123'),
(5, 'user', 'u@gmail.com', '123'),
(6, 'admin123', 'WWW@gmail.com', '123'),
(7, 'hero', 'hero@gmail.com', '123'),
(8, 'satish', 'satish.karki.330@gmail.com', '202cb962ac59075b964b');

-- --------------------------------------------------------

--
-- Table structure for table `adoptedpets`
--

CREATE TABLE `adoptedpets` (
  `sno` int(100) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adoptedpets`
--

INSERT INTO `adoptedpets` (`sno`, `title`, `description`) VALUES
(45, 'Boiii', '../uploads/IMG-64b2c333116999.70845483.jpg'),
(46, 'Ramu', '../uploads/IMG-64b2c318810122.70516131.jpg'),
(214, 'peter', '../uploads/IMG-64b3e0fd10b380.20601195.jpg'),
(228, 'www', ''),
(229, 'asasas', '../uploads/IMG-64e20cb748b746.91570775.jpg'),
(230, 'Bhai', '../uploads/IMG-64e20c944bf220.80502545.jpg'),
(231, 'sss', '../uploads/IMG-64e230d632b018.54467596.jpg'),
(232, 'hjjjjj', '../uploads/IMG-64e230ebbd5635.60724441.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `availablepets`
--

CREATE TABLE `availablepets` (
  `sno` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `species` varchar(50) NOT NULL,
  `breed` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `doctor_contact` varchar(15) NOT NULL,
  `health_condition` varchar(100) NOT NULL,
  `owner_contact` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `availablepets`
--

INSERT INTO `availablepets` (`sno`, `title`, `description`, `species`, `breed`, `age`, `gender`, `weight`, `doctor_contact`, `health_condition`, `owner_contact`) VALUES
(185, 'aayush', '../uploads/IMG-64e363b970e061.45273661.jpeg', 'rr', 'dd', 11, 'nak', '22 kg', '1111111111', 'G', '1111111111'),
(186, 'don', '../uploads/IMG-64e363d610a7b3.11654306.jpg', 'dd', 'ss', 11, 'ss', '33 kg', '1111111111', 'sss', '1111111111');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `social` varchar(255) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `phone`, `social`, `message`) VALUES
(1, 'satish', 'satish@gmail.com', '9815555', '@gopal', 'hii very good website\r\n'),
(9, 'Ramu', 'ramu@gmail.com', '9877757843', '@Ramu.php', 'Hi very good website but i think you should add Dark mode, its so cool!!\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `rescue_form`
--

CREATE TABLE `rescue_form` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `number` int(20) NOT NULL,
  `breed` varchar(50) NOT NULL,
  `image` varchar(250) NOT NULL,
  `quantity` int(20) NOT NULL,
  `date` date NOT NULL,
  `address` varchar(50) NOT NULL,
  `message` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rescue_form`
--

INSERT INTO `rescue_form` (`id`, `fullname`, `number`, `breed`, `image`, `quantity`, `date`, `address`, `message`) VALUES
(10, 'satish karki', 2147483647, 'dog', 'IMG-64b3f85630c8e5.38991185.jpg', 1, '2023-07-04', 'balkumari pul ', 'Hi here i found a dog which need help.. please!!'),
(11, 'shahil', 95598556, 'cat', 'IMG-64b3fa80c1ddd2.73713211.jpeg', 1, '2023-07-06', 'jadibuti buspark', 'Hii! come fast');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone` int(10) NOT NULL,
  `course` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `phone`, `course`) VALUES
(2, 'satish karki', 'satish.karki.330@gmail.com', 989898222, 'BCA');

-- --------------------------------------------------------

--
-- Table structure for table `try_form`
--

CREATE TABLE `try_form` (
  `name` varchar(500) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `cpassword` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `cpassword`) VALUES
(1, 'kukur', 'kukur@gmail.com', '202cb962ac59075b964b07152d234b70', ''),
(2, 'satish', 'satish.karki.330@gmail.com', '202cb962ac59075b964b07152d234b70', ''),
(3, 'shahil', 'shahilkesari123@gmail.com', '202cb962ac59075b964b07152d234b70', ''),
(4, 'shahil', 'shail@gmail.com', '202cb962ac59075b964b07152d234b70', ''),
(5, 'Gopal', 'Gopal@gmail.com', '202cb962ac59075b964b07152d234b70', ''),
(6, 'hasin', 'h@gmail.com', '202cb962ac59075b964b07152d234b70', ''),
(7, 'bishon', 'bishon@gmail.com', '3337381473e04c05fafc4db52fac78cd', ''),
(23, 'satish12', 'satish@gmail.com', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addedtocart`
--
ALTER TABLE `addedtocart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adoptedpets`
--
ALTER TABLE `adoptedpets`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `availablepets`
--
ALTER TABLE `availablepets`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rescue_form`
--
ALTER TABLE `rescue_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
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
-- AUTO_INCREMENT for table `addedtocart`
--
ALTER TABLE `addedtocart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `adoptedpets`
--
ALTER TABLE `adoptedpets`
  MODIFY `sno` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `availablepets`
--
ALTER TABLE `availablepets`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rescue_form`
--
ALTER TABLE `rescue_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
