ALTER TABLE `estimates` ADD `project_start_date_type` VARCHAR(30) NULL DEFAULT NULL AFTER `initial_payment_type`;
ALTER TABLE `chat` ADD `estimate_id` INT(11) NOT NULL AFTER `project_id`;
ALTER TABLE `chat` ADD `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_at`;
ALTER TABLE `chat` CHANGE `id` `id` BIGINT(20) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`);
ALTER TABLE `project_reviews` ADD `verified` TINYINT(1) NOT NULL DEFAULT '0' AFTER `description`;
ALTER TABLE `projects` ADD `postcode` VARCHAR(10) NULL AFTER `contact_email`, ADD `county` VARCHAR(20) NULL AFTER `postcode`;
ALTER TABLE `projects` ADD `town` VARCHAR(20) NULL AFTER `county`;
