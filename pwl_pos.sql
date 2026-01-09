-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 09, 2026 at 01:35 AM
-- Server version: 8.0.30
-- PHP Version: 8.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwl_pos`
--

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_10_28_041612_create_m_level_table', 1),
(6, '2025_10_28_043014_create_m_kategori_table', 1),
(7, '2025_10_28_043035_create_m_supplier_table', 1),
(8, '2025_10_28_043125_create_m_user_table', 1),
(9, '2025_10_28_051055_create_m_barang_table', 1),
(10, '2025_10_28_051355_create_m_penjualan_table', 1),
(11, '2025_10_28_052124_create_t_penjualan_table', 1),
(12, '2025_10_28_052538_create_t_stok_table', 1),
(13, '2025_10_28_052752_create_t_penjualan_detail_table', 1),
(14, '2026_01_07_023530_add_avatar_to_m_user_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_barang`
--

CREATE TABLE `m_barang` (
  `barang_id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `supplier_id` bigint UNSIGNED NOT NULL,
  `barang_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barang_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` int NOT NULL,
  `harga_jual` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_barang`
--

INSERT INTO `m_barang` (`barang_id`, `kategori_id`, `supplier_id`, `barang_kode`, `barang_nama`, `harga_beli`, `harga_jual`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'BRG001', 'Laptop Acer', 8000000, 9000000, NULL, NULL),
(2, 1, 1, 'BRG002', 'Mouse Logitech', 150000, 180000, NULL, NULL),
(3, 1, 1, 'BRG003', 'Headset Gaming', 300000, 350000, NULL, NULL),
(4, 1, 1, 'BRG004', 'SSD 512GB', 600000, 700000, NULL, NULL),
(5, 1, 1, 'BRG005', 'Keyboard Mechanical', 500000, 600000, NULL, NULL),
(6, 2, 2, 'BRG006', 'Indomie Goreng', 2500, 3000, NULL, NULL),
(7, 2, 2, 'BRG007', 'Biskuit Roma', 9000, 10000, NULL, NULL),
(8, 3, 2, 'BRG008', 'Coca Cola 330ml', 4000, 5000, NULL, NULL),
(9, 3, 2, 'BRG009', 'Aqua 600ml', 2500, 3000, NULL, NULL),
(10, 2, 2, 'BRG010', 'Chiki Balls', 1000, 1500, NULL, NULL),
(11, 4, 3, 'BRG011', 'Kaos Polos Hitam', 25000, 35000, NULL, NULL),
(12, 4, 3, 'BRG012', 'Celana Jeans', 80000, 100000, NULL, NULL),
(13, 4, 3, 'BRG013', 'Topi Baseball', 15000, 20000, NULL, NULL),
(14, 4, 3, 'BRG014', 'Sweater Hoodie', 60000, 80000, NULL, NULL),
(15, 4, 3, 'BRG015', 'Sarung Tangan Musim Dingin', 20000, 25000, NULL, NULL),
(31, 1, 1, 'BRG020', 'Laptop Acer', 8000000, 9000000, '2026-01-07 20:24:24', NULL),
(33, 1, 1, 'BRG018', 'Holder HP', 5000, 13000, '2026-01-08 03:34:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_kategori`
--

CREATE TABLE `m_kategori` (
  `kategori_id` bigint UNSIGNED NOT NULL,
  `kategori_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_kategori`
--

INSERT INTO `m_kategori` (`kategori_id`, `kategori_kode`, `kategori_nama`, `created_at`, `updated_at`) VALUES
(1, 'ELK', 'Elektronik', NULL, NULL),
(2, 'MKN', 'Makanan', NULL, NULL),
(3, 'MNM', 'Minuman', NULL, NULL),
(4, 'PKA', 'Pakaian', NULL, NULL),
(5, 'ATK', 'Alat Tulis Kantor', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_level`
--

CREATE TABLE `m_level` (
  `level_id` bigint UNSIGNED NOT NULL,
  `level_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_level`
--

INSERT INTO `m_level` (`level_id`, `level_kode`, `level_nama`, `created_at`, `updated_at`) VALUES
(1, 'ADM', 'Administrator', NULL, NULL),
(2, 'MNG', 'Manager', NULL, NULL),
(3, 'STF', 'Staff', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_penjualan`
--

CREATE TABLE `m_penjualan` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_supplier`
--

CREATE TABLE `m_supplier` (
  `supplier_id` bigint UNSIGNED NOT NULL,
  `supplier_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_supplier`
--

INSERT INTO `m_supplier` (`supplier_id`, `supplier_kode`, `supplier_nama`, `supplier_alamat`, `created_at`, `updated_at`) VALUES
(1, 'SP01', 'PT ABC Elektronik', 'Jl. Teknologi No. 1, Malang', NULL, NULL),
(2, 'SP02', 'CV XYZ Konsumsi', 'Jl. Industri No. 2, Surabaya', NULL, NULL),
(3, 'SP03', 'Toko Langgeng Pakaian', 'Jl. Fashion No. 3, Jakarta', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `user_id` bigint UNSIGNED NOT NULL,
  `level_id` bigint UNSIGNED NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`user_id`, `level_id`, `username`, `nama`, `password`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'Administrator', '$2y$12$cvkQt98tikYuonPVoUkenu27KZqMhUtHXcDdMLe.4STJ7EEcAME0G', NULL, NULL, NULL),
(2, 2, 'manager', 'Manager', '$2y$12$1k/w0hkwI/LR2r.6wBKAiOsiBMd4ud2tUYavPGFD0RivoCPQoJ.hq', NULL, NULL, NULL),
(3, 3, 'staff', 'Staff/Kasir', '$2y$12$eUIR3SPqARVdbXUnyIdgdeja.gNLxSipRD2kpWFbtrKJgTFXp4CQe', NULL, NULL, NULL),
(5, 2, 'aril', 'Akbar Atma', '$2y$12$fgRVEOjzDwOW4yRaZq0oKu0HWtqzCJx5P3lyUx.zXQ.S7.TK7TpTi', NULL, '2026-01-07 19:49:23', '2026-01-08 02:23:23'),
(7, 3, 'bintang', 'Tri Bintang', '$2y$12$KuoRG/uJBRqAc0c5B1eJRey3LI7IIsEe0xAGFHuqAIqcLXXoocPB6', '1767869192_download.jpg', '2026-01-08 02:17:27', '2026-01-08 03:46:32');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan`
--

CREATE TABLE `t_penjualan` (
  `penjualan_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `pembeli` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjualan_kode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjualan_tanggal` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_penjualan`
--

INSERT INTO `t_penjualan` (`penjualan_id`, `user_id`, `pembeli`, `penjualan_kode`, `penjualan_tanggal`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pelanggan 1', 'PJ-0001', '2026-01-07 05:08:31', NULL, NULL),
(2, 1, 'Pelanggan 2', 'PJ-0002', '2026-01-07 05:08:31', NULL, NULL),
(3, 1, 'Pelanggan 3', 'PJ-0003', '2026-01-07 05:08:31', NULL, NULL),
(4, 1, 'Pelanggan 4', 'PJ-0004', '2026-01-07 05:08:31', NULL, NULL),
(5, 1, 'Pelanggan 5', 'PJ-0005', '2026-01-07 05:08:31', NULL, NULL),
(6, 1, 'Pelanggan 6', 'PJ-0006', '2026-01-07 05:08:31', NULL, NULL),
(7, 1, 'Pelanggan 7', 'PJ-0007', '2026-01-07 05:08:31', NULL, NULL),
(8, 1, 'Pelanggan 8', 'PJ-0008', '2026-01-07 05:08:31', NULL, NULL),
(9, 1, 'Pelanggan 9', 'PJ-0009', '2026-01-07 05:08:31', NULL, NULL),
(10, 1, 'Pelanggan 10', 'PJ-0010', '2026-01-07 05:08:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan_detail`
--

CREATE TABLE `t_penjualan_detail` (
  `detail_id` bigint UNSIGNED NOT NULL,
  `penjualan_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `harga` int NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_penjualan_detail`
--

INSERT INTO `t_penjualan_detail` (`detail_id`, `penjualan_id`, `barang_id`, `harga`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 350000, 4, NULL, NULL),
(2, 1, 5, 600000, 5, NULL, NULL),
(3, 1, 11, 35000, 5, NULL, NULL),
(4, 2, 4, 700000, 2, NULL, NULL),
(5, 2, 11, 35000, 1, NULL, NULL),
(6, 2, 15, 25000, 5, NULL, NULL),
(7, 3, 3, 350000, 4, NULL, NULL),
(8, 3, 11, 35000, 3, NULL, NULL),
(9, 3, 13, 20000, 2, NULL, NULL),
(10, 4, 1, 9000000, 4, NULL, NULL),
(11, 4, 5, 600000, 4, NULL, NULL),
(12, 4, 6, 3000, 1, NULL, NULL),
(13, 5, 5, 600000, 4, NULL, NULL),
(14, 5, 6, 3000, 4, NULL, NULL),
(15, 5, 10, 1500, 3, NULL, NULL),
(16, 6, 1, 9000000, 1, NULL, NULL),
(17, 6, 9, 3000, 1, NULL, NULL),
(18, 6, 11, 35000, 2, NULL, NULL),
(19, 7, 4, 700000, 5, NULL, NULL),
(20, 7, 14, 80000, 4, NULL, NULL),
(21, 7, 15, 25000, 2, NULL, NULL),
(22, 8, 2, 180000, 3, NULL, NULL),
(23, 8, 10, 1500, 5, NULL, NULL),
(24, 8, 15, 25000, 1, NULL, NULL),
(25, 9, 2, 180000, 3, NULL, NULL),
(26, 9, 6, 3000, 3, NULL, NULL),
(27, 9, 15, 25000, 3, NULL, NULL),
(28, 10, 2, 180000, 1, NULL, NULL),
(29, 10, 3, 350000, 2, NULL, NULL),
(30, 10, 14, 80000, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_stok`
--

CREATE TABLE `t_stok` (
  `stok_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `stok_tanggal` datetime NOT NULL,
  `stok_jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_stok`
--

INSERT INTO `t_stok` (`stok_id`, `barang_id`, `user_id`, `stok_tanggal`, `stok_jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-01-07 05:08:31', 34, NULL, NULL),
(2, 2, 1, '2026-01-07 05:08:31', 47, NULL, NULL),
(3, 3, 1, '2026-01-07 05:08:31', 23, NULL, NULL),
(4, 4, 1, '2026-01-07 05:08:31', 32, NULL, NULL),
(5, 5, 1, '2026-01-07 05:08:31', 34, NULL, NULL),
(6, 6, 1, '2026-01-07 05:08:31', 32, NULL, NULL),
(7, 7, 1, '2026-01-07 05:08:31', 39, NULL, NULL),
(8, 10, 1, '2026-01-07 05:08:31', 23, NULL, NULL),
(9, 8, 1, '2026-01-07 05:08:31', 34, NULL, NULL),
(10, 9, 1, '2026-01-07 05:08:31', 48, NULL, NULL),
(11, 11, 1, '2026-01-07 05:08:31', 27, NULL, NULL),
(12, 12, 1, '2026-01-07 05:08:31', 32, NULL, NULL),
(13, 13, 1, '2026-01-07 05:08:31', 23, NULL, NULL),
(14, 14, 1, '2026-01-07 05:08:31', 23, NULL, NULL),
(15, 15, 1, '2026-01-07 05:08:31', 48, NULL, NULL),
(17, 11, 7, '2026-01-08 17:22:00', 35, NULL, NULL);

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

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
-- Indexes for table `m_barang`
--
ALTER TABLE `m_barang`
  ADD PRIMARY KEY (`barang_id`),
  ADD UNIQUE KEY `m_barang_barang_kode_unique` (`barang_kode`),
  ADD KEY `m_barang_kategori_id_foreign` (`kategori_id`),
  ADD KEY `m_barang_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `m_kategori`
--
ALTER TABLE `m_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `m_level`
--
ALTER TABLE `m_level`
  ADD PRIMARY KEY (`level_id`),
  ADD UNIQUE KEY `m_level_level_kode_unique` (`level_kode`);

--
-- Indexes for table `m_penjualan`
--
ALTER TABLE `m_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_supplier`
--
ALTER TABLE `m_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `m_user_username_unique` (`username`),
  ADD KEY `m_user_level_id_index` (`level_id`);

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
-- Indexes for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  ADD PRIMARY KEY (`penjualan_id`),
  ADD UNIQUE KEY `t_penjualan_penjualan_kode_unique` (`penjualan_kode`),
  ADD KEY `t_penjualan_user_id_index` (`user_id`);

--
-- Indexes for table `t_penjualan_detail`
--
ALTER TABLE `t_penjualan_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `t_penjualan_detail_penjualan_id_index` (`penjualan_id`),
  ADD KEY `t_penjualan_detail_barang_id_index` (`barang_id`);

--
-- Indexes for table `t_stok`
--
ALTER TABLE `t_stok`
  ADD PRIMARY KEY (`stok_id`),
  ADD KEY `t_stok_barang_id_foreign` (`barang_id`),
  ADD KEY `t_stok_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `m_barang`
--
ALTER TABLE `m_barang`
  MODIFY `barang_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `m_kategori`
--
ALTER TABLE `m_kategori`
  MODIFY `kategori_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_level`
--
ALTER TABLE `m_level`
  MODIFY `level_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_penjualan`
--
ALTER TABLE `m_penjualan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_supplier`
--
ALTER TABLE `m_supplier`
  MODIFY `supplier_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `penjualan_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_penjualan_detail`
--
ALTER TABLE `t_penjualan_detail`
  MODIFY `detail_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `t_stok`
--
ALTER TABLE `t_stok`
  MODIFY `stok_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_barang`
--
ALTER TABLE `m_barang`
  ADD CONSTRAINT `m_barang_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `m_kategori` (`kategori_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `m_barang_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `m_supplier` (`supplier_id`) ON DELETE CASCADE;

--
-- Constraints for table `m_user`
--
ALTER TABLE `m_user`
  ADD CONSTRAINT `m_user_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `m_level` (`level_id`);

--
-- Constraints for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  ADD CONSTRAINT `t_penjualan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `m_user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `t_penjualan_detail`
--
ALTER TABLE `t_penjualan_detail`
  ADD CONSTRAINT `t_penjualan_detail_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `m_barang` (`barang_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_penjualan_detail_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `t_penjualan` (`penjualan_id`) ON DELETE CASCADE;

--
-- Constraints for table `t_stok`
--
ALTER TABLE `t_stok`
  ADD CONSTRAINT `t_stok_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `m_barang` (`barang_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_stok_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `m_user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
