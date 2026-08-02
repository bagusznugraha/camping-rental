-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2026 at 02:43 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camping_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Carrier', NULL, '2026-06-30 06:36:44', '2026-06-30 06:36:44'),
(3, 'Sleeping Bag', NULL, '2026-06-30 06:37:09', '2026-06-30 06:37:09'),
(4, 'Kompor', NULL, '2026-06-30 06:37:31', '2026-06-30 06:37:31'),
(5, 'Lampu', NULL, '2026-06-30 06:37:54', '2026-06-30 06:37:54'),
(6, 'Tenda', NULL, '2026-06-30 07:42:56', '2026-06-30 07:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rental_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `sender` enum('Admin','Pelanggan') NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `total_unit` int(11) NOT NULL DEFAULT 0,
  `rent_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `specification` text DEFAULT NULL,
  `watt` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `category_id`, `name`, `stock`, `total_unit`, `rent_count`, `price`, `description`, `specification`, `watt`, `image`, `created_at`, `updated_at`, `views`) VALUES
(2, 2, 'Carrier consina 60L', 6, 9, 4, 35000.00, NULL, 'Merek: Consina\r\nKapasitas: 60 Liter\r\nBahan: Polyester Ripstop tahan air\r\nBerat: ±1,8 kg', NULL, '1785077040.png', '2026-07-02 05:00:52', '2026-07-30 12:38:20', 0),
(3, 6, 'Tenda Eiger 4 Orang', 8, 10, 3, 50000.00, NULL, 'Merek: Eiger\r\nKapasitas: 4 Orang\r\nUkuran: 210 × 240 × 140 cm\r\nBahan Flysheet: Polyester Waterproof \r\nBerat: ±3,8 kg', NULL, '1785076455.png', '2026-07-02 05:01:33', '2026-07-30 08:25:43', 0),
(4, 3, 'Sleeping Bag Naturehike', 13, 15, 2, 20000.00, NULL, 'Merek: Naturehike\r\nUkuran: 210 × 75 cm\r\nBahan Luar: Polyester 190T\r\nIsian: Hollow Cotton\r\nBerat: ±1 kg\r\nSuhu Nyaman: 5–15°C', NULL, '1785076972.png', '2026-07-02 05:02:32', '2026-07-28 18:22:41', 0),
(5, 4, 'Kompor Portable', 8, 10, 2, 25000.00, NULL, 'enis: Portable Gas Stove\r\nBahan: Stainless Steel & Aluminium Alloy\r\nBahan Bakar: Gas Butane 220 gr\r\nBerat: ±450 gram\r\nFitur: Api dapat diatur, konsumsi gas', NULL, '1785076546.png', '2026-07-02 05:03:13', '2026-07-30 12:28:21', 0),
(6, 5, 'Lampu Camping LED', 14, 15, 2, 15000.00, NULL, 'Jenis: Rechargeable Camping Lantern\r\nSumber Cahaya: LED High Brightness\r\nKapasitas: 30W\r\nDaya Tahan: 6–12 jam', NULL, '1785076514.png', '2026-07-02 05:04:05', '2026-07-27 17:32:50', 0),
(7, 6, 'Tenda Consina Magnum 4', 13, 13, 1, 50000.00, NULL, 'Merek: Consina\r\nKapasitas: 4 Orang\r\nBahan: Polyester Waterproof 3000 mm\r\nTiang: Fiberglass', NULL, '1785079565.jpg', '2026-07-26 15:26:05', '2026-07-28 16:47:33', 0),
(8, 6, 'Tenda Naturehike Cloud Up 2', 12, 14, 4, 60000.00, NULL, 'Merek: Naturehike\r\nKapasitas: 2 Orang\r\nBahan: Nylon Silicone Waterproof 4000 mm\r\nTiang: Aluminium Alloy\r\nBerat: ±2 kg', NULL, '1785079669.jpg', '2026-07-26 15:27:49', '2026-07-30 08:15:02', 0),
(9, 6, 'Tenda Dome 4 Orang', 14, 15, 1, 55000.00, NULL, 'Jenis: Dome Tent\r\nKapasitas: 4 Orang\r\nBahan: Polyester Waterproof\r\nTiang: Fiberglass', NULL, '1785079742.jpg', '2026-07-26 15:29:02', '2026-07-27 01:53:23', 0),
(10, 6, 'Tenda Dome 2 Orang', 15, 16, 1, 40000.00, NULL, 'Jenis: Dome Tent\r\nKapasitas: 2 Orang\r\nBahan: Polyester Waterproof\r\nTiang: Fiberglass', NULL, '1785079820.jpg', '2026-07-26 15:30:20', '2026-07-26 15:58:17', 0),
(11, 5, 'Headlamp Outdoor', 18, 20, 2, 15000.00, NULL, 'Jenis: LED Headlamp\r\nKecerahan: 300 Lumens\r\nBaterai: Rechargeable\r\nDaya Tahan: 6–10 jam', NULL, '1785079952.jpg', '2026-07-26 15:32:32', '2026-07-28 16:55:19', 0),
(12, 5, 'Lampu Lentera LED', 16, 17, 1, 15000.00, NULL, 'Jenis: Camping Lantern\r\nSumber Cahaya: LED High Brightness\r\nKapasitas: 30W\r\nDaya Tahan: 6–12 jam', NULL, '1785080044.jpg', '2026-07-26 15:34:04', '2026-07-29 17:25:51', 0),
(13, 5, 'Lampu Camping Solar', 14, 14, 0, 18000.00, NULL, 'Jenis: Solar Camping Lamp\r\nSumber Daya: Panel Surya & USB\r\nKecerahan: 400 Lumens\r\nDaya Tahan: 8–12 jam', NULL, '1785080141.jpg', '2026-07-26 15:35:41', '2026-07-26 15:35:41', 0),
(14, 5, 'Lampu LED Rechargeable', 19, 20, 1, 12000.00, NULL, 'Jenis: Rechargeable LED Lamp\r\nKapasitas Baterai: 2400 mAh\r\nDaya Tahan: 5–10 jam', NULL, '1785080214.jpg', '2026-07-26 15:36:54', '2026-07-28 18:35:09', 0),
(15, 4, 'Kompor Gas Outdoor', 15, 16, 1, 25000.00, NULL, 'Jenis: Portable Gas Stove\r\nBahan: Stainless Steel\r\nBahan Bakar: Gas Butane 220 gr\r\nBerat: ±450 gram', NULL, '1785080314.jpg', '2026-07-26 15:38:34', '2026-07-28 17:05:02', 0),
(16, 4, 'Kompor Camping Premium', 16, 17, 1, 35000.00, NULL, 'Jenis: Premium Gas Stove\r\nBahan: Stainless Steel & Aluminium Alloy\r\nBerat: ±600 gram', NULL, '1785080392.jpg', '2026-07-26 15:39:52', '2026-07-29 19:01:21', 0),
(17, 4, 'Kompor Lipat Hiking', 18, 18, 0, 20000.00, NULL, 'Jenis: Folding Stove\r\nBahan: Aluminium Alloy\r\nBerat: ±300 gram\r\nBahan Bakar: Gas Butane', NULL, '1785080475.jpg', '2026-07-26 15:41:15', '2026-07-26 15:41:15', 0),
(18, 4, 'Kompor Windproof', 14, 15, 1, 30000.00, NULL, 'Jenis: Windproof Stove\r\nBahan: Stainless Steel\r\nBahan Bakar: Gas Butane\r\nBerat: ±420 gram', NULL, '1785080539.jpg', '2026-07-26 15:42:19', '2026-07-29 00:35:51', 0),
(19, 2, 'Carrier Avtech 55L', 12, 13, 1, 25000.00, NULL, 'Merek: Avtech\r\nKapasitas: 55 Liter\r\nBahan: Polyester Ripstop', NULL, '1785080612.jpg', '2026-07-26 15:43:32', '2026-07-29 00:35:51', 0),
(20, 2, 'Carrier Naturehike 65L', 14, 14, 0, 45000.00, NULL, 'Merek: Naturehike\r\nKapasitas: 65 Liter\r\nBahan: Nylon Waterproof\r\nBerat: ±1,7 kg', NULL, '1785080670.jpg', '2026-07-26 15:44:30', '2026-07-26 15:44:30', 0),
(21, 2, 'Carrier Rei 50L', 16, 17, 1, 35000.00, NULL, 'Merek: Rei\r\nKapasitas: 50 Liter\r\nBahan: Polyester', NULL, '1785080723.jpg', '2026-07-26 15:45:23', '2026-07-28 16:19:21', 0),
(22, 2, 'Carrier Eiger 60L', 14, 15, 1, 40000.00, NULL, 'Merek: Eiger\r\nKapasitas: 60 Liter\r\nBahan: Polyester Ripstop', NULL, '1785080801.jpg', '2026-07-26 15:46:10', '2026-07-29 18:19:10', 0),
(23, 3, 'Sleeping Bag Consina', 20, 20, 0, 20000.00, NULL, 'Merek: Consina\r\nUkuran: 210 × 75 cm\r\nIsian: Hollow Cotton\r\nBerat: ±1 kg\r\nSuhu Nyaman: 5–15°C.', NULL, '1785080907.jpg', '2026-07-26 15:48:27', '2026-07-26 15:48:27', 0),
(24, 3, 'Sleeping Bag Polar Outdoor', 17, 18, 1, 22000.00, NULL, 'Merek: Polar Outdoor\r\nUkuran: 210 × 80 cm\r\nIsian: Hollow Fiber\r\nBerat: ±1,2 kg\r\nHangat dan nyaman.', NULL, '1785080994.jpg', '2026-07-26 15:49:54', '2026-07-28 21:08:50', 0),
(25, 3, 'Sleeping Bag Rei', 18, 19, 2, 25000.00, NULL, 'Merek: Rei\r\nUkuran: 210 × 80 cm\r\nIsian: Polyester Fiber\r\nBerat: ±1,1 kg\r\nSuhu Nyaman: 0–10°C', NULL, '1785081058.jpg', '2026-07-26 15:50:58', '2026-07-30 07:25:59', 0),
(27, 3, 'Sleeping Bag Consina Mummy', 19, 20, 1, 25000.00, NULL, 'Merek: Consina\r\nJenis: Mummy Sleeping Bag\r\nBahan Luar: Polyester 210T\r\nBahan Dalam: Soft Polyester\r\nSuhu Nyaman: 5–15°C', NULL, '1785264338.jpg', '2026-07-28 18:45:38', '2026-07-30 08:15:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_28_174121_add_role_to_users_table', 1),
(5, '2026_06_30_154728_create_categories_table', 1),
(6, '2026_06_30_170744_create_equipment_table', 1),
(7, '2026_06_30_204241_create_rentals_table', 1),
(8, '2026_06_30_204303_create_rental_details_table', 1),
(9, '2026_07_18_155546_update_rentals_table_add_new_fields', 1),
(10, '2026_07_18_155613_update_equipments_table_add_new_fields', 1),
(11, '2026_07_18_163911_create_payments_table', 1),
(12, '2026_07_18_163946_create_notifications_table', 1),
(13, '2026_07_18_163954_create_chats_table', 1),
(14, '2026_07_18_192644_create_reviews_table', 1),
(15, '2026_07_20_164749_add_total_unit_to_equipment_table', 1),
(16, '2026_07_22_092015_add_rental_id_to_notifications_table', 1),
(17, '2026_07_22_110427_change_return_date_nullable_in_rentals_table', 1),
(18, '2026_07_23_180915_add_photo_to_reviews_table', 1),
(19, '2026_07_23_202215_change_rental_date_nullable_in_rentals_table', 1),
(20, '2026_07_24_100305_create_visitors_table', 1),
(21, '2026_07_26_003338_add_booking_fields_to_rentals_table', 1),
(22, '2026_07_26_005452_add_deposit_fields_to_rentals_table', 1),
(23, '2026_07_26_015050_update_payments_table_add_deposit_system', 1),
(24, '2026_07_26_034620_add_remaining_payment_proof_to_payments_table', 1),
(25, '2026_07_26_152738_update_payment_status_enum', 1),
(26, '2026_07_29_034049_add_views_to_equipment_table', 2),
(27, '2026_07_29_034715_create_page_views_table', 3),
(28, '2026_07_30_143406_add_late_fee_to_rentals_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rental_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `rental_id`, `title`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 1, '2026-07-26 14:31:22', '2026-07-28 16:46:51'),
(2, 1, NULL, 'Bukti Pembayaran Dikirim', 'Pembayaran sedang diverifikasi Admin.', 1, '2026-07-26 14:31:38', '2026-07-28 16:46:51'),
(3, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 1, '2026-07-26 15:58:17', '2026-07-28 16:46:51'),
(4, 1, NULL, 'Bukti Pembayaran Dikirim', 'Pembayaran sedang diverifikasi Admin.', 1, '2026-07-26 15:58:35', '2026-07-28 16:46:51'),
(5, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 1, '2026-07-27 01:53:23', '2026-07-28 16:46:51'),
(6, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 1, '2026-07-27 01:54:57', '2026-07-28 16:46:51'),
(7, 1, NULL, 'Deposit Diterima', 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.', 1, '2026-07-27 16:10:36', '2026-07-28 16:46:51'),
(8, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 1, '2026-07-27 17:00:05', '2026-07-28 16:46:51'),
(9, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 1, '2026-07-27 17:06:05', '2026-07-28 16:46:51'),
(10, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 1, '2026-07-27 17:07:13', '2026-07-28 16:46:51'),
(11, 1, NULL, 'Deposit Diterima', 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.', 1, '2026-07-27 17:08:49', '2026-07-28 16:46:51'),
(12, 1, NULL, 'Pembayaran Diterima', 'Pembayaran Anda telah diverifikasi. Pesanan siap diproses admin.', 1, '2026-07-27 17:14:00', '2026-07-28 16:46:51'),
(13, 1, NULL, 'Pembayaran Diterima', 'Pembayaran Anda telah diverifikasi. Pesanan siap diproses admin.', 1, '2026-07-27 17:31:17', '2026-07-28 16:46:51'),
(14, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 1, '2026-07-27 17:32:50', '2026-07-28 16:46:51'),
(15, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 1, '2026-07-27 17:33:16', '2026-07-28 16:46:51'),
(16, 1, NULL, 'Deposit Diterima', 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.', 1, '2026-07-27 17:33:29', '2026-07-28 16:46:51'),
(17, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 1, '2026-07-27 17:33:35', '2026-07-28 16:46:51'),
(18, 1, NULL, 'Pelunasan Dikirim', 'Pelunasan berhasil dikirim dan sedang menunggu verifikasi admin.', 1, '2026-07-27 18:00:39', '2026-07-28 16:46:51'),
(19, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 1, '2026-07-27 18:04:04', '2026-07-28 16:46:51'),
(20, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 1, '2026-07-27 18:05:05', '2026-07-28 16:46:51'),
(21, 1, NULL, 'Deposit Diterima', 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.', 1, '2026-07-27 18:07:06', '2026-07-28 16:46:51'),
(22, 1, NULL, 'Pelunasan Dikirim', 'Pelunasan berhasil dikirim dan sedang menunggu verifikasi admin.', 1, '2026-07-27 18:07:32', '2026-07-28 16:46:51'),
(23, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 1, '2026-07-27 19:03:37', '2026-07-28 16:46:51'),
(24, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 1, '2026-07-27 19:04:04', '2026-07-28 16:46:51'),
(25, 1, NULL, 'Deposit Diterima', 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.', 1, '2026-07-27 19:04:18', '2026-07-28 16:46:51'),
(26, 1, NULL, 'Permintaan Bayar Cash', 'Administrator memilih pelunasan cash saat pengambilan.', 1, '2026-07-27 19:05:06', '2026-07-28 16:46:51'),
(27, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 1, '2026-07-27 19:25:46', '2026-07-28 16:46:51'),
(28, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 1, '2026-07-27 19:26:25', '2026-07-28 16:46:51'),
(29, 1, NULL, 'Deposit Diterima', 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.', 1, '2026-07-27 19:26:38', '2026-07-28 16:46:51'),
(30, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 1, '2026-07-27 19:27:10', '2026-07-28 16:46:51'),
(31, 1, NULL, 'Permintaan Bayar Cash', 'Administrator memilih pelunasan cash saat pengambilan.', 1, '2026-07-27 19:27:44', '2026-07-28 16:46:51'),
(32, 1, NULL, 'Barang Siap Diambil', 'Barang dapat diambil maksimal besok pukul 17.00 WIB.', 1, '2026-07-27 19:27:58', '2026-07-28 16:46:51'),
(33, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 1, '2026-07-27 19:29:50', '2026-07-28 16:46:51'),
(34, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 1, '2026-07-27 19:30:01', '2026-07-28 16:46:51'),
(35, 1, NULL, 'Deposit Diterima', 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.', 1, '2026-07-27 19:30:15', '2026-07-28 16:46:51'),
(36, 1, NULL, 'Pelunasan Dikirim', 'Pelunasan berhasil dikirim dan sedang menunggu verifikasi admin.', 1, '2026-07-27 19:30:34', '2026-07-28 16:46:51'),
(37, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 1, '2026-07-28 16:19:21', '2026-07-28 16:46:51'),
(38, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 1, '2026-07-28 16:20:07', '2026-07-28 16:46:51'),
(39, 1, NULL, 'Deposit Diterima', 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.', 1, '2026-07-28 16:20:23', '2026-07-28 16:46:51'),
(40, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 1, '2026-07-28 16:20:34', '2026-07-28 16:46:51'),
(41, 1, NULL, 'Pelunasan Dikirim', 'Pelunasan berhasil dikirim dan sedang menunggu verifikasi admin.', 1, '2026-07-28 16:21:02', '2026-07-28 16:46:51'),
(42, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 1, '2026-07-28 16:36:09', '2026-07-28 16:46:51'),
(43, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 1, '2026-07-28 16:36:22', '2026-07-28 16:46:51'),
(44, 1, NULL, 'Deposit Diterima', 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.', 1, '2026-07-28 16:36:38', '2026-07-28 16:46:51'),
(45, 1, NULL, 'Pelunasan Dikirim', 'Pelunasan berhasil dikirim dan sedang menunggu verifikasi admin.', 1, '2026-07-28 16:37:28', '2026-07-28 16:46:51'),
(46, 1, NULL, 'Pelunasan Diterima', 'Pelunasan berhasil diverifikasi. Pesanan siap diproses admin.', 1, '2026-07-28 16:38:01', '2026-07-28 16:46:51'),
(47, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 1, '2026-07-28 16:38:08', '2026-07-28 16:46:51'),
(48, 1, NULL, 'Barang Siap Diambil', 'Barang dapat diambil maksimal besok pukul 17.00 WIB.', 1, '2026-07-28 16:38:15', '2026-07-28 16:46:51'),
(49, 1, NULL, 'Penyewaan Dimulai', 'Selamat menikmati perlengkapan camping Anda.', 1, '2026-07-28 16:39:42', '2026-07-28 16:46:51'),
(50, 1, NULL, 'Penyewaan Selesai', 'Terima kasih telah menyewa di CampRent.', 1, '2026-07-28 16:41:30', '2026-07-28 16:46:51'),
(51, 1, NULL, 'Pelunasan Diterima', 'Pelunasan berhasil diverifikasi. Pesanan siap diproses admin.', 1, '2026-07-28 16:42:21', '2026-07-28 16:46:51'),
(52, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 1, '2026-07-28 16:42:33', '2026-07-28 16:46:51'),
(53, 1, NULL, 'Barang Siap Diambil', 'Barang dapat diambil maksimal besok pukul 17.00 WIB.', 1, '2026-07-28 16:42:40', '2026-07-28 16:46:46'),
(54, 1, NULL, 'Penyewaan Dimulai', 'Selamat menikmati perlengkapan camping Anda.', 1, '2026-07-28 16:42:44', '2026-07-28 16:46:51'),
(55, 1, NULL, 'Penyewaan Selesai', 'Terima kasih telah menyewa di CampRent.', 0, '2026-07-28 16:47:33', '2026-07-28 16:47:33'),
(56, 1, NULL, 'Pembayaran Cash Diterima', 'Pembayaran cash telah diterima oleh admin.', 0, '2026-07-28 16:49:09', '2026-07-28 16:49:09'),
(57, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 0, '2026-07-28 16:49:14', '2026-07-28 16:49:14'),
(58, 1, NULL, 'Barang Siap Diambil', 'Barang dapat diambil maksimal besok pukul 17.00 WIB.', 0, '2026-07-28 16:49:20', '2026-07-28 16:49:20'),
(59, 1, NULL, 'Penyewaan Dimulai', 'Selamat menikmati perlengkapan camping Anda.', 0, '2026-07-28 16:49:29', '2026-07-28 16:49:29'),
(60, 1, NULL, 'Penyewaan Selesai', 'Terima kasih telah menyewa di CampRent.', 0, '2026-07-28 16:49:40', '2026-07-28 16:49:40'),
(61, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 0, '2026-07-28 16:55:19', '2026-07-28 16:55:19'),
(62, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-28 16:55:42', '2026-07-28 16:55:42'),
(63, 1, NULL, 'Pembayaran Diterima', 'Pembayaran Anda telah diverifikasi. Pesanan siap diproses admin.', 0, '2026-07-28 16:56:07', '2026-07-28 16:56:07'),
(64, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 0, '2026-07-28 16:56:19', '2026-07-28 16:56:19'),
(65, 1, NULL, 'Barang Dikirim', 'Barang sedang dikirim ke alamat Anda.', 0, '2026-07-28 16:56:27', '2026-07-28 16:56:27'),
(66, 1, NULL, 'Penyewaan Dimulai', 'Selamat menikmati perlengkapan camping Anda.', 0, '2026-07-28 16:57:59', '2026-07-28 16:57:59'),
(67, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 0, '2026-07-28 17:05:02', '2026-07-28 17:05:02'),
(68, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-28 17:05:41', '2026-07-28 17:05:41'),
(69, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-28 17:05:42', '2026-07-28 17:05:42'),
(70, 1, NULL, 'Deposit Diterima', 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.', 0, '2026-07-28 17:06:00', '2026-07-28 17:06:00'),
(71, 1, NULL, 'Pelunasan Dikirim', 'Pelunasan berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-28 17:06:58', '2026-07-28 17:06:58'),
(72, 1, NULL, 'Pelunasan Diterima', 'Pelunasan berhasil diverifikasi. Pesanan siap diproses admin.', 0, '2026-07-28 17:07:12', '2026-07-28 17:07:12'),
(73, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 0, '2026-07-28 17:07:19', '2026-07-28 17:07:19'),
(74, 1, NULL, 'Barang Siap Diambil', 'Barang dapat diambil maksimal besok pukul 17.00 WIB.', 0, '2026-07-28 17:07:24', '2026-07-28 17:07:24'),
(75, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 0, '2026-07-28 17:08:37', '2026-07-28 17:08:37'),
(76, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-28 17:09:07', '2026-07-28 17:09:07'),
(77, 1, NULL, 'Deposit Diterima', 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.', 0, '2026-07-28 17:09:23', '2026-07-28 17:09:23'),
(78, 1, NULL, 'Permintaan Bayar Cash', 'Administrator memilih pelunasan cash saat pengambilan.', 0, '2026-07-28 17:13:06', '2026-07-28 17:13:06'),
(79, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 0, '2026-07-28 18:06:07', '2026-07-28 18:06:07'),
(80, 1, NULL, 'Barang Siap Diambil', 'Barang dapat diambil maksimal besok pukul 17.00 WIB.', 0, '2026-07-28 18:06:13', '2026-07-28 18:06:13'),
(81, 1, NULL, 'Pembayaran Cash Diterima', 'Pembayaran cash telah diterima oleh admin.', 0, '2026-07-28 18:06:24', '2026-07-28 18:06:24'),
(82, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 0, '2026-07-28 18:06:52', '2026-07-28 18:06:52'),
(83, 1, NULL, 'Barang Siap Diambil', 'Barang dapat diambil maksimal besok pukul 17.00 WIB.', 0, '2026-07-28 18:06:59', '2026-07-28 18:06:59'),
(84, 1, NULL, 'Penyewaan Dimulai', 'Selamat menikmati perlengkapan camping Anda.', 0, '2026-07-28 18:07:22', '2026-07-28 18:07:22'),
(85, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 0, '2026-07-28 18:09:00', '2026-07-28 18:09:00'),
(86, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-28 18:09:27', '2026-07-28 18:09:27'),
(87, 1, NULL, 'Deposit Diterima', 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.', 0, '2026-07-28 18:09:38', '2026-07-28 18:09:38'),
(88, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 0, '2026-07-28 18:09:44', '2026-07-28 18:09:44'),
(89, 1, NULL, 'Permintaan Bayar Cash', 'Administrator memilih pelunasan cash saat pengambilan.', 0, '2026-07-28 18:10:14', '2026-07-28 18:10:14'),
(90, 1, NULL, 'Barang Siap Diambil', 'Barang dapat diambil maksimal besok pukul 17.00 WIB.', 0, '2026-07-28 18:10:54', '2026-07-28 18:10:54'),
(91, 1, NULL, 'Pembayaran Cash Diterima', 'Pembayaran cash telah diterima oleh admin.', 0, '2026-07-28 18:11:17', '2026-07-28 18:11:17'),
(92, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 0, '2026-07-28 18:11:27', '2026-07-28 18:11:27'),
(93, 1, NULL, 'Barang Siap Diambil', 'Barang dapat diambil maksimal besok pukul 17.00 WIB.', 0, '2026-07-28 18:11:35', '2026-07-28 18:11:35'),
(94, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 0, '2026-07-28 18:22:41', '2026-07-28 18:22:41'),
(95, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-28 18:23:01', '2026-07-28 18:23:01'),
(96, 1, NULL, 'Deposit Diterima', 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.', 0, '2026-07-28 18:23:21', '2026-07-28 18:23:21'),
(97, 1, NULL, 'Permintaan Bayar Cash', 'Administrator memilih pelunasan cash saat pengambilan.', 0, '2026-07-28 18:23:37', '2026-07-28 18:23:37'),
(98, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 0, '2026-07-28 18:23:49', '2026-07-28 18:23:49'),
(99, 1, NULL, 'Barang Siap Diambil', 'Barang dapat diambil maksimal besok pukul 17.00 WIB.', 0, '2026-07-28 18:23:54', '2026-07-28 18:23:54'),
(100, 1, NULL, 'Pembayaran Cash Diterima', 'Pembayaran cash telah diterima oleh admin.', 0, '2026-07-28 18:24:01', '2026-07-28 18:24:01'),
(101, 1, NULL, 'Penyewaan Dimulai', 'Selamat menikmati perlengkapan camping Anda.', 0, '2026-07-28 18:24:06', '2026-07-28 18:24:06'),
(102, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 0, '2026-07-28 18:25:40', '2026-07-28 18:25:40'),
(103, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-28 18:26:58', '2026-07-28 18:26:58'),
(104, 1, NULL, 'Pembayaran Diterima', 'Pembayaran Anda telah diverifikasi. Pesanan siap diproses admin.', 0, '2026-07-28 18:27:26', '2026-07-28 18:27:26'),
(105, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 0, '2026-07-28 18:33:09', '2026-07-28 18:33:09'),
(106, 1, NULL, 'Barang Siap Diambil', 'Barang dapat diambil maksimal besok pukul 17.00 WIB.', 0, '2026-07-28 18:33:16', '2026-07-28 18:33:16'),
(107, 1, NULL, 'Penyewaan Dimulai', 'Selamat menikmati perlengkapan camping Anda.', 0, '2026-07-28 18:33:50', '2026-07-28 18:33:50'),
(108, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 0, '2026-07-28 18:35:09', '2026-07-28 18:35:09'),
(109, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-28 18:35:31', '2026-07-28 18:35:31'),
(110, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-28 18:35:32', '2026-07-28 18:35:32'),
(111, 1, NULL, 'Pembayaran Diterima', 'Pembayaran Anda telah diverifikasi. Pesanan siap diproses admin.', 0, '2026-07-28 18:35:47', '2026-07-28 18:35:47'),
(112, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 0, '2026-07-28 18:36:15', '2026-07-28 18:36:15'),
(113, 1, NULL, 'Barang Dikirim', 'Barang sedang dikirim ke alamat Anda.', 0, '2026-07-28 18:36:20', '2026-07-28 18:36:20'),
(114, 1, NULL, 'Penyewaan Selesai', 'Terima kasih telah menyewa di CampRent.', 0, '2026-07-28 18:52:06', '2026-07-28 18:52:06'),
(115, 1, NULL, 'Penyewaan Selesai', 'Terima kasih telah menyewa di CampRent.', 0, '2026-07-28 19:05:08', '2026-07-28 19:05:08'),
(116, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 0, '2026-07-28 21:08:50', '2026-07-28 21:08:50'),
(117, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-28 21:09:17', '2026-07-28 21:09:17'),
(118, 1, NULL, 'Deposit Diterima', 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.', 0, '2026-07-28 21:10:23', '2026-07-28 21:10:23'),
(119, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 0, '2026-07-28 21:10:31', '2026-07-28 21:10:31'),
(120, 1, NULL, 'Pelunasan Dikirim', 'Pelunasan berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-28 21:11:03', '2026-07-28 21:11:03'),
(121, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 0, '2026-07-28 21:28:17', '2026-07-28 21:28:17'),
(122, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-28 21:28:26', '2026-07-28 21:28:26'),
(123, 1, NULL, 'Deposit Diterima', 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.', 0, '2026-07-28 21:34:41', '2026-07-28 21:34:41'),
(124, 1, NULL, 'Pelunasan Dikirim', 'Pelunasan berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-28 21:35:04', '2026-07-28 21:35:04'),
(125, 1, NULL, 'Pelunasan Diterima', 'Pelunasan berhasil diverifikasi. Pesanan siap diproses admin.', 0, '2026-07-28 21:35:16', '2026-07-28 21:35:16'),
(126, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 0, '2026-07-28 21:35:53', '2026-07-28 21:35:53'),
(127, 1, NULL, 'Barang Siap Diambil', 'Barang dapat diambil maksimal besok pukul 17.00 WIB.', 0, '2026-07-29 00:34:33', '2026-07-29 00:34:33'),
(128, 1, NULL, 'Penyewaan Dimulai', 'Selamat menikmati perlengkapan camping Anda.', 0, '2026-07-29 00:34:43', '2026-07-29 00:34:43'),
(129, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 0, '2026-07-29 00:35:51', '2026-07-29 00:35:51'),
(130, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-29 00:36:24', '2026-07-29 00:36:24'),
(131, 1, NULL, 'Deposit Diterima', 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.', 0, '2026-07-29 00:37:36', '2026-07-29 00:37:36'),
(132, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 0, '2026-07-29 00:37:51', '2026-07-29 00:37:51'),
(133, 1, NULL, 'Pelunasan Dikirim', 'Pelunasan berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-29 01:21:20', '2026-07-29 01:21:20'),
(134, 1, NULL, 'Pelunasan Diterima', 'Pelunasan berhasil diverifikasi. Pesanan siap diproses admin.', 0, '2026-07-29 01:29:10', '2026-07-29 01:29:10'),
(135, 1, NULL, 'Barang Dikirim', 'Barang sedang dikirim ke alamat Anda.', 0, '2026-07-29 01:30:27', '2026-07-29 01:30:27'),
(136, 1, NULL, 'Pelunasan Diterima', 'Pelunasan berhasil diverifikasi. Pesanan siap diproses admin.', 0, '2026-07-29 17:24:14', '2026-07-29 17:24:14'),
(137, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 0, '2026-07-29 17:25:51', '2026-07-29 17:25:51'),
(138, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-29 17:26:57', '2026-07-29 17:26:57'),
(139, 1, NULL, 'Pembayaran Ditolak', 'Bukti pembayaran ditolak. Silakan upload ulang bukti pembayaran.', 0, '2026-07-29 17:28:01', '2026-07-29 17:28:01'),
(140, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-29 17:54:35', '2026-07-29 17:54:35'),
(141, 1, NULL, 'Deposit Diterima', 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.', 0, '2026-07-29 17:55:01', '2026-07-29 17:55:01'),
(142, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 0, '2026-07-29 17:55:06', '2026-07-29 17:55:06'),
(143, 1, NULL, 'Pelunasan Dikirim', 'Pelunasan berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-29 17:55:47', '2026-07-29 17:55:47'),
(144, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 0, '2026-07-29 18:19:10', '2026-07-29 18:19:10'),
(145, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-29 18:19:42', '2026-07-29 18:19:42'),
(146, 1, NULL, 'Pembayaran Diterima', 'Pembayaran Anda telah diverifikasi. Pesanan siap diproses admin.', 0, '2026-07-29 18:20:01', '2026-07-29 18:20:01'),
(147, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 0, '2026-07-29 18:20:09', '2026-07-29 18:20:09'),
(148, 1, NULL, 'Barang Siap Diambil', 'Barang dapat diambil maksimal besok pukul 17.00 WIB.', 0, '2026-07-29 18:20:42', '2026-07-29 18:20:42'),
(149, 1, NULL, 'Penyewaan Dimulai', 'Selamat menikmati perlengkapan camping Anda.', 0, '2026-07-29 19:00:04', '2026-07-29 19:00:04'),
(150, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 0, '2026-07-29 19:01:21', '2026-07-29 19:01:21'),
(151, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-29 19:01:35', '2026-07-29 19:01:35'),
(152, 1, NULL, 'Deposit Diterima', 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.', 0, '2026-07-29 19:01:51', '2026-07-29 19:01:51'),
(153, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 0, '2026-07-29 19:01:56', '2026-07-29 19:01:56'),
(154, 1, NULL, 'Pelunasan Dikirim', 'Pelunasan berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-29 19:03:03', '2026-07-29 19:03:03'),
(155, 1, NULL, 'Pelunasan Diterima', 'Pelunasan berhasil diverifikasi. Pesanan siap diproses admin.', 0, '2026-07-29 19:03:38', '2026-07-29 19:03:38'),
(156, 1, NULL, 'Barang Dikirim', 'Barang sedang dikirim ke alamat Anda.', 0, '2026-07-29 19:03:44', '2026-07-29 19:03:44'),
(157, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 0, '2026-07-30 07:21:47', '2026-07-30 07:21:47'),
(158, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-30 07:23:04', '2026-07-30 07:23:04'),
(159, 1, NULL, 'Pembayaran Ditolak', 'Bukti pembayaran ditolak. Silakan upload ulang bukti pembayaran.', 0, '2026-07-30 07:23:30', '2026-07-30 07:23:30'),
(160, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-30 07:24:17', '2026-07-30 07:24:17'),
(161, 1, NULL, 'Deposit Diterima', 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.', 0, '2026-07-30 07:24:31', '2026-07-30 07:24:31'),
(162, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 0, '2026-07-30 07:24:39', '2026-07-30 07:24:39'),
(163, 1, NULL, 'Permintaan Bayar Cash', 'Administrator memilih pelunasan cash saat pengambilan.', 0, '2026-07-30 07:24:54', '2026-07-30 07:24:54'),
(164, 1, NULL, 'Barang Siap Diambil', 'Barang dapat diambil maksimal besok pukul 17.00 WIB.', 0, '2026-07-30 07:25:30', '2026-07-30 07:25:30'),
(165, 1, NULL, 'Pembayaran Cash Diterima', 'Pembayaran cash telah diterima oleh admin.', 0, '2026-07-30 07:25:37', '2026-07-30 07:25:37'),
(166, 1, NULL, 'Penyewaan Dimulai', 'Selamat menikmati perlengkapan camping Anda.', 0, '2026-07-30 07:25:45', '2026-07-30 07:25:45'),
(167, 1, NULL, 'Penyewaan Selesai', 'Terima kasih telah menyewa di CampRent.', 0, '2026-07-30 07:25:59', '2026-07-30 07:25:59'),
(168, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 0, '2026-07-30 07:54:06', '2026-07-30 07:54:06'),
(169, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-30 07:54:35', '2026-07-30 07:54:35'),
(170, 1, NULL, 'Pembayaran Ditolak', 'Bukti pembayaran ditolak. Silakan upload ulang bukti pembayaran.', 0, '2026-07-30 07:55:24', '2026-07-30 07:55:24'),
(171, 1, NULL, 'Pelunasan Dikirim', 'Pelunasan berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-30 08:07:57', '2026-07-30 08:07:57'),
(172, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 0, '2026-07-30 08:15:02', '2026-07-30 08:15:02'),
(173, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-30 08:15:30', '2026-07-30 08:15:30'),
(174, 1, NULL, 'Deposit Diterima', 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.', 0, '2026-07-30 08:24:31', '2026-07-30 08:24:31'),
(175, 1, NULL, 'Penyewaan Diproses', 'Admin sedang menyiapkan perlengkapan Anda.', 0, '2026-07-30 08:24:39', '2026-07-30 08:24:39'),
(176, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 0, '2026-07-30 08:25:43', '2026-07-30 08:25:43'),
(177, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-30 08:25:54', '2026-07-30 08:25:54'),
(178, 1, NULL, 'Pembayaran Ditolak', 'Bukti pembayaran ditolak. Silakan upload ulang bukti pembayaran.', 0, '2026-07-30 08:26:28', '2026-07-30 08:26:28'),
(179, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-30 12:27:28', '2026-07-30 12:27:28'),
(180, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 0, '2026-07-30 12:28:21', '2026-07-30 12:28:21'),
(181, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-30 12:28:44', '2026-07-30 12:28:44'),
(182, 1, NULL, 'Pembayaran Ditolak', 'Bukti pembayaran ditolak. Silakan upload ulang bukti pembayaran.', 0, '2026-07-30 12:29:13', '2026-07-30 12:29:13'),
(183, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-30 12:36:34', '2026-07-30 12:36:34'),
(184, 1, NULL, 'Pembayaran Diterima', 'Pembayaran Anda telah diverifikasi. Pesanan siap diproses admin.', 0, '2026-07-30 12:36:57', '2026-07-30 12:36:57'),
(185, 1, NULL, 'Penyewaan Berhasil', 'Silakan lakukan pembayaran agar penyewaan diproses Admin.', 0, '2026-07-30 12:38:20', '2026-07-30 12:38:20'),
(186, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-30 12:38:47', '2026-07-30 12:38:47'),
(187, 1, NULL, 'Pembayaran Ditolak', 'Bukti pembayaran ditolak. Silakan upload ulang bukti pembayaran.', 0, '2026-07-30 12:39:28', '2026-07-30 12:39:28'),
(188, 1, NULL, 'Bukti Pembayaran Dikirim', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.', 0, '2026-07-30 12:40:28', '2026-07-30 12:40:28'),
(189, 1, NULL, 'Pembayaran Diterima', 'Pembayaran Anda telah diverifikasi. Pesanan siap diproses admin.', 0, '2026-07-30 12:40:56', '2026-07-30 12:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `page_views`
--

CREATE TABLE `page_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_views`
--

INSERT INTO `page_views` (`id`, `page`, `created_at`, `updated_at`) VALUES
(1, 'camping', '2026-07-28 20:57:14', '2026-07-28 20:57:14'),
(4, 'camping', '2026-07-29 00:33:13', '2026-07-29 00:33:13'),
(5, 'camping', '2026-07-29 01:45:46', '2026-07-29 01:45:46'),
(6, 'camping', '2026-07-29 17:24:41', '2026-07-29 17:24:41'),
(7, 'camping', '2026-07-30 07:20:57', '2026-07-30 07:20:57'),
(8, 'camping', '2026-07-30 12:26:16', '2026-07-30 12:26:16');

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rental_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `remaining_payment_proof` varchar(255) DEFAULT NULL,
  `status` enum('Belum Bayar','Menunggu Verifikasi','Menunggu Verifikasi Pelunasan','Deposit Diterima','Cash Saat Pengambilan','Lunas','Ditolak') NOT NULL DEFAULT 'Belum Bayar',
  `amount` decimal(12,2) NOT NULL,
  `admin_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_type` enum('deposit','remaining','full') NOT NULL DEFAULT 'deposit',
  `amount_paid` decimal(12,2) NOT NULL DEFAULT 0.00,
  `remaining_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `deposit_deadline` date DEFAULT NULL,
  `final_payment_proof` varchar(255) DEFAULT NULL,
  `final_payment_status` enum('Belum Bayar','Menunggu Verifikasi','Diterima','Ditolak') NOT NULL DEFAULT 'Belum Bayar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `rental_id`, `payment_method`, `payment_proof`, `remaining_payment_proof`, `status`, `amount`, `admin_note`, `created_at`, `updated_at`, `payment_type`, `amount_paid`, `remaining_amount`, `deposit_deadline`, `final_payment_proof`, `final_payment_status`) VALUES
(1, 8, 'Transfer Bank', 'payments/c8Z7ycvB9Ujyamfe1RwaMreXvmNh3T6nA6tp6wVZ.png', NULL, 'Deposit Diterima', 15000.00, NULL, '2026-07-26 14:31:22', '2026-07-27 17:08:49', 'deposit', 1500.00, 13500.00, '2026-07-27', NULL, 'Belum Bayar'),
(2, 9, 'Transfer Bank', 'payments/FTRziGbrZJYqjb9I8hh2rkERUkP6lRdBmucrkNRS.png', NULL, 'Lunas', 295000.00, NULL, '2026-07-26 15:58:17', '2026-07-27 17:31:17', 'full', 295000.00, 0.00, '2026-07-28', NULL, 'Belum Bayar'),
(3, 10, 'Transfer Bank', 'payments/o1VVLGP5XviX7zCmBPC6GurJI1tQL79XQBsRGlnK.png', NULL, 'Deposit Diterima', 420000.00, NULL, '2026-07-27 01:53:23', '2026-07-27 16:10:36', 'deposit', 42000.00, 378000.00, '2026-07-29', NULL, 'Belum Bayar'),
(4, 11, 'Transfer Bank', 'payments/qqRQXQ3X7ICqxGB77TEw5hWg8qxwKjDazGesSWbh.png', NULL, 'Lunas', 175000.00, NULL, '2026-07-27 17:06:05', '2026-07-27 17:14:00', 'full', 175000.00, 0.00, '2026-07-29', NULL, 'Belum Bayar'),
(5, 12, 'Transfer Bank', 'payments/WJFKF26WMujQrNBi09XqsR2FhRO8UTR89489CMYI.png', 'payments/Mm6K4KtmaTX2ao8MrTue9yeLD5pgsYOdfXFVAvPI.png', 'Menunggu Verifikasi Pelunasan', 60000.00, NULL, '2026-07-27 17:32:50', '2026-07-27 18:00:39', 'deposit', 6000.00, 54000.00, '2026-07-30', NULL, 'Belum Bayar'),
(6, 13, 'Transfer Bank', 'payments/ThlNIl9mbghIiFCyjXsrwYiXR79ZKfzd8DOUlEeh.png', 'payments/J1RPQxrspi9Ubh2nBdHgPnrg84UUwqVk5tWFjUxX.png', 'Menunggu Verifikasi Pelunasan', 100000.00, NULL, '2026-07-27 18:04:04', '2026-07-27 18:07:32', 'deposit', 10000.00, 90000.00, '2026-08-03', NULL, 'Belum Bayar'),
(7, 14, 'Transfer Bank', 'payments/KeqQiegjOiFhoBcSATsSDoudMF7cixXFG4WCSaj9.png', NULL, 'Cash Saat Pengambilan', 100000.00, NULL, '2026-07-27 19:03:37', '2026-07-27 19:05:06', 'deposit', 10000.00, 90000.00, '2026-07-28', NULL, 'Belum Bayar'),
(8, 15, 'Transfer Bank', 'payments/KtuiyINoRJ2VjzBm04syRBy9lnxFKEiUa2rNHkFm.png', NULL, 'Lunas', 140000.00, NULL, '2026-07-27 19:25:46', '2026-07-28 16:49:09', 'deposit', 140000.00, 0.00, '2026-08-01', NULL, 'Belum Bayar'),
(9, 16, 'Transfer Bank', 'payments/J7qXsgvlhQYubcC2t3s1asxDo4BG0Frt8llEz1K6.png', 'payments/0y1nfw8bqcGXa6nul7HqYqXtpqH7GwdJcK1Q9zMB.png', 'Lunas', 200000.00, NULL, '2026-07-27 19:29:50', '2026-07-28 16:42:21', 'deposit', 200000.00, 0.00, '2026-08-03', NULL, 'Belum Bayar'),
(10, 17, 'Transfer Bank', 'payments/XJW19J9PnOcAOWCQ7ziz2A35I5OaVKvKIykJYc6t.png', 'payments/cFmCQIBfgquyS5Sd61YyUPalxajek8eIX8YUSMsF.png', 'Menunggu Verifikasi Pelunasan', 105000.00, NULL, '2026-07-28 16:19:21', '2026-07-28 16:21:02', 'deposit', 10500.00, 94500.00, '2026-07-31', NULL, 'Belum Bayar'),
(11, 18, 'Transfer Bank', 'payments/EXc0RX0TxCEXBM75xOpJdKAIrDsOMZGUEBlyvPEY.png', 'payments/LYmyfujarAEtbe7wQeOt1OaXEyGhmrk7zOYmKl8z.png', 'Lunas', 180000.00, NULL, '2026-07-28 16:36:09', '2026-07-28 16:38:01', 'deposit', 180000.00, 0.00, '2026-08-02', NULL, 'Belum Bayar'),
(12, 19, 'Transfer Bank', 'payments/lsu4USMS6XGiNisRWIgmd6GnIEp9cQ8y28GuBy5p.png', NULL, 'Lunas', 80000.00, NULL, '2026-07-28 16:55:19', '2026-07-28 16:56:07', 'full', 80000.00, 0.00, '2026-07-29', NULL, 'Belum Bayar'),
(13, 20, 'Dana', 'payments/1VKiNXCoZYTiyk5nfuI14KM8mHmnOXfP3JRsLtEO.png', 'payments/fhI4USfm5oUb6I99wYOjAnwThi9PAn6AUMI2I3jG.png', 'Lunas', 75000.00, NULL, '2026-07-28 17:05:02', '2026-07-28 17:07:12', 'deposit', 75000.00, 0.00, '2026-08-02', NULL, 'Belum Bayar'),
(14, 21, 'Transfer Bank', 'payments/ydvFuHyLssJghxOrqFcGGCFWMnm0RhVv6hvsfQQU.png', NULL, 'Lunas', 200000.00, NULL, '2026-07-28 17:08:37', '2026-07-28 18:06:24', 'deposit', 200000.00, 0.00, '2026-08-04', NULL, 'Belum Bayar'),
(15, 22, 'Transfer Bank', 'payments/Xc5r6esBBg1hAplTDWHCrTPBRqqQwgy4D2XkK90C.png', NULL, 'Lunas', 140000.00, NULL, '2026-07-28 18:09:00', '2026-07-28 18:11:17', 'deposit', 140000.00, 0.00, '2026-08-03', NULL, 'Belum Bayar'),
(16, 23, 'Transfer Bank', 'payments/HNLp9kcaQTmoZRnNU0cgclUs5xJHORRAy1l8w17J.png', NULL, 'Lunas', 80000.00, NULL, '2026-07-28 18:22:41', '2026-07-28 18:24:01', 'deposit', 80000.00, 0.00, '2026-08-04', NULL, 'Belum Bayar'),
(17, 24, 'Transfer Bank', 'payments/MQ2uNObOkGbLx8L7JgcMN53n98lSHkwoIDXnTXyN.png', NULL, 'Lunas', 240000.00, NULL, '2026-07-28 18:25:40', '2026-07-28 18:27:26', 'full', 240000.00, 0.00, '2026-08-03', NULL, 'Belum Bayar'),
(18, 25, 'Transfer Bank', 'payments/k5HenW9krCsLSPZoHc73qzaIpnKQ975027XyR8Um.png', NULL, 'Lunas', 80000.00, NULL, '2026-07-28 18:35:09', '2026-07-28 18:35:47', 'full', 80000.00, 0.00, '2026-08-03', NULL, 'Belum Bayar'),
(19, 26, 'Transfer Bank', 'payments/UiLqulGRFYZVOlpqHYI7gmoM03Xdt11soxT01Zmy.png', 'payments/0roFXLDWzxxP0U3isQSyUMwZxhzYtC1C9dFyFTvA.png', 'Lunas', 88000.00, NULL, '2026-07-28 21:08:50', '2026-07-29 17:24:14', 'deposit', 88000.00, 0.00, '2026-07-30', NULL, 'Belum Bayar'),
(20, 27, 'Transfer Bank', 'payments/PGQfRXD06UQcusNPpLTu0BoBz6DWCitenWvaKSsD.png', 'payments/pY42Fw68tQblyOe1atrQ0lzsgqOReMzVU0OvvY3J.png', 'Lunas', 100000.00, NULL, '2026-07-28 21:28:17', '2026-07-28 21:35:16', 'deposit', 100000.00, 0.00, '2026-07-30', NULL, 'Belum Bayar'),
(21, 28, 'Transfer Bank', 'payments/tNatIaNYqxmTAlNIwDZ2uOEMG4hKIYIgkp6WkTLU.png', 'payments/T9aca4d2621u6nt4ikT4UoDGnRp3XVLtgmKyci40.png', 'Lunas', 295000.00, NULL, '2026-07-29 00:35:51', '2026-07-29 01:29:10', 'deposit', 295000.00, 0.00, '2026-08-04', NULL, 'Belum Bayar'),
(22, 29, 'Dana', 'payments/F68Gvvv1RqHhc1kiZEMFlHIO7R2KARPjMMnSahBi.png', 'payments/qW8Qqxr30i3yqwO75wyH5kOFZst95fE2zkLSdt70.png', 'Menunggu Verifikasi Pelunasan', 75000.00, 'bukti transfer kurang jelas silakan lakukan pemesanan kembali dengan melampirkan bukti yg jelas', '2026-07-29 17:25:51', '2026-07-29 17:55:47', 'deposit', 7500.00, 67500.00, '2026-08-04', NULL, 'Belum Bayar'),
(23, 30, 'Transfer Bank', 'payments/WSP43OCVKNfWYwd5SVlu9PFAixcErhcZkPdlHJDC.png', NULL, 'Lunas', 120000.00, NULL, '2026-07-29 18:19:10', '2026-07-29 18:20:01', 'full', 120000.00, 0.00, '2026-08-03', NULL, 'Belum Bayar'),
(24, 31, 'Transfer Bank', 'payments/xKOjoQes1GEWZr00xiGEkYTaU19BmjgQburd72pG.png', 'payments/GMx8XWhDmhyvLjRS4bLJ96QF3DBPL7JmBIB5PSBA.png', 'Lunas', 90000.00, NULL, '2026-07-29 19:01:21', '2026-07-29 19:03:38', 'deposit', 90000.00, 0.00, '2026-08-05', NULL, 'Belum Bayar'),
(25, 32, 'Transfer Bank', 'payments/dlq6FyA1DHIstIVoK0ASmqpATgP5xDiXpbyNdTaz.png', NULL, 'Lunas', 100000.00, 'butki ga jelas', '2026-07-30 07:21:47', '2026-07-30 07:25:37', 'deposit', 100000.00, 0.00, '2026-08-03', NULL, 'Belum Bayar'),
(26, 33, 'Transfer Bank', 'payments/yZTMxjBi5OPWpOKFocG7qCPT1e9sSWkwRF9iX0s2.png', 'payments/NwfwootCqfjJVxjbPwtNtKsddsOJHcRsuH9zi7jX.png', 'Menunggu Verifikasi Pelunasan', 260000.00, 'bukti kurang jelas', '2026-07-30 07:54:06', '2026-07-30 08:07:57', 'full', 260000.00, 0.00, '2026-08-04', NULL, 'Belum Bayar'),
(27, 34, 'Transfer Bank', 'payments/QKjqEjzMDCsHMMvc7Wd637g5yLsGxoMkQ5WoxuON.png', NULL, 'Deposit Diterima', 360000.00, NULL, '2026-07-30 08:15:02', '2026-07-30 08:24:31', 'deposit', 36000.00, 324000.00, '2026-08-04', NULL, 'Belum Bayar'),
(28, 35, 'Transfer Bank', 'payments/aFDZLJIPNfIPdCH4PLn2CaklkQnslUcf3vWl5bfv.png', NULL, 'Menunggu Verifikasi', 200000.00, 'bukti kurang jelas silakakn upload ulang', '2026-07-30 08:25:43', '2026-07-30 12:27:28', 'deposit', 20000.00, 180000.00, '2026-08-04', NULL, 'Belum Bayar'),
(29, 36, 'Transfer Bank', 'payments/EoroUCU7DErYQC88l3KQmH8CI7nt07oivvbrgGxP.png', NULL, 'Lunas', 125000.00, NULL, '2026-07-30 12:28:21', '2026-07-30 12:36:57', 'full', 125000.00, 0.00, '2026-08-04', NULL, 'Belum Bayar'),
(30, 37, 'Transfer Bank', 'payments/5RUaHjE2dWMbbM4vM8On5tfNd2IL5xyBpTJ5BuqW.png', NULL, 'Lunas', 140000.00, NULL, '2026-07-30 12:38:20', '2026-07-30 12:40:56', 'full', 140000.00, 0.00, '2026-09-03', NULL, 'Belum Bayar');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `rental_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `rental_days` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `pickup_method` enum('Diambil','Dikirim') NOT NULL DEFAULT 'Diambil',
  `delivery_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `payment_status` enum('Belum Bayar','Menunggu Verifikasi','Diterima','Ditolak') NOT NULL DEFAULT 'Belum Bayar',
  `pickup_deadline` date DEFAULT NULL,
  `pickup_deadline_time` time DEFAULT NULL,
  `admin_note` text DEFAULT NULL,
  `total_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status` enum('menunggu','menunggu_pelunasan','disetujui','diproses','dikirim','siap_diambil','dipinjam','selesai','dibatalkan') NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deposit_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `remaining_payment` decimal(12,2) NOT NULL DEFAULT 0.00,
  `deposit_deadline` date DEFAULT NULL,
  `deposit_paid_at` timestamp NULL DEFAULT NULL,
  `deposit_status` enum('belum_bayar','menunggu_verifikasi','lunas','kadaluarsa') NOT NULL DEFAULT 'belum_bayar',
  `returned_at` date DEFAULT NULL,
  `late_days` int(11) NOT NULL DEFAULT 0,
  `late_fee` decimal(12,2) NOT NULL DEFAULT 0.00,
  `late_fee_status` enum('Belum Ada','Belum Dibayar','Lunas') NOT NULL DEFAULT 'Belum Ada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`id`, `user_id`, `start_date`, `rental_date`, `return_date`, `rental_days`, `phone`, `address`, `pickup_method`, `delivery_fee`, `payment_method`, `payment_proof`, `payment_status`, `pickup_deadline`, `pickup_deadline_time`, `admin_note`, `total_price`, `status`, `created_at`, `updated_at`, `deposit_amount`, `remaining_payment`, `deposit_deadline`, `deposit_paid_at`, `deposit_status`, `returned_at`, `late_days`, `late_fee`, `late_fee_status`) VALUES
(1, 2, NULL, '2026-07-01', '2026-07-09', 0, '', '', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 400.00, '', '2026-06-30 07:34:33', '2026-07-03 15:03:12', 0.00, 0.00, NULL, NULL, 'belum_bayar', NULL, 0, 0.00, 'Belum Ada'),
(2, 2, NULL, '2026-06-08', '2026-06-10', 0, '', '', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 70000.00, 'selesai', '2026-07-02 05:11:11', '2026-07-03 14:55:58', 0.00, 0.00, NULL, NULL, 'belum_bayar', NULL, 0, 0.00, 'Belum Ada'),
(3, 2, NULL, '2026-07-03', '2026-07-04', 0, '', '', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 105000.00, 'selesai', '2026-07-03 02:29:10', '2026-07-03 04:00:26', 0.00, 0.00, NULL, NULL, 'belum_bayar', NULL, 0, 0.00, 'Belum Ada'),
(4, 2, NULL, '2026-07-04', '2026-07-05', 0, '', '', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 60000.00, 'selesai', '2026-07-03 14:02:16', '2026-07-03 14:55:33', 0.00, 0.00, NULL, NULL, 'belum_bayar', NULL, 0, 0.00, 'Belum Ada'),
(5, 1, NULL, '2026-07-04', '2026-07-05', 0, '', '', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 40000.00, 'menunggu', '2026-07-03 14:24:59', '2026-07-03 14:24:59', 0.00, 0.00, NULL, NULL, 'belum_bayar', NULL, 0, 0.00, 'Belum Ada'),
(6, 1, NULL, '2026-07-04', '2026-07-05', 0, '', '', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 40000.00, 'menunggu', '2026-07-03 14:26:37', '2026-07-03 14:26:37', 0.00, 0.00, NULL, NULL, 'belum_bayar', NULL, 0, 0.00, 'Belum Ada'),
(8, 1, '2026-07-29', '2026-07-29', '2026-07-30', 1, '085224252627', 'jln karo', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 15000.00, 'menunggu_pelunasan', '2026-07-26 14:31:22', '2026-07-27 17:08:49', 1500.00, 13500.00, '2026-07-27', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(9, 1, '2026-07-30', '2026-07-30', '2026-08-04', 5, '085224252627', 'jln buto no56', 'Dikirim', 20000.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 275000.00, 'disetujui', '2026-07-26 15:58:17', '2026-07-27 17:31:17', 29500.00, 0.00, '2026-07-28', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(10, 1, '2026-07-31', '2026-07-31', '2026-08-04', 4, '085224252627', 'jln karo', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 420000.00, 'diproses', '2026-07-27 01:53:23', '2026-07-27 17:00:05', 42000.00, 378000.00, '2026-07-29', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(11, 1, '2026-07-31', '2026-07-31', '2026-08-05', 5, '085224252627', 'jln karo', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 175000.00, 'disetujui', '2026-07-27 17:06:05', '2026-07-27 17:14:00', 17500.00, 0.00, '2026-07-29', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(12, 1, '2026-08-01', '2026-08-01', '2026-08-05', 4, '085224252627', 'jln kotu', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 60000.00, 'diproses', '2026-07-27 17:32:50', '2026-07-27 17:33:35', 6000.00, 54000.00, '2026-07-30', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(13, 1, '2026-08-05', '2026-08-05', '2026-08-10', 5, '085224252627', 'jln kare', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 100000.00, 'disetujui', '2026-07-27 18:04:04', '2026-07-27 18:07:06', 10000.00, 90000.00, '2026-08-03', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(14, 1, '2026-07-30', '2026-07-30', '2026-08-03', 4, '085224252627', 'jln mute', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 100000.00, 'disetujui', '2026-07-27 19:03:37', '2026-07-27 19:04:18', 10000.00, 90000.00, '2026-07-28', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(15, 1, '2026-08-03', '2026-07-28', '2026-08-01', 4, '085224252627', 'jln mk', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', '2026-07-29', '17:00:00', NULL, 140000.00, 'selesai', '2026-07-27 19:25:46', '2026-07-28 16:49:40', 14000.00, 0.00, '2026-08-01', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(16, 1, '2026-08-05', '2026-07-28', '2026-08-01', 4, '085224252627', 'jln mj', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', '2026-07-29', '17:00:00', NULL, 200000.00, 'selesai', '2026-07-27 19:29:50', '2026-07-28 16:47:33', 20000.00, 0.00, '2026-08-03', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(17, 1, '2026-08-02', '2026-08-02', '2026-08-05', 3, '085224252627', 'jln karo', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 105000.00, 'diproses', '2026-07-28 16:19:21', '2026-07-28 16:20:34', 10500.00, 94500.00, '2026-07-31', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(18, 1, '2026-08-04', '2026-07-28', '2026-07-31', 3, '085224252627', 'jln kute', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', '2026-07-29', '17:00:00', NULL, 180000.00, 'selesai', '2026-07-28 16:36:09', '2026-07-28 16:41:30', 18000.00, 0.00, '2026-08-02', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(19, 1, '2026-07-31', '2026-07-28', '2026-08-01', 4, '085224252627', 'jln muto no 9', 'Dikirim', 20000.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 60000.00, 'dipinjam', '2026-07-28 16:55:19', '2026-07-28 16:57:59', 8000.00, 0.00, '2026-07-29', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(20, 1, '2026-08-04', '2026-08-04', '2026-08-07', 3, '085224252627', 'jln turo no 9', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', '2026-07-30', '17:00:00', NULL, 75000.00, 'siap_diambil', '2026-07-28 17:05:02', '2026-07-28 17:07:24', 7500.00, 0.00, '2026-08-02', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(21, 1, '2026-08-06', '2026-07-29', '2026-08-02', 4, '085224252627', 'jln kato', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', '2026-07-30', '17:00:00', NULL, 200000.00, 'selesai', '2026-07-28 17:08:37', '2026-07-28 18:52:06', 20000.00, 0.00, '2026-08-04', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(22, 1, '2026-08-05', '2026-08-05', '2026-08-09', 4, '085224252627', 'jnl mute no 89', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', '2026-07-30', '17:00:00', NULL, 140000.00, 'siap_diambil', '2026-07-28 18:09:00', '2026-07-28 18:11:35', 14000.00, 0.00, '2026-08-03', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(23, 1, '2026-08-06', '2026-07-29', '2026-08-02', 4, '085224252627', 'jln kari no 9', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', '2026-07-30', '17:00:00', NULL, 80000.00, 'dipinjam', '2026-07-28 18:22:41', '2026-07-28 18:24:06', 8000.00, 0.00, '2026-08-04', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(24, 1, '2026-08-05', '2026-07-29', '2026-08-02', 4, '085224252627', 'jln kuto no 9', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', '2026-07-30', '17:00:00', NULL, 240000.00, 'selesai', '2026-07-28 18:25:40', '2026-07-28 19:05:08', 24000.00, 0.00, '2026-08-03', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(25, 1, '2026-08-05', '2026-08-05', '2026-08-10', 5, '085224252627', 'jln kuta no 9', 'Dikirim', 20000.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 60000.00, 'dikirim', '2026-07-28 18:35:09', '2026-07-28 18:36:20', 8000.00, 0.00, '2026-08-03', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(26, 1, '2026-08-01', '2026-08-01', '2026-08-05', 4, '085224252627', 'jln mute', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 88000.00, 'diproses', '2026-07-28 21:08:50', '2026-07-29 17:24:14', 8800.00, 0.00, '2026-07-30', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(27, 1, '2026-08-01', '2026-07-29', '2026-08-02', 4, '085224252627', 'jln mute', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', '2026-07-30', '17:00:00', NULL, 100000.00, 'dipinjam', '2026-07-28 21:28:17', '2026-07-29 00:34:43', 10000.00, 0.00, '2026-07-30', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(28, 1, '2026-08-06', '2026-08-06', '2026-08-11', 5, '085224252627', 'jln karo', 'Dikirim', 20000.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 275000.00, 'dikirim', '2026-07-29 00:35:51', '2026-07-29 01:30:27', 29500.00, 0.00, '2026-08-04', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(29, 1, '2026-08-06', '2026-08-06', '2026-08-11', 5, '085224252627', 'jln muto rumah no 5', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 75000.00, 'diproses', '2026-07-29 17:25:51', '2026-07-29 17:55:06', 7500.00, 67500.00, '2026-08-04', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(30, 1, '2026-08-05', '2026-07-30', '2026-08-02', 3, '085224252627', 'jln kari rmh no 9', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', '2026-07-31', '17:00:00', NULL, 120000.00, 'dipinjam', '2026-07-29 18:19:10', '2026-07-29 19:00:04', 12000.00, 0.00, '2026-08-03', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(31, 1, '2026-08-07', '2026-08-07', '2026-08-09', 2, '085224252627', 'jln karo', 'Dikirim', 20000.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 70000.00, 'dikirim', '2026-07-29 19:01:21', '2026-07-29 19:03:44', 9000.00, 0.00, '2026-08-05', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(32, 1, '2026-08-05', '2026-07-30', '2026-08-03', 4, '085224252627', 'jln karo rumah no 78', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', '2026-07-31', '17:00:00', NULL, 100000.00, 'selesai', '2026-07-30 07:21:47', '2026-07-30 07:25:59', 10000.00, 0.00, '2026-08-03', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(33, 1, '2026-08-06', '2026-08-06', '2026-08-10', 4, '085224252627', 'jln weru rmh no 5', 'Dikirim', 20000.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 240000.00, 'menunggu', '2026-07-30 07:54:06', '2026-07-30 07:54:06', 26000.00, 234000.00, '2026-08-04', NULL, 'belum_bayar', NULL, 0, 0.00, 'Belum Ada'),
(34, 1, '2026-08-06', '2026-08-06', '2026-08-10', 4, '085224252627', 'jln weru rmh no 5', 'Dikirim', 20000.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 340000.00, 'diproses', '2026-07-30 08:15:02', '2026-07-30 08:24:39', 36000.00, 324000.00, '2026-08-04', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(35, 1, '2026-08-06', '2026-08-06', '2026-08-10', 4, '085224252627', 'jln karo', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 200000.00, 'menunggu', '2026-07-30 08:25:43', '2026-07-30 08:25:43', 20000.00, 180000.00, '2026-08-04', NULL, 'belum_bayar', NULL, 0, 0.00, 'Belum Ada'),
(36, 1, '2026-08-06', '2026-08-06', '2026-08-11', 5, '085224252627', 'jln karo', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 125000.00, 'disetujui', '2026-07-30 12:28:21', '2026-07-30 12:36:57', 12500.00, 0.00, '2026-08-04', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada'),
(37, 1, '2026-09-05', '2026-09-05', '2026-09-09', 4, '085224252627', 'jln weru', 'Diambil', 0.00, NULL, NULL, 'Belum Bayar', NULL, NULL, NULL, 140000.00, 'disetujui', '2026-07-30 12:38:20', '2026-07-30 12:40:56', 14000.00, 0.00, '2026-09-03', NULL, 'lunas', NULL, 0, 0.00, 'Belum Ada');

-- --------------------------------------------------------

--
-- Table structure for table `rental_details`
--

CREATE TABLE `rental_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rental_id` bigint(20) UNSIGNED NOT NULL,
  `equipment_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rental_details`
--

INSERT INTO `rental_details` (`id`, `rental_id`, `equipment_id`, `quantity`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
(2, 2, 2, 1, 35000.00, 70000.00, '2026-07-02 05:11:11', '2026-07-02 05:11:11'),
(3, 3, 2, 1, 35000.00, 35000.00, '2026-07-03 02:29:10', '2026-07-03 02:29:10'),
(4, 3, 3, 1, 50000.00, 50000.00, '2026-07-03 02:29:10', '2026-07-03 02:29:10'),
(5, 3, 4, 1, 20000.00, 20000.00, '2026-07-03 02:29:10', '2026-07-03 02:29:10'),
(6, 4, 2, 1, 35000.00, 35000.00, '2026-07-03 14:02:16', '2026-07-03 14:02:16'),
(7, 4, 5, 1, 25000.00, 25000.00, '2026-07-03 14:02:16', '2026-07-03 14:02:16'),
(8, 5, 5, 1, 25000.00, 25000.00, '2026-07-03 14:24:59', '2026-07-03 14:24:59'),
(9, 5, 6, 1, 15000.00, 15000.00, '2026-07-03 14:24:59', '2026-07-03 14:24:59'),
(10, 6, 5, 1, 25000.00, 25000.00, '2026-07-03 14:26:37', '2026-07-03 14:26:37'),
(11, 6, 6, 1, 15000.00, 15000.00, '2026-07-03 14:26:37', '2026-07-03 14:26:37'),
(13, 8, 6, 1, 15000.00, 15000.00, '2026-07-26 14:31:22', '2026-07-26 14:31:22'),
(14, 9, 10, 1, 40000.00, 200000.00, '2026-07-26 15:58:17', '2026-07-26 15:58:17'),
(15, 9, 11, 1, 15000.00, 75000.00, '2026-07-26 15:58:17', '2026-07-26 15:58:17'),
(16, 10, 3, 1, 50000.00, 200000.00, '2026-07-27 01:53:23', '2026-07-27 01:53:23'),
(17, 10, 9, 1, 55000.00, 220000.00, '2026-07-27 01:53:23', '2026-07-27 01:53:23'),
(18, 11, 2, 1, 35000.00, 175000.00, '2026-07-27 17:06:05', '2026-07-27 17:06:05'),
(19, 12, 6, 1, 15000.00, 60000.00, '2026-07-27 17:32:50', '2026-07-27 17:32:50'),
(20, 13, 4, 1, 20000.00, 100000.00, '2026-07-27 18:04:04', '2026-07-27 18:04:04'),
(21, 14, 5, 1, 25000.00, 100000.00, '2026-07-27 19:03:37', '2026-07-27 19:03:37'),
(22, 15, 2, 1, 35000.00, 140000.00, '2026-07-27 19:25:46', '2026-07-27 19:25:46'),
(23, 16, 7, 1, 50000.00, 200000.00, '2026-07-27 19:29:50', '2026-07-27 19:29:50'),
(24, 17, 21, 1, 35000.00, 105000.00, '2026-07-28 16:19:21', '2026-07-28 16:19:21'),
(25, 18, 8, 1, 60000.00, 180000.00, '2026-07-28 16:36:09', '2026-07-28 16:36:09'),
(26, 19, 11, 1, 15000.00, 60000.00, '2026-07-28 16:55:19', '2026-07-28 16:55:19'),
(27, 20, 15, 1, 25000.00, 75000.00, '2026-07-28 17:05:02', '2026-07-28 17:05:02'),
(28, 21, 3, 1, 50000.00, 200000.00, '2026-07-28 17:08:37', '2026-07-28 17:08:37'),
(29, 22, 2, 1, 35000.00, 140000.00, '2026-07-28 18:09:00', '2026-07-28 18:09:00'),
(30, 23, 4, 1, 20000.00, 80000.00, '2026-07-28 18:22:41', '2026-07-28 18:22:41'),
(31, 24, 8, 1, 60000.00, 240000.00, '2026-07-28 18:25:40', '2026-07-28 18:25:40'),
(32, 25, 14, 1, 12000.00, 60000.00, '2026-07-28 18:35:09', '2026-07-28 18:35:09'),
(33, 26, 24, 1, 22000.00, 88000.00, '2026-07-28 21:08:50', '2026-07-28 21:08:50'),
(34, 27, 25, 1, 25000.00, 100000.00, '2026-07-28 21:28:17', '2026-07-28 21:28:17'),
(35, 28, 18, 1, 30000.00, 150000.00, '2026-07-29 00:35:51', '2026-07-29 00:35:51'),
(36, 28, 19, 1, 25000.00, 125000.00, '2026-07-29 00:35:51', '2026-07-29 00:35:51'),
(37, 29, 12, 1, 15000.00, 75000.00, '2026-07-29 17:25:51', '2026-07-29 17:25:51'),
(38, 30, 22, 1, 40000.00, 120000.00, '2026-07-29 18:19:10', '2026-07-29 18:19:10'),
(39, 31, 16, 1, 35000.00, 70000.00, '2026-07-29 19:01:21', '2026-07-29 19:01:21'),
(40, 32, 25, 1, 25000.00, 100000.00, '2026-07-30 07:21:47', '2026-07-30 07:21:47'),
(41, 33, 8, 1, 60000.00, 240000.00, '2026-07-30 07:54:06', '2026-07-30 07:54:06'),
(42, 34, 8, 1, 60000.00, 240000.00, '2026-07-30 08:15:02', '2026-07-30 08:15:02'),
(43, 34, 27, 1, 25000.00, 100000.00, '2026-07-30 08:15:02', '2026-07-30 08:15:02'),
(44, 35, 3, 1, 50000.00, 200000.00, '2026-07-30 08:25:43', '2026-07-30 08:25:43'),
(45, 36, 5, 1, 25000.00, 125000.00, '2026-07-30 12:28:21', '2026-07-30 12:28:21'),
(46, 37, 2, 1, 35000.00, 140000.00, '2026-07-30 12:38:20', '2026-07-30 12:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rental_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `rental_id`, `rating`, `comment`, `photo`, `created_at`, `updated_at`) VALUES
(1, 1, 18, 5, 'barang yg disewakan sangat bekualitasdan bagus', '1785257106.jpg', '2026-07-28 16:45:06', '2026-07-28 16:45:06'),
(2, 1, 16, 5, 'barangnya  nyaman', NULL, '2026-07-28 16:51:11', '2026-07-28 16:51:11'),
(3, 1, 21, 5, 'cukup nyaman', NULL, '2026-07-28 18:52:31', '2026-07-28 18:52:31'),
(4, 1, 24, 5, 'tendanya sangat nyaman di pakai', '1785265553.jpg', '2026-07-28 19:05:53', '2026-07-28 19:05:53'),
(5, 1, 15, 4, 'lumayan bagus', NULL, '2026-07-28 20:30:55', '2026-07-28 20:30:55'),
(6, 2, 2, 5, 'tas nya keren', NULL, '2026-07-29 01:46:53', '2026-07-29 01:46:53'),
(7, 2, 3, 5, 'gak nyesel deh nyewa di sini, semua nya bagus\"', NULL, '2026-07-29 01:48:21', '2026-07-29 01:48:21');

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
('AGcQEsNIGXm9abqkkDOSkm01QZvjsflCNPSyS9Yz', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'eyJfdG9rZW4iOiIzS2sxcDFtVlJEOWhmM0c1d0xvMGR1bzZpSXdyV2p4TFpwWXVyQzYxIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2VxdWlwbWVudCJ9LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL3JlbnRhbHNcLzM3Iiwicm91dGUiOiJyZW50YWxzLnNob3cifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MSwiY2FtcGluZ192aWV3ZWQiOnRydWV9', 1785415258);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pelanggan') NOT NULL DEFAULT 'pelanggan',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@gmail.com', NULL, '$2y$12$Tbc64FvdnEFuhE51ZkfqI.a8pPgcu6MHBKDjqmYgbWzgSZBGdLmqq', 'admin', NULL, '2026-07-26 11:12:44', '2026-07-26 11:12:44'),
(2, 'Akbar', 'akbar@gmail.com', NULL, '$2y$12$2.bQrIRoHNMaA9Tl8piUJOarwvWCAzYZcu2PuAHX.7jG5CT5JAMMO', 'pelanggan', NULL, '2026-06-28 04:51:46', '2026-06-28 04:51:46'),
(3, 'Rudi', 'rudi@gmail.com', NULL, '$2y$12$WSjkF5EKeUD88p1EoJrff.9LGM9arTEEhqrmXzu96GLBtLhmCHGiq', 'pelanggan', NULL, '2026-06-30 07:47:14', '2026-06-30 07:47:14');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `visitor_name` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `visit_date` date NOT NULL,
  `visit_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `user_id`, `visitor_name`, `role`, `visit_date`, `visit_time`, `created_at`, `updated_at`) VALUES
(1, 1, 'Administrator', 'admin', '2026-07-26', '18:32:56', '2026-07-26 11:32:56', '2026-07-26 11:32:56'),
(2, 1, 'Administrator', 'admin', '2026-07-27', '08:42:15', '2026-07-27 01:42:15', '2026-07-27 01:42:15'),
(3, 1, 'Administrator', 'admin', '2026-07-27', '23:10:00', '2026-07-27 16:10:00', '2026-07-27 16:10:00'),
(4, 1, 'Administrator', 'admin', '2026-07-28', '21:50:27', '2026-07-28 14:50:27', '2026-07-28 14:50:27'),
(5, 1, 'Administrator', 'admin', '2026-07-29', '07:32:46', '2026-07-29 00:32:46', '2026-07-29 00:32:46'),
(6, 2, 'Akbar', 'pelanggan', '2026-07-29', '08:45:45', '2026-07-29 01:45:45', '2026-07-29 01:45:45'),
(7, 1, 'Administrator', 'admin', '2026-07-30', '00:19:46', '2026-07-29 17:19:46', '2026-07-29 17:19:46'),
(8, 1, 'Administrator', 'admin', '2026-07-30', '14:20:28', '2026-07-30 07:20:28', '2026-07-30 07:20:28'),
(9, 1, 'Administrator', 'admin', '2026-07-30', '14:20:30', '2026-07-30 07:20:30', '2026-07-30 07:20:30'),
(10, 1, 'Administrator', 'admin', '2026-07-30', '19:25:10', '2026-07-30 12:25:10', '2026-07-30 12:25:10');

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_rental_id_foreign` (`rental_id`),
  ADD KEY `chats_user_id_foreign` (`user_id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_category_id_foreign` (`category_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `notifications_rental_id_foreign` (`rental_id`);

--
-- Indexes for table `page_views`
--
ALTER TABLE `page_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_rental_id_foreign` (`rental_id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rentals_user_id_foreign` (`user_id`);

--
-- Indexes for table `rental_details`
--
ALTER TABLE `rental_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rental_details_rental_id_foreign` (`rental_id`),
  ADD KEY `rental_details_equipment_id_foreign` (`equipment_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_rental_id_foreign` (`rental_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitors_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `page_views`
--
ALTER TABLE `page_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `rental_details`
--
ALTER TABLE `rental_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_rental_id_foreign` FOREIGN KEY (`rental_id`) REFERENCES `rentals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equipment_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_rental_id_foreign` FOREIGN KEY (`rental_id`) REFERENCES `rentals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_rental_id_foreign` FOREIGN KEY (`rental_id`) REFERENCES `rentals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rental_details`
--
ALTER TABLE `rental_details`
  ADD CONSTRAINT `rental_details_equipment_id_foreign` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rental_details_rental_id_foreign` FOREIGN KEY (`rental_id`) REFERENCES `rentals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_rental_id_foreign` FOREIGN KEY (`rental_id`) REFERENCES `rentals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visitors`
--
ALTER TABLE `visitors`
  ADD CONSTRAINT `visitors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
