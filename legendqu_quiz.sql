-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 20, 2019 at 06:39 PM
-- Server version: 5.6.42-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `legendqu_quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `gameId` int(11) NOT NULL,
  `gameName` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`gameId`, `gameName`) VALUES
(1, 'League Of Legends'),
(2, 'CS:GO'),
(3, 'DOTA 2');

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `pointId` int(99) NOT NULL,
  `userId` int(99) NOT NULL,
  `gameId` int(99) NOT NULL,
  `points` int(99) NOT NULL,
  `date_of_point` text NOT NULL,
  `userIP` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`pointId`, `userId`, `gameId`, `points`, `date_of_point`, `userIP`) VALUES
(59, 1, 1, 1, '2018-09-10 11:18:23', '193.231.35.71'),
(58, 1, 3, 0, '2018-09-10 11:12:42', '193.231.35.71'),
(57, 1, 1, 2, '2018-09-10 11:12:05', '193.231.35.71'),
(56, 1, 3, 1, '2018-09-08 18:19:15', '86.120.204.21'),
(55, 1, 2, 1, '2018-09-08 18:19:06', '86.120.204.21'),
(54, 1, 1, 2, '2018-09-08 18:18:43', '86.120.204.21'),
(53, 1, 1, 0, '2018-09-08 18:13:12', '86.120.204.21'),
(52, 1, 1, 0, '2018-09-08 18:12:58', '86.120.204.21'),
(51, 1, 1, 1, '2018-09-07 16:32:20', '194.102.62.107'),
(50, 1, 1, 0, '2018-09-07 16:03:57', '194.102.62.107'),
(49, 1, 2, 0, '2018-07-23 14:04:56', '194.39.218.10'),
(48, 1, 1, 1, '2018-07-23 14:04:41', '194.39.218.10'),
(47, 1, 1, 1, '2018-06-09 18:46:49', '5.15.137.84'),
(46, 1, 1, 1, '2018-06-08 11:14:45', '82.137.12.21'),
(45, 1, 1, 0, '2018-06-05 02:31:49', '79.114.89.225'),
(44, 1, 1, 1, '2018-06-05 02:31:30', '79.114.89.225'),
(43, 1, 1, 1, '2018-06-04 16:22:11', '79.114.34.218'),
(42, 1, 1, 1, '2018-06-04 16:19:58', '79.114.34.218'),
(41, 1, 1, 2, '2018-06-04 14:39:59', '82.137.8.20'),
(40, 1, 1, 0, '2018-06-04 12:23:16', '82.137.8.20'),
(39, 1, 1, 0, '2018-06-04 03:47:06', '82.137.8.20');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `questionId` int(11) NOT NULL,
  `gameId` int(9) NOT NULL,
  `gameQuiz` text NOT NULL,
  `gameAns1` text NOT NULL,
  `gameAns2` text NOT NULL,
  `gameAns3` text NOT NULL,
  `gameAns4` text NOT NULL,
  `gameAns5` text NOT NULL,
  `gameCor` int(99) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`questionId`, `gameId`, `gameQuiz`, `gameAns1`, `gameAns2`, `gameAns3`, `gameAns4`, `gameAns5`, `gameCor`) VALUES
(1, 1, 'Care este prescurtarea de la League of Legends', 'LEL', 'LOFL', 'LOL', '', '', 3),
(2, 1, 'League of Legends este un joc de tip', 'FPS', 'MOBA', 'RPG', 'MMORPG', '', 2),
(4, 2, 'Counter Strike Global Offensive este un joc de tip', 'FPS', 'RPG', 'MOBA', '', '', 1),
(5, 3, 'DOTA 2 este un joc exclusiv Steam?', 'Da', 'Nu', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPass`) VALUES
(1, 'Ionut', 'test@test.com', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08'),
(2, 'Diana', 'diana.voda97@e-uvt.ro', 'b22b3e0dcc1b2725113758531fe883eee9dfecf4c652c961579481254c97721f'),
(3, 'alif', 'killuakun544@yahoo.ro', 'b042bbf25e9497cb23a8c2699ea7646777c35f9f1ed217179c681d278f88f6f7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`gameId`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`pointId`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`questionId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `gameId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
  MODIFY `pointId` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `questionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
