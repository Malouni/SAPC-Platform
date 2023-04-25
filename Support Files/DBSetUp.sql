-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2023 at 07:27 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sciencestrategicplan`
--

-- --------------------------------------------------------

--
-- Table structure for table `answernotes`
--

CREATE TABLE `answernotes` (
  `NoteID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `QuestionID` int(11) DEFAULT NULL,
  `NoteText` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `answeroptions`
--

CREATE TABLE `answeroptions` (
  `SurvID` int(11) DEFAULT NULL,
  `QuestionID` int(11) DEFAULT NULL,
  `SubQuestionID` int(11) DEFAULT NULL,
  `InputValue` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loginattemptstable`
--

CREATE TABLE `loginattemptstable` (
  `Id` int(11) NOT NULL,
  `IpAddress` varbinary(16) NOT NULL,
  `Time` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subquestionanswer`
--

CREATE TABLE `subquestionanswer` (
  `UserID` int(11) DEFAULT NULL,
  `QuestionID` int(11) DEFAULT NULL,
  `SubQuestionID` int(11) DEFAULT NULL,
  `Answer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subquestions`
--

CREATE TABLE `subquestions` (
  `SubQuestionID` int(11) NOT NULL,
  `SurvID` int(11) DEFAULT NULL,
  `QuestionID` int(11) DEFAULT NULL,
  `Sub_Q` varchar(800) DEFAULT NULL,
  `SubType` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surveyquestions`
--

CREATE TABLE `surveyquestions` (
  `QuestionID` int(11) NOT NULL,
  `SurvID` int(11) DEFAULT NULL,
  `Goal` varchar(200) DEFAULT NULL,
  `SubGoal` varchar(200) DEFAULT NULL,
  `Question` varchar(800) DEFAULT NULL,
  `Type` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surveyreport`
--

CREATE TABLE `surveyreport` (
  `SurvID` int(11) DEFAULT NULL,
  `QuestionID` int(11) DEFAULT NULL,
  `SubQuestionID` int(11) DEFAULT NULL,
  `Answer_Percentage` float DEFAULT NULL,
  `Activity_Involvement` tinyint(4) DEFAULT NULL,
  `Activity_Historical` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surveytable`
--

CREATE TABLE `surveytable` (
  `SurvID` int(11) NOT NULL,
  `SurvYear` smallint(6) DEFAULT NULL,
  `SurvName` varchar(100) DEFAULT NULL,
  `SurvDateStart` date DEFAULT NULL,
  `SurvDateEnd` date DEFAULT NULL,
  `TotalAnswersAvg` float DEFAULT NULL,
  `LastUpdatedDate` date DEFAULT NULL,
  `Position` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `useranswer`
--

CREATE TABLE `useranswer` (
  `UserID` int(11) DEFAULT NULL,
  `QuestionID` int(11) DEFAULT NULL,
  `SurvID` int(11) DEFAULT NULL,
  `Answer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE `usertable` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` char(60) DEFAULT NULL,
  `Fname` varchar(100) DEFAULT NULL,
  `Lname` varchar(100) DEFAULT NULL,
  `Position` varchar(100) DEFAULT NULL,
  `Department` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`UserID`, `UserName`, `Password`, `Fname`, `Lname`, `Position`, `Department`) VALUES
(1, 'admin', '$2y$10$G1tZ.7QIKy1ZtOW//6NkDeasHzz/z.TKM46pdpJf73sqhAhXUADKO', 'Site', 'Administrator', 'admin', 'Science');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answernotes`
--
ALTER TABLE `answernotes`
  ADD PRIMARY KEY (`NoteID`);

--
-- Indexes for table `loginattemptstable`
--
ALTER TABLE `loginattemptstable`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `subquestions`
--
ALTER TABLE `subquestions`
  ADD PRIMARY KEY (`SubQuestionID`);

--
-- Indexes for table `surveyquestions`
--
ALTER TABLE `surveyquestions`
  ADD PRIMARY KEY (`QuestionID`);

--
-- Indexes for table `surveytable`
--
ALTER TABLE `surveytable`
  ADD PRIMARY KEY (`SurvID`);

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answernotes`
--
ALTER TABLE `answernotes`
  MODIFY `NoteID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loginattemptstable`
--
ALTER TABLE `loginattemptstable`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subquestions`
--
ALTER TABLE `subquestions`
  MODIFY `SubQuestionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surveyquestions`
--
ALTER TABLE `surveyquestions`
  MODIFY `QuestionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surveytable`
--
ALTER TABLE `surveytable`
  MODIFY `SurvID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usertable`
--
ALTER TABLE `usertable`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
