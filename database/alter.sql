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
