-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2025 at 10:32 AM
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
(1, 2, 'Vũ Hoàng Anh Xin Nghỉ Phép', 'Xử lý việc gia đình', 6, 'Đơn nghỉ phép', '2025-08-13', '2025-08-14', '2_1755053171_logo.png', 'Đã duyệt', '2025-08-13 02:46:14', '2025-08-13'),
(2, 4, 'Bùi Văn Phong Xin Nghỉ ốm', 'xử lý sức khỏe', 9, 'Đơn thay đổi giờ làm', '2025-08-13', '2025-08-14', '4_1755054019_Screenshot (1).png', 'Chờ duyệt', '2025-08-13 03:00:20', NULL),
(3, 5, 'Trần Huyền Trang xin nghỉ bận việc gia đình', 'xử lý việc gia đình', 8, 'Đơn xin thanh toán công tác phí', '2025-08-13', '2025-08-14', '5_1755054120_Screenshot (2).png', 'Chờ duyệt', '2025-08-13 03:02:02', NULL),
(4, 2, 'xin nghi đi du lịch', 'du lịch hạ long', 6, 'Đơn nghỉ phép', '2025-08-13', '2025-08-14', '2_1755055418_Screenshot (8).png', 'Đã hủy', '2025-08-13 03:23:40', '2025-08-13'),
(5, 2, 'a', 'a', 6, 'Đơn nghỉ phép', '2025-08-13', '2025-08-13', '2_1755069001_Screenshot (1).png', 'Chờ duyệt', '2025-08-13 07:10:03', NULL),
(6, 2, 'b', 'b', 6, 'Đơn nghỉ phép', '2025-08-13', '2025-08-13', '2_1755069020_Screenshot (2).png', 'Chờ duyệt', '2025-08-13 07:10:25', NULL),
(7, 2, 'c', 'c', 6, 'Đơn nghỉ phép', '2025-08-13', '2025-08-13', '2_1755069077_Screenshot (2).png', 'Chờ duyệt', '2025-08-13 07:11:19', NULL),
(8, 2, 'd', 'd', 6, 'Đơn nghỉ phép', '2025-08-13', '2025-08-13', '2_1755069098_Screenshot (2).png', 'Chờ duyệt', '2025-08-13 07:11:40', NULL),
(9, 2, 'f', 'f', 6, 'Đơn nghỉ phép', '2025-08-13', '2025-08-13', '2_1755069120_Screenshot (9).png', 'Chờ duyệt', '2025-08-13 07:12:02', NULL),
(10, 2, 'q', 'q', 6, 'Đơn nghỉ phép', '2025-08-13', '2025-08-13', '2_1755069149_Screenshot (8).png', 'Chờ duyệt', '2025-08-13 07:12:31', NULL),
(11, 2, 'xin nghỉ ốm', 'z', 6, 'Đơn nghỉ phép', '2025-08-13', '2025-08-13', '2_1755069170_Screenshot (9).png', 'Chờ duyệt', '2025-08-13 07:12:57', NULL),
(12, 2, 'test3', 'test3', 6, 'Đơn nghỉ phép', '2025-08-13', '2025-08-13', '2_1755069206_Screenshot (4).png', 'Chờ duyệt', '2025-08-13 07:13:27', NULL),
(13, 2, 'yjyjtyj', '3', 6, 'Đơn nghỉ phép', '2025-08-13', '2025-08-13', '2_1755069224_Screenshot (10).png', 'Chờ duyệt', '2025-08-13 07:13:46', NULL),
(14, 2, 'xin tang luong', 'v', 6, 'Đơn nghỉ phép', '2025-08-13', '2025-08-13', '2_1755069287_Screenshot (16).png', 'Chờ duyệt', '2025-08-13 07:14:49', NULL),
(15, 2, 'vu thanh tung', 'v', 6, 'Đơn nghỉ phép', '2025-08-13', '2025-08-13', '2_1755069310_Screenshot (9).png', 'Chờ duyệt', '2025-08-13 07:15:11', NULL),
(16, 2, 'vu thanh tung', 'v', 6, 'Đơn nghỉ phép', '2025-08-13', '2025-08-29', '2_1755069329_Screenshot (10).png', 'Chờ duyệt', '2025-08-13 07:15:31', NULL),
(17, 2, 'test3', 'c', 6, 'Đơn nghỉ phép', '2025-08-13', '2025-08-13', '2_1755069353_Screenshot (25).png', 'Chờ duyệt', '2025-08-13 07:15:56', NULL),
(18, 2, 'xin nghỉ ốm', 'c', 6, 'Đơn nghỉ phép', '2025-08-08', '2025-08-14', '2_1755069385_Screenshot (16).png', 'Chờ duyệt', '2025-08-13 07:16:27', NULL);

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
(1, 'admin', 'Bùi Văn Hồ Bắc', '$2y$10$VqHlPwh4KTvAqdzmKS7LReCEf7NQN0aak/q.JE5QnkR1H.oNuLk9K', 'buihobac2k44@gmail.com', '1990-05-15', 'admin', NULL, 'Đang hoạt động', '2025-08-13 01:57:07'),
(2, 'vuhoanganh', 'Vũ Hoàng Anh', '$2y$10$gYoCz1Ikjik/ZufeM.OvyeJtdqsk1hgXDuRtB6tvSE805MAFUd456', 'vuthanhtung2k4@gmail.com', '2025-08-13', 'Nhân viên', 'Phòng IT', 'Đang hoạt động', '2025-08-13 02:07:40'),
(3, 'vuthanhtung', 'Vũ Thanh Tung', '$2y$10$g3QQ9ywXaLUqK5k6m7sBoOODSIMuchmMlIn7bGo6f9D72xxBgt8TS', 'vuthanhtungg2k4@gmail.com', '2025-08-13', 'Nhân viên', 'Phòng Nhân sự', 'Đang hoạt động', '2025-08-13 02:09:19'),
(4, 'buivanphong', 'Bùi Văn Phong', '$2y$10$5rgpg4BLhrSyK6.Tv2oLluJUJihwBpC/0qKLRxJE7SEJ5MXgSHQl2', 'buivanphong2k4@gmail.com', '2025-08-13', 'Nhân viên', 'Phòng Sản xuất', 'Đang hoạt động', '2025-08-13 02:10:13'),
(5, 'tranhuyentrang', 'Trần Huyền Trang', '$2y$10$beRm9Dz21YFnoGwQKPqoOeyeW76bZT8.iWTMbE6jwAiL.f4CnUhmm', 'htrangxinh@gmail.com', '2025-08-13', 'Nhân viên', 'Phòng Kinh doanh', 'Đang hoạt động', '2025-08-13 02:12:23'),
(6, 'buihobac', 'Bùi Văn Hồ Bắc', '$2y$10$YucJYAxImxtqeUAVYt8umOYhLOOXFZzfLDEP2vnca0f0.PR1yE7R6', 'buihobac2k4@gmail.com', '2025-08-13', 'Quản lý', 'Phòng IT', 'Đang hoạt động', '2025-08-13 02:13:44'),
(7, 'phamquynhtrang', 'Phạm Quỳnh Trang', '$2y$10$jbRHa1Vn9jHvy71B2RFdUeOD7rLZXKdWyubmTLLyLCfwnpZ3KdR62', 'hqtrangxindh@gmail.com', '2025-08-13', 'Quản lý', 'Phòng Nhân sự', 'Đang hoạt động', '2025-08-13 02:17:09'),
(8, 'nguyenngocdung', 'Nguyễn Ngọc Dung', '$2y$10$x6ArpL2KnCRrd0eBukdDTusm1GgNtb/2Zjnxcrx5uy4Kanb22n5L2', 'dungdung@gmail.com', '2025-08-13', 'Quản lý', 'Phòng Kinh doanh', 'Đang hoạt động', '2025-08-13 02:21:50'),
(9, 'buituanh', 'Bùi Tú Anh', '$2y$10$AcdO7RvJ4Eolkft7nPDY5uaNvZSz/ow.3P/fosf4hgXymfum0qBK2', 'buituanh@gmail.com', '2025-08-13', 'Quản lý', 'Phòng Sản xuất', 'Đang hoạt động', '2025-08-13 02:24:34'),
(10, 'viet', 'Bùi Việt', '$2y$10$eDSBOQqTC9LEZT8JtRsdHulJ2QY46a4Crfn8.MDvSWW79ETifbJ26', 'buiviet@gmail.com', '2025-08-13', 'Quản lý', 'Phòng Nhân sự', 'Đã khóa', '2025-08-13 02:25:55'),
(11, 'phamanh', 'Pham Anh', '$2y$10$iDKf1GqAozPcy/.CV.N2GeAOllXP/QuqV/a1Dt.M4mjFSYmyspPMm', 'buihobacc2k4@gmail.com', '2025-08-13', 'Quản lý', 'Phòng IT', 'Đang hoạt động', '2025-08-13 05:00:25');

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
  MODIFY `letterId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
