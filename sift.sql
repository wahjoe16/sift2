-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2024 at 04:25 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sift`
--

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `category_archive_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_archive_id` bigint(20) UNSIGNED NOT NULL,
  `tahun_ajaran_id` bigint(20) UNSIGNED NOT NULL,
  `semester_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_archives`
--

CREATE TABLE `category_archives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_archives`
--

INSERT INTO `category_archives` (`id`, `name`, `description`, `section_id`, `created_at`, `updated_at`) VALUES
(1, 'Pendidikan', NULL, 1, '2023-12-27 19:38:22', '2023-12-27 19:38:22'),
(2, 'Penelitian', NULL, 1, '2023-12-27 19:39:28', '2023-12-27 19:39:28'),
(3, 'Pengabdian kepada Masyarakat', NULL, 1, '2023-12-27 19:40:48', '2023-12-27 19:40:48'),
(4, 'Unsur Penunjang', NULL, 1, '2023-12-27 19:42:02', '2023-12-27 19:42:02'),
(5, 'Kerja Sama Dalam Negeri', NULL, 3, '2023-12-27 19:43:35', '2023-12-27 19:43:35'),
(6, 'Kerja Sama Luar Negeri', NULL, 3, '2023-12-27 19:43:58', '2023-12-27 19:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_seminar`
--

CREATE TABLE `daftar_seminar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `tahun_ajaran_id` bigint(20) UNSIGNED NOT NULL,
  `semester_id` bigint(20) UNSIGNED NOT NULL,
  `dosen1_id` bigint(20) UNSIGNED NOT NULL,
  `dosen2_id` bigint(20) UNSIGNED DEFAULT NULL,
  `program_studi_id` varchar(100) NOT NULL,
  `judul_skripsi` text NOT NULL,
  `syarat_1` varchar(255) DEFAULT NULL,
  `status_1` tinyint(4) DEFAULT 0,
  `keterangan_1` text DEFAULT NULL,
  `syarat_2` varchar(255) DEFAULT NULL,
  `status_2` tinyint(4) DEFAULT 0,
  `keterangan_2` text DEFAULT NULL,
  `syarat_3` varchar(255) DEFAULT NULL,
  `status_3` tinyint(4) DEFAULT 0,
  `keterangan_3` text DEFAULT NULL,
  `syarat_4` varchar(255) DEFAULT NULL,
  `status_4` tinyint(4) DEFAULT 0,
  `keterangan_4` text DEFAULT NULL,
  `syarat_5` varchar(255) DEFAULT NULL,
  `status_5` tinyint(4) DEFAULT 0,
  `keterangan_5` text DEFAULT NULL,
  `syarat_6` varchar(255) DEFAULT NULL,
  `status_6` tinyint(4) DEFAULT 0,
  `keterangan_6` text DEFAULT NULL,
  `syarat_7` varchar(255) DEFAULT NULL,
  `status_7` tinyint(4) DEFAULT 0,
  `keterangan_7` text DEFAULT NULL,
  `syarat_8` varchar(255) DEFAULT NULL,
  `status_8` tinyint(4) DEFAULT 0,
  `keterangan_8` text DEFAULT NULL,
  `syarat_9` varchar(255) DEFAULT NULL,
  `status_9` tinyint(4) DEFAULT 0,
  `keterangan_9` text DEFAULT NULL,
  `syarat_10` varchar(255) DEFAULT NULL,
  `status_10` tinyint(4) DEFAULT 0,
  `keterangan_10` text DEFAULT NULL,
  `syarat_11` varchar(255) DEFAULT NULL,
  `status_11` tinyint(4) DEFAULT 0,
  `keterangan_11` text DEFAULT NULL,
  `syarat_12` varchar(255) DEFAULT NULL,
  `status_12` tinyint(4) DEFAULT 0,
  `keterangan_12` text DEFAULT NULL,
  `syarat_13` varchar(255) DEFAULT NULL,
  `status_13` tinyint(4) DEFAULT 0,
  `keterangan_13` text DEFAULT NULL,
  `syarat_14` varchar(255) DEFAULT NULL,
  `status_14` tinyint(4) DEFAULT 0,
  `keterangan_14` text DEFAULT NULL,
  `syarat_15` varchar(255) DEFAULT NULL,
  `status_15` tinyint(4) DEFAULT 0,
  `keterangan_15` text DEFAULT NULL,
  `syarat_16` varchar(255) DEFAULT NULL,
  `status_16` tinyint(4) DEFAULT 0,
  `keterangan_16` text DEFAULT NULL,
  `syarat_17` varchar(255) DEFAULT NULL,
  `status_17` tinyint(4) DEFAULT 0,
  `keterangan_17` text DEFAULT NULL,
  `syarat_18` varchar(255) DEFAULT NULL,
  `status_18` tinyint(4) DEFAULT 0,
  `keterangan_18` text DEFAULT NULL,
  `syarat_19` varchar(255) DEFAULT NULL,
  `status_19` tinyint(4) DEFAULT 0,
  `keterangan_19` text DEFAULT NULL,
  `syarat_20` varchar(255) DEFAULT NULL,
  `status_20` tinyint(4) DEFAULT 0,
  `keterangan_20` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daftar_seminar`
--

