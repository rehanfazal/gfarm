-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 17, 2022 at 11:38 AM
-- Server version: 5.7.37
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goncocom_gfarm_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feedback` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `customer_name`, `feedback`, `status`, `created_at`, `updated_at`) VALUES
(1, 120, 'Test Customer', 'Test Job Here', 1, '2021-10-07 04:09:27', '2021-10-07 04:09:27'),
(2, 120, 'Test Customer', 'Test Job Here', 1, '2021-10-07 04:10:03', '2021-10-07 04:10:03'),
(3, 65052, 'undefined undefined', 'Dgd', 1, '2021-10-07 07:35:47', '2021-10-07 07:35:47'),
(4, 65052, 'undefined undefined', 'Dgd', 1, '2021-10-07 07:38:35', '2021-10-07 07:38:35'),
(5, 65052, 'undefined undefined', 'Dh', 1, '2021-10-07 07:38:45', '2021-10-07 07:38:45'),
(6, 98848, 'undefined undefined', 'Dgjzg', 1, '2021-10-08 02:39:51', '2021-10-08 02:39:51'),
(7, 139, 'Muhammad Qureshi', 'Rsjfaj', 1, '2021-10-13 08:19:53', '2021-10-13 08:19:53'),
(8, 139, 'Muhammad Qureshi', 'Tksgkskxg', 1, '2021-10-15 16:13:01', '2021-10-15 16:13:01'),
(9, 120, 'Test Customer', 'Test Job Here', 1, '2021-11-30 08:05:59', '2021-11-30 08:05:59'),
(10, 83453, 'GUEST_83453', 'Hi there', 1, '2021-11-30 08:14:46', '2021-11-30 08:14:46'),
(11, 11933, 'GUEST_11933', 'Hmmm', 1, '2021-11-30 08:21:11', '2021-11-30 08:21:11'),
(12, 139, 'GUEST_139', 'gu', 1, '2021-11-30 10:28:13', '2021-11-30 10:28:13');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'serviceImages/category20211005-061808.webp', 2, '2021-10-05 04:18:08', '2022-03-16 10:03:55'),
(2, 'serviceImages/category20211005-061835.jpeg', 2, '2021-10-05 04:18:35', '2022-03-16 10:03:59'),
(3, 'serviceImages/category20211005-061850.jpg', 2, '2021-10-05 04:18:50', '2022-03-16 10:04:04'),
(4, 'serviceImages/category20211005-061922.svg', 2, '2021-10-05 04:19:22', '2021-10-05 04:28:40'),
(5, 'serviceImages/category20211005-061953.png', 2, '2021-10-05 04:19:53', '2022-03-16 10:04:09');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `sp_id` int(11) DEFAULT NULL,
  `q_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urgent` tinyint(1) NOT NULL,
  `total_price` int(11) DEFAULT NULL COMMENT 'Total Price of Job',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 = Inactive,1 = Active, 2=In-Progress, 3=Completed, 4=Cancelled',
  `sp_job_accept` timestamp NULL DEFAULT NULL COMMENT 'Timestamp for counter - when sp accept job',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main_category`
--

CREATE TABLE `main_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `main_category`
--

INSERT INTO `main_category` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Farm Fresh Products', 'serviceImages/category20220316-112152.jpg', 1, '2021-10-02 06:01:21', '2022-03-16 10:21:52'),
(2, 'Meat', NULL, 0, '2021-10-07 03:07:30', '2022-03-16 10:16:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mobileemailotp`
--

CREATE TABLE `mobileemailotp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `tokenforemail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mobileemailotp`
--

INSERT INTO `mobileemailotp` (`id`, `user_id`, `tokenforemail`, `expiry_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 140, '111222', NULL, 1, '2021-11-30 13:24:43', '2021-11-30 13:24:43'),
(2, 142, '111222', NULL, 1, '2021-11-30 14:32:16', '2021-11-30 14:32:16'),
(3, 143, '111222', NULL, 1, '2021-12-01 10:31:30', '2021-12-01 10:31:30'),
(4, 144, '111222', NULL, 1, '2021-12-01 10:32:20', '2021-12-01 10:32:20'),
(5, 146, '111222', NULL, 1, '2021-12-06 07:27:10', '2021-12-06 07:27:10'),
(6, 147, '111222', NULL, 1, '2021-12-06 07:46:40', '2021-12-06 07:46:40'),
(7, 149, '111222', NULL, 1, '2021-12-06 09:19:47', '2021-12-06 09:19:47'),
(8, 150, '111222', NULL, 1, '2022-03-10 10:09:52', '2022-03-10 10:09:52');

-- --------------------------------------------------------

--
-- Table structure for table `mobilesessions`
--

CREATE TABLE `mobilesessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mobilesessions`
--

