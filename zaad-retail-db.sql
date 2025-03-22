-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 04:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zaad-retail`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `social_media` varchar(255) DEFAULT NULL,
  `vat` varchar(255) NOT NULL DEFAULT 'no_vat',
  `vat_percent` bigint(20) UNSIGNED DEFAULT 0,
  `trn_number` varchar(255) DEFAULT NULL,
  `prefix_inv` varchar(255) DEFAULT NULL,
  `invoice_header` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `installation_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `opening_cash` double DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `other_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `credit_sale`
--

CREATE TABLE `credit_sale` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `type` enum('credit','debit','cod-credit') NOT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `paid_date` datetime NOT NULL,
  `sale_order_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `payment_type` varchar(225) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_number` varchar(255) NOT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_address` varchar(255) DEFAULT NULL,
  `customer_gender` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `driver_name` varchar(255) NOT NULL,
  `driver_email` varchar(255) DEFAULT NULL,
  `driver_phone` varchar(255) NOT NULL,
  `driver_address` varchar(255) DEFAULT NULL,
  `date_of_join` date NOT NULL,
  `driver_code` varchar(255) NOT NULL,
  `driver_pin` varchar(255) NOT NULL,
  `driver_license` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) NOT NULL,
  `uuid` char(36) NOT NULL,
  `branch_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `expense_cat_id` bigint(20) NOT NULL,
  `expense_cat_name` varchar(255) NOT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `total_before_vat` double NOT NULL,
  `vat` double NOT NULL,
  `total_amount` double NOT NULL,
  `action` varchar(255) NOT NULL,
  `payment_status` varchar(16) NOT NULL DEFAULT 'unpaid',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `expense_category_name` varchar(255) NOT NULL,
  `expense_category_slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_other_name` varchar(255) DEFAULT NULL,
  `item_cost_price` varchar(255) DEFAULT NULL,
  `multiple_price` enum('yes','no') NOT NULL DEFAULT 'no',
  `item_price` varchar(255) NOT NULL,
  `tax` enum('yes','no') DEFAULT 'no',
  `tax_percent` int(11) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `stock` bigint(20) UNSIGNED DEFAULT NULL,
  `item_type` enum('1','0') NOT NULL DEFAULT '1' COMMENT '1 = salable, 0 = non-salable',
  `stock_applicable` enum('1','0') NOT NULL DEFAULT '1' COMMENT '1 = yes, 0 = no',
  `image` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `item_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `price_size_id` bigint(20) UNSIGNED NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `cost_price` double DEFAULT NULL,
  `price` double NOT NULL,
  `stock` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_06_01_123324_create_branches_table', 1),