INSERT INTO `daftar_seminar` (`id`, `mahasiswa_id`, `tahun_ajaran_id`, `semester_id`, `dosen1_id`, `dosen2_id`, `program_studi_id`, `judul_skripsi`, `syarat_1`, `status_1`, `keterangan_1`, `syarat_2`, `status_2`, `keterangan_2`, `syarat_3`, `status_3`, `keterangan_3`, `syarat_4`, `status_4`, `keterangan_4`, `syarat_5`, `status_5`, `keterangan_5`, `syarat_6`, `status_6`, `keterangan_6`, `syarat_7`, `status_7`, `keterangan_7`, `syarat_8`, `status_8`, `keterangan_8`, `syarat_9`, `status_9`, `keterangan_9`, `syarat_10`, `status_10`, `keterangan_10`, `syarat_11`, `status_11`, `keterangan_11`, `syarat_12`, `status_12`, `keterangan_12`, `syarat_13`, `status_13`, `keterangan_13`, `syarat_14`, `status_14`, `keterangan_14`, `syarat_15`, `status_15`, `keterangan_15`, `syarat_16`, `status_16`, `keterangan_16`, `syarat_17`, `status_17`, `keterangan_17`, `syarat_18`, `status_18`, `keterangan_18`, `syarat_19`, `status_19`, `keterangan_19`, `syarat_20`, `status_20`, `keterangan_20`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 13, 41, 44, 'Teknik Pertambangan', 'test', '10070120200_doc1.pdf', 1, NULL, '10070120200_doc3.pdf', 1, NULL, '10070120200_doc4.pdf', 1, NULL, '10070120200_doc5.pdf', 1, NULL, '10070120200_doc7.pdf', 1, NULL, '10070120200_doc8.pdf', 1, NULL, '10070120200_doc9.pdf', 1, NULL, '10070120200_doc10.pdf', 1, NULL, '10070120200_doc11.pdf', 1, NULL, '10070120200_doc12.pdf', 1, NULL, '10070120200_doc13.pdf', 1, NULL, '10070120200_Draft Skripsi.pdf', 1, NULL, '10070120200_kombinasi keramik kayu.docx', 1, NULL, '10070120200_doc16.pdf', 1, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, 1, NULL, '2024-01-09 21:37:02', '2024-01-09 21:54:59'),
(3, 33, 2, 13, 128, 153, 'Perencanaan Wilayah dan Kota', 'test', '10070320001_1705042856_doc11.pdf', 1, NULL, '10070320001_1705042856_doc12.pdf', 1, NULL, '10070320001_1705042856_doc13.pdf', 1, NULL, '10070320001_1705042856_doc14.pdf', 1, NULL, '10070320001_1705042856_doc15 (1).pdf', 1, NULL, '10070320001_1705042856_doc16.pdf', 1, NULL, '10070320001_1705042856_doc17.pdf', 1, NULL, '10070320001_1705042856_doc1.pdf', 1, NULL, '10070320001_1705042856_doc2.pdf', 1, NULL, '10070320001_1705042856_doc3.pdf', 1, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, 1, NULL, '2024-01-11 23:42:09', '2024-01-12 00:02:54'),
(4, 3, 2, 13, 74, 79, 'Teknik Industri', 'test seminar', '10070220200_1705546310_doc16.pdf', 1, NULL, '10070220200_1705546310_doc14.pdf', 1, NULL, '10070220200_1705546310_doc13.pdf', 1, NULL, '10070220200_1705546310_doc12.pdf', 1, NULL, '10070220200_1705546310_doc11.pdf', 1, NULL, '10070220200_1705546310_doc10.pdf', 1, NULL, '10070220200_1705546310_doc9.pdf', 1, NULL, '10070220200_1705546310_doc8.pdf', 1, NULL, '10070220200_1705546310_doc7.pdf', 1, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, 1, NULL, '2024-01-17 19:25:08', '2024-01-17 19:54:28'),
(5, 4, 2, 13, 138, 153, 'Perencanaan Wilayah dan Kota', 'test', '10070320300_1705548099_doc16.pdf', 0, 'Salah', '10070320300_1705548099_doc14.pdf', 0, 'Salah', '10070320300_1705548099_doc13.pdf', 0, 'Salah', '10070320300_1705548099_doc12.pdf', 0, 'Salah', '10070320300_1705548099_doc11.pdf', 0, 'Salah', '10070320300_1705548099_doc10.pdf', 0, 'Salah', '10070320300_1705548099_doc9.pdf', 0, 'Salah', '10070320300_1705548099_doc8.pdf', 0, 'Salah', '10070320300_1705548099_doc7.pdf', 0, 'Salah', '10070320300_1705548099_doc5.pdf', 0, 'Salah', NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, 0, NULL, '2024-01-17 20:11:54', '2024-01-17 20:21:39');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_sidang`
--

CREATE TABLE `daftar_sidang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `tahun_ajaran_id` bigint(20) UNSIGNED NOT NULL,
  `semester_id` bigint(20) UNSIGNED NOT NULL,
  `dosen1_id` bigint(20) UNSIGNED NOT NULL,
  `dosen2_id` bigint(20) UNSIGNED DEFAULT NULL,
  `program_studi_id` varchar(100) NOT NULL,
  `judul_skripsi` text NOT NULL,
  `syarat_1` varchar(255) DEFAULT NULL,
  `status_1` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan_1` text DEFAULT NULL,
  `syarat_2` varchar(255) DEFAULT NULL,
  `status_2` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan_2` text DEFAULT NULL,
  `syarat_3` varchar(255) DEFAULT NULL,
  `status_3` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan_3` text DEFAULT NULL,
  `syarat_4` varchar(255) DEFAULT NULL,
  `status_4` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan_4` text DEFAULT NULL,
  `syarat_5` varchar(255) DEFAULT NULL,
  `status_5` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan_5` text DEFAULT NULL,
  `syarat_6` varchar(255) DEFAULT NULL,
  `status_6` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan_6` text DEFAULT NULL,
  `syarat_7` varchar(255) DEFAULT NULL,
  `status_7` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan_7` text DEFAULT NULL,
  `syarat_8` varchar(255) DEFAULT NULL,
  `status_8` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan_8` text DEFAULT NULL,
  `syarat_9` varchar(255) DEFAULT NULL,
  `status_9` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan_9` text DEFAULT NULL,
  `syarat_10` varchar(255) DEFAULT NULL,
  `status_10` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan_10` text DEFAULT NULL,
  `syarat_11` varchar(255) DEFAULT NULL,
  `status_11` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan_11` text DEFAULT NULL,
  `syarat_12` varchar(255) DEFAULT NULL,
  `status_12` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan_12` text DEFAULT NULL,
  `syarat_13` varchar(255) DEFAULT NULL,
  `status_13` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan_13` text DEFAULT NULL,
  `syarat_14` varchar(255) DEFAULT NULL,
  `status_14` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan_14` text DEFAULT NULL,
  `syarat_15` varchar(255) DEFAULT NULL,
  `status_15` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan_15` text DEFAULT NULL,
  `syarat_16` varchar(255) DEFAULT NULL,
  `status_16` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan_16` text DEFAULT NULL,
  `syarat_17` varchar(255) DEFAULT NULL,
  `status_17` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan_17` text DEFAULT NULL,
  `syarat_18` varchar(255) DEFAULT NULL,
  `status_18` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan_18` text DEFAULT NULL,
  `syarat_19` varchar(255) DEFAULT NULL,
  `status_19` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan_19` text DEFAULT NULL,
  `syarat_20` varchar(255) DEFAULT NULL,
  `status_20` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan_20` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daftar_sidang`
--

INSERT INTO `daftar_sidang` (`id`, `mahasiswa_id`, `tahun_ajaran_id`, `semester_id`, `dosen1_id`, `dosen2_id`, `program_studi_id`, `judul_skripsi`, `syarat_1`, `status_1`, `keterangan_1`, `syarat_2`, `status_2`, `keterangan_2`, `syarat_3`, `status_3`, `keterangan_3`, `syarat_4`, `status_4`, `keterangan_4`, `syarat_5`, `status_5`, `keterangan_5`, `syarat_6`, `status_6`, `keterangan_6`, `syarat_7`, `status_7`, `keterangan_7`, `syarat_8`, `status_8`, `keterangan_8`, `syarat_9`, `status_9`, `keterangan_9`, `syarat_10`, `status_10`, `keterangan_10`, `syarat_11`, `status_11`, `keterangan_11`, `syarat_12`, `status_12`, `keterangan_12`, `syarat_13`, `status_13`, `keterangan_13`, `syarat_14`, `status_14`, `keterangan_14`, `syarat_15`, `status_15`, `keterangan_15`, `syarat_16`, `status_16`, `keterangan_16`, `syarat_17`, `status_17`, `keterangan_17`, `syarat_18`, `status_18`, `keterangan_18`, `syarat_19`, `status_19`, `keterangan_19`, `syarat_20`, `status_20`, `keterangan_20`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 13, 41, 43, 'Teknik Pertambangan', 'test', '10070120200_doc7.pdf', 1, NULL, '10070120200_doc8.pdf', 1, NULL, '10070120200_doc10.pdf', 1, NULL, '10070120200_doc11.pdf', 1, NULL, '10070120200_doc12.pdf', 1, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, 1, NULL, '2024-01-11 20:46:18', '2024-01-11 21:25:16'),
(2, 33, 2, 13, 128, 153, 'Perencanaan Wilayah dan Kota', 'test', '10070320001_1705043994_doc7.pdf', 1, NULL, '10070320001_1705043994_doc8.pdf', 1, NULL, '10070320001_1705043994_doc9.pdf', 1, NULL, '10070320001_1705043994_doc10.pdf', 1, NULL, '10070320001_1705043994_doc11.pdf', 1, NULL, '10070320001_1705043994_doc12.pdf', 1, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, 1, NULL, '2024-01-12 00:08:11', '2024-01-12 00:21:50'),
(3, 3, 2, 13, 74, 79, 'Teknik Industri', 'sidang', '10070220200_1705550682_AKTA KELAHIRAN-KHALISA-20122021153707.pdf', 1, NULL, '10070220200_1705550682_CamScanner 10-28-2020 07.15.19.pdf', 1, NULL, '10070220200_1705550682_CamScanner 10-28-2020 07.17.52.pdf', 1, NULL, '10070220200_1705550682_CamScanner 10-28-2020 07.17.52-1.pdf', 1, NULL, '10070220200_1705550682_CamScanner 10-28-2020 07.25.54.pdf', 1, NULL, '10070220200_1705550682_CamScanner 10-28-2020 07.26.45.pdf', 1, NULL, '10070220200_1705550682_CamScanner 10-28-2020 07.28.04.pdf', 1, NULL, '10070220200_1705550682_CamScanner 10-28-2020 07.29.01.pdf', 1, NULL, '10070220200_1705550682_CamScanner 10-28-2020 07.32.21.pdf', 1, NULL, '10070220200_1705550682_CamScanner 10-28-2020 07.34.00.pdf', 1, NULL, '10070220200_1705550682_CamScanner 10-28-2020 07.36.42.pdf', 1, NULL, '10070220200_1705550682_CamScanner 11-06-2020 07.11.pdf', 1, NULL, '10070220200_1705550682_KARTU KELUARGA-WAHYU-30112021110637.pdf', 1, NULL, '10070220200_1705550682_KIS BPJS ANAK WAHYU HIDAYAT TEKNIK 2021.pdf', 1, NULL, '10070220200_1705550682_kombinasi keramik kayu.pdf', 1, NULL, '10070220200_1705550682_myCV.pdf', 1, NULL, '10070220200_1705550682_Pelatihan pra jabatan.pdf', 1, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, 1, NULL, '2024-01-17 20:42:39', '2024-01-17 21:12:44');

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
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `collection_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `disk` varchar(255) NOT NULL,
  `conversions_disk` varchar(255) DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_06_03_152526_add_new_column_to_users_table', 2),