INSERT INTO `mobilesessions` (`id`, `user_id`, `remember_token`, `expiry_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 120, '939b64c06c1fbcbd414726c55c285d2e', NULL, 1, '2021-10-02 06:17:37', '2021-10-02 06:17:37'),
(2, 120, '0bcc277dd340ab819bc52182548ecc41', NULL, 1, '2021-10-02 17:09:08', '2021-10-02 17:09:08'),
(3, 120, '63efec5c4e1f2881e11f9a3fae1379f4', NULL, 1, '2021-10-02 17:12:32', '2021-10-02 17:12:32'),
(4, 120, 'cb4bcf0d26767faa9d000930c831401a', NULL, 1, '2021-10-02 17:56:26', '2021-10-02 17:56:26'),
(5, 121, '9da0729bc81cb6f223eb8bc71578810f', NULL, 1, '2021-10-02 18:13:51', '2021-10-02 18:13:51'),
(6, 121, 'fdfc1929b2020b1e7efe7db064cfd532', NULL, 1, '2021-10-02 18:14:08', '2021-10-02 18:14:08'),
(7, 121, 'f11eb29137a1151a1f0a9f39949ee317', NULL, 1, '2021-10-02 18:14:16', '2021-10-02 18:14:16'),
(8, 122, 'f8586656b5653d4b6eccebf06066d5ab', NULL, 1, '2021-10-02 18:17:44', '2021-10-02 18:17:44'),
(9, 121, 'a833bcd29606edb719a35ef32fd5112e', NULL, 1, '2021-10-02 18:20:09', '2021-10-02 18:20:09'),
(10, 120, '4828adfef3ab153546b737882015be9b', NULL, 1, '2021-10-04 17:47:40', '2021-10-04 17:47:40'),
(11, 123, 'fc603b973bb7387f191d820c3d420581', NULL, 1, '2021-10-04 17:48:36', '2021-10-04 17:48:36'),
(12, 124, 'd37f342a3312085f99908c97ff054eb7', NULL, 1, '2021-10-05 03:38:36', '2021-10-05 03:38:36'),
(13, 125, 'ec9d027a920ee1bc94b42b5f34b11844', NULL, 1, '2021-10-05 03:58:14', '2021-10-05 03:58:14'),
(14, 126, '3f1bd1d4e2df46b1124b84bf62195dbd', NULL, 1, '2021-10-05 04:02:03', '2021-10-05 04:02:03'),
(15, 127, 'b8e9969b707853ac43f75ed1fda14bde', NULL, 1, '2021-10-05 04:02:30', '2021-10-05 04:02:30'),
(16, 128, '19d3ce1876f0e94945fc42b2319d3818', NULL, 1, '2021-10-05 05:28:20', '2021-10-05 05:28:20'),
(17, 129, '13912fa69883eba9fd78b2763f003ca1', NULL, 1, '2021-10-05 05:34:20', '2021-10-05 05:34:20'),
(18, 129, 'ef80f1fb1f9bd476b3ee9b0092be71a9', NULL, 1, '2021-10-05 05:34:41', '2021-10-05 05:34:41'),
(19, 130, '5fb357b7d83841e0b995ddfd8cd7fd00', NULL, 1, '2021-10-05 05:35:07', '2021-10-05 05:35:07'),
(20, 129, 'ae58559f78481478303e28cd380f17e1', NULL, 1, '2021-10-05 05:38:32', '2021-10-05 05:38:32'),
(21, 131, '6c4edb8b5877d0d4f844f6cab42f0e21', NULL, 1, '2021-10-05 05:43:33', '2021-10-05 05:43:33'),
(22, 131, '11093324c11bff60c4a48acd972c25ef', NULL, 1, '2021-10-05 05:45:11', '2021-10-05 05:45:11'),
(23, 129, 'c49fe8b19fee5bf6115dcd199d46e3b6', NULL, 1, '2021-10-05 05:49:42', '2021-10-05 05:49:42'),
(24, 130, '49ad687637233d8fa12003920044805f', NULL, 1, '2021-10-05 05:49:56', '2021-10-05 05:49:56'),
(25, 129, 'f29b82efbf3c156358509ef2fcea780f', NULL, 1, '2021-10-05 05:51:21', '2021-10-05 05:51:21'),
(26, 129, '75bc9261582586a3ee792fd4de5ffae0', NULL, 1, '2021-10-05 05:54:05', '2021-10-05 05:54:05'),
(27, 131, 'cd6d749934c01f1d4c3b3b547bb271de', NULL, 1, '2021-10-05 05:59:19', '2021-10-05 05:59:19'),
(28, 132, '0ba9f56b3c9028daf0157e813e13b1be', NULL, 1, '2021-10-05 06:30:43', '2021-10-05 06:30:43'),
(29, 132, '759b62a5fbe8e66802e4daf6dff368e6', NULL, 1, '2021-10-05 07:26:45', '2021-10-05 07:26:45'),
(30, 133, '70f3c5b7b484af02c072ebb54de9deba', NULL, 1, '2021-10-05 07:38:07', '2021-10-05 07:38:07'),
(31, 134, '6bdf3266158bbd0267bc4fe7ffaf9d14', NULL, 1, '2021-10-05 09:58:01', '2021-10-05 09:58:01'),
(32, 135, '64da87c29dbeaf14405c43a2d901eb7d', NULL, 1, '2021-10-05 10:09:52', '2021-10-05 10:09:52'),
(33, 136, '3e6e49dd7b42f8f8e4fd2ef7d8cf8bbf', NULL, 1, '2021-10-06 03:48:06', '2021-10-06 03:48:06'),
(34, 96444, '052b8c879447385a10d28eb5a46e59c2', NULL, 1, '2021-10-06 03:54:23', '2021-10-06 03:54:23'),
(35, 53995, 'd93c6b98060dd6531aea270eff369aab', NULL, 1, '2021-10-06 03:55:47', '2021-10-06 03:55:47'),
(36, 20609, '8a4b1690dd807643c362bee5fbe3b8f2', NULL, 1, '2021-10-06 03:58:15', '2021-10-06 03:58:15'),
(37, 136, 'e6866db0d74c4d3273476ca4a5a8123f', NULL, 1, '2021-10-06 04:13:23', '2021-10-06 04:13:23'),
(38, 14339, '38391328d80d2556852b9081d557ec58', NULL, 1, '2021-10-06 04:24:03', '2021-10-06 04:24:03'),
(39, 51099, 'c6f80cafd1b2a4dac6a59677aeb6548d', NULL, 1, '2021-10-06 04:30:05', '2021-10-06 04:30:05'),
(40, 91835, '52f26933a5485656d380481f01f3c4d7', NULL, 1, '2021-10-06 04:30:21', '2021-10-06 04:30:21'),
(41, 39339, '4889745829eeda9fbe62991b5c303fbb', NULL, 1, '2021-10-06 04:37:02', '2021-10-06 04:37:02'),
(42, 71237, '782cb890d5da28eec7f50698ddd296ff', NULL, 1, '2021-10-06 04:40:10', '2021-10-06 04:40:10'),
(43, 86295, 'b71163f14184eb0d18edd5ae989b5e92', NULL, 1, '2021-10-06 04:43:49', '2021-10-06 04:43:49'),
(44, 88247, '8823ca26d8bc6e23eb7db0d04454aa31', NULL, 1, '2021-10-06 05:57:51', '2021-10-06 05:57:51'),
(45, 137, '767787934cb21dd1c58b5aab796bb7e7', NULL, 1, '2021-10-06 06:12:01', '2021-10-06 06:12:01'),
(46, 55230, 'd58ad0c472284771eb5ec8ee412ed234', NULL, 1, '2021-10-06 06:13:20', '2021-10-06 06:13:20'),
(47, 43299, 'c76c7305ab795a09c82f22755fc2dbb3', NULL, 1, '2021-10-06 06:21:58', '2021-10-06 06:21:58'),
(48, 94862, 'e745a07009e4fd01e6e3bec76f220bc3', NULL, 1, '2021-10-06 10:15:22', '2021-10-06 10:15:22'),
(49, 138, 'e3c1d6b08ce1478f58e95f168b2a0b44', NULL, 1, '2021-10-06 10:16:08', '2021-10-06 10:16:08'),
(50, 14458, '5b0c1f06134f7e3f904e2eb443fec571', NULL, 1, '2021-10-06 10:19:47', '2021-10-06 10:19:47'),
(51, 138, '8f04840e4d866fb07f710db2c583e17f', NULL, 1, '2021-10-06 10:21:06', '2021-10-06 10:21:06'),
(52, 23571, '97c8e4c528fa7bf291b950a725760348', NULL, 1, '2021-10-06 14:44:17', '2021-10-06 14:44:17'),
(53, 12666, '2ab3d8f584a92fc797dd69011567ee1a', NULL, 1, '2021-10-06 14:59:47', '2021-10-06 14:59:47'),
(54, 87634, 'a4f4497ac7c7767c02bf8f274eb86bd9', NULL, 1, '2021-10-06 15:20:15', '2021-10-06 15:20:15'),
(55, 139, '7fd5cdfdd6a96fb076b3c252fd246840', NULL, 1, '2021-10-06 15:23:46', '2021-10-06 15:23:46'),
(56, 33217, '887d0b92479e11a8c1dcedb18329abf0', NULL, 1, '2021-10-06 15:29:08', '2021-10-06 15:29:08'),
(57, 81023, '585ac222a60517802486501eb4e22e5e', NULL, 1, '2021-10-06 16:10:05', '2021-10-06 16:10:05'),
(58, 46335, 'bd5f185f3d7c49da79b4a1bf89efc9f4', NULL, 1, '2021-10-07 06:34:21', '2021-10-07 06:34:21'),
(59, 65052, 'a7fe7993534a946bddd43ff92ce4caf7', NULL, 1, '2021-10-07 06:40:13', '2021-10-07 06:40:13'),
(60, 98848, '64f4ebcd05156dad27eb87d21a3b3a94', NULL, 1, '2021-10-07 08:25:13', '2021-10-07 08:25:13'),
(61, 80919, 'e53f47a6a133f9e8e41071ad25646836', NULL, 1, '2021-10-08 09:38:48', '2021-10-08 09:38:48'),
(62, 139, 'b3a1b7d007e723ea4c818b44f7b6eeda', NULL, 1, '2021-10-13 08:12:20', '2021-10-13 08:12:20'),
(63, 139, '94059f512a6fa3f65934ff06596c5e7f', NULL, 1, '2021-10-15 16:11:52', '2021-10-15 16:11:52'),
(64, 139, '608c377fc40162491903c536c3e0524c', NULL, 1, '2021-10-15 16:13:41', '2021-10-15 16:13:41'),
(65, 32214, 'f9d25a31b818976b541eabcdec7d655f', NULL, 1, '2021-10-15 16:13:52', '2021-10-15 16:13:52'),
(66, 29722, '21629fc0ae3fc18f08e5860879803d4d', NULL, 1, '2021-10-15 16:27:46', '2021-10-15 16:27:46'),
(67, 25251, '66ca72144964221ee436ad910bfe277d', NULL, 1, '2021-10-17 09:32:15', '2021-10-17 09:32:15'),
(68, 90231, '9828476739e111ce68ca6579982aed6c', NULL, 1, '2021-10-17 10:52:23', '2021-10-17 10:52:23'),
(69, 54730, '300c135cef253d0a526c60ef6f1adc87', NULL, 1, '2021-11-15 11:12:28', '2021-11-15 11:12:28'),
(70, 139, 'b52ca0b3d54999b255cb347c0112d6ab', NULL, 1, '2021-11-26 13:46:43', '2021-11-26 13:46:43'),
(71, 83453, '6f8a26cb26702dbb17706390693f7ad5', NULL, 1, '2021-11-30 08:04:41', '2021-11-30 08:04:41'),
(72, 11933, 'a3f6cc4ad47db2722cae84bcd7913762', NULL, 1, '2021-11-30 08:21:00', '2021-11-30 08:21:00'),
(73, 139, '621f6a41de56d096e5be5391519cf292', NULL, 1, '2021-11-30 10:27:32', '2021-11-30 10:27:32'),
(74, 12475, 'd914c85041e90391c993495fcde3f402', NULL, 1, '2021-11-30 10:47:48', '2021-11-30 10:47:48'),
(75, 71857, '333b8fda2f408affd7af9e1fd47e0016', NULL, 1, '2021-11-30 13:09:30', '2021-11-30 13:09:30'),
(76, 140, '6470880e58e65151dba99cddca314f6b', NULL, 1, '2021-11-30 13:24:43', '2021-11-30 13:24:43'),
(77, 141, 'd638c581617e11797ca262411ccbfafb', NULL, 1, '2021-11-30 13:25:15', '2021-11-30 13:25:15'),
(78, 142, '3a68c1d2ebc0146d79ffdad737a8c687', NULL, 1, '2021-11-30 14:32:16', '2021-11-30 14:32:16'),
(79, 141, '17b920034cd61d51a64e0f2787a6a834', NULL, 1, '2021-12-01 10:09:33', '2021-12-01 10:09:33'),
(80, 141, '75ef40c5bd9d659c09569d39bf782441', NULL, 1, '2021-12-01 10:10:01', '2021-12-01 10:10:01'),
(81, 141, 'ea6a12646a75adcfdd6d2cdd417f26be', NULL, 1, '2021-12-01 10:11:44', '2021-12-01 10:11:44'),
(82, 141, '3a2b9f6eabc8411fa2d06f5f127ea446', NULL, 1, '2021-12-01 10:11:53', '2021-12-01 10:11:53'),
(83, 141, 'b112fc9693635a88af8427c42f7a01ac', NULL, 1, '2021-12-01 10:12:46', '2021-12-01 10:12:46'),
(84, 143, 'ad946a0f5d64cdf3591d172842a7312c', NULL, 1, '2021-12-01 10:31:30', '2021-12-01 10:31:30'),
(85, 144, 'f4f619a2904153da1621f915aeac70b6', NULL, 1, '2021-12-01 10:32:20', '2021-12-01 10:32:20'),
(86, 145, 'eae62e3b33032af53474b30bcf972420', NULL, 1, '2021-12-02 08:09:22', '2021-12-02 08:09:22'),
(87, 146, '3593936d3cfce0a7b41c1493b2511263', NULL, 1, '2021-12-06 07:27:10', '2021-12-06 07:27:10'),
(88, 146, '80bad7bd5936b22de48c2cf1509dfc03', NULL, 1, '2021-12-06 07:27:26', '2021-12-06 07:27:26'),
(89, 146, 'ca99aea971aeea33a8d6765820311464', NULL, 1, '2021-12-06 07:27:36', '2021-12-06 07:27:36'),
(90, 147, 'd0e2e094985e3b91f1a16cfc02cc13f0', NULL, 1, '2021-12-06 07:46:40', '2021-12-06 07:46:40'),
(91, 147, '21ad3e5da534782270bd1792e466e329', NULL, 1, '2021-12-06 07:47:12', '2021-12-06 07:47:12'),
(92, 147, '43430083f873485c2a5faf513f54c892', NULL, 1, '2021-12-06 07:48:59', '2021-12-06 07:48:59'),
(93, 147, 'a740151c38f8d8190d93ee3d0bf7c103', NULL, 1, '2021-12-06 07:49:25', '2021-12-06 07:49:25'),
(94, 147, '318c7c1fa3cc90d555b772c138edfe35', NULL, 1, '2021-12-06 07:49:39', '2021-12-06 07:49:39'),
(95, 30460, '33f5ef08861e7cfe09e2fc8de43d76f8', NULL, 1, '2021-12-06 08:06:00', '2021-12-06 08:06:00'),
(96, 145, 'edaf2d0d5740ca905b24cc9fcbc1f825', NULL, 1, '2021-12-06 08:18:10', '2021-12-06 08:18:10'),
(97, 145, 'e96d00d0eb6b1859811f2fe4f45476a2', NULL, 1, '2021-12-06 08:23:48', '2021-12-06 08:23:48'),
(98, 44444, 'dfe3dce505de975b4b814e2ca0da5c17', NULL, 1, '2021-12-06 08:26:22', '2021-12-06 08:26:22'),
(99, 145, 'e585b18ea3d41d971ce2462ea7c7e20b', NULL, 1, '2021-12-06 09:01:17', '2021-12-06 09:01:17'),
(100, 148, '9ef236689c6e34bf163a788af728d6d1', NULL, 1, '2021-12-06 09:06:58', '2021-12-06 09:06:58'),
(101, 148, 'f534969690050d1f07d7b3a8f5889e7a', NULL, 1, '2021-12-06 09:11:46', '2021-12-06 09:11:46'),
(102, 139, 'd5c8659227650520cc5caad5c1582528', NULL, 1, '2021-12-06 09:12:02', '2021-12-06 09:12:02'),
(103, 139, 'ab27e602edf244769bdc227de58d962f', NULL, 1, '2021-12-06 09:12:58', '2021-12-06 09:12:58'),
(104, 139, '37736ba5f00d3a9a34aacdb8bec91fb2', NULL, 1, '2021-12-06 09:18:16', '2021-12-06 09:18:16'),
(105, 149, '5aadf2ba3a969e1e7e8cc1f1ec31ff99', NULL, 1, '2021-12-06 09:19:47', '2021-12-06 09:19:47'),
(106, 149, '28b4875064d593011810803666ed882b', NULL, 1, '2021-12-06 09:20:23', '2021-12-06 09:20:23'),
(107, 14448, '3a9234d129e605837e00c9d738ef0793', NULL, 1, '2021-12-06 09:59:50', '2021-12-06 09:59:50'),
(108, 150, 'c3903cc8852c2e1a0b96a9970f72053b', NULL, 1, '2022-03-10 10:09:52', '2022-03-10 10:09:52'),
(109, 150, '68e898df4d4aefae7f03b94dc4b05ee4', NULL, 1, '2022-03-10 10:10:59', '2022-03-10 10:10:59'),
(110, 48826, '8bd6591ee128c09e2192c5baab0371db', NULL, 1, '2022-03-10 10:55:13', '2022-03-10 10:55:13'),
(111, 151, '345cde3f9393e89e8a053cbaada0e42c', NULL, 1, '2022-03-16 10:12:33', '2022-03-16 10:12:33'),
(112, 151, '30f66eebf2f8d232bc7e24a0957c94fb', NULL, 1, '2022-03-16 10:18:48', '2022-03-16 10:18:48'),
(113, 19992, '651862dd6c6ab8e9ff2f75401a994503', NULL, 1, '2022-03-17 04:51:50', '2022-03-17 04:51:50');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_price` double(10,2) DEFAULT '0.00' COMMENT 'Total Price of Order',
  `discount` double(10,2) DEFAULT '0.00' COMMENT 'Discount Given for Order',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 = Inactive,1 = Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `first_name`, `last_name`, `location`, `description`, `phone`, `total_price`, `discount`, `status`, `created_at`, `updated_at`) VALUES
