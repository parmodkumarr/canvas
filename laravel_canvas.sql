-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 11, 2019 at 07:34 AM
-- Server version: 5.7.22-0ubuntu0.17.10.1
-- PHP Version: 7.1.17-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_canvas`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `charts`
--

CREATE TABLE `charts` (
  `id` int(11) NOT NULL,
  `chart_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `workchart_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `type` varchar(11) NOT NULL DEFAULT 'S',
  `chart_mode` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=Real-Time,2=Historical',
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `picture` int(11) DEFAULT NULL,
  `chart_type` varchar(11) DEFAULT NULL,
  `chart_color` varchar(10) DEFAULT NULL,
  `data_group` varchar(100) DEFAULT NULL,
  `data_group_option` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `charts`
--

INSERT INTO `charts` (`id`, `chart_id`, `title`, `workchart_id`, `group_id`, `type`, `chart_mode`, `start_date`, `end_date`, `picture`, `chart_type`, `chart_color`, `data_group`, `data_group_option`, `created_at`, `updated_at`) VALUES
(16, 12, 'Test Chart 2', 29, 1, 'M', 2, '2017-12-31 22:44:22', '2018-01-12 16:48:22', NULL, NULL, NULL, NULL, NULL, '2018-12-18 10:45:41', '2018-12-18 10:45:41'),
(17, 12, 'Test Chart 3', 29, 1, 'S', 2, '2017-12-31 22:44:22', '2018-01-12 16:48:22', NULL, NULL, NULL, NULL, NULL, '2018-12-13 06:05:14', '2018-12-13 06:05:14'),
(22, 12, 'New Chart', 29, 1, 'S', 2, '2017-12-31 22:44:22', '2018-01-12 16:48:22', NULL, NULL, NULL, NULL, NULL, '2018-12-13 06:10:54', '2018-12-13 06:10:54'),
(29, 0, 'First Group', 31, 5, 'M', 2, '2017-12-31 22:44:22', '2018-01-12 16:48:22', NULL, NULL, NULL, NULL, NULL, '2018-12-18 07:53:31', '2018-12-18 07:53:31');

-- --------------------------------------------------------

--
-- Table structure for table `chart_comments`
--

CREATE TABLE `chart_comments` (
  `id` int(11) NOT NULL,
  `chart_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `xaxis` varchar(200) NOT NULL,
  `yaxis` varchar(100) NOT NULL,
  `font_style` text NOT NULL,
  `font_color` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chart_groups`
--

CREATE TABLE `chart_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1=Acitve,0=Inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chart_groups`
--

INSERT INTO `chart_groups` (`id`, `name`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Test', 1, '2018-12-13 11:50:15', '2018-12-13 11:50:15', 1, 1),
(5, NULL, 1, '2018-12-13 07:58:45', '2018-12-13 07:58:45', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chart_lines`
--

