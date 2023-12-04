-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2023 at 02:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone_rchive`
--

-- --------------------------------------------------------

--
-- Table structure for table `adviser`
--

CREATE TABLE `adviser` (
  `adviserId` bigint(20) NOT NULL,
  `adviser_name` varchar(255) DEFAULT NULL,
  `adviser_college` bigint(20) UNSIGNED NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adviser`
--

INSERT INTO `adviser` (`adviserId`, `adviser_name`, `adviser_college`, `profile_picture`, `created_at`, `updated_at`) VALUES
(1133, 'Rizza Armildez', 131, '1700448153.png', '2023-10-05 13:30:13', '2023-11-20 02:42:33'),
(1134, 'Ivan Castillo', 131, '1700448132.png', '2023-10-05 13:30:13', '2023-11-20 02:42:12'),
(1139, 'Regina Bravo', 131, NULL, '2023-10-05 13:33:53', '2023-10-05 13:33:53'),
(1140, 'Larry Caduada', 131, NULL, '2023-10-05 13:35:21', '2023-10-05 13:35:21'),
(1141, 'Menchie Lopez', 131, NULL, '2023-10-05 17:56:37', '2023-10-05 17:56:37'),
(1142, 'Jent Carlos Gardose', 131, NULL, '2023-10-05 18:08:13', '2023-10-07 04:36:25'),
(1147, 'Florideth Jeanne Gatan', 130, NULL, '2023-10-07 04:12:18', '2023-10-09 06:58:18'),
(1150, 'Bemsor Caabay', 131, '1700448109.png', '2023-10-09 12:10:10', '2023-11-20 02:41:49'),
(1159, 'Demy Dizon', 131, NULL, '2023-11-29 14:50:28', '2023-11-29 14:50:28');

-- --------------------------------------------------------

--
-- Table structure for table `auditlog`
--

CREATE TABLE `auditlog` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `adminId` bigint(20) UNSIGNED NOT NULL,
  `admin_action` enum('Upload','Edit','Delete') NOT NULL,
  `research` varchar(255) NOT NULL,
  `action_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auditlog`
--

