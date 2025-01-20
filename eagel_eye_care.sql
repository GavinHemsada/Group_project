-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2024 at 08:30 AM
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
-- Database: `eagel_eye_care`
--

-- --------------------------------------------------------

--
-- Table structure for table `admine`
--

CREATE TABLE `admine` (
  `Email` varchar(100) NOT NULL,
  `Password` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admine`
--

INSERT INTO `admine` (`Email`, `Password`) VALUES
('admin@gmail.com', 'admiN@12');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `Appointment_id` varchar(50) NOT NULL,
  `Fisrt_name` varchar(100) NOT NULL,
  `Last_name` varchar(100) NOT NULL,
  `Treatment_type` varchar(100) NOT NULL,
  `Age` int(20) NOT NULL,
  `Date` date NOT NULL,
  `Doctor_Name` varchar(100) NOT NULL,
  `Price` varchar(100) NOT NULL,
  `Patient_id` varchar(50) NOT NULL,
  `Doctor_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`Appointment_id`, `Fisrt_name`, `Last_name`, `Treatment_type`, `Age`, `Date`, `Doctor_Name`, `Price`, `Patient_id`, `Doctor_id`) VALUES
('EV_A1', 'gavin1', 'hemsada34', 'Laser Surgery', 15, '2024-11-15', 'gavin hemsada', '$500', 'P_EV1', 'D_EV1'),
('EV_A2', 'gavin', 'hemsada', 'Eye Care', 22, '2024-09-13', '', '$100', 'P_EV1', 'D_EV1'),
('EV_A3', 'gavin', 'hemsada', 'Retina Repair', 33, '2024-09-14', 'gavin hemsada', '$400', 'P_EV1', 'D_EV3'),
('EV_A4', 'gavin', 'hemsada', 'Laser Surgery', 33, '2024-09-14', 'gavin hemsada', '$500', 'P_EV1', 'D_EV1'),
('EV_A5', 'gavin', 'hemsada', 'Eye Care', 50, '2024-09-22', 'gavinh hemsada', '$100', 'P_EV2', 'D_EV2'),
('EV_A6', 'gavin', 'hemsada', 'Eye Care', 22, '2024-09-20', 'gavinh hemsada', '$100', 'P_EV1', 'D_EV2'),
('EV_A7', 'gavin', 'hemsada', 'Laser Surgery', 33, '2024-09-26', 'gavin hemsada', '$500', 'P_EV1', 'D_EV1'),
('EV_A8', '', '', 'Eye Care', 0, '0000-00-00', '', '$100', 'P_EV1', 'D_EV1'),
('EV_A9', 'gavin', 'hemsada', 'Eye Care', 22, '2024-09-27', 'gavinh hemsada', '$100', 'P_EV1', 'D_EV2'),
('EV_A10', 'gavin', 'hemsada', 'Laser Surgery', 34, '2024-09-27', 'gavin hemsada', '$500', 'P_EV1', 'D_EV1'),
('EV_A11', 'gavin', 'hemsada', 'Laser Surgery', 22, '2024-09-26', 'gavin hemsada', '$500', 'P_EV1', 'D_EV1'),
('EV_A12', 'gavin', 'hemsada', 'Eye Care', 30, '2024-09-30', 'gavinh hemsada', '$100', 'P_EV1', 'D_EV2'),
('EV_A14', 'gavin', 'hemsada', '', 16, '0000-00-00', '', '', 'P_EV1', 'D_EV1'),
('EV_A15', 'gavin', 'hemsada', 'Laser Surgery', 23, '0000-00-00', 'gavin hemsada', '$500', 'P_EV1', 'D_EV1'),
('EV_A15', 'gavin', 'hemsada', 'Eye Care', 19, '2024-11-18', 'gavinh hemsada', '$100', 'P_EV1', 'D_EV2');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `Doctor_id` varchar(20) NOT NULL,
  `Fisrt_name` varchar(100) NOT NULL,
  `Last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `Age` int(20) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Phone_Number` varchar(100) NOT NULL,
  `Street_Number` varchar(50) NOT NULL,
  `Street_Name` varchar(100) NOT NULL,
  `City` varchar(100) NOT NULL,
  `password` varchar(70) DEFAULT NULL,
  `Profile_photo` varchar(100) DEFAULT NULL,
  `Hospital_Name` varchar(100) DEFAULT NULL,
  `Hospital_ID` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`Doctor_id`, `Fisrt_name`, `Last_name`, `email`, `Gender`, `Age`, `Role`, `Phone_Number`, `Street_Number`, `Street_Name`, `City`, `password`, `Profile_photo`, `Hospital_Name`, `Hospital_ID`) VALUES
