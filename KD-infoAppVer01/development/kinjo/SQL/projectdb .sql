-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-04-30 13:19:45
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `projectdb`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` text NOT NULL,
  `description` text NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `ratings`
--

INSERT INTO `ratings` (`id`, `project_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(2, 22, 5, NULL, '2024-04-26 04:27:44', '2024-04-26 04:27:44'),
(3, 22, 5, NULL, '2024-04-26 04:27:44', '2024-04-26 04:27:44'),
(4, 22, 5, NULL, '2024-04-26 04:27:45', '2024-04-26 04:27:45'),
(5, 22, 4, NULL, '2024-04-26 04:27:55', '2024-04-26 04:27:55'),
(6, 31, 5, NULL, '2024-04-30 01:59:07', '2024-04-30 01:59:07'),
(7, 31, 5, NULL, '2024-04-30 02:02:20', '2024-04-30 02:02:20'),
(8, 31, 4, NULL, '2024-04-30 02:02:25', '2024-04-30 02:02:25'),
(9, 32, 5, NULL, '2024-04-30 02:45:54', '2024-04-30 02:45:54'),
(10, 32, 5, NULL, '2024-04-30 02:56:32', '2024-04-30 02:56:32'),
(11, 33, 5, NULL, '2024-04-30 02:56:49', '2024-04-30 02:56:49'),
(12, 35, 5, NULL, '2024-04-30 03:59:19', '2024-04-30 03:59:19'),
(13, 35, 3, NULL, '2024-04-30 03:59:30', '2024-04-30 03:59:30'),
(14, 36, 5, NULL, '2024-04-30 04:05:42', '2024-04-30 04:05:42'),
(15, 37, 3, NULL, '2024-04-30 04:12:51', '2024-04-30 04:12:51'),
(16, 37, 5, NULL, '2024-04-30 04:12:59', '2024-04-30 04:12:59');

-- --------------------------------------------------------

--
-- テーブルの構造 `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `replies`
--

INSERT INTO `replies` (`id`, `project_id`, `content`, `created_at`) VALUES
(25, 36, 'いいとおもった', '2024-04-30 04:05:54');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `projects` ADD FULLTEXT KEY `image_name` (`image_name`);

--
-- テーブルのインデックス `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- テーブルの AUTO_INCREMENT `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- テーブルの AUTO_INCREMENT `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
