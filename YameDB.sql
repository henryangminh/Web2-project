-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 14, 2018 at 08:37 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `YameDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `AuthenticationUsr`
--

CREATE TABLE `AuthenticationUsr` (
  `Authentication` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `AuthenticationName` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `AuthenticationUsr`
--

INSERT INTO `AuthenticationUsr` (`Authentication`, `AuthenticationName`) VALUES
('Admin', 'Sửa quyền user'),
('Invoice', 'Quản lý hóa đơn'),
('Store', 'Quản lý kho hàng'),
('Usr', 'User thường');

-- --------------------------------------------------------

--
-- Table structure for table `Invoice`
--

CREATE TABLE `Invoice` (
  `InvoiceID` int(10) NOT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UsrName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PhoneNo` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SubTotal` int(10) NOT NULL,
  `Ship` int(6) NOT NULL,
  `Total` int(10) NOT NULL,
  `DateInvoice` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Invoice`
--

INSERT INTO `Invoice` (`InvoiceID`, `Email`, `UsrName`, `PhoneNo`, `Address`, `SubTotal`, `Ship`, `Total`, `DateInvoice`) VALUES
(1, 'beyeu123@gmail.com', 'Bé Yêu', '0969991242', '123 Đường Nhựa', 4908999, 50000, 4958999, '2018-05-11 19:02:07'),
(2, 'beyeu123@gmail.com', 'Bé Yêu', '0929884123', '123/45 Đường Bé Yêu Phường Bé Yêu Quận Bé Yêu', 678000, 50000, 728000, '2018-05-11 19:02:58'),
(3, 'beyeu123@gmail.com', 'Bé Yêu', '0929884123', '123/45 Đường Bé Yêu Phường Bé Yêu Quận Bé Yêu', 678000, 0, 678000, '2018-05-11 19:06:50'),
(4, 'daurong@beyeu.com', 'Đậu Rồng', '0915107907', 'Nhà cô Bé Yêu', 787000, 0, 787000, '2018-05-11 19:10:37');

-- --------------------------------------------------------

--
-- Table structure for table `InvoiceDetails`
--