(1, 120, 'This is Test Job Title From User Test', 'This is Test Job Details', NULL, 'Test Job Here', '051', 4.00, 0.00, 1, '2021-10-02 06:20:51', '2021-10-02 06:20:51'),
(2, 120, 'This is Test Job Title From User Test', 'This is Test Job Details', NULL, 'Test Job Here', '051', 4.00, 0.00, 1, '2021-10-02 06:21:45', '2021-10-02 06:21:45'),
(3, 120, 'This is Test Job Title From User Test', 'This is Test Job Details', NULL, 'Test Job Here', '051', 4.00, 0.00, 1, '2021-10-05 07:36:32', '2021-10-05 07:36:32'),
(4, 120, 'This is Test Job Title From User Test', 'This is Test Job Details', NULL, 'Test Job Here', '051', 4.00, 0.00, 1, '2021-10-05 07:58:43', '2021-10-05 07:58:43'),
(5, 133, 'Zaid', 'Qureshi', NULL, NULL, '0', 225.00, 0.00, 1, '2021-10-05 08:05:33', '2021-10-05 08:05:33'),
(6, 133, 'Zaid', 'Qureshi', NULL, NULL, '0', 225.00, 0.00, 2, '2021-10-05 08:06:03', '2021-10-26 10:15:09'),
(7, 133, 'Zaid', 'Qureshi', NULL, NULL, '0', 225.00, 0.00, 1, '2021-10-05 08:15:58', '2021-10-05 08:15:58'),
(8, 133, 'Zaid', 'Qureshi', NULL, NULL, '0', 225.00, 0.00, 1, '2021-10-05 08:23:00', '2021-10-05 08:23:00'),
(9, 133, 'Zaid', 'Qureshi', NULL, NULL, '0', 100.00, 0.00, 1, '2021-10-05 08:25:25', '2021-10-05 08:25:25'),
(10, 133, 'Zaid', 'Qureshi', NULL, NULL, '0', 100.00, 0.00, 1, '2021-10-05 08:25:43', '2021-10-05 08:25:43'),
(11, 133, 'Zaid', 'Qureshi', NULL, NULL, '0', 125.00, 0.00, 1, '2021-10-05 08:28:46', '2021-10-05 08:28:46'),
(12, 134, 'Zaid', 'Qureshi', NULL, NULL, '0', 925.00, 0.00, 1, '2021-10-05 09:59:45', '2021-10-05 09:59:45'),
(13, 134, 'Muhammad', 'Qureshi', NULL, NULL, '0', 125.00, 0.00, 1, '2021-10-05 10:02:06', '2021-10-05 10:02:06'),
(14, 134, 'Muhammad', 'Qureshi', NULL, NULL, '0', 125.00, 0.00, 1, '2021-10-05 10:02:22', '2021-10-05 10:02:22'),
(15, 134, 'Muhammad', 'Qureshi', NULL, NULL, '0', 125.00, 0.00, 1, '2021-10-05 10:02:37', '2021-10-05 10:02:37'),
(16, 137, 'Zaid', 'Qureshi', NULL, NULL, '0', 125.00, 0.00, 1, '2021-10-06 06:12:17', '2021-10-06 06:12:17'),
(17, 55230, 'Guest', 'User_55230', NULL, NULL, '0', 100.00, 0.00, 1, '2021-10-06 06:16:30', '2021-10-06 06:16:30'),
(18, 14458, 'Guest', 'User_14458', NULL, NULL, '0', 100.00, 0.00, 1, '2021-10-06 10:20:31', '2021-10-06 10:20:31'),
(19, 138, 'Zaid', 'Qureshi', NULL, NULL, '0', 100.00, 0.00, 1, '2021-10-06 10:23:49', '2021-10-06 10:23:49'),
(20, 12666, 'Guest', 'User_12666', NULL, NULL, '0', 250.00, 0.00, 1, '2021-10-06 15:01:24', '2021-10-06 15:01:24'),
(21, 87634, 'Guest', 'User_87634', NULL, NULL, '0', 500.00, 0.00, 1, '2021-10-06 15:21:57', '2021-10-06 15:21:57'),
(22, 81023, 'Guest', 'User_81023', NULL, NULL, '0', 375.00, 0.00, 1, '2021-10-06 16:10:53', '2021-10-06 16:10:53'),
(23, 120, 'This is Test Job Title From User Test', 'This is Test Job Details', NULL, 'Test Job Here', '051', 4.00, 0.00, 1, '2021-10-07 04:27:05', '2021-10-07 04:27:05'),
(24, 65052, 'Guest', 'User_65052', NULL, NULL, '0', 100.00, 0.00, 6, '2021-10-07 07:12:36', '2022-03-16 10:14:22'),
(25, 98848, 'Guest', 'User_98848', NULL, NULL, '0', 100.00, 0.00, 6, '2021-10-08 02:40:06', '2022-03-16 10:14:12'),
(26, 80919, 'Guest', 'User_80919', NULL, NULL, '0', 125.00, 0.00, 1, '2021-10-10 06:09:38', '2021-10-10 06:09:38'),
(27, 139, 'Muhammad', 'Qureshi', NULL, NULL, '0', 500.00, 0.00, 1, '2021-10-13 08:16:18', '2021-10-13 08:16:18'),
(28, 120, 'This is Test Job Title From User Test', 'This is Test Job Details', NULL, 'Test Job Here', '051', 4.00, 0.00, 1, '2021-10-13 08:58:44', '2021-10-13 08:58:44'),
(29, 120, 'This is Test Job Title From User Test', 'This is Test Job Details', NULL, 'Test Job Here', '051', 4.00, 0.00, 1, '2021-10-13 08:58:50', '2021-10-13 08:58:50'),
(30, 120, 'This is Test Job Title From User Test', 'This is Test Job Details', NULL, 'Test Job Here', '051', 4.00, 0.00, 1, '2021-10-15 03:27:43', '2021-10-15 03:27:43'),
(31, 120, 'This is Test Job Title From User Test', 'This is Test Job Details', NULL, 'Test Job Here', '051', 4.00, 0.00, 1, '2021-10-15 03:27:49', '2021-10-15 03:27:49'),
(32, 139, 'Muhammad', 'Qureshi', NULL, NULL, '0', 725.00, 0.00, 1, '2021-10-15 03:56:20', '2021-10-15 03:56:20'),
(33, 139, 'Muhammad', 'Qureshi', NULL, NULL, '0', 375.00, 0.00, 1, '2021-10-15 10:45:51', '2021-10-15 10:45:51'),
(34, 139, 'Muhammad', 'Qureshi', NULL, NULL, '0', 775.00, 0.00, 1, '2021-10-15 16:12:17', '2021-10-15 16:12:17'),
(35, 32214, 'Guest', 'User_32214', NULL, NULL, '0', 100.00, 0.00, 6, '2021-10-15 16:14:09', '2021-10-26 10:22:40'),
(36, 29722, 'Guest', 'User_29722', NULL, NULL, '0', 375.00, 0.00, 5, '2021-10-15 16:28:06', '2021-10-26 10:14:52'),
(39, 139, 'Test', 'Test', NULL, NULL, NULL, 530.00, 0.00, 1, '2021-11-23 10:35:26', '2021-11-23 10:35:26'),
(40, 139, 'Test', 'Test', NULL, NULL, NULL, 530.00, 0.00, 1, '2021-11-23 10:46:13', '2021-11-23 10:46:13'),
(41, 139, 'Muhammad', 'Qureshi', NULL, NULL, '0', 500.00, 0.00, 1, '2021-11-26 14:25:31', '2021-11-26 14:25:31'),
(42, 139, 'Muhammad', 'Zaid', NULL, NULL, '0', 750.00, 0.00, 1, '2021-11-30 07:35:14', '2021-11-30 07:35:14'),
(43, 139, 'Muhammad', 'Zaid', NULL, NULL, '0', 500.00, 0.00, 1, '2021-11-30 07:48:54', '2021-11-30 07:48:54'),
(44, 120, 'This is Test Job Title From User Test', 'This is Test Job Details', NULL, 'Test Job Here', '051', 4.00, 0.00, 1, '2021-11-30 08:19:33', '2021-11-30 08:19:33'),
(45, 120, 'This is Test Job Title From User Test', 'This is Test Job Details', NULL, 'Test Job Here', '051', 4.00, 0.00, 1, '2021-11-30 08:20:16', '2021-11-30 08:20:16'),
(46, 11933, 'Guest', 'User_11933', NULL, NULL, '0', 500.00, 0.00, 6, '2021-11-30 10:02:37', '2022-03-16 10:24:58'),
(47, 11933, 'Guest', 'User_11933', NULL, NULL, '0', 500.00, 0.00, 6, '2021-11-30 10:04:48', '2022-03-16 10:24:53'),
(48, 11933, 'Guest', 'User_11933', NULL, NULL, '0', 600.00, 0.00, 6, '2021-11-30 10:24:23', '2022-03-16 10:24:50'),
(49, 12475, 'Guest', 'User_12475', NULL, NULL, '0', 100.00, 0.00, 6, '2021-11-30 10:48:28', '2022-03-16 10:15:11'),
(50, 12475, 'Guest', 'User_12475', NULL, NULL, '0', 600.00, 0.00, 6, '2021-11-30 11:30:31', '2022-03-16 10:15:07'),
(51, 71857, 'Guest', 'User_71857', NULL, NULL, '0', 100.00, 0.00, 6, '2021-11-30 13:09:53', '2022-03-16 10:15:05'),
(52, 144, 'Zaid', 'User_144', NULL, NULL, '0', 500.00, 0.00, 6, '2021-12-01 10:33:57', '2022-03-16 10:15:02'),
(53, 30460, 'Guest', 'User_30460', NULL, NULL, '0', 100.00, 0.00, 6, '2021-12-06 08:06:19', '2022-03-16 10:15:00'),
(54, 139, 'Muhammad', 'Zai', NULL, NULL, '0', 100.00, 0.00, 6, '2021-12-06 09:13:26', '2022-03-16 10:14:29'),
(55, 139, 'Muhammad', 'Zai', NULL, NULL, '0', 500.00, 0.00, 6, '2021-12-06 09:18:32', '2022-03-16 10:14:25'),
(56, 151, 'Shariq', 'Ismail', NULL, NULL, '0', 100.00, 0.00, 6, '2022-03-16 10:15:33', '2022-03-16 10:24:43'),
(57, 151, 'Shariq', 'Ismail', NULL, NULL, '0', 190.00, 0.00, 1, '2022-03-16 10:33:09', '2022-03-16 10:33:09'),
(58, 19992, 'Guest', 'User_19992', NULL, NULL, '0', 500.00, 0.00, 1, '2022-03-17 04:52:58', '2022-03-17 04:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `discount_given` tinyint(1) DEFAULT '0',
  `discount_amount` double(10,2) NOT NULL DEFAULT '0.00',
  `price` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `discount_given`, `discount_amount`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 0, 0.00, 0.00, '2021-10-02 06:20:51', '2021-10-02 06:20:51'),
