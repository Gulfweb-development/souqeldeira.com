ALTER TABLE `settings` ADD `expire_time_adv` INT NOT NULL DEFAULT '30' AFTER `youtube`, ADD `expire_time_premium_adv` INT NOT NULL DEFAULT '30' AFTER `expire_time_adv`, ADD `price_adv` FLOAT NOT NULL DEFAULT '1' AFTER `expire_time_premium_adv`, ADD `price_premium_adv` FLOAT NOT NULL DEFAULT '2' AFTER `price_adv`;
ALTER TABLE `subscriptions` CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `subscriptions` ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL AFTER `updated_at`;
ALTER TABLE `subscriptions` ADD `expire_time` INT NULL DEFAULT NULL AFTER `status`;
ALTER TABLE `subscription_history` CHANGE `user_id` `user_id` BIGINT(20) UNSIGNED NOT NULL;
ALTER TABLE `subscription_history` ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `subscription_history` ADD FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `subscription_history` CHANGE `order_id` `order_id` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `subscription_history` ADD `adv_count` INT NULL DEFAULT NULL AFTER `order_id`, ADD `featured_count` INT NOT NULL DEFAULT '0' AFTER `adv_count`, ADD `adv_use` INT NULL DEFAULT NULL AFTER `featured_count`, ADD `featured_use` INT NOT NULL DEFAULT '0' AFTER `adv_use`, ADD `expired_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `featured_use`;
ALTER TABLE `subscription_history` ADD `is_payed` BOOLEAN NOT NULL DEFAULT FALSE AFTER `order_id`;
CREATE TABLE `orders` ( `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `description_en` VARCHAR(255) NULL DEFAULT NULL , `description_ar` VARCHAR(255) NULL DEFAULT NULL , `transaction_id` VARCHAR(255) NULL DEFAULT NULL , `price` VARCHAR(10) NULL DEFAULT NULL , `status` VARCHAR(100) NOT NULL DEFAULT 'pending' , `on_success` LONGTEXT NULL DEFAULT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `orders` ADD `description` TEXT NULL DEFAULT NULL AFTER `on_success`;

ALTER TABLE `settings` ADD `num_special_position` INT NOT NULL DEFAULT '0' AFTER `price_premium_adv`, ADD `special_position` TEXT NULL DEFAULT NULL AFTER `num_special_position`;
CREATE TABLE `premium_positions` ( `id` INT NOT NULL AUTO_INCREMENT , `user_id` BIGINT UNSIGNED NOT NULL , `order_id` BIGINT UNSIGNED NULL DEFAULT NULL , `is_payed` BOOLEAN NOT NULL DEFAULT FALSE , `title` VARCHAR(255) NULL DEFAULT NULL , `description` TEXT NULL DEFAULT NULL , `image` TEXT NULL DEFAULT NULL , `link` TEXT NULL DEFAULT NULL , `expired_at` DATETIME NULL DEFAULT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `premium_positions` ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT; ALTER TABLE `premium_positions` ADD FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `premium_positions` ADD `position` INT NOT NULL AFTER `is_payed`;

CREATE TABLE `tracks` ( `id` VARCHAR(255) NOT NULL , `belongs_to_type` VARCHAR(255) NULL DEFAULT NULL , `belongs_to` BIGINT UNSIGNED NULL DEFAULT NULL , `type` ENUM('view','click') NOT NULL DEFAULT 'view' , `ip` VARCHAR(255) NULL DEFAULT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `tracks` ADD `is_featured` BOOLEAN NOT NULL DEFAULT FALSE AFTER `type`;
ALTER TABLE `tracks` ADD `time_checker` VARCHAR(255) NULL DEFAULT NULL AFTER `ip`;
ALTER TABLE `tracks` ADD INDEX(`belongs_to_type`, `belongs_to`, `type`, `ip`, `time_checker`);
ALTER TABLE `ads` ADD `tracks` TEXT NULL DEFAULT NULL AFTER `views`;
ALTER TABLE `users` ADD `tracks` TEXT NULL DEFAULT NULL AFTER `type`;

ALTER TABLE `settings` ADD `gift_normal` INT NOT NULL DEFAULT '0' AFTER `expire_time_premium_adv`, ADD `gift_premium` INT NOT NULL DEFAULT '0' AFTER `gift_normal`;

CREATE TABLE `personal_access_tokens` (
                                          `id` bigint(20) UNSIGNED NOT NULL,
                                          `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `tokenable_id` bigint(20) UNSIGNED NOT NULL,
                                          `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                          `last_used_at` timestamp NULL DEFAULT NULL,
                                          `created_at` timestamp NULL DEFAULT NULL,
                                          `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `personal_access_tokens`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

ALTER TABLE `personal_access_tokens`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

-- ===============================================================================
