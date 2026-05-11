-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 11, 2026 at 07:15 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db digma-uks`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `attempts` smallint UNSIGNED NOT NULL,
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
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `created_at`, `updated_at`) VALUES
(1, 'X RPL 1', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(2, 'X TKJ 1', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(3, 'XI RPL 2', '2026-05-04 00:56:20', '2026-05-04 00:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_obat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `nama_obat`, `satuan`, `stok`, `created_at`, `updated_at`) VALUES
(1, 'Paracetamol 500mg', 'Tablet', 49, '2026-05-04 00:56:20', '2026-05-10 04:13:59'),
(2, 'Amoxicillin 500mg', 'Kapsul', 30, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(3, 'Antasida Doen', 'Tablet', 40, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(4, 'Betadine 15ml', 'Botol', 10, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(5, 'Minyak Kayu Putih', 'Botol', 15, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(6, 'Tolak Angin', 'Sachet', 25, '2026-05-04 00:56:20', '2026-05-04 00:56:20');

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
(4, '2026_04_27_075554_create_kelas_table', 1),
(5, '2026_04_27_075555_create_students_table', 1),
(6, '2026_04_27_075556_create_medicines_table', 1),
(7, '2026_04_27_075557_create_treatments_table', 1),
(8, '2026_04_27_075558_create_treatment_details_table', 1),
(9, '2026_04_27_075559_add_role_to_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('8b3aHPZZAhhLYpbZrdXWXkKdIqjiQ0pKAiJRZF7J', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJhcmttUk0xdGduQUdjRno4OGxrSFlxcXFVYTVoa3BrcWNJbjlvbm1CIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2Rhc2hib2FyZCIsInJvdXRlIjoiZGFzaGJvYXJkIn0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==', 1778411685),
('YzZJpHR7liHRcVVkwKw8yTYGnfO9Kq3Rtik4zWYs', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJZQlBXd0VRb0V2ZmhhekxuU0dxSVlXWlhjUTBUTVV0U09UcXhpamhhIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9tZWRpY2luZXMiLCJyb3V0ZSI6Im1lZGljaW5lcy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==', 1778483578);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint UNSIGNED NOT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_id` bigint UNSIGNED NOT NULL,
  `jk` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `nis`, `nama`, `kelas_id`, `jk`, `created_at`, `updated_at`) VALUES
