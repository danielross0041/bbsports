-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2021 at 03:33 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taskboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(10) UNSIGNED NOT NULL,
  `attribute` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `attribute`, `name`, `role`, `color`, `is_active`, `is_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'roles', 'CEO', 'Super Admin', '#00ffe5', 1, 0, '2021-05-12 00:45:00', '2021-05-12 00:56:40', NULL),
(2, 'roles', 'COO', 'Admin', '#0084ff', 1, 0, '2021-05-12 00:45:13', '2021-05-12 00:45:33', NULL),
(3, 'roles', 'Manager', 'Manager', '#b3ff00', 1, 0, '2021-05-12 00:46:30', '2021-05-12 00:46:30', NULL),
(4, 'roles', 'Employee', 'Employee', '#ff5c33', 1, 0, '2021-05-12 00:46:51', '2021-05-12 00:46:51', NULL),
(5, 'departments', 'Custom Development', '', '#007a6e', 1, 0, '2021-05-12 00:47:25', '2021-05-12 00:47:25', NULL),
(6, 'departments', 'WordPress Development', '', '#3fc624', 1, 0, '2021-05-12 00:47:48', '2021-05-12 00:47:48', NULL),
(7, 'departments', 'Logo Design', '', '#7d248f', 1, 0, '2021-05-12 00:48:14', '2021-05-12 00:48:14', NULL),
(8, 'departments', 'Mock Design', '', '#1e00ff', 1, 0, '2021-05-12 00:48:34', '2021-05-12 00:48:34', NULL),
(9, 'designations', 'Executive', '', '#a7f4ec', 1, 0, '2021-05-12 00:49:08', '2021-05-12 00:49:08', NULL),
(10, 'designations', 'Junior Executive', '', '#a7f4ec', 1, 0, '2021-05-12 00:49:23', '2021-05-12 00:49:23', NULL),
(11, 'designations', 'Senior Executive', '', '#327770', 1, 0, '2021-05-12 00:49:43', '2021-05-12 00:49:43', NULL),
(12, 'designations', 'Manager Executive', '', '#007bff', 1, 0, '2021-05-12 00:50:30', '2021-05-12 00:50:30', NULL),
(13, 'designations', 'Chief Operating Officer', '', '#ae00ff', 1, 0, '2021-05-12 00:50:50', '2021-05-12 00:50:50', NULL),
(14, 'designations', 'Chief Executive Officer', '', '#ff007b', 1, 0, '2021-05-12 00:51:23', '2021-05-12 00:51:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_departments_table', 1),
(2, '2014_10_12_000000_create_designations_table', 1),
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2021_05_08_010845_attributes', 1),
(7, '2021_05_12_051804_role_assign', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_assign`
--

CREATE TABLE `role_assign` (
  `id` int(10) UNSIGNED NOT NULL,
  `assignee` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_assign`
--

INSERT INTO `role_assign` (`id`, `assignee`, `role_id`, `is_active`, `is_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'a:4:{i:0;s:7:\"roles_1\";i:1;s:13:\"departments_2\";i:2;s:13:\"departments_4\";i:3;s:14:\"designations_3\";}', 2, 1, 0, '2021-05-11 20:05:21', '2021-05-11 20:05:21', NULL),
(2, 'a:12:{i:0;s:7:\"roles_1\";i:1;s:7:\"roles_2\";i:2;s:7:\"roles_3\";i:3;s:7:\"roles_4\";i:4;s:13:\"departments_1\";i:5;s:13:\"departments_2\";i:6;s:13:\"departments_3\";i:7;s:13:\"departments_4\";i:8;s:14:\"designations_1\";i:9;s:14:\"designations_2\";i:10;s:14:\"designations_3\";i:11;s:14:\"designations_4\";}', 1, 1, 0, '2021-05-11 20:06:25', '2021-05-11 20:06:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume_doc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnic_doc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education_doc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personal_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phonenumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residential_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_id` int(11) NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `join_date` date NOT NULL,
  `reporting_line` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v_model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v_model_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v_number_plate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `profile_pic`, `resume_doc`, `cnic_doc`, `education_doc`, `personal_email`, `phonenumber`, `emergency_number`, `cnic`, `residential_address`, `blood_group`, `dob`, `gender`, `marital_status`, `emp_id`, `designation`, `department`, `join_date`, `reporting_line`, `v_model_name`, `v_model_year`, `v_number_plate`, `bank_account_number`, `is_active`, `is_deleted`, `created_at`, `updated_at`, `deleted_at`, `remember_token`) VALUES
(1, 'Administrator', 'admin', 'admin@project.com', NULL, '$2y$10$tmPeoAmP.ER/7cVW6JvGMOhEtCztu7LiyGde99kwQWO2ot.Ad7tGa', 'uploads/avatar/d05c0005452b9f34da2619e71b70561f/8cObG2FFbK0eQ7WwW6douTP2O3YjKLu4szGd1vKR.png', 'uploads/resume/2339f4445ad239e370e032dbee4d5819/4e9psgcsxImYuXFTRJMdpu9RS7RgL6twLhX6QfCT.png', 'uploads/cnic/b591d9b80583399ce26d62ab98bf47ec/it4PcMBwokHHu43ruRYeNi1benQEdfCCEolbOcLr.png', NULL, 'admin@thesoftcube.com', '0300-00000000', '0300-00000000', '00000-0000000-0', 'None', 'B-VE', '1992-06-14', 'male', 'single', 1027, 'Chief Executive Officer', 'Custom Development', '2021-05-01', 'me@mydomain.com', 'Vitz', '2021', '12345', 'None', 1, 0, '2021-05-11 19:44:21', '2021-05-11 20:08:25', NULL, NULL),
(2, 'Junaid pervez', 'junaidpervez', 'junaid.pervez@thesoftcube.com', NULL, '$2y$10$fhwPHT7rJ4/vsdLU8jQ9e.pW/QTJYBNuIL.o8Gq2W9Djvm.8CmkEq', 'uploads/avatar/e793c089fd61fd5f9ac89162136c47c7/Yb0EsbzahpuzAaB5ozqzafBAZx0oRPmwi3VWDH3I.png', 'uploads/resume/6c08c99dc3f53d5b2ea945fe0767a0a2/Eb01WKZGxPZ6zPskGdj7JaT0pohDFl5yw93e4wcV.png', 'uploads/cnic/cf6cbede9c63b5f99c0988ed76818e60/Pz4UodEGGAWvmMvWT7C3ASnQ1hmkObyva5BGMxrZ.png', NULL, 'junaidpervez@gmail.com', '0300-00000000', '0300-00000000', '00000-0000000-0', 'None', 'O+VE', '1995-01-01', 'male', 'single', 1001, 'Chief Operating Officer', 'WordPress Development', '2021-04-01', 'me@mydomain.com', '', '', '', 'None', 1, 0, '2021-05-11 20:21:21', '2021-05-11 20:21:21', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
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
-- Indexes for table `role_assign`
--
ALTER TABLE `role_assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role_assign`
--
ALTER TABLE `role_assign`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
