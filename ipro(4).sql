-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2019 at 10:02 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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

CREATE TABLE `branches` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `city`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bandung', NULL, NULL, '2019-04-15 00:46:36', '2019-04-15 00:46:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Conwood', '2019-04-15 00:38:17', '2019-04-15 00:38:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `brand_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Kayu', '2019-04-15 00:38:27', '2019-04-15 00:38:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

CREATE TABLE `counters` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `counter` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`id`, `name`, `counter`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PO', 8, NULL, '2019-04-25 20:36:49', NULL),
(2, 'SO', 4, NULL, '2019-04-23 01:04:02', NULL),
(3, 'QO', 1, NULL, '2019-04-23 01:04:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `no_ktp` bigint(20) NOT NULL,
  `project_owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `no_ktp`, `project_owner`, `address`, `phone`, `fax`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1234567891012131, 'Asep Jeck Sadikin', 'Jalan Kemayu Oke Oce', '08987654321', '0101010101', 'ujeck.sadik@asep.com', '2019-04-15 00:37:50', '2019-04-15 00:37:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `holds`
--

CREATE TABLE `holds` (
  `id` int(10) UNSIGNED NOT NULL,
  `stocks_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
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

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category_id`, `code`, `name`, `purchase_price`, `weight`, `area`, `width`, `height`, `length`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '4.5\"', 'Kayu Flooring', 15000, 1, 40, 30, 40, 1.3, '2019-04-15 00:39:30', '2019-04-15 00:39:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(36, '2019_04_26_091247_add_purchase_detail_id_to_receives', 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `purchase_number` text NOT NULL,
  `approval_status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `purchase_number`, `approval_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PO1904180100001', 1, '2019-04-22 07:48:13', '2019-04-22 00:47:42', NULL),
(2, 'PO1904180100002', 1, '2019-04-22 08:31:57', '2019-04-22 01:31:57', NULL),
(3, 'PO1904180100003', 0, '2019-04-18 00:20:38', '2019-04-18 00:20:38', NULL),
(4, 'PO1904180100004', 0, '2019-04-18 00:23:52', '2019-04-18 00:23:52', NULL),
(5, 'PO1904220000005', 0, '2019-04-22 01:38:14', '2019-04-22 01:38:14', NULL),
(6, 'PO1904220000005', 1, '2019-04-22 08:40:06', '2019-04-22 01:40:06', NULL),
(7, 'PO1904240100006', 0, '2019-04-23 21:20:26', '2019-04-23 21:20:26', NULL),
(8, 'PO1904250100007', 0, '2019-04-25 03:01:14', '2019-04-25 03:01:14', NULL),
(9, 'PO1904260100007', 1, '2019-04-26 03:38:18', '2019-04-25 20:38:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
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
  `sales_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `item_id`, `total_price`, `qty`, `purchase_price`, `created_at`, `updated_at`, `deleted_at`, `purchase_id`, `approval_finance`, `qty_approval`, `status`, `sales_id`) VALUES
(1, 1, 30000, 2, 15000, '2019-04-22 07:46:30', '2019-04-22 00:46:30', NULL, 1, 1, 4, 0, 0),
(2, 1, 30000, 2, 15000, '2019-04-22 07:46:31', '2019-04-22 00:46:31', NULL, 1, 1, 4, 0, 0),
(3, 1, 30000, 2, 15000, '2019-04-18 00:15:24', '2019-04-18 00:15:24', NULL, 1, 0, 0, 0, 0),
(4, 1, 60000, 4, 15000, '2019-04-22 07:46:31', '2019-04-22 00:46:31', NULL, 1, 1, 4, 0, 0),
(5, 1, 60000, 4, 15000, '2019-04-22 07:46:31', '2019-04-22 00:46:31', NULL, 1, 1, 4, 0, 0),
(6, 1, 30000, 2, 15000, '2019-04-22 08:31:55', '2019-04-22 01:31:55', NULL, 2, 1, 2, 0, 0),
(7, 1, 30000, 2, 15000, '2019-04-22 08:31:56', '2019-04-22 01:31:56', NULL, 2, 1, 2, 0, 0),
(8, 1, 30000, 2, 15000, '2019-04-22 08:31:56', '2019-04-22 01:31:56', NULL, 2, 1, 2, 0, 0),
(9, 1, 60000, 4, 15000, '2019-04-22 08:31:57', '2019-04-22 01:31:57', NULL, 2, 1, 4, 0, 0),
(10, 1, 60000, 4, 15000, '2019-04-22 08:31:57', '2019-04-22 01:31:57', NULL, 2, 1, 4, 0, 0),
(11, 1, 30000, 2, 15000, '2019-04-18 00:20:38', '2019-04-18 00:20:38', NULL, 3, 0, 0, 0, 0),
(12, 1, 30000, 2, 15000, '2019-04-18 00:20:38', '2019-04-18 00:20:38', NULL, 3, 0, 0, 0, 0),
(13, 1, 30000, 2, 15000, '2019-04-18 00:20:38', '2019-04-18 00:20:38', NULL, 3, 0, 0, 0, 0),
(14, 1, 30000, 2, 15000, '2019-04-18 00:23:52', '2019-04-18 00:23:52', NULL, 4, 0, 0, 0, 0),
(15, 1, 30000, 2, 15000, '2019-04-18 00:23:52', '2019-04-18 00:23:52', NULL, 4, 0, 0, 0, 0),
(16, 1, 30000, 2, 15000, '2019-04-18 00:23:52', '2019-04-18 00:23:52', NULL, 4, 0, 0, 0, 0),
(17, 1, 30000, 2, 15000, '2019-04-22 08:40:06', '2019-04-22 01:40:06', NULL, 6, 1, 2, 0, 0),
(18, 1, 30000, 2, 15000, '2019-04-22 01:38:55', '2019-04-22 01:38:55', NULL, 6, NULL, NULL, 0, 0),
(19, 1, 30000, 2, 15000, '2019-04-22 08:40:06', '2019-04-22 01:40:06', NULL, 6, 1, 2, 0, 0),
(20, 1, 150000, 10, 15000, '2019-04-22 01:38:56', '2019-04-22 01:38:56', NULL, 6, NULL, NULL, 0, 0),
(21, 1, 30000, 2, 15000, '2019-04-23 21:20:26', '2019-04-23 21:20:26', NULL, 7, NULL, NULL, 0, 0),
(22, 1, 30000, 2, 15000, '2019-04-23 21:20:26', '2019-04-23 21:20:26', NULL, 7, NULL, NULL, 0, 0),
(23, 1, 30000, 2, 15000, '2019-04-23 21:20:26', '2019-04-23 21:20:26', NULL, 7, NULL, NULL, 0, 0),
(24, 1, 45000, 3, 15000, '2019-04-23 21:20:26', '2019-04-23 21:20:26', NULL, 7, NULL, NULL, 0, 0),
(25, 1, 30000, 2, 15000, '2019-04-26 03:38:18', '2019-04-25 20:38:18', NULL, 9, 1, 2, NULL, 1),
(26, 1, 30000, 2, 15000, '2019-04-26 03:38:18', '2019-04-25 20:38:18', NULL, 9, 1, 2, NULL, 1),
(27, 1, 30000, 2, 15000, '2019-04-26 03:38:18', '2019-04-25 20:38:18', NULL, 9, 1, 2, NULL, 1),
(28, 1, 30000, 2, 15000, '2019-04-26 03:38:18', '2019-04-25 20:38:18', NULL, 9, 1, 2, NULL, 2),
(29, 1, 30000, 2, 15000, '2019-04-26 03:38:18', '2019-04-25 20:38:18', NULL, 9, 1, 2, NULL, 2),
(30, 1, 30000, 2, 15000, '2019-04-26 03:38:18', '2019-04-25 20:38:18', NULL, 9, 1, 2, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `receives`
--

CREATE TABLE `receives` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `receipt` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receives`
--

INSERT INTO `receives` (`id`, `purchase_id`, `receipt`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 9, 123456, '2019-04-28 21:19:15', '2019-04-28 21:19:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `receive_details`
--

CREATE TABLE `receive_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `qty_get` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `receive_id` int(11) DEFAULT NULL,
  `purchase_detail_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receive_details`
--

INSERT INTO `receive_details` (`id`, `qty_get`, `price`, `total_price`, `created_at`, `updated_at`, `deleted_at`, `receive_id`, `purchase_detail_id`) VALUES
(13, 2, 0, 0, '2019-04-28 20:52:19', '2019-04-28 20:52:19', NULL, 1, 25),
(14, 2, 0, 0, '2019-04-28 20:52:19', '2019-04-28 20:52:19', NULL, 1, 26),
(15, 2, 0, 0, '2019-04-28 20:52:19', '2019-04-28 20:52:19', NULL, 1, 27),
(16, 2, 0, 0, '2019-04-28 20:52:19', '2019-04-28 20:52:19', NULL, 1, 28),
(17, 2, 0, 0, '2019-04-28 20:52:19', '2019-04-28 20:52:19', NULL, 1, 29),
(18, 2, 0, 0, '2019-04-28 20:52:20', '2019-04-28 20:52:20', NULL, 1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `sales_orders`
--

CREATE TABLE `sales_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `quotation_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_pic_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `no_so` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_order` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_orders`
--

INSERT INTO `sales_orders` (`id`, `customer_id`, `user_id`, `quotation_id`, `project`, `send_address`, `send_date`, `send_pic_phone`, `payment_method`, `note`, `created_at`, `updated_at`, `deleted_at`, `no_so`, `notes`, `no_order`) VALUES
(1, 1, 1, '000001', 'Bikin Lantai Rumah', 'Jalan Project Rumahnya', '2019-04-15', '0101010101', 'Cash', 'Jalan Project', '2019-04-15 01:00:40', '2019-04-23 01:04:02', NULL, 'SO1904230000003', NULL, NULL),
(2, 1, 1, '000001', 'Bikin Lantai Rumah', 'Jalan Project Rumahnya', '2019-04-15', '0101010101', 'Cash', 'Jalan Project', '2019-04-15 01:00:40', '2019-04-23 01:04:02', NULL, 'SO1904230000004', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_details`
--

CREATE TABLE `sales_order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `sales_order_id` int(10) UNSIGNED NOT NULL,
  `stock_id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_order_details`
--

INSERT INTO `sales_order_details` (`id`, `sales_order_id`, `stock_id`, `qty`, `price`, `total`, `discount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 2, 15000, 30000, 0, '2019-04-15 01:00:40', '2019-04-15 01:00:40', NULL),
(2, 1, 1, 2, 15000, 30000, 0, '2019-04-15 01:00:40', '2019-04-15 01:00:40', NULL),
(3, 1, 1, 2, 15000, 30000, 0, '2019-04-15 01:00:40', '2019-04-15 01:00:40', NULL),
(4, 2, 1, 2, 15000, 30000, 0, '2019-04-15 01:00:40', '2019-04-15 01:00:40', NULL),
(5, 2, 1, 2, 15000, 30000, 0, '2019-04-15 01:00:40', '2019-04-15 01:00:40', NULL),
(6, 2, 1, 2, 15000, 30000, 0, '2019-04-15 01:00:40', '2019-04-15 01:00:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `item_id`, `branch_id`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 50, '2019-04-15 00:59:34', '2019-04-15 00:59:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` int(10) UNSIGNED DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `role`, `branch_id`, `saldo`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@secret.com', 'admin', 1, NULL, NULL, '$2y$10$cdLsZb5WpnNiXYoFJX/GDOHv3JR6hb6jLOf32rkScJO2bnjT3Y7MK', 'SoYmloctMh1L5qlg18sZFZotjwCjCrTqUkciBdVSXxH1EkuA6oQFpO1xXPpI', '2019-04-14 22:33:27', '2019-04-14 22:33:27'),
(2, 'Finance', 'finance', 'finance@ipro.com', 'finance', NULL, NULL, NULL, '$2y$10$JDMsqnwNiB.IVPnj3efrcOd.Hmw2ofnqMm2doheBErfEtDdfjCra.', 'Bl4Rmk5XByAbiBXC3SpUnFaww5rwxHm1R2xvmcS3SdePIVn83LpTlSpoa7Te', '2019-04-21 22:36:50', '2019-04-21 22:36:50');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `counters`
--
ALTER TABLE `counters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `holds`
--
ALTER TABLE `holds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `receives`
--
ALTER TABLE `receives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `receive_details`
--
ALTER TABLE `receive_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sales_orders`
--
ALTER TABLE `sales_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_order_details`
--
ALTER TABLE `sales_order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
