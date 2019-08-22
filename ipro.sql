-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 22, 2019 at 05:32 AM
-- Server version: 5.5.60-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipro`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `city`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bandung', NULL, NULL, '2019-04-15 00:46:36', '2019-04-15 00:46:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Conwood', '2019-04-15 00:38:17', '2019-04-15 00:38:17', NULL),
(2, 'Shera', '2019-05-02 05:14:36', '2019-05-02 05:14:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL,
  `brand_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `brand_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Kayu', '2019-04-15 00:38:27', '2019-04-15 00:38:27', NULL),
(2, 2, 'Flooring', '2019-05-02 05:15:00', '2019-05-02 05:15:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE IF NOT EXISTS `commissions` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `percentage` int(11) NOT NULL DEFAULT '0',
  `total_commission` int(11) NOT NULL DEFAULT '0',
  `total_commission_not_achieve` int(11) NOT NULL DEFAULT '0',
  `achievement` int(11) NOT NULL DEFAULT '0',
  `achieved` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `period_start` date NOT NULL,
  `period_end` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commissions`
--

INSERT INTO `commissions` (`id`, `user_id`, `percentage`, `total_commission`, `total_commission_not_achieve`, `achievement`, `achieved`, `created_at`, `updated_at`, `deleted_at`, `period_start`, `period_end`) VALUES
(1, 3, 30, 1500, 450, 300000000, 4000000, '2019-07-23 07:59:25', '2019-08-22 03:54:35', NULL, '2019-07-15', '2019-10-14'),
(2, 5, 100, 500, 150, 150000000, 1000000, '2019-08-20 06:20:06', '2019-08-22 03:54:35', NULL, '2019-07-15', '2019-10-14');

-- --------------------------------------------------------

--
-- Table structure for table `commissions_details`
--

CREATE TABLE IF NOT EXISTS `commissions_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `commission` int(11) NOT NULL,
  `commission_not_achieve` int(11) NOT NULL,
  `sales_order_id` int(11) NOT NULL,
  `role` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commissions_details`
--

