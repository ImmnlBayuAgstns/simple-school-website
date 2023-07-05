-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 03:30 PM
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
-- Database: `multiuser`
--

-- --------------------------------------------------------

--
-- Table structure for table `crud_guru`
--

CREATE TABLE `crud_guru` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crud_guru`
--

INSERT INTO `crud_guru` (`id`, `nama`, `telp`, `email`) VALUES
(3, 'kumalala', '1476238742757', 'kumalala@gmail.com'),
(5, 'nur', '08673737', 'nur22@gmail.com'),
(6, 'afefe', '1413412412', 'wuefuw@gmail.com'),
(8, 'fehwuffwb', '6236236', 'ashbfywb@gmail.com'),
(9, 'qwdqwdqw', '31273671', 'shfywgyfwe@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `signin`
--

CREATE TABLE `signin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(8) NOT NULL,
  `tipe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `signin`
--

INSERT INTO `signin` (`id`, `username`, `pass`, `tipe`) VALUES
(1, 'Dan', '123', 'admin'),
(2, 'Han', '124', 'user'),
(3, 'Pal', '125', 'vip');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crud_guru`
--
ALTER TABLE `crud_guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signin`
--
ALTER TABLE `signin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crud_guru`
--
ALTER TABLE `crud_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `signin`
--
ALTER TABLE `signin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
