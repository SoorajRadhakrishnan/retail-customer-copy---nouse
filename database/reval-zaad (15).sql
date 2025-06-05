-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 17, 2025 at 10:59 AM
-- Server version: 8.0.41-0ubuntu0.22.04.1
-- PHP Version: 8.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reval-zaad`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_media` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no_vat',
  `vat_percent` bigint UNSIGNED DEFAULT '0',
  `trn_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefix_inv` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `installation_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `opening_cash` double DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `uuid`, `branch_name`, `location`, `contact_no`, `email`, `social_media`, `vat`, `vat_percent`, `trn_number`, `prefix_inv`, `invoice_header`, `image`, `installation_date`, `expiry_date`, `created_at`, `opening_cash`, `updated_at`, `deleted_at`) VALUES
(1, 'e709e00f-9c03-4ca0-8208-3fe4ec5ef003', 'REVAL', 'Ajman - Al Muwaihat', '+971 56 798 0994', NULL, NULL, 'no_vat', NULL, NULL, 'INV', 'Ajman - Al Muwaihat, +971 56 798 0994', '1744736690.jpg', '2025-04-15', '2026-04-15', '2025-04-15 14:21:24', NULL, '2025-04-15 21:04:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `uuid`, `branch_id`, `category_name`, `category_slug`, `other_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '49ce5d1e-e8a9-41d6-82c9-a61e114dbeb8', 1, 'general', 'general', 'عام', '2025-04-15 14:21:24', '2025-04-22 14:18:04', '2025-04-22 14:18:04'),
(2, '6f07b104-6f7c-4108-8c4c-539415c5a20f', 1, 'PERFUME', 'perfume', NULL, '2025-04-15 17:56:33', '2025-04-15 17:56:33', NULL),
(3, '689ff914-d521-4642-aba9-9ed4e9b15b4d', 1, 'KG BAKHOOR', 'kg-bakhoor', NULL, '2025-04-15 17:56:41', '2025-04-22 14:17:23', NULL),
(4, 'd289954e-3c45-48f2-9f94-e4592f22e0c5', 1, 'AIR FRESHNER', 'air-freshner', NULL, '2025-04-15 17:56:52', '2025-04-15 17:56:52', NULL),
(5, '5f88733f-f75c-40ed-b6b3-ecada2faa945', 1, 'METERIAL', 'meterial', NULL, '2025-04-15 17:57:17', '2025-04-15 17:57:17', NULL),
(6, 'c8483d6e-3abd-45f6-9e8d-e395a6f28116', 1, 'Oil', 'oil', NULL, '2025-04-21 14:01:36', '2025-04-21 14:01:36', NULL),
(7, '9933c9f2-f03e-48e6-b8b4-77141635e9db', 1, 'Bottles', 'bottles', 'whosale', '2025-04-22 14:08:53', '2025-04-22 14:08:53', NULL),
(8, '60ec7a25-0aa4-476c-8274-92a8cd97c2b8', 1, 'BUKHOOR INCENCE', 'bukhoor-incence', 'SHOP', '2025-04-22 14:17:49', '2025-04-22 14:17:49', NULL),
(9, '90e5cb9a-b225-4e9b-8c2e-275f4d32fba5', 1, 'caps', 'caps', 'wholsale', '2025-04-27 11:41:16', '2025-04-27 11:41:49', NULL),
(10, '503f6c27-cf5e-457b-9a11-0648cc08a9f2', 1, 'reval proudacte material', 'reval-proudacte-material', NULL, '2025-04-28 19:39:27', '2025-04-28 19:39:27', NULL),
(11, 'fb122482-a61d-482a-b613-229dd426fd59', 1, 'BUKHOOR JAR', 'bukhoor-jar', NULL, '2025-05-05 11:33:45', '2025-05-05 11:33:45', NULL),
(12, '87341f1a-ddbe-4fb2-89ff-ce4687639879', 1, 'BOXES', 'boxes', NULL, '2025-05-05 15:19:28', '2025-05-05 15:19:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `credit_sale`
--

CREATE TABLE `credit_sale` (
  `id` int NOT NULL,
  `customer_id` int DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `type` enum('credit','debit','cod-credit') NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `paid_date` datetime NOT NULL,
  `sale_order_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `shop_id` int NOT NULL,
  `payment_type` varchar(225) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit_sale`
--

INSERT INTO `credit_sale` (`id`, `customer_id`, `name`, `number`, `type`, `amount`, `paid_date`, `sale_order_id`, `user_id`, `shop_id`, `payment_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, NULL, '0503937771', 'credit', 130, '2025-04-25 18:29:06', 11, 3, 1, NULL, NULL, NULL, NULL),
(2, 6, 'ARNAB DELIVERY', '0508262720', 'credit', 250, '2025-04-28 17:15:12', 33, 3, 1, NULL, NULL, NULL, NULL),
(3, 6, 'ARNAB DELIVERY', '0508262720', 'credit', 300, '2025-04-30 15:43:32', 43, 3, 1, NULL, NULL, NULL, NULL),
(4, 6, 'ARNAB DELIVERY', '0508262720', 'credit', 130, '2025-04-30 15:47:11', 44, 3, 1, NULL, NULL, NULL, NULL),
(5, 13, 'faheem', '0567980994', 'credit', 51.5, '2025-05-01 18:25:05', 50, 3, 1, NULL, NULL, NULL, NULL),
(6, 13, 'faheem', '0567980994', 'credit', 101.5, '2025-05-01 18:26:14', 51, 3, 1, NULL, NULL, NULL, NULL),
(7, 27, 'nabel alhutami', '0526661154', 'credit', 250, '2025-05-12 14:08:09', 100, 3, 1, NULL, NULL, NULL, NULL),
(8, 28, 'im', '0509720635', 'credit', 4, '2025-05-15 17:02:59', 114, 4, 1, NULL, NULL, NULL, NULL),
(9, 28, 'im', 'Im (0509720635 )', 'debit', 2.5, '2025-05-15 17:04:07', NULL, 4, 1, 'cash', NULL, NULL, NULL),
(10, 29, 'mmmmmm', '0505506803', 'credit', 3, '2025-05-15 17:10:43', 115, 4, 1, NULL, NULL, NULL, NULL),
(11, 29, 'mmmmmm', 'Mmmmmm (0505506803 )', 'debit', 2, '2025-05-15 17:12:16', NULL, 4, 1, 'cash', NULL, NULL, NULL),
(12, 29, 'mmmmmm', 'Mmmmmm (0505506803 )', 'debit', 1, '2025-05-15 17:12:25', NULL, 4, 1, 'cash', NULL, NULL, NULL),
(13, 28, 'im', 'Im (0509720635 )', 'debit', 1.5, '2025-05-15 17:13:41', NULL, 4, 1, 'cash', NULL, NULL, NULL),
(14, 30, 'khamis', '0501844044', 'credit', 80, '2025-05-17 09:50:43', 125, 3, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `uuid`, `branch_id`, `customer_name`, `customer_number`, `customer_email`, `customer_address`, `customer_gender`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '56f074f1-f8ce-4da2-a71e-dd7a47bce3b5', 1, 'REVAL', '987654', '', '', '', '2025-04-15 18:40:55', '2025-04-15 18:41:19', NULL),
(2, '86feda42-6c10-4b90-b10e-87271d231d58', 1, 'mohmad saed', '0565339054', '', '', '', '2025-04-24 22:49:19', '2025-04-24 22:49:19', NULL),
(3, 'd6208f0d-5525-4707-a748-adfaaf679ca2', 1, '', '0503937771', '', 'fujirah murishiead', 'male', '2025-04-25 18:29:06', '2025-04-25 18:29:06', NULL),
(4, '5cfe5322-3527-4804-8a10-525d0aa8ec3f', 1, 'ahmad', '0569426876', '', '', '', '2025-04-25 22:05:46', '2025-04-25 22:05:46', NULL),
(5, 'e0867dca-f879-4f9b-8444-0e1e8efb33b8', 1, 'mohamad', '0501441959', '', '', '', '2025-04-25 23:06:44', '2025-04-25 23:06:44', NULL),
(6, 'b1173fbe-a66b-4ed5-bedc-c132f2b5a161', 1, 'ARNAB DELIVERY', '0508262720', '', '', 'male', '2025-04-26 19:20:54', '2025-04-30 15:47:11', NULL),
(7, '0a2bff7a-a5a3-485f-a128-7c6b5ae0b301', 1, 'ABDULLAH ALBULUSHI', '0501070207', '', '', '', '2025-04-26 22:12:31', '2025-04-26 22:12:31', NULL),
(8, '8079994c-f6ca-4ac4-9091-39717c8ed004', 1, 'hamad alshiba', '0501771197', '', '', '', '2025-04-28 00:08:07', '2025-04-28 00:08:07', NULL),
(9, 'e3fc7b23-6d70-49a3-b4e9-49686f9aefa0', 1, 'salim obaid', '0566073791', '', '', '', '2025-04-28 23:02:20', '2025-04-28 23:02:20', NULL),
(10, 'f3bf0313-ac49-48c3-af93-dacef3ed48bb', 1, 'ABU MAKTOUM', '0561196040', '', '', '', '2025-04-30 19:57:54', '2025-04-30 19:57:54', NULL),
(11, 'fe0bb2eb-0f18-465a-b994-64942a8a78a9', 1, 'ALI ,,,', '0522366365', '', '', '', '2025-04-30 21:46:50', '2025-04-30 21:46:50', NULL),
(12, '2298a1ef-7c3d-4825-a307-e97041456aac', 1, 'mohsen', '0529800157', '', '', '', '2025-05-01 13:03:45', '2025-05-01 13:03:45', NULL),
(13, 'bbd4aea2-3c2c-4199-ba09-410890c760dd', 1, 'faheem', '0567980994', '', '', '', '2025-05-01 18:25:05', '2025-05-01 18:26:14', NULL),
(14, '35f31299-c3aa-450e-93c2-b25fb34610f1', 1, 'hade', '0589714499', '', '', '', '2025-05-01 18:36:39', '2025-05-01 18:36:39', NULL),
(15, '6836ab46-1fc7-48c2-be2d-8794c9ad63f5', 1, 'youness', '0502522077', '', '', '', '2025-05-01 19:04:11', '2025-05-01 19:04:11', NULL),
(16, 'fed9af2d-319a-4114-818e-fce141c452ce', 1, 'shay shay kgg', '0556969518', '', '', '', '2025-05-01 20:40:26', '2025-05-01 20:40:26', NULL),
(17, '4e1bb79f-d91c-4a37-a1c8-678a8ae7d007', 1, 'majeed', '0559114001', '', '', '', '2025-05-01 20:50:14', '2025-05-01 20:50:14', NULL),
(18, 'a306dc56-beff-48a1-8354-4afb37bea37d', 1, '', '0551995664', '', '', '', '2025-05-01 20:51:42', '2025-05-01 20:51:42', NULL),
(19, '8a9800d2-94ce-4691-b630-d8de134dfb2a', 1, 'mohamed', '0528911292', '', '', '', '2025-05-01 22:25:05', '2025-05-01 22:25:05', NULL),
(20, 'ef5ba40c-c260-40c4-9af2-adc6d0129088', 1, 'hassan', '0528606050', '', '', '', '2025-05-01 23:06:09', '2025-05-01 23:06:09', NULL),
(21, '94cfbf41-4162-4be2-92c9-cf2c24ba68e5', 1, 'muasood', '0509599908', '', '', '', '2025-05-03 21:17:46', '2025-05-03 21:17:46', NULL),
(22, 'b83ad8cd-4e60-4353-83b3-59f1b65d5078', 1, 'khalid', '0567440006', '', '', '', '2025-05-04 19:15:42', '2025-05-04 19:15:42', NULL),
(23, '1cb39134-1552-4b18-89d7-d84fa3508ae7', 1, 'mohamed gul', '0581443320', '', '', '', '2025-05-05 18:43:09', '2025-05-05 18:43:09', NULL),
(24, 'f888750e-d3aa-4b9c-a7b4-c715f21506b7', 1, 'smael', '0506782866', '', 'sawede', '', '2025-05-07 20:26:01', '2025-05-07 20:26:01', NULL),
(25, '2d5dac90-e117-4766-a17f-13868cb77856', 1, 'ali', '05592565430', '', '', '', '2025-05-09 18:09:29', '2025-05-09 18:09:29', NULL),
(26, '0cfe13f3-ab2b-405f-a8cf-0b063f34096f', 1, 'hmdan', '0506663544', '', '', '', '2025-05-11 21:39:57', '2025-05-11 21:39:57', NULL),
(27, '519261fb-d2c4-4d14-9b79-3f0b4c931506', 1, 'nabel alhutami', '0526661154', '', '', '', '2025-05-12 14:08:09', '2025-05-12 14:08:09', NULL),
(28, '5d5bee6e-da60-488c-bcec-43f5f61dfdbd', 1, 'im', '0509720635', '', '', '', '2025-05-15 17:02:59', '2025-05-15 17:02:59', NULL),
(29, '2875e5af-f3d1-4eed-9558-39af770e579c', 1, 'mmmmmm', '0505506803', '', '', '', '2025-05-15 17:10:43', '2025-05-15 17:10:43', NULL),
(30, '05731af8-9f13-4400-8cb9-c43a68c116ff', 1, 'khamis', '0501844044', '', '', '', '2025-05-17 09:50:43', '2025-05-17 09:50:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `driver_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_join` date NOT NULL,
  `driver_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_pin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_license` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `uuid`, `branch_id`, `driver_name`, `driver_email`, `driver_phone`, `driver_address`, `date_of_join`, `driver_code`, `driver_pin`, `driver_license`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'c79d297d-d5d9-469f-b339-bc61a27dcda2', 1, 'Arnab delivery', NULL, '0508262720', NULL, '2025-05-01', '111', '111', '', '2025-05-01 18:24:08', '2025-05-01 18:24:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint NOT NULL,
  `uuid` char(36) NOT NULL,
  `branch_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `expense_cat_id` bigint NOT NULL,
  `expense_cat_name` varchar(255) NOT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `description` text,
  `total_before_vat` double DEFAULT '0',
  `vat` double DEFAULT '0',
  `total_amount` double NOT NULL,
  `action` varchar(255) NOT NULL,
  `payment_status` varchar(16) NOT NULL DEFAULT 'unpaid',
  `payment_type` varchar(255) NOT NULL DEFAULT '',
  `date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `uuid`, `branch_id`, `user_id`, `expense_cat_id`, `expense_cat_name`, `invoice_no`, `description`, `total_before_vat`, `vat`, `total_amount`, `action`, `payment_status`, `payment_type`, `date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'f3c1c7ee-8d78-400c-8d9f-89009818ff62', 1, 2, 1, 'WATER', NULL, NULL, NULL, NULL, 100, 'Admin', 'paid', '', NULL, '2025-05-01 18:09:02', '2025-05-01 18:09:02', NULL),
(2, '938b9fe5-fb2e-4bd7-9378-72476a57ef24', 1, 2, 5, 'Administrative Expenses', 'inv0007', 'سستم زاد', NULL, NULL, 2150, 'Admin', 'paid', '', '2025-05-07', '2025-05-07 15:50:27', '2025-05-07 17:38:04', NULL),
(3, 'd12f458c-8ae8-4362-a1d0-a4146aecb2cd', 1, 2, 5, 'Administrative Expenses', NULL, 'رسوم حجز اسم تجاري', NULL, NULL, 755, 'Admin', 'paid', '', '2025-05-07', '2025-05-07 16:07:25', '2025-05-07 17:38:12', NULL),
(4, '343967bc-8948-49fe-baa7-7d0fa37b9834', 1, 2, 5, 'Administrative Expenses', '65431', 'asdfghjk', NULL, NULL, 50, 'Admin', 'paid', '', '2025-05-07', '2025-05-07 17:28:22', '2025-05-07 17:29:19', '2025-05-07 17:29:19'),
(5, '5867a782-7a0d-43d8-8371-6645cf876c36', 1, 3, 5, 'Administrative Expenses', '987654', 'asdfghn', NULL, NULL, 50, 'Counter', 'paid', '', '2025-05-05', '2025-05-07 17:29:04', '2025-05-07 17:29:24', '2025-05-07 17:29:24'),
(6, 'ddddb823-4853-488b-8cf9-7aebf02a7a5f', 1, 2, 5, 'Administrative Expenses', NULL, 'ضريبة محل', NULL, NULL, 3500, 'Admin', 'paid', '', '2025-02-26', '2025-05-11 12:32:06', '2025-05-11 12:38:46', '2025-05-11 12:38:46'),
(7, 'eaf34571-947c-42b3-b016-9b7fb851403f', 1, 2, 5, 'Administrative Expenses', NULL, 'ضريبة المحل', NULL, NULL, 3500, 'Admin', 'paid', '', '2025-02-26', '2025-05-11 12:36:17', '2025-05-11 12:38:07', NULL),
(8, '3638f671-bbd6-4e06-9d56-cfcfa7cb9055', 1, 2, 5, 'Administrative Expenses', NULL, 'عمولة المحل', NULL, NULL, 4000, 'Admin', 'paid', '', '2025-02-26', '2025-05-11 12:37:15', '2025-05-11 12:37:15', NULL),
(9, '66d02b99-d73d-4ed2-a10f-77ec623decd1', 1, 2, 5, 'Administrative Expenses', NULL, 'تصميم شعار (خمسات)', NULL, NULL, 250, 'Admin', 'paid', '', '2025-03-02', '2025-05-11 12:39:54', '2025-05-11 12:39:54', NULL),
(10, 'd52df76e-3f0c-40f9-a8aa-aba0949e3075', 1, 2, 5, 'Administrative Expenses', NULL, 'المنتصر علب دخون للتخمير', NULL, NULL, 144, 'Admin', 'paid', '', '2025-03-02', '2025-05-11 12:40:43', '2025-05-11 12:40:43', NULL),
(11, 'c734654b-c915-4537-a6a2-df0048587e4e', 1, 2, 5, 'Administrative Expenses', NULL, 'ديكور ميزانين + تكسير', NULL, NULL, 22000, 'Admin', 'paid', '', '2025-03-02', '2025-05-11 12:41:25', '2025-05-11 12:41:25', NULL),
(12, '7f330cca-e375-498c-905e-380f53d90d54', 1, 2, 5, 'Administrative Expenses', NULL, 'عينات غراش جولدن وينجس', NULL, NULL, 200, 'Admin', 'paid', '', '2025-03-04', '2025-05-11 12:42:09', '2025-05-11 12:42:09', NULL),
(13, '214bd3ac-00b4-49ff-bc39-6dc587065ef6', 1, 2, 5, 'Administrative Expenses', NULL, 'الصرف الصحي تفعيل الحساب', NULL, NULL, 595, 'Admin', 'paid', '', '2025-03-07', '2025-05-11 12:42:59', '2025-05-11 12:42:59', NULL),
(14, '60cda54d-0c1b-46d5-ad08-18abb6df274c', 1, 2, 5, 'Administrative Expenses', NULL, 'كهرباء وتشطيب', NULL, NULL, 6000, 'Admin', 'paid', '', '2025-03-08', '2025-05-11 12:43:36', '2025-05-11 12:43:36', NULL),
(15, 'e4c6dfc6-6e38-4f69-970c-6a2117412e32', 1, 2, 5, 'Administrative Expenses', NULL, 'تلفون للمحل - الشامسي للهواتف', NULL, NULL, 3800, 'Admin', 'paid', '', '2025-05-07', '2025-05-11 12:44:03', '2025-05-11 12:44:03', NULL),
(16, '92b2caff-f75c-4fd6-940f-d059ff4de9a3', 1, 2, 5, 'Administrative Expenses', NULL, 'اعمال خشب و رفوف', NULL, NULL, 12000, 'Admin', 'paid', '', '2025-05-07', '2025-05-11 12:44:29', '2025-05-11 12:44:29', NULL),
(17, 'f60c3bea-0542-46f4-9087-0be43f902e28', 1, 2, 5, 'Administrative Expenses', NULL, 'اصدار الرخصة', NULL, NULL, 11500, 'Admin', 'paid', '', '2025-05-07', '2025-05-11 12:44:54', '2025-05-11 12:44:54', NULL),
(18, '2a2eafde-1397-441d-8090-f83e48bb85b5', 1, 2, 5, 'Administrative Expenses', NULL, 'صبغ المحل', NULL, NULL, 1500, 'Admin', 'paid', '', '2025-03-17', '2025-05-11 12:53:34', '2025-05-11 12:53:34', NULL),
(19, 'a8cf3cb4-cea3-42f0-af49-c856b8848cec', 1, 2, 5, 'Administrative Expenses', NULL, 'تأمين كهرباء', NULL, NULL, 2000, 'Admin', 'paid', '', '2025-03-20', '2025-05-11 12:54:37', '2025-05-11 12:54:37', NULL),
(20, '5f12a2b1-83ee-477a-9e40-d6518a186f9d', 1, 2, 5, 'Administrative Expenses', NULL, 'اللوحة ساين بورد', NULL, NULL, 5000, 'Admin', 'paid', '', '2025-03-23', '2025-05-11 12:55:16', '2025-05-11 12:55:16', NULL),
(21, '80f5c6da-fa79-4985-8ea5-a7236e780042', 1, 2, 5, 'Administrative Expenses', NULL, 'اعمال حديد الاستاند', NULL, NULL, 12000, 'Admin', 'paid', '', '2025-03-23', '2025-05-11 12:55:46', '2025-05-11 12:55:46', NULL),
(22, 'cb593c66-b1a5-4b30-a46b-67db74abaa97', 1, 2, 5, 'Administrative Expenses', NULL, 'ديكور عامود', NULL, NULL, 1600, 'Admin', 'paid', '', '2025-03-23', '2025-05-11 12:56:15', '2025-05-11 12:56:15', NULL),
(23, 'ec46f368-a140-4c2e-8a52-86abfb7cbb41', 1, 2, 5, 'Administrative Expenses', NULL, 'مكيفات ريفال', NULL, NULL, 9200, 'Admin', 'paid', '', '2025-03-24', '2025-05-11 12:56:52', '2025-05-11 12:56:52', NULL),
(24, '7fdf08c3-552d-40c5-8c11-2b90b3834310', 1, 2, 5, 'Administrative Expenses', NULL, 'اعمال الاصباغ', NULL, NULL, 7500, 'Admin', 'paid', '', '2025-03-24', '2025-05-11 12:57:21', '2025-05-11 12:57:21', NULL),
(25, '288a2a2f-3b10-455b-a36d-07d222df58d2', 1, 2, 5, 'Administrative Expenses', NULL, 'معاملة الكهرباء', NULL, NULL, 500, 'Admin', 'paid', '', '2025-03-24', '2025-05-11 12:58:06', '2025-05-11 12:58:06', NULL),
(26, '32ace665-46f8-4fc4-80a5-7d5fe90a06eb', 1, 2, 5, 'Administrative Expenses', NULL, 'واجهه ذهبي - صبغ حديد', NULL, NULL, 1775, 'Admin', 'paid', '', '2025-03-24', '2025-05-11 12:58:50', '2025-05-11 12:58:50', NULL),
(27, 'c8b8c57d-aa53-4826-963f-d91dd422c915', 1, 2, 5, 'Administrative Expenses', NULL, 'اعمال البلاستر والسباكة', NULL, NULL, 2000, 'Admin', 'paid', '', '2025-03-24', '2025-05-11 12:59:18', '2025-05-11 12:59:18', NULL),
(28, '9dc01e7d-3362-441d-abe1-665ff54d5778', 1, 2, 5, 'Administrative Expenses', NULL, 'بترول', NULL, NULL, 100, 'Admin', 'paid', '', '2025-03-24', '2025-05-11 12:59:58', '2025-05-11 12:59:58', NULL),
(29, '16533452-bdbb-4e46-ba25-464eb89b1b6b', 1, 2, 5, 'Administrative Expenses', NULL, 'دهما للتجارة - عود للتعطير', NULL, NULL, 1260, 'Admin', 'paid', '', '2025-03-24', '2025-05-11 13:01:17', '2025-05-11 13:01:17', NULL),
(30, '952f9094-61c5-4629-ab4a-8be236c4248c', 1, 2, 5, 'Administrative Expenses', NULL, 'مكاين للخلط والتعبئة', NULL, NULL, 8000, 'Admin', 'paid', '', '2025-03-24', '2025-05-11 13:01:51', '2025-05-11 13:01:51', NULL),
(31, '20c3b1ca-a6f5-4364-ac8f-29b23e823fe5', 1, 2, 5, 'Administrative Expenses', NULL, 'بكسات ريفال - الفخامة', NULL, NULL, 1992, 'Admin', 'paid', '', '2025-03-25', '2025-05-11 13:03:17', '2025-05-11 13:03:48', '2025-05-11 13:03:48'),
(32, 'cb0975ba-b26e-437d-814a-6d14f66341c3', 1, 2, 5, 'Administrative Expenses', NULL, 'ثريات', NULL, NULL, 740, 'Admin', 'paid', '', '2025-03-25', '2025-05-11 13:04:24', '2025-05-11 13:04:24', NULL),
(33, '0b83c005-2077-4cb7-9ddc-dab675980da6', 1, 2, 5, 'Administrative Expenses', NULL, 'بيبات مكيفات زيادة', NULL, NULL, 600, 'Admin', 'paid', '', '2025-03-26', '2025-05-11 13:04:57', '2025-05-11 13:04:57', NULL),
(34, '50e2980e-46c6-47b8-a5c6-585edc34b2cc', 1, 2, 6, 'Invoices', NULL, 'كهرباء ومياه', NULL, NULL, 2000, 'Admin', 'paid', '', '2025-04-03', '2025-05-11 13:07:19', '2025-05-11 13:07:19', NULL),
(35, '77ca1fba-488d-4f5b-a2fe-71af39cfdcb4', 1, 2, 5, 'Administrative Expenses', NULL, 'تسكير حساب يسري الديكور كامل', NULL, NULL, 5500, 'Admin', 'paid', '', '2025-04-05', '2025-05-11 13:08:06', '2025-05-11 13:08:06', NULL),
(36, 'da09ab69-36dc-4c39-9488-222d5bbd8dc7', 1, 2, 5, 'Administrative Expenses', NULL, 'مصروفات دي تو دي', NULL, NULL, 84, 'Admin', 'paid', '', '2025-04-14', '2025-05-11 13:09:45', '2025-05-11 13:09:45', NULL),
(37, 'd543c086-4c72-4cfa-8f4c-7a56189c4fe7', 1, 2, 5, 'Administrative Expenses', NULL, 'مصروفات سوبر ماركت', NULL, NULL, 15, 'Admin', 'paid', '', '2025-04-14', '2025-05-11 13:10:34', '2025-05-11 13:10:34', NULL),
(38, 'cc0bb6bf-a46a-4545-84cf-3c4e493b6100', 1, 2, 5, 'Administrative Expenses', NULL, 'فلاش انترنت - المصري للهواتف المتحركة', NULL, NULL, 14, 'Admin', 'paid', '', '2025-04-14', '2025-05-11 13:11:06', '2025-05-11 13:11:06', NULL),
(39, 'bdd13da4-55bd-4799-9a68-83b02ed1cff8', 1, 2, 5, 'Administrative Expenses', NULL, 'ادوات صيانة كوبريسر', NULL, NULL, 180, 'Admin', 'paid', '', '2025-04-05', '2025-05-11 13:11:38', '2025-05-11 13:11:38', NULL),
(40, 'e053fad7-cc8b-43f8-9f6a-9588d9cdf2ad', 1, 2, 5, 'Administrative Expenses', NULL, 'صيانة كوبريسر تصليح', NULL, NULL, 50, 'Admin', 'paid', '', '2025-04-06', '2025-05-11 13:12:46', '2025-05-11 13:12:46', NULL),
(41, '65496566-0654-42fa-801e-2ae475487099', 1, 2, 5, 'Administrative Expenses', NULL, 'افراج لتجارة الهواتف واير نت', NULL, NULL, 25, 'Admin', 'paid', '', '2025-04-25', '2025-05-11 13:14:03', '2025-05-11 13:14:03', NULL),
(42, 'ad8b5432-55fc-411a-b2fd-cf25c1f31cae', 1, 2, 5, 'Administrative Expenses', NULL, 'نيستو هايبر ماركت', NULL, NULL, 97, 'Admin', 'paid', '', '2025-04-04', '2025-05-11 13:14:52', '2025-05-11 13:14:52', NULL),
(43, '24c0f2ce-9b61-4cb3-882f-9c2e290f11ab', 1, 2, 5, 'Administrative Expenses', NULL, 'اكسات سوبر ماركت', NULL, NULL, 41, 'Admin', 'paid', '', '2025-04-05', '2025-05-11 13:15:29', '2025-05-11 13:15:29', NULL),
(44, '6a5551f7-de94-4fc1-95f1-c3bb97c8dbf7', 1, 2, 5, 'Administrative Expenses', NULL, 'ماركت & سيف كواية وسويجات', NULL, NULL, 82, 'Admin', 'paid', '', '2025-04-04', '2025-05-11 13:17:15', '2025-05-11 13:17:15', NULL),
(45, 'c88ec1f9-7f04-46a4-a41b-d85644106176', 1, 2, 6, 'Invoices', NULL, 'الاتحاد للكهرباء والماء', NULL, NULL, 1055, 'Admin', 'paid', '', '2025-04-03', '2025-05-11 13:18:14', '2025-05-11 13:18:14', NULL),
(46, '40b0d27a-c02e-421f-9391-ec68c3c84c4a', 1, 2, 5, 'Administrative Expenses', NULL, 'ms max discount center', NULL, NULL, 14, 'Admin', 'paid', '', '2025-04-05', '2025-05-11 13:18:47', '2025-05-11 13:18:47', NULL),
(47, '5982d58c-0097-4a03-8db3-b52616c5cde5', 1, 2, 5, 'Administrative Expenses', NULL, 'الدليل لتجارة الاثاث المستعمل طاولة مكتب وكرسيين الصناعية', NULL, NULL, 500, 'Admin', 'paid', '', '2025-04-06', '2025-05-11 13:19:19', '2025-05-11 13:19:19', NULL),
(48, '77e9347f-43b4-46f7-980a-9f84fe280881', 1, 2, 5, 'Administrative Expenses', NULL, 'صناعية الشارقة رفوف', NULL, NULL, 320, 'Admin', 'paid', '', '2025-04-06', '2025-05-11 13:19:53', '2025-05-11 13:19:53', NULL),
(49, '1ef9917f-d8dd-4910-86fc-77426f01d5b7', 1, 2, 5, 'Administrative Expenses', NULL, 'برايت هاوس للتجارة العامة', NULL, NULL, 244, 'Admin', 'paid', '', '2025-04-07', '2025-05-11 13:20:24', '2025-05-11 13:20:24', NULL),
(50, 'a1e1f119-4aee-470a-90e6-60cb2992e950', 1, 2, 5, 'Administrative Expenses', NULL, 'اي ام ناتشور الي لايف تريدنج', NULL, NULL, 626, 'Admin', 'paid', '', '2025-04-13', '2025-05-11 13:20:57', '2025-05-11 13:20:57', NULL),
(51, '6b69c2a5-4184-4b24-b548-24f62f5b8b1d', 1, 2, 5, 'Administrative Expenses', NULL, 'اكسات سوبر ماركت', NULL, NULL, 40, 'Admin', 'paid', '', '2025-04-05', '2025-05-11 13:22:43', '2025-05-11 13:22:43', NULL),
(52, 'bc5535de-1b56-4ee1-9f62-edc7ced7d0f6', 1, 2, 5, 'Administrative Expenses', NULL, 'mark and save', NULL, NULL, 121, 'Admin', 'paid', '', '2025-04-08', '2025-05-11 13:23:17', '2025-05-11 13:23:17', NULL),
(53, 'b2ccf00f-b3d7-47c3-8f58-7fd54eddefc6', 1, 2, 5, 'Administrative Expenses', NULL, 'بترول', NULL, NULL, 50, 'Admin', 'paid', '', '2025-04-05', '2025-05-11 13:23:43', '2025-05-11 13:23:43', NULL),
(54, '0395d9d9-9f88-47d1-b94c-fd1375bb72a6', 1, 2, 5, 'Administrative Expenses', NULL, 'السوق الصيني 5 كراسي وطاولتين (دونج فانج ميلان للتجارة )', NULL, NULL, 1239, 'Admin', 'paid', '', '2025-04-13', '2025-05-11 13:24:20', '2025-05-11 13:24:20', NULL),
(55, 'c7362b07-fa9b-4f5c-91d5-2e28a2f742b2', 1, 2, 5, 'Administrative Expenses', NULL, 'تم دفع تكاليف باقي اللوحة', NULL, NULL, 1800, 'Admin', 'paid', '', '2025-04-17', '2025-05-11 13:24:57', '2025-05-11 13:24:57', NULL),
(56, '2c543c5b-4fa1-4d9a-8afa-850dd4e6d044', 1, 2, 5, 'Administrative Expenses', NULL, 'تصليح المكيف', NULL, NULL, 200, 'Admin', 'paid', '', '2025-04-17', '2025-05-11 13:25:24', '2025-05-11 13:25:24', NULL),
(57, '65683991-8d9c-4c7a-beab-8476ef7d4a5b', 1, 2, 5, 'Administrative Expenses', NULL, 'بيترول', NULL, NULL, 50, 'Admin', 'paid', '', '2025-04-17', '2025-05-11 13:25:54', '2025-05-11 13:25:54', NULL),
(58, '85ebd109-6dfc-4d52-8162-35374a057bbb', 1, 2, 5, 'Administrative Expenses', NULL, 'مشتربات محل', NULL, NULL, 70, 'Admin', 'paid', '', '2025-04-17', '2025-05-11 13:26:58', '2025-05-11 13:26:58', NULL),
(59, '03323f80-0938-4e1d-a77d-b4bdb619a84e', 1, 2, 8, 'ADS', NULL, 'اعلانات انستقرام', NULL, NULL, 1612, 'Admin', 'paid', '', '2025-04-15', '2025-05-11 13:29:18', '2025-05-11 13:29:18', NULL),
(60, '2e64c273-c5f1-4208-a057-a95bd9fef4f7', 1, 2, 5, 'Administrative Expenses', NULL, 'شركة بيرفيوم ورد تايلند', NULL, NULL, 5500, 'Admin', 'paid', '', '2025-04-16', '2025-05-11 13:30:17', '2025-05-11 13:30:17', NULL),
(61, 'c9e1d9c9-f79d-4517-bb7d-ecbf7be48ee4', 1, 2, 5, 'Administrative Expenses', NULL, 'صبغ الغرش الملون (ساند شاين)', NULL, NULL, 4500, 'Admin', 'paid', '', '2025-04-17', '2025-05-11 13:30:56', '2025-05-11 13:30:56', NULL),
(62, 'dacfbc26-1ae1-4d72-a2c9-663b885be77a', 1, 2, 5, 'Administrative Expenses', NULL, 'مايك الصوت (نون)', NULL, NULL, 212, 'Admin', 'paid', '', '2025-04-15', '2025-05-11 13:31:30', '2025-05-11 13:31:30', NULL),
(63, '3eaa6cab-dec3-4ac9-bb8e-e45357b41915', 1, 2, 5, 'Administrative Expenses', NULL, 'الطابعة من شرف دي جي', NULL, NULL, 540, 'Admin', 'paid', '', '2025-04-14', '2025-05-11 13:32:02', '2025-05-11 13:52:41', NULL),
(64, '9867ae38-c0b9-4a72-b9cf-b294ed7a5bf6', 1, 2, 5, 'Administrative Expenses', NULL, 'مايكرفون وطوابع', NULL, NULL, 55, 'Admin', 'paid', '', '2025-04-19', '2025-05-11 13:32:33', '2025-05-11 13:32:33', NULL),
(65, '31b139b8-27ee-45a5-a44a-275cdc720113', 1, 2, 5, 'Administrative Expenses', NULL, 'جمارك فيدكس برفيوم ورد', NULL, NULL, 649, 'Admin', 'paid', '', '2025-04-21', '2025-05-11 13:33:05', '2025-05-11 13:33:05', NULL),
(66, '5d064105-072d-4b40-a824-3ad98addf116', 1, 2, 5, 'Administrative Expenses', NULL, 'مشتريات محل', NULL, NULL, 56, 'Admin', 'paid', '', '2025-04-15', '2025-05-11 13:33:33', '2025-05-11 13:33:33', NULL),
(67, '2aad56fe-652b-41fe-9b14-01e104fad2ef', 1, 2, 6, 'Invoices', NULL, 'باقة نت', NULL, NULL, 200, 'Admin', 'paid', '', '2025-04-15', '2025-05-11 13:34:11', '2025-05-11 13:34:11', NULL),
(68, '0bc3c93b-44e6-4ad2-a067-d90e9c0a427e', 1, 2, 5, 'Administrative Expenses', NULL, 'غسيل زجاج', NULL, NULL, 25, 'Admin', 'paid', '', '2025-04-22', '2025-05-11 13:35:06', '2025-05-11 13:35:06', NULL),
(69, 'a404d7de-c53e-41b0-be62-5e9d857c732f', 1, 2, 5, 'Administrative Expenses', NULL, 'لجهاز الصراف نتورك', NULL, NULL, 1575, 'Admin', 'paid', '', '2025-04-23', '2025-05-11 13:36:28', '2025-05-11 13:36:28', NULL),
(70, '5b958093-a6fc-42ab-8a76-7821d51ed318', 1, 2, 8, 'ADS', NULL, 'اعلانين انستقرام', NULL, NULL, 1092, 'Admin', 'paid', '', '2025-04-25', '2025-05-11 13:37:39', '2025-05-11 13:37:39', NULL),
(71, 'cb613b50-2be6-49bb-bece-6c3cb72d6f2f', 1, 2, 8, 'ADS', NULL, 'احمد المصور قيمة التصوير 38 صورة', NULL, NULL, 1140, 'Admin', 'paid', '', '2025-04-27', '2025-05-11 13:38:16', '2025-05-11 13:38:16', NULL),
(72, 'f610d80c-0548-4e5b-81fb-21f707ad7ab6', 1, 2, 5, 'Administrative Expenses', NULL, 'مشتربات محل زينة', NULL, NULL, 422, 'Admin', 'paid', '', '2025-04-28', '2025-05-11 13:38:54', '2025-05-11 13:38:54', NULL),
(73, 'aff62196-1a65-4c86-a873-8432b1dc8e4b', 1, 2, 6, 'Invoices', NULL, 'كهرباء للحسابين', NULL, NULL, 455, 'Admin', 'paid', '', '2025-04-28', '2025-05-11 13:39:34', '2025-05-11 13:39:34', NULL),
(74, '545d0522-1a24-4f37-9aa0-b92bffdc4615', 1, 2, 6, 'Invoices', NULL, 'الصرف الصحي عجمان', NULL, NULL, 280, 'Admin', 'paid', '', '2025-04-28', '2025-05-11 13:40:11', '2025-05-11 13:40:11', NULL),
(75, '8645c9e9-c51e-4e24-a6b0-d98bb984312e', 1, 2, 5, 'Administrative Expenses', NULL, 'تركيب خزاين', NULL, NULL, 100, 'Admin', 'paid', '', '2025-04-30', '2025-05-11 13:40:38', '2025-05-11 13:40:38', NULL),
(76, '81b33cb2-0ae2-419d-88a7-f87a31b027d3', 1, 2, 5, 'Administrative Expenses', NULL, 'علب بلاستيك كيلو بخور', NULL, NULL, 42, 'Admin', 'paid', '', '2025-04-25', '2025-05-11 13:41:20', '2025-05-11 13:41:20', NULL),
(77, 'a56e5d9e-d550-4339-8175-e048c352a3d5', 1, 2, 7, 'Salaries', NULL, 'عبداللة راتب  شهر 4', NULL, NULL, 3500, 'Admin', 'paid', '', '2025-04-30', '2025-05-11 13:42:05', '2025-05-11 13:42:05', NULL),
(78, '2041128f-2487-40b6-b308-eb59581ca73d', 1, 2, 7, 'Salaries', NULL, 'فيصل راتب شهر 4', NULL, NULL, 2000, 'Admin', 'paid', '', '2025-04-30', '2025-05-11 13:42:42', '2025-05-11 13:42:42', NULL),
(79, 'fe6656ed-4311-4c72-8c8a-1b07860014d9', 1, 2, 7, 'Salaries', NULL, 'كولنز  شهر 4', NULL, NULL, 1800, 'Admin', 'paid', '', '2025-04-30', '2025-05-11 13:43:23', '2025-05-11 13:43:23', NULL),
(80, '49714ff8-4823-44cd-9830-c3c22fdc5092', 1, 2, 7, 'Salaries', NULL, 'وضاح  شهر 4', NULL, NULL, 1000, 'Admin', 'paid', '', '2025-04-30', '2025-05-11 13:44:16', '2025-05-11 13:44:16', NULL),
(81, 'fbbe35ea-009e-40f1-8c96-7510e6d96d25', 1, 2, 6, 'Invoices', NULL, 'انترنت دو', NULL, NULL, 209, 'Admin', 'paid', '', '2025-04-30', '2025-05-11 13:44:48', '2025-05-11 13:44:48', NULL),
(82, '4998ed06-68ce-462f-978b-129c1243ab96', 1, 2, 5, 'Administrative Expenses', NULL, 'مصروفات محل', NULL, NULL, 31, 'Admin', 'paid', '', '2025-05-03', '2025-05-11 13:46:03', '2025-05-11 13:46:03', NULL),
(83, 'ee6bc33a-ecf0-4cd5-a4ca-e04891d41a6e', 1, 2, 5, 'Administrative Expenses', NULL, 'مواد قرطاسية', NULL, NULL, 25, 'Admin', 'paid', '', '2025-05-06', '2025-05-11 13:46:47', '2025-05-11 13:46:47', NULL),
(84, 'f713b414-1e0e-48e5-9531-a37c3866fa15', 1, 2, 6, 'Invoices', NULL, 'انترنت تيلفون المحل', NULL, NULL, 50, 'Admin', 'paid', '', '2025-05-07', '2025-05-11 13:47:27', '2025-05-11 13:47:27', NULL),
(85, '66377e59-3cef-4f11-94b1-5b91b0ad869f', 1, 2, 8, 'ADS', NULL, 'اعلان انستقرام', NULL, NULL, 1560, 'Admin', 'paid', '', '2025-05-05', '2025-05-11 13:48:02', '2025-05-11 13:48:02', NULL),
(86, '5e62fc35-db9e-4afe-8aac-465c970380a5', 1, 2, 5, 'Administrative Expenses', NULL, 'شركة دليلي للتوصيل', NULL, NULL, 35, 'Admin', 'paid', '', '2025-05-10', '2025-05-11 13:48:40', '2025-05-11 13:48:40', NULL),
(87, 'ad03a127-e0a6-40e2-abdb-d145fb33c248', 1, 2, 5, 'Administrative Expenses', NULL, 'مكتب وخزانة مع التحميل', NULL, NULL, 490, 'Admin', 'paid', '', '2025-05-11', '2025-05-11 13:49:11', '2025-05-11 13:49:11', NULL),
(88, '8f5ca407-3419-4872-963f-6ccf3f8dcc69', 1, 2, 5, 'Administrative Expenses', NULL, 'معاملة استخراج بطاقة منشأة من الجوازات مع رسوم الطباعة', NULL, NULL, 643, 'Admin', 'paid', '', '2025-05-12', '2025-05-12 15:27:38', '2025-05-12 15:27:38', NULL),
(89, 'e5963f56-1bfa-4243-bc2d-2c5fd7eb1b7c', 1, 2, 5, 'Administrative Expenses', NULL, 'معاملة الجوازات اي جنل E CHANEL مع رسوم الطباعة', NULL, NULL, 3301, 'Admin', 'paid', '', '2025-05-13', '2025-05-13 17:49:27', '2025-05-13 17:49:27', NULL),
(90, '679a638b-88e2-4709-bfdc-1b7f5b78a23a', 1, 2, 5, 'Administrative Expenses', NULL, 'معاملة فتح ملف في العمل والعمال', NULL, NULL, 524, 'Admin', 'paid', '', '2025-05-13', '2025-05-13 17:50:14', '2025-05-15 16:47:32', NULL),
(91, '6aad11a4-9ca6-4671-8f31-26e4eaedee72', 1, 2, 5, 'Administrative Expenses', NULL, NULL, NULL, NULL, 7, 'Admin', 'paid', 'card', '2025-05-15', '2025-05-15 17:16:56', '2025-05-15 17:17:14', '2025-05-15 17:17:14');

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `expense_category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expense_category_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `uuid`, `branch_id`, `expense_category_name`, `expense_category_slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'fbdf2ea8-7a2c-4221-a969-8edbe6fddf9a', 1, 'WATER', 'water', '2025-05-01 18:08:39', '2025-05-04 13:30:30', '2025-05-04 13:30:30'),
(2, 'dd37c59b-5ac7-465a-8f38-9e6c7f0e21a6', 1, 'FUEL', 'fuel', '2025-05-01 18:08:47', '2025-05-04 13:30:25', '2025-05-04 13:30:25'),
(3, 'ae0e6617-6026-4a4e-b50c-b5db8a23db01', 1, 'ش', '-', '2025-05-04 13:31:41', '2025-05-04 13:31:53', '2025-05-04 13:31:53'),
(4, '62339d46-ec60-4647-8519-8e14c0c8622e', 1, 'ش', '-', '2025-05-04 13:31:41', '2025-05-04 13:31:48', '2025-05-04 13:31:48'),
(5, 'dd3855a9-e837-4248-b8f8-ff398f81ac08', 1, 'Administrative Expenses', 'administrative-expenses', '2025-05-04 13:33:02', '2025-05-04 13:33:02', NULL),
(6, '2754f12c-ead1-4341-8ef0-1853d29c198f', 1, 'Invoices', 'invoices', '2025-05-04 13:33:44', '2025-05-04 13:33:44', NULL),
(7, 'b45efda3-db4a-4013-a5b0-df0cc9bb0b07', 1, 'Salaries', 'salaries', '2025-05-04 13:34:33', '2025-05-04 13:34:33', NULL),
(8, '19ab85e1-8800-4ccb-9e4b-a90a7fbe108d', 1, 'ADS', 'ads', '2025-05-11 13:28:07', '2025-05-11 13:28:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_log`
--

CREATE TABLE `inventory_log` (
  `id` int NOT NULL,
  `branch_id` int NOT NULL,
  `user_id` int NOT NULL,
  `customer_id` int DEFAULT NULL,
  `item_id` int NOT NULL,
  `qty` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `open_stock` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `closing_stock` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_log`
--

INSERT INTO `inventory_log` (`id`, `branch_id`, `user_id`, `customer_id`, `item_id`, `qty`, `open_stock`, `closing_stock`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 0, 43, '-3', '8', '5', '2025-04-26 18:41:34', '2025-04-26 18:41:34'),
(2, 1, 2, 0, 18, '-27', '27', '0', '2025-04-28 19:51:10', '2025-04-28 19:51:10'),
(3, 1, 2, 0, 48, '-3', '3', '0', '2025-05-03 22:49:49', '2025-05-03 22:49:49'),
(4, 1, 2, 0, 48, '-3', '0', '-3', '2025-05-03 22:49:50', '2025-05-03 22:49:50'),
(5, 1, 2, 0, 565, '120', '0', '120', '2025-05-05 12:54:21', '2025-05-05 12:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `unit_id` bigint UNSIGNED NOT NULL,
  `item_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_other_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_cost_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `multiple_price` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `item_price` decimal(10,2) DEFAULT '0.00',
  `tax` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `tax_percent` int DEFAULT NULL,
  `barcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` bigint UNSIGNED DEFAULT NULL,
  `minimum_qty` double NOT NULL DEFAULT '0',
  `item_type` enum('1','0','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1 = salable, 0 = non-salable, 2 = raw material',
  `stock_applicable` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1 = yes, 0 = no',
  `ingredient` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '1 = yes, 0 = no',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `active` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `uuid`, `branch_id`, `category_id`, `unit_id`, `item_name`, `item_slug`, `item_other_name`, `item_cost_price`, `multiple_price`, `item_price`, `tax`, `tax_percent`, `barcode`, `stock`, `minimum_qty`, `item_type`, `stock_applicable`, `ingredient`, `image`, `expiry_date`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '294d8cc2-69d7-4da5-a373-7ced2881b4c2', 1, 1, 1, 'IRISH LEATHER', 'irish-leather', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 5, '1', '1', '1', '1744727883.jpg', NULL, 'yes', '2025-04-15 18:03:14', '2025-04-22 14:15:50', '2025-04-22 14:15:50'),
(2, 'dd33b542-db0c-4483-9325-d563ed6b9f10', 1, 5, 1, 'BOTTLE', 'bottle', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 5, '2', '1', '0', '1744727923.jpg', NULL, 'yes', '2025-04-15 18:18:21', '2025-04-22 14:15:18', '2025-04-22 14:15:18'),
(3, '68eb638b-139f-4f65-9e2b-8b5216b65af6', 1, 1, 1, 'test', 'test', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-04-15 18:18:28', '2025-04-15 18:18:33', '2025-04-15 18:18:33'),
(4, '4adacdbd-406b-4bac-aa1d-18fec4d721b5', 1, 5, 4, 'OIL', 'oil', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 5, '2', '1', '0', '1744727952.jpg', NULL, 'yes', '2025-04-15 18:19:25', '2025-04-22 14:16:02', '2025-04-22 14:16:02'),
(5, 'be99450a-9d62-4589-8feb-2b6551181e37', 1, 5, 5, 'ETHANOL', 'ethanol', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 5, '2', '1', '0', '1744727901.jpg', NULL, 'yes', '2025-04-15 18:20:00', '2025-04-22 14:15:34', '2025-04-22 14:15:34'),
(6, '921c73f4-82f9-4e7d-8ab6-97e915a18528', 1, 5, 1, 'BOX', 'box', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 5, '2', '1', '0', '1744727893.jpg', NULL, 'yes', '2025-04-15 18:20:26', '2025-04-22 14:15:26', '2025-04-22 14:15:26'),
(7, '47101e60-5e1b-4d4a-96dd-16d9b3647816', 1, 10, 1, 'bumb', 'bumb', 'bumb', '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1000, '2', '1', '1', '', NULL, 'yes', '2025-04-15 18:59:11', '2025-04-28 19:41:07', NULL),
(8, '1e8a22a7-4bfc-40a5-b13e-683b65d497dc', 1, 2, 1, 'savage', 'savage', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-15 19:15:40', '2025-04-15 19:15:40', NULL),
(9, '45ae360a-06e1-4b8b-8dd9-b6c53ea0b96d', 1, 2, 1, 'le belle', 'le-belle', '', '50', 'no', 50.00, '', 0, '534609', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(10, 'c5cbd705-4143-47fd-b52f-d3941614789c', 1, 2, 1, 'dep masay', 'dep-masay', '', '50', 'no', 50.00, '', 0, '679734', 7, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(11, '43ee31fd-cfeb-489d-82a0-570017581752', 1, 2, 1, 'shumokh', 'shumokh', '', '50', 'no', 50.00, '', 0, '873626', 7, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(12, '4275730b-1d50-4b06-85a3-91038b3c23ed', 1, 2, 1, 'iris leather', 'iris-leather', '', '50', 'no', 50.00, '', 0, '780440', 7, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(13, '577712e4-b275-46a7-b698-ea147bb9ce6d', 1, 2, 1, 'mis bloming', 'mis-bloming', '', '50', 'no', 50.00, '', 0, '766645', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(14, '2e0c2a09-fa8b-4da1-acf5-ba013e4e538e', 1, 2, 1, 'ulttra male', 'ulttra-male', '', '50', 'no', 50.00, '', 0, '414740', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(15, '27cbcc76-8500-4cee-a094-ee4682600092', 1, 2, 1, 'red tabaco', 'red-tabaco', '', '50', 'no', 50.00, '', 0, '906207', 7, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(16, 'b1ca8f64-9761-4240-b519-74f19aad9622', 1, 2, 1, 'insolnce', 'insolnce', '', '50', 'no', 50.00, '', 0, '952503', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(17, 'ed649f3f-409f-45cb-8102-7ba74631116c', 1, 2, 1, 'hachivat', 'hachivat', '', '50', 'no', 50.00, '', 0, '617426', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(18, '1c8c4a89-277e-4cdb-b2ae-de930ab45a7a', 1, 2, 1, 'akuya', 'akuya', '', '50', 'no', 50.00, '', 0, '405928', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(19, 'ac5e280c-ad61-4787-9ff0-5dee35cdf359', 1, 2, 1, 'avntus', 'avntus', '', '50', 'no', 50.00, '', 0, '908731', 0, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(20, 'c1e15216-cc63-442a-9e26-7b49df293481', 1, 2, 1, 'garcoon', 'garcoon', '', '50', 'no', 50.00, '', 0, '824819', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(21, '36ea04b8-87c8-4bfc-ad38-7a24f9a89e92', 1, 2, 1, 'paradox', 'paradox', '', '50', 'no', 50.00, '', 0, '224518', 7, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(22, '4f965934-a8e4-406f-a5fd-980d6553830a', 1, 2, 1, 'imperial', 'imperial', '', '50', 'no', 50.00, '', 0, '600643', 4, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(23, 'd6815f11-7874-4eb0-8b92-faca3253be34', 1, 2, 1, 'O20', 'o20', '', '50', 'no', 50.00, '', 0, '788398', 8, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(24, '2b256cb4-9702-4284-ae0a-21a497ce3b44', 1, 2, 1, 'althar', 'althar', '', '50', 'no', 50.00, '', 0, '356431', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(25, '0ad8bb98-4e76-464b-a2c1-951b1176c57b', 1, 2, 1, 'abu dhabi', 'abu-dhabi', '', '50', 'no', 50.00, '', 0, '676863', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(26, '3b9227e6-6178-40a4-8161-b240d5fb9309', 1, 2, 1, 'madhawi', 'madhawi', '', '50', 'no', 50.00, '', 0, '650725', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(27, '13c52b34-5848-4e38-b8a2-5ccbfd2471e4', 1, 2, 1, 'delina exc', 'delina-exc', '', '50', 'no', 50.00, '', 0, '686713', 7, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(28, '9d8130f4-42a1-4592-a124-6f1049c1592f', 1, 2, 1, 'gullty absolute', 'gullty-absolute', '', '50', 'no', 50.00, '', 0, '196689', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(29, '4f78fb0d-7c4d-49e7-b193-3d57647b5fa1', 1, 2, 1, 'savage', 'savage', '', '50', 'no', 50.00, '', 0, '797887', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(30, 'b8f534d1-e0e2-45e4-888d-2941fb193690', 1, 2, 1, 'idol', 'idol', '', '50', 'no', 50.00, '', 0, '547352', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(31, '5a002ccc-89f1-4a56-a3b1-64320850fc4d', 1, 2, 1, 'gaidance', 'gaidance', '', '50', 'no', 50.00, '', 0, '198406', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(32, '049fe06a-ca20-42f8-9a23-1a27a41d77f8', 1, 2, 1, 'coco', 'coco', '', '50', 'no', 50.00, '', 0, '788032', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(33, '5b57c6da-344d-476c-93ff-007e3dcd5944', 1, 2, 1, 'la male ex', 'la-male-ex', '', '50', 'no', 50.00, '', 0, '232126', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(34, '1ba72aef-6352-46e3-b670-a4aeaee22cf8', 1, 2, 1, 'dukhoon', 'dukhoon', '', '50', 'no', 50.00, '', 0, '629520', 7, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(35, 'ac35910e-b9bd-47b4-b866-4c45e4c9a441', 1, 2, 1, 'mydan square', 'mydan-square', 'mydan ميدان', '0', 'no', 0.00, '', 0, NULL, 7, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 14:12:03', NULL),
(36, 'ddc37e7f-50b3-48a9-9dad-d75fe8505ca8', 1, 2, 1, 'oud zafran', 'oud-zafran', '', '50', 'no', 50.00, '', 0, '262803', 7, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(37, '51ef23b7-3a8d-4d81-8f47-8de23a90ae74', 1, 2, 1, 'libr', 'libr', '', '50', 'no', 50.00, '', 0, '803062', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(38, '474fed63-b71e-411b-8fd1-42b770d6ae21', 1, 2, 1, 'you leather', 'you-leather', '', '50', 'no', 50.00, '', 0, '532441', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(39, '10011b99-e658-4720-a6d0-e2e914027df9', 1, 2, 1, 'you', 'you', '', '50', 'no', 50.00, '', 0, '519232', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(40, '7dc84bb1-90f3-421c-a4b0-52f11d526743', 1, 2, 1, 'lnterdit', 'lnterdit', '', '50', 'no', 50.00, '', 0, '640139', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(41, 'f6a6e63d-a804-43e5-961b-b3febc5a491a', 1, 2, 1, 'gres', 'gres', '', '50', 'no', 50.00, '', 0, '106852', 7, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(42, '3e733aa3-c5d0-4356-a981-ba6f6609651d', 1, 2, 1, 'la lona', 'la-lona', '', '50', 'no', 50.00, '', 0, '557395', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(43, '7fcf0d5a-ea88-4938-9abf-ceb4b907b7c0', 1, 2, 1, '1984', '1984', NULL, '0', 'no', 0.00, '', 0, NULL, 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-26 18:31:59', NULL),
(44, '1ce7cf43-aa48-4edb-967f-a765b48afa19', 1, 2, 1, 'baby powder', 'baby-powder', '', '50', 'no', 50.00, '', 0, '507957', 7, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(45, '63b98bd0-c061-4831-b608-5d1df50197a0', 1, 2, 1, 'al tarahib', 'al-tarahib', '', '50', 'no', 50.00, '', 0, '183683', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(46, '91eee6e8-14a8-4580-90da-74123fc5c6d2', 1, 2, 1, 'avntus absolu', 'avntus-absolu', '', '50', 'no', 50.00, '', 0, '323150', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(47, '94ccb6a5-455f-41bc-84af-722a6673b875', 1, 2, 1, 'baby catt', 'baby-catt', '', '50', 'no', 50.00, '', 0, '772645', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(48, '29378efd-64f5-4276-97b7-a5dcb201e24b', 1, 2, 1, 'sekushi', 'sekushi', '', '50', 'no', 50.00, '', 0, '913694', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(49, '1eaca27d-4812-4237-a1e9-565534cf3dd3', 1, 2, 1, 'floora', 'floora', '', '50', 'no', 50.00, '', 0, '473490', 6, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(50, '00ebb75c-732b-4f6c-853e-7272a83138b5', 1, 2, 1, 'taxedo', 'taxedo', '', '50', 'no', 50.00, '', 0, '952737', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(51, 'ba2db869-1dd4-4e31-be30-6bf2030decec', 1, 2, 1, '2020', '2020', '', '50', 'no', 50.00, '', 0, '786079', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(52, '491aee3d-3416-4bb4-99c2-25ba8076a586', 1, 2, 1, 'bacarat', 'bacarat', '', '50', 'no', 50.00, '', 0, '675262', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(53, 'bbeaa1a5-e7b2-421f-a52b-5e5a42a1e388', 1, 2, 1, 'opuim', 'opuim', '', '50', 'no', 50.00, '', 0, '394846', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(54, '6c551c1a-98bc-4a7e-8bfe-84eeaf2ff197', 1, 2, 1, 'bluenel', 'bluenel', '', '50', 'no', 50.00, '', 0, '180594', 6, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(55, '3ebdb6a6-cd49-4df7-909a-3022cf37a3e4', 1, 2, 1, 'god girl', 'god-girl', '', '50', 'no', 50.00, '', 0, '153864', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(56, 'c597c3a5-7750-4c01-8680-7aa4a0e02d3f', 1, 2, 1, 'arba pura', 'arba-pura', '', '50', 'no', 50.00, '', 0, '550364', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(57, '20b5c287-9203-458e-a2a8-1fb684d609d4', 1, 2, 1, 'rose vanilla', 'rose-vanilla', '', '50', 'no', 50.00, '', 0, '788213', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(58, 'bf946035-ae59-4a85-beb5-a209379bdfc9', 1, 2, 1, 'hudson', 'hudson', '', '50', 'no', 50.00, '', 0, '839666', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(59, '0b727e93-6319-432b-b15d-cb4f2c6ee2fb', 1, 2, 1, 'home intense', 'home-intense', '', '50', 'no', 50.00, '', 0, '249140', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(60, '4df5ceb1-efd6-4638-953f-58090e1282e2', 1, 2, 1, 'la vie abelle', 'la-vie-abelle', '', '50', 'no', 50.00, '', 0, '289100', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(61, '86e515d5-5f19-4a8c-a1ab-ba082284cf52', 1, 2, 1, 'scndal with him', 'scndal-with-him', '', '50', 'no', 50.00, '', 0, '974366', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(62, '00c467e9-5e7a-4c3c-9227-bf434d98f489', 1, 2, 1, 'master', 'master', '', '50', 'no', 50.00, '', 0, '659111', 4, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(63, '3adb8c14-a155-47c5-8cb1-707c577e5a79', 1, 2, 1, 'COLLECTOR', 'collector', '', '50', 'no', 50.00, '', 0, '145118', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(64, '9957ccfb-a286-45be-a864-bd0a2f77c0bc', 1, 2, 1, 'GUILTY ELIXIR', 'guilty-elixir', '', '50', 'no', 50.00, '', 0, '144933', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(65, 'a4507bd9-0986-4416-b2d2-c515fc5cade1', 1, 2, 1, 'MARVO', 'marvo', '', '50', 'no', 50.00, '', 0, '140180', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(66, '61cc9a3d-3d4d-4382-84e7-4760bdc9c001', 1, 2, 1, 'tahnoun  ex', 'tahnoun-ex', '', '50', 'no', 50.00, '', 0, '555522', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(67, 'a4eac9b0-e75b-47e9-ad1c-a6f4f9eaae49', 1, 2, 1, '1990', '1990', '', '50', 'no', 50.00, '', 0, '596464', 10, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(68, 'db73e517-050b-4778-93c9-db8a605d97e2', 1, 2, 1, 'milan', 'milan', '', '50', 'no', 50.00, '', 0, '851891', 11, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(69, '52acb31c-1c30-433e-9d10-1a528d3aa9eb', 1, 2, 1, 'TYGER', 'tyger', '', '50', 'no', 50.00, '', 0, '149201', 9, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(70, 'a5bac075-801d-42b6-b213-a14f3c55d26e', 1, 2, 1, 'Tahnoon', 'tahnoon', 'طحنون', '0', 'no', 0.00, '', 0, NULL, 10, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 14:11:37', NULL),
(71, '0e819a0e-486a-4b3e-8ff8-5e58a71c983d', 1, 2, 1, 'Sheikh Abdullah', 'sheikh-abdullah', 'الشيخ عبدالله', '0', 'no', 0.00, '', 0, NULL, 30, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 14:11:23', NULL),
(72, 'fd37c2d5-ec53-4d01-ab0f-46d33fb6d0d3', 1, 2, 1, 'FRUITY OUD', 'fruity-oud', '', '50', 'no', 50.00, '', 0, '534926', 10, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(73, '4cdb8c68-cccd-4b4c-bdb5-a0e1eeb1d8d4', 1, 2, 1, 'L hebiscus', 'l-hebiscus', '', '50', 'no', 50.00, '', 0, '320400', 10, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(74, 'e00a9d78-77b5-4864-b80a-9ef9151dd9f3', 1, 2, 1, 'nsayeb', 'nsayeb', '', '50', 'no', 50.00, '', 0, '630537', 10, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(75, '2bca87bd-08e6-4e03-8611-e543a03269f4', 1, 2, 1, 'OUD VANILLA', 'oud-vanilla', '', '50', 'no', 50.00, '', 0, '133111', 26, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(76, 'ccd376a0-2712-43e4-9517-762b2e0c58be', 1, 2, 1, 'scandel women', 'scandel-women', '', '50', 'no', 50.00, '', 0, '363512', 11, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(77, '34a92e3a-7cdd-495d-bad5-94601b522325', 1, 2, 1, 'THE WAY', 'the-way', '', '50', 'no', 50.00, '', 0, '191172', 11, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(78, 'a80150dc-9a0c-4c10-bdd1-a105049881db', 1, 2, 1, 'PINKY', 'pinky', '', '50', 'no', 50.00, '', 0, '817195', 21, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(79, '64168d86-c5f3-43db-89eb-79d07528dda4', 1, 2, 1, 'invictus elixir', 'invictus-elixir', '', '50', 'no', 50.00, '', 0, '292241', 11, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(80, 'd4dd284f-5d30-4896-b587-8d3099fa4c39', 1, 2, 1, 'imagination', 'imagination', '', '50', 'no', 50.00, '', 0, '584021', 11, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(81, '56105abe-dcce-44c6-be37-ca2bb983453c', 1, 2, 1, 'azaran', 'azaran', '', '50', 'no', 50.00, '', 0, '914029', 10, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-18 10:10:25', NULL),
(82, '782eac11-3f6b-4783-a24b-24ca3d7dff2d', 1, 1, 1, 'HUDSON', 'hudson', '', '50', 'no', 50.00, '', 0, '439437', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-22 14:18:04', '2025-04-22 14:18:04'),
(83, 'ce73ab95-0a90-4a10-bb68-4bfed048d8b0', 1, 1, 1, 'THE WAY', 'the-way', '', '50', 'no', 50.00, '', 0, '134931', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-22 14:18:04', '2025-04-22 14:18:04'),
(84, 'cea5e522-1831-47ce-9219-c8cf155f9517', 1, 1, 1, 'SHAY OUD', 'shay-oud', '', '50', 'no', 50.00, '', 0, '917385', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-22 14:18:04', '2025-04-22 14:18:04'),
(85, '7c814ad0-faa2-4909-a552-367c0f853b83', 1, 1, 1, 'SHIKAH ABDULLLAH', 'shikah-abdulllah', '', '80', 'no', 80.00, '', 0, '617448', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-22 14:18:04', '2025-04-22 14:18:04'),
(86, '3cffec7f-e37c-4270-aa9c-a27548feb13c', 1, 1, 1, 'SHAY SHAY', 'shay-shay', '', '50', 'no', 50.00, '', 0, '753432', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-22 14:18:04', '2025-04-22 14:18:04'),
(87, 'c205b763-8116-4219-9eff-52de33e76b3b', 1, 1, 1, 'SHAY OUD', 'shay-oud', '', '50', 'no', 50.00, '', 0, '617207', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-22 14:18:04', '2025-04-22 14:18:04'),
(88, 'bd9d87bf-0f7f-45bb-b21f-fb5fa103ffe5', 1, 1, 1, 'GISSAH', 'gissah', '', '50', 'no', 50.00, '', 0, '522765', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-22 14:18:04', '2025-04-22 14:18:04'),
(89, 'cc1de638-937d-4d8a-aa49-cac4f9b46a6c', 1, 1, 1, 'SHUMUKH', 'shumukh', '', '50', 'no', 50.00, '', 0, '503887', 5, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-18 10:10:25', '2025-04-22 14:18:04', '2025-04-22 14:18:04'),
(90, '47ec4748-b02d-4ca8-aeaf-5ce99f2cae7d', 1, 6, 4, 'OIL 020', 'oil-020', '', '1550', 'no', 1550.00, '', 0, '714657', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(91, 'a6076da0-e67d-4e13-b744-dc50a37c425c', 1, 6, 4, 'OIL 020(WHITE)', 'oil-020-white-', '', '850', 'no', 850.00, '', 0, '191067', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(92, '491d2588-4ad1-468a-a2bc-eacb980ac6a2', 1, 6, 4, 'OIL 2020', 'oil-2020', '', '900', 'no', 900.00, '', 0, '592135', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(93, 'cc5bca0e-f0b8-4db1-9944-4233db7eabc8', 1, 6, 4, 'OIL 82', 'oil-82', '', '1500', 'no', 1500.00, '', 0, '502858', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(94, 'b0dc0401-29cc-47ad-b31a-dd7cc158c9d8', 1, 6, 4, 'OIL ABDALMAJEED', 'oil-abdalmajeed', '', '750', 'no', 750.00, '', 0, '934478', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(95, '4a5bb17e-156e-4cd2-b25a-bbf1051a73f1', 1, 6, 4, 'OIL ABSOLUTE AVENTUS', 'oil-absolute-aventus', '', '800', 'no', 800.00, '', 0, '878808', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(96, 'eb16a963-a561-4e83-ae5e-31701c95d196', 1, 6, 4, 'OIL ABUDHABI', 'oil-abudhabi', '', '1300', 'no', 1300.00, '', 0, '845889', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(97, '394ce276-32b1-4265-b023-552c66797b01', 1, 6, 4, 'OIL ACQUA DI GIO', 'oil-acqua-di-gio', '', '850', 'no', 850.00, '', 0, '725144', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(98, '82a64511-9dfd-426c-a3a4-dce7da828801', 1, 6, 4, 'OIL ADDICT DIOR', 'oil-addict-dior', '', '650', 'no', 650.00, '', 0, '713185', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(99, '37fe09f6-e755-4d8b-ae95-47e856ab84b7', 1, 6, 4, 'OIL AFGANI', 'oil-afgani', '', '1000', 'no', 1000.00, '', 0, '789192', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(100, '34e650e1-118f-4a23-bbf6-5afec09f3cc7', 1, 6, 4, 'OIL AGHLA SHAY', 'oil-aghla-shay', '', '900', 'no', 900.00, '', 0, '723347', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(101, 'd3ca507b-5157-467d-943a-76d31191dfa8', 1, 6, 4, 'OIL AHOJAS', 'oil-ahojas', '', '800', 'no', 800.00, '', 0, '968120', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(102, 'ab65231b-485e-43a1-b4e8-54aa0aaa6423', 1, 6, 4, 'OIL AL TARAHEEB', 'oil-al-taraheeb', '', '680', 'no', 680.00, '', 0, '456344', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(103, '19cc8b52-c891-474b-a49d-ef274fe137d8', 1, 6, 4, 'OIL AL THAIER', 'oil-al-thaier', '', '780', 'no', 780.00, '', 0, '315693', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(104, '54beacef-5f2c-49d4-b5ee-00b092c38160', 1, 6, 4, 'OIL ALIEN', 'oil-alien', '', '850', 'no', 850.00, '', 0, '702233', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(105, 'e07a360d-1f81-4a95-9b9c-08c78a6ccab9', 1, 6, 4, 'OIL ALLURE HOMME SPORT', 'oil-allure-homme-sport', '', '850', 'no', 850.00, '', 0, '545003', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(106, '63d9a39c-388e-4ab4-99a4-9f0075f6a325', 1, 6, 4, 'OIL AMBER NUIT', 'oil-amber-nuit', '', '1000', 'no', 1000.00, '', 0, '395936', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(107, 'e4a1f929-bdda-4ca2-a8d8-9bc1e8f8ba62', 1, 6, 4, 'OIL ANGELS SHARE', 'oil-angels-share', '', '1050', 'no', 1050.00, '', 0, '531475', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(108, '6a12baeb-f2df-48ad-8d33-0a14d9ad05a9', 1, 6, 4, 'OIL AOUD WOOD', 'oil-aoud-wood', '', '1050', 'no', 1050.00, '', 0, '155412', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(109, '20a62b67-f6a4-4c2e-8ce6-e28e8c35fb0f', 1, 6, 4, 'OIL ARMANI CODE', 'oil-armani-code', '', '900', 'no', 900.00, '', 0, '997466', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(110, '6c3897b2-d71a-4998-b7a0-4acd9e9d6e53', 1, 6, 4, 'OIL ASK', 'oil-ask', '', '1200', 'no', 1200.00, '', 0, '310060', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(111, '611eef6d-8ee6-4684-815a-bf89c2afa779', 1, 6, 4, 'OIL AYESH SAEED', 'oil-ayesh-saeed', '', '1100', 'no', 1100.00, '', 0, '412905', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(112, '3d11c53a-d918-4117-9147-3c8566c483b1', 1, 6, 4, 'OIL AZARAN', 'oil-azaran', '', '1350', 'no', 1350.00, '', 0, '345126', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(113, '17115275-64ed-4823-a894-f2ef06a2c1b0', 1, 6, 4, 'OIL BABY CAT', 'oil-baby-cat', '', '760', 'no', 760.00, '', 0, '953766', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(114, 'bb27b413-b772-4a56-ab79-18b498477713', 1, 6, 4, 'OIL BABY PAWDER', 'oil-baby-pawder', '', '450', 'no', 450.00, '', 0, '266226', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(115, 'c23be088-1cf4-4162-90c2-6763408d3096', 1, 6, 4, 'OIL BACCARAT ROUGE', 'oil-baccarat-rouge', '', '850', 'no', 850.00, '', 0, '951480', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(116, 'd1b0124d-19f1-4342-b17f-010580fb2f99', 1, 6, 4, 'OIL BARARI', 'oil-barari', '', '980', 'no', 980.00, '', 0, '912265', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(117, '918478bc-bf63-4883-98b5-38562416d75f', 1, 6, 4, 'OIL BECAUSE ITS YOU', 'oil-because-its-you', '', '650', 'no', 650.00, '', 0, '223352', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(118, '34d7db29-139f-4a6d-8a24-06a91a910cc2', 1, 6, 4, 'OIL BITTER PEACH', 'oil-bitter-peach', '', '750', 'no', 750.00, '', 0, '890723', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(119, 'd353f173-04ee-46a5-822f-d72fba8314c8', 1, 6, 4, 'OIL BLACK IRIS', 'oil-black-iris', '', '1150', 'no', 1150.00, '', 0, '972837', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(120, '05822e38-e7d7-415c-8569-6b5eb1b1e26a', 1, 6, 4, 'OIL BLACK OPIUM', 'oil-black-opium', '', '850', 'no', 850.00, '', 0, '270788', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(121, '64871dc4-3bef-41fa-af1c-127853a6c642', 1, 6, 4, 'OIL BLACK ORCHID', 'oil-black-orchid', '', '850', 'no', 850.00, '', 0, '410857', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(122, '74b360ee-e4cd-441d-baea-912a3b62831e', 1, 6, 4, 'OIL BLACK OUD', 'oil-black-oud', '', '', 'no', 0.00, '', 0, '285955', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(123, '42dc5a49-3b5b-47a1-b5d6-023acb8dd5a0', 1, 6, 4, 'OIL BLACK PATCHOULI', 'oil-black-patchouli', '', '800', 'no', 800.00, '', 0, '984415', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(124, '27b42915-e803-4c54-82f2-879efecce3f1', 1, 6, 4, 'OIL BLACK SAFFRON', 'oil-black-saffron', '', '1100', 'no', 1100.00, '', 0, '979452', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(125, 'c5e4df92-9259-441f-a27b-c0f840f512f6', 1, 6, 4, 'OIL BLOOM', 'oil-bloom', '', '890', 'no', 890.00, '', 0, '784769', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(126, '0f832312-cb9c-4290-a936-be1a1881b15a', 1, 6, 4, 'OIL BOIS IMPERIAL', 'oil-bois-imperial', '', '1100', 'no', 1100.00, '', 0, '389358', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(127, '660930d7-6b92-4ad6-9f8e-5adb396f58b8', 1, 6, 4, 'OIL BONNE BABY', 'oil-bonne-baby', '', '', 'no', 0.00, '', 0, '533000', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(128, '09215d5b-d098-46af-8426-063bad5410a8', 1, 6, 4, 'OIL BROMPTION', 'oil-bromption', '', '900', 'no', 900.00, '', 0, '539544', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(129, '1d834e6d-de53-44ea-8f24-20a0d25f0826', 1, 6, 4, 'OIL BUKHOOR NO 9', 'oil-bukhoor-no-9', '', '1200', 'no', 1200.00, '', 0, '212050', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(130, 'ecdfe642-6a9a-4141-be7c-620ab36632cf', 1, 6, 4, 'OIL CABRI', 'oil-cabri', '', '1050', 'no', 1050.00, '', 0, '231448', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(131, '7aa67d47-c8ac-4da1-b690-653fc4c178ee', 1, 6, 4, 'OIL CABRIOLE BABY', 'oil-cabriole-baby', '', '800', 'no', 800.00, '', 0, '694531', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(132, 'b4a2b4b5-1161-4d7e-ad82-38f7d1723e68', 1, 6, 4, 'OIL CALABRIA', 'oil-calabria', '', '800', 'no', 800.00, '', 0, '495214', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(133, '71ea750f-4cc8-47f2-a7b5-ebefc4ca5da6', 1, 6, 4, 'OIL CHANCE CHANEL', 'oil-chance-chanel', '', '830', 'no', 830.00, '', 0, '256098', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(134, '47ce016f-7f15-4e47-81f3-9d94c2c9cb80', 1, 6, 4, 'OIL CHANEL N5', 'oil-chanel-n5', '', '650', 'no', 650.00, '', 0, '509982', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(135, 'a42d034e-b6bc-4a3a-b3d7-391a8b6c5a66', 1, 6, 4, 'OIL CHARNEL EXTRAIT', 'oil-charnel-extrait', '', '1250', 'no', 1250.00, '', 0, '909664', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(136, '58645312-bcf3-409f-bed5-793468f9611b', 1, 6, 4, 'OIL CHEESE CAKE', 'oil-cheese-cake', '', '850', 'no', 850.00, '', 0, '757568', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(137, '37691539-2420-4ff0-8f1f-15aaf0ea1a69', 1, 6, 4, 'OIL CINEMA', 'oil-cinema', '', '850', 'no', 850.00, '', 0, '409050', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(138, 'fcb763ba-73c4-4c24-b753-885a03d28e40', 1, 6, 4, 'OIL COCO', 'oil-coco', '', '900', 'no', 900.00, '', 0, '823700', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(139, '910a80fc-5ba6-4c33-b7c6-fd8bbb8b5ed8', 1, 6, 4, 'OIL COMPLEX', 'oil-complex', '', '800', 'no', 800.00, '', 0, '836660', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(140, '9ba94c31-774e-431e-ad29-6fdc3469c8d2', 1, 6, 4, 'OIL COOLWATER', 'oil-coolwater', '', '750', 'no', 750.00, '', 0, '233817', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(141, '58974be2-5169-433a-8eb9-aab02f10638e', 1, 6, 4, 'OIL COROMANDEL CHANEL', 'oil-coromandel-chanel', '', '1200', 'no', 1200.00, '', 0, '249817', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(142, 'a3596141-3566-4b0e-8eda-858b953fd1d1', 1, 6, 4, 'OIL CREED AVENTUS', 'oil-creed-aventus', '', '880', 'no', 880.00, '', 0, '412754', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(143, '85be2319-3c72-41e9-a666-fdc820809fa5', 1, 6, 4, 'OIL CREED SILVER MOUNTAIN', 'oil-creed-silver-mountain', '', '650', 'no', 650.00, '', 0, '534802', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(144, '8a78f459-bbcf-46f7-be1e-71c97bec6cf6', 1, 6, 4, 'OIL CRYSTAL NOIR', 'oil-crystal-noir', '', '800', 'no', 800.00, '', 0, '191284', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(145, '412219ce-26a5-4d14-a8d7-a07847acc4f7', 1, 6, 4, 'OIL CRYSTAL SAFFRON', 'oil-crystal-saffron', '', '900', 'no', 900.00, '', 0, '321077', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(146, '9ad8550f-dd5b-4f17-a770-b5558339db38', 1, 6, 4, 'OIL CUIR INTENSE', 'oil-cuir-intense', '', '1200', 'no', 1200.00, '', 0, '165755', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(147, 'acb6a7d2-3659-44b0-bb3c-f3da77d587b8', 1, 6, 4, 'OIL DECLORATION', 'oil-decloration', '', '980', 'no', 980.00, '', 0, '489428', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(148, 'a1a09485-d6c9-4e35-8d46-8bfaeae0dc2d', 1, 6, 4, 'OIL DEEP MASAEY', 'oil-deep-masaey', '', '900', 'no', 900.00, '', 0, '688383', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(149, '04f2240b-b68c-41e8-a3d6-b567984b1ea5', 1, 6, 4, 'OIL DELINA', 'oil-delina', '', '850', 'no', 850.00, '', 0, '350048', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(150, 'aa73a84e-712e-40f4-bce9-95383fd29fdb', 1, 6, 4, 'OIL DELINA EXCLUSIVE', 'oil-delina-exclusive', '', '1150', 'no', 1150.00, '', 0, '644569', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(151, '8186531d-7acf-46bb-91e3-ce7b4d2d4434', 1, 6, 4, 'OIL DESERT OUD', 'oil-desert-oud', '', '1050', 'no', 1050.00, '', 0, '717393', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(152, '98188940-b38c-4f4f-83b6-1c2b06d4fe6a', 1, 6, 4, 'OIL DIOR HOME INTENSE', 'oil-dior-home-intense', '', '850', 'no', 850.00, '', 0, '941388', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(153, '859252e6-bbba-4074-b06c-3046c3c15951', 1, 6, 4, 'OIL DYLAN BLUE MAN', 'oil-dylan-blue-man', '', '850', 'no', 850.00, '', 0, '152852', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(154, '4d006ecf-5c41-45e2-afe4-ee5627696e67', 1, 6, 4, 'OIL ELIE SAAB', 'oil-elie-saab', '', '850', 'no', 850.00, '', 0, '286115', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(155, 'ed202bcd-ead5-4726-bb61-d15206b398c1', 1, 6, 4, 'OIL ELLORA', 'oil-ellora', '', '950', 'no', 950.00, '', 0, '196568', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(156, 'a064093d-fbfa-4f29-8438-4d797cd12afb', 1, 6, 4, 'OIL EMARATI MUSK', 'oil-emarati-musk', '', '850', 'no', 850.00, '', 0, '268497', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(157, 'f3bf0416-cf86-436e-8935-c0776b799c48', 1, 6, 4, 'OIL EMERALD OUD DKHOUN', 'oil-emerald-oud-dkhoun', '', '1600', 'no', 1600.00, '', 0, '760450', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(158, '2877f035-f3f2-44e0-8220-fedb4b473738', 1, 6, 4, 'OIL ENFANT BABY', 'oil-enfant-baby', '', '550', 'no', 550.00, '', 0, '175728', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(159, '1fa5a476-f2df-466b-bb1d-571a8e892c0c', 1, 6, 4, 'OIL EPIC M', 'oil-epic-m', '', '900', 'no', 900.00, '', 0, '433052', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(160, 'fb4ba48e-8cdf-47bc-b5e3-1943a98a4403', 1, 6, 4, 'OIL EPIC W', 'oil-epic-w', '', '', 'no', 0.00, '', 0, '804068', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(161, 'e863fa8c-5753-45cb-9d25-7b123092afc3', 1, 6, 4, 'OIL ERBA PURA', 'oil-erba-pura', '', '1280', 'no', 1280.00, '', 0, '180134', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(162, '0322e9b5-ccba-4881-8f52-24118260f61b', 1, 6, 4, 'OIL EROS VERSACE', 'oil-eros-versace', '', '800', 'no', 800.00, '', 0, '405501', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(163, 'fb18653a-3d55-4503-a043-ff4b2deb0dcd', 1, 6, 4, 'OIL EXPLORER', 'oil-explorer', '', '680', 'no', 680.00, '', 0, '799159', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(164, '814c60c4-f7b2-4b5a-b84e-afe049177135', 1, 6, 4, 'OIL FABLOUS', 'oil-fablous', '', '1200', 'no', 1200.00, '', 0, '147857', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(165, '4b29d670-440c-4dd7-8bc6-bcf92f808cce', 1, 6, 4, 'OIL FAHRENHEIT', 'oil-fahrenheit', '', '850', 'no', 850.00, '', 0, '221875', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(166, '90da9ef0-db67-4768-8d18-a3dab6da3445', 1, 6, 4, 'OIL FALCON LEATHER', 'oil-falcon-leather', '', '1000', 'no', 1000.00, '', 0, '400709', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(167, 'b2231cf3-22ab-414e-abe0-060e9c779e18', 1, 6, 4, 'OIL FALKAR', 'oil-falkar', '', '1700', 'no', 1700.00, '', 0, '413672', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(168, '7c109b9c-62a0-40d0-83a3-cc9353757b6c', 1, 6, 4, 'OIL FLORA', 'oil-flora', '', '880', 'no', 880.00, '', 0, '237848', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(169, '856a5181-628c-4386-9359-4389751a0d44', 1, 6, 4, 'OIL FOREVER', 'oil-forever', '', '880', 'no', 880.00, '', 0, '417396', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(170, 'b1a5fc87-6868-4d82-9784-c12b8a97fb5a', 1, 6, 4, 'OIL GABRIELLE', 'oil-gabrielle', '', '850', 'no', 850.00, '', 0, '739042', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(171, 'a95150ca-830a-4ada-9d1e-62049fc3460f', 1, 6, 4, 'OIL GARCON MANQUE', 'oil-garcon-manque', '', '900', 'no', 900.00, '', 0, '540448', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(172, '987535dc-0739-4a73-aa8c-0eb6e780be6d', 1, 6, 4, 'OIL GENTLEMEN ONLY', 'oil-gentlemen-only', '', '720', 'no', 720.00, '', 0, '426321', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(173, '3293880c-f59e-4314-a09b-8bdc2e3cd855', 1, 6, 4, 'OIL GOOD GIRL', 'oil-good-girl', '', '950', 'no', 950.00, '', 0, '953970', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(174, '86d4f71f-96c9-4467-adde-09fe415a9a66', 1, 6, 4, 'OIL GRIS', 'oil-gris', '', '1250', 'no', 1250.00, '', 0, '676758', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(175, '6c1e8b84-bc6e-45f9-94b3-f2fe7c8e4398', 1, 6, 4, 'OIL GUCCI ABSOLUTE', 'oil-gucci-absolute', '', '1200', 'no', 1200.00, '', 0, '974468', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(176, '6c7f4583-cfb1-42be-9342-de56d842c64c', 1, 6, 4, 'OIL HALFETI LEATHER', 'oil-halfeti-leather', '', '1200', 'no', 1200.00, '', 0, '613838', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(177, '8428924a-91d8-48cc-849c-5087935ec000', 1, 6, 4, 'OIL HELEN', 'oil-helen', '', '850', 'no', 850.00, '', 0, '997543', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(178, '89467118-2baf-4cc3-9fc6-983ed64dffea', 1, 6, 4, 'OIL HER BURBERRY', 'oil-her-burberry', '', '850', 'no', 850.00, '', 0, '593765', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(179, '827d31f0-9cc2-4450-92fa-289909bffa50', 1, 6, 4, 'OIL HIBISCUS', 'oil-hibiscus', '', '1050', 'no', 1050.00, '', 0, '279487', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(180, 'c02db602-9e19-465f-a712-f694f0bc8e05', 1, 6, 4, 'OIL HIDDEN LEATHER', 'oil-hidden-leather', '', '950', 'no', 950.00, '', 0, '510220', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(181, '47e3fff9-7c15-4336-a5fe-4c2f82b074b6', 1, 6, 4, 'OIL HOBE ONE', 'oil-hobe-one', '', '', 'no', 0.00, '', 0, '457687', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(182, 'c68f8a07-58e7-4df3-ac2b-d8da55b58c8d', 1, 6, 4, 'OIL HORIZON GISA', 'oil-horizon-gisa', '', '900', 'no', 900.00, '', 0, '777345', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(183, '193bd867-80fe-40d9-8e8e-b8abbed29d6e', 1, 6, 4, 'OIL HUDSON VALLEY', 'oil-hudson-valley', '', '750', 'no', 750.00, '', 0, '577256', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(184, '0920ba67-ce4f-463a-9d4b-f673a36397b7', 1, 6, 4, 'OIL HYPNOTIC POISON', 'oil-hypnotic-poison', '', '800', 'no', 800.00, '', 0, '706041', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(185, '1cba7ec3-6f09-4cf9-86c0-5c45044f28ce', 1, 6, 4, 'OIL IDOLE', 'oil-idole', '', '850', 'no', 850.00, '', 0, '372920', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(186, '9958191e-2d93-4330-89a5-56c71b034667', 1, 6, 4, 'OIL IMAGINATION', 'oil-imagination', '', '1700', 'no', 1700.00, '', 0, '589202', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(187, '03d49765-56e9-4129-b19e-dfcd50d10234', 1, 6, 4, 'OIL IMPERAL VALLEY', 'oil-imperal-valley', '', '750', 'no', 750.00, '', 0, '367843', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(188, 'e03909a4-304c-4ec8-b5b3-811c1a53bbd4', 1, 6, 4, 'OIL IN LOVE WITH YOU', 'oil-in-love-with-you', '', '800', 'no', 800.00, '', 0, '990930', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(189, 'f559d8c5-a35f-4823-9186-fd6ad98d223d', 1, 6, 4, 'OIL INSOLENCE', 'oil-insolence', '', '850', 'no', 850.00, '', 0, '348870', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(190, 'ae1a94cf-7d24-455f-8bae-cbca3dac9c2e', 1, 6, 4, 'OIL INTENSE OUD', 'oil-intense-oud', '', '1000', 'no', 1000.00, '', 0, '610401', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(191, '850eea8e-5d65-44fc-9f0d-33734c5f3386', 1, 6, 4, 'OIL INTERLUDE', 'oil-interlude', '', '1050', 'no', 1050.00, '', 0, '968003', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(192, 'edfa28fa-c0ab-4918-b315-3d6afbff6f6e', 1, 6, 4, 'OIL INVICTUS', 'oil-invictus', '', '850', 'no', 850.00, '', 0, '770502', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(193, 'd192d781-716f-4a5e-978c-8ab77d72b0ff', 1, 6, 4, 'OIL INVICTUS ELIXIR', 'oil-invictus-elixir', '', '1050', 'no', 1050.00, '', 0, '890070', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(194, '372b4265-9506-4c22-a4fb-b569384d421d', 1, 6, 4, 'OIL IRISH LEATHER', 'oil-irish-leather', '', '1450', 'no', 1450.00, '', 0, '938828', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(195, 'c603bace-4ca3-4013-bc59-a8fda83dce7d', 1, 6, 4, 'OIL IRISH OUD', 'oil-irish-oud', '', '1450', 'no', 1450.00, '', 0, '910413', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(196, 'e1206257-e633-41a2-aa72-b1afecad6c10', 1, 6, 4, 'OIL JADOER IN JOY DIOR', 'oil-jadoer-in-joy-dior', '', '800', 'no', 800.00, '', 0, '872293', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 10:44:13', '2025-04-21 10:44:13', NULL),
(197, '13c3ee7f-d635-43f6-a8aa-4c5c72d3cdee', 1, 6, 4, 'OIL JADORE', 'oil-jadore', '', '850', 'no', 850.00, '', 0, '914557', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(198, 'db57fcfa-70f9-4ece-9cae-a76387d27bd8', 1, 6, 4, 'OIL JAZZ CLUB', 'oil-jazz-club', '', '750', 'no', 750.00, '', 0, '180141', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(199, '5165a04a-ddbb-4e9c-a406-ca3122f7868f', 1, 6, 4, 'OIL KHASHAB AL OUD', 'oil-khashab-al-oud', '', '1050', 'no', 1050.00, '', 0, '528243', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(200, '9b0daa06-8e1d-4d51-8ce8-536711ab85f5', 1, 6, 4, 'OIL KING D&G', 'oil-king-d-g', '', '1050', 'no', 1050.00, '', 0, '928545', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(201, '2213d27c-42c1-47c4-b7d5-9f3226542bd7', 1, 6, 4, 'OIL KIRKI', 'oil-kirki', '', '850', 'no', 850.00, '', 0, '554307', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(202, '73f4d297-0a37-4dd6-84e0-abdb3e6ef69b', 1, 6, 4, 'OIL LA BELEL', 'oil-la-belel', '', '850', 'no', 850.00, '', 0, '103274', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(203, '9ecb202c-30e8-4a3c-a2ac-431b1efbc1d1', 1, 6, 4, 'OIL LA LUNA', 'oil-la-luna', '', '1700', 'no', 1700.00, '', 0, '562740', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(204, '8ffd0509-b50e-4054-879b-76d9ee64f553', 1, 6, 4, 'OIL LA VIE EST BELLE', 'oil-la-vie-est-belle', '', '850', 'no', 850.00, '', 0, '288167', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(205, '7e7c9d20-2864-4c49-9dd4-afd8b3e7f2b7', 1, 6, 4, 'OIL LADOR BAKHUR', 'oil-lador-bakhur', '', '850', 'no', 850.00, '', 0, '898179', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(206, 'f70b4d64-08d3-45fb-84a3-43c5f32565ba', 1, 6, 4, 'OIL LAYTON', 'oil-layton', '', '650', 'no', 650.00, '', 0, '539021', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(207, 'adecfb12-81be-4f81-b03d-54d28173755e', 1, 6, 4, 'OIL LE MALE ELIXIR', 'oil-le-male-elixir', '', '780', 'no', 780.00, '', 0, '376591', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(208, '05e80bd3-9271-4f8f-bb43-b59ed358b607', 1, 6, 4, 'OIL LIBRE LAURENT', 'oil-libre-laurent', '', '850', 'no', 850.00, '', 0, '354463', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(209, '6ddaa1cb-b945-4049-b488-db98ef50a859', 1, 6, 4, 'OIL LIEBI', 'oil-liebi', '', '900', 'no', 900.00, '', 0, '750240', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(210, '5a702e11-2d88-4c78-ba24-df88974c9fb3', 1, 6, 4, 'OIL LIGHT BLUE D & G', 'oil-light-blue-d-g', '', '850', 'no', 850.00, '', 0, '933196', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(211, '8d0e0f0a-b3c3-460f-bad6-70df9584b838', 1, 6, 4, 'OIL LINTERDIT', 'oil-linterdit', '', '880', 'no', 880.00, '', 0, '749752', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(212, '491759dd-55b1-496b-8425-8dd0b3e935db', 1, 6, 4, 'OIL LORD GEORGE', 'oil-lord-george', '', '850', 'no', 850.00, '', 0, '541990', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(213, '39d84e39-b499-4258-b365-d57ec04f52bb', 1, 6, 4, 'OIL LOST CHERRY', 'oil-lost-cherry', '', '850', 'no', 850.00, '', 0, '932554', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(214, 'a45caffc-46f7-41e1-bd45-c46ba06566c2', 1, 6, 4, 'OIL MADAWI', 'oil-madawi', '', '850', 'no', 850.00, '', 0, '347580', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(215, '443071c3-6889-4aad-9510-151d03c07b92', 1, 6, 4, 'OIL MAGIC', 'oil-magic', '', '780', 'no', 780.00, '', 0, '606571', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(216, '422fb9fd-6101-43c8-bba5-928ae6a9b09d', 1, 6, 4, 'OIL MAGIC INSTANT', 'oil-magic-instant', '', '650', 'no', 650.00, '', 0, '717306', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(217, '5e53b66e-9471-4c68-8980-1a028b64b8d0', 1, 6, 4, 'OIL MARFA', 'oil-marfa', '', '980', 'no', 980.00, '', 0, '505966', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(218, '16dec498-f989-413f-aaff-66d07f1cc583', 1, 6, 4, 'OIL MARSHOIUD 4', 'oil-marshoiud-4', '', '800', 'no', 800.00, '', 0, '519106', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(219, '19ff44e2-c50a-4b0d-9741-c18d75ad7704', 1, 6, 4, 'OIL MASTER', 'oil-master', '', '1300', 'no', 1300.00, '', 0, '300392', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(220, '5e4e0b08-2e70-4279-ab7f-c896c99dba51', 1, 6, 4, 'OIL MATIERE NOIR', 'oil-matiere-noir', '', '1050', 'no', 1050.00, '', 0, '389854', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(221, '407ce1a5-b8cc-4100-9d55-71c16b5611f2', 1, 6, 4, 'OIL MEGAMARE', 'oil-megamare', '', '1200', 'no', 1200.00, '', 0, '364434', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(222, '78098e51-73f0-407e-86a6-87e66385fb95', 1, 6, 4, 'OIL MEYDAN', 'oil-meydan', '', '850', 'no', 850.00, '', 0, '625692', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(223, '9209bc52-5596-4be0-9d07-cd75168d54b9', 1, 6, 4, 'OIL MIAMI BLOSOM', 'oil-miami-blosom', '', '780', 'no', 780.00, '', 0, '856521', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(224, '46cf58ad-cd26-44e3-bf53-1aa1bfb07c7e', 1, 6, 4, 'OIL MIDNGHT PISION', 'oil-midnght-pision', '', '750', 'no', 750.00, '', 0, '908874', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(225, '2ce0aa91-b941-4625-a75f-dbd8c5bf1aa7', 1, 6, 4, 'OIL MIDNIGHT GLOW', 'oil-midnight-glow', '', '800', 'no', 800.00, '', 0, '116899', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(226, 'deb92ddd-928b-4bbd-8ff6-9951a8b4a0b5', 1, 6, 4, 'OIL MIDNIGHT ROSE', 'oil-midnight-rose', '', '580', 'no', 580.00, '', 0, '752441', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(227, '063d9891-23f8-402d-a5b6-02e49fd5f715', 1, 6, 4, 'OIL MIDNIGHT STROLL', 'oil-midnight-stroll', '', '780', 'no', 780.00, '', 0, '449668', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL);
INSERT INTO `items` (`id`, `uuid`, `branch_id`, `category_id`, `unit_id`, `item_name`, `item_slug`, `item_other_name`, `item_cost_price`, `multiple_price`, `item_price`, `tax`, `tax_percent`, `barcode`, `stock`, `minimum_qty`, `item_type`, `stock_applicable`, `ingredient`, `image`, `expiry_date`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(228, '284f9785-707f-4736-8882-c92ea34a225e', 1, 6, 4, 'OIL MILANO', 'oil-milano', '', '1500', 'no', 1500.00, '', 0, '292746', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(229, '070745bf-6f07-4d95-99b8-025dd03dba9c', 1, 6, 4, 'OIL MILLION 1', 'oil-million-1', '', '980', 'no', 980.00, '', 0, '755582', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(230, '668974e8-82b5-4bd0-abc9-8496cd03b6b0', 1, 6, 4, 'OIL MISS BLOMING', 'oil-miss-bloming', '', '800', 'no', 800.00, '', 0, '836411', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(231, '7e410d74-d786-4b30-9a6b-840bb5a37493', 1, 6, 4, 'OIL MISS DIOR CHERIE', 'oil-miss-dior-cherie', '', '650', 'no', 650.00, '', 0, '361824', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(232, 'da2c0855-b877-478e-ba55-6fdad139a9e4', 1, 6, 4, 'OIL MISS LAVREN', 'oil-miss-lavren', '', '680', 'no', 680.00, '', 0, '841701', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(233, 'abf3c8dc-1fa1-4980-a630-c5ce728b2289', 1, 6, 4, 'OIL MORNING MUSK', 'oil-morning-musk', '', '850', 'no', 850.00, '', 0, '511652', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(234, 'fe5525de-a4a6-475a-bd3a-0b7e76b95ff2', 1, 6, 4, 'OIL MR SAM', 'oil-mr-sam', '', '750', 'no', 750.00, '', 0, '939732', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(235, '9f7016e8-a00e-4db8-be6c-eab9b4ede34c', 1, 6, 4, 'OIL MUSK AL SHIOKH', 'oil-musk-al-shiokh', '', '950', 'no', 950.00, '', 0, '283051', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(236, 'ce52b890-ba4c-49cd-b1a9-3f55e69f2bf1', 1, 6, 4, 'OIL MUSK ALHAREER', 'oil-musk-alhareer', '', '1000', 'no', 1000.00, '', 0, '895192', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(237, 'b1a08b78-c285-4868-997e-ddde1223429d', 1, 6, 4, 'OIL MUSK ALRUMAN', 'oil-musk-alruman', '', '500', 'no', 500.00, '', 0, '694675', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(238, '9f1ab686-5b59-464a-9145-f46e6308a026', 1, 6, 4, 'OIL MUSK ALTOOT', 'oil-musk-altoot', '', '500', 'no', 500.00, '', 0, '349312', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(239, '8f0d3428-e689-4042-a549-7bcf293e7b2e', 1, 6, 4, 'OIL MUSK REVAL', 'oil-musk-reval', '', '850', 'no', 850.00, '', 0, '783558', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(240, '03057a60-67fa-4d70-a64d-e905c4f44eaa', 1, 6, 4, 'OIL MUSK WHITE', 'oil-musk-white', '', '500', 'no', 500.00, '', 0, '331512', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(241, '628f0999-0f13-49c8-ab81-d076b41e0df8', 1, 6, 4, 'OIL MY WAY', 'oil-my-way', '', '850', 'no', 850.00, '', 0, '978499', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(242, 'ba7990f5-653b-49a0-b1e9-4fc50b62b896', 1, 6, 4, 'OIL NASAYEB', 'oil-nasayeb', '', '1300', 'no', 1300.00, '', 0, '280909', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(243, 'cf139bda-f86f-44df-8830-4ff69da27586', 1, 6, 4, 'OIL NAXOS', 'oil-naxos', '', '900', 'no', 900.00, '', 0, '830016', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(244, 'e87447b9-3816-4d1d-b32b-df420024a21d', 1, 6, 4, 'OIL NEXUS GISA', 'oil-nexus-gisa', '', '850', 'no', 850.00, '', 0, '848639', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(245, '022a6709-64ec-450c-b335-9922cb3358ce', 1, 6, 4, 'OIL NISHANE HACIVAT', 'oil-nishane-hacivat', '', '980', 'no', 980.00, '', 0, '915417', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(246, '486dfa00-c580-4663-b8a5-29d9b997c2ba', 1, 6, 4, 'OIL NOBLE WOOD', 'oil-noble-wood', '', '1200', 'no', 1200.00, '', 0, '397721', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(247, '1eb9d61e-43d0-45ca-968e-d5dc23add354', 1, 6, 4, 'OIL NOIR DE NOIR', 'oil-noir-de-noir', '', '850', 'no', 850.00, '', 0, '180448', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(248, '5c9eb78e-5785-4b7d-9c03-cf4cae84986a', 1, 6, 4, 'OIL NOUVE MONDE', 'oil-nouve-monde', '', '1650', 'no', 1650.00, '', 0, '415595', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(249, 'bde4dcfd-222b-4df9-ad3b-f79c46b1f5c4', 1, 6, 4, 'OIL OCTOBER', 'oil-october', '', '850', 'no', 850.00, '', 0, '444907', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(250, '0e6aa6fe-437c-4c9f-9d57-be6d0852f7d1', 1, 6, 4, 'OIL OLYMPEA INTENSE', 'oil-olympea-intense', '', '850', 'no', 850.00, '', 0, '938107', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(251, '47b8456b-557f-4d28-af30-fa543e143dc3', 1, 6, 4, 'OIL OMBER NOMADE', 'oil-omber-nomade', '', '1200', 'no', 1200.00, '', 0, '558082', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(252, 'b3a4c91a-2d21-4619-bc6f-aae4fdc9d3e3', 1, 6, 4, 'OIL OMBRE LEATHER', 'oil-ombre-leather', '', '900', 'no', 900.00, '', 0, '741231', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(253, '1126bcb6-5c63-4114-9dee-2518dcfcd3b0', 1, 6, 4, 'OIL OMBRE WITH HONEY', 'oil-ombre-with-honey', '', '800', 'no', 800.00, '', 0, '549661', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(254, 'd27c2237-2fc5-479e-baeb-d01b18a491c7', 1, 6, 4, 'OIL OMO', 'oil-omo', '', '770', 'no', 770.00, '', 0, '325104', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(255, '8440bf96-6ced-44c8-ad9b-a32a161d652f', 1, 6, 4, 'OIL ONE ONLY', 'oil-one-only', '', '950', 'no', 950.00, '', 0, '675921', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(256, 'dfcc4523-90b4-4488-a895-3223fe1652d8', 1, 6, 4, 'OIL OPUS 5', 'oil-opus-5', '', '880', 'no', 880.00, '', 0, '459840', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(257, 'e9421c61-ec19-4607-a000-d293e009c3a2', 1, 6, 4, 'OIL ORAGE', 'oil-orage', '', '950', 'no', 950.00, '', 0, '569884', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(258, 'f281c56f-9ed6-4c08-b7a3-b70054d78cd7', 1, 6, 4, 'OIL OUD & BERGAMOT', 'oil-oud-bergamot', '', '800', 'no', 800.00, '', 0, '957091', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(259, '2da4bd37-2c0e-4975-925e-6d3f7433c252', 1, 6, 4, 'OIL OUD AL SHAMS', 'oil-oud-al-shams', '', '1200', 'no', 1200.00, '', 0, '428175', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(260, '1c916403-56d5-42c0-b779-50bb18bf2de1', 1, 6, 4, 'OIL OUD BOUQUET', 'oil-oud-bouquet', '', '850', 'no', 850.00, '', 0, '891073', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(261, '8b1142f7-9e01-4582-bd74-2a47ea1ae7b9', 1, 6, 4, 'OIL OUD CADENZA', 'oil-oud-cadenza', '', '880', 'no', 880.00, '', 0, '196894', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(262, 'fd9ae3f9-24ae-4bf6-b52e-1155d2f0a339', 1, 6, 4, 'OIL OUD DUBAI', 'oil-oud-dubai', '', '850', 'no', 850.00, '', 0, '856083', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(263, '3efd94d0-ba90-4150-9be4-f12367af0bdb', 1, 6, 4, 'OIL OUD FOR GREATNESS', 'oil-oud-for-greatness', '', '850', 'no', 850.00, '', 0, '711131', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(264, '32f1710d-e820-4d21-8646-8ca633113fb8', 1, 6, 4, 'OIL OUD ISPAHAN', 'oil-oud-ispahan', '', '1440', 'no', 1440.00, '', 0, '705753', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(265, 'd08cf6aa-b628-42ee-92a1-b8428fc61c17', 1, 6, 4, 'OIL OUD LAVENDER', 'oil-oud-lavender', '', '750', 'no', 750.00, '', 0, '278218', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(266, 'a18238c2-f0c5-41fa-b0c3-6b14cc5cfd28', 1, 6, 4, 'OIL OUD MALAKI', 'oil-oud-malaki', '', '800', 'no', 800.00, '', 0, '773580', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(267, '4fe54fc8-93be-412b-aaa6-a093a06d3cc0', 1, 6, 4, 'OIL OUD MARACUJA', 'oil-oud-maracuja', '', '1200', 'no', 1200.00, '', 0, '275936', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(268, '3657ffd2-abec-4569-a1bd-6a319babb93f', 1, 6, 4, 'OIL OUD ROSEWOOD', 'oil-oud-rosewood', '', '1100', 'no', 1100.00, '', 0, '149443', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(269, 'ebe939fb-f872-42d5-8376-63411f5d0e83', 1, 6, 4, 'OIL OUD SAFFRON', 'oil-oud-saffron', '', '800', 'no', 800.00, '', 0, '649614', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(270, 'b9e8b70d-b889-4fd3-bdab-cb33f0ec63d4', 1, 6, 4, 'OIL OUD STAIN', 'oil-oud-stain', '', '880', 'no', 880.00, '', 0, '724734', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(271, '3319cf02-7385-4901-91a3-db4d561b96ec', 1, 6, 4, 'OIL OUD STALIN', 'oil-oud-stalin', '', '880', 'no', 880.00, '', 0, '365524', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(272, 'd46ddb86-81fd-4586-9891-a1fae2847fdb', 1, 6, 4, 'OIL OUD VANILLA', 'oil-oud-vanilla', '', '1300', 'no', 1300.00, '', 0, '121973', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(273, 'dbab7702-327f-4cbd-9fb2-73bc471a10fe', 1, 6, 4, 'OIL PARADOX', 'oil-paradox', '', '950', 'no', 950.00, '', 0, '576526', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(274, '46c1ec37-ceee-4f2c-8a71-705b496ec28c', 1, 6, 4, 'OIL PARIS', 'oil-paris', '', '850', 'no', 850.00, '', 0, '937182', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(275, '93ffc7cd-0c64-487f-8ac9-f684992e727d', 1, 6, 4, 'OIL PATCHOULI ARDENT', 'oil-patchouli-ardent', '', '1050', 'no', 1050.00, '', 0, '773265', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(276, '870815cc-6f8a-4f70-9cb1-6570fcdd0bfa', 1, 6, 4, 'OIL PATCHOULI INTENSE', 'oil-patchouli-intense', '', '920', 'no', 920.00, '', 0, '889082', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(277, 'eb7a364d-a527-4e9e-8bc2-df8761cf6886', 1, 6, 4, 'OIL PEGASUS', 'oil-pegasus', '', '880', 'no', 880.00, '', 0, '504812', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(278, 'cbc549b4-6f3e-4f74-8f54-83323140982a', 1, 6, 4, 'OIL PERCIVAL', 'oil-percival', '', '850', 'no', 850.00, '', 0, '302946', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(279, '8fadc990-49cb-4a2d-bbce-caba7aef79a0', 1, 6, 4, 'OIL PHANTOM', 'oil-phantom', '', '880', 'no', 880.00, '', 0, '829012', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(280, '75e73402-815b-411d-a862-dede9ade23a4', 1, 6, 4, 'OIL PINK MUSK', 'oil-pink-musk', '', '1200', 'no', 1200.00, '', 0, '516253', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(281, 'a46a6ee0-2d17-4953-bdb3-ac672954533e', 1, 6, 4, 'OIL PUR OUD', 'oil-pur-oud', '', '1450', 'no', 1450.00, '', 0, '467719', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(282, '787e33ee-7381-4b49-9c50-c2762aca2ee2', 1, 6, 4, 'OIL PURPLE OUD', 'oil-purple-oud', '', '1250', 'no', 1250.00, '', 0, '332487', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(283, 'dc7a684a-fee0-4193-89ce-02da33c81cb8', 1, 6, 4, 'OIL PURPOSE AMOUAGE', 'oil-purpose-amouage', '', '900', 'no', 900.00, '', 0, '387671', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(284, '29008eac-8e92-4056-9bab-87c9dfd0741e', 1, 6, 4, 'OIL QUEEN SILK', 'oil-queen-silk', '', '850', 'no', 850.00, '', 0, '323375', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(285, '2c74f03c-a5e3-47aa-8fe1-f0baf4167bc8', 1, 6, 4, 'OIL QUEEN-D&G', 'oil-queen-d-g', '', '970', 'no', 970.00, '', 0, '501495', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(286, '9ce3c5f2-cd6b-4cdc-87d5-3af6be6d9cff', 1, 6, 4, 'OIL R.TOBACCO', 'oil-r-tobacco', '', '950', 'no', 950.00, '', 0, '352754', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(287, 'dc8db524-0fce-4a69-a0ba-4e2f21cc8323', 1, 6, 4, 'OIL REMEMBER ME Y', 'oil-remember-me-y', '', '1300', 'no', 1300.00, '', 0, '209333', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(288, '2936ab0f-967f-472b-b827-f954f5345088', 1, 6, 4, 'OIL RIVIERE', 'oil-riviere', '', '850', 'no', 850.00, '', 0, '124285', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(289, '3abb450a-5d85-4fd7-8c26-16f96f5915f8', 1, 6, 4, 'OIL ROBERTO CAVALIE GOLD', 'oil-roberto-cavalie-gold', '', '800', 'no', 800.00, '', 0, '234104', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(290, '40477578-f15a-42f7-ad03-6bd6cab70767', 1, 6, 4, 'OIL ROSE D,AMALFI', 'oil-rose-d-amalfi', '', '950', 'no', 950.00, '', 0, '885198', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(291, '669b1aa3-9473-4301-9866-b39d156937b0', 1, 6, 4, 'OIL ROSE VANILLA', 'oil-rose-vanilla', '', '900', 'no', 900.00, '', 0, '320103', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(292, 'fa89a91e-1c8f-4f7b-9912-d3061430529c', 1, 6, 4, 'OIL ROSENDU NO 5', 'oil-rosendu-no-5', '', '860', 'no', 860.00, '', 0, '517976', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(293, '83779eac-f241-4d77-a0f2-c19c18f5aa16', 1, 6, 4, 'OIL ROUGE SMOKING', 'oil-rouge-smoking', '', '', 'no', 0.00, '', 0, '507012', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(294, '9d76745c-d4a5-47d1-a9e4-587e70ace822', 1, 6, 4, 'OIL SAFARI EXTREME', 'oil-safari-extreme', '', '1200', 'no', 1200.00, '', 0, '837315', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(295, '1b06cf5a-1446-4e2c-b5c1-74581d1cfbd9', 1, 6, 4, 'OIL SAFFRON LAZULI', 'oil-saffron-lazuli', '', '', 'no', 0.00, '', 0, '631138', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(296, '42d9d175-fe5f-43c0-838d-9c606c904be7', 1, 6, 4, 'OIL SAKORA', 'oil-sakora', '', '900', 'no', 900.00, '', 0, '531744', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(297, 'ec58a876-2cb5-45b7-a025-0bb8cff7ae56', 1, 6, 4, 'OIL SANTAL 33', 'oil-santal-33', '', '1200', 'no', 1200.00, '', 0, '179394', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(298, '01274696-52e5-466d-b1c6-5f76e551b558', 1, 6, 4, 'OIL SANTAL NOIR', 'oil-santal-noir', '', '', 'no', 0.00, '', 0, '161784', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(299, 'c4254ac1-ff8c-41a8-b0e4-7ea1f38b5165', 1, 6, 4, 'OIL SAUVAGE ELIXIR', 'oil-sauvage-elixir', '', '850', 'no', 850.00, '', 0, '508435', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(300, 'aa99d653-789c-45ed-b9c9-131740fd5cf4', 1, 6, 4, 'OIL SAUVVAGE', 'oil-sauvvage', '', '1050', 'no', 1050.00, '', 0, '561222', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(301, 'aa8f0d18-9d88-4dc9-bf3a-be2167a80886', 1, 6, 4, 'OIL SCANDAL WOMEN', 'oil-scandal-women', '', '650', 'no', 650.00, '', 0, '819076', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(302, '302cea55-5f43-49a4-b32d-67d91ee63b09', 1, 6, 4, 'OIL SCANDAL MAN', 'oil-scandal-man', '', '850', 'no', 850.00, '', 0, '955197', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(303, 'e39d5417-5ffb-42c8-bb3e-f1219f8ec8de', 1, 6, 4, 'OIL SEARCH', 'oil-search', '', '1200', 'no', 1200.00, '', 0, '228320', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(304, '568e7226-df60-4b04-a83b-dacf792b4e6f', 1, 6, 4, 'OIL SEKUSHI NO7', 'oil-sekushi-no7', '', '850', 'no', 850.00, '', 0, '948175', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(305, 'd9f9dde9-5e47-4228-908e-82efadb31501', 1, 6, 4, 'OIL SHAI BUT NOT OUT', 'oil-shai-but-not-out', '', '1650', 'no', 1650.00, '', 0, '624056', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(306, 'dd29fb5a-fda4-406c-a4a6-2a6085c9ce87', 1, 6, 4, 'OIL SHAY OUD', 'oil-shay-oud', '', '450', 'no', 450.00, '', 0, '765989', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(307, 'eda8074a-6e1b-41c2-8266-f5406355c159', 1, 6, 4, 'OIL SHAY SHAY', 'oil-shay-shay', '', '550', 'no', 550.00, '', 0, '543829', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(308, '8ff81274-a225-46ed-9b16-ae675b0bbf65', 1, 6, 4, 'OIL SHEIKH TAHNOUN', 'oil-sheikh-tahnoun', '', '950', 'no', 950.00, '', 0, '235322', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(309, 'ec7c0625-523a-4135-9493-353cf1af14e5', 1, 6, 4, 'OIL SHUMUKH', 'oil-shumukh', '', '850', 'no', 850.00, '', 0, '994340', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(310, 'd6ee0b72-caf3-4694-9417-c3257f13caa3', 1, 6, 4, 'OIL SI ARMANI', 'oil-si-armani', '', '780', 'no', 780.00, '', 0, '648253', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(311, 'e755cccd-a247-447a-a588-9ec3272440c3', 1, 6, 4, 'OIL SIDE EFFECT', 'oil-side-effect', '', '1200', 'no', 1200.00, '', 0, '672105', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(312, 'e084881b-bfd8-4303-b0f0-8899a8358d70', 1, 6, 4, 'OIL SORA', 'oil-sora', '', '850', 'no', 850.00, '', 0, '360310', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(313, 'f3cde876-e6d5-485c-b144-399d522d176b', 1, 6, 4, 'OIL SOSPIRO ACCENTO', 'oil-sospiro-accento', '', '1250', 'no', 1250.00, '', 0, '113986', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(314, '126829bf-8621-47e5-be89-4cec65619f5a', 1, 6, 4, 'OIL SPICE BLEND', 'oil-spice-blend', '', '880', 'no', 880.00, '', 0, '543714', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(315, '56c5c9ca-895b-4819-bd04-6bcf6af606dc', 1, 6, 4, 'OIL SPICE BOMB', 'oil-spice-bomb', '', '850', 'no', 850.00, '', 0, '475016', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(316, 'ec7c8e94-d970-460f-be07-c487eed75d3e', 1, 6, 4, 'OIL STELLAR TIMES', 'oil-stellar-times', '', '900', 'no', 900.00, '', 0, '760410', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(317, '5e7faadf-ea64-4091-bfdb-8659b874ea63', 1, 6, 4, 'OIL STRONG WITH YOU ABS', 'oil-strong-with-you-abs', '', '', 'no', 0.00, '', 0, '764707', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(318, 'b5e4752a-99de-4975-9dd7-8f42f459f7dd', 1, 6, 4, 'OIL STRONGER WITH YOU', 'oil-stronger-with-you', '', '850', 'no', 850.00, '', 0, '193210', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(319, '55e23a16-1f2a-4944-a17c-9418115c63f5', 1, 6, 4, 'OIL STRONGER WITH YOU LEATHER', 'oil-stronger-with-you-leather', '', '750', 'no', 750.00, '', 0, '863287', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(320, 'ec082ceb-2ca3-49c9-8b4a-c8306ad0cf73', 1, 6, 4, 'OIL STRONGER WITH YOU OUD', 'oil-stronger-with-you-oud', '', '900', 'no', 900.00, '', 0, '832234', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(321, '9559a7e6-c96e-443d-929a-9875355c7d46', 1, 6, 4, 'OIL SUPREME BOUQUET 84', 'oil-supreme-bouquet-84', '', '', 'no', 0.00, '', 0, '497607', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(322, '7be929e0-da5d-48a0-a2cf-d13dbefd5d1b', 1, 6, 4, 'OIL SUPREME BOUQUET( DR)', 'oil-supreme-bouquet-dr-', '', '', 'no', 0.00, '', 0, '782924', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(323, '1f818576-8bec-4aff-afcf-08aa1819f13f', 1, 6, 4, 'OIL SWEET OUD(AT)', 'oil-sweet-oud-at-', '', '1050', 'no', 1050.00, '', 0, '479306', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(324, 'a6f70b7f-bffb-49e1-b86c-fbe948fd2284', 1, 6, 4, 'OIL SWEET VANILLA', 'oil-sweet-vanilla', '', '800', 'no', 800.00, '', 0, '700170', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(325, 'c18f9b70-850d-452c-be19-0f32fd5a72a3', 1, 6, 4, 'OIL TAHNON EXCEP', 'oil-tahnon-excep', '', '', 'no', 0.00, '', 0, '277693', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(326, 'b7429f89-2213-49dd-9f74-db725b7f4cff', 1, 6, 4, 'OIL TASKN LEATHER', 'oil-taskn-leather', '', '', 'no', 0.00, '', 0, '617534', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(327, '62c5570c-8271-4cbf-be6e-2eb974312acd', 1, 6, 4, 'OIL TERRE D HERMES', 'oil-terre-d-hermes', '', '950', 'no', 950.00, '', 0, '698068', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(328, 'ac78e88d-313e-49cd-9880-26b6933f654e', 1, 6, 4, 'OIL TERRONI', 'oil-terroni', '', '1050', 'no', 1050.00, '', 0, '814639', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(329, '2917c1b9-2994-458f-8fa4-2f9c5c9c6e87', 1, 6, 4, 'OIL THE COLLECTOR', 'oil-the-collector', '', '1350', 'no', 1350.00, '', 0, '108389', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(330, '646ff600-b0bc-4cf4-a2d6-19f412be6129', 1, 6, 4, 'OIL THE FIRE', 'oil-the-fire', '', '950', 'no', 950.00, '', 0, '581981', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(331, 'f4311c07-58c5-4efa-8087-fcf1ad173dd8', 1, 6, 4, 'OIL THE ONE', 'oil-the-one', '', '850', 'no', 850.00, '', 0, '397938', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(332, 'afc676c4-bf8f-4436-a994-795a41ffa994', 1, 6, 4, 'OIL TOBACCO LOR', 'oil-tobacco-lor', '', '900', 'no', 900.00, '', 0, '168530', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(333, '606235ab-3e56-4267-8d90-3c985b4b7299', 1, 6, 4, 'OIL TOBACCO VANILLE', 'oil-tobacco-vanille', '', '850', 'no', 850.00, '', 0, '778237', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(334, '33da99a2-9295-41a6-bd04-fc95c976721e', 1, 6, 4, 'OIL TRU OUD', 'oil-tru-oud', '', '1550', 'no', 1550.00, '', 0, '135074', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(335, 'c91765ff-870e-4713-a8bc-6b4d5d811a90', 1, 6, 4, 'OIL TUSCAN LEATHER', 'oil-tuscan-leather', '', '800', 'no', 800.00, '', 0, '322768', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(336, '9cae6177-db7c-42f5-b0b7-d45713a487f4', 1, 6, 4, 'OIL TUXEDO', 'oil-tuxedo', '', '950', 'no', 950.00, '', 0, '572269', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(337, '767e063e-b74d-4f76-8fb2-1789d6f839a9', 1, 6, 4, 'OIL TYGER', 'oil-tyger', '', '1550', 'no', 1550.00, '', 0, '509564', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(338, '321b7456-ed74-493e-9ce9-7557ecad55fb', 1, 6, 4, 'OIL ULTRA MALE', 'oil-ultra-male', '', '850', 'no', 850.00, '', 0, '149569', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(339, '825853a1-0ab4-48f7-a5ef-c6f5562a6501', 1, 6, 4, 'OIL VANILLA', 'oil-vanilla', '', '', 'no', 0.00, '', 0, '139646', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(340, '69a0a3c8-ff19-4b16-b31b-437554162576', 1, 6, 4, 'OIL VELVEVT WOOD', 'oil-velvevt-wood', '', '800', 'no', 800.00, '', 0, '916680', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(341, 'a446bc86-571c-462e-b088-03da6e46d92a', 1, 6, 4, 'OIL VERT MALACHITE', 'oil-vert-malachite', '', '920', 'no', 920.00, '', 0, '344854', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(342, 'ebddf3d0-bab3-4af0-8940-bd976b40fc05', 1, 6, 4, 'OIL VERY SEXY', 'oil-very-sexy', '', '850', 'no', 850.00, '', 0, '151308', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(343, '8fb46fa8-a109-4589-a3fa-456e6acd9d60', 1, 6, 4, 'OIL VERY SEXY ORCHID', 'oil-very-sexy-orchid', '', '800', 'no', 800.00, '', 0, '384911', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(344, 'c3379e6b-d9c0-4b14-afbb-c8231cda495d', 1, 6, 4, 'OIL VOICE SNAKE', 'oil-voice-snake', '', '1420', 'no', 1420.00, '', 0, '847332', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(345, '0ef07b00-5ff7-4291-ad1f-8fe6da20a7f1', 1, 6, 4, 'OIL WHITE OMBER', 'oil-white-omber', '', '', 'no', 0.00, '', 0, '110369', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(346, '7f0fb661-fd87-4752-b358-3afeeef7246b', 1, 6, 4, 'OIL WHY(y)', 'oil-why-y-', '', '850', 'no', 850.00, '', 0, '167362', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(347, '3c088eb4-57dd-4dfd-8aba-8134a09248dd', 1, 6, 4, 'OIL WOOD', 'oil-wood', '', '', 'no', 0.00, '', 0, '133203', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(348, '7ade5097-5e6b-4346-81aa-4a127d3649b5', 1, 6, 4, 'OIL WOODY', 'oil-woody', '', '', 'no', 0.00, '', 0, '434083', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(349, '745601ea-0239-472d-8003-21fbed2ad2ad', 1, 6, 4, 'OIL WOW', 'oil-wow', '', '1000', 'no', 1000.00, '', 0, '248870', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(350, '854de63a-5802-46ad-b53b-f75e789f7247', 1, 6, 4, 'OIL X S', 'oil-x-s', '', '850', 'no', 850.00, '', 0, '769898', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(351, '210fab71-50e7-4d17-89be-001c6873fc12', 1, 6, 4, 'OIL1990', 'oil1990', '', '900', 'no', 900.00, '', 0, '915418', 0, 0, '2', '1', '1', '', NULL, 'yes', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(352, 'fea81871-17bd-4ca1-8f4a-a130d855e9e6', 1, 5, 1, 'BOTTLE MEDIA-50ml', 'bottle-media-50ml', '50ml', '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-04-21 19:47:57', '2025-05-05 12:55:52', NULL),
(353, 'b22aec80-222d-4d61-9711-efda1fc0d795', 1, 5, 1, 'BOTTLE MEDIA-250ml', 'bottle-media-250ml', '250ml', '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-04-21 19:48:43', '2025-04-21 19:48:43', NULL),
(354, '8ab7bd44-a4db-47df-9291-03ee59cae063', 1, 5, 1, 'BOTTLE MEDIA-500ml', 'bottle-media-500ml', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-04-21 19:50:12', '2025-04-21 19:50:12', NULL),
(355, 'deac65b8-de96-4183-8c07-1d7cf6a32816', 1, 5, 1, 'BOTTLE MEDIA-1000ml', 'bottle-media-1000ml', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-04-21 19:50:40', '2025-05-05 12:55:46', NULL),
(356, '5dfe06d5-1227-49bd-be18-745dcfb09731', 1, 5, 1, 'BUKHOOR KHAM', 'bukhoor-kham', 'INCENCE', '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-04-21 19:51:54', '2025-04-21 19:51:54', NULL),
(357, '1e223d0b-e660-40cf-8578-442f702a6714', 1, 5, 1, 'OUD KHAM', 'oud-kham', 'MAROUKI', '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-04-21 19:53:19', '2025-04-21 19:53:19', NULL),
(358, '62837425-6cc4-4d5b-8565-235bf561f1b5', 1, 3, 1, 'SHAY SHAY KG', 'shay-shay-kg', 'BUKHOOR KG', '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-04-21 19:53:59', '2025-04-21 19:53:59', NULL),
(359, '927f4f53-4b79-4130-ae2b-289b8d6788d7', 1, 3, 4, 'SHAY OUD KG', 'shay-oud-kg', 'BUKHOOR KG', '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-04-21 19:54:37', '2025-04-21 19:54:37', NULL),
(360, '9778c818-8d72-4f85-8a55-3039ea21a0b7', 1, 3, 4, 'SHIKAH ABDULLAH KG', 'shikah-abdullah-kg', 'BUKHOOR KG', '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-04-21 19:55:27', '2025-04-21 19:55:27', NULL),
(361, 'aa212a54-8385-4179-9736-df30fb991104', 1, 3, 4, 'SALAMA KG', 'salama-kg', 'BUKHOOR KG', '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-04-21 19:56:03', '2025-04-21 19:56:03', NULL),
(362, '0768c199-35e9-4623-8374-f9b1fb5b54ed', 1, 3, 4, 'ALAMEER KG', 'alameer-kg', 'BUKHOOR KG', '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-04-21 19:56:33', '2025-04-21 19:56:33', NULL),
(363, 'eb6929b1-c3ff-4a3b-82e0-fd4283c6fb90', 1, 3, 4, 'ANFASIC KG', 'anfasic-kg', 'BUKHOOR KG', '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-04-21 19:58:18', '2025-04-21 19:58:18', NULL),
(364, '3ac472ff-05c4-47da-9bc3-3ebdde314c25', 1, 3, 4, 'IMPERIAL KG', 'imperial-kg', 'BUKHOOR KG', '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-04-21 19:58:47', '2025-04-21 19:58:47', NULL),
(365, '09eb81f9-33f8-411e-a117-a35266e3e0e6', 1, 3, 4, 'SHUMUKH-1', 'shumukh-1', 'BUKHOOR KG', '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-04-21 19:59:24', '2025-04-21 19:59:24', NULL),
(366, '8e6cdf1b-08f2-40f0-9d47-f0061a557312', 1, 7, 1, 'BO50001', 'bo50001', 'SAMPLE', '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '1', '1745316862.jpg', NULL, 'yes', '2025-04-22 14:14:22', '2025-04-23 13:51:33', '2025-04-23 13:51:33'),
(367, 'b4c989ca-d7b9-4e74-8738-4abea6c9daf4', 1, 7, 1, 'BOTTLE 100ML 012', 'bottle-100ml-012', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745427480.jpg', NULL, 'yes', '2025-04-23 20:58:00', '2025-04-23 20:58:24', NULL),
(368, 'fa24c5b1-d485-4f21-ad40-937ba99fbc86', 1, 7, 1, 'BOTTLE 80ML 013', 'bottle-80ml-013', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745427545.jpg', NULL, 'yes', '2025-04-23 20:59:05', '2025-04-23 20:59:18', NULL),
(369, '468b9961-ba3b-4b25-99a6-1f8554689c01', 1, 7, 1, 'BOTTLE 100ML 014', 'bottle-100ml-014', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '0', '0', '1745427614.jpg', NULL, 'yes', '2025-04-23 21:00:14', '2025-04-23 21:00:14', NULL),
(370, '2eb73103-3f0c-4bc6-a95f-40f5dc6fbaeb', 1, 7, 1, 'BOTTLE 80ML 015', 'bottle-80ml-015', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '1', '1745427755.jpg', NULL, 'yes', '2025-04-23 21:02:35', '2025-04-23 21:02:35', NULL),
(371, '5400721a-a90b-4f8e-87bf-0c7c1caec221', 1, 7, 1, 'BOTTLE 100ML 016', 'bottle-100ml-016', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745427835.jpg', NULL, 'yes', '2025-04-23 21:03:55', '2025-04-23 21:03:55', NULL),
(372, 'd5ed1f27-3ae7-4f1a-bab1-ef7d65b2c904', 1, 7, 1, 'OTTLE 100ML 017', 'ottle-100ml-017', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745428007.jpg', NULL, 'yes', '2025-04-23 21:06:47', '2025-04-23 21:06:47', NULL),
(373, '084f528f-d254-4dbb-b73d-bd8e23299e37', 1, 7, 1, 'BOTTLE 100ML 018', 'bottle-100ml-018', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745428043.jpg', NULL, 'yes', '2025-04-23 21:07:23', '2025-04-23 21:07:23', NULL),
(374, '410d5c58-ce8c-4cca-aa2a-edcaa4fe2b37', 1, 7, 1, 'BOTTLE 100ML 019', 'bottle-100ml-019', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745428090.jpg', NULL, 'yes', '2025-04-23 21:08:10', '2025-04-23 21:08:10', NULL),
(375, '0bc310e8-5ffc-450c-9885-c6a3528ac248', 1, 7, 1, 'BOTTLE 115ML 020', 'bottle-115ml-020', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745428145.jpg', NULL, 'yes', '2025-04-23 21:09:05', '2025-04-23 21:09:05', NULL),
(376, '00dc1976-a040-4629-b216-90758dba7490', 1, 7, 1, 'BOTTLE 100ML 021', 'bottle-100ml-021', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745428178.jpg', NULL, 'yes', '2025-04-23 21:09:38', '2025-04-23 21:09:38', NULL),
(377, '65344746-1fac-41a0-9262-898cdfc805ee', 1, 7, 1, 'BOTTLE 200ML 022', 'bottle-200ml-022', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745428208.jpg', NULL, 'yes', '2025-04-23 21:10:08', '2025-04-23 21:10:08', NULL),
(378, '7909bb54-0579-453f-99fa-014f55e9308a', 1, 7, 1, 'BOTTLE 100ML 023', 'bottle-100ml-023', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745428242.jpg', NULL, 'yes', '2025-04-23 21:10:42', '2025-04-23 21:10:42', NULL),
(379, '5fe19483-204a-4de0-9850-4b7263087fc7', 1, 7, 1, 'BOTTLE 100ML 024', 'bottle-100ml-024', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745428324.jpg', NULL, 'yes', '2025-04-23 21:12:05', '2025-04-23 21:12:05', NULL),
(380, '315742e4-c9d1-4cd6-9e6e-af6acca63b4c', 1, 7, 1, 'BOTTLE 80ML 025', 'bottle-80ml-025', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '1', '1745428440.jpg', NULL, 'yes', '2025-04-23 21:14:00', '2025-04-23 21:14:00', NULL),
(381, '9eae9627-0b76-4f31-9eec-18d4c2c7cc42', 1, 7, 1, 'BOTTLE 100ML 026', 'bottle-100ml-026', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745428474.jpg', NULL, 'yes', '2025-04-23 21:14:34', '2025-04-23 21:14:34', NULL),
(382, 'be4453d6-b045-4e05-9b9d-ae53a493fadf', 1, 7, 1, 'BOTTLE 80ML 027', 'bottle-80ml-027', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745428550.jpg', NULL, 'yes', '2025-04-23 21:15:50', '2025-04-23 21:15:50', NULL),
(383, '020b08af-929e-4f44-b159-20c17240eac8', 1, 7, 1, 'BOTTLE 100ML 028', 'bottle-100ml-028', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745428586.jpg', NULL, 'yes', '2025-04-23 21:16:26', '2025-04-23 21:16:26', NULL),
(384, 'e37974b7-f308-40d0-9209-05851ae93b3a', 1, 7, 1, 'BOTTLE 100ML 029', 'bottle-100ml-029', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745428665.jpg', NULL, 'yes', '2025-04-23 21:17:45', '2025-04-23 21:17:45', NULL),
(385, '2d55d62f-62e6-4e28-82b5-4f036502e69a', 1, 7, 1, 'BOTTLE 100ML 030', 'bottle-100ml-030', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745428704.jpg', NULL, 'yes', '2025-04-23 21:18:24', '2025-04-23 21:18:24', NULL),
(386, '3584876b-b324-4367-a8c1-cb1bbeb7740a', 1, 7, 1, 'BOTTLE 100ML 031', 'bottle-100ml-031', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745428759.jpg', NULL, 'yes', '2025-04-23 21:19:19', '2025-04-23 21:19:19', NULL),
(387, '211e41e7-6632-4151-bbeb-1fa53c2c7178', 1, 7, 1, 'BOTTLE 100ML 032', 'bottle-100ml-032', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745428802.jpg', NULL, 'yes', '2025-04-23 21:20:02', '2025-04-23 21:20:02', NULL),
(388, '7448b089-013d-400f-b6df-38676c8605a8', 1, 7, 1, 'BOTTLE 30ML 033', 'bottle-30ml-033', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745428842.jpg', NULL, 'yes', '2025-04-23 21:20:42', '2025-04-23 21:20:42', NULL),
(389, '7411b8b6-f719-4f9c-85a6-f399b627c246', 1, 7, 1, 'BOTTLE 50ML 034', 'bottle-50ml-034', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745428899.jpg', NULL, 'yes', '2025-04-23 21:21:39', '2025-04-23 21:21:39', NULL),
(390, '437fe6e3-bdeb-401c-ae50-c4767245dc87', 1, 7, 1, 'BOTTLE  100ML 035', 'bottle-100ml-035', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745428950.jpg', NULL, 'yes', '2025-04-23 21:22:30', '2025-04-23 21:22:30', NULL),
(391, 'afca0022-fc84-4ca5-90d9-173c04ef6b6f', 1, 7, 1, 'BOTTLE 100ML 036', 'bottle-100ml-036', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745429040.jpg', NULL, 'yes', '2025-04-23 21:24:00', '2025-04-23 21:24:00', NULL),
(392, 'e05cfb70-6b16-4ad1-a4d0-9aea306e055d', 1, 7, 1, 'BOTTLE 50ML 037', 'bottle-50ml-037', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745429087.jpg', NULL, 'yes', '2025-04-23 21:24:47', '2025-04-23 22:17:49', NULL),
(393, '36c4afca-33f1-40c6-9def-407cd743e226', 1, 7, 1, 'BOTTLE 50ML 038', 'bottle-50ml-038', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745429144.jpg', NULL, 'yes', '2025-04-23 21:25:44', '2025-04-23 21:25:44', NULL),
(394, '29275676-cabf-4ba8-adb4-1a25fddf149b', 1, 7, 1, 'BOTTLE 80ML 039', 'bottle-80ml-039', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745429203.jpg', NULL, 'yes', '2025-04-23 21:26:43', '2025-04-23 21:26:43', NULL),
(395, '31a98f91-cca1-4da2-9945-d4dfb319eab5', 1, 7, 1, 'BOTTLE 50ML 040', 'bottle-50ml-040', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745429290.jpg', NULL, 'yes', '2025-04-23 21:28:10', '2025-04-23 21:28:10', NULL),
(396, 'd7dcf594-bd55-47c1-9562-97c74da7f193', 1, 7, 1, 'BOTTLE 50ML 041', 'bottle-50ml-041', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745429731.jpg', NULL, 'yes', '2025-04-23 21:35:31', '2025-04-23 21:35:31', NULL),
(397, '7c06173a-a96b-455b-b94e-6967bc108b06', 1, 7, 1, 'BOTTLE 50ML 042', 'bottle-50ml-042', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '1', '1745429845.jpg', NULL, 'yes', '2025-04-23 21:37:25', '2025-04-23 21:37:25', NULL),
(398, '7524df1e-4aec-4ce7-8666-a9c844ae3d6b', 1, 7, 1, 'BOTTLE 50ML 043', 'bottle-50ml-043', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745429898.jpg', NULL, 'yes', '2025-04-23 21:38:18', '2025-04-23 21:38:18', NULL),
(399, 'a9db1798-a2d2-45cd-a562-8df484f794a1', 1, 7, 1, 'BOTTLE 50ML 044', 'bottle-50ml-044', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745429952.jpg', NULL, 'yes', '2025-04-23 21:39:12', '2025-04-23 21:39:12', NULL),
(400, 'fe6718eb-bc06-4c18-854d-7f6774483027', 1, 7, 1, 'BOTTLE 30ML 045', 'bottle-30ml-045', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '1', '1745430114.jpg', NULL, 'yes', '2025-04-23 21:41:54', '2025-04-23 22:17:32', NULL),
(401, '68cbd40e-3b78-4856-8181-bc9a271f5bf1', 1, 7, 1, 'BOTTLE 50ML 046', 'bottle-50ml-046', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745430217.jpg', NULL, 'yes', '2025-04-23 21:43:37', '2025-04-23 21:43:37', NULL),
(402, '09d164e2-e08e-4491-ba0a-8aeb4206be28', 1, 7, 1, 'BOTTLE 048', 'bottle-048', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '1', '1745430252.jpg', NULL, 'yes', '2025-04-23 21:44:12', '2025-04-23 22:16:04', NULL),
(403, '15fbed21-2d87-4064-a8c6-3ba9bc64b30c', 1, 7, 1, 'BOTTLE 50ML 048', 'bottle-50ml-048', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745430325.jpg', NULL, 'yes', '2025-04-23 21:45:25', '2025-04-23 22:17:56', NULL),
(404, 'c024af05-9e0d-4576-8ebb-857e9dc984a6', 1, 7, 1, 'BOTTLE 20ML 049', 'bottle-20ml-049', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '1', '1745430402.jpg', NULL, 'yes', '2025-04-23 21:46:42', '2025-04-23 21:46:42', NULL),
(405, 'f6244ed0-cdb1-4b83-b240-1f23938894ae', 1, 7, 1, 'BOTTLE 50ML', 'bottle-50ml', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745430444.jpg', NULL, 'yes', '2025-04-23 21:47:24', '2025-04-23 21:47:24', NULL),
(406, 'e9071c11-d744-41f8-adba-f446b1e94250', 1, 7, 1, 'BOTTLE 50ML 051', 'bottle-50ml-051', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745430499.jpg', NULL, 'yes', '2025-04-23 21:48:19', '2025-04-23 22:18:05', NULL),
(407, '0c944af9-f8f7-4f48-b06d-953e5f6e717f', 1, 7, 1, 'BOTTLE 50ML 052', 'bottle-50ml-052', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745430557.jpg', NULL, 'yes', '2025-04-23 21:49:17', '2025-04-23 21:49:17', NULL),
(408, '8ef3901e-87bc-4d0d-90a7-8a55b64b5f5a', 1, 7, 1, 'BOTTLE 30ML 053', 'bottle-30ml-053', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745430613.jpg', NULL, 'yes', '2025-04-23 21:50:13', '2025-04-23 22:17:41', NULL),
(409, 'bb3fd15b-7f99-4152-b803-d37a2f0fd001', 1, 7, 1, 'BOTTLE 50ML 054', 'bottle-50ml-054', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '1', '1745430668.jpg', NULL, 'yes', '2025-04-23 21:51:08', '2025-04-23 21:51:08', NULL),
(410, 'babb5446-d17c-47cf-bb32-e688a341c230', 1, 7, 1, 'BOTTLE 50ML 055', 'bottle-50ml-055', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745430762.jpg', NULL, 'yes', '2025-04-23 21:52:42', '2025-04-23 21:52:42', NULL),
(411, 'f1bd36a7-9952-4a7b-b0a6-353ddb2dfd3f', 1, 7, 1, 'BOTTLE 50ML 056', 'bottle-50ml-056', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745430906.jpg', NULL, 'yes', '2025-04-23 21:55:06', '2025-04-23 21:55:06', NULL),
(412, 'e7b4e3cf-5b1a-4e62-929f-4ffd26f6687d', 1, 7, 1, 'BOTTLE 50ML 057', 'bottle-50ml-057', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745430953.jpg', NULL, 'yes', '2025-04-23 21:55:53', '2025-04-23 21:55:53', NULL),
(413, 'eec80e85-c6a2-471d-bb20-df8499941505', 1, 7, 1, 'BOTTLE 50ML 058', 'bottle-50ml-058', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745430985.jpg', NULL, 'yes', '2025-04-23 21:56:25', '2025-04-23 21:56:25', NULL),
(414, '5a11be78-d0db-4856-a577-0705a5c80be5', 1, 7, 1, 'BOTTLE 50ML 059', 'bottle-50ml-059', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745431026.jpg', NULL, 'yes', '2025-04-23 21:57:06', '2025-04-23 22:18:13', NULL),
(415, '6e59cb0d-4395-421b-a5f4-353aab2fef78', 1, 7, 1, 'BOTTLE 30ML 060', 'bottle-30ml-060', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '1', '1745431090.jpg', NULL, 'yes', '2025-04-23 21:58:10', '2025-04-23 21:58:10', NULL),
(416, '5052250f-f696-4b4c-8ffd-829d724e0245', 1, 7, 1, 'BOTTLE 50ML 061', 'bottle-50ml-061', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745431159.jpg', NULL, 'yes', '2025-04-23 21:59:19', '2025-04-23 21:59:19', NULL),
(417, 'cd9c4de6-37b2-4e88-ad88-33bd84bd51ad', 1, 7, 1, 'BOTTLE 30ML 062', 'bottle-30ml-062', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745431223.jpg', NULL, 'yes', '2025-04-23 22:00:23', '2025-04-23 22:00:23', NULL),
(418, '563c771a-0c6e-4d1d-954d-7325baa2de85', 1, 7, 1, 'BOTTLE 50ML 063', 'bottle-50ml-063', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '1', '1745431286.jpg', NULL, 'yes', '2025-04-23 22:01:26', '2025-04-23 22:02:56', NULL),
(419, 'cd27084c-271b-42c6-9157-735f05589988', 1, 7, 1, 'BOTTLE 30ML 064', 'bottle-30ml-064', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745431411.jpg', NULL, 'yes', '2025-04-23 22:03:31', '2025-04-23 22:03:31', NULL),
(420, '33ee0d13-18e0-4cf2-81f6-e9659cc74946', 1, 10, 1, 'BOTTLE REVAL 50ML', 'bottle-reval-50ml', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 540, '2', '1', '1', '1745431470.jpg', NULL, 'yes', '2025-04-23 22:04:30', '2025-04-28 19:41:48', NULL),
(421, '2985a26e-e54f-43c0-a209-f0fde5ad4409', 1, 7, 1, 'BOTTLE 50ML 065', 'bottle-50ml-065', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745431498.jpg', NULL, 'yes', '2025-04-23 22:04:58', '2025-04-23 22:04:58', NULL),
(422, 'b67b41d6-3c2b-4424-af07-b15ce61de926', 1, 7, 1, 'BOTTLE 50ML 068', 'bottle-50ml-068', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745431542.jpg', NULL, 'yes', '2025-04-23 22:05:42', '2025-04-23 22:05:42', NULL),
(423, '0c4e8361-a8a9-41e0-bdb0-0e09f131da1d', 1, 10, 1, 'STEACKER', 'steacker', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1000, '2', '1', '1', '', NULL, 'yes', '2025-04-24 13:30:24', '2025-04-28 19:40:07', NULL),
(424, '2526c331-39b5-4d9a-8321-37b0184b62da', 1, 5, 1, 'CAP REVAL', 'cap-reval', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 500, '2', '1', '1', '', NULL, 'yes', '2025-04-24 13:31:46', '2025-04-28 18:09:23', NULL),
(425, '5e28fc73-6781-439b-8af8-e6384f7d8376', 1, 4, 1, 'hudson air freshner', 'hudson-air-freshner', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 5, '1', '1', '1', '', NULL, 'yes', '2025-04-24 19:16:47', '2025-04-24 19:16:47', NULL),
(426, '90262d94-4449-4aca-8c6f-672ee7b95a07', 1, 4, 1, 'the way air freshner', 'the-way-air-freshner', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 5, '1', '1', '1', '', NULL, 'yes', '2025-04-24 19:17:12', '2025-04-24 19:17:12', NULL),
(427, 'b3b713aa-2169-4adf-b9c0-05f1598f50a9', 1, 4, 1, 'shay oud air freshner', 'shay-oud-air-freshner', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 5, '1', '1', '1', '', NULL, 'yes', '2025-04-24 19:17:33', '2025-04-24 19:17:33', NULL),
(428, 'e8e4f9c8-3813-41b7-90a7-fb4e901307c1', 1, 8, 1, 'shay oud incence', 'shay-oud-incence', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 5, '1', '1', '1', '', NULL, 'yes', '2025-04-24 19:18:31', '2025-04-24 19:18:31', NULL),
(429, 'd93c36a2-9925-4800-a633-73db78abf4f5', 1, 8, 1, 'shay shay incence', 'shay-shay-incence', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-24 19:19:06', '2025-04-24 19:19:06', NULL),
(430, '927db0d1-079b-4f60-9421-07f074d36d34', 1, 8, 1, 'shumukh incence', 'shumukh-incence', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 5, '1', '1', '1', '', NULL, 'yes', '2025-04-24 19:19:26', '2025-04-24 19:19:26', NULL),
(431, 'cd07835c-9f0b-450a-bc77-1c7500225647', 1, 8, 1, 'shikah abdullah incence', 'shikah-abdullah-incence', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 5, '1', '1', '1', '', NULL, 'yes', '2025-04-24 19:19:47', '2025-04-24 19:19:47', NULL),
(432, 'd4633eed-edcc-446b-b39f-8dd544682bc6', 1, 8, 1, 'qissa incence', 'qissa-incence', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 5, '1', '1', '1', '', NULL, 'yes', '2025-04-24 19:20:04', '2025-04-24 19:20:04', NULL),
(433, 'e71637f2-db29-485c-9d26-e7b9b461be85', 1, 2, 1, 'sample quintity', 'sample-quintity', 'عبيع عينات', '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-24 20:22:56', '2025-04-24 20:22:56', NULL),
(434, 'ec248296-bbbe-4431-b338-ff96ac566c60', 1, 2, 1, 'DELIVERY CHARGE', 'delivery-charge', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-25 18:06:35', '2025-04-25 18:06:35', NULL),
(435, 'f8dc2ed6-14fa-4c0c-8eac-65d0dd9c513f', 1, 4, 1, 'LIBRE AIR FRESHNER', 'libre-air-freshner', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '1', '1', '1', '', NULL, 'yes', '2025-04-25 18:07:02', '2025-04-25 18:07:02', NULL),
(436, '534263af-ffb9-445f-8667-cef65e0df056', 1, 10, 4, 'alcohol reval perfume', 'alcohol-reval-perfume', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 120, '2', '1', '1', '', NULL, 'yes', '2025-04-25 19:48:00', '2025-05-07 13:11:33', '2025-05-07 13:11:33'),
(437, '6f461b00-09a4-44a1-bb24-78e5ab47ea04', 1, 9, 1, 'cap 0019', 'cap-0019', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745739796.jpg', NULL, 'yes', '2025-04-27 11:43:16', '2025-04-27 11:43:16', NULL),
(438, '326a14f5-2441-437c-9a23-38bb597b430b', 1, 9, 1, 'cap 0020', 'cap-0020', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745739830.jpg', NULL, 'yes', '2025-04-27 11:43:50', '2025-04-27 11:43:50', NULL),
(439, 'df00c300-613a-4fb9-ac22-206a323b7403', 1, 9, 1, 'cap 0022', 'cap-0022', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745739937.jpg', NULL, 'yes', '2025-04-27 11:45:37', '2025-04-27 11:45:37', NULL),
(440, '2b6cc433-9168-437b-ad56-a00be43a1bd6', 1, 9, 1, 'cap 0023', 'cap-0023', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745739965.jpg', NULL, 'yes', '2025-04-27 11:46:05', '2025-04-27 11:46:05', NULL),
(441, '6b5ef69f-f8ec-4bbd-8c8c-852998398b23', 1, 9, 1, 'cap 0024', 'cap-0024', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745739998.jpg', NULL, 'yes', '2025-04-27 11:46:38', '2025-04-27 11:46:38', NULL),
(442, 'be5a2a83-5beb-4e06-b297-78dcdf2d9598', 1, 9, 1, 'cap 0025', 'cap-0025', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740086.jpg', NULL, 'yes', '2025-04-27 11:48:06', '2025-04-27 11:48:06', NULL),
(443, '4b82f70b-788b-4838-b7a3-ecb41bc84986', 1, 9, 1, 'cap 0026', 'cap-0026', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740118.jpg', NULL, 'yes', '2025-04-27 11:48:38', '2025-04-27 11:48:38', NULL);
INSERT INTO `items` (`id`, `uuid`, `branch_id`, `category_id`, `unit_id`, `item_name`, `item_slug`, `item_other_name`, `item_cost_price`, `multiple_price`, `item_price`, `tax`, `tax_percent`, `barcode`, `stock`, `minimum_qty`, `item_type`, `stock_applicable`, `ingredient`, `image`, `expiry_date`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(444, 'ccfbc4b7-234a-49c3-98d2-6b624fd7bef8', 1, 9, 1, 'cap 0027', 'cap-0027', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740145.jpg', NULL, 'yes', '2025-04-27 11:49:05', '2025-04-27 11:49:05', NULL),
(445, 'ff118c52-393d-473d-adff-5b4a4805ce49', 1, 9, 1, 'cap 0028', 'cap-0028', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740175.jpg', NULL, 'yes', '2025-04-27 11:49:35', '2025-04-27 11:49:35', NULL),
(446, 'a0e03e68-06b7-494c-b0bf-8801e2fd5803', 1, 9, 1, 'cap 0029', 'cap-0029', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740203.jpg', NULL, 'yes', '2025-04-27 11:50:03', '2025-04-27 11:50:03', NULL),
(447, '1defab35-c841-44f0-8d75-3da3ef240b6d', 1, 9, 1, 'cap 0030', 'cap-0030', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740237.jpg', NULL, 'yes', '2025-04-27 11:50:37', '2025-04-27 11:50:37', NULL),
(448, 'c9e1cb24-12d8-4c1c-a00c-89bb22483ef5', 1, 9, 1, 'cap 0031', 'cap-0031', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740272.jpg', NULL, 'yes', '2025-04-27 11:51:12', '2025-04-27 11:51:12', NULL),
(449, '25743a4b-967c-42e5-a0e7-fdc7440a1b71', 1, 9, 1, 'cap 0032', 'cap-0032', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740322.jpg', NULL, 'yes', '2025-04-27 11:52:02', '2025-04-27 11:52:02', NULL),
(450, 'd603ec63-8633-4db2-9f0a-34b6d848a93c', 1, 9, 1, 'cap 0033', 'cap-0033', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740354.jpg', NULL, 'yes', '2025-04-27 11:52:34', '2025-04-27 11:52:34', NULL),
(451, 'd7e0cb4c-cd28-4db1-aeef-be58820e9cea', 1, 9, 1, 'cap 0034', 'cap-0034', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '1', '1745740491.jpg', NULL, 'yes', '2025-04-27 11:54:51', '2025-04-27 11:54:51', NULL),
(452, '13fb4ab2-9678-4dda-8b23-1f4d9a8f44b7', 1, 9, 1, 'cap 0035', 'cap-0035', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740522.jpg', NULL, 'yes', '2025-04-27 11:55:22', '2025-04-27 11:55:33', NULL),
(453, '7b133958-1a90-4be7-b09a-1975734386d8', 1, 10, 1, 'CAP REVAL GOLD', 'cap-reval-gold', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 500, '2', '1', '0', '1745740614.jpg', NULL, 'yes', '2025-04-27 11:56:54', '2025-04-28 19:41:59', NULL),
(454, 'c182cead-7c1d-4803-a55e-2495c7a613d5', 1, 9, 1, 'CAP 0037', 'cap-0037', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740637.jpg', NULL, 'yes', '2025-04-27 11:57:17', '2025-04-27 11:57:17', NULL),
(455, 'cf009197-b82d-4849-ab9b-7e611cf0da08', 1, 9, 1, 'CAP 0038', 'cap-0038', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740675.jpg', NULL, 'yes', '2025-04-27 11:57:55', '2025-04-27 11:57:55', NULL),
(456, '8efed04d-81e3-4f63-8f9c-d4df8b5203d2', 1, 9, 1, 'CAP 0039', 'cap-0039', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740719.jpg', NULL, 'yes', '2025-04-27 11:58:39', '2025-04-27 11:58:39', NULL),
(457, 'a0546bcc-70ad-4f89-a94c-0f22e608c162', 1, 9, 1, 'CAP 0040', 'cap-0040', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740743.jpg', NULL, 'yes', '2025-04-27 11:59:03', '2025-04-27 11:59:03', NULL),
(458, '84449875-b453-4f9b-8291-4e1838a51af5', 1, 9, 1, 'CAP 0041', 'cap-0041', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740769.jpg', NULL, 'yes', '2025-04-27 11:59:29', '2025-04-27 11:59:29', NULL),
(459, 'cacf6455-b98f-4c66-b36f-5190408ab358', 1, 9, 1, 'CAP 0042', 'cap-0042', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740808.jpg', NULL, 'yes', '2025-04-27 12:00:08', '2025-04-27 12:00:08', NULL),
(460, '49c64f4a-3874-4738-82b7-3507b1368752', 1, 9, 1, 'CAP 0043', 'cap-0043', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740842.jpg', NULL, 'yes', '2025-04-27 12:00:42', '2025-04-27 12:00:42', NULL),
(461, '1b711fad-2b3e-413e-8718-bcdf9309a513', 1, 9, 1, 'CAP 0044', 'cap-0044', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740875.jpg', NULL, 'yes', '2025-04-27 12:01:15', '2025-04-27 12:01:15', NULL),
(462, '58f955b4-e6dc-4b8d-be1a-314d361b6aa5', 1, 9, 1, 'CAP 0045', 'cap-0045', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740904.jpg', NULL, 'yes', '2025-04-27 12:01:44', '2025-04-27 12:01:44', NULL),
(463, 'd70be660-2e47-446e-b445-819e165512eb', 1, 9, 1, 'CAP 0046', 'cap-0046', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740936.jpg', NULL, 'yes', '2025-04-27 12:02:16', '2025-04-27 12:02:16', NULL),
(464, '7da8835d-20c2-4be7-b4d6-4de1b0a2ecca', 1, 9, 1, 'CAP 0047', 'cap-0047', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745740992.jpg', NULL, 'yes', '2025-04-27 12:02:56', '2025-04-27 12:03:12', NULL),
(465, '1bc2f873-08af-404c-acea-713a62ad0d17', 1, 9, 1, 'CAP 0048', 'cap-0048', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745741046.jpg', NULL, 'yes', '2025-04-27 12:04:06', '2025-04-27 12:04:06', NULL),
(466, 'fa2f4fc0-6050-4ce9-99b7-3cc6b9e4ea61', 1, 9, 1, 'CAP 0049', 'cap-0049', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745741111.jpg', NULL, 'yes', '2025-04-27 12:05:11', '2025-04-27 12:05:11', NULL),
(467, 'fcca7720-98d7-4a32-81a3-6e494838a84b', 1, 9, 1, 'CAP 0050', 'cap-0050', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745741157.jpg', NULL, 'yes', '2025-04-27 12:05:57', '2025-04-27 12:05:57', NULL),
(468, '74a91cfc-31ec-403d-90d1-9b6c8daff8b0', 1, 9, 1, 'CAP 0051', 'cap-0051', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745741284.jpg', NULL, 'yes', '2025-04-27 12:08:04', '2025-04-27 12:11:37', NULL),
(469, 'acbb3384-f366-49e2-abf0-5716023d2a09', 1, 9, 1, 'CAP 0052', 'cap-0052', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745741313.jpg', NULL, 'yes', '2025-04-27 12:08:33', '2025-04-27 12:08:33', NULL),
(470, '36fde80d-def1-45c9-9614-398f5e516b0f', 1, 10, 1, 'CAP REVAL BLACK', 'cap-reval-black', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 500, '2', '1', '1', '1745741343.jpg', NULL, 'yes', '2025-04-27 12:09:03', '2025-04-28 19:42:19', NULL),
(471, '05864b53-250d-476d-a3e6-d1e7ef572c58', 1, 9, 1, 'CAP 0054', 'cap-0054', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745741392.jpg', NULL, 'yes', '2025-04-27 12:09:52', '2025-04-27 12:09:52', NULL),
(472, 'c8562b5b-cebe-4f53-a1a1-5f60edd64c49', 1, 9, 1, 'CAP 0056', 'cap-0056', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745741549.jpg', NULL, 'yes', '2025-04-27 12:12:29', '2025-04-27 12:12:29', NULL),
(473, '3b5e1a82-8c6a-48ed-9299-85995429cdf9', 1, 9, 1, 'CAP 0057', 'cap-0057', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745741587.jpg', NULL, 'yes', '2025-04-27 12:13:07', '2025-04-27 12:13:07', NULL),
(474, '4e1c9e02-c5e1-470f-82df-b9534d4440c7', 1, 9, 1, 'CAP 0058', 'cap-0058', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745741623.jpg', NULL, 'yes', '2025-04-27 12:13:43', '2025-04-27 12:13:43', NULL),
(475, 'b23b00f2-f289-4832-9a34-0d6cea2d0394', 1, 9, 1, 'CAP 0059', 'cap-0059', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745741670.jpg', NULL, 'yes', '2025-04-27 12:14:30', '2025-04-27 12:14:30', NULL),
(476, 'b7a8d173-b786-4b60-850c-26a970f89274', 1, 9, 1, 'CAP 0060', 'cap-0060', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745741716.jpg', NULL, 'yes', '2025-04-27 12:15:16', '2025-04-27 12:15:16', NULL),
(477, 'c578d4a5-06cb-488d-a013-3e67546ca740', 1, 9, 1, 'CAP 0061', 'cap-0061', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745741746.jpg', NULL, 'yes', '2025-04-27 12:15:46', '2025-04-27 12:15:46', NULL),
(478, 'bf85e00c-9799-40d4-90b7-51bf0ff6efa4', 1, 9, 1, 'CAP 0062', 'cap-0062', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1745741775.jpg', NULL, 'yes', '2025-04-27 12:16:15', '2025-04-27 12:16:15', NULL),
(479, 'aedda7e9-8c04-4a4a-aa60-4c94887ea2d0', 1, 9, 1, 'CAP 0063', 'cap-0063', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745741802.jpg', NULL, 'yes', '2025-04-27 12:16:42', '2025-04-27 12:16:42', NULL),
(480, 'c70d8d16-d9c7-4b30-88f3-2ed4f265d20a', 1, 9, 1, 'CAP 0064', 'cap-0064', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745741841.jpg', NULL, 'yes', '2025-04-27 12:17:21', '2025-04-27 12:17:21', NULL),
(481, 'aa167fad-0a30-4b1e-b165-953666b0111c', 1, 9, 1, 'CAP 0065', 'cap-0065', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745741886.jpg', NULL, 'yes', '2025-04-27 12:18:06', '2025-04-27 12:18:06', NULL),
(482, '0c708ac6-46f8-405a-9629-f836c5c4eff5', 1, 9, 1, 'CAP 0066', 'cap-0066', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745742064.jpg', NULL, 'yes', '2025-04-27 12:21:04', '2025-04-27 12:21:04', NULL),
(483, '6db94e5f-f7e7-4234-bfb1-4650c8016f00', 1, 9, 1, 'CAP 0067', 'cap-0067', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745742098.jpg', NULL, 'yes', '2025-04-27 12:21:38', '2025-04-27 12:21:38', NULL),
(484, '098dbc66-3881-4b02-95c2-ea2536e5cbe8', 1, 9, 1, 'CAP 0068', 'cap-0068', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745742122.jpg', NULL, 'yes', '2025-04-27 12:22:02', '2025-04-27 12:22:02', NULL),
(485, 'c952ab73-b5ed-4823-a91c-9fb0a502b432', 1, 9, 1, 'CAP 0069', 'cap-0069', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745742179.jpg', NULL, 'yes', '2025-04-27 12:22:59', '2025-04-27 12:22:59', NULL),
(486, '2a3d8096-cddb-4415-bdd3-4c49f3438b09', 1, 9, 1, 'CAP 0070', 'cap-0070', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745742212.jpg', NULL, 'yes', '2025-04-27 12:23:32', '2025-04-27 12:23:32', NULL),
(487, '1c094577-3f55-4ab8-ab58-9f5090386120', 1, 9, 1, 'CAP 0071', 'cap-0071', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745742295.jpg', NULL, 'yes', '2025-04-27 12:24:55', '2025-04-27 12:24:55', NULL),
(488, '6ae1d27b-ed01-43cf-b177-7540afd481ef', 1, 9, 1, 'CAP 0072', 'cap-0072', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745742340.jpg', NULL, 'yes', '2025-04-27 12:25:40', '2025-04-27 12:25:40', NULL),
(489, '9a41f33d-7324-44e6-8b6c-d36f18464ee6', 1, 9, 1, 'CAP 0073', 'cap-0073', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745742371.jpg', NULL, 'yes', '2025-04-27 12:26:11', '2025-04-27 12:26:11', NULL),
(490, '89012176-af97-4dc1-bffb-45297fd9cf40', 1, 9, 1, 'CAP 0074', 'cap-0074', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745742395.jpg', NULL, 'yes', '2025-04-27 12:26:35', '2025-04-27 12:26:35', NULL),
(491, 'fddb4acd-f986-4972-bd08-decb64e2bdca', 1, 9, 1, 'CAP 0075', 'cap-0075', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745742431.jpg', NULL, 'yes', '2025-04-27 12:27:11', '2025-04-27 12:27:11', NULL),
(492, '81c11774-c443-4512-a846-291d017f3441', 1, 9, 1, 'CAP 0076', 'cap-0076', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745742680.jpg', NULL, 'yes', '2025-04-27 12:31:20', '2025-04-27 12:31:20', NULL),
(493, '71632bba-787c-4422-ab74-0a9aee8c2e07', 1, 9, 1, 'CAP 0077', 'cap-0077', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745742721.jpg', NULL, 'yes', '2025-04-27 12:32:01', '2025-04-27 12:32:01', NULL),
(494, 'e4cddbd2-9c7a-4c7e-ae36-b3df0fcb0cd2', 1, 9, 1, 'CAP 0078', 'cap-0078', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745742865.jpg', NULL, 'yes', '2025-04-27 12:34:25', '2025-04-27 12:34:25', NULL),
(495, '25bfd703-7723-47f7-ba6e-3527cac921d1', 1, 9, 1, 'CAP 0079', 'cap-0079', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745744950.jpg', NULL, 'yes', '2025-04-27 13:09:10', '2025-04-27 13:09:10', NULL),
(496, '7ebe0de3-baf3-4969-ab61-cac1dd97e5ec', 1, 9, 1, 'CAP 0080', 'cap-0080', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745744976.jpg', NULL, 'yes', '2025-04-27 13:09:36', '2025-04-27 13:09:36', NULL),
(497, 'bf36d9b0-e1d4-46f4-8969-968cbb4e02bf', 1, 9, 1, 'CAP 0081', 'cap-0081', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745030.jpg', NULL, 'yes', '2025-04-27 13:10:30', '2025-04-27 13:10:30', NULL),
(498, 'e6c0b956-afaa-4da0-b6a1-1f29aa7ac9b0', 1, 9, 1, 'CAP 0082', 'cap-0082', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745069.jpg', NULL, 'yes', '2025-04-27 13:11:09', '2025-04-27 13:11:09', NULL),
(499, '5fd40cdb-2439-453c-b735-d533bcafe636', 1, 9, 1, 'CAP 0083', 'cap-0083', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745121.jpg', NULL, 'yes', '2025-04-27 13:12:01', '2025-04-27 13:12:01', NULL),
(500, '92284e19-9f67-40dd-8956-1bbd069a41fd', 1, 9, 1, 'CAP 0084', 'cap-0084', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745196.jpg', NULL, 'yes', '2025-04-27 13:13:16', '2025-04-27 13:13:16', NULL),
(501, '9c84d56c-e041-432e-b428-aa22d8da3a8d', 1, 9, 1, 'CAP 0085', 'cap-0085', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745228.jpg', NULL, 'yes', '2025-04-27 13:13:48', '2025-04-27 13:13:48', NULL),
(502, '9994b24c-e17b-49ea-b386-e7bf5ffd9b34', 1, 9, 1, 'CAP 0086', 'cap-0086', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745266.jpg', NULL, 'yes', '2025-04-27 13:14:26', '2025-04-27 13:14:26', NULL),
(503, '82557da6-de43-4bdb-b865-97da30f4dd67', 1, 9, 1, 'CAP 0087', 'cap-0087', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745323.jpg', NULL, 'yes', '2025-04-27 13:15:23', '2025-04-27 13:15:23', NULL),
(504, 'e52fa840-aadf-463a-bf27-003ad5b1662a', 1, 9, 1, 'CAP 0088', 'cap-0088', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745353.jpg', NULL, 'yes', '2025-04-27 13:15:53', '2025-04-27 13:15:53', NULL),
(505, '8ee75c83-e20a-4dd6-b5ea-1d74cf19d071', 1, 9, 1, 'CAP 0089', 'cap-0089', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745379.jpg', NULL, 'yes', '2025-04-27 13:16:19', '2025-04-27 13:16:19', NULL),
(506, '95f0d5de-eabb-48f6-8f28-41db5cf7b392', 1, 9, 1, 'CAP 0090', 'cap-0090', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745429.jpg', NULL, 'yes', '2025-04-27 13:17:09', '2025-04-27 13:17:09', NULL),
(507, '8c1d7249-b9c6-4c0a-8125-b8568dc8f337', 1, 9, 1, 'CAP 0091', 'cap-0091', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745635.jpg', NULL, 'yes', '2025-04-27 13:17:44', '2025-04-27 13:20:35', NULL),
(508, 'd8a3f779-bdc0-4d26-987b-9543100e0123', 1, 9, 1, 'CAP 0092', 'cap-0092', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745668.jpg', NULL, 'yes', '2025-04-27 13:21:08', '2025-04-27 13:21:08', NULL),
(509, 'a27f53ee-a5ad-4c81-af10-a27272d60a50', 1, 9, 1, 'CAP 0093', 'cap-0093', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745716.jpg', NULL, 'yes', '2025-04-27 13:21:56', '2025-04-27 13:21:56', NULL),
(510, 'ec8f4589-b7f6-4040-936d-897f35bb41ab', 1, 9, 1, 'CAP 0094', 'cap-0094', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745751.jpg', NULL, 'yes', '2025-04-27 13:22:31', '2025-04-27 13:22:31', NULL),
(511, 'afdc6a33-d578-4e75-bf88-46050458548c', 1, 9, 1, 'CAP 0095', 'cap-0095', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745804.jpg', NULL, 'yes', '2025-04-27 13:23:24', '2025-04-27 13:23:24', NULL),
(512, 'a09f7060-cd1e-4b74-a1ce-d5341f0c6753', 1, 9, 1, 'CAP 0096', 'cap-0096', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745822.jpg', NULL, 'yes', '2025-04-27 13:23:42', '2025-04-27 13:23:42', NULL),
(513, '1b7582c0-4197-44e1-a7f6-b9b127fd62e1', 1, 9, 1, 'CAP 0097', 'cap-0097', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745848.jpg', NULL, 'yes', '2025-04-27 13:24:08', '2025-04-27 13:24:08', NULL),
(514, 'fbb7cf5a-509c-49a6-9c5a-fe4ad341fcdf', 1, 9, 1, 'CAP 0100', 'cap-0100', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745893.jpg', NULL, 'yes', '2025-04-27 13:24:53', '2025-04-27 13:24:53', NULL),
(515, '5d046db9-5214-4de8-83c4-80ce5d8542e7', 1, 9, 1, 'CAP 0101', 'cap-0101', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745917.jpg', NULL, 'yes', '2025-04-27 13:25:17', '2025-04-27 13:25:17', NULL),
(516, 'd1b271f6-c101-4257-ba28-fee44706e1c1', 1, 9, 1, 'CAP 0106', 'cap-0106', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745952.jpg', NULL, 'yes', '2025-04-27 13:25:52', '2025-04-27 13:25:52', NULL),
(517, '7235be7b-97e4-4cf6-84ba-426126845dfc', 1, 9, 1, 'CAP 0107', 'cap-0107', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745745989.jpg', NULL, 'yes', '2025-04-27 13:26:29', '2025-04-27 13:26:29', NULL),
(518, '31846a09-431a-4df1-90af-32628a9e9ae6', 1, 9, 1, 'CAP 0108', 'cap-0108', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746011.jpg', NULL, 'yes', '2025-04-27 13:26:51', '2025-04-27 13:26:51', NULL),
(519, 'eb497923-6f1c-43bc-a5a0-5106f5c9de7c', 1, 9, 1, 'CAP 0109', 'cap-0109', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746036.jpg', NULL, 'yes', '2025-04-27 13:27:16', '2025-04-27 13:27:16', NULL),
(520, '6e0d09fd-266b-47bc-9f60-035c9059adcb', 1, 9, 1, 'CAP 0110', 'cap-0110', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746112.jpg', NULL, 'yes', '2025-04-27 13:28:32', '2025-04-27 13:28:32', NULL),
(521, 'a9877c10-7eb1-41e8-a7dc-924d1767460e', 1, 9, 1, 'CAP 0111', 'cap-0111', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746141.jpg', NULL, 'yes', '2025-04-27 13:29:01', '2025-04-27 13:29:01', NULL),
(522, 'e5f817c1-0f85-4620-911d-f8dca8cb8e09', 1, 9, 1, 'CAP 0112', 'cap-0112', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746179.jpg', NULL, 'yes', '2025-04-27 13:29:39', '2025-04-27 13:29:39', NULL),
(523, '4d25dc68-6224-4259-acee-b18027396cec', 1, 9, 1, 'CAP 0114', 'cap-0114', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746217.jpg', NULL, 'yes', '2025-04-27 13:30:17', '2025-04-27 13:30:17', NULL),
(524, '85ade998-4303-44ca-85ce-4a4d2b6129ca', 1, 9, 1, 'CAP 0115', 'cap-0115', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746267.jpg', NULL, 'yes', '2025-04-27 13:31:07', '2025-04-27 13:31:07', NULL),
(525, '8d67cc0c-2512-4d64-a8f5-b1b2b0c01105', 1, 9, 1, 'CAP 0116', 'cap-0116', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746312.jpg', NULL, 'yes', '2025-04-27 13:31:52', '2025-04-27 13:31:52', NULL),
(526, '278238c2-fb2e-4288-b32e-ad1ed2970ef2', 1, 9, 1, 'CAP 0117', 'cap-0117', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746354.jpg', NULL, 'yes', '2025-04-27 13:32:34', '2025-04-27 13:32:34', NULL),
(527, '8f623c46-de7a-4a50-a2c8-6e98cfa94ae1', 1, 9, 1, 'CAP 0118', 'cap-0118', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746387.jpg', NULL, 'yes', '2025-04-27 13:33:07', '2025-04-27 13:33:07', NULL),
(528, 'be7acb73-af66-4aff-a6fe-bfe25fdd008e', 1, 9, 1, 'CAP 0119', 'cap-0119', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746427.jpg', NULL, 'yes', '2025-04-27 13:33:47', '2025-04-27 13:33:47', NULL),
(529, 'ba437dba-1821-43e2-b07f-0d22da6c0ce4', 1, 9, 1, 'CAP 0120', 'cap-0120', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746452.jpg', NULL, 'yes', '2025-04-27 13:34:12', '2025-04-27 13:34:12', NULL),
(530, '7aa13e43-2620-4bdc-be75-8efec8983453', 1, 9, 1, 'CAP 01121', 'cap-01121', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746501.jpg', NULL, 'yes', '2025-04-27 13:35:01', '2025-04-27 13:35:01', NULL),
(531, 'fae82e61-dd4a-471b-9ca2-359b90e189c8', 1, 9, 1, 'CAP 0122', 'cap-0122', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746526.jpg', NULL, 'yes', '2025-04-27 13:35:26', '2025-04-27 13:35:26', NULL),
(532, '490fc180-5f50-4fce-ae07-26208f4d22e7', 1, 9, 1, 'CAP 01124', 'cap-01124', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746553.jpg', NULL, 'yes', '2025-04-27 13:35:53', '2025-04-27 13:35:53', NULL),
(533, 'b279d37b-f077-4783-a788-44534ca3e39c', 1, 9, 1, 'CAP 0126', 'cap-0126', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746600.jpg', NULL, 'yes', '2025-04-27 13:36:40', '2025-04-27 13:36:40', NULL),
(534, 'd1cc2c81-ae77-47d9-b2fb-6f7a7b2412f4', 1, 9, 1, 'CAP 01127', 'cap-01127', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746624.jpg', NULL, 'yes', '2025-04-27 13:37:04', '2025-04-27 13:37:04', NULL),
(535, 'd968443c-f6f7-46d9-8c26-1f35f23b8654', 1, 9, 1, 'CAP 01128', 'cap-01128', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746649.jpg', NULL, 'yes', '2025-04-27 13:37:29', '2025-04-27 13:37:29', NULL),
(536, '18145110-6af6-4c69-adef-65c6b04eb753', 1, 9, 1, 'CAP 0127', 'cap-0127', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746796.jpg', NULL, 'yes', '2025-04-27 13:39:56', '2025-04-27 13:39:56', NULL),
(537, 'd50cd180-ce39-4830-acf2-de76b70efc02', 1, 9, 1, 'CAP 0128', 'cap-0128', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746819.jpg', NULL, 'yes', '2025-04-27 13:40:19', '2025-04-27 13:40:19', NULL),
(538, '6e2175d4-101e-4919-8c99-f3976818cae9', 1, 9, 1, 'CAP 0129', 'cap-0129', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746843.jpg', NULL, 'yes', '2025-04-27 13:40:43', '2025-04-27 13:40:43', NULL),
(539, '0a0c29f9-1543-40a1-a6aa-dc107bd7c5de', 1, 9, 1, 'CAP 0131', 'cap-0131', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746896.jpg', NULL, 'yes', '2025-04-27 13:41:36', '2025-04-27 13:41:36', NULL),
(540, '603b21e5-2757-48ef-b400-4f902f10c7ab', 1, 9, 1, 'CAP 0132', 'cap-0132', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746920.jpg', NULL, 'yes', '2025-04-27 13:42:00', '2025-04-27 13:42:00', NULL),
(541, '217dc9ff-6e49-4fb4-b912-3e8c0c113a15', 1, 9, 1, 'CAP 0133', 'cap-0133', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745746987.jpg', NULL, 'yes', '2025-04-27 13:43:07', '2025-04-27 13:43:07', NULL),
(542, 'bb8a65c2-fede-4878-ad57-b8474cf91657', 1, 9, 1, 'CAP 0134', 'cap-0134', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745747008.jpg', NULL, 'yes', '2025-04-27 13:43:28', '2025-04-27 13:43:28', NULL),
(543, 'af55b937-f5a0-4885-8eef-43a3e769252f', 1, 9, 1, 'CAP 0135', 'cap-0135', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745747056.jpg', NULL, 'yes', '2025-04-27 13:44:16', '2025-04-27 13:44:16', NULL),
(544, '3eff4954-cd62-4fe8-9f7e-a6774facc290', 1, 9, 1, 'CAP 0136', 'cap-0136', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745747080.jpg', NULL, 'yes', '2025-04-27 13:44:40', '2025-04-27 13:44:40', NULL),
(545, 'df9ea59a-e5f4-404f-9a39-7ba1351a63b6', 1, 9, 1, 'CAP 0137', 'cap-0137', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745747100.jpg', NULL, 'yes', '2025-04-27 13:45:00', '2025-04-27 13:45:00', NULL),
(546, '5b876996-e6b4-411c-a3d3-7697ddf61cf0', 1, 9, 1, 'CAP 0138', 'cap-0138', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 1, '2', '1', '0', '1745747128.jpg', NULL, 'yes', '2025-04-27 13:45:28', '2025-04-27 13:45:28', NULL),
(547, 'b353e147-34d8-4f49-82c9-4bc7c00c9c10', 1, 2, 1, '1957', '1957', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 8, '1', '1', '1', '', NULL, 'yes', '2025-04-27 15:31:56', '2025-04-27 15:36:19', NULL),
(548, '351ff0c3-8042-4c47-a5e4-0f41d3fdc7f5', 1, 2, 1, 'AROJA AHLAM', 'aroja-ahlam', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 7, '1', '1', '1', '', NULL, 'yes', '2025-04-27 15:32:25', '2025-04-27 15:36:05', NULL),
(549, 'fe1206c1-de8c-466c-a7f8-83e1568555d2', 1, 2, 1, 'MAGEC', 'magec', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 4, '1', '1', '1', '', NULL, 'yes', '2025-04-27 15:35:50', '2025-04-27 15:35:50', NULL),
(550, 'acda8b05-369c-4a5b-833a-aabe87ee6d31', 1, 2, 1, 'VERT', 'vert', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 5, '1', '1', '1', '', NULL, 'yes', '2025-04-27 15:36:53', '2025-04-27 15:36:53', NULL),
(551, 'ef27fccf-618c-4731-9bf6-1c2c39b2eaa5', 1, 2, 1, 'AMBER LEATHER', 'amber-leather', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 5, '1', '1', '1', '', NULL, 'yes', '2025-04-27 15:37:18', '2025-04-27 15:37:18', NULL),
(552, '903c97fc-d837-4351-a972-0ae6cecedbc5', 1, 2, 1, 'Y', 'y', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 5, '1', '1', '1', '', NULL, 'yes', '2025-04-27 15:37:32', '2025-04-27 15:37:32', NULL),
(553, '2537391f-bb8d-4d1c-a7ee-cc0390776f19', 1, 10, 1, 'box reval maroun', 'box-reval-maroun', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 500, '2', '1', '1', '', NULL, 'yes', '2025-04-28 18:54:17', '2025-04-28 19:43:58', NULL),
(554, '7cec0a90-35cf-4a62-a552-bab43aba7c89', 1, 5, 1, 'BEAKER 100 ML', 'beaker-100-ml', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '1', '', NULL, 'yes', '2025-05-05 10:12:30', '2025-05-05 10:23:37', '2025-05-05 10:23:37'),
(555, '9cbd0aa6-95a0-47e8-bcb3-26290558a11e', 1, 5, 1, 'BEAKER 100 ML', 'beaker-100-ml', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '1', '', NULL, 'yes', '2025-05-05 10:24:31', '2025-05-05 12:55:21', NULL),
(556, '7945dfd0-f980-4acc-8de3-ea753ddba472', 1, 5, 1, 'BEAKER 250 ML', 'beaker-250-ml', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'no', '2025-05-05 10:27:04', '2025-05-05 12:55:30', NULL),
(557, '6562cade-1184-4fcf-b411-dba5309efc71', 1, 5, 1, 'BEAKER 500 ML', 'beaker-500-ml', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'no', '2025-05-05 10:28:01', '2025-05-05 12:55:41', NULL),
(558, '90f65fbc-0887-4fc3-99ef-e48b5480e9f8', 1, 5, 1, 'BEAKER 50 ML', 'beaker-50-ml', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'no', '2025-05-05 10:31:04', '2025-05-05 12:55:36', NULL),
(559, 'e5d4fb11-693d-4ec0-ab6c-107902fa226e', 1, 5, 1, 'PLASTIC FUNNEL', 'plastic-funnel', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'no', '2025-05-05 10:36:29', '2025-05-05 10:36:29', NULL),
(560, 'f5e4b5a9-5ce6-4196-911f-887be517e304', 1, 5, 1, 'WASH BOTTLE 1000 ML', 'wash-bottle-1000-ml', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'no', '2025-05-05 10:37:17', '2025-05-05 10:37:17', NULL),
(561, '11380694-27d8-4b8f-b625-b51fd4f1bf20', 1, 5, 1, 'WASH BOTTLE 500 ML', 'wash-bottle-500-ml', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'no', '2025-05-05 10:37:58', '2025-05-05 10:37:58', NULL),
(562, '4f340d5a-edd9-4690-b405-a3ce33f84320', 1, 5, 1, 'GLASS REGENT BOTTLE 3000 ML', 'glass-regent-bottle-3000-ml', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '1', '', NULL, 'yes', '2025-05-05 11:09:52', '2025-05-05 11:12:58', '2025-05-05 11:12:58'),
(563, '85353060-9e05-4914-9c18-e23219050c4e', 1, 5, 1, 'MAGNATIC STIRRE BAR C10*35', 'magnatic-stirre-bar-c10-35', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'no', '2025-05-05 11:11:31', '2025-05-05 11:11:31', NULL),
(564, '9f2e5223-e52a-4bc3-8a0a-2875e0c71041', 1, 5, 1, 'GLASS REAGENT BOTTLE 3000 ML', 'glass-reagent-bottle-3000-ml', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'no', '2025-05-05 11:13:39', '2025-05-05 11:13:39', NULL),
(565, 'c4bfdfd6-3cae-4e16-aea5-0c294442b14f', 1, 11, 1, 'BUKHOOR JAR MINI 50 GM', 'bukhoor-jar-mini-50-gm', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '1746431404.jpg', NULL, 'yes', '2025-05-05 11:50:04', '2025-05-05 12:53:04', NULL),
(566, 'af6c7418-f8e5-4ee5-858d-3732718ce85d', 1, 6, 1, 'OIL HAMDAN BUKHOOR', 'oil-hamdan-bukhoor', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '1', '', NULL, 'yes', '2025-05-05 13:09:48', '2025-05-05 13:09:48', NULL),
(567, 'b1b5348b-0deb-4527-8a2e-0b3bc17057c3', 1, 6, 1, 'AMBER HINDI', 'amber-hindi', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-05-05 15:08:30', '2025-05-05 15:08:30', NULL),
(568, 'f56865b3-465a-4d83-9c40-b0aeb3097c87', 1, 6, 1, 'WHITE AMBER', 'white-amber', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-05-05 15:08:55', '2025-05-05 15:08:55', NULL),
(569, 'a4e0e672-c71a-4628-9de3-dc42886579de', 1, 12, 1, 'BOX BOUKHOOR', 'box-boukhoor', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-05-05 15:20:36', '2025-05-05 15:20:36', NULL),
(570, '6ae07597-73d5-4a7e-93b4-8869d1ae4390', 1, 12, 1, 'BOX OUD', 'box-oud', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-05-05 15:21:03', '2025-05-05 15:21:03', NULL),
(571, '868aae0c-59ec-43d2-a02a-7dc34876d378', 1, 12, 1, 'BOX AIR FRESHNER', 'box-air-freshner', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-05-05 15:21:30', '2025-05-05 15:21:30', NULL),
(572, 'a357679c-c33d-4d30-8cb3-e8fb810c8b48', 1, 12, 1, 'BAG A4', 'bag-a4', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-05-05 15:22:09', '2025-05-05 15:22:09', NULL),
(573, '95334117-fa64-45eb-813c-b1357fe11d74', 1, 5, 1, 'GLASS REAGENT BOTTLE 5000 ML', 'glass-reagent-bottle-5000-ml', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'no', '2025-05-07 09:58:31', '2025-05-07 09:58:31', NULL),
(574, '1c95a397-9bff-40a4-9dff-38e12a7fb10a', 1, 5, 1, 'JAR GLASS WITH HAND 1000 ML', 'jar-glass-with-hand-1000-ml', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'no', '2025-05-07 09:59:34', '2025-05-07 09:59:34', NULL),
(575, 'c0c7bb15-7a49-495b-b534-c164dfdeb814', 1, 5, 1, 'PLASTIC WASH BOTTLE 1.2 LTR', 'plastic-wash-bottle-1-2-ltr', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'no', '2025-05-07 10:01:50', '2025-05-07 10:01:50', NULL),
(576, '13f202dc-089d-4ac9-b86a-d1e8bc80c796', 1, 5, 1, 'MIXER 500', 'mixer-500', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-05-07 10:02:29', '2025-05-07 10:02:29', NULL),
(577, '0cfb976e-c39b-4ae9-8bc4-3e287759c80a', 1, 5, 1, 'CELLPHONE CUTTING MANUAL WRAPPING MACHINE', 'cellphone-cutting-manual-wrapping-machine', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-05-07 10:13:38', '2025-05-07 10:13:38', NULL),
(578, 'fe61f872-083e-473b-ae19-b9d1f86288c9', 1, 5, 1, 'MANUAL CRIMPING MACHINE', 'manual-crimping-machine', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-05-07 10:14:26', '2025-05-07 10:14:26', NULL),
(579, '4117d38f-4c08-476c-a54b-5cc59287ecdf', 1, 5, 1, 'PNENUMATIC CRIMPING MACHINE', 'pnenumatic-crimping-machine', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-05-07 10:15:25', '2025-05-07 10:15:25', NULL),
(580, 'be194e45-52cc-4b7e-96fa-3846147ed3cd', 1, 5, 1, 'OIL STEACKER', 'oil-steacker', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'no', '2025-05-07 10:20:10', '2025-05-07 10:20:10', NULL),
(581, 'c444715d-ac5a-4031-b79e-8307e853a68d', 1, 5, 1, 'KG BUKHOOR STEACKER', 'kg-bukhoor-steacker', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-05-07 10:21:04', '2025-05-07 10:21:40', NULL),
(582, 'd5a08eb7-f0e1-4ae9-a100-a9ebf57d56a3', 1, 7, 1, 'COLOR BOTTLE 1 COLOR', 'color-bottle-1-color', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-05-07 10:39:50', '2025-05-07 10:39:50', NULL),
(583, 'b104a391-2939-482c-90b3-5f11861ac1a4', 1, 7, 1, 'PRINT LOGO', 'print-logo', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-05-07 10:40:13', '2025-05-07 10:40:13', NULL),
(584, '41b20f83-13b9-4a0b-b4e2-5dd903762f52', 1, 6, 4, 'OIL MARVO', 'oil-marvo', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '1', '', NULL, 'yes', '2025-05-07 10:47:02', '2025-05-07 10:49:36', NULL),
(585, '1e6601b2-cf71-4e62-8e5a-bfa5fb7f1237', 1, 5, 1, 'DELIVERY SPLIER', 'delivery-splier', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'yes', '2025-05-07 10:47:47', '2025-05-07 10:47:47', NULL),
(586, '3c119220-fbb4-4c03-9a0b-6db4c113dac8', 1, 10, 4, 'ALCOHOL', 'alcohol', NULL, '0', 'no', 0.00, 'no', NULL, NULL, NULL, 0, '2', '1', '0', '', NULL, 'no', '2025-05-07 13:12:45', '2025-05-07 13:12:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_ingredient`
--

CREATE TABLE `item_ingredient` (
  `id` int NOT NULL,
  `branch_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `main_item_id` int NOT NULL COMMENT 'it is item price id',
  `item_id` int NOT NULL,
  `price_id` int NOT NULL,
  `item_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `unit` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `qty` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_ingredient`
--

INSERT INTO `item_ingredient` (`id`, `branch_id`, `user_id`, `main_item_id`, `item_id`, `price_id`, `item_name`, `unit`, `qty`, `created_at`, `updated_at`) VALUES
(9, 1, 2, 1, 2, 2, 'BOTTLE -', 'pcs', 1, '2025-04-15 19:03:32', '2025-04-15 19:03:32'),
(10, 1, 2, 1, 4, 4, 'OIL -', 'KG', 0.02, '2025-04-15 19:03:32', '2025-04-15 19:03:32'),
(11, 1, 2, 1, 5, 5, 'ETHANOL -', 'LITRE', 63.03, '2025-04-15 19:03:32', '2025-04-15 19:03:32'),
(12, 1, 2, 1, 6, 6, 'BOX -', 'pcs', 1, '2025-04-15 19:03:32', '2025-04-15 19:03:32'),
(218, 1, 2, 579, 7, 7, 'bumb', 'pcs', 1, '2025-05-04 20:38:07', '2025-05-04 20:38:07'),
(219, 1, 2, 579, 436, 468, 'alcohol reval perfume', 'KG', 0.025, '2025-05-04 20:38:07', '2025-05-04 20:38:07'),
(220, 1, 2, 579, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-04 20:38:07', '2025-05-04 20:38:07'),
(221, 1, 2, 579, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-04 20:38:07', '2025-05-04 20:38:07'),
(222, 1, 2, 579, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-04 20:38:07', '2025-05-04 20:38:07'),
(223, 1, 2, 579, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-04 20:38:07', '2025-05-04 20:38:07'),
(294, 1, 2, 81, 7, 7, 'bumb', 'pcs', 1, '2025-05-05 15:40:01', '2025-05-05 15:40:01'),
(295, 1, 2, 81, 112, 144, 'OIL AZARAN', 'KG', 0.02, '2025-05-05 15:40:01', '2025-05-05 15:40:01'),
(296, 1, 2, 81, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-05 15:40:01', '2025-05-05 15:40:01'),
(297, 1, 2, 81, 436, 468, 'alcohol reval perfume', 'KG', 0.03, '2025-05-05 15:40:01', '2025-05-05 15:40:01'),
(298, 1, 2, 81, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-05 15:40:01', '2025-05-05 15:40:01'),
(299, 1, 2, 81, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-05 15:40:01', '2025-05-05 15:40:01'),
(300, 1, 2, 81, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-05 15:40:01', '2025-05-05 15:40:01'),
(364, 1, 2, 72, 7, 7, 'bumb', 'pcs', 1, '2025-05-05 16:45:14', '2025-05-05 16:45:14'),
(365, 1, 2, 72, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-05 16:45:14', '2025-05-05 16:45:14'),
(366, 1, 2, 72, 436, 468, 'alcohol reval perfume', 'KG', 0.02, '2025-05-05 16:45:14', '2025-05-05 16:45:14'),
(367, 1, 2, 72, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-05 16:45:14', '2025-05-05 16:45:14'),
(368, 1, 2, 72, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-05 16:45:14', '2025-05-05 16:45:14'),
(369, 1, 2, 72, 267, 299, 'OIL OUD MARACUJA', 'KG', 0.03, '2025-05-05 16:45:14', '2025-05-05 16:45:14'),
(398, 1, 2, 17, 7, 7, 'bumb', 'pcs', 1, '2025-05-05 17:18:55', '2025-05-05 17:18:55'),
(399, 1, 2, 17, 436, 468, 'alcohol reval perfume', 'KG', 0.025, '2025-05-05 17:18:55', '2025-05-05 17:18:55'),
(400, 1, 2, 17, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-05 17:18:55', '2025-05-05 17:18:55'),
(401, 1, 2, 17, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-05 17:18:55', '2025-05-05 17:18:55'),
(402, 1, 2, 17, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-05 17:18:55', '2025-05-05 17:18:55'),
(403, 1, 2, 17, 245, 277, 'OIL NISHANE HACIVAT', 'KG', 0.025, '2025-05-05 17:18:55', '2025-05-05 17:18:55'),
(404, 1, 2, 17, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-05 17:18:55', '2025-05-05 17:18:55'),
(579, 1, 2, 48, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 12:54:30', '2025-05-07 12:54:30'),
(580, 1, 2, 48, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 12:54:30', '2025-05-07 12:54:30'),
(581, 1, 2, 48, 436, 468, 'alcohol reval perfume', 'KG', 0.025, '2025-05-07 12:54:30', '2025-05-07 12:54:30'),
(582, 1, 2, 48, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 12:54:30', '2025-05-07 12:54:30'),
(583, 1, 2, 48, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 12:54:30', '2025-05-07 12:54:30'),
(584, 1, 2, 48, 304, 336, 'OIL SEKUSHI NO7', 'KG', 0.025, '2025-05-07 12:54:30', '2025-05-07 12:54:30'),
(585, 1, 2, 48, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 12:54:30', '2025-05-07 12:54:30'),
(621, 1, 2, 584, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 12:59:44', '2025-05-07 12:59:44'),
(622, 1, 2, 584, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 12:59:44', '2025-05-07 12:59:44'),
(623, 1, 2, 584, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 12:59:44', '2025-05-07 12:59:44'),
(624, 1, 2, 584, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 12:59:44', '2025-05-07 12:59:44'),
(625, 1, 2, 584, 346, 378, 'OIL WHY(y)', 'KG', 0.025, '2025-05-07 12:59:44', '2025-05-07 12:59:44'),
(626, 1, 2, 584, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 12:59:44', '2025-05-07 12:59:44'),
(627, 1, 2, 584, 436, 468, 'alcohol reval perfume', 'KG', 0.025, '2025-05-07 12:59:44', '2025-05-07 12:59:44'),
(649, 1, 2, 37, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:13:10', '2025-05-07 13:13:10'),
(650, 1, 2, 37, 208, 240, 'OIL LIBRE LAURENT', 'KG', 0.025, '2025-05-07 13:13:10', '2025-05-07 13:13:10'),
(651, 1, 2, 37, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:13:10', '2025-05-07 13:13:10'),
(652, 1, 2, 37, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:13:10', '2025-05-07 13:13:10'),
(653, 1, 2, 37, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:13:10', '2025-05-07 13:13:10'),
(654, 1, 2, 37, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:13:10', '2025-05-07 13:13:10'),
(655, 1, 2, 37, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:13:10', '2025-05-07 13:13:10'),
(656, 1, 2, 43, 7, 7, 'bumb -', 'pcs', 1, '2025-05-07 13:18:17', '2025-05-07 13:18:17'),
(657, 1, 2, 43, 424, 456, 'CAP REVAL -', 'pcs', 1, '2025-05-07 13:18:17', '2025-05-07 13:18:17'),
(658, 1, 2, 43, 420, 452, 'BOTTLE REVAL 50ML -', 'pcs', 1, '2025-05-07 13:18:17', '2025-05-07 13:18:17'),
(659, 1, 2, 43, 423, 455, 'STEACKER -', 'pcs', 1, '2025-05-07 13:18:17', '2025-05-07 13:18:17'),
(660, 1, 2, 43, 436, 468, 'alcohol reval perfume -', 'pcs', 0.03, '2025-05-07 13:18:17', '2025-05-07 13:18:17'),
(661, 1, 2, 67, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:18:37', '2025-05-07 13:18:37'),
(662, 1, 2, 67, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:18:37', '2025-05-07 13:18:37'),
(663, 1, 2, 67, 470, 502, 'CAP REVAL BLACK', 'pcs', 1, '2025-05-07 13:18:37', '2025-05-07 13:18:37'),
(664, 1, 2, 67, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:18:37', '2025-05-07 13:18:37'),
(665, 1, 2, 67, 351, 383, 'OIL1990', 'KG', 0.025, '2025-05-07 13:18:37', '2025-05-07 13:18:37'),
(666, 1, 2, 67, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:18:37', '2025-05-07 13:18:37'),
(667, 1, 2, 67, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:18:37', '2025-05-07 13:18:37'),
(668, 1, 2, 51, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:21:57', '2025-05-07 13:21:57'),
(669, 1, 2, 51, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:21:58', '2025-05-07 13:21:58'),
(670, 1, 2, 51, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:21:58', '2025-05-07 13:21:58'),
(671, 1, 2, 51, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:21:58', '2025-05-07 13:21:58'),
(672, 1, 2, 51, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:21:58', '2025-05-07 13:21:58'),
(673, 1, 2, 51, 92, 124, 'OIL 2020', 'KG', 0.025, '2025-05-07 13:21:58', '2025-05-07 13:21:58'),
(674, 1, 2, 51, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:21:58', '2025-05-07 13:21:58'),
(675, 1, 2, 18, 267, 299, 'OIL OUD MARACUJA', 'KG', 0.2, '2025-05-07 13:22:45', '2025-05-07 13:22:45'),
(676, 1, 2, 18, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:22:45', '2025-05-07 13:22:45'),
(677, 1, 2, 18, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:22:45', '2025-05-07 13:22:45'),
(678, 1, 2, 18, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:22:45', '2025-05-07 13:22:45'),
(679, 1, 2, 18, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:22:45', '2025-05-07 13:22:45'),
(680, 1, 2, 18, 553, 585, 'box', 'pcs', 1, '2025-05-07 13:22:45', '2025-05-07 13:22:45'),
(681, 1, 2, 18, 586, 618, 'ALCOHOL', 'KG', 0.03, '2025-05-07 13:22:45', '2025-05-07 13:22:45'),
(682, 1, 2, 45, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:23:03', '2025-05-07 13:23:03'),
(683, 1, 2, 45, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:23:03', '2025-05-07 13:23:03'),
(684, 1, 2, 45, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:23:03', '2025-05-07 13:23:03'),
(685, 1, 2, 45, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:23:03', '2025-05-07 13:23:03'),
(686, 1, 2, 45, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:23:03', '2025-05-07 13:23:03'),
(687, 1, 2, 45, 102, 134, 'OIL AL TARAHEEB', 'KG', 0.025, '2025-05-07 13:23:03', '2025-05-07 13:23:03'),
(688, 1, 2, 45, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:23:03', '2025-05-07 13:23:03'),
(689, 1, 2, 24, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:23:30', '2025-05-07 13:23:30'),
(690, 1, 2, 24, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:23:30', '2025-05-07 13:23:30'),
(691, 1, 2, 24, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:23:30', '2025-05-07 13:23:30'),
(692, 1, 2, 24, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:23:30', '2025-05-07 13:23:30'),
(693, 1, 2, 24, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:23:30', '2025-05-07 13:23:30'),
(694, 1, 2, 24, 103, 135, 'OIL AL THAIER', 'KG', 0.025, '2025-05-07 13:23:30', '2025-05-07 13:23:30'),
(695, 1, 2, 24, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:23:30', '2025-05-07 13:23:30'),
(696, 1, 2, 583, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:23:47', '2025-05-07 13:23:47'),
(697, 1, 2, 583, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:23:47', '2025-05-07 13:23:47'),
(698, 1, 2, 583, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:23:47', '2025-05-07 13:23:47'),
(699, 1, 2, 583, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:23:47', '2025-05-07 13:23:47'),
(700, 1, 2, 583, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:23:47', '2025-05-07 13:23:47'),
(701, 1, 2, 583, 252, 284, 'OIL OMBRE LEATHER', 'KG', 0.025, '2025-05-07 13:23:47', '2025-05-07 13:23:47'),
(702, 1, 2, 583, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:23:47', '2025-05-07 13:23:47'),
(703, 1, 2, 56, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:24:12', '2025-05-07 13:24:12'),
(704, 1, 2, 56, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:24:12', '2025-05-07 13:24:12'),
(705, 1, 2, 56, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:24:12', '2025-05-07 13:24:12'),
(706, 1, 2, 56, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:24:12', '2025-05-07 13:24:12'),
(707, 1, 2, 56, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:24:12', '2025-05-07 13:24:12'),
(708, 1, 2, 56, 161, 193, 'OIL ERBA PURA', 'KG', 0.025, '2025-05-07 13:24:12', '2025-05-07 13:24:12'),
(709, 1, 2, 56, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:24:12', '2025-05-07 13:24:12'),
(710, 1, 2, 19, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:25:58', '2025-05-07 13:25:58'),
(711, 1, 2, 19, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:25:58', '2025-05-07 13:25:58'),
(712, 1, 2, 19, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:25:58', '2025-05-07 13:25:58'),
(713, 1, 2, 19, 142, 174, 'OIL CREED AVENTUS', 'KG', 0.025, '2025-05-07 13:25:58', '2025-05-07 13:25:58'),
(714, 1, 2, 19, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:25:58', '2025-05-07 13:25:58'),
(715, 1, 2, 19, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:25:58', '2025-05-07 13:25:58'),
(716, 1, 2, 19, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:25:58', '2025-05-07 13:25:58'),
(717, 1, 2, 46, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:26:15', '2025-05-07 13:26:15'),
(718, 1, 2, 46, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:26:15', '2025-05-07 13:26:15'),
(719, 1, 2, 46, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:26:15', '2025-05-07 13:26:15'),
(720, 1, 2, 46, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:26:15', '2025-05-07 13:26:15'),
(721, 1, 2, 46, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:26:15', '2025-05-07 13:26:15'),
(722, 1, 2, 46, 95, 127, 'OIL ABSOLUTE AVENTUS', 'KG', 0.025, '2025-05-07 13:26:15', '2025-05-07 13:26:15'),
(723, 1, 2, 46, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:26:15', '2025-05-07 13:26:15'),
(724, 1, 2, 47, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:27:01', '2025-05-07 13:27:01'),
(725, 1, 2, 47, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:27:01', '2025-05-07 13:27:01'),
(726, 1, 2, 47, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:27:01', '2025-05-07 13:27:01'),
(727, 1, 2, 47, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:27:01', '2025-05-07 13:27:01'),
(728, 1, 2, 47, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:27:01', '2025-05-07 13:27:01'),
(729, 1, 2, 47, 113, 145, 'OIL BABY CAT', 'KG', 0.025, '2025-05-07 13:27:01', '2025-05-07 13:27:01'),
(730, 1, 2, 47, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:27:01', '2025-05-07 13:27:01'),
(731, 1, 2, 44, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:28:22', '2025-05-07 13:28:22'),
(732, 1, 2, 44, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:28:22', '2025-05-07 13:28:22'),
(733, 1, 2, 44, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:28:22', '2025-05-07 13:28:22'),
(734, 1, 2, 44, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:28:22', '2025-05-07 13:28:22'),
(735, 1, 2, 44, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:28:22', '2025-05-07 13:28:22'),
(736, 1, 2, 44, 114, 146, 'OIL BABY PAWDER', 'KG', 0.02, '2025-05-07 13:28:22', '2025-05-07 13:28:22'),
(737, 1, 2, 44, 586, 618, 'ALCOHOL', 'KG', 0.03, '2025-05-07 13:28:22', '2025-05-07 13:28:22'),
(738, 1, 2, 52, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:28:43', '2025-05-07 13:28:43'),
(739, 1, 2, 52, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:28:43', '2025-05-07 13:28:43'),
(740, 1, 2, 52, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:28:43', '2025-05-07 13:28:43'),
(741, 1, 2, 52, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:28:43', '2025-05-07 13:28:43'),
(742, 1, 2, 52, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:28:43', '2025-05-07 13:28:43'),
(743, 1, 2, 52, 115, 147, 'OIL BACCARAT ROUGE', 'KG', 0.025, '2025-05-07 13:28:43', '2025-05-07 13:28:43'),
(744, 1, 2, 52, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:28:43', '2025-05-07 13:28:43'),
(745, 1, 2, 32, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:29:39', '2025-05-07 13:29:39'),
(746, 1, 2, 32, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:29:39', '2025-05-07 13:29:39'),
(747, 1, 2, 32, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:29:39', '2025-05-07 13:29:39'),
(748, 1, 2, 32, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:29:39', '2025-05-07 13:29:39'),
(749, 1, 2, 32, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:29:39', '2025-05-07 13:29:39'),
(750, 1, 2, 32, 138, 170, 'OIL COCO', 'KG', 0.025, '2025-05-07 13:29:39', '2025-05-07 13:29:39'),
(751, 1, 2, 32, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:29:39', '2025-05-07 13:29:39'),
(752, 1, 2, 63, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:29:59', '2025-05-07 13:29:59'),
(753, 1, 2, 63, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:29:59', '2025-05-07 13:29:59'),
(754, 1, 2, 63, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:29:59', '2025-05-07 13:29:59'),
(755, 1, 2, 63, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:29:59', '2025-05-07 13:29:59'),
(756, 1, 2, 63, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:29:59', '2025-05-07 13:29:59'),
(757, 1, 2, 63, 329, 361, 'OIL THE COLLECTOR', 'KG', 0.025, '2025-05-07 13:29:59', '2025-05-07 13:29:59'),
(758, 1, 2, 63, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:29:59', '2025-05-07 13:29:59'),
(759, 1, 2, 27, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:30:24', '2025-05-07 13:30:24'),
(760, 1, 2, 27, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:30:24', '2025-05-07 13:30:24'),
(761, 1, 2, 27, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:30:24', '2025-05-07 13:30:24'),
(762, 1, 2, 27, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:30:24', '2025-05-07 13:30:24'),
(763, 1, 2, 27, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:30:24', '2025-05-07 13:30:24'),
(764, 1, 2, 27, 150, 182, 'OIL DELINA EXCLUSIVE', 'KG', 0.025, '2025-05-07 13:30:24', '2025-05-07 13:30:24'),
(765, 1, 2, 27, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:30:24', '2025-05-07 13:30:24'),
(766, 1, 2, 10, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:30:56', '2025-05-07 13:30:56'),
(767, 1, 2, 10, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:30:56', '2025-05-07 13:30:56'),
(768, 1, 2, 10, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:30:56', '2025-05-07 13:30:56'),
(769, 1, 2, 10, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:30:56', '2025-05-07 13:30:56'),
(770, 1, 2, 10, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:30:56', '2025-05-07 13:30:56'),
(771, 1, 2, 10, 148, 180, 'OIL DEEP MASAEY', 'KG', 0.02, '2025-05-07 13:30:56', '2025-05-07 13:30:56'),
(772, 1, 2, 10, 586, 618, 'ALCOHOL', 'KG', 0.03, '2025-05-07 13:30:56', '2025-05-07 13:30:56'),
(773, 1, 2, 34, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:31:17', '2025-05-07 13:31:17'),
(774, 1, 2, 34, 470, 502, 'CAP REVAL BLACK', 'pcs', 1, '2025-05-07 13:31:17', '2025-05-07 13:31:17'),
(775, 1, 2, 34, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:31:17', '2025-05-07 13:31:17'),
(776, 1, 2, 34, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:31:17', '2025-05-07 13:31:17'),
(777, 1, 2, 34, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:31:17', '2025-05-07 13:31:17'),
(778, 1, 2, 34, 129, 161, 'OIL BUKHOOR NO 9', 'KG', 0.025, '2025-05-07 13:31:17', '2025-05-07 13:31:17'),
(779, 1, 2, 34, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:31:17', '2025-05-07 13:31:17'),
(780, 1, 2, 49, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:31:42', '2025-05-07 13:31:42'),
(781, 1, 2, 49, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:31:42', '2025-05-07 13:31:42'),
(782, 1, 2, 49, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:31:42', '2025-05-07 13:31:42'),
(783, 1, 2, 49, 453, 485, 'CAP REVAL GOLD', 'pcs', 11, '2025-05-07 13:31:42', '2025-05-07 13:31:42'),
(784, 1, 2, 49, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:31:42', '2025-05-07 13:31:42'),
(785, 1, 2, 49, 168, 200, 'OIL FLORA', 'KG', 0.025, '2025-05-07 13:31:42', '2025-05-07 13:31:42'),
(786, 1, 2, 49, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:31:42', '2025-05-07 13:31:42'),
(787, 1, 2, 20, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:32:22', '2025-05-07 13:32:22'),
(788, 1, 2, 20, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:32:22', '2025-05-07 13:32:22'),
(789, 1, 2, 20, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:32:22', '2025-05-07 13:32:22'),
(790, 1, 2, 20, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:32:22', '2025-05-07 13:32:22'),
(791, 1, 2, 20, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:32:22', '2025-05-07 13:32:22'),
(792, 1, 2, 20, 171, 203, 'OIL GARCON MANQUE', 'KG', 0.025, '2025-05-07 13:32:22', '2025-05-07 13:32:22'),
(793, 1, 2, 20, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:32:22', '2025-05-07 13:32:22'),
(794, 1, 2, 55, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:33:23', '2025-05-07 13:33:23'),
(795, 1, 2, 55, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:33:23', '2025-05-07 13:33:23'),
(796, 1, 2, 55, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:33:23', '2025-05-07 13:33:23'),
(797, 1, 2, 55, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:33:23', '2025-05-07 13:33:23'),
(798, 1, 2, 55, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:33:23', '2025-05-07 13:33:23'),
(799, 1, 2, 55, 173, 205, 'OIL GOOD GIRL', 'KG', 0.025, '2025-05-07 13:33:23', '2025-05-07 13:33:23'),
(800, 1, 2, 55, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:33:23', '2025-05-07 13:33:23'),
(801, 1, 2, 41, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:33:43', '2025-05-07 13:33:43'),
(802, 1, 2, 41, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:33:43', '2025-05-07 13:33:43'),
(803, 1, 2, 41, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:33:43', '2025-05-07 13:33:43'),
(804, 1, 2, 41, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:33:43', '2025-05-07 13:33:43'),
(805, 1, 2, 41, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:33:43', '2025-05-07 13:33:43'),
(806, 1, 2, 41, 174, 206, 'OIL GRIS', 'KG', 0.02, '2025-05-07 13:33:43', '2025-05-07 13:33:43'),
(807, 1, 2, 41, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:33:43', '2025-05-07 13:33:43'),
(808, 1, 2, 28, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:34:13', '2025-05-07 13:34:13'),
(809, 1, 2, 28, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:34:13', '2025-05-07 13:34:13'),
(810, 1, 2, 28, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:34:13', '2025-05-07 13:34:13'),
(811, 1, 2, 28, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:34:13', '2025-05-07 13:34:13'),
(812, 1, 2, 28, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:34:13', '2025-05-07 13:34:13'),
(813, 1, 2, 28, 175, 207, 'OIL GUCCI ABSOLUTE', 'KG', 0.025, '2025-05-07 13:34:13', '2025-05-07 13:34:13'),
(814, 1, 2, 28, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:34:13', '2025-05-07 13:34:13'),
(815, 1, 2, 59, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:34:30', '2025-05-07 13:34:30'),
(816, 1, 2, 59, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:34:30', '2025-05-07 13:34:30'),
(817, 1, 2, 59, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:34:30', '2025-05-07 13:34:30'),
(818, 1, 2, 59, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:34:30', '2025-05-07 13:34:30'),
(819, 1, 2, 59, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:34:30', '2025-05-07 13:34:30'),
(820, 1, 2, 59, 152, 184, 'OIL DIOR HOME INTENSE', 'KG', 0.025, '2025-05-07 13:34:30', '2025-05-07 13:34:30'),
(821, 1, 2, 59, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:34:30', '2025-05-07 13:34:30'),
(822, 1, 2, 58, 183, 215, 'OIL HUDSON VALLEY', 'KG', 0.025, '2025-05-07 13:35:20', '2025-05-07 13:35:20'),
(823, 1, 2, 58, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:35:20', '2025-05-07 13:35:20'),
(824, 1, 2, 58, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:35:20', '2025-05-07 13:35:20'),
(825, 1, 2, 58, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:35:20', '2025-05-07 13:35:20'),
(826, 1, 2, 58, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:35:20', '2025-05-07 13:35:20'),
(827, 1, 2, 58, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:35:20', '2025-05-07 13:35:20'),
(828, 1, 2, 58, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:35:20', '2025-05-07 13:35:20'),
(829, 1, 2, 30, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:35:45', '2025-05-07 13:35:45'),
(830, 1, 2, 30, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:35:45', '2025-05-07 13:35:45'),
(831, 1, 2, 30, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:35:45', '2025-05-07 13:35:45'),
(832, 1, 2, 30, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:35:45', '2025-05-07 13:35:45'),
(833, 1, 2, 30, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:35:45', '2025-05-07 13:35:45'),
(834, 1, 2, 30, 185, 217, 'OIL IDOLE', 'KG', 0.025, '2025-05-07 13:35:45', '2025-05-07 13:35:45'),
(835, 1, 2, 30, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:35:45', '2025-05-07 13:35:45'),
(836, 1, 2, 22, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:36:05', '2025-05-07 13:36:05'),
(837, 1, 2, 22, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:36:05', '2025-05-07 13:36:05'),
(838, 1, 2, 22, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:36:05', '2025-05-07 13:36:05'),
(839, 1, 2, 22, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:36:05', '2025-05-07 13:36:05'),
(840, 1, 2, 22, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:36:05', '2025-05-07 13:36:05'),
(841, 1, 2, 22, 187, 219, 'OIL IMPERAL VALLEY', 'KG', 0.025, '2025-05-07 13:36:05', '2025-05-07 13:36:05'),
(842, 1, 2, 22, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:36:05', '2025-05-07 13:36:05'),
(843, 1, 2, 16, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:36:24', '2025-05-07 13:36:24'),
(844, 1, 2, 16, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:36:24', '2025-05-07 13:36:24'),
(845, 1, 2, 16, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:36:24', '2025-05-07 13:36:24'),
(846, 1, 2, 16, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:36:24', '2025-05-07 13:36:24'),
(847, 1, 2, 16, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:36:24', '2025-05-07 13:36:24'),
(848, 1, 2, 16, 189, 221, 'OIL INSOLENCE', 'KG', 0.025, '2025-05-07 13:36:24', '2025-05-07 13:36:24'),
(849, 1, 2, 16, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:36:24', '2025-05-07 13:36:24'),
(850, 1, 2, 12, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:36:42', '2025-05-07 13:36:42'),
(851, 1, 2, 12, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:36:42', '2025-05-07 13:36:42'),
(852, 1, 2, 12, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:36:42', '2025-05-07 13:36:42'),
(853, 1, 2, 12, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:36:42', '2025-05-07 13:36:42'),
(854, 1, 2, 12, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:36:42', '2025-05-07 13:36:42'),
(855, 1, 2, 12, 194, 226, 'OIL IRISH LEATHER', 'KG', 0.025, '2025-05-07 13:36:42', '2025-05-07 13:36:42'),
(856, 1, 2, 12, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:36:42', '2025-05-07 13:36:42'),
(857, 1, 2, 42, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:37:02', '2025-05-07 13:37:02'),
(858, 1, 2, 42, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:37:02', '2025-05-07 13:37:02'),
(859, 1, 2, 42, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:37:02', '2025-05-07 13:37:02'),
(860, 1, 2, 42, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:37:02', '2025-05-07 13:37:02'),
(861, 1, 2, 42, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:37:02', '2025-05-07 13:37:02'),
(862, 1, 2, 42, 203, 235, 'OIL LA LUNA', 'KG', 0.02, '2025-05-07 13:37:02', '2025-05-07 13:37:02'),
(863, 1, 2, 42, 586, 618, 'ALCOHOL', 'KG', 0.03, '2025-05-07 13:37:02', '2025-05-07 13:37:02'),
(864, 1, 2, 33, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:37:18', '2025-05-07 13:37:18'),
(865, 1, 2, 33, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:37:18', '2025-05-07 13:37:18'),
(866, 1, 2, 33, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:37:18', '2025-05-07 13:37:18'),
(867, 1, 2, 33, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:37:18', '2025-05-07 13:37:18'),
(868, 1, 2, 33, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:37:18', '2025-05-07 13:37:18'),
(869, 1, 2, 33, 207, 239, 'OIL LE MALE ELIXIR', 'KG', 0.025, '2025-05-07 13:37:18', '2025-05-07 13:37:18'),
(870, 1, 2, 33, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:37:18', '2025-05-07 13:37:18'),
(871, 1, 2, 60, 204, 236, 'OIL LA VIE EST BELLE', 'KG', 0.025, '2025-05-07 13:37:34', '2025-05-07 13:37:34'),
(872, 1, 2, 60, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:37:34', '2025-05-07 13:37:34'),
(873, 1, 2, 60, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:37:34', '2025-05-07 13:37:34'),
(874, 1, 2, 60, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:37:34', '2025-05-07 13:37:34'),
(875, 1, 2, 60, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:37:34', '2025-05-07 13:37:34'),
(876, 1, 2, 60, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:37:34', '2025-05-07 13:37:34'),
(877, 1, 2, 60, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:37:34', '2025-05-07 13:37:34'),
(878, 1, 2, 9, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:37:47', '2025-05-07 13:37:47'),
(879, 1, 2, 9, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:37:47', '2025-05-07 13:37:47'),
(880, 1, 2, 9, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:37:47', '2025-05-07 13:37:47'),
(881, 1, 2, 9, 202, 234, 'OIL LA BELEL', 'KG', 0.025, '2025-05-07 13:37:47', '2025-05-07 13:37:47'),
(882, 1, 2, 9, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:37:47', '2025-05-07 13:37:47'),
(883, 1, 2, 9, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:37:47', '2025-05-07 13:37:47'),
(884, 1, 2, 9, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:37:47', '2025-05-07 13:37:47'),
(885, 1, 2, 40, 211, 243, 'OIL LINTERDIT', 'KG', 0.025, '2025-05-07 13:38:08', '2025-05-07 13:38:08'),
(886, 1, 2, 40, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:38:08', '2025-05-07 13:38:08'),
(887, 1, 2, 40, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:38:08', '2025-05-07 13:38:08'),
(888, 1, 2, 40, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:38:08', '2025-05-07 13:38:08'),
(889, 1, 2, 40, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:38:08', '2025-05-07 13:38:08'),
(890, 1, 2, 40, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:38:08', '2025-05-07 13:38:08'),
(891, 1, 2, 40, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:38:08', '2025-05-07 13:38:08'),
(892, 1, 2, 26, 214, 246, 'OIL MADAWI', 'KG', 0.025, '2025-05-07 13:38:23', '2025-05-07 13:38:23'),
(893, 1, 2, 26, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:38:23', '2025-05-07 13:38:23'),
(894, 1, 2, 26, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:38:23', '2025-05-07 13:38:23'),
(895, 1, 2, 26, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:38:23', '2025-05-07 13:38:23'),
(896, 1, 2, 26, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:38:23', '2025-05-07 13:38:23'),
(897, 1, 2, 26, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:38:23', '2025-05-07 13:38:23'),
(898, 1, 2, 26, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:38:23', '2025-05-07 13:38:23'),
(899, 1, 2, 581, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:38:39', '2025-05-07 13:38:39'),
(900, 1, 2, 581, 215, 247, 'OIL MAGIC', 'KG', 0.025, '2025-05-07 13:38:39', '2025-05-07 13:38:39'),
(901, 1, 2, 581, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:38:39', '2025-05-07 13:38:39'),
(902, 1, 2, 581, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:38:39', '2025-05-07 13:38:39'),
(903, 1, 2, 581, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:38:39', '2025-05-07 13:38:39'),
(904, 1, 2, 581, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:38:39', '2025-05-07 13:38:39'),
(905, 1, 2, 581, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:38:39', '2025-05-07 13:38:39'),
(906, 1, 2, 65, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:38:54', '2025-05-07 13:38:54'),
(907, 1, 2, 65, 584, 616, 'OIL MARVO', 'KG', 0.025, '2025-05-07 13:38:54', '2025-05-07 13:38:54'),
(908, 1, 2, 65, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:38:54', '2025-05-07 13:38:54'),
(909, 1, 2, 65, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:38:54', '2025-05-07 13:38:54'),
(910, 1, 2, 65, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:38:54', '2025-05-07 13:38:54'),
(911, 1, 2, 65, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:38:54', '2025-05-07 13:38:54'),
(912, 1, 2, 65, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:38:54', '2025-05-07 13:38:54'),
(913, 1, 2, 62, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:39:14', '2025-05-07 13:39:14'),
(914, 1, 2, 62, 219, 251, 'OIL MASTER', 'KG', 0.025, '2025-05-07 13:39:14', '2025-05-07 13:39:14'),
(915, 1, 2, 62, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:39:14', '2025-05-07 13:39:14'),
(916, 1, 2, 62, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:39:14', '2025-05-07 13:39:14'),
(917, 1, 2, 62, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:39:14', '2025-05-07 13:39:14'),
(918, 1, 2, 62, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:39:14', '2025-05-07 13:39:14'),
(919, 1, 2, 62, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:39:14', '2025-05-07 13:39:14'),
(920, 1, 2, 13, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:39:52', '2025-05-07 13:39:52'),
(921, 1, 2, 13, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:39:52', '2025-05-07 13:39:52'),
(922, 1, 2, 13, 230, 262, 'OIL MISS BLOMING', 'KG', 0.025, '2025-05-07 13:39:52', '2025-05-07 13:39:52'),
(923, 1, 2, 13, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:39:52', '2025-05-07 13:39:52'),
(924, 1, 2, 13, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:39:52', '2025-05-07 13:39:52'),
(925, 1, 2, 13, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:39:52', '2025-05-07 13:39:52'),
(926, 1, 2, 13, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:39:52', '2025-05-07 13:39:52'),
(927, 1, 2, 35, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:40:10', '2025-05-07 13:40:10'),
(928, 1, 2, 35, 222, 254, 'OIL MEYDAN', 'KG', 0.025, '2025-05-07 13:40:10', '2025-05-07 13:40:10'),
(929, 1, 2, 35, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:40:10', '2025-05-07 13:40:10'),
(930, 1, 2, 35, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:40:10', '2025-05-07 13:40:10'),
(931, 1, 2, 35, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:40:10', '2025-05-07 13:40:10'),
(932, 1, 2, 35, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:40:10', '2025-05-07 13:40:10'),
(933, 1, 2, 35, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:40:10', '2025-05-07 13:40:10'),
(934, 1, 2, 23, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:40:46', '2025-05-07 13:40:46'),
(935, 1, 2, 23, 90, 122, 'OIL 020', 'KG', 0.025, '2025-05-07 13:40:46', '2025-05-07 13:40:46'),
(936, 1, 2, 23, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:40:46', '2025-05-07 13:40:46'),
(937, 1, 2, 23, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:40:46', '2025-05-07 13:40:46'),
(938, 1, 2, 23, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:40:46', '2025-05-07 13:40:46'),
(939, 1, 2, 23, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:40:46', '2025-05-07 13:40:46'),
(940, 1, 2, 23, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:40:46', '2025-05-07 13:40:46'),
(941, 1, 2, 53, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:41:03', '2025-05-07 13:41:03'),
(942, 1, 2, 53, 120, 152, 'OIL BLACK OPIUM', 'KG', 0.025, '2025-05-07 13:41:03', '2025-05-07 13:41:03'),
(943, 1, 2, 53, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:41:03', '2025-05-07 13:41:03'),
(944, 1, 2, 53, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:41:03', '2025-05-07 13:41:03'),
(945, 1, 2, 53, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:41:03', '2025-05-07 13:41:03'),
(946, 1, 2, 53, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:41:03', '2025-05-07 13:41:03'),
(947, 1, 2, 53, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:41:03', '2025-05-07 13:41:03'),
(948, 1, 2, 36, 269, 301, 'OIL OUD SAFFRON', 'KG', 0.025, '2025-05-07 13:41:22', '2025-05-07 13:41:22'),
(949, 1, 2, 36, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:41:22', '2025-05-07 13:41:22'),
(950, 1, 2, 36, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:41:22', '2025-05-07 13:41:22'),
(951, 1, 2, 36, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:41:22', '2025-05-07 13:41:22'),
(952, 1, 2, 36, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:41:23', '2025-05-07 13:41:23'),
(953, 1, 2, 36, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:41:23', '2025-05-07 13:41:23'),
(954, 1, 2, 36, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:41:23', '2025-05-07 13:41:23'),
(955, 1, 2, 21, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:41:41', '2025-05-07 13:41:41'),
(956, 1, 2, 21, 273, 305, 'OIL PARADOX', 'KG', 0.025, '2025-05-07 13:41:41', '2025-05-07 13:41:41'),
(957, 1, 2, 21, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:41:41', '2025-05-07 13:41:41'),
(958, 1, 2, 21, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:41:41', '2025-05-07 13:41:41'),
(959, 1, 2, 21, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:41:41', '2025-05-07 13:41:41'),
(960, 1, 2, 21, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:41:41', '2025-05-07 13:41:41'),
(961, 1, 2, 21, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:41:41', '2025-05-07 13:41:41'),
(962, 1, 2, 15, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:42:20', '2025-05-07 13:42:20'),
(963, 1, 2, 15, 286, 318, 'OIL R.TOBACCO', 'KG', 0.025, '2025-05-07 13:42:20', '2025-05-07 13:42:20'),
(964, 1, 2, 15, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:42:20', '2025-05-07 13:42:20'),
(965, 1, 2, 15, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:42:20', '2025-05-07 13:42:20'),
(966, 1, 2, 15, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:42:20', '2025-05-07 13:42:20'),
(967, 1, 2, 15, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:42:20', '2025-05-07 13:42:20'),
(968, 1, 2, 15, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:42:20', '2025-05-07 13:42:20'),
(969, 1, 2, 57, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:42:33', '2025-05-07 13:42:33'),
(970, 1, 2, 57, 291, 323, 'OIL ROSE VANILLA', 'KG', 0.025, '2025-05-07 13:42:33', '2025-05-07 13:42:33'),
(971, 1, 2, 57, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:42:33', '2025-05-07 13:42:33'),
(972, 1, 2, 57, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:42:33', '2025-05-07 13:42:33'),
(973, 1, 2, 57, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:42:33', '2025-05-07 13:42:33'),
(974, 1, 2, 57, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:42:33', '2025-05-07 13:42:33'),
(975, 1, 2, 57, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:42:33', '2025-05-07 13:42:33'),
(976, 1, 2, 8, 300, 332, 'OIL SAUVVAGE', 'KG', 0.025, '2025-05-07 13:42:57', '2025-05-07 13:42:57'),
(977, 1, 2, 8, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:42:57', '2025-05-07 13:42:57'),
(978, 1, 2, 8, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:42:57', '2025-05-07 13:42:57'),
(979, 1, 2, 8, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:42:57', '2025-05-07 13:42:57'),
(980, 1, 2, 8, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:42:57', '2025-05-07 13:42:57'),
(981, 1, 2, 8, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:42:57', '2025-05-07 13:42:57'),
(982, 1, 2, 8, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:42:57', '2025-05-07 13:42:57'),
(983, 1, 2, 61, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:43:22', '2025-05-07 13:43:22'),
(984, 1, 2, 61, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:43:22', '2025-05-07 13:43:22'),
(985, 1, 2, 61, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:43:22', '2025-05-07 13:43:22'),
(986, 1, 2, 61, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:43:22', '2025-05-07 13:43:22'),
(987, 1, 2, 61, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:43:22', '2025-05-07 13:43:22'),
(988, 1, 2, 61, 302, 334, 'OIL SCANDAL MAN', 'KG', 0.025, '2025-05-07 13:43:22', '2025-05-07 13:43:22'),
(989, 1, 2, 61, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:43:22', '2025-05-07 13:43:22'),
(990, 1, 2, 11, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:43:49', '2025-05-07 13:43:49'),
(991, 1, 2, 11, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:43:49', '2025-05-07 13:43:49'),
(992, 1, 2, 11, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:43:49', '2025-05-07 13:43:49'),
(993, 1, 2, 11, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:43:49', '2025-05-07 13:43:49'),
(994, 1, 2, 11, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:43:49', '2025-05-07 13:43:49'),
(995, 1, 2, 11, 309, 341, 'OIL SHUMUKH', 'KG', 0.025, '2025-05-07 13:43:49', '2025-05-07 13:43:49'),
(996, 1, 2, 11, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:43:49', '2025-05-07 13:43:49'),
(997, 1, 2, 66, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:44:09', '2025-05-07 13:44:09'),
(998, 1, 2, 66, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:44:09', '2025-05-07 13:44:09'),
(999, 1, 2, 66, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:44:09', '2025-05-07 13:44:09'),
(1000, 1, 2, 66, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:44:09', '2025-05-07 13:44:09'),
(1001, 1, 2, 66, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:44:09', '2025-05-07 13:44:09'),
(1002, 1, 2, 66, 325, 357, 'OIL TAHNON EXCEP', 'KG', 0.025, '2025-05-07 13:44:09', '2025-05-07 13:44:09'),
(1003, 1, 2, 66, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:44:09', '2025-05-07 13:44:09'),
(1004, 1, 2, 50, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:44:26', '2025-05-07 13:44:26'),
(1005, 1, 2, 50, 336, 368, 'OIL TUXEDO', 'KG', 0.025, '2025-05-07 13:44:26', '2025-05-07 13:44:26'),
(1006, 1, 2, 50, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:44:26', '2025-05-07 13:44:26'),
(1007, 1, 2, 50, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:44:26', '2025-05-07 13:44:26'),
(1008, 1, 2, 50, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:44:26', '2025-05-07 13:44:26'),
(1009, 1, 2, 50, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:44:26', '2025-05-07 13:44:26'),
(1010, 1, 2, 50, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:44:26', '2025-05-07 13:44:26'),
(1011, 1, 2, 14, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:44:42', '2025-05-07 13:44:42'),
(1012, 1, 2, 14, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:44:42', '2025-05-07 13:44:42'),
(1013, 1, 2, 14, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:44:42', '2025-05-07 13:44:42'),
(1014, 1, 2, 14, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:44:42', '2025-05-07 13:44:42'),
(1015, 1, 2, 14, 338, 370, 'OIL ULTRA MALE', 'KG', 0.25, '2025-05-07 13:44:42', '2025-05-07 13:44:42'),
(1016, 1, 2, 14, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:44:42', '2025-05-07 13:44:42'),
(1017, 1, 2, 14, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:44:42', '2025-05-07 13:44:42'),
(1018, 1, 2, 582, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:44:58', '2025-05-07 13:44:58'),
(1019, 1, 2, 582, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:44:58', '2025-05-07 13:44:58'),
(1020, 1, 2, 582, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:44:58', '2025-05-07 13:44:58'),
(1021, 1, 2, 582, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:44:58', '2025-05-07 13:44:58'),
(1022, 1, 2, 582, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:44:58', '2025-05-07 13:44:58'),
(1023, 1, 2, 582, 341, 373, 'OIL VERT MALACHITE', 'KG', 0.025, '2025-05-07 13:44:58', '2025-05-07 13:44:58'),
(1024, 1, 2, 582, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:44:58', '2025-05-07 13:44:58'),
(1032, 1, 2, 39, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:45:32', '2025-05-07 13:45:32'),
(1033, 1, 2, 39, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:45:32', '2025-05-07 13:45:32'),
(1034, 1, 2, 39, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:45:32', '2025-05-07 13:45:32'),
(1035, 1, 2, 39, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:45:32', '2025-05-07 13:45:32'),
(1036, 1, 2, 39, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:45:32', '2025-05-07 13:45:32'),
(1037, 1, 2, 39, 318, 350, 'OIL STRONGER WITH YOU', 'KG', 0.025, '2025-05-07 13:45:32', '2025-05-07 13:45:32'),
(1038, 1, 2, 39, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:45:32', '2025-05-07 13:45:32'),
(1039, 1, 2, 38, 7, 7, 'bumb', 'pcs', 1, '2025-05-07 13:45:49', '2025-05-07 13:45:49'),
(1040, 1, 2, 38, 319, 351, 'OIL STRONGER WITH YOU LEATHER', 'KG', 0.025, '2025-05-07 13:45:49', '2025-05-07 13:45:49'),
(1041, 1, 2, 38, 423, 455, 'STEACKER', 'pcs', 1, '2025-05-07 13:45:49', '2025-05-07 13:45:49'),
(1042, 1, 2, 38, 420, 452, 'BOTTLE REVAL 50ML', 'pcs', 1, '2025-05-07 13:45:49', '2025-05-07 13:45:49'),
(1043, 1, 2, 38, 453, 485, 'CAP REVAL GOLD', 'pcs', 1, '2025-05-07 13:45:49', '2025-05-07 13:45:49'),
(1044, 1, 2, 38, 553, 585, 'box reval maroun', 'pcs', 1, '2025-05-07 13:45:49', '2025-05-07 13:45:49'),
(1045, 1, 2, 38, 586, 618, 'ALCOHOL', 'KG', 0.025, '2025-05-07 13:45:49', '2025-05-07 13:45:49');

-- --------------------------------------------------------

--
-- Table structure for table `item_prices`
--

CREATE TABLE `item_prices` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `price_size_id` bigint UNSIGNED NOT NULL,
  `barcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost_price` double DEFAULT '0',
  `price` double NOT NULL,
  `stock` double DEFAULT NULL,
  `total_cost_price` double NOT NULL DEFAULT '0',
  `ingredient_added` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '1 = Ingredient added, 2 = not added',
  `price_item_type` enum('1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `edit_cost_price` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 = edit, 1 = non-edit',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_prices`
--

INSERT INTO `item_prices` (`id`, `branch_id`, `item_id`, `price_size_id`, `barcode`, `cost_price`, `price`, `stock`, `total_cost_price`, `ingredient_added`, `price_item_type`, `edit_cost_price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, '442937', 0, 50, 0, 0, '1', '1', '0', '2025-04-15 18:03:14', '2025-04-22 14:15:50', '2025-04-22 14:15:50'),
(2, 1, 2, 1, '768800', 1, 2, 73, 0, '0', '2', '0', '2025-04-15 18:18:21', '2025-04-22 14:15:18', '2025-04-22 14:15:18'),
(3, 1, 3, 1, '753683', 0, 100, 0, 0, '0', '2', '0', '2025-04-15 18:18:28', '2025-04-15 18:18:33', '2025-04-15 18:18:33'),
(4, 1, 4, 1, '722947', 1, 2, 0.7, 0, '0', '2', '0', '2025-04-15 18:19:25', '2025-04-22 14:16:02', '2025-04-22 14:16:02'),
(5, 1, 5, 1, '629492', 1, 3, 3.55, 0, '0', '2', '0', '2025-04-15 18:20:00', '2025-04-22 14:15:34', '2025-04-22 14:15:34'),
(6, 1, 6, 1, '611099', 1, 2, 79, 0, '0', '2', '0', '2025-04-15 18:20:26', '2025-04-22 14:15:26', '2025-04-22 14:15:26'),
(7, 1, 7, 1, '907828', 0.998, 1.5, 875, 870.256, '0', '2', '1', '2025-04-15 18:59:11', '2025-05-15 17:13:15', NULL),
(8, 1, 8, 1, '222224', 0, 50, -2, 0, '1', '1', '0', '2025-04-15 19:15:40', '2025-05-12 17:26:15', NULL),
(9, 1, 9, 1, '534609', 0, 50, -1, 0, '1', '1', '1', '2025-04-18 15:40:25', '2025-05-12 17:26:15', NULL),
(10, 1, 10, 1, '679734', 50, 50, 0, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:30:56', NULL),
(11, 1, 11, 1, '873626', 13.838948587175, 50, 7, 96.872640110226, '1', '1', '1', '2025-04-18 15:40:25', '2025-05-09 19:19:34', NULL),
(12, 1, 12, 1, '780440', 50, 50, -3, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:36:42', NULL),
(13, 1, 13, 1, '766645', 50, 50, -4, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-16 23:05:17', NULL),
(14, 1, 14, 1, '414740', 173.70493573397, 50, 4, 694.81974293588, '1', '1', '1', '2025-04-18 15:40:25', '2025-05-09 19:19:34', NULL),
(15, 1, 15, 1, '906207', 50, 50, -1, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:42:20', NULL),
(16, 1, 16, 1, '952503', 50, 50, -3, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-16 18:59:47', NULL),
(17, 1, 17, 1, '617426', 50, 50, 0, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-05 17:18:55', NULL),
(18, 1, 18, 1, '405928', 0, 50, -2, 0, '1', '1', '1', '2025-04-18 15:40:25', '2025-05-17 09:50:43', NULL),
(19, 1, 19, 1, '908731', 50, 50, -2, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-10 21:31:24', NULL),
(20, 1, 20, 1, '824819', 50, 50, -4, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-11 21:39:57', NULL),
(21, 1, 21, 1, '224518', 50, 50, -1, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:41:41', NULL),
(22, 1, 22, 1, '600643', 50, 50, 0, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:36:05', NULL),
(23, 1, 23, 1, '788398', 50, 50, -4, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-17 10:32:51', NULL),
(24, 1, 24, 1, '356431', 0, 50, 0, 0, '1', '1', '1', '2025-04-18 15:40:25', '2025-05-07 13:23:30', NULL),
(25, 1, 25, 1, '676863', 50, 50, 0, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-04-21 20:04:25', NULL),
(26, 1, 26, 1, '650725', 50, 50, 0, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:38:23', NULL),
(27, 1, 27, 1, '686713', 50, 50, 0, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:30:24', NULL),
(28, 1, 28, 1, '196689', 50, 50, -2, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:34:13', NULL),
(29, 1, 29, 1, '797887', 50, 50, 0, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-04-21 20:04:25', NULL),
(30, 1, 30, 1, '547352', 50, 50, 0, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:35:45', NULL),
(31, 1, 31, 1, '198406', 50, 50, 0, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-04-21 20:04:25', NULL),
(32, 1, 32, 1, '788032', 50, 50, -1, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:29:39', NULL),
(33, 1, 33, 1, '232126', 50, 50, 0, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:37:18', NULL),
(34, 1, 34, 1, '629520', 0, 50, 0, 0, '1', '1', '1', '2025-04-18 15:40:25', '2025-05-07 13:31:17', NULL),
(35, 1, 35, 1, '173083', 50, 50, 0, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:40:10', NULL),
(36, 1, 36, 1, '262803', 50, 50, 0, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:41:23', NULL),
(37, 1, 37, 1, '803062', 0, 50, 0, 0, '1', '1', '1', '2025-04-18 15:40:25', '2025-05-07 13:13:18', NULL),
(38, 1, 38, 1, '532441', 50, 50, -2, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:45:49', NULL),
(39, 1, 39, 1, '519232', 25.860560733969, 50, 2, 51.721121467938, '1', '1', '1', '2025-04-18 15:40:25', '2025-05-17 10:32:51', NULL),
(40, 1, 40, 1, '640139', 50, 50, -1, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:38:08', NULL),
(41, 1, 41, 1, '106852', 50, 50, -1, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-16 21:18:45', NULL),
(42, 1, 42, 1, '557395', 50, 50, -3, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:37:02', NULL),
(43, 1, 43, 1, '162910', 0, 50, 0, 0, '1', '1', '1', '2025-04-18 15:40:25', '2025-05-07 13:18:17', NULL),
(44, 1, 44, 1, '507957', 50, 50, -1, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:28:22', NULL),
(45, 1, 45, 1, '183683', 0, 50, -1, 0, '1', '1', '1', '2025-04-18 15:40:25', '2025-05-07 13:23:03', NULL),
(46, 1, 46, 1, '323150', 50, 50, -2, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-10 21:31:24', NULL),
(47, 1, 47, 1, '772645', 50, 50, -1, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:27:01', NULL),
(48, 1, 48, 1, '913694', 19.553698587175, 50, 5, 97.768492935875, '1', '1', '1', '2025-04-18 15:40:25', '2025-05-09 19:19:34', NULL),
(49, 1, 49, 1, '473490', 50, 50, 0, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:31:42', NULL),
(50, 1, 50, 1, '952737', 49.859871467938, 50, 1, 49.859871467938, '1', '1', '1', '2025-04-18 15:40:25', '2025-05-12 19:30:10', NULL),
(51, 1, 51, 1, '786079', 0, 50, -1, 0, '1', '1', '1', '2025-04-18 15:40:25', '2025-05-07 13:21:58', NULL),
(52, 1, 52, 1, '675262', 50, 50, 0, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:28:43', NULL),
(53, 1, 53, 1, '394846', 50, 50, 0, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:41:03', NULL),
(54, 1, 54, 1, '180594', 50, 50, 0, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-04-21 20:04:25', NULL),
(55, 1, 55, 1, '153864', 50, 50, 0, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:33:23', NULL),
(56, 1, 56, 1, '550364', 50, 50, -1, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-12 14:08:09', NULL),
(57, 1, 57, 1, '788213', 50, 50, 0, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:42:33', NULL),
(58, 1, 58, 1, '839666', 50, 50, -1, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:35:20', NULL),
(59, 1, 59, 1, '249140', 50, 50, -3, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:34:30', NULL),
(60, 1, 60, 1, '289100', 50, 50, 0, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:37:34', NULL),
(61, 1, 61, 1, '974366', 50, 50, -1, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:43:22', NULL),
(62, 1, 62, 1, '659111', 50, 50, 0, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:39:14', NULL),
(63, 1, 63, 1, '145118', 50, 50, -4, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-17 10:32:51', NULL),
(64, 1, 64, 1, '144933', 50, 50, -6, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-05-04 23:10:13', NULL),
(65, 1, 65, 1, '140180', 50, 50, 0, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-07 13:38:54', NULL),
(66, 1, 66, 1, '555522', 28.954935733969, 50, 4, 115.81974293588, '1', '1', '1', '2025-04-18 15:40:25', '2025-05-09 19:19:34', NULL),
(67, 1, 67, 1, '596464', 0, 50, -2, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-09 18:09:29', NULL),
(68, 1, 68, 1, '851891', 50, 50, -5, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-05-07 20:26:01', NULL),
(69, 1, 69, 1, '149201', 50, 50, -7, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-05-16 23:05:17', NULL),
(70, 1, 70, 1, '159229', 50, 50, -5, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-05-16 23:05:17', NULL),
(71, 1, 71, 1, '853032', 50, 50, -3, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-05-07 20:26:01', NULL),
(72, 1, 72, 1, '534926', 50, 50, -8, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-16 18:23:05', NULL),
(73, 1, 73, 1, '320400', 50, 50, -8, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-05-14 20:49:44', NULL),
(74, 1, 74, 1, '630537', 50, 50, -1, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-05-01 18:36:39', NULL),
(75, 1, 75, 1, '133111', 50, 50, -8, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-05-17 11:14:37', NULL),
(76, 1, 76, 1, '363512', 50, 50, -6, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-05-16 20:09:19', NULL),
(77, 1, 77, 1, '191172', 50, 50, -8, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-05-15 22:07:13', NULL),
(78, 1, 78, 1, '817195', 50, 50, -2, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-04-30 15:43:32', NULL),
(79, 1, 79, 1, '292241', 50, 50, -7, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-05-15 22:07:13', NULL),
(80, 1, 80, 1, '584021', 50, 50, -15, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-05-14 20:49:44', NULL),
(81, 1, 81, 1, '914029', 50, 50, -9, 0, '1', '1', '0', '2025-04-18 15:40:25', '2025-05-12 17:26:15', NULL),
(82, 1, 82, 1, '439437', 50, 50, 0, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-04-22 14:18:04', '2025-04-22 14:18:04'),
(83, 1, 83, 1, '134931', 50, 50, 0, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-04-22 14:18:04', '2025-04-22 14:18:04'),
(84, 1, 84, 1, '917385', 50, 50, 0, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-04-22 14:18:04', '2025-04-22 14:18:04'),
(85, 1, 85, 1, '617448', 80, 80, 0, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-04-22 14:18:04', '2025-04-22 14:18:04'),
(86, 1, 86, 1, '753432', 50, 50, 0, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-04-22 14:18:04', '2025-04-22 14:18:04'),
(87, 1, 87, 1, '617207', 50, 50, 0, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-04-22 14:18:04', '2025-04-22 14:18:04'),
(88, 1, 88, 1, '522765', 50, 50, 0, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-04-22 14:18:04', '2025-04-22 14:18:04'),
(89, 1, 89, 1, '503887', 50, 50, 0, 0, '0', '1', '0', '2025-04-18 15:40:25', '2025-04-22 14:18:04', '2025-04-22 14:18:04'),
(122, 1, 90, 1, '714657', 1330, 1550, -30, 0, '0', '2', '1', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(123, 1, 91, 1, '191067', 0, 850, -0.025, 0, '0', '2', '1', '2025-04-21 10:44:13', '2025-05-04 14:43:11', NULL),
(124, 1, 92, 1, '592135', 560.77, 900, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(125, 1, 93, 1, '502858', 1230, 1500, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(126, 1, 94, 1, '934478', 368.29, 750, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(127, 1, 95, 1, '878808', 472.99, 800, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(128, 1, 96, 1, '845889', 880, 1300, 1, 880, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(129, 1, 97, 1, '725144', 530, 850, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(130, 1, 98, 1, '713185', 284.25, 650, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(131, 1, 99, 1, '789192', 800, 1000, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(132, 1, 100, 1, '723347', 580, 900, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(133, 1, 101, 1, '968120', 80, 800, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(134, 1, 102, 1, '456344', 14.419836302359, 680, 51.925, 748.75, '0', '2', '1', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(135, 1, 103, 1, '315693', 465.65, 780, 1, 465.65, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(136, 1, 104, 1, '702233', 580, 850, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(137, 1, 105, 1, '545003', 580, 850, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(138, 1, 106, 1, '395936', 685.55, 1000, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(139, 1, 107, 1, '531475', 730, 1050, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(140, 1, 108, 1, '155412', 762.62, 1050, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(141, 1, 109, 1, '997466', 600, 900, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(142, 1, 110, 1, '310060', 680, 1200, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(143, 1, 111, 1, '412905', 780, 1100, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(144, 1, 112, 1, '345126', 1030, 1350, 1, 1030, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(145, 1, 113, 1, '953766', 414.27, 760, 1, 414.27, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(146, 1, 114, 1, '266226', 220, 450, 1, 220, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(147, 1, 115, 1, '951480', 556.19, 850, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(148, 1, 116, 1, '912265', 680, 980, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(149, 1, 117, 1, '223352', 420, 650, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(150, 1, 118, 1, '890723', 428.65, 750, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(151, 1, 119, 1, '972837', 880, 1150, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(152, 1, 120, 1, '270788', 580, 850, 1, 580, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(153, 1, 121, 1, '410857', 575.45, 850, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(154, 1, 122, 1, '285955', 530, 0, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(155, 1, 123, 1, '984415', 499.05, 800, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(156, 1, 124, 1, '979452', 780.97, 1100, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(157, 1, 125, 1, '784769', 640, 890, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(158, 1, 126, 1, '389358', 835, 1100, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(159, 1, 127, 1, '533000', 2580, 0, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(160, 1, 128, 1, '539544', 580, 900, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(161, 1, 129, 1, '212050', 839.69, 1200, 0.975, 818.69775, '0', '2', '1', '2025-04-21 10:44:13', '2025-05-07 13:10:20', NULL),
(162, 1, 130, 1, '231448', 780, 1050, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(163, 1, 131, 1, '694531', 480, 800, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(164, 1, 132, 1, '495214', 338.86, 800, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(165, 1, 133, 1, '256098', 530, 830, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(166, 1, 134, 1, '509982', 313.2, 650, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(167, 1, 135, 1, '909664', 930, 1250, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(168, 1, 136, 1, '757568', 530, 850, 1, 530, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(169, 1, 137, 1, '409050', 540, 850, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(170, 1, 138, 1, '823700', 630, 900, 1, 630, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(171, 1, 139, 1, '836660', 494.71, 800, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(172, 1, 140, 1, '233817', 520, 750, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(173, 1, 141, 1, '249817', 924.1, 1200, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(174, 1, 142, 1, '412754', 608.48, 880, 1, 608.48, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(175, 1, 143, 1, '534802', 296.83, 650, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(176, 1, 144, 1, '191284', 526.49, 800, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(177, 1, 145, 1, '321077', 472.96, 900, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(178, 1, 146, 1, '165755', 830, 1200, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(179, 1, 147, 1, '489428', 730, 980, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(180, 1, 148, 1, '688383', 599.78, 900, 1, 599.78, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(181, 1, 149, 1, '350048', 580, 850, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(182, 1, 150, 1, '644569', 830, 1150, 1, 830, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(183, 1, 151, 1, '717393', 800, 1050, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(184, 1, 152, 1, '941388', 560, 850, 1, 560, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(185, 1, 153, 1, '152852', 520, 850, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(186, 1, 154, 1, '286115', 505.72, 850, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(187, 1, 155, 1, '196568', 730, 950, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(188, 1, 156, 1, '268497', 505.72, 850, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(189, 1, 157, 1, '760450', 1280, 1600, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(190, 1, 158, 1, '175728', 280, 550, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(191, 1, 159, 1, '433052', 651.43, 900, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(192, 1, 160, 1, '804068', 80, 0, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(193, 1, 161, 1, '180134', 1000, 1280, 1, 1000, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(194, 1, 162, 1, '405501', 500, 800, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(195, 1, 163, 1, '799159', 430, 680, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(196, 1, 164, 1, '147857', 730, 1200, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(197, 1, 165, 1, '221875', 560, 850, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(198, 1, 166, 1, '400709', 730, 1000, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(199, 1, 167, 1, '413672', 1480, 1700, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(200, 1, 168, 1, '237848', 545.45, 880, 1, 545.45, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(201, 1, 169, 1, '417396', 580, 880, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(202, 1, 170, 1, '739042', 480, 850, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(203, 1, 171, 1, '540448', 564.44, 900, 1, 564.44, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:10:59', NULL),
(204, 1, 172, 1, '426321', 439.96, 720, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(205, 1, 173, 1, '953970', 656.19, 950, 1, 656.19, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(206, 1, 174, 1, '676758', 953.46, 1250, 1, 953.46, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(207, 1, 175, 1, '974468', 830, 1200, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(208, 1, 176, 1, '613838', 930, 1200, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(209, 1, 177, 1, '997543', 612.16, 850, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(210, 1, 178, 1, '593765', 500, 850, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(211, 1, 179, 1, '279487', 691.34, 1050, 1, 691.34, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:10:59', NULL),
(212, 1, 180, 1, '510220', 630, 950, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(213, 1, 181, 1, '457687', 80, 0, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(214, 1, 182, 1, '777345', 630, 900, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(215, 1, 183, 1, '577256', 410.53, 750, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(216, 1, 184, 1, '706041', 479.8, 800, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(217, 1, 185, 1, '372920', 590, 850, 1, 590, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(218, 1, 186, 1, '589202', 1280, 1700, 1, 1280, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(219, 1, 187, 1, '367843', 410, 750, 1, 410, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(220, 1, 188, 1, '990930', 480, 800, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(221, 1, 189, 1, '348870', 530, 850, 1, 530, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:31:30', NULL),
(222, 1, 190, 1, '610401', 698.45, 1000, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(223, 1, 191, 1, '968003', 751.61, 1050, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(224, 1, 192, 1, '770502', 620, 850, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(225, 1, 193, 1, '890070', 622.31, 1050, 1, 622.31, '0', '2', '0', '2025-04-21 10:44:13', '2025-05-03 22:10:59', NULL),
(226, 1, 194, 1, '938828', 1280, 1450, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(227, 1, 195, 1, '910413', 1265, 1450, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(228, 1, 196, 1, '872293', 500, 800, 0, 0, '0', '2', '0', '2025-04-21 10:44:13', '2025-04-21 20:04:25', NULL),
(229, 1, 197, 1, '914557', 620, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(230, 1, 198, 1, '180141', 402.96, 750, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(231, 1, 199, 1, '528243', 780, 1050, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(232, 1, 200, 1, '928545', 840, 1050, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(233, 1, 201, 1, '554307', 560, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(234, 1, 202, 1, '103274', 560, 850, 0.975, 546, '0', '2', '1', '2025-04-21 11:03:51', '2025-05-07 13:08:34', NULL),
(235, 1, 203, 1, '562740', 1480, 1700, 1, 1480, '0', '2', '0', '2025-04-21 11:03:51', '2025-05-03 22:22:13', NULL),
(236, 1, 204, 1, '288167', 560, 850, 1, 560, '0', '2', '0', '2025-04-21 11:03:51', '2025-05-03 22:22:13', NULL),
(237, 1, 205, 1, '898179', 603.81, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(238, 1, 206, 1, '539021', 364.73, 650, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(239, 1, 207, 1, '376591', 472.99, 780, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(240, 1, 208, 1, '354463', 500, 850, -0.025, 0, '0', '2', '1', '2025-04-21 11:03:51', '2025-05-07 13:13:18', NULL),
(241, 1, 209, 1, '750240', 630, 900, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(242, 1, 210, 1, '933196', 540, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(243, 1, 211, 1, '749752', 577.62, 880, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(244, 1, 212, 1, '541990', 608.48, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(245, 1, 213, 1, '932554', 590, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(246, 1, 214, 1, '347580', 461.68, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(247, 1, 215, 1, '606571', 481.63, 780, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(248, 1, 216, 1, '717306', 380, 650, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(249, 1, 217, 1, '505966', 700.23, 980, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(250, 1, 218, 1, '519106', 413.34, 800, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(251, 1, 219, 1, '300392', 780, 1300, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(252, 1, 220, 1, '389854', 715.92, 1050, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(253, 1, 221, 1, '364434', 815, 1200, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(254, 1, 222, 1, '625692', 680, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(255, 1, 223, 1, '856521', 480, 780, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(256, 1, 224, 1, '908874', 470, 750, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(257, 1, 225, 1, '116899', 339.03, 800, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(258, 1, 226, 1, '752441', 287.66, 580, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(259, 1, 227, 1, '449668', 489.46, 780, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(260, 1, 228, 1, '292746', 880, 1500, -0.1, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-05-03 21:54:03', NULL),
(261, 1, 229, 1, '755582', 760, 980, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(262, 1, 230, 1, '836411', 530, 800, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(263, 1, 231, 1, '361824', 300.2, 650, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(264, 1, 232, 1, '841701', 316.88, 680, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(265, 1, 233, 1, '511652', 545, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(266, 1, 234, 1, '939732', 396.93, 750, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(267, 1, 235, 1, '283051', 680, 950, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(268, 1, 236, 1, '895192', 545, 1000, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(269, 1, 237, 1, '694675', 318.1, 500, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(270, 1, 238, 1, '349312', 318.1, 500, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(271, 1, 239, 1, '783558', 510.48, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(272, 1, 240, 1, '331512', 270, 500, 1, 270, '0', '2', '0', '2025-04-21 11:03:51', '2025-05-03 22:10:59', NULL),
(273, 1, 241, 1, '978499', 432.32, 850, 1, 432.32, '0', '2', '0', '2025-04-21 11:03:51', '2025-05-03 22:10:59', NULL),
(274, 1, 242, 1, '280909', 520, 1300, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(275, 1, 243, 1, '830016', 930, 900, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(276, 1, 244, 1, '848639', 546.2, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(277, 1, 245, 1, '915417', 630, 980, 1, 630, '0', '2', '0', '2025-04-21 11:03:51', '2025-05-03 22:10:59', NULL),
(278, 1, 246, 1, '397721', 480, 1200, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(279, 1, 247, 1, '180448', 638.22, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(280, 1, 248, 1, '415595', 651.43, 1650, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(281, 1, 249, 1, '444907', 587, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(282, 1, 250, 1, '938107', 575.45, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(283, 1, 251, 1, '558082', 680, 1200, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(284, 1, 252, 1, '741231', 80, 900, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(285, 1, 253, 1, '549661', 603.81, 800, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(286, 1, 254, 1, '325104', 80, 770, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(287, 1, 255, 1, '675921', 580, 950, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(288, 1, 256, 1, '459840', 608.48, 880, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(289, 1, 257, 1, '569884', 1130, 950, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(290, 1, 258, 1, '957091', 413.35, 800, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(291, 1, 259, 1, '428175', 915.71, 1200, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(292, 1, 260, 1, '891073', 448.26, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(293, 1, 261, 1, '196894', 580, 880, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(294, 1, 262, 1, '856083', 80, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(295, 1, 263, 1, '711131', 700.23, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(296, 1, 264, 1, '705753', 80, 1440, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(297, 1, 265, 1, '278218', 645.18, 750, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(298, 1, 266, 1, '773580', 560.77, 800, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(299, 1, 267, 1, '275936', 915.71, 1200, -0.4, 0, '0', '2', '1', '2025-04-21 11:03:51', '2025-05-01 22:03:46', NULL),
(300, 1, 268, 1, '149443', 610, 1100, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(301, 1, 269, 1, '649614', 660, 800, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(302, 1, 270, 1, '724734', 580, 880, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(303, 1, 271, 1, '365524', 600, 880, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(304, 1, 272, 1, '121973', 700.23, 1300, 1, 700.23, '0', '2', '0', '2025-04-21 11:03:51', '2025-05-01 22:03:46', NULL),
(305, 1, 273, 1, '576526', 645.18, 950, 1, 645.18, '0', '2', '0', '2025-04-21 11:03:51', '2025-05-01 22:03:46', NULL),
(306, 1, 274, 1, '937182', 641.57, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(307, 1, 275, 1, '773265', 540, 1050, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(308, 1, 276, 1, '889082', 755, 920, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(309, 1, 277, 1, '504812', 667.2, 880, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(310, 1, 278, 1, '302946', 0, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(311, 1, 279, 1, '829012', 1080, 880, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(312, 1, 280, 1, '516253', 538.75, 1200, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(313, 1, 281, 1, '467719', 530, 1450, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(314, 1, 282, 1, '332487', 680, 1250, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(315, 1, 283, 1, '387671', 630.5, 900, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(316, 1, 284, 1, '323375', 80, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(317, 1, 285, 1, '501495', 1070, 970, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(318, 1, 286, 1, '352754', 667.2, 950, 1, 667.2, '0', '2', '0', '2025-04-21 11:03:51', '2025-05-01 22:03:46', NULL),
(319, 1, 287, 1, '209333', 630, 1300, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(320, 1, 288, 1, '124285', 980, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(321, 1, 289, 1, '234104', 80, 800, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(322, 1, 290, 1, '885198', 553.43, 950, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(323, 1, 291, 1, '320103', 630.5, 900, 1, 630.5, '0', '2', '0', '2025-04-21 11:03:51', '2025-05-01 22:03:46', NULL),
(324, 1, 292, 1, '517976', 430, 860, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(325, 1, 293, 1, '507012', 461.68, 0, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(326, 1, 294, 1, '837315', 814, 1200, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(327, 1, 295, 1, '631138', 454.34, 0, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(328, 1, 296, 1, '531744', 1380, 900, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(329, 1, 297, 1, '179394', 280, 1200, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(330, 1, 298, 1, '161784', 275, 0, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(331, 1, 299, 1, '508435', 730, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(332, 1, 300, 1, '561222', 760, 1050, 1, 760, '0', '2', '0', '2025-04-21 11:03:51', '2025-05-01 22:03:46', NULL),
(333, 1, 301, 1, '819076', 430, 650, 1, 430, '0', '2', '0', '2025-04-21 11:03:51', '2025-05-01 22:03:46', NULL),
(334, 1, 302, 1, '955197', 461.68, 850, 1, 461.68, '0', '2', '0', '2025-04-21 11:03:51', '2025-05-01 22:03:46', NULL),
(335, 1, 303, 1, '228320', 630, 1200, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(336, 1, 304, 1, '948175', 454.34, 850, 0.55, 249.887, '0', '2', '1', '2025-04-21 11:03:51', '2025-05-09 19:19:34', NULL),
(337, 1, 305, 1, '624056', 538.75, 1650, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(338, 1, 306, 1, '765989', 280, 450, 1, 280, '0', '2', '0', '2025-04-21 11:03:51', '2025-05-01 22:03:46', NULL),
(339, 1, 307, 1, '543829', 195, 550, 1, 195, '0', '2', '0', '2025-04-21 11:03:51', '2025-05-01 21:43:41', NULL),
(340, 1, 308, 1, '235322', 980, 950, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(341, 1, 309, 1, '994340', 357, 850, 0.8, 285.6, '0', '2', '1', '2025-04-21 11:03:51', '2025-05-09 19:19:34', NULL),
(342, 1, 310, 1, '648253', 402.96, 780, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(343, 1, 311, 1, '672105', 630, 1200, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(344, 1, 312, 1, '360310', 290, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(345, 1, 313, 1, '113986', 580, 1250, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(346, 1, 314, 1, '543714', 810, 880, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(347, 1, 315, 1, '475016', 500, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(348, 1, 316, 1, '760410', 730, 900, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(349, 1, 317, 1, '764707', 80, 0, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(350, 1, 318, 1, '193210', 630.98, 850, -0.125, 0, '0', '2', '1', '2025-04-21 11:03:51', '2025-05-09 19:19:34', NULL),
(351, 1, 319, 1, '863287', 402.96, 750, 1, 402.96, '0', '2', '0', '2025-04-21 11:03:51', '2025-05-01 21:43:41', NULL),
(352, 1, 320, 1, '832234', 1030, 900, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(353, 1, 321, 1, '497607', 700, 0, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(354, 1, 322, 1, '782924', 500, 0, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(355, 1, 323, 1, '479306', 590, 1050, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(356, 1, 324, 1, '700170', 540, 800, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(357, 1, 325, 1, '277693', 730, 0, 0.875, 638.75, '0', '2', '1', '2025-04-21 11:03:51', '2025-05-09 19:19:34', NULL),
(358, 1, 326, 1, '617534', 511.04, 0, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(359, 1, 327, 1, '698068', 601.2, 950, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(360, 1, 328, 1, '814639', 1280, 1050, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(361, 1, 329, 1, '108389', 1030, 1350, 1, 1030, '0', '2', '0', '2025-04-21 11:03:51', '2025-05-01 21:43:41', NULL),
(362, 1, 330, 1, '581981', 500, 950, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(363, 1, 331, 1, '397938', 580, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(364, 1, 332, 1, '168530', 680, 900, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(365, 1, 333, 1, '778237', 365.71, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(366, 1, 334, 1, '135074', 530, 1550, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(367, 1, 335, 1, '322768', 1180, 800, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(368, 1, 336, 1, '572269', 601.2, 950, 0.875, 526.05, '0', '2', '1', '2025-04-21 11:03:51', '2025-05-09 19:19:34', NULL),
(369, 1, 337, 1, '509564', 516.73, 1550, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(370, 1, 338, 1, '149569', 536.2, 850, -0.25, 0, '0', '2', '1', '2025-04-21 11:03:51', '2025-05-09 19:19:34', NULL),
(371, 1, 339, 1, '139646', 715, 0, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(372, 1, 340, 1, '916680', 540, 800, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 20:04:25', NULL),
(373, 1, 341, 1, '344854', 680, 920, 0.875, 595, '0', '2', '1', '2025-04-21 11:03:51', '2025-05-09 19:19:34', NULL),
(374, 1, 342, 1, '151308', 0, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(375, 1, 343, 1, '384911', 0, 800, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(376, 1, 344, 1, '847332', 0, 1420, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(377, 1, 345, 1, '110369', 0, 0, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(378, 1, 346, 1, '167362', 0, 850, -0.125, 0, '0', '2', '1', '2025-04-21 11:03:51', '2025-05-09 19:19:35', NULL),
(379, 1, 347, 1, '133203', 0, 0, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(380, 1, 348, 1, '434083', 0, 0, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(381, 1, 349, 1, '248870', 0, 1000, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(382, 1, 350, 1, '769898', 0, 850, 0, 0, '0', '2', '0', '2025-04-21 11:03:51', '2025-04-21 11:03:51', NULL),
(383, 1, 351, 1, '915418', 560, 900, 0.885, 495.6, '0', '2', '1', '2025-04-21 11:03:51', '2025-05-04 18:11:26', NULL),
(384, 1, 352, 1, '334299', 1, 30, 18, 0, '0', '2', '0', '2025-04-21 19:47:57', '2025-05-05 12:55:52', NULL),
(385, 1, 353, 1, '333903', 1, 45, 8, 0, '0', '2', '0', '2025-04-21 19:48:43', '2025-04-25 19:47:26', NULL),
(386, 1, 354, 1, '796882', 1, 55, 7, 0, '0', '2', '0', '2025-04-21 19:50:12', '2025-04-25 19:47:26', NULL),
(387, 1, 355, 1, '876797', 1, 65, 10, 0, '0', '2', '0', '2025-04-21 19:50:40', '2025-05-05 12:55:46', NULL),
(388, 1, 356, 1, '749062', 100, 150, 0, 0, '0', '2', '0', '2025-04-21 19:51:54', '2025-04-25 19:47:26', NULL),
(389, 1, 357, 1, '361478', 210, 500, 6, 1260, '0', '2', '1', '2025-04-21 19:53:19', '2025-05-07 10:09:47', NULL),
(390, 1, 358, 1, '842798', 315, 350, 1, 315, '0', '2', '0', '2025-04-21 19:53:59', '2025-04-30 21:35:29', NULL),
(391, 1, 359, 1, '573078', 180, 350, 2.5, 0, '0', '2', '0', '2025-04-21 19:54:37', '2025-04-25 19:47:26', NULL),
(392, 1, 360, 1, '779408', 340, 550, 2, 0, '0', '2', '0', '2025-04-21 19:55:27', '2025-04-25 19:47:26', NULL),
(393, 1, 361, 1, '917597', 217, 420, 1.5, 0, '0', '2', '0', '2025-04-21 19:56:03', '2025-04-25 19:47:26', NULL),
(394, 1, 362, 1, '145493', 217, 420, 2.5, 0, '0', '2', '0', '2025-04-21 19:56:33', '2025-04-25 19:47:26', NULL),
(395, 1, 363, 1, '531056', 217, 450, 2, 0, '0', '2', '0', '2025-04-21 19:58:18', '2025-04-25 19:47:26', NULL),
(396, 1, 364, 1, '180674', 264, 460, 2, 0, '0', '2', '0', '2025-04-21 19:58:47', '2025-04-25 19:47:26', NULL),
(397, 1, 365, 1, '314303', 241.5, 460, 2, 0, '0', '2', '0', '2025-04-21 19:59:24', '2025-04-25 19:47:26', NULL),
(398, 1, 366, 1, '238551', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-22 14:14:22', '2025-04-23 13:51:33', '2025-04-23 13:51:33'),
(399, 1, 367, 1, '705938', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 20:58:00', '2025-04-23 20:58:24', NULL),
(400, 1, 368, 1, '407829', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 20:59:05', '2025-04-23 20:59:18', NULL),
(401, 1, 369, 1, '958934', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:00:14', '2025-04-23 21:00:14', NULL),
(402, 1, 370, 1, '882829', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:02:35', '2025-04-23 21:02:35', NULL),
(403, 1, 371, 1, '147358', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:03:55', '2025-04-23 21:03:55', NULL),
(404, 1, 372, 1, '456579', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:06:47', '2025-05-15 17:07:59', NULL),
(405, 1, 373, 1, '621210', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:07:23', '2025-05-15 17:07:59', NULL),
(406, 1, 374, 1, '193578', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:08:10', '2025-04-23 21:08:10', NULL),
(407, 1, 375, 1, '629961', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:09:05', '2025-04-23 21:09:05', NULL),
(408, 1, 376, 1, '464961', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:09:38', '2025-04-23 21:09:38', NULL),
(409, 1, 377, 1, '496774', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:10:08', '2025-04-23 21:10:08', NULL),
(410, 1, 378, 1, '154497', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:10:42', '2025-04-23 21:10:42', NULL),
(411, 1, 379, 1, '350873', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:12:05', '2025-04-23 21:12:05', NULL),
(412, 1, 380, 1, '432807', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:14:00', '2025-04-23 21:14:00', NULL),
(413, 1, 381, 1, '810590', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:14:34', '2025-04-23 21:14:34', NULL),
(414, 1, 382, 1, '486894', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:15:50', '2025-04-23 21:15:50', NULL),
(415, 1, 383, 1, '725612', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:16:26', '2025-04-23 21:16:26', NULL),
(416, 1, 384, 1, '425936', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:17:45', '2025-04-23 21:17:45', NULL),
(417, 1, 385, 1, '149049', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:18:24', '2025-04-23 21:18:24', NULL),
(418, 1, 386, 1, '558698', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:19:19', '2025-04-23 21:19:19', NULL),
(419, 1, 387, 1, '638218', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:20:02', '2025-04-23 21:20:02', NULL),
(420, 1, 388, 1, '197445', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:20:42', '2025-04-23 21:20:42', NULL),
(421, 1, 389, 1, '738122', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:21:39', '2025-04-23 21:21:39', NULL),
(422, 1, 390, 1, '280913', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:22:30', '2025-04-23 21:22:30', NULL),
(423, 1, 391, 1, '435335', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:24:00', '2025-04-23 21:24:00', NULL),
(424, 1, 392, 1, '633336', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:24:47', '2025-04-23 22:17:49', NULL),
(425, 1, 393, 1, '906616', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:25:44', '2025-04-23 21:25:44', NULL),
(426, 1, 394, 1, '333109', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:26:43', '2025-04-23 21:26:43', NULL),
(427, 1, 395, 1, '916585', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:28:10', '2025-04-23 21:28:10', NULL),
(428, 1, 396, 1, '837902', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:35:31', '2025-04-23 21:35:31', NULL),
(429, 1, 397, 1, '715023', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:37:25', '2025-04-23 21:37:25', NULL),
(430, 1, 398, 1, '224175', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:38:18', '2025-04-23 21:38:18', NULL),
(431, 1, 399, 1, '836945', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:39:12', '2025-04-23 21:39:12', NULL),
(432, 1, 400, 1, '835351', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:41:54', '2025-04-23 22:17:32', NULL),
(433, 1, 401, 1, '890603', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:43:37', '2025-04-23 21:43:37', NULL),
(434, 1, 402, 1, '586098', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:44:12', '2025-04-23 22:16:04', NULL),
(435, 1, 403, 1, '761054', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:45:25', '2025-04-23 22:17:56', NULL),
(436, 1, 404, 1, '777818', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:46:42', '2025-04-23 21:46:42', NULL),
(437, 1, 405, 1, '641326', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:47:24', '2025-04-23 21:47:24', NULL),
(438, 1, 406, 1, '556033', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:48:19', '2025-04-23 22:18:05', NULL),
(439, 1, 407, 1, '628151', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:49:17', '2025-04-23 21:49:17', NULL),
(440, 1, 408, 1, '976934', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:50:13', '2025-04-23 22:17:41', NULL),
(441, 1, 409, 1, '167570', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:51:08', '2025-04-23 21:51:08', NULL),
(442, 1, 410, 1, '759570', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:52:42', '2025-04-23 21:52:42', NULL),
(443, 1, 411, 1, '626835', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:55:06', '2025-04-23 21:55:06', NULL),
(444, 1, 412, 1, '665704', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:55:53', '2025-04-23 21:55:53', NULL),
(445, 1, 413, 1, '527264', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:56:25', '2025-04-23 21:56:25', NULL),
(446, 1, 414, 1, '757639', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:57:06', '2025-04-23 22:18:13', NULL),
(447, 1, 415, 1, '157426', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:58:10', '2025-04-23 21:58:10', NULL),
(448, 1, 416, 1, '396002', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 21:59:19', '2025-04-23 21:59:19', NULL),
(449, 1, 417, 1, '620073', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 22:00:23', '2025-04-23 22:00:23', NULL),
(450, 1, 418, 1, '723926', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 22:01:26', '2025-04-23 22:02:56', NULL),
(451, 1, 419, 1, '948459', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 22:03:31', '2025-04-23 22:03:31', NULL),
(452, 1, 420, 1, '127509', 1, 2.5, 887, 887, '0', '2', '1', '2025-04-23 22:04:30', '2025-05-13 21:52:03', NULL),
(453, 1, 421, 1, '872144', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 22:04:58', '2025-04-23 22:04:58', NULL),
(454, 1, 422, 1, '210443', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-23 22:05:42', '2025-04-23 22:05:42', NULL),
(455, 1, 423, 1, '183102', 0.5, 0.5, 944, 472, '0', '2', '1', '2025-04-24 13:30:24', '2025-05-09 19:19:35', NULL),
(456, 1, 424, 1, '827699', 1, 1, -12, 0, '0', '2', '1', '2025-04-24 13:31:46', '2025-05-04 14:43:11', NULL),
(457, 1, 425, 1, '729066', 0, 50, -1, 0, '0', '1', '0', '2025-04-24 19:16:47', '2025-05-16 21:18:45', NULL),
(458, 1, 426, 1, '252348', 0, 50, 0, 0, '0', '1', '0', '2025-04-24 19:17:12', '2025-04-28 00:08:07', NULL),
(459, 1, 427, 1, '418324', 0, 50, -2, 0, '0', '1', '0', '2025-04-24 19:17:33', '2025-05-13 19:23:01', NULL),
(460, 1, 428, 1, '829449', 0, 50, -2, 0, '0', '1', '0', '2025-04-24 19:18:31', '2025-05-13 19:22:16', NULL),
(461, 1, 429, 1, '361857', 0, 50, -2, 0, '0', '1', '0', '2025-04-24 19:19:06', '2025-05-11 20:32:58', NULL),
(462, 1, 430, 1, '608454', 0, 50, -2, 0, '0', '1', '0', '2025-04-24 19:19:26', '2025-05-14 20:49:44', NULL),
(463, 1, 431, 1, '314452', 0, 80, 0, 0, '0', '1', '0', '2025-04-24 19:19:47', '2025-04-24 19:19:47', NULL),
(464, 1, 432, 1, '521656', 0, 50, -5, 0, '0', '1', '0', '2025-04-24 19:20:04', '2025-05-16 22:48:20', NULL),
(465, 1, 433, 1, '226375', 1.4320754716981, 1, 112, 160.39245283019, '0', '1', '1', '2025-04-24 20:22:56', '2025-05-09 18:33:47', NULL),
(466, 1, 434, 1, '518014', 0, 30, -5, 0, '0', '1', '0', '2025-04-25 18:06:35', '2025-05-17 09:50:43', NULL),
(467, 1, 435, 1, '784704', 0, 50, 0, 0, '0', '1', '0', '2025-04-25 18:07:02', '2025-04-26 23:28:57', NULL),
(468, 1, 436, 1, '845911', 131.25, 250, 6142.9, 806255.625, '0', '2', '1', '2025-04-25 19:48:00', '2025-05-07 13:11:33', '2025-05-07 13:11:33'),
(469, 1, 437, 1, '631290', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:43:16', '2025-04-27 11:43:16', NULL),
(470, 1, 438, 1, '525942', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:43:50', '2025-04-27 11:43:50', NULL),
(471, 1, 439, 1, '663067', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:45:37', '2025-04-27 11:45:37', NULL),
(472, 1, 440, 1, '674658', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:46:05', '2025-04-27 11:46:05', NULL),
(473, 1, 441, 1, '548489', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:46:38', '2025-04-27 11:46:38', NULL),
(474, 1, 442, 1, '354771', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:48:06', '2025-04-27 11:48:06', NULL),
(475, 1, 443, 1, '445464', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:48:38', '2025-04-27 11:48:38', NULL),
(476, 1, 444, 1, '871613', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:49:05', '2025-04-27 11:49:05', NULL),
(477, 1, 445, 1, '965769', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:49:35', '2025-04-27 11:49:35', NULL),
(478, 1, 446, 1, '158488', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:50:03', '2025-04-27 11:50:03', NULL),
(479, 1, 447, 1, '187889', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:50:37', '2025-04-27 11:50:37', NULL),
(480, 1, 448, 1, '659261', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:51:12', '2025-04-27 11:51:12', NULL),
(481, 1, 449, 1, '803083', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:52:02', '2025-04-27 11:52:02', NULL),
(482, 1, 450, 1, '312924', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:52:34', '2025-04-27 11:52:34', NULL),
(483, 1, 451, 1, '898176', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:54:51', '2025-04-27 11:54:51', NULL);
INSERT INTO `item_prices` (`id`, `branch_id`, `item_id`, `price_size_id`, `barcode`, `cost_price`, `price`, `stock`, `total_cost_price`, `ingredient_added`, `price_item_type`, `edit_cost_price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(484, 1, 452, 1, '828373', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:55:22', '2025-04-27 11:55:33', NULL),
(485, 1, 453, 1, '413240', 1, 1, 1044, 1044, '0', '2', '1', '2025-04-27 11:56:54', '2025-05-09 19:19:35', NULL),
(486, 1, 454, 1, '889161', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:57:17', '2025-04-27 11:57:17', NULL),
(487, 1, 455, 1, '714661', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:57:55', '2025-04-27 11:57:55', NULL),
(488, 1, 456, 1, '729567', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:58:39', '2025-04-27 11:58:39', NULL),
(489, 1, 457, 1, '968076', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:59:03', '2025-04-27 11:59:03', NULL),
(490, 1, 458, 1, '682943', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 11:59:29', '2025-04-27 11:59:29', NULL),
(491, 1, 459, 1, '574337', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:00:08', '2025-04-27 12:00:08', NULL),
(492, 1, 460, 1, '840990', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:00:42', '2025-04-27 12:00:42', NULL),
(493, 1, 461, 1, '135014', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:01:15', '2025-04-27 12:01:15', NULL),
(494, 1, 462, 1, '370338', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:01:44', '2025-04-27 12:01:44', NULL),
(495, 1, 463, 1, '210714', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:02:16', '2025-04-27 12:02:16', NULL),
(496, 1, 464, 1, '100440', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:02:56', '2025-04-27 12:03:12', NULL),
(497, 1, 465, 1, '940428', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:04:06', '2025-04-27 12:04:06', NULL),
(498, 1, 466, 1, '860855', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:05:11', '2025-04-27 12:05:11', NULL),
(499, 1, 467, 1, '115327', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:05:57', '2025-04-27 12:05:57', NULL),
(500, 1, 468, 1, '220075', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:08:04', '2025-04-27 12:11:37', NULL),
(501, 1, 469, 1, '129232', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:08:33', '2025-04-27 12:08:33', NULL),
(502, 1, 470, 1, '861633', 1, 1, 1599, 1599, '0', '2', '1', '2025-04-27 12:09:03', '2025-05-13 21:52:03', NULL),
(503, 1, 471, 1, '398447', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:09:52', '2025-04-27 12:09:52', NULL),
(504, 1, 472, 1, '914925', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:12:29', '2025-04-27 12:12:29', NULL),
(505, 1, 473, 1, '436742', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:13:07', '2025-04-27 12:13:07', NULL),
(506, 1, 474, 1, '781941', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:13:43', '2025-04-27 12:13:43', NULL),
(507, 1, 475, 1, '513135', 0, 1, 0, 0, '0', '2', '0', '2025-04-27 12:14:30', '2025-04-27 12:14:30', NULL),
(508, 1, 476, 1, '866914', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:15:16', '2025-04-27 12:15:16', NULL),
(509, 1, 477, 1, '258963', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:15:46', '2025-04-27 12:15:46', NULL),
(510, 1, 478, 1, '227321', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:16:15', '2025-04-27 12:16:15', NULL),
(511, 1, 479, 1, '637606', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:16:42', '2025-04-27 12:16:42', NULL),
(512, 1, 480, 1, '376279', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:17:21', '2025-04-27 12:17:21', NULL),
(513, 1, 481, 1, '771638', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:18:06', '2025-04-27 12:18:06', NULL),
(514, 1, 482, 1, '550425', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:21:04', '2025-04-27 12:21:04', NULL),
(515, 1, 483, 1, '359539', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:21:38', '2025-04-27 12:21:38', NULL),
(516, 1, 484, 1, '411004', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:22:02', '2025-04-27 12:22:02', NULL),
(517, 1, 485, 1, '767554', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:22:59', '2025-04-27 12:22:59', NULL),
(518, 1, 486, 1, '584377', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:23:32', '2025-04-27 12:23:32', NULL),
(519, 1, 487, 1, '188172', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:24:55', '2025-04-27 12:24:55', NULL),
(520, 1, 488, 1, '830512', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:25:40', '2025-04-27 12:25:40', NULL),
(521, 1, 489, 1, '830357', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:26:11', '2025-04-27 12:26:11', NULL),
(522, 1, 490, 1, '794093', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:26:35', '2025-04-27 12:26:35', NULL),
(523, 1, 491, 1, '412616', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:27:11', '2025-04-27 12:27:11', NULL),
(524, 1, 492, 1, '835840', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:31:20', '2025-04-27 12:31:20', NULL),
(525, 1, 493, 1, '479473', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:32:01', '2025-04-27 12:32:01', NULL),
(526, 1, 494, 1, '184702', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 12:34:25', '2025-04-27 12:34:25', NULL),
(527, 1, 495, 1, '727927', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:09:10', '2025-04-27 13:09:10', NULL),
(528, 1, 496, 1, '514658', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:09:36', '2025-04-27 13:09:36', NULL),
(529, 1, 497, 1, '469766', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:10:30', '2025-04-27 13:10:30', NULL),
(530, 1, 498, 1, '770800', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:11:09', '2025-04-27 13:11:09', NULL),
(531, 1, 499, 1, '147460', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:12:01', '2025-04-27 13:12:01', NULL),
(532, 1, 500, 1, '822483', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:13:16', '2025-04-27 13:13:16', NULL),
(533, 1, 501, 1, '952588', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:13:48', '2025-04-27 13:13:48', NULL),
(534, 1, 502, 1, '541697', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:14:26', '2025-04-27 13:14:26', NULL),
(535, 1, 503, 1, '216592', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:15:23', '2025-04-27 13:15:23', NULL),
(536, 1, 504, 1, '620033', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:15:53', '2025-04-27 13:15:53', NULL),
(537, 1, 505, 1, '556153', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:16:19', '2025-04-27 13:16:19', NULL),
(538, 1, 506, 1, '815320', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:17:09', '2025-04-27 13:17:09', NULL),
(539, 1, 507, 1, '942583', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:17:44', '2025-04-27 13:20:35', NULL),
(540, 1, 508, 1, '622164', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:21:08', '2025-04-27 13:21:08', NULL),
(541, 1, 509, 1, '165162', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:21:56', '2025-04-27 13:21:56', NULL),
(542, 1, 510, 1, '309064', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:22:31', '2025-04-27 13:22:31', NULL),
(543, 1, 511, 1, '285581', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:23:24', '2025-04-27 13:23:24', NULL),
(544, 1, 512, 1, '743977', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:23:42', '2025-04-27 13:23:42', NULL),
(545, 1, 513, 1, '743886', 0, 1, 0, 0, '0', '2', '0', '2025-04-27 13:24:08', '2025-04-27 13:24:08', NULL),
(546, 1, 514, 1, '207766', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:24:53', '2025-04-27 13:24:53', NULL),
(547, 1, 515, 1, '630985', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:25:17', '2025-04-27 13:25:17', NULL),
(548, 1, 516, 1, '109713', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:25:52', '2025-04-27 13:25:52', NULL),
(549, 1, 517, 1, '481879', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:26:29', '2025-04-27 13:26:29', NULL),
(550, 1, 518, 1, '148104', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:26:51', '2025-04-27 13:26:51', NULL),
(551, 1, 519, 1, '730611', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:27:16', '2025-04-27 13:27:16', NULL),
(552, 1, 520, 1, '579596', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:28:32', '2025-04-27 13:28:32', NULL),
(553, 1, 521, 1, '363542', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:29:01', '2025-04-27 13:29:01', NULL),
(554, 1, 522, 1, '936624', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:29:39', '2025-04-27 13:29:39', NULL),
(555, 1, 523, 1, '868508', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:30:17', '2025-04-27 13:30:17', NULL),
(556, 1, 524, 1, '693051', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:31:07', '2025-04-27 13:31:07', NULL),
(557, 1, 525, 1, '736493', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:31:52', '2025-04-27 13:31:52', NULL),
(558, 1, 526, 1, '786450', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:32:34', '2025-04-27 13:32:34', NULL),
(559, 1, 527, 1, '243670', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:33:07', '2025-04-27 13:33:07', NULL),
(560, 1, 528, 1, '975998', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:33:47', '2025-04-27 13:33:47', NULL),
(561, 1, 529, 1, '271438', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:34:12', '2025-04-27 13:34:12', NULL),
(562, 1, 530, 1, '486679', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:35:01', '2025-04-27 13:35:01', NULL),
(563, 1, 531, 1, '435197', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:35:26', '2025-04-27 13:35:26', NULL),
(564, 1, 532, 1, '175354', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:35:53', '2025-04-27 13:35:53', NULL),
(565, 1, 533, 1, '410237', 0, 2.5, 120, 0, '0', '2', '0', '2025-04-27 13:36:40', '2025-05-05 12:54:21', NULL),
(566, 1, 534, 1, '144577', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:37:04', '2025-04-27 13:37:04', NULL),
(567, 1, 535, 1, '448870', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:37:29', '2025-04-27 13:37:29', NULL),
(568, 1, 536, 1, '780897', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:39:56', '2025-04-27 13:39:56', NULL),
(569, 1, 537, 1, '860256', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:40:19', '2025-04-27 13:40:19', NULL),
(570, 1, 538, 1, '920589', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:40:43', '2025-04-27 13:40:43', NULL),
(571, 1, 539, 1, '520168', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:41:36', '2025-04-27 13:41:36', NULL),
(572, 1, 540, 1, '429415', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:42:00', '2025-04-27 13:42:00', NULL),
(573, 1, 541, 1, '399951', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:43:07', '2025-04-27 13:43:07', NULL),
(574, 1, 542, 1, '948937', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:43:28', '2025-04-27 13:43:28', NULL),
(575, 1, 543, 1, '313405', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:44:16', '2025-04-27 13:44:16', NULL),
(576, 1, 544, 1, '647334', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:44:40', '2025-04-27 13:44:40', NULL),
(577, 1, 545, 1, '834776', 0, 2.5, 0, 0, '0', '2', '0', '2025-04-27 13:45:00', '2025-04-27 13:45:00', NULL),
(578, 1, 546, 1, '614451', 1.5, 2.5, 500, 750, '0', '2', '0', '2025-04-27 13:45:28', '2025-05-01 17:33:34', NULL),
(579, 1, 547, 1, '813332', 0, 50, -1, 0, '1', '1', '1', '2025-04-27 15:31:56', '2025-05-12 19:30:10', NULL),
(580, 1, 548, 1, '490129', 0, 50, -2, 0, '0', '1', '0', '2025-04-27 15:32:25', '2025-05-04 19:15:42', NULL),
(581, 1, 549, 1, '763970', 1.5, 50, 5, 7.5, '1', '1', '0', '2025-04-27 15:35:50', '2025-05-07 13:38:39', NULL),
(582, 1, 550, 1, '349414', 36.523247645292, 50, 1, 36.523247645292, '1', '1', '1', '2025-04-27 15:36:53', '2025-05-16 20:09:19', NULL),
(583, 1, 551, 1, '456768', 1.5, 50, 199, 298.5, '1', '1', '0', '2025-04-27 15:37:18', '2025-05-16 21:18:45', NULL),
(584, 1, 552, 1, '495724', 1.9079705536072, 50, 203, 387.31802238226, '1', '1', '1', '2025-04-27 15:37:32', '2025-05-12 14:08:09', NULL),
(585, 1, 553, 1, '530349', 1.4159485871751, 2.5, 2245, 3178.8045782081, '0', '2', '1', '2025-04-28 18:54:17', '2025-05-09 19:19:35', NULL),
(586, 1, 554, 1, '931022', 0, 6, 0, 0, '0', '2', '0', '2025-05-05 10:12:30', '2025-05-05 10:23:37', '2025-05-05 10:23:37'),
(587, 1, 555, 1, '239501', 0, 6, 0, 0, '0', '2', '0', '2025-05-05 10:24:31', '2025-05-05 12:55:21', NULL),
(588, 1, 556, 1, '568889', 8, 8, 2, 16, '0', '2', '1', '2025-05-05 10:27:04', '2025-05-05 12:58:26', NULL),
(589, 1, 557, 1, '922970', 12, 12, 2, 24, '0', '2', '1', '2025-05-05 10:28:01', '2025-05-05 12:58:26', NULL),
(590, 1, 558, 1, '285634', 4, 4, 4, 16, '0', '2', '1', '2025-05-05 10:31:04', '2025-05-05 12:58:26', NULL),
(591, 1, 559, 1, '878674', 1, 4, 8, 8, '0', '2', '1', '2025-05-05 10:36:29', '2025-05-05 12:58:26', NULL),
(592, 1, 560, 1, '939025', 13, 13, 2, 26, '0', '2', '1', '2025-05-05 10:37:17', '2025-05-05 12:58:26', NULL),
(593, 1, 561, 1, '599031', 8, 8, 2, 16, '0', '2', '1', '2025-05-05 10:37:58', '2025-05-05 12:58:26', NULL),
(594, 1, 562, 1, '158333', 0, 60, 0, 0, '0', '2', '0', '2025-05-05 11:09:52', '2025-05-05 11:12:58', '2025-05-05 11:12:58'),
(595, 1, 563, 1, '388014', 13.333333333333, 15, 15, 200, '0', '2', '1', '2025-05-05 11:11:31', '2025-05-07 10:09:12', NULL),
(596, 1, 564, 1, '103369', 60, 60, 18, 1080, '0', '2', '1', '2025-05-05 11:13:39', '2025-05-07 10:09:12', NULL),
(597, 1, 565, 1, '304124', 1.0833333333333, 2.5, 240, 260, '0', '2', '1', '2025-05-05 11:50:04', '2025-05-05 12:53:04', NULL),
(598, 1, 566, 1, '605731', 0, 1350, 0, 0, '0', '2', '0', '2025-05-05 13:09:48', '2025-05-05 13:09:48', NULL),
(599, 1, 567, 1, '679269', 0, 750, 0, 0, '0', '2', '0', '2025-05-05 15:08:31', '2025-05-05 15:08:31', NULL),
(600, 1, 568, 1, '451314', 0, 1000, 0, 0, '0', '2', '0', '2025-05-05 15:08:55', '2025-05-05 15:08:55', NULL),
(601, 1, 569, 1, '317466', 0, 3, 0, 0, '0', '2', '0', '2025-05-05 15:20:36', '2025-05-05 15:20:36', NULL),
(602, 1, 570, 1, '163449', 0, 3, 0, 0, '0', '2', '0', '2025-05-05 15:21:03', '2025-05-05 15:21:03', NULL),
(603, 1, 571, 1, '380901', 0, 5, 0, 0, '0', '2', '0', '2025-05-05 15:21:30', '2025-05-05 15:21:30', NULL),
(604, 1, 572, 1, '264602', 0, 7, 0, 0, '0', '2', '0', '2025-05-05 15:22:09', '2025-05-05 15:22:09', NULL),
(605, 1, 573, 1, '118027', 100, 100, 2, 200, '0', '2', '1', '2025-05-07 09:58:31', '2025-05-07 10:09:12', NULL),
(606, 1, 574, 1, '817978', 20, 20, 1, 20, '0', '2', '1', '2025-05-07 09:59:34', '2025-05-07 10:09:12', NULL),
(607, 1, 575, 1, '295552', 10, 10, 2, 20, '0', '2', '1', '2025-05-07 10:01:50', '2025-05-07 10:09:12', NULL),
(608, 1, 576, 1, '465561', 140, 190, 4, 560, '0', '2', '1', '2025-05-07 10:02:29', '2025-05-07 10:09:12', NULL),
(609, 1, 577, 1, '580980', 3300, 3600, 1, 3300, '0', '2', '1', '2025-05-07 10:13:38', '2025-05-07 10:18:03', NULL),
(610, 1, 578, 1, '125236', 1400, 1850, 1, 1400, '0', '2', '1', '2025-05-07 10:14:26', '2025-05-07 10:18:03', NULL),
(611, 1, 579, 1, '636588', 3300, 3450, 1, 3300, '0', '2', '1', '2025-05-07 10:15:25', '2025-05-07 10:18:03', NULL),
(612, 1, 580, 1, '567241', 0.5, 0.5, 500, 250, '0', '2', '1', '2025-05-07 10:20:10', '2025-05-07 10:22:44', NULL),
(613, 1, 581, 1, '547778', 0.5, 0.5, 100, 50, '0', '2', '1', '2025-05-07 10:21:04', '2025-05-07 10:22:44', NULL),
(614, 1, 582, 1, '642357', 1.25, 2.5, 1800, 2250, '0', '2', '1', '2025-05-07 10:39:50', '2025-05-07 10:45:37', NULL),
(615, 1, 583, 1, '643415', 1.25, 2.5, 1800, 2250, '0', '2', '1', '2025-05-07 10:40:13', '2025-05-07 10:45:37', NULL),
(616, 1, 584, 1, '524870', 0, 930, 0, 0, '0', '2', '0', '2025-05-07 10:47:02', '2025-05-07 10:49:36', NULL),
(617, 1, 585, 1, '171129', 0, 25, 0, 0, '0', '2', '0', '2025-05-07 10:47:47', '2025-05-07 10:47:47', NULL),
(618, 1, 586, 1, '625188', 0, 250, -0.825, 0, '0', '2', '1', '2025-05-07 13:12:45', '2025-05-09 19:19:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_production`
--

CREATE TABLE `item_production` (
  `id` int NOT NULL,
  `branch_id` int NOT NULL,
  `user_id` int NOT NULL,
  `item_id` int NOT NULL,
  `price_id` int NOT NULL,
  `qty` double NOT NULL,
  `production_cost` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `unit_cost_price` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_production`
--

INSERT INTO `item_production` (`id`, `branch_id`, `user_id`, `item_id`, `price_id`, `qty`, `production_cost`, `unit_cost_price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 48, 48, 5, '0', '0', '2025-05-07 15:35:51', NULL, NULL),
(2, 1, 2, 48, 48, 5, '0', '0', '2025-05-07 15:35:53', NULL, NULL),
(3, 1, 2, 48, 48, 5, '0', '0', '2025-05-07 15:35:56', NULL, NULL),
(4, 1, 2, 48, 48, 5, '0', '0', '2025-05-07 15:42:08', NULL, NULL),
(5, 1, 2, 48, 48, 5, '0', '0', '2025-05-07 16:22:37', NULL, NULL),
(6, 1, 2, 48, 48, 5, '0', '0', '2025-05-09 18:40:19', NULL, NULL),
(7, 1, 2, 48, 48, 5, '0', '0', '2025-05-09 18:42:45', NULL, NULL),
(8, 1, 2, 48, 48, 1, '0', '0', '2025-05-09 18:47:01', NULL, NULL),
(9, 1, 2, 48, 48, 1, '0', '0', '2025-05-09 18:47:33', NULL, NULL),
(10, 1, 2, 48, 48, 5, '97.768492935875', '19.553698587175', '2025-05-09 19:19:34', '2025-05-09 19:19:34', NULL),
(11, 1, 2, 66, 66, 5, '144.77467866984', '28.954935733969', '2025-05-09 19:19:34', '2025-05-09 19:19:34', NULL),
(12, 1, 2, 11, 11, 7, '96.872640110226', '13.838948587175', '2025-05-09 19:19:34', '2025-05-09 19:19:34', NULL),
(13, 1, 2, 50, 50, 5, '249.29935733969', '49.859871467938', '2025-05-09 19:19:34', '2025-05-09 19:19:34', NULL),
(14, 1, 2, 14, 14, 5, '868.52467866984', '173.70493573397', '2025-05-09 19:19:34', '2025-05-09 19:19:34', NULL),
(15, 1, 2, 550, 582, 5, '182.61623822646', '36.523247645292', '2025-05-09 19:19:34', '2025-05-09 19:19:34', NULL),
(16, 1, 2, 39, 39, 5, '129.30280366984', '25.860560733969', '2025-05-09 19:19:34', '2025-05-09 19:19:34', NULL),
(17, 1, 2, 552, 584, 5, '9.5398527680362', '1.9079705536072', '2025-05-09 19:19:35', '2025-05-09 19:19:35', NULL),
(18, 1, 2, 547, 579, 1, '0', '0', '2025-05-09 19:30:58', NULL, NULL),
(19, 1, 2, 547, 579, 1, '0', '0', '2025-05-09 19:31:03', NULL, NULL),
(20, 1, 2, 547, 579, 1, '0', '0', '2025-05-09 19:31:08', NULL, NULL),
(21, 1, 2, 547, 579, 1, '0', '0', '2025-05-09 19:31:13', NULL, NULL),
(22, 1, 2, 547, 579, 1, '0', '0', '2025-05-09 19:32:00', NULL, NULL),
(23, 1, 2, 547, 579, 1, '0', '0', '2025-05-09 19:32:25', NULL, NULL),
(24, 1, 2, 547, 579, 1, '0', '0', '2025-05-09 19:32:30', NULL, NULL),
(25, 1, 2, 547, 579, 1, '0', '0', '2025-05-09 19:32:34', NULL, NULL),
(26, 1, 2, 547, 579, 1, '0', '0', '2025-05-09 19:32:41', NULL, NULL),
(27, 1, 2, 547, 579, 1, '0', '0', '2025-05-09 19:33:04', NULL, NULL),
(28, 1, 2, 547, 579, 1, '0', '0', '2025-05-09 19:35:19', NULL, NULL),
(29, 1, 2, 547, 579, 1, '0', '0', '2025-05-09 19:35:24', NULL, NULL),
(30, 1, 2, 547, 579, 1, '0', '0', '2025-05-09 19:35:28', NULL, NULL),
(31, 1, 2, 547, 579, 1, '0', '0', '2025-05-09 19:35:51', NULL, NULL),
(32, 1, 2, 547, 579, 1, '0', '0', '2025-05-09 19:35:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `open_drawer_log`
--

CREATE TABLE `open_drawer_log` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `shop_id` int NOT NULL,
  `staff_id` int DEFAULT NULL,
  `reason` varchar(250) NOT NULL,
  `open_date` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `payment_method_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `uuid`, `branch_id`, `payment_method_name`, `payment_method_slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '5c997adc-b1a0-40c5-af12-f1972054755b', 1, 'cash', 'cash', '2025-04-15 14:21:24', '2025-04-15 14:21:24', NULL),
(2, '8d15d09e-1659-44a4-836c-d9920289eedd', 1, 'card', 'card', '2025-04-15 14:21:24', '2025-04-15 14:21:24', NULL),
(3, '25cad29d-6cb9-4dac-bdaa-95235668248c', 1, 'credit', 'credit', '2025-04-15 14:21:24', '2025-04-15 14:21:24', NULL),
(4, '9c32302d-c8a5-41eb-9047-4ca1cc4fd4c9', 1, 'Dummy', 'dummy', '2025-04-15 15:29:33', '2025-04-15 15:32:03', '2025-04-15 15:32:03'),
(5, '1eb07889-e32c-47e5-923d-40caea574c0d', 1, 'bank oman', 'bank-oman', '2025-05-10 13:06:16', '2025-05-10 13:06:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pay_back`
--

CREATE TABLE `pay_back` (
  `id` int NOT NULL,
  `sale_order_item_id` int NOT NULL,
  `sale_order_id` int NOT NULL,
  `receipt_id` varchar(50) NOT NULL,
  `item_id` int NOT NULL,
  `qty` double NOT NULL,
  `weight` varchar(50) DEFAULT NULL,
  `amount` double NOT NULL,
  `cost_price` double DEFAULT NULL,
  `discount` double NOT NULL,
  `discount_percent` double DEFAULT NULL,
  `tax_amt` double NOT NULL,
  `tax_type` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `shop_id` int NOT NULL,
  `payback_date` datetime NOT NULL,
  `payment_type` varchar(225) DEFAULT NULL,
  `staff_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` enum('admin','counter') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
(68, 4, 'Recent_sales', 'counter', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(69, 4, 'settle_sale', 'counter', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(70, 4, 'opening_balance', 'counter', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(71, 11, 'customer_create', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(72, 11, 'customer_edit', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(73, 11, 'customer_delete', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(74, 3, 'settle_sale_report', 'admin', '2024-06-13 17:47:59', '2024-06-13 17:47:59', NULL),
(75, 4, 'crm', 'counter', '2024-08-11 12:22:24', NULL, NULL),
(76, 4, 'pay_back', 'counter', '2024-08-11 12:22:24', NULL, NULL),
(77, 4, 'open_drawer', 'counter', '2024-08-11 12:22:24', NULL, NULL),
(78, 1, 'production', 'admin', NULL, NULL, NULL),
(79, 4, 'delivery_log', 'counter', '2024-08-11 17:52:24', NULL, NULL),
(80, 1, 'barcode_print', 'admin', NULL, NULL, NULL),
(81, 3, 'supplier_outstanding_report', 'admin', NULL, NULL, NULL),
(82, 3, 'customer_outstanding_report', 'admin', NULL, NULL, NULL),
(83, 3, 'driver_outstanding_report', 'admin', NULL, NULL, NULL),
(84, 3, 'expense_report', 'admin', NULL, NULL, NULL),
(85, 3, 'profit_loss_report', 'admin', NULL, NULL, NULL),
(87, 2, 'stock_transfer', 'admin', '2024-11-05 10:58:14', NULL, NULL),
(88, 87, 'stock_transfer_create', 'admin', '2024-11-05 10:58:14', NULL, NULL),
(89, 87, 'stock_transfer_edit', 'admin', '2024-11-05 10:58:14', NULL, NULL),
(90, 87, 'stock_transfer_delete', 'admin', '2024-11-05 10:58:14', NULL, NULL),
(92, 2, 'stock_add', 'admin', NULL, NULL, NULL),
(93, 92, 'stock_update', 'admin', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `id` int NOT NULL,
  `uuid` char(36) NOT NULL,
  `branch_id` bigint NOT NULL,
  `size_name` varchar(255) NOT NULL,
  `size_slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `price_size`
--

INSERT INTO `price_size` (`id`, `uuid`, `branch_id`, `size_name`, `size_slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '89e7ac5f-b5dc-4678-90c6-40470bef5ae7', 1, 'Unit price', 'unit-price', '2025-04-15 14:21:24', '2025-04-15 14:21:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` int NOT NULL,
  `uuid` char(36) NOT NULL,
  `shop_id` int NOT NULL,
  `user_id` int NOT NULL,
  `supplier_id` int UNSIGNED DEFAULT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `payment_status` enum('paid','un_paid','partial_paid') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'un_paid',
  `total_amount` double DEFAULT NULL,
  `paid_amount` double NOT NULL DEFAULT '0',
  `discount` decimal(13,2) NOT NULL DEFAULT '0.00',
  `total_discount` decimal(13,2) NOT NULL DEFAULT '0.00',
  `tax_amount` double DEFAULT NULL,
  `status` enum('pending','ordered','received') NOT NULL DEFAULT 'pending',
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `uuid`, `shop_id`, `user_id`, `supplier_id`, `supplier_name`, `invoice_no`, `payment_status`, `total_amount`, `paid_amount`, `discount`, `total_discount`, `tax_amount`, `status`, `date_added`, `date_updated`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '4795b03b-9c4d-4d0b-b71c-d7aa70da0c50', 1, 2, 4, 'MOHAMED SHAMSI', '557399', 'paid', 130, 130, 0.00, 0.00, 6.19, 'received', '2025-04-02 00:00:00', NULL, '2025-04-02 00:00:00', '2025-05-05 12:52:31', NULL),
(2, 'b50cf681-b149-4f7f-87ee-94e27a481eb4', 1, 2, 3, 'TAYEB AL WARD TRADING LLC', '2502', 'paid', 375, 375, 0.00, 0.00, 17.86, 'received', '2025-03-10 00:00:00', NULL, '2025-03-10 00:00:00', '2025-05-05 12:51:20', NULL),
(3, '62fb7477-bfbe-4f7e-82a0-f00f1ca0593c', 1, 2, 2, 'LA ROSE GALLERY PERFUMES', '001008', 'paid', 53, 53, 0.00, 0.00, 2.52, 'received', '2025-04-05 00:00:00', NULL, '2025-04-05 00:00:00', '2025-05-05 12:58:26', NULL),
(4, '0ae330bf-89a7-4baf-b4e1-ec8c49830ae4', 1, 2, 6, 'AL FAKHAMAH', '0726', 'paid', 2700, 2700, 0.00, 0.00, 128.57, 'received', '2025-04-05 00:00:00', NULL, '2025-04-05 00:00:00', '2025-05-05 16:18:30', NULL),
(5, 'a7007d46-0ad7-4fc3-8834-624bcf9f17d7', 1, 2, 7, 'FAWAF PERFUMES', '294', 'un_paid', 2850, 0, 0.00, 0.00, 135.71, 'pending', '2025-03-25 00:00:00', NULL, '2025-03-25 00:00:00', '2025-05-06 13:00:28', NULL),
(6, '361e3ef4-17e7-471e-8c70-01690653bd4f', 1, 2, 8, 'GOLDEN WINGS', '0094', 'paid', 200, 200, 0.00, 0.00, 9.52, 'received', '2025-05-06 00:00:00', NULL, '2025-05-06 00:00:00', '2025-05-07 10:09:17', NULL),
(7, 'fff3238d-a1b7-49d5-b6e9-559d86a553b6', 1, 2, 3, 'TAYEB AL WARD TRADING LLC', '7577', 'paid', 1330, 1330, 0.00, 0.00, 63.33, 'received', '2025-03-05 00:00:00', NULL, '2025-03-05 00:00:00', '2025-05-07 10:09:12', NULL),
(8, 'b897d87d-4380-4945-8166-44724e2a5b72', 1, 2, 9, 'DAHMA TRADING - SHEIJAH ISSA', '251000616', 'paid', 1260, 1260, 0.00, 0.00, 60, 'received', '2025-03-24 00:00:00', NULL, '2025-03-24 00:00:00', '2025-05-07 10:09:47', NULL),
(9, '5f00bd47-c99b-4429-b0db-905fbe62bbce', 1, 2, 10, 'PRIME PACKING MATERIALS RTANDING', 'PPCI-00072', 'paid', 8000, 8000, 0.00, 0.00, 380.95, 'received', '2025-03-24 00:00:00', NULL, '2025-03-24 00:00:00', '2025-05-07 10:18:20', NULL),
(10, 'ce1175ac-6c4e-4cb0-bd72-e24009759551', 1, 2, 6, 'AL FAKHAMAH', '0723', 'paid', 300, 300, 0.00, 0.00, 14.28, 'received', '2025-04-02 00:00:00', NULL, '2025-04-02 00:00:00', '2025-05-07 10:23:01', NULL),
(11, '95d2cb87-08e1-4ebc-9a41-bbd22a40e94c', 1, 2, 11, 'SUN SHINE ARTIFACTS', '150425', 'paid', 4500, 4500, 0.00, 0.00, 214.28, 'received', '2025-04-17 00:00:00', NULL, '2025-04-17 00:00:00', '2025-05-07 10:45:37', NULL),
(12, '2045eb7a-8bee-4045-a52e-e997f1e39f5f', 1, 2, 5, 'BIN TAMAM', '0021627', 'un_paid', 603, 0, 0.00, 0.00, 28.71, 'pending', '2025-04-15 00:00:00', NULL, '2025-04-15 00:00:00', '2025-05-07 10:54:25', NULL),
(13, '913ca684-608f-49f5-87c6-0266e95af3a6', 1, 2, 5, 'BIN TAMAM', '0020109', 'paid', 53.6, 53.6, 0.00, 0.00, 2.55, 'received', '2025-03-14 00:00:00', NULL, '2025-03-14 00:00:00', '2025-05-07 10:59:30', NULL),
(14, 'd7a8b385-4fd8-4df1-a1fa-ceba042d3f4c', 1, 2, 12, 'SMELL & SMILE', '3285', 'paid', 50, 50, 0.00, 0.00, 2.38, 'received', '2025-03-01 00:00:00', NULL, '2025-03-01 00:00:00', '2025-05-07 11:05:05', NULL),
(15, '14bd78c8-5f17-40af-b966-6e1450d01c1e', 1, 2, 1, 'SKYLINE', '08142', 'un_paid', 1250, 0, 0.00, 0.00, 59.52, 'received', '2025-03-26 00:00:00', NULL, '2025-03-26 00:00:00', '2025-05-07 17:44:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_items`
--

CREATE TABLE `purchase_order_items` (
  `id` int NOT NULL,
  `purchase_id` int UNSIGNED DEFAULT NULL,
  `item_id` int UNSIGNED DEFAULT NULL,
  `price_id` int DEFAULT NULL,
  `product_name` varchar(225) DEFAULT NULL,
  `qty` int DEFAULT '0',
  `unit_price` decimal(9,2) DEFAULT NULL,
  `total_amount` decimal(9,2) DEFAULT NULL,
  `discount` decimal(13,2) NOT NULL DEFAULT '0.00',
  `tax` decimal(9,2) DEFAULT NULL,
  `tax_amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `purchase_order_items`
--

INSERT INTO `purchase_order_items` (`id`, `purchase_id`, `item_id`, `price_id`, `product_name`, `qty`, `unit_price`, `total_amount`, `discount`, `tax`, `tax_amount`) VALUES
(1, 1, 565, 597, 'BUKHOOR JAR MINI 50 GM', 120, 1.08, 130.00, 0.00, 5.00, 6.19),
(2, 2, 564, 596, 'GLASS REAGENT BOTTLE 3000 ML', 5, 60.00, 300.00, 0.00, 5.00, 14.29),
(3, 2, 563, 595, 'MAGNATIC STIRRE BAR C10*35', 5, 15.00, 75.00, 0.00, 5.00, 3.57),
(4, 3, 556, 588, 'BEAKER 250 ML', 1, 8.00, 8.00, 0.00, 5.00, 0.38),
(5, 3, 557, 589, 'BEAKER 500 ML', 1, 12.00, 12.00, 0.00, 5.00, 0.57),
(6, 3, 558, 590, 'BEAKER 50 ML', 2, 4.00, 8.00, 0.00, 5.00, 0.38),
(7, 3, 559, 591, 'PLASTIC FUNNEL', 4, 1.00, 4.00, 0.00, 5.00, 0.19),
(8, 3, 560, 592, 'WASH BOTTLE 1000 ML', 1, 13.00, 13.00, 0.00, 5.00, 0.62),
(9, 3, 561, 593, 'WASH BOTTLE 500 ML', 1, 8.00, 8.00, 0.00, 5.00, 0.38),
(10, 4, 553, 585, 'box reval maroun', 1800, 1.50, 2700.00, 0.00, 5.00, 128.57),
(11, 5, 572, 604, 'BAG A4', 500, 2.70, 1350.00, 0.00, 5.00, 64.29),
(12, 5, 569, 601, 'BOX BOUKHOOR', 100, 2.00, 200.00, 0.00, 5.00, 9.52),
(13, 5, 570, 602, 'BOX OUD', 100, 2.00, 200.00, 0.00, 5.00, 9.52),
(14, 5, 571, 603, 'BOX AIR FRESHNER', 100, 3.50, 350.00, 0.00, 5.00, 16.67),
(15, 5, 553, 585, 'box reval maroun', 500, 1.50, 750.00, 0.00, 5.00, 35.71),
(16, 6, 433, 465, 'sample quintity', 200, 1.00, 200.00, 0.00, 5.00, 9.52),
(17, 7, 564, 596, 'GLASS REAGENT BOTTLE 3000 ML', 8, 60.00, 480.00, 0.00, 5.00, 22.86),
(18, 7, 573, 605, 'GLASS REAGENT BOTTLE 5000 ML', 2, 100.00, 200.00, 0.00, 5.00, 9.52),
(19, 7, 574, 606, 'JAR GLASS WITH HAND 1000 ML', 1, 20.00, 20.00, 0.00, 5.00, 0.95),
(20, 7, 563, 595, 'MAGNATIC STIRRE BAR C10*35', 5, 10.00, 50.00, 0.00, 5.00, 2.38),
(21, 7, 575, 607, 'PLASTIC WASH BOTTLE 1.2 LTR', 2, 10.00, 20.00, 0.00, 5.00, 0.95),
(22, 7, 576, 608, 'MIXER 500', 4, 140.00, 560.00, 0.00, 5.00, 26.67),
(23, 8, 357, 389, 'OUD KHAM', 4, 315.00, 1260.00, 0.00, 5.00, 60),
(24, 9, 577, 609, 'CELLPHONE CUTTING MANUAL WRAPPING MACHINE', 1, 3300.00, 3300.00, 0.00, 5.00, 157.14),
(25, 9, 578, 610, 'MANUAL CRIMPING MACHINE', 1, 1400.00, 1400.00, 0.00, 5.00, 66.67),
(26, 9, 579, 611, 'PNENUMATIC CRIMPING MACHINE', 1, 3300.00, 3300.00, 0.00, 5.00, 157.14),
(27, 10, 580, 612, 'OIL STEACKER', 500, 0.50, 250.00, 0.00, 5.00, 11.9),
(28, 10, 581, 613, 'KG BUKHOOR STEACKER', 100, 0.50, 50.00, 0.00, 5.00, 2.38),
(29, 11, 582, 614, 'COLOR BOTTLE 1 COLOR', 1800, 1.25, 2250.00, 0.00, 5.00, 107.14),
(30, 11, 583, 615, 'PRINT LOGO', 1800, 1.25, 2250.00, 0.00, 5.00, 107.14),
(31, 12, 584, 616, 'OIL MARVO', 1, 578.00, 578.00, 0.00, 5.00, 27.52),
(32, 12, 434, 466, 'DELIVERY CHARGE', 1, 25.00, 25.00, 0.00, 5.00, 1.19),
(33, 13, 433, 465, 'sample quintity', 4, 13.40, 53.60, 0.00, 5.00, 2.55),
(34, 14, 433, 465, 'sample quintity', 10, 5.00, 50.00, 0.00, 5.00, 2.38),
(35, 15, 453, 485, 'CAP REVAL GOLD', 625, 1.00, 625.00, 0.00, 5.00, 29.76),
(36, 15, 470, 502, 'CAP REVAL BLACK', 625, 1.00, 625.00, 0.00, 5.00, 29.76);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_pay_log`
--

CREATE TABLE `purchase_pay_log` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `purchase_id` bigint UNSIGNED NOT NULL,
  `payment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_pay_log`
--

INSERT INTO `purchase_pay_log` (`id`, `branch_id`, `purchase_id`, `payment_type`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'cash', 130, '2025-05-05 12:41:50', NULL, NULL),
(2, 1, 2, 'cash', 375, '2025-05-05 12:51:20', NULL, NULL),
(3, 1, 3, 'cash', 53, '2025-05-05 12:58:19', NULL, NULL),
(4, 1, 4, 'cash', 2700, '2025-05-05 16:18:30', NULL, NULL),
(5, 1, 7, 'card', 1330, '2025-05-07 10:08:10', NULL, NULL),
(6, 1, 6, 'cash', 200, '2025-05-07 10:08:49', NULL, NULL),
(7, 1, 8, 'cash', 1260, '2025-05-07 10:09:01', NULL, NULL),
(8, 1, 9, 'cash', 8000, '2025-05-07 10:18:20', NULL, NULL),
(9, 1, 10, 'cash', 300, '2025-05-07 10:23:01', NULL, NULL),
(10, 1, 11, 'cash', 4500, '2025-05-07 10:45:28', NULL, NULL),
(11, 1, 13, 'cash', 35.6, '2025-05-07 10:59:10', NULL, NULL),
(12, 1, 13, 'cash', 18, '2025-05-07 10:59:21', NULL, NULL),
(13, 1, 14, 'cash', 50, '2025-05-07 11:04:54', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_orders`
--

CREATE TABLE `sale_orders` (
  `id` int NOT NULL,
  `uuid` char(36) NOT NULL,
  `company_id` int DEFAULT NULL,
  `receipt_id` varchar(250) NOT NULL,
  `user_id` int NOT NULL,
  `shop_id` int NOT NULL,
  `customer_uuid` char(36) DEFAULT NULL,
  `customer_id` int NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `customer_number` varchar(50) DEFAULT NULL,
  `customer_address` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `customer_email` varchar(225) DEFAULT NULL,
  `customer_gender` varchar(16) DEFAULT NULL,
  `customer_trn` varchar(100) DEFAULT NULL,
  `order_type` enum('counter_sale','delivery','dine_in','take_away','website_order','free_sale') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `payment_type` text,
  `card_num` int DEFAULT NULL,
  `payment_status` enum('paid','unpaid') NOT NULL,
  `discount` float NOT NULL DEFAULT '0',
  `discount_per` double DEFAULT NULL,
  `amount_given` float DEFAULT NULL,
  `balance_amount` float DEFAULT NULL,
  `status` enum('pending','conform','out_for_delivery','delivered','reject','hold') NOT NULL,
  `remarks` text,
  `delivered_in` varchar(100) DEFAULT NULL,
  `reject_reason` text,
  `driver_id` int DEFAULT NULL,
  `staff_id` int DEFAULT NULL,
  `ordered_date` datetime NOT NULL,
  `paid_date` datetime DEFAULT NULL,
  `vat` int DEFAULT NULL,
  `date_time` varchar(225) DEFAULT NULL,
  `without_tax` varchar(50) NOT NULL,
  `tax_amount` varchar(50) NOT NULL,
  `with_tax` varchar(50) NOT NULL,
  `edit_staff_id` int DEFAULT NULL,
  `active` varchar(5) DEFAULT '1',
  `reason` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_orders`
--

INSERT INTO `sale_orders` (`id`, `uuid`, `company_id`, `receipt_id`, `user_id`, `shop_id`, `customer_uuid`, `customer_id`, `customer_name`, `customer_number`, `customer_address`, `customer_email`, `customer_gender`, `customer_trn`, `order_type`, `payment_type`, `card_num`, `payment_status`, `discount`, `discount_per`, `amount_given`, `balance_amount`, `status`, `remarks`, `delivered_in`, `reject_reason`, `driver_id`, `staff_id`, `ordered_date`, `paid_date`, `vat`, `date_time`, `without_tax`, `tax_amount`, `with_tax`, `edit_staff_id`, `active`, `reason`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'd76a0bda-1725-41ce-9c25-c589bc6e1099', NULL, 'INV-1-3-1', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-23 14:21:26', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-04-23 14:21:26', NULL, NULL),
(2, '9b28ec9c-8981-4332-9d0c-634fdb0f2f11', NULL, 'INV-1-3-2', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-23 19:26:41', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-04-23 19:26:41', NULL, NULL),
(3, '43977f5e-3bd4-472f-abd7-4c1b9ab2753b', NULL, 'INV-1-3-3', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-23 23:02:06', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-04-23 23:02:06', NULL, NULL),
(4, '2eed6b79-d3ce-415c-9463-9d40966cc529', NULL, 'INV-1-3-4', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-24 18:48:32', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-04-24 18:48:32', NULL, NULL),
(5, '4644b4b2-b580-4816-a04f-c60d78090796', NULL, 'INV-1-3-5', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-24 19:44:58', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-04-24 19:44:58', NULL, NULL),
(6, '41f65893-7b47-4dda-b659-366c2708e90f', NULL, 'INV-1-3-6', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-24 20:09:37', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-04-24 20:09:37', NULL, NULL),
(7, '5098c6c1-e8b4-4e5b-94a8-baa4a91521f6', NULL, 'INV-1-3-7', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-24 20:11:18', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-04-24 20:11:18', NULL, NULL),
(8, 'd24f5f6e-9121-4a23-b9e1-e7c0bd1eaa19', NULL, 'INV-1-3-8', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-24 20:27:35', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-04-24 20:27:35', NULL, NULL),
(9, '27404fde-5286-4bb3-8bf0-f0bf84ad0b6b', NULL, 'INV-1-3-9', 3, 1, '86feda42-6c10-4b90-b10e-87271d231d58', 2, 'mohmad saed', '0565339054', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 150, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-24 22:49:19', NULL, 0, '', '150', '0', '150', NULL, '1', NULL, '2025-04-24 22:49:19', NULL, NULL),
(10, 'cd6d4fe4-f8e9-4f11-983b-f196c533234d', NULL, 'INV-1-3-10', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-25 17:44:02', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-04-25 17:44:02', NULL, NULL),
(11, '3bf51a56-76e5-49d2-8814-837645b3d794', NULL, 'INV-1-3-11', 3, 1, 'd6208f0d-5525-4707-a748-adfaaf679ca2', 3, '', '0503937771', 'fujirah murishiead', '', 'male', NULL, 'counter_sale', 'credit', 0, 'paid', 0, 0, 130, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-25 18:29:06', NULL, 0, '', '130', '0', '130', NULL, '1', NULL, '2025-04-25 18:29:06', NULL, NULL),
(12, '7276858b-5241-4f0f-a0f7-7789aa776433', NULL, 'INV-1-3-12', 3, 1, '5cfe5322-3527-4804-8a10-525d0aa8ec3f', 4, 'ahmad', '0569426876', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-25 22:05:46', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-04-25 22:05:46', NULL, NULL),
(13, 'b2050801-aef9-4360-be73-c33f6a9a19cb', NULL, 'INV-1-3-13', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-25 23:05:36', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-04-25 23:05:36', NULL, NULL),
(14, '8ae5f7a0-00c2-4304-b352-8117577492e4', NULL, 'INV-1-3-14', 3, 1, 'e0867dca-f879-4f9b-8444-0e1e8efb33b8', 5, 'mohamad', '0501441959', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-25 23:06:44', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-04-25 23:06:44', NULL, NULL),
(15, '05cde035-77d0-44d3-b0e2-f24f80b30474', NULL, 'INV-1-3-15', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 250, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-25 23:29:53', NULL, 0, '', '250', '0', '250', NULL, '1', NULL, '2025-04-25 23:29:53', NULL, NULL),
(16, '284501e7-bdeb-4808-9b6c-e56d6a2ddda0', NULL, 'INV-1-3-16', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 150, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-25 23:30:45', NULL, 0, '', '150', '0', '150', NULL, '1', NULL, '2025-04-25 23:30:45', NULL, NULL),
(17, '23992ec0-91e9-4697-bdd9-abb7277ca415', NULL, 'INV-1-3-17', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash,card', 0, 'paid', 0, 0, 250, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-26 09:49:54', NULL, 0, '', '250', '0', '250', NULL, '1', NULL, '2025-04-26 09:49:54', NULL, NULL),
(18, 'd0c546e2-1b8b-4043-8a5f-f8086d7fe01c', NULL, 'INV-1-3-18', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', '', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-26 18:34:10', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-04-26 18:34:10', NULL, NULL),
(19, '2a982941-e8a2-456c-8ee8-cf79e1e12dc7', NULL, 'INV-1-3-19', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', '', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-26 18:34:57', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-04-26 18:34:57', NULL, NULL),
(20, 'de77776a-ffb1-4a2f-b545-c7cab2bf7a79', NULL, 'INV-1-3-20', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', '', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-26 18:35:22', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-04-26 18:35:22', NULL, NULL),
(21, 'b1762a15-9f7e-42cc-9339-05b56e089ac0', NULL, 'INV-1-3-21', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-26 18:47:55', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-04-26 18:47:55', NULL, NULL),
(22, 'f766a8a7-c827-4475-b8a7-caeee4d1e74b', NULL, 'INV-1-3-22', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 200, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-26 18:50:33', NULL, 0, '', '200', '0', '200', NULL, '1', NULL, '2025-04-26 18:50:33', NULL, NULL),
(23, 'd54057f0-ab30-4a16-b7f0-c82dc70a70ce', NULL, 'INV-1-3-23', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-26 18:55:27', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-04-26 18:55:27', NULL, NULL),
(24, 'd8a11fcd-59a1-418b-a357-6db5faddebb0', NULL, 'INV-1-3-24', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 800, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-26 19:02:03', NULL, 0, '', '800', '0', '800', NULL, '1', NULL, '2025-04-26 19:02:03', NULL, NULL),
(25, '1c8e5f20-7417-47b8-8aa8-a514de4e127b', NULL, 'INV-1-3-25', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 250, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-26 19:04:59', NULL, 0, '', '250', '0', '250', NULL, '1', NULL, '2025-04-26 19:04:59', NULL, NULL),
(26, 'd1695907-daef-40c4-8508-212ac49e2e5f', NULL, 'INV-1-3-26', 3, 1, '0a2bff7a-a5a3-485f-a128-7c6b5ae0b301', 7, 'ABDULLAH ALBULUSHI', '0501070207', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-26 22:12:31', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-04-26 22:12:31', NULL, NULL),
(27, 'a65ff4d9-0122-4965-9968-06108c7b12fe', NULL, 'INV-1-3-27', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 350, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-26 23:28:57', NULL, 0, '', '350', '0', '350', NULL, '1', NULL, '2025-04-26 23:28:57', NULL, NULL),
(28, 'd72c6f02-4825-4876-8f31-997edd14bccb', NULL, 'INV-1-3-28', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-27 20:54:06', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-04-27 20:54:06', NULL, NULL),
(29, '091238c4-def8-45c4-bb45-16c3c459b243', NULL, 'INV-1-3-29', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-27 22:10:16', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-04-27 22:10:16', NULL, NULL),
(30, '06b39592-cf33-471d-9d6e-ff0b734d5232', NULL, 'INV-1-3-30', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-27 22:53:25', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-04-27 22:53:25', NULL, NULL),
(31, '6c02bcec-2a80-4f7c-9f07-7a19a982fdb5', NULL, 'INV-1-3-31', 3, 1, '8079994c-f6ca-4ac4-9091-39717c8ed004', 8, 'hamad alshiba', '0501771197', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 300, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-28 00:08:07', NULL, 0, '', '300', '0', '300', NULL, '1', NULL, '2025-04-28 00:08:07', NULL, NULL),
(32, '7f3c221d-5c70-44b4-a587-8efbfac0ffb4', NULL, 'INV-1-3-32', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-28 14:02:26', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-04-28 14:02:26', NULL, NULL),
(33, '22d24a36-73bd-405d-b3ff-9291a3f91300', NULL, 'INV-1-3-33', 3, 1, 'b1173fbe-a66b-4ed5-bedc-c132f2b5a161', 6, 'ARNAB DELIVERY', '0508262720', '', '', 'male', NULL, 'counter_sale', 'credit', 0, 'paid', 30, 0, 250, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-28 17:15:12', NULL, 0, '', '280', '0', '250', NULL, '1', NULL, '2025-04-28 17:15:12', NULL, NULL),
(34, '5458c9b2-9b26-41e2-a12e-72d2ca4de2dd', NULL, 'INV-1-3-34', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-28 17:48:52', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-04-28 17:48:52', NULL, NULL),
(35, '60b19f90-cff9-42ed-9190-55686b051d11', NULL, 'INV-1-3-35', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-28 22:43:02', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-04-28 22:43:02', NULL, NULL),
(36, 'b6d92838-3abf-4f8e-81d6-c6167140279d', NULL, 'INV-1-3-36', 3, 1, 'e3fc7b23-6d70-49a3-b4e9-49686f9aefa0', 9, 'salim obaid', '0566073791', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 150, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-28 23:02:20', NULL, 0, '', '150', '0', '150', NULL, '1', NULL, '2025-04-28 23:02:20', NULL, NULL),
(37, '62e21a27-b3b8-4464-ba74-bdce58f45bbe', NULL, 'INV-1-3-37', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-29 17:14:26', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-04-29 17:14:26', NULL, NULL),
(38, '1ecc8625-eec0-438a-a552-f887beb31b7d', NULL, 'INV-1-3-38', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-29 20:13:45', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-04-29 20:13:45', NULL, NULL),
(39, '1f236c0d-1d17-4757-95dd-084f4f7ab19f', NULL, 'INV-1-3-39', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-29 20:19:06', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-04-29 20:19:06', NULL, NULL),
(40, '203dbe35-1919-4fbe-b93a-dca864fcf186', NULL, 'INV-1-3-40', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 350, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-29 20:30:03', NULL, 0, '', '350', '0', '350', NULL, '1', NULL, '2025-04-29 20:30:03', NULL, NULL),
(41, '2c9764aa-d950-4c0f-80d8-cc9e4806d21b', NULL, 'INV-1-3-41', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-29 21:25:12', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-04-29 21:25:12', NULL, NULL),
(42, '8693bcb6-ae0b-4575-be0c-756860606470', NULL, 'INV-1-3-42', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-29 21:53:31', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-04-29 21:53:31', NULL, NULL),
(43, '5998beaa-4230-4145-92db-d4fb179aa081', NULL, 'INV-1-3-43', 3, 1, 'b1173fbe-a66b-4ed5-bedc-c132f2b5a161', 6, 'ARNAB DELIVERY', '0508262720', '', '', 'male', NULL, 'counter_sale', 'credit', 0, 'paid', 30, 0, 300, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-30 15:43:32', NULL, 0, '', '330', '0', '300', NULL, '1', NULL, '2025-04-30 15:43:32', NULL, NULL),
(44, 'b4b97a59-c219-4702-89cc-c7855431559c', NULL, 'INV-1-3-44', 3, 1, 'b1173fbe-a66b-4ed5-bedc-c132f2b5a161', 6, 'ARNAB DELIVERY', '0508262720', '', '', 'male', NULL, 'counter_sale', 'credit', 0, 'paid', 0, 0, 130, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-30 15:47:11', NULL, 0, '', '130', '0', '130', NULL, '1', NULL, '2025-04-30 15:47:11', NULL, NULL),
(45, '9c05aa78-8382-48c5-a41c-69e81ad707c5', NULL, 'INV-1-3-45', 3, 1, 'f3bf0313-ac49-48c3-af93-dacef3ed48bb', 10, 'ABU MAKTOUM', '0561196040', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-30 19:57:54', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-04-30 19:57:54', NULL, NULL),
(46, '72153101-277c-4358-9005-71d71a0cab55', NULL, 'INV-1-3-46', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 450, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-30 21:35:29', NULL, 0, '', '450', '0', '450', NULL, '1', NULL, '2025-04-30 21:35:29', NULL, NULL),
(47, 'fa9d06cb-b614-4948-ac9a-13374a6e1f03', NULL, 'INV-1-3-47', 3, 1, 'fe0bb2eb-0f18-465a-b994-64942a8a78a9', 11, 'ALI ,,,', '0522366365', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 150, 0, 'pending', '', NULL, NULL, 0, 0, '2025-04-30 21:46:50', NULL, 0, '', '150', '0', '150', NULL, '1', NULL, '2025-04-30 21:46:50', NULL, NULL),
(48, '56495bf0-db2b-4193-8dab-bcb22c7783ad', NULL, 'INV-1-3-48', 3, 1, '2298a1ef-7c3d-4825-a307-e97041456aac', 12, 'mohsen', '0529800157', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-01 13:03:45', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-05-01 13:03:45', NULL, NULL),
(49, 'fce60f42-6190-42dc-b81d-1d49566941ff', NULL, 'INV-1-3-49', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-01 13:08:28', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-01 13:08:28', NULL, NULL),
(50, 'fa8d3c2c-e56d-4881-8b29-4251474b1583', NULL, 'INV-1-3-50', 3, 1, 'bbd4aea2-3c2c-4199-ba09-410890c760dd', 13, 'faheem', '0567980994', '', '', '', NULL, 'delivery', 'credit', 0, 'paid', 0, 0, 51.5, 0, 'delivered', '', NULL, NULL, 1, 0, '2025-05-01 18:25:05', NULL, 0, '', '51.5', '0', '51.5', NULL, '1', 'test', '2025-05-01 18:25:05', '2025-05-01 18:30:06', '2025-05-01 18:30:06'),
(51, 'e4c8fbbd-e954-440b-99bf-42de4b8e670e', NULL, 'INV-1-3-51', 3, 1, 'bbd4aea2-3c2c-4199-ba09-410890c760dd', 13, 'faheem', '0567980994', '', '', '', NULL, 'delivery', 'credit', 0, 'paid', 0, 0, 101.5, 0, 'delivered', '', NULL, NULL, 1, 0, '2025-05-01 18:26:14', NULL, 0, '', '101.5', '0', '101.5', NULL, '1', 'test', '2025-05-01 18:26:14', '2025-05-01 18:29:57', '2025-05-01 18:29:57'),
(52, 'd5d57604-e493-4edc-8569-327bccb34b9e', NULL, 'INV-1-3-50', 3, 1, '35f31299-c3aa-450e-93c2-b25fb34610f1', 14, 'hade', '0589714499', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 150, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-01 18:36:39', NULL, 0, '', '150', '0', '150', NULL, '1', NULL, '2025-05-01 18:36:39', NULL, NULL),
(53, '7f117162-8ac8-4ff0-9629-58247f9ab2a2', NULL, 'INV-1-3-51', 3, 1, '6836ab46-1fc7-48c2-be2d-8794c9ad63f5', 15, 'youness', '0502522077', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 150, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-01 19:04:11', NULL, 0, '', '150', '0', '150', NULL, '1', NULL, '2025-05-01 19:04:11', NULL, NULL),
(54, '4a8ae21f-7476-45cf-bd88-4b6b6ac98ad5', NULL, 'INV-1-3-52', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-01 19:06:00', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-01 19:06:00', NULL, NULL),
(55, '6c39ac18-36a0-42f7-9264-4abdf7f28a47', NULL, 'INV-1-3-53', 3, 1, 'fed9af2d-319a-4114-818e-fce141c452ce', 16, 'shay shay kgg', '0556969518', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-01 20:40:26', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-01 20:40:26', NULL, NULL),
(56, '66ee177b-6743-4aee-a23e-7ad8a0b69b08', NULL, 'INV-1-3-54', 3, 1, '4e1bb79f-d91c-4a37-a1c8-678a8ae7d007', 17, 'majeed', '0559114001', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 200, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-01 20:50:14', NULL, 0, '', '200', '0', '200', NULL, '1', NULL, '2025-05-01 20:50:14', NULL, NULL),
(57, '04e0e1e0-b2bc-4168-9401-9121bc39ed11', NULL, 'INV-1-3-55', 3, 1, 'a306dc56-beff-48a1-8354-4afb37bea37d', 18, '', '0551995664', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 200, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-01 20:51:42', NULL, 0, '', '200', '0', '200', NULL, '1', NULL, '2025-05-01 20:51:42', NULL, NULL),
(58, '262f6984-f640-4337-86e0-f12295fe72a3', NULL, 'INV-1-3-56', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-01 21:47:14', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-05-01 21:47:14', NULL, NULL),
(59, 'aee08e1e-d698-4473-b503-cad4691e2115', NULL, 'INV-1-3-57', 3, 1, '8a9800d2-94ce-4691-b630-d8de134dfb2a', 19, 'mohamed', '0528911292', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-01 22:25:05', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-05-01 22:25:05', NULL, NULL),
(60, 'f840f2dd-de94-4e4d-8e54-ea54a1e224a5', NULL, 'INV-1-3-58', 3, 1, 'ef5ba40c-c260-40c4-9af2-adc6d0129088', 20, 'hassan', '0528606050', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 150, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-01 23:06:09', NULL, 0, '', '150', '0', '150', NULL, '1', NULL, '2025-05-01 23:06:09', NULL, NULL),
(61, '343cf09b-f003-4378-b2a6-7dda5269455b', NULL, 'INV-1-3-59', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-02 19:50:01', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-05-02 19:50:01', NULL, NULL),
(62, 'd7aba066-06ce-4a1f-ae47-e64e6126b2e2', NULL, 'INV-1-3-60', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-02 19:57:59', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-05-02 19:57:59', NULL, NULL),
(63, '09de31ab-c3e0-4467-9a1a-73ec8d301461', NULL, 'INV-1-3-61', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-02 21:37:03', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-02 21:37:03', NULL, NULL),
(64, '41e538b7-456c-451a-971b-54e4c4dd7d13', NULL, 'INV-1-3-62', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-02 21:38:00', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-02 21:38:00', NULL, NULL),
(65, 'cf20b933-0c4c-443a-a7e3-1adac74597e7', NULL, 'INV-1-3-63', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 300, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-03 15:54:57', NULL, 0, '', '300', '0', '300', NULL, '1', NULL, '2025-05-03 15:54:57', NULL, NULL),
(66, '9bcc5b44-42b4-4878-87d1-057b20d75e84', NULL, 'INV-1-3-64', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 164, -14, 'pending', '', NULL, NULL, 0, 0, '2025-05-03 19:08:58', NULL, 0, '', '150', '0', '150', NULL, '1', 'im test', '2025-05-03 19:08:58', '2025-05-03 19:09:30', '2025-05-03 19:09:30'),
(67, '569ebcc1-0b66-4d77-9558-42aee09ea524', NULL, 'INV-1-3-64', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-03 19:18:09', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-05-03 19:18:09', NULL, NULL),
(68, 'b0a779e8-2454-455a-a1e6-f0dedd9b8194', NULL, 'INV-1-3-65', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 150, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-03 19:20:01', NULL, 0, '', '150', '0', '150', NULL, '1', NULL, '2025-05-03 19:20:01', NULL, NULL),
(69, '82627a95-2a47-4bf1-a93f-87a2fe4c987f', NULL, 'INV-1-3-66', 3, 1, '94cfbf41-4162-4be2-92c9-cf2c24ba68e5', 21, 'muasood', '0509599908', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 300, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-03 21:17:46', NULL, 0, '', '300', '0', '300', NULL, '1', 'im abdullah cpustemer', '2025-05-03 21:17:46', '2025-05-03 21:24:22', '2025-05-03 21:24:22'),
(70, '9352e2b3-845a-48a1-9e56-a736750e7137', NULL, 'INV-1-3-67', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-03 21:23:30', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-03 21:23:30', NULL, NULL),
(71, 'e2ed1bc8-686d-4687-86f5-c33e4f28d917', NULL, 'INV-1-4-1', 4, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 164, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-03 21:54:03', NULL, 0, '', '164', '0', '164', NULL, '1', NULL, '2025-05-03 21:54:03', NULL, NULL),
(72, '3ee0d2ed-8070-4300-936c-292e8220f77b', NULL, 'INV-1-3-68', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-03 22:27:49', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-05-03 22:27:49', NULL, NULL),
(73, '2217acf1-5cd2-42b5-b951-f45bf3c8e43f', NULL, 'INV-1-3-69', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-04 17:33:32', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-05-04 17:33:32', NULL, NULL),
(74, '55ccc7bd-3883-4b5f-b185-6c8cc93e68f7', NULL, 'INV-1-3-70', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-04 17:34:19', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-05-04 17:34:19', NULL, NULL),
(75, '3e87cc3b-80b2-4cd3-813b-93db3d14c106', NULL, 'INV-1-3-71', 3, 1, 'b83ad8cd-4e60-4353-83b3-59f1b65d5078', 22, 'khalid', '0567440006', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 50, 0, 550, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-04 19:15:42', NULL, 0, '', '600', '0', '550', NULL, '1', NULL, '2025-05-04 19:15:42', NULL, NULL),
(76, '9a7fa7cd-4d75-46a7-a216-2202bbec5885', NULL, 'INV-1-3-72', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 150, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-04 19:44:41', NULL, 0, '', '150', '0', '150', NULL, '1', NULL, '2025-05-04 19:44:41', NULL, NULL),
(77, '324d33f5-2bb5-4355-b2c4-2fdaa4b70c41', NULL, 'INV-1-3-73', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 150, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-04 21:36:05', NULL, 0, '', '150', '0', '150', NULL, '1', NULL, '2025-05-04 21:36:05', NULL, NULL),
(78, '10f18691-5573-4496-8c8c-a497d8bb3a69', NULL, 'INV-1-3-74', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-04 23:10:13', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-05-04 23:10:13', NULL, NULL),
(79, '72d360ff-adcf-4e67-86e0-186b9f1e92e3', NULL, 'INV-1-3-75', 3, 1, '1cb39134-1552-4b18-89d7-d84fa3508ae7', 23, 'mohamed gul', '0581443320', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-05 18:43:09', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-05-05 18:43:09', NULL, NULL),
(80, 'a675d0f9-9ff3-4f18-97c8-5a0623e7cca1', NULL, 'INV-1-3-76', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-05 18:43:22', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-05 18:43:22', NULL, NULL),
(81, '7184038c-51ab-47d0-aa3a-487f5403c8d3', NULL, 'INV-1-3-77', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 250, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-06 13:55:13', NULL, 0, '', '250', '0', '250', NULL, '1', NULL, '2025-05-06 13:55:13', NULL, NULL),
(82, '8aca6fe4-b185-4a78-8091-9b657f675701', NULL, 'INV-1-3-78', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 5, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-06 16:12:33', NULL, 0, '', '5', '0', '5', NULL, '1', NULL, '2025-05-06 16:12:33', NULL, NULL),
(83, 'bf210961-0f16-4256-8084-fef8890bf007', NULL, 'INV-1-3-79', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-06 21:50:03', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-06 21:50:03', NULL, NULL),
(84, '825cdc4b-3594-49fe-80ec-4a5c8a1e2d23', NULL, 'INV-1-3-80', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-06 23:05:52', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-06 23:05:52', NULL, NULL),
(85, '3cbb570e-e2f1-4133-990e-2e4985d6cb1d', NULL, 'INV-1-3-81', 3, 1, 'f888750e-d3aa-4b9c-a7b4-c715f21506b7', 24, 'smael', '0506782866', 'sawede', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 150, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-07 20:26:01', NULL, 0, '', '150', '0', '150', NULL, '1', NULL, '2025-05-07 20:26:01', NULL, NULL),
(86, '0a143c2d-a918-4419-b92e-fd27c6e17463', NULL, 'INV-1-3-82', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 150, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-07 22:50:08', NULL, 0, '', '150', '0', '150', NULL, '1', NULL, '2025-05-07 22:50:08', NULL, NULL),
(87, 'af4c3e6b-73b2-4f0f-a3ab-377d56cb63bd', NULL, 'INV-1-3-83', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-08 17:34:40', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-08 17:34:40', NULL, NULL),
(88, 'd974cb69-bff8-4222-a634-90f7cc95b0b8', NULL, 'INV-1-3-84', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-08 20:34:37', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-08 20:34:37', NULL, NULL),
(89, '8babe191-0389-4aae-ace8-7d9688da976d', NULL, 'INV-1-3-85', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash,card', 0, 'paid', 0, 0, 150, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-08 23:56:46', NULL, 0, '', '150', '0', '150', NULL, '1', NULL, '2025-05-08 23:56:46', NULL, NULL),
(90, 'db81ce0c-21c8-4d58-94ab-82a7350bc1a9', NULL, 'INV-1-3-86', 3, 1, '2d5dac90-e117-4766-a17f-13868cb77856', 25, 'ali', '05592565430', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-09 18:09:29', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-09 18:09:29', NULL, NULL),
(91, 'a5d55bd7-e86a-4fde-8b75-4895985a2db8', NULL, 'INV-1-3-87', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-09 18:33:03', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-05-09 18:33:03', NULL, NULL),
(92, 'd4b467a4-a967-499c-9c1c-91f9f65e1ca3', NULL, 'INV-1-3-88', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-09 18:33:47', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-09 18:33:47', NULL, NULL),
(93, '86fa0f36-fe2d-422d-a0d8-38ae1344dc63', NULL, 'INV-1-3-89', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-09 20:50:10', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-09 20:50:10', NULL, NULL),
(94, '8578ceff-72c7-4d42-bf07-f61c938269bf', NULL, 'INV-1-3-90', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-09 21:23:06', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-09 21:23:06', NULL, NULL),
(95, 'f6cb24ad-9e1a-48a6-aa31-4f04c7592700', NULL, 'INV-1-3-91', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-10 20:29:54', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-10 20:29:54', NULL, NULL),
(96, 'f604e2e0-4c24-4e32-9ffb-4d77ba960cf8', NULL, 'INV-1-3-92', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 200, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-10 21:31:24', NULL, 0, '', '200', '0', '200', NULL, '1', NULL, '2025-05-10 21:31:24', NULL, NULL),
(97, '4aef1638-19da-43eb-bb1f-fa6b81c69cb7', NULL, 'INV-1-3-93', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-11 20:32:58', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-11 20:32:58', NULL, NULL),
(98, '65a52206-cf6a-47d6-bba8-801a6da53043', NULL, 'INV-1-3-94', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-11 21:06:06', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-05-11 21:06:06', NULL, NULL),
(99, '5143913d-5616-4c99-bed6-19d4759e118f', NULL, 'INV-1-3-95', 3, 1, '0cfe13f3-ab2b-405f-a8cf-0b063f34096f', 26, 'hmdan', '0506663544', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 150, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-11 21:39:57', NULL, 0, '', '150', '0', '150', NULL, '1', NULL, '2025-05-11 21:39:57', NULL, NULL),
(100, '160664dd-e997-4e12-932f-00cf20584144', NULL, 'INV-1-3-96', 3, 1, '519261fb-d2c4-4d14-9b79-3f0b4c931506', 27, 'nabel alhutami', '0526661154', '', '', '', NULL, 'delivery', 'credit', 0, 'paid', 30, 0, 250, 0, 'pending', '', NULL, NULL, 1, 0, '2025-05-12 14:08:09', NULL, 0, '', '280', '0', '250', NULL, '1', NULL, '2025-05-12 14:08:09', NULL, NULL),
(101, 'b22c33eb-0486-4d54-97a0-5f80d324cf18', NULL, 'INV-1-3-97', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 50, 0, 250, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-12 17:26:15', NULL, 0, '', '300', '0', '250', NULL, '1', NULL, '2025-05-12 17:26:15', NULL, NULL),
(102, 'ece750fc-eb6a-4eae-aa06-98c7dfb80ff7', NULL, 'INV-1-3-98', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-12 19:30:10', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-05-12 19:30:10', NULL, NULL),
(103, '4612c688-62e0-4e7d-b1ec-e3d32c450d87', NULL, 'INV-1-3-99', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 50, 0, 250, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-12 19:42:26', NULL, 0, '', '300', '0', '250', NULL, '1', NULL, '2025-05-12 19:42:26', NULL, NULL),
(104, '669fcf5d-74bb-40a0-876b-0a00dcf7c140', NULL, 'INV-1-3-100', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-13 19:22:16', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-13 19:22:16', NULL, NULL),
(105, '3dadb0c6-3f6f-4771-ba1f-bb5d9a901705', NULL, 'INV-1-3-101', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-13 19:23:01', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-13 19:23:01', NULL, NULL),
(106, '48993b88-0a9f-4027-81d4-9ca35d5c5617', NULL, 'INV-1-3-102', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-13 19:57:17', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-13 19:57:17', NULL, NULL),
(107, '62c7a776-ae48-445e-889d-c959265bac6f', NULL, 'INV-1-3-103', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-13 21:49:35', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-13 21:49:35', NULL, NULL),
(108, '0d083f28-bf63-43ee-b425-f5661da0775c', NULL, 'INV-1-3-104', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 150, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-13 21:52:03', NULL, 0, '', '150', '0', '150', NULL, '1', NULL, '2025-05-13 21:52:03', NULL, NULL),
(109, '18123c9c-5804-439e-ab4f-46e42088a554', NULL, 'INV-1-3-105', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-13 22:20:58', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-13 22:20:58', NULL, NULL),
(110, 'cbf4224a-f15a-4fee-a14a-04835f2a2c84', NULL, 'INV-1-3-106', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-14 14:52:04', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-14 14:52:04', NULL, NULL),
(111, 'b702c3a2-c61e-4f95-af77-b0c90cf3c66c', NULL, 'INV-1-3-107', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash,card', 0, 'paid', 0, 0, 150, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-14 20:49:44', NULL, 0, '', '150', '0', '150', NULL, '1', NULL, '2025-05-14 20:49:44', NULL, NULL),
(112, '79da3647-deb3-42de-bdc7-a4fc290e6bc5', NULL, 'INV-1-3-108', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-15 00:04:23', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-15 00:04:23', NULL, NULL),
(113, '67f8e1b4-2f6a-4b4a-9ccb-0d5f8896305f', NULL, 'INV-1-3-109', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-15 16:15:31', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-15 16:15:31', NULL, NULL),
(114, '2716419f-5053-43fa-85e6-5690a48a0503', NULL, 'INV-1-4-2', 4, 1, '5d5bee6e-da60-488c-bcec-43f5f61dfdbd', 28, 'im', '0509720635', '', '', '', NULL, 'counter_sale', 'credit,', 0, 'paid', 0, 0, 6.5, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-15 17:02:59', NULL, 0, '', '6.5', '0', '6.5', NULL, '1', 'test', '2025-05-15 17:02:59', '2025-05-15 17:07:59', '2025-05-15 17:07:59'),
(115, 'fc1b0806-7c05-4b74-a2d9-499f90d15a74', NULL, 'INV-1-4-2', 4, 1, '', 29, 'mmmmmm', '0505506803', '', '', '', NULL, 'counter_sale', 'cash,credit', 0, 'paid', 0, 0, 4.5, 4.5, 'pending', '', NULL, NULL, 0, 0, '2025-05-15 17:08:14', NULL, 0, '', '4.5', '0', '4.5', 0, '1', 'test', '2025-05-15 17:08:14', '2025-05-15 17:13:15', '2025-05-15 17:13:15'),
(116, 'd94b781a-3299-4049-929d-b9a3d3aeaa18', NULL, 'INV-1-4-2', 4, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 1575, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-15 19:48:25', NULL, 0, '', '1575', '0', '1575', NULL, '1', 'test', '2025-05-15 19:48:25', '2025-05-15 22:07:13', '2025-05-15 22:07:13'),
(117, '69af775b-665a-4ed3-98f1-8357e40361ab', NULL, 'INV-1-3-110', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-15 22:06:48', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-05-15 22:06:48', NULL, NULL),
(118, '4ba86341-5674-488b-be65-c1c208957f70', NULL, 'INV-1-3-111', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-16 17:56:15', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-16 17:56:15', NULL, NULL),
(119, '64587a1a-4587-41a6-aca6-9755e2373a55', NULL, 'INV-1-3-112', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-16 18:23:05', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-05-16 18:23:05', NULL, NULL),
(120, '3ee7865a-c7be-4355-b701-553bba495c53', NULL, 'INV-1-3-113', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-16 18:59:47', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-16 18:59:47', NULL, NULL),
(121, '3b77a783-86f6-4ef6-a6c4-1f1d756c6feb', NULL, 'INV-1-3-114', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 100, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-16 20:09:19', NULL, 0, '', '100', '0', '100', NULL, '1', NULL, '2025-05-16 20:09:19', NULL, NULL),
(122, '17f7824b-ffe9-431f-b3cd-a172af5339dd', NULL, 'INV-1-3-115', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 150, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-16 21:18:45', NULL, 0, '', '150', '0', '150', NULL, '1', NULL, '2025-05-16 21:18:45', NULL, NULL),
(123, '139e545d-1cbd-4552-85c3-fc32f11c3d5a', NULL, 'INV-1-3-116', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'cash', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-16 22:48:20', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-16 22:48:20', NULL, NULL),
(124, 'e97168ed-55bd-41ae-b3e4-329f86161104', NULL, 'INV-1-3-117', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 150, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-16 23:05:17', NULL, 0, '', '150', '0', '150', NULL, '1', NULL, '2025-05-16 23:05:17', NULL, NULL),
(125, '02a41274-1793-4c94-8227-3ffe7ad91918', NULL, 'INV-1-3-118', 3, 1, '05731af8-9f13-4400-8cb9-c43a68c116ff', 30, 'khamis', '0501844044', '', '', '', NULL, 'delivery', 'credit', 0, 'paid', 0, 0, 80, 0, 'pending', '', NULL, NULL, 1, 0, '2025-05-17 09:50:43', NULL, 0, '', '80', '0', '80', NULL, '1', NULL, '2025-05-17 09:50:43', NULL, NULL),
(126, 'b9b4986f-2f1e-4b3f-aa90-8524f19a8894', NULL, 'INV-1-3-119', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 150, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-17 10:32:51', NULL, 0, '', '150', '0', '150', NULL, '1', NULL, '2025-05-17 10:32:51', NULL, NULL),
(127, 'fb32425b-f361-4b8f-92f4-a86a278f97b6', NULL, 'INV-1-3-120', 3, 1, '', 0, '', '0', '', '', '', NULL, 'counter_sale', 'card', 0, 'paid', 0, 0, 50, 0, 'pending', '', NULL, NULL, 0, 0, '2025-05-17 11:14:37', NULL, 0, '', '50', '0', '50', NULL, '1', NULL, '2025-05-17 11:14:37', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_order_items`
--

CREATE TABLE `sale_order_items` (
  `id` int NOT NULL,
  `sale_order_id` int NOT NULL,
  `category_id` int NOT NULL,
  `item_id` int NOT NULL,
  `price_size_id` int NOT NULL,
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
  `tax_count` int NOT NULL,
  `active` varchar(5) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_order_items`
--

INSERT INTO `sale_order_items` (`id`, `sale_order_id`, `category_id`, `item_id`, `price_size_id`, `item_name`, `other_item_name`, `price`, `item_unit_price`, `discount_percent`, `discount_amount`, `item_discount`, `tax_without_price`, `cost_price`, `qty`, `total_price`, `notes`, `tax_percentage`, `tax_name`, `tax_amt`, `tax_amt_not_round`, `tax_type`, `tax_count`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 19, 19, 'avntus', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(2, 1, 2, 77, 77, 'THE WAY', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(3, 2, 2, 62, 62, 'master', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(4, 3, 2, 70, 70, 'Tahnoon', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(5, 4, 2, 41, 41, 'gres', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(6, 4, 2, 36, 36, 'oud zafran', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(7, 5, 4, 425, 457, 'hudson air freshner', NULL, '50.00', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(8, 5, 4, 425, 457, 'hudson air freshner', NULL, '50.00', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(9, 6, 2, 20, 20, 'garcoon', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(10, 6, 2, 78, 78, 'PINKY', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(11, 7, 8, 432, 464, 'qissa incence', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(12, 8, 2, 433, 465, 'sample quintity', NULL, '100', 100, 0, 0, 0, 100, NULL, 1, 100, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(13, 9, 2, 64, 64, 'GUILTY ELIXIR', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(14, 9, 2, 33, 33, 'la male ex', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(15, 9, 2, 9, 9, 'le belle', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(16, 10, 8, 432, 464, 'qissa incence', NULL, '50.00', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(17, 11, 2, 67, 67, '1990', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(18, 11, 2, 18, 18, 'akuya', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(19, 11, 2, 434, 466, 'DELIVERY CHARGE', NULL, '30', 30, 0, 0, 0, 30, NULL, 1, 30, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(20, 12, 2, 72, 72, 'FRUITY OUD', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(21, 12, 2, 70, 70, 'Tahnoon', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(22, 13, 2, 73, 73, 'L hebiscus', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(23, 13, 2, 80, 80, 'imagination', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(24, 14, 2, 80, 80, 'imagination', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(25, 14, 2, 73, 73, 'L hebiscus', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(26, 15, 4, 425, 457, 'hudson air freshner', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(27, 15, 2, 61, 61, 'scndal with him', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(28, 15, 2, 69, 69, 'TYGER', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(29, 15, 8, 429, 461, 'shay shay incence', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(30, 15, 2, 64, 64, 'GUILTY ELIXIR', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(31, 16, 2, 77, 77, 'THE WAY', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(32, 16, 2, 75, 75, 'OUD VANILLA', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(33, 16, 2, 21, 21, 'paradox', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(34, 17, 2, 80, 80, 'imagination', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(35, 17, 2, 38, 38, 'you leather', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(36, 17, 2, 22, 22, 'imperial', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(37, 17, 2, 81, 81, 'azaran', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(38, 17, 4, 425, 457, 'hudson air freshner', NULL, '50', 50, 0, 0, 0, 50, NULL, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(39, 18, 8, 429, 461, 'shay shay incence', NULL, '50.00', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(40, 19, 8, 429, 461, 'shay shay incence', NULL, '50.00', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(41, 20, 8, 429, 461, 'shay shay incence', NULL, '50.00', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(42, 21, 8, 429, 461, 'shay shay incence', NULL, '50.00', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(43, 22, 8, 432, 464, 'qissa incence', NULL, '50.00', 50, 0, 0, 0, 50, 0, 2, 100, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(44, 22, 8, 430, 462, 'shumukh incence', NULL, '50.00', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(45, 22, 8, 429, 461, 'shay shay incence', NULL, '50.00', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(46, 23, 2, 68, 68, 'milan', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(47, 23, 2, 64, 64, 'GUILTY ELIXIR', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(48, 24, 2, 77, 77, 'THE WAY', NULL, '50', 50, 0, 0, 0, 50, 50, 2, 100, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(49, 24, 2, 30, 30, 'idol', NULL, '50', 50, 0, 0, 0, 50, 50, 2, 100, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(50, 24, 4, 425, 457, 'hudson air freshner', NULL, '50', 50, 0, 0, 0, 50, 0, 2, 100, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(51, 24, 8, 428, 460, 'shay oud incence', NULL, '50.00', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(52, 24, 2, 37, 37, 'libr', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(53, 24, 2, 70, 70, 'Tahnoon', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(54, 24, 2, 72, 72, 'FRUITY OUD', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(55, 24, 2, 75, 75, 'OUD VANILLA', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(56, 24, 2, 80, 80, 'imagination', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(57, 24, 2, 81, 81, 'azaran', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(58, 24, 2, 13, 13, 'mis bloming', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(59, 24, 2, 76, 76, 'scandel women', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(60, 24, 2, 61, 61, 'scndal with him', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(61, 25, 2, 24, 24, 'althar', NULL, '50', 50, 0, 0, 0, 50, 1, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(62, 25, 8, 429, 461, 'shay shay incence', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(63, 25, 2, 23, 23, 'O20', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(64, 25, 2, 44, 44, 'baby powder', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(65, 25, 2, 80, 80, 'imagination', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(66, 26, 2, 18, 18, 'akuya', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(67, 26, 2, 68, 68, 'milan', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(68, 27, 4, 435, 467, 'LIBRE AIR FRESHNER', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(69, 27, 2, 44, 44, 'baby powder', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(70, 27, 2, 71, 71, 'Sheikh Abdullah', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(71, 27, 2, 75, 75, 'OUD VANILLA', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(72, 27, 2, 80, 80, 'imagination', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(73, 27, 2, 41, 41, 'gres', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(74, 27, 2, 55, 55, 'god girl', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(75, 28, 2, 548, 580, 'AROJA AHLAM', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(76, 29, 2, 36, 36, 'oud zafran', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(77, 29, 2, 30, 30, 'idol', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(78, 30, 2, 41, 41, 'gres', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(79, 31, 2, 30, 30, 'idol', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(80, 31, 8, 432, 464, 'qissa incence', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(81, 31, 2, 37, 37, 'libr', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(82, 31, 2, 67, 67, '1990', NULL, '50', 50, 0, 0, 0, 50, 50, 2, 100, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(83, 31, 4, 426, 458, 'the way air freshner', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(84, 32, 2, 77, 77, 'THE WAY', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(85, 33, 2, 69, 69, 'TYGER', NULL, '50', 44.64, 0, 5.36, 0, 50, 50, 1, 44.64, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(86, 33, 2, 68, 68, 'milan', NULL, '50', 44.64, 0, 5.36, 0, 50, 50, 1, 44.64, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(87, 33, 2, 66, 66, 'tahnoun  ex', NULL, '50', 44.64, 0, 5.36, 0, 50, 50, 1, 44.64, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(88, 33, 2, 72, 72, 'FRUITY OUD', NULL, '50', 44.64, 0, 5.36, 0, 50, 50, 1, 44.64, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(89, 33, 2, 23, 23, 'O20', NULL, '50', 44.64, 0, 5.36, 0, 50, 50, 1, 44.64, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(90, 33, 2, 434, 466, 'DELIVERY CHARGE', NULL, '30', 26.8, 0, 3.2, 0, 30, 0, 1, 26.8, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(91, 34, 2, 80, 80, 'imagination', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(92, 35, 2, 78, 78, 'PINKY', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(93, 35, 2, 76, 76, 'scandel women', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(94, 36, 2, 79, 79, 'invictus elixir', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(95, 36, 2, 77, 77, 'THE WAY', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(96, 36, 2, 20, 20, 'garcoon', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(97, 37, 2, 61, 61, 'scndal with him', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(98, 38, 2, 50, 50, 'taxedo', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(99, 39, 2, 21, 21, 'paradox', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(100, 40, 2, 15, 15, 'red tabaco', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(101, 40, 2, 59, 59, 'home intense', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(102, 40, 2, 71, 71, 'Sheikh Abdullah', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(103, 40, 2, 67, 67, '1990', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(104, 40, 2, 18, 18, 'akuya', NULL, '50', 50, 0, 0, 0, 50, 636.8072519084, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(105, 40, 2, 73, 73, 'L hebiscus', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(106, 40, 2, 28, 28, 'gullty absolute', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(107, 41, 2, 73, 73, 'L hebiscus', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(108, 42, 2, 70, 70, 'Tahnoon', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(109, 42, 8, 429, 461, 'shay shay incence', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(110, 43, 2, 78, 78, 'PINKY', NULL, '50', 45.45, 0, 4.55, 0, 50, 50, 1, 45.45, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(111, 43, 2, 77, 77, 'THE WAY', NULL, '50', 45.45, 0, 4.55, 0, 50, 50, 1, 45.45, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(112, 43, 2, 76, 76, 'scandel women', NULL, '50', 45.45, 0, 4.55, 0, 50, 50, 1, 45.45, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(113, 43, 2, 548, 580, 'AROJA AHLAM', NULL, '50', 45.45, 0, 4.55, 0, 50, 0, 1, 45.45, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(114, 43, 2, 75, 75, 'OUD VANILLA', NULL, '50', 45.45, 0, 4.55, 0, 50, 50, 1, 45.45, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(115, 43, 2, 42, 42, 'la lona', NULL, '50', 45.45, 0, 4.55, 0, 50, 50, 1, 45.45, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(116, 43, 2, 434, 466, 'DELIVERY CHARGE', NULL, '30', 27.3, 0, 2.7, 0, 30, 0, 1, 27.3, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(117, 44, 2, 73, 73, 'L hebiscus', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(118, 44, 2, 80, 80, 'imagination', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(119, 44, 2, 434, 466, 'DELIVERY CHARGE', NULL, '30', 30, 0, 0, 0, 30, 0, 1, 30, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(120, 45, 2, 71, 71, 'Sheikh Abdullah', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(121, 45, 2, 70, 70, 'Tahnoon', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(122, 46, 3, 358, 390, 'SHAY SHAY KG', NULL, '350.00', 350, 0, 0, 0, 350, 315, 1, 350, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(123, 46, 2, 79, 79, 'invictus elixir', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(124, 46, 2, 77, 77, 'THE WAY', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(125, 47, 2, 16, 16, 'insolnce', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(126, 47, 2, 44, 44, 'baby powder', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(127, 47, 2, 73, 73, 'L hebiscus', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(128, 48, 2, 50, 50, 'taxedo', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(129, 48, 2, 80, 80, 'imagination', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(130, 49, 2, 32, 32, 'coco', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(131, 50, 10, 7, 7, 'bumb', NULL, '1.50', 1.5, 0, 0, 0, 1.5, 1, 1, 1.5, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-01 18:30:06', '2025-05-01 18:30:06'),
(132, 50, 2, 12, 12, 'iris leather', NULL, '50.00', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-01 18:30:06', '2025-05-01 18:30:06'),
(133, 51, 10, 7, 7, 'bumb', NULL, '1.50', 1.5, 0, 0, 0, 1.5, 1, 1, 1.5, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-01 18:29:57', '2025-05-01 18:29:57'),
(134, 51, 2, 12, 12, 'iris leather', NULL, '50.00', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-01 18:29:57', '2025-05-01 18:29:57'),
(135, 51, 2, 13, 13, 'mis bloming', NULL, '50.00', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-01 18:29:57', '2025-05-01 18:29:57'),
(136, 52, 2, 18, 18, 'akuya', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(137, 52, 2, 74, 74, 'nsayeb', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(138, 52, 2, 81, 81, 'azaran', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(139, 53, 2, 552, 584, 'Y', NULL, '50', 50, 0, 0, 0, 50, 1.75, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(140, 53, 2, 80, 80, 'imagination', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(141, 53, 2, 64, 64, 'GUILTY ELIXIR', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(142, 54, 2, 64, 64, 'GUILTY ELIXIR', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(143, 55, 2, 13, 13, 'mis bloming', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(144, 56, 2, 64, 64, 'GUILTY ELIXIR', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(145, 56, 2, 20, 20, 'garcoon', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(146, 56, 2, 42, 42, 'la lona', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(147, 56, 8, 432, 464, 'qissa incence', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(148, 57, 2, 73, 73, 'L hebiscus', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(149, 57, 2, 72, 72, 'FRUITY OUD', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(150, 57, 2, 20, 20, 'garcoon', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(151, 57, 8, 432, 464, 'qissa incence', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(152, 58, 8, 432, 464, 'qissa incence', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(153, 58, 2, 58, 58, 'hudson', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(154, 59, 2, 72, 72, 'FRUITY OUD', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(155, 59, 2, 73, 73, 'L hebiscus', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(156, 60, 2, 75, 75, 'OUD VANILLA', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(157, 60, 2, 80, 80, 'imagination', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(158, 60, 2, 81, 81, 'azaran', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(159, 61, 2, 73, 73, 'L hebiscus', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(160, 61, 2, 68, 68, 'milan', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(161, 62, 2, 68, 68, 'milan', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(162, 62, 2, 79, 79, 'invictus elixir', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(163, 63, 2, 77, 77, 'THE WAY', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(164, 64, 2, 79, 79, 'invictus elixir', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(165, 65, 2, 433, 465, 'sample quintity', NULL, '300', 300, 0, 0, 0, 300, 0, 1, 300, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(166, 66, 6, 228, 260, 'OIL MILANO', NULL, '1500', 1500, 0, 0, 0, 1500, 880, 0.1, 150, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-03 19:09:30', '2025-05-03 19:09:30'),
(167, 67, 2, 81, 81, 'azaran', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(168, 67, 2, 40, 40, 'lnterdit', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(169, 68, 2, 47, 47, 'baby catt', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(170, 68, 2, 59, 59, 'home intense', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(171, 68, 2, 64, 64, 'GUILTY ELIXIR', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(172, 69, 2, 70, 70, 'Tahnoon', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-03 21:24:22', '2025-05-03 21:24:22'),
(173, 69, 2, 68, 68, 'milan', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-03 21:24:22', '2025-05-03 21:24:22'),
(174, 69, 2, 67, 67, '1990', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-03 21:24:22', '2025-05-03 21:24:22'),
(175, 69, 2, 62, 62, 'master', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-03 21:24:22', '2025-05-03 21:24:22'),
(176, 69, 2, 70, 70, 'Tahnoon', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-03 21:24:22', '2025-05-03 21:24:22'),
(177, 69, 2, 35, 35, 'mydan square', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-03 21:24:22', '2025-05-03 21:24:22'),
(178, 70, 2, 70, 70, 'Tahnoon', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(179, 71, 6, 228, 260, 'OIL MILANO', NULL, '1640', 1640, 0, 0, 0, 1640, 880, 0.1, 164, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(180, 72, 2, 550, 582, 'VERT', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(181, 72, 2, 80, 80, 'imagination', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(182, 73, 2, 51, 51, '2020', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(183, 73, 2, 64, 64, 'GUILTY ELIXIR', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(184, 74, 2, 72, 72, 'FRUITY OUD', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(185, 74, 2, 72, 72, 'FRUITY OUD', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(186, 75, 2, 14, 14, 'ulttra male', NULL, '50', 45.83, 0, 4.17, 0, 50, 50, 1, 45.83, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(187, 75, 2, 38, 38, 'you leather', NULL, '50', 45.83, 0, 4.17, 0, 50, 50, 1, 45.83, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(188, 75, 2, 46, 46, 'avntus absolu', NULL, '50', 45.83, 0, 4.17, 0, 50, 50, 1, 45.83, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(189, 75, 2, 12, 12, 'iris leather', NULL, '50', 45.83, 0, 4.17, 0, 50, 50, 1, 45.83, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(190, 75, 2, 28, 28, 'gullty absolute', NULL, '50', 45.83, 0, 4.17, 0, 50, 50, 1, 45.83, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(191, 75, 2, 81, 81, 'azaran', NULL, '50', 45.83, 0, 4.17, 0, 50, 50, 1, 45.83, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(192, 75, 2, 67, 67, '1990', NULL, '50', 45.83, 0, 4.17, 0, 50, 50, 1, 45.83, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(193, 75, 2, 72, 72, 'FRUITY OUD', NULL, '50', 45.83, 0, 4.17, 0, 50, 50, 1, 45.83, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(194, 75, 2, 550, 582, 'VERT', NULL, '50', 45.83, 0, 4.17, 0, 50, 0, 1, 45.83, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(195, 75, 2, 548, 580, 'AROJA AHLAM', NULL, '50', 45.83, 0, 4.17, 0, 50, 0, 1, 45.83, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(196, 75, 2, 19, 19, 'avntus', NULL, '50', 45.83, 0, 4.17, 0, 50, 50, 1, 45.83, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(197, 75, 2, 80, 80, 'imagination', NULL, '50', 45.87, 0, 4.13, 0, 50, 50, 1, 45.87, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(198, 76, 2, 50, 50, 'taxedo', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(199, 76, 2, 42, 42, 'la lona', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(200, 76, 2, 68, 68, 'milan', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(201, 77, 2, 12, 12, 'iris leather', NULL, '50', 50, 0, 0, 0, 50, 50, 2, 100, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(202, 77, 2, 77, 77, 'THE WAY', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(203, 78, 2, 63, 63, 'COLLECTOR', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(204, 78, 2, 64, 64, 'GUILTY ELIXIR', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(205, 79, 2, 70, 70, 'Tahnoon', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(206, 79, 2, 80, 80, 'imagination', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(207, 80, 2, 76, 76, 'scandel women', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(208, 81, 2, 69, 69, 'TYGER', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(209, 81, 2, 11, 11, 'shumokh', NULL, '50', 50, 0, 0, 0, 50, 19.780188295165, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(210, 81, 2, 79, 79, 'invictus elixir', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(211, 81, 2, 59, 59, 'home intense', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(212, 81, 2, 45, 45, 'al tarahib', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(213, 82, 2, 433, 465, 'sample quintity', NULL, '5', 5, 0, 0, 0, 5, 0, 1, 5, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(214, 83, 2, 38, 38, 'you leather', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(215, 84, 2, 79, 79, 'invictus elixir', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(216, 85, 2, 71, 71, 'Sheikh Abdullah', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(217, 85, 2, 68, 68, 'milan', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(218, 85, 2, 79, 79, 'invictus elixir', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(219, 86, 2, 67, 67, '1990', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(220, 86, 2, 81, 81, 'azaran', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(221, 86, 2, 80, 80, 'imagination', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(222, 87, 8, 430, 462, 'shumukh incence', NULL, '50.00', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(223, 88, 2, 75, 75, 'OUD VANILLA', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(224, 89, 2, 39, 39, 'you', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(225, 89, 2, 77, 77, 'THE WAY', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(226, 89, 4, 427, 459, 'shay oud air freshner', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(227, 90, 2, 67, 67, '1990', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(228, 91, 2, 13, 13, 'mis bloming', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(229, 91, 2, 433, 465, 'sample quintity', NULL, '1', 1, 0, 0, 0, 1, 1.4320754716981, 50, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(230, 92, 2, 433, 465, 'sample quintity', NULL, '1', 1, 0, 0, 0, 1, 1.4320754716981, 50, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(231, 93, 2, 16, 16, 'insolnce', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(232, 94, 2, 13, 13, 'mis bloming', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(233, 95, 2, 69, 69, 'TYGER', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(234, 96, 2, 19, 19, 'avntus', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(235, 96, 2, 81, 81, 'azaran', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(236, 96, 2, 46, 46, 'avntus absolu', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(237, 96, 2, 75, 75, 'OUD VANILLA', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(238, 97, 8, 429, 461, 'shay shay incence', NULL, '50.00', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(239, 98, 2, 63, 63, 'COLLECTOR', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(240, 98, 2, 75, 75, 'OUD VANILLA', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(241, 99, 2, 20, 20, 'garcoon', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(242, 99, 2, 80, 80, 'imagination', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(243, 99, 2, 81, 81, 'azaran', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(244, 100, 2, 552, 584, 'Y', NULL, '50', 44.64, 0, 5.36, 0, 50, 1.9079705536072, 1, 44.64, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(245, 100, 2, 80, 80, 'imagination', NULL, '50', 44.64, 0, 5.36, 0, 50, 50, 1, 44.64, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(246, 100, 2, 39, 39, 'you', NULL, '50', 44.64, 0, 5.36, 0, 50, 25.860560733969, 1, 44.64, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(247, 100, 2, 23, 23, 'O20', NULL, '50', 44.64, 0, 5.36, 0, 50, 50, 1, 44.64, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(248, 100, 2, 56, 56, 'arba pura', NULL, '50', 44.64, 0, 5.36, 0, 50, 50, 1, 44.64, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(249, 100, 2, 434, 466, 'DELIVERY CHARGE', NULL, '30', 26.8, 0, 3.2, 0, 30, 0, 1, 26.8, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(250, 101, 2, 9, 9, 'le belle', NULL, '50', 41.67, 0, 8.33, 0, 50, 0, 1, 41.67, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(251, 101, 2, 81, 81, 'azaran', NULL, '50', 41.67, 0, 16.67, 0, 50, 50, 2, 83.34, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(252, 101, 2, 8, 8, 'savage', NULL, '50', 41.67, 0, 16.67, 0, 50, 0, 2, 83.34, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(253, 101, 2, 72, 72, 'FRUITY OUD', NULL, '50', 41.67, 0, 8.33, 0, 50, 50, 1, 41.67, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(254, 102, 2, 547, 579, '1957', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(255, 102, 2, 50, 50, 'taxedo', NULL, '50', 50, 0, 0, 0, 50, 49.859871467938, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(256, 103, 2, 69, 69, 'TYGER', NULL, '50', 41.67, 0, 16.67, 0, 50, 50, 2, 83.34, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(257, 103, 2, 80, 80, 'imagination', NULL, '50', 41.67, 0, 16.67, 0, 50, 50, 2, 83.34, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(258, 103, 8, 432, 464, 'qissa incence', NULL, '50', 41.67, 0, 8.33, 0, 50, 0, 1, 41.67, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(259, 103, 8, 428, 460, 'shay oud incence', NULL, '50', 41.67, 0, 8.33, 0, 50, 0, 1, 41.67, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(260, 104, 8, 428, 460, 'shay oud incence', NULL, '50.00', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(261, 105, 4, 427, 459, 'shay oud air freshner', NULL, '50.00', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(262, 106, 2, 69, 69, 'TYGER', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(263, 107, 2, 80, 80, 'imagination', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(264, 108, 10, 420, 452, 'BOTTLE REVAL 50ML', NULL, '2.5', 2.5, 0, 0, 0, 2.5, 1, 20, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(265, 108, 10, 7, 7, 'bumb', NULL, '2.5', 2.5, 0, 0, 0, 2.5, 0.998, 20, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(266, 108, 10, 470, 502, 'CAP REVAL BLACK', NULL, '2.5', 2.5, 0, 0, 0, 2.5, 1, 20, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(267, 109, 2, 23, 23, 'O20', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(268, 110, 2, 75, 75, 'OUD VANILLA', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(269, 111, 2, 80, 80, 'imagination', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(270, 111, 8, 430, 462, 'shumukh incence', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(271, 111, 2, 73, 73, 'L hebiscus', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(272, 112, 2, 75, 75, 'OUD VANILLA', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(273, 113, 2, 63, 63, 'COLLECTOR', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(274, 114, 10, 7, 7, 'bumb', NULL, '1.50', 1.5, 0, 0, 0, 1.5, 0.998, 1, 1.5, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-15 17:07:59', '2025-05-15 17:07:59'),
(275, 114, 7, 372, 404, 'OTTLE 100ML 017', NULL, '2.50', 2.5, 0, 0, 0, 2.5, 0, 1, 2.5, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-15 17:07:59', '2025-05-15 17:07:59'),
(276, 114, 7, 373, 405, 'BOTTLE 100ML 018', NULL, '2.50', 2.5, 0, 0, 0, 2.5, 0, 1, 2.5, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-15 17:07:59', '2025-05-15 17:07:59'),
(277, 115, 10, 7, 7, 'bumb', NULL, '1.50', 1.5, 0, 0, 0, 1.5, 0.998, 1, 1.5, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-15 17:13:15', '2025-05-15 17:13:15'),
(278, 115, 10, 7, 7, 'bumb', NULL, '1.50', 1.5, 0, 0, 0, 1.5, 0.998, 1, 1.5, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-15 17:13:15', '2025-05-15 17:13:15'),
(279, 115, 10, 7, 7, 'bumb', NULL, '1.50', 1.5, 0, 0, 0, 1.5, 0.998, 1, 1.5, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-15 17:13:15', '2025-05-15 17:13:15'),
(280, 116, 2, 70, 70, 'Tahnoon', NULL, '30', 30, 0, 0, 0, 30, 50, 20, 600, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-15 22:07:13', '2025-05-15 22:07:13'),
(281, 116, 2, 77, 77, 'THE WAY', NULL, '32', 32, 0, 0, 0, 32, 50, 15, 480, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-15 22:07:13', '2025-05-15 22:07:13'),
(282, 116, 2, 79, 79, 'invictus elixir', NULL, '33', 33, 0, 0, 0, 33, 50, 15, 495, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, '2025-05-15 22:07:13', '2025-05-15 22:07:13'),
(283, 117, 2, 76, 76, 'scandel women', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(284, 117, 2, 77, 77, 'THE WAY', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(285, 118, 2, 550, 582, 'VERT', NULL, '50', 50, 0, 0, 0, 50, 36.523247645292, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(286, 119, 2, 76, 76, 'scandel women', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(287, 119, 2, 72, 72, 'FRUITY OUD', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(288, 120, 2, 16, 16, 'insolnce', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(289, 121, 2, 550, 582, 'VERT', NULL, '50', 50, 0, 0, 0, 50, 36.523247645292, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(290, 121, 2, 76, 76, 'scandel women', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(291, 122, 4, 425, 457, 'hudson air freshner', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(292, 122, 2, 41, 41, 'gres', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(293, 122, 2, 551, 583, 'AMBER LEATHER', NULL, '50', 50, 0, 0, 0, 50, 1.5, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(294, 123, 8, 432, 464, 'qissa incence', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(295, 124, 2, 13, 13, 'mis bloming', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(296, 124, 2, 70, 70, 'Tahnoon', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(297, 124, 2, 69, 69, 'TYGER', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(298, 125, 2, 18, 18, 'akuya', NULL, '50', 50, 0, 0, 0, 50, 0, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(299, 125, 2, 434, 466, 'DELIVERY CHARGE', NULL, '30', 30, 0, 0, 0, 30, 0, 1, 30, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(300, 126, 2, 63, 63, 'COLLECTOR', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(301, 126, 2, 39, 39, 'you', NULL, '50', 50, 0, 0, 0, 50, 25.860560733969, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(302, 126, 2, 23, 23, 'O20', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL),
(303, 127, 2, 75, 75, 'OUD VANILLA', NULL, '50', 50, 0, 0, 0, 50, 50, 1, 50, '', '0', 'VAT', 0, 0, 'no_vat', 1, '1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_order_payments`
--

CREATE TABLE `sale_order_payments` (
  `payment_id` int NOT NULL,
  `shop_id` int NOT NULL,
  `user_id` int NOT NULL,
  `sale_order_id` int NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `currency` varchar(255) NOT NULL,
  `multiplier` double NOT NULL DEFAULT '1',
  `sub_payment_type` varchar(225) NOT NULL,
  `remarks` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `real_amount` varchar(255) NOT NULL DEFAULT '0',
  `order_type` varchar(225) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_order_payments`
--

INSERT INTO `sale_order_payments` (`payment_id`, `shop_id`, `user_id`, `sale_order_id`, `payment_type`, `amount`, `currency`, `multiplier`, `sub_payment_type`, `remarks`, `created_at`, `real_amount`, `order_type`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 1, 'card', 100, 'AED', 1, '', '', '2025-04-23 14:21:26', '100.00', 'counter_sale', NULL, NULL),
(2, 1, 3, 2, 'cash', 50, 'AED', 1, '', '', '2025-04-23 19:26:42', '50.00', 'counter_sale', NULL, NULL),
(3, 1, 3, 3, 'card', 50, 'AED', 1, '', '', '2025-04-23 23:02:06', '50.00', 'counter_sale', NULL, NULL),
(4, 1, 3, 4, 'card', 100, 'AED', 1, '', '', '2025-04-24 18:48:32', '100.00', 'counter_sale', NULL, NULL),
(5, 1, 3, 5, 'card', 100, 'AED', 1, '', '', '2025-04-24 19:44:58', '100.00', 'counter_sale', NULL, NULL),
(6, 1, 3, 6, 'card', 100, 'AED', 1, '', '', '2025-04-24 20:09:37', '100.00', 'counter_sale', NULL, NULL),
(7, 1, 3, 7, 'card', 50, 'AED', 1, '', '', '2025-04-24 20:11:18', '50.00', 'counter_sale', NULL, NULL),
(8, 1, 3, 8, 'cash', 100, 'AED', 1, '', '', '2025-04-24 20:27:35', '100.00', 'counter_sale', NULL, NULL),
(9, 1, 3, 9, 'card', 150, 'AED', 1, '', '', '2025-04-24 22:49:19', '150.00', 'counter_sale', NULL, NULL),
(10, 1, 3, 10, 'card', 50, 'AED', 1, '', '', '2025-04-25 17:44:02', '50.00', 'counter_sale', NULL, NULL),
(11, 1, 3, 11, 'credit', 130, 'AED', 1, '', '', '2025-04-25 18:29:06', '130.00', 'counter_sale', NULL, NULL),
(12, 1, 3, 12, 'card', 100, 'AED', 1, '', '', '2025-04-25 22:05:46', '100.00', 'counter_sale', NULL, NULL),
(13, 1, 3, 13, 'card', 100, 'AED', 1, '', '', '2025-04-25 23:05:36', '100.00', 'counter_sale', NULL, NULL),
(14, 1, 3, 14, 'card', 100, 'AED', 1, '', '', '2025-04-25 23:06:44', '100.00', 'counter_sale', NULL, NULL),
(15, 1, 3, 15, 'card', 250, 'AED', 1, '', '', '2025-04-25 23:29:53', '250.00', 'counter_sale', NULL, NULL),
(16, 1, 3, 16, 'card', 150, 'AED', 1, '', '', '2025-04-25 23:30:45', '150.00', 'counter_sale', NULL, NULL),
(17, 1, 3, 17, 'cash', 200, 'AED', 1, '', '', '2025-04-26 09:49:54', '200', 'counter_sale', NULL, NULL),
(18, 1, 3, 17, 'card', 50, 'AED', 1, '', '', '2025-04-26 09:49:54', '50.00', 'counter_sale', NULL, NULL),
(19, 1, 3, 21, 'card', 50, 'AED', 1, '', '', '2025-04-26 18:47:55', '50.00', 'counter_sale', NULL, NULL),
(20, 1, 3, 22, 'card', 200, 'AED', 1, '', '', '2025-04-26 18:50:33', '200.00', 'counter_sale', NULL, NULL),
(21, 1, 3, 23, 'cash', 100, 'AED', 1, '', '', '2025-04-26 18:55:27', '100.00', 'counter_sale', NULL, NULL),
(22, 1, 3, 24, 'cash', 800, 'AED', 1, '', '', '2025-04-26 19:02:03', '800.00', 'counter_sale', NULL, NULL),
(23, 1, 3, 25, 'card', 250, 'AED', 1, '', '', '2025-04-26 19:04:59', '250.00', 'counter_sale', NULL, NULL),
(24, 1, 3, 26, 'card', 100, 'AED', 1, '', '', '2025-04-26 22:12:31', '100.00', 'counter_sale', NULL, NULL),
(25, 1, 3, 27, 'card', 350, 'AED', 1, '', '', '2025-04-26 23:28:57', '350.00', 'counter_sale', NULL, NULL),
(26, 1, 3, 28, 'card', 50, 'AED', 1, '', '', '2025-04-27 20:54:06', '50.00', 'counter_sale', NULL, NULL),
(27, 1, 3, 29, 'card', 100, 'AED', 1, '', '', '2025-04-27 22:10:16', '100.00', 'counter_sale', NULL, NULL),
(28, 1, 3, 30, 'card', 50, 'AED', 1, '', '', '2025-04-27 22:53:25', '50.00', 'counter_sale', NULL, NULL),
(29, 1, 3, 31, 'card', 300, 'AED', 1, '', '', '2025-04-28 00:08:07', '300.00', 'counter_sale', NULL, NULL),
(30, 1, 3, 32, 'cash', 50, 'AED', 1, '', '', '2025-04-28 14:02:26', '50.00', 'counter_sale', NULL, NULL),
(31, 1, 3, 33, 'credit', 250, 'AED', 1, '', '', '2025-04-28 17:15:12', '250.00', 'counter_sale', NULL, NULL),
(32, 1, 3, 34, 'card', 50, 'AED', 1, '', '', '2025-04-28 17:48:52', '50.00', 'counter_sale', NULL, NULL),
(33, 1, 3, 35, 'cash', 100, 'AED', 1, '', '', '2025-04-28 22:43:02', '100.00', 'counter_sale', NULL, NULL),
(34, 1, 3, 36, 'card', 150, 'AED', 1, '', '', '2025-04-28 23:02:20', '150.00', 'counter_sale', NULL, NULL),
(35, 1, 3, 37, 'card', 50, 'AED', 1, '', '', '2025-04-29 17:14:27', '50.00', 'counter_sale', NULL, NULL),
(36, 1, 3, 38, 'card', 50, 'AED', 1, '', '', '2025-04-29 20:13:45', '50.00', 'counter_sale', NULL, NULL),
(37, 1, 3, 39, 'card', 50, 'AED', 1, '', '', '2025-04-29 20:19:06', '50.00', 'counter_sale', NULL, NULL),
(38, 1, 3, 40, 'card', 350, 'AED', 1, '', '', '2025-04-29 20:30:03', '350.00', 'counter_sale', NULL, NULL),
(39, 1, 3, 41, 'cash', 50, 'AED', 1, '', '', '2025-04-29 21:25:12', '50.00', 'counter_sale', NULL, NULL),
(40, 1, 3, 42, 'card', 100, 'AED', 1, '', '', '2025-04-29 21:53:31', '100.00', 'counter_sale', NULL, NULL),
(41, 1, 3, 43, 'credit', 300, 'AED', 1, '', '', '2025-04-30 15:43:32', '300.00', 'counter_sale', NULL, NULL),
(42, 1, 3, 44, 'credit', 130, 'AED', 1, '', '', '2025-04-30 15:47:11', '130.00', 'counter_sale', NULL, NULL),
(43, 1, 3, 45, 'cash', 100, 'AED', 1, '', '', '2025-04-30 19:57:54', '100.00', 'counter_sale', NULL, NULL),
(44, 1, 3, 46, 'cash', 450, 'AED', 1, '', '', '2025-04-30 21:35:29', '450.00', 'counter_sale', NULL, NULL),
(45, 1, 3, 47, 'card', 150, 'AED', 1, '', '', '2025-04-30 21:46:50', '150.00', 'counter_sale', NULL, NULL),
(46, 1, 3, 48, 'card', 100, 'AED', 1, '', '', '2025-05-01 13:03:45', '100.00', 'counter_sale', NULL, NULL),
(47, 1, 3, 49, 'card', 50, 'AED', 1, '', '', '2025-05-01 13:08:28', '50.00', 'counter_sale', NULL, NULL),
(48, 1, 3, 50, 'credit', 51.5, 'AED', 1, '', '', '2025-05-01 14:30:06', '51.50', 'delivery', '2025-05-01 18:30:06', '2025-05-01 18:30:06'),
(49, 1, 3, 51, 'credit', 101.5, 'AED', 1, '', '', '2025-05-01 14:29:57', '101.50', 'delivery', '2025-05-01 18:29:57', '2025-05-01 18:29:57'),
(50, 1, 3, 52, 'cash', 150, 'AED', 1, '', '', '2025-05-01 18:36:39', '150.00', 'counter_sale', NULL, NULL),
(51, 1, 3, 53, 'card', 150, 'AED', 1, '', '', '2025-05-01 19:04:11', '150.00', 'counter_sale', NULL, NULL),
(52, 1, 3, 54, 'card', 50, 'AED', 1, '', '', '2025-05-01 19:06:00', '50.00', 'counter_sale', NULL, NULL),
(53, 1, 3, 55, 'cash', 50, 'AED', 1, '', '', '2025-05-01 20:40:26', '50.00', 'counter_sale', NULL, NULL),
(54, 1, 3, 56, 'card', 200, 'AED', 1, '', '', '2025-05-01 20:50:14', '200.00', 'counter_sale', NULL, NULL),
(55, 1, 3, 57, 'card', 200, 'AED', 1, '', '', '2025-05-01 20:51:42', '200.00', 'counter_sale', NULL, NULL),
(56, 1, 3, 58, 'card', 100, 'AED', 1, '', '', '2025-05-01 21:47:14', '100.00', 'counter_sale', NULL, NULL),
(57, 1, 3, 59, 'card', 100, 'AED', 1, '', '', '2025-05-01 22:25:05', '100.00', 'counter_sale', NULL, NULL),
(58, 1, 3, 60, 'card', 150, 'AED', 1, '', '', '2025-05-01 23:06:09', '150.00', 'counter_sale', NULL, NULL),
(59, 1, 3, 61, 'card', 100, 'AED', 1, '', '', '2025-05-02 19:50:01', '100.00', 'counter_sale', NULL, NULL),
(60, 1, 3, 62, 'cash', 100, 'AED', 1, '', '', '2025-05-02 19:57:59', '100.00', 'counter_sale', NULL, NULL),
(61, 1, 3, 63, 'cash', 50, 'AED', 1, '', '', '2025-05-02 21:37:03', '50.00', 'counter_sale', NULL, NULL),
(62, 1, 3, 64, 'card', 50, 'AED', 1, '', '', '2025-05-02 21:38:00', '50.00', 'counter_sale', NULL, NULL),
(63, 1, 3, 65, 'cash', 300, 'AED', 1, '', '', '2025-05-03 15:54:57', '300.00', 'counter_sale', NULL, NULL),
(64, 1, 3, 66, 'card', 150, 'AED', 1, '', '', '2025-05-03 15:09:30', '164', 'counter_sale', '2025-05-03 19:09:30', '2025-05-03 19:09:30'),
(65, 1, 3, 67, 'card', 100, 'AED', 1, '', '', '2025-05-03 19:18:09', '100.00', 'counter_sale', NULL, NULL),
(66, 1, 3, 68, 'card', 150, 'AED', 1, '', '', '2025-05-03 19:20:01', '150.00', 'counter_sale', NULL, NULL),
(67, 1, 3, 69, 'card', 300, 'AED', 1, '', '', '2025-05-03 17:24:22', '300.00', 'counter_sale', '2025-05-03 21:24:22', '2025-05-03 21:24:22'),
(68, 1, 3, 70, 'cash', 50, 'AED', 1, '', '', '2025-05-03 21:23:30', '50.00', 'counter_sale', NULL, NULL),
(69, 1, 4, 71, 'card', 164, 'AED', 1, '', '', '2025-05-03 21:54:03', '164.00', 'counter_sale', NULL, NULL),
(70, 1, 3, 72, 'cash', 100, 'AED', 1, '', '', '2025-05-03 22:27:49', '100.00', 'counter_sale', NULL, NULL),
(71, 1, 3, 73, 'card', 100, 'AED', 1, '', '', '2025-05-04 17:33:32', '100.00', 'counter_sale', NULL, NULL),
(72, 1, 3, 74, 'card', 100, 'AED', 1, '', '', '2025-05-04 17:34:19', '100.00', 'counter_sale', NULL, NULL),
(73, 1, 3, 75, 'cash', 550, 'AED', 1, '', '', '2025-05-04 19:15:42', '550.00', 'counter_sale', NULL, NULL),
(74, 1, 3, 76, 'card', 150, 'AED', 1, '', '', '2025-05-04 19:44:41', '150.00', 'counter_sale', NULL, NULL),
(75, 1, 3, 77, 'cash', 150, 'AED', 1, '', '', '2025-05-04 21:36:05', '150.00', 'counter_sale', NULL, NULL),
(76, 1, 3, 78, 'cash', 100, 'AED', 1, '', '', '2025-05-04 23:10:13', '100.00', 'counter_sale', NULL, NULL),
(77, 1, 3, 79, 'cash', 100, 'AED', 1, '', '', '2025-05-05 18:43:09', '100.00', 'counter_sale', NULL, NULL),
(78, 1, 3, 80, 'cash', 50, 'AED', 1, '', '', '2025-05-05 18:43:22', '50.00', 'counter_sale', NULL, NULL),
(79, 1, 3, 81, 'card', 250, 'AED', 1, '', '', '2025-05-06 13:55:13', '250.00', 'counter_sale', NULL, NULL),
(80, 1, 3, 82, 'cash', 5, 'AED', 1, '', '', '2025-05-06 16:12:33', '5.00', 'counter_sale', NULL, NULL),
(81, 1, 3, 83, 'card', 50, 'AED', 1, '', '', '2025-05-06 21:50:03', '50.00', 'counter_sale', NULL, NULL),
(82, 1, 3, 84, 'card', 50, 'AED', 1, '', '', '2025-05-06 23:05:52', '50.00', 'counter_sale', NULL, NULL),
(83, 1, 3, 85, 'card', 150, 'AED', 1, '', '', '2025-05-07 20:26:01', '150.00', 'counter_sale', NULL, NULL),
(84, 1, 3, 86, 'card', 150, 'AED', 1, '', '', '2025-05-07 22:50:08', '150.00', 'counter_sale', NULL, NULL),
(85, 1, 3, 87, 'card', 50, 'AED', 1, '', '', '2025-05-08 17:34:40', '50.00', 'counter_sale', NULL, NULL),
(86, 1, 3, 88, 'cash', 50, 'AED', 1, '', '', '2025-05-08 20:34:37', '50.00', 'counter_sale', NULL, NULL),
(87, 1, 3, 89, 'cash', 50, 'AED', 1, '', '', '2025-05-08 23:56:46', '50', 'counter_sale', NULL, NULL),
(88, 1, 3, 89, 'card', 100, 'AED', 1, '', '', '2025-05-08 23:56:46', '100.00', 'counter_sale', NULL, NULL),
(89, 1, 3, 90, 'card', 50, 'AED', 1, '', '', '2025-05-09 18:09:29', '50.00', 'counter_sale', NULL, NULL),
(90, 1, 3, 91, 'card', 100, 'AED', 1, '', '', '2025-05-09 18:33:03', '100.00', 'counter_sale', NULL, NULL),
(91, 1, 3, 92, 'card', 50, 'AED', 1, '', '', '2025-05-09 18:33:47', '50.00', 'counter_sale', NULL, NULL),
(92, 1, 3, 93, 'card', 50, 'AED', 1, '', '', '2025-05-09 20:50:10', '50.00', 'counter_sale', NULL, NULL),
(93, 1, 3, 94, 'cash', 50, 'AED', 1, '', '', '2025-05-09 21:23:06', '50.00', 'counter_sale', NULL, NULL),
(94, 1, 3, 95, 'card', 50, 'AED', 1, '', '', '2025-05-10 20:29:54', '50.00', 'counter_sale', NULL, NULL),
(95, 1, 3, 96, 'card', 200, 'AED', 1, '', '', '2025-05-10 21:31:24', '200.00', 'counter_sale', NULL, NULL),
(96, 1, 3, 97, 'card', 50, 'AED', 1, '', '', '2025-05-11 20:32:58', '50.00', 'counter_sale', NULL, NULL),
(97, 1, 3, 98, 'cash', 100, 'AED', 1, '', '', '2025-05-11 21:06:06', '100.00', 'counter_sale', NULL, NULL),
(98, 1, 3, 99, 'card', 150, 'AED', 1, '', '', '2025-05-11 21:39:57', '150.00', 'counter_sale', NULL, NULL),
(99, 1, 3, 100, 'credit', 250, 'AED', 1, '', '', '2025-05-12 14:08:09', '250.00', 'delivery', NULL, NULL),
(100, 1, 3, 101, 'card', 250, 'AED', 1, '', '', '2025-05-12 17:26:15', '250.00', 'counter_sale', NULL, NULL),
(101, 1, 3, 102, 'card', 100, 'AED', 1, '', '', '2025-05-12 19:30:10', '100.00', 'counter_sale', NULL, NULL),
(102, 1, 3, 103, 'card', 250, 'AED', 1, '', '', '2025-05-12 19:42:26', '250.00', 'counter_sale', NULL, NULL),
(103, 1, 3, 104, 'card', 50, 'AED', 1, '', '', '2025-05-13 19:22:16', '50.00', 'counter_sale', NULL, NULL),
(104, 1, 3, 105, 'card', 50, 'AED', 1, '', '', '2025-05-13 19:23:01', '50.00', 'counter_sale', NULL, NULL),
(105, 1, 3, 106, 'cash', 50, 'AED', 1, '', '', '2025-05-13 19:57:17', '50.00', 'counter_sale', NULL, NULL),
(106, 1, 3, 107, 'card', 50, 'AED', 1, '', '', '2025-05-13 21:49:35', '50.00', 'counter_sale', NULL, NULL),
(107, 1, 3, 108, 'card', 150, 'AED', 1, '', '', '2025-05-13 21:52:03', '150.00', 'counter_sale', NULL, NULL),
(108, 1, 3, 109, 'cash', 50, 'AED', 1, '', '', '2025-05-13 22:20:58', '50.00', 'counter_sale', NULL, NULL),
(109, 1, 3, 110, 'cash', 50, 'AED', 1, '', '', '2025-05-14 14:52:04', '50.00', 'counter_sale', NULL, NULL),
(110, 1, 3, 111, 'cash', 50, 'AED', 1, '', '', '2025-05-14 20:49:44', '50', 'counter_sale', NULL, NULL),
(111, 1, 3, 111, 'card', 100, 'AED', 1, '', '', '2025-05-14 20:49:44', '100.00', 'counter_sale', NULL, NULL),
(112, 1, 3, 112, 'card', 50, 'AED', 1, '', '', '2025-05-15 00:04:23', '50.00', 'counter_sale', NULL, NULL),
(113, 1, 3, 113, 'card', 50, 'AED', 1, '', '', '2025-05-15 16:15:31', '50.00', 'counter_sale', NULL, NULL),
(114, 1, 4, 114, 'credit', 4, 'AED', 1, '', '', '2025-05-15 13:07:59', '4', 'counter_sale', '2025-05-15 17:07:59', '2025-05-15 17:07:59'),
(115, 1, 4, 114, '', 2.5, 'AED', 1, '', '', '2025-05-15 13:07:59', '2.50', 'counter_sale', '2025-05-15 17:07:59', '2025-05-15 17:07:59'),
(116, 1, 4, 115, 'cash', 1.5, 'AED', 1, '', '', '2025-05-15 13:13:15', '1.50', 'counter_sale', '2025-05-15 17:13:15', '2025-05-15 17:13:15'),
(117, 1, 4, 115, 'credit', 3, 'AED', 1, '', '', '2025-05-15 13:13:15', '3.00', 'counter_sale', '2025-05-15 17:13:15', '2025-05-15 17:13:15'),
(118, 1, 4, 116, 'card', 1575, 'AED', 1, '', '', '2025-05-15 18:07:13', '1575.00', 'counter_sale', '2025-05-15 22:07:13', '2025-05-15 22:07:13'),
(119, 1, 3, 117, 'cash', 100, 'AED', 1, '', '', '2025-05-15 22:06:48', '100.00', 'counter_sale', NULL, NULL),
(120, 1, 3, 118, 'cash', 50, 'AED', 1, '', '', '2025-05-16 17:56:15', '50.00', 'counter_sale', NULL, NULL),
(121, 1, 3, 119, 'card', 100, 'AED', 1, '', '', '2025-05-16 18:23:05', '100.00', 'counter_sale', NULL, NULL),
(122, 1, 3, 120, 'card', 50, 'AED', 1, '', '', '2025-05-16 18:59:47', '50.00', 'counter_sale', NULL, NULL),
(123, 1, 3, 121, 'cash', 100, 'AED', 1, '', '', '2025-05-16 20:09:19', '100.00', 'counter_sale', NULL, NULL),
(124, 1, 3, 122, 'card', 150, 'AED', 1, '', '', '2025-05-16 21:18:45', '150.00', 'counter_sale', NULL, NULL),
(125, 1, 3, 123, 'cash', 50, 'AED', 1, '', '', '2025-05-16 22:48:20', '50.00', 'counter_sale', NULL, NULL),
(126, 1, 3, 124, 'card', 150, 'AED', 1, '', '', '2025-05-16 23:05:17', '150.00', 'counter_sale', NULL, NULL),
(127, 1, 3, 125, 'credit', 80, 'AED', 1, '', '', '2025-05-17 09:50:43', '80.00', 'delivery', NULL, NULL),
(128, 1, 3, 126, 'card', 150, 'AED', 1, '', '', '2025-05-17 10:32:51', '150.00', 'counter_sale', NULL, NULL),
(129, 1, 3, 127, 'card', 50, 'AED', 1, '', '', '2025-05-17 11:14:37', '50.00', 'counter_sale', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'currency', 'AED', NULL, '2025-04-14 17:44:03', NULL),
(2, 'decimal_point', '2', NULL, '2025-04-14 17:44:03', NULL),
(3, 'date_format', 'd-m-Y', NULL, '2025-04-14 17:44:03', NULL),
(4, 'time_format', 'H:i:s', NULL, '2025-04-14 17:44:03', NULL),
(5, 'unit_price', 'yes', NULL, '2025-04-14 17:44:03', NULL),
(6, 'stock_check', 'no', NULL, '2025-04-14 17:44:03', NULL),
(7, 'stock_show', 'yes', NULL, '2025-04-14 17:44:03', NULL),
(8, 'settle_check_pending', 'yes', NULL, '2025-04-14 17:44:03', NULL),
(9, 'delivery_sale', 'yes', NULL, '2025-04-14 17:44:03', NULL),
(10, 'api_key', '123', NULL, NULL, NULL),
(11, 'custom_product', '4', NULL, NULL, NULL),
(12, 'language', '1', NULL, NULL, NULL),
(13, 'delivery_sales', 'yes', '2024-06-08 00:31:01', '2024-06-08 00:31:01', NULL),
(14, 'staff_pin', 'no', '2024-06-08 00:31:01', '2025-04-14 17:44:03', NULL),
(15, 'barcode', 'yes', '2024-07-28 07:14:55', '2025-04-14 17:44:03', NULL),
(16, 'drawer_password', '321', '2024-07-28 07:14:55', '2025-04-14 17:44:03', NULL),
(17, 'payback_password', '123', '2024-07-28 07:14:55', '2025-04-14 17:44:03', NULL),
(18, 'purchase', 'yes', NULL, '2025-04-14 17:44:03', NULL),
(19, 'production', 'yes', NULL, '2025-04-14 17:44:03', NULL),
(20, 'production', 'yes', NULL, '2025-04-14 17:44:03', NULL),
(21, 'Minimum-stock', 'yes', NULL, '2025-04-14 17:44:03', NULL),
(22, 'wastage-usage', 'yes', NULL, '2025-04-14 17:44:03', NULL),
(23, 'wastage-usage-zero-stock', 'yes', NULL, '2025-04-14 17:44:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settle_sale`
--

CREATE TABLE `settle_sale` (
  `id` int NOT NULL,
  `account_ledger_id` int DEFAULT NULL,
  `company_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `shop_id` int NOT NULL,
  `staff_id` int NOT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settle_sale`
--

INSERT INTO `settle_sale` (`id`, `account_ledger_id`, `company_id`, `user_id`, `shop_id`, `staff_id`, `cash_at_starting`, `cash_sale`, `card_sale`, `credit_sale`, `delivery_sale`, `delivery_recover`, `online_order_recovery`, `credit_recover`, `cg_advance`, `cg_recover`, `gross_total`, `gross_total_tax`, `gross_total_without_tax`, `discount`, `net_total`, `cash_drawer`, `settle_date`, `expense`, `pay_back`, `pay_back_vat`, `deposit_amount`, `petty_cash_amount`, `multi_payment_types_amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, 3, 1, 0, '', '470', '0', '0', '0', NULL, '0', '0', '0', '0', '500', 0.00, 0.00, '30', '470', '420', '2025-04-15 19:07:21', '0', '50', 0, 0, 0, 'a:1:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:470;}}', NULL, NULL, NULL),
(2, NULL, NULL, 3, 1, 0, '', '202', '55', '0', '0', NULL, '0', '0', '0', '0', '257', 0.00, 0.00, '0', '257', '112', '2025-04-15 19:11:09', '0', '90', 0, 0, 0, 'a:2:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:202;}i:1;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:55;}}', NULL, NULL, NULL),
(3, NULL, NULL, 3, 1, 0, '', '50', '150', '0', '0', NULL, '0', '0', '0', '0', '200', 0.00, 0.00, '0', '200', '50', '2025-04-23 23:02:48', '0', '0', 0, 0, 0, 'a:2:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:50;}i:1;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:150;}}', NULL, NULL, NULL),
(4, NULL, NULL, 3, 1, 0, '', '100', '500', '0', '0', NULL, '0', '0', '0', '0', '600', 0.00, 0.00, '0', '600', '100', '2025-04-24 23:00:37', '0', '0', 0, 0, 0, 'a:2:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:100;}i:1;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:500;}}', NULL, NULL, NULL),
(5, NULL, NULL, 3, 1, 0, '', '0', '750', '130', '0', NULL, '0', '0', '0', '0', '880', 0.00, 0.00, '0', '880', '0', '2025-04-25 23:59:59', '0', '0', 0, 0, 0, 'a:2:{i:0;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:750;}i:1;a:2:{s:12:\"payment_type\";s:6:\"credit\";s:6:\"amount\";d:130;}}', NULL, NULL, NULL),
(6, NULL, NULL, 3, 1, 0, '', '1100', '950', '0', '0', NULL, '0', '0', '0', '0', '2100', 0.00, 0.00, '0', '2100', '1100', '2025-04-26 23:46:40', '0', '0', 0, 0, 0, 'a:2:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:1100;}i:1;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:1000;}}', NULL, NULL, NULL),
(7, NULL, NULL, 3, 1, 0, '', '150', '700', '250', '0', NULL, '0', '0', '0', '0', '1130', 0.00, 0.00, '30', '1100', '150', '2025-04-28 23:56:23', '0', '0', 0, 0, 0, 'a:3:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:150;}i:1;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:700;}i:2;a:2:{s:12:\"payment_type\";s:6:\"credit\";s:6:\"amount\";d:250;}}', NULL, NULL, NULL),
(8, NULL, NULL, 3, 1, 0, '', '50', '600', '0', '0', NULL, '0', '0', '0', '0', '650', 0.00, 0.00, '0', '650', '50', '2025-04-29 23:57:46', '0', '0', 0, 0, 0, 'a:2:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:50;}i:1;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:600;}}', NULL, NULL, NULL),
(9, NULL, NULL, 3, 1, 0, '', '550', '150', '430', '0', NULL, '0', '0', '0', '0', '1160', 0.00, 0.00, '30', '1130', '550', '2025-04-30 23:56:07', '0', '0', 0, 0, 0, 'a:3:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:550;}i:1;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:150;}i:2;a:2:{s:12:\"payment_type\";s:6:\"credit\";s:6:\"amount\";d:430;}}', NULL, NULL, NULL),
(10, NULL, NULL, 3, 1, 0, '', '200', '1100', '0', '0', NULL, '0', '0', '0', '0', '1300', 0.00, 0.00, '0', '1300', '100', '2025-05-01 23:52:48', '100', '0', 0, 0, 0, 'a:2:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:200;}i:1;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:1100;}}', NULL, NULL, NULL),
(11, NULL, NULL, 3, 1, 0, '', '150', '150', '0', '0', NULL, '0', '0', '0', '0', '300', 0.00, 0.00, '0', '300', '150', '2025-05-02 23:55:11', '0', '0', 0, 0, 0, 'a:2:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:150;}i:1;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:150;}}', NULL, NULL, NULL),
(12, NULL, NULL, 3, 1, 0, '', '450', '414', '0', '0', NULL, '0', '0', '0', '0', '864', 0.00, 0.00, '0', '864', '450', '2025-05-03 23:53:16', '0', '0', 0, 0, 0, 'a:2:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:450;}i:1;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:414;}}', NULL, NULL, NULL),
(13, NULL, NULL, 3, 1, 0, '', '800', '350', '0', '0', NULL, '0', '0', '0', '0', '1200', 0.00, 0.00, '50', '1150', '800', '2025-05-04 23:57:04', '0', '0', 0, 0, 0, 'a:2:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:800;}i:1;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:350;}}', NULL, NULL, NULL),
(14, NULL, NULL, 3, 1, 0, '', '150', '0', '0', '0', NULL, '0', '0', '0', '0', '150', 0.00, 0.00, '0', '150', '150', '2025-05-05 23:53:45', '0', '0', 0, 0, 0, 'a:1:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:150;}}', NULL, NULL, NULL),
(15, NULL, NULL, 3, 1, 0, '', '5', '350', '0', '0', NULL, '0', '0', '0', '0', '355', 0.00, 0.00, '0', '355', '5', '2025-05-06 23:58:37', '0', '0', 0, 0, 0, 'a:2:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:5;}i:1;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:350;}}', NULL, NULL, NULL),
(16, NULL, NULL, 3, 1, 0, '', '0', '300', '0', '0', NULL, '0', '0', '0', '0', '300', 0.00, 0.00, '0', '300', '-2905', '2025-05-07 23:55:27', '2905', '0', 0, 0, 0, 'a:1:{i:0;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:300;}}', NULL, NULL, NULL),
(17, NULL, NULL, 3, 1, 0, '', '100', '50', '0', '0', NULL, '0', '0', '0', '0', '250', 0.00, 0.00, '0', '250', '100', '2025-05-08 23:56:56', '0', '0', 0, 0, 0, 'a:2:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:100;}i:1;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:150;}}', NULL, NULL, NULL),
(18, NULL, NULL, 3, 1, 0, '', '50', '250', '0', '0', NULL, '0', '0', '0', '0', '300', 0.00, 0.00, '0', '300', '50', '2025-05-09 23:57:07', '0', '0', 0, 0, 0, 'a:2:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:50;}i:1;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:250;}}', NULL, NULL, NULL),
(19, NULL, NULL, 3, 1, 0, '', '0', '250', '0', '0', NULL, '0', '0', '0', '0', '250', 0.00, 0.00, '0', '250', '0', '2025-05-10 23:51:36', '0', '0', 0, 0, 0, 'a:1:{i:0;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:250;}}', NULL, NULL, NULL),
(20, NULL, NULL, 3, 1, 0, '', '100', '200', '0', '0', NULL, '0', '0', '0', '0', '300', 0.00, 0.00, '0', '300', '-161236', '2025-05-11 23:54:55', '161336', '0', 0, 0, 0, 'a:2:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:100;}i:1;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:200;}}', NULL, NULL, NULL),
(21, NULL, NULL, 3, 1, 0, '', '0', '600', '250', '250', NULL, '0', '0', '0', '0', '980', 0.00, 0.00, '130', '850', '-643', '2025-05-12 23:59:52', '643', '0', 0, 0, 0, 'a:2:{i:0;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:600;}i:1;a:2:{s:12:\"payment_type\";s:6:\"credit\";s:6:\"amount\";d:250;}}', NULL, NULL, NULL),
(22, NULL, NULL, 3, 1, 0, '', '100', '300', '0', '0', NULL, '0', '0', '0', '0', '400', 0.00, 0.00, '0', '400', '-3725', '2025-05-13 23:55:33', '3825', '0', 0, 0, 0, 'a:2:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:100;}i:1;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:300;}}', NULL, NULL, NULL),
(23, NULL, NULL, 3, 1, 0, '', '100', '0', '0', '0', NULL, '0', '0', '0', '0', '200', 0.00, 0.00, '0', '200', '100', '2025-05-14 23:58:32', '0', '0', 0, 0, 0, 'a:2:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:100;}i:1;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:100;}}', NULL, NULL, NULL),
(24, NULL, NULL, 3, 1, 0, '', '100', '100', '0', '0', NULL, '0', '7', '0', '0', '200', 0.00, 7.00, '0', '200', '107', '2025-05-15 23:57:25', '0', '0', 0, 0, 0, 'a:2:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:100;}i:1;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:100;}}', NULL, NULL, NULL),
(25, NULL, NULL, 3, 1, 0, '', '200', '450', '0', '0', NULL, '0', '0', '0', '0', '650', 0.00, 0.00, '0', '650', '200', '2025-05-16 23:55:16', '0', '0', 0, 0, 0, 'a:2:{i:0;a:2:{s:12:\"payment_type\";s:4:\"cash\";s:6:\"amount\";d:200;}i:1;a:2:{s:12:\"payment_type\";s:4:\"card\";s:6:\"amount\";d:450;}}', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `staff_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_join` date DEFAULT NULL,
  `staff_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_pin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_manage`
--

CREATE TABLE `stock_manage` (
  `id` bigint NOT NULL,
  `uuid` char(36) NOT NULL,
  `created_user_id` bigint NOT NULL,
  `approver_user_id` bigint NOT NULL DEFAULT '0',
  `source_branch_id` bigint NOT NULL,
  `destination_branch_id` bigint NOT NULL,
  `manage_type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `notes` text,
  `transaction_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `stock_management_history`
--

CREATE TABLE `stock_management_history` (
  `id` int NOT NULL,
  `shop_id` int NOT NULL,
  `user_id` int NOT NULL,
  `item_id` int NOT NULL,
  `item_price_id` int NOT NULL,
  `action_type` enum('add','sub') NOT NULL DEFAULT 'add',
  `reference_no` varchar(225) DEFAULT NULL,
  `reference_key` varchar(225) NOT NULL,
  `open_stock` double NOT NULL,
  `closing_stock` double NOT NULL,
  `stock_value` double NOT NULL,
  `cost_price` double NOT NULL DEFAULT '0',
  `total_cost_price` double NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `stock_management_history`
--

INSERT INTO `stock_management_history` (`id`, `shop_id`, `user_id`, `item_id`, `item_price_id`, `action_type`, `reference_no`, `reference_key`, `open_stock`, `closing_stock`, `stock_value`, `cost_price`, `total_cost_price`, `date_added`) VALUES
(1, 1, 2, 2, 2, 'add', '1', 'Purchase Order', 0, 100, 100, 0, 0, '2025-04-15 00:00:00'),
(2, 1, 2, 4, 4, 'add', '2', 'Purchase Order', 0, 5, 5, 0, 0, '2025-04-15 00:00:00'),
(3, 1, 2, 5, 5, 'add', '3', 'Purchase Order', 0, 10, 10, 0, 0, '2025-04-15 00:00:00'),
(4, 1, 2, 6, 6, 'add', '4', 'Purchase Order', 0, 100, 100, 0, 0, '2025-04-15 00:00:00'),
(5, 1, 2, 1, 1, 'add', '1', 'Production', 0, 10, 10, 0, 0, '2025-04-15 18:27:29'),
(6, 1, 2, 2, 2, 'sub', '1', 'Production', 100, 90, 10, 0, 0, '2025-04-15 18:27:29'),
(7, 1, 2, 4, 4, 'sub', '1', 'Production', 5, 4.8, 0.2, 0, 0, '2025-04-15 18:27:29'),
(8, 1, 2, 5, 5, 'sub', '1', 'Production', 10, 9.7, 0.3, 0, 0, '2025-04-15 18:27:29'),
(9, 1, 2, 6, 6, 'sub', '1', 'Production', 100, 90, 10, 0, 0, '2025-04-15 18:27:29'),
(10, 1, 2, 1, 1, 'add', '2', 'Production', 10, 15, 5, 0, 0, '2025-04-15 18:29:13'),
(11, 1, 2, 2, 2, 'sub', '2', 'Production', 90, 85, 5, 0, 0, '2025-04-15 18:29:13'),
(12, 1, 2, 4, 4, 'sub', '2', 'Production', 4.8, 4.7, 0.1, 0, 0, '2025-04-15 18:29:13'),
(13, 1, 2, 5, 5, 'sub', '2', 'Production', 9.7, 9.55, 0.15, 0, 0, '2025-04-15 18:29:13'),
(14, 1, 2, 6, 6, 'sub', '2', 'Production', 90, 85, 5, 0, 0, '2025-04-15 18:29:13'),
(15, 1, 3, 1, 1, 'sub', '1', 'counter_sale', 15, 13, 2, 0, 0, '2025-04-15 18:29:48'),
(16, 1, 3, 1, 1, 'sub', '2', 'counter_sale', 13, 12, 1, 0, 0, '2025-04-15 18:37:31'),
(17, 1, 3, 1, 1, 'sub', '3', 'counter_sale', 12, 6, 6, 0, 0, '2025-04-15 18:40:55'),
(18, 1, 3, 1, 1, 'sub', '4', 'counter_sale', 6, 5, 1, 0, 0, '2025-04-15 18:41:19'),
(19, 1, 3, 1, 1, 'add', 'INV-1-3-4', 'pay_back', 5, 6, 300, 0, 0, '2025-04-15 18:42:48'),
(20, 1, 2, 1, 1, 'sub', NULL, 'wastage', 6, 5, 1, 0, 0, '2025-04-15 18:44:20'),
(21, 1, 2, 1, 1, 'sub', NULL, 'usage', 5, 4, 1, 0, 0, '2025-04-15 18:44:33'),
(22, 1, 3, 2, 2, 'sub', '5', 'counter_sale', 85, 84, 1, 0, 0, '2025-04-15 19:09:33'),
(23, 1, 3, 4, 4, 'sub', '6', 'counter_sale', 4.7, 3.7, 1, 0, 0, '2025-04-15 19:09:41'),
(24, 1, 3, 5, 5, 'sub', '6', 'counter_sale', 9.55, 8.55, 1, 0, 0, '2025-04-15 19:09:41'),
(25, 1, 3, 1, 1, 'sub', '6', 'counter_sale', 4, 3, 1, 0, 0, '2025-04-15 19:09:41'),
(26, 1, 3, 1, 1, 'add', 'INV-1-3-3', 'pay_back', 3, 5, 250, 0, 0, '2025-04-15 19:10:15'),
(27, 1, 3, 1, 1, 'sub', '7', 'counter_sale', 5, 1, 4, 0, 0, '2025-04-15 19:10:50'),
(28, 1, 2, 8, 8, 'add', NULL, 'Stock Update', 0, 100, 100, 0, 0, '2025-04-15 19:29:14'),
(29, 1, 3, 1, 1, 'sub', '8', 'counter_sale', 1, 0, 1, 0, 0, '2025-04-15 20:04:54'),
(30, 1, 3, 2, 2, 'sub', '9', 'counter_sale', 84, 83, 1, 0, 0, '2025-04-15 20:05:42'),
(31, 1, 3, 6, 6, 'sub', '10', 'counter_sale', 85, 84, 1, 0, 0, '2025-04-15 20:06:26'),
(32, 1, 3, 6, 6, 'sub', '10', 'counter_sale', 84, 83, 1, 0, 0, '2025-04-15 20:06:26'),
(33, 1, 3, 5, 5, 'sub', '10', 'counter_sale', 8.55, 7.55, 1, 0, 0, '2025-04-15 20:06:26'),
(34, 1, 3, 6, 6, 'sub', '10', 'counter_sale', 83, 82, 1, 0, 0, '2025-04-15 20:06:26'),
(35, 1, 3, 2, 2, 'sub', '11', 'counter_sale', 83, 82, 1, 0, 0, '2025-04-15 20:07:10'),
(36, 1, 3, 4, 4, 'sub', '11', 'counter_sale', 3.7, 2.7, 1, 0, 0, '2025-04-15 20:07:10'),
(37, 1, 3, 2, 2, 'sub', '12', 'counter_sale', 82, 81, 1, 0, 0, '2025-04-15 20:07:20'),
(38, 1, 3, 5, 5, 'sub', '12', 'counter_sale', 7.55, 6.55, 1, 0, 0, '2025-04-15 20:07:20'),
(39, 1, 3, 6, 6, 'sub', '12', 'counter_sale', 82, 81, 1, 0, 0, '2025-04-15 20:07:20'),
(40, 1, 3, 4, 4, 'sub', '13', 'counter_sale', 2.7, 1.7, 1, 0, 0, '2025-04-15 20:07:37'),
(41, 1, 3, 2, 2, 'sub', '13', 'counter_sale', 81, 80, 1, 0, 0, '2025-04-15 20:07:37'),
(42, 1, 3, 8, 8, 'sub', '13', 'counter_sale', 100, 99, 1, 0, 0, '2025-04-15 20:07:37'),
(43, 1, 3, 2, 2, 'sub', '14', 'counter_sale', 80, 79, 1, 0, 0, '2025-04-15 20:07:50'),
(44, 1, 3, 4, 4, 'sub', '14', 'counter_sale', 1.7, 0.7, 1, 0, 0, '2025-04-15 20:07:50'),
(45, 1, 3, 2, 2, 'sub', '15', 'counter_sale', 79, 78, 1, 0, 0, '2025-04-15 20:09:26'),
(46, 1, 3, 5, 5, 'sub', '16', 'counter_sale', 6.55, 5.55, 1, 0, 0, '2025-04-15 20:18:41'),
(47, 1, 3, 2, 2, 'sub', '17', 'counter_sale', 78, 77, 1, 0, 0, '2025-04-15 20:21:00'),
(48, 1, 3, 2, 2, 'sub', '17', 'counter_sale', 77, 76, 1, 0, 0, '2025-04-15 20:21:00'),
(49, 1, 3, 5, 5, 'sub', '17', 'counter_sale', 5.55, 4.55, 1, 0, 0, '2025-04-15 20:21:00'),
(50, 1, 3, 6, 6, 'sub', '17', 'counter_sale', 81, 80, 1, 0, 0, '2025-04-15 20:21:00'),
(51, 1, 3, 2, 2, 'sub', '18', 'counter_sale', 76, 75, 1, 0, 0, '2025-04-15 20:21:09'),
(52, 1, 3, 6, 6, 'sub', '18', 'counter_sale', 80, 79, 1, 0, 0, '2025-04-15 20:21:09'),
(53, 1, 3, 2, 2, 'sub', '19', 'counter_sale', 75, 74, 1, 0, 0, '2025-04-15 20:24:11'),
(54, 1, 3, 2, 2, 'sub', '20', 'counter_sale', 74, 73, 1, 0, 0, '2025-04-15 20:45:17'),
(55, 1, 3, 5, 5, 'sub', '20', 'counter_sale', 4.55, 3.55, 1, 0, 0, '2025-04-15 20:45:17'),
(56, 1, 2, 357, 389, 'add', NULL, 'Stock Update', 0, 2, 2, 0, 0, '2025-04-21 20:01:10'),
(57, 1, 2, 355, 387, 'add', NULL, 'Stock Update', 0, 10, 10, 0, 0, '2025-04-21 20:01:10'),
(58, 1, 2, 354, 386, 'add', NULL, 'Stock Update', 0, 7, 7, 0, 0, '2025-04-21 20:01:10'),
(59, 1, 2, 353, 385, 'add', NULL, 'Stock Update', 0, 8, 8, 0, 0, '2025-04-21 20:01:10'),
(60, 1, 2, 352, 384, 'add', NULL, 'Stock Update', 0, 18, 18, 0, 0, '2025-04-21 20:01:10'),
(61, 1, 2, 365, 397, 'add', NULL, 'Stock Update', 0, 2, 2, 0, 0, '2025-04-21 20:04:25'),
(62, 1, 2, 364, 396, 'add', NULL, 'Stock Update', 0, 2, 2, 0, 0, '2025-04-21 20:04:25'),
(63, 1, 2, 363, 395, 'add', NULL, 'Stock Update', 0, 2, 2, 0, 0, '2025-04-21 20:04:25'),
(64, 1, 2, 362, 394, 'add', NULL, 'Stock Update', 0, 2.5, 2.5, 0, 0, '2025-04-21 20:04:25'),
(65, 1, 2, 361, 393, 'add', NULL, 'Stock Update', 0, 1.5, 1.5, 0, 0, '2025-04-21 20:04:25'),
(66, 1, 2, 360, 392, 'add', NULL, 'Stock Update', 0, 2, 2, 0, 0, '2025-04-21 20:04:25'),
(67, 1, 2, 359, 391, 'add', NULL, 'Stock Update', 0, 2.5, 2.5, 0, 0, '2025-04-21 20:04:25'),
(68, 1, 2, 358, 390, 'add', NULL, 'Stock Update', 0, 2, 2, 0, 0, '2025-04-21 20:04:25'),
(69, 1, 3, 77, 77, 'sub', '1', 'counter_sale', 11, 10, 1, 0, 0, '2025-04-23 14:21:26'),
(70, 1, 3, 62, 62, 'sub', '2', 'counter_sale', 4, 3, 1, 0, 0, '2025-04-23 19:26:41'),
(71, 1, 3, 70, 70, 'sub', '3', 'counter_sale', 10, 9, 1, 0, 0, '2025-04-23 23:02:06'),
(72, 1, 3, 41, 41, 'sub', '4', 'counter_sale', 7, 6, 1, 0, 0, '2025-04-24 18:48:32'),
(73, 1, 3, 36, 36, 'sub', '4', 'counter_sale', 7, 6, 1, 0, 0, '2025-04-24 18:48:32'),
(74, 1, 3, 20, 20, 'sub', '6', 'counter_sale', 5, 4, 1, 0, 0, '2025-04-24 20:09:37'),
(75, 1, 3, 78, 78, 'sub', '6', 'counter_sale', 21, 20, 1, 0, 0, '2025-04-24 20:09:37'),
(76, 1, 3, 64, 64, 'sub', '9', 'counter_sale', 5, 4, 1, 0, 0, '2025-04-24 22:49:19'),
(77, 1, 3, 33, 33, 'sub', '9', 'counter_sale', 5, 4, 1, 0, 0, '2025-04-24 22:49:19'),
(78, 1, 3, 9, 9, 'sub', '9', 'counter_sale', 5, 4, 1, 0, 0, '2025-04-24 22:49:19'),
(79, 1, 3, 67, 67, 'sub', '11', 'counter_sale', 10, 9, 1, 0, 0, '2025-04-25 18:29:06'),
(80, 1, 3, 18, 18, 'sub', '11', 'counter_sale', 5, 4, 1, 0, 0, '2025-04-25 18:29:06'),
(81, 1, 3, 72, 72, 'sub', '12', 'counter_sale', 10, 9, 1, 0, 0, '2025-04-25 22:05:46'),
(82, 1, 3, 70, 70, 'sub', '12', 'counter_sale', 9, 8, 1, 0, 0, '2025-04-25 22:05:46'),
(83, 1, 3, 73, 73, 'sub', '13', 'counter_sale', 10, 9, 1, 0, 0, '2025-04-25 23:05:36'),
(84, 1, 3, 80, 80, 'sub', '13', 'counter_sale', 11, 10, 1, 0, 0, '2025-04-25 23:05:36'),
(85, 1, 3, 80, 80, 'sub', '14', 'counter_sale', 10, 9, 1, 0, 0, '2025-04-25 23:06:44'),
(86, 1, 3, 73, 73, 'sub', '14', 'counter_sale', 9, 8, 1, 0, 0, '2025-04-25 23:06:44'),
(87, 1, 3, 61, 61, 'sub', '15', 'counter_sale', 5, 4, 1, 0, 0, '2025-04-25 23:29:53'),
(88, 1, 3, 69, 69, 'sub', '15', 'counter_sale', 9, 8, 1, 0, 0, '2025-04-25 23:29:53'),
(89, 1, 3, 64, 64, 'sub', '15', 'counter_sale', 4, 3, 1, 0, 0, '2025-04-25 23:29:53'),
(90, 1, 3, 77, 77, 'sub', '16', 'counter_sale', 10, 9, 1, 0, 0, '2025-04-25 23:30:45'),
(91, 1, 3, 75, 75, 'sub', '16', 'counter_sale', 26, 25, 1, 0, 0, '2025-04-25 23:30:45'),
(92, 1, 3, 21, 21, 'sub', '16', 'counter_sale', 7, 6, 1, 0, 0, '2025-04-25 23:30:45'),
(93, 1, 3, 80, 80, 'sub', '17', 'counter_sale', 9, 8, 1, 0, 0, '2025-04-26 09:49:54'),
(94, 1, 3, 38, 38, 'sub', '17', 'counter_sale', 5, 4, 1, 0, 0, '2025-04-26 09:49:54'),
(95, 1, 3, 22, 22, 'sub', '17', 'counter_sale', 4, 3, 1, 0, 0, '2025-04-26 09:49:54'),
(96, 1, 3, 81, 81, 'sub', '17', 'counter_sale', 10, 9, 1, 0, 0, '2025-04-26 09:49:54'),
(97, 1, 2, 43, 43, 'add', '3', 'Production', 5, 6, 1, 0, 0, '2025-04-26 14:36:53'),
(98, 1, 2, 7, 7, 'sub', '3', 'Production', 0, -1, 1, 0, 0, '2025-04-26 14:36:53'),
(99, 1, 2, 424, 456, 'sub', '3', 'Production', 0, -1, 1, 0, 0, '2025-04-26 14:36:53'),
(100, 1, 2, 420, 452, 'sub', '3', 'Production', 0, -1, 1, 0, 0, '2025-04-26 14:36:53'),
(101, 1, 2, 423, 455, 'sub', '3', 'Production', 0, -1, 1, 0, 0, '2025-04-26 14:36:53'),
(102, 1, 2, 436, 468, 'sub', '3', 'Production', 0, -0.3, 0.3, 0, 0, '2025-04-26 14:36:53'),
(103, 1, 2, 91, 123, 'sub', '3', 'Production', 0, -0.025, 0.025, 0, 0, '2025-04-26 14:36:53'),
(104, 1, 2, 43, 43, 'add', '4', 'Production', 6, 7, 1, 0, 0, '2025-04-26 14:41:32'),
(105, 1, 2, 7, 7, 'sub', '4', 'Production', -1, -2, 1, 0, 0, '2025-04-26 14:41:32'),
(106, 1, 2, 424, 456, 'sub', '4', 'Production', -1, -2, 1, 0, 0, '2025-04-26 14:41:32'),
(107, 1, 2, 420, 452, 'sub', '4', 'Production', -1, -2, 1, 0, 0, '2025-04-26 14:41:32'),
(108, 1, 2, 423, 455, 'sub', '4', 'Production', -1, -2, 1, 0, 0, '2025-04-26 14:41:32'),
(109, 1, 2, 436, 468, 'sub', '4', 'Production', -0.3, -0.33, 0.03, 0, 0, '2025-04-26 14:41:32'),
(110, 1, 2, 91, 123, 'sub', '4', 'Production', -0.025, -0.05, 0.025, 0, 0, '2025-04-26 14:41:32'),
(111, 1, 2, 43, 43, 'add', '5', 'Production', 7, 8, 1, 0, 0, '2025-04-26 14:44:15'),
(112, 1, 2, 7, 7, 'sub', '5', 'Production', -2, -3, 1, 0, 0, '2025-04-26 14:44:15'),
(113, 1, 2, 424, 456, 'sub', '5', 'Production', -2, -3, 1, 0, 0, '2025-04-26 14:44:15'),
(114, 1, 2, 420, 452, 'sub', '5', 'Production', -2, -3, 1, 0, 0, '2025-04-26 14:44:15'),
(115, 1, 2, 423, 455, 'sub', '5', 'Production', -2, -3, 1, 0, 0, '2025-04-26 14:44:15'),
(116, 1, 2, 436, 468, 'sub', '5', 'Production', -0.33, -0.36, 0.03, 0, 0, '2025-04-26 14:44:15'),
(117, 1, 2, 91, 123, 'sub', '5', 'Production', -0.05, -0.075, 0.025, 0, 0, '2025-04-26 14:44:15'),
(118, 1, 2, 43, 43, 'sub', '1', 'Stock adjustment', 8, 5, -3, 0, 0, '2025-04-26 18:41:34'),
(119, 1, 2, 7, 7, 'sub', '11', 'Production', -8, -9, 1, 0, 0, '2025-04-26 18:42:55'),
(120, 1, 2, 424, 456, 'sub', '11', 'Production', -3, -4, 1, 1, 0, '2025-04-26 18:42:55'),
(121, 1, 2, 420, 452, 'sub', '11', 'Production', -3, -4, 1, 1, 0, '2025-04-26 18:42:55'),
(122, 1, 2, 423, 455, 'sub', '11', 'Production', -3, -4, 1, 0.5, 0, '2025-04-26 18:42:55'),
(123, 1, 2, 436, 468, 'sub', '11', 'Production', -0.36, -0.39, 0.03, 0, 0, '2025-04-26 18:42:55'),
(124, 1, 2, 91, 123, 'sub', '11', 'Production', -0.075, -0.1, 0.025, 0, 0, '2025-04-26 18:42:55'),
(125, 1, 2, 43, 43, 'add', '11', 'Production', 5, 6, 1, 0.41666666666667, 2.5, '2025-04-26 18:42:55'),
(126, 1, 3, 429, 461, 'sub', '42', 'Counter Sale', -3, -4, 1, 0, 0, '2025-04-26 18:47:55'),
(127, 1, 2, 7, 7, 'sub', '12', 'Production', -9, -10, 1, 0, 0, '2025-04-26 18:48:40'),
(128, 1, 2, 424, 456, 'sub', '12', 'Production', -4, -5, 1, 1, 0, '2025-04-26 18:48:40'),
(129, 1, 2, 420, 452, 'sub', '12', 'Production', -4, -5, 1, 1, 0, '2025-04-26 18:48:40'),
(130, 1, 2, 423, 455, 'sub', '12', 'Production', -4, -5, 1, 0.5, 0, '2025-04-26 18:48:40'),
(131, 1, 2, 436, 468, 'sub', '12', 'Production', -0.39, -0.42, 0.03, 0, 0, '2025-04-26 18:48:40'),
(132, 1, 2, 91, 123, 'sub', '12', 'Production', -0.1, -0.125, 0.025, 0, 0, '2025-04-26 18:48:40'),
(133, 1, 2, 43, 43, 'add', '12', 'Production', 6, 7, 1, 0.71428571428571, 5, '2025-04-26 18:48:40'),
(134, 1, 2, 7, 7, 'sub', '13', 'Production', -10, -11, 1, 0, 0, '2025-04-26 18:48:49'),
(135, 1, 2, 424, 456, 'sub', '13', 'Production', -5, -6, 1, 1, 0, '2025-04-26 18:48:49'),
(136, 1, 2, 420, 452, 'sub', '13', 'Production', -5, -6, 1, 1, 0, '2025-04-26 18:48:49'),
(137, 1, 2, 423, 455, 'sub', '13', 'Production', -5, -6, 1, 0.5, 0, '2025-04-26 18:48:49'),
(138, 1, 2, 436, 468, 'sub', '13', 'Production', -0.42, -0.45, 0.03, 0, 0, '2025-04-26 18:48:49'),
(139, 1, 2, 91, 123, 'sub', '13', 'Production', -0.125, -0.15, 0.025, 0, 0, '2025-04-26 18:48:49'),
(140, 1, 2, 43, 43, 'add', '13', 'Production', 7, 8, 1, 0.9375, 7.5, '2025-04-26 18:48:49'),
(141, 1, 3, 432, 464, 'sub', '43', 'Counter Sale', 0, -2, 2, 0, 0, '2025-04-26 18:50:33'),
(142, 1, 3, 430, 462, 'sub', '44', 'Counter Sale', 0, -1, 1, 0, 0, '2025-04-26 18:50:33'),
(143, 1, 3, 429, 461, 'sub', '45', 'Counter Sale', -4, -5, 1, 0, 0, '2025-04-26 18:50:33'),
(144, 1, 2, 7, 7, 'sub', '14', 'Production', -11, -16, 5, 0, 0, '2025-04-26 18:53:43'),
(145, 1, 2, 424, 456, 'sub', '14', 'Production', -6, -11, 5, 1, 0, '2025-04-26 18:53:43'),
(146, 1, 2, 420, 452, 'sub', '14', 'Production', -6, -11, 5, 1, 0, '2025-04-26 18:53:43'),
(147, 1, 2, 24, 24, 'add', '14', 'Production', 5, 10, 5, 1, 10, '2025-04-26 18:53:43'),
(148, 1, 3, 68, 68, 'sub', '46', 'Counter Sale', 11, 10, 1, 50, 500, '2025-04-26 18:55:27'),
(149, 1, 3, 64, 64, 'sub', '47', 'Counter Sale', 3, 2, 1, 50, 100, '2025-04-26 18:55:27'),
(150, 1, 3, 77, 77, 'sub', '48', 'Counter Sale', 9, 7, 2, 50, 350, '2025-04-26 19:02:03'),
(151, 1, 3, 30, 30, 'sub', '49', 'Counter Sale', 5, 3, 2, 50, 150, '2025-04-26 19:02:03'),
(152, 1, 3, 425, 457, 'sub', '50', 'Counter Sale', 0, -2, 2, 0, 0, '2025-04-26 19:02:03'),
(153, 1, 3, 428, 460, 'sub', '51', 'Counter Sale', 0, -1, 1, 0, 0, '2025-04-26 19:02:03'),
(154, 1, 3, 37, 37, 'sub', '52', 'Counter Sale', 5, 4, 1, 50, 200, '2025-04-26 19:02:03'),
(155, 1, 3, 70, 70, 'sub', '53', 'Counter Sale', 8, 7, 1, 50, 350, '2025-04-26 19:02:03'),
(156, 1, 3, 72, 72, 'sub', '54', 'Counter Sale', 9, 8, 1, 50, 400, '2025-04-26 19:02:03'),
(157, 1, 3, 75, 75, 'sub', '55', 'Counter Sale', 25, 24, 1, 50, 1200, '2025-04-26 19:02:03'),
(158, 1, 3, 80, 80, 'sub', '56', 'Counter Sale', 8, 7, 1, 50, 350, '2025-04-26 19:02:03'),
(159, 1, 3, 81, 81, 'sub', '57', 'Counter Sale', 9, 8, 1, 50, 400, '2025-04-26 19:02:03'),
(160, 1, 3, 13, 13, 'sub', '58', 'Counter Sale', 5, 4, 1, 50, 200, '2025-04-26 19:02:03'),
(161, 1, 3, 76, 76, 'sub', '59', 'Counter Sale', 11, 10, 1, 50, 500, '2025-04-26 19:02:03'),
(162, 1, 3, 61, 61, 'sub', '60', 'Counter Sale', 4, 3, 1, 50, 150, '2025-04-26 19:02:03'),
(163, 1, 3, 24, 24, 'sub', '61', 'Counter Sale', 10, 9, 1, 1, 9, '2025-04-26 19:04:59'),
(164, 1, 3, 429, 461, 'sub', '62', 'Counter Sale', -5, -6, 1, 0, 0, '2025-04-26 19:04:59'),
(165, 1, 3, 23, 23, 'sub', '63', 'Counter Sale', 8, 7, 1, 50, 350, '2025-04-26 19:04:59'),
(166, 1, 3, 44, 44, 'sub', '64', 'Counter Sale', 7, 6, 1, 50, 300, '2025-04-26 19:04:59'),
(167, 1, 3, 80, 80, 'sub', '65', 'Counter Sale', 7, 6, 1, 50, 300, '2025-04-26 19:04:59'),
(168, 1, 3, 18, 18, 'sub', '66', 'Counter Sale', 4, 3, 1, 50, 150, '2025-04-26 22:12:31'),
(169, 1, 3, 68, 68, 'sub', '67', 'Counter Sale', 10, 9, 1, 50, 450, '2025-04-26 22:12:31'),
(170, 1, 3, 435, 467, 'sub', '68', 'Counter Sale', 0, -1, 1, 0, 0, '2025-04-26 23:28:57'),
(171, 1, 3, 44, 44, 'sub', '69', 'Counter Sale', 6, 5, 1, 50, 250, '2025-04-26 23:28:57'),
(172, 1, 3, 71, 71, 'sub', '70', 'Counter Sale', 30, 29, 1, 50, 1450, '2025-04-26 23:28:57'),
(173, 1, 3, 75, 75, 'sub', '71', 'Counter Sale', 24, 23, 1, 50, 1150, '2025-04-26 23:28:57'),
(174, 1, 3, 80, 80, 'sub', '72', 'Counter Sale', 6, 5, 1, 50, 250, '2025-04-26 23:28:57'),
(175, 1, 3, 41, 41, 'sub', '73', 'Counter Sale', 6, 5, 1, 50, 250, '2025-04-26 23:28:57'),
(176, 1, 3, 55, 55, 'sub', '74', 'Counter Sale', 5, 4, 1, 50, 200, '2025-04-26 23:28:57'),
(177, 1, 3, 548, 580, 'sub', '75', 'Counter Sale', 0, -1, 1, 0, 0, '2025-04-27 20:54:06'),
(178, 1, 3, 36, 36, 'sub', '76', 'Counter Sale', 6, 5, 1, 50, 250, '2025-04-27 22:10:16'),
(179, 1, 3, 30, 30, 'sub', '77', 'Counter Sale', 3, 2, 1, 50, 100, '2025-04-27 22:10:16'),
(180, 1, 3, 41, 41, 'sub', '78', 'Counter Sale', 5, 4, 1, 50, 200, '2025-04-27 22:53:25'),
(181, 1, 3, 30, 30, 'sub', '79', 'Counter Sale', 2, 1, 1, 50, 50, '2025-04-28 00:08:07'),
(182, 1, 3, 432, 464, 'sub', '80', 'Counter Sale', -2, -3, 1, 0, 0, '2025-04-28 00:08:07'),
(183, 1, 3, 37, 37, 'sub', '81', 'Counter Sale', 4, 3, 1, 50, 150, '2025-04-28 00:08:07'),
(184, 1, 3, 67, 67, 'sub', '82', 'Counter Sale', 9, 7, 2, 50, 350, '2025-04-28 00:08:07'),
(185, 1, 3, 426, 458, 'sub', '83', 'Counter Sale', 0, -1, 1, 0, 0, '2025-04-28 00:08:07'),
(186, 1, 3, 77, 77, 'sub', '84', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-28 14:02:26'),
(187, 1, 3, 69, 69, 'sub', '85', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-28 17:15:12'),
(188, 1, 3, 68, 68, 'sub', '86', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-28 17:15:12'),
(189, 1, 3, 66, 66, 'sub', '87', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-28 17:15:12'),
(190, 1, 3, 72, 72, 'sub', '88', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-28 17:15:12'),
(191, 1, 3, 23, 23, 'sub', '89', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-28 17:15:12'),
(192, 1, 3, 434, 466, 'sub', '90', 'Counter Sale', 0, -1, 1, 0, 0, '2025-04-28 17:15:12'),
(193, 1, 3, 80, 80, 'sub', '91', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-28 17:48:52'),
(194, 1, 2, 7, 7, 'add', NULL, 'Direct Stock Update', -16, 984, 1000, 1, 984, '2025-04-28 18:45:20'),
(195, 1, 2, 453, 485, 'add', NULL, 'Direct Stock Update', 0, 500, 500, 1, 500, '2025-04-28 18:50:12'),
(196, 1, 2, 453, 485, 'add', NULL, 'Direct Stock Update', 500, 1000, 500, 1, 1000, '2025-04-28 18:50:13'),
(197, 1, 2, 453, 485, 'add', NULL, 'Direct Stock Update', 1000, 1500, 500, 1, 1500, '2025-04-28 18:50:15'),
(198, 1, 2, 453, 485, 'sub', NULL, 'Direct Stock Update', 1500, 500, 1000, 1, 500, '2025-04-28 18:50:37'),
(199, 1, 2, 470, 502, 'add', NULL, 'Direct Stock Update', 0, 500, 500, 1, 500, '2025-04-28 18:51:18'),
(200, 1, 2, 470, 502, 'add', NULL, 'Direct Stock Update', 500, 1000, 500, 1, 1000, '2025-04-28 18:51:18'),
(201, 1, 2, 553, 585, 'add', NULL, 'Direct Stock Update', 0, 500, 500, 1, 500, '2025-04-28 18:59:39'),
(202, 1, 2, 267, 299, 'sub', '15', 'Production', 0, -0.15, 0.15, 830, 0, '2025-04-28 19:10:57'),
(203, 1, 2, 7, 7, 'sub', '15', 'Production', 984, 978, 6, 1, 978, '2025-04-28 19:10:57'),
(204, 1, 2, 453, 485, 'sub', '15', 'Production', 500, 494, 6, 1, 494, '2025-04-28 19:10:57'),
(205, 1, 2, 436, 468, 'sub', '15', 'Production', -0.45, -0.63, 0.18, 0, 0, '2025-04-28 19:10:57'),
(206, 1, 2, 420, 452, 'sub', '15', 'Production', -11, -17, 6, 1, 0, '2025-04-28 19:10:57'),
(207, 1, 2, 423, 455, 'sub', '15', 'Production', -6, -12, 6, 0.5, 0, '2025-04-28 19:10:57'),
(208, 1, 2, 267, 299, 'sub', '16', 'Production', -0.15, -0.3, 0.15, 830, 0, '2025-04-28 19:13:13'),
(209, 1, 2, 7, 7, 'sub', '16', 'Production', 978, 972, 6, 1, 972, '2025-04-28 19:13:13'),
(210, 1, 2, 453, 485, 'sub', '16', 'Production', 494, 488, 6, 1, 488, '2025-04-28 19:13:13'),
(211, 1, 2, 436, 468, 'sub', '16', 'Production', -0.63, -0.81, 0.18, 0, 0, '2025-04-28 19:13:13'),
(212, 1, 2, 420, 452, 'sub', '16', 'Production', -17, -23, 6, 1, 0, '2025-04-28 19:13:13'),
(213, 1, 2, 423, 455, 'sub', '16', 'Production', -12, -18, 6, 0.5, 0, '2025-04-28 19:13:13'),
(214, 1, 2, 267, 299, 'sub', '17', 'Production', -0.3, -0.325, 0.025, 830, 0, '2025-04-28 19:14:16'),
(215, 1, 2, 7, 7, 'sub', '17', 'Production', 972, 971, 1, 1, 971, '2025-04-28 19:14:16'),
(216, 1, 2, 453, 485, 'sub', '17', 'Production', 488, 487, 1, 1, 487, '2025-04-28 19:14:16'),
(217, 1, 2, 436, 468, 'sub', '17', 'Production', -0.81, -0.84, 0.03, 0, 0, '2025-04-28 19:14:16'),
(218, 1, 2, 420, 452, 'sub', '17', 'Production', -23, -24, 1, 1, 0, '2025-04-28 19:14:16'),
(219, 1, 2, 423, 455, 'sub', '17', 'Production', -18, -19, 1, 0.5, 0, '2025-04-28 19:14:16'),
(220, 1, 2, 267, 299, 'sub', '18', 'Production', -0.325, -0.475, 0.15, 830, 0, '2025-04-28 19:15:37'),
(221, 1, 2, 7, 7, 'sub', '18', 'Production', 971, 965, 6, 1, 965, '2025-04-28 19:15:37'),
(222, 1, 2, 453, 485, 'sub', '18', 'Production', 487, 481, 6, 1, 481, '2025-04-28 19:15:37'),
(223, 1, 2, 436, 468, 'sub', '18', 'Production', -0.84, -1.02, 0.18, 0, 0, '2025-04-28 19:15:37'),
(224, 1, 2, 420, 452, 'sub', '18', 'Production', -24, -30, 6, 1, 0, '2025-04-28 19:15:37'),
(225, 1, 2, 423, 455, 'sub', '18', 'Production', -19, -25, 6, 0.5, 0, '2025-04-28 19:15:37'),
(226, 1, 2, 18, 18, 'add', '18', 'Production', 13, 19, 6, 24.25, 460.75, '2025-04-28 19:15:37'),
(227, 1, 2, 267, 299, 'sub', '19', 'Production', -0.475, -0.625, 0.15, 830, 0, '2025-04-28 19:18:23'),
(228, 1, 2, 7, 7, 'sub', '19', 'Production', 965, 959, 6, 1, 959, '2025-04-28 19:18:23'),
(229, 1, 2, 453, 485, 'sub', '19', 'Production', 481, 475, 6, 1, 475, '2025-04-28 19:18:23'),
(230, 1, 2, 436, 468, 'sub', '19', 'Production', -1.02, -1.2, 0.18, 0, 0, '2025-04-28 19:18:23'),
(231, 1, 2, 420, 452, 'sub', '19', 'Production', -30, -36, 6, 1, 0, '2025-04-28 19:18:23'),
(232, 1, 2, 423, 455, 'sub', '19', 'Production', -25, -31, 6, 0.5, 0, '2025-04-28 19:18:23'),
(233, 1, 2, 553, 585, 'sub', '19', 'Production', 500, 494, 6, 1, 494, '2025-04-28 19:18:23'),
(234, 1, 2, 18, 18, 'add', '19', 'Production', 19, 25, 6, 24.49, 612.25, '2025-04-28 19:18:23'),
(235, 1, 2, 553, 585, 'add', NULL, 'Direct Stock Update', 494, 500, 6, 1.006, 503, '2025-04-28 19:27:26'),
(236, 1, 2, 553, 585, 'add', NULL, 'Direct Stock Update', 500, 506, 6, 1.0118577075099, 512, '2025-04-28 19:27:28'),
(237, 1, 2, 553, 585, 'add', NULL, 'Direct Stock Update', 506, 512, 6, 1.017578125, 521, '2025-04-28 19:27:30'),
(238, 1, 2, 553, 585, 'add', NULL, 'Direct Stock Update', 512, 518, 6, 1.023166023166, 530, '2025-04-28 19:27:30'),
(239, 1, 2, 553, 585, 'add', NULL, 'Direct Stock Update', 518, 524, 6, 1.0286259541985, 539, '2025-04-28 19:27:30'),
(240, 1, 2, 267, 299, 'sub', '20', 'Production', -0.625, -0.65, 0.025, 830, 0, '2025-04-28 19:28:04'),
(241, 1, 2, 7, 7, 'sub', '20', 'Production', 959, 958, 1, 1, 958, '2025-04-28 19:28:04'),
(242, 1, 2, 453, 485, 'sub', '20', 'Production', 475, 474, 1, 1, 474, '2025-04-28 19:28:04'),
(243, 1, 2, 436, 468, 'sub', '20', 'Production', -1.2, -1.23, 0.03, 0, 0, '2025-04-28 19:28:04'),
(244, 1, 2, 420, 452, 'sub', '20', 'Production', -36, -37, 1, 1, 0, '2025-04-28 19:28:04'),
(245, 1, 2, 423, 455, 'sub', '20', 'Production', -31, -32, 1, 0.5, 0, '2025-04-28 19:28:04'),
(246, 1, 2, 553, 585, 'sub', '20', 'Production', 524, 523, 1, 1.0286259541985, 537.97137404582, '2025-04-28 19:28:04'),
(247, 1, 2, 18, 18, 'add', '20', 'Production', 25, 26, 1, 24.520331767469, 637.5286259542, '2025-04-28 19:28:04'),
(248, 1, 2, 267, 299, 'sub', '21', 'Production', -0.65, -0.9, 0.25, 830, 0, '2025-04-28 19:38:23'),
(249, 1, 2, 7, 7, 'sub', '21', 'Production', 958, 957, 1, 1, 957, '2025-04-28 19:38:23'),
(250, 1, 2, 453, 485, 'sub', '21', 'Production', 474, 473, 1, 1, 473, '2025-04-28 19:38:23'),
(251, 1, 2, 436, 468, 'sub', '21', 'Production', -1.23, -1.53, 0.3, 0, 0, '2025-04-28 19:38:23'),
(252, 1, 2, 420, 452, 'sub', '21', 'Production', -37, -38, 1, 1, 0, '2025-04-28 19:38:23'),
(253, 1, 2, 423, 455, 'sub', '21', 'Production', -32, -33, 1, 0.5, 0, '2025-04-28 19:38:23'),
(254, 1, 2, 553, 585, 'sub', '21', 'Production', 523, 522, 1, 1.0286259541985, 536.94274809162, '2025-04-28 19:38:23'),
(255, 1, 2, 18, 18, 'add', '21', 'Production', 26, 27, 1, 31.465083404015, 849.5572519084, '2025-04-28 19:38:23'),
(256, 1, 2, 18, 18, 'sub', '2', 'Stock adjustment', 27, 0, -27, 0, 0, '2025-04-28 19:51:10'),
(257, 1, 2, 267, 299, 'sub', '22', 'Production', -0.9, -1.15, 0.25, 830, 0, '2025-04-28 19:54:24'),
(258, 1, 2, 7, 7, 'sub', '22', 'Production', 957, 956, 1, 1, 956, '2025-04-28 19:54:25'),
(259, 1, 2, 453, 485, 'sub', '22', 'Production', 473, 472, 1, 1, 472, '2025-04-28 19:54:25'),
(260, 1, 2, 436, 468, 'sub', '22', 'Production', -1.53, -2.53, 1, 0, 0, '2025-04-28 19:54:25'),
(261, 1, 2, 420, 452, 'sub', '22', 'Production', -38, -39, 1, 1, 0, '2025-04-28 19:54:25'),
(262, 1, 2, 423, 455, 'sub', '22', 'Production', -33, -34, 1, 0.5, 0, '2025-04-28 19:54:25'),
(263, 1, 2, 553, 585, 'sub', '22', 'Production', 522, 521, 1, 1.0286259541985, 535.91412213742, '2025-04-28 19:54:25'),
(264, 1, 2, 18, 18, 'add', '22', 'Production', 0, 1, 1, 1061.5858778626, 1061.5858778626, '2025-04-28 19:54:25'),
(265, 1, 2, 267, 299, 'sub', '23', 'Production', -1.15, -1.4, 0.25, 830, 0, '2025-04-28 19:55:37'),
(266, 1, 2, 7, 7, 'sub', '23', 'Production', 956, 955, 1, 1, 955, '2025-04-28 19:55:37'),
(267, 1, 2, 453, 485, 'sub', '23', 'Production', 472, 471, 1, 1, 471, '2025-04-28 19:55:37'),
(268, 1, 2, 436, 468, 'sub', '23', 'Production', -2.53, -2.905, 0.375, 0, 0, '2025-04-28 19:55:37'),
(269, 1, 2, 420, 452, 'sub', '23', 'Production', -39, -40, 1, 1, 0, '2025-04-28 19:55:37'),
(270, 1, 2, 423, 455, 'sub', '23', 'Production', -34, -35, 1, 0.5, 0, '2025-04-28 19:55:37'),
(271, 1, 2, 553, 585, 'sub', '23', 'Production', 521, 520, 1, 1.0286259541985, 534.88549618322, '2025-04-28 19:55:37'),
(272, 1, 2, 18, 18, 'add', '23', 'Production', 1, 2, 1, 636.8072519084, 1273.6145038168, '2025-04-28 19:55:37'),
(273, 1, 3, 78, 78, 'sub', '92', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-28 22:43:02'),
(274, 1, 3, 76, 76, 'sub', '93', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-28 22:43:02'),
(275, 1, 3, 79, 79, 'sub', '94', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-28 23:02:20'),
(276, 1, 3, 77, 77, 'sub', '95', 'Counter Sale', -1, -2, 1, 50, 0, '2025-04-28 23:02:20'),
(277, 1, 3, 20, 20, 'sub', '96', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-28 23:02:20'),
(278, 1, 3, 61, 61, 'sub', '97', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-29 17:14:26'),
(279, 1, 3, 50, 50, 'sub', '98', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-29 20:13:45'),
(280, 1, 3, 21, 21, 'sub', '99', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-29 20:19:06'),
(281, 1, 3, 15, 15, 'sub', '100', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-29 20:30:03'),
(282, 1, 3, 59, 59, 'sub', '101', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-29 20:30:03'),
(283, 1, 3, 71, 71, 'sub', '102', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-29 20:30:03'),
(284, 1, 3, 67, 67, 'sub', '103', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-29 20:30:03'),
(285, 1, 3, 18, 18, 'sub', '104', 'Counter Sale', 2, 1, 1, 636.8072519084, 636.8072519084, '2025-04-29 20:30:03'),
(286, 1, 3, 73, 73, 'sub', '105', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-29 20:30:03'),
(287, 1, 3, 28, 28, 'sub', '106', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-29 20:30:03'),
(288, 1, 3, 73, 73, 'sub', '107', 'Counter Sale', -1, -2, 1, 50, 0, '2025-04-29 21:25:12'),
(289, 1, 3, 70, 70, 'sub', '108', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-29 21:53:31'),
(290, 1, 3, 429, 461, 'sub', '109', 'Counter Sale', 0, -1, 1, 0, 0, '2025-04-29 21:53:31'),
(291, 1, 2, 7, 7, 'sub', '24', 'Production', 955, 954, 1, 1, 954, '2025-04-30 10:11:47'),
(292, 1, 2, 420, 452, 'sub', '24', 'Production', -40, -41, 1, 1, 0, '2025-04-30 10:11:47'),
(293, 1, 2, 436, 468, 'sub', '24', 'Production', -2.905, -2.935, 0.03, 0, 0, '2025-04-30 10:11:47'),
(294, 1, 2, 453, 485, 'sub', '24', 'Production', 471, 470, 1, 1, 470, '2025-04-30 10:11:47'),
(295, 1, 2, 423, 455, 'sub', '24', 'Production', -35, -36, 1, 0.5, 0, '2025-04-30 10:11:47'),
(296, 1, 2, 553, 585, 'sub', '24', 'Production', 520, 519, 1, 1.0286259541985, 533.85687022902, '2025-04-30 10:11:47'),
(297, 1, 2, 102, 134, 'sub', '24', 'Production', 0, -0.025, 0.025, 430, 0, '2025-04-30 10:11:47'),
(298, 1, 2, 45, 45, 'add', '24', 'Production', 0, 1, 1, 15.278625954198, 15.278625954198, '2025-04-30 10:11:47'),
(299, 1, 2, 7, 7, 'sub', '25', 'Production', 954, 953, 1, 1, 953, '2025-04-30 10:14:57'),
(300, 1, 2, 420, 452, 'sub', '25', 'Production', -41, -42, 1, 1, 0, '2025-04-30 10:14:57'),
(301, 1, 2, 436, 468, 'sub', '25', 'Production', -2.935, -2.965, 0.03, 0, 0, '2025-04-30 10:14:57'),
(302, 1, 2, 453, 485, 'sub', '25', 'Production', 470, 469, 1, 1, 469, '2025-04-30 10:14:57'),
(303, 1, 2, 423, 455, 'sub', '25', 'Production', -36, -37, 1, 0.5, 0, '2025-04-30 10:14:57'),
(304, 1, 2, 553, 585, 'sub', '25', 'Production', 519, 518, 1, 1.0286259541985, 532.82824427482, '2025-04-30 10:14:57'),
(305, 1, 2, 102, 134, 'sub', '25', 'Production', -0.025, -0.05, 0.025, 430, 0, '2025-04-30 10:14:57'),
(306, 1, 2, 45, 45, 'add', '25', 'Production', 1, 2, 1, 15.278625954198, 30.557251908397, '2025-04-30 10:14:57'),
(307, 1, 2, 102, 134, 'add', NULL, 'Direct Stock Update', -0.05, 0.95, 1, 350, 332.5, '2025-04-30 10:18:30'),
(308, 1, 3, 78, 78, 'sub', '110', 'Counter Sale', -1, -2, 1, 50, 0, '2025-04-30 15:43:32'),
(309, 1, 3, 77, 77, 'sub', '111', 'Counter Sale', -2, -3, 1, 50, 0, '2025-04-30 15:43:32'),
(310, 1, 3, 76, 76, 'sub', '112', 'Counter Sale', -1, -2, 1, 50, 0, '2025-04-30 15:43:32'),
(311, 1, 3, 548, 580, 'sub', '113', 'Counter Sale', 0, -1, 1, 0, 0, '2025-04-30 15:43:32'),
(312, 1, 3, 75, 75, 'sub', '114', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-30 15:43:32'),
(313, 1, 3, 42, 42, 'sub', '115', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-30 15:43:32'),
(314, 1, 3, 434, 466, 'sub', '116', 'Counter Sale', -1, -2, 1, 0, 0, '2025-04-30 15:43:32'),
(315, 1, 3, 73, 73, 'sub', '117', 'Counter Sale', -2, -3, 1, 50, 0, '2025-04-30 15:47:11'),
(316, 1, 3, 80, 80, 'sub', '118', 'Counter Sale', -1, -2, 1, 50, 0, '2025-04-30 15:47:11'),
(317, 1, 3, 434, 466, 'sub', '119', 'Counter Sale', -2, -3, 1, 0, 0, '2025-04-30 15:47:11'),
(318, 1, 2, 7, 7, 'sub', '1', 'Production', 953, 952, 1, 1, 952, '2025-04-30 16:42:52'),
(319, 1, 2, 420, 452, 'sub', '1', 'Production', -42, -43, 1, 1, 0, '2025-04-30 16:42:52'),
(320, 1, 2, 436, 468, 'sub', '1', 'Production', -2.965, -2.995, 0.03, 0, 0, '2025-04-30 16:42:52'),
(321, 1, 2, 453, 485, 'sub', '1', 'Production', 469, 468, 1, 1, 468, '2025-04-30 16:42:52'),
(322, 1, 2, 423, 455, 'sub', '1', 'Production', -37, -38, 1, 0.5, 0, '2025-04-30 16:42:52'),
(323, 1, 2, 553, 585, 'sub', '1', 'Production', 518, 517, 1, 1.0286259541985, 531.79961832062, '2025-04-30 16:42:52'),
(324, 1, 2, 102, 134, 'sub', '1', 'Production', 0.95, 0.925, 0.025, 350, 323.75, '2025-04-30 16:42:52'),
(325, 1, 2, 45, 45, 'add', '1', 'Production', 0, 1, 1, 13.278625954198, 13.278625954198, '2025-04-30 16:42:52'),
(326, 1, 2, 553, 585, 'sub', NULL, 'Direct Stock Update', 517, 500, 17, 1.0286259541985, 514.31297709925, '2025-04-30 16:46:53'),
(327, 1, 3, 71, 71, 'sub', '120', 'Counter Sale', -1, -2, 1, 50, 0, '2025-04-30 19:57:54'),
(328, 1, 3, 70, 70, 'sub', '121', 'Counter Sale', -1, -2, 1, 50, 0, '2025-04-30 19:57:54'),
(329, 1, 3, 358, 390, 'sub', '122', 'Counter Sale', 2, 1, 1, 315, 315, '2025-04-30 21:35:29'),
(330, 1, 3, 79, 79, 'sub', '123', 'Counter Sale', -1, -2, 1, 50, 0, '2025-04-30 21:35:29'),
(331, 1, 3, 77, 77, 'sub', '124', 'Counter Sale', -3, -4, 1, 50, 0, '2025-04-30 21:35:29'),
(332, 1, 3, 16, 16, 'sub', '125', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-30 21:46:50'),
(333, 1, 3, 44, 44, 'sub', '126', 'Counter Sale', 0, -1, 1, 50, 0, '2025-04-30 21:46:50'),
(334, 1, 3, 73, 73, 'sub', '127', 'Counter Sale', -3, -4, 1, 50, 0, '2025-04-30 21:46:50'),
(335, 1, 3, 50, 50, 'sub', '128', 'Counter Sale', -1, -2, 1, 50, 0, '2025-05-01 13:03:45'),
(336, 1, 3, 80, 80, 'sub', '129', 'Counter Sale', -2, -3, 1, 50, 0, '2025-05-01 13:03:45'),
(337, 1, 3, 32, 32, 'sub', '130', 'Counter Sale', 0, -1, 1, 50, 0, '2025-05-01 13:08:28'),
(338, 1, 2, 549, 581, 'add', NULL, 'Direct Stock Update', 0, 5, 5, 1.5, 7.5, '2025-05-01 17:32:32'),
(339, 1, 2, 553, 585, 'add', NULL, 'Direct Stock Update', 500, 600, 100, 1.1071882951654, 664.31297709925, '2025-05-01 17:33:01'),
(340, 1, 2, 552, 584, 'add', NULL, 'Direct Stock Update', 0, 100, 100, 1.5, 150, '2025-05-01 17:33:20'),
(341, 1, 2, 546, 578, 'add', NULL, 'Direct Stock Update', 0, 500, 500, 1.5, 750, '2025-05-01 17:33:34'),
(342, 1, 2, 102, 134, 'add', NULL, 'Direct Stock Update', 0.925, 50.925, 50, 7.8301423662248, 398.75, '2025-05-01 17:34:21'),
(343, 1, 2, 552, 584, 'add', NULL, 'Direct Stock Update', 100, 200, 100, 1.75, 350, '2025-05-01 17:38:02'),
(344, 1, 2, 551, 583, 'add', NULL, 'Direct Stock Update', 0, 100, 100, 1, 100, '2025-05-01 17:40:13'),
(345, 1, 2, 551, 583, 'add', NULL, 'Direct Stock Update', 100, 200, 100, 1.5, 300, '2025-05-01 17:40:29'),
(346, 1, 2, 7, 7, 'sub', '2', 'Production', 952, 951, 1, 1, 951, '2025-05-01 17:44:06'),
(347, 1, 2, 90, 122, 'sub', '2', 'Production', 0, -1, 1, 0, 0, '2025-05-01 17:44:06'),
(348, 1, 2, 547, 579, 'add', '2', 'Production', 0, 1, 1, 1, 1, '2025-05-01 17:44:06'),
(349, 1, 2, 7, 7, 'sub', '3', 'Production', 951, 941, 10, 1, 941, '2025-05-01 17:46:24'),
(350, 1, 2, 90, 122, 'sub', '3', 'Production', -1, -11, 10, 0, 0, '2025-05-01 17:46:24'),
(351, 1, 2, 51, 51, 'add', '3', 'Production', 0, 10, 10, 1, 10, '2025-05-01 17:46:24'),
(352, 1, 2, 7, 7, 'sub', '4', 'Production', 941, 931, 10, 1, 931, '2025-05-01 17:59:28'),
(353, 1, 2, 90, 122, 'sub', '4', 'Production', -11, -21, 10, 0, 0, '2025-05-01 17:59:28'),
(354, 1, 2, 51, 51, 'add', '4', 'Production', 10, 20, 10, 1, 20, '2025-05-01 17:59:28'),
(355, 1, 2, 7, 7, 'sub', '5', 'Production', 931, 921, 10, 1, 921, '2025-05-01 18:00:05'),
(356, 1, 2, 90, 122, 'sub', '5', 'Production', -21, -31, 10, 0, 0, '2025-05-01 18:00:05'),
(357, 1, 2, 51, 51, 'add', '5', 'Production', 20, 30, 10, 1, 30, '2025-05-01 18:00:05'),
(358, 1, 3, 7, 7, 'sub', '131', 'Delivery Sale', 921, 920, 1, 1, 920, '2025-05-01 18:25:05'),
(359, 1, 3, 12, 12, 'sub', '132', 'Delivery Sale', 0, -1, 1, 50, 0, '2025-05-01 18:25:05'),
(360, 1, 3, 7, 7, 'sub', '133', 'Delivery Sale', 920, 919, 1, 1, 919, '2025-05-01 18:26:14'),
(361, 1, 3, 12, 12, 'sub', '134', 'Delivery Sale', -1, -2, 1, 50, 0, '2025-05-01 18:26:14'),
(362, 1, 3, 13, 13, 'sub', '135', 'Delivery Sale', 0, -1, 1, 50, 0, '2025-05-01 18:26:14'),
(363, 1, 2, 7, 7, 'add', '133', 'Sale Delete', 919, 920, 1, 0, 0, '2025-05-01 18:29:57'),
(364, 1, 2, 12, 12, 'add', '134', 'Sale Delete', -2, -1, 1, 0, 0, '2025-05-01 18:29:57'),
(365, 1, 2, 13, 13, 'add', '135', 'Sale Delete', -1, 0, 1, 0, 0, '2025-05-01 18:29:57'),
(366, 1, 2, 7, 7, 'add', '131', 'Sale Delete', 920, 921, 1, 0, 0, '2025-05-01 18:30:06'),
(367, 1, 2, 12, 12, 'add', '132', 'Sale Delete', -1, 0, 1, 0, 0, '2025-05-01 18:30:06'),
(368, 1, 3, 18, 18, 'sub', '136', 'Counter Sale', 0, -1, 1, 0, 0, '2025-05-01 18:36:39'),
(369, 1, 3, 74, 74, 'sub', '137', 'Counter Sale', 0, -1, 1, 50, 0, '2025-05-01 18:36:39'),
(370, 1, 3, 81, 81, 'sub', '138', 'Counter Sale', 0, -1, 1, 50, 0, '2025-05-01 18:36:39'),
(371, 1, 3, 552, 584, 'sub', '139', 'Counter Sale', 200, 199, 1, 1.75, 348.25, '2025-05-01 19:04:11'),
(372, 1, 3, 80, 80, 'sub', '140', 'Counter Sale', -3, -4, 1, 50, 0, '2025-05-01 19:04:11'),
(373, 1, 3, 64, 64, 'sub', '141', 'Counter Sale', 0, -1, 1, 50, 0, '2025-05-01 19:04:11'),
(374, 1, 3, 64, 64, 'sub', '142', 'Counter Sale', -1, -2, 1, 50, 0, '2025-05-01 19:06:00'),
(375, 1, 2, 351, 383, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 560, 560, '2025-05-01 19:51:26'),
(376, 1, 3, 13, 13, 'sub', '143', 'Counter Sale', 0, -1, 1, 50, 0, '2025-05-01 20:40:26'),
(377, 1, 3, 64, 64, 'sub', '144', 'Counter Sale', -2, -3, 1, 50, 0, '2025-05-01 20:50:14'),
(378, 1, 3, 20, 20, 'sub', '145', 'Counter Sale', -1, -2, 1, 50, 0, '2025-05-01 20:50:14'),
(379, 1, 3, 42, 42, 'sub', '146', 'Counter Sale', -1, -2, 1, 50, 0, '2025-05-01 20:50:14'),
(380, 1, 3, 432, 464, 'sub', '147', 'Counter Sale', 0, -1, 1, 0, 0, '2025-05-01 20:50:14'),
(381, 1, 3, 73, 73, 'sub', '148', 'Counter Sale', -4, -5, 1, 50, 0, '2025-05-01 20:51:42'),
(382, 1, 3, 72, 72, 'sub', '149', 'Counter Sale', -1, -2, 1, 50, 0, '2025-05-01 20:51:42'),
(383, 1, 3, 20, 20, 'sub', '150', 'Counter Sale', -2, -3, 1, 50, 0, '2025-05-01 20:51:42'),
(384, 1, 3, 432, 464, 'sub', '151', 'Counter Sale', -1, -2, 1, 0, 0, '2025-05-01 20:51:42'),
(385, 1, 2, 341, 373, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 680, 680, '2025-05-01 21:28:43'),
(386, 1, 2, 338, 370, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 536.2, 536.2, '2025-05-01 21:29:21'),
(387, 1, 2, 336, 368, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 601.2, 601.2, '2025-05-01 21:43:41'),
(388, 1, 2, 329, 361, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 1030, 1030, '2025-05-01 21:43:41'),
(389, 1, 2, 325, 357, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 730, 730, '2025-05-01 21:43:41'),
(390, 1, 2, 319, 351, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 402.96, 402.96, '2025-05-01 21:43:41'),
(391, 1, 2, 309, 341, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 357, 357, '2025-05-01 21:43:41'),
(392, 1, 2, 307, 339, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 195, 195, '2025-05-01 21:43:41'),
(393, 1, 3, 432, 464, 'sub', '152', 'Counter Sale', -2, -3, 1, 0, 0, '2025-05-01 21:47:14'),
(394, 1, 3, 58, 58, 'sub', '153', 'Counter Sale', 0, -1, 1, 50, 0, '2025-05-01 21:47:14'),
(395, 1, 2, 306, 338, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 280, 280, '2025-05-01 22:03:46'),
(396, 1, 2, 304, 336, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 454.34, 454.34, '2025-05-01 22:03:46'),
(397, 1, 2, 302, 334, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 461.68, 461.68, '2025-05-01 22:03:46'),
(398, 1, 2, 301, 333, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 430, 430, '2025-05-01 22:03:46'),
(399, 1, 2, 300, 332, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 760, 760, '2025-05-01 22:03:46'),
(400, 1, 2, 291, 323, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 630.5, 630.5, '2025-05-01 22:03:46'),
(401, 1, 2, 286, 318, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 667.2, 667.2, '2025-05-01 22:03:46'),
(402, 1, 2, 273, 305, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 645.18, 645.18, '2025-05-01 22:03:46'),
(403, 1, 2, 272, 304, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 700.23, 700.23, '2025-05-01 22:03:46'),
(404, 1, 2, 267, 299, 'add', NULL, 'Direct Stock Update', -1.4, -0.4, 1, 915.71, 0, '2025-05-01 22:03:46'),
(405, 1, 3, 72, 72, 'sub', '154', 'Counter Sale', -2, -3, 1, 50, 0, '2025-05-01 22:25:05'),
(406, 1, 3, 73, 73, 'sub', '155', 'Counter Sale', -5, -6, 1, 50, 0, '2025-05-01 22:25:05'),
(407, 1, 3, 75, 75, 'sub', '156', 'Counter Sale', -1, -2, 1, 50, 0, '2025-05-01 23:06:09'),
(408, 1, 3, 80, 80, 'sub', '157', 'Counter Sale', -4, -5, 1, 50, 0, '2025-05-01 23:06:09'),
(409, 1, 3, 81, 81, 'sub', '158', 'Counter Sale', -1, -2, 1, 50, 0, '2025-05-01 23:06:09'),
(410, 1, 3, 73, 73, 'sub', '159', 'Counter Sale', -6, -7, 1, 50, 0, '2025-05-02 19:50:01'),
(411, 1, 3, 68, 68, 'sub', '160', 'Counter Sale', -1, -2, 1, 50, 0, '2025-05-02 19:50:01'),
(412, 1, 3, 68, 68, 'sub', '161', 'Counter Sale', -2, -3, 1, 50, 0, '2025-05-02 19:57:59'),
(413, 1, 3, 79, 79, 'sub', '162', 'Counter Sale', -2, -3, 1, 50, 0, '2025-05-02 19:57:59'),
(414, 1, 3, 77, 77, 'sub', '163', 'Counter Sale', -4, -5, 1, 50, 0, '2025-05-02 21:37:03'),
(415, 1, 3, 79, 79, 'sub', '164', 'Counter Sale', -3, -4, 1, 50, 0, '2025-05-02 21:38:00'),
(416, 1, 3, 433, 465, 'sub', '165', 'Counter Sale', 0, -1, 1, 0, 0, '2025-05-03 15:54:57'),
(417, 1, 3, 228, 260, 'sub', '166', 'Counter Sale', 0, -0.1, 0.1, 880, 0, '2025-05-03 19:08:58'),
(418, 1, 3, 228, 260, 'add', '166', 'Sale Delete', -0.1, 0, 0.1, 0, 0, '2025-05-03 19:09:30'),
(419, 1, 3, 81, 81, 'sub', '167', 'Counter Sale', -2, -3, 1, 50, 0, '2025-05-03 19:18:09'),
(420, 1, 3, 40, 40, 'sub', '168', 'Counter Sale', 0, -1, 1, 50, 0, '2025-05-03 19:18:09'),
(421, 1, 3, 47, 47, 'sub', '169', 'Counter Sale', 0, -1, 1, 50, 0, '2025-05-03 19:20:01'),
(422, 1, 3, 59, 59, 'sub', '170', 'Counter Sale', -1, -2, 1, 50, 0, '2025-05-03 19:20:01'),
(423, 1, 3, 64, 64, 'sub', '171', 'Counter Sale', -3, -4, 1, 50, 0, '2025-05-03 19:20:01'),
(424, 1, 3, 70, 70, 'sub', '172', 'Counter Sale', -2, -3, 1, 50, 0, '2025-05-03 21:17:46'),
(425, 1, 3, 68, 68, 'sub', '173', 'Counter Sale', -3, -4, 1, 50, 0, '2025-05-03 21:17:46'),
(426, 1, 3, 67, 67, 'sub', '174', 'Counter Sale', -1, -2, 1, 50, 0, '2025-05-03 21:17:46'),
(427, 1, 3, 62, 62, 'sub', '175', 'Counter Sale', 0, -1, 1, 50, 0, '2025-05-03 21:17:46'),
(428, 1, 3, 70, 70, 'sub', '176', 'Counter Sale', -3, -4, 1, 50, 0, '2025-05-03 21:17:46'),
(429, 1, 3, 35, 35, 'sub', '177', 'Counter Sale', 0, -1, 1, 50, 0, '2025-05-03 21:17:46'),
(430, 1, 3, 70, 70, 'sub', '178', 'Counter Sale', -4, -5, 1, 50, 0, '2025-05-03 21:23:30'),
(431, 1, 3, 35, 35, 'add', '177', 'Sale Delete', -1, 0, 1, 0, 0, '2025-05-03 21:24:22'),
(432, 1, 3, 62, 62, 'add', '175', 'Sale Delete', -1, 0, 1, 0, 0, '2025-05-03 21:24:22'),
(433, 1, 3, 67, 67, 'add', '174', 'Sale Delete', -2, -1, 1, 0, 0, '2025-05-03 21:24:22'),
(434, 1, 3, 68, 68, 'add', '173', 'Sale Delete', -4, -3, 1, 0, 0, '2025-05-03 21:24:22'),
(435, 1, 3, 70, 70, 'add', '172', 'Sale Delete', -5, -4, 1, 0, 0, '2025-05-03 21:24:22'),
(436, 1, 3, 70, 70, 'add', '176', 'Sale Delete', -4, -3, 1, 0, 0, '2025-05-03 21:24:22'),
(437, 1, 4, 228, 260, 'sub', '179', 'Counter Sale', 0, -0.1, 0.1, 880, 0, '2025-05-03 21:54:03'),
(438, 1, 2, 245, 277, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 630, 630, '2025-05-03 22:10:59'),
(439, 1, 2, 241, 273, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 432.32, 432.32, '2025-05-03 22:10:59'),
(440, 1, 2, 240, 272, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 270, 270, '2025-05-03 22:10:59'),
(441, 1, 2, 193, 225, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 622.31, 622.31, '2025-05-03 22:10:59'),
(442, 1, 2, 179, 211, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 691.34, 691.34, '2025-05-03 22:10:59'),
(443, 1, 2, 171, 203, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 564.44, 564.44, '2025-05-03 22:10:59'),
(444, 1, 2, 204, 236, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 560, 560, '2025-05-03 22:22:13'),
(445, 1, 2, 203, 235, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 1480, 1480, '2025-05-03 22:22:13'),
(446, 1, 2, 202, 234, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 560, 560, '2025-05-03 22:22:13'),
(447, 1, 3, 550, 582, 'sub', '180', 'Counter Sale', 0, -1, 1, 0, 0, '2025-05-03 22:27:49'),
(448, 1, 3, 80, 80, 'sub', '181', 'Counter Sale', -5, -6, 1, 50, 0, '2025-05-03 22:27:49'),
(449, 1, 2, 189, 221, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 530, 530, '2025-05-03 22:31:30'),
(450, 1, 2, 187, 219, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 410, 410, '2025-05-03 22:31:30'),
(451, 1, 2, 186, 218, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 1280, 1280, '2025-05-03 22:31:30'),
(452, 1, 2, 185, 217, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 590, 590, '2025-05-03 22:31:30'),
(453, 1, 2, 174, 206, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 953.46, 953.46, '2025-05-03 22:31:30'),
(454, 1, 2, 173, 205, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 656.19, 656.19, '2025-05-03 22:31:30'),
(455, 1, 2, 168, 200, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 545.45, 545.45, '2025-05-03 22:31:30'),
(456, 1, 2, 161, 193, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 1000, 1000, '2025-05-03 22:31:30'),
(457, 1, 2, 152, 184, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 560, 560, '2025-05-03 22:31:30'),
(458, 1, 2, 150, 182, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 830, 830, '2025-05-03 22:31:30'),
(459, 1, 2, 148, 180, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 599.78, 599.78, '2025-05-03 22:31:30'),
(460, 1, 2, 142, 174, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 608.48, 608.48, '2025-05-03 22:31:30'),
(461, 1, 2, 138, 170, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 630, 630, '2025-05-03 22:31:30'),
(462, 1, 2, 136, 168, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 530, 530, '2025-05-03 22:31:30'),
(463, 1, 2, 129, 161, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 839.69, 839.69, '2025-05-03 22:31:30'),
(464, 1, 2, 120, 152, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 580, 580, '2025-05-03 22:31:30'),
(465, 1, 2, 114, 146, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 220, 220, '2025-05-03 22:31:30'),
(466, 1, 2, 113, 145, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 414.27, 414.27, '2025-05-03 22:31:30'),
(467, 1, 2, 112, 144, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 1030, 1030, '2025-05-03 22:31:30'),
(468, 1, 2, 103, 135, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 465.65, 465.65, '2025-05-03 22:31:30'),
(469, 1, 2, 102, 134, 'add', NULL, 'Direct Stock Update', 50.925, 51.925, 1, 14.419836302359, 748.75, '2025-05-03 22:31:30'),
(470, 1, 2, 96, 128, 'add', NULL, 'Direct Stock Update', 0, 1, 1, 880, 880, '2025-05-03 22:31:30'),
(471, 1, 2, 90, 122, 'add', NULL, 'Direct Stock Update', -31, -30, 1, 1330, 0, '2025-05-03 22:31:30'),
(472, 1, 2, 553, 585, 'sub', NULL, 'Direct Stock Update', 600, 500, 100, 1.1071882951654, 553.5941475827, '2025-05-03 22:35:46'),
(473, 1, 2, 436, 468, 'add', NULL, 'Direct Stock Update', -2.995, 3072.005, 3075, 250, 768001.25, '2025-05-03 22:35:46'),
(474, 1, 2, 423, 455, 'add', NULL, 'Direct Stock Update', -38, 1000, 1038, 0.5, 500, '2025-05-03 22:35:46'),
(475, 1, 2, 420, 452, 'add', NULL, 'Direct Stock Update', -43, 1000, 1043, 1, 1000, '2025-05-03 22:35:46'),
(476, 1, 2, 7, 7, 'add', NULL, 'Direct Stock Update', 921, 1000, 79, 0.998, 998, '2025-05-03 22:35:46'),
(477, 1, 2, 7, 7, 'sub', '1', 'Production', 1000, 999, 1, 0.998, 997.002, '2025-05-03 22:39:44'),
(478, 1, 2, 420, 452, 'sub', '1', 'Production', 1000, 999, 1, 1, 999, '2025-05-03 22:39:44'),
(479, 1, 2, 436, 468, 'sub', '1', 'Production', 3072.005, 3071.98, 0.025, 250, 767995, '2025-05-03 22:39:44'),
(480, 1, 2, 553, 585, 'sub', '1', 'Production', 500, 499, 1, 1.1071882951654, 552.48695928753, '2025-05-03 22:39:44'),
(481, 1, 2, 453, 485, 'sub', '1', 'Production', 468, 467, 1, 1, 467, '2025-05-03 22:39:44'),
(482, 1, 2, 304, 336, 'sub', '1', 'Production', 1, 0.975, 0.025, 454.34, 442.9815, '2025-05-03 22:39:44'),
(483, 1, 2, 423, 455, 'sub', '1', 'Production', 1000, 999, 1, 0.5, 499.5, '2025-05-03 22:39:44'),
(484, 1, 2, 48, 48, 'add', '1', 'Production', 0, 1, 1, 22.213688295165, 22.213688295165, '2025-05-03 22:39:44'),
(485, 1, 2, 7, 7, 'sub', '2', 'Production', 999, 998, 1, 0.998, 996.004, '2025-05-03 22:46:19'),
(486, 1, 2, 420, 452, 'sub', '2', 'Production', 999, 998, 1, 1, 998, '2025-05-03 22:46:19'),
(487, 1, 2, 436, 468, 'sub', '2', 'Production', 3071.98, 3071.73, 0.25, 250, 767932.5, '2025-05-03 22:46:19'),
(488, 1, 2, 553, 585, 'sub', '2', 'Production', 499, 498, 1, 1.1071882951654, 551.37977099237, '2025-05-03 22:46:19'),
(489, 1, 2, 453, 485, 'sub', '2', 'Production', 467, 466, 1, 1, 466, '2025-05-03 22:46:19'),
(490, 1, 2, 304, 336, 'sub', '2', 'Production', 0.975, 0.725, 0.25, 454.34, 329.3965, '2025-05-03 22:46:19'),
(491, 1, 2, 423, 455, 'sub', '2', 'Production', 999, 998, 1, 0.5, 499, '2025-05-03 22:46:19'),
(492, 1, 2, 48, 48, 'add', '2', 'Production', 1, 2, 1, 101.45193829517, 202.90387659033, '2025-05-03 22:46:19'),
(493, 1, 2, 7, 7, 'sub', '3', 'Production', 998, 997, 1, 0.998, 995.006, '2025-05-03 22:49:19'),
(494, 1, 2, 420, 452, 'sub', '3', 'Production', 998, 997, 1, 1, 997, '2025-05-03 22:49:19'),
(495, 1, 2, 436, 468, 'sub', '3', 'Production', 3071.73, 3071.705, 0.025, 250, 767926.25, '2025-05-03 22:49:19'),
(496, 1, 2, 553, 585, 'sub', '3', 'Production', 498, 497, 1, 1.1071882951654, 550.2725826972, '2025-05-03 22:49:19'),
(497, 1, 2, 453, 485, 'sub', '3', 'Production', 466, 465, 1, 1, 465, '2025-05-03 22:49:19'),
(498, 1, 2, 304, 336, 'sub', '3', 'Production', 0.725, 0.7, 0.025, 454.34, 318.038, '2025-05-03 22:49:19'),
(499, 1, 2, 423, 455, 'sub', '3', 'Production', 998, 997, 1, 0.5, 498.5, '2025-05-03 22:49:19'),
(500, 1, 2, 48, 48, 'add', '3', 'Production', 2, 3, 1, 75.039188295165, 225.1175648855, '2025-05-03 22:49:19'),
(501, 1, 2, 48, 48, 'sub', '3', 'Stock adjustment', 3, 0, -3, 0, 0, '2025-05-03 22:49:49'),
(502, 1, 2, 48, 48, 'sub', '4', 'Stock adjustment', 0, -3, -3, 0, 0, '2025-05-03 22:49:50'),
(503, 1, 2, 48, 48, 'add', NULL, 'Direct Stock Update', -3, 0, 3, 75.04, 0, '2025-05-03 22:51:00'),
(504, 1, 2, 7, 7, 'sub', '4', 'Production', 997, 996, 1, 0.998, 994.008, '2025-05-03 22:52:01'),
(505, 1, 2, 420, 452, 'sub', '4', 'Production', 997, 996, 1, 1, 996, '2025-05-03 22:52:01'),
(506, 1, 2, 436, 468, 'sub', '4', 'Production', 3071.705, 3071.68, 0.025, 250, 767920, '2025-05-03 22:52:01'),
(507, 1, 2, 553, 585, 'sub', '4', 'Production', 497, 496, 1, 1.1071882951654, 549.16539440204, '2025-05-03 22:52:01'),
(508, 1, 2, 453, 485, 'sub', '4', 'Production', 465, 464, 1, 1, 464, '2025-05-03 22:52:01'),
(509, 1, 2, 304, 336, 'sub', '4', 'Production', 0.7, 0.675, 0.025, 454.34, 306.6795, '2025-05-03 22:52:01'),
(510, 1, 2, 423, 455, 'sub', '4', 'Production', 997, 996, 1, 0.5, 498, '2025-05-03 22:52:01'),
(511, 1, 2, 48, 48, 'add', '4', 'Production', 0, 1, 1, 22.213688295165, 22.213688295165, '2025-05-03 22:52:01'),
(512, 1, 2, 7, 7, 'sub', '5', 'Production', 996, 995, 1, 0.998, 993.01, '2025-05-03 23:02:14'),
(513, 1, 2, 420, 452, 'sub', '5', 'Production', 996, 995, 1, 1, 995, '2025-05-03 23:02:14'),
(514, 1, 2, 470, 502, 'sub', '5', 'Production', 1000, 999, 1, 1, 999, '2025-05-03 23:02:14'),
(515, 1, 2, 436, 468, 'sub', '5', 'Production', 3071.68, 3071.65, 0.03, 250, 767912.5, '2025-05-03 23:02:14'),
(516, 1, 2, 553, 585, 'sub', '5', 'Production', 496, 495, 1, 1.1071882951654, 548.05820610687, '2025-05-03 23:02:14'),
(517, 1, 2, 351, 383, 'sub', '5', 'Production', 1, 0.98, 0.02, 560, 548.8, '2025-05-03 23:02:14'),
(518, 1, 2, 423, 455, 'sub', '5', 'Production', 996, 995, 1, 0.5, 497.5, '2025-05-03 23:02:14'),
(519, 1, 2, 7, 7, 'sub', '6', 'Production', 995, 994, 1, 0.998, 992.012, '2025-05-03 23:03:48'),
(520, 1, 2, 420, 452, 'sub', '6', 'Production', 995, 994, 1, 1, 994, '2025-05-03 23:03:48'),
(521, 1, 2, 470, 502, 'sub', '6', 'Production', 999, 998, 1, 1, 998, '2025-05-03 23:03:48'),
(522, 1, 2, 436, 468, 'sub', '6', 'Production', 3071.65, 3071.62, 0.03, 250, 767905, '2025-05-03 23:03:48'),
(523, 1, 2, 553, 585, 'sub', '6', 'Production', 495, 494, 1, 1.1071882951654, 546.95101781171, '2025-05-03 23:03:48'),
(524, 1, 2, 351, 383, 'sub', '6', 'Production', 0.98, 0.96, 0.02, 560, 537.6, '2025-05-03 23:03:48'),
(525, 1, 2, 423, 455, 'sub', '6', 'Production', 995, 994, 1, 0.5, 497, '2025-05-03 23:03:48'),
(526, 1, 2, 7, 7, 'sub', '7', 'Production', 994, 993, 1, 0.998, 991.014, '2025-05-04 14:25:13'),
(527, 1, 2, 420, 452, 'sub', '7', 'Production', 994, 993, 1, 1, 993, '2025-05-04 14:25:13'),
(528, 1, 2, 436, 468, 'sub', '7', 'Production', 3071.62, 3071.595, 0.025, 250, 767898.75, '2025-05-04 14:25:13'),
(529, 1, 2, 453, 485, 'sub', '7', 'Production', 464, 463, 1, 1, 463, '2025-05-04 14:25:13'),
(530, 1, 2, 553, 585, 'sub', '7', 'Production', 494, 493, 1, 1.1071882951654, 545.84382951654, '2025-05-04 14:25:13'),
(531, 1, 2, 423, 455, 'sub', '7', 'Production', 994, 993, 1, 0.5, 496.5, '2025-05-04 14:25:13'),
(532, 1, 2, 309, 341, 'sub', '7', 'Production', 1, 0.975, 0.025, 357, 348.075, '2025-05-04 14:25:13');
INSERT INTO `stock_management_history` (`id`, `shop_id`, `user_id`, `item_id`, `item_price_id`, `action_type`, `reference_no`, `reference_key`, `open_stock`, `closing_stock`, `stock_value`, `cost_price`, `total_cost_price`, `date_added`) VALUES
(533, 1, 2, 11, 11, 'add', '7', 'Production', 0, 1, 1, 19.780188295165, 19.780188295165, '2025-05-04 14:25:13'),
(534, 1, 2, 7, 7, 'sub', '8', 'Production', 993, 992, 1, 0.998, 990.016, '2025-05-04 14:38:17'),
(535, 1, 2, 420, 452, 'sub', '8', 'Production', 993, 992, 1, 1, 992, '2025-05-04 14:38:17'),
(536, 1, 2, 470, 502, 'sub', '8', 'Production', 998, 997, 1, 1, 997, '2025-05-04 14:38:17'),
(537, 1, 2, 436, 468, 'sub', '8', 'Production', 3071.595, 3071.565, 0.03, 250, 767891.25, '2025-05-04 14:38:17'),
(538, 1, 2, 553, 585, 'sub', '8', 'Production', 493, 492, 1, 1.1071882951654, 544.73664122138, '2025-05-04 14:38:17'),
(539, 1, 2, 351, 383, 'sub', '8', 'Production', 0.96, 0.935, 0.025, 560, 523.6, '2025-05-04 14:38:17'),
(540, 1, 2, 423, 455, 'sub', '8', 'Production', 993, 992, 1, 0.5, 496, '2025-05-04 14:38:17'),
(541, 1, 2, 7, 7, 'sub', '9', 'Production', 992, 991, 1, 0.998, 989.018, '2025-05-04 14:40:54'),
(542, 1, 2, 420, 452, 'sub', '9', 'Production', 992, 991, 1, 1, 991, '2025-05-04 14:40:54'),
(543, 1, 2, 470, 502, 'sub', '9', 'Production', 997, 996, 1, 1, 996, '2025-05-04 14:40:54'),
(544, 1, 2, 436, 468, 'sub', '9', 'Production', 3071.565, 3071.535, 0.03, 250, 767883.75, '2025-05-04 14:40:54'),
(545, 1, 2, 553, 585, 'sub', '9', 'Production', 492, 491, 1, 1.1071882951654, 543.62945292621, '2025-05-04 14:40:54'),
(546, 1, 2, 351, 383, 'sub', '9', 'Production', 0.935, 0.91, 0.025, 560, 509.6, '2025-05-04 14:40:54'),
(547, 1, 2, 423, 455, 'sub', '9', 'Production', 992, 991, 1, 0.5, 495.5, '2025-05-04 14:40:54'),
(548, 1, 2, 7, 7, 'sub', '10', 'Production', 991, 990, 1, 0.998, 988.02, '2025-05-04 14:43:11'),
(549, 1, 2, 424, 456, 'sub', '10', 'Production', -11, -12, 1, 1, 0, '2025-05-04 14:43:11'),
(550, 1, 2, 420, 452, 'sub', '10', 'Production', 991, 990, 1, 1, 990, '2025-05-04 14:43:11'),
(551, 1, 2, 423, 455, 'sub', '10', 'Production', 991, 990, 1, 0.5, 495, '2025-05-04 14:43:11'),
(552, 1, 2, 436, 468, 'sub', '10', 'Production', 3071.535, 3071.505, 0.03, 250, 767876.25, '2025-05-04 14:43:11'),
(553, 1, 2, 91, 123, 'sub', '10', 'Production', 0, -0.025, 0.025, 0, 0, '2025-05-04 14:43:11'),
(554, 1, 2, 43, 43, 'add', '10', 'Production', 0, 1, 1, 10.998, 10.998, '2025-05-04 14:43:11'),
(555, 1, 3, 51, 51, 'sub', '182', 'Counter Sale', 0, -1, 1, 0, 0, '2025-05-04 17:33:32'),
(556, 1, 3, 64, 64, 'sub', '183', 'Counter Sale', -4, -5, 1, 50, 0, '2025-05-04 17:33:32'),
(557, 1, 3, 72, 72, 'sub', '184', 'Counter Sale', -3, -4, 1, 50, 0, '2025-05-04 17:34:19'),
(558, 1, 3, 72, 72, 'sub', '185', 'Counter Sale', -4, -5, 1, 50, 0, '2025-05-04 17:34:19'),
(559, 1, 2, 7, 7, 'sub', '11', 'Production', 990, 989, 1, 0.998, 987.022, '2025-05-04 18:11:26'),
(560, 1, 2, 420, 452, 'sub', '11', 'Production', 990, 989, 1, 1, 989, '2025-05-04 18:11:26'),
(561, 1, 2, 470, 502, 'sub', '11', 'Production', 996, 995, 1, 1, 995, '2025-05-04 18:11:26'),
(562, 1, 2, 436, 468, 'sub', '11', 'Production', 3071.505, 3071.475, 0.03, 250, 767868.75, '2025-05-04 18:11:26'),
(563, 1, 2, 553, 585, 'sub', '11', 'Production', 491, 490, 1, 1.1071882951654, 542.52226463105, '2025-05-04 18:11:26'),
(564, 1, 2, 351, 383, 'sub', '11', 'Production', 0.91, 0.885, 0.025, 560, 495.6, '2025-05-04 18:11:26'),
(565, 1, 2, 423, 455, 'sub', '11', 'Production', 990, 989, 1, 0.5, 494.5, '2025-05-04 18:11:26'),
(566, 1, 3, 14, 14, 'sub', '186', 'Counter Sale', 0, -1, 1, 50, 0, '2025-05-04 19:15:42'),
(567, 1, 3, 38, 38, 'sub', '187', 'Counter Sale', 0, -1, 1, 50, 0, '2025-05-04 19:15:42'),
(568, 1, 3, 46, 46, 'sub', '188', 'Counter Sale', 0, -1, 1, 50, 0, '2025-05-04 19:15:42'),
(569, 1, 3, 12, 12, 'sub', '189', 'Counter Sale', 0, -1, 1, 50, 0, '2025-05-04 19:15:42'),
(570, 1, 3, 28, 28, 'sub', '190', 'Counter Sale', -1, -2, 1, 50, 0, '2025-05-04 19:15:42'),
(571, 1, 3, 81, 81, 'sub', '191', 'Counter Sale', -3, -4, 1, 50, 0, '2025-05-04 19:15:42'),
(572, 1, 3, 67, 67, 'sub', '192', 'Counter Sale', -1, -2, 1, 50, 0, '2025-05-04 19:15:42'),
(573, 1, 3, 72, 72, 'sub', '193', 'Counter Sale', -5, -6, 1, 50, 0, '2025-05-04 19:15:42'),
(574, 1, 3, 550, 582, 'sub', '194', 'Counter Sale', -1, -2, 1, 0, 0, '2025-05-04 19:15:42'),
(575, 1, 3, 548, 580, 'sub', '195', 'Counter Sale', -1, -2, 1, 0, 0, '2025-05-04 19:15:42'),
(576, 1, 3, 19, 19, 'sub', '196', 'Counter Sale', 0, -1, 1, 50, 0, '2025-05-04 19:15:42'),
(577, 1, 3, 80, 80, 'sub', '197', 'Counter Sale', -6, -7, 1, 50, 0, '2025-05-04 19:15:42'),
(578, 1, 3, 50, 50, 'sub', '198', 'Counter Sale', -2, -3, 1, 50, 0, '2025-05-04 19:44:41'),
(579, 1, 3, 42, 42, 'sub', '199', 'Counter Sale', -2, -3, 1, 50, 0, '2025-05-04 19:44:41'),
(580, 1, 3, 68, 68, 'sub', '200', 'Counter Sale', -3, -4, 1, 50, 0, '2025-05-04 19:44:41'),
(581, 1, 3, 12, 12, 'sub', '201', 'Counter Sale', -1, -3, 2, 50, 0, '2025-05-04 21:36:05'),
(582, 1, 3, 77, 77, 'sub', '202', 'Counter Sale', -5, -6, 1, 50, 0, '2025-05-04 21:36:05'),
(583, 1, 3, 63, 63, 'sub', '203', 'Counter Sale', 0, -1, 1, 50, 0, '2025-05-04 23:10:13'),
(584, 1, 3, 64, 64, 'sub', '204', 'Counter Sale', -5, -6, 1, 50, 0, '2025-05-04 23:10:13'),
(585, 1, 2, 556, 588, 'add', '1', 'Purchase Order', 0, 1, 1, 8, 8, '2025-04-05 00:00:00'),
(586, 1, 2, 557, 589, 'add', '2', 'Purchase Order', 0, 1, 1, 12, 12, '2025-04-05 00:00:00'),
(587, 1, 2, 558, 590, 'add', '3', 'Purchase Order', 0, 2, 2, 4, 8, '2025-04-05 00:00:00'),
(588, 1, 2, 560, 592, 'add', '4', 'Purchase Order', 0, 1, 1, 13, 13, '2025-04-05 00:00:00'),
(589, 1, 2, 561, 593, 'add', '5', 'Purchase Order', 0, 1, 1, 8, 8, '2025-04-05 00:00:00'),
(590, 1, 2, 559, 591, 'add', '6', 'Purchase Order', 0, 4, 4, 1, 4, '2025-04-05 00:00:00'),
(591, 1, 2, 563, 595, 'add', '7', 'Purchase Order', 0, 5, 5, 15, 75, '2025-05-05 00:00:00'),
(592, 1, 2, 564, 596, 'add', '8', 'Purchase Order', 0, 5, 5, 60, 300, '2025-05-05 00:00:00'),
(593, 1, 2, 565, 597, 'add', '9', 'Purchase Order', 0, 120, 120, 1.0833333333333, 130, '2025-04-02 00:00:00'),
(594, 1, 2, 564, 596, 'add', '2', 'Purchase Order', 5, 10, 5, 60, 600, '2025-03-10 00:00:00'),
(595, 1, 2, 563, 595, 'add', '3', 'Purchase Order', 5, 10, 5, 15, 150, '2025-03-10 00:00:00'),
(596, 1, 2, 565, 597, 'add', '1', 'Purchase Order', 120, 240, 120, 1.0833333333333, 260, '2025-05-05 12:52:31'),
(597, 1, 2, 533, 565, 'add', '5', 'Stock adjustment', 0, 120, 120, 0, 0, '2025-05-05 12:54:21'),
(598, 1, 2, 556, 588, 'add', '4', 'Purchase Order', 1, 2, 1, 8, 16, '2025-05-05 12:58:26'),
(599, 1, 2, 557, 589, 'add', '5', 'Purchase Order', 1, 2, 1, 12, 24, '2025-05-05 12:58:26'),
(600, 1, 2, 558, 590, 'add', '6', 'Purchase Order', 2, 4, 2, 4, 16, '2025-05-05 12:58:26'),
(601, 1, 2, 559, 591, 'add', '7', 'Purchase Order', 4, 8, 4, 1, 8, '2025-05-05 12:58:26'),
(602, 1, 2, 560, 592, 'add', '8', 'Purchase Order', 1, 2, 1, 13, 26, '2025-05-05 12:58:26'),
(603, 1, 2, 561, 593, 'add', '9', 'Purchase Order', 1, 2, 1, 8, 16, '2025-05-05 12:58:26'),
(604, 1, 2, 553, 585, 'add', '10', 'Purchase Order', 490, 2290, 1800, 1.4159485871751, 3242.522264631, '2025-04-05 00:00:00'),
(605, 1, 3, 70, 70, 'sub', '205', 'Counter Sale', -3, -4, 1, 50, 0, '2025-05-05 18:43:09'),
(606, 1, 3, 80, 80, 'sub', '206', 'Counter Sale', -7, -8, 1, 50, 0, '2025-05-05 18:43:09'),
(607, 1, 3, 76, 76, 'sub', '207', 'Counter Sale', -2, -3, 1, 50, 0, '2025-05-05 18:43:22'),
(608, 1, 3, 69, 69, 'sub', '208', 'Counter Sale', -1, -2, 1, 50, 0, '2025-05-06 13:55:13'),
(609, 1, 3, 11, 11, 'sub', '209', 'Counter Sale', 1, 0, 1, 19.780188295165, 0, '2025-05-06 13:55:13'),
(610, 1, 3, 79, 79, 'sub', '210', 'Counter Sale', -4, -5, 1, 50, 0, '2025-05-06 13:55:13'),
(611, 1, 3, 59, 59, 'sub', '211', 'Counter Sale', -2, -3, 1, 50, 0, '2025-05-06 13:55:13'),
(612, 1, 3, 45, 45, 'sub', '212', 'Counter Sale', 0, -1, 1, 0, 0, '2025-05-06 13:55:13'),
(613, 1, 3, 433, 465, 'sub', '213', 'Counter Sale', -1, -2, 1, 0, 0, '2025-05-06 16:12:33'),
(614, 1, 3, 38, 38, 'sub', '214', 'Counter Sale', -1, -2, 1, 50, 0, '2025-05-06 21:50:03'),
(615, 1, 3, 79, 79, 'sub', '215', 'Counter Sale', -5, -6, 1, 50, 0, '2025-05-06 23:05:52'),
(616, 1, 2, 563, 595, 'add', '20', 'Purchase Order', 10, 15, 5, 13.333333333333, 200, '2025-05-07 10:09:12'),
(617, 1, 2, 564, 596, 'add', '17', 'Purchase Order', 10, 18, 8, 60, 1080, '2025-05-07 10:09:12'),
(618, 1, 2, 573, 605, 'add', '18', 'Purchase Order', 0, 2, 2, 100, 200, '2025-05-07 10:09:12'),
(619, 1, 2, 574, 606, 'add', '19', 'Purchase Order', 0, 1, 1, 20, 20, '2025-05-07 10:09:12'),
(620, 1, 2, 575, 607, 'add', '21', 'Purchase Order', 0, 2, 2, 10, 20, '2025-05-07 10:09:12'),
(621, 1, 2, 576, 608, 'add', '22', 'Purchase Order', 0, 4, 4, 140, 560, '2025-05-07 10:09:12'),
(622, 1, 2, 433, 465, 'add', '16', 'Purchase Order', -2, 198, 200, 1.010101010101, 200, '2025-05-07 10:09:17'),
(623, 1, 2, 357, 389, 'add', '23', 'Purchase Order', 2, 6, 4, 210, 1260, '2025-05-07 10:09:47'),
(624, 1, 2, 577, 609, 'add', '24', 'Purchase Order', 0, 1, 1, 3300, 3300, '2025-03-24 00:00:00'),
(625, 1, 2, 578, 610, 'add', '25', 'Purchase Order', 0, 1, 1, 1400, 1400, '2025-03-24 00:00:00'),
(626, 1, 2, 579, 611, 'add', '26', 'Purchase Order', 0, 1, 1, 3300, 3300, '2025-03-24 00:00:00'),
(627, 1, 2, 580, 612, 'add', '27', 'Purchase Order', 0, 500, 500, 0.5, 250, '2025-04-02 00:00:00'),
(628, 1, 2, 581, 613, 'add', '28', 'Purchase Order', 0, 100, 100, 0.5, 50, '2025-04-02 00:00:00'),
(629, 1, 2, 582, 614, 'add', '29', 'Purchase Order', 0, 1800, 1800, 1.25, 2250, '2025-05-07 10:45:37'),
(630, 1, 2, 583, 615, 'add', '30', 'Purchase Order', 0, 1800, 1800, 1.25, 2250, '2025-05-07 10:45:37'),
(631, 1, 2, 433, 465, 'add', '33', 'Purchase Order', 198, 202, 4, 1.2554455445545, 253.6, '2025-05-07 10:59:30'),
(632, 1, 2, 433, 465, 'add', '34', 'Purchase Order', 202, 212, 10, 1.4320754716981, 303.6, '2025-05-07 11:05:05'),
(633, 1, 2, 436, 468, 'add', NULL, 'Direct Stock Update', 3071.475, 6142.95, 3071.475, 131.25, 806262.1875, '2025-05-07 13:07:41'),
(634, 1, 2, 7, 7, 'sub', '12', 'Production', 989, 988, 1, 0.998, 986.024, '2025-05-07 13:08:34'),
(635, 1, 2, 436, 468, 'sub', '12', 'Production', 6142.95, 6142.925, 0.025, 131.25, 806258.90625, '2025-05-07 13:08:34'),
(636, 1, 2, 553, 585, 'sub', '12', 'Production', 2290, 2289, 1, 1.4159485871751, 3241.1063160438, '2025-05-07 13:08:34'),
(637, 1, 2, 420, 452, 'sub', '12', 'Production', 989, 988, 1, 1, 988, '2025-05-07 13:08:34'),
(638, 1, 2, 202, 234, 'sub', '12', 'Production', 1, 0.975, 0.025, 560, 546, '2025-05-07 13:08:34'),
(639, 1, 2, 453, 485, 'sub', '12', 'Production', 463, 462, 1, 1, 462, '2025-05-07 13:08:34'),
(640, 1, 2, 423, 455, 'sub', '12', 'Production', 989, 988, 1, 0.5, 494, '2025-05-07 13:08:34'),
(641, 1, 2, 9, 9, 'add', '12', 'Production', 0, 1, 1, 22.195198587175, 22.195198587175, '2025-05-07 13:08:34'),
(642, 1, 2, 420, 452, 'sub', '13', 'Production', 988, 987, 1, 1, 987, '2025-05-07 13:10:20'),
(643, 1, 2, 436, 468, 'sub', '13', 'Production', 6142.925, 6142.9, 0.025, 131.25, 806255.625, '2025-05-07 13:10:20'),
(644, 1, 2, 470, 502, 'sub', '13', 'Production', 995, 994, 1, 1, 994, '2025-05-07 13:10:20'),
(645, 1, 2, 553, 585, 'sub', '13', 'Production', 2289, 2288, 1, 1.4159485871751, 3239.6903674566, '2025-05-07 13:10:20'),
(646, 1, 2, 7, 7, 'sub', '13', 'Production', 988, 987, 1, 0.998, 985.026, '2025-05-07 13:10:20'),
(647, 1, 2, 423, 455, 'sub', '13', 'Production', 988, 987, 1, 0.5, 493.5, '2025-05-07 13:10:20'),
(648, 1, 2, 129, 161, 'sub', '13', 'Production', 1, 0.975, 0.025, 839.69, 818.69775, '2025-05-07 13:10:20'),
(649, 1, 2, 34, 34, 'add', '13', 'Production', 0, 1, 1, 29.187448587175, 29.187448587175, '2025-05-07 13:10:20'),
(650, 1, 2, 7, 7, 'sub', '14', 'Production', 987, 986, 1, 0.998, 984.028, '2025-05-07 13:13:18'),
(651, 1, 2, 208, 240, 'sub', '14', 'Production', 0, -0.025, 0.025, 500, 0, '2025-05-07 13:13:18'),
(652, 1, 2, 420, 452, 'sub', '14', 'Production', 987, 986, 1, 1, 986, '2025-05-07 13:13:18'),
(653, 1, 2, 453, 485, 'sub', '14', 'Production', 462, 461, 1, 1, 461, '2025-05-07 13:13:18'),
(654, 1, 2, 553, 585, 'sub', '14', 'Production', 2288, 2287, 1, 1.4159485871751, 3238.2744188695, '2025-05-07 13:13:18'),
(655, 1, 2, 423, 455, 'sub', '14', 'Production', 987, 986, 1, 0.5, 493, '2025-05-07 13:13:18'),
(656, 1, 2, 586, 618, 'sub', '14', 'Production', 0, -0.025, 0.025, 0, 0, '2025-05-07 13:13:18'),
(657, 1, 2, 37, 37, 'add', '14', 'Production', 0, 1, 1, 17.413948587175, 17.413948587175, '2025-05-07 13:13:18'),
(658, 1, 2, 7, 7, 'sub', '1', 'Production', 986, 981, 5, 0.998, 979.038, '2025-05-07 15:35:51'),
(659, 1, 2, 420, 452, 'sub', '1', 'Production', 986, 981, 5, 1, 981, '2025-05-07 15:35:51'),
(660, 1, 2, 7, 7, 'sub', '2', 'Production', 981, 976, 5, 0.998, 974.048, '2025-05-07 15:35:53'),
(661, 1, 2, 420, 452, 'sub', '2', 'Production', 981, 976, 5, 1, 976, '2025-05-07 15:35:53'),
(662, 1, 2, 7, 7, 'sub', '3', 'Production', 976, 971, 5, 0.998, 969.058, '2025-05-07 15:35:56'),
(663, 1, 2, 420, 452, 'sub', '3', 'Production', 976, 971, 5, 1, 971, '2025-05-07 15:35:56'),
(664, 1, 2, 7, 7, 'sub', '4', 'Production', 971, 966, 5, 0.998, 964.068, '2025-05-07 15:42:08'),
(665, 1, 2, 420, 452, 'sub', '4', 'Production', 971, 966, 5, 1, 966, '2025-05-07 15:42:08'),
(666, 1, 2, 7, 7, 'sub', '5', 'Production', 966, 961, 5, 0.998, 959.078, '2025-05-07 16:22:37'),
(667, 1, 2, 420, 452, 'sub', '5', 'Production', 966, 961, 5, 1, 961, '2025-05-07 16:22:37'),
(668, 1, 2, 453, 485, 'add', '35', 'Purchase Order', 461, 1086, 625, 1, 1086, '2025-03-26 00:00:00'),
(669, 1, 2, 470, 502, 'add', '36', 'Purchase Order', 994, 1619, 625, 1, 1619, '2025-03-26 00:00:00'),
(670, 1, 3, 71, 71, 'sub', '216', 'Counter Sale', -2, -3, 1, 50, 0, '2025-05-07 20:26:01'),
(671, 1, 3, 68, 68, 'sub', '217', 'Counter Sale', -4, -5, 1, 50, 0, '2025-05-07 20:26:01'),
(672, 1, 3, 79, 79, 'sub', '218', 'Counter Sale', -6, -7, 1, 50, 0, '2025-05-07 20:26:01'),
(673, 1, 3, 67, 67, 'sub', '219', 'Counter Sale', 0, -1, 1, 0, 0, '2025-05-07 22:50:08'),
(674, 1, 3, 81, 81, 'sub', '220', 'Counter Sale', -4, -5, 1, 50, 0, '2025-05-07 22:50:08'),
(675, 1, 3, 80, 80, 'sub', '221', 'Counter Sale', -8, -9, 1, 50, 0, '2025-05-07 22:50:08'),
(676, 1, 3, 430, 462, 'sub', '222', 'Counter Sale', 0, -1, 1, 0, 0, '2025-05-08 17:34:40'),
(677, 1, 3, 75, 75, 'sub', '223', 'Counter Sale', -2, -3, 1, 50, 0, '2025-05-08 20:34:37'),
(678, 1, 3, 39, 39, 'sub', '224', 'Counter Sale', 0, -1, 1, 50, 0, '2025-05-08 23:56:46'),
(679, 1, 3, 77, 77, 'sub', '225', 'Counter Sale', -6, -7, 1, 50, 0, '2025-05-08 23:56:46'),
(680, 1, 3, 427, 459, 'sub', '226', 'Counter Sale', 0, -1, 1, 0, 0, '2025-05-08 23:56:46'),
(681, 1, 3, 67, 67, 'sub', '227', 'Counter Sale', -1, -2, 1, 0, 0, '2025-05-09 18:09:29'),
(682, 1, 3, 13, 13, 'sub', '228', 'Counter Sale', -1, -2, 1, 50, 0, '2025-05-09 18:33:03'),
(683, 1, 3, 433, 465, 'sub', '229', 'Counter Sale', 212, 162, 50, 1.4320754716981, 231.99622641509, '2025-05-09 18:33:03'),
(684, 1, 3, 433, 465, 'sub', '230', 'Counter Sale', 162, 112, 50, 1.4320754716981, 160.39245283019, '2025-05-09 18:33:47'),
(685, 1, 2, 7, 7, 'sub', '6', 'Production', 961, 956, 5, 0.998, 954.088, '2025-05-09 18:40:19'),
(686, 1, 2, 420, 452, 'sub', '6', 'Production', 961, 956, 5, 1, 956, '2025-05-09 18:40:19'),
(687, 1, 2, 7, 7, 'sub', '7', 'Production', 956, 951, 5, 0.998, 949.098, '2025-05-09 18:42:45'),
(688, 1, 2, 420, 452, 'sub', '7', 'Production', 956, 951, 5, 1, 951, '2025-05-09 18:42:45'),
(689, 1, 2, 7, 7, 'sub', '8', 'Production', 951, 950, 1, 0.998, 948.1, '2025-05-09 18:47:01'),
(690, 1, 2, 420, 452, 'sub', '8', 'Production', 951, 950, 1, 1, 950, '2025-05-09 18:47:01'),
(691, 1, 2, 7, 7, 'sub', '9', 'Production', 950, 949, 1, 0.998, 947.102, '2025-05-09 18:47:33'),
(692, 1, 2, 420, 452, 'sub', '9', 'Production', 950, 949, 1, 1, 949, '2025-05-09 18:47:33'),
(693, 1, 2, 7, 7, 'sub', '10', 'Production', 949, 944, 5, 0.998, 942.112, '2025-05-09 19:19:34'),
(694, 1, 2, 420, 452, 'sub', '10', 'Production', 949, 944, 5, 1, 944, '2025-05-09 19:19:34'),
(695, 1, 2, 436, 468, 'sub', '10', 'Production', 6142.9, 6142.775, 0.125, 131.25, 806239.21875, '2025-05-09 19:19:34'),
(696, 1, 2, 553, 585, 'sub', '10', 'Production', 2287, 2282, 5, 1.4159485871751, 3231.1946759336, '2025-05-09 19:19:34'),
(697, 1, 2, 453, 485, 'sub', '10', 'Production', 1086, 1081, 5, 1, 1081, '2025-05-09 19:19:34'),
(698, 1, 2, 304, 336, 'sub', '10', 'Production', 0.675, 0.55, 0.125, 454.34, 249.887, '2025-05-09 19:19:34'),
(699, 1, 2, 423, 455, 'sub', '10', 'Production', 986, 981, 5, 0.5, 490.5, '2025-05-09 19:19:34'),
(700, 1, 2, 48, 48, 'add', '10', 'Production', 0, 5, 5, 19.553698587175, 97.768492935875, '2025-05-09 19:19:34'),
(701, 1, 2, 7, 7, 'sub', '11', 'Production', 944, 939, 5, 0.998, 937.122, '2025-05-09 19:19:34'),
(702, 1, 2, 420, 452, 'sub', '11', 'Production', 944, 939, 5, 1, 939, '2025-05-09 19:19:34'),
(703, 1, 2, 453, 485, 'sub', '11', 'Production', 1081, 1076, 5, 1, 1076, '2025-05-09 19:19:34'),
(704, 1, 2, 553, 585, 'sub', '11', 'Production', 2282, 2277, 5, 1.4159485871751, 3224.1149329977, '2025-05-09 19:19:34'),
(705, 1, 2, 423, 455, 'sub', '11', 'Production', 981, 976, 5, 0.5, 488, '2025-05-09 19:19:34'),
(706, 1, 2, 325, 357, 'sub', '11', 'Production', 1, 0.875, 0.125, 730, 638.75, '2025-05-09 19:19:34'),
(707, 1, 2, 586, 618, 'sub', '11', 'Production', -0.025, -0.15, 0.125, 0, 0, '2025-05-09 19:19:34'),
(708, 1, 2, 66, 66, 'add', '11', 'Production', -1, 4, 5, 28.954935733969, 115.81974293588, '2025-05-09 19:19:34'),
(709, 1, 2, 7, 7, 'sub', '12', 'Production', 939, 932, 7, 0.998, 930.136, '2025-05-09 19:19:34'),
(710, 1, 2, 420, 452, 'sub', '12', 'Production', 939, 932, 7, 1, 932, '2025-05-09 19:19:34'),
(711, 1, 2, 453, 485, 'sub', '12', 'Production', 1076, 1069, 7, 1, 1069, '2025-05-09 19:19:34'),
(712, 1, 2, 553, 585, 'sub', '12', 'Production', 2277, 2270, 7, 1.4159485871751, 3214.2032928875, '2025-05-09 19:19:34'),
(713, 1, 2, 423, 455, 'sub', '12', 'Production', 976, 969, 7, 0.5, 484.5, '2025-05-09 19:19:34'),
(714, 1, 2, 309, 341, 'sub', '12', 'Production', 0.975, 0.8, 0.175, 357, 285.6, '2025-05-09 19:19:34'),
(715, 1, 2, 586, 618, 'sub', '12', 'Production', -0.15, -0.325, 0.175, 0, 0, '2025-05-09 19:19:34'),
(716, 1, 2, 11, 11, 'add', '12', 'Production', 0, 7, 7, 13.838948587175, 96.872640110226, '2025-05-09 19:19:34'),
(717, 1, 2, 7, 7, 'sub', '13', 'Production', 932, 927, 5, 0.998, 925.146, '2025-05-09 19:19:34'),
(718, 1, 2, 336, 368, 'sub', '13', 'Production', 1, 0.875, 0.125, 601.2, 526.05, '2025-05-09 19:19:34'),
(719, 1, 2, 420, 452, 'sub', '13', 'Production', 932, 927, 5, 1, 927, '2025-05-09 19:19:34'),
(720, 1, 2, 453, 485, 'sub', '13', 'Production', 1069, 1064, 5, 1, 1064, '2025-05-09 19:19:34'),
(721, 1, 2, 553, 585, 'sub', '13', 'Production', 2270, 2265, 5, 1.4159485871751, 3207.1235499516, '2025-05-09 19:19:34'),
(722, 1, 2, 423, 455, 'sub', '13', 'Production', 969, 964, 5, 0.5, 482, '2025-05-09 19:19:34'),
(723, 1, 2, 586, 618, 'sub', '13', 'Production', -0.325, -0.45, 0.125, 0, 0, '2025-05-09 19:19:34'),
(724, 1, 2, 50, 50, 'add', '13', 'Production', -3, 2, 5, 49.859871467938, 99.719742935876, '2025-05-09 19:19:34'),
(725, 1, 2, 420, 452, 'sub', '14', 'Production', 927, 922, 5, 1, 922, '2025-05-09 19:19:34'),
(726, 1, 2, 453, 485, 'sub', '14', 'Production', 1064, 1059, 5, 1, 1059, '2025-05-09 19:19:34'),
(727, 1, 2, 553, 585, 'sub', '14', 'Production', 2265, 2260, 5, 1.4159485871751, 3200.0438070157, '2025-05-09 19:19:34'),
(728, 1, 2, 423, 455, 'sub', '14', 'Production', 964, 959, 5, 0.5, 479.5, '2025-05-09 19:19:34'),
(729, 1, 2, 338, 370, 'sub', '14', 'Production', 1, -0.25, 1.25, 536.2, 0, '2025-05-09 19:19:34'),
(730, 1, 2, 7, 7, 'sub', '14', 'Production', 927, 922, 5, 0.998, 920.156, '2025-05-09 19:19:34'),
(731, 1, 2, 586, 618, 'sub', '14', 'Production', -0.45, -0.575, 0.125, 0, 0, '2025-05-09 19:19:34'),
(732, 1, 2, 14, 14, 'add', '14', 'Production', -1, 4, 5, 173.70493573397, 694.81974293588, '2025-05-09 19:19:34'),
(733, 1, 2, 7, 7, 'sub', '15', 'Production', 922, 917, 5, 0.998, 915.166, '2025-05-09 19:19:34'),
(734, 1, 2, 420, 452, 'sub', '15', 'Production', 922, 917, 5, 1, 917, '2025-05-09 19:19:34'),
(735, 1, 2, 453, 485, 'sub', '15', 'Production', 1059, 1054, 5, 1, 1054, '2025-05-09 19:19:34'),
(736, 1, 2, 553, 585, 'sub', '15', 'Production', 2260, 2255, 5, 1.4159485871751, 3192.9640640799, '2025-05-09 19:19:34'),
(737, 1, 2, 423, 455, 'sub', '15', 'Production', 959, 954, 5, 0.5, 477, '2025-05-09 19:19:34'),
(738, 1, 2, 341, 373, 'sub', '15', 'Production', 1, 0.875, 0.125, 680, 595, '2025-05-09 19:19:34'),
(739, 1, 2, 586, 618, 'sub', '15', 'Production', -0.575, -0.7, 0.125, 0, 0, '2025-05-09 19:19:34'),
(740, 1, 2, 550, 582, 'add', '15', 'Production', -2, 3, 5, 36.523247645292, 109.56974293588, '2025-05-09 19:19:34'),
(741, 1, 2, 7, 7, 'sub', '16', 'Production', 917, 912, 5, 0.998, 910.176, '2025-05-09 19:19:34'),
(742, 1, 2, 420, 452, 'sub', '16', 'Production', 917, 912, 5, 1, 912, '2025-05-09 19:19:34'),
(743, 1, 2, 453, 485, 'sub', '16', 'Production', 1054, 1049, 5, 1, 1049, '2025-05-09 19:19:34'),
(744, 1, 2, 553, 585, 'sub', '16', 'Production', 2255, 2250, 5, 1.4159485871751, 3185.884321144, '2025-05-09 19:19:34'),
(745, 1, 2, 423, 455, 'sub', '16', 'Production', 954, 949, 5, 0.5, 474.5, '2025-05-09 19:19:34'),
(746, 1, 2, 318, 350, 'sub', '16', 'Production', 0, -0.125, 0.125, 630.98, 0, '2025-05-09 19:19:34'),
(747, 1, 2, 586, 618, 'sub', '16', 'Production', -0.7, -0.825, 0.125, 0, 0, '2025-05-09 19:19:34'),
(748, 1, 2, 39, 39, 'add', '16', 'Production', -1, 4, 5, 25.860560733969, 103.44224293588, '2025-05-09 19:19:35'),
(749, 1, 2, 7, 7, 'sub', '17', 'Production', 912, 907, 5, 0.998, 905.186, '2025-05-09 19:19:35'),
(750, 1, 2, 420, 452, 'sub', '17', 'Production', 912, 907, 5, 1, 907, '2025-05-09 19:19:35'),
(751, 1, 2, 453, 485, 'sub', '17', 'Production', 1049, 1044, 5, 1, 1044, '2025-05-09 19:19:35'),
(752, 1, 2, 553, 585, 'sub', '17', 'Production', 2250, 2245, 5, 1.4159485871751, 3178.8045782081, '2025-05-09 19:19:35'),
(753, 1, 2, 346, 378, 'sub', '17', 'Production', 0, -0.125, 0.125, 0, 0, '2025-05-09 19:19:35'),
(754, 1, 2, 423, 455, 'sub', '17', 'Production', 949, 944, 5, 0.5, 472, '2025-05-09 19:19:35'),
(755, 1, 2, 436, 468, 'sub', '17', 'Production', 6142.9, 6142.775, 0.125, 131.25, 806239.21875, '2025-05-09 19:19:35'),
(756, 1, 2, 552, 584, 'add', '17', 'Production', 199, 204, 5, 1.9079705536072, 389.22599293588, '2025-05-09 19:19:35'),
(757, 1, 2, 7, 7, 'sub', '18', 'Production', 907, 906, 1, 0.998, 904.188, '2025-05-09 19:30:58'),
(758, 1, 2, 7, 7, 'sub', '19', 'Production', 906, 905, 1, 0.998, 903.19, '2025-05-09 19:31:03'),
(759, 1, 2, 7, 7, 'sub', '20', 'Production', 905, 904, 1, 0.998, 902.192, '2025-05-09 19:31:08'),
(760, 1, 2, 7, 7, 'sub', '21', 'Production', 904, 903, 1, 0.998, 901.194, '2025-05-09 19:31:13'),
(761, 1, 2, 7, 7, 'sub', '22', 'Production', 903, 902, 1, 0.998, 900.196, '2025-05-09 19:32:00'),
(762, 1, 2, 7, 7, 'sub', '23', 'Production', 902, 901, 1, 0.998, 899.198, '2025-05-09 19:32:25'),
(763, 1, 2, 7, 7, 'sub', '24', 'Production', 901, 900, 1, 0.998, 898.2, '2025-05-09 19:32:30'),
(764, 1, 2, 7, 7, 'sub', '25', 'Production', 900, 899, 1, 0.998, 897.202, '2025-05-09 19:32:34'),
(765, 1, 2, 7, 7, 'sub', '26', 'Production', 899, 898, 1, 0.998, 896.204, '2025-05-09 19:32:41'),
(766, 1, 2, 7, 7, 'sub', '27', 'Production', 898, 897, 1, 0.998, 895.206, '2025-05-09 19:33:04'),
(767, 1, 2, 7, 7, 'sub', '28', 'Production', 897, 896, 1, 0.998, 894.208, '2025-05-09 19:35:19'),
(768, 1, 2, 7, 7, 'sub', '29', 'Production', 896, 895, 1, 0.998, 893.21, '2025-05-09 19:35:24'),
(769, 1, 2, 7, 7, 'sub', '30', 'Production', 895, 894, 1, 0.998, 892.212, '2025-05-09 19:35:28'),
(770, 1, 2, 7, 7, 'sub', '31', 'Production', 894, 893, 1, 0.998, 891.214, '2025-05-09 19:35:51'),
(771, 1, 2, 7, 7, 'sub', '32', 'Production', 893, 892, 1, 0.998, 890.216, '2025-05-09 19:35:55'),
(772, 1, 3, 16, 16, 'sub', '231', 'Counter Sale', -1, -2, 1, 50, 0, '2025-05-09 20:50:10'),
(773, 1, 3, 13, 13, 'sub', '232', 'Counter Sale', -2, -3, 1, 50, 0, '2025-05-09 21:23:06'),
(774, 1, 3, 69, 69, 'sub', '233', 'Counter Sale', -2, -3, 1, 50, 0, '2025-05-10 20:29:54'),
(775, 1, 3, 19, 19, 'sub', '234', 'Counter Sale', -1, -2, 1, 50, 0, '2025-05-10 21:31:24'),
(776, 1, 3, 81, 81, 'sub', '235', 'Counter Sale', -5, -6, 1, 50, 0, '2025-05-10 21:31:24'),
(777, 1, 3, 46, 46, 'sub', '236', 'Counter Sale', -1, -2, 1, 50, 0, '2025-05-10 21:31:24'),
(778, 1, 3, 75, 75, 'sub', '237', 'Counter Sale', -3, -4, 1, 50, 0, '2025-05-10 21:31:24'),
(779, 1, 3, 429, 461, 'sub', '238', 'Counter Sale', -1, -2, 1, 0, 0, '2025-05-11 20:32:58'),
(780, 1, 3, 63, 63, 'sub', '239', 'Counter Sale', -1, -2, 1, 50, 0, '2025-05-11 21:06:06'),
(781, 1, 3, 75, 75, 'sub', '240', 'Counter Sale', -4, -5, 1, 50, 0, '2025-05-11 21:06:06'),
(782, 1, 3, 20, 20, 'sub', '241', 'Counter Sale', -3, -4, 1, 50, 0, '2025-05-11 21:39:57'),
(783, 1, 3, 80, 80, 'sub', '242', 'Counter Sale', -9, -10, 1, 50, 0, '2025-05-11 21:39:57'),
(784, 1, 3, 81, 81, 'sub', '243', 'Counter Sale', -6, -7, 1, 50, 0, '2025-05-11 21:39:57'),
(785, 1, 3, 552, 584, 'sub', '244', 'Delivery Sale', 204, 203, 1, 1.9079705536072, 387.31802238226, '2025-05-12 14:08:09'),
(786, 1, 3, 80, 80, 'sub', '245', 'Delivery Sale', -10, -11, 1, 50, 0, '2025-05-12 14:08:09'),
(787, 1, 3, 39, 39, 'sub', '246', 'Delivery Sale', 4, 3, 1, 25.860560733969, 77.581682201907, '2025-05-12 14:08:09'),
(788, 1, 3, 23, 23, 'sub', '247', 'Delivery Sale', -1, -2, 1, 50, 0, '2025-05-12 14:08:09'),
(789, 1, 3, 56, 56, 'sub', '248', 'Delivery Sale', 0, -1, 1, 50, 0, '2025-05-12 14:08:09'),
(790, 1, 3, 434, 466, 'sub', '249', 'Delivery Sale', -3, -4, 1, 0, 0, '2025-05-12 14:08:09'),
(791, 1, 3, 9, 9, 'sub', '250', 'Counter Sale', 0, -1, 1, 0, 0, '2025-05-12 17:26:15'),
(792, 1, 3, 81, 81, 'sub', '251', 'Counter Sale', -7, -9, 2, 50, 0, '2025-05-12 17:26:15'),
(793, 1, 3, 8, 8, 'sub', '252', 'Counter Sale', 0, -2, 2, 0, 0, '2025-05-12 17:26:15'),
(794, 1, 3, 72, 72, 'sub', '253', 'Counter Sale', -6, -7, 1, 50, 0, '2025-05-12 17:26:15'),
(795, 1, 3, 547, 579, 'sub', '254', 'Counter Sale', 0, -1, 1, 0, 0, '2025-05-12 19:30:10'),
(796, 1, 3, 50, 50, 'sub', '255', 'Counter Sale', 2, 1, 1, 49.859871467938, 49.859871467938, '2025-05-12 19:30:10'),
(797, 1, 3, 69, 69, 'sub', '256', 'Counter Sale', -3, -5, 2, 50, 0, '2025-05-12 19:42:26'),
(798, 1, 3, 80, 80, 'sub', '257', 'Counter Sale', -11, -13, 2, 50, 0, '2025-05-12 19:42:26'),
(799, 1, 3, 432, 464, 'sub', '258', 'Counter Sale', -3, -4, 1, 0, 0, '2025-05-12 19:42:26'),
(800, 1, 3, 428, 460, 'sub', '259', 'Counter Sale', 0, -1, 1, 0, 0, '2025-05-12 19:42:26'),
(801, 1, 3, 428, 460, 'sub', '260', 'Counter Sale', -1, -2, 1, 0, 0, '2025-05-13 19:22:16'),
(802, 1, 3, 427, 459, 'sub', '261', 'Counter Sale', -1, -2, 1, 0, 0, '2025-05-13 19:23:01'),
(803, 1, 3, 69, 69, 'sub', '262', 'Counter Sale', -5, -6, 1, 50, 0, '2025-05-13 19:57:17'),
(804, 1, 3, 80, 80, 'sub', '263', 'Counter Sale', -13, -14, 1, 50, 0, '2025-05-13 21:49:35'),
(805, 1, 3, 420, 452, 'sub', '264', 'Counter Sale', 907, 887, 20, 1, 887, '2025-05-13 21:52:03'),
(806, 1, 3, 7, 7, 'sub', '265', 'Counter Sale', 892, 872, 20, 0.998, 870.256, '2025-05-13 21:52:03'),
(807, 1, 3, 470, 502, 'sub', '266', 'Counter Sale', 1619, 1599, 20, 1, 1599, '2025-05-13 21:52:03'),
(808, 1, 3, 23, 23, 'sub', '267', 'Counter Sale', -2, -3, 1, 50, 0, '2025-05-13 22:20:58'),
(809, 1, 3, 75, 75, 'sub', '268', 'Counter Sale', -5, -6, 1, 50, 0, '2025-05-14 14:52:04'),
(810, 1, 3, 80, 80, 'sub', '269', 'Counter Sale', -14, -15, 1, 50, 0, '2025-05-14 20:49:44'),
(811, 1, 3, 430, 462, 'sub', '270', 'Counter Sale', -1, -2, 1, 0, 0, '2025-05-14 20:49:44'),
(812, 1, 3, 73, 73, 'sub', '271', 'Counter Sale', -7, -8, 1, 50, 0, '2025-05-14 20:49:44'),
(813, 1, 3, 75, 75, 'sub', '272', 'Counter Sale', -6, -7, 1, 50, 0, '2025-05-15 00:04:23'),
(814, 1, 3, 63, 63, 'sub', '273', 'Counter Sale', -2, -3, 1, 50, 0, '2025-05-15 16:15:31'),
(815, 1, 4, 7, 7, 'sub', '274', 'Counter Sale', 872, 871, 1, 0.998, 869.258, '2025-05-15 17:02:59'),
(816, 1, 4, 372, 404, 'sub', '275', 'Counter Sale', 0, -1, 1, 0, 0, '2025-05-15 17:02:59'),
(817, 1, 4, 373, 405, 'sub', '276', 'Counter Sale', 0, -1, 1, 0, 0, '2025-05-15 17:02:59'),
(818, 1, 4, 7, 7, 'add', '274', 'Sale Delete', 871, 872, 1, 0, 0, '2025-05-15 17:07:59'),
(819, 1, 4, 372, 404, 'add', '275', 'Sale Delete', -1, 0, 1, 0, 0, '2025-05-15 17:07:59'),
(820, 1, 4, 373, 405, 'add', '276', 'Sale Delete', -1, 0, 1, 0, 0, '2025-05-15 17:07:59'),
(821, 1, 4, 7, 7, 'sub', '277', 'Counter Sale', 873, 872, 1, 0.998, 870.256, '2025-05-15 17:10:43'),
(822, 1, 4, 7, 7, 'sub', '278', 'Counter Sale', 873, 872, 1, 0.998, 870.256, '2025-05-15 17:10:43'),
(823, 1, 4, 7, 7, 'sub', '279', 'Counter Sale', 873, 872, 1, 0.998, 870.256, '2025-05-15 17:10:43'),
(824, 1, 4, 7, 7, 'add', '277', 'Sale Delete', 872, 873, 1, 0, 0, '2025-05-15 17:13:15'),
(825, 1, 4, 7, 7, 'add', '278', 'Sale Delete', 873, 874, 1, 0, 0, '2025-05-15 17:13:15'),
(826, 1, 4, 7, 7, 'add', '279', 'Sale Delete', 874, 875, 1, 0, 0, '2025-05-15 17:13:15'),
(827, 1, 4, 70, 70, 'sub', '280', 'Counter Sale', -4, -24, 20, 50, 0, '2025-05-15 19:48:25'),
(828, 1, 4, 77, 77, 'sub', '281', 'Counter Sale', -7, -22, 15, 50, 0, '2025-05-15 19:48:25'),
(829, 1, 4, 79, 79, 'sub', '282', 'Counter Sale', -7, -22, 15, 50, 0, '2025-05-15 19:48:25'),
(830, 1, 3, 76, 76, 'sub', '283', 'Counter Sale', -3, -4, 1, 50, 0, '2025-05-15 22:06:48'),
(831, 1, 3, 77, 77, 'sub', '284', 'Counter Sale', -22, -23, 1, 50, 0, '2025-05-15 22:06:48'),
(832, 1, 3, 70, 70, 'add', '280', 'Sale Delete', -24, -4, 20, 0, 0, '2025-05-15 22:07:13'),
(833, 1, 3, 77, 77, 'add', '281', 'Sale Delete', -23, -8, 15, 0, 0, '2025-05-15 22:07:13'),
(834, 1, 3, 79, 79, 'add', '282', 'Sale Delete', -22, -7, 15, 0, 0, '2025-05-15 22:07:13'),
(835, 1, 3, 550, 582, 'sub', '285', 'Counter Sale', 3, 2, 1, 36.523247645292, 73.046495290584, '2025-05-16 17:56:15'),
(836, 1, 3, 76, 76, 'sub', '286', 'Counter Sale', -4, -5, 1, 50, 0, '2025-05-16 18:23:05'),
(837, 1, 3, 72, 72, 'sub', '287', 'Counter Sale', -7, -8, 1, 50, 0, '2025-05-16 18:23:05'),
(838, 1, 3, 16, 16, 'sub', '288', 'Counter Sale', -2, -3, 1, 50, 0, '2025-05-16 18:59:47'),
(839, 1, 3, 550, 582, 'sub', '289', 'Counter Sale', 2, 1, 1, 36.523247645292, 36.523247645292, '2025-05-16 20:09:19'),
(840, 1, 3, 76, 76, 'sub', '290', 'Counter Sale', -5, -6, 1, 50, 0, '2025-05-16 20:09:19'),
(841, 1, 3, 425, 457, 'sub', '291', 'Counter Sale', 0, -1, 1, 0, 0, '2025-05-16 21:18:45'),
(842, 1, 3, 41, 41, 'sub', '292', 'Counter Sale', 0, -1, 1, 50, 0, '2025-05-16 21:18:45'),
(843, 1, 3, 551, 583, 'sub', '293', 'Counter Sale', 200, 199, 1, 1.5, 298.5, '2025-05-16 21:18:45'),
(844, 1, 3, 432, 464, 'sub', '294', 'Counter Sale', -4, -5, 1, 0, 0, '2025-05-16 22:48:20'),
(845, 1, 3, 13, 13, 'sub', '295', 'Counter Sale', -3, -4, 1, 50, 0, '2025-05-16 23:05:17'),
(846, 1, 3, 70, 70, 'sub', '296', 'Counter Sale', -4, -5, 1, 50, 0, '2025-05-16 23:05:17'),
(847, 1, 3, 69, 69, 'sub', '297', 'Counter Sale', -6, -7, 1, 50, 0, '2025-05-16 23:05:17'),
(848, 1, 3, 18, 18, 'sub', '298', 'Delivery Sale', -1, -2, 1, 0, 0, '2025-05-17 09:50:43'),
(849, 1, 3, 434, 466, 'sub', '299', 'Delivery Sale', -4, -5, 1, 0, 0, '2025-05-17 09:50:43'),
(850, 1, 3, 63, 63, 'sub', '300', 'Counter Sale', -3, -4, 1, 50, 0, '2025-05-17 10:32:51'),
(851, 1, 3, 39, 39, 'sub', '301', 'Counter Sale', 3, 2, 1, 25.860560733969, 51.721121467938, '2025-05-17 10:32:51'),
(852, 1, 3, 23, 23, 'sub', '302', 'Counter Sale', -3, -4, 1, 50, 0, '2025-05-17 10:32:51'),
(853, 1, 3, 75, 75, 'sub', '303', 'Counter Sale', -7, -8, 1, 50, 0, '2025-05-17 11:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `stock_manage_items`
--

CREATE TABLE `stock_manage_items` (
  `id` bigint NOT NULL,
  `stock_manage_id` bigint NOT NULL,
  `item_price_id` bigint NOT NULL,
  `item_price_size_id` bigint NOT NULL,
  `item_id` bigint NOT NULL,
  `qty` double NOT NULL,
  `received_qty` double DEFAULT '0',
  `cost_price` double DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `supplier_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_company_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `uuid`, `branch_id`, `supplier_name`, `supplier_company_name`, `supplier_email`, `supplier_company_email`, `supplier_phone`, `supplier_address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1248ce04-abb6-4d90-8c94-09a934838416', 1, 'SKYLINE', 'SKYLINE', NULL, NULL, '98765678', NULL, '2025-04-15 18:22:01', '2025-04-15 18:22:01', NULL),
(2, '89f924ff-dca7-4675-876b-72d56e272cc4', 1, 'LA ROSE GALLERY PERFUMES', 'LA ROSE GALLERY PERFUMES', NULL, NULL, '065562611', 'AJMAN LUWARA', '2025-05-05 10:11:18', '2025-05-05 10:11:18', NULL),
(3, 'c1e1d7c7-c4c9-4963-be99-7357c1c942c9', 1, 'TAYEB AL WARD TRADING LLC', 'TAYEB AL WARD TRADING LLC', NULL, NULL, '0523086008', NULL, '2025-05-05 11:08:48', '2025-05-05 11:08:48', NULL),
(4, 'bf35385b-a9d7-46d0-bec0-ccea1595b2bc', 1, 'MOHAMED SHAMSI', 'SHAMSI', NULL, NULL, '0505282235', 'DUBAI', '2025-05-05 11:51:07', '2025-05-05 11:51:07', NULL),
(5, 'd3761ccb-4057-4861-96c2-538fd69e407a', 1, 'BIN TAMAM', 'BIN TAMAM', NULL, NULL, '0506445141', NULL, '2025-05-05 13:08:31', '2025-05-05 13:08:31', NULL),
(6, '96e78ef2-a55d-4ab6-a230-f4ee5ebdba92', 1, 'AL FAKHAMAH', 'AL FAKHAMAH', NULL, NULL, '0509254073', NULL, '2025-05-05 16:13:51', '2025-05-05 16:13:51', NULL),
(7, '5c9a2b2a-91c9-4138-9def-ffdea0dc5665', 1, 'FAWAF PERFUMES', 'FAWAF PERFUMES', NULL, NULL, '0551714931', NULL, '2025-05-06 12:57:46', '2025-05-06 12:57:46', NULL),
(8, 'ba30ce89-0929-4b83-b9ff-5e3979d950f3', 1, 'GOLDEN WINGS', 'GOLDEN WINGS', NULL, NULL, '0524662263', NULL, '2025-05-06 16:38:18', '2025-05-06 16:38:18', NULL),
(9, 'a4fe4fa5-c61a-4db6-804b-0e867e97b7cd', 1, 'DAHMA TRADING - SHEIJAH ISSA', 'DAHMA TRADING - SHEIJAH ISSA', NULL, NULL, '050185067', NULL, '2025-05-07 10:06:49', '2025-05-07 10:06:49', NULL),
(10, '92c66751-1a9c-43ca-9865-01a0ba220cf5', 1, 'PRIME PACKING MATERIALS RTANDING', 'PRIME PACKING MATERIALS RTANDING', NULL, NULL, '0502183606', NULL, '2025-05-07 10:16:34', '2025-05-07 10:16:34', NULL),
(11, 'bb72470e-f658-446a-9754-b115c2e8e835', 1, 'SUN SHINE ARTIFACTS', 'SUN SHINE ARTIFACTS', NULL, NULL, '0563408427', NULL, '2025-05-07 10:41:22', '2025-05-07 10:41:22', NULL),
(12, '901296e2-e765-4bf4-8524-1b7974978b45', 1, 'SMELL & SMILE', 'SMELL & SMILE', NULL, NULL, '0505627380', NULL, '2025-05-07 11:00:49', '2025-05-07 11:00:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `unit_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `uuid`, `branch_id`, `unit_name`, `unit_slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'e980c6b3-4359-4c68-ab65-a03907bfa5b1', 1, 'pcs', 'pcs', '2025-04-15 14:21:24', '2025-04-15 14:21:24', NULL),
(2, '017d38d6-29fb-4166-958a-f6e34c16c9d0', 1, 'carton', 'carton', '2025-04-15 14:21:24', '2025-04-15 14:21:24', NULL),
(3, 'b0a5faa9-393f-45fe-a29a-c7970d16b629', 1, 'BOX', 'box', '2025-04-15 18:01:34', '2025-04-15 18:01:34', NULL),
(4, 'e25e19d1-2dda-4d7b-a2d4-32bbbb23be11', 1, 'KG', 'kg', '2025-04-15 18:01:56', '2025-04-15 18:01:56', NULL),
(5, 'cf8ab218-eb4b-4499-a83e-82ccaf8b2798', 1, 'LITRE', 'litre', '2025-04-15 18:19:36', '2025-04-15 18:19:36', NULL),
(6, 'cef4532d-5b26-424e-bdae-9e0962d0efb4', 1, 'reval proudacte material', 'reval-proudacte-material', '2025-04-28 19:36:18', '2025-04-28 19:37:05', '2025-04-28 19:37:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usertype` enum('superadmin','mainadmin','admin','counter') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `branch_id`, `name`, `email`, `usertype`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'superadmin', NULL, 'superadmin', 'superadmin', 'superadmin', NULL, '$2y$10$Qkgg.mRpLM1kvwFd8Mp62OW0WSPlj9PBrnVXQAAdhhDFBOQniJcWy', NULL, NULL, NULL, NULL),
(2, '872100aa-9cbe-482a-918d-5ea321c5f21a', 1, 'Admin', NULL, 'admin', NULL, '$2y$10$RF4PTiR/0chLAolStcPsseyM9CqV20u269gjiVbNx5a6MQsharCAq', NULL, '2025-04-15 15:23:58', '2025-04-26 15:32:19', NULL),
(3, '515a6ae3-eb5a-4557-97ed-993c426a1c14', 1, 'Counter', NULL, 'counter', NULL, '$2y$10$o5BMknxAhfEBKCDz1SUVXOGEUDwmcz.RFmcWi.XfYvawVGQpJ2BPi', NULL, '2025-04-15 15:24:17', '2025-05-01 18:31:43', NULL),
(4, 'cc5f8733-114f-439d-8b2d-e6560273d839', 1, 'abdhulla', NULL, 'counter', NULL, '$2y$10$2fcTYrBG5YU4Xn25nplKEutKCpkkqfZI1W8KinNtyhNZqJ6I2a3wq', NULL, '2025-05-01 18:32:03', '2025-05-01 18:34:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_permissions`
--

CREATE TABLE `user_has_permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_has_permissions`
--

INSERT INTO `user_has_permissions` (`id`, `user_id`, `action`, `created_at`, `updated_at`) VALUES
(169, 2, 'master', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(170, 2, 'category', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(171, 2, 'category_create', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(172, 2, 'category_edit', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(173, 2, 'category_delete', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(174, 2, 'items', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(175, 2, 'item_create', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(176, 2, 'item_edit', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(177, 2, 'item_delete', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(178, 2, 'units', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(179, 2, 'unit_create', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(180, 2, 'unit_edit', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(181, 2, 'unit_delete', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(182, 2, 'suppliers', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(183, 2, 'supplier_create', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(184, 2, 'supplier_edit', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(185, 2, 'supplier_delete', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(186, 2, 'drivers', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(187, 2, 'driver_create', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(188, 2, 'driver_edit', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(189, 2, 'driver_delete', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(190, 2, 'staffs', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(191, 2, 'staff_create', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(192, 2, 'staff_edit', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(193, 2, 'staff_delete', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(194, 2, 'customers', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(195, 2, 'customer_create', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(196, 2, 'customer_edit', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(197, 2, 'customer_delete', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(198, 2, 'expense_category', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(199, 2, 'expense_category_create', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(200, 2, 'expense_category_edit', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(201, 2, 'expense_category_delete', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(202, 2, 'production', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(203, 2, 'barcode_print', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(204, 2, 'transcations', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(205, 2, 'sales', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(206, 2, 'sale_delete', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(207, 2, 'sale_payment_change', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(208, 2, 'purchases', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(209, 2, 'purchase_create', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(210, 2, 'purchase_edit', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(211, 2, 'purchase_delete', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(212, 2, 'expenses', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(213, 2, 'expense_create', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(214, 2, 'expense_edit', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(215, 2, 'expense_delete', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(216, 2, 'manage_stocks', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(217, 2, 'stock_adjust', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(218, 2, 'stock_transfer', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(219, 2, 'stock_transfer_create', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(220, 2, 'stock_transfer_edit', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(221, 2, 'stock_transfer_delete', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(222, 2, 'stock_add', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(223, 2, 'stock_update', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(224, 2, 'reports', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(225, 2, 'bill_wise_report', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(226, 2, 'item_wise_report', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(227, 2, 'category_wise_report', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(228, 2, 'order_type_wise_report', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(229, 2, 'user_wise_report', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(230, 2, 'staff_wise_report', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(231, 2, 'driver_wise_report', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(232, 2, 'customer_wise_report', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(233, 2, 'perfomance_report', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(234, 2, 'purchase_wise_report', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(235, 2, 'supplier_wise_report', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(236, 2, 'stock_report', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(237, 2, 'logs', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(238, 2, 'settle_sale_report', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(239, 2, 'supplier_outstanding_report', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(240, 2, 'customer_outstanding_report', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(241, 2, 'driver_outstanding_report', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(242, 2, 'expense_report', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(243, 2, 'profit_loss_report', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(244, 2, 'couter', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(245, 2, 'counter_sale', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(246, 2, 'expense', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(247, 2, 'credit_sale', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(248, 2, 'Recent_sales', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(249, 2, 'settle_sale', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(250, 2, 'opening_balance', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(251, 2, 'crm', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(252, 2, 'pay_back', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(253, 2, 'open_drawer', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(254, 2, 'delivery_log', '2025-04-26 15:32:19', '2025-04-26 15:32:19'),
(255, 3, 'master', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(256, 3, 'category', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(257, 3, 'category_create', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(258, 3, 'category_edit', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(259, 3, 'category_delete', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(260, 3, 'items', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(261, 3, 'item_create', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(262, 3, 'item_edit', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(263, 3, 'item_delete', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(264, 3, 'units', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(265, 3, 'unit_create', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(266, 3, 'unit_edit', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(267, 3, 'unit_delete', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(268, 3, 'suppliers', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(269, 3, 'supplier_create', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(270, 3, 'supplier_edit', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(271, 3, 'supplier_delete', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(272, 3, 'drivers', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(273, 3, 'driver_create', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(274, 3, 'driver_edit', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(275, 3, 'driver_delete', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(276, 3, 'staffs', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(277, 3, 'staff_create', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(278, 3, 'staff_edit', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(279, 3, 'staff_delete', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(280, 3, 'customers', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(281, 3, 'customer_create', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(282, 3, 'customer_edit', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(283, 3, 'customer_delete', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(284, 3, 'expense_category', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(285, 3, 'expense_category_create', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(286, 3, 'expense_category_edit', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(287, 3, 'expense_category_delete', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(288, 3, 'production', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(289, 3, 'barcode_print', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(290, 3, 'transcations', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(291, 3, 'sales', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(292, 3, 'sale_delete', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(293, 3, 'sale_payment_change', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(294, 3, 'purchases', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(295, 3, 'purchase_create', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(296, 3, 'purchase_edit', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(297, 3, 'purchase_delete', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(298, 3, 'expenses', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(299, 3, 'expense_create', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(300, 3, 'expense_edit', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(301, 3, 'expense_delete', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(302, 3, 'manage_stocks', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(303, 3, 'stock_adjust', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(304, 3, 'stock_transfer', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(305, 3, 'stock_transfer_create', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(306, 3, 'stock_transfer_edit', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(307, 3, 'stock_transfer_delete', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(308, 3, 'reports', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(309, 3, 'bill_wise_report', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(310, 3, 'item_wise_report', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(311, 3, 'category_wise_report', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(312, 3, 'order_type_wise_report', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(313, 3, 'user_wise_report', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(314, 3, 'staff_wise_report', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(315, 3, 'driver_wise_report', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(316, 3, 'customer_wise_report', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(317, 3, 'perfomance_report', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(318, 3, 'purchase_wise_report', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(319, 3, 'supplier_wise_report', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(320, 3, 'stock_report', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(321, 3, 'logs', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(322, 3, 'settle_sale_report', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(323, 3, 'supplier_outstanding_report', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(324, 3, 'customer_outstanding_report', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(325, 3, 'driver_outstanding_report', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(326, 3, 'expense_report', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(327, 3, 'profit_loss_report', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(328, 3, 'couter', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(329, 3, 'counter_sale', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(330, 3, 'expense', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(331, 3, 'credit_sale', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(332, 3, 'Recent_sales', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(333, 3, 'settle_sale', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(334, 3, 'opening_balance', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(335, 3, 'crm', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(336, 3, 'pay_back', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(337, 3, 'open_drawer', '2025-05-01 18:31:43', '2025-05-01 18:31:43'),
(423, 4, 'master', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(424, 4, 'category', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(425, 4, 'category_create', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(426, 4, 'category_edit', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(427, 4, 'category_delete', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(428, 4, 'items', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(429, 4, 'item_create', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(430, 4, 'item_edit', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(431, 4, 'item_delete', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(432, 4, 'units', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(433, 4, 'unit_create', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(434, 4, 'unit_edit', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(435, 4, 'unit_delete', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(436, 4, 'suppliers', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(437, 4, 'supplier_create', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(438, 4, 'supplier_edit', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(439, 4, 'supplier_delete', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(440, 4, 'drivers', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(441, 4, 'driver_create', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(442, 4, 'driver_edit', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(443, 4, 'driver_delete', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(444, 4, 'staffs', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(445, 4, 'staff_create', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(446, 4, 'staff_edit', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(447, 4, 'staff_delete', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(448, 4, 'customers', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(449, 4, 'customer_create', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(450, 4, 'customer_edit', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(451, 4, 'customer_delete', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(452, 4, 'expense_category', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(453, 4, 'expense_category_create', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(454, 4, 'expense_category_edit', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(455, 4, 'expense_category_delete', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(456, 4, 'production', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(457, 4, 'barcode_print', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(458, 4, 'transcations', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(459, 4, 'sales', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(460, 4, 'sale_delete', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(461, 4, 'sale_payment_change', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(462, 4, 'purchases', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(463, 4, 'purchase_create', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(464, 4, 'purchase_edit', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(465, 4, 'purchase_delete', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(466, 4, 'expenses', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(467, 4, 'expense_create', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(468, 4, 'expense_edit', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(469, 4, 'expense_delete', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(470, 4, 'manage_stocks', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(471, 4, 'stock_adjust', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(472, 4, 'stock_transfer', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(473, 4, 'stock_transfer_create', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(474, 4, 'stock_transfer_edit', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(475, 4, 'stock_transfer_delete', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(476, 4, 'stock_add', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(477, 4, 'stock_update', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(478, 4, 'reports', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(479, 4, 'bill_wise_report', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(480, 4, 'item_wise_report', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(481, 4, 'category_wise_report', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(482, 4, 'order_type_wise_report', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(483, 4, 'user_wise_report', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(484, 4, 'staff_wise_report', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(485, 4, 'driver_wise_report', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(486, 4, 'customer_wise_report', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(487, 4, 'perfomance_report', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(488, 4, 'purchase_wise_report', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(489, 4, 'supplier_wise_report', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(490, 4, 'stock_report', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(491, 4, 'logs', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(492, 4, 'settle_sale_report', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(493, 4, 'supplier_outstanding_report', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(494, 4, 'customer_outstanding_report', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(495, 4, 'driver_outstanding_report', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(496, 4, 'expense_report', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(497, 4, 'profit_loss_report', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(498, 4, 'couter', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(499, 4, 'counter_sale', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(500, 4, 'expense', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(501, 4, 'credit_sale', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(502, 4, 'Recent_sales', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(503, 4, 'settle_sale', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(504, 4, 'opening_balance', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(505, 4, 'crm', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(506, 4, 'pay_back', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(507, 4, 'open_drawer', '2025-05-01 18:34:06', '2025-05-01 18:34:06'),
(508, 4, 'delivery_log', '2025-05-01 18:34:06', '2025-05-01 18:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `wastage_usage`
--

CREATE TABLE `wastage_usage` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `price_id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `qty` bigint NOT NULL,
  `wastage_qty` bigint NOT NULL,
  `usage_qty` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wastage_usage`
--

INSERT INTO `wastage_usage` (`id`, `branch_id`, `user_id`, `price_id`, `item_id`, `qty`, `wastage_qty`, `usage_qty`, `created_at`, `deleted_at`) VALUES
(1, 1, 2, 1, 1, 1, 1, 0, '2025-04-15 18:44:20', NULL),
(2, 1, 2, 1, 1, 1, 0, 1, '2025-04-15 18:44:33', NULL);

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
-- Indexes for table `inventory_log`
--
ALTER TABLE `inventory_log`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `item_ingredient`
--
ALTER TABLE `item_ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_prices`
--
ALTER TABLE `item_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_prices_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `item_production`
--
ALTER TABLE `item_production`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `purchase_pay_log`
--
ALTER TABLE `purchase_pay_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_prices_branch_id_foreign` (`branch_id`);

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
-- Indexes for table `stock_manage`
--
ALTER TABLE `stock_manage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_management_history`
--
ALTER TABLE `stock_management_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`item_id`);

--
-- Indexes for table `stock_manage_items`
--
ALTER TABLE `stock_manage_items`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `wastage_usage`
--
ALTER TABLE `wastage_usage`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `credit_sale`
--
ALTER TABLE `credit_sale`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_log`
--
ALTER TABLE `inventory_log`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=587;

--
-- AUTO_INCREMENT for table `item_ingredient`
--
ALTER TABLE `item_ingredient`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1046;

--
-- AUTO_INCREMENT for table `item_prices`
--
ALTER TABLE `item_prices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=619;

--
-- AUTO_INCREMENT for table `item_production`
--
ALTER TABLE `item_production`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `open_drawer_log`
--
ALTER TABLE `open_drawer_log`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pay_back`
--
ALTER TABLE `pay_back`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price_size`
--
ALTER TABLE `price_size`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `purchase_pay_log`
--
ALTER TABLE `purchase_pay_log`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sale_orders`
--
ALTER TABLE `sale_orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `sale_order_items`
--
ALTER TABLE `sale_order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=304;

--
-- AUTO_INCREMENT for table `sale_order_payments`
--
ALTER TABLE `sale_order_payments`
  MODIFY `payment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `settle_sale`
--
ALTER TABLE `settle_sale`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_manage`
--
ALTER TABLE `stock_manage`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_management_history`
--
ALTER TABLE `stock_management_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=854;

--
-- AUTO_INCREMENT for table `stock_manage_items`
--
ALTER TABLE `stock_manage_items`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_has_permissions`
--
ALTER TABLE `user_has_permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=509;

--
-- AUTO_INCREMENT for table `wastage_usage`
--
ALTER TABLE `wastage_usage`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