(2, 2, 1, 2, 0, 0.00, 0.00, '2021-10-02 06:21:45', '2021-10-02 06:21:45'),
(3, 3, 1, 2, 0, 0.00, 0.00, '2021-10-05 07:36:32', '2021-10-05 07:36:32'),
(4, 4, 1, 2, 0, 0.00, 0.00, '2021-10-05 07:58:43', '2021-10-05 07:58:43'),
(5, 7, 2, 1, 0, 0.00, 0.00, '2021-10-05 08:15:58', '2021-10-05 08:15:58'),
(6, 7, 1, 1, 0, 0.00, 0.00, '2021-10-05 08:15:58', '2021-10-05 08:15:58'),
(7, 8, 2, 1, 0, 0.00, 0.00, '2021-10-05 08:23:00', '2021-10-05 08:23:00'),
(8, 8, 1, 1, 0, 0.00, 0.00, '2021-10-05 08:23:00', '2021-10-05 08:23:00'),
(9, 9, 2, 1, 0, 0.00, 0.00, '2021-10-05 08:25:25', '2021-10-05 08:25:25'),
(10, 10, 2, 1, 0, 0.00, 0.00, '2021-10-05 08:25:43', '2021-10-05 08:25:43'),
(11, 11, 1, 1, 0, 0.00, 0.00, '2021-10-05 08:28:46', '2021-10-05 08:28:46'),
(12, 12, 1, 1, 0, 0.00, 0.00, '2021-10-05 09:59:45', '2021-10-05 09:59:45'),
(13, 12, 2, 8, 0, 0.00, 0.00, '2021-10-05 09:59:45', '2021-10-05 09:59:45'),
(14, 13, 1, 1, 0, 0.00, 0.00, '2021-10-05 10:02:06', '2021-10-05 10:02:06'),
(15, 14, 1, 1, 0, 0.00, 0.00, '2021-10-05 10:02:22', '2021-10-05 10:02:22'),
(16, 15, 1, 1, 0, 0.00, 0.00, '2021-10-05 10:02:37', '2021-10-05 10:02:37'),
(17, 16, 1, 1, 0, 0.00, 0.00, '2021-10-06 06:12:17', '2021-10-06 06:12:17'),
(18, 17, 2, 1, 0, 0.00, 0.00, '2021-10-06 06:16:30', '2021-10-06 06:16:30'),
(19, 18, 2, 1, 0, 0.00, 0.00, '2021-10-06 10:20:31', '2021-10-06 10:20:31'),
(20, 19, 2, 1, 0, 0.00, 0.00, '2021-10-06 10:23:49', '2021-10-06 10:23:49'),
(21, 20, 1, 2, 0, 0.00, 0.00, '2021-10-06 15:01:24', '2021-10-06 15:01:24'),
(22, 21, 1, 4, 0, 0.00, 0.00, '2021-10-06 15:21:57', '2021-10-06 15:21:57'),
(23, 22, 1, 3, 0, 0.00, 0.00, '2021-10-06 16:10:53', '2021-10-06 16:10:53'),
(24, 23, 1, 2, 0, 0.00, 0.00, '2021-10-07 04:27:05', '2021-10-07 04:27:05'),
(25, 24, 2, 1, 0, 0.00, 0.00, '2021-10-07 07:12:36', '2021-10-07 07:12:36'),
(26, 25, 2, 1, 0, 0.00, 0.00, '2021-10-08 02:40:06', '2021-10-08 02:40:06'),
(27, 26, 1, 1, 0, 0.00, 0.00, '2021-10-10 06:09:38', '2021-10-10 06:09:38'),
(28, 27, 3, 1, 0, 0.00, 0.00, '2021-10-13 08:16:18', '2021-10-13 08:16:18'),
(29, 28, 1, 2, 0, 0.00, 0.00, '2021-10-13 08:58:44', '2021-10-13 08:58:44'),
(30, 29, 1, 2, 0, 0.00, 0.00, '2021-10-13 08:58:50', '2021-10-13 08:58:50'),
(31, 30, 1, 2, 0, 0.00, 0.00, '2021-10-15 03:27:43', '2021-10-15 03:27:43'),
(32, 31, 1, 2, 0, 0.00, 0.00, '2021-10-15 03:27:49', '2021-10-15 03:27:49'),
(33, 32, 1, 1, 0, 0.00, 0.00, '2021-10-15 03:56:20', '2021-10-15 03:56:20'),
(34, 32, 2, 1, 0, 0.00, 0.00, '2021-10-15 03:56:20', '2021-10-15 03:56:20'),
(35, 32, 3, 1, 0, 0.00, 0.00, '2021-10-15 03:56:20', '2021-10-15 03:56:20'),
(36, 33, 1, 3, 0, 0.00, 0.00, '2021-10-15 10:45:51', '2021-10-15 10:45:51'),
(37, 34, 1, 3, 0, 0.00, 0.00, '2021-10-15 16:12:17', '2021-10-15 16:12:17'),
(38, 34, 2, 4, 0, 0.00, 0.00, '2021-10-15 16:12:17', '2021-10-15 16:12:17'),
(39, 35, 2, 1, 0, 0.00, 0.00, '2021-10-15 16:14:09', '2021-10-15 16:14:09'),
(40, 36, 1, 3, 0, 0.00, 0.00, '2021-10-15 16:28:06', '2021-10-15 16:28:06'),
(41, 38, 1, 24, NULL, 0.00, 250.00, '2021-11-23 10:28:56', '2021-11-23 10:28:56'),
(42, 39, 1, 24, NULL, 0.00, 250.00, '2021-11-23 10:35:26', '2021-11-23 10:35:26'),
(43, 39, 2, 2, NULL, 0.00, 280.00, '2021-11-23 10:35:26', '2021-11-23 10:35:26'),
(44, 40, 1, 24, 0, 0.00, 250.00, '2021-11-23 10:46:13', '2021-11-23 10:46:13'),
(45, 40, 2, 2, 0, 0.00, 250.00, '2021-11-23 10:46:13', '2021-11-23 10:46:13'),
(46, 43, 1, 4, 0, 0.00, 500.00, '2021-11-30 07:48:54', '2021-11-30 07:48:54'),
(47, 44, 1, 2, 0, 0.00, 20.00, '2021-11-30 08:19:33', '2021-11-30 08:19:33'),
(48, 45, 1, 2, 0, 0.00, 20.00, '2021-11-30 08:20:16', '2021-11-30 08:20:16'),
(49, 46, 3, 1, 0, 0.00, 500.00, '2021-11-30 10:02:37', '2021-11-30 10:02:37'),
(50, 47, 3, 1, 0, 0.00, 500.00, '2021-11-30 10:04:48', '2021-11-30 10:04:48'),
(51, 48, 2, 1, 0, 0.00, 100.00, '2021-11-30 10:24:23', '2021-11-30 10:24:23'),
(52, 48, 3, 1, 0, 0.00, 500.00, '2021-11-30 10:24:23', '2021-11-30 10:24:23'),
(53, 49, 2, 1, 0, 0.00, 100.00, '2021-11-30 10:48:28', '2021-11-30 10:48:28'),
(54, 50, 2, 1, 0, 0.00, 100.00, '2021-11-30 11:30:31', '2021-11-30 11:30:31'),
(55, 50, 3, 1, 0, 0.00, 500.00, '2021-11-30 11:30:31', '2021-11-30 11:30:31'),
(56, 51, 2, 1, 0, 0.00, 100.00, '2021-11-30 13:09:53', '2021-11-30 13:09:53'),
(57, 52, 3, 1, 0, 0.00, 500.00, '2021-12-01 10:33:57', '2021-12-01 10:33:57'),
(58, 53, 2, 1, 0, 0.00, 100.00, '2021-12-06 08:06:19', '2021-12-06 08:06:19'),
(59, 54, 2, 1, 0, 0.00, 100.00, '2021-12-06 09:13:26', '2021-12-06 09:13:26'),
(60, 55, 2, 5, 0, 0.00, 500.00, '2021-12-06 09:18:32', '2021-12-06 09:18:32'),
(61, 56, 2, 1, 0, 0.00, 100.00, '2022-03-16 10:15:33', '2022-03-16 10:15:33'),
(62, 57, 1, 1, 0, 0.00, 190.00, '2022-03-16 10:33:09', '2022-03-16 10:33:09'),
(63, 58, 3, 1, 0, 0.00, 500.00, '2022-03-17 04:52:58', '2022-03-17 04:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int(4) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `discount_quantity` int(4) DEFAULT NULL,
  `discount_amount` int(4) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `description`, `image`, `stock`, `price`, `discount_quantity`, `discount_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'G-Eggs', 'Farm Fresh Desi Eggs', NULL, 99, 190, 24, 6, 1, '2021-10-02 06:01:58', '2022-03-16 10:33:09'),
(2, 1, 'G-Milk', 'Farm Fresh Cow Milk, Un-Boiled', NULL, 49, 140, 1, 0, 1, '2021-10-05 07:06:32', '2022-03-16 10:15:33'),
(3, 2, 'G-Meat (Desi Chicken)', 'Desi Chicken Meat, Live Weight', NULL, 19, 500, 3, 5, 1, '2021-10-07 03:08:12', '2022-03-17 04:52:58'),
(4, 1, 'G-Quail', 'Quail Meat, Price is per piece', NULL, 100, 110, 6, 5, 1, '2022-03-16 10:07:28', '2022-03-16 10:16:41'),
(5, 2, 'G-Mutton', 'Farm Fresh Goat Meat', NULL, 0, 1600, 4, 5, 1, '2022-03-16 10:08:09', '2022-03-16 10:08:09');

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE `userroles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userroles`
--

INSERT INTO `userroles` (`id`, `role_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 1, '2021-03-29 07:14:36', '2021-03-29 07:14:36'),
(2, 'user', 1, '2021-03-29 07:14:36', '2021-03-29 07:14:36'),
(3, 'merchant', 1, '2021-03-29 07:14:36', '2021-03-29 07:14:36'),
(4, 'organization', 1, '2021-04-09 06:48:18', '2021-04-09 06:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization` int(11) DEFAULT NULL,
  `remember_token` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `phone`, `username`, `role_id`, `status`, `email_verified_at`, `password`, `organization`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@admin.com', NULL, 'admin', 1, 1, NULL, '$2y$10$dJEfFaVZEPwvyLvM5dOGXuT7aj.wTEYRs9su7tPkUqHCpozsqu5Om', NULL, NULL, '2021-03-29 07:14:36', '2021-03-29 07:14:36'),
(139, 'qzaid797@gmail.com', NULL, NULL, 2, 2, NULL, 'eyJhbGciOiJSUzI1NiIsImtpZCI6ImY0MTk2YWVlMTE5ZmUyMTU5M2Q0OGJmY2ZiNWJmMDAxNzdkZDRhNGQiLCJ0eXAiOiJKV1QifQ.eyJpc3MiOiJodHRwczovL2FjY291bnRzLmdvb2dsZS5jb20iLCJhenAiOiIxMDc1NDU1NTgyMzM2LTAxaWFsanVmYmUzZjFhMHNyNWcyYnZpN2phcDlncXVsLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiYXVkIjoiMTA3NTQ1NTU4MjMzNi01MzlpZm9obzIyMWEwZGpubDMxdXU2cDlrcjdlb3Zzai5hcHBzLmdvb2dsZXVzZXJjb250ZW50LmNvbSIsInN1YiI6IjExODE0NzAyMTcwMTU0NjA4NDE3MCIsImVtYWlsIjoicXphaWQ3OTdAZ21haWwuY29tIiwiZW1haWxfdmVyaWZpZWQiOnRydWUsIm5hbWUiOiJaYWlkIFF1cmVzaGkiLCJwaWN0dXJlIjoiaHR0cHM6Ly9saDMuZ29vZ2xldXNlcmNvbnRlbnQuY29tL2EtL0FPaDE0R2pxYXFxVkZpSjdMQUZPQTBfdGZBUG9FT25FMVlnUTgtNERjdlA2Qnc9czk2LWMiLCJnaXZlbl9uYW1lIjoiWmFpZCIsImZhbWlseV9uYW1lIjoiUXVyZXNoaSIsImxvY2FsZSI6ImVuIiwiaWF0IjoxNjMzNTQwOTg4LCJleHAiOjE2MzM1NDQ1ODh9.CUpTZcbGrdJM7tCTcnyxmQQfuU6gFHCFScZpCkPk-OA0envlwhYDqMXaeSkRwFKI4HjPxQeugkTBIhk_FY38_vOaBTuEVwbJ1rBz_FrazduamCI28fvZvUg45IzyZQCa1NyJdKh_MWIo2iVndhWIpOeWGsf74_LDWySiH3ItHY4FaGGCKQcZIoNQPVSTwdDlxkHe7Ow3ECX7OG-Ix6xLUS3x5cHn1J3xUxBP2BTw90sBojUy1cO4E8jK-uGvNrn4FxQjxuEfXe1oArFRj59qX5M8C9msHp_pzqAmdBYXyHxymIZ4m4p4vuzqRjLJpstgpX3d4lYzeEoQa35FP3iGDQ', NULL, 'eyJhbGciOiJSUzI1NiIsImtpZCI6ImY0MTk2YWVlMTE5ZmUyMTU5M2Q0OGJmY2ZiNWJmMDAxNzdkZDRhNGQiLCJ0eXAiOiJKV1QifQ.eyJpc3MiOiJodHRwczovL2FjY291bnRzLmdvb2dsZS5jb20iLCJhenAiOiIxMDc1NDU1NTgyMzM2LTAxaWFsanVmYmUzZjFhMHNyNWcyYnZpN2phcDlncXVsLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiYXVkIjoiMTA3NTQ1NTU4MjMzNi01MzlpZm9obzIyMWEwZGpubDMxdXU2cDlrcjdlb3Zzai5hcHBzLmdvb2dsZXVzZXJjb250ZW50LmNvbSIsInN1YiI6IjExODE0NzAyMTcwMTU0NjA4NDE3MCIsImVtYWlsIjoicXphaWQ3OTdAZ21haWwuY29tIiwiZW1haWxfdmVyaWZpZWQiOnRydWUsIm5hbWUiOiJaYWlkIFF1cmVzaGkiLCJwaWN0dXJlIjoiaHR0cHM6Ly9saDMuZ29vZ2xldXNlcmNvbnRlbnQuY29tL2EtL0FPaDE0R2pxYXFxVkZpSjdMQUZPQTBfdGZBUG9FT25FMVlnUTgtNERjdlA2Qnc9czk2LWMiLCJnaXZlbl9uYW1lIjoiWmFpZCIsImZhbWlseV9uYW1lIjoiUXVyZXNoaSIsImxvY2FsZSI6ImVuIiwiaWF0IjoxNjMzNTQwOTg4LCJleHAiOjE2MzM1NDQ1ODh9.CUpTZcbGrdJM7tCTcnyxmQQfuU6gFHCFScZpCkPk-OA0envlwhYDqMXaeSkRwFKI4HjPxQeugkTBIhk_FY38_vOaBTuEVwbJ1rBz_FrazduamCI28fvZvUg45IzyZQCa1NyJdKh_MWIo2iVndhWIpOeWGsf74_LDWySiH3ItHY4FaGGCKQcZIoNQPVSTwdDlxkHe7Ow3ECX7OG-Ix6xLUS3x5cHn1J3xUxBP2BTw90sBojUy1cO4E8jK-uGvNrn4FxQjxuEfXe1oArFRj59qX5M8C9msHp_pzqAmdBYXyHxymIZ4m4p4vuzqRjLJpstgpX3d4lYzeEoQa35FP3iGDQ', '2021-10-06 15:23:46', '2022-03-12 08:01:54'),
(140, 'yiloko2680@animex198.com123', '03001123432123', 'testuser43211123', 2, 2, NULL, '$2y$10$Of3d8OUrD.aKEwLv9kNPBOt7KxPM7Cf7aXUOq3kH./x1Sr35obUEu', NULL, NULL, '2021-11-30 13:24:43', '2022-03-12 08:02:18'),
(141, 'yiloko2680@animex198.co24573', NULL, NULL, 2, 2, NULL, '1234567890', NULL, '1234567890', '2021-11-30 13:25:15', '2022-03-12 08:02:23'),
(142, 'yiloko2680@animex198.com1234', '0300112343212367', 'testuser432111234', 2, 2, NULL, '$2y$10$EwB4d4LYaR5gnJwPwE3EjOp1zrrygWleQ4/.sfGRqJ3lMSPEpMbBS', NULL, NULL, '2021-11-30 14:32:16', '2022-03-12 08:02:29'),
(143, 'Qzaid97@gmail.com', 'Qzaid97@gmail.com', 'Qureshi797', 2, 2, NULL, '$2y$10$xvM3MToqE6BwoKDQAJNDcudQTCMvXWKZH1wenqOIYvjBxacOJKhiC', NULL, NULL, '2021-12-01 10:31:30', '2022-03-12 08:02:35'),
(144, 'Qzai97@gmail.com', 'Qzai97@gmail.com', 'Qureshi79h', 2, 2, NULL, '$2y$10$JxOSqbSoTKiiIHVYLzqSl.YVrrmoqSQv/5EXqzNhEr2QusszUK3qO', NULL, NULL, '2021-12-01 10:32:20', '2022-03-16 10:10:44'),
(145, 'yiloko2680@animex198.co', NULL, NULL, 2, 2, NULL, '654654sd65f4ds65f4sd56f465sd4f65sd4f65sd4f6ds5', NULL, '654654sd65f4ds65f4sd56f465sd4f65sd4f65sd4f6ds5', '2021-12-02 08:09:22', '2022-03-16 10:10:47'),
(146, 'user@test.com', '123321', 'testqwe', 2, 2, NULL, '$2y$10$XQRcS9MBYyEpF.b/1XHn8OrWBEwtgM8aF6mehoNbmSIb0c8B1yDUm', NULL, NULL, '2021-12-06 07:27:10', '2022-03-16 10:10:51'),
(147, 'qzaid@gmail.coo', 'qzaid@gmail.coo', 'Qureshi', 2, 2, NULL, '$2y$10$MTXOblVhdTkA0Gk2GzVdIOGDz/IorQXJhKxJWz.EwyBDbDlw7SzeS', NULL, NULL, '2021-12-06 07:46:40', '2022-03-16 10:10:55'),
(148, 'qzaid45@gmail.com', NULL, NULL, 2, 2, NULL, 'eyJhbGciOiJSUzI1NiIsImtpZCI6IjkzNDFhYmM0MDkyYjZmYz…kP9hWWL9vg_YRnefEXXoMve87iXSvhjdCZg7TUBl3gJYgWrLA', NULL, 'eyJhbGciOiJSUzI1NiIsImtpZCI6IjkzNDFhYmM0MDkyYjZmYz…kP9hWWL9vg_YRnefEXXoMve87iXSvhjdCZg7TUBl3gJYgWrLA', '2021-12-06 09:06:58', '2022-03-16 10:10:58'),
(149, 'q@gmail.com', 'q@gmail.com', 'Q', 2, 2, NULL, '$2y$10$7uptJY7P8RFPzP0.XxdfIOFmY.0dKrMvMInWendvH7ytUzV.XCLbO', NULL, NULL, '2021-12-06 09:19:47', '2022-03-16 10:11:03'),
(150, 'org45@groom.com4', '0300112343231245', 'org345', 3, 1, NULL, '$2y$10$fkfszOE18PgU64YKgtc/JOV7SOO/mGSm54CCtEstarOFGfYOCPDw.', NULL, NULL, '2022-03-10 10:09:52', '2022-03-10 10:09:52'),
(151, 'shariqismail86@gmail.com', NULL, NULL, 2, 1, NULL, 'eyJhbGciOiJSUzI1NiIsImtpZCI6ImQ2M2RiZTczYWFkODhjODU0ZGUwZDhkNmMwMTRjMzZkYzI1YzQyOTIiLCJ0eXAiOiJKV1QifQ.eyJpc3MiOiJodHRwczovL2FjY291bnRzLmdvb2dsZS5jb20iLCJhenAiOiIxMDc1NDU1NTgyMzM2LTAxaWFsanVmYmUzZjFhMHNyNWcyYnZpN2phcDlncXVsLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiYXVkIjoiMTA3NTQ1NTU4MjMzNi01MzlpZm9obzIyMWEwZGpubDMxdXU2cDlrcjdlb3Zzai5hcHBzLmdvb2dsZXVzZXJjb250ZW50LmNvbSIsInN1YiI6IjEwNDYwMzM4ODc0ODMzMDI3MTc4MSIsImVtYWlsIjoic2hhcmlxaXNtYWlsODZAZ21haWwuY29tIiwiZW1haWxfdmVyaWZpZWQiOnRydWUsIm5hbWUiOiJTaGFyaXEgSXNtYWlsIiwicGljdHVyZSI6Imh0dHBzOi8vbGgzLmdvb2dsZXVzZXJjb250ZW50LmNvbS9hLS9BT2gxNEdqdm9rNnJOU1lqYlEwaVBoUU9DcTNmbVpCOEw4c1RHU1lVdmRuZ3pnPXM5Ni1jIiwiZ2l2ZW5fbmFtZSI6IlNoYXJpcSIsImZhbWlseV9uYW1lIjoiSXNtYWlsIiwibG9jYWxlIjoiZW4tR0IiLCJpYXQiOjE2NDc0MjkxNTEsImV4cCI6MTY0NzQzMjc1MX0.Z-c9pTR-ZpfYg3tqqz0ORZNHD7cJdl7CkLclX34JX7R5nW6kToAnN7xnYcPRPD4Fs_IlBcXwQ8kAokXN-il5bK0pujDiSTA8Y9N9q3ZTXAs02C4kKvE0yQ5vx8u_2PL_GfCWMXWneHX-goPQLXYCU3TDsDdQnvz9GGa-vS7uG0NSju9kI7WpEBrec24X8WZzUHqjdqJnPSMQEGDYz1mb0J5VBc_Stm6WTlPPXDRKWGwdFeDOWN2PoxF7yktkNWBzUclF5hB5LGOMkG-PSUo8utHdHAlGfw0eP-oj3g7rEuyn7Lu2xoHsIKZD474PopJ885RrwIrcsfjl0Mk3I26GCQ', NULL, 'eyJhbGciOiJSUzI1NiIsImtpZCI6ImQ2M2RiZTczYWFkODhjODU0ZGUwZDhkNmMwMTRjMzZkYzI1YzQyOTIiLCJ0eXAiOiJKV1QifQ.eyJpc3MiOiJodHRwczovL2FjY291bnRzLmdvb2dsZS5jb20iLCJhenAiOiIxMDc1NDU1NTgyMzM2LTAxaWFsanVmYmUzZjFhMHNyNWcyYnZpN2phcDlncXVsLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiYXVkIjoiMTA3NTQ1NTU4MjMzNi01MzlpZm9obzIyMWEwZGpubDMxdXU2cDlrcjdlb3Zzai5hcHBzLmdvb2dsZXVzZXJjb250ZW50LmNvbSIsInN1YiI6IjEwNDYwMzM4ODc0ODMzMDI3MTc4MSIsImVtYWlsIjoic2hhcmlxaXNtYWlsODZAZ21haWwuY29tIiwiZW1haWxfdmVyaWZpZWQiOnRydWUsIm5hbWUiOiJTaGFyaXEgSXNtYWlsIiwicGljdHVyZSI6Imh0dHBzOi8vbGgzLmdvb2dsZXVzZXJjb250ZW50LmNvbS9hLS9BT2gxNEdqdm9rNnJOU1lqYlEwaVBoUU9DcTNmbVpCOEw4c1RHU1lVdmRuZ3pnPXM5Ni1jIiwiZ2l2ZW5fbmFtZSI6IlNoYXJpcSIsImZhbWlseV9uYW1lIjoiSXNtYWlsIiwibG9jYWxlIjoiZW4tR0IiLCJpYXQiOjE2NDc0MjkxNTEsImV4cCI6MTY0NzQzMjc1MX0.Z-c9pTR-ZpfYg3tqqz0ORZNHD7cJdl7CkLclX34JX7R5nW6kToAnN7xnYcPRPD4Fs_IlBcXwQ8kAokXN-il5bK0pujDiSTA8Y9N9q3ZTXAs02C4kKvE0yQ5vx8u_2PL_GfCWMXWneHX-goPQLXYCU3TDsDdQnvz9GGa-vS7uG0NSju9kI7WpEBrec24X8WZzUHqjdqJnPSMQEGDYz1mb0J5VBc_Stm6WTlPPXDRKWGwdFeDOWN2PoxF7yktkNWBzUclF5hB5LGOMkG-PSUo8utHdHAlGfw0eP-oj3g7rEuyn7Lu2xoHsIKZD474PopJ885RrwIrcsfjl0Mk3I26GCQ', '2022-03-16 10:12:33', '2022-03-16 10:12:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_verified` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `first_name`, `last_name`, `profile_image`, `birthday`, `gender`, `location`, `phone`, `phone_verified`, `email_verified`, `language`, `country_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super', 'Admin', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 92, 1, NULL, '2021-03-29 07:14:36', '2021-03-29 07:14:36'),
(137, 137, 'Zaid', 'Qureshi', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, '2021-10-06 06:12:01', '2021-10-06 06:12:01'),
(138, 138, 'Zaid', 'Qureshi', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, '2021-10-06 10:16:08', '2021-10-06 10:16:08'),
(139, 139, 'Muhammad', 'Zai', 'userImage20211126-032702pm994.', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, '2021-10-06 15:23:46', '2021-11-30 10:28:03'),
(140, 140, 'TestUser12341', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, '2021-11-30 13:24:43', '2021-11-30 13:24:43'),
(141, 141, 'Rehan', 'Fazal', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, '2021-11-30 13:25:15', '2021-11-30 13:25:15'),
(142, 142, 'TestUser12341', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, '2021-11-30 14:32:16', '2021-11-30 14:32:16'),
(143, 143, 'Zaid', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, '2021-12-01 10:31:30', '2021-12-01 10:31:30'),
(144, 144, 'Zaid', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, '2021-12-01 10:32:20', '2021-12-01 10:32:20'),
(145, 145, 'Rehan', 'Fazal', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, '2021-12-02 08:09:22', '2021-12-02 08:09:22'),
(146, 146, 'TestUser12341', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, '2021-12-06 07:27:10', '2021-12-06 07:27:10'),
(147, 147, 'Zaid', 'Qureshi', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, '2021-12-06 07:46:40', '2021-12-06 07:50:14'),
(148, 148, 'Zaid', 'Fazal', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, '2021-12-06 09:06:58', '2021-12-06 09:06:58'),
(149, 149, 'muhammad', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, '2021-12-06 09:19:47', '2021-12-06 09:19:47'),
(150, 150, 'Organization Admin', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, '2022-03-10 10:09:52', '2022-03-10 10:09:52'),
(151, 151, 'Shariq', 'Ismail', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, NULL, '2022-03-16 10:12:33', '2022-03-16 10:12:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_location`
--

CREATE TABLE `user_location` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_location`
--

INSERT INTO `user_location` (`id`, `user_id`, `job_id`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(104, 108, 231, '31.5203696', '74.35874729999999', '2021-09-02 18:43:48', '2021-09-02 18:43:48'),
(105, 108, 232, '33.6834522', '72.9886954', '2021-09-02 18:48:27', '2021-09-02 18:48:27'),
(106, 108, 233, '33.6834243', '72.9887272', '2021-09-02 18:51:51', '2021-09-02 18:51:51'),
(107, 108, 235, '33.6834348', '72.9887167', '2021-09-02 18:57:25', '2021-09-02 18:57:25'),
(108, 110, 235, '31.4955504', '74.4067685', '2021-09-02 19:01:18', '2021-09-02 19:01:18'),
(109, 111, 234, '33.683451', '72.9887303', '2021-09-02 19:01:34', '2021-09-02 19:01:34'),
(110, 111, 233, '33.6834094', '72.9887211', '2021-09-02 19:02:21', '2021-09-02 19:02:21'),
(111, 112, 236, '31.495551', '74.4067665', '2021-09-02 19:08:22', '2021-09-02 19:08:22'),
(112, 113, 237, '33.6834173', '72.9887128', '2021-09-02 19:26:17', '2021-09-02 19:26:17'),
(113, 2, 242, '37.33233141', '-122.0312186', '2021-09-02 21:25:46', '2021-09-02 21:25:46'),
(114, 2, 239, '31.4955464', '74.4067683', '2021-09-02 22:18:58', '2021-09-02 22:18:58'),
(115, 119, 244, '31.5203696', '74.35874729999999', '2021-09-03 19:19:17', '2021-09-03 19:19:17'),
(116, 119, 243, '31.5203696', '74.35874729999999', '2021-09-03 20:06:22', '2021-09-03 20:06:22'),
(117, 2, 247, '37.33233141', '-122.0312186', '2021-09-07 10:32:38', '2021-09-07 10:32:38'),
(118, 2, 245, '31.5144166', '74.344761', '2021-09-07 11:03:09', '2021-09-07 11:03:09'),
(119, 2, 248, '37.33233141', '-122.0312186', '2021-09-09 11:43:05', '2021-09-09 11:43:05'),
(120, 2, 240, '37.33233141', '-122.0312186', '2021-09-09 11:43:25', '2021-09-09 11:43:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_category`
--
ALTER TABLE `main_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobileemailotp`
--
ALTER TABLE `mobileemailotp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobilesessions`
--
ALTER TABLE `mobilesessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_location`
--
ALTER TABLE `user_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `main_category`
--
ALTER TABLE `main_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mobileemailotp`
--
ALTER TABLE `mobileemailotp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mobilesessions`
--
ALTER TABLE `mobilesessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `user_location`
--
ALTER TABLE `user_location`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_location`
--
ALTER TABLE `user_location`
  ADD CONSTRAINT `user_location_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