(2, '2014_10_12_000000_create_users_table', 2),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 2),
(4, '2019_08_19_000000_create_failed_jobs_table', 2),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(6, '2024_06_08_071859_create_permission_tables', 2),
(7, '2024_06_08_095155_create_setting_table', 2),
(8, '2024_06_22_105514_create_user_has_permissions_table', 3),
(9, '2024_06_26_044405_create_categories_table', 4),
(10, '2024_06_28_141036_create_expense_categories_table', 5),
(11, '2024_06_28_141044_create_payment_methods_table', 5),
(12, '2024_06_28_141058_create_customers_table', 5),
(13, '2024_06_28_141105_create_staff_table', 5),
(14, '2024_06_28_141112_create_drivers_table', 5),
(15, '2024_06_28_141120_create_suppliers_table', 5),
(16, '2024_06_28_141126_create_units_table', 5),
(17, '2024_06_28_141134_create_items_table', 5),
(18, '2024_06_30_162640_create_item_prices_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `open_drawer_log`
--

CREATE TABLE `open_drawer_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `reason` varchar(250) NOT NULL,
  `open_date` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


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
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method_name` varchar(255) NOT NULL,
  `payment_method_slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pay_back`
--

CREATE TABLE `pay_back` (
  `id` int(11) NOT NULL,
  `sale_order_item_id` int(11) NOT NULL,
  `sale_order_id` int(11) NOT NULL,
  `receipt_id` varchar(50) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` double NOT NULL,
  `weight` varchar(50) DEFAULT NULL,
  `amount` double NOT NULL,
  `discount` double NOT NULL,
  `discount_percent` double DEFAULT NULL,
  `tax_amt` double NOT NULL,
  `tax_type` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `payback_date` datetime NOT NULL,
  `payment_type` varchar(225) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;



-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `usertype` enum('admin','counter') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `parent_id`, `name`, `usertype`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 'master', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(2, 0, 'transcations', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(3, 0, 'reports', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(4, 0, 'couter', 'counter', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(5, 1, 'category', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(6, 1, 'items', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(7, 1, 'units', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(8, 1, 'suppliers', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(9, 1, 'drivers', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(10, 1, 'staffs', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(11, 1, 'customers', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(12, 1, 'payment_method', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', '2024-07-04 06:12:05'),
(13, 1, 'expense_category', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(14, 2, 'sales', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(15, 2, 'purchases', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(16, 2, 'expenses', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(17, 2, 'manage_stocks', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(18, 3, 'bill_wise_report', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(19, 3, 'item_wise_report', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(20, 3, 'category_wise_report', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(21, 3, 'order_type_wise_report', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(22, 3, 'user_wise_report', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(23, 3, 'staff_wise_report', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(24, 3, 'driver_wise_report', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(25, 3, 'customer_wise_report', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(26, 3, 'perfomance_report', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(27, 3, 'purchase_wise_report', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(28, 3, 'supplier_wise_report', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(29, 3, 'stock_report', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(30, 3, 'logs', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(31, 5, 'category_create', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(32, 5, 'category_edit', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(33, 5, 'category_delete', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(34, 6, 'item_create', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(35, 6, 'item_edit', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(36, 6, 'item_delete', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(37, 7, 'unit_create', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(38, 7, 'unit_edit', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(39, 7, 'unit_delete', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(40, 8, 'supplier_create', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(41, 8, 'supplier_edit', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(42, 8, 'supplier_delete', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(43, 9, 'driver_create', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(44, 9, 'driver_edit', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(45, 9, 'driver_delete', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(46, 10, 'staff_create', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(47, 10, 'staff_edit', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(48, 10, 'staff_delete', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(50, 12, 'payment_method_create', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', '2024-07-04 06:12:27'),
(51, 12, 'payment_method_edit', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', '2024-07-04 06:12:30'),
(52, 12, 'payment_method_delete', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', '2024-07-04 06:12:34'),
(53, 13, 'expense_category_create', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(54, 13, 'expense_category_edit', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(55, 13, 'expense_category_delete', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(56, 14, 'sale_delete', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(57, 14, 'sale_payment_change', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(58, 15, 'purchase_create', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(59, 15, 'purchase_edit', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(60, 15, 'purchase_delete', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(61, 16, 'expense_create', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(62, 16, 'expense_edit', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(63, 16, 'expense_delete', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(64, 17, 'stock_adjust', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(65, 4, 'counter_sale', 'counter', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(66, 4, 'expense', 'counter', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(67, 4, 'credit_sale', 'counter', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(68, 4, 'sale_log', 'counter', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(69, 4, 'settle_sale', 'counter', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(70, 4, 'opening_balance', 'counter', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(71, 11, 'customer_create', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(72, 11, 'customer_edit', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(73, 11, 'customer_delete', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(74, 3, 'settle_sale_report', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(75, 4, 'crm', 'counter', '2024-08-11 12:22:24', NULL, NULL),
(76, 4, 'pay_back', 'counter', '2024-08-11 12:22:24', NULL, NULL),
(77, 4, 'open_drawer', 'counter', '2024-08-11 12:22:24', NULL, NULL);

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
-- Table structure for table `price_size`
--

CREATE TABLE `price_size` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL,
  `branch_id` bigint(20) NOT NULL,
  `size_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `supplier_id` int(10) UNSIGNED DEFAULT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `payment_status` enum('paid','un_paid') DEFAULT 'un_paid',
  `total_amount` double DEFAULT NULL,
  `tax_amount` double DEFAULT NULL,
  `status` enum('pending','ordered','received') NOT NULL DEFAULT 'pending',
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_items`
--

CREATE TABLE `purchase_order_items` (
  `id` int(11) NOT NULL,
  `purchase_id` int(10) UNSIGNED DEFAULT NULL,
  `item_id` int(10) UNSIGNED DEFAULT NULL,
  `price_id` int(11) DEFAULT NULL,
  `product_name` varchar(225) DEFAULT NULL,
  `qty` int(11) DEFAULT 0,
  `unit_price` decimal(9,2) DEFAULT NULL,
  `total_amount` decimal(9,2) DEFAULT NULL,
  `tax` decimal(9,2) DEFAULT NULL,
  `tax_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `sale_orders`
--

CREATE TABLE `sale_orders` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `receipt_id` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `customer_uuid` char(36) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `customer_number` varchar(50) DEFAULT NULL,
  `customer_address` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `customer_email` varchar(225) DEFAULT NULL,
  `customer_gender` varchar(16) DEFAULT NULL,
  `customer_trn` varchar(100) DEFAULT NULL,
  `order_type` enum('counter_sale','delivery','dine_in','take_away','website_order','free_sale') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` text DEFAULT NULL,
  `card_num` int(11) DEFAULT NULL,
  `payment_status` enum('paid','unpaid') NOT NULL,
  `discount` float NOT NULL DEFAULT 0,
  `discount_per` double DEFAULT NULL,
  `amount_given` float DEFAULT NULL,
  `balance_amount` float DEFAULT NULL,
  `status` enum('pending','conform','out_for_delivery','delivered','reject','hold') NOT NULL,
  `remarks` text DEFAULT NULL,
  `delivered_in` varchar(100) DEFAULT NULL,
  `reject_reason` text DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `ordered_date` datetime NOT NULL,
  `paid_date` datetime DEFAULT NULL,
  `vat` int(11) DEFAULT NULL,
  `date_time` varchar(225) DEFAULT NULL,
  `without_tax` varchar(50) NOT NULL,
  `tax_amount` varchar(50) NOT NULL,
  `with_tax` varchar(50) NOT NULL,
  `edit_staff_id` int(11) DEFAULT NULL,
  `active` varchar(5) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_order_items`
--

CREATE TABLE `sale_order_items` (
  `id` int(11) NOT NULL,
  `sale_order_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price_size_id` int(11) NOT NULL,
  `item_name` varchar(250) NOT NULL,
  `other_item_name` varchar(225) DEFAULT NULL,
  `price` varchar(50) NOT NULL,
  `item_unit_price` double NOT NULL,
  `discount_percent` double NOT NULL,
  `discount_amount` double NOT NULL,
  `item_discount` double NOT NULL,
  `tax_without_price` double DEFAULT NULL,
  `cost_price` double DEFAULT NULL,
  `qty` double NOT NULL,
  `total_price` double NOT NULL,
  `notes` varchar(250) NOT NULL,
  `tax_percentage` varchar(225) NOT NULL,
  `tax_name` varchar(225) NOT NULL,
  `tax_amt` double NOT NULL,
  `tax_amt_not_round` double DEFAULT NULL,
  `tax_type` varchar(225) NOT NULL,
  `tax_count` int(11) NOT NULL,
  `active` varchar(5) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sale_order_items`
--

-- --------------------------------------------------------

--
-- Table structure for table `sale_order_payments`
--

CREATE TABLE `sale_order_payments` (
  `payment_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sale_order_id` int(11) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `currency` varchar(255) NOT NULL,
  `multiplier` double NOT NULL DEFAULT 1,
  `sub_payment_type` varchar(225) NOT NULL,
  `remarks` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `real_amount` varchar(255) NOT NULL DEFAULT '0',
  `order_type` varchar(225) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'currency', 'AED', NULL, '2024-08-22 04:21:07', NULL),
(2, 'decimal_point', '2', NULL, '2024-08-22 04:21:07', NULL),
(3, 'date_format', 'd-m-Y', NULL, '2024-08-22 04:21:07', NULL),
(4, 'time_format', 'h:i A', NULL, '2024-08-22 04:21:07', NULL),
(5, 'unit_price', 'no', NULL, '2024-08-22 04:21:07', NULL),
(6, 'stock_check', 'yes', NULL, '2024-08-22 04:21:07', NULL),
(7, 'stock_show', 'yes', NULL, '2024-08-22 04:21:07', NULL),
(8, 'settle_check_pending', 'yes', NULL, '2024-08-22 04:21:07', NULL),
(9, 'delivery_sale', 'yes', NULL, '2024-08-22 04:21:07', NULL),
(10, 'api_key', '123', NULL, NULL, NULL),
(11, 'custom_product', '4', NULL, NULL, NULL),
(12, 'language', '1', NULL, NULL, NULL),
(13, 'delivery_sales', 'yes', '2024-06-08 00:31:01', '2024-06-08 00:31:01', NULL),
(14, 'staff_pin', 'no', '2024-06-08 00:31:01', '2024-08-22 04:21:07', NULL),
(15, 'barcode', 'yes', '2024-07-28 07:14:55', '2024-08-22 04:21:08', NULL),
(16, 'drawer_password', '321', '2024-07-28 07:14:55', '2024-08-22 04:21:08', NULL),
(17, 'payback_password', '123', '2024-07-28 07:14:55', '2024-08-22 04:21:08', NULL),
(18, 'purchase', 'yes', NULL, '2024-08-22 04:21:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settle_sale`
--

CREATE TABLE `settle_sale` (
  `id` int(11) NOT NULL,
  `account_ledger_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `cash_at_starting` varchar(50) NOT NULL,
  `cash_sale` varchar(50) NOT NULL,
  `card_sale` varchar(50) NOT NULL,
  `credit_sale` varchar(50) NOT NULL,
  `delivery_sale` varchar(50) NOT NULL,
  `delivery_recover` varchar(50) DEFAULT NULL,
  `online_order_recovery` varchar(50) DEFAULT NULL,
  `credit_recover` varchar(50) NOT NULL,
  `cg_advance` varchar(50) NOT NULL,
  `cg_recover` varchar(50) NOT NULL,
  `gross_total` varchar(50) NOT NULL,
  `gross_total_tax` decimal(10,2) DEFAULT NULL,
  `gross_total_without_tax` decimal(10,2) DEFAULT NULL,
  `discount` varchar(50) NOT NULL,
  `net_total` varchar(50) NOT NULL,
  `cash_drawer` varchar(50) NOT NULL,
  `settle_date` datetime NOT NULL,
  `expense` varchar(50) NOT NULL,
  `pay_back` varchar(50) NOT NULL,
  `pay_back_vat` double DEFAULT NULL,
  `deposit_amount` double NOT NULL,
  `petty_cash_amount` double NOT NULL,
  `multi_payment_types_amount` mediumtext NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `settle_sale`
--

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `staff_email` varchar(255) DEFAULT NULL,
  `staff_phone` varchar(255) NOT NULL,
  `staff_address` varchar(255) DEFAULT NULL,
  `date_of_join` date DEFAULT NULL,
  `staff_code` varchar(255) NOT NULL,
  `staff_pin` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_management_history`
--

CREATE TABLE `stock_management_history` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_price_id` int(11) NOT NULL,
  `action_type` enum('add','sub') NOT NULL DEFAULT 'add',
  `reference_no` varchar(225) DEFAULT NULL,
  `reference_key` varchar(225) NOT NULL,
  `open_stock` double NOT NULL,
  `closing_stock` double NOT NULL,
  `stock_value` double NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_company_name` varchar(255) NOT NULL,
  `supplier_email` varchar(255) DEFAULT NULL,
  `supplier_company_email` varchar(255) DEFAULT NULL,
  `supplier_phone` varchar(255) NOT NULL,
  `supplier_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `unit_slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `usertype` enum('superadmin','mainadmin','admin','counter') NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `branch_id`, `name`, `email`, `usertype`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'superadmin', NULL, 'superadmin', 'superadmin', 'superadmin', NULL, '$2y$10$1.uk5zXRwSSq3Fc5jfmJHORKT/5P5Vb.zRMAwmOqB2l0DWSFyej3u', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_permissions`
--

CREATE TABLE `user_has_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_uuid_unique` (`uuid`),
  ADD KEY `categories_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `credit_sale`
--
ALTER TABLE `credit_sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `shop_id` (`shop_id`),
  ADD KEY `name` (`name`,`number`,`sale_order_id`),
  ADD KEY `name_2` (`name`,`number`,`sale_order_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_uuid_unique` (`uuid`),
  ADD KEY `customers_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `drivers_uuid_unique` (`uuid`),
  ADD KEY `drivers_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `expense_categories_uuid_unique` (`uuid`),
  ADD KEY `expense_categories_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `items_uuid_unique` (`uuid`),
  ADD KEY `items_branch_id_foreign` (`branch_id`),
  ADD KEY `items_category_id_foreign` (`category_id`),
  ADD KEY `items_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `item_prices`
--
ALTER TABLE `item_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_prices_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `open_drawer_log`
--
ALTER TABLE `open_drawer_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`shop_id`,`staff_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_methods_uuid_unique` (`uuid`),
  ADD KEY `payment_methods_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `pay_back`
--
ALTER TABLE `pay_back`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_order_item_id` (`sale_order_item_id`,`sale_order_id`,`receipt_id`,`item_id`,`user_id`,`shop_id`,`staff_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `price_size`
--
ALTER TABLE `price_size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_id` (`shop_id`,`supplier_id`,`date_added`);

--
-- Indexes for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_id` (`purchase_id`,`item_id`,`product_name`);

--
-- Indexes for table `sale_orders`
--
ALTER TABLE `sale_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receipt_id` (`receipt_id`,`user_id`,`shop_id`,`customer_id`,`driver_id`,`staff_id`,`ordered_date`),
  ADD KEY `receipt_id_2` (`receipt_id`,`user_id`,`shop_id`,`customer_id`,`driver_id`,`staff_id`,`ordered_date`),
  ADD KEY `receipt_id_3` (`receipt_id`,`user_id`,`shop_id`,`customer_id`,`driver_id`,`staff_id`,`ordered_date`),
  ADD KEY `contact_name` (`customer_name`,`customer_number`,`order_type`,`edit_staff_id`),
  ADD KEY `receipt_id_4` (`receipt_id`,`user_id`,`shop_id`,`customer_id`,`driver_id`,`staff_id`,`ordered_date`);

--
-- Indexes for table `sale_order_items`
--
ALTER TABLE `sale_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_order_id` (`sale_order_id`,`item_id`,`price_size_id`,`item_name`),
  ADD KEY `sale_order_id_2` (`sale_order_id`,`item_id`,`price_size_id`,`item_name`);

--
-- Indexes for table `sale_order_payments`
--
ALTER TABLE `sale_order_payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payment_id` (`payment_id`,`shop_id`,`user_id`,`sale_order_id`,`payment_type`,`sub_payment_type`,`order_type`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settle_sale`
--
ALTER TABLE `settle_sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`account_ledger_id`,`company_id`,`user_id`,`shop_id`,`staff_id`,`settle_date`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_uuid_unique` (`uuid`),
  ADD KEY `staff_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `stock_management_history`
--
ALTER TABLE `stock_management_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`item_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_uuid_unique` (`uuid`),
  ADD KEY `suppliers_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `units_uuid_unique` (`uuid`),
  ADD KEY `units_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `user_has_permissions`
--
ALTER TABLE `user_has_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_has_permissions_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `credit_sale`
--
ALTER TABLE `credit_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `item_prices`
--
ALTER TABLE `item_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `open_drawer_log`
--
ALTER TABLE `open_drawer_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pay_back`
--
ALTER TABLE `pay_back`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price_size`
--
ALTER TABLE `price_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `sale_orders`
--
ALTER TABLE `sale_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `sale_order_items`
--
ALTER TABLE `sale_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `sale_order_payments`
--
ALTER TABLE `sale_order_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `settle_sale`
--
ALTER TABLE `settle_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `stock_management_history`
--
ALTER TABLE `stock_management_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_has_permissions`
--
ALTER TABLE `user_has_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD CONSTRAINT `expense_categories_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `items_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_prices`
--
ALTER TABLE `item_prices`
  ADD CONSTRAINT `item_prices_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD CONSTRAINT `payment_methods_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `units_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_has_permissions`
--
ALTER TABLE `user_has_permissions`
  ADD CONSTRAINT `user_has_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