(6, '2014_10_12_200000_add_two_factor_columns_to_users_table', 3),
(7, '2023_06_03_155840_create_sessions_table', 3),
(8, '2023_06_07_092316_create_semesters_table', 4),
(11, '2023_06_08_041106_create_tahun_ajarans_table', 5),
(12, '2023_06_08_075318_create_daftar_seminars_table', 6),
(13, '2023_06_12_094636_create_daftar_sidangs_table', 7),
(14, '2020_05_21_100000_create_teams_table', 8),
(15, '2020_05_21_200000_create_team_user_table', 8),
(16, '2020_05_21_300000_create_team_invitations_table', 8),
(17, '2023_08_04_065525_create_sections_table', 9),
(18, '2023_08_07_024839_create_category_archives_table', 10),
(19, '2023_08_07_040838_create_subcategory_archives_table', 11),
(20, '2023_08_07_073102_create_archives_table', 12),
(21, '2023_08_08_025750_add_new_column_to_archives_table', 13),
(22, '2023_08_10_102604_add_column_name_to_archives_table', 14),
(23, '2023_08_15_071404_create_my_archives_table', 15),
(24, '2023_12_21_084833_create_media_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `my_archives`
--

CREATE TABLE `my_archives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `archive_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Akademik dan Karir Dosen', 'Sesi Akademik', '2023-08-06 19:29:38', '2023-08-31 19:24:50'),
(2, 'Keuangan, SDM dan Umum', 'Sesi keuangan, kepegawaian, sarana', '2023-08-06 19:34:59', '2023-08-31 19:25:20'),
(3, 'Kemahasiswaan, Kerja Sama, Alumni, dan Ruhul Islam', 'Sesi Kemahasiswaan, Kerja Sama, Ruhul Islam', '2023-08-06 19:35:40', '2023-08-31 19:26:01');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `semester` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `semester`, `created_at`, `updated_at`) VALUES
(13, 'Ganjil', '2023-06-07 20:49:39', '2023-06-07 20:49:39'),
(14, 'Genap', '2023-06-07 20:49:47', '2023-06-07 20:49:47');

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CZm9PwlCgm9jWwCFsnFZvugCPt0uK4dgA8x6GSy4', 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRE9GMkhHOGg2Z29UOEpIV3Z2VjYxeEdmY0FaVTh1NDhqUFl3Y3NZOCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kb2t1bWVudGFzaV9zaWRhbmcvZGF0YS1iaW1iaW5nYW4vMi90bWItc2hvdy0yIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDM7czo0OiJwYWdlIjtzOjEyOiJiaW1iaW5nYW5UbWIiO30=', 1708067100);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory_archives`
--

CREATE TABLE `subcategory_archives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `category_archive_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategory_archives`
--

INSERT INTO `subcategory_archives` (`id`, `name`, `description`, `section_id`, `category_archive_id`, `created_at`, `updated_at`) VALUES
(1, 'Pelaksanaan Perkuliahan', 'Deskripsi Pelaksanaan Perkuliahan', 1, 1, '2023-08-07 00:00:37', '2023-08-07 00:26:28'),
(3, 'Membimbing Seminar Mahasiswa', 'Deskripsi Membimbing Seminar Mahasiswa', 1, 1, '2023-08-14 20:05:07', '2023-08-14 20:05:07'),
(4, 'Membimbing KKN, Praktik Kerja Nyata, Praktik Kerja Lapangan', 'Deskripsi Membimbing KKN, Praktik Kerja Nyata, Praktik Kerja Lapangan', 1, 1, '2023-08-14 20:10:52', '2023-08-14 20:10:52'),
(5, 'Membimbing dan ikut membimbing dalam menghasilkan disertasi, tesis, skripsi dan laporan akhir studi', 'Deskripsi Membimbing dan ikut membimbing dalam menghasilkan disertasi, tesis, skripsi dan laporan akhir studi', 1, 1, '2023-08-14 20:11:59', '2023-08-14 20:11:59'),
(6, 'Bertugas sebagai penguji pada ujian akhir / profesi', NULL, 1, 1, '2023-08-14 20:13:16', '2023-08-14 20:13:16'),
(7, 'Membina kegiatan mahasiswa di bidang akademik dan kemahasiswaan', NULL, 1, 1, '2023-08-14 20:13:55', '2023-08-14 20:13:55'),
(8, 'Mengembangkan program kuliah yang mempunyai nilai kebaharuan metode atau substansi', NULL, 1, 1, '2023-08-14 20:14:30', '2023-08-14 20:14:30'),
(9, 'Mengembangkan bahan pengajaran/ bahan kuliah yang mempunyai nilai kebaharuan', NULL, 1, 1, '2023-08-14 20:15:00', '2023-08-14 20:15:00'),
(10, 'Menyampaikan orasi ilmiah di tingkat perguruan tinggi', NULL, 1, 1, '2023-08-14 20:15:26', '2023-08-14 20:15:26'),
(11, 'Menduduki jabatan pimpinan perguruan tinggi sesuai tugas pokok, fungsi dan kewenangan dan/atau setara', NULL, 1, 1, '2023-08-14 20:15:54', '2023-08-14 20:15:54'),
(12, 'Membimbing dosen yang mempunyai jabatan akademik lebih rendah setiap semester', NULL, 1, 1, '2023-08-14 20:16:39', '2023-08-14 20:16:39'),
(13, 'Melaksanakan kegiatan detasering dan pencangkokan di luar institusi tempat bekerja setiap semester', NULL, 1, 1, '2023-08-14 20:18:20', '2023-08-14 20:18:20'),
(14, 'Melaksanakan pengembangan diri untuk meningkatkan kompetensi', NULL, 1, 1, '2023-08-14 20:19:06', '2023-08-14 20:19:06'),
(15, 'Menghasilkan karya ilmiah sesuai dengan bidang ilmunya', NULL, 1, 2, '2023-08-14 20:19:45', '2023-08-14 20:19:45'),
(16, 'Hasil penelitian atau hasil pemikiran yang didesiminasikan', NULL, 1, 2, '2023-08-14 20:20:12', '2023-08-14 20:28:58'),
(17, 'Hasil penelitian atau pemikiran atau kerjasama industri yang tidak dipublikasikan (tersimpan dalam perpustakaan) yang dilakukan secara melembaga', NULL, 1, 2, '2023-08-14 20:20:46', '2023-08-14 20:20:46'),
(18, 'Menerjemahkan/menyadur buku ilmiah yang diterbitkan (ber ISBN)', NULL, 1, 2, '2023-08-14 20:21:18', '2023-08-14 20:21:18'),
(19, 'Mengedit/menyunting karya ilmiah dalam bentuk buku yang diterbitkan (ber ISBN)', NULL, 1, 2, '2023-08-14 20:21:39', '2023-08-14 20:21:39'),
(20, 'Membuat rancangan dan karya teknologi yang dipatenkan atau seni yang terdaftar di HaKI secara nasional atau internasional', NULL, 1, 2, '2023-08-14 20:22:01', '2023-08-14 20:22:01'),
(21, 'Membuat rancangan dan karya teknologi yang tidak dipatenkan', NULL, 1, 2, '2023-08-14 20:23:03', '2023-08-14 20:23:03'),
(22, 'Membuat rancangan dan karya seni yang tidak terdaftar HaKI', NULL, 1, 2, '2023-08-14 20:23:25', '2023-08-14 20:23:25'),
(23, 'Menduduki jabatan pimpinan pada lembaga pemerintahan/pejabat negara yang harus dibebaskan dari jabatan organiknya tiap semester', NULL, 1, 3, '2023-08-14 20:29:54', '2023-08-14 20:29:54'),
(24, 'Melaksanakan pengembangan hasil pendidikan, dan penelitian yang dapat dimanfaatkan oleh masyarakat/ industry setiap program', NULL, 1, 3, '2023-08-14 20:30:23', '2023-08-14 20:30:23'),
(25, 'Memberi latihan/penyuluhan/ penataran/ceramah pada masyarakat, terjadwal/terprogram', NULL, 1, 3, '2023-08-14 20:30:44', '2023-08-14 20:30:44'),
(26, 'Memberi pelayanan kepada masyarakat atau kegiatan lain yang menunjang pelaksanaan tugas pemerintahan dan pembangunan', NULL, 1, 3, '2023-08-14 20:31:08', '2023-08-14 20:31:08'),
(27, 'Membuat/menulis karya pengabdian pada masyarakat yang tidak dipublikasikan,tiap karya', NULL, 1, 3, '2023-08-14 20:31:28', '2023-08-14 20:31:28'),
(28, 'Hasil kegiatan pengabdian kepada masyarakat yang dipublikasikan di sebuah berkala/jurnal pengabdian kepada masyarakat atau teknologi tepat guna', NULL, 1, 3, '2023-08-14 20:31:58', '2023-08-14 20:31:58'),
(29, 'Berperan serta aktif dalam pengelolaan jurnal ilmiah', NULL, 1, 3, '2023-08-14 20:32:19', '2023-08-14 20:32:19'),
(30, 'Menjadi anggota dalam suatu Panitia/Badan pada Perguruan Tinggi', NULL, 1, 4, '2023-08-14 20:33:21', '2023-08-14 20:33:21'),
(31, 'Menjadi anggota panitia/badan pada lembaga pemerintah', NULL, 1, 4, '2023-08-14 20:33:40', '2023-08-14 20:33:40'),
(32, 'Menjadi anggota organisasi profesi', NULL, 1, 4, '2023-08-14 20:34:00', '2023-08-14 20:34:00'),
(33, 'Mewakili Perguruan Tinggi/Lembaga Pemerintah duduk dalam Panitia Antar Lembaga, tiap kepanitiaan', NULL, 1, 4, '2023-08-14 20:34:22', '2023-08-14 20:34:22'),
(34, 'Menjadi anggota delegasi Nasional ke pertemuan Internasional', NULL, 1, 4, '2023-08-14 20:34:42', '2023-08-14 20:34:42'),
(35, 'Berperan serta aktif dalam pertemuan ilmiah', NULL, 1, 4, '2023-08-14 20:35:05', '2023-08-14 20:35:05'),
(36, 'Mendapat tanda jasa/penghargaan', NULL, 1, 4, '2023-08-14 20:35:28', '2023-08-14 20:35:28'),
(37, 'Menulis buku pelajaran SLTA ke bawah yang diterbitkan dan diedarkan secara nasional', NULL, 1, 4, '2023-08-14 20:35:50', '2023-08-14 20:35:50'),
(38, 'Mempunyai prestasi di bidang olahraga/ Humaniora', NULL, 1, 4, '2023-08-14 20:36:13', '2023-08-14 20:36:13'),
(39, 'Keanggotaan dalam tim penilai jabatan akademik dosen', NULL, 1, 1, '2023-08-14 20:36:40', '2023-08-14 20:36:40'),
(40, 'N/A', '---', 3, 10, '2023-10-12 20:30:08', '2023-10-12 20:30:08');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahun_ajaran` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id`, `tahun_ajaran`, `created_at`, `updated_at`) VALUES
(1, '2022 - 2023', '2023-06-25 21:37:37', '2023-06-25 21:37:37'),
(2, '2023 - 2024', '2023-07-17 20:37:57', '2023-07-17 20:37:57'),
(4, '2024 - 2025', '2023-09-20 23:41:51', '2023-09-20 23:41:51');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_invitations`
--

CREATE TABLE `team_invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_user`
--

CREATE TABLE `team_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `program_studi` enum('Teknik Pertambangan','Perencanaan Wilayah dan Kota','Teknik Industri','Program Profesi Insinyur','Magister Perencanaan Wilayah dan Kota') DEFAULT NULL,
  `tipe_dosen` enum('internal','eksternal') DEFAULT NULL,
  `status_koordinator_skripsi` tinyint(4) NOT NULL DEFAULT 0,
  `status_dekanat` tinyint(4) NOT NULL DEFAULT 0,
  `status_kaprodi` tinyint(4) NOT NULL DEFAULT 0,
  `status_sekprodi` tinyint(4) NOT NULL DEFAULT 0,
  `status_superadmin` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nik`, `nama`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `level`, `telepon`, `foto`, `jabatan`, `program_studi`, `tipe_dosen`, `status_koordinator_skripsi`, `status_dekanat`, `status_kaprodi`, `status_sekprodi`, `status_superadmin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'A190436', 'Wahyu Hidayat', 'wahjoe16@gmail.com', NULL, '$2a$12$//4i16Wnq0Zw/YjinPM3teqgpH9QHTcqFrvUmMEuCQg4JAIExdhym', NULL, NULL, NULL, 1, '082240312828', 'user-2023-09-27094046.jpg', NULL, NULL, NULL, 0, 0, 0, 0, 1, NULL, NULL, '2023-09-27 02:40:47'),
