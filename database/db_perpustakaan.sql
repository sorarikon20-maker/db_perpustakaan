-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_perpustakaan
CREATE DATABASE IF NOT EXISTS `db_perpustakaan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_perpustakaan`;

-- Dumping structure for table db_perpustakaan.bukus
CREATE TABLE IF NOT EXISTS `bukus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_terbit` year NOT NULL,
  `kategori_id` bigint unsigned NOT NULL,
  `rak` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `rak_nomor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bukus_kategori_id_foreign` (`kategori_id`),
  CONSTRAINT `bukus_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.bukus: ~7 rows (approximately)
INSERT INTO `bukus` (`id`, `judul`, `penulis`, `penerbit`, `cover_image`, `tahun_terbit`, `kategori_id`, `rak`, `stok`, `rak_nomor`, `deskripsi`, `created_at`, `updated_at`) VALUES
	(1, 'Perjalanan ke Negeri Dongeng', 'J.K. Rowling', 'Gramedia', 'bukus/1nguGdoZyooCUWMszpFhXX6vUClQ8b0Roj4nEsIr.webp', '2015', 1, NULL, 3, 'A1', NULL, '2026-02-28 22:41:43', '2026-05-07 15:46:21'),
	(2, 'Laskar Pelangi', 'Andrea Hirata', 'Bentang', 'bukus/5Ynlo2Voi8e9KHbsPBDfT0QZWDo6EZp7nwe0K97C.webp', '2005', 1, NULL, 3, 'A1', NULL, '2026-02-28 22:41:43', '2026-05-07 15:42:22'),
	(3, 'Sejarah Indonesia Modern', 'Ricklefs', 'Serambi', 'bukus/XEQCtbjfqDWRNk5N8k2unREZs8eHHrnxfxyWc6QD.webp', '2009', 2, NULL, 11, 'A3', NULL, '2026-02-28 22:41:43', '2026-04-18 16:18:37'),
	(5, 'Ayat-Ayat Cinta', 'Habiburrahman El Shirazy', 'Baqi', 'bukus/tNbz1hgkM4RDhNINboO8hRM1gu244DzdUkIaZfa9.webp', '2004', 1, NULL, 5, 'A1', NULL, '2026-02-28 22:41:43', '2026-04-23 15:47:50'),
	(14, 'Kamus Besar Bahasa Indonesia', 'solihin', 'heri buwono', 'bukus/lyiOHddev2FkOjS87GWoMPyNZHuTminDCOjcZXYd.webp', '2026', 1, NULL, 4, 'B2', NULL, '2026-04-23 15:58:48', '2026-04-23 15:58:48'),
	(15, 'pk', 'kkkk', 'kkkk', NULL, '2026', 1, NULL, 1, 'B2', NULL, '2026-04-26 15:37:53', '2026-04-26 15:37:53'),
	(16, 'pukul', 'kkkk', 'kkkk', NULL, '2026', 4, NULL, 4, 'B1', NULL, '2026-04-26 15:38:59', '2026-04-26 15:38:59');

-- Dumping structure for table db_perpustakaan.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.cache: ~10 rows (approximately)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('laravel-cache-admin@admin.com|127.0.0.1', 'i:1;', 1776901350),
	('laravel-cache-admin@admin.com|127.0.0.1:timer', 'i:1776901350;', 1776901350),
	('laravel-cache-admin@example.com|127.0.0.1', 'i:1;', 1776561042),
	('laravel-cache-admin@example.com|127.0.0.1:timer', 'i:1776561042;', 1776561042),
	('laravel-cache-test@example.com|127.0.0.1', 'i:1;', 1776078753),
	('laravel-cache-test@example.com|127.0.0.1:timer', 'i:1776078753;', 1776078753),
	('laravel-cache-test@test.com|127.0.0.1', 'i:1;', 1776078740),
	('laravel-cache-test@test.com|127.0.0.1:timer', 'i:1776078740;', 1776078740),
	('laravel-cache-test2@gmail.com|127.0.0.1', 'i:1;', 1776561064),
	('laravel-cache-test2@gmail.com|127.0.0.1:timer', 'i:1776561064;', 1776561064);

-- Dumping structure for table db_perpustakaan.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.cache_locks: ~0 rows (approximately)

-- Dumping structure for table db_perpustakaan.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table db_perpustakaan.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.jobs: ~0 rows (approximately)

-- Dumping structure for table db_perpustakaan.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.job_batches: ~0 rows (approximately)

-- Dumping structure for table db_perpustakaan.kategoris
CREATE TABLE IF NOT EXISTS `kategoris` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.kategoris: ~5 rows (approximately)
INSERT INTO `kategoris` (`id`, `nama_kategori`, `keterangan`, `created_at`, `updated_at`) VALUES
	(1, 'Fiksi', NULL, '2026-02-28 22:41:43', '2026-04-16 00:31:56'),
	(2, 'Non-Fiksi', NULL, '2026-02-28 22:41:43', '2026-02-28 22:41:43'),
	(4, 'horor', NULL, '2026-04-15 16:48:40', '2026-04-16 00:32:02'),
	(5, 'action', NULL, '2026-04-16 16:06:51', '2026-04-16 16:06:51'),
	(6, 'Referensi', NULL, '2026-04-23 16:11:00', '2026-04-23 16:11:00');

-- Dumping structure for table db_perpustakaan.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.migrations: ~9 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_02_04_235456_create_siswas_table', 1),
	(5, '2026_02_04_235505_create_kategoris_table', 1),
	(6, '2026_02_04_235506_create_bukus_table', 1),
	(7, '2026_02_04_235507_create_peminjamans_table', 1),
	(8, '2026_04_13_014754_add_denda_to_peminjamans_table', 2),
	(9, '2026_04_13_022744_fix_all_tables_schema', 3),
	(10, '2026_02_10_000000_add_cover_image_to_bukus_table', 4),
	(11, '2026_04_17_000000_add_rak_to_bukus_table', 5),
	(12, '2026_04_18_000000_add_rak_nomor_to_bukus_table', 6),
	(13, '2026_04_19_000000_add_profile_photo_to_users_table', 7),
	(14, '2026_04_23_124932_create_settings_table', 8),
	(15, '2026_04_23_124942_add_deskripsi_to_bukus_table', 9);

-- Dumping structure for table db_perpustakaan.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table db_perpustakaan.peminjamans
CREATE TABLE IF NOT EXISTS `peminjamans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `buku_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `batas_kembali` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('dipinjam','dikembalikan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dipinjam',
  `denda` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `peminjamans_siswa_id_foreign` (`siswa_id`),
  KEY `peminjamans_buku_id_foreign` (`buku_id`),
  KEY `peminjamans_user_id_foreign` (`user_id`),
  CONSTRAINT `peminjamans_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `bukus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `peminjamans_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `peminjamans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.peminjamans: ~5 rows (approximately)
INSERT INTO `peminjamans` (`id`, `siswa_id`, `buku_id`, `user_id`, `tanggal_pinjam`, `batas_kembali`, `tanggal_kembali`, `status`, `denda`, `created_at`, `updated_at`) VALUES
	(2, 2, 2, 2, '2026-01-16', '2026-04-10', '2026-04-13', 'dikembalikan', 0, '2026-02-28 22:41:43', '2026-04-15 16:18:06'),
	(20, 8, 5, 10, '2026-04-16', '2026-04-18', '2026-04-16', 'dikembalikan', 0, '2026-04-15 17:03:27', '2026-04-15 17:03:58'),
	(27, 8, 5, 10, '2026-03-10', '2026-03-19', '2026-03-20', 'dikembalikan', 5000, '2026-04-15 23:43:31', '2026-04-15 23:43:59'),
	(43, 6, 5, 10, '2026-04-20', '2026-04-23', '2026-04-24', 'dikembalikan', 700000, '2026-04-23 15:47:28', '2026-04-23 15:47:50'),
	(46, 4, 1, 10, '2026-04-22', '2026-04-25', NULL, 'dikembalikan', 8400000, '2026-04-26 15:40:07', '2026-05-07 15:46:21');

-- Dumping structure for table db_perpustakaan.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.sessions: ~2 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('EusSM6Ohu3CzFK9XRKgy45df8HZgiwmswZmsmX5F', 10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY0duNm9VT2E3UFBqZ1MzYlVPSTZSeXl0UDd2bWJvZU45SHpGOVlzMCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW1pbmphbWFucy9sYXBvcmFuP21vbnRoPTQmeWVhcj0yMDI2IjtzOjU6InJvdXRlIjtzOjE5OiJwZW1pbmphbWFucy5sYXBvcmFuIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTA7fQ==', 1778197610),
	('pxLoZOtPUz0S23wyauMfe1vzasyDjd5Sr9epUN4P', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiakF5S0hSck8ySjdHY0duZktXY09FZFNyQnNmZTlJMnNxSVgxdVdzWiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1777468495);

-- Dumping structure for table db_perpustakaan.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.settings: ~0 rows (approximately)
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
	(1, 'denda_per_hari', '700000', '2026-04-23 05:14:28', '2026-04-23 15:46:57');

-- Dumping structure for table db_perpustakaan.siswas
CREATE TABLE IF NOT EXISTS `siswas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `siswas_nis_unique` (`nis`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.siswas: ~6 rows (approximately)
INSERT INTO `siswas` (`id`, `nama`, `nis`, `kelas`, `jurusan`, `created_at`, `updated_at`) VALUES
	(2, 'Siti Nurhaliza', '001002', 'XI', 'PPLG 2', '2026-02-28 22:41:43', '2026-04-22 15:23:52'),
	(3, 'Budi Santoso', '001003', 'XI', 'PPLG 1', '2026-02-28 22:41:43', '2026-04-22 15:23:58'),
	(4, 'Dewi Lestari', '001004', 'XI', 'PPLG 1', '2026-02-28 22:41:43', '2026-04-22 15:24:05'),
	(5, 'Eka Prasetyo', '001005', 'XI', 'PPLG', '2026-02-28 22:41:43', '2026-04-15 16:05:55'),
	(6, 'APA', '3211', 'X', 'BD 2', '2026-04-13 03:37:18', '2026-04-22 15:23:09'),
	(8, 'azzam sandrian', '9209', 'X', 'PPLG 1', '2026-04-15 15:34:08', '2026-04-22 15:21:49');

-- Dumping structure for table db_perpustakaan.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'petugas',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.users: ~14 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `profile_photo`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin Perpustakaan', 'admin@perpustakaan.com', NULL, NULL, '$2y$12$wY1j6AX3Fvw1GVzw7EmiR.m3CAnS2WP/RDdo1pqNIKSVU9PFtFzj.', 'admin', NULL, '2026-02-28 22:41:42', '2026-02-28 22:41:42'),
	(2, 'Petugas Perpustakaan', 'petugas@perpustakaan.com', NULL, NULL, '$2y$12$WVtSLiJq6POoIzG7DgEbM.0IfP4Kleq6R.66Hn8QNWfM4aGWAXtru', 'petugas', NULL, '2026-02-28 22:41:43', '2026-02-28 22:41:43'),
	(3, 'azzam', 'sorarikon20@gmail.com', NULL, NULL, '$2y$12$B0.jdsZItTQzrCAK5QhujOAbtL.jkRa4tANTSVu1mKiL/OgCN48Wi', 'petugas', 'AZm9dUthgVji42UAgMQth8sBSqu0q8xT4wOwBOSpdOHGCGLVPRJIPd3SPasp', '2026-04-09 01:58:20', '2026-04-09 01:58:20'),
	(4, 'Test User', 'test@example.com', NULL, NULL, '$2y$12$Mnn9b4rCN.RbQXBTve/xEuDPIXOrgh8eyiVLglLum9bS0qqUhT9oi', 'petugas', NULL, '2026-04-12 16:20:54', '2026-04-12 16:20:54'),
	(5, 'azzam', 'jdfhjauhfoh@gmail.com', NULL, NULL, '$2y$12$DkBk5xqH9lej09Dn9sPwqO.zT670MX3ArlbHpRN4wDzLSHjUdziAa', 'petugas', NULL, '2026-04-12 16:27:00', '2026-04-12 16:27:00'),
	(6, 'Test User', 'test2@example.com', NULL, NULL, '$2y$12$93.wxNg806/MXDKIPApH8uvwjmJiTNjpYGkWQwYi1oyQBCGLOkVVu', 'petugas', NULL, '2026-04-12 18:01:04', '2026-04-12 18:01:04'),
	(7, 'Admin', 'admin@admin.com', NULL, NULL, '$2y$12$OyTZQX0ShsyV6Axkteb/qO8gQsEFB1936d2sSi2Y3wnZnu7WTAnD.', 'petugas', NULL, '2026-04-13 03:11:57', '2026-04-13 03:11:57'),
	(8, 'azzam', 'azzam@gmail.com', NULL, NULL, '$2y$12$Gj.NBXcWt2.uB.QIbmSRNOM1qfak9DuNw.41z7Hbcd/BqIpXBcXea', 'petugas', NULL, '2026-04-15 16:03:51', '2026-04-15 16:03:51'),
	(9, 'petugas perpustakaan', 'petugas@gmail.com', NULL, NULL, '$2y$12$lQjw6wHIvPiEw4PP0oMNbOiittpvsoIS.zYzirT9WB8n16V0lfwMC', 'petugas', NULL, '2026-04-15 16:17:49', '2026-04-15 16:17:49'),
	(10, 'admin', 'admin@gmail.com', NULL, NULL, '$2y$12$aBzvo.yn4oxd4.X4pmKodOknmFGCuCq6HeZF/7ZIu3UQO6JzRkoFC', 'petugas', NULL, '2026-04-15 16:18:59', '2026-04-26 15:40:40'),
	(11, 'azzam', 'azzammm@gmail.com', NULL, NULL, '$2y$12$yfhv7OkmqVOlwTeVxGYa2.Ne/MPbBX5vBKoNaBWg3/cE6bO.0lKie', 'petugas', NULL, '2026-04-16 15:42:01', '2026-04-16 15:42:01'),
	(12, 'Admin', 'test2@gmail.com', NULL, NULL, '$2y$12$C0S5umpDFCw05HuAQa3g9eWettPxqoAaua9xJXNX66UZhFrgnzD76', 'petugas', NULL, '2026-04-17 17:02:18', '2026-04-17 17:02:18'),
	(13, 'Admin', 'admin@example.com', NULL, NULL, '$2y$12$pmAlda0fioE3q251jlLjlu15Hjfc71asPO5ec1.8GiJ.qHWgYRiFO', 'petugas', NULL, '2026-04-18 17:10:32', '2026-04-18 17:35:16'),
	(14, 'Verifier', 'verifier@test.com', NULL, NULL, '$2y$12$Qj0GwsjAtM2aEAXNL6yWSeH6fmkn8sPo/V63HjD3aBI1qfXjvKm0a', 'petugas', NULL, '2026-04-22 15:41:46', '2026-04-22 15:43:41');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
