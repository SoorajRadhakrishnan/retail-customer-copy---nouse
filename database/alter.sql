INSERT INTO `permissions` (`id`, `parent_id`, `name`, `usertype`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '4', 'delivery_log', 'counter', '2024-08-11 17:52:24', NULL, NULL);

INSERT INTO `permissions` (`id`, `parent_id`, `name`, `usertype`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '1', 'barcode_print', 'admin', NULL, NULL, NULL);
INSERT INTO `permissions` (`id`, `parent_id`, `name`, `usertype`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '3', 'supplier_outstanding_report', 'admin', NULL, NULL, NULL);
INSERT INTO `permissions` (`id`, `parent_id`, `name`, `usertype`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '3', 'customer_outstanding_report', 'admin', NULL, NULL, NULL);
INSERT INTO `permissions` (`id`, `parent_id`, `name`, `usertype`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '3', 'driver_outstanding_report', 'admin', NULL, NULL, NULL);
INSERT INTO `permissions` (`id`, `parent_id`, `name`, `usertype`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '3', 'expense_report', 'admin', NULL, NULL, NULL);
INSERT INTO `permissions` (`id`, `parent_id`, `name`, `usertype`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '3', 'profit_loss_report', 'admin', NULL, NULL, NULL);

ALTER TABLE `items` CHANGE `item_type` `item_type` ENUM('1','0','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1 = salable, 0 = non-salable, 2 = raw material';

ALTER TABLE `items` ADD `ingredient` ENUM('1','0') NOT NULL DEFAULT '0' COMMENT '1 = yes, 0 = no' AFTER `stock_applicable`;

ALTER TABLE `sale_orders`
CHANGE `payment_type` `payment_type` varchar(255) COLLATE 'latin1_swedish_ci' NOT NULL DEFAULT 'cash' AFTER `order_type`;

CREATE TABLE `item_ingredient` (`id` INT NOT NULL AUTO_INCREMENT , `item_id` INT NOT NULL , `price_id` INT NOT NULL , `item_name` VARCHAR(255) NOT NULL , `unit` VARCHAR(32) NOT NULL , `qty` INT NOT NULL , `created_at` DATETIME NULL , `updated_at` DATETIME NULL , `deleted_at` DATETIME NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `item_ingredient` ADD `branch_id` INT NULL AFTER `id`, ADD `user_id` INT NOT NULL AFTER `branch_id`;

ALTER TABLE `item_ingredient` DROP `deleted_at`;

ALTER TABLE `item_ingredient` ADD `main_item_id` INT NOT NULL AFTER `user_id`;

ALTER TABLE `item_prices` ADD `ingredient_added` ENUM('1','0') NOT NULL DEFAULT '0' COMMENT '1 = Ingredient added, 2 = not added' AFTER `stock`;

ALTER TABLE `item_ingredient` CHANGE `qty` `qty` DOUBLE NOT NULL;

-- latest

CREATE TABLE `item_production` (`id` INT NOT NULL AUTO_INCREMENT , `branch_id` INT NOT NULL , `user_id` INT NOT NULL , `item_id` INT NOT NULL , `price_id` INT NOT NULL , `qty` DOUBLE NOT NULL , `created_at` DATETIME NULL , `updated_at` DATETIME NULL , `deleted_at` DATETIME NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

INSERT INTO `permissions` (`id`, `parent_id`, `name`, `usertype`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '1', 'production', 'admin', NULL, NULL, NULL);

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, 'production', 'no', NULL, NULL, NULL);

ALTER TABLE `item_prices` ADD `price_item_type` ENUM('1','2') NOT NULL DEFAULT '1' AFTER `stock`;


CREATE TABLE `payment_transfers` (
  `id` bigint(20) NOT NULL,
  `uuid` char(36) NOT NULL,
  `branch_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `source_payment_type` varchar(16) NOT NULL,
  `destination_payment_type` varchar(16) NOT NULL,
  `notes` text DEFAULT NULL,
  `amount` double NOT NULL,
  `transaction_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE `payment_transfers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `payment_transfers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

CREATE TABLE `payment_transcations` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_type` varchar(16) NOT NULL,
  `type` varchar(16) NOT NULL,
  `status` varchar(256) NOT NULL,
  `ref_no` varchar(16) DEFAULT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE `payment_transcations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `payment_transcations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

INSERT INTO `payment_transcations` (`id`, `branch_id`, `user_id`, `payment_type`, `type`, `status`, `ref_no`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '1', '2', 'cash', 'add', 'open_balance', NULL, '0', '2025-04-15 19:51:24', '2025-04-15 19:51:24', NULL);
INSERT INTO `payment_transcations` (`id`, `branch_id`, `user_id`, `payment_type`, `type`, `status`, `ref_no`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '1', '2', 'card', 'add', 'open_balance', NULL, '0', '2025-04-15 19:51:24', '2025-04-15 19:51:24', NULL);
INSERT INTO `payment_transcations` (`id`, `branch_id`, `user_id`, `payment_type`, `type`, `status`, `ref_no`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '1', '2', 'credit', 'add', 'open_balance', NULL, '0', '2025-04-15 19:51:24', '2025-04-15 19:51:24', NULL);
INSERT INTO `payment_transcations` (`id`, `branch_id`, `user_id`, `payment_type`, `type`, `status`, `ref_no`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '1', '2', 'bank-oman', 'add', 'open_balance', NULL, '0', '2025-05-10 18:36:16', '2025-05-10 18:36:16', NULL);

INSERT INTO `payment_transcations` (branch_id, user_id, payment_type, type, status, ref_no, amount, created_at, updated_at) select shop_id, user_id, payment_type, 'add', 'sale', sale_order_id, amount, created_at, updated_at from sale_order_payments where payment_type != 'credit';

INSERT INTO `payment_transcations` (branch_id, user_id, payment_type, type, status, ref_no, amount, created_at, updated_at)
select shop_id, user_id, payment_type, 'add', 'credit_sale', id, amount, paid_date, updated_at from credit_sale where type = 'debit';

INSERT INTO `payment_transcations` (branch_id, user_id, payment_type, type, status, ref_no, amount, created_at, updated_at) select branch_id, user_id, payment_type, 'sub', 'expense', id, total_amount, created_at, updated_at from expenses where payment_status = 'paid' and deleted_at is null and payment_type != null;



-- today (21-05s)
ALTER TABLE `settle_sale` ADD `purchase` VARCHAR(50) NULL AFTER `expense`;
-- quotation

CREATE TABLE `quotations` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL,
  `quotation_no` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total_price` int(255) NOT NULL,
  `total_discount` decimal(13,2) NOT NULL,
  `total_vat` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `quotations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `quotation_items` (
  `id` int(11) NOT NULL,
  `qout_id` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price_size_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `other_item_name` varchar(255) DEFAULT NULL,
  `item_type` int(11) NOT NULL DEFAULT 1,
  `stock_applicable` enum('1','0') NOT NULL,
  `price` decimal(13,2) NOT NULL,
  `item_unit_price` decimal(13,2) NOT NULL,
  `qty` decimal(13,2) NOT NULL,
  `discount` decimal(13,2) DEFAULT NULL,
  `tax_amt` decimal(13,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `quotation_items`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `quotation_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


-- alter 31-05-25

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, 'quotation', 'yes', '2024-12-19 00:00:00', '2025-05-04 10:06:33', NULL);
INSERT INTO `permissions` (`id`, `parent_id`, `name`, `usertype`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '2', 'admin_quotation', 'admin', NULL, NULL, NULL);
INSERT INTO `permissions` (`id`, `parent_id`, `name`, `usertype`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '100', 'admin_quotation_create', 'admin', NULL, NULL, NULL);
INSERT INTO `permissions` (`id`, `parent_id`, `name`, `usertype`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '100', 'admin_quotation_delete', 'admin', NULL, NULL, NULL);
INSERT INTO `permissions` (`id`, `parent_id`, `name`, `usertype`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '4', 'quotation', 'counter', NULL, NULL, NULL);
ALTER TABLE `quotation_items` ADD `price_id` INT NOT NULL AFTER `item_id`;


-- loyality
ALTER TABLE `customers` ADD `referal_code` VARCHAR(255) NOT NULL AFTER `customer_gender`, ADD `points` VARCHAR(255) NULL DEFAULT NULL AFTER `referal_code`;
ALTER TABLE `customers` ADD `refered_by` VARCHAR(255) NULL DEFAULT NULL AFTER `points`;
ALTER TABLE `customers` CHANGE `points` `points` BIGINT(11) NULL DEFAULT NULL;
ALTER TABLE `customers` ADD `discount` INT(11) NULL DEFAULT NULL AFTER `referal_code`;
ALTER TABLE `customers` ADD `referal_discount` INT NOT NULL AFTER `referal_code`;
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, 'referal', 'yes', NULL, NULL, NULL), (NULL, 'referal_discount', '20', NULL, NULL, NULL);
ALTER TABLE `customers` CHANGE `referal_discount` `referal_discount` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `sale_orders` ADD `refered_code` VARCHAR(255) NULL DEFAULT NULL AFTER `active`, ADD `points_redeemed` INT(11) NULL DEFAULT NULL AFTER `refered_code`;

INSERT INTO `permissions` (`id`, `parent_id`, `name`, `usertype`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '4', 'loyality_points', 'counter', NULL, NULL, NULL);

CREATE TABLE `loyality` (`id` INT(11) NOT NULL AUTO_INCREMENT , `min_sale_amount` VARCHAR(255) NOT NULL , `loyalty_points` INT(11) NOT NULL , `selling_points` INT(11) NOT NULL , `redeem_amount` VARCHAR(11) NOT NULL , `created_at` TIMESTAMP NOT NULL , `updated_at` TIMESTAMP NULL DEFAULT NULL , `deleted_at` DATETIME NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `sale_orders` ADD `points_added` VARCHAR(11) NOT NULL DEFAULT '0' AFTER `points_redeemed`;
ALTER TABLE `customers`
  DROP `referal_code`,
  DROP `referal_discount`;

  ALTER TABLE `customers` CHANGE `points` `points` BIGINT(11) NULL DEFAULT '0';
UPDATE `customers` SET `points` = '0'
