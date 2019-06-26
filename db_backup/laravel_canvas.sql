-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2019 at 08:00 PM
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
-- Table structure for table `algos`
--

CREATE TABLE `algos` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `formula` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operator_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `algos`
--

INSERT INTO `algos` (`id`, `title`, `user_id`, `formula`, `operator_type`, `created_at`, `updated_at`) VALUES
(1, 'Test Algo', 1, '101+66', 'sell', NULL, '2019-01-22 05:30:13'),
(2, 'test123', 1, 'cos(1)', 'sell', '2019-01-22 05:28:45', '2019-01-22 05:28:45'),
(3, 'mytest', 3, 'PLPZU0000011+PLJSW0000015', 'buy', '2019-06-26 08:06:11', '2019-06-26 08:06:11');

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
(16, 12, 'chart-1', 29, 1, '', 2, '2017-12-31 22:44:22', '2018-01-12 16:01:22', NULL, NULL, NULL, NULL, NULL, '2019-01-11 11:55:41', '2019-01-11 06:25:41'),
(17, 12, 'Test Chart 3', 29, 1, 'S', 2, '2017-12-31 22:44:22', '2018-01-12 16:48:22', NULL, NULL, NULL, NULL, NULL, '2018-12-13 06:05:14', '2018-12-13 06:05:14'),
(22, 12, 'New Chart', 29, 1, 'S', 2, '2017-12-31 22:44:22', '2018-01-12 16:48:22', NULL, NULL, NULL, NULL, NULL, '2018-12-13 06:10:54', '2018-12-13 06:10:54'),
(29, 0, 'First Group', 31, 5, 'M', 2, '2017-12-31 22:44:22', '2018-01-12 16:48:22', NULL, NULL, NULL, NULL, NULL, '2018-12-18 07:53:31', '2018-12-18 07:53:31'),
(30, 0, 'candle-1', 38, 6, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-02-13 12:53:53', '2019-02-13 07:23:53'),
(31, 0, 'test', 27, 7, 'M', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-02-15 00:30:43', '2019-02-15 00:30:43'),
(36, 0, 'tttttttttttttttttt111111111111111', 8, 10, 'M', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-03-05 01:00:33', '2019-03-05 01:00:33'),
(37, 0, 'test1', 9, 11, 'M', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-03-05 01:16:38', '2019-03-05 01:16:38'),
(38, 0, 'chart#1', 42, 12, 'M', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-03-05 01:24:27', '2019-03-05 01:24:27'),
(39, 0, 'test', 44, 13, 'M', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-03-13 07:04:11', '2019-03-13 07:04:11'),
(40, 0, 'test', 40, 14, 'M', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-03-15 02:56:53', '2019-03-15 02:56:53'),
(41, 0, 'test', 46, 15, 'M', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-03-19 08:06:57', '2019-03-19 08:06:57'),
(42, 0, 'test', 47, 16, 'M', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-26 08:06:38', '2019-06-26 08:06:38');

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

--
-- Dumping data for table `chart_comments`
--

INSERT INTO `chart_comments` (`id`, `chart_id`, `comment`, `xaxis`, `yaxis`, `font_style`, `font_color`, `created_at`, `updated_at`) VALUES
(1, 16, 'erererer', '2018-01-05T06:53:44.028Z', '101.48', '', '', '2019-01-08 05:40:51', '2019-01-08 05:40:51'),
(6, 16, 'test', '2018-01-05T13:18:09.559Z', '9.78', '', '', '2019-01-11 06:45:36', '2019-01-11 06:45:36'),
(14, 16, 'hhhhhhhhhhhhhhhhhhhhhh', '2018-01-05T16:42:39.393Z', '62.46', '', '', '2019-01-11 12:12:58', '2019-01-11 12:12:58'),
(15, 16, 'hhhhhhhhhhhhhhhhhhhhhh', '2018-01-05T16:42:39.393Z', '62.46', '', '', '2019-01-11 12:12:58', '2019-01-11 12:12:58'),
(16, 16, 'hhhhhhhhhhhhhhhhhhhhhh', '2018-01-05T16:42:39.393Z', '62.46', '', '', '2019-01-11 12:12:58', '2019-01-11 12:12:58'),
(17, 16, 'hhhhhhhhhhhhhhhhhhhhhh', '2018-01-05T16:42:39.393Z', '62.46', '', '', '2019-01-11 12:12:58', '2019-01-11 12:12:58'),
(18, 16, 'testing', '2017-12-30T08:06:29.602Z', '77.26', '', '', '2019-02-04 11:30:29', '2019-02-04 11:30:29'),
(19, 16, 'testing', '2017-12-30T08:06:29.602Z', '77.26', '', '', '2019-02-04 11:30:29', '2019-02-04 11:30:29'),
(20, 29, 'test', '2018-01-05T08:52:36.805Z', '12.61', '', '', '2019-02-12 12:20:47', '2019-02-12 12:20:47'),
(21, 29, 'test2222', '2018-01-05T09:24:18.792Z', '12.39', '', '', '2019-02-12 12:35:22', '2019-02-12 12:35:22'),
(24, 29, '777777777777777', '2018-01-05T09:14:22.369Z', '12.39', '', '', '2019-02-13 07:32:35', '2019-02-13 07:32:35'),
(25, 29, '777777777777777', '2018-01-05T09:14:22.369Z', '12.39', '', '', '2019-02-13 07:32:35', '2019-02-13 07:32:35'),
(26, 29, '999999999999999', '2018-01-05T10:00:52.736Z', '12.56', '', '', '2019-02-13 07:34:43', '2019-02-13 07:34:43'),
(27, 29, '999999999999999', '2018-01-05T09:46:03.054Z', '12.54', '', '', '2019-02-13 07:35:37', '2019-02-13 07:35:37'),
(28, 29, '8787878787', '2018-01-05T09:36:36.892Z', '12.63', '', '', '2019-02-13 07:36:05', '2019-02-13 07:36:05'),
(29, 32, 'Testing the comments', '2018-01-09T06:48:18.397Z', '12.01', '', '', '2019-02-15 09:05:01', '2019-02-15 09:05:01'),
(30, 32, 'Again a second Comment', '2018-01-02T11:23:02.897Z', '12.38', '', '', '2019-02-15 09:05:21', '2019-02-15 09:05:21'),
(31, 32, 'Comment 3', '2018-01-06T12:30:22.358Z', '11.85', '', '', '2019-02-15 09:09:49', '2019-02-15 09:09:49'),
(32, 32, 'testing it on Server', '2018-01-02T07:23:43.559Z', '12.74', '', '', '2019-02-15 12:12:27', '2019-02-15 12:12:27'),
(33, 32, 'bottom', '2018-01-12T00:10:44.344Z', '11.67', '', '', '2019-02-15 12:12:36', '2019-02-15 12:12:36'),
(34, 32, 'new text', '2018-01-05T12:18:57.905Z', '12.52', '', '', '2019-02-18 11:43:12', '2019-02-18 11:43:12'),
(35, 33, '123', '2018-01-05T15:48:26.068Z', '26.11', '', '', '2019-03-04 16:52:11', '2019-03-04 16:52:11'),
(37, 32, 'new comment', '2018-01-07T21:48:53.731Z', '12.18', '', '', '2019-03-08 11:42:42', '2019-03-08 11:42:42'),
(38, 35, 'test', '2018-01-07T19:55:16.984Z', '300.58', '', '', '2019-03-13 07:19:49', '2019-03-13 07:19:49'),
(39, 39, 'test', '2018-01-06T20:58:27.792Z', '12.77', '', '', '2019-03-13 13:10:34', '2019-03-13 13:10:34'),
(40, 40, 'test', '2018-01-04T20:35:52.434Z', '0.00', '', '', '2019-03-18 10:14:22', '2019-03-18 10:14:22'),
(41, 39, 'test', '2018-01-04T22:31:14.480Z', '12.87', '', '', '2019-03-18 10:20:32', '2019-03-18 10:20:32'),
(42, 39, 'test123', '2018-01-01T17:32:57.647Z', '12.65', '', '', '2019-03-18 10:20:40', '2019-03-18 10:20:40'),
(43, 40, 'test', '2018-01-02T13:21:22.695Z', '12.86', '', '', '2019-03-18 10:21:30', '2019-03-18 10:21:30'),
(44, 40, 'test123', '2018-01-02T01:34:20.704Z', '5.21', '', '', '2019-03-18 10:21:35', '2019-03-18 10:21:35'),
(45, 42, 'sfsdf', '2018-01-03T16:46:46.724Z', '103.96', '', '', '2019-06-26 13:41:21', '2019-06-26 13:41:21'),
(46, 42, 'sfsdf', '2018-01-08T08:05:41.035Z', '104.96', '', '', '2019-06-26 13:41:30', '2019-06-26 13:41:30');

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
(5, NULL, 1, '2018-12-13 07:58:45', '2018-12-13 07:58:45', 1, 1),
(6, NULL, 1, '2019-02-13 07:58:41', '2019-02-13 07:58:41', 1, 1),
(7, NULL, 1, '2019-02-15 06:00:42', '2019-02-15 06:00:42', 1, 1),
(8, NULL, 1, '2019-02-15 07:41:17', '2019-02-15 07:41:17', 1, 1),
(9, NULL, 1, '2019-03-05 06:28:32', '2019-03-05 06:28:32', 1, 1),
(10, NULL, 1, '2019-03-05 06:30:33', '2019-03-05 06:30:33', 1, 1),
(11, NULL, 1, '2019-03-05 06:46:38', '2019-03-05 06:46:38', 1, 1),
(12, NULL, 1, '2019-03-05 06:54:27', '2019-03-05 06:54:27', 1, 1),
(13, NULL, 1, '2019-03-13 12:34:11', '2019-03-13 12:34:11', 1, 1),
(14, NULL, 1, '2019-03-15 08:26:53', '2019-03-15 08:26:53', 1, 1),
(15, NULL, 1, '2019-03-19 13:36:57', '2019-03-19 13:36:57', 1, 1),
(16, NULL, 1, '2019-06-26 13:36:38', '2019-06-26 13:36:38', 3, 3);

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
(7, 16, '2018-01-05T11:10:13.851Z', '17.19', '2018-01-08T23:07:03.107Z', '22.89', '{\"dataPoints\":[{\"x\":\"2018-01-05T11:10:13.851Z\",\"y\":\"17.19\"},{\"x\":\"2018-01-08T23:07:03.107Z\",\"y\":\"22.89\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-09 10:29:38', '2019-01-09 10:29:38'),
(8, 16, '2018-01-09T11:24:19.535Z', '38.48', '2018-01-09T10:47:49.612Z', '5.59', '{\"dataPoints\":[{\"x\":\"2018-01-09T11:24:19.535Z\",\"y\":\"38.48\"},{\"x\":\"2018-01-09T10:47:49.612Z\",\"y\":\"5.59\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-09 10:29:46', '2019-01-09 10:29:46'),
(9, 16, '2018-01-08T08:29:06.913Z', '41.82', '2018-01-08T11:27:57.532Z', '33.95', '{\"dataPoints\":[{\"x\":\"2018-01-08T08:29:06.913Z\",\"y\":\"41.82\"},{\"x\":\"2018-01-08T11:27:57.532Z\",\"y\":\"33.95\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-09 10:33:48', '2019-01-09 10:33:48'),
(10, 16, '2018-01-08T11:50:57.099Z', '17.01', '2018-01-08T12:19:41.643Z', '29.33', '{\"dataPoints\":[{\"x\":\"2018-01-08T11:50:57.099Z\",\"y\":\"17.01\"},{\"x\":\"2018-01-08T12:19:41.643Z\",\"y\":\"29.33\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-09 10:43:19', '2019-01-09 10:43:19'),
(11, 16, '2018-01-08T12:19:41.643Z', '29.33', '2018-01-08T12:35:26.035Z', '18.89', '{\"dataPoints\":[{\"x\":\"2018-01-08T12:19:41.643Z\",\"y\":\"29.33\"},{\"x\":\"2018-01-08T12:35:26.035Z\",\"y\":\"18.89\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-09 10:43:22', '2019-01-09 10:43:22'),
(12, 16, '2018-01-08T12:35:26.035Z', '18.89', '2018-01-08T12:49:48.307Z', '27.44', '{\"dataPoints\":[{\"x\":\"2018-01-08T12:35:26.035Z\",\"y\":\"18.89\"},{\"x\":\"2018-01-08T12:49:48.307Z\",\"y\":\"27.44\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-09 10:43:25', '2019-01-09 10:43:25'),
(13, 16, '2018-01-08T12:49:48.307Z', '27.44', '2018-01-08T13:04:37.952Z', '14.78', '{\"dataPoints\":[{\"x\":\"2018-01-08T12:49:48.307Z\",\"y\":\"27.44\"},{\"x\":\"2018-01-08T13:04:37.952Z\",\"y\":\"14.78\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-09 10:43:27', '2019-01-09 10:43:27'),
(14, 16, '2018-01-08T13:04:37.952Z', '14.78', '2018-01-08T13:31:46.688Z', '31.21', '{\"dataPoints\":[{\"x\":\"2018-01-08T13:04:37.952Z\",\"y\":\"14.78\"},{\"x\":\"2018-01-08T13:31:46.688Z\",\"y\":\"31.21\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-09 10:43:30', '2019-01-09 10:43:30'),
(15, 16, '2018-01-08T13:31:46.688Z', '31.21', '2018-01-08T13:55:16.433Z', '11.36', '{\"dataPoints\":[{\"x\":\"2018-01-08T13:31:46.688Z\",\"y\":\"31.21\"},{\"x\":\"2018-01-08T13:55:16.433Z\",\"y\":\"11.36\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-09 10:43:32', '2019-01-09 10:43:32'),
(16, 16, '2018-01-08T13:55:16.433Z', '11.36', '2018-01-08T14:21:03.047Z', '34.46', '{\"dataPoints\":[{\"x\":\"2018-01-08T13:55:16.433Z\",\"y\":\"11.36\"},{\"x\":\"2018-01-08T14:21:03.047Z\",\"y\":\"34.46\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-09 10:43:34', '2019-01-09 10:43:34'),
(17, 16, '2018-01-08T14:21:03.047Z', '34.46', '2018-01-08T14:42:56.985Z', '9.65', '{\"dataPoints\":[{\"x\":\"2018-01-08T14:21:03.047Z\",\"y\":\"34.46\"},{\"x\":\"2018-01-08T14:42:56.985Z\",\"y\":\"9.65\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-09 10:43:37', '2019-01-09 10:43:37'),
(18, 16, '2018-01-08T12:23:40.046Z', '10.33', '2018-01-08T12:25:22.710Z', '14.27', '{\"dataPoints\":[{\"x\":\"2018-01-08T12:23:40.046Z\",\"y\":\"10.33\"},{\"x\":\"2018-01-08T12:25:22.710Z\",\"y\":\"14.27\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-09 10:46:40', '2019-01-09 10:46:40'),
(19, 16, '2018-01-08T12:25:22.710Z', '14.27', '2018-01-08T12:26:31.153Z', '10.68', '{\"dataPoints\":[{\"x\":\"2018-01-08T12:25:22.710Z\",\"y\":\"14.27\"},{\"x\":\"2018-01-08T12:26:31.153Z\",\"y\":\"10.68\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-09 10:46:46', '2019-01-09 10:46:46'),
(20, 16, '2018-01-08T12:26:31.153Z', '10.68', '2018-01-08T12:27:36.174Z', '13.59', '{\"dataPoints\":[{\"x\":\"2018-01-08T12:26:31.153Z\",\"y\":\"10.68\"},{\"x\":\"2018-01-08T12:27:36.174Z\",\"y\":\"13.59\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-09 10:46:47', '2019-01-09 10:46:47'),
(21, 16, '2018-01-08T12:27:36.174Z', '13.59', '2018-01-08T12:28:03.551Z', '9.65', '{\"dataPoints\":[{\"x\":\"2018-01-08T12:27:36.174Z\",\"y\":\"13.59\"},{\"x\":\"2018-01-08T12:28:03.551Z\",\"y\":\"9.65\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-09 10:46:49', '2019-01-09 10:46:49'),
(24, 16, '2018-01-05T12:54:14.020Z', '13.27', '2018-01-05T13:01:29.032Z', '37.00', '{\"dataPoints\":[{\"x\":\"2018-01-05T12:54:14.020Z\",\"y\":\"13.27\"},{\"x\":\"2018-01-05T13:01:29.032Z\",\"y\":\"37.00\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-11 06:45:19', '2019-01-11 06:45:19'),
(25, 16, '2018-01-05T13:03:20.892Z', '37.00', '2018-01-05T13:04:41.680Z', '8.86', '{\"dataPoints\":[{\"x\":\"2018-01-05T13:03:20.892Z\",\"y\":\"37.00\"},{\"x\":\"2018-01-05T13:04:41.680Z\",\"y\":\"8.86\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-11 06:45:21', '2019-01-11 06:45:21'),
(26, 16, '2018-01-05T13:07:41.899Z', '8.86', '2018-01-05T13:13:36.123Z', '36.24', '{\"dataPoints\":[{\"x\":\"2018-01-05T13:07:41.899Z\",\"y\":\"8.86\"},{\"x\":\"2018-01-05T13:13:36.123Z\",\"y\":\"36.24\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-11 06:45:23', '2019-01-11 06:45:23'),
(31, 16, '2018-01-05T13:42:41.897Z', '34.46', '2018-01-05T16:01:35.531Z', '44.10', '{\"dataPoints\":[{\"x\":\"2018-01-05T13:42:41.897Z\",\"y\":\"34.46\"},{\"x\":\"2018-01-05T16:01:35.531Z\",\"y\":\"44.10\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-11 12:11:49', '2019-01-11 12:11:49'),
(35, 16, '2018-01-08T14:10:45.197Z', '34.73', '2018-01-08T14:10:45.197Z', '34.73', '{\"dataPoints\":[{\"x\":\"2018-01-08T14:10:45.197Z\",\"y\":\"34.73\"},{\"x\":\"2018-01-08T14:10:45.197Z\",\"y\":\"34.73\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-14 05:54:25', '2019-01-14 05:54:25'),
(38, 16, '2018-01-07T20:51:53.296Z', '28.74', '2018-01-07T20:51:53.296Z', '28.74', '{\"dataPoints\":[{\"x\":\"2018-01-07T20:51:53.296Z\",\"y\":\"28.74\"},{\"x\":\"2018-01-07T20:51:53.296Z\",\"y\":\"28.74\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-14 05:54:41', '2019-01-14 05:54:41'),
(39, 16, '2018-01-07T20:51:53.296Z', '29.04', '2018-01-07T20:51:53.296Z', '29.04', '{\"dataPoints\":[{\"x\":\"2018-01-07T20:51:53.296Z\",\"y\":\"29.04\"},{\"x\":\"2018-01-07T20:51:53.296Z\",\"y\":\"29.04\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-14 05:54:42', '2019-01-14 05:54:42'),
(45, 16, '2018-01-06T06:21:57.267Z', '-13.77', '2018-01-06T06:21:57.267Z', '-13.77', '{\"dataPoints\":[{\"x\":\"2018-01-06T06:21:57.267Z\",\"y\":\"-13.77\"},{\"x\":\"2018-01-06T06:21:57.267Z\",\"y\":\"-13.77\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-14 05:55:00', '2019-01-14 05:55:00'),
(51, 16, '2017-12-25T19:15:20.298Z', '-350.90', '2017-12-25T19:15:20.298Z', '-350.90', '{\"dataPoints\":[{\"x\":\"2017-12-25T19:15:20.298Z\",\"y\":\"-350.90\"},{\"x\":\"2017-12-25T19:15:20.298Z\",\"y\":\"-350.90\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-14 05:57:00', '2019-01-14 05:57:00'),
(52, 16, '2018-01-03T09:37:01.176Z', '27.54', '2018-01-03T09:37:01.176Z', '27.54', '{\"dataPoints\":[{\"x\":\"2018-01-03T09:37:01.176Z\",\"y\":\"27.54\"},{\"x\":\"2018-01-03T09:37:01.176Z\",\"y\":\"27.54\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-14 05:57:39', '2019-01-14 05:57:39'),
(53, 16, '2018-01-02T04:29:42.528Z', '42.75', '2018-01-02T04:29:42.528Z', '43.71', '{\"dataPoints\":[{\"x\":\"2018-01-02T04:29:42.528Z\",\"y\":\"42.75\"},{\"x\":\"2018-01-02T04:29:42.528Z\",\"y\":\"43.71\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-01-28 11:23:53', '2019-01-28 11:23:53'),
(57, 29, '2018-01-05T07:23:53.253Z', '12.52', '2018-01-05T08:23:25.769Z', '12.32', '{\"dataPoints\":[{\"x\":\"2018-01-05T07:23:53.253Z\",\"y\":\"12.52\"},{\"x\":\"2018-01-05T08:23:25.769Z\",\"y\":\"12.32\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-02-12 12:35:00', '2019-02-12 12:35:00'),
(59, 29, '2018-01-05T09:23:48.530Z', '12.33', '2018-01-05T11:26:15.149Z', '12.35', '{\"dataPoints\":[{\"x\":\"2018-01-05T09:23:48.530Z\",\"y\":\"12.33\"},{\"x\":\"2018-01-05T11:26:15.149Z\",\"y\":\"12.35\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-02-13 07:37:35', '2019-02-13 07:37:35'),
(60, 42, '2018-01-05T09:20:37.024Z', '104.29', '2018-01-07T21:57:13.460Z', '105.54', '{\"dataPoints\":[{\"x\":\"2018-01-05T09:20:37.024Z\",\"y\":\"104.29\"},{\"x\":\"2018-01-07T21:57:13.460Z\",\"y\":\"105.54\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-06-26 13:41:37', '2019-06-26 13:41:37'),
(61, 42, '2018-01-06T02:05:16.973Z', '102.34', '2018-01-08T11:23:47.222Z', '102.47', '{\"dataPoints\":[{\"x\":\"2018-01-06T02:05:16.973Z\",\"y\":\"102.34\"},{\"x\":\"2018-01-08T11:23:47.222Z\",\"y\":\"102.47\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-06-26 13:41:45', '2019-06-26 13:41:45'),
(62, 42, '2018-01-06T10:48:50.468Z', '104.21', '2018-01-08T22:42:59.864Z', '106.95', '{\"dataPoints\":[{\"x\":\"2018-01-06T10:48:50.468Z\",\"y\":\"104.21\"},{\"x\":\"2018-01-08T22:42:59.864Z\",\"y\":\"106.95\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-06-26 13:41:47', '2019-06-26 13:41:47'),
(63, 42, '2018-01-08T14:13:35.383Z', '105.00', '2018-01-09T10:02:12.506Z', '101.97', '{\"dataPoints\":[{\"x\":\"2018-01-08T14:13:35.383Z\",\"y\":\"105.00\"},{\"x\":\"2018-01-09T10:02:12.506Z\",\"y\":\"101.97\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-06-26 13:41:48', '2019-06-26 13:41:48'),
(64, 42, '2018-01-11T08:01:30.113Z', '106.49', '2018-01-08T00:04:34.580Z', '102.09', '{\"dataPoints\":[{\"x\":\"2018-01-11T08:01:30.113Z\",\"y\":\"106.49\"},{\"x\":\"2018-01-08T00:04:34.580Z\",\"y\":\"102.09\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-06-26 13:41:49', '2019-06-26 13:41:49'),
(65, 42, '2018-01-04T23:26:18.463Z', '102.38', '2018-01-06T15:03:32.709Z', '103.88', '{\"dataPoints\":[{\"x\":\"2018-01-04T23:26:18.463Z\",\"y\":\"102.38\"},{\"x\":\"2018-01-06T15:03:32.709Z\",\"y\":\"103.88\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-06-26 13:41:51', '2019-06-26 13:41:51'),
(66, 42, '2018-01-05T01:47:48.596Z', '102.09', '2018-01-07T12:02:54.899Z', '102.05', '{\"dataPoints\":[{\"x\":\"2018-01-05T01:47:48.596Z\",\"y\":\"102.09\"},{\"x\":\"2018-01-07T12:02:54.899Z\",\"y\":\"102.05\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-06-26 13:41:52', '2019-06-26 13:41:52'),
(67, 42, '2018-01-04T14:42:44.968Z', '104.33', '2018-01-04T07:38:14.567Z', '99.31', '{\"dataPoints\":[{\"x\":\"2018-01-04T14:42:44.968Z\",\"y\":\"104.33\"},{\"x\":\"2018-01-04T07:38:14.567Z\",\"y\":\"99.31\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-06-26 13:41:56', '2019-06-26 13:41:56'),
(68, 42, '2018-01-03T09:56:25.337Z', '99.48', '2018-01-04T06:27:29.500Z', '101.64', '{\"dataPoints\":[{\"x\":\"2018-01-03T09:56:25.337Z\",\"y\":\"99.48\"},{\"x\":\"2018-01-04T06:27:29.500Z\",\"y\":\"101.64\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-06-26 13:42:00', '2019-06-26 13:42:00'),
(69, 42, '2018-01-04T14:00:17.928Z', '105.83', '2018-01-05T07:41:33.930Z', '106.49', '{\"dataPoints\":[{\"x\":\"2018-01-04T14:00:17.928Z\",\"y\":\"105.83\"},{\"x\":\"2018-01-05T07:41:33.930Z\",\"y\":\"106.49\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-06-26 13:42:04', '2019-06-26 13:42:04'),
(70, 42, '2018-01-11T11:19:36.300Z', '106.91', '2018-01-01T14:04:28.850Z', '101.80', '{\"dataPoints\":[{\"x\":\"2018-01-11T11:19:36.300Z\",\"y\":\"106.91\"},{\"x\":\"2018-01-01T14:04:28.850Z\",\"y\":\"101.80\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-06-26 13:42:10', '2019-06-26 13:42:10'),
(71, 42, '2018-01-11T16:30:54.594Z', '105.33', '2018-01-01T03:27:43.248Z', '98.77', '{\"dataPoints\":[{\"x\":\"2018-01-11T16:30:54.594Z\",\"y\":\"105.33\"},{\"x\":\"2018-01-01T03:27:43.248Z\",\"y\":\"98.77\"}],\"type\":\"line\",\"Color\":\"#000000\"}', '2019-06-26 13:42:15', '2019-06-26 13:42:15');

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

--
-- Dumping data for table `chart_signals`
--

INSERT INTO `chart_signals` (`id`, `title`, `chart_id`, `level`, `value`, `signal_type`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Signal – Below –  E-mail', 16, 2, '157.03', '[\"2\"]', 1, 1, 1, '2019-01-08 05:41:12', '2019-01-08 05:41:12'),
(2, 'Signal – Below –  E-mail', 16, 2, '157.03', '[\"2\"]', 1, 1, 1, '2019-01-08 05:41:12', '2019-01-08 05:41:12'),
(3, 'Signal – Below –  E-mail', 16, 2, '157.03', '[\"2\"]', 1, 1, 1, '2019-01-08 05:41:12', '2019-01-08 05:41:12'),
(4, 'Signal – Below –  E-mail', 16, 2, '157.03', '[\"2\"]', 1, 1, 1, '2019-01-08 05:41:12', '2019-01-08 05:41:12'),
(5, 'Signal – Below –  E-mail', 16, 2, '157.03', '[\"2\"]', 1, 1, 1, '2019-01-08 05:41:12', '2019-01-08 05:41:12'),
(6, 'Signal – Below –  E-mail', 16, 2, '157.03', '[\"2\"]', 1, 1, 1, '2019-01-08 05:41:12', '2019-01-08 05:41:12'),
(7, 'Signal – Below –  E-mail', 16, 2, '157.03', '[\"2\"]', 1, 1, 1, '2019-01-08 05:41:13', '2019-01-08 05:41:13'),
(8, 'Signal – Below –  E-mail', 16, 2, '157.03', '[\"2\"]', 1, 1, 1, '2019-01-08 05:41:13', '2019-01-08 05:41:13'),
(9, 'Signal – Below – SMS, E-mail IVR,', 16, 2, '72.17', '[\"1\",\"2\",\"3\"]', 1, 1, 1, '2019-01-08 05:52:39', '2019-01-08 05:52:39'),
(10, 'Signal – Above – SMS, E-mail IVR,', 16, 1, '97.17', '[\"1\",\"2\",\"3\"]', 1, 1, 1, '2019-01-08 09:53:30', '2019-01-08 09:53:30'),
(39, 'Signal – Below –  IVR,', 16, 2, '55', '[\"3\"]', 1, 1, 1, '2019-01-12 06:54:38', '2019-01-12 06:54:38'),
(40, 'Signal – Above – SMS,', 29, 1, '12.75', '[\"1\"]', 1, 1, 1, '2019-01-14 05:51:25', '2019-01-14 05:51:25'),
(41, 'Signal – Above – SMS,', 29, 1, '50', '[\"1\"]', 1, 1, 1, '2019-02-01 12:00:21', '2019-02-01 12:00:21'),
(42, 'Signal – Above –  IVR,', 29, 1, '100', '[\"3\"]', 1, 1, 1, '2019-02-01 12:01:48', '2019-02-01 12:01:48'),
(43, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:46', '2019-02-12 12:21:46'),
(44, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:46', '2019-02-12 12:21:46'),
(45, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:46', '2019-02-12 12:21:46'),
(46, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:46', '2019-02-12 12:21:46'),
(47, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:46', '2019-02-12 12:21:46'),
(48, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:46', '2019-02-12 12:21:46'),
(49, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:46', '2019-02-12 12:21:46'),
(50, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:46', '2019-02-12 12:21:46'),
(51, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:46', '2019-02-12 12:21:46'),
(52, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:46', '2019-02-12 12:21:46'),
(53, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:46', '2019-02-12 12:21:46'),
(54, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:46', '2019-02-12 12:21:46'),
(55, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:47', '2019-02-12 12:21:47'),
(56, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:47', '2019-02-12 12:21:47'),
(57, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:47', '2019-02-12 12:21:47'),
(58, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:47', '2019-02-12 12:21:47'),
(59, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:47', '2019-02-12 12:21:47'),
(60, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:47', '2019-02-12 12:21:47'),
(61, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:47', '2019-02-12 12:21:47'),
(62, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:47', '2019-02-12 12:21:47'),
(63, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:47', '2019-02-12 12:21:47'),
(64, 'Signal – Above – SMS,', 29, 1, '12.61', '[\"1\"]', 1, 1, 1, '2019-02-12 12:21:47', '2019-02-12 12:21:47'),
(107, 'Signal – Above –  IVR,', 29, 1, '55', '[\"3\"]', 1, 1, 1, '2019-02-13 07:29:08', '2019-02-13 07:29:08'),
(108, 'Signal – Above –  IVR,', 29, 1, '55', '[\"3\"]', 1, 1, 1, '2019-02-13 07:29:08', '2019-02-13 07:29:08'),
(109, 'Signal – Above –  IVR,', 29, 1, '55', '[\"3\"]', 1, 1, 1, '2019-02-13 07:29:08', '2019-02-13 07:29:08'),
(110, 'Signal – Above –  IVR,', 29, 1, '55', '[\"3\"]', 1, 1, 1, '2019-02-13 07:29:08', '2019-02-13 07:29:08'),
(111, 'Signal – Above –  IVR,', 29, 1, '55', '[\"3\"]', 1, 1, 1, '2019-02-13 07:29:08', '2019-02-13 07:29:08'),
(112, 'Signal – Above –  IVR,', 29, 1, '55', '[\"3\"]', 1, 1, 1, '2019-02-13 07:29:08', '2019-02-13 07:29:08'),
(113, 'Signal – Above –  IVR,', 29, 1, '55', '[\"3\"]', 1, 1, 1, '2019-02-13 07:29:09', '2019-02-13 07:29:09'),
(114, 'Signal – Above –  IVR,', 29, 1, '55', '[\"3\"]', 1, 1, 1, '2019-02-13 07:29:09', '2019-02-13 07:29:09'),
(115, 'Signal – Above –  IVR,', 29, 1, '55', '[\"3\"]', 1, 1, 1, '2019-02-13 07:29:09', '2019-02-13 07:29:09'),
(116, 'Signal – Above –  IVR,', 29, 1, '55', '[\"3\"]', 1, 1, 1, '2019-02-13 07:29:09', '2019-02-13 07:29:09'),
(117, 'Signal – Above – SMS,', 30, 1, '0', '[\"1\"]', 1, 1, 1, '2019-02-13 12:53:45', '2019-02-13 12:53:45'),
(125, 'Signal – Above – SMS,', 16, 1, '72', '[\"1\"]', 1, 1, 1, '2019-02-18 13:07:39', '2019-02-18 13:07:39'),
(140, 'Signal – Below – SMS,', 38, 2, '5', '[\"1\"]', 1, 1, 1, '2019-03-05 06:55:43', '2019-03-05 06:55:43'),
(141, 'Signal – Below –  E-mail', 38, 2, '5', '[\"2\"]', 1, 1, 1, '2019-03-05 06:56:20', '2019-03-05 06:56:20'),
(142, 'Signal – Below – SMS,', 38, 2, '5', '[\"1\"]', 1, 1, 1, '2019-03-05 06:57:27', '2019-03-05 06:57:27'),
(150, 'Signal – Below – SMS,', 38, 2, '-10000', '[\"1\"]', 1, 1, 1, '2019-03-08 11:35:11', '2019-03-08 11:35:11'),
(156, 'Signal – Below – SMS,', 39, 2, '12.55', '[\"1\"]', 1, 1, 1, '2019-03-15 07:00:29', '2019-03-15 07:00:29'),
(157, 'Signal – Below – SMS,', 40, 2, '5.21', '[\"1\"]', 1, 1, 1, '2019-03-18 10:22:06', '2019-03-18 10:22:06'),
(158, 'Signal – Above –  E-mail', 42, 1, '101.00', '[\"2\"]', 1, 3, 3, '2019-06-26 13:40:34', '2019-06-26 13:40:34');

-- --------------------------------------------------------

--
-- Table structure for table `intervals`
--

CREATE TABLE `intervals` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `formula` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `intervals`
--

INSERT INTO `intervals` (`id`, `title`, `user_id`, `formula`, `created_at`, `updated_at`) VALUES
(2, 'test indicator', 1, '123 * 1234', '2019-01-20 05:33:51', '2019-01-20 05:33:51'),
(3, 'test', 3, 'PLPZU0000011+PLJSW0000015', '2019-03-15 06:05:51', '2019-03-15 06:05:51'),
(4, 'mytest', 3, 'PLPZU0000011+PLJSW0000015', '2019-06-26 08:05:42', '2019-06-26 08:05:42');

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
(15, '2019_03_12_130607_create_algos_table', 0),
(16, '2019_03_12_130607_create_articles_table', 0),
(17, '2019_03_12_130607_create_chart_comments_table', 0),
(18, '2019_03_12_130607_create_chart_groups_table', 0),
(19, '2019_03_12_130607_create_chart_lines_table', 0),
(20, '2019_03_12_130607_create_chart_signals_table', 0),
(21, '2019_03_12_130607_create_charts_table', 0),
(22, '2019_03_12_130607_create_intervals_table', 0),
(23, '2019_03_12_130607_create_jobs_table', 0),
(24, '2019_03_12_130607_create_oauth_access_tokens_table', 0),
(25, '2019_03_12_130607_create_oauth_auth_codes_table', 0),
(26, '2019_03_12_130607_create_oauth_clients_table', 0),
(27, '2019_03_12_130607_create_oauth_personal_access_clients_table', 0),
(28, '2019_03_12_130607_create_oauth_refresh_tokens_table', 0),
(29, '2019_03_12_130607_create_password_resets_table', 0),
(30, '2019_03_12_130607_create_timeseries_table', 0),
(31, '2019_03_12_130607_create_users_table', 0),
(32, '2019_03_12_130607_create_workareas_table', 0),
(33, '2019_03_12_130607_create_workchart_timeseries_table', 0),
(34, '2019_03_12_130607_create_workcharts_table', 0);

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
(16, 16, '#0000ff', 'line', 2, 1, 10735, 1, 1, 1, '2018-11-29 05:31:52', '2019-01-11 11:55:42'),
(19, 22, '#93c47d', 'candle', 1, 1, 10783, 1, 1, 1, '2018-12-11 08:03:52', '2018-12-11 08:19:01'),
(21, 23, '#0b5394', 'line', 0, 1, 10735, 1, 1, 1, '2018-12-13 07:15:20', '2018-12-13 07:17:22'),
(24, 25, '#741b47', 'line', 0, 1, 11164, 1, 1, 1, '2018-12-13 07:38:08', '2018-12-13 07:38:08'),
(28, 29, '#134f5c', 'line', 0, 1, 13519, 1, 1, 1, '2018-12-13 07:58:45', '2018-12-21 04:15:39'),
(32, 16, '#ff9900', 'line', 0, 1, 11302, 1, 1, 1, '2018-12-13 14:36:56', '2019-01-11 11:55:42'),
(33, 29, '#0b5394', 'line', 0, 1, 10735, 1, 1, 1, '2018-12-18 08:26:49', '2018-12-21 05:38:34'),
(34, 16, '#134f5c', 'line', 0, 1, 11164, 1, 1, 1, '2019-01-11 11:50:56', '2019-01-11 11:55:42'),
(35, 31, '#0000ff', 'line', 0, 1, 13519, 1, 1, 1, '2019-02-15 06:09:06', '2019-02-15 06:16:04'),
(36, 31, '#76a5af', 'line', 0, 1, 10752, 1, 1, 1, '2019-02-15 06:20:10', '2019-02-15 06:20:10'),
(43, 36, '#000000', 'line', 0, 1, 10735, 1, 1, 1, '2019-03-05 06:31:41', '2019-03-05 06:31:41'),
(44, 37, '#000000', 'line', 0, 1, 10735, 1, 1, 1, '2019-03-05 06:47:19', '2019-03-05 06:47:19'),
(45, 38, '#eecccc', 'line', 0, 1, 11308, 1, 1, 1, '2019-03-05 06:55:16', '2019-03-05 06:55:16'),
(49, 39, '#20124d', 'line', 0, 1, 17851, 1, 1, 1, '2019-03-13 12:35:02', '2019-03-13 12:35:02'),
(50, 39, '#00ff00', 'line', 0, 3, 50010, 1, 1, 1, '2019-03-13 13:09:47', '2019-03-13 13:09:47'),
(51, 38, '#00ff00', 'line', 0, 3, 50010, 1, 1, 1, '2019-03-15 06:44:37', '2019-03-15 06:44:37'),
(52, 40, '#674ea7', 'area', 0, 1, 11306, 1, 1, 1, '2019-03-15 08:29:08', '2019-03-15 08:29:08'),
(53, 40, '#ff00ff', 'area', 0, 1, 17851, 1, 1, 1, '2019-03-15 08:29:08', '2019-03-15 08:29:08'),
(54, 42, '#444', 'line', 0, 1, 17852, 1, 3, 3, '2019-06-26 13:37:29', '2019-06-26 13:37:29'),
(55, 42, '#0000ff', 'line', 0, 1, 11302, 1, 3, 3, '2019-06-26 13:37:29', '2019-06-26 13:37:29');

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
(1, 'Admin', 'admin@gmail.com', '$2y$10$ka9QkHnif9CgiDY4SgyGHu3McdWLwDLNTQlUHuxNU29wBYS4cv8nG', 'sph5450xjlTF6aqHLWHolGfPlxrY8RXjEICS99Ql4B2POfSQyex87JGloZJh', '2018-10-05 00:36:56', '2018-10-05 00:36:56'),
(2, 'testing', 'dino@yop.com', '$2y$10$39rfS2LvWVxJAkLaGN.Zt.uH0T7a.KFSdpBkoF7PKwRIZENq3nn4y', NULL, '2019-03-12 03:54:18', '2019-03-12 03:54:18'),
(3, 'pramod', 'pramod.kumar@contriverz.com', '$2y$10$LbfqObyXCU1tO4LklljVNew3w5fsLLvVWPHqyYU7DXQHFS5.1Qp8G', NULL, '2019-03-15 06:04:32', '2019-03-15 06:04:32');

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
(29, 'test workchart', 1, '', '2018-11-16 04:19:45', '2018-11-16 04:19:45'),
(31, 'New Work Chart', 1, '', '2018-11-29 00:18:12', '2018-11-29 00:18:12'),
(38, 'test-peter-1234', 1, '', '2019-02-13 02:26:48', '2019-02-13 02:27:06'),
(40, 'New Testing Chart Latest', 1, '', '2019-03-05 00:58:03', '2019-03-05 00:58:03'),
(42, 'Peter#1', 1, '', '2019-03-05 01:22:39', '2019-03-05 01:22:39'),
(43, 'drt', 2, '', '2019-03-12 03:54:26', '2019-03-12 03:54:26'),
(44, 'New Blank Chart', 1, '', '2019-03-13 06:48:36', '2019-03-13 06:48:36'),
(46, 'dino', 1, '', '2019-03-19 08:06:42', '2019-03-19 08:06:42'),
(47, 'mytest', 3, '', '2019-06-26 08:04:49', '2019-06-26 08:04:49');

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
-- Indexes for table `algos`
--
ALTER TABLE `algos`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `intervals`
--
ALTER TABLE `intervals`
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
-- AUTO_INCREMENT for table `algos`
--
ALTER TABLE `algos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `charts`
--
ALTER TABLE `charts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `chart_comments`
--
ALTER TABLE `chart_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `chart_groups`
--
ALTER TABLE `chart_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `chart_lines`
--
ALTER TABLE `chart_lines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `chart_signals`
--
ALTER TABLE `chart_signals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
--
-- AUTO_INCREMENT for table `intervals`
--
ALTER TABLE `intervals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `workareas`
--
ALTER TABLE `workareas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `workcharts`
--
ALTER TABLE `workcharts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `workchart_timeseries`
--
ALTER TABLE `workchart_timeseries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