CREATE TABLE `InvoiceDetails` (
  `InvoiceID` int(10) NOT NULL,
  `ProductID` int(5) NOT NULL,
  `Quantities` int(2) NOT NULL,
  `Price` int(10) NOT NULL,
  `SubTotal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `InvoiceDetails`
--

INSERT INTO `InvoiceDetails` (`InvoiceID`, `ProductID`, `Quantities`, `Price`, `SubTotal`) VALUES
(0, 27, 1, 678000, 678000),
(1, 3, 1, 125000, 125000),
(1, 4, 2, 210000, 420000),
(1, 5, 1, 399999, 399999),
(1, 6, 1, 452000, 452000),
(1, 7, 1, 234000, 234000),
(1, 25, 4, 650000, 2600000),
(1, 27, 1, 678000, 678000),
(2, 27, 1, 678000, 678000),
(3, 27, 1, 678000, 678000),
(4, 3, 1, 125000, 125000),
(4, 4, 1, 210000, 210000),
(4, 6, 1, 452000, 452000);

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE `Product` (
  `ProductID` int(5) NOT NULL,
  `ProductName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ProductTypeID` int(3) NOT NULL,
  `UnitPrice` int(10) NOT NULL,
  `Quantity` int(2) NOT NULL,
  `Size` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `imgsrc` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`ProductID`, `ProductName`, `ProductTypeID`, `UnitPrice`, `Quantity`, `Size`, `Description`, `imgsrc`, `Date`) VALUES
(2, 'Đầm xòe hoa văn', 2, 650000, 31, 'M', '', 'SP2.jpg', '2018-05-11 16:39:30'),
(3, 'Váy nữ sinh', 3, 125000, 9, 'M', '', 'SP3.jpg', '2018-05-11 16:52:02'),
(4, 'Áo Khoác Xanh ', 5, 210000, 0, 'XL', '', 'SP4.jpg', '2018-05-11 17:00:11'),
(5, 'Đầm suông kẻ sọc', 2, 399999, 23, 'M', '', 'SP5.jpg', '2018-05-11 17:08:18'),
(6, 'Đầm xòe đơn sắc', 2, 452000, 13, 'L', '', 'SP6.jpg', '2018-05-11 17:12:57'),
(7, 'Đầm xòe đơn sắc', 2, 234000, 60, 'M', '', 'SP7.jpg', '2018-05-11 17:13:56'),
(8, 'Đầm kẻ sọc trắng đen', 2, 456000, 152, 'M', '', 'SP8.jpg', '2018-05-11 17:14:39'),
(9, 'Đầm suông ngắn chân', 2, 432000, 12, 'L', '', 'SP9.jpg', '2018-05-11 17:15:09'),
(12, 'Áo Khoác KaKi', 5, 325987, 21, 'M', '', 'SP12.jpg', '2018-05-11 17:22:21'),
(13, 'Áo Khoác Jean', 5, 555000, 213, 'L', '', 'SP13.jpg', '2018-05-11 17:23:01'),
(14, 'Áo Khoác Da', 5, 345000, 42, 'L', '', 'SP14.jpg', '2018-05-11 17:23:47'),
(15, 'Áo Khoác Lạnh', 5, 555666, 12, 'L', '', 'SP15.jpg', '2018-05-11 17:24:26'),
(16, 'Áo Khoác Xanh Đậm', 5, 230000, 12, 'M', '', 'SP16.jpg', '2018-05-11 17:25:59'),
(17, 'Áo Sơ Mi Hàn Quốc', 6, 555555, 22, 'M', '', 'SP17.jpg', '2018-05-11 17:27:25'),
(18, 'Đầm xòe công chúa', 2, 457890, 12, 'M', '', 'SP18.jpg', '2018-05-11 17:28:27'),
(19, 'Quần baggy jean', 8, 655000, 23, 'L', '', 'SP19.jpg', '2018-05-11 17:30:57'),
(20, 'Áo tay lỡ', 9, 567000, 45, 'L', '', 'SP20.jpg', '2018-05-11 17:36:57'),
(21, 'Quần Thun', 10, 600000, 33, 'L', '', 'SP21.jpg', '2018-05-11 17:41:00'),
(22, 'Áo tay lỡ', 9, 660000, 34, 'L', '', 'SP22.jpg', '2018-05-11 17:41:49'),
(23, 'Áo tay lỡ', 9, 700000, 22, 'L', '', 'SP23.jpg', '2018-05-11 17:42:42'),
(24, 'Áo sơ mi tay ngắn', 9, 1000000, 66, 'XL', '', 'SP24.jpg', '2018-05-11 17:43:51'),
(25, 'Áo tay lỡ xẻ dọc', 9, 650000, 76, 'L', '', 'SP25.jpg', '2018-05-11 17:44:33'),
(26, 'Quần thun adidas', 10, 768000, 34, 'L', '', 'SP26.jpg', '2018-05-11 17:45:32'),
(27, 'Áo thun tay ngắn', 9, 678000, 56, 'XL', '', 'SP27.jpg', '2018-05-11 17:46:00'),
(28, 'Áo hoodie tay dài', 9, 900000, 90, 'XL', '', 'SP28.jpg', '2018-05-11 17:46:40'),
(29, 'Quần Thun', 10, 71900, 7, 'M', '', 'SP29.jpg', '2018-05-11 19:32:22');

-- --------------------------------------------------------

--
-- Table structure for table `ProductType`
--

CREATE TABLE `ProductType` (
  `ProductTypeID` int(5) NOT NULL,
  `ProductTypeName` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Gender` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ProductType`
--

INSERT INTO `ProductType` (`ProductTypeID`, `ProductTypeName`, `Gender`) VALUES
(1, 'Vest', 'Nam'),
(2, 'Đầm', 'Nữ'),
(3, 'Váy', 'Nữ'),
(4, 'Khoác', 'Nữ'),
(5, 'Khoác', 'Nam'),
(6, 'Sơ Mi', 'Nam'),
(7, 'Quần', 'Nam'),
(8, 'Quần', 'Nữ'),
(9, 'Áo', 'Unisex'),
(10, 'Quần', 'Unisex'),
(11, 'Khoác', 'Unisex');

-- --------------------------------------------------------

--
-- Table structure for table `Usr`
--

CREATE TABLE `Usr` (
  `Email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Passwd` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `UsrName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PhoneNo` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Blocked` tinyint(1) NOT NULL,
  `Authentication` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Usr`
--

INSERT INTO `Usr` (`Email`, `Passwd`, `UsrName`, `PhoneNo`, `Address`, `Blocked`, `Authentication`) VALUES
('beyeu@beyeu.com', '26053235b85fda7d87cdb92bd00123725d5e39af', 'Trần Văn A', '09543219999', '123 Đường Abc', 0, 'Usr'),
('beyeu@gmail.com', '26053235b85fda7d87cdb92bd00123725d5e39af', 'Bé Yêu', '0123456789', '123/45 Đường Bé Yêu Phường Bé Yêu Quận Bé Yêu', 0, 'Admin'),
('beyeu123@gmail.com', '6902e277c3f0df6a3a3f4839a422745fc4a24b0d', 'Bé Yêu', '0929884123', '123/45 Đường Bé Yêu Phường Bé Yêu Quận Bé Yêu', 0, 'Usr'),
('dauphong@gmail.com', '26053235b85fda7d87cdb92bd00123725d5e39af', 'Đậu Phộng', '0915107907', '273 An Dương Vương Phòng Trung Tâm CNTT', 0, 'Admin'),
('daurong@beyeu.com', '26053235b85fda7d87cdb92bd00123725d5e39af', 'Đậu Rồng', '0915107907', 'Nhà cô Bé Yêu', 0, 'Usr'),
('hippore114@gmail.com', '26053235b85fda7d87cdb92bd00123725d5e39af', 'MinMin', '0919991169', '5 Đường Làng', 0, 'Store'),
('min@beyeu.com', '26053235b85fda7d87cdb92bd00123725d5e39af', 'Min', '0981293012', '6 Đường Nguyễn Văn Cừ Phường 7', 0, 'Store'),
('minmin@gmail.com', '26053235b85fda7d87cdb92bd00123725d5e39af', 'Min Min', '0919991166', '123 đường an dương vương', 0, 'Invoice'),
('nguyenvanb@gmail.com', '26053235b85fda7d87cdb92bd00123725d5e39af', 'Nguyễn Văn B', '09786542121', '123 Đường Abc', 0, 'Usr'),
('phanvanc@gmail.com', '26053235b85fda7d87cdb92bd00123725d5e39af', 'Phan Văn C', '09765432123', '7/69 Đường Mòn', 0, 'Usr');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AuthenticationUsr`
--
ALTER TABLE `AuthenticationUsr`
  ADD PRIMARY KEY (`Authentication`);

--
-- Indexes for table `Invoice`
--
ALTER TABLE `Invoice`
  ADD PRIMARY KEY (`InvoiceID`);

--
-- Indexes for table `InvoiceDetails`
--
ALTER TABLE `InvoiceDetails`
  ADD PRIMARY KEY (`InvoiceID`,`ProductID`);

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `ProductType`
--
ALTER TABLE `ProductType`
  ADD PRIMARY KEY (`ProductTypeID`);

--
-- Indexes for table `Usr`
--
ALTER TABLE `Usr`
  ADD PRIMARY KEY (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Invoice`
--
ALTER TABLE `Invoice`
  MODIFY `InvoiceID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `ProductID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `ProductType`
--
ALTER TABLE `ProductType`
  MODIFY `ProductTypeID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
