-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 13, 2026 at 05:14 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hezb_el_shaab`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_settings`
--

INSERT INTO `app_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'banner_image', 'storage/uploads/settings/aGvbx1UM2UAcTz3gZaq5QxTlpxhsnGuV7BfM4yl8.jpg', '2025-08-12 09:29:19', '2025-08-12 09:40:10'),
(2, 'show_elections', '1', '2025-08-12 09:31:30', '2025-08-12 09:31:30');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('hezb-el-shaab-cache-admin@gmail.com|156.183.10.215', 'i:2;', 1776007707),
('hezb-el-shaab-cache-admin@gmail.com|156.183.10.215:timer', 'i:1776007707;', 1776007707),
('hezb-el-shaab-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:9:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:6:\"Events\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:4:\"News\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:5;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:10:\"Candidates\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:5;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:5:\"Users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:10:\"Users List\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:12:\"Users Create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:12:\"Users Update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:12:\"Users Delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:19:\"Users Member Action\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"super admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:10:\"employee11\";s:1:\"c\";s:3:\"web\";}}}', 1778774958);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `slug`, `name`, `brief`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ahmd', 'أحمد', '<p style=\"text-align: right;\">إن الالتزام بأخلاقيات المهنة الطبية والسلوك المهني أحد المجالات الرئيسية لاختصاص نقابة الأطباء. تتولى الهيئة إعداد قانون أخلاقيات مهنة</p>', 'candidate/images/zi3u7bwq2NBMu8S4dUKOumlEqRgi9Y2sfYohXwXL.jpg', '<p style=\"text-align: right;\">إن هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام &quot;هنا يوجد محتوى نصي، هنا يوجد محتوى نصي</p>', 1, '2025-08-11 12:14:58', '2025-08-11 12:24:38'),
(2, 'ahmd-aabd-allh', 'أحمد عبد الله', '<p style=\"text-align: right;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي</p>', 'candidate/images/C6eWzJfi33g2Jh7Ckyh13vZQBF0v5EyoLJVNmevs.jpg', '<p style=\"text-align: right;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام &quot;هنا يوجد محتوى نصي، هنا يوجد محتوى نصي</p>', 1, '2025-08-11 12:18:20', '2025-08-11 12:18:20');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `rules` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `chat_available` tinyint(1) NOT NULL DEFAULT '0',
  `is_private` tinyint(1) NOT NULL DEFAULT '0',
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `slug`, `title`, `image`, `video`, `date`, `address`, `description`, `rules`, `status`, `chat_available`, `is_private`, `latitude`, `longitude`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'asm-faaaly-tgryby', 'أسم فعالية تجريبي', 'events/images/HZt8Opa7fSKNQwPMEZCUQvtMjkVPdNfnfTTmA5IU.jpg', 'events/videos/rm67Xi05lRk3ibHfz1JPvDIlWpGhRdFNKUif7UgD.mp4', '2025-08-31 17:00:00', '3 شارع مكرم عبيد - القاهرة', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد محتوى نصي، هنا يوجد محتوى نصيهناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد محتوى نصي، هنا يوجد محتوى نصي', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد محتوى نصي، هنا يوجد محتوى نصيهناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد محتوى نصي، هنا يوجد محتوى نصي', 1, 0, 0, 33.00000000, 35.00000000, 1, '2025-08-10 07:56:26', '2025-08-10 08:03:41'),
(3, 'tgrb', 'تجربة', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, NULL, NULL, 1, '2025-08-10 10:25:31', '2025-08-10 10:25:31'),
(8, 'faaaly-gdyd', 'فعالية جديدة', 'events/images/nl21Mo7kYCyIZycHgdTNdCHH5ZHToPBkGJBO8Xf0.png', 'events/videos/jdQnr4Oi7SwLFZ6ows9A7TeTFooX10sTJ37ZLbBx.mp4', '2025-08-31 18:00:00', '30 شارع مكرم عبيد - القاهرة', '<p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام &quot;هنا يوجد محتوى نصي، هنا يوجد محتوى نصيهناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام &quot;هنا يوجد محتوى نصي، هنا يوجد محتوى نصي</p><p data-f-id=\"pbf\" style=\"text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;\">Powered by <a href=\"https://www.froala.com/wysiwyg-editor?pb=1\" title=\"Froala Editor\">Froala Editor</a></p>', '<p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام &quot;هنا يوجد محتوى نصي، هنا يوجد محتوى نصيهناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام &quot;هنا يوجد محتوى نصي، هنا يوجد محتوى نصي</p><p data-f-id=\"pbf\" style=\"text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;\">Powered by <a href=\"https://www.froala.com/wysiwyg-editor?pb=1\" title=\"Froala Editor\">Froala Editor</a></p>', 1, 0, 0, 33.00000000, 35.00000000, 1, '2025-08-10 12:23:56', '2025-08-14 11:52:12'),
(9, 'tgrb-llfaaalyat', 'تجربة للفاعليات', 'events/images/2c8MV2jrkh3Zyej9252Lrx4msLpiq4NcgJOVCPUP.jpg', 'events/videos/Jp6xGIUt4fC3PsXpE5fYRgKovdmO3oCGDZnjlzHS.mp4', '2025-08-20 11:00:00', '30 شارع مكرم عبيد - القاهرة', '<p style=\"text-align: right;\"><strong><span style=\"font-family: Georgia,serif;\">هناك حقيقة مثبتة</span></strong><span style=\"font-family: Georgia,serif;\">&nbsp;منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ</span> <span style=\"color: rgb(184, 49, 47);\">طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام &quot;هنا</span></p>', '<ul><li style=\"text-align: right; font-family: Tahoma, Geneva, sans-serif;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما&nbsp;</li><li style=\"text-align: right; font-family: Tahoma, Geneva, sans-serif;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما&nbsp;</li><li style=\"text-align: right; font-family: Tahoma, Geneva, sans-serif;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما&nbsp;</li><li style=\"text-align: right; font-family: Tahoma, Geneva, sans-serif;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما&nbsp;</li><li style=\"text-align: right; font-family: Tahoma, Geneva, sans-serif;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما&nbsp;</li><li style=\"text-align: right; font-family: Tahoma, Geneva, sans-serif;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما&nbsp;</li></ul>', 1, 1, 0, 33.00000000, 35.00000000, 1, '2025-08-11 05:19:28', '2025-08-11 05:53:57'),
(10, 'tgrb-thdyd-ashkhas', 'تجربة تحديد اشخاص', 'events/images/oAoclR2JJfRYQXeGmE0vn5SGaIuntOqJy62hvr2U.jpg', NULL, '2025-08-15 20:00:00', '30 شارع مكرم عبيد - القاهرة', '<p style=\"text-align: right;\">تيست</p>', '<p style=\"text-align: right;\" id=\"isPasted\">تيست</p>', 1, 1, 1, 33.00000000, 35.00000000, 1, '2025-08-12 05:58:54', '2025-08-12 05:58:54');

-- --------------------------------------------------------

--
-- Table structure for table `event_organizers`
--

CREATE TABLE `event_organizers` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_organizers`
--

