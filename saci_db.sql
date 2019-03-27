-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2019 at 04:19 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saci_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `Account_ID` varchar(10) NOT NULL,
  `Account_Type` varchar(20) NOT NULL,
  `On_Hand` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`Account_ID`, `Account_Type`, `On_Hand`) VALUES
('1514', 'Staff', '0'),
('81398', 'Administrator', '0'),
('1134566777', 'College Student', '0'),
('2323', 'Librarian', '0'),
('1212', 'College Student', '0'),
('23132121', 'Senior High School S', '0'),
('123', 'College Student', '0'),
('321', 'College Student', '0'),
('0898', 'Administrator', '0'),
('108', 'College Student', '0');

-- --------------------------------------------------------

--
-- Table structure for table `acquisition`
--

CREATE TABLE `acquisition` (
  `Acquisition_ID` int(11) NOT NULL,
  `Accession_Number` varchar(255) NOT NULL,
  `Number_Purchased` varchar(255) NOT NULL,
  `Date_Purchased` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `archieve`
--

CREATE TABLE `archieve` (
  `Archieve_ID` int(11) NOT NULL,
  `Accession_Number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `Attendance_ID` int(11) NOT NULL,
  `Borrower_ID` int(11) NOT NULL,
  `Date_Entered` date NOT NULL,
  `Time_Entered` time NOT NULL,
  `Borrower_Type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`Attendance_ID`, `Borrower_ID`, `Date_Entered`, `Time_Entered`, `Borrower_Type`) VALUES
(1, 0, '2018-08-31', '15:23:20', 'Librarian'),
(2, 0, '2018-08-31', '15:26:59', 'Librarian'),
(3, 0, '2018-08-31', '15:28:01', 'Librarian'),
(4, 0, '2018-08-31', '15:33:43', 'Librarian'),
(5, 0, '2018-08-31', '15:34:48', 'Librarian'),
(6, 81398, '2018-08-31', '15:36:38', 'Librarian'),
(7, 81398, '2018-09-01', '17:34:13', 'Administrator'),
(8, 81398, '2018-09-02', '18:11:45', 'Administrator'),
(9, 1514, '2018-09-02', '23:36:06', 'Staff'),
(10, 81398, '2018-09-03', '17:09:51', 'Administrator'),
(11, 81398, '2018-09-08', '04:27:02', 'Administrator'),
(12, 81398, '2018-09-09', '01:46:17', 'Administrator'),
(13, 81398, '2018-09-10', '03:59:20', 'Administrator'),
(14, 81398, '2018-09-11', '00:59:27', 'Administrator'),
(15, 81398, '2018-09-12', '15:10:33', 'Staff'),
(16, 81398, '2018-09-13', '12:59:19', 'Staff'),
(17, 81398, '2018-09-14', '02:22:34', 'Staff'),
(18, 81398, '2018-09-16', '09:58:03', 'Administrator'),
(19, 81398, '2018-09-18', '15:45:39', 'Administrator'),
(20, 81398, '2018-09-19', '19:53:45', 'Administrator'),
(21, 81398, '2018-09-21', '02:16:34', 'Administrator'),
(22, 1514, '2018-09-21', '23:32:35', 'Staff'),
(23, 81398, '2018-09-22', '00:30:45', 'Administrator'),
(24, 1514, '2018-09-22', '02:43:06', 'Staff'),
(25, 81398, '2018-09-24', '14:30:35', 'Administrator'),
(26, 81398, '2018-09-26', '20:00:58', 'Administrator'),
(27, 81398, '2018-09-27', '10:13:29', 'Administrator'),
(28, 81398, '2018-09-30', '11:21:23', 'Administrator'),
(29, 81398, '2018-10-02', '22:07:45', 'Administrator'),
(30, 81398, '2018-10-04', '13:48:59', 'Administrator'),
(31, 81398, '2018-10-06', '20:21:58', 'Administrator'),
(32, 81398, '2018-11-28', '04:19:16', 'Administrator'),
(33, 81398, '2018-11-29', '03:00:37', 'Administrator'),
(34, 81398, '2018-12-10', '22:15:35', 'Administrator'),
(35, 81398, '2018-12-25', '19:38:53', 'Administrator'),
(36, 81398, '2019-01-05', '17:09:06', 'Administrator'),
(37, 81398, '2019-01-07', '16:23:06', 'Administrator'),
(38, 81398, '2019-01-10', '11:36:34', 'Administrator'),
(39, 81398, '2019-01-28', '16:38:19', 'Administrator'),
(40, 81398, '2019-01-30', '11:04:15', 'Administrator'),
(41, 81398, '2019-01-31', '16:03:20', 'Administrator'),
(42, 81398, '2019-02-26', '16:11:58', 'Administrator'),
(43, 1514, '2019-02-26', '16:55:25', 'Staff'),
(44, 81398, '2019-02-27', '15:52:05', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `Author_ID` int(10) NOT NULL,
  `Author_First_Name` varchar(255) NOT NULL,
  `Author_Last_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`Author_ID`, `Author_First_Name`, `Author_Last_Name`) VALUES
(2, 'Kiel Andrei', 'Santos'),
(3, 'Hernandez', 'Salazar'),
(4, 'Rodelio', 'Roque'),
(5, 'gin', 'Gaitama'),
(6, 'sample ', 'sample'),
(7, 'Enrico', 'Tabag'),
(8, 'Ma Corona', 'Romero'),
(9, 'Amelia', 'Mendoza'),
(10, 'Cristopher', 'De Jesus'),
(11, 'Paul', 'Kleinman'),
(12, 'Morton', 'Berman'),
(13, 'Patricia', 'Jakubowski'),
(14, 'William', 'Glasser'),
(15, 'Leo', 'Buscaglia'),
(16, 'J.A.', 'Rogers'),
(17, 'Thomas', 'Moore'),
(18, 'Alan Loy', 'McGinnis'),
(19, 'John', 'Thurman'),
(20, 'Judith', 'Vogt'),
(21, 'Ronna', 'Lichtenberg'),
(22, 'Steve', 'Biddulph'),
(23, 'Mark', 'Victor'),
(24, 'Alex', 'Osborn'),
(25, 'Scott', 'Peck'),
(26, 'Susan', 'Forward'),
(27, 'Nati', 'San Gabriel'),
(28, 'Robert', 'Greene'),
(29, 'Maricar', 'Desaliza'),
(30, 'Kristenee', 'Benzon');

-- --------------------------------------------------------

--
-- Table structure for table `barcodes`
--

CREATE TABLE `barcodes` (
  `Book_ID` int(11) NOT NULL,
  `Barcode_Number` varchar(255) NOT NULL,
  `Accession_Number` int(5) NOT NULL,
  `Availability` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barcodes`
--

INSERT INTO `barcodes` (`Book_ID`, `Barcode_Number`, `Accession_Number`, `Availability`) VALUES
(1, '2 25866 680 0', 1, '1'),
(2, '1 70129 951 0', 1, '1'),
(3, '8 18944 171 0', 1, '1'),
(4, '4 69980 660 9', 1, '1'),
(5, '0 36840 409 3', 1, '1'),
(6, '6 04175 723 0', 1, '1'),
(7, '4 79854 959 6', 1, '1'),
(8, '5 34357 751 4', 1, '1'),
(9, '2 94469 643 1', 1, '1'),
(10, '6 33270 468 1', 1, '1'),
(11, '0 54604 588 9', 1, '1'),
(12, '2 19717 381 7', 1, '1'),
(13, '2 58769 388 7', 1, '1'),
(14, '5 36780 677 1', 1, '1'),
(15, '4 12967 744 4', 1, '1'),
(16, '8 06863 328 1', 1, '1'),
(17, '2 39432 065 1', 1, '1'),
(18, '4 33809 116 5', 1, '1'),
(19, '5 28866 676 3', 1, '1'),
(20, '4 10510 191 6', 1, '1'),
(21, '7 15341 524 0', 1, '1'),
(22, '7 39577 725 9', 1, '1'),
(23, '5 43908 069 3', 1, '1'),
(23, '1 88436 608 7', 2, '1'),
(23, '4 29538 871 1', 3, '1'),
(23, '4 16097 327 4', 4, '1'),
(23, '4 13291 872 9', 5, '1');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `Book_ID` int(11) NOT NULL,
  `Publisher_ID` int(11) NOT NULL,
  `Section_ID` int(11) NOT NULL,
  `Book_Title` varchar(255) NOT NULL,
  `Call_Number` varchar(255) NOT NULL,
  `Edition` varchar(255) NOT NULL,
  `Year_Published` int(11) DEFAULT NULL,
  `Quantity` int(11) NOT NULL,
  `Unit_Of_Price` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Category_ID` int(11) NOT NULL,
  `Date_Added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`Book_ID`, `Publisher_ID`, `Section_ID`, `Book_Title`, `Call_Number`, `Edition`, `Year_Published`, `Quantity`, `Unit_Of_Price`, `Status`, `Image`, `Category_ID`, `Date_Added`) VALUES
(1, 1, 0, '108 Digital I,T. Solutions Inc., manual ', '12345', '1', 2016, 1, '120', 'active', '', 7, '2019-02-26'),
(2, 5, 3, 'Psych 101', '', 'First', 2012, 1, '', 'active', '', 3, '2018-09-22'),
(3, 6, 3, 'Eight Great Comedies', '', 'First', 1958, 1, '', 'active', '', 3, '2018-09-22'),
(4, 7, 3, 'The Assertive Option', '', 'First', 1978, 1, '', 'active', '', 3, '2018-09-22'),
(5, 8, 3, 'Control Theory', '', 'First', 1984, 1, '', 'active', '', 3, '2018-09-22'),
(6, 9, 3, 'Living, Loving & Learning', '', 'First', 1982, 1, '', 'inactive', '', 3, '2018-09-22'),
(7, 7, 0, 'The Assertive Option', '', 'First', 1978, 1, '', 'active', '', 3, '2019-01-31'),
(8, 11, 3, 'Care of the Soul', '', 'First', 1992, 1, '', 'active', '', 3, '2018-09-22'),
(9, 12, 3, 'Bringing Out The Best in People', '', 'First', 1991, 1, '', 'active', '', 3, '2018-09-22'),
(10, 13, 3, 'Pioneering Principles', '', 'First', 1962, 1, '', 'active', '', 3, '2018-09-22'),
(11, 14, 3, 'Empowerment in Organizations', '', 'First', 1990, 1, '', 'active', '', 3, '2018-09-22'),
(12, 12, 3, 'Confidence', '', 'First', 1987, 1, '', 'active', '', 3, '2018-09-22'),
(13, 15, 3, 'Work Would Be Great If It Weren\'t For The People', '', 'First', 1998, 1, '', 'active', '', 3, '2018-09-22'),
(14, 16, 3, 'The Secret Of A Happy Family', '', 'First', 1988, 1, '', 'active', '', 3, '2018-09-22'),
(15, 17, 3, 'Dare To Win', '', 'Second', 1994, 1, '', 'active', '', 3, '2018-09-22'),
(16, 18, 3, 'Applied Imagination', '', 'Second', 1992, 1, '', 'active', '', 3, '2018-09-22'),
(17, 19, 3, 'The Road Less Travelled', '', 'Second', 1990, 1, '', 'active', '', 3, '2018-09-22'),
(18, 20, 3, 'Toxic Parents', '', 'Second', 1989, 1, '', 'active', '', 3, '2018-09-22'),
(19, 21, 3, 'Business Finance', '', 'Third', 1980, 1, '', 'active', '', 3, '2018-09-22'),
(20, 22, 3, 'Mastery', '', 'Third', 2013, 1, '', 'active', '', 3, '2018-09-22'),
(21, 22, 3, '48 Laws Of Power', '', 'Third', 2000, 1, '', 'active', '', 3, '2018-09-22'),
(22, 2, 3, 'C2', '123', 'Second', 2016, 1, '', 'inactive', '', 2, '2018-09-22'),
(23, 1, 3, '108 Digital I,T. Solutions Inc., manual ', '12345', '1', 2016, 5, '120', 'active', '', 7, '2019-02-26');

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `Borrow_ID` int(11) NOT NULL,
  `Borrowers_ID` varchar(11) NOT NULL,
  `Librarian_ID` varchar(255) NOT NULL,
  `Date_Borrowed` datetime NOT NULL,
  `Borrow_Due_Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`Borrow_ID`, `Borrowers_ID`, `Librarian_ID`, `Date_Borrowed`, `Borrow_Due_Date`) VALUES
(1, '1514', '1514', '2018-09-22 17:32:23', '2018-09-29 17:32:23'),
(2, '1514', '1514', '2018-09-22 17:32:40', '2018-09-29 17:32:40'),
(3, '81398', '1514', '2018-09-22 17:34:47', '2018-09-29 17:34:47'),
(4, '81398', '1514', '2018-09-22 17:34:55', '2018-09-29 17:34:55'),
(5, '81398', '1514', '2018-09-22 17:35:50', '2018-09-29 17:35:50'),
(6, '81398', '1514', '2018-09-22 17:36:07', '2018-09-29 17:36:07'),
(7, '321', '1514', '2018-09-22 17:36:38', '2018-09-29 17:36:38'),
(8, '321', '1514', '2018-09-22 17:36:40', '2018-09-29 17:36:40'),
(9, '321', '1514', '2018-09-22 17:36:42', '2018-09-29 17:36:42'),
(10, '81398', '1514', '2018-09-22 17:37:15', '2018-09-29 17:37:15'),
(11, '81398', '1514', '2018-09-22 17:39:24', '2018-09-29 17:39:24'),
(12, '1514', '1514', '2018-09-22 17:39:40', '2018-09-29 17:39:40'),
(13, '1514', '1514', '2018-09-22 17:41:18', '2018-09-29 17:41:18'),
(14, '1514', '1514', '2018-09-22 17:41:32', '2018-09-29 17:41:32'),
(15, '1514', '1514', '2018-09-22 17:41:42', '2018-09-29 17:41:42'),
(16, '1514', '1514', '2018-09-22 17:41:47', '2018-09-29 17:41:47'),
(17, '1514', '1514', '2018-09-22 17:41:49', '2018-09-29 17:41:49'),
(18, '1514', '1514', '2018-09-22 17:41:50', '2018-09-29 17:41:50'),
(19, '1514', '1514', '2018-09-22 17:41:52', '2018-09-29 17:41:52'),
(20, '1514', '1514', '2018-09-22 17:41:56', '2018-09-29 17:41:56'),
(21, '81398', '81398', '2018-09-22 17:57:18', '2018-09-29 17:57:18'),
(22, '81398', '81398', '2018-09-22 17:57:43', '2018-09-29 17:57:43'),
(23, '81398', '81398', '2018-09-22 17:57:43', '2018-09-29 17:57:43'),
(24, '81398', '81398', '2018-09-24 14:33:05', '2018-10-01 14:33:05'),
(25, '81398', '81398', '2018-09-24 14:33:19', '2018-10-01 14:33:19'),
(26, '81398', '81398', '2019-02-26 16:31:08', '2019-03-05 16:31:08'),
(27, '81398', '81398', '2019-02-26 16:31:54', '2019-03-05 16:31:54');

-- --------------------------------------------------------

--
-- Table structure for table `borrower`
--

CREATE TABLE `borrower` (
  `Borrower_ID` int(10) NOT NULL,
  `Department_ID` int(11) NOT NULL,
  `Borrower_First_Name` varchar(255) NOT NULL,
  `Borrower_Middle_Name` varchar(255) NOT NULL,
  `Borrower_Last_Name` varchar(255) NOT NULL,
  `Contact_Number` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Borrower_Type` varchar(255) NOT NULL,
  `Status` varchar(255) DEFAULT NULL,
  `Course` varchar(255) NOT NULL,
  `Borrower_Password` varchar(255) NOT NULL,
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrower`
--

INSERT INTO `borrower` (`Borrower_ID`, `Department_ID`, `Borrower_First_Name`, `Borrower_Middle_Name`, `Borrower_Last_Name`, `Contact_Number`, `Gender`, `Borrower_Type`, `Status`, `Course`, `Borrower_Password`, `Image`) VALUES
(108, 7, 'ditsi', '', '', '', 'Male', 'College Student', NULL, 'Bachelor of Science in Nursing', '1587965fb4d4b5afe8428a4a024feb0d', NULL),
(123, 2, 'lolito', 'jose', 'pogi', '13212312123', 'Male', 'College Student', NULL, 'Bachelor of Science in Radiologic Technology', '202cb962ac59075b964b07152d234b70', NULL),
(321, 3, 'nat', 'tan', 'natnat', '12312312312', 'Male', 'College Student', NULL, 'Bachelor of Science in Physical Therapy', 'caf1a3dfb505ffed0d024130f58c5cfa', NULL),
(1212, 3, 'welp', 'welp', 'welp', '09052323232', 'Male', 'College Student', NULL, 'Bachelor of Science in Physical Therapy', 'a01610228fe998f515a72dd730294d87', NULL),
(23132121, 0, 'hjgj', 'fjfjh', 'hhgghkj', '90809808900', 'Male', 'Senior High School Student', NULL, '', 'a01610228fe998f515a72dd730294d87', NULL),
(2147483647, 1, 'Mar', 'Ocampo', 'Saliza', '09876533213', 'Female', 'College Student', NULL, 'Bachelor of Science in Nursing', '3f8af4a6eba2299b2ff2dafea6d786c3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `borrow_details`
--

CREATE TABLE `borrow_details` (
  `Borrow_Details_ID` int(11) NOT NULL,
  `Borrow_ID` int(11) NOT NULL,
  `Barcode_Number` varchar(255) NOT NULL,
  `Final_Due_Date` datetime NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `Category_ID` int(11) NOT NULL,
  `Category_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Category_ID`, `Category_Name`) VALUES
(1, 'Nursing'),
(2, 'Radiologic Technology'),
(3, 'Physical Theraphy'),
(4, 'Midwifery'),
(5, 'Tourism'),
(6, 'Hotel and Restaurant Management'),
(7, 'Thesis');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `Department_ID` int(11) NOT NULL,
  `Department_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`Department_ID`, `Department_Name`) VALUES