('D_EV1', 'gavin', 'hemsada', 'ghemsada@gmail.com', 'male', 0, 'Laser Surgery', '0718721716', '142/C', ' duwawatta road', 'piliyandala', '$2y$10$VZo4sh13b3pAAU7DiKwraOJJ8v7fMuxn3jlm6JHh00XKc..trHXQu', 'Doctor-D_EV1.png', NULL, NULL),
('D_EV2', 'gavinh', 'hemsada', 'gavinhemsada@gmail.com', 'male', 0, 'Eye Care', '0718721716', '142/C', ' duwawatta road', 'piliyandala', '$2y$10$7CMWDyVcALnoUbQ.AraMZuqB5cVhE3BCduQwhsL.XVr9z705AA8L6', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `Patient_id` varchar(50) NOT NULL,
  `Fisrt_name` varchar(100) NOT NULL,
  `Last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Phone_Number` varchar(100) NOT NULL,
  `Street_Number` varchar(50) NOT NULL,
  `Street_Name` varchar(100) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Profile_photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`Patient_id`, `Fisrt_name`, `Last_name`, `email`, `Gender`, `password`, `Phone_Number`, `Street_Number`, `Street_Name`, `City`, `Profile_photo`) VALUES
('P_EV1', 'gavin1', 'hemsada', 'ghemsada@gmail.com', 'male', '$2y$10$R05vtHMWPqNkosCbXtjyW.LQQHDz2seqFwGCAL2eGyz7at4//t/xi', '0718721716', '142/C', ' duwawatta road', 'piliyandala', 'Patient-P_EV1.png'),
('P_EV2', 'gavin', 'hemsada', 'gahemsada@gmail.com', 'male', '$2y$10$b86viScTS.SJMIGWwR2G5u.r3KdJsoTgMnJwSeWBpgXpEoAe8qM4K', '0718721716', '142/C,', ' duwawatta road', 'piliyandala', 'Patient-P_EV2.png'),
('P_EV3', 'gavin', 'hemsada', 'gbhemsada@gmail.com', 'male', '$2y$10$lq6VXLWkkIVQ.Gy5z6DdjuooIRIJjYcKVU2pouU.Suxz3AkLkaA2q', '0718721716', '142/C,', ' duwawatta road', 'piliyandala', 'Patient-P_EV3.png');

-- --------------------------------------------------------

--
-- Table structure for table `patinet_subscriptions`
--

CREATE TABLE `patinet_subscriptions` (
  `Patient_Sub_ID` varchar(50) NOT NULL,
  `Patient_ID` varchar(100) NOT NULL,
  `Sub_Type` varchar(100) NOT NULL,
  `Sub_name` varchar(100) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Sub_Price` varchar(50) DEFAULT NULL,
  `States` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patinet_subscriptions`
--

INSERT INTO `patinet_subscriptions` (`Patient_Sub_ID`, `Patient_ID`, `Sub_Type`, `Sub_name`, `Date`, `Sub_Price`, `States`) VALUES
('9JA81932A9111771C', 'P_EV1', 'Monthly', 'Basic Plan', '2024-09-21', '$100.00', 'Expired'),
('7RU853267F236634E', 'P_EV2', 'Monthly', 'Standard Plan', '2024-09-21', '$500.00', 'active'),
('1VJ78934RU4970928', 'P_EV3', 'Annual', 'Standard Plan', '2024-09-21', '$3000.00', 'active'),
('1XW12957X63241843', 'P_EV1', 'Monthly', 'Premium Plan', '2024-11-16', '$2000.00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_id` varchar(50) NOT NULL,
  `Date` date NOT NULL,
  `Payment_type` varchar(50) NOT NULL,
  `Price` varchar(50) NOT NULL,
  `Patinet_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_id`, `Date`, `Payment_type`, `Price`, `Patinet_id`) VALUES
('27N87887XY529263V', '2024-11-01', 'Paid', '$500.00', 'P_EV1'),
('4EL18214K10774645', '2024-11-16', 'Paid', '$100.00', 'P_EV1');

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `Appointment_id` varchar(50) NOT NULL,
  `ratings` int(100) NOT NULL,
  `Message` varchar(100) NOT NULL,
  `Patient_ID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`Appointment_id`, `ratings`, `Message`, `Patient_ID`) VALUES
('EV_A1', 5, 'dfdf', 'P_EV1'),
('EV_A2', 5, 'gg', 'P_EV1'),
('EV_A3', 5, 'gg', 'P_EV1'),
('EV_A6', 5, 'gg', 'P_EV1');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `Service_id` varchar(50) NOT NULL,
  `Service_Name` varchar(100) NOT NULL,
  `Photo` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Price` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`Service_id`, `Service_Name`, `Photo`, `Description`, `Price`) VALUES