INSERT INTO `commissions_details` (`id`, `user_id`, `commission`, `commission_not_achieve`, `sales_order_id`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 1500, 450, 3, 'Admin', '2019-08-22 03:54:35', '2019-08-22 03:54:35', NULL),
(2, 5, 500, 150, 3, 'Admin', '2019-08-22 03:54:35', '2019-08-22 03:54:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

CREATE TABLE IF NOT EXISTS `counters` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `counter` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`id`, `name`, `counter`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PO', 2, NULL, '2019-07-29 04:12:21', NULL),
(2, 'SO', 30, NULL, '2019-08-22 03:54:35', NULL),
(3, 'QO', 12, NULL, '2019-08-22 03:22:56', NULL),
(4, 'DO', 15, NULL, '2019-07-24 10:02:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `no_ktp` bigint(20) NOT NULL,
  `npwp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `no_ktp`, `npwp`, `project_owner`, `address`, `phone`, `fax`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1234567891012131, NULL, 'Asep Jeck Sadikin', 'Jalan Kemayu Oke Oce', '08987654321', '0101010101', 'ujeck.sadik@asep.com', '2019-04-15 00:37:50', '2019-04-15 00:37:50', NULL),
(2, 3, 1234567890101112, NULL, 'Mamang Andi', 'Jalan ABC', '012345678', '01010101', 'Mamang@andi.me', '2019-05-02 04:53:12', '2019-05-02 04:53:12', NULL),
(3, 1, 1234567890, '1234567890', 'AA Ariq', '123456789', '1234567890', '1234567890', 'a@a.com', '2019-07-24 08:06:24', '2019-07-24 08:06:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_orders`
--

CREATE TABLE IF NOT EXISTS `delivery_orders` (
  `id` int(11) NOT NULL,
  `nomor_surat` text NOT NULL,
  `sales_order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `mobil` varchar(191) NOT NULL,
  `plat` varchar(191) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_orders`
--

INSERT INTO `delivery_orders` (`id`, `nomor_surat`, `sales_order_id`, `created_at`, `updated_at`, `deleted_at`, `mobil`, `plat`) VALUES
(1, 'DO1907230100001', 1, '2019-07-23 07:48:52', '2019-07-23 07:48:52', NULL, '', ''),
(2, 'DO1907230100001', 1, '2019-07-23 07:49:34', '2019-07-23 07:49:34', NULL, '', ''),
(3, 'DO1907240100002', 1, '2019-07-24 05:29:49', '2019-07-24 05:29:49', NULL, 'Tata', 'D 8078 F'),
(4, 'DO1907240100003', 6, '2019-07-24 09:09:47', '2019-07-24 09:09:47', NULL, 'tata', '123123'),
(5, 'DO1907240100004', 7, '2019-07-24 09:12:29', '2019-07-24 09:12:29', NULL, '123123', '123123'),
(6, 'DO1907240100005', 6, '2019-07-24 09:57:08', '2019-07-24 09:57:08', NULL, '123123', 'aedwadwa'),
(7, 'DO1907240100006', 6, '2019-07-24 09:57:57', '2019-07-24 09:57:57', NULL, '123123', 'aedwadwa'),
(8, 'DO1907240100007', 6, '2019-07-24 09:58:17', '2019-07-24 09:58:17', NULL, '123123', 'aedwadwa'),
(9, 'DO1907240100008', 6, '2019-07-24 09:58:25', '2019-07-24 09:58:25', NULL, '123123', 'aedwadwa'),
(10, 'DO1907240100009', 6, '2019-07-24 09:59:01', '2019-07-24 09:59:01', NULL, '123123', 'aedwadwa'),
(11, 'DO1907240100010', 6, '2019-07-24 09:59:43', '2019-07-24 09:59:43', NULL, '123123', 'aedwadwa'),
(12, 'DO1907240100011', 6, '2019-07-24 10:01:36', '2019-07-24 10:01:36', NULL, '123123', 'aedwadwa'),
(13, 'DO1907240100012', 6, '2019-07-24 10:02:01', '2019-07-24 10:02:01', NULL, '123123', 'aedwadwa'),
(14, 'DO1907240100013', 6, '2019-07-24 10:02:15', '2019-07-24 10:02:15', NULL, '123123', 'aedwadwa'),
(15, 'DO1907240100014', 6, '2019-07-24 10:02:35', '2019-07-24 10:02:35', NULL, '123123', 'aedwadwa');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_order_details`
--

CREATE TABLE IF NOT EXISTS `delivery_order_details` (
  `id` int(11) NOT NULL,
  `do_id` int(11) NOT NULL,
  `qty_kirim` int(11) NOT NULL DEFAULT '0',
  `sales_order_detail_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_order_details`
--

INSERT INTO `delivery_order_details` (`id`, `do_id`, `qty_kirim`, `sales_order_detail_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 1, '2019-07-23 07:48:52', '2019-07-23 07:48:52', NULL),
(2, 2, 2, 1, '2019-07-23 07:49:34', '2019-07-23 07:49:34', NULL),
(3, 2, 0, 2, '2019-07-23 07:49:34', '2019-07-23 07:49:34', NULL),
(4, 3, 1, 2, '2019-07-24 05:29:49', '2019-07-24 05:29:49', NULL),
(5, 4, 2, 8, '2019-07-24 09:09:47', '2019-07-24 09:09:47', NULL),
(6, 4, 2, 9, '2019-07-24 09:09:47', '2019-07-24 09:09:47', NULL),
(7, 5, 5, 10, '2019-07-24 09:12:29', '2019-07-24 09:12:29', NULL),
(8, 6, 0, 8, '2019-07-24 09:57:08', '2019-07-24 09:57:08', NULL),
(9, 6, 1, 9, '2019-07-24 09:57:08', '2019-07-24 09:57:08', NULL),
(10, 7, 0, 8, '2019-07-24 09:57:57', '2019-07-24 09:57:57', NULL),
(11, 7, 1, 9, '2019-07-24 09:57:57', '2019-07-24 09:57:57', NULL),
(12, 8, 0, 8, '2019-07-24 09:58:17', '2019-07-24 09:58:17', NULL),
(13, 8, 1, 9, '2019-07-24 09:58:17', '2019-07-24 09:58:17', NULL),
(14, 9, 0, 8, '2019-07-24 09:58:26', '2019-07-24 09:58:26', NULL),
(15, 9, 1, 9, '2019-07-24 09:58:26', '2019-07-24 09:58:26', NULL),
(16, 10, 0, 8, '2019-07-24 09:59:01', '2019-07-24 09:59:01', NULL),
(17, 10, 1, 9, '2019-07-24 09:59:01', '2019-07-24 09:59:01', NULL),
(18, 11, 0, 8, '2019-07-24 09:59:43', '2019-07-24 09:59:43', NULL),
(19, 11, 0, 9, '2019-07-24 09:59:43', '2019-07-24 09:59:43', NULL),
(20, 12, 0, 8, '2019-07-24 10:01:36', '2019-07-24 10:01:36', NULL),
(21, 12, 0, 9, '2019-07-24 10:01:36', '2019-07-24 10:01:36', NULL),
(22, 13, 0, 8, '2019-07-24 10:02:01', '2019-07-24 10:02:01', NULL),
(23, 13, 0, 9, '2019-07-24 10:02:01', '2019-07-24 10:02:01', NULL),
(24, 14, 0, 8, '2019-07-24 10:02:15', '2019-07-24 10:02:15', NULL),
(25, 15, 0, 8, '2019-07-24 10:02:35', '2019-07-24 10:02:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `holds`
--

CREATE TABLE IF NOT EXISTS `holds` (
  `id` int(10) unsigned NOT NULL,
  `stocks_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_price` double NOT NULL,
  `weight` double NOT NULL,
  `area` double NOT NULL,
  `width` double NOT NULL,
  `height` double NOT NULL,
  `length` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category_id`, `code`, `name`, `purchase_price`, `weight`, `area`, `width`, `height`, `length`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '4.5"', 'Kayu Flooring', 15000, 1, 40, 30, 40, 1.3, '2019-04-15 00:39:30', '2019-04-15 00:39:30', NULL),
(2, 2, 'SDC04', 'Shera Deck 4"', 250000, 2, 2, 2, 2, 2, '2019-05-02 05:16:56', '2019-05-02 05:16:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '2014_10_12_000000_create_users_table', 1),
(13, '2014_10_12_100000_create_password_resets_table', 1),
(14, '2019_02_22_081433_create_brands_table', 1),
(15, '2019_02_22_082116_create_categories_table', 1),
(16, '2019_02_22_082331_create_stocks_table', 1),
(17, '2019_02_22_082522_create_items_table', 1),
(18, '2019_02_22_083022_create_branches_table', 1),
(19, '2019_02_22_083308_create_sales_orders_table', 1),
(20, '2019_02_22_083338_create_sales_order_details_table', 1),
(21, '2019_02_22_085547_create_customers_table', 1),
(22, '2019_02_26_141821_create_holds_table', 1),
(23, '2019_04_16_052454_add_no_order_to_sales_orders', 2),
(24, '2019_04_16_052558_remove_price_from_stocks', 2),
(25, '2019_04_16_052759_remove_price_from_stocks', 3),
(26, '2019_04_16_070223_create_counters_table', 4),
(27, '2019_04_18_065514_add_purchase_id_to_purchase_details', 5),
(28, '2019_04_22_044422_add_sales_id_to_purchase', 6),
(29, '2019_04_22_064525_add_approval_finance_to_purchase_details', 7),
(30, '2019_04_22_064917_add_qty_approval_to_purchase_details', 8),
(31, '2019_04_23_075841_add_notes_to_sales_orders', 9),
(32, '2019_04_24_053539_create_receives_table', 10),
(33, '2019_04_24_054812_add_status_to_purchase_details', 10),
(34, '2019_04_25_085750_add_sales_id_to_purchase_details', 11),
(35, '2019_04_25_085959_drop_sales_id_from_purchases', 11),
(36, '2019_04_26_091247_add_purchase_detail_id_to_receives', 12),
(37, '2019_05_02_170722_create_vendors_table', 13),
(38, '2019_05_23_120829_alter_stocks_table_add_price_branch', 13),
(39, '2019_05_23_134223_alter_sales_orders_table_add_person_in_charge', 13),
(40, '2019_05_23_143152_alter_sales_orders_table_add_grand_total', 13),
(41, '2019_07_03_112728_alter_customers_table_add_npwp', 13),
(42, '2019_07_03_114248_add_tgl_pembayaran_to_sales_orders_table', 13),
(43, '2019_07_03_115053_add_qty_kirim_to_sales_order_details_table', 13),
(44, '2019_07_03_122035_add_qty_kirim_to_delivery_order_details_table', 13),
(45, '2019_07_05_124449_alter_vendors_table_add_image', 13),
(46, '2019_07_18_132215_create_commisions_table', 14),
(47, '2019_07_18_132731_create_settings_table', 14),
(49, '2019_07_18_132825_add_hold_to_table_stock', 15),
(50, '2019_07_19_105110_alter_commisions_to_commissions', 16),
(51, '2019_07_23_160946_add_mobil_to_delivery_orders', 17),
(52, '2019_07_23_163134_add_plat_to_delivery_orders', 17),
(53, '2019_08_01_103600_alter_commissions_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE IF NOT EXISTS `purchases` (
  `id` int(11) NOT NULL,
  `purchase_number` text NOT NULL,
  `approval_status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `purchase_number`, `approval_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PO1907290100001', 1, '2019-08-16 04:10:26', '2019-08-16 04:10:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE IF NOT EXISTS `purchase_details` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `purchase_price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `purchase_id` int(11) NOT NULL,
  `approval_finance` int(11) DEFAULT NULL,
  `qty_approval` int(11) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `sales_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `item_id`, `total_price`, `qty`, `purchase_price`, `created_at`, `updated_at`, `deleted_at`, `purchase_id`, `approval_finance`, `qty_approval`, `status`, `sales_id`) VALUES
(1, 2, 1000000, 4, 250000, '2019-08-16 04:10:25', '2019-08-16 04:10:25', NULL, 1, 1, 4, NULL, NULL),
(2, 1, 15000, 1, 15000, '2019-08-16 04:10:26', '2019-08-16 04:10:26', NULL, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `receives`
--

CREATE TABLE IF NOT EXISTS `receives` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `receipt` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receives`
--

INSERT INTO `receives` (`id`, `purchase_id`, `receipt`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1234567, '2019-08-16 04:10:37', '2019-08-16 04:10:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `receive_details`
--

CREATE TABLE IF NOT EXISTS `receive_details` (
  `id` int(10) unsigned NOT NULL,
  `qty_get` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `receive_id` int(11) DEFAULT NULL,
  `purchase_detail_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receive_details`
--

INSERT INTO `receive_details` (`id`, `qty_get`, `total_price`, `created_at`, `updated_at`, `deleted_at`, `receive_id`, `purchase_detail_id`) VALUES
(1, 4, 1000000, '2019-08-16 04:10:37', '2019-08-16 04:10:37', NULL, 1, 1),
(2, 1, 15000, '2019-08-16 04:10:37', '2019-08-16 04:10:37', NULL, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales_orders`
--

CREATE TABLE IF NOT EXISTS `sales_orders` (
  `id` int(10) unsigned NOT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `quotation_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_pic_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pembayaran` date DEFAULT NULL,
  `grand_total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `no_so` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_order` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ongkir` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_orders`
--

INSERT INTO `sales_orders` (`id`, `customer_id`, `user_id`, `sales_id`, `admin_id`, `quotation_id`, `project`, `pic`, `send_address`, `send_date`, `send_pic_phone`, `payment_method`, `note`, `tgl_pembayaran`, `grand_total`, `created_at`, `updated_at`, `deleted_at`, `no_so`, `notes`, `no_order`, `ongkir`) VALUES
(3, 3, 3, NULL, 5, 'QO1908220100011', '123123', '123123', '123123', '2019-08-22', '123123', 'CBD', 'aaaaaa', '2019-08-14', 5000000, '2019-08-22 03:22:56', '2019-08-22 03:54:35', NULL, 'SO1908220100029', '123', NULL, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_details`
--

CREATE TABLE IF NOT EXISTS `sales_order_details` (
  `id` int(10) unsigned NOT NULL,
  `sales_order_id` int(10) unsigned NOT NULL,
  `stock_id` int(10) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `qty_kirim` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `status` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `komisi_achieve` int(11) NOT NULL DEFAULT '0',
  `komisi_not_achieve` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_order_details`
--

INSERT INTO `sales_order_details` (`id`, `sales_order_id`, `stock_id`, `qty`, `qty_kirim`, `price`, `total`, `discount`, `status`, `created_at`, `updated_at`, `deleted_at`, `komisi_achieve`, `komisi_not_achieve`) VALUES
(1, 2, 1, 3, 0, 10000000, 30000000, 0, 0, '2019-08-20 06:42:53', '2019-08-20 06:42:53', NULL, 0, 0),
(2, 3, 1, 5, 0, 1000000, 5000000, 0, 0, '2019-08-22 03:22:56', '2019-08-22 03:22:56', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'finance-period-start', '15', NULL, NULL, NULL),
(2, 'finance-period-end', '14', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `branch_id` int(10) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_branch` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `hold` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `item_id`, `branch_id`, `quantity`, `price_branch`, `created_at`, `updated_at`, `deleted_at`, `hold`) VALUES
(1, 1, 1, 34, 26000, '2019-04-15 00:59:34', '2019-08-22 03:22:56', NULL, 15),
(2, 2, 1, 20, 340000, '2019-05-02 05:17:20', '2019-08-16 04:10:37', NULL, -2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` int(10) unsigned DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `role`, `branch_id`, `saldo`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@secret.com', 'admin', 1, NULL, NULL, '$2y$10$cdLsZb5WpnNiXYoFJX/GDOHv3JR6hb6jLOf32rkScJO2bnjT3Y7MK', 'rUkMbWEH5pDFRd9Iq1juZOoptSntrKvWJN3PPTZrECASrBaEDKQfdtVELq3R', '2019-04-14 22:33:27', '2019-04-14 22:33:27'),
(2, 'Finance', 'finance', 'finance@ipro.com', 'finance', NULL, NULL, NULL, '$2y$10$JDMsqnwNiB.IVPnj3efrcOd.Hmw2ofnqMm2doheBErfEtDdfjCra.', 'yseYczSEYrStZ3UKnAZABMSxgJY3fbTUnT72U3eTkWVP7r9sMrq5qRvINJDi', '2019-04-21 22:36:50', '2019-04-21 22:36:50'),
(3, 'Sales Bandung', 'Salesbandung', 'sales@bandung.com', 'sales', 1, NULL, NULL, '$2y$10$7P9QRO0rTrwfstxqS7mOVOSDTAIBlTzov0LGsLp2UL606WbUg.20K', 'sIH9XpbWi8qdGRArNmvImhPi2eanRljSpCJJHndCYSLJOGT86dDLlpM00gvV', '2019-05-01 20:34:06', '2019-05-01 21:31:51'),
(4, 'Erlin', 'Erlin', 'Erlin@ipro.com', 'finance', 1, NULL, NULL, '$2y$10$kmtOvJGdaDxmswy1GfrVvu60seKcJvvfypA.j4lVAVHooDNm9BT3.', 'doOrTkkrgI71BBrBxnsTaLjxNbtOuWKWolvMB0xlHZVAbHSm3ZhSeBVWkeI4', '2019-05-02 09:19:22', '2019-05-02 09:19:22'),
(5, 'Head Office', 'headoffice', 'headoffice@ipro.com', 'sales', 1, NULL, NULL, '$2y$10$smyfKe3xm7vY7iwxKuMP/Ouu.QgER.xtdFqKw94UuzuCQIgAQOp9u', NULL, '2019-08-15 13:39:30', '2019-08-15 13:39:30');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int(10) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commissions_details`
--
ALTER TABLE `commissions_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counters`
--
ALTER TABLE `counters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_no_ktp_unique` (`no_ktp`);

--
-- Indexes for table `delivery_orders`
--
ALTER TABLE `delivery_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_order_details`
--
ALTER TABLE `delivery_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holds`
--
ALTER TABLE `holds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receives`
--
ALTER TABLE `receives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receive_details`
--
ALTER TABLE `receive_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_order_details`
--
ALTER TABLE `sales_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `commissions_details`
--
ALTER TABLE `commissions_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `counters`
--
ALTER TABLE `counters`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `delivery_orders`
--
ALTER TABLE `delivery_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `delivery_order_details`
--
ALTER TABLE `delivery_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `holds`
--
ALTER TABLE `holds`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `receives`
--
ALTER TABLE `receives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `receive_details`
--
ALTER TABLE `receive_details`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sales_orders`
--
ALTER TABLE `sales_orders`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sales_order_details`
--
ALTER TABLE `sales_order_details`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
