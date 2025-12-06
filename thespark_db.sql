-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2025 at 02:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thespark_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'News', 'news', 'Latest news and current events', NULL, NULL),
(2, 'Opinion', 'opinion', 'Opinion pieces and editorials', NULL, NULL),
(3, 'DevCom', 'devcom', 'Development communication articles', NULL, NULL),
(4, 'Feature', 'feature', 'Feature stories and in-depth articles', NULL, NULL),
(5, 'Literary', 'literary', 'Literary works and creative writing', NULL, NULL),
(6, 'Sci&Tech', 'scitech', 'Science and technology news', NULL, NULL),
(7, 'Sports', 'sports', 'Sports news and updates', NULL, NULL),
(8, 'Telesiklab', 'telesiklab', 'Telesiklab content and updates', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `drafts`
--

CREATE TABLE `drafts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `photojournalist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_12_06_010231_create_users_table', 1),
(2, '2025_12_06_010247_create_password_reset_tokens_table', 1),
(3, '2025_12_06_010253_create_sessions_table', 1),
(4, '2025_12_06_010256_create_staff_table', 1),
(5, '2025_12_06_010300_create_categories_table', 1),
(6, '2025_12_06_010316_create_posts_table', 1),
(7, '2025_12_06_010320_create_drafts_table', 1),
(8, '2025_12_06_010324_create_trash_table', 1),
(9, '2025_12_06_010328_create_favorites_table', 1),
(10, '2025_12_06_010333_create_comments_table', 1),
(11, '2025_12_06_010337_create_cache_table', 1),
(12, '2025_12_06_103127_add_missing_columns_to_trash_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `photojournalist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `thumbnail` varchar(255) NOT NULL COMMENT 'Path for front view thumbnail',
  `description` longtext NOT NULL COMMENT 'The article content itself',
  `image` varchar(255) DEFAULT NULL COMMENT 'Main article image, different from thumbnail',
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `reading_time` int(10) UNSIGNED DEFAULT NULL COMMENT 'Reading time in minutes',
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `date`, `time`, `author_id`, `photojournalist_id`, `category_id`, `thumbnail`, `description`, `image`, `views`, `reading_time`, `is_featured`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Amethyst rules over multi-division conquest in combative events', 'amethyst-rules-over-multi-division-conquest-in-combative-events', '2025-12-06', '18:24:00', 2, 3, 7, 'thumbnails/OutFQwrKAI3JuqPoK9WZGDqHVOiS5Ycs9CU2JHAC.jpg', '<span id=\"docs-internal-guid-edd6e0f3-7fff-bc35-bb13-4d17da04a646\"><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">CHS asserted clear dominance in the combative warzone after sweeping multiple divisions in both Taekwondo and Arnis, with gold-medal performances across two action-packed days in the November 25-26 showdowns held at the Academic Building III.&nbsp;</span></p><br><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">On the Taekwondo bloodbath, Amethyst unleashed a commanding storm filled with purple banners, blitzing the overall standings with a 51-point onslaught, far ahead of Verdant\'s 23points and Obsidian\'s 20points.&nbsp;</span></p><br><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">Meanwhile, in Arnis, CHS once again erupted into a gold-fever rampage, hoarding 74 points against CCS’ 43points, and CEA’s 40points, further cementing their stranglehold on all fronts.&nbsp;</span></p><br><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">With the largest arsenal in terms of official entries, CHS Amethyst terrorized the mat as undisputed goliaths, significantly elevating their college’s standing after amassing a 100-point golden haul for both men’s and women’s divisions.&nbsp;</span></p></span>', NULL, 0, 1, 0, '2025-12-06 01:41:43', '2025-12-06 02:32:09', '2025-12-06 02:32:09'),
(4, 'Amethyst ayys', 'amethyst-ayys', '2025-12-06', '19:05:00', 2, 3, 7, 'thumbnails/AgWLrOWxHb9FX92lKccpPac38LRQxBAwBhjIzMpF.jpg', '<span id=\"docs-internal-guid-ffea4b60-7fff-ddea-bcf2-d7094b81b06c\"><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">CHS asserted clear dominance in the combative warzone after sweeping multiple divisions in both Taekwondo and Arnis, with gold-medal performances across two action-packed days in the November 25-26 showdowns held at the Academic Building III.&nbsp;</span></p><br><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">On the Taekwondo bloodbath, Amethyst unleashed a commanding storm filled with purple banners, blitzing the overall standings with a 51-point onslaught, far ahead of Verdant\'s 23points and Obsidian\'s 20points.&nbsp;</span></p><br><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">Meanwhile, in Arnis, CHS once again erupted into a gold-fever rampage, hoarding 74 points against CCS’ 43points, and CEA’s 40points, further cementing their stranglehold on all fronts.&nbsp;</span></p><br><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">With the largest arsenal in terms of official entries, CHS Amethyst terrorized the mat as undisputed goliaths, significantly elevating their college’s standing after amassing a 100-point golden haul for both men’s and women’s divisions.&nbsp;</span></p><div><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\"><br></span></div></span>', NULL, 0, 1, 0, '2025-12-06 03:04:49', '2025-12-06 03:05:16', '2025-12-06 03:05:16'),
(25, 'asdfghj', 'asdfghj', '2025-12-06', '19:47:00', 2, 3, 7, 'thumbnails/f47R4g37lpcQUW2pqC2AJSTcBEVpkagSPIVtxz1Q.jpg', 'asdasdsad', NULL, 0, 1, 0, '2025-12-06 03:47:29', '2025-12-06 03:47:41', '2025-12-06 03:47:41'),
(26, 'asdsadsadadasd', 'asdsadsadadasd', '2025-12-06', '19:52:00', 2, 3, 7, 'thumbnails/IxKWOlOJnUp9A1M659QIWZJQmwuBSBl3eK3jcob8.jpg', 'asdsaddasdasdasdasdad', NULL, 0, 1, 0, '2025-12-06 03:52:39', '2025-12-06 03:52:39', NULL),
(27, 'water', 'water', '2025-12-06', '19:57:00', 1, 1, 8, 'thumbnails/3XaEM5wCphGNeogs2a57VIjFpDqvO0uOkNqOzxkJ.jpg', 'asdasdas', NULL, 0, 1, 0, '2025-12-06 03:57:43', '2025-12-06 03:58:08', '2025-12-06 03:58:08'),
(30, 'wasssssssssssss', 'wasssssssssssss', '2025-12-06', '20:07:00', 1, 1, 1, 'thumbnails/Fykv8rN4kOSqMxt7noqKniXJAYqnWei2WpWCF2o2.jpg', 'asdddddddd', NULL, 0, 1, 0, '2025-12-06 04:07:45', '2025-12-06 04:07:45', NULL),
(34, 'Fire', 'fire', '2025-12-06', '20:11:00', 2, 1, 2, 'thumbnails/CaWtCd5m6nii4Vb0rxDSpaZWwe0XosUT6GIC0ek8.jpg', 'sssesssesds', NULL, 0, 1, 0, '2025-12-06 04:11:15', '2025-12-06 04:11:15', NULL),
(35, 'Buntis Sya', 'buntis-sya', '2025-12-06', '20:11:00', 3, 3, 3, 'thumbnails/yeD640GOlKrZBUtnelPiIp3epuF7X5QnpEAWZDFl.jpg', 'buntis', NULL, 1, 1, 0, '2025-12-06 04:11:40', '2025-12-06 04:38:11', NULL),
(36, 'Air', 'air', '2025-12-06', '20:18:00', 3, 1, 4, 'thumbnails/V2EVouzckJA2YCoXSR7gMrwVm2S4L7pXEqUIzZAy.jpg', 'asssswssssassssaasssswssssassssaasssswssssassssaasssswssssassssaassssws<div>sssassssaasssswssssassssaasssswssssassssaasssswssssassssaasssswsss</div><div>sassssaasssswssssassssaasssswssssassssaasssswssssassssaasssswssssas</div><div>sssaasssswssssassssaasssswssssassssaasssswssssassssaasssswssssassssaassss</div><div>wssssassssaasssswssssassssaasssswssssassssaasssswssssassssaassssw</div><div>ssssassssaasssswssssassssaasssswssssassssaasssswssssassssaasssswssssassssaasssswssssassssaasssswssss<div>assssaasssswssssassssaasssswssssassssaasssswssssassssaasssswssssassssaasssswssssassssaasssswssssassssa</div></div>', NULL, 1, 1, 0, '2025-12-06 04:18:34', '2025-12-06 05:39:47', '2025-12-06 05:39:47'),
(37, 'eyyyyy', 'eyyyyy', '2025-12-06', '20:54:00', 3, NULL, 4, 'thumbnails/HE5Ctf8My06fJoTVmlizoqItv6rFNIRC16RmRS1S.jpg', 'awaawwwawaw', NULL, 0, 1, 0, '2025-12-06 04:54:11', '2025-12-06 04:54:11', NULL),
(38, 'Amethyst Crazy123', 'amethyst-crazy123', '2025-12-06', '21:30:00', 3, 1, 7, 'thumbnails/vKIVgHz4r4rtCczW8PNgRjE4VJRMjODixLAwkMsq.jpg', '<span id=\"docs-internal-guid-3fa71a08-7fff-5302-9f84-8d51049a73c7\"><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">CHS asserted clear dominance in the combative warzone after sweeping multiple divisions in both Taekwondo and Arnis, with gold-medal performances across two action-packed days in the November 25-26 showdowns held at the Academic Building III.&nbsp;</span></p><br><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">On the Taekwondo bloodbath, Amethyst unleashed a commanding storm filled with purple banners, blitzing the overall standings with a 51-point onslaught, far ahead of Verdant\'s 23points and Obsidian\'s 20points.&nbsp;</span></p><br><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">Meanwhile, in Arnis, CHS once again erupted into a gold-fever rampage, hoarding 74 points against CCS’ 43points, and CEA’s 40points, further cementing their stranglehold on all fronts.&nbsp;</span></p><br><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">With the largest arsenal in terms of official entries, CHS Amethyst terrorized the mat as undisputed goliaths, significantly elevating their college’s standing after amassing a 100-point golden haul for both men’s and women’s divisions.&nbsp;</span></p><div><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\"><br></span></div></span>', NULL, 0, 1, 0, '2025-12-06 05:29:40', '2025-12-06 05:31:05', '2025-12-06 05:31:05'),
(39, 'Amethyst Wins Intramurals 2025 SIKLAB', 'amethyst-wins-intramurals-2025-siklab', '2025-12-06', '21:39:00', 3, 1, 7, 'thumbnails/BthcRqWd08J5e2lzEgbggcipCnPv0wSrg5kUQIuz.jpg', '<span id=\"docs-internal-guid-b61e4909-7fff-a796-b65c-48f5f7284f7c\"><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">CHS asserted clear dominance in the combative warzone after sweeping multiple divisions in both Taekwondo and Arnis, with gold-medal performances across two action-packed days in the November 25-26 showdowns held at the Academic Building III.&nbsp;</span></p><br><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">On the Taekwondo bloodbath, Amethyst unleashed a commanding storm filled with purple banners, blitzing the overall standings with a 51-point onslaught, far ahead of Verdant\'s 23points and Obsidian\'s 20points.&nbsp;</span></p><br><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">Meanwhile, in Arnis, CHS once again erupted into a gold-fever rampage, hoarding 74 points against CCS’ 43points, and CEA’s 40points, further cementing their stranglehold on all fronts.&nbsp;</span></p><br><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">With the largest arsenal in terms of official entries, CHS Amethyst terrorized the mat as undisputed goliaths, significantly elevating their college’s standing after amassing a 100-point golden haul for both men’s and women’s divisions.&nbsp;</span></p><div><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\"><br></span></div></span>', NULL, 0, 1, 0, '2025-12-06 05:38:36', '2025-12-06 05:39:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL COMMENT 'Format: Last Name, Given Names, Middle Initial',
  `cspc_email` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL COMMENT 'Path to photo',
  `position` enum('Editor-In-Chief','Associate Editor for Internal','Associate Editor for External','Managing Editor','Assistant Managing Editor','Circulation Manager','Copy Editor','Art Editor','Layout Editor','Copyreader','Layout Artist','Editorial Cartoonist','Graphic Artist','Photojournalist','News Presenter','Videographer','Video Editor','Technical Director','Editorial Assistant','News','Opinion','DevCom','Feature','Literary','Sci&Tech','Sports') NOT NULL,
  `program` varchar(100) NOT NULL,
  `year_section` varchar(10) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `status` enum('active','archived') NOT NULL DEFAULT 'active',
  `archived_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `full_name`, `cspc_email`, `photo`, `position`, `program`, `year_section`, `is_active`, `status`, `archived_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mario Emmanuel Obrero', 'maobrero@my.cspc.edu.ph', 'staff-pictures/x3oP9gEAAgaU6TIOa1K9XuH0XwBcAsFBe3RZ5192.jpg', 'Photojournalist', 'BSCompEng', '3B', 1, 'active', NULL, '2025-12-06 01:32:17', '2025-12-06 05:42:15', NULL),
(2, 'Cutie Denise', 'deibarondo@my.cspc.edu.ph', 'staff-pictures/3PNwb5PdsyJpEnZEWAlOblGxAOTW5i4BR8qYWOvG.jpg', 'Sports', 'BSN', '4C', 1, 'active', NULL, '2025-12-06 01:32:53', '2025-12-06 01:32:53', NULL),
(3, 'kenji Turiano', 'emturiano@my.cspc.edu.ph', 'staff-pictures/lDUUOFRsxx2PNf9BzsjnhwDr4sdlMqC58Js9YZyV.jpg', 'Video Editor', 'BSIT', '3C', 1, 'active', NULL, '2025-12-06 01:33:37', '2025-12-06 01:33:37', NULL),
(4, 'Ella Jade Algura123', 'elalgura@my.cspc.edu.ph', 'staff-pictures/VEbZYVEAXq2ZAjF6dmsZ3ilYxx9rdQalpqlyn3h2.jpg', 'News Presenter', 'BSDevCom', '1A', 1, 'active', NULL, '2025-12-06 05:31:45', '2025-12-06 05:32:19', '2025-12-06 05:32:19'),
(5, 'Glyn Nicole Lee Lee', 'gllee@my.cspc.edu.ph', 'staff-pictures/rqL8My99uJz4UIhsQ51BcoTybBLUYMYmm7JX4qAb.jpg', 'Editorial Cartoonist', 'BSArchi', '2C', 1, 'active', NULL, '2025-12-06 05:40:31', '2025-12-06 05:41:10', '2025-12-06 05:41:10');

-- --------------------------------------------------------

--
-- Table structure for table `trash`
--

CREATE TABLE `trash` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `original_post_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Reference to original post ID',
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `photojournalist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `article_image` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `reading_time` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'When moved to trash',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Original creation date',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Original last update'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trash`
--

INSERT INTO `trash` (`id`, `original_post_id`, `title`, `slug`, `date`, `time`, `author_id`, `photojournalist_id`, `category_id`, `thumbnail`, `article_image`, `description`, `reading_time`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 4, 'Amethyst ayys', 'amethyst-ayys', '2025-12-06', '19:05:00', 2, 3, 7, 'thumbnails/AgWLrOWxHb9FX92lKccpPac38LRQxBAwBhjIzMpF.jpg', NULL, '<span id=\"docs-internal-guid-ffea4b60-7fff-ddea-bcf2-d7094b81b06c\"><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">CHS asserted clear dominance in the combative warzone after sweeping multiple divisions in both Taekwondo and Arnis, with gold-medal performances across two action-packed days in the November 25-26 showdowns held at the Academic Building III.&nbsp;</span></p><br><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">On the Taekwondo bloodbath, Amethyst unleashed a commanding storm filled with purple banners, blitzing the overall standings with a 51-point onslaught, far ahead of Verdant\'s 23points and Obsidian\'s 20points.&nbsp;</span></p><br><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">Meanwhile, in Arnis, CHS once again erupted into a gold-fever rampage, hoarding 74 points against CCS’ 43points, and CEA’s 40points, further cementing their stranglehold on all fronts.&nbsp;</span></p><br><p dir=\"ltr\" style=\"line-height:1.38;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\">With the largest arsenal in terms of official entries, CHS Amethyst terrorized the mat as undisputed goliaths, significantly elevating their college’s standing after amassing a 100-point golden haul for both men’s and women’s divisions.&nbsp;</span></p><div><span style=\"font-size: 12pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; vertical-align: baseline; white-space-collapse: preserve;\"><br></span></div></span>', 1, NULL, '2025-12-06 11:05:16', '2025-12-06 03:05:16', '2025-12-06 03:05:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','visitor') NOT NULL DEFAULT 'visitor',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@cspc.edu.ph', '2025-12-06 01:30:25', '$2y$12$2hi/9EXxw4VltNv8fml8bu4IGbp9e6kAubVad1tfGlJeGtK0JMWUe', 'admin', NULL, NULL, NULL),
(2, 'Kenji', 'emturiano@my.cspc.edu.ph', NULL, '$2y$12$a1Oi/6XZ/v1wwpDILfek2u1rOhD6302LhJUO4ICAHSQTh7nZ5ciVK', 'admin', NULL, '2025-12-06 01:31:04', '2025-12-06 01:31:04'),
(3, 'testuser123', 'test123@example.com', NULL, '$2y$12$qjcg6cNjFG6WPwO27NXhi.JYHpE4picko1OngBF09AqArUwwU6tz2', 'visitor', NULL, '2025-12-06 05:10:04', '2025-12-06 05:10:04'),
(5, 'Me', 'me@my.cspc.edu.ph', NULL, '$2y$12$9ha.ICHAY00yHNGW.D9QR.aOKVMaFCKroz7642cA7S/JDDzp/prGO', 'visitor', NULL, '2025-12-06 05:20:28', '2025-12-06 05:20:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_index` (`post_id`),
  ADD KEY `comments_user_id_index` (`user_id`),
  ADD KEY `comments_parent_id_index` (`parent_id`);

--
-- Indexes for table `drafts`
--
ALTER TABLE `drafts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `drafts_photojournalist_id_foreign` (`photojournalist_id`),
  ADD KEY `drafts_category_id_foreign` (`category_id`),
  ADD KEY `drafts_author_id_index` (`author_id`),
  ADD KEY `drafts_updated_at_index` (`updated_at`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `favorites_user_id_post_id_unique` (`user_id`,`post_id`),
  ADD KEY `favorites_user_id_index` (`user_id`),
  ADD KEY `favorites_post_id_index` (`post_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_photojournalist_id_foreign` (`photojournalist_id`),
  ADD KEY `posts_slug_index` (`slug`),
  ADD KEY `posts_category_id_index` (`category_id`),
  ADD KEY `posts_author_id_index` (`author_id`),
  ADD KEY `posts_date_index` (`date`),
  ADD KEY `posts_deleted_at_index` (`deleted_at`),
  ADD KEY `posts_is_featured_index` (`is_featured`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_cspc_email_unique` (`cspc_email`);

--
-- Indexes for table `trash`
--
ALTER TABLE `trash`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trash_photojournalist_id_foreign` (`photojournalist_id`),
  ADD KEY `trash_category_id_foreign` (`category_id`),
  ADD KEY `trash_deleted_at_index` (`deleted_at`),
  ADD KEY `trash_author_id_index` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_email_index` (`email`),
  ADD KEY `users_role_index` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `drafts`
--
ALTER TABLE `drafts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trash`
--
ALTER TABLE `trash`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `drafts`
--
ALTER TABLE `drafts`
  ADD CONSTRAINT `drafts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `staff` (`id`),
  ADD CONSTRAINT `drafts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `drafts_photojournalist_id_foreign` FOREIGN KEY (`photojournalist_id`) REFERENCES `staff` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `staff` (`id`),
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `posts_photojournalist_id_foreign` FOREIGN KEY (`photojournalist_id`) REFERENCES `staff` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trash`
--
ALTER TABLE `trash`
  ADD CONSTRAINT `trash_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `staff` (`id`),
  ADD CONSTRAINT `trash_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `trash_photojournalist_id_foreign` FOREIGN KEY (`photojournalist_id`) REFERENCES `staff` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