('EVE_S_2', 'Eye Care', 'eye_care.jpg', 'Experience the latest breakthrough in vision correction. Our skilled ophthalmologists utilize advanced laser technology to reshape the cornea with precision, reducing or eliminating the need for glasses or contact lenses.', '$100'),
('EVE_S_3', 'Retina Repair', 'Retina_Repair.jpg', 'Retina repair involves advanced procedures to treat conditions like retinal tears, detachment, or macular degeneration. Our expert ophthalmologists use cutting-edge techniques to restore the retina and protect your vision. We ensure precise and effective treatment to preserve your eyesight and improve your quality of life.', '$400'),
('EVE_S_4', 'Vision Check', 'Vision_Check.jpg', 'A vision check is a comprehensive eye exam that assesses your eyesight and detects any issues early. Our specialists evaluate your vision clarity, eye health, and screen for conditions like nearsightedness or astigmatism. Regular vision checks ensure your eyes stay healthy and your prescription is up to date.', '$150'),
('EVE_S_5', 'Cornea Transplant', 'Cornea_Transplant.jpg', 'A cornea transplant replaces damaged or diseased corneal tissue with healthy donor tissue, restoring clear vision. Our skilled surgeons perform this delicate procedure with precision, treating conditions like keratoconus or scarring. A successful cornea transplant can significantly improve vision and enhance your overall quality of life.', '$600'),
('EVE_S_6', 'Dry Eye Surgery', 'Dry_Eye_Surgery.jpg', '                                    Dry eye surgery is a medical procedure designed to treat chronic dry eye syndrome, a condition caused by insufficient tear production or poor tear quality. The surgery aims to alleviate symptoms such as irritation, burning, and vision problems. Techniques may include punctal plugs, thermal pulsation, or intense pulsed light therapy to improve tear retention and reduce inflammation, enhancing eye comfort.', '$1000'),
('EVE_S_1', 'Laser Surgery', 'laser_repaire.jpg', 'Laser eye surgery is a breakthrough solution to correct vision problems and reduce or eliminate the need for glasses or contact lenses. Our highly skilled ophthalmologists use cutting-edge laser technology to reshape the cornea, the eye\'s front surface, with remarkable precision.', '$500');

-- --------------------------------------------------------

--
-- Table structure for table `staff_details`
--

CREATE TABLE `staff_details` (
  `Staff_id` varchar(20) NOT NULL,
  `Fisrt_name` varchar(50) NOT NULL,
  `Last_name` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Age` int(20) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `Phone_Number` varchar(100) NOT NULL,
  `Street_Number` varchar(20) NOT NULL,
  `Street_Name` varchar(100) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Password` varchar(70) NOT NULL,
  `Profile_photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_details`
--

INSERT INTO `staff_details` (`Staff_id`, `Fisrt_name`, `Last_name`, `Email`, `Age`, `Role`, `Gender`, `Phone_Number`, `Street_Number`, `Street_Name`, `City`, `Password`, `Profile_photo`) VALUES
('S_EV1', 'gavin', 'hemsada', 'ghemsada@gmail.com', 22, 'Staff2', 'Male', '0718721716', '142/C', ' duwawatta road', 'piliyandala', '$2y$10$xs6sGnR2.ztffEWpapgE4e6OZIcP80E1Th2coxQGZ8h8C2rnq2RiW', 'Staff-S_EV1.png'),
('S_EV2', 'ggga', 'hemsada', 'gavinhemsada@gmail.com', 28, 'Staff', 'Male', '0718721716', '142/C', 'river road', 'piliyandala', '$2y$10$E/Z7BbnkYIy48HXLNOTASe1/cTEZdBPoYTzdN3OWfIMrWPCJA.BqK', 'Staff-S_EV2.png');

-- --------------------------------------------------------

--
-- Table structure for table `staff_login`
--

CREATE TABLE `staff_login` (
  `Staff_login_id` varchar(50) NOT NULL,
  `Staff_id` varchar(50) NOT NULL,
  `Date_and_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `Sub_ID` varchar(50) NOT NULL,
  `Type` varchar(100) NOT NULL,
  `Price` varchar(100) NOT NULL,
  `Usage` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`Sub_ID`, `Type`, `Price`, `Usage`) VALUES
('EV_S1', 'basic_mon', '$100', 'Comprehensive Eye Exam, General Checkup, Vision Checks'),
('EV_S2', 'standed_mon', '$500', 'Comprehensive Dry Eye Assessment ,Patient Consultation, Personalized Treatment Plan'),
('EV_S3', 'primium_mon', '$2000', 'Preoperative Consultation, Surgical Procedure, Postoperative Care'),
('EV_S4', 'basic_year', '$800', 'Comprehensive Eye Exam, General Checkup, Vision Checks'),
('EV_S5', 'standed_year', '$3000', 'Comprehensive Dry Eye Assessment ,Patient Consultation, Personalized Treatment Plan'),
('EV_S6', 'primium_year', '$8000', 'Preoperative Consultation, Surgical Procedure, Postoperative Care');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`Appointment_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
