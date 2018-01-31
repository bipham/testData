-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 04, 2017 lúc 07:58 PM
-- Phiên bản máy phục vụ: 10.1.26-MariaDB
-- Phiên bản PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ucendu`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `host_downloads`
--

CREATE TABLE `host_downloads` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `admin_responsibility` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `host_downloads`
--

INSERT INTO `host_downloads` (`id`, `name`, `logo`, `status`, `admin_responsibility`, `created_at`, `updated_at`) VALUES
(1, 'Google Drive', 'Google Drive.jpg', 1, 1, '2017-12-03 04:35:40', '2017-12-03 04:35:40'),
(2, 'Fshare', 'Fshare.png', 1, 1, '2017-12-03 13:21:58', '2017-12-03 13:21:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `story_authors`
--

CREATE TABLE `story_authors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `introduction` text COLLATE utf8mb4_unicode_ci,
  `admin_responsibility` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `story_authors`
--

INSERT INTO `story_authors` (`id`, `name`, `avatar`, `introduction`, `admin_responsibility`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Robert Dasan', 'Robert Dasan.jpg', '<p>Lorem ipsum dolor sit amet, consectetuer<br />\r\nadipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque<br />\r\npenatibus et magnis Lorem ipsum dolor sit amet, consectetuer adipiscing elit. . Cum sociisnatoque penatibus et magnis&hellip;</p>', 1, 1, '2017-12-04 14:35:09', '2017-12-04 14:35:09'),
(2, 'Patrick Wigan', 'Patrick Wigan.jpg', '<p>Lorem ipsum dolor sit amet, consectetuer<br />\r\nadipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque<br />\r\npenatibus et magnis Lorem ipsum dolor sit amet, consectetuer adipiscing elit. . Cum sociisnatoque penatibus et magnis&hellip;</p>', 1, 1, '2017-12-04 14:35:33', '2017-12-04 14:35:33'),
(3, 'Blackmon Evans', 'Blackmon Evans.jpg', '<p>Lorem ipsum dolor sit amet, consectetuer<br />\r\nadipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque<br />\r\npenatibus et magnis Lorem ipsum dolor sit amet, consectetuer adipiscing elit. . Cum sociisnatoque penatibus et magnis&hellip;</p>', 1, 1, '2017-12-04 14:36:00', '2017-12-04 14:36:00'),
(4, 'Lyanna Stark', 'Lyanna Stark.jpg', '<p>Lorem ipsum dolor sit amet, consectetuer<br />\r\nadipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque<br />\r\npenatibus et magnis Lorem ipsum dolor sit amet, consectetuer adipiscing elit. . Cum sociisnatoque penatibus et magnis&hellip;</p>', 1, 1, '2017-12-04 14:37:07', '2017-12-04 14:37:07'),
(5, 'Catelyn Stark', 'Catelyn Stark.jpg', '<p>Lorem ipsum dolor sit amet, consectetuer<br />\r\nadipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque<br />\r\npenatibus et magnis Lorem ipsum dolor sit amet, consectetuer adipiscing elit. . Cum sociisnatoque penatibus et magnis&hellip;</p>', 1, 1, '2017-12-04 14:37:27', '2017-12-04 14:37:27'),
(6, 'Arya Stark', 'Arya Stark.jpg', '<p>Lorem ipsum dolor sit amet, consectetuer<br />\r\nadipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque<br />\r\npenatibus et magnis Lorem ipsum dolor sit amet, consectetuer adipiscing elit. . Cum sociisnatoque penatibus et magnis&hellip;</p>', 1, 1, '2017-12-04 14:38:27', '2017-12-04 14:38:27'),
(7, 'dsad', 'dsad.jpg', '<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will dsfdfdf dfds fsdfsd fdsffds</p>', 1, 1, '2017-12-04 17:07:24', '2017-12-04 17:07:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `story_englishes`
--

CREATE TABLE `story_englishes` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_cover` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `author_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_story_id` tinyint(4) NOT NULL,
  `genre_id` tinyint(4) NOT NULL,
  `length_id` tinyint(4) NOT NULL,
  `viewed` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `admin_responsibility` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `story_englishes`
--

INSERT INTO `story_englishes` (`id`, `title`, `image_cover`, `description`, `author_id`, `level_story_id`, `genre_id`, `length_id`, `viewed`, `status`, `admin_responsibility`, `created_at`, `updated_at`) VALUES
(1, 'Good and Cheap', 'Good and Cheap.jpg', '<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will dsfdfdf dfds fsdfsd fdsffds</p>', '3', 2, 1, 1, 711, 1, 1, '2017-12-04 14:42:05', '2017-12-04 14:42:05'),
(2, 'Fifty Shades of Grey', 'Fifty Shades of Grey.jpg', '<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain</p>', '6', 1, 1, 1, 603, 1, 1, '2017-12-04 14:43:37', '2017-12-04 14:43:37'),
(3, 'The Glass Magician', 'The Glass Magician.jpg', '<p>These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided.&nbsp;</p>', '5', 1, 2, 1, 851, 1, 1, '2017-12-04 14:44:04', '2017-12-04 14:44:04'),
(4, 'Forks Over Knives', 'Forks Over Knives.jpg', '<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will</p>', '4', 2, 2, 2, 405, 1, 1, '2017-12-04 14:44:38', '2017-12-04 14:44:38'),
(5, 'Voyager', 'Voyager.jpg', '<p>These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided.</p>', '2', 1, 2, 2, 355, 1, 1, '2017-12-04 14:45:05', '2017-12-04 14:45:05'),
(6, 'Barefoot to Avalon', 'Barefoot to Avalon.jpg', '<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue;&nbsp;</p>', '1', 2, 2, 2, 672, 1, 1, '2017-12-04 14:45:33', '2017-12-04 14:45:33'),
(7, 'The Pioneer Woman Cooks', 'The Pioneer Woman Cooks.jpg', '<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue</p>', '4', 1, 2, 2, 678, 1, 1, '2017-12-04 14:46:14', '2017-12-04 14:46:14'),
(8, 'How to Cook Everything', 'How to Cook Everything.jpg', '<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will</p>', '5', 1, 2, 1, 875, 1, 1, '2017-12-04 14:46:45', '2017-12-04 14:46:45'),
(9, 'Jerusalem: A Cookbook', 'Jerusalem.jpg', '<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through w</p>', '6', 2, 1, 1, 149, 1, 1, '2017-12-04 14:47:14', '2017-12-04 14:47:14'),
(10, 'Children\'s books', 'Children\'s books.jpg', 'dasd sad', '1', 1, 2, 1, 192, 1, 1, '2017-12-04 17:38:51', '2017-12-04 17:38:51'),
(11, 'Fairytale', 'Fairytale.jpg', 'dsad', '1', 1, 2, 1, 602, 1, 1, '2017-12-04 17:39:28', '2017-12-04 17:39:28'),
(12, 'Miracle', 'Miracle.jpg', 'dfsf', '1', 1, 2, 1, 893, 1, 1, '2017-12-04 17:39:56', '2017-12-04 18:19:49'),
(13, 'Go on a Journey', 'Go on a Journey.jpg', 'gfdg', '1', 1, 2, 1, 387, 1, 1, '2017-12-04 17:40:29', '2017-12-04 18:52:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `story_english_chapters`
--

CREATE TABLE `story_english_chapters` (
  `id` int(10) UNSIGNED NOT NULL,
  `story_id` int(10) UNSIGNED NOT NULL,
  `title_chapter` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chapter_cover` text COLLATE utf8mb4_unicode_ci,
  `order_chapter` int(11) NOT NULL,
  `content_chapter` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `audio_link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `admin_responsibility` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `story_english_download_audios`
--

CREATE TABLE `story_english_download_audios` (
  `id` int(10) UNSIGNED NOT NULL,
  `chap_id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_responsibility` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `story_english_download_ebooks`
--

CREATE TABLE `story_english_download_ebooks` (
  `id` int(10) UNSIGNED NOT NULL,
  `chap_id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_responsibility` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `story_english_download_fulls`
--

CREATE TABLE `story_english_download_fulls` (
  `id` int(10) UNSIGNED NOT NULL,
  `story_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_responsibility` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `story_english_genres`
--

CREATE TABLE `story_english_genres` (
  `id` int(10) UNSIGNED NOT NULL,
  `genre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `introduction` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `admin_responsibility` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `story_english_genres`
--

INSERT INTO `story_english_genres` (`id`, `genre`, `introduction`, `status`, `admin_responsibility`, `created_at`, `updated_at`) VALUES
(1, 'Novel', NULL, 1, 1, '2017-12-02 14:42:11', '2017-12-02 14:42:11'),
(2, 'Anime', NULL, 1, 1, '2017-12-02 14:42:21', '2017-12-02 14:42:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `story_english_get_books`
--

CREATE TABLE `story_english_get_books` (
  `id` int(10) UNSIGNED NOT NULL,
  `story_id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_responsibility` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `story_english_lengths`
--

CREATE TABLE `story_english_lengths` (
  `id` int(10) UNSIGNED NOT NULL,
  `length` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `introduction` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `admin_responsibility` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `story_english_lengths`
--

INSERT INTO `story_english_lengths` (`id`, `length`, `introduction`, `status`, `admin_responsibility`, `created_at`, `updated_at`) VALUES
(1, 'Short', NULL, 1, 1, '2017-12-02 04:03:41', '2017-12-02 04:03:41'),
(2, 'Medium', NULL, 1, 1, '2017-12-02 14:42:33', '2017-12-02 14:42:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `story_english_levels`
--

CREATE TABLE `story_english_levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `introduction` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `admin_responsibility` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `story_english_levels`
--

INSERT INTO `story_english_levels` (`id`, `level`, `introduction`, `status`, `admin_responsibility`, `created_at`, `updated_at`) VALUES
(1, 'Pre-intermediate', NULL, 1, 1, '2017-12-02 14:41:58', '2017-12-02 14:41:58'),
(2, 'Basic', NULL, 1, 1, '2017-12-02 14:42:02', '2017-12-02 14:42:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `story_english_total_by_levels`
--

CREATE TABLE `story_english_total_by_levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `level_story_id` int(11) NOT NULL,
  `total_stories` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `story_english_total_by_levels`
--

INSERT INTO `story_english_total_by_levels` (`id`, `level_story_id`, `total_stories`, `created_at`, `updated_at`) VALUES
(1, 2, 4, '2017-12-04 14:42:05', '2017-12-04 14:47:14'),
(2, 1, 9, '2017-12-04 14:43:37', '2017-12-04 17:40:29');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `host_downloads`
--
ALTER TABLE `host_downloads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `host_downloads_name_unique` (`name`);

--
-- Chỉ mục cho bảng `story_authors`
--
ALTER TABLE `story_authors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `story_authors_name_unique` (`name`);

--
-- Chỉ mục cho bảng `story_englishes`
--
ALTER TABLE `story_englishes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `story_english_chapters`
--
ALTER TABLE `story_english_chapters`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `story_english_download_audios`
--
ALTER TABLE `story_english_download_audios`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `story_english_download_ebooks`
--
ALTER TABLE `story_english_download_ebooks`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `story_english_download_fulls`
--
ALTER TABLE `story_english_download_fulls`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `story_english_genres`
--
ALTER TABLE `story_english_genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `story_english_genres_genre_unique` (`genre`);

--
-- Chỉ mục cho bảng `story_english_get_books`
--
ALTER TABLE `story_english_get_books`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `story_english_lengths`
--
ALTER TABLE `story_english_lengths`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `story_english_lengths_length_unique` (`length`);

--
-- Chỉ mục cho bảng `story_english_levels`
--
ALTER TABLE `story_english_levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `story_english_levels_level_unique` (`level`);

--
-- Chỉ mục cho bảng `story_english_total_by_levels`
--
ALTER TABLE `story_english_total_by_levels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `host_downloads`
--
ALTER TABLE `host_downloads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `story_authors`
--
ALTER TABLE `story_authors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `story_englishes`
--
ALTER TABLE `story_englishes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `story_english_chapters`
--
ALTER TABLE `story_english_chapters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `story_english_download_audios`
--
ALTER TABLE `story_english_download_audios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `story_english_download_ebooks`
--
ALTER TABLE `story_english_download_ebooks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `story_english_download_fulls`
--
ALTER TABLE `story_english_download_fulls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `story_english_genres`
--
ALTER TABLE `story_english_genres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `story_english_get_books`
--
ALTER TABLE `story_english_get_books`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `story_english_lengths`
--
ALTER TABLE `story_english_lengths`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `story_english_levels`
--
ALTER TABLE `story_english_levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `story_english_total_by_levels`
--
ALTER TABLE `story_english_total_by_levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