CREATE TABLE `chart_lines` (
  `id` int(11) NOT NULL,
  `chart_id` int(11) NOT NULL,
  `start_x` text NOT NULL,
  `start_y` text NOT NULL,
  `end_x` text NOT NULL,
  `end_y` text NOT NULL,
  `extra_info` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chart_lines`
--

INSERT INTO `chart_lines` (`id`, `chart_id`, `start_x`, `start_y`, `end_x`, `end_y`, `extra_info`, `created_at`, `updated_at`) VALUES
(1, 29, '2018-01-02T06:09:04.007Z', '12.17', '2018-01-04T20:54:03.418Z', '12.89', '{\"dataPoints\":[{\"x\":\"2018-01-02T06:09:04.007Z\",\"y\":\"12.17\"},{\"x\":\"2018-01-04T20:54:03.418Z\",\"y\":\"12.89\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-09 12:22:12', '2019-01-09 12:22:12'),
(2, 16, '2018-01-02T03:59:52.556Z', '11.94', '2018-01-06T13:48:40.975Z', '12.90', '{\"dataPoints\":[{\"x\":\"2018-01-02T03:59:52.556Z\",\"y\":\"11.94\"},{\"x\":\"2018-01-06T13:48:40.975Z\",\"y\":\"12.90\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-10 10:00:04', '2019-01-10 10:00:04'),
(3, 16, '2018-01-05T06:26:11.269Z', '11.57', '2018-01-09T02:24:28.936Z', '12.62', '{\"dataPoints\":[{\"x\":\"2018-01-05T06:26:11.269Z\",\"y\":\"11.57\"},{\"x\":\"2018-01-09T02:24:28.936Z\",\"y\":\"12.62\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-10 10:00:06', '2019-01-10 10:00:06'),
(4, 16, '2018-01-03T08:17:48.761Z', '11.79', '2018-01-08T05:11:01.782Z', '12.91', '{\"dataPoints\":[{\"x\":\"2018-01-03T08:17:48.761Z\",\"y\":\"11.79\"},{\"x\":\"2018-01-08T05:11:01.782Z\",\"y\":\"12.91\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-10 10:00:08', '2019-01-10 10:00:08'),
(5, 16, '2018-01-02T00:55:19.056Z', '12.51', '2018-01-05T07:58:28.020Z', '12.96', '{\"dataPoints\":[{\"x\":\"2018-01-02T00:55:19.056Z\",\"y\":\"12.51\"},{\"x\":\"2018-01-05T07:58:28.020Z\",\"y\":\"12.96\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-10 10:00:10', '2019-01-10 10:00:10'),
(6, 16, '2018-01-06T18:07:03.876Z', '11.62', '2018-01-09T19:38:00.539Z', '12.62', '{\"dataPoints\":[{\"x\":\"2018-01-06T18:07:03.876Z\",\"y\":\"11.62\"},{\"x\":\"2018-01-09T19:38:00.539Z\",\"y\":\"12.62\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-10 10:00:12', '2019-01-10 10:00:12'),
(7, 16, '2018-01-05T23:02:48.172Z', '12.00', '2018-01-10T04:33:13.690Z', '13.02', '{\"dataPoints\":[{\"x\":\"2018-01-05T23:02:48.172Z\",\"y\":\"12.00\"},{\"x\":\"2018-01-10T04:33:13.690Z\",\"y\":\"13.02\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-10 10:00:15', '2019-01-10 10:00:15');

-- --------------------------------------------------------

--
-- Table structure for table `chart_signals`
--

CREATE TABLE `chart_signals` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `chart_id` int(11) NOT NULL,
  `level` tinyint(4) NOT NULL COMMENT '1=Above,2=Below',
  `value` varchar(50) NOT NULL,
  `signal_type` text COMMENT '1=SMS,2=Email,3=IVR',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=Active,0=Inactive',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2017_03_24_122715_create_article_table', 1),
(9, '2017_08_07_111434_create_workcharts_table', 1),
(10, '2017_08_07_112006_create_workareas_table', 1),
(11, '2017_08_07_113330_create_charts_table', 1),
(12, '2018_10_03_074526_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `timeseries`
--

CREATE TABLE `timeseries` (
  `id` int(11) NOT NULL,
  `chart_id` int(11) NOT NULL,
  `color` varchar(50) NOT NULL COMMENT '1=Above,2=Below',
  `chart_type` varchar(50) NOT NULL,
  `indicator` int(11) NOT NULL,
  `series_type` int(11) NOT NULL,
  `param_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=Active,0=Inactive',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeseries`
--

INSERT INTO `timeseries` (`id`, `chart_id`, `color`, `chart_type`, `indicator`, `series_type`, `param_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(13, 17, '#f1c232', 'area', 1, 1, 10783, 1, 1, 1, '2018-11-28 13:23:51', '2018-11-28 13:23:51'),
(16, 16, '#660000', 'line', 2, 1, 13519, 1, 1, 1, '2018-11-29 05:31:52', '2018-12-13 11:01:19'),
(19, 22, '#93c47d', 'candle', 1, 1, 13519, 1, 1, 1, '2018-12-11 08:03:52', '2019-01-07 06:23:16'),
(21, 23, '#0b5394', 'line', 0, 1, 10735, 1, 1, 1, '2018-12-13 07:15:20', '2018-12-13 07:17:22'),
(24, 25, '#741b47', 'line', 0, 1, 11164, 1, 1, 1, '2018-12-13 07:38:08', '2018-12-13 07:38:08'),
(28, 29, '#134f5c', 'line', 0, 1, 13519, 1, 1, 1, '2018-12-13 07:58:45', '2018-12-21 04:15:39'),
(32, 16, '#38761d', 'bar', 0, 1, 10735, 1, 1, 1, '2018-12-13 14:36:56', '2018-12-13 14:36:56'),
(33, 29, '#0b5394', 'line', 0, 1, 10735, 1, 1, 1, '2018-12-18 08:26:49', '2018-12-21 05:38:34'),
(34, 22, '#134f5c', 'line', 0, 1, 13519, 1, 1, 1, '2019-01-07 06:23:16', '2019-01-07 06:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$ka9QkHnif9CgiDY4SgyGHu3McdWLwDLNTQlUHuxNU29wBYS4cv8nG', '6FywyGgPG7Ne47KExSMyEnXZ4KI9C7HY1bL5enTPaCiq4tCdxMKWMsLgax0S', '2018-10-05 00:36:56', '2018-10-05 00:36:56');

-- --------------------------------------------------------

--
-- Table structure for table `workareas`
--

CREATE TABLE `workareas` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workchart_id` int(11) NOT NULL,
  `mainchart_id` int(255) DEFAULT '0',
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'S',
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chart_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `workareas`
--

INSERT INTO `workareas` (`id`, `title`, `workchart_id`, `mainchart_id`, `type`, `picture`, `chart_type`, `created_at`, `updated_at`) VALUES
(14, 'subject', 27, NULL, 'M', NULL, '', '2018-10-10 06:17:27', '2018-10-10 06:17:27'),
(15, 'math', 27, 14, 'S', NULL, '', '2018-10-10 06:21:20', '2018-10-10 06:21:20'),
(21, 'english', 27, 14, 'S', NULL, '', '2018-10-11 01:00:21', '2018-10-11 01:00:21'),
(22, 'punjabi', 27, 14, 'S', NULL, '', '2018-10-11 01:05:23', '2018-10-11 01:05:23'),
(24, 'testts', 27, 14, 'S', NULL, 'Line', '2018-10-11 05:56:57', '2018-10-11 05:56:57');

-- --------------------------------------------------------

--
-- Table structure for table `workcharts`
--

CREATE TABLE `workcharts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `workcharts`
--

INSERT INTO `workcharts` (`id`, `title`, `user_id`, `picture`, `created_at`, `updated_at`) VALUES
(27, 'testts', 1, '', '2018-10-10 05:21:36', '2018-10-10 05:21:36'),
(28, 'new work chart', 1, '', '2018-10-30 23:21:31', '2018-10-30 23:21:31'),
(29, 'test workchart', 1, '', '2018-11-16 04:19:45', '2018-11-16 04:19:45'),
(30, 'Dharamveer Test Workchart For Every Functionality Test', 1, '', '2018-11-28 23:47:37', '2018-11-28 23:47:37'),
(31, 'New Work Chart', 1, '', '2018-11-29 00:18:12', '2018-11-29 00:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `workchart_timeseries`
--

CREATE TABLE `workchart_timeseries` (
  `id` int(11) NOT NULL,
  `workchart_id` int(11) NOT NULL,
  `series_type` int(11) NOT NULL,
  `indicator` int(11) NOT NULL,
  `chart_type` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=Active,0=Inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workchart_timeseries`
--

INSERT INTO `workchart_timeseries` (`id`, `workchart_id`, `series_type`, `indicator`, `chart_type`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 29, 2, 1, 'bar', 1, '2018-11-22 13:53:33', '2018-11-22 14:19:33', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `charts`
--
ALTER TABLE `charts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_comments`
--
ALTER TABLE `chart_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_groups`
--
ALTER TABLE `chart_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_lines`
--
ALTER TABLE `chart_lines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_signals`
--
ALTER TABLE `chart_signals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_reserved_at_index` (`queue`,`reserved_at`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `timeseries`
--
ALTER TABLE `timeseries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `workareas`
--
ALTER TABLE `workareas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workcharts`
--
ALTER TABLE `workcharts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workchart_timeseries`
--
ALTER TABLE `workchart_timeseries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `charts`
--
ALTER TABLE `charts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `chart_comments`
--
ALTER TABLE `chart_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chart_groups`
--
ALTER TABLE `chart_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `chart_lines`
--
ALTER TABLE `chart_lines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `chart_signals`
--
ALTER TABLE `chart_signals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `timeseries`
--
ALTER TABLE `timeseries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `workareas`
--
ALTER TABLE `workareas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `workcharts`
--
ALTER TABLE `workcharts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `workchart_timeseries`
--
ALTER TABLE `workchart_timeseries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
