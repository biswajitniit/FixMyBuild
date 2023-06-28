ALTER TABLE `estimates` ADD `project_start_date_type` VARCHAR(30) NULL DEFAULT NULL AFTER `initial_payment_type`;
ALTER TABLE `chat` ADD `estimate_id` INT(11) NOT NULL AFTER `project_id`;
ALTER TABLE `chat` ADD `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_at`;
ALTER TABLE `chat` CHANGE `id` `id` BIGINT(20) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`);
