-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2024 at 02:19 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `disabilities`
--

CREATE TABLE `disabilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `disability_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `disabilities`
--

INSERT INTO `disabilities` (`id`, `disability_name`, `created_at`, `updated_at`) VALUES
(1, 'Learning', '2024-03-12 17:10:59', '2024-03-15 00:22:28'),
(2, 'Physical', '2024-03-12 17:11:13', '2024-03-12 17:11:13'),
(3, 'Visual', '2024-03-17 04:07:26', '2024-03-17 04:07:26'),
(4, 'Hearing', '2024-03-17 22:20:56', '2024-03-17 22:21:07');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_02_26_132739_create_question_table', 1),
(7, '2024_02_26_181840_create_user_answer_table', 1),
(8, '2024_03_05_085757_add_role_to_user_table', 2),
(9, '2024_03_07_065015_change_user_type', 2),
(10, '2024_03_12_163531_create_disabilities_table', 3),
(11, '2024_03_13_004239_add_column_for_users_disability_id', 3),
(12, '2024_03_13_210709_create_score_table', 4),
(13, '2024_03_17_110402_add_column_for_table_score', 5),
(14, '2024_03_17_111951_make_score_nullabel_in_score_table', 6);

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
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qNumber` int(11) NOT NULL,
  `qDescription` varchar(255) NOT NULL,
  `qAnswer` varchar(255) NOT NULL,
  `qChoicesB` varchar(255) NOT NULL,
  `qChoicesC` varchar(255) NOT NULL,
  `qChoicesD` varchar(255) NOT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `qNumber`, `qDescription`, `qAnswer`, `qChoicesB`, `qChoicesC`, `qChoicesD`, `added_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'How is a search engine similar to the engine in a car?', 'It allows you to navigate an online highway', 'It\'s powered by gasoline', 'It allows the internet to run smoothly', 'It is powered by electricity', 1, '2024-02-26 22:28:16', '2024-03-18 17:05:26'),
(2, 2, 'In the phrase, \"Internet users have a plethora of search engines to choose from,\" what does \"plethora\" mean?', 'Large Number', 'Pleasure', 'Limited few', 'Platform', 1, '2024-02-29 22:52:18', '2024-03-18 17:05:58'),
(3, 3, 'If you want to narrow down the results of an internet search, what\'s your best course of action?', 'Add more relevant words to your search', 'Remove the quotes from around the term you are searching for', 'Try using a more powerful search engine', 'Log off the Internet and go to the library', 1, '2024-02-29 23:59:41', '2024-03-18 17:06:40'),
(4, 4, 'In the phrase, \"A bad internet search can return an inordinate number of hits,\" what is the best synonym for \"inordinate?\"', 'Excessive', 'Unrelated', 'Incorrect', 'Moderate', 1, '2024-03-01 00:02:32', '2024-03-18 17:07:17'),
(5, 5, 'If you wanted to learn about George W. Bush\'s term as governor of Texas--but not his term as U.S. President--what would be the best phrase to search under?', '\"George W. Bush\" + Texas - President', '\"George W. Bush\" + Texas + President', '\"George W. Bush\" Texas Not President', '\"George W. Bush\" -Texas - President', 1, '2024-03-01 00:03:33', '2024-03-18 17:07:53'),
(6, 6, 'How does the search term \"Fred Rogers\" compare with the search term Fred Rogers, without the quotes?', '\"Fred Rogers\" would return more hits', 'Fred Rogers (without quotes) would return more hits', 'They would return an equal number of hits', 'Neither would return any hits without a plus sign between the words', 1, '2024-03-01 00:06:37', '2024-03-18 17:08:28'),
(8, 7, 'If you want to conduct the best internet search possible, what should you do before you begin?', 'Learn a bit about the topic you\'re searching for', 'Spend a lot of time on the internet.', 'Look up the history of search engines', 'Ask your friends about their favorite websites', 1, '2024-03-01 21:16:49', '2024-03-18 17:09:10'),
(10, 8, '\"Internet Math\" uses which two basic math operations?', 'Addition and subtraction', 'Addition and multiplication', 'Multiplication and division', 'Subtraction and division', 1, '2024-03-01 21:18:33', '2024-03-18 17:09:46'),
(13, 9, 'What is the function of the: help and \"search tips\" links featured on some search engines', 'They explain how each particular search engine works', 'They contain lists of topics featured on each search engine', 'They contain links to other search engines', 'They contain entire libraries if information', 1, '2024-03-18 17:17:01', '2024-03-18 17:17:01'),
(14, 10, '10. What can you conclude about search engines from the information presented in the movie', 'Knowing how to conduct a good, focused search is the most important part of online research', 'Google is the most powerful search engine on the internet', 'Using internet math is unnecessary on modern search engines', 'Search engines will never be easier to use than library card catalogs', 1, '2024-03-18 17:17:34', '2024-03-18 17:17:34');

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_scoreId` bigint(20) UNSIGNED NOT NULL,
  `examType` varchar(255) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `exempted` varchar(255) NOT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `disability_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `disability_id`, `email_verified_at`, `password`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jerry Gonzaga Sanguyo', 'JSANGUYO1624@GMAIL.COM', 1, NULL, '$2y$12$grP4tfXFtPbLSzv8rczNaeEV.2WherlIoZF4aD0hwONy.UQgBjF3i', 'superadmin', NULL, '2024-02-26 22:27:49', '2024-02-26 22:27:49'),
(9, 'AdminTest', 'AdminTest@gmail.com', NULL, NULL, '$2y$12$/f0W.DCzpliZ.9zSI3GNgOMAiZmJkAF.Ds31fOvaFkDmn6eRao5kC', 'admin', NULL, '2024-03-18 17:14:47', '2024-03-18 17:14:47'),
(10, 'JudgeTest', 'JudgeTest@gmail.com', NULL, NULL, '$2y$12$4Bbuw6/rm8umdKks0tA/deGvg35o57btBM6o3lBMJHebudL.cLWOq', 'judge', NULL, '2024-03-18 17:15:04', '2024-03-18 17:15:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_answer`
--

CREATE TABLE `user_answer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `answer` varchar(255) NOT NULL,
  `result` int(11) NOT NULL,
  `time_spent` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disabilities`
--
ALTER TABLE `disabilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_added_by_foreign` (`added_by`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `score_user_scoreid_foreign` (`user_scoreId`),
  ADD KEY `score_added_by_foreign` (`added_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_disability_id_foreign` (`disability_id`);

--
-- Indexes for table `user_answer`
--
ALTER TABLE `user_answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_answer_user_id_foreign` (`user_id`),
  ADD KEY `user_answer_question_id_foreign` (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disabilities`
--
ALTER TABLE `disabilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_answer`
--
ALTER TABLE `user_answer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `score_user_scoreid_foreign` FOREIGN KEY (`user_scoreId`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_disability_id_foreign` FOREIGN KEY (`disability_id`) REFERENCES `disabilities` (`id`);

--
-- Constraints for table `user_answer`
--
ALTER TABLE `user_answer`
  ADD CONSTRAINT `user_answer_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_answer_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
