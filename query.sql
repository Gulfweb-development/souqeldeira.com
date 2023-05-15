ALTER TABLE `settings` ADD `expire_time_adv` INT NOT NULL DEFAULT '30' AFTER `youtube`, ADD `expire_time_premium_adv` INT NOT NULL DEFAULT '30' AFTER `expire_time_adv`, ADD `price_adv` FLOAT NOT NULL DEFAULT '1' AFTER `expire_time_premium_adv`, ADD `price_premium_adv` FLOAT NOT NULL DEFAULT '2' AFTER `price_adv`;
ALTER TABLE `subscriptions` CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `subscriptions` ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL AFTER `updated_at`;
ALTER TABLE `subscriptions` ADD `expire_time` INT NULL DEFAULT NULL AFTER `status`;
ALTER TABLE `subscription_history` CHANGE `user_id` `user_id` BIGINT(20) UNSIGNED NOT NULL;
ALTER TABLE `subscription_history` ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `subscription_history` ADD FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `subscription_history` CHANGE `order_id` `order_id` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `subscription_history` ADD `adv_count` INT NULL DEFAULT NULL AFTER `order_id`, ADD `featured_count` INT NOT NULL DEFAULT '0' AFTER `adv_count`, ADD `adv_use` INT NULL DEFAULT NULL AFTER `featured_count`, ADD `featured_use` INT NOT NULL DEFAULT '0' AFTER `adv_use`, ADD `expired_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `featured_use`;
