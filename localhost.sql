-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 17, 2018 at 09:19 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Table structure for table `deadline`
--

CREATE TABLE `deadline` (
  `datum` varchar(16) CHARACTER SET ascii NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deadline`
--

INSERT INTO `deadline` (`datum`) VALUES
('2.8.2018');

-- --------------------------------------------------------

--
-- Table structure for table `einteilung`
--

CREATE TABLE `einteilung` (
  `s_id` int(11) NOT NULL,
  `pg_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `einteilung`
--

INSERT INTO `einteilung` (`s_id`, `pg_id`) VALUES
(1, 16),
(2, 15);


-- --------------------------------------------------------

--
-- Table structure for table `projektgruppen`
--

CREATE TABLE `projektgruppen` (
  `id` int(11) NOT NULL,
  `titel` varchar(256) NOT NULL,
  `lim` int(11) NOT NULL,
  `leiter` varchar(256) NOT NULL,
  `beschreibung` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projektgruppen`
--

INSERT INTO `projektgruppen` (`id`, `titel`, `lim`, `leiter`, `beschreibung`) VALUES
(15, 'A', 30, 'A', 'A'),
(16, 'B', 30, 'B', 'B'),
(17, 'C', 30, 'C', 'C'),
(18, 'D', 30, 'D', 'D'),
(19, 'E', 30, 'E', 'E');

-- --------------------------------------------------------

--
-- Table structure for table `schueler`
--

CREATE TABLE `schueler` (
  `s_id` int(11) NOT NULL,
  `s_username` varchar(16) CHARACTER SET ascii NOT NULL,
  `s_pword` varchar(128) CHARACTER SET ascii NOT NULL,
  `s_klasse` varchar(8) CHARACTER SET ascii NOT NULL,
  `s_name` varchar(128) CHARACTER SET ascii NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schueler`
--

INSERT INTO `schueler` (`s_id`, `s_username`, `s_pword`, `s_klasse`, `s_name`) VALUES
(1, 'muellars', 'f2d30d8b5e42548529721f5827eea2f0', '9d', 'Lars Mueller'),
(2, 'muelkai', '94846ab27a4abb8672589ca403d0dc43', 'Q1', 'Kai Gerd Mueller');

-- --------------------------------------------------------

--
-- Table structure for table `schulleiter_passwort`
--

CREATE TABLE `schulleiter_passwort` (
  `hash` varchar(256) CHARACTER SET ascii NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schulleiter_passwort`
--

INSERT INTO `schulleiter_passwort` (`hash`) VALUES
('2ebbd6f0f37bcf0de4ef4cd4a622173c');

-- --------------------------------------------------------

--
-- Table structure for table `wahl`
--

CREATE TABLE `wahl` (
  `s_id` int(11) NOT NULL,
  `wahl1_id` int(11) NOT NULL,
  `wahl2_id` int(11) NOT NULL,
  `wahl3_id` int(11) NOT NULL,
  `wahl4_id` int(11) NOT NULL,
  `wahl5_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wahl`
--

INSERT INTO `wahl` (`s_id`, `wahl1_id`, `wahl2_id`, `wahl3_id`, `wahl4_id`, `wahl5_id`) VALUES
(1, 15, 17, 18, 19, 16),
(2, 16, 15, 17, 18, 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `einteilung`
--
ALTER TABLE `einteilung`
  ADD PRIMARY KEY (`s_id`,`pg_id`);

--
-- Indexes for table `projektgruppen`
--
ALTER TABLE `projektgruppen`
  ADD PRIMARY KEY (`id`,`titel`,`leiter`);

--
-- Indexes for table `schueler`
--
ALTER TABLE `schueler`
  ADD PRIMARY KEY (`s_id`,`s_username`,`s_pword`,`s_klasse`);

--
-- Indexes for table `schulleiter_passwort`
--
ALTER TABLE `schulleiter_passwort`
  ADD PRIMARY KEY (`hash`);

--
-- Indexes for table `wahl`
--
ALTER TABLE `wahl`
  ADD PRIMARY KEY (`s_id`,`wahl1_id`,`wahl2_id`,`wahl3_id`,`wahl4_id`,`wahl5_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projektgruppen`
--
ALTER TABLE `projektgruppen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `schueler`
--
ALTER TABLE `schueler`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
