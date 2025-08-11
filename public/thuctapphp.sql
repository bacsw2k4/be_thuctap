-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2025 at 10:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thuctapphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `letter`
--

CREATE TABLE `letter` (
  `letterId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `approverId` int(11) DEFAULT NULL,
  `categoryLetter` varchar(100) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `attachment` varchar(500) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `approvalDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `letter`
--

INSERT INTO `letter` (`letterId`, `userId`, `title`, `content`, `approverId`, `categoryLetter`, `startDate`, `endDate`, `attachment`, `status`, `createdAt`, `approvalDate`) VALUES
(43, 21, 'Đơn xin nghỉ phép', 'Tôi xin nghỉ 2 ngày vì lý do cá nhân.', 41, 'Nghỉ phép', '2025-08-01', '2025-08-02', NULL, 'Chờ duyệt', '2025-08-11 08:07:19', NULL),
(44, 25, 'Đơn xin công tác', 'Tôi xin đi công tác Hà Nội.', 7, 'Công tác', '2025-08-05', '2025-08-08', NULL, 'approved', '2025-08-11 08:07:19', '2025-08-04'),
(45, 23, 'Đơn xin làm thêm giờ', 'Tôi xin phép làm thêm 3 giờ vào ngày 10/8.', 6, 'Làm thêm giờ', '2025-08-10', '2025-08-10', NULL, 'Chờ duyệt', '2025-08-11 08:07:19', NULL),
(46, 40, 'Đơn xin nghỉ ốm', 'Tôi bị ốm nên xin nghỉ 3 ngày.', 9, 'Nghỉ ốm', '2025-08-03', '2025-08-05', NULL, 'approved', '2025-08-11 08:07:19', '2025-08-02'),
(47, 32, 'Đơn xin nghỉ phép', 'Tôi xin nghỉ 1 ngày.', 41, 'Nghỉ phép', '2025-08-12', '2025-08-12', NULL, 'Chờ duyệt', '2025-08-11 08:07:19', NULL),
(48, 28, 'Đơn xin công tác', 'Tôi xin đi công tác Đà Nẵng.', 8, 'Công tác', '2025-08-15', '2025-08-18', NULL, 'Đã hủy', '2025-08-11 08:07:19', '2025-08-14'),
(49, 35, 'Đơn xin làm thêm giờ', 'Xin làm thêm để hoàn thành dự án.', 3, 'Làm thêm giờ', '2025-08-20', '2025-08-20', NULL, 'approved', '2025-08-11 08:07:19', '2025-08-19'),
(50, 30, 'Đơn xin nghỉ ốm', 'Bị sốt cao xin nghỉ.', 41, 'Nghỉ ốm', '2025-08-07', '2025-08-08', NULL, 'Chờ duyệt', '2025-08-11 08:07:19', NULL),
(51, 26, 'Đơn xin nghỉ phép', 'Nghỉ để giải quyết việc gia đình.', 5, 'Nghỉ phép', '2025-08-22', '2025-08-23', NULL, 'approved', '2025-08-11 08:07:19', '2025-08-21'),
(52, 38, 'Đơn xin công tác', 'Đi khảo sát dự án mới.', 41, 'Công tác', '2025-08-25', '2025-08-27', NULL, 'Chờ duyệt', '2025-08-11 08:07:19', NULL),
(53, 37, 'Đơn xin nghỉ ốm', 'Bị đau lưng xin nghỉ 2 ngày.', 6, 'Nghỉ ốm', '2025-08-17', '2025-08-18', NULL, 'approved', '2025-08-11 08:07:19', '2025-08-16'),
(54, 33, 'Đơn xin nghỉ phép', 'Xin nghỉ phép 4 ngày.', 4, 'Nghỉ phép', '2025-08-28', '2025-08-31', NULL, 'Đã hủy', '2025-08-11 08:07:19', NULL),
(55, 24, 'Đơn xin công tác', 'Đi gặp khách hàng tại Hải Phòng.', 8, 'Công tác', '2025-08-06', '2025-08-07', NULL, 'approved', '2025-08-11 08:07:19', '2025-08-05'),
(56, 29, 'Đơn xin làm thêm giờ', 'Làm thêm để hoàn thành hợp đồng.', 3, 'Làm thêm giờ', '2025-08-14', '2025-08-14', NULL, 'Đã hủy', '2025-08-11 08:07:19', NULL),
(57, 34, 'Đơn xin nghỉ ốm', 'Xin nghỉ do đau đầu.', 2, 'Nghỉ ốm', '2025-08-09', '2025-08-09', NULL, 'Đã hủy', '2025-08-11 08:07:19', '2025-08-08'),
(58, 31, 'Đơn xin nghỉ phép', 'Nghỉ đi du lịch với gia đình.', 5, 'Nghỉ phép', '2025-08-11', '2025-08-13', NULL, 'approved', '2025-08-11 08:07:19', '2025-08-10'),
(59, 27, 'Đơn xin công tác', 'Đi tham dự hội thảo công nghệ.', 7, 'Công tác', '2025-08-19', '2025-08-21', NULL, 'Chờ duyệt', '2025-08-11 08:07:19', NULL),
(60, 36, 'Đơn xin làm thêm giờ', 'Làm thêm ca tối.', 6, 'Làm thêm giờ', '2025-08-24', '2025-08-24', NULL, 'approved', '2025-08-11 08:07:19', '2025-08-23'),
(61, 39, 'Đơn xin nghỉ ốm', 'Cảm cúm xin nghỉ.', 9, 'Nghỉ ốm', '2025-08-26', '2025-08-27', NULL, 'Đã hủy', '2025-08-11 08:07:19', NULL),
(62, 22, 'Đơn xin nghỉ phép', 'Xin nghỉ phép 1 ngày.', 4, 'Nghỉ phép', '2025-08-29', '2025-08-29', NULL, 'approved', '2025-08-11 08:07:19', '2025-08-28');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `fullName` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `userType` varchar(50) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `username`, `fullName`, `password`, `email`, `dob`, `userType`, `department`, `status`, `createdAt`) VALUES
(21, 'user1', 'Nguyen Van A', '123456', 'user1@example.com', '1990-01-01', 'nhân viên', 'IT', 'active', '2025-08-11 08:02:59'),
(22, 'user2', 'Nguyen Van B', '123456', 'user2@example.com', '1991-02-02', 'staff', 'HR', 'active', '2025-08-11 08:02:59'),
(23, 'user3', 'Nguyen Van C', '123456', 'user3@example.com', '1992-03-03', 'staff', 'Finance', 'inactive', '2025-08-11 08:02:59'),
(24, 'user4', 'Nguyen Van D', '123456', 'user4@example.com', '1993-04-04', 'nhân viên', 'IT', 'active', '2025-08-11 08:02:59'),
(25, 'user5', 'Nguyen Van E', '123456', 'user5@example.com', '1994-05-05', 'staff', 'HR', 'active', '2025-08-11 08:02:59'),
(26, 'user6', 'Nguyen Van F', '123456', 'user6@example.com', '1995-06-06', 'staff', 'Finance', 'inactive', '2025-08-11 08:02:59'),
(27, 'user7', 'Nguyen Van G', '123456', 'user7@example.com', '1996-07-07', 'nhân viên', 'IT', 'active', '2025-08-11 08:02:59'),
(28, 'user8', 'Nguyen Van H', '123456', 'user8@example.com', '1997-08-08', 'staff', 'HR', 'active', '2025-08-11 08:02:59'),
(29, 'user9', 'Nguyen Van I', '123456', 'user9@example.com', '1998-09-09', 'staff', 'Finance', 'inactive', '2025-08-11 08:02:59'),
(30, 'user10', 'Nguyen Van J', '123456', 'user10@example.com', '1999-10-10', 'admin', 'IT', 'active', '2025-08-11 08:02:59'),
(31, 'user11', 'Nguyen Van K', '123456', 'user11@example.com', '1989-01-11', 'staff', 'HR', 'active', '2025-08-11 08:02:59'),
(32, 'user12', 'Nguyen Van L', '123456', 'user12@example.com', '1988-02-12', 'staff', 'Finance', 'inactive', '2025-08-11 08:02:59'),
(33, 'user13', 'Nguyen Van M', '123456', 'user13@example.com', '1987-03-13', 'admin', 'IT', 'active', '2025-08-11 08:02:59'),
(34, 'user14', 'Nguyen Van N', '123456', 'user14@example.com', '1986-04-14', 'staff', 'HR', 'active', '2025-08-11 08:02:59'),
(35, 'user15', 'Nguyen Van O', '123456', 'user15@example.com', '1985-05-15', 'staff', 'Finance', 'inactive', '2025-08-11 08:02:59'),
(36, 'user16', 'Nguyen Van P', '123456', 'user16@example.com', '1984-06-16', 'admin', 'IT', 'active', '2025-08-11 08:02:59'),
(37, 'user17', 'Nguyen Van Q', '123456', 'user17@example.com', '1983-07-17', 'staff', 'HR', 'active', '2025-08-11 08:02:59'),
(38, 'user18', 'Nguyen Van R', '123456', 'user18@example.com', '1982-08-18', 'staff', 'Finance', 'inactive', '2025-08-11 08:02:59'),
(39, 'user19', 'Nguyen Van S', '123456', 'user19@example.com', '1981-09-19', 'admin', 'IT', 'active', '2025-08-11 08:02:59'),
(40, 'user20', 'Nguyen Van T', '123456', 'user20@example.com', '1980-10-20', 'staff', 'HR', 'active', '2025-08-11 08:02:59'),
(41, 'admin', 'BUI VAN HO BAC', '$2y$10$/xrDlYDyvgmkFRjFTNpL.um9GKCTPemAsd4pNRrMyTAPKK.gzsDPa', 'buihobac2k4@gmail.com', '2025-08-11', 'Quản lý', 'Phòng IT', 'Đang hoạt động', '2025-08-11 08:05:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `letter`
--
ALTER TABLE `letter`
  ADD PRIMARY KEY (`letterId`),
  ADD KEY `fk_letter_user` (`userId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `letter`
--
ALTER TABLE `letter`
  MODIFY `letterId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `letter`
--
ALTER TABLE `letter`
  ADD CONSTRAINT `fk_letter_user` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