(1, 'Department of Nursing'),
(2, 'Department of Radiologic Technology'),
(3, 'Department of Physical Therapy'),
(4, 'Department of Midwifery'),
(5, 'Department of Tourism'),
(6, 'Department of Hotel and Restaurant Management'),
(7, 'asfd'),
(8, 'TDEPestsadff'),
(9, 'Department of Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `Holiday_ID` int(10) NOT NULL,
  `Holiday` varchar(50) NOT NULL,
  `Holiday_Type` varchar(20) NOT NULL,
  `Month` int(2) NOT NULL,
  `Day` int(2) NOT NULL,
  `Year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`Holiday_ID`, `Holiday`, `Holiday_Type`, `Month`, `Day`, `Year`) VALUES
(1, 'Jesus\' Birthday', 'Special Holiday', 12, 25, 2018),
(2, 'New Year', 'Special Holiday', 1, 1, 2019);

-- --------------------------------------------------------

--
-- Table structure for table `librarian`
--

CREATE TABLE `librarian` (
  `Librarian_ID` int(11) NOT NULL,
  `Librarian_First_Name` varchar(255) NOT NULL,
  `Librarian_Middle_Name` varchar(255) NOT NULL,
  `Librarian_Last_Name` varchar(255) NOT NULL,
  `Librarian_Password` varchar(255) NOT NULL,
  `Librarian_Type` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `librarian`
--

INSERT INTO `librarian` (`Librarian_ID`, `Librarian_First_Name`, `Librarian_Middle_Name`, `Librarian_Last_Name`, `Librarian_Password`, `Librarian_Type`, `Image`) VALUES
(123, 'Kiel', 'A', 'Villocillo', 'eb62f6b9306db575c2d596b1279627a4', 'Administrator', 'sacinean.png'),
(1514, 'andreious', 'Guzman', 'Villocillo', '83f2550373f2f19492aa30fbd5b57512', 'Staff', ''),
(2323, 'freelo', 'freelo', 'freelo', '149815eb972b3c370dee3b89d645ae14', 'Librarian', 'sacinean.png'),
(81398, 'Kiel Andrei', 'de Guzman', 'Villocillo', '4cb0f55ec4773bcb8e2eb61ee8d306d9', 'Administrator', 'sacinean.png');

-- --------------------------------------------------------

--
-- Table structure for table `penalties`
--

CREATE TABLE `penalties` (
  `Penalty_ID` int(11) NOT NULL,
  `Return_ID` int(11) NOT NULL,
  `Penalty` double NOT NULL,
  `Date_of_Payment` date NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penalty`
--

CREATE TABLE `penalty` (
  `Penalty_ID` int(11) NOT NULL,
  `Return_ID` int(11) NOT NULL,
  `Penalty_Status` varchar(255) NOT NULL,
  `Number_Of_Days_Over` int(11) NOT NULL,
  `Penalty_Amount` varchar(255) NOT NULL,
  `Amount_Paid` varchar(255) NOT NULL,
  `Change` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `Publisher_ID` int(10) NOT NULL,
  `Publisher_Name` varchar(255) NOT NULL,
  `Publisher_Address` varchar(255) NOT NULL,
  `Contact_Number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`Publisher_ID`, `Publisher_Name`, `Publisher_Address`, `Contact_Number`) VALUES
(1, 'abcd', 'ue', '09156372852'),
(2, 'C&E', 'recto', '09124565431'),
(3, 'abcdefg', '933', '09156372852'),
(4, 'REX Bookstore', 'nicanor reyes St.', '09123456723'),
(5, 'Adams Media', '621-629 Gastmabide', '421-2244'),
(6, 'The New American Library', '620 Lealtad', '455-5566'),
(7, 'Research Press Company', '77 Anonas', '440-2145'),
(8, 'Harper & Row, Publishers', 'F. Pimentel St. ', '455-1244'),
(9, 'Ballantine Books', 'San Francisco', '421-1001'),
(10, 'Simon & Schuster', 'C.M. Recto ', '541-7211'),
(11, 'HarperCollins Publishers', '440 Manhattan', '441-2345'),
(12, 'Augsburg Publishing House', 'Augsburg ', '721-9118'),
(13, 'C. Arthur Pearson, LTD.', 'Pearson St.', '441-6778'),
(14, 'Pfeiffer & Company', 'California', '445-5555'),
(15, 'Hyperion', 'Collins St.', '440-1121'),
(16, 'Doubleday', '11 Santa Barbara', '555-5555'),
(17, 'Berkley Books', 'San Francisco', '445-5891'),
(18, 'Better Yourself Books', 'Largo St.', '421-1134'),
(19, 'Arrow Books Limited', 'Lealtad', '440-1121'),
(20, 'Bantam Books', 'University ', ''),
(21, 'Goodwill Training Co., Inc.', 'Goodwill Avenue', '421-1135'),
(22, 'Penguin Books', 'Penguin Villa', '441-6711'),
(23, '108 ditsi', 'capitol commons', '09156372852');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `Reservation_ID` int(11) NOT NULL,
  `Borrowers_ID` int(11) NOT NULL,
  `Book_ID` int(11) NOT NULL,
  `Date_Reserved` datetime NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`Reservation_ID`, `Borrowers_ID`, `Book_ID`, `Date_Reserved`, `Status`) VALUES
(1, 81398, 18, '2018-09-22 17:05:51', 'active'),
(2, 81398, 16, '2018-09-22 17:08:10', 'inactive'),
(3, 81398, 19, '2018-09-22 17:08:55', 'inactive'),
(4, 81398, 21, '2018-09-22 17:09:55', 'inactive'),
(5, 81398, 21, '2018-09-22 17:11:21', 'inactive'),
(6, 81398, 16, '2018-09-22 17:12:23', 'inactive'),
(7, 81398, 9, '2018-09-22 17:13:59', 'inactive'),
(8, 81398, 16, '2018-09-22 17:17:19', 'active'),
(9, 81398, 21, '2018-09-22 17:19:04', 'inactive'),
(10, 81398, 21, '2018-09-22 17:20:53', 'active'),
(11, 81398, 9, '2018-09-22 17:21:11', 'active'),
(12, 1514, 19, '2018-09-22 17:40:38', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `return`
--

CREATE TABLE `return` (
  `Return_ID` int(11) NOT NULL,
  `Borrowers_ID` varchar(255) NOT NULL,
  `Accession_Number` varchar(255) NOT NULL,
  `Date_Returned` datetime NOT NULL,
  `Transaction_Status` varchar(255) NOT NULL,
  `Official_Receipt_Number` int(11) NOT NULL,
  `Borrower_Details_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `Section_ID` int(11) NOT NULL,
  `Section_Type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`Section_ID`, `Section_Type`) VALUES
(1, 'Foreign'),
(2, 'Filipinana'),
(3, 'Reference'),
(4, 'Circulations');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `Transaction_ID` int(11) NOT NULL,
  `Reservation_ID` int(11) NOT NULL,
  `Borrow_ID` int(11) NOT NULL,
  `Return_ID` int(11) NOT NULL,
  `Librarian_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `weeding`
--

CREATE TABLE `weeding` (
  `Weeding_ID` int(11) NOT NULL,
  `Book_ID` int(11) NOT NULL,
  `Reason` varchar(255) NOT NULL,
  `Date_Weeded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weeding`
--

INSERT INTO `weeding` (`Weeding_ID`, `Book_ID`, `Reason`, `Date_Weeded`) VALUES
(1, 6, '', '2018-09-22'),
(2, 22, '', '2018-09-22');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `Author_ID` int(11) NOT NULL,
  `Book_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`Author_ID`, `Book_ID`) VALUES
(11, 2),
(12, 3),
(13, 4),
(14, 5),
(15, 6),
(17, 8),
(18, 9),
(19, 10),
(20, 11),
(18, 12),
(21, 13),
(22, 14),
(23, 15),
(24, 16),
(25, 17),
(26, 18),
(27, 19),
(28, 20),
(28, 21),
(4, 22),
(13, 7),
(2, 23),
(29, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acquisition`
--
ALTER TABLE `acquisition`
  ADD PRIMARY KEY (`Acquisition_ID`);

--
-- Indexes for table `archieve`
--
ALTER TABLE `archieve`
  ADD PRIMARY KEY (`Archieve_ID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`Attendance_ID`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`Author_ID`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`Book_ID`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`Borrow_ID`);

--
-- Indexes for table `borrower`
--
ALTER TABLE `borrower`
  ADD PRIMARY KEY (`Borrower_ID`);

--
-- Indexes for table `borrow_details`
--
ALTER TABLE `borrow_details`
  ADD PRIMARY KEY (`Borrow_Details_ID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`Department_ID`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`Holiday_ID`);

--
-- Indexes for table `librarian`
--
ALTER TABLE `librarian`
  ADD PRIMARY KEY (`Librarian_ID`);

--
-- Indexes for table `penalties`
--
ALTER TABLE `penalties`
  ADD PRIMARY KEY (`Penalty_ID`);

--
-- Indexes for table `penalty`
--
ALTER TABLE `penalty`
  ADD PRIMARY KEY (`Penalty_ID`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`Publisher_ID`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`Reservation_ID`);

--
-- Indexes for table `return`
--
ALTER TABLE `return`
  ADD PRIMARY KEY (`Return_ID`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`Section_ID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`Transaction_ID`);

--
-- Indexes for table `weeding`
--
ALTER TABLE `weeding`
  ADD PRIMARY KEY (`Weeding_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acquisition`
--
ALTER TABLE `acquisition`
  MODIFY `Acquisition_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `archieve`
--
ALTER TABLE `archieve`
  MODIFY `Archieve_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `Attendance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `Author_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `Book_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `Borrow_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `borrow_details`
--
ALTER TABLE `borrow_details`
  MODIFY `Borrow_Details_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `Category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `Department_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `Holiday_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `penalties`
--
ALTER TABLE `penalties`
  MODIFY `Penalty_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penalty`
--
ALTER TABLE `penalty`
  MODIFY `Penalty_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `Publisher_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `Reservation_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `return`
--
ALTER TABLE `return`
  MODIFY `Return_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `Section_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `Transaction_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `weeding`
--
ALTER TABLE `weeding`
  MODIFY `Weeding_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
