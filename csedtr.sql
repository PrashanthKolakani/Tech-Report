-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 06, 2017 at 03:27 AM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csedtr`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `authorid` int(11) NOT NULL,
  `authorname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `regno` varchar(50) NOT NULL,
  `programme` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`authorid`, `authorname`, `username`, `regno`, `programme`) VALUES
(7, 'vaishnavi', 'vaishnavi_b130889cs@nitc.ac.in', 'b130889cs', 'btech'),
(8, 'Bhavana', 'bhavana_b130545cs@nitc.ac.in', 'b130545cs', 'btech'),
(10, 'sita', 'himana_b130484cs@nitc.ac.in', 'b130484cs', 'btech');

-- --------------------------------------------------------

--
-- Table structure for table `editor`
--

CREATE TABLE `editor` (
  `editorid` int(11) NOT NULL,
  `editorname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `editor`
--

INSERT INTO `editor` (`editorid`, `editorname`, `username`) VALUES
(3, 'vaishnavi', 'vaishnavi_b130889cs@nitc.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `privilege` int(11) NOT NULL,
  `confirmation` int(11) DEFAULT NULL,
  `confcode` varchar(50) DEFAULT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `privilege`, `confirmation`, `confcode`, `dob`) VALUES
('bhavana_b130545cs@nitc.ac.in', 'bhavana', 0, 1, '1099642019', '1996-03-31'),
('bhavana_b130545cs@nitc.ac.in', 'bhavana', 2, NULL, NULL, '1997-07-20'),
('himana_b130484cs@nitc.ac.in', 'sita', 0, 1, '1512924595', '1999-11-25'),
('himana_b130484cs@nitc.ac.in', 'himana', 2, NULL, NULL, '1996-04-30'),
('srisudha_b130197cs@nitc.ac.in', 'sudha', 2, NULL, NULL, '1996-05-10'),
('techreport.2017@gmail.com', 'admin', 5, NULL, NULL, '2000-02-23'),
('vaishnavi_b130889cs@nitc.ac.in', 'vaishnavi', 0, 1, '14884', '1996-08-02'),
('vaishnavi_b130889cs@nitc.ac.in', 'vaishnavi', 1, NULL, NULL, '1995-08-02'),
('vaishnavi_b130889cs@nitc.ac.in', 'vaishnavi', 2, NULL, NULL, '1995-08-02');

-- --------------------------------------------------------

--
-- Table structure for table `reviewer`
--

CREATE TABLE `reviewer` (
  `idno` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `specializationid` int(11) NOT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `designation` varchar(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviewer`
--

INSERT INTO `reviewer` (`idno`, `name`, `specializationid`, `contactno`, `designation`, `username`) VALUES
(21, 'Sri Sudha', 4, 8136876425, 'adhoc', 'srisudha_b130197cs@nitc.ac.in'),
(25, 'Himana', 10, 9074587345, 'adhoc', 'himana_b130484cs@nitc.ac.in'),
(26, 'Bhavana', 10, 3433343434, 'adhoc', 'bhavana_b130545cs@nitc.ac.in'),
(27, 'Vaishnavi', 4, 4353535434, 'adhoc', 'vaishnavi_b130889cs@nitc.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE `specialization` (
  `specializationid` int(11) NOT NULL,
  `specializationname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`specializationid`, `specializationname`) VALUES
(1, 'Computer Security'),
(2, 'Bioinformatics'),
(3, 'Operating Systems'),
(4, 'Digital Image Processing'),
(5, 'Computer Architecture'),
(6, 'Data Mining'),
(7, 'Computer Networks'),
(8, 'Data Structures'),
(9, 'Graph Theory'),
(10, 'Compilers'),
(11, 'Information Security Management'),
(12, 'Mathematical Logic'),
(13, 'Complexity Theory'),
(14, 'Cryptography and Security'),
(15, 'Design and Analysis of Algorithms'),
(16, 'Parallel Computing'),
(17, 'Computational Drug Design'),
(18, 'Data Base Management Systems'),
(19, 'Software Engineering'),
(20, 'Object Oriented Systems'),
(21, 'Network Security'),
(22, 'Cloud Computing'),
(23, 'Computational Intelligence'),
(24, 'Program Analysis'),
(25, 'Combinatorial Optimization'),
(26, 'Computer Vision'),
(27, 'High Performance Computing'),
(28, 'Programming Languages'),
(29, '');

-- --------------------------------------------------------

--
-- Table structure for table `techreport`
--

CREATE TABLE `techreport` (
  `reportid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `authorid` int(11) NOT NULL,
  `researchfield` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `reportpath` varchar(100) NOT NULL,
  `privilege` int(11) NOT NULL,
  `reviewerid` int(11) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `uniqueid` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `techreport`
--

INSERT INTO `techreport` (`reportid`, `title`, `authorid`, `researchfield`, `year`, `reportpath`, `privilege`, `reviewerid`, `status`, `comment`, `uniqueid`) VALUES
(13, 'gene prediction', 7, 'bioinformatics', 2017, 'publishedreports/ilovepdf_merged.pdf', 1, 21, 'SP', 'comments/SCAN.pdf', 'NITC/CSED/TR/B130889CS/2017/3/31/01:56:29'),
(15, 'Big Data', 7, 'Data Mining', 2017, 'reports/B130889CS_Final.pdf', 1, 21, 'P', NULL, 'NITC/CSED/TR/B130889CS/2017/3/31/10:42:34'),
(16, 'vaish', 7, 'niseksa', 2017, 'reports/ApplicationForm.pdf', 1, 21, 'P', NULL, 'NITC/CSED/TR/B130889CS/2017/3/31/10:46:03'),
(18, 'wireless sensor networks', 7, 'Data Mining', 2017, 'publishedreports/ilovepdf_merged (1).pdf', 1, 21, 'P', NULL, 'NITC/CSED/TR/B130889CS/2017/3/31/11:21:51'),
(20, 'Privacy preserving', 8, 'Data Mining', 2017, 'publishedreports/ilovepdf_merged.pdf', 1, 21, 'P', '', 'NITC/CSED/TR/B130545CS/2017/4/5/05:37:58'),
(22, 'honey', 10, 'dkfs', 2017, 'reports/ilp2.pdf', 1, NULL, 'SP', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`authorid`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `editor`
--
ALTER TABLE `editor`
  ADD PRIMARY KEY (`editorid`),
  ADD KEY `username` (`username`),
  ADD KEY `username_2` (`username`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`,`privilege`);

--
-- Indexes for table `reviewer`
--
ALTER TABLE `reviewer`
  ADD PRIMARY KEY (`idno`,`specializationid`),
  ADD KEY `specializationid` (`specializationid`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `specialization`
--
ALTER TABLE `specialization`
  ADD PRIMARY KEY (`specializationid`);

--
-- Indexes for table `techreport`
--
ALTER TABLE `techreport`
  ADD PRIMARY KEY (`reportid`),
  ADD KEY `reviewerid` (`reviewerid`),
  ADD KEY `authorid` (`authorid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `authorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `editor`
--
ALTER TABLE `editor`
  MODIFY `editorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `reviewer`
--
ALTER TABLE `reviewer`
  MODIFY `idno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `specialization`
--
ALTER TABLE `specialization`
  MODIFY `specializationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `techreport`
--
ALTER TABLE `techreport`
  MODIFY `reportid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