INSERT INTO `auditlog` (`id`, `adminId`, `admin_action`, `research`, `action_date`, `created_at`, `updated_at`) VALUES
(16, 99, 'Upload', 'District bar.pdf', '2023-11-27 23:25:54', '2023-11-27 23:25:54', '2023-11-27 23:25:54'),
(17, 99, 'Delete', 'District bar.pdf', '2023-11-27 23:27:22', '2023-11-27 23:27:22', '2023-11-27 23:27:22'),
(18, 99, 'Upload', 'District bar.pdf', '2023-11-27 23:28:14', '2023-11-27 23:28:14', '2023-11-27 23:28:14'),
(19, 99, 'Delete', 'District bar.pdf', '2023-11-27 23:29:05', '2023-11-27 23:29:05', '2023-11-27 23:29:05'),
(20, 99, 'Upload', 'District bar.pdf', '2023-11-27 23:29:55', '2023-11-27 23:29:55', '2023-11-27 23:29:55'),
(21, 99, 'Delete', 'District bar.pdf', '2023-11-27 23:30:57', '2023-11-27 23:30:57', '2023-11-27 23:30:57'),
(22, 99, 'Edit', '1-Deploying Web Application in Heroku.pdf', '2023-11-27 23:32:00', '2023-11-27 23:32:00', '2023-11-27 23:32:00'),
(23, 99, 'Upload', 'District bar.pdf', '2023-11-27 23:46:46', '2023-11-27 23:46:46', '2023-11-27 23:46:46'),
(24, 3, 'Edit', '1-Deploying Web Application in Heroku.pdf', '2023-11-27 23:47:25', '2023-11-27 23:47:25', '2023-11-27 23:47:25'),
(25, 99, 'Edit', 'HAHAHAH HAHAHH -2019 6AFCSYEYE HUUWSUUQUIW- SHYEYEGW.pdf', '2023-11-28 09:22:19', '2023-11-28 09:22:19', '2023-11-28 09:22:19'),
(26, 3, 'Upload', 'OmpadMarkJustine-Exer4.pdf', '2023-11-29 22:53:38', '2023-11-29 22:53:38', '2023-11-29 22:53:38'),
(27, 3, 'Delete', '1-Deploying Web Application in Heroku.pdf', '2023-11-30 02:40:25', '2023-11-30 02:40:25', '2023-11-30 02:40:25'),
(28, 3, 'Upload', 'Baute-Norkizah-M.-Exer3.pdf', '2023-11-30 02:43:51', '2023-11-30 02:43:51', '2023-11-30 02:43:51'),
(29, 3, 'Upload', '1-Deploying Web Application in Heroku (4).pdf', '2023-11-30 02:47:56', '2023-11-30 02:47:56', '2023-11-30 02:47:56'),
(30, 3, 'Delete', '8-SCHEDULE-OF-PROPOSAL-DEFENSE-2ND-SEM-2022-2023.pdf', '2023-11-30 02:49:53', '2023-11-30 02:49:53', '2023-11-30 02:49:53'),
(31, 3, 'Upload', '8-SCHEDULE-OF-PROPOSAL-DEFENSE-2ND-SEM-2022-2023.pdf', '2023-11-30 02:54:47', '2023-11-30 02:54:47', '2023-11-30 02:54:47');

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `changes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`id`, `user_id`, `action`, `changes`, `created_at`, `updated_at`) VALUES
(1, 3, 'update', 'hahahaha', '2023-09-22 13:29:06', '2023-09-22 13:52:31'),
(2, 3, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"}}', '2023-09-22 05:52:37', '2023-09-22 05:52:37'),
(3, 3, 'Profile Updated', '{\"name\":{\"old\":\"Jesuron Caleb Cayao\",\"new\":\"Jesuron Caleb Cayao J.\"},\"college_id\":{\"old\":131,\"new\":\"131\"}}', '2023-09-22 05:53:47', '2023-09-22 05:53:47'),
(4, 3, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"},\"profile_picture\":{\"old\":\"1695387961.png\",\"new\":\"1695392848.png\"}}', '2023-09-22 06:27:29', '2023-09-22 06:27:29'),
(8, 4, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"},\"profile_picture\":{\"old\":\"\",\"new\":\"1695483409.png\"}}', '2023-09-23 07:36:51', '2023-09-23 07:36:51'),
(21, 3, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"},\"profile_picture\":{\"old\":\"1695392848.png\",\"new\":\"1696078796.png\"}}', '2023-09-30 04:59:56', '2023-09-30 04:59:56'),
(62, 3, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"},\"interest\":{\"old\":\"Technology\",\"new\":null},\"profile_picture\":{\"old\":\"1696078796.png\",\"new\":\"1696834767.jpg\"}}', '2023-10-09 06:59:28', '2023-10-09 06:59:28'),
(63, 3, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"},\"interest\":{\"old\":null,\"new\":\"Technology\"}}', '2023-10-09 11:52:21', '2023-10-09 11:52:21'),
(70, 3, 'Profile Updated', '{\"name\":{\"old\":\"Jesuron Caleb Cayao Jarilla\",\"new\":\"ThesesVault\"},\"college_id\":{\"old\":131,\"new\":\"131\"}}', '2023-10-10 15:32:35', '2023-10-10 15:32:35'),
(85, 62, 'Profile Updated', '{\"program\":{\"old\":null,\"new\":\"BS Environmental Science\"},\"college_id\":{\"old\":null,\"new\":\"131\"},\"interest\":{\"old\":null,\"new\":\"Technology\"}}', '2023-10-18 11:49:10', '2023-10-18 11:49:10'),
(86, 62, 'Profile Updated', '{\"program\":{\"old\":\"BS Environmental Science\",\"new\":\"BS Information Technology\"},\"college_id\":{\"old\":131,\"new\":\"131\"},\"profile_picture\":{\"old\":null,\"new\":\"1697879742.jpg\"}}', '2023-10-21 09:15:42', '2023-10-21 09:15:42'),
(88, 62, 'Profile Updated', '{\"name\":{\"old\":\"Maurene Llado\",\"new\":\"Poging Maurene\"},\"college_id\":{\"old\":131,\"new\":\"131\"}}', '2023-10-24 05:26:48', '2023-10-24 05:26:48'),
(89, 3, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"},\"profile_picture\":{\"old\":\"1696834767.jpg\",\"new\":\"1698588373.jpeg\"}}', '2023-10-29 14:06:14', '2023-10-29 14:06:14'),
(90, 3, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"},\"profile_picture\":{\"old\":\"1698588373.jpeg\",\"new\":\"1698588654.jpg\"}}', '2023-10-29 14:10:54', '2023-10-29 14:10:54'),
(95, 3, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"}}', '2023-11-20 14:19:54', '2023-11-20 14:19:54'),
(96, 3, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"130\"}}', '2023-11-20 14:20:14', '2023-11-20 14:20:14'),
(97, 3, 'Profile Updated', '{\"college_id\":{\"old\":130,\"new\":\"131\"}}', '2023-11-20 14:20:56', '2023-11-20 14:20:56'),
(98, 3, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"130\"}}', '2023-11-20 14:22:03', '2023-11-20 14:22:03'),
(99, 3, 'Profile Updated', '{\"program\":{\"old\":\"BS Information Technology\",\"new\":\"BS Electrical Engineering\"},\"college_id\":{\"old\":130,\"new\":\"130\"}}', '2023-11-20 14:22:09', '2023-11-20 14:22:09'),
(100, 62, 'Profile Updated', '{\"name\":{\"old\":\"Poging Maurene\",\"new\":\"Maurene Llado\"},\"college_id\":{\"old\":131,\"new\":\"131\"},\"profile_picture\":{\"old\":\"1697879742.jpg\",\"new\":\"1700491646.jpg\"}}', '2023-11-20 14:47:26', '2023-11-20 14:47:26'),
(103, 62, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"130\"}}', '2023-11-23 10:28:18', '2023-11-23 10:28:18'),
(104, 62, 'Profile Updated', '{\"college_id\":{\"old\":130,\"new\":\"131\"}}', '2023-11-23 10:32:03', '2023-11-23 10:32:03'),
(105, 3, 'Profile Updated', '{\"program\":{\"old\":\"BS Electrical Engineering\",\"new\":\"BS Information Technology\"},\"college_id\":{\"old\":130,\"new\":\"131\"}}', '2023-11-23 13:52:03', '2023-11-23 13:52:03'),
(106, 62, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"130\"}}', '2023-11-23 14:18:02', '2023-11-23 14:18:02'),
(107, 62, 'Profile Updated', '{\"college_id\":{\"old\":130,\"new\":\"131\"}}', '2023-11-23 14:21:12', '2023-11-23 14:21:12'),
(108, 62, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"130\"}}', '2023-11-23 14:31:15', '2023-11-23 14:31:15'),
(109, 62, 'Profile Updated', '{\"college_id\":{\"old\":130,\"new\":\"130\"}}', '2023-11-23 14:52:21', '2023-11-23 14:52:21'),
(110, 3, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"130\"}}', '2023-11-23 14:52:42', '2023-11-23 14:52:42'),
(111, 3, 'Profile Updated', '{\"college_id\":{\"old\":130,\"new\":\"131\"}}', '2023-11-23 14:52:53', '2023-11-23 14:52:53'),
(112, 62, 'Profile Updated', '{\"college_id\":{\"old\":130,\"new\":\"131\"}}', '2023-11-23 14:53:26', '2023-11-23 14:53:26'),
(128, 95, 'Profile Updated', '{\"name\":{\"old\":\"JONARD LAURENCE GANESO\",\"new\":\"glu\"},\"program\":{\"old\":null,\"new\":\"BS Medical Biology\"},\"interest\":{\"old\":null,\"new\":\"Business\"}}', '2023-11-24 05:59:04', '2023-11-24 05:59:04'),
(129, 96, 'Profile Updated', '{\"program\":{\"old\":null,\"new\":\"BS Information Technology\"},\"college_id\":{\"old\":null,\"new\":\"131\"}}', '2023-11-24 06:11:21', '2023-11-24 06:11:21'),
(130, 96, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"},\"profile_picture\":{\"old\":null,\"new\":\"1700807294.jpg\"}}', '2023-11-24 06:28:15', '2023-11-24 06:28:15'),
(131, 62, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"},\"interest\":{\"old\":\"Technology\",\"new\":\"Business\"}}', '2023-11-26 04:29:55', '2023-11-26 04:29:55'),
(132, 62, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"},\"interest\":{\"old\":\"Business\",\"new\":\"Technology\"}}', '2023-11-26 04:30:13', '2023-11-26 04:30:13'),
(133, 62, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"},\"interest\":{\"old\":\"Technology\",\"new\":\"Education\"}}', '2023-11-26 04:30:31', '2023-11-26 04:30:31'),
(134, 3, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"}}', '2023-11-26 04:31:24', '2023-11-26 04:31:24'),
(135, 3, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"},\"interest\":{\"old\":\"Technology\",\"new\":\"Education\"}}', '2023-11-26 04:32:43', '2023-11-26 04:32:43'),
(138, 3, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"},\"interest\":{\"old\":\"Education\",\"new\":\"Business\"}}', '2023-11-26 04:35:52', '2023-11-26 04:35:52'),
(140, 3, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"130\"}}', '2023-11-26 06:09:02', '2023-11-26 06:09:02'),
(141, 3, 'Profile Updated', '{\"college_id\":{\"old\":130,\"new\":\"131\"}}', '2023-11-26 06:09:08', '2023-11-26 06:09:08'),
(142, 3, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"}}', '2023-11-26 06:09:21', '2023-11-26 06:09:21'),
(146, 99, 'Profile Updated', '{\"program\":{\"old\":null,\"new\":\"BS Information Technology\"},\"college_id\":{\"old\":null,\"new\":\"131\"}}', '2023-11-27 01:29:59', '2023-11-27 01:29:59'),
(147, 99, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"},\"interest\":{\"old\":null,\"new\":\"Education\"}}', '2023-11-27 01:30:12', '2023-11-27 01:30:12'),
(150, 3, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"},\"interest\":{\"old\":\"Business\",\"new\":\"Education\"}}', '2023-11-29 11:40:46', '2023-11-29 11:40:46'),
(151, 3, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"},\"interest\":{\"old\":\"Education\",\"new\":\"Technology\"}}', '2023-11-29 11:40:59', '2023-11-29 11:40:59'),
(154, 62, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"}}', '2023-11-29 20:26:48', '2023-11-29 20:26:48'),
(155, 62, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"130\"},\"interest\":{\"old\":\"Education\",\"new\":\"Technology\"}}', '2023-11-30 14:11:12', '2023-11-30 14:11:12'),
(156, 62, 'Profile Updated', '{\"college_id\":{\"old\":130,\"new\":\"130\"}}', '2023-11-30 14:11:31', '2023-11-30 14:11:31'),
(157, 62, 'Profile Updated', '{\"program\":{\"old\":\"BS Information Technology\",\"new\":\"BS Medical Biology\"},\"college_id\":{\"old\":130,\"new\":\"131\"}}', '2023-11-30 14:12:38', '2023-11-30 14:12:38'),
(158, 62, 'Profile Updated', '{\"program\":{\"old\":\"BS Medical Biology\",\"new\":\"BS Information Technology\"},\"college_id\":{\"old\":131,\"new\":\"130\"}}', '2023-11-30 14:12:49', '2023-11-30 14:12:49'),
(159, 62, 'Profile Updated', '{\"college_id\":{\"old\":130,\"new\":\"130\"}}', '2023-11-30 14:13:08', '2023-11-30 14:13:08'),
(160, 62, 'Profile Updated', '{\"program\":{\"old\":\"BS Information Technology\",\"new\":\"BS Marine Biology\"},\"college_id\":{\"old\":130,\"new\":\"131\"}}', '2023-11-30 14:14:47', '2023-11-30 14:14:47'),
(161, 62, 'Profile Updated', '{\"program\":{\"old\":\"BS Marine Biology\",\"new\":\"BS Information Technology\"},\"college_id\":{\"old\":131,\"new\":\"130\"}}', '2023-11-30 14:14:55', '2023-11-30 14:14:55'),
(162, 62, 'Profile Updated', '{\"program\":{\"old\":\"BS Information Technology\",\"new\":\"BS Computer Science\"},\"college_id\":{\"old\":130,\"new\":\"131\"}}', '2023-11-30 14:16:47', '2023-11-30 14:16:47'),
(163, 62, 'Profile Updated', '{\"program\":{\"old\":\"BS Computer Science\",\"new\":\"BS Information Technology\"},\"college_id\":{\"old\":131,\"new\":\"130\"}}', '2023-11-30 14:16:54', '2023-11-30 14:16:54'),
(164, 62, 'Profile Updated', '{\"program\":{\"old\":\"BS Information Technology\",\"new\":\"BS Marine Biology\"},\"college_id\":{\"old\":130,\"new\":\"131\"}}', '2023-11-30 14:18:54', '2023-11-30 14:18:54'),
(165, 62, 'Profile Updated', '{\"program\":{\"old\":\"BS Marine Biology\",\"new\":\"BS Information Technology\"},\"college_id\":{\"old\":131,\"new\":\"130\"}}', '2023-11-30 14:21:09', '2023-11-30 14:21:09'),
(166, 62, 'Profile Updated', '{\"college_id\":{\"old\":130,\"new\":\"130\"}}', '2023-11-30 14:22:04', '2023-11-30 14:22:04'),
(167, 62, 'Profile Updated', '{\"program\":{\"old\":\"BS Information Technology\",\"new\":\"BS Medical Biology\"},\"college_id\":{\"old\":130,\"new\":\"131\"}}', '2023-11-30 14:28:40', '2023-11-30 14:28:40'),
(168, 62, 'Profile Updated', '{\"program\":{\"old\":\"BS Medical Biology\",\"new\":\"BS Architecture\"},\"college_id\":{\"old\":131,\"new\":\"130\"}}', '2023-11-30 14:28:47', '2023-11-30 14:28:47'),
(169, 62, 'Profile Updated', '{\"program\":{\"old\":\"BS Architecture\",\"new\":null},\"college_id\":{\"old\":130,\"new\":\"131\"}}', '2023-11-30 14:33:13', '2023-11-30 14:33:13'),
(170, 62, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"131\"}}', '2023-11-30 14:33:22', '2023-11-30 14:33:22'),
(171, 62, 'Profile Updated', '{\"program\":{\"old\":null,\"new\":\"BS Information Technology\"},\"college_id\":{\"old\":131,\"new\":\"130\"}}', '2023-11-30 14:33:49', '2023-11-30 14:33:49'),
(172, 62, 'Profile Updated', '{\"program\":{\"old\":\"BS Information Technology\",\"new\":\"BS Petroleum Engineering\"},\"college_id\":{\"old\":130,\"new\":\"131\"}}', '2023-11-30 14:37:58', '2023-11-30 14:37:58'),
(173, 62, 'Profile Updated', '{\"college_id\":{\"old\":131,\"new\":\"130\"}}', '2023-11-30 14:38:05', '2023-11-30 14:38:05'),
(174, 62, 'Profile Updated', '{\"program\":{\"old\":\"BS Petroleum Engineering\",\"new\":\"BS Medical Biology\"},\"college_id\":{\"old\":130,\"new\":\"131\"}}', '2023-11-30 14:38:17', '2023-11-30 14:38:17'),
(175, 62, 'Profile Updated', '{\"program\":{\"old\":\"BS Medical Biology\",\"new\":\"BS Computer Science\"},\"college_id\":{\"old\":131,\"new\":\"131\"}}', '2023-11-30 14:45:19', '2023-11-30 14:45:19'),
(176, 62, 'Profile Updated', '{\"program\":{\"old\":\"BS Computer Science\",\"new\":\"BS Architecture\"},\"college_id\":{\"old\":131,\"new\":\"130\"}}', '2023-11-30 14:45:25', '2023-11-30 14:45:25'),
(177, 104, 'Profile Updated', '{\"program\":{\"old\":\"BS Information Technology\",\"new\":\"BS Civil Engineering\"},\"college_id\":{\"old\":131,\"new\":\"130\"},\"interest\":{\"old\":null,\"new\":\"Business\"}}', '2023-11-30 14:55:53', '2023-11-30 14:55:53');

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `college_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`id`, `college_name`, `created_at`, `updated_at`) VALUES
(130, 'CEAT', '2023-08-31 12:52:56', '2023-09-01 05:58:57'),
(131, 'CS', '2023-08-31 12:52:56', '2023-09-01 05:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `fid` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`fid`, `user_id`, `filename`, `created_at`, `updated_at`) VALUES
(148, 62, '8-SCHEDULE-OF-PROPOSAL-DEFENSE-2ND-SEM-2022-2023.pdf', '2023-12-01 03:55:32', '2023-12-01 03:55:32'),
(157, 104, 'CaseStudy-Llado Maurene C..pdf', '2023-12-04 13:15:30', '2023-12-04 13:15:30');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `hid` bigint(20) NOT NULL,
  `search_name` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`hid`, `search_name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'maurene', 3, '2023-09-13 16:47:38', '2023-09-13 16:47:38'),
(2, 'maurene', 3, '2023-09-13 16:47:43', '2023-09-13 16:47:43'),
(3, 'bemsor', 3, '2023-09-13 16:47:49', '2023-09-13 16:47:49'),
(4, '8-SCHEDULE-OF-PROPOSAL-DEFENSE-2ND-SEM-2022-2023', 3, '2023-09-13 18:04:10', '2023-09-13 18:04:10'),
(11, '1-Deploying Web Application in Heroku', 3, '2023-09-18 06:46:05', '2023-09-18 06:46:05'),
(12, '1-Deploying Web Application in Heroku', 3, '2023-09-18 06:46:38', '2023-09-18 06:46:38'),
(13, '2019-Curriculum-BSIT-for-Students (1)', 3, '2023-09-18 22:17:47', '2023-09-18 22:17:47'),
(14, '2019-Curriculum-BSIT-for-Students (1)', 3, '2023-09-18 22:18:01', '2023-09-18 22:18:01'),
(15, '2019-Curriculum-BSIT-for-Students (1)', 3, '2023-09-18 22:18:07', '2023-09-18 22:18:07'),
(16, '2019-Curriculum-BSIT-for-Students (1)', 3, '2023-09-18 23:59:53', '2023-09-18 23:59:53'),
(26, 'cute', 3, '2023-09-22 04:18:16', '2023-09-22 04:18:16'),
(27, 'cute', 3, '2023-09-22 04:18:23', '2023-09-22 04:18:23'),
(28, 'Mally', 3, '2023-09-22 04:19:45', '2023-09-22 04:19:45'),
(29, 'Mally', 3, '2023-09-22 04:22:24', '2023-09-22 04:22:24'),
(30, 'Mally', 3, '2023-09-22 04:23:12', '2023-09-22 04:23:12'),
(31, 'Mally', 3, '2023-09-22 04:24:17', '2023-09-22 04:24:17'),
(32, 'Mally', 3, '2023-09-22 04:24:25', '2023-09-22 04:24:25'),
(33, 'hhhh', 3, '2023-09-22 04:26:01', '2023-09-22 04:26:01'),
(34, 'Mally', 3, '2023-09-22 05:03:47', '2023-09-22 05:03:47'),
(35, '2GO Travel - Itinerary Receipt', 3, '2023-09-22 06:35:57', '2023-09-22 06:35:57'),
(36, 'Duplichecker-Plagiarism-Report', 3, '2023-09-22 06:36:25', '2023-09-22 06:36:25'),
(37, 'rec', 3, '2023-09-22 06:36:33', '2023-09-22 06:36:33'),
(38, '2GO Travel - Itinerary Receipt', 3, '2023-09-22 06:36:45', '2023-09-22 06:36:45'),
(39, 'CaseStudy-Llado Maurene C.', 3, '2023-09-22 06:37:06', '2023-09-22 06:37:06'),
(49, 'Duplichecker-Plagiarism-Report', 3, '2023-09-29 07:46:18', '2023-09-29 07:46:18'),
(50, 'Duplichecker-Plagiarism-Report', 3, '2023-09-29 07:47:05', '2023-09-29 07:47:05'),
(51, 'Duplichecker-Plagiarism-Report', 3, '2023-09-29 07:47:59', '2023-09-29 07:47:59'),
(52, 'Duplichecker-Plagiarism-Report', 3, '2023-09-29 07:47:59', '2023-09-29 07:47:59'),
(53, 'Duplichecker-Plagiarism-Report', 3, '2023-09-29 07:48:15', '2023-09-29 07:48:15'),
(54, 'Duplichecker-Plagiarism-Report', 3, '2023-09-29 07:48:41', '2023-09-29 07:48:41'),
(55, 'Duplichecker-Plagiarism-Report', 3, '2023-09-29 07:52:22', '2023-09-29 07:52:22'),
(56, 'Duplichecker-Plagiarism-Report', 3, '2023-09-29 07:52:38', '2023-09-29 07:52:38'),
(57, 'Duplichecker-Plagiarism-Report', 3, '2023-09-29 07:55:23', '2023-09-29 07:55:23'),
(58, '1-Deploying Web Application in Heroku', 3, '2023-09-29 21:11:56', '2023-09-29 21:11:56'),
(59, '1-Deploying Web Application in Heroku', 3, '2023-09-29 21:12:06', '2023-09-29 21:12:06'),
(60, '1-Deploying Web Application in Heroku', 3, '2023-09-29 21:12:10', '2023-09-29 21:12:10'),
(61, '1-Deploying Web Application in Heroku', 3, '2023-09-29 21:12:13', '2023-09-29 21:12:13'),
(62, '1-Deploying Web Application in Heroku', 3, '2023-09-30 03:48:48', '2023-09-30 03:48:48'),
(88, '1-Deploying Web Application in Heroku', 3, '2023-09-30 04:59:43', '2023-09-30 04:59:43'),
(93, '2019-Curriculum-BSIT-for-Students (1)', 3, '2023-10-01 03:47:56', '2023-10-01 03:47:56'),
(96, '1-Deploying Web Application in Heroku', 3, '2023-10-01 04:16:06', '2023-10-01 04:16:06'),
(97, '1-Deploying Web Application in Heroku', 3, '2023-10-01 09:49:34', '2023-10-01 09:49:34'),
(98, '1-Deploying Web Application in Heroku', 3, '2023-10-01 09:49:36', '2023-10-01 09:49:36'),
(99, '1-Deploying Web Application in Heroku', 3, '2023-10-01 09:49:53', '2023-10-01 09:49:53'),
(100, '1-Deploying Web Application in Heroku', 3, '2023-10-01 09:50:05', '2023-10-01 09:50:05'),
(112, 'Module-1-Lesson-5-IER', 3, '2023-10-04 16:09:19', '2023-10-04 16:09:19'),
(113, 'Quote29', 3, '2023-10-04 16:12:08', '2023-10-04 16:12:08'),
(114, 'Updatedtemplate (3)', 3, '2023-10-05 03:20:00', '2023-10-05 03:20:00'),
(115, 'Updatedtemplate (3)', 3, '2023-10-05 03:20:11', '2023-10-05 03:20:11'),
(116, 'Updatedtemplate (3)', 3, '2023-10-05 03:20:15', '2023-10-05 03:20:15'),
(140, 'mau', 3, '2023-10-06 05:10:11', '2023-10-06 05:10:11'),
(141, 'mau', 3, '2023-10-06 05:12:45', '2023-10-06 05:12:45'),
(142, 'mau', 3, '2023-10-06 05:12:52', '2023-10-06 05:12:52'),
(143, '1-Deploying Web Application in Heroku', 3, '2023-10-06 05:13:29', '2023-10-06 05:13:29'),
(147, '1-Deploying Web Application in Heroku', 3, '2023-10-06 14:39:19', '2023-10-06 14:39:19'),
(154, 'Updatedtemplate (3)', 3, '2023-10-06 14:53:18', '2023-10-06 14:53:18'),
(156, 'LLADO-ORGA', 3, '2023-10-07 04:51:11', '2023-10-07 04:51:11'),
(157, 'LLADO-ORGA', 3, '2023-10-07 04:51:26', '2023-10-07 04:51:26'),
(172, 'LLADO-ORGA', 3, '2023-10-08 05:36:20', '2023-10-08 05:36:20'),
(178, 'mau', 3, '2023-10-09 06:49:37', '2023-10-09 06:49:37'),
(179, '162', 3, '2023-10-09 06:49:57', '2023-10-09 06:49:57'),
(180, 'mau', 3, '2023-10-09 06:49:57', '2023-10-09 06:49:57'),
(181, '1232', 3, '2023-10-09 06:50:28', '2023-10-09 06:50:28'),
(182, 'mau', 3, '2023-10-09 06:50:29', '2023-10-09 06:50:29'),
(193, '1-Deploying Web Application in Heroku', 62, '2023-10-18 11:52:04', '2023-10-18 11:52:04'),
(194, 'mau', 3, '2023-10-23 15:49:49', '2023-10-23 15:49:49'),
(195, 'mau', 3, '2023-10-23 16:52:00', '2023-10-23 16:52:00'),
(199, 'ir04', 3, '2023-10-24 03:46:00', '2023-10-24 03:46:00'),
(200, 'wetw', 3, '2023-10-24 03:46:11', '2023-10-24 03:46:11'),
(201, '1-Deploying Web Application in Heroku', 3, '2023-10-25 01:43:03', '2023-10-25 01:43:03'),
(202, 'maurene', 3, '2023-10-25 01:43:17', '2023-10-25 01:43:17'),
(203, 'Duplichecker-Plagiarism-Report', 3, '2023-10-25 05:23:07', '2023-10-25 05:23:07'),
(205, '1-Deploying Web Application in Heroku', 3, '2023-10-29 14:05:35', '2023-10-29 14:05:35'),
(209, 'Llado, Maurene C. - Exer4', 3, '2023-11-07 05:44:07', '2023-11-07 05:44:07'),
(210, 'Llado, Maurene C. - Exer4', 62, '2023-11-07 07:15:37', '2023-11-07 07:15:37'),
(211, 'CaseStudy-Llado Maurene C.', 3, '2023-11-17 02:53:10', '2023-11-17 02:53:10'),
(212, 'bemsor', 3, '2023-11-17 02:53:34', '2023-11-17 02:53:34'),
(213, 'information technology', 3, '2023-11-17 02:54:07', '2023-11-17 02:54:07'),
(214, '1-Deploying Web Application in Heroku', 3, '2023-11-18 18:59:55', '2023-11-18 18:59:55'),
(217, 'Author Search', 3, '2023-11-20 11:00:23', '2023-11-20 11:00:23'),
(218, '1-Deploying Web Application in Heroku', 3, '2023-11-20 11:08:06', '2023-11-20 11:08:06'),
(219, '1-Deploying Web Application in Heroku', 3, '2023-11-20 11:18:55', '2023-11-20 11:18:55'),
(220, 'honeylyn Vigo', 3, '2023-11-20 11:35:28', '2023-11-20 11:35:28'),
(221, 'Maurene LLado', 3, '2023-11-20 11:35:43', '2023-11-20 11:35:43'),
(222, 'calma', 3, '2023-11-20 11:36:00', '2023-11-20 11:36:00'),
(223, 'Bemsor caabay', 3, '2023-11-20 11:37:01', '2023-11-20 11:37:01'),
(224, 'calma', 3, '2023-11-20 11:37:01', '2023-11-20 11:37:01'),
(225, 'calma', 3, '2023-11-20 11:40:09', '2023-11-20 11:40:09'),
(226, 'honeylyn', 3, '2023-11-20 11:40:20', '2023-11-20 11:40:20'),
(227, 'calma', 3, '2023-11-20 11:40:20', '2023-11-20 11:40:20'),
(228, 'bemsor', 3, '2023-11-20 11:40:30', '2023-11-20 11:40:30'),
(229, 'JD-Quotation', 3, '2023-11-20 11:40:42', '2023-11-20 11:40:42'),
(230, 'jent', 3, '2023-11-20 11:40:52', '2023-11-20 11:40:52'),
(231, 'jent', 3, '2023-11-20 11:48:19', '2023-11-20 11:48:19'),
(232, 'jent', 3, '2023-11-20 11:49:05', '2023-11-20 11:49:05'),
(233, 'jent', 3, '2023-11-20 11:50:47', '2023-11-20 11:50:47'),
(234, 'Honey', 3, '2023-11-20 11:50:51', '2023-11-20 11:50:51'),
(235, 'jent', 3, '2023-11-20 11:50:51', '2023-11-20 11:50:51'),
(236, 'CS', 3, '2023-11-20 11:51:01', '2023-11-20 11:51:01'),
(237, 'CS', 3, '2023-11-20 11:52:46', '2023-11-20 11:52:46'),
(238, '130', 3, '2023-11-20 11:52:52', '2023-11-20 11:52:52'),
(239, 'CS', 3, '2023-11-20 11:52:52', '2023-11-20 11:52:52'),
(240, '131', 3, '2023-11-20 11:53:24', '2023-11-20 11:53:24'),
(241, 'CS', 3, '2023-11-20 11:53:24', '2023-11-20 11:53:24'),
(242, 'CS', 3, '2023-11-20 11:55:46', '2023-11-20 11:55:46'),
(243, '130', 3, '2023-11-20 11:55:51', '2023-11-20 11:55:51'),
(244, '131', 3, '2023-11-20 11:56:03', '2023-11-20 11:56:03'),
(245, 'CaseStudy-Llado Maurene C.', 3, '2023-11-20 11:56:19', '2023-11-20 11:56:19'),
(246, 'honeylyn Vigo', 3, '2023-11-20 12:02:14', '2023-11-20 12:02:14'),
(247, 'honeylyn Vigo', 3, '2023-11-20 12:09:29', '2023-11-20 12:09:29'),
(248, 'honeylyn Vigo', 3, '2023-11-20 12:09:48', '2023-11-20 12:09:48'),
(249, 'honeylyn Vigo', 3, '2023-11-20 12:09:54', '2023-11-20 12:09:54'),
(250, 'honeylyn Vigo', 3, '2023-11-20 12:10:00', '2023-11-20 12:10:00'),
(251, 'honeylyn Vigo', 3, '2023-11-20 12:10:06', '2023-11-20 12:10:06'),
(252, 'honeylyn Vigo', 3, '2023-11-20 12:10:30', '2023-11-20 12:10:30'),
(253, 'honeylyn Vigo', 3, '2023-11-20 12:11:46', '2023-11-20 12:11:46'),
(254, 'BS Information Technology', 3, '2023-11-20 12:11:54', '2023-11-20 12:11:54'),
(255, 'BS Environmental Science', 3, '2023-11-20 12:12:00', '2023-11-20 12:12:00'),
(256, 'BS Environmental Science', 3, '2023-11-20 12:12:32', '2023-11-20 12:12:32'),
(257, 'BS Environmental Science', 3, '2023-11-20 12:16:43', '2023-11-20 12:16:43'),
(258, 'BS Information Technology', 3, '2023-11-20 12:16:48', '2023-11-20 12:16:48'),
(259, 'MAURENE', 62, '2023-11-20 12:43:28', '2023-11-20 12:43:28'),
(260, 'MAURENE', 62, '2023-11-20 12:45:26', '2023-11-20 12:45:26'),
(261, 'MAURENE', 62, '2023-11-20 12:45:51', '2023-11-20 12:45:51'),
(262, 'MAURENE', 62, '2023-11-20 12:47:12', '2023-11-20 12:47:12'),
(263, 'MAURENE', 62, '2023-11-20 12:47:19', '2023-11-20 12:47:19'),
(264, 'orga', 62, '2023-11-20 12:47:54', '2023-11-20 12:47:54'),
(265, 'BS Information Technology', 62, '2023-11-20 12:48:23', '2023-11-20 12:48:23'),
(266, 'CEAT', 62, '2023-11-20 12:48:33', '2023-11-20 12:48:33'),
(267, 'BS Mechanical Engineering', 62, '2023-11-20 12:49:12', '2023-11-20 12:49:12'),
(268, 'BS Mechanical Engineering', 3, '2023-11-20 12:49:54', '2023-11-20 12:49:54'),
(269, 'BS Information Technology', 3, '2023-11-20 12:49:54', '2023-11-20 12:49:54'),
(270, 'BS Architecture', 62, '2023-11-20 12:50:12', '2023-11-20 12:50:12'),
(271, 'BS Environmental Science', 62, '2023-11-20 12:50:30', '2023-11-20 12:50:30'),
(272, 'BS Environmental Science', 62, '2023-11-20 12:50:35', '2023-11-20 12:50:35'),
(273, 'CEAT', 3, '2023-11-20 12:52:17', '2023-11-20 12:52:17'),
(274, 'Module-1-Lesson-5-IER', 3, '2023-11-20 13:59:49', '2023-11-20 13:59:49'),
(275, 'OmpadMarkJustine-Exer4', 3, '2023-11-20 14:04:52', '2023-11-20 14:04:52'),
(276, 'pdfcoffee.com_1-8-15-pdf-free', 3, '2023-11-20 14:06:11', '2023-11-20 14:06:11'),
(277, '1-Deploying Web Application in Heroku', 3, '2023-11-20 14:08:14', '2023-11-20 14:08:14'),
(278, 'CaseStudy-Llado Maurene C.', 3, '2023-11-20 14:08:38', '2023-11-20 14:08:38'),
(279, 'UIUXB1-Maurene Llado-Excer1', 3, '2023-11-20 14:09:06', '2023-11-20 14:09:06'),
(291, 'llado', 3, '2023-11-21 06:17:33', '2023-11-21 06:17:33'),
(292, 'CaseStudy-Llado Maurene C.', 3, '2023-11-21 06:24:00', '2023-11-21 06:24:00'),
(293, 'CEAT', 3, '2023-11-21 07:11:33', '2023-11-21 07:11:33'),
(294, 'HCI-2-final-requirements (1)', 3, '2023-11-21 07:20:20', '2023-11-21 07:20:20'),
(295, '2023', 3, '2023-11-21 07:24:35', '2023-11-21 07:24:35'),
(299, 'Program Search', 3, '2023-11-21 08:42:00', '2023-11-21 08:42:00'),
(300, 'CEAT', 3, '2023-11-21 08:42:20', '2023-11-21 08:42:20'),
(307, 'hahaha', 3, '2023-11-23 02:55:41', '2023-11-23 02:55:41'),
(308, 'hahaha', 3, '2023-11-23 02:55:43', '2023-11-23 02:55:43'),
(309, 'hahaha', 3, '2023-11-23 02:55:43', '2023-11-23 02:55:43'),
(310, 'hahaha', 3, '2023-11-23 02:55:44', '2023-11-23 02:55:44'),
(311, 'hahaha', 3, '2023-11-23 02:55:45', '2023-11-23 02:55:45'),
(312, 'dfwregegrhyh', 3, '2023-11-23 02:55:54', '2023-11-23 02:55:54'),
(313, 'hahaha', 3, '2023-11-23 02:55:57', '2023-11-23 02:55:57'),
(314, 'orga', 3, '2023-11-23 02:56:13', '2023-11-23 02:56:13'),
(315, 'science', 62, '2023-11-23 03:02:32', '2023-11-23 03:02:32'),
(316, 'science', 62, '2023-11-23 03:02:36', '2023-11-23 03:02:36'),
(317, 'science', 62, '2023-11-23 03:02:37', '2023-11-23 03:02:37'),
(318, 'science', 62, '2023-11-23 03:02:39', '2023-11-23 03:02:39'),
(319, 'science', 62, '2023-11-23 03:02:41', '2023-11-23 03:02:41'),
(320, 'science', 62, '2023-11-23 03:02:41', '2023-11-23 03:02:41'),
(321, 'science', 62, '2023-11-23 03:02:43', '2023-11-23 03:02:43'),
(322, 'science', 62, '2023-11-23 03:02:44', '2023-11-23 03:02:44'),
(323, 'science', 62, '2023-11-23 03:02:44', '2023-11-23 03:02:44'),
(324, 'science', 62, '2023-11-23 09:36:46', '2023-11-23 09:36:46'),
(325, '1-Deploying Web Application in Heroku', 62, '2023-11-23 09:37:07', '2023-11-23 09:37:07'),
(326, 'IT-PLAYERS-2023', 62, '2023-11-23 09:37:16', '2023-11-23 09:37:16'),
(327, 'org', 62, '2023-11-23 09:37:31', '2023-11-23 09:37:31'),
(328, 'BS Information Technology', 62, '2023-11-23 09:38:22', '2023-11-23 09:38:22'),
(329, 'HACHERO-Anniza-A.-EXER-7', 62, '2023-11-23 09:42:10', '2023-11-23 09:42:10'),
(330, 'HACHERO-Anniza-A.-EXER-7', 62, '2023-11-23 09:42:22', '2023-11-23 09:42:22'),
(331, 'BS Environmental Science', 3, '2023-11-23 14:31:51', '2023-11-23 14:31:51'),
(332, 'BS Environmental Science', 3, '2023-11-23 14:32:20', '2023-11-23 14:32:20'),
(333, 'BS Environmental Science', 3, '2023-11-23 14:32:36', '2023-11-23 14:32:36'),
(334, 'BS Environmental Science', 3, '2023-11-23 14:35:43', '2023-11-23 14:35:43'),
(335, 'HACHERO-Anniza-A.-EXER-7', 3, '2023-11-23 14:35:53', '2023-11-23 14:35:53'),
(347, 'jent', 96, '2023-11-24 06:26:13', '2023-11-24 06:26:13'),
(348, 'jent', 96, '2023-11-24 06:26:13', '2023-11-24 06:26:13'),
(349, 'CEAT', 62, '2023-11-25 07:14:07', '2023-11-25 07:14:07'),
(351, 'HCI_POWERPOINT', 99, '2023-11-27 01:30:43', '2023-11-27 01:30:43'),
(353, '1-Deploying Web Application in Heroku', 3, '2023-11-29 18:45:18', '2023-11-29 18:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('202080054@psu.palawan.edu.ph', '$2y$10$xD4oaKTTMGJJHgsxZTlp2OLKZOR56OUdl0YU4eVyd10V2URLqFgC6', '2023-11-21 13:31:11'),
('fabrigasmeah66@gmail.com', '$2y$10$NQoOZ9ptn9vCJO5U5GRGsuoEw1YxsBsKOhR33vXhdX8eeVzKxQreW', '2023-10-17 02:16:12'),
('mau@gmail.com', '$2y$10$IsTv1oOXbiqc3cx.YhKbB.7DBFDIuzUY9IoUfRc8xeDzTI0VYebPy', '2023-11-18 19:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `research`
--

CREATE TABLE `research` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `callno` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `program` enum('BS Information Technology','BS Computer Science','BS Medical Biology','BS Environmental Science','BS Marine Biology','BS Civil Engineering','BS Mechanical Engineering','BS Petroleum Engineering','BS Electrical Engineering','BS Architecture') DEFAULT NULL,
  `date_published` date DEFAULT NULL,
  `college` bigint(20) UNSIGNED DEFAULT NULL,
  `adviser` varchar(255) DEFAULT NULL,
  `fieldname` enum('Business','Technology','Education') DEFAULT NULL,
  `campus` enum('Main Campus','Araceli','Balabac','Bataraza','Brooke''s Point','Coron','Cuyo','Dumaran','El Nido','Linapacan','Narra','Quezon','Rizal','Roxas','San Rafael','San Vicente','Sofronio Española','Taytay') DEFAULT NULL,
  `citation` text DEFAULT NULL,
  `drive_link` varchar(10000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `research`
--

INSERT INTO `research` (`id`, `callno`, `filename`, `author`, `program`, `date_published`, `college`, `adviser`, `fieldname`, `campus`, `citation`, `drive_link`, `created_at`, `updated_at`) VALUES
(2, 'CEAT 3215', 'CaseStudy-Llado Maurene C..pdf', 'Calma, Llado, Orga, Casayas', 'BS Architecture', '2023-10-07', 130, 'Jent Carlos Gardose', 'Technology', 'San Rafael', 'Orga, S. Et al, (2021).CaseStudy-Llado Maurene C. Palawan state university', 'https://drive.google.com/file/d/1h970cbwZd34uN1llLpOrIYnyDHusK9IT/view?usp=drive_link', '2023-09-10 01:30:25', '2023-11-27 13:44:19'),
(5, 'CEAT 299812', 'Module-1-Lesson-5-IER.pdf', 'Randel Vitero', 'BS Electrical Engineering', '2023-10-06', 130, 'Rizza Armildez', 'Technology', 'Coron', 'Vitero. R. et al.(2021).Module-1-Lesson-5-IER.Palawan State University.', 'https://drive.google.com/file/d/1HYkYk6tPlC-otBstBxBUyZTjRTcIzv3U/view?usp=drive_link', '2023-09-10 01:58:23', '2023-11-26 22:17:06'),
(6, 'CS 12321', 'JD-Quotation.pdf', 'Ellaine Mae Llacuna, Llado, Maurene C., Pilarmeo, Francis Joe P., Vigo, Honeyly M.', 'BS Computer Science', '2023-09-12', 131, 'Rizza Armildez', 'Technology', 'Sofronio Española', 'Llacun, E.M. et al.(2021).JD-Quotation. Palawan State University', 'https://drive.google.com/file/d/13woq9W4l5aa6L-fHvvItiFKiYf0B6pU6/view?usp=drive_link', '2023-09-11 22:39:03', '2023-11-26 22:16:09'),
(12, 'IT 2341', 'Duplichecker-Plagiarism-Report.pdf', 'Ganeso Jonard', 'BS Information Technology', '2023-09-12', 131, 'Regina Bravo', 'Technology', 'Roxas', 'Ganeso, J. (2021).Duplichecker-Plagiarism-Report. Palawan State University', 'https://drive.google.com/file/d/1ZqtLkTMZMOWttOVyQfCjvHRM5r15PUH9/view?usp=drive_link', '2023-09-12 00:37:54', '2023-11-26 22:11:57'),
(13, 'CEAT 6342', 'pdfcoffee.com_1-8-15-pdf-free.pdf', 'Jordan Masdo', 'BS Architecture', '2023-09-14', 130, 'Ivan Castillo', 'Technology', 'Brooke\'s Point', 'Masdo. J. (2021).pdfcoffee.com_1-8-15-pdf-free. Palawan State University', '', '2023-09-13 16:01:03', '2023-11-24 08:00:56'),
(16, 'IT 173911', 'HAHAHAH HAHAHH -2019 6AFCSYEYE HUUWSUUQUIW- SHYEYEGW.pdf', 'Calma, Llado, Orga, Casayas', 'BS Information Technology', '2023-09-19', 131, 'Rizza Armildez', 'Technology', 'Narra', 'Calma, I. et al.,(2023)HAHAHAH HAHAHH -2019 6AFCSYEYE HUUWSUUQUIW- SHYEYEGW. Palawan State University', 'https://drive.google.com/file/d/1zr2xBdpM4T7RLwvAjohYTXfbW8NFRP_E/view?usp=drive_link', '2023-09-19 00:38:57', '2023-11-26 22:13:39'),
(17, 'IT 23142', 'IT-PLAYERS-2023.pdf', 'Maurene Llado', 'BS Information Technology', '2023-10-01', 131, 'Rizza Armildez', 'Business', 'Narra', 'Llado, M. et al. (2023).IT-PLAYERS-2023. Palawan State. University', 'https://drive.google.com/file/d/1ysQKgiBZ1ZKt9OGLmq0jUQI7Bz7vITvl/view?usp=drive_link', '2023-10-01 03:25:48', '2023-11-26 22:15:01'),
(18, 'CEAT 55123', 'Quote29.pdf', 'Shammel Binaguiohan, Brix sobretodo', 'BS Architecture', '2023-10-04', 130, 'Larry Caduada', 'Technology', 'Cuyo', NULL, '', '2023-10-04 09:08:12', '2023-10-07 15:32:22'),
(20, 'MB 3215', 'CONFIDENTIALITY AGREEMENT.pdf', 'Sean Harvey Orga.', 'BS Medical Biology', '2023-10-07', 131, 'Florideth Jeanne Gatan', 'Education', 'Linapacan', 'Harvey, S, et al. (2021).CONFIDENTIALITY AGREEMENT. Palawan State University', 'https://drive.google.com/file/d/1zMi70nT5w5s6hfUB8YBez8TyxO-NE7uR/view?usp=drive_link', '2023-10-07 04:15:44', '2023-11-26 22:11:37'),
(21, 'ES 4321', 'VITERORANDEL-EXERCISE-5.pdf', 'Nerysol Namuco', 'BS Environmental Science', '2023-10-18', 131, 'Jent Carlos Gardose', 'Education', 'Roxas', 'Namuco, N et.al', '', '2023-10-07 04:35:01', '2023-11-23 14:32:35'),
(23, 'IT 2162', 'UIUXB1-Maurene Llado-Excer1.pdf', 'Maurene Llado', 'BS Information Technology', '2023-10-09', 131, 'Bemsor Caabay', 'Technology', 'Main Campus', 'Calma , Casayas etal', '', '2023-10-09 12:11:46', '2023-10-09 12:11:46'),
(28, 'IT 234255', 'HCI-2-final-requirements (1).pdf', 'Casayas, Jiezca', 'BS Information Technology', '2023-11-21', 131, 'Jent Carlos Gardose', 'Technology', 'Main Campus', 'casayas, J. et al. (2023).HCI-2-final-requirements (1). Palawan State University', 'https://drive.google.com/file/d/1PMbNkBzJLoI_5FV8haemW9RGVcSwyjPt/view?usp=drive_link', '2023-11-21 07:19:54', '2023-11-26 22:14:03'),
(29, 'CEAT 215233', 'HACHERO-Anniza-A.-EXER-7.pdf', 'Sean Harvey Orga, Maria Victoria Del Moro', 'BS Mechanical Engineering', '2023-11-23', 130, 'Bemsor Caabay', 'Technology', 'Main Campus', 'Llado, et al, (2019), HACHERO-Anniza-A.-EXER-7.', 'https://drive.google.com/file/d/1RY1rF9r0hUvjFczPf06lwWFBi-_BwmvJ/view?usp=drive_link', '2023-11-23 09:41:46', '2023-11-26 22:12:49'),
(30, 'MBS 12122', 'HCI_POWERPOINT.pdf', 'Nerysol Namuco', 'BS Marine Biology', '2023-11-23', 131, 'Menchie Lopez', 'Education', 'Quezon', 'Namuco, N. A. (2023).HCI_POWERPOINT. Palawan State University.', 'https://drive.google.com/file/d/1ydXUGsFWWQDdVooCrfnqEgCOd2dIWzS7/view?usp=drive_link', '2023-11-23 14:35:43', '2023-11-26 22:14:29'),
(31, 'IT 234211', 'Castillas-Lereza-Mae-V.-Exer4.pdf', 'Ellaine Mae Llacuna', 'BS Information Technology', '2023-11-27', 130, 'Florideth Jeanne Gatan', 'Business', 'Main Campus', 'haha et al', 'https://drive.google.com/file/d/1jg4AxQ5D368yyYNdVNDGcfXU8oYM4Aor/view?usp=drive_link', '2023-11-26 16:03:27', '2023-11-26 16:55:01'),
(39, 'CEAT 29981111', 'District bar.pdf', 'Calma, Llado, Orga, Casayas', 'BS Petroleum Engineering', '2023-11-27', 130, 'Regina Bravo', 'Technology', 'Narra', 'Llado, M. et al.(2023).District Bar. Palawan State University', 'https://drive.google.com/file/d/1W0Yc1Uxb6ClxCRgVrp_tW-qDjgim4ogW/view?usp=drive_link', '2023-11-27 15:46:46', '2023-11-27 15:46:46'),
(40, 'IT 212111', 'OmpadMarkJustine-Exer4.pdf', 'Mark Justine Ompad', 'BS Information Technology', '2023-11-29', 131, 'Demy Dizon', 'Technology', 'Main Campus', 'Ompad M.J. (2023).Ompad-Exer4. Palawan State University', 'https://drive.google.com/file/d/1MaTqGPqRCbxawbCcG6Asb7fFk7eZmS_y/view?usp=drive_link', '2023-11-29 14:53:38', '2023-11-29 14:53:38'),
(41, 'CEAT 2998123211', 'Baute-Norkizah-M.-Exer3.pdf', 'Ellaine Mae Llacuna, Llado, Maurene C., Pilarmeo, Francis Joe P., Vigo, Honeyly M.', 'BS Information Technology', '2023-11-30', 131, 'Jent Carlos Gardose', 'Technology', 'El Nido', 'zzz', 'https://drive.google.com/file/d/1W0Yc1Uxb6ClxCRgVrp_tW-qDjgim4ogW/view?usp=drive_link', '2023-11-29 18:43:51', '2023-11-29 18:43:51'),
(42, 'IT-98812', '1-Deploying Web Application in Heroku (4).pdf', 'Calma, Llado, Orga, Casayas', 'BS Information Technology', '2023-11-06', 131, 'Bemsor Caabay', 'Technology', 'Main Campus', 'Calma I.J. eta al. (2023). Deploying web Application in Heroku. Palawan State University', 'https://drive.google.com/file/d/1a3KzrbZ8NnIzU9E2FpMor11ZyirnbgBW/view?usp=drive_link', '2023-11-29 18:47:56', '2023-11-29 18:47:56'),
(43, 'CEAT 234299', '8-SCHEDULE-OF-PROPOSAL-DEFENSE-2ND-SEM-2022-2023.pdf', 'Llado, Maurene', 'BS Mechanical Engineering', '2023-11-30', 130, 'Menchie Lopez', 'Technology', 'Balabac', 'Llado, M.(2023).8-SCHEDULE-OF-PROPOSAL-DEFENSE-2ND-SEM-2022-2023. Palawan State University', 'https://drive.google.com/file/d/1Tw18tZLPkbVzIrG_V2e6IJ_2ajOIJ9R6/view?usp=drive_link', '2023-11-29 18:54:47', '2023-11-29 18:54:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `program` enum('BS Information Technology','BS Computer Science','BS Medical Biology','BS Environmental Science','BS Marine Biology','BS Civil Engineering','BS Mechanical Engineering','BS Petroleum Engineering','BS Electrical Engineering','BS Architecture') DEFAULT NULL,
  `college_id` bigint(20) UNSIGNED DEFAULT NULL,
  `interest` enum('Business','Technology','Education') DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile_picture`, `program`, `college_id`, `interest`, `role`, `email_verified_at`, `last_login`, `status`, `google_id`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'ThesesVault', 'mau@gmail.com', '1698588654.jpg', 'BS Information Technology', 131, 'Technology', 'admin', '2023-09-03 22:37:55', '2023-11-29 22:50:07', 'Active', NULL, '$2y$10$G1ff/CTGSD4aHQ55D7AY7.fEdZblYLTIvjEF03T3Zz0qfW583mdCW', 'IalmsBShkxfuaa4qK6dLIB7geWyastf0M43k6v87asilWgSEB6cRHHJfIHue', '2023-09-03 22:37:08', '2023-11-29 14:50:07'),
