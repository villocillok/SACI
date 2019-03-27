-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2018 at 04:31 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

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
('81398', 'Administrator', '0');

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
(21, 81398, '2018-09-21', '02:16:34', 'Administrator');

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
(2, 'Kiel Andrei', 'Villocillo'),
(3, 'Hernandez', 'Salazar'),
(4, 'Rodelio', 'Roque'),
(5, 'gin', 'Gaitama'),
(6, 'sample ', 'sample'),
(7, 'Enrico', 'Tabag'),
(8, 'Ma Corona', 'Romero'),
(9, 'Amelia', 'Mendoza'),
(10, 'Cristopher', 'De Jesus');

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
(1, '7 89734 540 5', 1, 'true'),
(1, '9 84747 486 8', 2, 'true'),
(1, '4 71416 991 0', 3, 'true'),
(1, '1 41732 177 8', 4, 'true'),
(1, '8 89200 791 1', 5, 'true'),
(1, '4 66843 300 5', 6, 'true'),
(1, '9 75740 739 9', 7, 'true'),
(1, '1 10090 395 9', 8, 'true'),
(1, '1 36946 848 1', 9, 'true'),
(1, '3 73325 665 9', 10, 'true'),
(1, '1 34930 222 9', 11, 'true'),
(1, '5 45541 894 0', 12, 'true'),
(1, '4 21017 346 9', 13, 'true'),
(1, '9 74836 119 0', 14, 'true'),
(1, '1 23485 598 5', 15, 'true'),
(1, '0 02716 402 0', 16, 'true'),
(1, '0 70576 386 7', 17, 'true'),
(1, '7 64146 972 2', 18, 'true'),
(1, '8 63942 870 4', 19, 'true'),
(1, '6 09194 373 5', 20, 'true'),
(1, '3 46433 955 9', 21, 'true'),
(1, '8 04747 417 1', 22, 'true'),
(1, '2 74378 724 7', 23, 'true'),
(1, '7 17055 674 2', 24, 'true'),
(1, '5 00879 903 4', 25, 'true'),
(1, '2 20181 251 5', 26, 'true'),
(1, '2 66695 377 2', 27, 'true'),
(1, '5 10923 360 1', 28, 'true'),
(1, '2 33206 403 6', 29, 'true'),
(1, '1 58504 501 5', 30, 'true'),
(1, '6 14247 538 1', 31, 'true'),
(1, '9 04668 239 6', 32, 'true'),
(1, '0 80721 609 2', 33, 'true'),
(1, '4 55836 542 1', 34, 'true'),
(1, '5 71080 882 6', 35, 'true'),
(1, '0 24767 791 4', 36, 'true'),
(1, '1 21393 649 2', 37, 'true'),
(1, '6 46580 668 6', 38, 'true'),
(1, '2 56703 654 9', 39, 'true'),
(1, '4 66748 162 1', 40, 'true'),
(1, '0 56863 335 0', 41, 'true'),
(1, '0 42966 787 9', 42, 'true'),
(1, '9 61933 247 3', 43, 'true'),
(1, '1 31108 175 5', 44, 'true'),
(1, '7 43885 725 9', 45, 'true'),
(1, '3 68337 119 5', 46, 'true'),
(1, '1 54019 675 1', 47, 'true'),
(1, '1 54050 780 9', 48, 'true'),
(1, '6 06902 712 2', 49, 'true'),
(1, '9 74332 923 7', 50, 'true'),
(1, '4 79023 447 2', 51, 'true'),
(1, '7 18268 851 4', 52, 'true'),
(1, '2 28817 171 0', 53, 'true'),
(1, '3 06050 328 0', 54, 'true'),
(1, '5 74759 936 1', 55, 'true'),
(1, '8 44932 199 9', 56, 'true'),
(1, '0 13678 625 3', 57, 'true'),
(1, '3 77165 117 7', 58, 'true'),
(1, '7 48470 823 1', 59, 'true'),
(1, '3 88378 011 3', 60, 'true'),
(1, '9 70089 486 3', 61, 'true'),
(1, '2 54259 157 2', 62, 'true'),
(1, '3 61898 506 0', 63, 'true'),
(1, '7 68665 211 2', 64, 'true'),
(1, '9 57026 187 1', 65, 'true'),
(1, '8 60031 569 5', 66, 'true'),
(1, '2 09120 115 8', 67, 'true'),
(1, '0 03122 669 1', 68, 'true'),
(1, '6 84049 431 9', 69, 'true'),
(1, '8 98724 909 3', 70, 'true'),
(1, '0 87133 170 7', 71, 'true'),
(1, '2 48536 800 3', 72, 'true'),
(1, '6 89066 269 2', 73, 'true'),
(1, '6 20493 314 0', 74, 'true'),
(1, '4 99722 471 7', 75, 'true'),
(1, '3 29415 578 4', 76, 'true'),
(1, '7 92365 462 3', 77, 'true'),
(1, '0 93402 173 1', 78, 'true'),
(1, '8 40951 130 7', 79, 'true'),
(1, '9 12643 878 8', 80, 'true'),
(1, '0 81889 597 1', 81, 'true'),
(1, '2 29776 590 5', 82, 'true'),
(1, '8 75666 242 7', 83, 'true'),
(1, '7 12290 053 3', 84, 'true'),
(1, '2 17321 079 4', 85, 'true'),
(1, '2 27438 748 9', 86, 'true'),
(1, '2 17551 027 6', 87, 'true'),
(1, '7 21699 945 1', 88, 'true'),
(1, '7 45383 121 4', 89, 'true'),
(1, '0 40054 127 4', 90, 'true'),
(1, '8 90861 947 6', 91, 'true'),
(1, '2 59605 786 0', 92, 'true'),
(1, '1 94332 638 6', 93, 'true'),
(1, '7 01574 858 2', 94, 'true'),
(1, '0 56932 262 3', 95, 'true'),
(1, '9 19375 424 8', 96, 'true'),
(1, '9 94802 469 6', 97, 'true'),
(1, '1 61413 458 5', 98, 'true'),
(1, '0 27623 358 1', 99, 'true'),
(1, '5 41983 956 0', 100, 'true'),
(2, '2 84309 605 4', 1, 'true'),
(2, '2 97830 858 6', 2, 'true'),
(2, '2 04028 250 4', 3, 'true'),
(2, '8 75992 796 5', 4, 'true'),
(2, '3 90086 995 6', 5, 'true'),
(2, '7 81378 035 0', 6, 'true'),
(2, '5 92789 086 9', 7, 'true'),
(2, '0 01003 872 2', 8, 'true'),
(2, '9 27568 075 9', 9, 'true'),
(2, '6 36091 256 5', 10, 'true'),
(2, '2 80030 616 7', 11, 'true'),
(2, '0 68845 460 7', 12, 'true'),
(2, '4 18371 849 8', 13, 'true'),
(2, '5 16978 052 2', 14, 'true'),
(2, '1 12923 266 9', 15, 'true'),
(2, '5 17840 149 9', 16, 'true'),
(2, '2 62140 087 4', 17, 'true'),
(2, '1 45006 870 9', 18, 'true'),
(2, '9 30866 762 2', 19, 'true'),
(2, '0 32396 602 8', 20, 'true'),
(2, '4 74710 098 1', 21, 'true'),
(2, '4 38417 268 1', 22, 'true'),
(2, '1 94631 516 9', 23, 'true'),
(2, '9 75482 702 3', 24, 'true'),
(2, '4 01862 006 8', 25, 'true'),
(2, '6 58487 450 3', 26, 'true'),
(2, '7 36161 658 0', 27, 'true'),
(2, '8 05847 931 8', 28, 'true'),
(2, '3 27662 624 5', 29, 'true'),
(2, '4 55033 735 0', 30, 'true'),
(2, '9 84862 266 8', 31, 'true'),
(2, '6 49625 532 1', 32, 'true'),
(2, '6 67076 421 6', 33, 'true'),
(2, '4 09437 963 4', 34, 'true'),
(2, '9 83148 828 3', 35, 'true'),
(2, '3 75936 202 8', 36, 'true'),
(2, '8 48234 076 6', 37, 'true'),
(2, '5 72331 799 3', 38, 'true'),
(2, '6 16801 442 8', 39, 'true'),
(2, '5 34304 315 6', 40, 'true'),
(2, '4 58044 095 4', 41, 'true'),
(2, '0 98413 198 0', 42, 'true'),
(2, '4 23640 025 3', 43, 'true'),
(2, '0 03976 444 8', 44, 'true'),
(2, '7 08199 152 4', 45, 'true'),
(2, '8 09565 536 3', 46, 'true'),
(2, '4 35046 650 1', 47, 'true'),
(2, '7 89078 409 2', 48, 'true'),
(2, '7 94659 728 0', 49, 'true'),
(2, '1 16782 826 3', 50, 'true'),
(2, '3 00652 356 9', 51, 'true'),
(2, '1 80429 766 4', 52, 'true'),
(2, '1 52533 475 2', 53, 'true'),
(2, '3 70525 871 5', 54, 'true'),
(2, '3 11967 083 8', 55, 'true'),
(2, '4 83965 523 2', 56, 'true'),
(2, '6 61176 864 8', 57, 'true'),
(2, '8 77382 573 0', 58, 'true'),
(2, '1 61053 983 9', 59, 'true'),
(2, '0 91195 651 4', 60, 'true'),
(2, '5 29185 817 6', 61, 'true'),
(2, '0 96414 441 6', 62, 'true'),
(2, '7 73617 176 9', 63, 'true'),
(2, '5 03014 241 8', 64, 'true'),
(2, '9 35401 589 6', 65, 'true'),
(2, '7 15282 273 1', 66, 'true'),
(2, '0 13127 993 9', 67, 'true'),
(2, '5 79321 088 2', 68, 'true'),
(2, '0 80366 024 1', 69, 'true'),
(2, '9 86070 623 9', 70, 'true'),
(2, '6 36405 890 0', 71, 'true'),
(2, '3 22849 700 0', 72, 'true'),
(2, '3 27554 569 1', 73, 'true'),
(2, '9 36522 512 4', 74, 'true'),
(2, '9 84543 262 0', 75, 'true'),
(2, '3 00702 971 3', 76, 'true'),
(2, '1 52471 254 2', 77, 'true'),
(2, '0 38360 985 2', 78, 'true'),
(2, '0 71430 603 7', 79, 'true'),
(2, '1 23173 841 4', 80, 'true'),
(2, '4 13391 917 7', 81, 'true'),
(2, '3 83526 751 9', 82, 'true'),
(2, '9 59609 910 1', 83, 'true'),
(2, '8 65439 907 8', 84, 'true'),
(2, '1 85721 546 9', 85, 'true'),
(2, '4 57802 179 3', 86, 'true'),
(2, '2 14365 828 0', 87, 'true'),
(2, '2 65477 794 9', 88, 'true'),
(2, '8 84457 950 7', 89, 'true'),
(2, '9 10894 274 7', 90, 'true'),
(2, '1 65912 575 8', 91, 'true'),
(2, '2 13446 739 0', 92, 'true'),
(2, '8 13234 795 7', 93, 'true'),
(2, '5 09216 701 1', 94, 'true'),
(2, '2 30728 968 6', 95, 'true'),
(2, '6 66349 828 3', 96, 'true'),
(2, '5 31385 213 0', 97, 'true'),
(2, '9 51335 684 9', 98, 'true'),
(2, '7 55007 547 4', 99, 'true'),
(2, '8 79040 988 2', 100, 'true'),
(2, '5 77668 531 5', 101, 'true'),
(2, '5 10158 207 8', 102, 'true'),
(2, '4 25087 184 8', 103, 'true'),
(2, '9 61415 220 7', 104, 'true'),
(2, '4 99712 854 0', 105, 'true'),
(2, '7 90897 865 8', 106, 'true'),
(2, '2 16741 953 1', 107, 'true'),
(2, '8 58244 533 9', 108, 'true'),
(2, '0 42176 175 6', 109, 'true'),
(2, '9 58624 384 7', 110, 'true'),
(2, '1 45778 426 5', 111, 'true'),
(2, '1 33967 263 9', 112, 'true'),
(2, '3 70953 343 8', 113, 'true'),
(2, '8 12789 068 9', 114, 'true'),
(2, '8 17667 095 0', 115, 'true'),
(2, '5 19378 751 0', 116, 'true'),
(2, '2 12171 185 7', 117, 'true'),
(2, '7 61476 303 7', 118, 'true'),
(2, '2 67505 523 9', 119, 'true'),
(2, '5 70219 193 1', 120, 'true'),
(2, '9 62607 177 9', 121, 'true'),
(2, '9 03220 234 6', 122, 'true'),
(2, '9 77675 190 7', 123, 'true'),
(2, '1 68362 349 0', 124, 'true'),
(2, '7 63849 018 7', 125, 'true'),
(2, '9 85388 007 7', 126, 'true'),
(2, '4 03269 583 5', 127, 'true'),
(2, '6 14068 772 0', 128, 'true'),
(2, '4 13741 209 5', 129, 'true'),
(2, '5 94376 997 8', 130, 'true'),
(2, '3 23748 118 1', 131, 'true'),
(2, '6 78032 014 5', 132, 'true'),
(2, '1 46833 738 6', 133, 'true'),
(2, '4 28129 163 4', 134, 'true'),
(2, '1 94467 000 1', 135, 'true'),
(2, '0 23043 182 1', 136, 'true'),
(2, '0 42384 383 3', 137, 'true'),
(2, '4 30110 218 3', 138, 'true'),
(2, '8 14063 378 8', 139, 'true'),
(2, '7 87039 547 6', 140, 'true'),
(2, '8 20952 482 6', 141, 'true'),
(2, '2 88450 092 1', 142, 'true'),
(2, '4 50766 048 7', 143, 'true'),
(2, '6 28858 231 8', 144, 'true'),
(2, '4 39753 840 5', 145, 'true'),
(2, '9 59331 504 7', 146, 'true'),
(2, '2 25489 110 4', 147, 'true'),
(2, '2 95214 652 9', 148, 'true'),
(2, '5 17032 466 1', 149, 'true'),
(2, '9 61393 994 5', 150, 'true'),
(2, '2 38283 195 4', 151, 'true'),
(2, '3 33374 547 0', 152, 'true'),
(2, '6 36717 149 4', 153, 'true'),
(2, '5 63691 033 7', 154, 'true'),
(2, '4 88142 663 9', 155, 'true'),
(2, '2 50709 146 4', 156, 'true'),
(2, '5 77327 239 2', 157, 'true'),
(2, '4 78433 382 5', 158, 'true'),
(2, '3 10802 901 8', 159, 'true'),
(2, '8 19334 188 3', 160, 'true'),
(2, '2 15365 729 2', 161, 'true'),
(2, '6 00218 548 0', 162, 'true'),
(2, '2 53998 467 2', 163, 'true'),
(2, '9 31707 063 7', 164, 'true'),
(2, '9 38611 790 3', 165, 'true'),
(2, '4 90411 721 7', 166, 'true'),
(2, '9 68649 406 3', 167, 'true'),
(2, '7 82724 766 1', 168, 'true'),
(2, '4 50774 757 7', 169, 'true'),
(2, '2 27453 290 8', 170, 'true'),
(2, '6 21475 536 6', 171, 'true'),
(2, '4 92449 645 9', 172, 'true'),
(2, '3 95350 353 8', 173, 'true'),
(2, '6 78721 669 9', 174, 'true'),
(2, '7 87821 984 3', 175, 'true'),
(2, '6 41768 845 8', 176, 'true'),
(2, '8 16839 738 8', 177, 'true'),
(2, '4 89801 429 4', 178, 'true'),
(2, '7 60714 347 5', 179, 'true'),
(2, '8 10419 151 9', 180, 'true'),
(2, '5 34013 965 7', 181, 'true'),
(2, '8 68875 718 0', 182, 'true'),
(2, '3 82257 693 5', 183, 'true'),
(2, '5 52093 087 3', 184, 'true'),
(2, '9 01309 586 8', 185, 'true'),
(2, '7 39238 319 4', 186, 'true'),
(2, '5 41556 969 6', 187, 'true'),
(2, '7 72576 831 3', 188, 'true'),
(2, '5 87249 934 2', 189, 'true'),
(2, '2 14363 037 8', 190, 'true'),
(2, '4 64083 076 1', 191, 'true'),
(2, '6 97059 670 0', 192, 'true'),
(2, '7 84472 086 8', 193, 'true'),
(2, '6 49796 890 1', 194, 'true'),
(2, '4 73252 200 8', 195, 'true'),
(2, '9 51398 309 8', 196, 'true'),
(2, '9 60458 517 1', 197, 'true'),
(2, '0 56042 149 7', 198, 'true'),
(2, '0 93790 951 7', 199, 'true'),
(2, '4 93151 818 4', 200, 'true'),
(2, '0 23963 703 4', 201, 'true'),
(2, '7 70320 096 2', 202, 'true'),
(2, '3 72624 132 2', 203, 'true'),
(2, '7 18576 698 7', 204, 'true'),
(2, '7 26857 467 1', 205, 'true'),
(2, '5 36135 791 2', 206, 'true'),
(2, '3 53970 835 2', 207, 'true'),
(2, '9 94953 433 5', 208, 'true'),
(2, '5 89663 429 1', 209, 'true'),
(2, '9 27803 447 9', 210, 'true'),
(2, '3 35647 048 2', 211, 'true'),
(2, '7 16698 210 8', 212, 'true'),
(2, '6 21820 863 2', 213, 'true'),
(2, '3 41786 358 3', 214, 'true'),
(2, '9 63748 099 1', 215, 'true'),
(2, '9 75622 623 9', 216, 'true'),
(2, '6 96345 372 0', 217, 'true'),
(2, '0 01365 277 9', 218, 'true'),
(2, '6 94359 748 1', 219, 'true'),
(2, '7 09244 128 2', 220, 'true'),
(2, '3 40434 820 8', 221, 'true'),
(2, '1 89989 038 6', 222, 'true'),
(2, '9 09907 043 0', 223, 'true'),
(2, '4 14634 130 8', 224, 'true'),
(2, '8 45821 472 3', 225, 'true'),
(2, '7 55080 755 9', 226, 'true'),
(2, '7 59411 257 8', 227, 'true'),
(2, '6 07016 425 8', 228, 'true'),
(2, '4 42095 590 7', 229, 'true'),
(2, '0 98841 791 3', 230, 'true'),
(2, '2 21475 872 5', 231, 'true'),
(2, '6 59406 902 5', 232, 'true'),
(2, '4 49595 883 1', 233, 'true'),
(2, '2 09832 543 7', 234, 'true'),
(2, '4 40004 531 9', 235, 'true'),
(2, '6 29643 990 3', 236, 'true'),
(2, '4 10694 581 2', 237, 'true'),
(2, '4 06134 113 3', 238, 'true'),
(2, '7 44410 886 9', 239, 'true'),
(2, '8 41182 424 2', 240, 'true'),
(2, '0 63417 428 1', 241, 'true'),
(2, '7 21459 667 7', 242, 'true'),
(2, '5 68684 572 6', 243, 'true'),
(2, '7 33796 470 6', 244, 'true'),
(2, '9 39515 973 2', 245, 'true'),
(2, '0 02046 062 3', 246, 'true'),
(2, '9 13655 404 8', 247, 'true'),
(2, '4 72474 507 8', 248, 'true'),
(2, '8 43057 946 5', 249, 'true'),
(2, '8 12190 042 4', 250, 'true'),
(2, '8 73929 703 3', 251, 'true'),
(2, '0 22915 570 6', 252, 'true'),
(2, '8 34251 533 6', 253, 'true'),
(2, '0 57988 952 7', 254, 'true'),
(2, '2 54166 014 9', 255, 'true'),
(2, '5 04071 908 8', 256, 'true'),
(2, '1 92875 735 9', 257, 'true'),
(2, '9 95977 365 9', 258, 'true'),
(2, '2 04777 307 8', 259, 'true'),
(2, '4 91853 281 4', 260, 'true'),
(2, '5 02944 940 2', 261, 'true'),
(2, '0 19892 481 8', 262, 'true'),
(2, '9 00562 750 5', 263, 'true'),
(2, '1 82349 266 3', 264, 'true'),
(2, '0 81608 783 4', 265, 'true'),
(2, '0 05489 540 4', 266, 'true'),
(2, '5 13286 437 9', 267, 'true'),
(2, '3 78733 017 3', 268, 'true'),
(2, '1 07452 677 6', 269, 'true'),
(2, '2 70937 338 7', 270, 'true'),
(2, '4 24153 827 4', 271, 'true'),
(2, '9 29839 589 0', 272, 'true'),
(2, '8 52892 310 5', 273, 'true'),
(2, '8 08607 186 7', 274, 'true'),
(2, '0 65425 331 7', 275, 'true'),
(2, '9 05790 624 1', 276, 'true'),
(2, '8 48554 324 1', 277, 'true'),
(2, '3 90798 719 4', 278, 'true'),
(2, '8 65063 826 4', 279, 'true'),
(2, '3 22177 509 1', 280, 'true'),
(2, '4 01845 018 0', 281, 'true'),
(2, '7 16767 511 3', 282, 'true'),
(2, '0 71661 400 9', 283, 'true'),
(2, '3 49788 540 1', 284, 'true'),
(2, '5 25546 967 6', 285, 'true'),
(2, '0 76292 473 4', 286, 'true'),
(2, '2 61843 091 7', 287, 'true'),
(2, '2 53215 578 6', 288, 'true'),
(2, '8 87176 152 0', 289, 'true'),
(2, '0 05699 539 6', 290, 'true'),
(2, '1 57099 174 4', 291, 'true'),
(2, '4 72981 373 8', 292, 'true'),
(2, '6 72315 764 4', 293, 'true'),
(2, '8 87952 480 4', 294, 'true'),
(2, '3 55549 349 7', 295, 'true'),
(2, '0 30867 077 6', 296, 'true'),
(2, '2 67111 696 5', 297, 'true'),
(2, '4 04392 492 5', 298, 'true'),
(2, '4 85368 905 3', 299, 'true'),
(2, '3 94654 528 2', 300, 'true'),
(2, '3 24731 707 6', 301, 'true'),
(2, '4 15861 741 0', 302, 'true'),
(2, '1 31031 604 2', 303, 'true'),
(2, '5 77729 608 6', 304, 'true'),
(2, '6 19965 608 4', 305, 'true'),
(2, '1 42459 393 1', 306, 'true'),
(2, '2 39635 861 1', 307, 'true'),
(2, '9 32776 633 8', 308, 'true'),
(2, '1 44403 287 6', 309, 'true'),
(2, '7 47042 729 5', 310, 'true'),
(2, '8 83942 904 0', 311, 'true'),
(2, '0 02194 652 9', 312, 'true'),
(2, '5 09210 113 7', 313, 'true'),
(2, '9 34327 969 6', 314, 'true'),
(2, '3 85950 339 8', 315, 'true'),
(2, '8 82872 536 7', 316, 'true'),
(2, '8 87771 186 8', 317, 'true'),
(2, '6 35091 848 5', 318, 'true'),
(2, '4 67174 738 0', 319, 'true'),
(2, '2 99672 994 6', 320, 'true'),
(2, '0 63098 791 2', 321, 'true'),
(2, '7 24919 625 7', 322, 'true'),
(2, '0 43554 279 3', 323, 'true'),
(2, '2 87978 368 5', 324, 'true'),
(2, '2 60043 500 6', 325, 'true'),
(2, '4 27966 082 0', 326, 'true'),
(2, '9 76792 372 3', 327, 'true'),
(2, '2 36768 024 0', 328, 'true'),
(2, '9 63208 532 0', 329, 'true'),
(2, '1 96815 531 7', 330, 'true'),
(2, '2 75052 944 7', 331, 'true'),
(2, '2 71394 087 4', 332, 'true'),
(2, '3 80623 900 6', 333, 'true'),
(2, '1 03466 721 8', 334, 'true'),
(2, '8 36419 237 8', 335, 'true'),
(2, '2 35487 855 1', 336, 'true'),
(2, '3 61639 464 7', 337, 'true'),
(2, '7 61824 725 0', 338, 'true'),
(2, '6 85522 458 6', 339, 'true'),
(2, '4 78693 104 0', 340, 'true'),
(2, '9 02796 287 9', 341, 'true'),
(2, '1 49721 418 7', 342, 'true'),
(2, '5 32794 982 7', 343, 'true'),
(2, '6 96998 018 6', 344, 'true'),
(2, '3 46683 014 2', 345, 'true'),
(2, '6 24897 819 6', 346, 'true'),
(2, '7 22298 415 4', 347, 'true'),
(2, '0 25820 754 0', 348, 'true'),
(2, '6 40743 586 4', 349, 'true'),
(2, '4 81848 823 3', 350, 'true'),
(2, '3 97866 447 0', 351, 'true'),
(2, '9 22742 596 8', 352, 'true'),
(2, '1 69617 849 3', 353, 'true'),
(2, '0 58544 191 8', 354, 'true'),
(2, '3 39781 330 4', 355, 'true'),
(2, '2 59252 991 9', 356, 'true'),
(2, '9 86317 353 9', 357, 'true'),
(2, '1 58423 453 1', 358, 'true'),
(2, '4 52894 332 8', 359, 'true'),
(2, '5 88857 846 1', 360, 'true'),
(2, '6 12476 050 5', 361, 'true'),
(2, '2 92626 750 3', 362, 'true'),
(2, '3 83550 067 2', 363, 'true'),
(2, '8 81536 796 5', 364, 'true'),
(2, '4 98307 139 8', 365, 'true'),
(2, '3 50009 049 7', 366, 'true'),
(2, '7 43324 906 9', 367, 'true'),
(2, '9 40257 456 9', 368, 'true'),
(2, '8 40638 682 7', 369, 'true'),
(2, '3 07173 386 8', 370, 'true'),
(2, '0 71516 706 5', 371, 'true'),
(2, '3 91124 656 8', 372, 'true'),
(2, '8 85093 214 0', 373, 'true'),
(2, '8 05021 554 3', 374, 'true'),
(2, '6 29603 065 4', 375, 'true'),
(2, '7 89966 603 0', 376, 'true'),
(2, '6 47934 584 8', 377, 'true'),
(2, '9 85377 095 8', 378, 'true'),
(2, '4 86908 567 2', 379, 'true'),
(2, '4 46368 873 6', 380, 'true'),
(2, '9 91783 200 8', 381, 'true'),
(2, '3 26429 089 7', 382, 'true'),
(2, '8 71896 133 9', 383, 'true'),
(2, '4 20056 814 9', 384, 'true'),
(2, '4 40421 348 0', 385, 'true'),
(2, '0 40328 369 5', 386, 'true'),
(2, '0 81718 306 5', 387, 'true'),
(2, '7 71308 748 7', 388, 'true'),
(2, '6 72756 246 3', 389, 'true'),
(2, '8 53760 651 5', 390, 'true'),
(2, '5 24362 400 2', 391, 'true'),
(2, '3 69551 323 8', 392, 'true'),
(2, '1 01395 500 1', 393, 'true'),
(2, '8 37203 386 9', 394, 'true'),
(2, '6 91057 673 4', 395, 'true'),
(2, '9 05352 182 3', 396, 'true'),
(2, '1 96553 551 9', 397, 'true'),
(2, '6 20693 892 3', 398, 'true'),
(2, '8 47219 306 3', 399, 'true'),
(2, '2 93833 354 7', 400, 'true'),
(2, '1 66434 828 0', 401, 'true'),
(2, '9 43302 527 4', 402, 'true'),
(2, '7 14481 059 1', 403, 'true'),
(2, '7 44443 164 7', 404, 'true'),
(2, '5 42529 461 1', 405, 'true'),
(2, '3 82887 349 9', 406, 'true'),
(2, '2 28399 433 7', 407, 'true'),
(2, '8 98111 741 3', 408, 'true'),
(2, '7 15250 281 1', 409, 'true'),
(2, '6 63067 220 3', 410, 'true'),
(2, '6 39893 834 9', 411, 'true'),
(2, '9 53291 708 3', 412, 'true'),
(2, '0 77266 061 6', 413, 'true'),
(2, '0 10568 815 1', 414, 'true'),
(2, '4 29895 059 1', 415, 'true'),
(2, '3 91812 321 5', 416, 'true'),
(2, '3 07677 757 8', 417, 'true'),
(2, '0 42971 504 2', 418, 'true'),
(2, '1 75788 527 3', 419, 'true'),
(2, '3 01107 896 7', 420, 'true'),
(2, '5 66684 174 8', 421, 'true'),
(2, '1 77599 724 9', 422, 'true'),
(2, '5 60931 265 4', 423, 'true'),
(2, '5 11494 762 4', 424, 'true'),
(2, '2 33286 406 2', 425, 'true'),
(2, '4 60226 477 3', 426, 'true'),
(2, '5 28289 560 6', 427, 'true'),
(2, '4 90895 079 5', 428, 'true'),
(2, '8 54509 242 5', 429, 'true'),
(2, '0 88414 387 6', 430, 'true'),
(2, '2 56819 873 2', 431, 'true'),
(2, '9 22323 205 6', 432, 'true'),
(2, '5 76686 746 4', 433, 'true'),
(2, '5 42472 435 9', 434, 'true'),
(2, '5 93580 446 8', 435, 'true'),
(2, '3 78922 422 6', 436, 'true'),
(2, '7 37951 931 8', 437, 'true'),
(2, '3 10290 050 3', 438, 'true'),
(2, '9 38756 137 0', 439, 'true'),
(2, '6 08931 937 5', 440, 'true'),
(2, '0 91247 218 1', 441, 'true'),
(2, '4 66480 430 0', 442, 'true'),
(2, '1 69494 458 0', 443, 'true'),
(2, '3 37173 847 1', 444, 'true'),
(2, '5 42293 765 8', 445, 'true'),
(2, '9 05667 856 4', 446, 'true'),
(2, '7 92711 391 3', 447, 'true'),
(2, '0 48917 476 9', 448, 'true'),
(2, '1 29664 128 6', 449, 'true'),
(2, '2 16887 318 3', 450, 'true'),
(2, '0 16660 656 5', 451, 'true'),
(2, '8 99271 189 7', 452, 'true'),
(2, '2 54457 423 3', 453, 'true'),
(2, '8 89003 191 3', 454, 'true'),
(2, '4 56102 355 8', 455, 'true'),
(2, '5 91963 632 5', 456, 'true'),
(2, '8 95466 481 8', 457, 'true'),
(2, '1 36498 878 5', 458, 'true'),
(3, '1 93977 818 5', 1, 'true'),
(3, '4 90989 807 2', 2, 'true'),
(3, '0 76368 354 1', 3, 'true'),
(3, '5 28180 479 0', 4, 'true'),
(3, '3 21725 295 6', 5, 'true'),
(4, '9 05781 702 8', 1, 'true'),
(4, '9 14485 599 7', 2, 'true'),
(4, '1 71370 033 0', 3, 'true'),
(4, '3 92240 180 9', 4, 'true'),
(4, '1 59540 731 9', 5, 'true'),
(4, '2 30291 462 9', 6, 'true');

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
(1, 3, 2, 'pluma', '', '', 0, 100, '', 'active', '', 3, '0000-00-00'),
(2, 4, 1, 'Victor', '', '3rd', 0, 1000, '1500', 'active', '', 3, '0000-00-00'),
(3, 2, 4, 'Physical Science', '', '1st', 2004, 5, '340', 'active', '', 3, '0000-00-00'),
(4, 2, 3, 'Science Biology', '', '4th', 2001, 6, '370', 'active', '', 2, '0000-00-00');

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
(7, 'Thesiss');

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
(8, 'TDEPestsadf'),
(9, 'Department of Engineerin');

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
(1514, 'andreious', 'Guzman', 'Villocillo', '83f2550373f2f19492aa30fbd5b57512', 'Staff', ''),
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
(4, 'REX Bookstore', 'nicanor reyes St.', '09123456723');

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
(1, 81398, 1, '2018-09-21 16:53:08', 'active');

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
  `Official_Receipt_Number` int(11) NOT NULL
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
(5, 1),
(4, 4);

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
  MODIFY `Attendance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `Author_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `Book_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `Borrow_ID` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `Publisher_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `Reservation_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `Weeding_ID` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