INSERT INTO `event_organizers` (`id`, `event_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 3, 4, NULL, NULL),
(4, 8, 2, NULL, NULL),
(5, 9, 1, NULL, NULL),
(6, 9, 4, NULL, NULL),
(7, 9, 2, NULL, NULL),
(8, 10, 1, NULL, NULL),
(9, 10, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_sponsors`
--

CREATE TABLE `event_sponsors` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_sponsors`
--

INSERT INTO `event_sponsors` (`id`, `event_id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(13, 8, 'شركة 1', 'events/sponsors/6Nso0ugX15Djf2yWOf79gf27cjGmkz6f58RQJCCx.png', '2025-08-10 12:43:31', '2025-08-10 12:52:25'),
(15, 8, 'شركة 2', 'events/sponsors/PFQzCPbygf7PYA76zyChGzd2F87nUmbw8Nu71ZdF.jpg', '2025-08-10 12:53:14', '2025-08-10 12:53:14'),
(16, 9, 'شركة 1', 'events/sponsors/OpsREzet52S6TBg9xcmT3pkPiefzrALCrpHabWOa.jpg', '2025-08-11 05:19:28', '2025-08-11 05:19:28'),
(17, 9, 'شركة 2', 'events/sponsors/IuQkkjK7yVVSVkPlJULiCAjSjp8LDj6G2RHd3oY3.jpg', '2025-08-11 05:19:28', '2025-08-11 05:19:28'),
(18, 9, 'شركة 3', 'events/sponsors/JoHd4Pi6oFCGmVTl6sB4PvorcexQfRSRe2xCiVuW.jpg', '2025-08-11 05:19:28', '2025-08-11 05:19:28'),
(19, 10, 'شركة 1', 'events/sponsors/Wjo8Nwbe4UXxMpDcPfwiasxolSzSqZW1JebTNNrd.jpg', '2025-08-12 05:58:54', '2025-08-12 05:58:54');

-- --------------------------------------------------------

--
-- Table structure for table `event_user`
--

CREATE TABLE `event_user` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_user`
--

INSERT INTO `event_user` (`id`, `event_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 10, 9, '2025-08-12 06:42:47', '2025-08-12 06:42:47'),
(3, 10, 15, '2025-08-14 07:08:09', '2025-08-14 07:08:09'),
(4, 10, 21, '2025-08-14 07:31:06', '2025-08-14 07:31:06'),
(5, 10, 27, '2025-08-14 11:55:11', '2025-08-14 11:55:11'),
(6, 10, 29, '2025-08-14 11:55:26', '2025-08-14 11:55:26'),
(7, 10, 30, '2025-08-14 12:32:24', '2025-08-14 12:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `membership_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `uuid`, `national_id`, `membership_number`, `created_at`, `updated_at`) VALUES
(4, 'b4a47677-9fa7-4d14-91c5-305585b3e041', '20002211112333', NULL, '2025-08-11 10:03:16', '2025-08-11 13:11:36'),
(5, '9092d976-f16c-4cde-bf72-771ccd6ee834', '20002211112331', NULL, '2025-08-12 09:15:46', '2025-08-12 09:15:46'),
(6, '7cbece00-fdba-44a6-b82f-7861e3ab6ed9', '20002211112330', NULL, '2025-08-13 07:54:40', '2025-08-13 07:54:40'),
(7, '5eafd6da-b444-49b8-b105-102d840071ba', '20002211112332', NULL, '2025-08-13 11:14:18', '2025-08-13 11:14:18'),
(8, 'dbe79446-0efc-4556-a309-bc723fb51e6c', '20002211112317', NULL, '2025-08-13 11:25:08', '2025-08-13 11:25:08'),
(9, '0d1d508f-d2c9-4cba-9202-c73d1f1a945e', '20002211112316', NULL, '2025-08-13 11:27:14', '2025-08-13 11:27:14'),
(10, '77b5203d-0427-44ef-81d7-3d58ab682ec6', '20002211112368', NULL, '2025-08-13 11:31:13', '2025-08-13 11:31:13'),
(11, '9fb14e6d-9303-4c97-bbce-f2bf4737c4f0', '20002211110000', NULL, '2025-08-13 11:35:10', '2025-08-13 11:35:10'),
(12, '8e2a6c2e-31fe-491a-a09d-01932440a15f', '36987452136947', NULL, '2025-08-13 11:42:50', '2025-08-13 11:42:50'),
(13, '5cdbea62-da5f-45de-a362-818a5401ba51', '12457896314563', NULL, '2025-08-13 11:44:36', '2025-08-13 11:44:36'),
(14, '04fdcc2c-7a7a-4b0c-9e94-c4cd790f28e7', '98765412336905', NULL, '2025-08-13 13:05:03', '2025-08-13 13:05:03'),
(15, 'cb1d9f8e-2c4f-4149-9019-4ef01520580d', '20002211112335', NULL, '2025-08-13 13:12:24', '2025-08-13 13:12:24'),
(16, '2dbbdb50-5b1b-4618-8a76-712bbc493b9a', '78945612385274', NULL, '2025-08-14 06:41:08', '2025-08-14 06:41:08'),
(17, 'e8e5d657-5cfc-4366-bc3d-cccf8b06ddbf', '09876543212345', NULL, '2025-08-14 08:53:45', '2025-08-14 08:53:45'),
(18, '35019f8e-b64b-452c-abb7-1f7fad476f20', '44553334455566', NULL, '2025-08-14 09:16:29', '2025-08-14 09:16:29'),
(19, '8528963d-ac51-44a7-a116-3b5cca87513b', '98765412336920', NULL, '2025-08-14 09:51:53', '2025-08-14 09:51:53'),
(20, '7fdb972e-634c-4550-b035-75373ed37ce6', '65986523526555', NULL, '2025-08-14 09:58:39', '2025-08-14 09:58:39'),
(21, 'b544f3b1-777c-48fc-9827-c8e289ba49e9', '11254088854069', NULL, '2025-08-14 10:12:04', '2025-08-14 10:12:04'),
(22, '718be725-f932-4761-aa57-4b0eae90ed8d', '12345678901234', NULL, '2025-08-14 10:57:34', '2025-08-14 12:30:06'),
(23, '232984a6-20ad-4546-8f76-46564cae71fb', '12345678922111', NULL, '2025-08-14 11:09:48', '2025-08-14 11:09:48'),
(24, '8aca8b1e-0bd5-4216-b3d4-19100a1f0fda', '12346597877875', NULL, '2025-08-14 11:17:48', '2025-08-14 11:47:35'),
(25, '520e6d45-529a-4590-a340-ce92f33836f1', '98714563258547', NULL, '2025-08-14 11:22:59', '2025-08-14 11:47:03'),
(26, '17490fec-3f68-4136-9a76-9b85b8378c05', '36987452125441', NULL, '2025-08-14 11:42:55', '2025-08-14 11:47:17'),
(27, 'f3cc06db-161e-436f-b984-0cbea15e5bf1', '98745663211556', NULL, '2025-08-14 11:44:13', '2025-08-14 11:47:53'),
(28, 'e37a5d90-5375-4f27-a107-38584e896e6b', '55262652626266', NULL, '2025-12-10 11:31:06', '2025-12-10 11:31:06'),
(29, '602d515c-9675-4442-aff5-a43a7659470c', '20002211112350', NULL, '2026-03-23 11:32:14', '2026-03-23 11:32:14');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_10_095100_add_status_to_users_table', 2),
(5, '2025_08_10_095829_create_events_table', 3),
(6, '2025_08_10_102338_add_image_to_users_table', 4),
(7, '2025_08_10_122217_add_uuid_to_users_table', 5),
(8, '2025_08_10_123551_add_role_to_users_table', 6),
(9, '2025_08_10_130804_create_event_organizers_table', 7),
(10, '2025_08_10_140306_create_event_sponsors_table', 8),
(12, '2025_08_11_082437_add_chat_available_to_events_table', 9),
(13, '2025_08_11_085629_create_news_table', 10),
(16, '2025_08_11_113754_create_personal_access_tokens_table', 11),
(17, '2025_08_11_114619_create_members_table', 11),
(18, '2025_08_11_120852_add_member_id_to_users_table', 12),
(19, '2025_08_11_121935_add_phone_code_to_users_table', 13),
(20, '2025_08_11_125906_add_user_id_to_members_table', 14),
(21, '2025_08_11_140509_create_candidates_table', 15),
(22, '2025_08_12_083137_add_is_private_to_events_table', 16),
(23, '2025_08_12_084047_create_event_user_table', 17),
(24, '2025_08_12_095821_create_permission_tables', 18),
(25, '2025_08_12_122729_create_app_settings_table', 19),
(26, '2025_08_12_124108_create_sliders_table', 20),
(27, '2026_05_13_164511_add_national_id_to_users_table', 21),
(28, '2026_05_13_180000_add_membership_number_and_move_birth_date_to_users', 21),
(29, '2026_05_13_200000_move_member_status_to_users_and_drop_member_columns', 22);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `read_minutes` int NOT NULL DEFAULT '0',
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `slug`, `title`, `image`, `description`, `status`, `read_minutes`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'aanoan-khbr-tgryby', 'عنوان خبر تجريبي', 'news/images/eOAE06sGfw0ry1B8wfX6A2n2hiqrtVFcISVnmuxE.jpg', '<p style=\"text-align: right;\"><strong><span style=\"color: rgb(0, 168, 133);\"><u>هناك حقيقة مثبتة</u></span></strong></p><p style=\"text-align: right;\"><span style=\"font-family: Arial,Helvetica,sans-serif;\">&nbsp;منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام &quot;هنا يوجد محتوى نصي، هنا يوجد محتوى نصيهناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام &quot;هنا يوجد محتوى نصي، هنا يوجد محتوى نصي</span></p><ul style=\"list-style-type: square;\"><li style=\"text-align: right; font-family: Verdana, Geneva, sans-serif; font-size: 18px; color: rgb(147, 101, 184);\">عنصر تجريبي&nbsp;</li><li style=\"text-align: right; font-family: Verdana, Geneva, sans-serif; font-size: 18px; color: rgb(147, 101, 184);\">عنصر تجريبي&nbsp;</li><li style=\"text-align: right; font-family: Verdana, Geneva, sans-serif; font-size: 18px; color: rgb(147, 101, 184);\">عنصر تجريبي</li></ul><p style=\"text-align: right;\"><br></p>', 1, 15, 1, '2025-08-11 06:14:43', '2025-08-11 06:22:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Events', 'web', '2025-08-12 07:12:48', '2025-08-12 07:12:48'),
(2, 'News', 'web', '2025-08-12 07:12:48', '2025-08-12 07:12:48'),
(3, 'Candidates', 'web', '2025-08-12 07:12:48', '2025-08-12 07:12:48'),
(4, 'Users', 'web', '2025-08-12 07:12:48', '2025-08-12 07:12:48'),
(5, 'Users List', 'web', '2025-08-12 07:12:48', '2025-08-12 07:12:48'),
(6, 'Users Create', 'web', '2025-08-12 07:12:48', '2025-08-12 07:12:48'),
(7, 'Users Update', 'web', '2025-08-12 07:12:48', '2025-08-12 07:12:48'),
(8, 'Users Delete', 'web', '2025-08-12 07:12:48', '2025-08-12 07:12:48'),
(9, 'Users Member Action', 'web', '2025-08-12 07:12:48', '2025-08-12 07:12:48');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 6, 'auth_token', '9a0ebae9567f12cd725230e9b660271dcaaa6acd7b47b59fcc072a532b14c0f9', '[\"*\"]', NULL, NULL, '2025-08-11 09:49:14', '2025-08-11 09:49:14'),
(2, 'App\\Models\\User', 6, 'auth_token', 'e50ec7b8a5d81b26288cbd6be448140b5dfbdbebb3ed4f32f8812403375f2569', '[\"*\"]', '2025-08-11 09:54:57', NULL, '2025-08-11 09:53:30', '2025-08-11 09:54:57'),
(3, 'App\\Models\\User', 7, 'auth_token', 'a6e3ee874e645e66d8439d2110bab0cd8a04d6600b0b65746cb6b44717bbdf71', '[\"*\"]', '2025-08-11 10:01:14', NULL, '2025-08-11 10:00:55', '2025-08-11 10:01:14'),
(4, 'App\\Models\\User', 8, 'auth_token', 'e62fda75eecc427477e51e85360042d807ba9eea63dfa449357886a802acaef4', '[\"*\"]', NULL, NULL, '2025-08-11 10:02:25', '2025-08-11 10:02:25'),
(5, 'App\\Models\\User', 9, 'auth_token', 'be32baba52d5461741efa878a07dc10d7df4cf8b262cc6387ab48917f3a24550', '[\"*\"]', '2026-03-25 11:36:56', NULL, '2025-08-11 10:03:33', '2026-03-25 11:36:56'),
(6, 'App\\Models\\User', 10, 'auth_token', 'ecc7738fd922a20b8e5bcf9290e5ed6748eb0b12fa68ba56387b9df48abf12cc', '[\"*\"]', NULL, NULL, '2025-08-12 09:16:50', '2025-08-12 09:16:50'),
(7, 'App\\Models\\User', 9, 'auth_token', 'c965a7ff313f7c931c99fa0180fb6191aea64a10e3e6a4d77075b337bf9f55b5', '[\"*\"]', NULL, NULL, '2025-08-12 11:38:14', '2025-08-12 11:38:14'),
(8, 'App\\Models\\User', 9, 'auth_token', '20a859eeb55e600c8dbd81c63a1b274fe46c3e085f6750394c03fbff2135306b', '[\"*\"]', '2025-08-12 11:42:06', NULL, '2025-08-12 11:42:00', '2025-08-12 11:42:06'),
(9, 'App\\Models\\User', 9, 'auth_token', '95b2c22089f6b49c22ef54a6e8467c2578d851a5ced37c301c969f88279a060d', '[\"*\"]', '2025-08-12 11:57:15', NULL, '2025-08-12 11:57:10', '2025-08-12 11:57:15'),
(10, 'App\\Models\\User', 9, 'auth_token', '623f1c666066a8e6076410f4dac418e6507f21cc83dbd9ffe4e0dbc9a18cea31', '[\"*\"]', '2025-08-12 12:27:48', NULL, '2025-08-12 12:27:42', '2025-08-12 12:27:48'),
(11, 'App\\Models\\User', 9, 'auth_token', '0eacfc76ef516677a5f86cca76bd4e6f633e56fdcef282cd0be717ea071873f2', '[\"*\"]', '2025-08-12 12:29:02', NULL, '2025-08-12 12:28:56', '2025-08-12 12:29:02'),
(12, 'App\\Models\\User', 9, 'auth_token', 'bf250bb131ae9f359f616382dbc5d216c1dfb6ce0b0a4481a1c3b5d149170d7c', '[\"*\"]', '2025-08-12 12:30:52', NULL, '2025-08-12 12:30:46', '2025-08-12 12:30:52'),
(13, 'App\\Models\\User', 9, 'auth_token', '49e445d2aa947bec82b832b947e13d3e1ebc472c320c80fe7f1559e98e879889', '[\"*\"]', '2025-08-12 12:42:46', NULL, '2025-08-12 12:38:56', '2025-08-12 12:42:46'),
(14, 'App\\Models\\User', 9, 'auth_token', '22680959aaabbca35dd20deef411ada5847472768c57556426197c5702494fc7', '[\"*\"]', '2025-08-12 12:53:39', NULL, '2025-08-12 12:53:27', '2025-08-12 12:53:39'),
(15, 'App\\Models\\User', 9, 'auth_token', '36cb8dd3e622f3ef38d4859e38e136e86fb680cb3fc68d3c6ee2e230fed04d74', '[\"*\"]', '2025-08-12 12:57:30', NULL, '2025-08-12 12:57:18', '2025-08-12 12:57:30'),
(16, 'App\\Models\\User', 9, 'auth_token', '75c76d065809af1a24e9c601b1f6d1daf6c7a19a51beca66ee136e867a9a4c44', '[\"*\"]', '2025-08-13 05:13:50', NULL, '2025-08-13 05:13:24', '2025-08-13 05:13:50'),
(17, 'App\\Models\\User', 9, 'auth_token', '29da604964ab28f49af7e469341e6be5e3349b156074f9c79ec463dbac1ac702', '[\"*\"]', '2025-08-13 05:21:05', NULL, '2025-08-13 05:20:53', '2025-08-13 05:21:05'),
(18, 'App\\Models\\User', 9, 'auth_token', 'd33a61f303a5b3abad468bb5e03c846e44372166b446f1b213205768db0a5f8f', '[\"*\"]', '2025-08-13 05:37:11', NULL, '2025-08-13 05:23:38', '2025-08-13 05:37:11'),
(19, 'App\\Models\\User', 9, 'auth_token', '58cc8cd2252f5bb35941c1fbc313992c3910d737ae4a1b35c64c4199360d85e3', '[\"*\"]', '2025-08-13 05:44:56', NULL, '2025-08-13 05:44:51', '2025-08-13 05:44:56'),
(20, 'App\\Models\\User', 9, 'auth_token', '0eae3f9f416a93062ca989363e6c634255dbb49c95b6963d3d491f30a6b4a3c4', '[\"*\"]', '2025-08-13 06:47:01', NULL, '2025-08-13 06:03:04', '2025-08-13 06:47:01'),
(21, 'App\\Models\\User', 9, 'auth_token', 'cca6238f04c7a9bd10cf5943f178404edc0244f10aca8cdd71c703d8c9eb0635', '[\"*\"]', '2025-08-13 07:02:22', NULL, '2025-08-13 06:48:36', '2025-08-13 07:02:22'),
(22, 'App\\Models\\User', 9, 'auth_token', 'f61c414f7bbd19480005225d7b2c048a278ba84c162a219522f62a3f18b745a8', '[\"*\"]', '2025-08-13 07:38:26', NULL, '2025-08-13 07:38:20', '2025-08-13 07:38:26'),
(23, 'App\\Models\\User', 9, 'auth_token', '8d99b9d19a1072b59d80845f511383dd73fc81ac5fb112ae465997d1547b077c', '[\"*\"]', '2025-08-13 07:46:56', NULL, '2025-08-13 07:46:50', '2025-08-13 07:46:56'),
(24, 'App\\Models\\User', 9, 'auth_token', 'ab71a19f7e61151470b7725557ccbf1de35e6ee679406bc76e61714ce875a6ec', '[\"*\"]', NULL, NULL, '2025-08-13 08:13:32', '2025-08-13 08:13:32'),
(25, 'App\\Models\\User', 9, 'auth_token', 'b8b68fe9618cbf6a2f2726a9c9a6436802edc56870013d69ead1eddcab402c7d', '[\"*\"]', '2025-08-13 08:25:28', NULL, '2025-08-13 08:25:22', '2025-08-13 08:25:28'),
(26, 'App\\Models\\User', 9, 'auth_token', '5f8dd77e08764325c60160e7330d24b1314842a5432b57a419125e01cfa58370', '[\"*\"]', '2025-08-13 08:47:29', NULL, '2025-08-13 08:34:19', '2025-08-13 08:47:29'),
(27, 'App\\Models\\User', 9, 'auth_token', 'f0bf2bcbd9185d971720940cfe8a67f62ed4d84c82bad127ddbb302d0c4e19b6', '[\"*\"]', '2025-08-13 08:49:07', NULL, '2025-08-13 08:49:01', '2025-08-13 08:49:07'),
(28, 'App\\Models\\User', 9, 'auth_token', '840e0dabc65331257af729460f4545597805b53a76a4b9bfe1848636566ea197', '[\"*\"]', '2025-08-13 08:58:29', NULL, '2025-08-13 08:57:15', '2025-08-13 08:58:29'),
(29, 'App\\Models\\User', 9, 'auth_token', 'c231efcc6e2c9e6154bfd4a1223cbf0ddccf211e01baac7ad38ef292161a7253', '[\"*\"]', '2025-08-13 08:59:55', NULL, '2025-08-13 08:59:49', '2025-08-13 08:59:55'),
(30, 'App\\Models\\User', 9, 'auth_token', 'e835a22f6f8dd3b6cdcab30bceb01d98a26737970111b527758ad6a9b86e7fd2', '[\"*\"]', '2025-08-13 09:05:18', NULL, '2025-08-13 09:05:12', '2025-08-13 09:05:18'),
(31, 'App\\Models\\User', 9, 'auth_token', 'c6870f3b693727652b6c6af0d808eb8f073a5344cc8fc7db95ecfb8aaad9e849', '[\"*\"]', '2025-08-13 09:12:38', NULL, '2025-08-13 09:12:32', '2025-08-13 09:12:38'),
(32, 'App\\Models\\User', 9, 'auth_token', '5a6ba3c4b6683ddc04d042ca0fc35ae8bdce957166eaef4c42de83a71d37b6cd', '[\"*\"]', NULL, NULL, '2025-08-13 09:15:20', '2025-08-13 09:15:20'),
(33, 'App\\Models\\User', 9, 'auth_token', '5c0ade70007ccf86116a48bdcdb2bf93b1743097e8b2e42249aaa19fa6320a20', '[\"*\"]', NULL, NULL, '2025-08-13 09:20:54', '2025-08-13 09:20:54'),
(34, 'App\\Models\\User', 9, 'auth_token', '994a81876c98b38f156edb6f38a72415b1f6449dee5e48291ae92f2750134ddb', '[\"*\"]', NULL, NULL, '2025-08-13 09:26:34', '2025-08-13 09:26:34'),
(35, 'App\\Models\\User', 9, 'auth_token', '7d0ab5ef423dec308306cacd0b04a994639a8f71b7f5b282096eaea2f9226381', '[\"*\"]', '2025-08-13 09:33:08', NULL, '2025-08-13 09:31:20', '2025-08-13 09:33:08'),
(36, 'App\\Models\\User', 9, 'auth_token', '6767915b2707a5c3f0c6a49f0cbc6191c6380779f2b37616517defbdcd735221', '[\"*\"]', '2025-08-13 09:37:41', NULL, '2025-08-13 09:37:35', '2025-08-13 09:37:41'),
(37, 'App\\Models\\User', 9, 'auth_token', 'cdc2d2eaaf8dc93c784e5da9d12d10739d1ca31895ef3428e136395ed91723fd', '[\"*\"]', '2025-08-13 09:55:41', NULL, '2025-08-13 09:45:21', '2025-08-13 09:55:41'),
(38, 'App\\Models\\User', 9, 'auth_token', '3ab17518b87e9066e10ececfbacb85fce17cbd89eb413d13965b631c572d5381', '[\"*\"]', '2025-08-13 09:57:47', NULL, '2025-08-13 09:57:40', '2025-08-13 09:57:47'),
(39, 'App\\Models\\User', 9, 'auth_token', '58da281179028f560d91decc8c3096d5a2193dda7580b1866f115642a9c9591f', '[\"*\"]', '2025-08-13 10:13:26', NULL, '2025-08-13 10:13:21', '2025-08-13 10:13:26'),
(40, 'App\\Models\\User', 9, 'auth_token', '0a38de2a26eb31cd959b1b575ede500e84bf7d25bf9701d95a72aacabf1b1da3', '[\"*\"]', '2025-08-13 10:20:04', NULL, '2025-08-13 10:19:57', '2025-08-13 10:20:04'),
(41, 'App\\Models\\User', 9, 'auth_token', '24238d77f2bb19bd2e5817e55f2cd2c60422546443eb41c7e8c5f2eb3b999cdd', '[\"*\"]', '2025-08-13 10:20:59', NULL, '2025-08-13 10:20:53', '2025-08-13 10:20:59'),
(42, 'App\\Models\\User', 9, 'auth_token', '7a529fcad110c75bbaa716760e195a2177166c2a52610328a5a4943a22f16a51', '[\"*\"]', '2025-08-13 10:43:30', NULL, '2025-08-13 10:43:25', '2025-08-13 10:43:30'),
(43, 'App\\Models\\User', 9, 'auth_token', '8e3ac6dd5ee463e5f06d7599f5509a738281eb9afc08ffe98115cbdbc6f48a64', '[\"*\"]', '2025-08-13 10:55:21', NULL, '2025-08-13 10:55:13', '2025-08-13 10:55:21'),
(44, 'App\\Models\\User', 9, 'auth_token', 'ca89b8a7bf8a165796e3bd5e535eac96fbf24233a479f3f82ba995612168c6eb', '[\"*\"]', '2025-08-13 10:59:36', NULL, '2025-08-13 10:59:30', '2025-08-13 10:59:36'),
(45, 'App\\Models\\User', 15, 'auth_token', 'f2e0a2448c1d74e954634fcc54bb93b5138fb428aba0f6765e7e772a671554ea', '[\"*\"]', NULL, NULL, '2025-08-13 11:31:34', '2025-08-13 11:31:34'),
(46, 'App\\Models\\User', 15, 'auth_token', '9cd20c1d26729eedcad1c67c1a8dbd00552c8ae81676d3dffdbe1acee1556d60', '[\"*\"]', NULL, NULL, '2025-08-13 11:33:03', '2025-08-13 11:33:03'),
(47, 'App\\Models\\User', 16, 'auth_token', '6421765e606372f67c97789d5dcdb7dea9417dce073d641095f42fbf51c6bf42', '[\"*\"]', NULL, NULL, '2025-08-13 11:35:22', '2025-08-13 11:35:22'),
(48, 'App\\Models\\User', 12, 'auth_token', 'd95bbe8a4ef72a496a85c9f2f4b41a933c7db5a1c204ac62ab02489dcd7b20c5', '[\"*\"]', NULL, NULL, '2025-08-13 11:37:57', '2025-08-13 11:37:57'),
(49, 'App\\Models\\User', 17, 'auth_token', 'b1d1dc161e7d33d7892cf5f842e1c3f34b153bd264cc0be1574263ead7ed2b05', '[\"*\"]', NULL, NULL, '2025-08-13 11:43:02', '2025-08-13 11:43:02'),
(50, 'App\\Models\\User', 18, 'auth_token', '63fb0d518ad05f4f7f37a8b393398247d7c753aa4b43b024ae3a7a71a48dc7c4', '[\"*\"]', '2025-08-13 11:45:34', NULL, '2025-08-13 11:44:46', '2025-08-13 11:45:34'),
(51, 'App\\Models\\User', 18, 'auth_token', 'bb7e60acc404e0ab86cdef2f5440b507e24ce7704fc75e22c35594aa27b6c3d5', '[\"*\"]', '2025-08-13 11:49:35', NULL, '2025-08-13 11:49:29', '2025-08-13 11:49:35'),
(52, 'App\\Models\\User', 12, 'auth_token', '858d477237df0a44dc7e89a772a6fbb57efef8cb095fdbf33d135b48188d0d10', '[\"*\"]', '2025-08-13 12:18:53', NULL, '2025-08-13 12:18:47', '2025-08-13 12:18:53'),
(53, 'App\\Models\\User', 9, 'auth_token', '7455ede9e5732be2c92c404b1e1b64aeade5f81f87202a3f7f69d028bf612740', '[\"*\"]', '2025-08-13 12:32:32', NULL, '2025-08-13 12:32:27', '2025-08-13 12:32:32'),
(54, 'App\\Models\\User', 12, 'auth_token', 'a5a3a7430df0a29a28b1ece22807ab6b134d00ce1251903e05a3df799bd2add9', '[\"*\"]', '2025-08-13 12:44:41', NULL, '2025-08-13 12:44:35', '2025-08-13 12:44:41'),
(55, 'App\\Models\\User', 12, 'auth_token', '87cf6292fa5245675f9b69386b4d6ecc3b048949d47b6456696cb1c4ad2f0e0d', '[\"*\"]', '2025-08-13 12:57:00', NULL, '2025-08-13 12:47:48', '2025-08-13 12:57:00'),
(56, 'App\\Models\\User', 19, 'auth_token', 'df98297bc2e632aa9d2b128725fca62f527e98bcb78cfed4738b02caa92affe3', '[\"*\"]', '2025-08-13 13:07:51', NULL, '2025-08-13 13:05:13', '2025-08-13 13:07:51'),
(57, 'App\\Models\\User', 20, 'auth_token', 'dead3c33b3933ec2a64f735672da4d31efc3e12f080f2f2e8abb3abbffa523b9', '[\"*\"]', NULL, NULL, '2025-08-13 13:12:44', '2025-08-13 13:12:44'),
(58, 'App\\Models\\User', 9, 'auth_token', 'c973ef2ae1d864a47fbe694b51fddb155b6fd0a89d21060346887bda67402893', '[\"*\"]', NULL, NULL, '2025-08-13 13:21:30', '2025-08-13 13:21:30'),
(59, 'App\\Models\\User', 9, 'auth_token', '91f9d8640150269f8356b1b8c4714a2fcc5eb6262ccdeb1e4bdf269bfb9f14ee', '[\"*\"]', NULL, NULL, '2025-08-13 13:22:16', '2025-08-13 13:22:16'),
(60, 'App\\Models\\User', 9, 'auth_token', '39bba6f6535eb10fc0e5632ba6a3075be858c7fe9582ab3510be4f222acf0bef', '[\"*\"]', NULL, NULL, '2025-08-13 13:23:06', '2025-08-13 13:23:06'),
(61, 'App\\Models\\User', 9, 'auth_token', '5c32a6de6201d99fe15af1a9519b96ee136b5c43a67733774c3febd3983f9ed7', '[\"*\"]', '2025-08-14 06:40:03', NULL, '2025-08-14 06:22:02', '2025-08-14 06:40:03'),
(62, 'App\\Models\\User', 21, 'auth_token', '7191f9e33833948e1aab4cc885026a4b2f14f2a0a2a9bc5ad4f9e2bbd08100b6', '[\"*\"]', '2026-03-24 11:31:05', NULL, '2025-08-14 06:41:21', '2026-03-24 11:31:05'),
(63, 'App\\Models\\User', 9, 'auth_token', '9dddaae8c97bbcd195f21d08a7c6148342b8255c0fda04d0651130c7be5e1dcc', '[\"*\"]', '2025-08-14 08:51:12', NULL, '2025-08-14 08:50:40', '2025-08-14 08:51:12'),
(64, 'App\\Models\\User', 22, 'auth_token', '1f9cfc9a25b8022d99a3d2d524d4ad08c1b375286235effa41cdd4528994dc4e', '[\"*\"]', '2025-08-14 08:57:24', NULL, '2025-08-14 08:53:55', '2025-08-14 08:57:24'),
(65, 'App\\Models\\User', 9, 'auth_token', 'e0677b502c6332646ce9772a84eda43db9d09cef0caecbb3d96ef178ad813f36', '[\"*\"]', '2025-08-14 09:00:08', NULL, '2025-08-14 08:54:06', '2025-08-14 09:00:08'),
(66, 'App\\Models\\User', 9, 'auth_token', '9e9ab71c7c737239aa1213bb84eb3b4a2bed4a3896a1e0083c3ce83abef7ef0c', '[\"*\"]', '2025-08-14 09:43:36', NULL, '2025-08-14 09:09:36', '2025-08-14 09:43:36'),
(67, 'App\\Models\\User', 23, 'auth_token', '5c5ab680d594e26f213d2ac11c674b7a63dc8c4178c277b13b9d0280a3e0e73c', '[\"*\"]', '2025-08-14 09:16:43', NULL, '2025-08-14 09:16:38', '2025-08-14 09:16:43'),
(68, 'App\\Models\\User', 25, 'auth_token', '8d5bf121b5b0d071c6ee42903935a7f1347cdea74369db9496145e75eccde875', '[\"*\"]', '2025-08-14 10:00:14', NULL, '2025-08-14 09:58:49', '2025-08-14 10:00:14'),
(69, 'App\\Models\\User', 9, 'auth_token', 'fb8c5ffb44e9bd95b1f3f0e503678a196ba7fa458219504afec635e8b56a1867', '[\"*\"]', '2025-08-14 10:11:17', NULL, '2025-08-14 10:11:11', '2025-08-14 10:11:17'),
(70, 'App\\Models\\User', 26, 'auth_token', 'a95af5408bab46eb79f0e1f98edf3d00ca651feb1a384928d9b7c8564251f839', '[\"*\"]', '2025-08-14 10:12:20', NULL, '2025-08-14 10:12:14', '2025-08-14 10:12:20'),
(71, 'App\\Models\\User', 9, 'auth_token', 'ae42868ffffeb9a88d329f5690eac7c299e1287d1e347d676674294f73e2c3f8', '[\"*\"]', '2025-08-14 10:15:47', NULL, '2025-08-14 10:15:41', '2025-08-14 10:15:47'),
(72, 'App\\Models\\User', 27, 'auth_token', 'c289dc1cb16117b269931864968f5635b9e19fd404a0d9c776ecc7930d3ec686', '[\"*\"]', '2025-08-14 11:00:00', NULL, '2025-08-14 10:57:48', '2025-08-14 11:00:00'),
(73, 'App\\Models\\User', 9, 'auth_token', '0aa48458e439ed24b73f7bedb1c8caeb2872908d0bae34293891e6081070994f', '[\"*\"]', '2025-08-14 11:01:50', NULL, '2025-08-14 11:01:14', '2025-08-14 11:01:50'),
(74, 'App\\Models\\User', 29, 'auth_token', 'bb6e942ae2b84d91eb71b72270b0d1d260462a3cb6153b7d58bb78ab580ed261', '[\"*\"]', '2025-08-14 11:18:04', NULL, '2025-08-14 11:17:59', '2025-08-14 11:18:04'),
(75, 'App\\Models\\User', 30, 'auth_token', '024170df89fe3cb06ad946758bcf7f07ba55cebd7766552ba8a8af5efaf7ce99', '[\"*\"]', '2025-08-14 11:23:16', NULL, '2025-08-14 11:23:10', '2025-08-14 11:23:16'),
(76, 'App\\Models\\User', 31, 'auth_token', '03bac210efd48edad1b170e12dce058e8b72afc534d07440f260027900ab1acc', '[\"*\"]', '2025-08-14 11:43:11', NULL, '2025-08-14 11:43:05', '2025-08-14 11:43:11'),
(77, 'App\\Models\\User', 32, 'auth_token', 'c64de8e8df714477a5f196f2fae1645d70d774e55edc1767da0861c2778aa819', '[\"*\"]', '2025-08-14 11:44:29', NULL, '2025-08-14 11:44:23', '2025-08-14 11:44:29'),
(78, 'App\\Models\\User', 30, 'auth_token', '03802d1443076f7324d8fcf635c43a3e45881e43fea5d51a39f166276e4a00b4', '[\"*\"]', '2025-08-14 11:46:00', NULL, '2025-08-14 11:45:54', '2025-08-14 11:46:00'),
(79, 'App\\Models\\User', 9, 'auth_token', 'f8ca8c203c8ca81d14e9a36e11ab9c09d288665ce8af6f86aa207d2ff69fe368', '[\"*\"]', '2025-08-14 12:45:58', NULL, '2025-08-14 11:46:35', '2025-08-14 12:45:58'),
(80, 'App\\Models\\User', 32, 'auth_token', 'f16aab36513c89f9668390cb0afc0382bb1c14a8c2fc240c62e73aa0b215017c', '[\"*\"]', '2025-08-14 12:18:14', NULL, '2025-08-14 12:18:09', '2025-08-14 12:18:14'),
(81, 'App\\Models\\User', 30, 'auth_token', '0684e869ec05ea77dfab8af3c7510b85f4bc01cddec53830e3d4d314bfe77f66', '[\"*\"]', '2026-01-25 14:28:30', NULL, '2025-08-14 12:26:59', '2026-01-25 14:28:30'),
(82, 'App\\Models\\User', 29, 'auth_token', '9afa3d2013e0d012e0bdec7589bf512dac2a6090d002663199a863fb2e2dacfb', '[\"*\"]', '2025-08-14 12:35:27', NULL, '2025-08-14 12:35:22', '2025-08-14 12:35:27'),
(83, 'App\\Models\\User', 32, 'auth_token', 'cc5472c886a52fed850adc94a921f5be006605838c0d861f2ca2bc1b41a05454', '[\"*\"]', '2025-08-14 12:39:02', NULL, '2025-08-14 12:37:16', '2025-08-14 12:39:02'),
(84, 'App\\Models\\User', 33, 'auth_token', '0ca7be325606a7d459bdee882acc7c04dee0e1f90818128cade758e3c5da8da0', '[\"*\"]', '2025-12-10 11:31:35', NULL, '2025-12-10 11:31:30', '2025-12-10 11:31:35'),
(85, 'App\\Models\\User', 34, 'auth_token', '94cc51a629fe545bfbfa5a5bd287861a3ba2e4c0fa60b9da7fb170badc8b5f25', '[\"*\"]', NULL, NULL, '2026-03-23 11:33:12', '2026-03-23 11:33:12'),
(86, 'App\\Models\\User', 34, 'auth_token', 'db109f01da8ff03cba8aab274fe1c05c834d3d34b52a711c03b0915a68c02d7e', '[\"*\"]', NULL, NULL, '2026-03-23 11:46:09', '2026-03-23 11:46:09'),
(87, 'App\\Models\\User', 34, 'auth_token', '2feee1b5f59eca4e1782868dbcd92457eaadf82f4c1e54852d13ba7027d5e7bc', '[\"*\"]', NULL, NULL, '2026-03-23 14:08:37', '2026-03-23 14:08:37'),
(88, 'App\\Models\\User', 34, 'auth_token', '3cd6547f3f09f440a51e6dbc04b04a520f099c771696263508196b027b5dbd03', '[\"*\"]', NULL, NULL, '2026-03-24 08:34:23', '2026-03-24 08:34:23'),
(89, 'App\\Models\\User', 34, 'auth_token', '8aa0becd07f274257d3687414dcf6b9277bd1e94110512c70cc72de619bf98bd', '[\"*\"]', NULL, NULL, '2026-03-24 08:46:53', '2026-03-24 08:46:53'),
(90, 'App\\Models\\User', 34, 'auth_token', 'dd247dffddba6c8ab342c3e14029c55bacb367c5745809379eef81c8cff66c58', '[\"*\"]', NULL, NULL, '2026-03-24 08:47:49', '2026-03-24 08:47:49'),
(91, 'App\\Models\\User', 34, 'auth_token', 'b1b290e9ad926e431843e4de62eec220433ab3d429d135748615cab08f6abf85', '[\"*\"]', NULL, NULL, '2026-03-24 08:47:51', '2026-03-24 08:47:51'),
(92, 'App\\Models\\User', 34, 'auth_token', '5c105831bec53beac127a820545887109c9447c64d707abd5768cf92d5eaadc7', '[\"*\"]', NULL, NULL, '2026-03-24 08:52:05', '2026-03-24 08:52:05'),
(93, 'App\\Models\\User', 34, 'auth_token', 'e40db9e9fd4ef14bb8bb7df7798f3639cb588a255203431f17d6c571be6e4b90', '[\"*\"]', '2026-03-24 15:24:52', NULL, '2026-03-24 08:59:14', '2026-03-24 15:24:52'),
(94, 'App\\Models\\User', 34, 'auth_token', 'a51564b415795829768a14ebf412007904be05134abaae08050e7c4691c17f67', '[\"*\"]', NULL, NULL, '2026-03-24 14:05:23', '2026-03-24 14:05:23'),
(95, 'App\\Models\\User', 9, 'auth_token', '0135e1a2a95970b1d7260721556c668facef3280467639cf4342911d0721b5dd', '[\"*\"]', NULL, NULL, '2026-03-25 11:37:07', '2026-03-25 11:37:07'),
(96, 'App\\Models\\User', 9, 'auth_token', 'ef730ca1fe83366065d542afa9f38dbdd10f54975cf57a0eb7aa995e21ab5b17', '[\"*\"]', '2026-04-12 08:55:31', NULL, '2026-03-26 10:55:18', '2026-04-12 08:55:31'),
(97, 'App\\Models\\User', 9, 'auth_token', '84e693d4f31e63c496f916220923ccccd2b03d2afd5c6674c2a0ed8d6dd72b19', '[\"*\"]', '2026-04-12 08:56:24', NULL, '2026-04-12 08:56:23', '2026-04-12 08:56:24'),
(98, 'App\\Models\\User', 9, 'auth_token', 'a1312356fa672ba03edecee03f05d506cb9f6534e591109ebdbbd68282a484a3', '[\"*\"]', '2026-04-12 09:55:42', NULL, '2026-04-12 09:24:39', '2026-04-12 09:55:42'),
(99, 'App\\Models\\User', 9, 'auth_token', 'f7d581d75d8a647e4e908fbaf387e812cc052dfe39d2ef74c8653116d2fb80de', '[\"*\"]', '2026-04-12 13:29:37', NULL, '2026-04-12 09:56:21', '2026-04-12 13:29:37'),
(100, 'App\\Models\\User', 9, 'auth_token', '51d416b1cfc16348daee29a021f3c4e4df398abc0f8793318ee8444c8adaac90', '[\"*\"]', '2026-04-12 15:23:24', NULL, '2026-04-12 13:36:39', '2026-04-12 15:23:24'),
(101, 'App\\Models\\User', 9, 'auth_token', 'f83491df8eecddbadc1e28f378b68497eb37f7eea46997018ac6bda01f7b6f90', '[\"*\"]', '2026-04-15 20:12:05', NULL, '2026-04-15 20:10:42', '2026-04-15 20:12:05');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'web', '2025-08-12 07:15:44', '2025-08-12 07:15:44'),
(2, 'admin', 'web', '2025-08-12 07:15:44', '2025-08-12 07:15:44'),
(5, 'employee11', 'web', '2025-08-12 08:18:35', '2025-08-12 08:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(1, 2),
(2, 2),
(3, 2),
(2, 5),
(3, 5),
(5, 5),
(7, 5),
(9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0xqrvmPLKrn0M3e8D5frAzL3h5J0xoYcGXmnH84r', NULL, '209.124.66.7', 'Internal domain checker - (domain_check.py)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibEpjenVVbUx6TGY3T2w4NkhUOVdManVkOXBMbHI1aWRIeHJwY2ExZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vaGV6Yi1lbC1zaGFhYi5tb2J0ZWFtLnNpdGUvYXV0aC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6NTA6Imh0dHBzOi8vaGV6Yi1lbC1zaGFhYi5tb2J0ZWFtLnNpdGUvYWRtaW4vZGFzaGJvYXJkIjt9fQ==', 1778468565),
('4JUzxkZHNrfbWm1eGbrfL4htQbdbr7yqUvvFAHH2', NULL, '185.122.115.106', 'Mozilla/5.0 (Linux; U; Android 13; sk-sk; Xiaomi 11T Pro Build/TKQ1.220829.002) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/112.0.5615.136 Mobile Safari/537.36 XiaoMi/MiuiBrowser/14.4.0-g', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZmVWbzhwTm5SMkZuY0JpRFExeVk4YzFiVnZidFg1S25ic1poU0hkTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly93d3cuaGV6Yi1lbC1zaGFhYi5tb2J0ZWFtLnNpdGUvYXV0aC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1778511955),
('AVSZqhJX2CsQoSDdCheo1nZPbE7rUJP2Zn8a2sVc', NULL, '54.188.239.75', 'Mozilla/5.0 (X11; Linux i686; rv:124.0) Gecko/20100101 Firefox/124.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSkpzbEJKckR5M2k0QUFleDhpRWh2WGJ5cHNxYnVEbjBQNkc3blZYdCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1NDoiaHR0cHM6Ly93d3cuaGV6Yi1lbC1zaGFhYi5tb2J0ZWFtLnNpdGUvYWRtaW4vZGFzaGJvYXJkIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vd3d3LmhlemItZWwtc2hhYWIubW9idGVhbS5zaXRlL2FkbWluL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1778570943),
('cRxn9lkevCqeya6DTQ7u9Hcibkbq244fMHbjdzaI', NULL, '3.249.231.193', 'Mozilla/5.0 (compatible; NetcraftSurveyAgent/1.0; +info@netcraft.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT3ZDREtvUjVIZDdjMnJkSjNSYjRSZEJCQTA3SHJKYkVJNlBId2I4WCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vaGV6Yi1lbC1zaGFhYi5tb2J0ZWFtLnNpdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1778544478),
('e98z2xcgnkLcJZgzsEOyDpPtuqof2Q77dAR6NEm0', NULL, '185.247.137.60', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOXJQODd2U0JLaDB0cXI5dzl5YW1VV1plUzVRUWNhNk1KSXZnTlR4WCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vaGV6Yi1lbC1zaGFhYi5tb2J0ZWFtLnNpdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1778534403),
('eNoDDpFAZTjgkjq9z4zUQnWNUqHLUwscdakkR64q', NULL, '209.124.66.12', 'Internal domain checker - (domain_check.py)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiT2hZVFVIWTdBUnlTWFdkV2U2Y2kyYkxVSHFFNXhqc0NxWjJ6OEk2eCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vaGV6Yi1lbC1zaGFhYi5tb2J0ZWFtLnNpdGUvYXV0aC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6NTA6Imh0dHBzOi8vaGV6Yi1lbC1zaGFhYi5tb2J0ZWFtLnNpdGUvYWRtaW4vZGFzaGJvYXJkIjt9fQ==', 1778456505),
('HA9Srkm5twFJNYi6SGsXM0dxYq9JQLRDoQBXpbeZ', NULL, '35.252.100.249', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoielNGVXdNVFBFRTJURVk4SE9VbmFKTjQ5Z3ZHdnQ1TkhhQnZMUzB5ayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly93d3cuaGV6Yi1lbC1zaGFhYi5tb2J0ZWFtLnNpdGUvYXV0aC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1778510961),
('IjelYn5VfmLmdS0pfzxfw5ofP6d9TmqTNpKgIHmE', NULL, '156.204.166.195', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiR3ZSRk9UalFLREt2TkRsTWZaMWpDSWk3T1dFVGVQVjVaQ0VjaXFMRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vaGV6Yi1lbC1zaGFhYi5tb2J0ZWFtLnNpdGUvYXV0aC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6NTA6Imh0dHBzOi8vaGV6Yi1lbC1zaGFhYi5tb2J0ZWFtLnNpdGUvYWRtaW4vZGFzaGJvYXJkIjt9fQ==', 1778681950),
('KKII4pWiaReA8a0VvTjKoRz6nkF4E4nI4zHVTgKz', NULL, '35.252.100.249', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieDFEeEhBUHI0b3hja0hCQTkycVJwNTRNTDIwbDhsU1FXeE1DRkRmTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly93d3cuaGV6Yi1lbC1zaGFhYi5tb2J0ZWFtLnNpdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1778510958),
('Kuk9yDUuGIssu2uiXNiRvmVN5tXF6atYbHB8VEgu', NULL, '167.94.146.57', 'Mozilla/5.0 (compatible; CensysInspect/1.1; +https://about.censys.io/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFR5MTZ5a05NU3pqUmlTa1daNFk3VENPVFJrRWhIQUVpNWxBVkwwTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9oZXpiLWVsLXNoYWFiLm1vYnRlYW0uc2l0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1778567244),
('l9RY6Y79ppSZOosLS07xBidoTJsV7DbTWcQHlVcw', NULL, '35.252.100.249', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZFM3a09MYXVtSE9MNTBOWTBhU1MwU2hGS2o4Y2JHMkpCdDlidHZDVCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1MzoiaHR0cDovL3d3dy5oZXpiLWVsLXNoYWFiLm1vYnRlYW0uc2l0ZS9hZG1pbi9kYXNoYm9hcmQiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo1MzoiaHR0cDovL3d3dy5oZXpiLWVsLXNoYWFiLm1vYnRlYW0uc2l0ZS9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1778510960),
('O2EL6AZs0WZO8otDsyVox8Ft5qg7Ds1x00dGuJ49', NULL, '32.184.1.235', 'Mozilla/5.0 (compatible; wpbot/1.4; +https://forms.gle/ajBaxygz9jSR8p8G9)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNmwybzBjYm45OGlsZWpiNlJaekZEemxLdG9SY3I1azRyeXZVb0JpbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vaGV6Yi1lbC1zaGFhYi5tb2J0ZWFtLnNpdGUvYXV0aC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6NTA6Imh0dHBzOi8vaGV6Yi1lbC1zaGFhYi5tb2J0ZWFtLnNpdGUvYWRtaW4vZGFzaGJvYXJkIjt9fQ==', 1778504157),
('PONhOVrScUecpmKdEMOSRS1lo06YQ5zdho5Hpb1O', NULL, '167.94.146.57', 'Mozilla/5.0 (compatible; CensysInspect/1.1; +https://about.censys.io/)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSzh3MlB5UlhBTmdLZW5JQzBRbUFST0VqVGNERzdKR1VZaWxJSE9SZSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0OToiaHR0cDovL2hlemItZWwtc2hhYWIubW9idGVhbS5zaXRlL2FkbWluL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ5OiJodHRwOi8vaGV6Yi1lbC1zaGFhYi5tb2J0ZWFtLnNpdGUvYWRtaW4vZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778567244),
('rDqfs6Xay4ajhJhqk0LThAa4HyiHbLEQaY421Zhj', NULL, '87.236.176.249', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidnMxS0V2MTFUNUFwVjN3SkpSUm82OFk1dGxGczRNdFR1ZWpPakFUeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9oZXpiLWVsLXNoYWFiLm1vYnRlYW0uc2l0ZS9hdXRoL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0OToiaHR0cDovL2hlemItZWwtc2hhYWIubW9idGVhbS5zaXRlL2FkbWluL2Rhc2hib2FyZCI7fX0=', 1778515228),
('rVH3CcwPCGsG5OAANVQBKFze0fveGgbdkh8eOk36', NULL, '185.247.137.60', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRVR3SDQwUUpMWmJJRUdEQ2pPdnZ2T2RmV1Y1SXk1THpsTWNiNlYyaSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1MDoiaHR0cHM6Ly9oZXpiLWVsLXNoYWFiLm1vYnRlYW0uc2l0ZS9hZG1pbi9kYXNoYm9hcmQiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo1MDoiaHR0cHM6Ly9oZXpiLWVsLXNoYWFiLm1vYnRlYW0uc2l0ZS9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1778534403),
('rWUnNd0lOwDOY4XTjGYZDOf9fkffyOmXW1wNgaWz', NULL, '185.247.137.60', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWXBWQWpVTk1WN2xkbjhsZnBYeVVWQkhEc2JFcUJjSWUzRXBXMk5oYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vaGV6Yi1lbC1zaGFhYi5tb2J0ZWFtLnNpdGUvYXV0aC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1778534403),
('SfY0YqsCsV1fxzZGHpF1iacNeHiQdIQvBde8PXgj', NULL, '198.235.24.131', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUEk4QW1IVGdxZlo5SjZ0d25FOThKVzAzNm9lR2J4ME5OYVVkMWpDeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vd3d3LmhlemItZWwtc2hhYWIubW9idGVhbS5zaXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778583267),
('SwygHlkZUHQJkbjxPEpIxOxeTJdB0K13ysDyp98I', NULL, '147.185.132.135', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQWRwMDdzZ3IzYzNZM1gwckVmMDQ0SnF0VVJLWkoweG9WWkhKVU9kOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9oZXpiLWVsLXNoYWFiLm1vYnRlYW0uc2l0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1778597568),
('uVcty7yYbHDONOD4viMHu8Q0fFxjk5JM7d6UTOsv', NULL, '54.188.239.75', 'Mozilla/5.0 (X11; Linux i686; rv:124.0) Gecko/20100101 Firefox/124.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTHRwZ2d1QzJuNFBtQVBmc1BYT21sOWdnTnZDbDFRWGdoRWdMNGVibSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vd3d3LmhlemItZWwtc2hhYWIubW9idGVhbS5zaXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778570942),
('vaIr4kkKPSSyDcYbadvk8ZAeuEehjQRtDWQzYIr6', NULL, '34.135.194.11', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNDFURE55bUQyYlJZQWI3UXJaTXNzR3g5WGd4ejlvN0NIYmhldFBYcCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1MzoiaHR0cDovL3d3dy5oZXpiLWVsLXNoYWFiLm1vYnRlYW0uc2l0ZS9hZG1pbi9kYXNoYm9hcmQiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo1MzoiaHR0cDovL3d3dy5oZXpiLWVsLXNoYWFiLm1vYnRlYW0uc2l0ZS9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1778515329),
('VdoJbG1q5gXswMPgSescJSPfyapb5xcgF68jtQIF', NULL, '54.188.239.75', 'Mozilla/5.0 (X11; Linux i686; rv:124.0) Gecko/20100101 Firefox/124.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOW02QnZKQ2R6cUVLcFltVDJSMTVSWjJpQlVDZkZEU2tUeHFGaGQ4UiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDk6Imh0dHBzOi8vd3d3LmhlemItZWwtc2hhYWIubW9idGVhbS5zaXRlL2F1dGgvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1778570943),
('viyOHezV1CjLy1I4HrzzrtZ1uzIeeNz6FJN0gpd3', NULL, '194.103.211.97', 'Mozilla/5.0 (Linux; U; Android 13; sk-sk; Xiaomi 11T Pro Build/TKQ1.220829.002) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/112.0.5615.136 Mobile Safari/537.36 XiaoMi/MiuiBrowser/14.4.0-g', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUGlXS0JTUXBZMFgxSVNFNnBCdmdxYzBPaEdhWDBhWmw3SUwxdGhZVCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1MzoiaHR0cDovL3d3dy5oZXpiLWVsLXNoYWFiLm1vYnRlYW0uc2l0ZS9hZG1pbi9kYXNoYm9hcmQiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo1MzoiaHR0cDovL3d3dy5oZXpiLWVsLXNoYWFiLm1vYnRlYW0uc2l0ZS9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1778511955),
('xIvmlXulovbkQgtcz2GzZtKO7XapD3Nnr1MsvqgT', NULL, '194.71.229.19', 'Mozilla/5.0 (Linux; U; Android 13; sk-sk; Xiaomi 11T Pro Build/TKQ1.220829.002) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/112.0.5615.136 Mobile Safari/537.36 XiaoMi/MiuiBrowser/14.4.0-g', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNnUwM3RrUkh2RkNUdVR0ZFBGWm5ReGx2dEh5NXJiZjFjald5VHhDdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly93d3cuaGV6Yi1lbC1zaGFhYi5tb2J0ZWFtLnNpdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1778511955),
('xpZzTWz1C2nybPeOiIb9akUwzGPgy9CQFZgsNwBp', NULL, '167.94.146.57', 'Mozilla/5.0 (compatible; CensysInspect/1.1; +https://about.censys.io/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUHBCeW91dGk5eUV0R0lKRTROVkxxS1Nub3JlemdhQVA2R29KS2FSSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9oZXpiLWVsLXNoYWFiLm1vYnRlYW0uc2l0ZS9hdXRoL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778567244),
('Z727VECnLGA7EtjJVBrfiQfBue6JDR8tOQ371j4R', NULL, '34.135.194.11', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkxyU0dvUVJIU0lkMVJxWkRGRkw1WUJiNTVuQWV4ZU1LMEpQR3h1byI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly93d3cuaGV6Yi1lbC1zaGFhYi5tb2J0ZWFtLnNpdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1778515328),
('ZnZhJahf7ieOrEEsCsAiDV7ODYxHRg8KRSrClbh0', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaERSWHdCdW9IUTZqVTI5M0dIeEg5aXFoRzkweDVFa2s3WUhtUUxZUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9oZXpiLWVsLXNoYWFiLnRlc3QvYWRtaW4vZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MToiaHR0cDovL2hlemItZWwtc2hhYWIudGVzdC9hZG1pbi9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1778688558),
('ZotD3PtOSOCbcVUiYFlTr6mIFTC4rvVkg017ikAS', NULL, '34.135.194.11', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTW03U1hhVVN4cjlxajNveFNMNTVJVWl0QVYxYkhzNkw5R1l6VzRocyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly93d3cuaGV6Yi1lbC1zaGFhYi5tb2J0ZWFtLnNpdGUvYXV0aC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1778515329);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `path`, `created_at`, `updated_at`) VALUES
(1, 'slider/images/Rb1gEvpQCEXExewYDTOx0sbuEmv7BVv7Z2QG1yb1.jpg', '2025-08-12 09:56:33', '2025-08-12 09:56:33'),
(2, 'slider/images/igThnVWue6Ul3W6CGgvv8wm7hbQCFGm9eZPVofO5.jpg', '2025-08-12 09:58:28', '2025-08-12 09:58:28'),
(3, 'slider/images/DQuwP3wFmkeLpKyJ0W7Cej5rKcpF0PpAgBRI8Wc8.jpg', '2025-08-12 09:58:34', '2025-08-12 09:58:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member_id` bigint UNSIGNED DEFAULT NULL,
  `member_status` enum('pending','active','rejected') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member_reviewed_by` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `name`, `phone`, `email`, `phone_verified_at`, `password`, `status`, `image`, `national_id`, `birth_date`, `remember_token`, `created_at`, `updated_at`, `role`, `code`, `member_id`, `member_status`, `member_reviewed_by`) VALUES
(1, 'aa44m900-af47-43d4-b21f-de68820ax111', 'Admin', '0123456789', 'admin@admin.com', '2025-08-10 05:41:23', '$2y$12$0miEZOU6KReKo0lmyszxd.t6I//S8tXAVqHhB1v7iasYMz.6kz.OS', 1, NULL, NULL, NULL, 'eTxhXby454Tvr03a3vctnIzcMCx0mPXfCzzM2UHKOFcgXPfJoeFGLdb6xfHN', '2025-08-10 05:41:24', '2025-08-11 07:25:23', 'admin', NULL, NULL, NULL, NULL),
(2, '4629884d-ce53-44b6-bc6d-ba977c444fe8', 'Ahmed', '0123456897', 'Ahmed@admin.com', NULL, '$2y$12$ccku19rWErgQ4vTN0N9dueVZ4Wx9h1/2adzbrGppfXAFQbE6rNZkG', 1, 'users/images/0VampMfY8RrdVsygqYePwsQyZUrKXZcDeFKGHlRj.jpg', NULL, NULL, NULL, '2025-08-10 09:46:35', '2025-08-10 09:46:35', 'admin', NULL, NULL, NULL, NULL),
(4, '3e045938-69c5-4c98-9f94-92dffc8eea78', 'khaled1', '01224785361', 'khaled@admin.com1', NULL, '$2y$12$iH9eIX4fVyCd/Agqd.bIN.s6ErFmy.b6jPuJwyrqdWJVMouclcg3G', 1, NULL, NULL, NULL, NULL, '2025-08-10 09:48:22', '2025-08-10 10:01:59', 'admin', NULL, NULL, NULL, NULL),
(9, 'e8b9b25d-ca1c-4f17-b6fc-98bb5ce96be3', 'Ahmed', '+2011230870', 'ahmed@user.user', '2025-08-13 07:46:50', NULL, 1, 'news/images/eOAE06sGfw0ry1B8wfX6A2n2hiqrtVFcISVnmuxE.jpg', NULL, '2000-01-01', NULL, '2025-08-11 10:03:16', '2026-03-23 11:31:25', 'user', '123456', 4, 'active', 1),
(10, '37d1d84d-b735-4eb7-a340-32df3a7df1ee', 'Ahmed', '+2011230871', 'ahmed@user1.user', '2025-08-12 09:16:50', NULL, 1, NULL, NULL, '2000-01-01', NULL, '2025-08-12 09:15:46', '2025-08-12 09:16:50', 'user', NULL, 5, 'pending', NULL),
(12, '0f437458-40b4-402e-b615-73f982086a7f', 'Ahmedd', '+2011230872', 'ahmedd@user.user', '2025-08-13 11:37:57', NULL, 1, NULL, NULL, '2000-01-01', NULL, '2025-08-13 11:14:18', '2025-08-13 12:47:48', 'user', NULL, 7, 'pending', NULL),
(13, '7743805c-a887-42f1-af0f-da719f61d5bb', 'aag', '+2011230885', 'ahmedd@user.userr', NULL, NULL, 0, NULL, NULL, '2000-01-13', NULL, '2025-08-13 11:25:08', '2025-08-13 11:25:08', 'user', '123456', 8, 'pending', NULL),
(16, '92b0c4d2-31c2-419f-b187-4065c5f62067', 'test', '+2011230800', 'test@test.com', '2025-08-13 11:35:22', NULL, 1, NULL, NULL, '2000-01-04', NULL, '2025-08-13 11:35:10', '2025-08-13 11:35:22', 'user', NULL, 11, 'pending', NULL),
(17, 'd0cf928e-a1b8-4735-b71c-8b3f103eabf6', 'test', '+2011230000', 'test@admin.com', '2025-08-13 11:43:02', NULL, 1, NULL, NULL, '2000-01-19', NULL, '2025-08-13 11:42:50', '2025-08-13 11:43:02', 'user', NULL, 12, 'pending', NULL),
(18, 'cdb92eb2-5e5a-4d20-8839-1daf26ebbb0c', 'test', '+2011230001', 'test@demo.com', '2025-08-13 11:44:46', NULL, 1, NULL, NULL, '2000-01-26', NULL, '2025-08-13 11:44:36', '2025-08-13 11:49:29', 'user', NULL, 13, 'pending', NULL),
(19, '58259ad0-a191-4bfb-a380-b8397a62acec', 'test', '+2065498112', 'testt@test.com', '2025-08-13 13:05:13', NULL, 1, NULL, NULL, '2000-01-13', NULL, '2025-08-13 13:05:03', '2025-08-13 13:05:13', 'user', NULL, 14, 'pending', NULL),
(20, '600c11e2-6396-4c25-868a-f6a54fa974ba', 'Ahmed', '+20112308712', 'ahmed@user1.usera', '2025-08-13 13:12:44', NULL, 1, NULL, NULL, '2000-01-01', NULL, '2025-08-13 13:12:24', '2025-08-13 13:12:44', 'user', NULL, 15, 'pending', NULL),
(21, 'c219b3cb-b59e-44dd-b16d-5161a1d93e6d', 'ayat', '+2098765412', 'ayat@test.com', '2025-08-14 06:41:21', NULL, 1, NULL, NULL, '2000-01-26', NULL, '2025-08-14 06:41:08', '2025-08-14 06:41:21', 'user', NULL, 16, 'pending', NULL),
(27, 'e831ee5b-d116-4adf-b42f-544b022aa459', 'osama', '+201007988964', 'osamadiab097@gmail.com', '2025-08-14 10:57:48', NULL, 1, NULL, NULL, '2025-08-14', NULL, '2025-08-14 10:57:34', '2025-08-14 10:57:48', 'user', NULL, 22, 'active', 1),
(28, '4a358367-2ba9-4819-a288-f809024d4f44', 'abas', '+201140051720', 'abas@gmail.com', NULL, NULL, 0, NULL, NULL, '2000-01-27', NULL, '2025-08-14 11:09:48', '2025-08-14 11:09:48', 'user', '123456', 23, 'pending', NULL),
(29, 'ffc32b82-befd-49e6-b2cd-00edc84c2c12', 'ahh', '+201234567895', 'ahh@test.com', '2025-08-14 11:17:59', NULL, 1, NULL, NULL, '2000-01-27', NULL, '2025-08-14 11:17:48', '2025-08-14 12:35:22', 'user', NULL, 24, 'active', 1),
(30, '3ab0e55b-20a7-482e-a4a4-9512b05a56a6', 'osama', '+201122345678', 'osama@test.com', '2025-08-14 11:23:10', NULL, 1, NULL, NULL, '2000-01-20', NULL, '2025-08-14 11:22:59', '2025-08-14 12:26:59', 'user', NULL, 25, 'active', 1),
(31, '2ed36734-2d79-4ac7-a876-9b51b5476b4e', 'nada', '+201122334567', 'nada@gmail.com', '2025-08-14 11:43:05', NULL, 1, NULL, NULL, '2000-01-20', NULL, '2025-08-14 11:42:55', '2025-08-14 11:43:05', 'user', NULL, 26, 'active', 1),
(32, '9543474f-910e-42b8-bccf-be787b4f59b9', 'ahmeddd', '+201245789633', 'ahmeddd@test.com', '2025-08-14 11:44:23', NULL, 1, NULL, NULL, '2000-01-27', NULL, '2025-08-14 11:44:13', '2025-08-14 12:37:16', 'user', NULL, 27, 'active', 1),
(33, 'cd47addd-9adf-4f02-bb72-35184e95fc85', 'ayat', '+211123456789', 'ayat@gmail.con', '2025-12-10 11:31:30', NULL, 1, NULL, NULL, '2000-01-09', NULL, '2025-12-10 11:31:06', '2025-12-10 11:31:30', 'user', NULL, 28, 'pending', NULL),
(34, 'a99319c2-3350-4c98-bbcf-576ca7e486f5', 'Ahmed', '+20112308711', 'ahmedd@user1.usera', '2026-03-23 11:33:12', NULL, 1, NULL, NULL, '2000-01-01', NULL, '2026-03-23 11:32:14', '2026-03-23 11:33:30', 'user', '123456', 29, 'pending', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `candidates_slug_unique` (`slug`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `events_slug_unique` (`slug`),
  ADD KEY `events_user_id_foreign` (`user_id`);

--
-- Indexes for table `event_organizers`
--
ALTER TABLE `event_organizers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_user_event_id_foreign` (`event_id`),
  ADD KEY `event_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `event_sponsors`
--
ALTER TABLE `event_sponsors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_sponsors_event_id_foreign` (`event_id`);

--
-- Indexes for table `event_user`
--
ALTER TABLE `event_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event_user_event_id_user_id_unique` (`event_id`,`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `members_membership_number_unique` (`membership_number`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_slug_unique` (`slug`),
  ADD KEY `news_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`phone`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_member_id_foreign` (`member_id`),
  ADD KEY `users_member_reviewed_by_foreign` (`member_reviewed_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `event_organizers`
--
ALTER TABLE `event_organizers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `event_sponsors`
--
ALTER TABLE `event_sponsors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `event_user`
--
ALTER TABLE `event_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `event_organizers`
--
ALTER TABLE `event_organizers`
  ADD CONSTRAINT `event_user_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_sponsors`
--
ALTER TABLE `event_sponsors`
  ADD CONSTRAINT `event_sponsors_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_member_reviewed_by_foreign` FOREIGN KEY (`member_reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