(2, '10070120200', 'Indah', 'indah@gmail.com', NULL, '$2y$10$cWCke92ruiIk2ySUwOYTUujWUd0rCtBviBTFUT0B/dflkE3JIzcjK', NULL, NULL, NULL, 3, '082240312811', 'user-2024-01-03034401.jpeg', NULL, 'Teknik Pertambangan', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:48', '2024-01-02 20:44:01'),
(3, '10070220200', 'Dewi', 'dewi@gmail.com', NULL, '$2y$10$uChhXkZz9yfYiCu37sZRrepPfQSoKlTZeudTLpUKXHk0Uh52zekuO', NULL, NULL, NULL, 3, '082240312812', 'user-2023-10-09060139.jpg', NULL, 'Teknik Industri', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:48', '2023-10-08 23:01:39'),
(4, '10070320300', 'Dudi', 'dudi@gmail.com', NULL, '$2y$10$GsDRUh8dKDOMxePqxOs8qOOdjoL8nf.6im662RbW.iss7mUHU/7hm', NULL, NULL, NULL, 3, '082240312814', NULL, NULL, 'Perencanaan Wilayah dan Kota', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:48', '2023-07-17 19:40:32'),
(5, '10070321301', 'Febri', 'febri@gmail.com', NULL, '$2y$10$dmGBV9t5bgHRj9eDhI0Ji.mEPEvzZKHWs/r63b4lo8VO.gHB92LmS', NULL, NULL, NULL, 3, '082240312815', 'user-2023-10-09070653.jpeg', NULL, 'Perencanaan Wilayah dan Kota', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:48', '2023-10-09 00:06:53'),
(6, '10070122301', 'Devi', 'devi@gmail.com', NULL, '$2y$10$.JsDbF2FT/LKgcwEJUfC6OUj1Jz4foxEcbSs0XhJTMEqn3/wlGq0u', NULL, NULL, NULL, 3, '082240312816', 'user-2023-10-09044314.jpeg', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:48', '2023-10-08 21:43:14'),
(7, '10070120001', 'Intan', 'intan@gmail.com', NULL, '$2y$10$kS7YiVVT.lerAWqTqwApcOuUJuUE9REjLAm4Pav.jXnP1bKWZlv/S', NULL, NULL, NULL, 3, '082240312817', 'user-2023-07-27071338.jpg', NULL, 'Teknik Pertambangan', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:48', '2023-07-27 00:13:38'),
(8, '10070120002', 'Adi', 'adi@gmail.com', NULL, '$2y$10$ETGMkD.s111Xm3Shuz95xe/RoEQKvipJFhiZdCu.nDO7h6fN6hShe', NULL, NULL, NULL, 3, '082240312818', 'user-2023-10-12020125.jpg', NULL, 'Teknik Pertambangan', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:48', '2023-10-11 19:01:25'),
(9, '10070120003', 'Fandi', 'fandi@gmail.com', NULL, '$2y$10$y9xVRI06.Fm0tZIXhHT/vOQur1veVLRAhiHVUVmP/kzfaVGA3SmWe', NULL, NULL, NULL, 3, '082240312819', NULL, NULL, 'Teknik Pertambangan', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:49', '2023-07-17 19:42:46'),
(10, '10070120004', 'Lia', 'lia@gmail.com', NULL, '$2y$10$vq/NV6Osgb5pkH4UjpGPQOmwXCY8FMl5eBrrbgilMzYJ8/9lQnN/G', NULL, NULL, NULL, 3, '082240312810', NULL, NULL, 'Teknik Pertambangan', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:49', '2023-07-17 19:43:15'),
(11, '10070120005', 'Pedro', 'pedro@gmail.com', NULL, '$2y$10$vvxnJgTS314ee8lUJ1lirurcO3CAQbDrZPr17x0VT1tlS2O1G8Siu', NULL, NULL, NULL, 3, '082240312801', NULL, NULL, 'Teknik Pertambangan', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:49', '2023-07-17 19:43:41'),
(12, '10070120006', 'Alex', 'alex@gmail.com', NULL, '$2y$10$gzT/M.GX5jReklO4pKFiXui65q9Fvldk7iI170UreqTzzjUde1Lu2', NULL, NULL, NULL, 3, '082240312802', NULL, NULL, 'Teknik Pertambangan', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:49', '2023-07-17 19:44:10'),
(13, '10070120007', 'David', 'david@gmail.com', NULL, '$2y$10$vXmH0DWt7JUc/sYYd6YH0u2uPkY6.WZ0QaDXnTQXEXKvR3KJ9I.Dq', NULL, NULL, NULL, 3, '082240312803', NULL, NULL, 'Teknik Pertambangan', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:49', '2023-07-17 19:44:38'),
(14, '10070120008', 'Vika', 'vika@gmail.com', NULL, '$2y$10$JTWCwiJgueE7u2NLriXtdOxotzj2PEEqL33nsRU2JeVKPdh9OEseC', NULL, NULL, NULL, 3, '082240312804', NULL, NULL, 'Teknik Pertambangan', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:49', '2023-07-17 19:45:06'),
(15, '10070120009', 'Vira', 'vira@gmail.com', NULL, '$2y$10$GWDGPupuV52D8ZFKfJhXFeNPmuNjg20JPbaWWK6LwW4FTwxOO.ckK', NULL, NULL, NULL, 3, '082240312805', NULL, NULL, 'Teknik Pertambangan', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:49', '2023-07-17 19:45:29'),
(16, '10070120010', 'Weni', 'weni@gmail.com', NULL, '$2y$10$m8o2yGI0A2PuAz9ihqKrrOKZP6nxn2n6QHCA6My2GC2AMocnJsbPC', NULL, NULL, NULL, 3, '082240312806', NULL, NULL, 'Teknik Pertambangan', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:49', '2023-07-17 19:45:51'),
(17, '10070120011', 'Widia', 'widia@gmail.com', NULL, '$2y$10$keHAXviROBUgpWdC5NTfm.xxRfYrzLoZhE9Qkf/gYDGq0oPV582Ai', NULL, NULL, NULL, 3, '082240312807', NULL, NULL, 'Teknik Pertambangan', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:49', '2023-07-17 19:46:16'),
(18, '10070120012', 'Amel', 'amel@gmail.com', NULL, '$2y$10$zZgGGwn/HF04Ysw4JdCZfunkkyt.ayG/hrCDNXVE/GPKYBPULlpHK', NULL, NULL, NULL, 3, '082240312808', NULL, NULL, 'Teknik Pertambangan', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:50', '2023-07-17 19:46:41'),
(19, '10070220001', 'Wina', 'wina@gmail.com', NULL, '$2y$10$ei3Ubk7P7yHaTQgq8H9g7u83UvLrzGLaf2b5kEddZw09E0sNHuHFm', NULL, NULL, NULL, 3, '082240312809', NULL, NULL, 'Teknik Industri', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:50', '2023-07-17 19:47:10'),
(20, '10070220002', 'Fitri', 'fitri@gmail.com', NULL, '$2y$10$ZUXUU/.f0DJWBE21KlU1ZuUzGxeCpINZXpwNwXqdLA8ugUIl5t5fa', NULL, NULL, NULL, 3, '082240312820', NULL, NULL, 'Teknik Industri', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:50', '2023-07-17 19:47:41'),
(21, '10070220003', 'Rini', 'rini@gmail.com', NULL, '$2y$10$gKAwss6Yf.n6cbDHaCuYpeZg3/.7TlX4AWivs.yXRFzmcGNHrcKdS', NULL, NULL, NULL, 3, '082240312821', 'user-2023-10-12024849.jpg', NULL, 'Teknik Industri', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:50', '2023-10-11 19:48:49'),
(22, '10070220004', 'Rina', 'rina@gmail.com', NULL, '$2y$10$P75kRBM44k1oAyAz.UllJOBkIwzWftMPplhXnSn/Snizw/lU80vgu', NULL, NULL, NULL, 3, '082240312822', NULL, NULL, 'Teknik Industri', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:50', '2023-07-17 19:49:12'),
(23, '10070220005', 'Tomo', 'tomo@gmail.com', NULL, '$2y$10$ecE0.DHXE3726vw9A4pFs.J4AenYIZf0M54MxbQ6Si6VcDBeoMHaa', NULL, NULL, NULL, 3, '082240312823', NULL, NULL, 'Teknik Industri', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:50', '2023-07-17 19:49:32'),
(24, '10070220006', 'Tomi', 'tomi@gmail.com', NULL, '$2y$10$Ymsy//fTL360l5ViSjmLf.aaW86gCwn2VMW3AtX5nnl5OYzzA7oHG', NULL, NULL, NULL, 3, '082240312824', NULL, NULL, 'Teknik Industri', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:50', '2023-07-17 19:50:13'),
(25, '10070220007', 'Totti', 'totti@gmail.com', NULL, '$2y$10$Au1LZtSxFgG4F2vwowCNruniQ4nt9gk8Qf0Qa/YpM/GajDFa1ceae', NULL, NULL, NULL, 3, '082240312824', NULL, NULL, 'Teknik Industri', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:50', '2023-07-17 19:50:43'),
(26, '10070220008', 'Hakim', 'hakim@gmail.com', NULL, '$2y$10$1CdIAnlfk50zNBZ7afz1Guvpm6rHdVHGFzCJB5QnDZJS38l9pm8m.', NULL, NULL, NULL, 3, '082240312825', NULL, NULL, 'Teknik Industri', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:50', '2023-07-17 19:51:08'),
(27, '10070220009', 'Mila', 'mila@gmail.com', NULL, '$2y$10$GFtDWH9DPyy5Od7BNuYffuhu5EvNU3mZU58hVqPsYmfCBe2Pa9tO2', NULL, NULL, NULL, 3, '082240312826', NULL, NULL, 'Teknik Industri', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:51', '2023-07-17 19:51:32'),
(28, '10070220010', 'Mia', 'mia@gmail.com', NULL, '$2y$10$sCErP2TPzPOz92497CdCTukzmUhjt5H5orpxrGLzI/HWZBAmW7dD6', NULL, NULL, NULL, 3, '082240312827', NULL, NULL, 'Teknik Industri', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:51', '2023-07-17 19:52:02'),
(29, '10070220011', 'Peni', 'peni@gmail.com', NULL, '$2y$10$efUqXc5iVnOWuKBb15FrmOE4OrM1j4OwVia5oCofogjMqbUZP7t/S', NULL, NULL, NULL, 3, '082240312829', NULL, NULL, 'Teknik Industri', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:51', '2023-07-17 19:52:25'),
(30, '10070220012', 'Risna', 'risna@gmail.com', NULL, '$2y$10$K2g9hzFZiiNGxSoTUhYOg.w1DQgnilqgbHpPE7CA19Ix8bG2T4WQ.', NULL, NULL, NULL, 3, '082240312831', NULL, NULL, 'Teknik Industri', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:51', '2023-07-17 19:52:53'),
(31, '10070220013', 'Risma', 'risma@gmail.com', NULL, '$2y$10$o/BxlpM/PYYaWTA.HssihOxuuVGIl2lbLOfjOszFZiwsnYERvuTuG', NULL, NULL, NULL, 3, '082240312832', NULL, NULL, 'Teknik Industri', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:51', '2023-07-17 19:53:17'),
(32, '10070220014', 'Hana', 'hana@gmail.com', NULL, '$2y$10$fWaIHeBTqTQglv5DW/ZATO8nMwMhP080JiB8CATwHZO/OH3Vrpu7C', NULL, NULL, NULL, 3, '082240312833', NULL, NULL, 'Teknik Industri', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:51', '2023-07-17 19:53:47'),
(33, '10070320001', 'Nina', 'nina@gmail.com', NULL, '$2y$10$dm/Wf83LYkwoe3ToGDyxZOJsC2WxEUN2vvwXM0alAhkHjRRzeblvm', NULL, NULL, NULL, 3, '082240312834', NULL, NULL, 'Perencanaan Wilayah dan Kota', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:51', '2023-07-17 19:54:40'),
(34, '10070320002', 'Deki', 'deki@gmail.com', NULL, '$2y$10$i8HPSR2XDqSKVSOHAELMse/ZgAuYJqzUWF0BvV0LvWeggY8.s7POm', NULL, NULL, NULL, 3, '082240312835', NULL, NULL, 'Perencanaan Wilayah dan Kota', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:51', '2023-07-17 19:55:12'),
(35, '10070320003', 'Deva', 'deva@gmail.com', NULL, '$2y$10$6m4XBIzc/U2jtxa4Eyf4oeXYXB/sQJt.xSCCveIUU.vygc/chgaNa', NULL, NULL, NULL, 3, '082240312836', 'user-2023-10-12031416.jpg', NULL, 'Perencanaan Wilayah dan Kota', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:51', '2023-10-11 20:14:16'),
(36, '10070320004', 'Putri', 'putri@gmail.com', NULL, '$2y$10$rw/SJxD4CYirzZnEbk2TtuR73QBPKWEms3ttI2EH5CDTrJbNx8SkO', NULL, NULL, NULL, 3, '082240312836', NULL, NULL, 'Perencanaan Wilayah dan Kota', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:52', '2023-07-17 19:56:05'),
(37, '10070320005', 'Mamik', 'mamik@gmail.com', NULL, '$2y$10$dQB53sjvbQv02/JbV3yL/e/o/0n7qkbAfmyomR1DTySuoeBtJvPbi', NULL, NULL, NULL, 3, '082240312837', NULL, NULL, 'Perencanaan Wilayah dan Kota', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:52', '2023-07-17 19:56:41'),
(38, '10070320006', 'Mika', 'mika@gmail.com', NULL, '$2y$10$Y051OKi55iEiZT0nsXHGyOnLbuu697N3c2376CRcVRWWFZUJpnMEi', NULL, NULL, NULL, 3, '082240312839', NULL, NULL, 'Perencanaan Wilayah dan Kota', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:52', '2023-07-17 19:57:07'),
(39, '10070320007', 'Michu', 'michu@gmail.com', NULL, '$2y$10$NIGfz3kgbrz/vYntrO1.u.3ZWgSheK3rvi2TVz2tUrTz2LZImSmL2', NULL, NULL, NULL, 3, '082240312830', NULL, NULL, 'Perencanaan Wilayah dan Kota', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:52', '2023-07-17 19:57:35'),
(40, '10070320008', 'Xabi', 'xabi@gmail.com', NULL, '$2y$10$5By3BorZfs9a6MKBK37DKeErTcY3TPCFF0.s..Mf5g8DwzQyKdzWm', NULL, NULL, NULL, 3, '082240312841', NULL, NULL, 'Perencanaan Wilayah dan Kota', NULL, 0, 0, 0, 0, 0, NULL, '2023-07-17 19:38:52', '2023-07-17 19:58:00'),
(41, 'D900117', 'Solihin, Ir., M.T', NULL, NULL, '$2y$10$L1LsoCQCjC1owkwiRLkq4Outi5v9IIr92/LTohmZqF20kqIthdQha', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Pertambangan', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:06:01', '2023-07-17 20:06:01'),
(42, 'D920158', 'Dr. Ir. Yunus Ashari, M.T.', NULL, NULL, '$2y$10$z8LRknD8ZxqKOYUZqKfOtO50MlxcL2T36TZ3gwusaOtL6GngB95Ka', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Pertambangan', 'internal', 0, 0, 1, 0, 0, NULL, '2023-07-17 20:06:01', '2023-07-25 20:43:34'),
(43, 'D930184', 'Ir. Linda Pulungan, M.T.', NULL, NULL, '$2y$10$7ZkZj5zOAvFe.GxDoKmya.aGTKlJAxA341Fe3660kuR6j3Jck2tUm', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Pertambangan', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:06:01', '2023-07-17 20:06:01'),
(44, 'D950217', 'Ir. Zaenal, M.T.', NULL, NULL, '$2y$10$3vFrOlRxiSUxXBXgDE0AiO1AULb6Nxf/k.51svQ7r81hP3FStCn76', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Pertambangan', 'internal', 1, 0, 0, 0, 0, NULL, '2023-07-17 20:06:01', '2023-07-17 21:56:25'),
(45, 'D950219', 'Elfida Moralista, S.Si., M.T.', NULL, NULL, '$2y$10$Qzaqf2GNT7v9nU4al3IXcOSWIkfxEfCrV/KdoGqxzDF/aL5JHKGfC', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Pertambangan', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:06:02', '2023-07-17 20:06:02'),
(46, 'D970270', 'Dr. Ir. Sri Widayati, S.T., M.T., IPM.', NULL, NULL, '$2y$10$8xXpjmhxWjMQU./Nv11yYu.vKtINiOcEbpWIli313SgGCY2DZNIQy', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Pertambangan', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:06:02', '2023-09-18 19:15:44'),
(47, 'D990304', 'Ir. Dono Guntoro, S.T., M.T.', NULL, NULL, '$2y$10$fZk1D7oWRa1N.kyOYLVxQuEJUXLLGSQTx/y8d31y/U3X3Z2egSWre', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Pertambangan', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:06:02', '2023-07-17 20:06:02'),
(51, 'D140619', 'Indra Karna Wijaksana, S.Pd., S.T., M.T.', NULL, NULL, '$2y$10$TEV2dtRwlK9j1rM93Xh4J.cZUtKjJo63S41/pw3hfpsBTELxNwEh2', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Pertambangan', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:06:02', '2023-07-17 20:06:02'),
(52, 'D201013', 'ALI MAHMUDI, IR., M.SC.', NULL, NULL, '$2y$10$9II0UD6rgflGz2QlRqClg.A.hU8n0/v9EDi5fmcIIoEQtS6CF8EHu', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Pertambangan', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:06:02', '2023-07-17 20:06:02'),
(53, 'D180765', 'ANDRIEANTO NURROCHMAN, S.T., M.SC.ENG.', NULL, NULL, '$2y$10$kTkz/XN/7Gr67Au54ahrF.WhWM7z96C7qF8dyOS8.L8ZScfsDB8Ji', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Pertambangan', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:06:02', '2023-07-17 20:06:02'),
(54, 'D180764', 'DR. ENG. MOHAMMAD RAHMAN ARDHIANSYAH, S.T., M.T.', NULL, NULL, '$2y$10$c/r/SawMRjjA/wPXGyUbNOPi7rLO0KIbfH2PrfpU258c.4lKOiV4a', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Pertambangan', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:06:03', '2023-07-17 20:06:03'),
(55, 'D193780', 'DR. HIMAWAN NURYAHYA, S.KOM., M.M.', NULL, NULL, '$2y$10$niBIe8eHP/RCyuEDR8VZvu0/0RqvudHKQdlF8lwtH6w3xQiS4PcAi', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Pertambangan', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:06:03', '2023-07-17 20:06:03'),
(56, 'D170719', 'ISWANDARU, S.T., M.T.', NULL, NULL, '$2y$10$l/Ug/L8fcP6QZghdCSKFMugsK69Os2cJ1lBYQAvd/PN264WG9./ia', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Pertambangan', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:06:03', '2023-07-17 20:06:03'),
(57, 'D230019', 'JERRY DWIFAJAR PRABOWO, S.T., M.T.', NULL, NULL, '$2y$10$b5UBVjTt9eZG3102HIL4VOuu43ILLJgF/mhFggFjM8frO/r36aKHe', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Pertambangan', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:06:03', '2023-07-17 20:06:03'),
(58, 'D160692', 'NOOR FAUZI ISNIARNO., S.SI., M.T.', NULL, NULL, '$2y$10$upzlAFAnGgeNJYR1Owbmv.oy7VuzeYJsQ3oqPCQZ3OqdVRcma2jS6', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Pertambangan', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:06:03', '2023-07-17 20:06:03'),
(59, 'D230020', 'RIDHO QURNIAWAN, S.T., M.T.', NULL, NULL, '$2y$10$h4X5hR1HVlWx9OGgDdsxg.hmH2ESDrcVOg7MKg3Z.vmc1r6GGfIBe', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Pertambangan', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:06:03', '2023-07-17 20:06:03'),
(60, 'D170720', 'RULLY NURHASAN RAMADANI, S.T., M.T.', NULL, NULL, '$2y$10$HK7ea95k1WjMvgBPKodGreq.9dwvW83Oo8kqR08tphGpGnl/Hy8oa', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Pertambangan', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:06:03', '2023-07-17 20:06:03'),
(61, 'D930183', 'Dr. Agus Nana Supena, M.T., IPM', NULL, NULL, '$2y$10$OZkDtgHZ37ZIpvjCrh3P3O97RMvzUNT2dOZy3ufiRhPP8HSnPkvyS', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:36', '2023-09-18 19:18:33'),
(62, 'D150643', 'Ahmad Arif Nurrahman, ST., MT', NULL, NULL, '$2y$10$Y5CptFf/0KjrXsdEHZ0i0ul681Q97lmZVOwi0o1zqzZLJvCNCRzXy', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:36', '2023-07-17 20:16:36'),
(63, 'D213923', 'Dr. Yan Orgoanus, Ir., M.Sc', NULL, NULL, '$2y$10$4VALlPX78bNuyVMNFEh6iOosGKVhqm0LH0drSPQXwcUOsAwVYNRCW', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:36', '2023-07-17 20:16:36'),
(64, 'D900114', 'Eri Achiraeniwati, ST., MM., IPM', NULL, NULL, '$2y$10$mGXkNwq4Y5.dc4ZPqZJBf.UIjDomM7OeXOSNpUYGOb/m4anqAIi2O', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:37', '2023-07-17 20:16:37'),
(65, 'D900115', 'Puti Renosori, Ir., M.T.', NULL, NULL, '$2y$10$j5wPaoVXFhP.OaboLyAe4OImiWunPzuLyPcaBRBWoA3fVzzCNYK7a', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:37', '2023-07-17 20:16:37'),
(66, 'D920142', 'Dr. Endang Prasetyaningsih, Ir., M.T.', NULL, NULL, '$2y$10$IUFJ50b/qLFSx8hO6U9BbOYcEEQSzwrvmFobM9PpTKbVQpg1OOiti', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:37', '2023-07-17 20:16:37'),
(67, 'D920159', 'Selamat, Drs., M.T.', NULL, NULL, '$2y$10$tzhyoelPxXPhWyygyzhqB.ds7TsAt2CAS5VtRW.wTRLLm4y.XUDPK', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:37', '2023-07-17 20:16:37'),
(68, 'D930182', 'Hirawati Oemar, Dra., M.T.', NULL, NULL, '$2y$10$7V9g7rr1WLBnzyPf/a7QPeYmfmBzRaMcSFcVW606qNgkoN9u9nFrG', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:37', '2023-07-17 20:16:37'),
(69, 'D190794', 'AJRINA FEBRI SUAHATI, S.T., M.T., M.B.A.', NULL, NULL, '$2y$10$D50nr.EJyhd6RopnsupEeeGGfgzeACK2W7dq0g/cZ37JHr7Z.FQl2', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 1, 0, 0, 0, 0, NULL, '2023-07-17 20:16:37', '2023-10-08 23:09:06'),
(70, 'D180763', 'ANIS SEPTIANI, S.T., M.T.', NULL, NULL, '$2y$10$AXnOdmk2w2TQIecW3ezhpOwg4ndZ8jBeoQM2sua/rTCb1QZafFiJO', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:37', '2023-07-17 20:16:37'),
(71, 'D150652', 'ANNISA RACHMANI TYANINGSIH, S.S., M.HUM.', NULL, NULL, '$2y$10$74ppFBVtiI2miQ.nUKGTNeE8zVDpqA.Ltdc5ncMcGo7TqsxIT.i4W', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:37', '2023-07-17 20:16:37'),
(72, 'D970272', 'ASEP NANA RUKMANA, IR., M.T., IPM.', NULL, NULL, '$2y$10$psz.0XWHmGA6wbNn1DQMY.nnpHlvg1QB3VxG7ozPVSa7gikTyDvym', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:37', '2023-09-18 19:19:44'),
(73, 'D201028', 'DARMANSYAH DJAMUS, IR., M.T.', NULL, NULL, '$2y$10$xjTuqjqcz80to62B/7PW/u0cOV53Z/jWwSlhkA9SOyps16rBuxQCq', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:37', '2023-07-17 20:16:37'),
(74, 'D960239', 'DR. IR. M. DZIKRON A.M., S.T., M.T., IPM.', NULL, NULL, '$2y$10$kJ7RcMKiMh5tAYdEq0nOzepcMoQ2uy8LhFLs5O2THfhLgdNoraA0u', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 1, 0, 0, NULL, '2023-07-17 20:16:38', '2023-07-25 20:54:56'),
(76, 'D190795', 'DR. LUTHFI NURWANDI, S.T., M.T.', NULL, NULL, '$2y$10$uGpw/qBMyBLUjx6MXCGhAuOoycL0O185mDnesPoIcyvEX8qJ1jlUy', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:38', '2023-07-17 20:16:38'),
(77, 'D180762', 'DR. NITA PUSPITA ANUGRAWATI HIDAYAT, IR., M.T.', NULL, NULL, '$2y$10$E/qT00jBWYW1LGPgZbnLzOmA1DmeVVgzJbuRNy7DZJfEy/GbChm26', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:38', '2023-07-17 20:16:38'),
(78, 'D201031', 'GALIH RESTU F., S.SI., M.SI', NULL, NULL, '$2y$10$XnpXreYXqneShCVYrEAK.eEiXte082SzYpDUqh/6WIZ5NuCjPJH1a', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:38', '2023-07-17 20:16:38'),
(79, 'D960236', 'IR. CHAZNIN R. MUHAMMAD, S.T., M.T.', NULL, NULL, '$2y$10$qpBh6J.alGFjGTfu02cFoe47zVR6m/IkZ2Nrzn9Rj1THlhl29GkLG', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:38', '2023-07-17 20:16:38'),
(80, 'D970273', 'IR. DJAMALUDIN, S.T., M.A.B.', NULL, NULL, '$2y$10$gHKBWZIHHnFtSoRuctrHRukYSD50HuN.BY2X4TtOpYNt8i4DCR1kK', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:38', '2023-07-17 20:16:38'),
(83, 'D970271', 'IYAN BACHTIAR, S.T., M.T.', NULL, NULL, '$2y$10$UVQo7dIGb3cmeIyVe9Agyu9mhROEu38GBWQGW1034YZFqvkEYGUQy', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:39', '2023-07-17 20:16:39'),
(84, 'D201029', 'MARIAH KARTAWIJAYA, DRA., MS.', NULL, NULL, '$2y$10$orhb9MfDcffL7AcPOWxCWeZysM6eEbIabtototQL7IA7NQMURUwZ6', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:39', '2023-07-17 20:16:39'),
(85, 'D230021', 'MUHAMMAD SYARQIM MAHFUDZ, S.T., M.SC.', NULL, NULL, '$2y$10$cRco4.uQKu77UoT8QtGxeu3zz7SVb9/WsCOHz2/Kxd0UHtP6mYw5S', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:39', '2023-07-17 20:16:39'),
(86, 'D201032', 'MUSYAFAK, S.T., M.ENG', NULL, NULL, '$2y$10$4.PaSlnHGq9.vWVHn5ZvkeZB/YbfJVWHoLPlhhBUwhv98McD7.isi', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:39', '2023-07-17 20:16:39'),
(87, 'D990319', 'NUR RAHMAN AS\'AD, S.T., M.T., IPM.', NULL, NULL, '$2y$10$Yy6XW6wLdofCMj7N7InKceXBUdlyxNgwl8qnco85bKXREijPdM4GC', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:39', '2023-09-18 19:20:35'),
(89, 'D990305', 'PROF. IR. A. HARITS NU\'MAN, M.T., PH.D., IPM', NULL, NULL, '$2y$10$dL94naNT5hBEAQ/rWZjobu0cPv4ccXv6Hc34iyoSF9J21B2Aly1pq', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:39', '2023-07-17 20:16:39'),
(90, 'D201030', 'RODIAN SITUMORANG, BS.MET., MST.', NULL, NULL, '$2y$10$E9nZvAXZOE7XCZUrTkV8ruEWdfHp7kK7WuGO0K8oEQ5BzTNp7k8EC', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:39', '2023-07-17 20:16:39'),
(91, 'D230022', 'ZAHWA FITRIA GUMILANG, S.T., M.T.', NULL, NULL, '$2y$10$R1Loz56DV1SYyzwOiSETE.yPRKL296WzXMo/YhctKlFpcf.t0bZgq', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Teknik Industri', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:16:40', '2023-07-17 20:16:40'),
(121, 'D852037', 'Prof. Dr. Hilwati Hindersah, Ir., M.URP.', NULL, NULL, '$2y$10$7LomLKFbMu9k3hCslppwsuubLCa3EFOKc1A1.Q4e0ESvRp766Pz1.', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Magister Perencanaan Wilayah dan Kota', 'internal', 0, 0, 1, 0, 0, NULL, '2023-07-17 20:28:54', '2023-09-21 21:33:16'),
(122, 'D872047', 'Dr. Ir. Tonny Judiantono, M.Sc.', NULL, NULL, '$2y$10$l.7WNk9tAX0g3FMOTBAoZuFs2ftv8weko1p9ODd4DR4FmLy9AVEwu', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:54', '2023-07-17 20:28:54'),
(123, 'D880070', 'Dr. Ir. Saraswati, M.T.', NULL, NULL, '$2y$10$hQ4yQr8AYsh3ecdO6DfgKulzIVvJYZZIXLhXvJSwBhYlbPIDQ5Zi.', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:54', '2023-07-17 20:28:54'),
(124, 'D910137', 'Dr. Ivan Chofyan, Ir., M.T.', NULL, NULL, '$2y$10$IOpyTHyqjLxP0ke./Xo2Sut0oNPucv9MjA0k5HcaaFWVaZ5TMskTe', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:54', '2023-07-17 20:28:54'),
(125, 'D940202', 'Prof. Dr. Ir. Ina Helena Agustina, M.T.', NULL, NULL, '$2y$10$MdWCSwLHm9jdStk.nPb47OxQas5WR/QrLtMirP0c/X87JiENNM9Pu', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:54', '2023-07-17 20:28:54'),
(126, 'D950218', 'Dr. Ernady Syaodih, Ir., M.T.', NULL, NULL, '$2y$10$pn7sUnauvG0rMcMfobLssO9deRVWOuK0E6JRBHH7v1CgbRRZjz3Pu', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:54', '2023-07-17 20:28:54'),
(127, 'D960241', 'Dr. Imam Indratno, S.T., M.T.', NULL, NULL, '$2y$10$hr7GgfuaQqziXO/ttofYgOedHHGKWtWIZZkgxIF8Yg/hAPKCnBF0W', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:54', '2023-07-17 20:28:54'),
(128, 'D960244', 'Dr. Ir. Hani Burhanudin S.T., M.T.', NULL, NULL, '$2y$10$zb4uSul7R4J9zpLjmgpKC.9HJoSZV3Hk9I63XXsclmHaesRDLEmJC', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:54', '2023-07-17 20:28:54'),
(129, 'D970283', 'Dr. Yulia Asyiawati, S.T., M.Si.', NULL, NULL, '$2y$10$1.XivZJ8jHwW8JRPd1bx8OkduBrSAlnLwal7766i1K7ytyiSQKcmC', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:54', '2023-07-17 20:28:54'),
(135, 'D040394', 'Ir. Lely Syiddatul Akliyah, S.T., M.Si.', NULL, NULL, '$2y$10$MsGKyHILthkceGOaBjuKcuB65T1I3tTtcf4bkoCsEB3P4VUSTZZR.', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:55', '2023-07-17 20:28:55'),
(136, 'D140617', 'Irland Fardani, S.Si., M.T.', NULL, NULL, '$2y$10$q7Gy0aU4se7mGkRizfl/V.JIG.3QVgK/6olStlRWcI6wwdvUk/lCu', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:55', '2023-07-17 20:28:55'),
(137, 'D140618', 'Ir. Astri Mutia Ekasari, ST., M.T.', NULL, NULL, '$2y$10$gjLnz3K6Zds6N13v6H/IlOg8.7Jfs79XDB6ZGsMQ2X6lgeuSV21pG', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:55', '2023-07-17 20:28:55'),
(138, 'D143605', 'Bambang Pranggono, Ir, MBA.', NULL, NULL, '$2y$10$iJrFmUxIC7WDRZ3Ko2CZHuc2nJwnj09Gk9GTNyuTPH93.3682dgF.', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:55', '2023-07-17 20:28:55'),
(139, 'D160709', 'Verry Damayanti, S.T., MT.', NULL, NULL, '$2y$10$SQRuzBD9RTHJPBnoxGDaMOB4ZWwjA4cTE2Qgcvlm/MH2JAkVvM4Bi', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:55', '2023-07-17 20:28:55'),
(140, 'D180747', 'Gina Puspitasari Rochman, S.T., M.T.', NULL, NULL, '$2y$10$Po6iqzLIUZM6LEy..0rldOEaOaO7ppOdZL/AxTqRtJiv/AZU/ceuC', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:55', '2023-07-17 20:28:55'),
(141, 'D190796', 'Tarlani, S.T., M.T.', NULL, NULL, '$2y$10$UvC5PEZE40OWLm2DZXUltezc3WW9EbNylIsuQ1ZfCyAUlzSmmflR.', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:56', '2023-07-17 20:28:56'),
(142, 'D190797', 'Fachmy Sugih Pradifta, S.T., M.T.', NULL, NULL, '$2y$10$bQeNobKVzqX5trJ0LPETLe4J3GULfZhuV6j76vKz8CmeOfJb/wkzS', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:56', '2023-07-17 20:28:56'),
(143, 'D190798', 'Riswandha Risang Aji, S.T., M.URP.', NULL, NULL, '$2y$10$VZpxeF1TmeSbCMvLPl1FY.2GzGkv5k.drfMW7f0lNh6ihtD5LqNEO', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:56', '2023-07-17 20:28:56'),
(144, 'D203901', 'Dr. Ernawati Hendrakusumah, Dra., M.SP.', NULL, NULL, '$2y$10$w.Ao/hFxAF2vZHMSMKb7beQ9inkbA0KGMDf6UwAzXftH9VTJwQgeS', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:56', '2023-07-17 20:28:56'),
(145, 'D210911', 'Lutfhi Ahmad Barwanto, .S.T., M.PWK.', NULL, NULL, '$2y$10$EDHi9W3iRHhKD/dYzD91/.FflaaYm1qWp1Orv8U2PWAo7Rt50beRm', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:56', '2023-07-17 20:28:56'),
(146, 'D210912', 'Rama Arianto Widagdo, S.T., M.URP.', NULL, NULL, '$2y$10$BfWqmnq1AGDDTdjIGHkP4.GZEqISLIRqsXAowAb9ZkNjq6cgxiKwW', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:56', '2023-07-17 20:28:56'),
(147, 'D211104', 'Sri Hidayati Djoeffan, Ir., M.T.', NULL, NULL, '$2y$10$IzhkvDZKZVd0/xHYRWhFx.hts5bgwDplovWHjIgNMQ35/2s.hHFhC', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:56', '2023-07-17 20:28:56'),
(148, 'D230017', 'Rahma Dewi, S.T., M.I.L.', NULL, NULL, '$2y$10$OKICcY1HzzXuoS6MEFdpY.4qHNAwbvutCl9JDZStA/CzUhFiU7Fku', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:56', '2023-07-17 20:28:56'),
(149, 'D230018', 'Rose Fatmadewi, S.Si, M.URP', NULL, NULL, '$2y$10$2/ESGuk7hmDUjh/B/SwPrO4a7HgYbRrxDG7hydPdz4EGBXdPW8iYS', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', 'internal', 0, 0, 0, 0, 0, NULL, '2023-07-17 20:28:56', '2023-07-17 20:28:56'),
(150, 'A130288', 'Nimas', 'nimas@unisba.ac.id', NULL, '$2y$10$rDjAx6NmwxQibAms9ZcsF.TQWyA3GSw1xHvEoM3SvWZcwMybaZeLW', NULL, NULL, NULL, 1, '082240312818', 'user-2023-09-22054103.jpg', NULL, 'Teknik Pertambangan', NULL, 0, 0, 0, 0, 0, NULL, '2023-09-12 20:46:12', '2023-12-20 00:31:16'),
(151, 'A200452', 'Hasna', NULL, NULL, '$2y$10$vA..LwG6mmwX8p604LEkY.ClJ71C5SokrNJJZ93WaxMshqG/IM55.', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Teknik Industri', NULL, 0, 0, 0, 0, 0, NULL, '2023-09-12 20:53:25', '2023-09-12 20:54:09'),
(152, 'A130295', 'HUBBA NURRANIA', NULL, NULL, '$2y$10$IUlRQk4f8RraemliVLL/3usI9Dry/DQadgZnqYBoYelUl.6mO0/pW', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', NULL, 0, 0, 0, 0, 0, NULL, '2023-09-12 20:55:41', '2023-09-12 20:55:41'),
(153, 'D000334', 'Dr. Ir. Ira Safitri, S.T., M.T., IPU', NULL, NULL, '$2y$10$GdZliMAsWMOOGjcV7.x/NOZecclcaFqDFU8MbUKgprEpUruKLqY6m', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Perencanaan Wilayah dan Kota', NULL, 1, 1, 0, 0, 0, NULL, '2023-10-09 18:53:10', '2023-10-09 18:53:29'),
(154, 'A160376', 'Vina', NULL, NULL, '$2y$10$bwLHG8McVMaGQ8rPXAeoJeypR1KVW5zj0S3u1RBuxivtDHZwQ66K.', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, '2023-12-20 23:47:16', '2023-12-20 23:47:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `archives_section_id_foreign` (`section_id`),
  ADD KEY `archives_category_archive_id_foreign` (`category_archive_id`),
  ADD KEY `archives_subcategory_archive_id_foreign` (`subcategory_archive_id`),
  ADD KEY `archives_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  ADD KEY `archives_semester_id_foreign` (`semester_id`);

--
-- Indexes for table `category_archives`
--
ALTER TABLE `category_archives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_archives_section_id_foreign` (`section_id`);

--
-- Indexes for table `daftar_seminar`
--
ALTER TABLE `daftar_seminar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `daftar_seminar_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `daftar_seminar_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  ADD KEY `daftar_seminar_semester_id_foreign` (`semester_id`),
  ADD KEY `daftar_seminar_dosen1_id_foreign` (`dosen1_id`),
  ADD KEY `daftar_seminar_dosen2_id_foreign` (`dosen2_id`);

--
-- Indexes for table `daftar_sidang`
--
ALTER TABLE `daftar_sidang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `daftar_sidang_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `daftar_sidang_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  ADD KEY `daftar_sidang_semester_id_foreign` (`semester_id`),
  ADD KEY `daftar_sidang_dosen1_id_foreign` (`dosen1_id`),
  ADD KEY `daftar_sidang_dosen2_id_foreign` (`dosen2_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_archives`
--
ALTER TABLE `my_archives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `my_archives_user_id_foreign` (`user_id`),
  ADD KEY `my_archives_archive_id_foreign` (`archive_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subcategory_archives`
--
ALTER TABLE `subcategory_archives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategory_archives_section_id_foreign` (`section_id`),
  ADD KEY `subcategory_archives_category_archive_id_foreign` (`category_archive_id`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_id_index` (`user_id`);

--
-- Indexes for table `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_invitations_team_id_email_unique` (`team_id`,`email`);

--
-- Indexes for table `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`);

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
-- AUTO_INCREMENT for table `archives`
--
ALTER TABLE `archives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category_archives`
--
ALTER TABLE `category_archives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `daftar_seminar`
--
ALTER TABLE `daftar_seminar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `daftar_sidang`
--
ALTER TABLE `daftar_sidang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `my_archives`
--
ALTER TABLE `my_archives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subcategory_archives`
--
ALTER TABLE `subcategory_archives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_invitations`
--
ALTER TABLE `team_invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `archives`
--
ALTER TABLE `archives`
  ADD CONSTRAINT `archives_category_archive_id_foreign` FOREIGN KEY (`category_archive_id`) REFERENCES `category_archives` (`id`),
  ADD CONSTRAINT `archives_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `archives_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`),
  ADD CONSTRAINT `archives_subcategory_archive_id_foreign` FOREIGN KEY (`subcategory_archive_id`) REFERENCES `subcategory_archives` (`id`),
  ADD CONSTRAINT `archives_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`);

--
-- Constraints for table `category_archives`
--
ALTER TABLE `category_archives`
  ADD CONSTRAINT `category_archives_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);

--
-- Constraints for table `daftar_seminar`
--
ALTER TABLE `daftar_seminar`
  ADD CONSTRAINT `daftar_seminar_dosen1_id_foreign` FOREIGN KEY (`dosen1_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `daftar_seminar_dosen2_id_foreign` FOREIGN KEY (`dosen2_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `daftar_seminar_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `daftar_seminar_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `daftar_seminar_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `daftar_sidang`
--
ALTER TABLE `daftar_sidang`
  ADD CONSTRAINT `daftar_sidang_dosen1_id_foreign` FOREIGN KEY (`dosen1_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `daftar_sidang_dosen2_id_foreign` FOREIGN KEY (`dosen2_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `daftar_sidang_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `daftar_sidang_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `daftar_sidang_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `my_archives`
--
ALTER TABLE `my_archives`
  ADD CONSTRAINT `my_archives_archive_id_foreign` FOREIGN KEY (`archive_id`) REFERENCES `archives` (`id`),
  ADD CONSTRAINT `my_archives_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subcategory_archives`
--
ALTER TABLE `subcategory_archives`
  ADD CONSTRAINT `subcategory_archives_category_archive_id_foreign` FOREIGN KEY (`category_archive_id`) REFERENCES `category_archives` (`id`),
  ADD CONSTRAINT `subcategory_archives_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);

--
-- Constraints for table `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD CONSTRAINT `team_invitations_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