(4, 'Maurene Llado', 'maurenellado@gmail.com', '1695483409.png', 'BS Information Technology', 131, 'Business', 'user', '2023-09-04 00:41:01', '2023-09-21 19:19:29', 'Inactive', NULL, '$2y$10$SrTB0f5hdEzWupellbsQi.oofoAfJalIvPAD09zuhkPpkUriWkKGy', 'PzVjFniBHkAmi3snm8VzS0RZRyxCovMPHLeGoD4EgvyEapu8WoxNURuvZLao', '2023-09-04 00:39:22', '2023-09-23 07:36:51'),
(62, 'Maurene Llado', 'maurenecayao@gmail.com', '1700491646.jpg', 'BS Architecture', 130, 'Technology', 'user', '2023-10-18 11:48:35', '2023-12-01 11:54:58', 'Active', '108929174058780206522', '$2y$10$wpQvbuu/jZzBTYAtB65sR.0XmJHEizks.z2MBhHFttEIzCIjPVAG6', 'LjIIOE56saWjkXU2VXJLhOcOY1IHjR0ALVVNc0IXUUF2dRNNQk50RnoYqGcu', '2023-10-18 11:47:16', '2023-12-01 03:54:58'),
(95, 'glu', '202180192@psu.palawan.edu.ph', NULL, 'BS Medical Biology', NULL, 'Business', 'user', NULL, '2023-11-24 13:58:20', 'Inactive', '109266244772006004865', '$2y$10$HwNxA9T3eRi5iWv.HcMeyukKsDjeonUoG4p8/UmBcWn6INpYJONIy', NULL, '2023-11-24 05:58:20', '2023-11-24 05:59:10'),
(96, 'Mia Garcellano', '202180094@psu.palawan.edu.ph', '1700807294.jpg', 'BS Information Technology', 131, NULL, 'user', '2023-11-24 06:10:30', '2022-12-13 14:09:27', 'Inactive', '115993481088615896391', '$2y$10$14Rty7arY0SkxwEV4nvh6.7KM6IN8cQEgPR/cueHSWW/rAtjJnhju', NULL, '2023-11-24 06:09:27', '2023-11-24 06:31:24'),
(99, 'Ingrid Calma', '202080086@psu.palawan.edu.ph', NULL, 'BS Information Technology', 131, 'Education', 'admin', '2023-11-27 01:23:26', '2023-12-04 21:12:06', 'Active', NULL, '$2y$10$017bM2Z4ompnYshaPK4oee2l7c/Dv/pXudKIWC8rjZP4nHc6Yngqe', 'oezzkj106TiokfAa8luZBhVgxo9tEUSUKEVDlpXUxt5yPyaqSa9aiVzrOi5B', '2023-11-27 01:22:50', '2023-12-04 13:12:06'),
(104, 'Maurene', '202080070@psu.palawan.edu.ph', NULL, 'BS Civil Engineering', 130, 'Business', 'user', '2023-11-30 14:55:31', '2023-12-04 21:15:10', 'Active', NULL, '$2y$10$gttTdMjYcFb9JDKqqxB05OqaQcIhn1JDosBdMOYf00Kil4xVFdbXW', NULL, '2023-11-30 14:55:01', '2023-12-04 13:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `view`
--

CREATE TABLE `view` (
  `vid` bigint(20) UNSIGNED NOT NULL,
  `research_id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) NOT NULL,
  `userview_id` bigint(20) UNSIGNED NOT NULL,
  `research_college` bigint(20) UNSIGNED DEFAULT NULL,
  `user_college` bigint(20) UNSIGNED DEFAULT NULL,
  `viewed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `view`
--

INSERT INTO `view` (`vid`, `research_id`, `filename`, `userview_id`, `research_college`, `user_college`, `viewed_at`, `created_at`, `updated_at`) VALUES
(30, 6, 'JD-Quotation.pdf', 3, NULL, NULL, '2023-09-19 07:43:37', '2023-09-19 07:43:37', '2023-09-19 07:43:37'),
(36, 16, 'HAHAHAH HAHAHH -2019 6AFCSYEYE HUUWSUUQUIW- SHYEYEGW.pdf', 3, NULL, NULL, '2023-09-19 07:45:49', '2023-09-19 07:45:49', '2023-09-19 07:45:49'),
(38, 13, 'pdfcoffee.com_1-8-15-pdf-free.pdf', 3, NULL, NULL, '2023-09-19 07:46:00', '2023-09-19 07:46:00', '2023-09-19 07:46:00'),
(42, 13, 'pdfcoffee.com_1-8-15-pdf-free.pdf', 3, NULL, NULL, '2023-09-19 07:46:25', '2023-09-19 07:46:25', '2023-09-19 07:46:25'),
(51, 5, 'Module-1-Lesson-5-IER.pdf', 3, NULL, NULL, '2023-09-23 06:26:42', '2023-09-23 06:26:42', '2023-09-23 06:26:42'),
(55, 6, 'JD-Quotation.pdf', 3, NULL, NULL, '2023-09-29 07:55:58', '2023-09-29 07:55:58', '2023-09-29 07:55:58'),
(90, 5, 'Module-1-Lesson-5-IER.pdf', 3, NULL, NULL, '2023-10-04 16:19:00', '2023-10-04 16:19:00', '2023-10-04 16:19:00'),
(103, 20, 'CONFIDENTIALITY AGREEMENT.pdf', 3, NULL, NULL, '2023-10-07 04:16:18', '2023-10-07 04:16:18', '2023-10-07 04:16:18'),
(120, 6, 'JD-Quotation.pdf', 3, NULL, NULL, '2023-10-09 06:47:18', '2023-10-09 06:47:18', '2023-10-09 06:47:18'),
(121, 20, 'CONFIDENTIALITY AGREEMENT.pdf', 3, NULL, NULL, '2023-10-09 07:00:40', '2023-10-09 07:00:40', '2023-10-09 07:00:40'),
(136, 20, 'CONFIDENTIALITY AGREEMENT.pdf', 62, NULL, NULL, '2023-10-18 11:52:21', '2023-10-18 11:52:21', '2023-10-18 11:52:21'),
(138, 21, 'VITERORANDEL-EXERCISE-5.pdf', 62, NULL, NULL, '2023-10-21 09:15:07', '2023-10-21 09:15:07', '2023-10-21 09:15:07'),
(141, 2, 'CaseStudy-Llado Maurene C..pdf', 62, NULL, NULL, '2023-10-24 05:29:07', '2023-10-24 05:29:07', '2023-10-24 05:29:07'),
(144, 2, 'CaseStudy-Llado Maurene C..pdf', 62, NULL, NULL, '2023-10-25 05:20:22', '2023-10-25 05:20:22', '2023-10-25 05:20:22'),
(147, 20, 'CONFIDENTIALITY AGREEMENT.pdf', 62, NULL, NULL, '2023-11-04 08:27:35', '2023-11-04 08:27:35', '2023-11-04 08:27:35'),
(152, 23, 'UIUXB1-Maurene Llado-Excer1.pdf', 62, NULL, NULL, '2023-11-17 02:57:12', '2023-11-17 02:57:12', '2023-11-17 02:57:12'),
(161, 21, 'VITERORANDEL-EXERCISE-5.pdf', 62, NULL, NULL, '2023-11-20 12:50:41', '2023-11-20 12:50:41', '2023-11-20 12:50:41'),
(162, 5, 'Module-1-Lesson-5-IER.pdf', 62, NULL, NULL, '2023-11-20 14:38:21', '2023-11-20 14:38:21', '2023-11-20 14:38:21'),
(164, 12, 'Duplichecker-Plagiarism-Report.pdf', 62, NULL, NULL, '2023-11-21 07:28:27', '2023-11-21 07:28:27', '2023-11-21 07:28:27'),
(166, 28, 'HCI-2-final-requirements (1).pdf', 3, NULL, NULL, '2023-11-21 08:33:55', '2023-11-21 08:33:55', '2023-11-21 08:33:55'),
(171, 28, 'HCI-2-final-requirements (1).pdf', 3, NULL, NULL, '2023-11-23 02:49:33', '2023-11-23 02:49:33', '2023-11-23 02:49:33'),
(172, 13, 'pdfcoffee.com_1-8-15-pdf-free.pdf', 62, NULL, NULL, '2023-11-23 03:03:40', '2023-11-23 03:03:40', '2023-11-23 03:03:40'),
(192, 20, 'CONFIDENTIALITY AGREEMENT.pdf', 62, 131, 130, '2023-11-23 23:41:12', '2023-11-23 23:41:12', '2023-11-23 23:41:12'),
(193, 12, 'Duplichecker-Plagiarism-Report.pdf', 62, 131, 130, '2023-11-23 23:45:11', '2023-11-23 23:45:11', '2023-11-23 23:45:11'),
(198, 20, 'CONFIDENTIALITY AGREEMENT.pdf', 62, 131, 131, '2023-11-24 00:03:21', '2023-11-24 00:03:21', '2023-11-24 00:03:21'),
(200, 30, 'HCI_POWERPOINT.pdf', 62, 131, 131, '2023-11-24 00:05:30', '2023-11-24 00:05:30', '2023-11-24 00:05:30'),
(209, 29, 'HACHERO-Anniza-A.-EXER-7.pdf', 3, 130, 131, '2023-11-24 01:02:22', '2023-11-24 01:02:22', '2023-11-24 01:02:22'),
(214, 30, 'HCI_POWERPOINT.pdf', 96, 131, 131, '2023-11-24 06:15:19', '2023-11-24 06:15:19', '2023-11-24 06:15:19'),
(215, 30, 'HCI_POWERPOINT.pdf', 96, 131, 131, '2023-11-24 06:15:20', '2023-11-24 06:15:20', '2023-11-24 06:15:20'),
(216, 20, 'CONFIDENTIALITY AGREEMENT.pdf', 96, 131, 131, '2023-11-24 06:17:28', '2023-11-24 06:17:28', '2023-11-24 06:17:28'),
(217, 2, 'CaseStudy-Llado Maurene C..pdf', 96, 130, 131, '2023-11-24 06:22:14', '2023-11-24 06:22:14', '2023-11-24 06:22:14'),
(218, 2, 'CaseStudy-Llado Maurene C..pdf', 96, 130, 131, '2023-11-24 06:22:14', '2023-11-24 06:22:14', '2023-11-24 06:22:14'),
(219, 21, 'VITERORANDEL-EXERCISE-5.pdf', 96, 131, 131, '2023-11-24 06:24:28', '2023-11-24 06:24:28', '2023-11-24 06:24:28'),
(220, 21, 'VITERORANDEL-EXERCISE-5.pdf', 96, 131, 131, '2023-11-24 06:24:28', '2023-11-24 06:24:28', '2023-11-24 06:24:28'),
(221, 12, 'Duplichecker-Plagiarism-Report.pdf', 62, 131, 131, '2023-11-24 16:28:52', '2023-11-24 16:28:52', '2023-11-24 16:28:52'),
(222, 29, 'HACHERO-Anniza-A.-EXER-7.pdf', 62, 130, 131, '2023-11-24 16:28:53', '2023-11-24 16:28:53', '2023-11-24 16:28:53'),
(223, 2, 'CaseStudy-Llado Maurene C..pdf', 62, 130, 131, '2023-11-24 16:28:53', '2023-11-24 16:28:53', '2023-11-24 16:28:53'),
(225, 20, 'CONFIDENTIALITY AGREEMENT.pdf', 62, 131, 131, '2023-11-24 16:28:54', '2023-11-24 16:28:54', '2023-11-24 16:28:54'),
(246, 29, 'HACHERO-Anniza-A.-EXER-7.pdf', 62, 130, 131, '2023-11-24 17:11:11', '2023-11-24 17:11:11', '2023-11-24 17:11:11'),
(247, 12, 'Duplichecker-Plagiarism-Report.pdf', 62, 131, 131, '2023-11-24 17:11:24', '2023-11-24 17:11:24', '2023-11-24 17:11:24'),
(260, 2, 'CaseStudy-Llado Maurene C..pdf', 62, 130, 131, '2023-11-25 07:10:59', '2023-11-25 07:10:59', '2023-11-25 07:10:59'),
(261, 13, 'pdfcoffee.com_1-8-15-pdf-free.pdf', 62, 130, 131, '2023-11-25 07:13:31', '2023-11-25 07:13:31', '2023-11-25 07:13:31'),
(262, 16, 'HAHAHAH HAHAHH -2019 6AFCSYEYE HUUWSUUQUIW- SHYEYEGW.pdf', 62, 131, 131, '2023-11-25 07:18:23', '2023-11-25 07:18:23', '2023-11-25 07:18:23'),
(263, 28, 'HCI-2-final-requirements (1).pdf', 62, 131, 131, '2023-11-25 07:18:29', '2023-11-25 07:18:29', '2023-11-25 07:18:29'),
(267, 2, 'CaseStudy-Llado Maurene C..pdf', 62, 130, 131, '2023-11-26 06:07:26', '2023-11-26 06:07:26', '2023-11-26 06:07:26'),
(268, 5, 'Module-1-Lesson-5-IER.pdf', 62, 130, 131, '2023-11-26 06:07:53', '2023-11-26 06:07:53', '2023-11-26 06:07:53'),
(302, 30, 'HCI_POWERPOINT.pdf', 62, 131, 131, '2023-11-29 18:28:59', '2023-11-29 18:28:59', '2023-11-29 18:28:59'),
(303, 42, '1-Deploying Web Application in Heroku (4).pdf', 62, 131, 131, '2023-11-29 18:49:10', '2023-11-29 18:49:10', '2023-11-29 18:49:10'),
(304, 42, '1-Deploying Web Application in Heroku (4).pdf', 62, 131, 131, '2023-11-29 20:26:56', '2023-11-29 20:26:56', '2023-11-29 20:26:56'),
(306, 43, '8-SCHEDULE-OF-PROPOSAL-DEFENSE-2ND-SEM-2022-2023.pdf', 104, 130, 130, '2023-12-04 13:14:34', '2023-12-04 13:14:34', '2023-12-04 13:14:34'),
(307, 43, '8-SCHEDULE-OF-PROPOSAL-DEFENSE-2ND-SEM-2022-2023.pdf', 104, 130, 130, '2023-12-04 13:15:44', '2023-12-04 13:15:44', '2023-12-04 13:15:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adviser`
--
ALTER TABLE `adviser`
  ADD PRIMARY KEY (`adviserId`),
  ADD UNIQUE KEY `adviser_name` (`adviser_name`),
  ADD KEY `college_aid` (`adviser_college`);

--
-- Indexes for table `auditlog`
--
ALTER TABLE `auditlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userIid` (`user_id`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`fid`),
  ADD KEY `userId` (`user_id`),
  ADD KEY `research_filename` (`filename`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`hid`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `research`
--
ALTER TABLE `research`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `filename` (`filename`),
  ADD UNIQUE KEY `callno` (`callno`),
  ADD KEY `college` (`college`),
  ADD KEY `adviserName` (`adviser`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `collegeid` (`college_id`);

--
-- Indexes for table `view`
--
ALTER TABLE `view`
  ADD PRIMARY KEY (`vid`),
  ADD KEY `filename` (`filename`),
  ADD KEY `userview` (`userview_id`),
  ADD KEY `researchId` (`research_id`),
  ADD KEY `user_college` (`user_college`),
  ADD KEY `research_college` (`research_college`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adviser`
--
ALTER TABLE `adviser`
  MODIFY `adviserId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1160;

--
-- AUTO_INCREMENT for table `auditlog`
--
ALTER TABLE `auditlog`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `fid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `hid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=354;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `research`
--
ALTER TABLE `research`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `view`
--
ALTER TABLE `view`
  MODIFY `vid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adviser`
--
ALTER TABLE `adviser`
  ADD CONSTRAINT `college_aid` FOREIGN KEY (`adviser_college`) REFERENCES `college` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD CONSTRAINT `userIid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `research_filename` FOREIGN KEY (`filename`) REFERENCES `research` (`filename`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userId` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `research`
--
ALTER TABLE `research`
  ADD CONSTRAINT `adviserName` FOREIGN KEY (`adviser`) REFERENCES `adviser` (`adviser_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `college` FOREIGN KEY (`college`) REFERENCES `college` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `collegeid` FOREIGN KEY (`college_id`) REFERENCES `college` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `view`
--
ALTER TABLE `view`
  ADD CONSTRAINT `filename` FOREIGN KEY (`filename`) REFERENCES `research` (`filename`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `researchId` FOREIGN KEY (`research_id`) REFERENCES `research` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `research_college` FOREIGN KEY (`research_college`) REFERENCES `college` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_college` FOREIGN KEY (`user_college`) REFERENCES `college` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userview` FOREIGN KEY (`userview_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