(1, '1001', 'Budi Santoso', 1, 'L', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(2, '1002', 'Siti Aminah', 1, 'P', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(3, '1003', 'Andi Wijaya', 2, 'L', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(4, '1004', 'Rina Melati', 2, 'P', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(5, '1005', 'Joko Anwar', 3, 'L', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(6, '1006', 'Kevin Lius Bong', 3, 'L', '2026-05-10 04:12:23', '2026-05-10 04:12:23');

-- --------------------------------------------------------

--
-- Table structure for table `treatments`
--

CREATE TABLE `treatments` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `keluhan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `diagnosa` text COLLATE utf8mb4_unicode_ci,
  `tanggal_kunjungan` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `treatments`
--

INSERT INTO `treatments` (`id`, `student_id`, `keluhan`, `diagnosa`, `tanggal_kunjungan`, `created_at`, `updated_at`) VALUES
(1, 3, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-01-13', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(2, 1, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-01-22', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(3, 3, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-01-13', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(4, 5, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-01-18', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(5, 1, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-01-07', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(6, 1, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-02-26', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(7, 5, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-02-13', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(8, 4, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-02-03', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(9, 1, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-03-08', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(10, 5, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-03-25', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(11, 1, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-03-03', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(12, 1, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-03-11', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(13, 5, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-03-04', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(14, 1, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-04-20', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(15, 5, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-04-15', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(16, 5, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-04-06', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(17, 2, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-04-10', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(18, 4, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-05-09', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(19, 1, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-05-25', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(20, 1, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-05-24', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(21, 3, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-06-14', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(22, 1, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-06-20', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(23, 2, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-06-13', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(24, 5, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-06-23', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(25, 3, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-06-21', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(26, 4, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-07-04', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(27, 3, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-07-23', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(28, 4, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-07-11', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(29, 3, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-07-15', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(30, 2, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-08-19', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(31, 1, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-08-25', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(32, 4, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-08-21', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(33, 1, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-08-26', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(34, 1, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-09-03', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(35, 4, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-09-26', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(36, 5, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-10-25', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(37, 4, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-10-24', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(38, 1, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-10-10', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(39, 5, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-10-07', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(40, 1, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-11-07', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(41, 5, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-11-22', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(42, 1, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-11-15', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(43, 4, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-11-11', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(44, 2, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-12-04', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(45, 1, 'Pusing dan mual ringan', 'Gejala maag atau kelelahan', '2026-12-21', '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(46, 6, 'pusing', 'Istirahat di uks', '2026-05-10', '2026-05-10 04:13:59', '2026-05-10 04:13:59');

-- --------------------------------------------------------

--
-- Table structure for table `treatment_details`
--

CREATE TABLE `treatment_details` (
  `id` bigint UNSIGNED NOT NULL,
  `medicine_id` bigint UNSIGNED NOT NULL,
  `treatment_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `treatment_details`
--

INSERT INTO `treatment_details` (`id`, `medicine_id`, `treatment_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 4, 4, 2, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(2, 2, 5, 1, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(3, 4, 7, 2, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(4, 3, 9, 1, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(5, 4, 11, 2, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(6, 4, 12, 2, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(7, 4, 13, 1, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(8, 5, 18, 2, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(9, 6, 20, 1, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(10, 2, 21, 2, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(11, 5, 22, 1, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(12, 5, 24, 1, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(13, 6, 26, 2, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(14, 3, 27, 1, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(15, 3, 28, 2, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(16, 1, 29, 1, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(17, 6, 30, 1, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(18, 6, 31, 2, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(19, 3, 32, 1, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(20, 5, 39, 2, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(21, 3, 40, 1, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(22, 2, 41, 2, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(23, 6, 42, 1, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(24, 3, 43, 1, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(25, 4, 45, 1, '2026-05-04 00:56:20', '2026-05-04 00:56:20'),
(26, 1, 46, 1, '2026-05-10 04:13:59', '2026-05-10 04:13:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','petugas') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'petugas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Afriza Nur Aini', 'afrizanuraini@gmail.com', NULL, '$2y$12$G0Fv7t3RKxB4jt7nh237..YRO2xdmhPFSOa4hEBa9BcvWLH8yD4Bq', '4k5Z3x6jZZZQVpQqEPBtaKco9XWZORHUueSHNw6XTvG7b6xX9BOvRnbjq3wS', '2026-05-04 00:56:19', '2026-05-04 00:56:19', 'admin'),
(2, 'Petugas PMR', 'petugas@uks.com', NULL, '$2y$12$D1cIV/708uBSYvy.cN3WB.YQildZujayVtSG79HlBDyhnbMzEZKcK', NULL, '2026-05-04 00:56:20', '2026-05-04 00:56:20', 'petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

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
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_nis_unique` (`nis`),
  ADD KEY `students_kelas_id_foreign` (`kelas_id`);

--
-- Indexes for table `treatments`
--
ALTER TABLE `treatments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `treatments_student_id_foreign` (`student_id`);

--
-- Indexes for table `treatment_details`
--
ALTER TABLE `treatment_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `treatment_details_medicine_id_foreign` (`medicine_id`),
  ADD KEY `treatment_details_treatment_id_foreign` (`treatment_id`);

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
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `treatments`
--
ALTER TABLE `treatments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `treatment_details`
--
ALTER TABLE `treatment_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `treatments`
--
ALTER TABLE `treatments`
  ADD CONSTRAINT `treatments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `treatment_details`
--
ALTER TABLE `treatment_details`
  ADD CONSTRAINT `treatment_details_medicine_id_foreign` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `treatment_details_treatment_id_foreign` FOREIGN KEY (`treatment_id`) REFERENCES `treatments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
