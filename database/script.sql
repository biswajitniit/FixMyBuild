ALTER TABLE `estimates` ADD `project_start_date_type` VARCHAR(30) NULL DEFAULT NULL AFTER `initial_payment_type`;
ALTER TABLE `chat` ADD `estimate_id` INT(11) NOT NULL AFTER `project_id`;
ALTER TABLE `chat` ADD `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_at`;
ALTER TABLE `chat` CHANGE `id` `id` BIGINT(20) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`);
ALTER TABLE `project_reviews` ADD `verified` TINYINT(1) NOT NULL DEFAULT '0' AFTER `description`;
ALTER TABLE `projects` ADD `postcode` VARCHAR(10) NULL AFTER `contact_email`, ADD `county` VARCHAR(20) NULL AFTER `postcode`;
ALTER TABLE `projects` ADD `town` VARCHAR(20) NULL AFTER `county`;
ALTER TABLE `projects` ADD `reviewer_id` INT(11) NULL DEFAULT NULL AFTER `status`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id` bigint NOT NULL,
  `parent_id` bigint DEFAULT NULL,
  `from_user_id` int NOT NULL,
  `to_user_id` int NOT NULL,
  `message` text NOT NULL,
  `read_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB;

ALTER TABLE `projects` CHANGE `status` `status` VARCHAR(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'submitted_for_review';
ALTER TABLE `notification_details` ADD `reviewer_note` TEXT NULL DEFAULT NULL AFTER `notification_text`;
ALTER TABLE `projects` ADD `customer_note` TEXT NULL DEFAULT NULL AFTER `subcategories`, ADD `tradeperson_note` TEXT NULL DEFAULT NULL AFTER `customer_note`, ADD `internal_note` TEXT NULL DEFAULT NULL AFTER `tradeperson_note`;
ALTER TABLE `tasks` ADD `is_initial` TINYINT(1) NOT NULL DEFAULT '0' AFTER `description`;
ALTER TABLE `projects` CHANGE `status` `status_old` ENUM('submitted_for_review','returned_for_review','estimation','project_started','awaiting_your_review') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'submitted_for_review';
ALTER TABLE `projects` ADD `satus` VARCHAR(30) NULL DEFAULT NULL AFTER `status_old`;
ALTER TABLE `estimates` ADD `status` VARCHAR(20) NULL DEFAULT NULL AFTER `project_awarded`;
ALTER TABLE `chat` ADD `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_at`;
ALTER TABLE `chat` CHANGE `id` `id` BIGINT(20) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`);
ALTER TABLE `chat` ADD `estimate_id` INT(11) NOT NULL AFTER `project_id`;
ALTER TABLE `chat` ADD `project_id` INT NOT NULL AFTER `to_user_id`;

CREATE TABLE `notification_details` (
  `id` int(11) NOT NULL,
  `read_status` tinyint(1) NOT NULL DEFAULT 0,
  `notification_text` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `notification_details` ADD `user_id` BIGINT(20) NOT NULL AFTER `id`, ADD `from_user_id` BIGINT(20) NOT NULL AFTER `user_id`, ADD `from_user_type` VARCHAR(30) NOT NULL AFTER `from_user_id`, ADD `related_to` VARCHAR(20) NOT NULL AFTER `from_user_type`, ADD `related_to_id` BIGINT(20) NOT NULL AFTER `related_to`;
ALTER TABLE `estimates` CHANGE `initial_payment_type` `initial_payment_type` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Fixed,Percentage';
ALTER TABLE `project_status_change_log` ADD `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `status_changed_at`;
ALTER TABLE `project_status_change_log` ADD `created_at` TIMESTAMP NOT NULL AFTER `status_changed_at`;
ALTER TABLE `project_status_change_log` CHANGE `id` `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`);

--
-- Table structure for table `user_personal_data_shares`
--

CREATE TABLE `user_personal_data_shares` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `tradeperson_id` bigint(20) NOT NULL,
  `settings` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_personal_data_shares`
--

INSERT INTO `user_personal_data_shares` (`id`, `user_id`, `project_id`, `tradeperson_id`, `settings`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 4, '{\"name\":\"1\",\"address\":\"1\",\"home_phone\":\"0\",\"mobile_phone\":\"0\",\"email\":\"0\"}', '2023-07-07 12:28:12', '2023-07-07 06:58:12');



ALTER TABLE `users` DROP INDEX `users_email_unique`;
